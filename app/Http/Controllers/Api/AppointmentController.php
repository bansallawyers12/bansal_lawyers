<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentPayment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /** Admin workflow: not yet approved (includes paid-awaiting-approval). */
    private const PENDING_STATUSES = [0, 9, 10];

    private const APPROVED_STATUSES = [1];

    public function index(Request $request): JsonResponse
    {
        $perPage = min(max((int) $request->query('per_page', 20), 1), 100);

        $query = Appointment::query()
            ->with(['service', 'natureOfEnquiry', 'assignee_user', 'payment'])
            ->orderByDesc('created_at');

        if ($request->filled('service_id')) {
            $query->where('service_id', $request->integer('service_id'));
        }

        $this->applyAppointmentStatusScope($request, $query);

        if ($request->filled('q')) {
            $q = substr(trim((string) $request->query('q')), 0, 100);
            $q = preg_replace('/[<>"\']/', '', $q);
            if ($q !== '') {
                $query->where(function ($qry) use ($q) {
                    $qry->where('description', 'like', '%'.$q.'%')
                        ->orWhere('client_unique_id', 'like', '%'.$q.'%')
                        ->orWhere('full_name', 'like', '%'.$q.'%')
                        ->orWhere('email', 'like', '%'.$q.'%');
                });
            }
        }

        $paginator = $query->paginate($perPage);

        return response()->json([
            'data' => collect($paginator->items())->map(fn (Appointment $a) => $this->serializeAppointment($a))->values(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
        ]);
    }

    /**
     * status_filter: comma list of pending, approved (case-insensitive), e.g. pending,approved
     * status: single id, or comma-separated ids, e.g. 0,1,10 — ignored when status_filter is set
     */
    private function applyAppointmentStatusScope(Request $request, Builder $query): void
    {
        if ($request->filled('status_filter')) {
            $parts = array_map('trim', explode(',', strtolower((string) $request->query('status_filter'))));
            $ids = [];
            foreach ($parts as $p) {
                if ($p === 'approved') {
                    $ids = array_merge($ids, self::APPROVED_STATUSES);
                } elseif ($p === 'pending') {
                    $ids = array_merge($ids, self::PENDING_STATUSES);
                }
            }
            $ids = array_values(array_unique(array_map('intval', $ids)));
            if ($ids !== []) {
                $query->whereIn('status', $ids);
            }

            return;
        }

        if (! $request->filled('status')) {
            return;
        }

        $raw = (string) $request->query('status');
        if (str_contains($raw, ',')) {
            $ids = array_values(array_filter(array_map('intval', explode(',', $raw))));
            if ($ids !== []) {
                $query->whereIn('status', $ids);
            }
        } else {
            $query->where('status', $request->integer('status'));
        }
    }

    public function show(Appointment $appointment): JsonResponse
    {
        $appointment->load(['service', 'natureOfEnquiry', 'assignee_user', 'payment']);

        return response()->json([
            'data' => $this->serializeBookingDetail($appointment, $appointment->payment),
        ]);
    }

    private function serializeBookingDetail(Appointment $a, ?AppointmentPayment $payment): array
    {
        $base = $this->serializeAppointment($a);

        return array_merge($base, [
            'timeslot_full' => $a->timeslot_full,
            'appointment_details' => $a->appointment_details,
            'invites' => $a->invites,
            'related_to' => $a->related_to,
            'user_id' => $a->user_id,
            'client_id' => $a->client_id,
            'assignee_id' => $a->assignee,
            'payment' => $payment ? [
                'amount' => $payment->amount,
                'currency' => $payment->currency,
                'payment_status' => $payment->payment_status,
                'order_status' => $payment->order_status,
                'payment_type' => $payment->payment_type,
                'order_date' => $payment->order_date?->toIso8601String(),
                'stripe_payment_intent_id' => $payment->stripe_payment_intent_id,
            ] : null,
        ]);
    }

    private function serializeAppointment(Appointment $a): array
    {
        $status = (int) $a->status;

        return [
            'id' => $a->id,
            'full_name' => $a->full_name,
            'email' => $a->email,
            'phone_no' => $a->phone,
            'client_unique_id' => $a->client_unique_id,
            'date' => $a->date,
            'time' => $a->time,
            'timezone' => $a->timezone,
            'status' => $a->status,
            'status_label' => $this->appointmentStatusLabel($status),
            'payment_type' => $this->appointmentPaidOrFreeType($a),
            'service_name' => $a->natureOfEnquiry?->title,
            'is_approved' => $status === 1,
            'is_pending' => in_array($status, self::PENDING_STATUSES, true),
            'title' => $a->title,
            'description' => $a->description,
            'order_hash' => $a->order_hash,
            'created_at' => $a->created_at?->toIso8601String(),
            'updated_at' => $a->updated_at?->toIso8601String(),
            'service' => $a->service ? $a->service->only(['id', 'title', 'duration', 'price']) : null,
            'nature_of_enquiry' => $a->natureOfEnquiry ? $a->natureOfEnquiry->only(['id', 'title']) : null,
            'assignee' => $a->assignee_user ? [
                'id' => $a->assignee_user->id,
                'name' => trim($a->assignee_user->first_name.' '.$a->assignee_user->last_name),
            ] : null,
        ];
    }

    /**
     * Paid vs free from bookable service: service_id 1 is the paid consultation product in this app.
     */
    private function appointmentPaidOrFreeType(Appointment $a): string
    {
        return (int) $a->service_id === 1 ? 'paid' : 'free';
    }

    private function appointmentStatusLabel(int $status): string
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
}
