<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;

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
		$siteData = Cache::remember('site_data', 3600, function () {
			return WebsiteSetting::first();
		});
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
		// Optimized: Single query to find the page type instead of multiple exists() checks
		$pageData = null;
		$pageType = null;
		
		// Check RecentCase first
		$casedetailists = RecentCase::where('slug', '=', $slug)->where('status', '=', 1)->first();
		if($casedetailists) {
			return view('casedetail', compact(['casedetailists']));
		}
		
		// Check Blog
		$blogdetailists = Blog::where('slug', '=', $slug)->where('status', '=', 1)->with(['categorydetail'])->first();
		if($blogdetailists) {
			// Cache latest blogs for better performance
			$latestbloglists = Cache::remember('latest_blogs', 1800, function () {
				return Blog::where('status', 1)->latest()->take(5)->get();
			});
			return view('blogdetail', compact(['blogdetailists','latestbloglists']));
		}
		
		// Check CmsPage
		$pagedata = CmsPage::where('slug', '=', $slug)->first();
		if($pagedata) {
			// Optimized: Use array for practice area slugs instead of long OR chain
			$practiceAreaSlugs = [
				'criminal-law', 'family-law', 'personal-law', 'corporate-law', 
				'commercial-law', 'property-law', 'migration-law', 'divorce', 
				'child-custody', 'family-violence', 'property-settlement', 
				'family-violence-orders', 'juridicational-error-federal-circuit-court-application', 
				'art-application', 'visa-refusals-visa-cancellation', 'federal-court-application', 
				'intervenition-orders', 'trafic-offences', 'drink-driving-offences', 
				'assualt-charges', 'business-law', 'leasing-or-selling-a-business', 
				'contracts-or-business-agreements', 'loan-agreement', 'conveyancing', 
				'building-and-construction-disputes', 'caveats-disputs-and-removal'
			];
			
			if(in_array($pagedata->slug, $practiceAreaSlugs)) {
				return view('Frontend.cms.index_inner', compact(['pagedata']));
			} else {
				return view('Frontend.cms.index', compact(['pagedata']));
			}
		}
		
		// Page not found
		abort(404);
    }

	public function index(Request $request)
    {
		// Optimized blog query - single query with pagination and category relationship
		$bloglists = Blog::where('status', 1)
			->with(['categorydetail'])
			->orderByDesc('id')
			->paginate(3);
		
		// Get total count from pagination object to avoid separate query
		$blogData = $bloglists->total();
		
        return view('index', compact(['bloglists', 'blogData']));
    }

	public function contactus(Request $request)
    {
		return view('contact');
    }

    /**
     * Contact form test page
     */
    // ARCHIVED - test version
    // public function contactFormTest(Request $request)
    // {
    //     return view('contact-form-test');
    // }

    /**
     * Contact form demo page - ARCHIVED
     */
    // public function contactFormDemo(Request $request)
    // {
    //     return view('contact-form-demo');
    // }

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
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
        $obj->contact_phone = $request->phone;
        $obj->subject = $request->subject;
        $obj->message = $request->message;
        $saved = $obj->save();
		if($saved){
            $obj1 = new Enquiry;
            $obj1->first_name = $request->name;
            $obj1->email = $request->email;
            $obj1->phone = $request->phone;
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
          'phone' => $request->phone,
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

    /**
     * Unified contact form submission handler
     */
    public function contactSubmit(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:2000',
                'g-recaptcha-response' => 'required',
                'form_source' => 'nullable|string',
                'form_variant' => 'nullable|string'
            ]);

            // Validate reCAPTCHA
            $recaptchaResponse = $this->validateRecaptcha($request);
            if ($recaptchaResponse !== true) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'reCAPTCHA validation failed',
                        'errors' => ['g-recaptcha-response' => ['Please complete the reCAPTCHA verification.']]
                    ], 422);
                }
                return $recaptchaResponse;
            }

            // Save to Contact model
            $contact = new Contact;
            $contact->name = $request->name;
            $contact->contact_email = $request->email;
            $contact->contact_phone = $request->phone;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();

            // Save to Enquiry model
            $enquiry = new Enquiry;
            $enquiry->first_name = $request->name;
            $enquiry->email = $request->email;
            $enquiry->phone = $request->phone;
            $enquiry->subject = $request->subject;
            $enquiry->message = $request->message;
            $enquiry->save();

            // Send email notification
            $fromAddress = config('mail.from.address');
            $subject = 'New Contact Form Submission from ' . $request->name;
            $details = [
                'title' => $subject,
                'body' => 'You have received a new contact form submission.',
                'subject' => $subject,
                'fullname' => 'Admin',
                'from' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'description' => $request->message
            ];

            \Mail::to($fromAddress)->send(new \App\Mail\ContactUsMail($details));

            // Return response based on request type
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your message has been sent successfully. We\'ll get back to you within 24 hours.'
                ]);
            }

            return back()->with('success', 'Thank you! Your message has been sent successfully. We\'ll get back to you within 24 hours.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Contact form submission error: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, there was an error sending your message. Please try again.'
                ], 500);
            }
            
            return back()->with('error', 'Sorry, there was an error sending your message. Please try again.');
        }
    }

	// ARCHIVED - unused testimonials page
	// public function testimonial(Request $request)
    // {
	// 	$testimonialquery 		= Testimonial::where('id', '!=', '')->where('status', '=', 1);
	// 	$testimonialData 	= $testimonialquery->count();	//for all data
	// 	$testimoniallists		=  $testimonialquery->orderby('id','DESC')->get();

	//    return view('testimonial', compact(['testimoniallists', 'testimonialData']));
    // }

	public function ourservices(Request $request)
    {
		$servicequery 		= OurService::where('id', '!=', '')->where('status', '=', 1);
		$serviceData 	= 	$servicequery->count();	//for all data
		$servicelists		=  $servicequery->orderby('id','ASC')->get();

	   return view('ourservices', compact(['servicelists', 'serviceData']));
    }

	public function blog(Request $request)
    {
		// Optimized: Cache blog categories as they rarely change
		$blogCategories = Cache::remember('blog_categories', 3600, function () {
			return BlogCategory::where('status', 1)->orderBy('name', 'asc')->get();
		});
		
		$blogquery = Blog::where('status', '=', 1)->with(['categorydetail']);
		
		// Filter by category if provided - optimized query
		if ($request->has('category') && !empty($request->category)) {
			$categorySlug = $request->category;
			$category = $blogCategories->where('slug', $categorySlug)->first();
			if ($category) {
				$blogquery->where('parent_category', $category->id);
			}
		}
		
		// SEO-Optimized Pagination: 9 posts per page for optimal 3x3 grid
		$bloglists = $blogquery->orderby('id','DESC')->paginate(9);
		$blogData = $bloglists->total();
		
		// Get current page for SEO meta tags
		$currentPage = $bloglists->currentPage();
		$totalPages = $bloglists->lastPage();
		
        return view('bloglatest', compact(['bloglists', 'blogData', 'blogCategories', 'currentPage', 'totalPages']));
    }
    
    public function blogCategory(Request $request, $categorySlug = null)
    {
        if (isset($categorySlug) && !empty($categorySlug)) {
            // Optimized: Use cached categories instead of separate query
            $blogCategories = Cache::remember('blog_categories', 3600, function () {
                return BlogCategory::where('status', 1)->orderBy('name', 'asc')->get();
            });
            
            $category = $blogCategories->where('slug', $categorySlug)->first();
            
            if ($category) {
                $blogquery = Blog::where('parent_category', $category->id)
                                ->where('status', 1)
                                ->with(['categorydetail']);
                
                // SEO-Optimized Pagination: 9 posts per page
                $bloglists = $blogquery->orderby('id','DESC')->paginate(9);
                $blogData = $bloglists->total();
                
                // Get current page for SEO meta tags
                $currentPage = $bloglists->currentPage();
                $totalPages = $bloglists->lastPage();
                
                return view('bloglatest', compact(['bloglists', 'blogData', 'blogCategories', 'category', 'currentPage', 'totalPages']));
            } else {
                return Redirect::to('/blog')->with('error', 'Category not found');
            }
        } else {
            return Redirect::to('/blog')->with('error', 'Invalid category');
        }
    }
  
	public function blogdetail(Request $request, $slug = null)
    {
		if(isset($slug) && !empty($slug)){
			// Optimized: Single query instead of exists() check first
			$blogdetailists = Blog::where('slug', '=', $slug)->where('status', '=', 1)->with(['categorydetail'])->first();
			
			if($blogdetailists) {
                // Optimized: Cache latest blogs with exclusion key
                $cacheKey = 'latest_blogs_exclude_' . $slug;
            	$latestbloglists = Cache::remember($cacheKey, 1800, function () use ($slug) {
                    return Blog::where('status', 1)
                        ->where('slug', '!=', $slug)
                        ->latest()
                        ->take(5)
                        ->get();
                });
                
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


    public function about()
    {
        return view('about');
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
        try {
            $requestData = $request->all();
            $appointment_id = $requestData['appointment_id'];
            $email = $requestData['customerEmail'];
            $cardName = $requestData['cardName'];
            $stripeToken = $requestData['stripeToken']; // This is now a PaymentMethod ID
            $currency = "aud";
            $payment_type = "stripe";
            $order_date = date("Y-m-d H:i:s");
            $amount = 150;

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create or retrieve customer
            $customer = Stripe\Customer::create([
                'email' => $email,
                'name' => $cardName,
            ]);

            // Create Payment Intent
            $payment_intent = Stripe\PaymentIntent::create([
                'amount' => $amount * 100, // Amount in cents
                'currency' => $currency,
                'customer' => $customer->id,
                'payment_method' => $stripeToken,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'description' => "Appointment Payment - Bansal Lawyers - $cardName",
                'return_url' => url('/book-an-appointment'),
            ]);

            // Check if payment was successful
            if ($payment_intent->status === 'succeeded') {
                // Payment successful
                $stripe_payment_intent_id = $payment_intent->id;
                $payment_status = "Paid";
                $order_status = "Completed";
                $appontment_status = 10; // Pending Appointment With Payment Success
                
                // Insert payment record
                $ins = DB::table('tbl_paid_appointment_payment')->insert([
                    'order_hash' => $stripeToken,
                    'payer_email' => $email,
                    'amount' => $amount,
                    'currency' => $currency,
                    'payment_type' => $payment_type,
                    'order_date' => $order_date,
                    'name' => $cardName,
                    'stripe_payment_intent_id' => $stripe_payment_intent_id,
                    'payment_status' => $payment_status,
                    'order_status' => $order_status
                ]);
                
                if ($ins) {
                    DB::table('appointments')->where('id', $appointment_id)->update([
                        'status' => $appontment_status,
                        'order_hash' => $stripeToken
                    ]);
                }
                
                // Redirect back to the normal booking page with success message
                return redirect('/book-an-appointment')->with('success', 'Payment successful! Your appointment has been confirmed.');
            } else {
                // Payment failed
                return back()->with('error', 'Payment failed. Please try again.');
            }
        } catch (Stripe\Exception\CardException $e) {
            // Card was declined
            return back()->with('error', 'Your card was declined: ' . $e->getMessage());
        } catch (Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly
            return back()->with('error', 'Too many requests. Please try again later.');
        } catch (Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API
            return back()->with('error', 'Invalid request. Please try again.');
        } catch (Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed
            return back()->with('error', 'Authentication failed. Please contact support.');
        } catch (Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed
            return back()->with('error', 'Network error. Please try again.');
        } catch (Stripe\Exception\ApiErrorException $e) {
            // Generic Stripe error
            return back()->with('error', 'Payment error: ' . $e->getMessage());
        } catch (Exception $e) {
            // Something else happened
            return back()->with('error', 'An unexpected error occurred. Please try again.');
        }
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

    // ARCHIVED - backup version
    // public function practiceareasBackup(Request $request)
    // {
	// 	return view('practiceareas_backup');
    // }
  
     public function case(Request $request)
    {
        $casequery 		= RecentCase::where('id', '!=', '')->where('status', '=', 1);
		$caseData 	    = $casequery->count();	//for all data
		$caselists		= $casequery->orderby('id','DESC')->paginate(9);
        return view('case', compact(['caselists', 'caseData']));
	}

    // ARCHIVED - experimental version
    // public function caseExperiment(Request $request)
    // {
    //     $casequery 		= RecentCase::where('id', '!=', '')->where('status', '=', 1);
	// 	$caseData 	    = $casequery->count();	//for all data
	// 	$caselists		= $casequery->orderby('id','DESC')->get();
    //     return view('case-experiment', compact(['caselists', 'caseData']));
	// }

    // ARCHIVED - unused duplicate method
    // public function caseNew(Request $request)
    // {
    //     $casequery 		= RecentCase::where('id', '!=', '')->where('status', '=', 1);
	// 	$caseData 	    = $casequery->count();	//for all data
	// 	$caselists		= $casequery->orderby('id','DESC')->get();
    //     return view('case-new', compact(['caselists', 'caseData']));
	// }

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

    // ARCHIVED - experimental case detail method
    // public function casedetailExperiment(Request $request, $slug = null)
    // {
    //     if(isset($slug) && !empty($slug)){
    //         if(RecentCase::where('slug', '=', $slug)->exists()) {
    //             $casedetailquery = RecentCase::where('slug', '=', $slug)->where('status', '=', 1);
    //             $casedetailists = $casedetailquery->first();

    //             return view('casedetail-experimental', compact(['casedetailists']));
    //         } else {
    //             return Redirect::to('/case')->with('error', 'Case'.Config::get('constants.not_exist'));
    //         }
    //     }
    //     else{
    //         return Redirect::to('/case')->with('error', Config::get('constants.unauthorized'));
    //     }
    // }
  
    //Practice area main page
    // ARCHIVED - backup version
    // public function familylaw(Request $request)
    // {
    //     $type = 'family-law';
	// 	if(CmsPage::where('slug', '=', $type)->exists()) {
    //         //for all data
    //         $pagequery 	= CmsPage::where('slug', '=', $type);
    //         $pagedata 	= $pagequery->first(); //dd($pagedata);
    //         //Get all its related pages
    //         if( isset($pagedata) &&  $pagedata->id != ""){
    //             $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
    //             $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
    //         }
    //         return view('practice_area', compact('type','pagedata','relatedpagedata'));
    //     }
    // }

    // Experimental Family Law using new template
    public function familylawExperiment(Request $request)
    {
        $type = 'family-law';
        if (CmsPage::where('slug', '=', $type)->exists()) {
            $pagequery = CmsPage::where('slug', '=', $type);
            $pagedata = $pagequery->first();
            if (isset($pagedata) && $pagedata->id != "") {
                $relatedpagequery = CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
                $relatedpagedata = $relatedpagequery->get();
            }
            return view('practice_area_experimental', compact('type','pagedata','relatedpagedata'));
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

    // Experimental Migration Law page using alternate Blade view
    public function migrationlawExperiment(Request $request)
    {
        $type = 'migration-law';
        if (CmsPage::where('slug', '=', $type)->exists()) {
            $pagequery = CmsPage::where('slug', '=', $type);
            $pagedata = $pagequery->first();
            if (isset($pagedata) && $pagedata->id != "") {
                $relatedpagequery = CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
                $relatedpagedata = $relatedpagequery->get();
            }
            return view('practice_area_experimental', compact('type','pagedata','relatedpagedata'));
        }
    }

    // ARCHIVED - backup version
    // public function criminallaw(Request $request)
    // {
    //     $type = 'criminal-law';
	// 	if(CmsPage::where('slug', '=', $type)->exists()) {
    //         //for all data
    //         $pagequery 	= CmsPage::where('slug', '=', $type);
    //         $pagedata 	= $pagequery->first(); //dd($pagedata);

    //         //Get all its related pages
    //         if( isset($pagedata) &&  $pagedata->id != ""){
    //             $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
    //             $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
    //         }
    //         return view('practice_area', compact('type','pagedata','relatedpagedata'));
    //     }
    // }

    // Experimental Criminal Law
    public function criminallawExperiment(Request $request)
    {
        $type = 'criminal-law';
        if (CmsPage::where('slug', '=', $type)->exists()) {
            $pagequery = CmsPage::where('slug', '=', $type);
            $pagedata = $pagequery->first();
            if (isset($pagedata) && $pagedata->id != "") {
                $relatedpagequery = CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
                $relatedpagedata = $relatedpagequery->get();
            }
            return view('practice_area_experimental', compact('type','pagedata','relatedpagedata'));
        }
    }

    // ARCHIVED - backup version
    // public function commerciallaw(Request $request)
    // {
    //     $type = 'commercial-law';
    //     if(CmsPage::where('slug', '=', $type)->exists()) {
    //         //for all data
    //         $pagequery 	= CmsPage::where('slug', '=', $type);
    //         $pagedata 	= $pagequery->first(); //dd($pagedata);

    //         //Get all its related pages
    //         if( isset($pagedata) &&  $pagedata->id != ""){
    //             $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
    //             $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
    //         }
    //         return view('practice_area', compact('type','pagedata','relatedpagedata'));
    //     }
    // }

    // Experimental Commercial Law
    public function commerciallawExperiment(Request $request)
    {
        $type = 'commercial-law';
        if (CmsPage::where('slug', '=', $type)->exists()) {
            $pagequery = CmsPage::where('slug', '=', $type);
            $pagedata = $pagequery->first();
            if (isset($pagedata) && $pagedata->id != "") {
                $relatedpagequery = CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
                $relatedpagedata = $relatedpagequery->get();
            }
            return view('practice_area_experimental', compact('type','pagedata','relatedpagedata'));
        }
    }

    // ARCHIVED - backup version
    // public function propertylaw(Request $request)
    // {
    //     $type = 'property-law';
    //     if(CmsPage::where('slug', '=', $type)->exists()) {
    //         //for all data
    //         $pagequery 	= CmsPage::where('slug', '=', $type);
    //         $pagedata 	= $pagequery->first(); //dd($pagedata);

    //         //Get all its related pages
    //         if( isset($pagedata) &&  $pagedata->id != ""){
    //             $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
    //             $relatedpagedata 	= $relatedpagequery->get(); //dd($relatedpagedata);
    //         }
    //         return view('practice_area', compact('type','pagedata','relatedpagedata'));
    //     }
    // }

    // Experimental Property Law
    public function propertylawExperiment(Request $request)
    {
        $type = 'property-law';
        if (CmsPage::where('slug', '=', $type)->exists()) {
            $pagequery = CmsPage::where('slug', '=', $type);
            $pagedata = $pagequery->first();
            if (isset($pagedata) && $pagedata->id != "") {
                $relatedpagequery = CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
                $relatedpagedata = $relatedpagequery->get();
            }
            return view('practice_area_experimental', compact('type','pagedata','relatedpagedata'));
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

    /**
     * Experimental Blog Listing Page
     */
    public function blogExperimental(Request $request)
    {
        // Optimized: Cache blog categories as they rarely change
        $blogCategories = Cache::remember('blog_categories', 3600, function () {
            return BlogCategory::where('status', 1)->orderBy('name', 'asc')->get();
        });
        
        $blogquery = Blog::where('status', '=', 1)->with(['categorydetail']);
        
        // Filter by category if provided - optimized query
        if ($request->has('category') && !empty($request->category)) {
            $categorySlug = $request->category;
            $category = $blogCategories->where('slug', $categorySlug)->first();
            if ($category) {
                $blogquery->where('parent_category', $category->id);
            }
        }
        
        // SEO-Optimized Pagination: 9 posts per page for optimal 3x3 grid
        $bloglists = $blogquery->orderby('id','DESC')->paginate(9);
        $blogData = $bloglists->total();
        
        // Get current page for SEO meta tags
        $currentPage = $bloglists->currentPage();
        $totalPages = $bloglists->lastPage();
        
        return view('blog-experimental', compact(['bloglists', 'blogData', 'blogCategories', 'currentPage', 'totalPages']));
    }
    
    /**
     * Experimental Blog Category Page
     */
    public function blogCategoryExperimental(Request $request, $categorySlug = null)
    {
        if (isset($categorySlug) && !empty($categorySlug)) {
            // Get category details
            $category = BlogCategory::where('slug', $categorySlug)->where('status', 1)->first();
            
            if (!$category) {
                return Redirect::to('/blog-experimental')->with('error', 'Category not found');
            }
            
            // Get blogs for this category with pagination
            $blogquery = Blog::where('status', '=', 1)
                ->where('parent_category', $category->id)
                ->with(['categorydetail']);
            
            // SEO-Optimized Pagination: 9 posts per page
            $bloglists = $blogquery->orderby('id','DESC')->paginate(9);
            $blogData = $bloglists->total();
            
            // Get all categories for filter
            $blogCategories = Cache::remember('blog_categories', 3600, function () {
                return BlogCategory::where('status', 1)->orderBy('name', 'asc')->get();
            });
            
            // Get current page for SEO meta tags
            $currentPage = $bloglists->currentPage();
            $totalPages = $bloglists->lastPage();
            
            return view('blog-experimental', compact(['bloglists', 'blogData', 'blogCategories', 'category', 'currentPage', 'totalPages']));
        }
        
        return Redirect::to('/blog-experimental')->with('error', 'Invalid category');
    }
    
    /**
     * Experimental Blog Detail Page
     */
    public function blogDetailExperimental(Request $request, $slug = null)
    {
        if(isset($slug) && !empty($slug)){
            // Optimized: Single query instead of exists() check first
            $blogdetailists = Blog::where('slug', '=', $slug)->where('status', '=', 1)->with(['categorydetail'])->first();
            
            if($blogdetailists) {
                // Optimized: Cache latest blogs with exclusion key
                $cacheKey = 'latest_blogs_exclude_' . $slug;
                $latestbloglists = Cache::remember($cacheKey, 1800, function () use ($slug) {
                    return Blog::where('status', 1)
                        ->where('slug', '!=', $slug)
                        ->latest()
                        ->take(5)
                        ->get();
                });
                
                // Get all categories for sidebar
                $blogCategories = Cache::remember('blog_categories', 3600, function () {
                    return BlogCategory::where('status', 1)->orderBy('name', 'asc')->get();
                });
                
                return view('blog-detail-experimental', compact(['blogdetailists','latestbloglists', 'blogCategories']));
            } else {
                return Redirect::to('/blog-experimental')->with('error', 'Blog not found');
            }
        } else {
            return Redirect::to('/blog-experimental')->with('error', 'Invalid blog URL');
        }
    }

}
