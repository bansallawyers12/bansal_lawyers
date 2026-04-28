<?php

namespace App\Support;

use App\Models\Appointment;
use App\Support\BookingTimeSlots;
use Carbon\Carbon;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

final class CrmLeadSync
{
    /**
     * POST /api/leads — CRM creates a lead or returns existing (same email). Returns admins.id / lead_id or null.
     */
    public static function createOrResolveLeadId(Appointment $appointment): ?int
    {
        $leadUrl = rtrim((string) config('services.crm_lead.url', ''), '/');
        if ($leadUrl === '') {
            return null;
        }


        $appointment->loadMissing('service');

        $fullName = (string) $appointment->full_name;
        $email = (string) $appointment->email;
        $phoneRaw = (string) $appointment->phone;

        $defaultCc = (string) config('services.crm_lead.country_code', '+61');
        [$countryCode, $nationalPhone] = self::splitCountryAndPhone($phoneRaw, $defaultCc);

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
                Log::warning('CRM /api/leads returned non-success status', [
                    'status' => $leadResponse->status(),
                    'body' => $leadResponse->body(),
                    'appointment_id' => $appointment->id,
                ]);

                return null;
            }

            $leadJson = $leadResponse->json();
            $leadArray = is_array($leadJson) ? $leadJson : null;
            $leadId = self::parseLeadIdFromLeadsApiResponse($leadArray);

            if ($leadId === null) {
                Log::warning('CRM /api/leads succeeded but lead_id not found in response', [
                    'body' => $leadResponse->body(),
                    'json_type' => get_debug_type($leadJson),
                    'appointment_id' => $appointment->id,
                ]);

                return null;
            }

            Log::info('CRM /api/leads lead_id resolved (passed to booking as client_id)', [
                'appointment_id' => $appointment->id,
                'lead_id' => $leadId,
                'http' => $leadResponse->status(),
            ]);

            return $leadId;
        } catch (\Throwable $e) {
            Log::error('CRM /api/leads request failed', [
                'message' => $e->getMessage(),
                'appointment_id' => $appointment->id,
                'trace' => $e->getTraceAsString(),
            ]);

            return null;
        }
    }

    /**
     * POST CRM get-booked-disabled-time-slots (booked starts for a day as slot labels).
     * Response shape: { success, data: { disabledtimeslotes: string[] } }.
     *
     * @param  string  $dateDdMmYyyy  e.g. 27/04/2026
     * @return list<string>
     */
    public static function fetchCrmBookedDisabledTimeSlots(string $dateDdMmYyyy, int $inpersonAddress = 2): array
    {
        $url = rtrim((string) config('services.crm_lead.disabled_time_slots_url', ''), '/');
        if ($url === '') {
            return [];
        }

        $addr = in_array($inpersonAddress, [1, 2], true) ? $inpersonAddress : 2;

        $timeoutSeconds = (float) config('services.crm_lead.disabled_time_slots_timeout', 4);
        if ($timeoutSeconds < 1.0) {
            $timeoutSeconds = 4.0;
        }

        try {
            $response = self::httpClientForDisabledTimeSlots()
                ->connectTimeout(min(3.0, $timeoutSeconds))
                ->timeout($timeoutSeconds)
                ->asJson()
                ->post($url, [
                    'date' => $dateDdMmYyyy,
                    'inperson_address' => $addr,
                ]);

            if (! $response->successful()) {
                Log::warning('CRM get-booked-disabled-time-slots returned non-success status', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [];
            }

            $json = $response->json();
            if (! is_array($json)) {
                return [];
            }

            $slots = [];
            $data = $json['data'] ?? null;
            if (is_array($data) && isset($data['disabledtimeslotes']) && is_array($data['disabledtimeslotes'])) {
                $slots = $data['disabledtimeslotes'];
            } elseif (isset($json['disabledtimeslotes']) && is_array($json['disabledtimeslotes'])) {
                $slots = $json['disabledtimeslotes'];
            }

            if ($slots === []) {
                return [];
            }

            $normalized = [];
            foreach ($slots as $raw) {
                if (! is_string($raw) && ! is_numeric($raw)) {
                    continue;
                }
                $n = BookingTimeSlots::normalizeLabel((string) $raw);
                if ($n !== '') {
                    $normalized[] = $n;
                }
            }

            return array_values(array_unique($normalized));
        } catch (\Throwable $e) {
            Log::warning('CRM get-booked-disabled-time-slots request failed', [
                'message' => $e->getMessage(),
            ]);

            return [];
        }
    }

    /**
     * Create or resolve lead via /api/leads, then POST booking-appointments with that client_id.
     *
     * @param  array<string, mixed>  $payment
     */
    public static function syncAppointmentToCrm(Appointment $appointment, array $payment = []): void
    {
        $leadUrl = rtrim((string) config('services.crm_lead.url', ''), '/');
        if ($leadUrl === '') {
            return;
        }

        $appointment->loadMissing('service');

        Log::info('CRM sync started (lead + booking)', [
            'appointment_id' => $appointment->id,
            'lead_url' => $leadUrl,
        ]);

        $leadId = self::createOrResolveLeadId($appointment);
        if ($leadId === null) {
            return;
        }

        $phoneRaw = (string) $appointment->phone;
        $defaultCc = (string) config('services.crm_lead.country_code', '+61');
        [$countryCode, $nationalPhone] = self::splitCountryAndPhone($phoneRaw, $defaultCc);
        $clientPhoneE164 = self::e164($countryCode, $nationalPhone);

        self::postBookingAppointment($appointment, $leadId, $clientPhoneE164, $payment);
    }

    /**
     * @param  int  $leadId  Numeric id from POST /api/leads response (`lead_id` / `data.lead_id` / `data.id` = CRM `admins.id`).
     */
    private static function postBookingAppointment(
        Appointment $appointment,
        int $leadId,
        string $clientPhoneE164,
        array $payment
    ): void {
        $bookingUrl = rtrim((string) config('services.crm_lead.booking_url', ''), '/');
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

        $duration = (int) ($appointment->service?->duration ?? config('services.crm_lead.default_duration', 30));

        $payload = [
            'bansal_appointment_id' => (int) $appointment->id,
            'order_hash' => (string) ($appointment->order_hash ?? ''),
            'client_name' => $appointment->full_name,
            'client_email' => $appointment->email,
            'client_phone' => $clientPhoneE164,
            'appointment_datetime' => self::appointmentDatetime($appointment),
            'location' => (string) config('services.crm_lead.location', 'melbourne'),
            'timeslot_full' => (string) ($appointment->timeslot_full ?? ''),
            'duration' => $duration,
            'noe_id' => (int) $appointment->noe_id,
            'timezone' => (string) ($appointment->timezone ?: config('services.crm_lead.default_timezone', 'Australia/Sydney')),
            'client_id' => $leadId,
            'meeting_type' => self::meetingTypeForCrm($appointment->appointment_details),
            'enquiry_details' => trim((string) $appointment->description.(($appointment->appointment_details ?? '') !== ''
                ? "\n\n".(string) $appointment->appointment_details
                : '')),
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

        $consultantId = config('services.crm_lead.consultant_id');
        if ($consultantId !== null && $consultantId !== '') {
            $payload['consultant_id'] = (int) $consultantId;
        }

        if (($payload['order_hash'] ?? '') === '') {
            unset($payload['order_hash']);
        }

        try {
            $bookingResponse = self::httpClient()
                ->timeout(20)
                ->asJson()
                ->post($bookingUrl, $payload);

            if (! $bookingResponse->successful()) {
                Log::warning('CRM booking-appointments returned non-success status', [
                    'status' => $bookingResponse->status(),
                    'body' => $bookingResponse->body(),
                    'lead_id' => $leadId,
                ]);

                return;
            }

            Log::info('CRM booking created', [
                'appointment_id' => $appointment->id,
                'lead_id' => $leadId,
                'http' => $bookingResponse->status(),
            ]);
        } catch (\Throwable $e) {
            Log::error('CRM booking-appointments request failed', [
                'message' => $e->getMessage(),
                'lead_id' => $leadId,
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Read only BansalLaw_CRM /api/leads fields — do not use generic id scanning (avoids wrong client_id).
     *
     * Shape: { "success": true, "lead_id": <int>, "data": { "id", "lead_id", "client_reference", ... } }
     * `client_reference` is NOT the FK; booking `client_id` must be `lead_id` / admins.id.
     */
    private static function parseLeadIdFromLeadsApiResponse(?array $json): ?int
    {
        if ($json === null) {
            return null;
        }

        $fromRoot = self::coerceAdminPk($json['lead_id'] ?? null);
        if ($fromRoot !== null) {
            return $fromRoot;
        }

        if (isset($json['data']) && is_array($json['data'])) {
            $data = $json['data'];
            $fromDataLead = self::coerceAdminPk($data['lead_id'] ?? null);
            if ($fromDataLead !== null) {
                return $fromDataLead;
            }
            $fromDataId = self::coerceAdminPk($data['id'] ?? null);
            if ($fromDataId !== null) {
                return $fromDataId;
            }
        }

        return null;
    }

    /**
     * CRM admins.id from API (positive integer only — never use client_reference / string client_id).
     */
    private static function coerceAdminPk(mixed $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }
        if (is_int($value)) {
            return $value > 0 ? $value : null;
        }
        if (is_string($value)) {
            $value = trim($value);
            if ($value !== '' && ctype_digit($value)) {
                $i = (int) $value;

                return $i > 0 ? $i : null;
            }
        }
        if (is_float($value)) {
            $i = (int) round($value);

            return $i > 0 ? $i : null;
        }

        return null;
    }

    /**
     * CRM booking `meeting_type` from stored consultation mode (`appointments.appointment_details`).
     * Falls back to `services.crm_lead.meeting_type` when empty or unrecognized.
     */
    private static function meetingTypeForCrm(?string $appointmentDetails): string
    {
        $fallback = (string) config('services.crm_lead.meeting_type', 'in_person');
        $label = trim((string) $appointmentDetails);
        if ($label === '') {
            return $fallback;
        }

        $lower = strtolower($label);

        if (str_contains($lower, 'zoom') || str_contains($lower, 'google meeting')) {
            return 'video';
        }
        if (str_contains($lower, 'phone')) {
            return 'phone';
        }
        if (str_contains($lower, 'in-person') || str_contains($lower, 'in person')) {
            return 'in_person';
        }

        return $fallback;
    }

    private static function httpClient(): PendingRequest
    {
        $req = Http::acceptJson();
        if (! config('services.crm_lead.verify_ssl', true)) {
            $req = $req->withoutVerifying();
        }
        $token = (string) config('services.crm_lead.api_token', '');
        if ($token !== '') {
            $req = $req->withToken($token);
        }

        return $req;
    }

    /**
     * CRM disabled-slots route is public; avoid sending Bearer by default so lead-sync tokens do not cause 401.
     */
    private static function httpClientForDisabledTimeSlots(): PendingRequest
    {
        $req = Http::acceptJson();
        if (! config('services.crm_lead.verify_ssl', true)) {
            $req = $req->withoutVerifying();
        }
        $useToken = (bool) config('services.crm_lead.disabled_time_slots_use_token', false);
        $token = (string) config('services.crm_lead.api_token', '');
        if ($useToken && $token !== '') {
            $req = $req->withToken($token);
        }

        return $req;
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
