<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Redirect;

use App\Models\Admin;
use App\Models\WebsiteSetting;
use App\Models\Setting;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;


class AdminController extends Controller
{
    // Status constants for better maintainability
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DECLINED = 2;
    const STATUS_PROCESSED = 4;
    
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
        //$countenquiries = \App\Models\Enquiry::whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
        //$countenquiries = DB::table('enquiries')->whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
        #dd($countenquiries);

        //dd(Auth::user()->role);
        //Get User role and module access

        //For Total Leads section
        //$countleads = \App\Models\Admin::where('is_archived',0)->where('role', '=', '7')->where('type','lead')->whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
        //$countallleads = \App\Models\Admin::where('is_archived',0)->where('role', '=', '7')->where('type','lead')->count();
        //$countleads = DB::table('admins')->where('is_archived', 0)->where('role',7)->where('type','lead')->whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
        //$countallleads = DB::table('admins')->where('is_archived', 0)->where('role',7)->where('type','lead')->count();


        //Today Followup - Removed Note model functionality

        //Total Clients
        //$countclient = \App\Models\Admin::where('is_archived',0)->where('type','client')->where('role', '=', '7')->count();


		/* Client data */
        //return view('Admin.dashboard', compact(['not_contacted', 'create_porposal', 'followup', 'undecided', 'lost', 'won', 'ready_to_pay', 'Contact', 'Lead', 'Admindd']));
        //return view('Admin.dashboard', compact(['countenquiries','module_access','countleads','countallleads','countfollowup','countclient']));
        return view('Admin.dashboard', compact(['Contact']));

    }

    public function fetchnotification(Request $request){
         // Notification functionality removed
         $data = array(
           'unseen_notification'  => 0
        );
        return response()->json($data);
    }
    
    public function fetchmessages(Request $request){
        // Notification functionality removed
        return 0;
    }
    
    public function fetchInPersonWaitingCount(Request $request){
        // CheckinLog functionality removed
        $data = array('InPersonwaitingCount'  => 0);
        return response()->json($data);
   }

    public function fetchTotalActivityCount(Request $request){
        // Note functionality removed
        $data = array('assigneesCount'  => 0);
        return response()->json($data);
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
			$obj							= 	Admin::find(Auth::id());
			if(($requestData['is_business_gst'] ?? null) == 'yes'){
			$obj->is_business_gst				=	$requestData['is_business_gst'] ?? null;
			$obj->gstin					=	$requestData['gstin'] ?? null;
			$obj->gst_date						=	$requestData['gst_date'] ?? null;
			}else{
				$obj->is_business_gst				=	$requestData['is_business_gst'] ?? null;
			$obj->gstin					=	'';
			$obj->gst_date						=	'';
			}
			$saved							=	$obj->save();

			if(!$saved)
			{
				return redirect()->back()->with('error', config('constants.server_error'));
			}
			else
			{
				return redirect('/admin/settings/taxes/returnsetting')->with('success', 'Your Profile has been edited successfully.');
			}
		}else{
			//return view('Admin.my_profile', compact(['fetchedData', 'countries']));
			return view('Admin.settings.returnsetting');
		}
	}
	public function taxrates(Request $request){
		// TaxRate functionality removed - not needed for appointment system
		return redirect()->back()->with('error', 'Tax rate functionality has been disabled');
	}
	public function taxratescreate(Request $request){
		// TaxRate functionality removed - not needed for appointment system
		return redirect()->back()->with('error', 'Tax rate functionality has been disabled');
	}

	public function edittaxrates(Request $request, $id = Null){
		// TaxRate functionality removed - not needed for appointment system
		return redirect()->back()->with('error', 'Tax rate functionality has been disabled');
	}

	public function savetaxrate(Request $request){
		// TaxRate functionality removed - not needed for appointment system
		return redirect()->back()->with('error', 'Tax rate functionality has been disabled');
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
								$this->unlinkFile($requestData['old_profile_img'], config('constants.profile_imgs'));
							}
					/* Unlink File Function End */

					$profile_img = $this->uploadFile($request->file('profile_img'), config('constants.profile_imgs'));
				}
				else
				{
					$profile_img = $requestData['old_profile_img'] ?? null;
				}
			/* Profile Image Upload Function End */


			$obj							= 	Admin::find(Auth::id());

		$obj->first_name				=	$requestData['first_name'] ?? null;
			$obj->last_name					=	$requestData['last_name'] ?? null;
			$obj->phone						=	$requestData['phone'] ?? null;
			$obj->country					=	$requestData['country'] ?? null;
			$obj->state						=	$requestData['state'] ?? null;
			$obj->city						=	$requestData['city'] ?? null;
			$obj->address					=	$requestData['address'] ?? null;
			$obj->zip						=	$requestData['zip'] ?? null;
			$obj->company_fax						=	$requestData['company_fax'] ?? null;
			$obj->company_name						=	$requestData['company_name'] ?? null;
			$obj->company_website						=	$requestData['company_website'] ?? null;
			$obj->profile_img				=	$profile_img ?? null;

			$saved							=	$obj->save();

			if(!$saved)
			{
				return redirect()->back()->with('error', config('constants.server_error'));
			}
			else
			{
				return redirect('/admin/my_profile')->with('success', 'Your Profile has been edited successfully.');
			}
		}
		else
		{
			$id = Auth::id();
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
				return redirect('/admin/dashboard')->with('error',config('constants.unauthorized'));
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
			$admin_id = Auth::id();

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
											return redirect()->back()->with('error', config('constants.server_error'));
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

		$contactexist = Contact::where('id', $request->customer_id)->where('user_id', Auth::id())->exists();
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
				return redirect('/admin/dashboard')->with('error',config('constants.unauthorized'));
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
								$this->unlinkFile(@$requestData['old_logo'], config('constants.logo'));
							}
					/* Unlink File Function End */

					$logo = $this->uploadFile($request->file('logo'), config('constants.logo'));
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
				return redirect()->back()->with('error', config('constants.server_error'));
			}
			else
			{
				return redirect('/admin/website_setting')->with('success', 'Website Setting has been edited successfully.');
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
		// admin-only routes are protected via auth:admin middleware
		if ($request->isMethod('post'))
		{
			$obj	= 	Admin::find(Auth::id());
			$obj->client_id	=	md5(Auth::id().time());
			$saved				=	$obj->save();
			if(!$saved)
			{
				return redirect()->back()->with('error', config('constants.server_error'));
			}
			else
			{
				return redirect('/admin/api-key')->with('success', 'Api Key'.config('constants.edited'));
			}
		}else{
			return view('Admin.apikey');
		}
	}

	public function updateAction(Request $request)
	{
		$status 			= 	0;
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);
			$requestData['current_status'] = trim($requestData['current_status']);
			$requestData['table'] = trim($requestData['table']);
			$requestData['col'] = trim($requestData['colname']);

			// admin-only routes are protected via auth:admin middleware
				if(isset($requestData['id']) && !empty($requestData['id']) && isset($requestData['current_status']) && isset($requestData['table']) && !empty($requestData['table']))
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));

					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();

						if($recordExist)
						{
							if($requestData['current_status'] == self::STATUS_DISABLED)
							{
								$updated_status = self::STATUS_ENABLED;
								$message = 'Record has been enabled successfully.';
							}
							else
							{
								$updated_status = self::STATUS_DISABLED;
								$message = 'Record has been disabled successfully.';
							}
							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update([$requestData['col'] => $updated_status]);
							if($response)
							{
								$status = 1;
							}
							else
							{
								$message = config('constants.server_error');
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
				$message = config('constants.post_method');
			}
			return response()->json(array('status'=>$status, 'message'=>$message));
		}

	


	public function moveAction(Request $request)
	{
		$status 			= 	0;
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


							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update([$requestData['col'] => self::STATUS_DISABLED]);
							if($response)
							{
								$status = 1;
								$message = 'Record successfully moved';
							}
							else
							{
								$message = config('constants.server_error');
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
			$message = config('constants.post_method');
		}
		return response()->json(array('status'=>$status, 'message'=>$message));
	}

	public function declinedAction(Request $request)
	{
		$status 			= 	0;
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);

			$requestData['table'] = trim($requestData['table']);


			// admin-only routes are protected via auth:admin middleware
				if(isset($requestData['id']) && !empty($requestData['id'])  && isset($requestData['table']) && !empty($requestData['table']))
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));

					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();

						if($recordExist)
						{

								$updated_status = self::STATUS_DECLINED;
								$message = 'Record has been declined successfully.';

							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update(['status' => $updated_status]);
							if($response)
							{
								$status = 1;
							}
							else
							{
								$message = config('constants.server_error');
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
			$message = config('constants.post_method');
		}
		return response()->json(array('status'=>$status, 'message'=>$message));
	}

	public function approveAction(Request $request)
	{
		$status 			= 	0;
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);

			$requestData['table'] = trim($requestData['table']);


			// admin-only routes are protected via auth:admin middleware
				if(isset($requestData['id']) && !empty($requestData['id'])  && isset($requestData['table']) && !empty($requestData['table']))
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));

					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();

						if($recordExist)
						{

								$updated_status = self::STATUS_ENABLED;
								$message = 'Record has been approved successfully.';

							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update(['status' => $updated_status]);
							if($response)
							{
								$status = 1;
							}
							else
							{
								$message = config('constants.server_error').'sss';
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
			$message = config('constants.post_method');
		}
		return response()->json(array('status'=>$status, 'message'=>$message));
	}

	public function processAction(Request $request)
	{
		$status 			= 	0;
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);

			$requestData['table'] = trim($requestData['table']);


			// admin-only routes are protected via auth:admin middleware
				if(isset($requestData['id']) && !empty($requestData['id'])  && isset($requestData['table']) && !empty($requestData['table']))
				{
					$tableExist = Schema::hasTable(trim($requestData['table']));

					if($tableExist)
					{
						$recordExist = DB::table($requestData['table'])->where('id', $requestData['id'])->exists();

						if($recordExist)
						{

								$updated_status = self::STATUS_PROCESSED;
								$message = 'Record has been processed successfully.';

							$response 	= 	DB::table($requestData['table'])->where('id', $requestData['id'])->update(['status' => $updated_status]);
							if($response)
							{
								$status = 1;
							}
							else
							{
								$message = config('constants.server_error').'sss';
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
			$message = config('constants.post_method');
		}
		return response()->json(array('status'=>$status, 'message'=>$message));
	}

	public function archiveAction(Request $request)
	{
		$status 			= 	0;
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);

			$requestData['table'] = trim($requestData['table']);

			$astatus = '';
			// admin-only routes are protected via auth:admin middleware
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
								$message = config('constants.server_error');
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
			$message = config('constants.post_method');
		}
		return response()->json(array('status'=>$status, 'message'=>$message, 'astatus'=>$astatus));
	}

	public function deleteAction(Request $request)
	{
		$status 			= 	0;
		if ($request->isMethod('post'))
		{
			$requestData 	= 	$request->all();

			$requestData['id'] = trim($requestData['id']);
			$requestData['table'] = trim($requestData['table']);

			// admin-only routes are protected via auth:admin middleware

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
							$o = \App\Models\Admin::where('id', $requestData['id'])->first();
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
								$message = config('constants.server_error');
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
								$message = config('constants.server_error');
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
										$message = config('constants.server_error');
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
										$message = config('constants.server_error');
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
										$message = config('constants.server_error');
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
										$message = config('constants.server_error');
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
									$message = config('constants.server_error');
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
			$message = config('constants.post_method');
		}
		return response()->json(array('status'=>$status, 'message'=>$message));
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
            // admin-only routes are protected via auth:admin middleware
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
                                $message = config('constants.server_error');
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
			$message = config('constants.post_method');
		}
		return response()->json(array('status'=>$status, 'message'=>$message));
	}

	public function getStates(Request $request)
	{
		$status 			= 	0;
		$data				= array();
		$method 			= 	$request->method();

		if ($request->isMethod('post'))
		{
			$message = 'States lookup has been disabled.';
		}
		else
		{
			$message = config('constants.post_method');
		}
		return response()->json(array('status'=>$status, 'message'=>$message, 'data'=>$data));
	}

	public function getChapters(Request $request)
	{
		$status 			= 	0;
		$data				= array();
		$method 			= 	$request->method();

		if ($request->isMethod('post'))
		{
			$message = 'Chapters lookup has been disabled.';
		}
		else
		{
			$message = config('constants.post_method');
		}
		return response()->json(array('status'=>$status, 'message'=>$message, 'data'=>$data));
	}

	public function addCkeditiorImage(Request $request)
	{
		$status 			= 	0;
		$method 			= 	$request->method();

		if ($request->isMethod('post'))
		{
			$message = 'CKEditor image upload has been disabled.';
		}
		else
		{
			$message = config('constants.post_method');
		}
		return response()->json(array('status'=>$status, 'message'=>$message));
	}

	public function sessions(Request $request)
	{
		return view('Admin.sessions');
	}






	public function sendmail(Request $request){
		$requestData = $request->all();
		//echo '<pre>'; print_r($requestData); die;
		$user_id = Auth::id();
		$reciept_id = '';
		$array = array();

        // Invoice and receipt functionality removed - not needed for appointment system

		$obj = new \App\MailReport;
		$obj->user_id 		=  $user_id;
		$obj->from_mail 	=  $requestData['email_from'];
		$obj->to_mail 		=  implode(',',$requestData['email_to']);
		if(isset($requestData['email_cc'])){
		$obj->cc 			=  implode(',', $requestData['email_cc'] ?? []);
		}
		$obj->template_id 	=  $requestData['template'];
		$obj->reciept_id 	=  $reciept_id;
		$obj->subject		=  $requestData['subject'];
		if(isset($requestData['type'])){
		$obj->type 			=  $requestData['type'] ?? null;
		}
		$obj->message		 =  $requestData['message'];
		$attachments = array();


		$saved	=	$obj->save();


		if(isset($requestData['checklistfile'])){
            if(!empty($requestData['checklistfile'])){
                // ActivitiesLog functionality removed
            }
        }

		$subject = $requestData['subject'];
		$message = $requestData['message'];
		foreach($requestData['email_to'] as $l){
			$client = \App\Models\Admin::Where('id', $l)->first();
			$subject = str_replace('{Client First Name}',$client->first_name, $subject);
			$message = str_replace('{Client First Name}',$client->first_name, $message);

			$message = str_replace('{Client Assignee Name}',$client->first_name, $message);
			$message = str_replace('{Company Name}',Auth::user()->company_name, $message);
			$ccarray = array();
			if(isset($requestData['email_cc']) && !empty($requestData['email_cc'])){
				foreach($requestData['email_cc'] as $cc){
					$clientcc = \App\Models\Admin::Where('id', $cc)->first();
					$ccarray[] = $clientcc;
				}
			}


		    if($request->hasfile('attach'))
            {
                 $array['filesatta'][] =  $request->attach;
            }
            $this->send_compose_template($client->email, $subject, $requestData['email_from'], $message, '', $array, $ccarray ?? []);
		}
        if(!empty($array['file'])){
            unset($array['file']);
        }
        if(!$saved) {
            return redirect()->back()->with('error', config('constants.server_error'));
        } else {
            return redirect()->back()->with('success', 'Email Sent Successfully');
        }
	}










	// Removed: appointmentsEducation, appointmentsJrp, appointmentsTourist - only Ajay appointments now
	
	public function appointmentsOthers(Request $request){
		$type='Appointments'; // Neutral title for Ajay's calendar
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

        	return redirect('/admin/gen-settings')->with('success', 'Record updated successfully');
    }

    public function checkclientexist(Request $request){
        if($request->type == 'email'){
         $clientexists = \App\Models\Admin::where('email', $request->vl)->where('role',7)->exists();
            if($clientexists){
                echo 1;
            }else{
                echo 0;
            }
        }else if($request->type == 'clientid'){
         $clientexists = \App\Models\Admin::where('client_id', $request->vl)->where('role',7)->exists();
            if($clientexists){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            $clientexists = \App\Models\Admin::where('phone', $request->vl)->where('role',7)->exists();
            if($clientexists){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

	public function allnotification(Request $request){
		// Notification functionality removed
		return view('Admin.notifications', compact([]));
	}
}
