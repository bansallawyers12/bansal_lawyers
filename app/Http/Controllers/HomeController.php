<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Models\WebsiteSetting;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\BlogCategory;
use App\Models\OurService;
use App\Models\Testimonial;
use App\Models\WhyChooseus;
use App\Models\HomeContent;
use App\Models\CmsPage;
// use App\Mail\CommonMail; // unused

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
// use Illuminate\Support\Facades\Cookie; // unused

use Illuminate\Support\Facades\Mail;

use Stripe;
use App\Models\Enquiry;
use App\Models\RecentCase;

class HomeController extends Controller
{
	public function __construct(Request $request)
    {
		$siteData = WebsiteSetting::first();
		\View::share('siteData', $siteData);
	}

    public function coming_soon()
    {
        return view('coming_soon');
    }

	public function sicaptcha(Request $request)
    {
		 $code=$request->code;

		$im = imagecreatetruecolor(50, 24);
		$bg = imagecolorallocate($im, 37, 37, 37); //background color blue
		$fg = imagecolorallocate($im, 255, 241, 70);//text color white
		imagefill($im, 0, 0, $bg);
		imagestring($im, 5, 5, 5,  $code, $fg);
		header("Cache-Control: no-cache, must-revalidate");
		header('Content-type: image/png');
		imagepng($im);
		imagedestroy($im);

    }

    public static function hextorgb ($hexstring){
        $integar = hexdec($hexstring);
                    return array( "red" => 0xFF & ($integar >> 0x10),
        "green" => 0xFF & ($integar >> 0x8),
        "blue" => 0xFF & $integar
        );
    }

	public function Page(Request $request, $slug= null)
    {
		if( RecentCase::where('slug', '=', $slug)->exists() ) { //dd('@@@');
            $casedetailquery 	= RecentCase::where('slug', '=', $slug)->where('status', '=', 1);
            $casedetailists		=  $casedetailquery->first(); //dd($casedetailists);
            return view('casedetail', compact(['casedetailists']));
        }
		else if( Blog::where('slug', '=', $slug)->exists() ) { //dd('@@@');
            $blogdetailquery 		= Blog::where('slug', '=', $slug)->where('status', '=', 1)->with(['categorydetail']);
            $blogdetailists		=  $blogdetailquery->first(); //dd($blogdetailists);
          
             //latest blogs
            $latestbloglists = Blog::where('status', 1)->latest()->take(5)->get();//dd($latestbloglists);
            return view('blogdetail', compact(['blogdetailists','latestbloglists']));
        }
        else if(CmsPage::where('slug', '=', $slug)->exists()) { //dd('####');
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $slug);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            if($pagedata){
                if( isset($pagedata->slug) &&  $pagedata->slug == 'criminal-law' || $pagedata->slug == 'family-law'  || $pagedata->slug == 'personal-law'  || $pagedata->slug == 'corporate-law'  || $pagedata->slug == 'commercial-law'  || $pagedata->slug == 'property-law'  || $pagedata->slug == 'migration-law' || $pagedata->slug == 'divorce' || $pagedata->slug == 'child-custody' || $pagedata->slug == 'family-violence' || $pagedata->slug == 'property-settlement' || $pagedata->slug == 'family-violence-orders' || $pagedata->slug == 'juridicational-error-federal-circuit-court-application' || $pagedata->slug == 'art-application' || $pagedata->slug == 'visa-refusals-visa-cancellation' || $pagedata->slug == 'federal-court-application' || $pagedata->slug == 'intervenition-orders' || $pagedata->slug == 'trafic-offences' || $pagedata->slug == 'drink-driving-offences' || $pagedata->slug == 'assualt-charges' || $pagedata->slug == 'business-law' || $pagedata->slug == 'leasing-or-selling-a-business' || $pagedata->slug == 'contracts-or-business-agreements' || $pagedata->slug == 'loan-agreement'  || $pagedata->slug == 'conveyancing' || $pagedata->slug == 'building-and-construction-disputes' || $pagedata->slug == 'caveats-disputs-and-removal' ) {
                    return view('Frontend.cms.index_inner', compact(['pagedata']));
                } else {
                    return view('Frontend.cms.index', compact(['pagedata']));
                }
            }
        }
        else { //dd('elsee');
          abort(404);
        }
    }

	public function index(Request $request)
    {
		// Optimized blog query - single query with pagination
		$bloglists = Blog::where('status', 1)
			->orderByDesc('id')
			->paginate(3);
		
		// Get total count from pagination object to avoid separate query
		$blogData = $bloglists->total();
		
        return view('index', compact(['bloglists', 'blogData']));
    }

	public function myprofile(Request $request)
    {
		return view('profile');
    }
	public function contactus(Request $request)
    {
		return view('contact');
    }

	public function refresh_captcha() {
		// This method is no longer needed with Google reCAPTCHA
		// Keeping for backward compatibility but returning empty response
		return response('', 200);
	}

	public function contact(Request $request){
        //dd( $request->all());
        $fromAddress = config('mail.from.address');
        //dd($fromAddress);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            //'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required'
        ]);

        // Validate reCAPTCHA
        $recaptchaResponse = $this->validateRecaptcha($request);
        if ($recaptchaResponse !== true) {
            return $recaptchaResponse;
        }

       //$set = \App\Models\Admin::where('id',1)->first();
		$obj = new Contact;
        $obj->name = $request->name;
        $obj->contact_email = $request->email;
        //$obj->contact_phone = $request->phone;
        $obj->subject = $request->subject;
        $obj->message = $request->message;
        $saved = $obj->save();
		if($saved){
            $obj1 = new Enquiry;
            $obj1->first_name = $request->name;
            $obj1->email = $request->email;
            //$obj1->phone = $request->phone;
            $obj1->subject = $request->subject;
            $obj1->message = $request->message;
            $obj1->save();
        }

        $subject = 'You have a New Query  from  '.$request->name;
      	$details = [
          'title' => 'You have a New Query  from  '.$request->name,
          'body' => 'This is for testing email using smtp',
          'subject'=>$subject,
          'fullname' => 'Admin',
          'from' =>$request->name,
          'email'=> $request->email,
          //'phone' => $request->phone,
          'description' => $request->message
        ];

        \Mail::to($fromAddress)->send(new \App\Mail\ContactUsMail($details));
       

        //mail to customer
        /*$subject_customer = 'You have a new query from Bansal Lawyers';
		$details_customer = [
            'title' => 'You have a new query from Bansal Lawyers',
            'body' => 'This is for testing email using smtp',
            'subject'=>$subject_customer,
            'fullname' => $request->name,
            'from' =>'Admin',
            'email'=> $request->email,
            //'phone' => $request->phone,
            'description' => $request->message
        ];
        \Mail::to($request->email)->send(new \App\Mail\ContactUsCustomerMail($details_customer));*/

        return back()->with('success', 'Thanks for sharing your interest. our team will respond to you with in 24 hours.');
	}

	public function testimonial(Request $request)
    {
		$testimonialquery 		= Testimonial::where('id', '!=', '')->where('status', '=', 1);
		$testimonialData 	= $testimonialquery->count();	//for all data
		$testimoniallists		=  $testimonialquery->orderby('id','DESC')->get();

	   return view('testimonial', compact(['testimoniallists', 'testimonialData']));
    }

	public function ourservices(Request $request)
    {
		$servicequery 		= OurService::where('id', '!=', '')->where('status', '=', 1);
		$serviceData 	= 	$servicequery->count();	//for all data
		$servicelists		=  $servicequery->orderby('id','ASC')->get();

	   return view('ourservices', compact(['servicelists', 'serviceData']));
    }

	public function blog(Request $request)
    {
		$blogquery 		= Blog::where('id', '!=', '')->where('status', '=', 1);
		$blogData 	= $blogquery->count();	//for all data
		$bloglists		=  $blogquery->orderby('id','DESC')->get();
		//return view('blog', compact(['bloglists', 'blogData']));
        return view('bloglatest', compact(['bloglists', 'blogData']));
    }
  
	public function blogdetail(Request $request, $slug = null)
    {
		if(isset($slug) && !empty($slug)){
			if(Blog::where('slug', '=', $slug)->exists()) {
				$blogdetailquery 		= Blog::where('slug', '=', $slug)->where('status', '=', 1)->with(['categorydetail']);
				$blogdetailists		=  $blogdetailquery->first();
              
                // Get latest blogs excluding the current slug
            	$latestbloglists = Blog::where('status', 1)
                                    ->where('slug', '!=', $slug) // Exclude current blog
                                    ->latest()
                                    ->take(5)
                                    ->get();
                return view('blogdetail', compact(['blogdetailists','latestbloglists']));
			} else {
				return Redirect::to('/blogs')->with('error', 'Blog'.Config::get('constants.not_exist'));
			}
		} else {
			return Redirect::to('/blogs')->with('error', Config::get('constants.unauthorized'));
		}
    }
  
	public function servicesdetail(Request $request, $slug = null)
    {
		if(isset($slug) && !empty($slug)){
			if(OurService::where('slug', '=', $slug)->exists())
			{
			$servicesdetailquery 		= OurService::where('slug', '=', $slug)->where('status', '=', 1);
			$servicesdetailists		=  $servicesdetailquery->first();

			return view('servicesdetail', compact(['servicesdetailists']));
			}
			else
			{
				return Redirect::to('/ourservices')->with('error', 'Our Services'.Config::get('constants.not_exist'));
			}
		}
		else{
			return Redirect::to('/ourservices')->with('error', Config::get('constants.unauthorized'));
		}
    }

	public function bookappointment()
    {
        return view('bookappointment');
    }

    public function bookappointment1()
    {
        return view('bookappointment1');
    }


    public function getdatetime(Request $request)
    {
        try {
            $enquiry_item = $request->enquiry_item;
            $req_service_id = $request->id;
            
            // Only handle paid appointments (service_id = 1) for Ajay Bansal
            if ($req_service_id != 1) {
                return response()->json(['success' => false, 'message' => 'Only paid appointments are available']);
            }
            
            // Ajay Bansal's configuration (person_id = 1, service_type = 1)
            $person_id = 1; // Ajay Bansal
            $service_type = 1; // Paid service
            
            $bookservice = \App\Models\BookService::where('id', $req_service_id)->first();
            if (!$bookservice) {
                return response()->json(['success' => false, 'message' => 'Service not found']);
            }
            
            $service = \App\Models\BookServiceSlotPerPerson::where('person_id', $person_id)->where('service_type', $service_type)->first();
            
            if ($service) {
                $weekendd = array();
                if ($service->weekend != '') {
                    $weekend = explode(',', $service->weekend);
                    foreach ($weekend as $e) {
                        switch (trim($e)) {
                            case 'Sun':
                                $weekendd[] = 0;
                                break;
                            case 'Mon':
                                $weekendd[] = 1;
                                break;
                            case 'Tue':
                                $weekendd[] = 2;
                                break;
                            case 'Wed':
                                $weekendd[] = 3;
                                break;
                            case 'Thu':
                                $weekendd[] = 4;
                                break;
                            case 'Fri':
                                $weekendd[] = 5;
                                break;
                            case 'Sat':
                                $weekendd[] = 6;
                                break;
                        }
                    }
                }
                
                $start_time = date('H:i', strtotime($service->start_time));
                $end_time = date('H:i', strtotime($service->end_time));

                // Handle disabled dates
                $disabledatesarray = array();
                if ($service->disabledates != '') {
                    if (strpos($service->disabledates, ',') !== false) {
                        $disabledatesArr = explode(',', $service->disabledates);
                        $disabledatesarray = array_map('trim', $disabledatesArr);
                    } else {
                        $disabledatesarray = array(trim($service->disabledates));
                    }
                }

                // Add the current date to the array to prevent past date selection
                $disabledatesarray[] = date('d/m/Y');
                
                return response()->json([
                    'success' => true, 
                    'duration' => $bookservice->duration,
                    'weeks' => $weekendd,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'disabledatesarray' => $disabledatesarray
                ]);
            } else {
                return response()->json([
                    'success' => false, 
                    'message' => 'Service configuration not found'
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('getdatetime error: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Server error occurred'
            ]);
        }
    }


    // Removed getdatetimebackend method - only handling paid appointments for Ajay Bansal

	public function getdisableddatetime(Request $request)
    {
        try {
            $requestData = $request->all();
            
            // Validate required parameters
            if (!isset($requestData['sel_date']) || !isset($request->service_id)) {
                return response()->json(['success' => false, 'message' => 'Missing required parameters']);
            }
            
            // Only handle paid appointments (service_id = 1) for Ajay Bansal
            if ($request->service_id != 1) {
                return response()->json(['success' => false, 'message' => 'Only paid appointments are available']);
            }
            
            // Handle different date formats
            $selDate = $requestData['sel_date'];
            if (strpos($selDate, '-') !== false) {
                // YYYY-MM-DD format from JavaScript
                $datey = $selDate;
            } else {
                // DD/MM/YYYY format
                $date = explode('/', $selDate);
                if (count($date) != 3) {
                    return response()->json(['success' => false, 'message' => 'Invalid date format']);
                }
                $datey = $date[2].'-'.$date[1].'-'.$date[0];
            }
            
            // Ajay Bansal's configuration (person_id = 1, service_type = 1)
            $book_service_slot_per_person_tbl_unique_id = 1;
            
            // Check for existing appointments on this date
            $service = \App\Models\Appointment::select('id', 'date', 'time')
                ->where('status', '!=', 7)
                ->whereDate('date', $datey)
                ->where('service_id', 1)
                ->whereIn('noe_id', [1, 2, 3, 4, 5, 6, 7])
                ->exists();

            $servicelist = \App\Models\Appointment::select('id', 'date', 'time')
                ->where('status', '!=', 7)
                ->whereDate('date', $datey)
                ->where('service_id', 1)
                ->whereIn('noe_id', [1, 2, 3, 4, 5, 6, 7])
                ->get();

            $disabledtimeslotes = array();
            
            // Add existing appointment times to disabled slots
            if ($service && $servicelist->isNotEmpty()) {
                foreach($servicelist as $list) {
                    $disabledtimeslotes[] = date('g:i A', strtotime($list->time));
                }
            }
            
            // Get manually disabled slots from BookServiceDisableSlot table
            $disabled_slot_arr = \App\Models\BookServiceDisableSlot::select('id','slots')
                ->where('book_service_slot_per_person_id', $book_service_slot_per_person_tbl_unique_id)
                ->whereDate('disabledates', $datey)
                ->get();
                
            if ($disabled_slot_arr->isNotEmpty()) {
                $newArray = explode(",", $disabled_slot_arr[0]->slots);
                $disabledtimeslotes = array_merge($disabledtimeslotes, $newArray);
            }
            
            return response()->json([
                'success' => true, 
                'disabledtimeslotes' => $disabledtimeslotes
            ]);
            
        } catch (\Exception $e) {
            \Log::error('getdisableddatetime error: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Server error occurred',
                'disabledtimeslotes' => []
            ]);
        }
    }



    

	

	public function stripe($appointmentId)
    {
        $appointmentInfo = \App\Models\Appointment::find($appointmentId);
        if($appointmentInfo){
            $adminInfo = \App\Models\Admin::find($appointmentInfo->client_id);
        } else {
            $adminInfo = array();
        }
        return view('stripe', compact(['appointmentId','appointmentInfo','adminInfo']));
    }

   public function stripePost(Request $request)
    {
        $requestData = $request->all(); //dd($requestData);
        $appointment_id = $requestData['appointment_id'];
        $email = $requestData['customerEmail'];
        $cardName = $requestData['cardName'];
        $stripeToken = $requestData['stripeToken'];
        $currency = "aud";
        $payment_type = "stripe";
        $order_date = date("Y-m-d H:i:s");
        $amount = 150;


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Stripe\Customer::create(array("email" => $email,"name" => $cardName,"source" => $stripeToken));

        $payment_result = Stripe\Charge::create ([
            "amount" => $amount * 100,
            "currency" => $currency,
            "customer" => $customer->id,
            "description" => "Paid To bansallawyers.com.au For Paid Service By $cardName"
        ]);
        //dd($payment_result);
        //update Order status
        if ( ! empty($payment_result) && $payment_result["status"] == "succeeded")
        { //success
            //Order insertion
            $stripe_payment_intent_id = $payment_result['id'];
            $payment_status = "Paid";
            $order_status = "Completed";
            $appontment_status = 10; //Pending Appointment With Payment Success
            $ins = DB::table('tbl_paid_appointment_payment')->insert([
                'order_hash' => $stripeToken,
                'payer_email' => $email,
                'amount' => $amount,
                'currency' => $currency,
                'payment_type' => $payment_type,
                'order_date' => $order_date,
                'name' => $cardName,
                'stripe_payment_intent_id'=>$stripe_payment_intent_id,
                'payment_status'=>$payment_status,
                'order_status'=>$order_status
            ]);
            if($ins ){
                DB::table('appointments')->where('id',$appointment_id)->update( array('status'=>$appontment_status,'order_hash'=>$stripeToken));
            }
            return back()->with('success', 'Payment successful!');
        } else { //failed
            $stripe_payment_intent_id = $payment_result['id'];
            $payment_status = "Unpaid";
            $order_status = "Payement Failure";
            $appontment_status = 11; //Pending Appointment With Payment Fail
            $ins = DB::table('tbl_paid_appointment_payment')->insert([
                'order_hash' => $stripeToken,
                'payer_email' => $email,
                'amount' => $amount,
                'currency' => $currency,
                'payment_type' => $payment_type,
                'order_date' => $order_date,
                'name' => $cardName,
                'stripe_payment_intent_id'=>$stripe_payment_intent_id,
                'payment_status'=>$payment_status,
                'order_status'=>$order_status
            ]);
            if($ins ){
                DB::table('appointments')->where('id',$appointment_id)->update( array('status'=>$appontment_status,'order_hash'=>$stripeToken));
            }
            //return json_encode(array('success'=>false));
            return back()->with('error', 'Payment failed!');
        }
        // handled above with with(...)
    }

    public function search_result(Request $request)
    {   //dd($request->all());
        if ( isset($request->search) &&  $request->search != "" ) {
            $search_string 	= $request->search;
        } else {
            $search_string 	= 'search_string';
        }
        /*$query 	= CmsPage::where('title', 'LIKE', '%'.$search_string.'%')
        ->orWhere('slug', 'LIKE', '%' . $search_string . '%')
        ->orWhere('content', 'LIKE', '%' . $search_string . '%')
        ->orWhere('meta_title', 'LIKE', '%' . $search_string . '%')
        ->orWhere('meta_description', 'LIKE', '%' . $search_string . '%')
        ->orWhere('meta_keyward', 'LIKE', '%' . $search_string . '%');*/

        $query 	= CmsPage::where('title', 'LIKE', '%'.$search_string.'%')
        ->orWhere('slug', 'LIKE', '%' . $search_string . '%')
        ->orWhere('meta_title', 'LIKE', '%' . $search_string . '%')
        ->orWhere('meta_keyward', 'LIKE', '%' . $search_string . '%');

        $totalData 	= $query->count();//dd($totalData);
        //$lists = $query->toSql();
        $lists	= $query->sortable(['id' => 'desc'])->paginate(20); //dd($lists);
        return view('searchresults', compact(['lists', 'totalData']));
    }
  
  
    public function practiceareas(Request $request)
    { 
		return view('practiceareas');
    }
  
     public function case(Request $request)
    {
        $casequery 		= RecentCase::where('id', '!=', '')->where('status', '=', 1);
		$caseData 	    = $casequery->count();	//for all data
		$caselists		= $casequery->orderby('id','DESC')->get();
        return view('case', compact(['caselists', 'caseData']));
	}

    public function casedetail(Request $request, $slug = null)
    {
		if(isset($slug) && !empty($slug)){
			if(RecentCase::where('slug', '=', $slug)->exists()) {
			    $casedetailquery 	= RecentCase::where('slug', '=', $slug)->where('status', '=', 1);
			    $casedetailists		=  $casedetailquery->first();

                return view('casedetail', compact(['casedetailists']));
			} else {
				return Redirect::to('/case')->with('error', 'Case'.Config::get('constants.not_exist'));
			}
		}
		else{
			return Redirect::to('/case')->with('error', Config::get('constants.unauthorized'));
		}
    }
  
    //Practice area main page
    public function familylaw(Request $request)
    {
        $type = 'family-law';
		if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function migrationlaw(Request $request)
    {
        $type = 'migration-law';
		if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function criminallaw(Request $request)
    {
        $type = 'criminal-law';
		if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);

            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function commerciallaw(Request $request)
    {
        $type = 'commercial-law';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);

            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
	}

    public function propertylaw(Request $request)
    {
        $type = 'property-law';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);

            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
	}
  
  
     //Practice area inner page
    public function divorce(Request $request)
    {
        $type = 'divorce';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function childcustody(Request $request)
    {
        $type = 'child-custody';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function familyviolence(Request $request)
    {
        $type = 'family-violence';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function propertysettlement(Request $request)
    {
        $type = 'property-settlement';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function familyviolenceorders(Request $request)
    {
        $type = 'family-violence-orders';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }
  
  
  
     public function juridicationalerrorfederalcircuitcourtapplication(Request $request)
    {
        $type = 'juridicational-error-federal-circuit-court-application';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }


    public function artapplication(Request $request)
    {
        $type = 'art-application';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }


    public function visarefusalsvisacancellation(Request $request)
    {
        $type = 'visa-refusals-visa-cancellation';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function federalcourtapplication(Request $request)
    {
        $type = 'federal-court-application';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }
  
  
  
     public function intervenitionorders(Request $request)
    {
        $type = 'intervenition-orders';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }


    public function traficoffences(Request $request)
    {
        $type = 'trafic-offences';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function drinkdrivingoffences(Request $request)
    {
        $type = 'drink-driving-offences';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function assualtcharges(Request $request)
    {
        $type = 'assualt-charges';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }
  
  
    
    public function businesslaw(Request $request)
    {
        $type = 'business-law';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }


    public function leasingorsellingabusiness(Request $request)
    {
        $type = 'leasing-or-selling-a-business';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function contractsorbusinessagreements(Request $request)
    {
        $type = 'contracts-or-business-agreements';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function loanagreement(Request $request)
    {
        $type = 'loan-agreement';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }
  
  
    public function conveyancing(Request $request)
    {
        $type = 'conveyancing';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function buildingandconstructiondisputes(Request $request)
    {
        $type = 'building-and-construction-disputes';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }

    public function caveatsdisputsandremoval(Request $request)
    {
        $type = 'caveats-disputs-and-removal';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first(); //dd($pagedata);
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
            }
            return view('practice_area_inner', compact('type','pagedata','relatedpagedata'));
        }
    }

    /**
     * Validate reCAPTCHA response
     */
    private function validateRecaptcha(Request $request): bool|\Illuminate\Http\RedirectResponse
    {
        $recaptcha_response = $request->input('g-recaptcha-response');
        
        if (is_null($recaptcha_response)) {
            $errors = ['g-recaptcha-response' => 'Please complete the reCAPTCHA to proceed'];
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $url = "https://www.google.com/recaptcha/api/siteverify";
        $body = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $recaptcha_response,
            'remoteip' => $request->ip()
        ];

        $response = \Illuminate\Support\Facades\Http::get($url, $body);
        $result = json_decode($response->body());

        if ($response->successful() && $result->success == true) {
            return true;
        } else {
            $errors = ['g-recaptcha-response' => 'Please complete the reCAPTCHA again to proceed'];
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

}
