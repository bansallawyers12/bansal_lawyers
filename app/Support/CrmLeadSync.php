<?php

namespace App\Support;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

final class CrmLeadSync
{
    /**
     * Create CRM lead then booking row. Logs and returns on failure; never throws to callers.
     *
     * @param  array<string, mixed>  $payment
     */
    public static function syncAppointmentToCrm(Appointment $appointment, array $payment = []): void
    {
        $leadUrl = (string) config('services.crm_lead.url', '');
        if ($leadUrl === '') {
            return;
        }

        $appointment->loadMissing('service');

        $fullName = (string) $appointment->full_name;
        $email = (string) $appointment->email;
        $phoneRaw = (string) $appointment->phone;

        $defaultCc = (string) config('services.crm_lead.country_code', '+61');
        [$countryCode, $nationalPhone] = self::splitCountryAndPhone($phoneRaw, $defaultCc);
        $clientPhoneE164 = self::e164($countryCode, $nationalPhone);

        $leadPayload = [
            'full_name' => $fullName,
            'email' => $email,
            'phone' => $nationalPhone,
            'country_code' => $countryCode,
            'source' => (string) config('services.crm_lead.source', 'Website form'),
            'lead_status' => (string) config('services.crm_lead.lead_status', 'new'),
        ];

        try {
            $leadResponse = self::httpClient()
                ->timeout(15)
                ->asJson()
                ->post($leadUrl, $leadPayload);

            if (! $leadResponse->successful()) {
                Log::warning('CRM leadspost returned non-success status', [
                    'status' => $leadResponse->status(),
                    'body' => $leadResponse->body(),
                ]);

                return;
            }

            $leadJson = $leadResponse->json();
            $crmClientId = self::extractLeadId($leadJson);

            if ($crmClientId === null) {
                Log::warning('CRM leadspost succeeded but lead id not found in response', [
                    'body' => $leadResponse->body(),
                ]);

                return;
            }

            self::postBookingAppointment($appointment, $crmClientId, $clientPhoneE164, $payment);
        } catch (\Throwable $e) {
            Log::error('CRM leadspost request failed', [
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @param  array<string, mixed>  $payment
     */
    private static function postBookingAppointment(
        Appointment $appointment,
        int $crmClientId,
        string $clientPhoneE164,
        array $payment
    ): void {
        $bookingUrl = (string) config('services.crm_lead.booking_url', '');
        if ($bookingUrl === '') {
            return;
        }

        $isPaid = (bool) ($payment['is_paid'] ?? false);
        $amount = (float) ($payment['amount'] ?? 0);
        $discountAmount = (float) ($payment['discount_amount'] ?? 0);
        $finalAmount = (float) ($payment['final_amount'] ?? 0);
        $promoCode = $payment['promo_code'] ?? null;
        $paymentStatus = (string) ($payment['payment_status'] ?? 'completed');
        $paymentMethod = (string) ($payment['payment_method'] ?? ($isPaid ? 'stripe' : 'promo_free'));
        $paidAt = (string) ($payment['paid_at'] ?? now()->format('Y-m-d H:i:s'));
        $confirmedAt = (string) ($payment['confirmed_at'] ?? $paidAt);

        $crmServiceId = config('services.crm_lead.crm_service_id');
        $serviceId = $crmServiceId !== null && $crmServiceId !== ''
            ? (int) $crmServiceId
            : (int) $appointment->service_id;

        $duration = (int) ($appointment->service->duration ?? config('services.crm_lead.default_duration', 30));

        $payload = [
            'client_name' => $appointment->full_name,
            'client_email' => $appointment->email,
            'client_phone' => $clientPhoneE164,
            'appointment_datetime' => self::appointmentDatetime($appointment),
            'location' => (string) config('services.crm_lead.location', 'melbourne'),
            'timeslot_full' => (string) ($appointment->timeslot_full ?? ''),
            'duration' => $duration,
            'noe_id' => (int) $appointment->noe_id,
            'timezone' => (string) ($appointment->timezone ?: config('services.crm_lead.default_timezone', 'Australia/Sydney')),
            'client_id' => $crmClientId,
            'meeting_type' => (string) config('services.crm_lead.meeting_type', 'in_person'),
            'enquiry_details' => trim((string) $appointment->description.(($appointment->appointment_details ?? '') !== ''
                ? "\n\n".(string) $appointment->appointment_details
                : '')),
            'consultant_id' => (int) config('services.crm_lead.consultant_id', 2),
            'status' => (string) ($payment['status'] ?? (string) $appointment->status),
            'is_paid' => $isPaid,
            'amount' => $amount,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'promo_code' => $promoCode,
            'service_id' => $serviceId,
            'payment_status' => $paymentStatus,
            'payment_method' => $paymentMethod,
            'paid_at' => $paidAt,
            'confirmed_at' => $confirmedAt,
        ];

        try {
            $bookingResponse = self::httpClient()
                ->timeout(20)
                ->asJson()
                ->post($bookingUrl, $payload);

            if (! $bookingResponse->successful()) {
                Log::warning('CRM booking-appointments returned non-success status', [
                    'status' => $bookingResponse->status(),
                    'body' => $bookingResponse->body(),
                    'crm_client_id' => $crmClientId,
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('CRM booking-appointments request failed', [
                'message' => $e->getMessage(),
                'crm_client_id' => $crmClientId,
            ]);
        }
    }

    private static function httpClient(): PendingRequest
    {
        $req = Http::acceptJson();
        $token = (string) config('services.crm_lead.api_token', '');
        if ($token !== '') {
            $req = $req->withToken($token);
        }

        return $req;
    }

    /**
     * @param  array<string, mixed>|null  $json
     */
    private static function extractLeadId(?array $json): ?int
    {
        if ($json === null) {
            return null;
        }

        $paths = [
            ['id'],
            ['lead_id'],
            ['client_id'],
            ['data', 'id'],
            ['data', 'lead_id'],
            ['data', 'client_id'],
            ['result', 'id'],
            ['lead', 'id'],
        ];

        foreach ($paths as $path) {
            $v = $json;
            foreach ($path as $p) {
                if (! is_array($v) || ! array_key_exists($p, $v)) {
                    $v = null;
                    break;
                }
                $v = $v[$p];
            }
            if ($v !== null && $v !== '' && is_numeric($v)) {
                return (int) $v;
            }
        }

        return null;
    }

    private static function appointmentDatetime(Appointment $a): string
    {
        $tz = $a->timezone ?: (string) config('services.crm_lead.default_timezone', 'Australia/Sydney');
        $date = trim((string) $a->date);
        $time = trim((string) $a->time);

        if ($date === '') {
            return '';
        }

        if ($time === '') {
            $time = '00:00:00';
        } elseif (preg_match('/^\d{1,2}:\d{2}$/', $time)) {
            $time .= ':00';
        }

        try {
            return Carbon::parse($date.' '.$time, $tz)->format('Y-m-d H:i:s');
        } catch (\Throwable $e) {
            Log::warning('CRM booking appointment_datetime parse failed', [
                'error' => $e->getMessage(),
                'date' => $date,
                'time' => $time,
            ]);

            return $date.' '.$time;
        }
    }

    private static function e164(string $countryCode, string $nationalDigits): string
    {
        $cc = (string) preg_replace('/\D+/', '', $countryCode);
        $nat = (string) preg_replace('/\D+/', '', $nationalDigits);

        return '+'.$cc.$nat;
    }

    /**
     * @return array{0: string, 1: string} [country_code, national_digits]
     */
    private static function splitCountryAndPhone(string $phone, string $defaultCountryCode): array
    {
        $digits = (string) preg_replace('/\D+/', '', $phone);
        $ccDigits = (string) preg_replace('/\D+/', '', $defaultCountryCode);

        if ($ccDigits !== '' && str_starts_with($digits, $ccDigits) && strlen($digits) > strlen($ccDigits)) {
            return [$defaultCountryCode, substr($digits, strlen($ccDigits))];
        }

        if (str_starts_with($digits, '0') && strlen($digits) >= 9) {
            $digits = substr($digits, 1);
        }

        return [$defaultCountryCode, $digits];
    }
}
