<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\NatureOfEnquiry;
use App\Support\BookingTimeSlots;
use App\Support\ConsultationServices;
use App\Support\CrmAppointmentPresenter;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * CRM pull/push endpoints for Bansal Legal CRM (mirrors immigration /api/crm/appointments contract).
 * Existing admin/list consumers continue using {@see AppointmentController}.
 */
class CrmAppointmentApiController extends Controller
{
    /**
     * GET /api/appointments/recent?minutes=30
     */
    public function recent(Request $request): JsonResponse
    {
        $minutes = min(max((int) $request->input('minutes', 30), 1), 1440);
        $cutoff = now()->subMinutes($minutes);

        $appointments = Appointment::query()
            ->with(['service', 'natureOfEnquiry', 'assignee_user', 'payment'])
            ->where(function ($q) use ($cutoff) {
                $q->where('created_at', '>=', $cutoff)
                    ->orWhere('updated_at', '>=', $cutoff);
            })
            ->orderByDesc('updated_at')
            ->get();

        return response()->json([
            'success' => true,
            'count' => $appointments->count(),
            'data' => $appointments->map(fn (Appointment $a) => CrmAppointmentPresenter::toArray($a))->values()->all(),
        ]);
    }

    /**
     * CRM backfill/list: GET /api/appointments?start_date=&end_date=
     * Invoked from AppointmentController when date range filters are present.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Appointment::query()
            ->with(['service', 'natureOfEnquiry', 'assignee_user', 'payment']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            try {
                $start = Carbon::parse((string) $request->input('start_date'))->startOfDay();
                $end = Carbon::parse((string) $request->input('end_date'))->endOfDay();
                $query->whereBetween('date', [$start->toDateString(), $end->toDateString()]);
            } catch (\Throwable $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid start_date or end_date',
                ], 422);
            }
        }

        if ($request->filled('created_after')) {
            $query->where('created_at', '>=', $request->input('created_after'));
        }

        if ($request->filled('updated_after')) {
            $query->where('updated_at', '>=', $request->input('updated_after'));
        }

        if ($request->filled('status')) {
            $raw = (string) $request->input('status');
            if (ctype_digit($raw)) {
                $query->where('status', (int) $raw);
            } else {
                $map = [
                    'pending' => [0, 9, 11, 4, 5],
                    'paid' => [10],
                    'confirmed' => [1],
                    'completed' => [2],
                    'cancelled' => [3, 7],
                    'no_show' => [6, 8],
                ];
                $key = strtolower($raw);
                if (isset($map[$key])) {
                    $query->whereIn('status', $map[$key]);
                }
            }
        }

        $perPage = min(max((int) $request->input('per_page', 50), 1), 100);
        $paginator = $query->orderByDesc('created_at')->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => collect($paginator->items())
                ->map(fn (Appointment $a) => CrmAppointmentPresenter::toArray($a))
                ->values()
                ->all(),
            'pagination' => [
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
        ]);
    }

    /**
     * GET /api/appointments/{id} CRM shape (optional; used when format=crm).
     */
    public function show(int $id): JsonResponse
    {
        $appointment = Appointment::with(['service', 'natureOfEnquiry', 'assignee_user', 'payment'])->find($id);

        if (! $appointment) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => CrmAppointmentPresenter::toArray($appointment),
        ]);
    }

    /**
     * POST /api/appointments/{id}/status
     * Body: { type: cancel|complete|confirm, cancel_reason?: string }
     */
    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'type' => 'required|string|in:cancel,complete,confirm',
            'cancel_reason' => 'nullable|string|max:500',
        ]);

        if ($validated['type'] === 'cancel' && blank($request->input('cancel_reason'))) {
            // Match immigration contract when cancel_reason is expected; allow empty for CRM flexibility.
        }

        $appointment = Appointment::with(['service', 'natureOfEnquiry', 'assignee_user', 'payment'])->find($id);
        if (! $appointment) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found',
            ], 404);
        }

        $newStatus = CrmAppointmentPresenter::websiteStatusFromCrmType($validated['type']);
        if ($newStatus === null) {
            return response()->json([
                'success' => false,
                'message' => 'Unsupported status type',
            ], 422);
        }

        $appointment->status = $newStatus;
        $appointment->save();

        Log::info('CRM updated website appointment status', [
            'appointment_id' => $appointment->id,
            'type' => $validated['type'],
            'status' => $newStatus,
            'cancel_reason' => $validated['cancel_reason'] ?? null,
        ]);

        $appointment->refresh();

        $message = match ($validated['type']) {
            'cancel' => 'Appointment cancelled successfully.',
            'complete' => 'Appointment marked as completed.',
            'confirm' => 'Appointment confirmed successfully.',
            default => 'Appointment status updated.',
        };

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => CrmAppointmentPresenter::toArray($appointment),
        ]);
    }

    /**
     * POST /api/appointments/add-appointment
     * Create website appointment from Legal CRM (Ajay calendar only).
     * Does NOT call CrmLeadSync — CRM already owns the booking_appointments row.
     */
    public function addAppointment(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:40',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string|max:20',
            'duration_minutes' => 'nullable|integer|min:10|max:180',
            'meeting_type' => 'nullable|string|max:50',
            'preferred_language' => 'nullable|string|max:50',
            'enquiry_details' => 'nullable|string|max:5000',
            'specific_service' => 'nullable|string|max:100',
            'service_type' => 'nullable|string|max:150',
            'is_paid' => 'nullable|boolean',
            'slot_overwrite' => 'nullable|integer|in:0,1',
            'timezone' => 'nullable|string|max:64',
            'noe_id' => 'nullable|integer',
            'service_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $parsedTime = $this->parseCrmTime((string) $validated['appointment_time']);
        if ($parsedTime === null) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid appointment_time',
            ], 422);
        }

        try {
            $dateYmd = Carbon::parse((string) $validated['appointment_date'])->format('Y-m-d');
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid appointment_date',
            ], 422);
        }

        $slotOverwrite = (int) ($validated['slot_overwrite'] ?? 0);
        if ($slotOverwrite !== 1) {
            $conflict = Appointment::query()
                ->whereDate('date', $dateYmd)
                ->where('status', '!=', 7)
                ->where(function ($q) use ($parsedTime) {
                    $q->where('time', $parsedTime['storage'])
                        ->orWhere('time', substr($parsedTime['storage'], 0, 5))
                        ->orWhere('timeslot_full', 'like', $parsedTime['label'].'%');
                })
                ->exists();

            if ($conflict) {
                return response()->json([
                    'success' => false,
                    'message' => 'Selected time slot is not available.',
                ], 422);
            }
        }

        $isPaid = array_key_exists('is_paid', $validated)
            ? (bool) $validated['is_paid']
            : false;
        $specific = strtolower((string) ($validated['specific_service'] ?? ''));
        if (! $isPaid && in_array($specific, ['paid-consultation', 'overseas-enquiry'], true)) {
            $isPaid = true;
        }

        $serviceId = isset($validated['service_id']) ? (int) $validated['service_id'] : 0;
        if (! ConsultationServices::isValidWebsiteServiceId($serviceId)) {
            if ($specific === 'overseas-enquiry') {
                $serviceId = ConsultationServices::PAID_60;
            } elseif ($isPaid || $specific === 'paid-consultation') {
                $serviceId = ConsultationServices::PAID_30;
            } else {
                $serviceId = ConsultationServices::FREE_10;
            }
        }

        $noeId = isset($validated['noe_id']) ? (int) $validated['noe_id'] : 0;
        if ($noeId <= 0) {
            $noeId = (int) NatureOfEnquiry::query()->where('status', 1)->orderBy('id')->value('id');
        }
        if ($noeId <= 0) {
            $noeId = 1;
        }

        $duration = (int) ($validated['duration_minutes'] ?? 0);
        if ($duration <= 0) {
            $duration = (int) config('services.crm_lead.default_duration', 30);
        }
        $endTs = strtotime($parsedTime['storage'].' +'.$duration.' minutes');
        $endLabel = $endTs ? date('g:i A', $endTs) : $parsedTime['label'];

        $meetingLabel = ! empty($validated['meeting_type'])
            ? CrmAppointmentPresenter::meetingTypeLabelForStorage((string) $validated['meeting_type'])
            : CrmAppointmentPresenter::meetingTypeLabelForStorage(
                (string) config('services.crm_lead.meeting_type', 'in_person')
            );

        $description = trim((string) ($validated['enquiry_details'] ?? ''));
        if ($description === '' && ! empty($validated['service_type'])) {
            $description = trim((string) $validated['service_type']);
        }

        // CRM-originated: approved/paid-success so slot is held; never push back via CrmLeadSync.
        $status = $isPaid ? 10 : 1;

        try {
            DB::beginTransaction();

            $fullName = trim((string) $validated['full_name']);
            $email = trim((string) $validated['email']);
            $phone = trim((string) ($validated['phone'] ?? ''));
            [$clientId, $clientUniqueId] = $this->resolveWebsiteClient($fullName, $email, $phone);

            $appointment = new Appointment;
            $appointment->client_id = $clientId;
            $appointment->client_unique_id = $clientUniqueId;
            $appointment->full_name = $fullName;
            $appointment->email = $email;
            $appointment->phone = $phone;
            $appointment->date = $dateYmd;
            $appointment->time = $parsedTime['storage'];
            $appointment->timeslot_full = $parsedTime['label'].' - '.$endLabel;
            $appointment->service_id = $serviceId;
            $appointment->noe_id = $noeId;
            $appointment->description = $description !== '' ? $description : 'Booked from Legal CRM';
            $appointment->appointment_details = $meetingLabel;
            $appointment->status = $status;
            $appointment->timezone = (string) ($validated['timezone']
                ?? config('services.crm_lead.default_timezone', 'Australia/Sydney'));
            $appointment->order_hash = 'crm-'.Str::lower((string) Str::uuid());
            $appointment->invites = 0;
            $appointment->title = null;
            $appointment->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('CRM add-appointment failed', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to create appointment on booking website.',
            ], 500);
        }

        $appointment->load(['service', 'natureOfEnquiry', 'assignee_user', 'payment']);

        Log::info('CRM created website appointment (Ajay calendar)', [
            'appointment_id' => $appointment->id,
            'date' => $appointment->date,
            'time' => $appointment->time,
            'email' => $appointment->email,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment created successfully.',
            'data' => CrmAppointmentPresenter::toArray($appointment),
            'appointment_id' => $appointment->id,
        ], 201);
    }

    /**
     * POST /api/appointments/update-appointment
     * Reschedule (and optional meeting type / language) from Legal CRM.
     */
    public function updateAppointment(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'appointment_id' => 'required|integer|exists:appointments,id',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable|string|max:20',
            'meeting_type' => 'nullable|string|max:50',
            'preferred_language' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        $appointment = Appointment::with(['service', 'natureOfEnquiry', 'assignee_user', 'payment'])
            ->find((int) $validated['appointment_id']);

        if (! $appointment) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found',
            ], 404);
        }

        if (! empty($validated['appointment_date'])) {
            try {
                $appointment->date = Carbon::parse($validated['appointment_date'])->format('Y-m-d');
            } catch (\Throwable $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid appointment_date',
                ], 422);
            }
        }

        if (! empty($validated['appointment_time'])) {
            $parsed = $this->parseCrmTime((string) $validated['appointment_time']);
            if ($parsed === null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid appointment_time',
                ], 422);
            }
            $appointment->time = $parsed['storage'];
            $label = $parsed['label'];
            $duration = (int) ($appointment->service?->duration ?? 30);
            if ($duration <= 0) {
                $duration = 30;
            }
            $endTs = strtotime($parsed['storage'].' +'.$duration.' minutes');
            $endLabel = $endTs ? date('g:i A', $endTs) : $label;
            $appointment->timeslot_full = $label.' - '.$endLabel;
        }

        if (! empty($validated['meeting_type'])) {
            $appointment->appointment_details = CrmAppointmentPresenter::meetingTypeLabelForStorage(
                (string) $validated['meeting_type']
            );
        }

        $appointment->save();
        $appointment->refresh();

        Log::info('CRM rescheduled website appointment', [
            'appointment_id' => $appointment->id,
            'date' => $appointment->date,
            'time' => $appointment->time,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment updated successfully.',
            'data' => CrmAppointmentPresenter::toArray($appointment),
        ]);
    }

    /**
     * Match website admins by email, then phone (same table as public booking).
     * Create a website client when neither matches. Same unique-code pattern as AppointmentBookController.
     *
     * @return array{0: int, 1: string|null}
     */
    private function resolveWebsiteClient(string $fullName, string $email, string $phone): array
    {
        $user = null;
        if ($email !== '') {
            $user = Admin::query()->where('email', $email)->first();
        }
        if (! $user && $phone !== '') {
            $user = Admin::query()->where('phone', $phone)->first();
        }

        $prefix = strlen($fullName) >= 4
            ? trim(substr($fullName, 0, 4))
            : trim($fullName);
        if ($prefix === '') {
            $prefix = 'CLNT';
        }

        if ($user) {
            if (empty($user->client_id)) {
                $user->client_id = $this->makeWebsiteClientUniqueId($prefix);
                $user->save();
            }

            return [(int) $user->id, $user->client_id];
        }

        $client = new Admin;
        $client->client_id = $this->makeWebsiteClientUniqueId($prefix);
        $client->first_name = $fullName;
        $client->last_name = '';
        $client->email = $email;
        $client->phone = $phone !== '' ? $phone : null;
        $client->save();

        return [(int) $client->id, $client->client_id];
    }

    private function makeWebsiteClientUniqueId(string $prefix): string
    {
        do {
            $unique = strtoupper($prefix).date('his').(string) random_int(10, 99);
        } while (Admin::query()->where('client_id', $unique)->exists());

        return $unique;
    }

    /**
     * @return array{storage: string, label: string}|null
     */
    private function parseCrmTime(string $time): ?array
    {
        $time = trim($time);
        if ($time === '') {
            return null;
        }

        // Accept H:i, H:i:s, or g:i A
        $ts = strtotime($time);
        if ($ts === false && preg_match('/^\d{1,2}:\d{2}/', $time)) {
            try {
                $ts = Carbon::parse($time)->timestamp;
            } catch (\Throwable $e) {
                return null;
            }
        }

        if ($ts === false) {
            return null;
        }

        $label = BookingTimeSlots::normalizeLabel(date('g:i A', $ts));

        return [
            'storage' => date('H:i:s', $ts),
            'label' => $label !== '' ? $label : date('g:i A', $ts),
        ];
    }
}
