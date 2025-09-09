<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;

use App\Lead;
use App\Admin;
use App\WebsiteSetting;
use App\SeoPage;
use App\City;
use App\Contact;
use App\TaxRate;
use PDF;
use App\InvoicePayment;
use App\Setting;
use Auth;
use Config;


class AdminController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
		/* Leads */
		/*$not_contacted = Lead::where('assign_to', '=', Auth::user()->id)->where('status', '=', 0)->count();
		$create_porposal = Lead::where('assign_to', '=', Auth::user()->id)->where('status', '=', 1)->count();
		$followup = Lead::where('assign_to', '=', Auth::user()->id)->where('status', '=', 15)->count();
		$undecided = Lead::where('assign_to', '=', Auth::user()->id)->where('status', '=', 11)->count();
		$lost = Lead::where('assign_to', '=', Auth::user()->id)->where('status', '=', 12)->count();
		$won = Lead::where('assign_to', '=', Auth::user()->id)->where('status', '=', 13)->count();
		$ready_to_pay = Lead::where('assign_to', '=', Auth::user()->id)->where('status', '=', 14)->count();*/

		/* Leads */
		/* Client data */
		$Contact = Contact::count();
		//$Lead = Lead::where('user_id', '=', Auth::user()->id)->count();
		//$Admindd = Admin::where('user_id', '=', Auth::user()->id)->count();



        //Total Enquiries
        //$countenquiries = \App\Enquiry::whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
        //$countenquiries = DB::table('enquiries')->whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
        #dd($countenquiries);

        //dd(Auth::user()->role);
        //Get User role and module access
        /*$roles = \App\UserRole::find(Auth::user()->role);
        $newarray = json_decode($roles->module_access);
        $module_access = (array) $newarray; //dd($module_access);*/

        //For Total Leads section
        //$countleads = \App\Admin::where('is_archived',0)->where('role', '=', '7')->where('type','lead')->whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
        //$countallleads = \App\Admin::where('is_archived',0)->where('role', '=', '7')->where('type','lead')->count();
        //$countleads = DB::table('admins')->where('is_archived', 0)->where('role',7)->where('type','lead')->whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
        //$countallleads = DB::table('admins')->where('is_archived', 0)->where('role',7)->where('type','lead')->count();


        //Today Followup
       /* if(Auth::user()->role == 1){
            $countfollowup = \App\Note::whereDate('followup_date', date('Y-m-d'))->count();
        }else{
            $countfollowup = \App\Note::whereDate('followup_date', date('Y-m-d'))->where('assigned_to', Auth::user()->id)->count();
        }*/

        //Total Clients
        //$countclient = \App\Admin::where('is_archived',0)->where('type','client')->where('role', '=', '7')->count();


		/* Client data */
        //return view('Admin.dashboard', compact(['not_contacted', 'create_porposal', 'followup', 'undecided', 'lost', 'won', 'ready_to_pay', 'Contact', 'Lead', 'Admindd']));
        //return view('Admin.dashboard', compact(['countenquiries','module_access','countleads','countallleads','countfollowup','countclient']));
        return view('Admin.dashboard', compact(['Contact']));

    }

    public function fetchnotification(Request $request){
         //$notificalists = \App\Notification::where('receiver_id', Auth::user()->id)->where('receiver_status', 0)->orderby('created_at','DESC')->paginate(5);
         $notificalistscount = \App\Notification::where('receiver_id', Auth::user()->id)->count(); //->where('receiver_status', 0)
         /*$output = '';
	    foreach($notificalists as $listnoti){
	        $output .= '<a href="'.$listnoti->url.'?t='.$listnoti->id.'" class="dropdown-item dropdown-item-unread">
						<span class="dropdown-item-icon bg-primary text-white">
							<i class="fas fa-code"></i>
						</span>
						<span class="dropdown-item-desc">'.$listnoti->message.' <span class="time">'.date('d/m/Y h:i A',strtotime($listnoti->created_at)).'</span></span>
					</a>';
	    }*/

	    $data = array(
          // 'notification' => $output,
           'unseen_notification'  => $notificalistscount
        );
        echo json_encode($data);
    }
    
    public function fetchmessages(Request $request){
        $notificalists = \App\Notification::where('receiver_id', Auth::user()->id)->where('seen', 0)->first();
        if($notificalists){
            $obj = \App\Notification::find($notificalists->id);
            $obj->seen = 1;
            $obj->save();
            return $notificalists->message;
        }else{
            return 0;
        }
    }
    
    public function fetchInPersonWaitingCount(Request $request){
        //if(\Auth::user()->role == 1){
            $InPersonwaitingCount = \App\CheckinLog::where('status',0)->count();
        /*}else{
            $InPersonwaitingCount = \App\CheckinLog::where('user_id',Auth::user()->id)->where('status',0)->count();
        }*/
        $data = array('InPersonwaitingCount'  => $InPersonwaitingCount);
        echo json_encode($data);
   }

    public function fetchTotalActivityCount(Request $request){
        if(\Auth::user()->role == 1){
            $assigneesCount = \App\Note::where('type','client')->whereNotNull('client_id')->where('folloup',1)->where('status',0)->count();
        }else{
            $assigneesCount = \App\Note::where('assigned_to',Auth::user()->id)->where('type','client')->where('folloup',1)->where('status',0)->count();
        }
        $data = array('assigneesCount'  => $assigneesCount);
        echo json_encode($data);
    }

   
	/**
     * My Profile.
     *
     * @return \Illuminate\Http\Response
     */
	public function returnsetting(Request $request){
		if ($request->isMethod('post'))
		{
			$requestData 		= 	$request->all();
			$obj							= 	Admin::find(Auth::user()->id);
			if(@$requestData['is_business_gst'] == 'yes'){
			$obj->is_business_gst				=	@$requestData['is_business_gst'];
			$obj->gstin					=	@$requestData['gstin'];
			$obj->gst_date						=	@$requestData['gst_date'];
			}else{
				$obj->is_business_gst				=	@$requestData['is_business_gst'];
			$obj->gstin					=	'';
			$obj->gst_date						=	'';
			}
			$saved							=	$obj->save();

			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/settings/taxes/returnsetting')->with('success', 'Your Profile has been edited successfully.');
			}
		}else{
			//return view('Admin.my_profile', compact(['fetchedData', 'countries']));
			return view('Admin.settings.returnsetting');
		}
	}
	public function taxrates(Request $request){
		if ($request->isMethod('post'))
		{

		}else{
			$query = TaxRate::where('user_id',Auth::user()->id);
			$totalData = $query->count();
			$lists = $query->get();
			return view('Admin.settings.taxrates', compact(['lists','totalData']));
		}
	}
	public function taxratescreate(Request $request){
		return view('Admin.settings.create');
	}

	public function edittaxrates(Request $request, $id = Null){
		if ($request->isMethod('post'))
		{
			$requestData 		= 	$request->all();

			$this->validate($request, [
										'name' => 'required|max:255'
									  ]);


			$obj				= 	TaxRate::find($requestData['id']);

			$obj->name			=	@$requestData['name'];
			$obj->rate			=	@$requestData['rate'];

			$saved				=	$obj->save();

			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/settings/taxes/taxrates/edit/'.base64_encode(convert_uuencode(@$requestData['id'])))->with('success', 'Tax updated Successfully');
			}
		}
		else
		{
			if(isset($id) && !empty($id))
			{
				$id = $this->decodeString($id);
				if(TaxRate::where('id', '=', $id)->where('user_id', '=', Auth::user()->id)->exists())
				{
					$fetchedData = TaxRate::find($id);

					return view('Admin.settings.edit', compact(['fetchedData']));
				}
				else
				{
					return Redirect::to('/admin/settings/taxes/taxrates')->with('error', 'Tax Not Exist');
				}
			}
			else
			{
				return Redirect::to('/admin/settings/taxes/taxrates')->with('error', Config::get('constants.unauthorized'));
			}
		}
	}

	public function savetaxrate(Request $request){
		if ($request->isMethod('post'))
		{
			$this->validate($request, [
										'name' => 'required|max:255'
									  ]);

			$requestData 		= 	$request->all();

			$obj				= 	new TaxRate;
			$obj->user_id	=	Auth::user()->id;
			$obj->name	=	@$requestData['name'];
			$obj->rate	=	@$requestData['rate'];

			$saved				=	$obj->save();

			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/settings/taxes/taxrates/edit/'.base64_encode(convert_uuencode(@$obj->id)))->with('success', 'Tax added Successfully');
			}
		}
	}
	public function myProfile(Request $request)
	{
		/* Get all Select Data */
			$countries = array();
		/* Get all Select Data */

		if ($request->isMethod('post'))
		{
			$requestData 		= 	$request->all();

			$this->validate($request, [
										'first_name' => 'required',
										'last_name' => 'nullable',
										'country' => 'required',
										'phone' => 'required',
										'state' => 'required',
										'city' => 'required',
										'address' => 'required',
										'zip' => 'required'
									  ]);

			/* Profile Image Upload Function Start */
				if($request->hasfile('profile_img'))
				{
					/* Unlink File Function Start */
						if($requestData['profile_img'] != '')
							{
								$this->unlinkFile($requestData['old_profile_img'], Config::get('constants.profile_imgs'));
							}
					/* Unlink File Function End */

					$profile_img = $this->uploadFile($request->file('profile_img'), Config::get('constants.profile_imgs'));
				}
				else
				{
					$profile_img = @$requestData['old_profile_img'];
				}
			/* Profile Image Upload Function End */


			$obj							= 	Admin::find(Auth::user()->id);

		$obj->first_name				=	@$requestData['first_name'];
			$obj->last_name					=	@$requestData['last_name'];
			$obj->phone						=	@$requestData['phone'];
			$obj->country					=	@$requestData['country'];
			$obj->state						=	@$requestData['state'];
			$obj->city						=	@$requestData['city'];
			$obj->address					=	@$requestData['address'];
			$obj->zip						=	@$requestData['zip'];
			$obj->company_fax						=	@$requestData['company_fax'];
			$obj->company_name						=	@$requestData['company_name'];
			$obj->company_website						=	@$requestData['company_website'];
			$obj->profile_img				=	@$profile_img;

			$saved							=	$obj->save();

			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/my_profile')->with('success', 'Your Profile has been edited successfully.');
			}
		}
		else
		{
			$id = Auth::user()->id;
			$fetchedData = Admin::find($id);

			return view('Admin.my_profile', compact(['fetchedData', 'countries']));
		}
	}
	/**
     * Change password and Logout automatiaclly.
     *
     * @return \Illuminate\Http\Response
     */
	public function change_password(Request $request)
	{
		//check authorization start
			/* $check = $this->checkAuthorizationAction('Admin', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			} */
		//check authorization end

		if ($request->isMethod('post'))
		{
			$this->validate($request, [
										'old_password' => 'required|min:6',
										'password' => 'required|confirmed|min:6',
										'password_confirmation' => 'required|min:6'
									  ]);


			$requestData 	= 	$request->all();
			$admin_id = Auth::user()->id;

			$fetchedData = Admin::where('id', '=', $admin_id)->first();
			if(!empty($fetchedData))
				{
					if($admin_id == trim($requestData['admin_id']))
						{
							 if (!(Hash::check($request->get('old_password'), Auth::user()->password)))
								{
									return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
								}
							else
								{
									$admin = Admin::find($requestData['admin_id']);
									$admin->password = Hash::make($requestData['password']);
									if($admin->save())
										{
											Auth::guard('admin')->logout();
											$request->session()->flush();

											return redirect('/admin')->with('success', 'Your Password has been changed successfully.');
										}
									else
										{
											return redirect()->back()->with('error', Config::get('constants.server_error'));
										}
								}
						}
					else
						{
							return redirect()->back()->with('error', 'You can change the password only your account.');
						}
				}
			else
				{
					return redirect()->back()->with('error', 'User is not exist, so you can not change the password.');
				}
		}
		return view('Admin.change_password');
	}

	public function CustomerDetail(Request $request){

		$contactexist = Contact::where('id', $request->customer_id)->where('user_id', Auth::user()->id)->exists();
		if($contactexist){
			$contact = Contact::where('id', $request->customer_id)->with(['currencydata'])->first();
			return json_encode(array('success' => true, 'contactdetail' => $contact));
		}else{
			return json_encode(array('success' => false, 'message' => 'ID not exist'));
		}
	}

	public function websiteSetting(Request $request)
	{
		//check authorization start
			$check = $this->checkAuthorizationAction('Admin', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			}
		//check authorization end

		if ($request->isMethod('post'))
		{
			$requestData 		= 	$request->all();

			$this->validate($request, [
										'phone' => 'required|max:20',
										'ofc_timing' => 'nullable|max:255',
										'email' => 'required|max:255'
									  ]);

			/* Logo Upload Function Start */
				if($request->hasfile('logo'))
				{
					/* Unlink File Function Start */
						if(@$requestData['logo'] != '')
							{
								$this->unlinkFile(@$requestData['old_logo'], Config::get('constants.logo'));
							}
					/* Unlink File Function End */

					$logo = $this->uploadFile($request->file('logo'), Config::get('constants.logo'));
				}
				else
				{
					$logo = @$requestData['old_logo'];
				}
			/* Logoe Upload Function End */

			if(!empty(@$requestData['id']))
			{
				$obj				= 	WebsiteSetting::find(@$requestData['id']);
			}
			else
			{
				$obj				= 	new WebsiteSetting;
			}
			$obj->phone				=	@$requestData['phone'];
			$obj->ofc_timing		=	@$requestData['ofc_timing'];
			$obj->email				=	@$requestData['email'];
			$obj->logo				=	@$logo;

			$saved							=	$obj->save();

			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/website_setting')->with('success', 'Website Setting has been edited successfully.');
			}
		}
		else
		{
			$fetchedData = WebsiteSetting::where('id', '!=', '')->first();

			return view('Admin.website_setting', compact(['fetchedData']));
		}
	}


	public function editapi(Request $request)
	{
		//check authorization start
			$check = $this->checkAuthorizationAction('api_key', $request->route()->getActionMethod(), Auth::user()->role);
			if($check)
			{
				return Redirect::to('/admin/dashboard')->with('error',config('constants.unauthorized'));
			}
		//check authorization end
		if ($request->isMethod('post'))
		{
			$obj	= 	Admin::find(Auth::user()->id);
			$obj->client_id	=	md5(Auth::user()->id.time());
			$saved				=	$obj->save();
			if(!$saved)
			{
				return redirect()->back()->with('error', Config::get('constants.server_error'));
			}
			else
			{
				return Redirect::to('/admin/api-key')->with('success', 'Api Key'.Config::get('constants.edited'));
			}
		}else{
			return view('Admin.apikey');
		}
	}

	public function updateAction(Request $request)
	{
		$status 			= 	0;
		$method 			= 	$request->method();
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);
			$requestData['current_status'] = trim($requestData['current_status']);
			$requestData['table'] = trim($requestData['table']);
			$requestData['col'] = trim($requestData['colname']);

			$role = Auth::user()->role;
			if($role == 1 || $role == 7)
			{
				if(isset($requestData['id']) && !empty($requestData['id']) && isset($requestData['current_status']) && isset($requestData['table']) && !empty($requestData['table']))
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));

					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();

						if($recordExist)
						{
							if($requestData['current_status'] == 0)
							{
								$updated_status = 1;
								$message = 'Record has been enabled successfully.';
							}
							else
							{
								$updated_status = 0;
								$message = 'Record has been disabled successfully.';
							}
							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update([$requestData['col'] => $updated_status]);
							if($response)
							{
								$status = 1;
							}
							else
							{
								$message = Config::get('constants.server_error');
							}
						}
						else
						{
							$message = 'ID does not exist, please check it once again.';
						}
					}
					else
					{
						$message = 'Table does not exist, please check it once again.';
					}
				}
				else
				{
					$message = 'Id OR Current Status OR Table does not exist, please check it once again.';
				}
			}
			else
			{
				$message = 'You are not authorized person to perform this action.';
			}
		}
		else
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message));
		 die;

	}


	public function moveAction(Request $request)
	{
		$status 			= 	0;
		$method 			= 	$request->method();
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);

			$requestData['table'] = trim($requestData['table']);
			$requestData['col'] = trim($requestData['col']);

				if(isset($requestData['id']) && !empty($requestData['id']) && isset($requestData['table']) && !empty($requestData['table']))
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));

					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();

						if($recordExist)
						{


							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update([$requestData['col'] => 0]);
							if($response)
							{
								$status = 1;
								$message = 'Record successfully moved';
							}
							else
							{
								$message = Config::get('constants.server_error');
							}
						}
						else
						{
							$message = 'ID does not exist, please check it once again.';
						}
					}
					else
					{
						$message = 'Table does not exist, please check it once again.';
					}
				}
				else
				{
					$message = 'Id OR Current Status OR Table does not exist, please check it once again.';
				}

		}
		else
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message));
		die;
	}

	public function declinedAction(Request $request)
	{
		$status 			= 	0;
		$method 			= 	$request->method();
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);

			$requestData['table'] = trim($requestData['table']);


			$role = Auth::user()->role;
			if($role == 1 || $role == 7)
			{
				if(isset($requestData['id']) && !empty($requestData['id'])  && isset($requestData['table']) && !empty($requestData['table']))
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));

					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();

						if($recordExist)
						{

								$updated_status = 2;
								$message = 'Record has been disabled successfully.';

							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update(['status' => $updated_status]);
							if($response)
							{
								$status = 1;
							}
							else
							{
								$message = Config::get('constants.server_error');
							}
						}
						else
						{
							$message = 'ID does not exist, please check it once again.';
						}
					}
					else
					{
						$message = 'Table does not exist, please check it once again.';
					}
				}
				else
				{
					$message = 'Id OR Current Status OR Table does not exist, please check it once again.';
				}
			}
			else
			{
				$message = 'You are not authorized person to perform this action.';
			}
		}
		else
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message));
		die;
	}

	public function approveAction(Request $request)
	{
		$status 			= 	0;
		$method 			= 	$request->method();
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);

			$requestData['table'] = trim($requestData['table']);


			$role = Auth::user()->role;
			if($role == 1 || $role == 7)
			{
				if(isset($requestData['id']) && !empty($requestData['id'])  && isset($requestData['table']) && !empty($requestData['table']))
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));

					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();

						if($recordExist)
						{

								$updated_status = 1;
								$message = 'Record has been approved successfully.';

							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update(['status' => $updated_status]);
							if($response)
							{
								$status = 1;
							}
							else
							{
								$message = Config::get('constants.server_error').'sss';
							}
						}
						else
						{
							$message = 'ID does not exist, please check it once again.';
						}
					}
					else
					{
						$message = 'Table does not exist, please check it once again.';
					}
				}
				else
				{
					$message = 'Id OR Current Status OR Table does not exist, please check it once again.';
				}
			}
			else
			{
				$message = 'You are not authorized person to perform this action.';
			}
		}
		else
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message));
		die;
	}

	public function processAction(Request $request)
	{
		$status 			= 	0;
		$method 			= 	$request->method();
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);

			$requestData['table'] = trim($requestData['table']);


			$role = Auth::user()->role;
			if($role == 1 || $role == 7)
			{
				if(isset($requestData['id']) && !empty($requestData['id'])  && isset($requestData['table']) && !empty($requestData['table']))
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));

					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();

						if($recordExist)
						{

								$updated_status = 4;
								$message = 'Record has been processed successfully.';

							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update(['status' => $updated_status]);
							if($response)
							{
								$status = 1;
							}
							else
							{
								$message = Config::get('constants.server_error').'sss';
							}
						}
						else
						{
							$message = 'ID does not exist, please check it once again.';
						}
					}
					else
					{
						$message = 'Table does not exist, please check it once again.';
					}
				}
				else
				{
					$message = 'Id OR Current Status OR Table does not exist, please check it once again.';
				}
			}
			else
			{
				$message = 'You are not authorized person to perform this action.';
			}
		}
		else
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message));
		die;
	}

	public function archiveAction(Request $request)
	{
		$status 			= 	0;
		$method 			= 	$request->method();
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);

			$requestData['table'] = trim($requestData['table']);

			$astatus = '';
			$role = Auth::user()->role;
			if($role == 1 || $role == 7)
			{
				if(isset($requestData['id']) && !empty($requestData['id'])  && isset($requestData['table']) && !empty($requestData['table']))
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));

					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();

						if($recordExist)
						{

								$updated_status = 1;
								$message = 'Record has been archived successfully.';

							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update(['is_archive' => $updated_status]);
							$getarchive 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->first();
							if($getarchive->status == 0){
								$astatus = '<span title="draft" class="ui label uppercase">Draft</span><span> (Archived)</span>';
							}else if($getarchive->status == 1){
								$astatus = '<span title="draft" class="ui label uppercase yellow">Sent</span><span> (Archived)</span>';
							}else if($getarchive->status == 2){
								$astatus = '<span title="draft" class="ui label uppercase text-danger">Declined</span><span> (Archived)</span>';
							}
							if($response)
							{
								$status = 1;
							}
							else
							{
								$message = Config::get('constants.server_error');
							}
						}
						else
						{
							$message = 'ID does not exist, please check it once again.';
						}
					}
					else
					{
						$message = 'Table does not exist, please check it once again.';
					}
				}
				else
				{
					$message = 'Id OR Current Status OR Table does not exist, please check it once again.';
				}
			}
			else
			{
				$message = 'You are not authorized person to perform this action.';
			}
		}
		else
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message, 'astatus'=>$astatus));
		die;
	}

	public function deleteAction(Request $request)
	{
		$status 			= 	0;
		$method 			= 	$request->method();
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);
			$requestData['table'] = trim($requestData['table']);

			$role = Auth::user()->role;

				if(isset($requestData['id']) && !empty($requestData['id']) && isset($requestData['table']) && !empty($requestData['table']))
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));

					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();

						if($recordExist)
						{
							if($requestData['table'] == 'admins'){
								/* if($requestData['current_status'] == 0)
								{
									$updated_status = 1;
									$message = 'Record has been enabled successfully.';
								}
								else
								{
									$updated_status = 0;
									$message = 'Record has been disabled successfully.';
								}	 */
							$o = \App\Admin::where('id', $requestData['id'])->first();
							if($o->is_archived == 1){
								$is_archived = 0;
							}else{
								$is_archived = 1;
							}
							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update(['is_archived' => $is_archived, 'archived_on' => date('Y-m-d')]);
							if($response)
							{
								$status = 1;
								$message = 'Record has been enabled successfully.';
							}
							else
							{
								$message = Config::get('constants.server_error');
							}
							}else if($requestData['table'] == 'quotations'){
								/* if($requestData['current_status'] == 0)
								{
									$updated_status = 1;
									$message = 'Record has been enabled successfully.';
								}
								else
								{
									$updated_status = 0;
									$message = 'Record has been disabled successfully.';
								}	 */

							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update(['is_archive' => 1]);
							if($response)
							{
								$status = 1;
								$message = 'Record has been enabled successfully.';
							}
							else
							{
								$message = Config::get('constants.server_error');
							}
							}
							else
							if($requestData['table'] == 'currencies'){
								$isexist	=	$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();
								if($isexist){
									$response	=	DB::table($requestData['table'])->where('id', @$requestData['id'])->delete();

									if($response)
									{
										$status = 1;
										$message = 'Record has been deleted successfully.';
									}
									else
									{
										$message = Config::get('constants.server_error');
									}
								}else{
									$message = 'ID does not exist, please check it once again.';
								}
							}else
							if($requestData['table'] == 'templates'){
								$isexist	=	$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();
								if($isexist){
									$response	=	DB::table($requestData['table'])->where('id', @$requestData['id'])->delete();
									DB::table('template_infos')->where('quotation_id', @$requestData['id'])->delete();

									if($response)
									{
										$status = 1;
										$message = 'Record has been deleted successfully.';
									}
									else
									{
										$message = Config::get('constants.server_error');
									}
								}else{
									$message = 'ID does not exist, please check it once again.';
								}
							}else
							if($requestData['table'] == 'invoice_schedules'){
								$response	=	DB::table($requestData['table'])->where('id', @$requestData['id'])->delete();
								DB::table('schedule_items')->where('schedule_id', @$requestData['id'])->delete();

								if($response)
									{
										$status = 1;
										$message = 'Record has been deleted successfully.';
									}
									else
									{
										$message = Config::get('constants.server_error');
									}
							}else
							if($requestData['table'] == 'agents'){
								$response	=	DB::table($requestData['table'])->where('id', @$requestData['id'])->update(['is_acrchived' => 1]);

								if($response)
									{
										$status = 1;
										$message = 'Record has been Archived successfully.';
									}
									else
									{
										$message = Config::get('constants.server_error');
									}
							}else if($requestData['table'] == 'products'){
								$applicationisexist	= DB::table('applications')->where('product_id', $requestData['id'])->exists();

								if($applicationisexist){
									$message = "Can't Delete its have relation with other records";
								}else{
									$isexist	=	$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();
									if($isexist){
									$response	=	DB::table($requestData['table'])->where('id', @$requestData['id'])->delete();
									DB::table('template_infos')->where('quotation_id', @$requestData['id'])->delete();

									if($response)
									{
										$status = 1;
										$message = 'Record has been deleted successfully.';
									}
									else
									{
										$message = Config::get('constants.server_error');
									}
									}else{
										$message = 'ID does not exist, please check it once again.';
									}
								}


							}else if($requestData['table'] == 'partners'){
								$applicationisexist	= DB::table('applications')->where('partner_id', $requestData['id'])->exists();
								$productsexist	= DB::table('products')->where('partner', $requestData['id'])->exists();

								if($applicationisexist){
									$message = "Can't Delete its have relation with other records";
								}else if($productsexist){
									$message = "Can't Delete its have relation with other records";
								}else{
									$isexist	=	$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();
									if($isexist){
									$response	=	DB::table($requestData['table'])->where('id', @$requestData['id'])->delete();
									DB::table('template_infos')->where('quotation_id', @$requestData['id'])->delete();

									if($response)
									{
										$status = 1;
										$message = 'Record has been deleted successfully.';
									}
									else
									{
										$message = Config::get('constants.server_error');
									}
									}else{
										$message = 'ID does not exist, please check it once again.';
									}
								}


							}else{
								$response	=	DB::table($requestData['table'])->where('id', @$requestData['id'])->delete();

								if($response)
								{
									$status = 1;
									$message = 'Record has been deleted successfully.';
								}
								else
								{
									$message = Config::get('constants.server_error');
								}
							}
						}
						else
						{
							$message = 'ID does not exist, please check it once again.';
						}
					}
					else
					{
						$message = 'Table does not exist, please check it once again.';
					}
				}
				else
				{
					$message = 'Id OR Table does not exist, please check it once again.';
				}

		}
		else
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message));
		die;
	}
  
  
    public function deleteSlotAction(Request $request)
	{
        $status = 	0;
		$method = 	$request->method();
		if ($request->isMethod('post')) {
			$requestData 	= 	$request->all();
            $requestData['id'] = trim($requestData['id']);
			$requestData['table'] = trim($requestData['table']);
            //echo  $requestData['id'].'==='.$requestData['table'];dd('###');
            $role = Auth::user()->role;
            if(isset($requestData['id']) && !empty($requestData['id']) && isset($requestData['table']) && !empty($requestData['table']))
			{
				$tableExist = Schema::hasTable(trim($requestData['table']));
                if($tableExist) {
                    if($requestData['table'] == 'book_service_disable_slots'){
                        $disableslotsexist	= DB::table('book_service_disable_slots')->where('book_service_slot_per_person_id', $requestData['id'])->exists();
                        if($disableslotsexist){
                            if($requestData['id'] == 1 || $requestData['id'] == 2){ //Ajay Slot
                                $idsToDelete = [1,2];
                                $response = DB::table('book_service_disable_slots')->whereIn('book_service_slot_per_person_id', $idsToDelete)->delete();
                            } else { //other user slot
                                $response = DB::table('book_service_disable_slots')->where('book_service_slot_per_person_id', @$requestData['id'])->delete();
                            }
                            if($response) {
                                $status = 1;
                                $message = 'Record has been deleted successfully.';
                            } else {
                                $message = Config::get('constants.server_error');
                            }
                        } else {
                            $message = 'Slot does not exist, please check it once again.';
                        }
                    }
                } else {
                    $message = 'Table does not exist, please check it once again.';
                }
            } else {
                $message = 'Id OR Table does not exist, please check it once again.';
            }
        } else {
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message));
		die;
	}

	public function getStates(Request $request)
	{
		$status 			= 	0;
		$data				=	array();
		$method 			= 	$request->method();

		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);

			if(isset($requestData['id']) && !empty($requestData['id']))
			{
				$recordExist = Country::where('id', $requestData['id'])->exists();

				if($recordExist)
				{
					$data 	= 	State::where('country_id', '=', $requestData['id'])->get();

					if($data)
					{
						$status = 1;
						$message = 'Record has been fetched successfully.';
					}
					else
					{
						$message = Config::get('constants.server_error');
					}
				}
				else
				{
					$message = 'ID does not exist, please check it once again.';
				}
			}
			else
			{
				$message = 'ID does not exist, please check it once again.';
			}
		}
		else
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message, 'data'=>$data));
		die;
	}

	public function getChapters(Request $request)
	{
		$status 			= 	0;
		$data				=	array();
		$method 			= 	$request->method();

		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);

			if(isset($requestData['id']) && !empty($requestData['id']))
			{
				$recordExist = McqSubject::where('id', $requestData['id'])->exists();

				if($recordExist)
				{
					$data 	= 	McqChapter::where('subject_id', '=', $requestData['id'])->get();

					if($data)
					{
						$status = 1;
						$message = 'Record has been fetched successfully.';
					}
					else
					{
						$message = Config::get('constants.server_error');
					}
				}
				else
				{
					$message = 'ID does not exist, please check it once again.';
				}
			}
			else
			{
				$message = 'ID does not exist, please check it once again.';
			}
		}
		else
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message, 'data'=>$data));
		die;
	}

	public function addCkeditiorImage(Request $request)
	{
		echo "<pre>";
		print_r($_FILES);die;



		$status 			= 	0;
		$method 			= 	$request->method();

		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			echo "<pre>";
			print_r($requestData);die;


			if(isset($requestData['id']) && !empty($requestData['id']))
			{
				$recordExist = Country::where('id', $requestData['id'])->exists();

				if($recordExist)
				{
					$data 	= 	State::where('country_id', '=', $requestData['id'])->get();

					if($data)
					{
						$status = 1;
						$message = 'Record has been fetched successfully.';
					}
					else
					{
						$message = Config::get('constants.server_error');
					}
				}
				else
				{
					$message = 'ID does not exist, please check it once again.';
				}
			}
			else
			{
				$message = 'ID does not exist, please check it once again.';
			}
		}
		else
		{
			$message = Config::get('constants.post_method');
		}
		echo json_encode(array('status'=>$status, 'message'=>$message, 'data'=>$data));
		die;
	}

	public function sessions(Request $request)
	{
		return view('Admin.sessions');
	}

	public function getpartner(Request $request){
		$catid = $request->cat_id;
		$lists = \App\Partner::where('service_workflow', $catid)->orderby('partner_name','ASC')->get();
		ob_start();
		?>
		<option value="">Select a Partner</option>
		<?php
		foreach($lists as $list){
			?>
			<option value="<?php echo $list->id; ?>"><?php echo $list->partner_name; ?></option>
			<?php
		}
		echo ob_get_clean();
	}

	public function getpartnerbranch(Request $request){
		$catid = $request->cat_id;
		$lists = \App\Partner::where('service_workflow', $catid)->orderby('partner_name','ASC')->get();
		ob_start();
		?>
		<option value="">Select Partner & Branch</option>
		<?php
		foreach($lists as $list){
			$listsbranchs = \App\PartnerBranch::where('partner_id', $list->id)->get();
			foreach($listsbranchs as $listsbranch){
			?>
			<option value="<?php echo $listsbranch->id; ?>_<?php echo $list->id; ?>"><?php echo $list->partner_name.' ('.$listsbranch->name.')'; ?></option>
			<?php
			}
		}
		echo ob_get_clean();
	}

	public function getbranchproduct(Request $request){
		$catid = $request->cat_id;
		$lists = \App\Product::whereRaw('FIND_IN_SET("'.$catid.'", branches)')->orderby('name','ASC')->get();
		ob_start();
		?>
		<option value="">Select Product</option>
		<?php
		foreach($lists as $list){

			?>
			<option value="<?php echo $list->id; ?>"><?php echo $list->name; ?></option>
			<?php

		}
		echo ob_get_clean();
	}

	public function getproduct(Request $request){
		$catid = $request->cat_id;
		$lists = \App\Product::where('partner', $catid)->orderby('name','ASC')->get();
		ob_start();
		?>
		<option value="">Select a Product</option>
		<?php
		foreach($lists as $list){
			?>
			<option value="<?php echo $list->id; ?>"><?php echo $list->name; ?></option>
			<?php
		}
		echo ob_get_clean();
	}

	public function gettemplates(Request $request){
		$id = $request->id;
		$CrmEmailTemplate = \App\CrmEmailTemplate::where('id',$id)->first();
		if($CrmEmailTemplate){
			echo json_encode(array('subject'=>$CrmEmailTemplate->subject, 'description'=>$CrmEmailTemplate->description));
		}else{
			echo json_encode(array('subject'=>'','description'=>''));
		}
	}

	public function sendmail(Request $request){
		$requestData = $request->all();
		//echo '<pre>'; print_r($requestData); die;
		$user_id = @Auth::user()->id;
		$reciept_id = '';
		$array = array();

        if(isset($requestData['receipt'])){
            $fetchedData = InvoicePayment::where('id', '=', $requestData['receipt'])->first();
            $reciept_id = $fetchedData->id;
            $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
            ])->loadView('emails.reciept', compact('fetchedData'));
            $output = $pdf->output();
            $invoicefilename = 'receipt_'.$reciept_id.'.pdf';
            file_put_contents('/home/bansaledu/public/invoices/'.$invoicefilename, $output);
            $array['file'] = '/home/bansaledu/public/invoices/'.$invoicefilename;
            $array['file_name'] = $invoicefilename;
        }

        if(isset($requestData['invreceipt'])){
            $invoicedetail = \App\Invoice::where('id', '=', $requestData['invreceipt'])->first();
            if($invoicedetail->type == 3){
                $workflowdaa = \App\Workflow::where('id', $invoicedetail->application_id)->first();
                $applicationdata = array();
                $partnerdata = array();
                $productdata = array();
                $branchdata = array();
            }else{
                $applicationdata = \App\Application::where('id', $invoicedetail->application_id)->first();
                $partnerdata = \App\Partner::where('id', @$applicationdata->partner_id)->first();
                $productdata = \App\Product::where('id', @$applicationdata->product_id)->first();
                $branchdata = \App\PartnerBranch::where('id', @$applicationdata->branch)->first();
                $workflowdaa = \App\Workflow::where('id', @$applicationdata->workflow)->first();
            }

			$clientdata = \App\Admin::where('role', 7)->where('id', $invoicedetail->client_id)->first();
			$admindata = \App\Admin::where('role', 1)->where('id', $invoicedetail->user_id)->first();

            $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
            ])->loadView('emails.invoice',compact(['applicationdata','partnerdata','workflowdaa','clientdata','productdata','branchdata','invoicedetail','admindata']));
            $reciept_id = $invoicedetail->id;

            $output = $pdf->output();
            $invoicefilename = 'invoice_'.$reciept_id.'.pdf';
            file_put_contents(public_path('invoices/'.$invoicefilename), $output);


            $array['file'] = public_path() . '/' .'invoices/'.$invoicefilename;
            $array['file_name'] = $invoicefilename;
        }

		$obj = new \App\MailReport;
		$obj->user_id 		=  $user_id;
		$obj->from_mail 	=  $requestData['email_from'];
		$obj->to_mail 		=  implode(',',$requestData['email_to']);
		if(isset($requestData['email_cc'])){
		$obj->cc 			=  implode(',',@$requestData['email_cc']);
		}
		$obj->template_id 	=  $requestData['template'];
		$obj->reciept_id 	=  $reciept_id;
		$obj->subject		=  $requestData['subject'];
		if(isset($requestData['type'])){
		$obj->type 			=  @$requestData['type'];
		}
		$obj->message		 =  $requestData['message'];
		$attachments = array();
		if(isset($requestData['checklistfile'])){
            if(!empty($requestData['checklistfile'])){
                $checklistfiles = $requestData['checklistfile'];
                $attachments = array();
                foreach($checklistfiles as $checklistfile){
                    $filechecklist =  \App\UploadChecklist::where('id', $checklistfile)->first();
                    if($filechecklist){
                        $attachments[] = array('file_name' => $filechecklist->name,'file_url' => $filechecklist->file);
                    }
                }
                $obj->attachments = json_encode($attachments);
            }
        }


		$saved	=	$obj->save();


		if(isset($requestData['checklistfile'])){
            if(!empty($requestData['checklistfile'])){
                $objs = new \App\ActivitiesLog;
                $objs->client_id = $obj->to_mail;
                $objs->created_by = Auth::user()->id;
                $objs->subject = "Checklist sent to client";
                $objs->save();
            }
        }

		$subject = $requestData['subject'];
		$message = $requestData['message'];
		foreach($requestData['email_to'] as $l){
			if(@$requestData['type'] == 'partner'){
				$client = \App\Partner::Where('id', $l)->first();
			$subject = str_replace('{Client First Name}',$client->partner_name, $subject);
			$message = str_replace('{Client First Name}',$client->partner_name, $message);
			}else if(@$requestData['type'] == 'agent'){
				$client = \App\Agent::Where('id', $l)->first();
			$subject = str_replace('{Client First Name}',$client->full_name, $subject);
			$message = str_replace('{Client First Name}',$client->full_name, $message);
			}else{
				$client = \App\Admin::Where('id', $l)->first();
			$subject = str_replace('{Client First Name}',$client->first_name, $subject);
			$message = str_replace('{Client First Name}',$client->first_name, $message);
			}

			$message = str_replace('{Client Assignee Name}',$client->first_name, $message);
			$message = str_replace('{Company Name}',Auth::user()->company_name, $message);
			$ccarray = array();
			if(isset($requestData['email_cc']) && !empty($requestData['email_cc'])){
				foreach($requestData['email_cc'] as $cc){
					$clientcc = \App\Admin::Where('id', $cc)->first();
					$ccarray[] = $clientcc;
				}
			}

			if(isset($requestData['checklistfile'])){
    		    if(!empty($requestData['checklistfile'])){
    		       $checklistfiles = $requestData['checklistfile'];
    		        foreach($checklistfiles as $checklistfile){
    		           $filechecklist =  \App\UploadChecklist::where('id', $checklistfile)->first();
    		           if($filechecklist){
    		            $array['files'][] =  public_path() . '/' .'checklists/'.$filechecklist->file;
    		           }
    		        }
    		    }
		    }

		    if($request->hasfile('attach'))
            {
                 $array['filesatta'][] =  $request->attach;
            }
            $this->send_compose_template($client->email, $subject, $requestData['email_from'], $message, '', $array,@$ccarray);
		}
        if(!empty($array['file'])){
            unset($array['file']);
        }
        if(!$saved) {
            return redirect()->back()->with('error', Config::get('constants.server_error'));
        } else {
            return redirect()->back()->with('success', 'Email Sent Successfully');
        }
	}


	public function getbranch(Request $request){
		$catid = $request->cat_id;
		$pro = \App\Product::where('id', $catid)->first();
		if($pro){
		$user_array = explode(',',$pro->branches);
		$lists = \App\PartnerBranch::WhereIn('id',$user_array)->Where('partner_id',$pro->partner)->orderby('name','ASC')->get();
		ob_start();
		?>
		<option value="">Select a Branch</option>
		<?php
		foreach($lists as $list){
			?>
			<option value="<?php echo $list->id; ?>"><?php echo $list->name; ?></option>
			<?php
		}
		}else{
			?>
			<option value="">Select a Branch</option>
			<?php
		}
		echo ob_get_clean();
	}

	public function getnewPartnerbranch(Request $request){
		$catid = $request->cat_id;
		$lists = \App\PartnerBranch::Where('partner_id',$catid)->orderby('name','ASC')->get();



		ob_start();
		?>
		<option value="">Select a Branch</option>
		<?php
		foreach($lists as $list){
			?>
			<option value="<?php echo $list->id; ?>"><?php echo $list->name.'('.$list->city.')'; ?></option>
			<?php
		}

		echo ob_get_clean();
	}


	public function getsubjects(Request $request){
		$catid = $request->cat_id;
		$lists = \App\Subject::where('subject_area', $catid)->orderby('name','ASC')->get();
		ob_start();
		?>
		<option value="">Please select a subject</option>
		<?php
		foreach($lists as $list){

			?>
			<option value="<?php echo $list->id; ?>"><?php echo $list->name; ?></option>
			<?php

		}
		echo ob_get_clean();
	}

	public function getproductbranch(Request $request){
		$catid = $request->cat_id;
		$sss = \App\Product::where('id', $catid)->first();
		if($sss){
		$lists = \App\PartnerBranch::where('id', $sss->branches)->get();
		ob_start();
		?>
		<option value="">Please select branch</option>
		<?php
		foreach($lists as $list){

			?>
			<option value="<?php echo $list->id; ?>"><?php echo $list->name; ?></option>
			<?php

		}
		}else{
			?>
			<option value="<?php echo $list->id; ?>"><?php echo $list->name; ?></option>
			<?php
		}
		echo ob_get_clean();
	}

	public function getsubcategories(Request $request){
		$catid = $request->cat_id;
		$lists = \App\SubCategory::where('cat_id', $catid)->get();
		ob_start();
		?>

		<?php
		foreach($lists as $list){

			?>
			<option value="<?php echo $list->sub_id; ?>"><?php echo $list->name; ?></option>
			<?php

		}
		echo ob_get_clean();
	}


		public function getpartnerajax(Request $request){
	    $fetchedData = \App\Partner::where('partner_name','LIKE', '%'.$request->likevalue.'%')->get();
		$agents = array();
		foreach($fetchedData as $list){
			$agents[] = array(
				'id' => $list->id,
				'agent_id' => $list->partner_name,
				'agent_company_name' => $list->partner_name,
			);
		}

		echo json_encode($agents);
	}

		public function getassigneeajax(Request $request){
		    $squery = $request->likevalue;
		     $fetchedData = \App\Admin::where('role', '!=', 7)
       ->where(
           function($query) use ($squery) {
             return $query
                    ->where('email', 'LIKE', '%'.$squery.'%')
                    ->orwhere('first_name', 'LIKE','%'.$squery.'%')->orwhere('last_name', 'LIKE','%'.$squery.'%')->orwhere('client_id', 'LIKE','%'.$squery.'%')->orwhere('phone', 'LIKE','%'.$squery.'%')->orWhere(DB::raw("concat(first_name, ' ', last_name)"), 'LIKE', "%".$squery."%");

            })
            ->get();


		$agents = array();
		foreach($fetchedData as $list){
			$agents[] = array(
				'id' => $list->id,
				'agent_id' => $list->first_name.' '.$list->last_name,
				'assignee' => $list->first_name.' '.$list->last_name,
			);
		}

		echo json_encode($agents);
	}
	public function appointmentsEducation(Request $request){
		$type='Education';
		return view('Admin.appointments.calender', compact('type'));
	}

	public function appointmentsJrp(Request $request){
		$type='Jrp';
		return view('Admin.appointments.calender', compact('type'));
	}

	public function appointmentsTourist(Request $request){
		$type='Tourist';
		return view('Admin.appointments.calender', compact('type'));
	}

	public function appointmentsOthers(Request $request){
		$type='Others';
		return view('Admin.appointments.calender', compact('type'));
	}

	public function gensettings(Request $request){
	   $setting = Setting::where('office_id', Auth::user()->office_id)->first();
		return view('Admin.gensettings.index', compact('setting'));
	}

    public function gensettingsupdate(Request $request){
        if(Setting::where('office_id', Auth::user()->office_id)->exists()){
           $setting = Setting::where('office_id', Auth::user()->office_id)->first();
            $objs = Setting::find($setting->id);
            $objs->date_format = $request->date_format;
             $objs->time_format = $request->time_format;
            $objs->save();
        }else{
             $objs = new Setting;
            $objs->date_format = $request->date_format;
            $objs->office_id = Auth::user()->office_id;
             $objs->time_format = $request->time_format;
            $objs->save();
        }

        	return Redirect::to('/admin/gen-settings')->with('success', 'Record updated successfully');
    }

    public function checkclientexist(Request $request){
        if($request->type == 'email'){
         $clientexists = \App\Admin::where('email', $request->vl)->where('role',7)->exists();
            if($clientexists){
                echo 1;
            }else{
                echo 0;
            }
        }else if($request->type == 'clientid'){
         $clientexists = \App\Admin::where('client_id', $request->vl)->where('role',7)->exists();
            if($clientexists){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            $clientexists = \App\Admin::where('phone', $request->vl)->where('role',7)->exists();
            if($clientexists){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

	public function allnotification(Request $request){
		$lists = \App\Notification::where('receiver_id', Auth::user()->id)->orderby('created_at','DESC')->paginate(20);
		return view('Admin.notifications', compact(['lists']));
	}
}
