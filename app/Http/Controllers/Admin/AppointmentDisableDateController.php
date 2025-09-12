<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\BookServiceDisableSlot;
use App\Models\BookServiceSlotPerPerson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AppointmentDisableDateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
	/**
     * All Vendors.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		//check authorization end
        $query = BookServiceSlotPerPerson::where('id','!=' ,'');
        // Group the results by person_id
        $query->groupBy('person_id');
        $totalData = $query->count();	//for all data
        $lists = $query->sortable(['id' => 'asc'])->paginate(config('constants.limit')); //dd($lists);
        
        // Load disabled slots for each person
        foreach($lists as $list) {
            $list->disabledSlots = BookServiceDisableSlot::select('id','book_service_slot_per_person_id','disabledates','slots','block_all')
                ->where('book_service_slot_per_person_id', $list->id)
                ->get();
        }
        
        return view('Admin.feature.appointmentdisabledate.index',compact(['lists', 'totalData']));
    }

	public function create(Request $request)
	{
		return view('Admin.feature.appointmentdisabledate.create');
	}

	public function store(Request $request)
	{
		//check authorization end
		if ($request->isMethod('post')) {
			$this->validate($request, [
				'person_id' => 'required|integer',
				'start_time' => 'required',
				'end_time' => 'required'
			]);
            $requestData = $request->all();
            $obj = new BookServiceSlotPerPerson;
			$obj->person_id = $requestData['person_id'];
			$obj->service_type = $requestData['service_type'] ?? 1;
			$obj->book_service_id = $requestData['book_service_id'] ?? null;
			$obj->start_time = $requestData['start_time'];
			$obj->end_time = $requestData['end_time'];
			$obj->weekend = is_array($requestData['weekend'] ?? null) ? implode(',', $requestData['weekend']) : ($requestData['weekend'] ?? null);
            $saved = $obj->save();
            if(!$saved) {
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			} else {
				return Redirect::to('/admin/appointment-dates-disable')->with('success', 'Slot Configuration Added Successfully');
			}
		}
        return view('Admin.feature.appointmentdisabledate.create');
	}

	public function edit(Request $request, $id = NULL)
	{
        //check authorization end
        if ($request->isMethod('post')) {
			$requestData 	=  $request->all(); //dd($requestData);
            $this->validate($request, [
                'disabledates' => 'required'
            ]);

            if($requestData['id'] == 1){ //Ajay
                $recordExist = BookServiceDisableSlot::select('id')->whereIn('book_service_slot_per_person_id', [1, 2])->exists();
                if ($recordExist) {
                    BookServiceDisableSlot::whereIn('book_service_slot_per_person_id', [1, 2])->delete();
                }
            } else { //except Ajay
                $recordExist = BookServiceDisableSlot::select('id')->where('book_service_slot_per_person_id', $requestData['id'])->exists();
                if ($recordExist) {
                    BookServiceDisableSlot::where('book_service_slot_per_person_id', $requestData['id'])->delete();
                }
            }

            if($requestData['id'] == 1)
            { //Ajay
                $disabledatesCnt = count($requestData['disabledates']);
                if($disabledatesCnt >0){
                    if($requestData['id'] == 1) {
                        for($i=0;$i<$disabledatesCnt;$i++){
                            $bookServiceDisableSlot = new BookServiceDisableSlot();
                            $bookServiceDisableSlot->book_service_slot_per_person_id = 1;

                            $date = explode('/', $requestData['disabledates'][$i][0]);
                            if(!empty($date)){
                                $datey = $date[2].'-'.$date[1].'-'.$date[0];
                            } else {
                                $datey = "";
                            }
                            $bookServiceDisableSlot->disabledates = $datey;
                            $bookServiceDisableSlot->slots = implode(",",$requestData['slots'][$i]);
                            $bookServiceDisableSlot->block_all =  $requestData['block_all'][$i][0];
                            $saved = $bookServiceDisableSlot->save();
                        }

                        for($i=0;$i<$disabledatesCnt;$i++){
                            $bookServiceDisableSlot = new BookServiceDisableSlot();
                            $bookServiceDisableSlot->book_service_slot_per_person_id = 2;

                            $date = explode('/', $requestData['disabledates'][$i][0]);
                            if(!empty($date)){
                                $datey = $date[2].'-'.$date[1].'-'.$date[0];
                            } else {
                                $datey = "";
                            }
                            $bookServiceDisableSlot->disabledates = $datey;
                            $bookServiceDisableSlot->slots = implode(",",$requestData['slots'][$i]);
                            $bookServiceDisableSlot->block_all =  $requestData['block_all'][$i][0];
                            $saved = $bookServiceDisableSlot->save();
                        }
                    }
                }
            }
            else
            { //except Ajay
                $disabledatesCnt = count($requestData['disabledates']);
                if($disabledatesCnt >0){
                    for($i=0;$i<$disabledatesCnt;$i++){
                        $bookServiceDisableSlot = new BookServiceDisableSlot();
                        $bookServiceDisableSlot->book_service_slot_per_person_id = $requestData['id'];

                        $date = explode('/', $requestData['disabledates'][$i][0]);
                        if(!empty($date)){
                            $datey = $date[2].'-'.$date[1].'-'.$date[0];
                        } else {
                            $datey = "";
                        }
                        $bookServiceDisableSlot->disabledates = $datey;
                        $bookServiceDisableSlot->slots = implode(",",$requestData['slots'][$i]);
                        $bookServiceDisableSlot->block_all =  $requestData['block_all'][$i][0];
                        $saved = $bookServiceDisableSlot->save();
                    }
                }
            }


            /*$obj			    = 	BookServiceSlotPerPerson::find(@$requestData['id']);
            $obj->disabledates	=	@$requestData['disabledates'];
			$saved				=	$obj->save();*/
            if(!$saved) {
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			} else {
				return Redirect::to('/admin/appointment-dates-disable')->with('success', 'Block Date Updated Successfully');
			}
		} else {
			if(isset($id) && !empty($id)) {
                $id = $this->decodeString($id); //dd($id);
				if(BookServiceSlotPerPerson::where('id', '=', $id)->exists()) {
					$fetchedData = BookServiceSlotPerPerson::find($id);//dd($fetchedData);

                    $disableSlotArr = BookServiceDisableSlot::select('id','book_service_slot_per_person_id','disabledates','slots','block_all')->where('book_service_slot_per_person_id',$id)->get();

                    $weekendd = array();
                    if($fetchedData->weekend != ''){
                        $weekend = explode(',',$fetchedData->weekend);
                        foreach($weekend as $e){
                            if($e == 'Sun'){
                                $weekendd[] = 0;
                            }else if($e == 'Mon'){
                                $weekendd[] = 1;
                            }else if($e == 'Tue'){
                                $weekendd[] = 2;
                            }else if($e == 'Wed'){
                                $weekendd[] = 3;
                            }else if($e == 'Thu'){
                                $weekendd[] = 4;
                            }else if($e == 'Fri'){
                                $weekendd[] = 5;
                            }else if($e == 'Sat'){
                                $weekendd[] = 6;
                            }
                        }
                    }
                    
                    $disabledatesF = array();
                    if($fetchedData->disabledates != ''){
                        if( strpos($fetchedData->disabledates, ',') !== false ) {
                            $disabledatesArr = explode(',',$fetchedData->disabledates);
                            $disabledatesF = $disabledatesArr;
                        } else {
                            $disabledatesF = array($fetchedData->disabledates);
                        }
                    }

                    return view('Admin.feature.appointmentdisabledate.edit', compact(['fetchedData','weekendd','disabledatesF','disableSlotArr']));
				} else {
					return Redirect::to('/admin/appointment-dates-disable')->with('error', 'Slot Not Exist');
				}
			} else {
				return Redirect::to('/admin/appointment-dates-disable')->with('error', Config::get('constants.unauthorized'));
			}
		}
    }
}
