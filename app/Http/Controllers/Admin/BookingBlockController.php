<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

use App\Models\BookServiceSlotPerPerson;
use App\Models\BookServiceDisableSlot;

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
            $list->disabledSlots = BookServiceDisableSlot::select('id','book_service_slot_per_person_id','disabledates','slots','block_all')
                ->where('book_service_slot_per_person_id', $list->id)
                ->get();
        }

        return view('Admin.feature.bookingblocks.index', compact('lists', 'totalData'));
    }

    public function create(Request $request)
    {
        return view('Admin.feature.bookingblocks.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'person_id' => 'required|integer',
            'date' => 'required',
        ]);

        // Ensure there is a base slot config for Ajay if not already (optional)
        BookServiceSlotPerPerson::firstOrCreate([
            'id' => 1
        ], [
            'person_id' => 1,
            'service_type' => 1,
            'start_time' => $request->start_time ?? '00:00',
            'end_time' => $request->end_time ?? '23:59',
        ]);

        // Create disabled slots for each submitted row
        $dates = (array)$request->input('date');
        $saved = false;
        foreach($dates as $i => $dateVal){
            $parts = explode('/', $dateVal ?? '');
            if (count($parts) === 3) {
                $dateIso = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
            } else {
                $dateIso = $dateVal; // fallback if already ISO
            }

            $disable = new BookServiceDisableSlot();
            $disable->book_service_slot_per_person_id = 1; // Ajay only
            $disable->disabledates = $dateIso;
            $fullDay = (int)($request->input('full_day.'.$i) ?? 0);
            $disable->block_all = $fullDay;
            if (!$fullDay) {
                $start = trim($request->input('start_time.'.$i) ?? '');
                $end = trim($request->input('end_time.'.$i) ?? '');
                $disable->slots = ($start && $end) ? ($start . '-' . $end) : '';
            } else {
                $disable->slots = '';
            }
            $saved = $disable->save() || $saved;
        }

        if(!$saved){
            return redirect()->back()->with('error', Config::get('constants.server_error'));
        }
        return Redirect::route('admin.feature.bookingblocks.index')->with('success','Block date added successfully');
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


