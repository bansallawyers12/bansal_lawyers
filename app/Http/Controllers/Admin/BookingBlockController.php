<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

use App\Models\BookServiceSlotPerPerson;
use App\Models\BookServiceDisableSlot;
use App\Services\BookingBlockValidator;
use Illuminate\Validation\ValidationException;

class BookingBlockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $query = BookServiceSlotPerPerson::where('person_id', 1);
        $totalData = $query->count();
        $lists = $query->sortable(['id' => 'asc'])->paginate(config('constants.limit'));

        foreach ($lists as $list) {
            $list->disabledSlots = BookServiceDisableSlot::select('id', 'book_service_slot_per_person_id', 'disabledates', 'slots', 'block_all')
                ->where('book_service_slot_per_person_id', $list->id)
                ->orderBy('disabledates')
                ->orderBy('id')
                ->get();

            $list->groupedBlocks = $this->groupBlocksByDate($list->disabledSlots);
        }

        return view('Admin.feature.bookingblocks.index', compact('lists', 'totalData'));
    }

    /**
     * @param  \Illuminate\Support\Collection<int, BookServiceDisableSlot>  $slots
     * @return list<array<string, mixed>>
     */
    private function groupBlocksByDate($slots): array
    {
        $grouped = [];

        foreach ($slots as $slot) {
            if (! $slot->disabledates) {
                continue;
            }

            $date = $slot->disabledates instanceof \Carbon\Carbon
                ? $slot->disabledates->copy()->startOfDay()
                : \Carbon\Carbon::parse($slot->disabledates)->startOfDay();

            $dateKey = $date->format('Y-m-d');

            if (! isset($grouped[$dateKey])) {
                $grouped[$dateKey] = [
                    'date_iso' => $dateKey,
                    'date_display' => $date->format('d/m/Y'),
                    'date_friendly' => $date->format('d M Y'),
                    'day_name' => $date->format('D'),
                    'month_short' => $date->format('M'),
                    'day_number' => $date->format('d'),
                    'year' => $date->format('Y'),
                    'slot_count' => 0,
                    'has_full_day' => false,
                    'slots' => [],
                    'search_terms' => strtolower($date->format('d/m/Y').' '.$date->format('d M Y')),
                ];
            }

            $isFullDay = (int) $slot->block_all === 1;
            $timeLabel = 'Full day';
            $timeSort = '00:00';

            if (! $isFullDay && ! empty($slot->slots)) {
                $parts = explode('-', $slot->slots, 2);
                if (count($parts) === 2) {
                    $start = trim($parts[0]);
                    $end = trim($parts[1]);
                    $timeLabel = $start.' – '.$end;
                    $timeSort = $start;
                } else {
                    $timeLabel = $slot->slots;
                }
            }

            $grouped[$dateKey]['slots'][] = [
                'id' => $slot->id,
                'type' => $isFullDay ? 'full-day' : 'partial',
                'label' => $timeLabel,
                'sort' => $timeSort,
            ];

            $grouped[$dateKey]['slot_count']++;
            $grouped[$dateKey]['has_full_day'] = $grouped[$dateKey]['has_full_day'] || $isFullDay;
            $grouped[$dateKey]['search_terms'] .= ' '.strtolower($timeLabel);
        }

        ksort($grouped);

        foreach ($grouped as &$group) {
            usort($group['slots'], function ($a, $b) {
                if ($a['type'] === 'full-day' && $b['type'] !== 'full-day') {
                    return -1;
                }
                if ($b['type'] === 'full-day' && $a['type'] !== 'full-day') {
                    return 1;
                }

                return strcmp($a['sort'], $b['sort']);
            });
        }
        unset($group);

        return array_values($grouped);
    }

    public function create(Request $request)
    {
        $serviceConfig = BookServiceSlotPerPerson::where('person_id', 1)
            ->where('service_type', 1)
            ->first();

        return view('Admin.feature.bookingblocks.create', compact('serviceConfig'));
    }

    public function store(Request $request, BookingBlockValidator $validator)
    {
        try {
            $request->validate([
                'person_id' => 'required|integer',
                'date' => 'required|array|min:1',
            ]);
        } catch (ValidationException $e) {
            return $this->storeResponse($request, false, $e->errors());
        }

        $dates = (array) $request->input('date', []);
        $fullDays = (array) $request->input('full_day', []);
        $startTimes = (array) $request->input('start_time', []);
        $endTimes = (array) $request->input('end_time', []);

        $result = $validator->validate($dates, $fullDays, $startTimes, $endTimes, 1);

        if (! $result['valid']) {
            return $this->storeResponse($request, false, $result['errors']);
        }

        BookServiceSlotPerPerson::firstOrCreate([
            'id' => 1,
        ], [
            'person_id' => 1,
            'service_type' => 1,
            'start_time' => '09:00',
            'end_time' => '17:00',
        ]);

        $saved = false;
        foreach ($result['blocks'] as $block) {
            $disable = new BookServiceDisableSlot();
            $disable->book_service_slot_per_person_id = 1;
            $disable->disabledates = $block['date_iso'];
            $disable->block_all = $block['full_day'] ? 1 : 0;

            if ($block['full_day']) {
                $disable->slots = '';
            } else {
                $disable->slots = $block['start'].'-'.$block['end'];
            }

            $saved = $disable->save() || $saved;
        }

        if (! $saved) {
            return $this->storeResponse($request, false, [
                'blocks' => [Config::get('constants.server_error')],
            ]);
        }

        return $this->storeResponse($request, true, [], 'Block date added successfully');
    }

    /**
     * @param  array<string, list<string>>  $errors
     */
    private function storeResponse(Request $request, bool $success, array $errors = [], string $message = '')
    {
        if ($request->ajax() || $request->wantsJson()) {
            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'redirect' => route('admin.feature.bookingblocks.index'),
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => $message ?: 'Please fix the validation errors below.',
                'errors' => $errors,
            ], 422);
        }

        if ($success) {
            return Redirect::route('admin.feature.bookingblocks.index')->with('success', $message);
        }

        return redirect()->back()->withInput()->withErrors($errors);
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $requestData = $request->all();
            // Allow either old payload (disabledates/slots/block_all) or new (date/start_time/end_time/full_day)
            $hasNewPayload = isset($requestData['date']);

            // wipe existing disabled slots for this person (Ajay 1/2 handled together)
            if ((int)$requestData['id'] === 1) {
                $recordExist = BookServiceDisableSlot::select('id')->whereIn('book_service_slot_per_person_id', [1,2])->exists();
                if ($recordExist) {
                    BookServiceDisableSlot::whereIn('book_service_slot_per_person_id', [1,2])->delete();
                }
            } else {
                $recordExist = BookServiceDisableSlot::select('id')->where('book_service_slot_per_person_id', $requestData['id'])->exists();
                if ($recordExist) {
                    BookServiceDisableSlot::where('book_service_slot_per_person_id', $requestData['id'])->delete();
                }
            }

            if ($hasNewPayload) {
                $count = count($requestData['date']);
                for ($i = 0; $i < $count; $i++) {
                    $bookServiceDisableSlot = new BookServiceDisableSlot();
                    $bookServiceDisableSlot->book_service_slot_per_person_id = (int)$requestData['id'];

                    $date = explode('/', $requestData['date'][$i] ?? '');
                    if (count($date) !== 3) {
                        $date = explode('-', $requestData['date'][$i] ?? ''); // fallback for YYYY-MM-DD browsers
                        if (count($date) === 3 && strlen($date[0]) === 4) {
                            $datey = ($date[0].'-'.$date[1].'-'.$date[2]);
                        } else {
                            $datey = '';
                        }
                    } else {
                        $datey = ($date[2].'-'.$date[1].'-'.$date[0]);
                    }

                    $fullDay = isset($requestData['full_day'][$i]) && (int)$requestData['full_day'][$i] === 1 ? 1 : 0;
                    $slots = '';
                    if (!$fullDay) {
                        $start = trim($requestData['start_time'][$i] ?? '');
                        $end = trim($requestData['end_time'][$i] ?? '');
                        $slots = ($start && $end) ? ($start.'-'.$end) : '';
                    }

                    $bookServiceDisableSlot->disabledates = $datey;
                    $bookServiceDisableSlot->slots = $slots;
                    $bookServiceDisableSlot->block_all = $fullDay;
                    $saved = $bookServiceDisableSlot->save();
                }
            } else {
                // Backward compatibility with old payload
                $disabledatesCnt = count($requestData['disabledates']);
                if ($disabledatesCnt > 0) {
                    for($i=0;$i<$disabledatesCnt;$i++){
                        $bookServiceDisableSlot = new BookServiceDisableSlot();
                        $bookServiceDisableSlot->book_service_slot_per_person_id = ((int)$requestData['id'] === 1 && isset($requestData['target_id']))
                            ? (int)$requestData['target_id'] : (int)$requestData['id'];

                        $date = explode('/', $requestData['disabledates'][$i][0] ?? '');
                        $datey = (!empty($date) && count($date) === 3) ? ($date[2].'-'.$date[1].'-'.$date[0]) : '';

                        $bookServiceDisableSlot->disabledates = $datey;
                        $bookServiceDisableSlot->slots = implode(',', $requestData['slots'][$i] ?? []);
                        $bookServiceDisableSlot->block_all = $requestData['block_all'][$i][0] ?? 0;
                        $saved = $bookServiceDisableSlot->save();
                    }
                }
            }

            if(!$saved){
                return redirect()->back()->with('error', Config::get('constants.server_error'));
            }
            return Redirect::route('admin.feature.bookingblocks.index')->with('success','Block Date Updated Successfully');
        }

        if(isset($id) && !empty($id)){
            if(BookServiceSlotPerPerson::where('id', '=', $id)->exists()){
                $fetchedData = BookServiceSlotPerPerson::find($id);
                $disableSlotArr = BookServiceDisableSlot::select('id','book_service_slot_per_person_id','disabledates','slots','block_all')->where('book_service_slot_per_person_id',$id)->get();
                return view('Admin.feature.bookingblocks.edit', compact('fetchedData','disableSlotArr'));
            }
        }
        return redirect()->route('admin.feature.bookingblocks.index')->with('error','Invalid request');
    }
}


