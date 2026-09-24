<?php

namespace App\Support;

use App\Models\Appointment;
use App\Models\AppointmentPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Formats website appointments for Bansal Legal CRM pull-sync
 * ({@see BansalLaw_CRM BansalApiClient / AppointmentSyncService}).
 */
final class CrmAppointmentPresenter
{
    /**
     * @return array<string, mixed>
     */
    public static function toArray(Appointment $appointment): array
    {
        $appointment->loadMissing(['service', 'natureOfEnquiry', 'assignee_user', 'payment']);

        $payment = $appointment->payment;
        $isPaid = self::isPaid($appointment, $payment);
        $amount = self::amount($appointment, $payment);
        $finalAmount = self::finalAmount($appointment, $payment);
        $status = self::crmStatus((int) $appointment->status, $isPaid);
        $tz = $appointment->timezone ?: (string) config('services.crm_lead.default_timezone', 'Australia/Sydney');
        $datetime = self::appointmentDatetime($appointment, $tz);
        $dateYmd = self::dateYmd($appointment);
        $timeHi = self::timeHi($appointment);
        $meetingType = self::meetingType($appointment);
        $location = (string) config('services.crm_lead.location', 'melbourne');

        return [
            'id' => (int) $appointment->id,
            'order_hash' => $appointment->order_hash,
            'full_name' => (string) $appointment->full_name,
            'email' => (string) $appointment->email,
            'phone' => (string) ($appointment->phone ?? ''),
            'location' => $location,
            'meeting_type' => $meetingType,
            'preferred_language' => 'English',
            'enquiry_type' => null,
            'enquiry_type_display' => $appointment->natureOfEnquiry?->title,
            'service_type' => self::serviceType($appointment),
            'specific_service' => $isPaid ? 'paid-consultation' : null,
            'enquiry_details' => self::enquiryDetails($appointment),
            'appointment_date' => $dateYmd,
            'appointment_time' => $timeHi,
            'appointment_datetime' => $datetime,
            'duration_minutes' => (int) ($appointment->service?->duration ?? config('services.crm_lead.default_duration', 30)),
            'status' => $status,
            'status_display' => self::statusDisplay((int) $appointment->status),
            'is_paid' => $isPaid,
            'amount' => $amount,
            'discount_amount' => max(0, round($amount - $finalAmount, 2)),
            'final_amount' => $finalAmount,
            'promo_code' => null,
            'noe_id' => $appointment->noe_id !== null ? (int) $appointment->noe_id : null,
            'service_id' => $appointment->service_id !== null ? (int) $appointment->service_id : null,
            'timeslot_full' => (string) ($appointment->timeslot_full ?? ''),
            'timezone' => $tz,
            'assigned_admin' => $appointment->assignee_user ? [
                'id' => $appointment->assignee_user->id,
                'name' => trim(($appointment->assignee_user->first_name ?? '').' '.($appointment->assignee_user->last_name ?? '')),
                'email' => $appointment->assignee_user->email ?? null,
            ] : null,
            'payment' => $payment ? [
                'id' => $payment->id,
                'status' => self::crmPaymentStatus($payment),
                'amount' => (float) ($payment->amount ?? 0),
                'payment_method' => (string) ($payment->payment_type ?? 'stripe'),
                'paid_at' => $payment->order_date?->toIso8601String(),
            ] : null,
            'admin_notes' => null,
            'client_notes' => null,
            'confirmed_at' => in_array($status, ['confirmed', 'paid', 'completed'], true)
                ? ($appointment->updated_at?->toIso8601String())
                : null,
            'cancelled_at' => $status === 'cancelled' ? ($appointment->updated_at?->toIso8601String()) : null,
            'cancellation_reason' => null,
            'created_at' => $appointment->created_at?->toIso8601String(),
            'updated_at' => $appointment->updated_at?->toIso8601String(),
        ];
    }

    public static function crmStatus(int $status, bool $isPaid): string
    {
        return match ($status) {
            1 => 'confirmed',
            2 => 'completed',
            3, 7 => 'cancelled',
            6, 8 => 'no_show',
            10 => 'paid',
            9, 11 => 'pending',
            default => $isPaid ? 'paid' : 'pending',
        };
    }

    public static function statusDisplay(int $status): string
    {
        return match ($status) {
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Completed',
            3 => 'Rejected',
            4 => 'N/P',
            5 => 'In Progress',
            6 => 'Did Not Come',
            7 => 'Cancelled',
            8 => 'Missed',
            9 => 'Payment Pending',
            10 => 'Payment Success',
            11 => 'Payment Failed',
            default => 'Unknown',
        };
    }

    /**
     * Map CRM sync status action to website numeric status.
     */
    public static function websiteStatusFromCrmType(string $type): ?int
    {
        return match ($type) {
            'cancel' => 7,
            'complete' => 2,
            'confirm' => 1,
            default => null,
        };
    }

    public static function meetingType(Appointment $appointment): string
    {
        $fallback = (string) config('services.crm_lead.meeting_type', 'in_person');
        $label = trim((string) ($appointment->appointment_details ?? ''));
        if ($label === '') {
            return $fallback;
        }

        $lower = strtolower($label);
        if (str_contains($lower, 'zoom') || str_contains($lower, 'google meeting') || str_contains($lower, 'video')) {
            return 'video-call';
        }
        if (str_contains($lower, 'phone')) {
            return 'phone';
        }
        if (str_contains($lower, 'in-person') || str_contains($lower, 'in person')) {
            return 'in-person';
        }

        return $fallback === 'in_person' ? 'in-person' : str_replace('_', '-', $fallback);
    }

    public static function meetingTypeLabelForStorage(string $meetingType): string
    {
        $normalized = strtolower(str_replace([' ', '-'], '_', trim($meetingType)));

        return match ($normalized) {
            'phone', 'telephone', 'call' => 'Phone',
            'video', 'video_call', 'videocall', 'zoom', 'online' => 'Zoom',
            default => 'In-Person',
        };
    }

    /**
     * CRM AppointmentSyncService::mapNoeId requires a known service_type string.
     */
    public static function serviceType(Appointment $appointment): string
    {
        $configured = trim((string) config('services.crm_lead.service_type', ''));
        if ($configured !== '') {
            return $configured;
        }

        $title = strtolower(trim((string) ($appointment->natureOfEnquiry?->title ?? '')));
        if ($title === '') {
            return 'complex-matters';
        }

        if (str_contains($title, 'tourist')) {
            return 'tourist-visa';
        }
        if (str_contains($title, 'education') || str_contains($title, 'student')) {
            return 'education-visa';
        }
        if (str_contains($title, 'temporary') || str_contains($title, '489') || str_contains($title, '482')) {
            return 'temporary-residency';
        }
        if (str_contains($title, 'permanent') || str_contains($title, 'pr ') || str_contains($title, '189') || str_contains($title, '190')) {
            return 'permanent-residency';
        }
        if (str_contains($title, 'cancel')) {
            return 'visa-cancellation';
        }
        if (str_contains($title, 'jrp') || str_contains($title, 'skill assessment')) {
            return 'jrp-skill-assessment';
        }

        return 'complex-matters';
    }

    private static function isPaid(Appointment $appointment, ?AppointmentPayment $payment): bool
    {
        if ($payment && $payment->isSuccessful()) {
            return true;
        }

        $status = (int) $appointment->status;
        if (in_array($status, [10, 1, 2], true) && ConsultationServices::parsePriceAud($appointment->service) > 0) {
            return true;
        }

        return false;
    }

    private static function amount(Appointment $appointment, ?AppointmentPayment $payment): float
    {
        if ($payment && $payment->amount !== null) {
            return (float) $payment->amount;
        }

        return ConsultationServices::parsePriceAud($appointment->service);
    }

    private static function finalAmount(Appointment $appointment, ?AppointmentPayment $payment): float
    {
        if ($payment && $payment->amount !== null) {
            return (float) $payment->amount;
        }

        return self::isPaid($appointment, $payment)
            ? ConsultationServices::parsePriceAud($appointment->service)
            : 0.0;
    }

    private static function crmPaymentStatus(AppointmentPayment $payment): string
    {
        if ($payment->isSuccessful()) {
            return 'completed';
        }
        if ($payment->isFailed()) {
            return 'failed';
        }

        return 'pending';
    }

    private static function enquiryDetails(Appointment $appointment): string
    {
        $parts = array_filter([
            trim((string) ($appointment->description ?? '')),
            trim((string) ($appointment->appointment_details ?? '')),
        ], static fn ($v) => $v !== '');

        return implode("\n\n", $parts);
    }

    private static function dateYmd(Appointment $appointment): string
    {
        $date = trim((string) ($appointment->date ?? ''));
        if ($date === '') {
            return '';
        }

        try {
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Throwable $e) {
            return $date;
        }
    }

    private static function timeHi(Appointment $appointment): string
    {
        $time = trim((string) ($appointment->time ?? ''));
        if ($time === '') {
            $slot = trim((string) ($appointment->timeslot_full ?? ''));
            if ($slot !== '') {
                $start = explode('-', $slot)[0] ?? $slot;
                $ts = strtotime(trim($start));
                if ($ts !== false) {
                    return date('H:i', $ts);
                }
            }

            return '00:00';
        }

        if (preg_match('/^\d{1,2}:\d{2}/', $time)) {
            try {
                return Carbon::parse($time)->format('H:i');
            } catch (\Throwable $e) {
                return substr($time, 0, 5);
            }
        }

        $ts = strtotime($time);

        return $ts !== false ? date('H:i', $ts) : '00:00';
    }

    private static function appointmentDatetime(Appointment $appointment, string $tz): string
    {
        $date = self::dateYmd($appointment);
        $time = self::timeHi($appointment);
        if ($date === '') {
            return $appointment->created_at?->toIso8601String() ?? now()->toIso8601String();
        }

        try {
            return Carbon::parse($date.' '.$time, $tz)->toIso8601String();
        } catch (\Throwable $e) {
            Log::warning('CRM appointment_datetime parse failed', [
                'appointment_id' => $appointment->id,
                'error' => $e->getMessage(),
            ]);

            return $date.'T'.$time.':00';
        }
    }
}
