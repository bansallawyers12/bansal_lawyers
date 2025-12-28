<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;

use App\Models\WebsiteSetting;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\BlogCategory;
use App\Models\OurService;
use App\Models\Testimonial;
use App\Models\HomeContent;
use App\Models\CmsPage;
use App\Models\AppointmentPayment;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

use Stripe;
use App\Models\Enquiry;
use App\Models\RecentCase;
use App\Models\Appointment;
use App\Models\BookService;
use App\Models\BookServiceSlotPerPerson;
use App\Models\BookServiceDisableSlot;
use App\Models\Admin;
use App\Models\NatureOfEnquiry;

class HomeController extends Controller
{
	public function __construct(Request $request)
    {
		$siteData = Cache::remember('site_data', 3600, function () {
			return WebsiteSetting::first();
		});
		View::share('siteData', $siteData);
	}

    public function coming_soon()
    {
        return view('coming_soon');
    }

	/**
	 * Generate CAPTCHA image
	 * Modernized GD library implementation with improved error handling and structure
	 * 
	 * Note: While functional, consider migrating to modern CAPTCHA solutions like Google reCAPTCHA
	 * which is already used elsewhere in this application.
	 * 
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function sicaptcha(Request $request)
    {
		$request->validate([
			'code' => 'required|string|max:10'
		]);
		
		// Check if GD extension is available
		if (!extension_loaded('gd')) {
			Log::error('GD extension not available for CAPTCHA generation');
			abort(500, 'Image generation service unavailable');
		}
		
		$code = $request->input('code');
		
		// Image dimensions
		$width = 50;
		$height = 24;
		
		// Color definitions (RGB)
		$backgroundColor = [37, 37, 37];   // Dark gray background
		$textColor = [255, 241, 70];        // Yellow text
		
		try {
			// Create image resource
			$image = imagecreatetruecolor($width, $height);
			
			if ($image === false) {
				throw new \RuntimeException('Failed to create image resource');
			}
			
			// Allocate colors
			$bgColor = imagecolorallocate($image, $backgroundColor[0], $backgroundColor[1], $backgroundColor[2]);
			$fgColor = imagecolorallocate($image, $textColor[0], $textColor[1], $textColor[2]);
			
			if ($bgColor === false || $fgColor === false) {
				imagedestroy($image);
				throw new \RuntimeException('Failed to allocate colors');
			}
			
			// Fill background
			imagefill($image, 0, 0, $bgColor);
			
			// Add text using built-in font (font size 5)
			// imagestring($image, font, x, y, string, color)
			imagestring($image, 5, 5, 5, $code, $fgColor);
			
			// Capture image output
			ob_start();
			$success = imagepng($image);
			$imageData = ob_get_clean();
			
			// Clean up
			imagedestroy($image);
			
			if (!$success || empty($imageData)) {
				throw new \RuntimeException('Failed to generate image data');
			}
			
			// Return response with proper headers
			return response($imageData, 200)
				->header('Content-Type', 'image/png')
				->header('Cache-Control', 'no-cache, must-revalidate, max-age=0')
				->header('Pragma', 'no-cache')
				->header('Expires', '0');
				
		} catch (\Exception $e) {
			Log::error('CAPTCHA generation failed: ' . $e->getMessage(), [
				'code' => $code,
				'trace' => $e->getTraceAsString()
			]);
			
			// Return a simple error image or abort
			abort(500, 'Failed to generate CAPTCHA image');
		}
    }

    public static function hextorgb ($hexstring){
        $integar = hexdec($hexstring);
                    return [ "red" => 0xFF & ($integar >> 0x10),
        "green" => 0xFF & ($integar >> 0x8),
        "blue" => 0xFF & $integar
        ];
    }

	public function Page(Request $request, $slug= null)
    {
		// Optimized: Single query to find the page type instead of multiple exists() checks
		
		// Check RecentCase first
		$casedetailists = RecentCase::where('slug', '=', $slug)->where('status', '=', 1)->first();
		if($casedetailists) {
			return view('casedetail', compact('casedetailists'));
		}
		
		// Check Blog
		$blogdetailists = Blog::where('slug', '=', $slug)->where('status', '=', 1)->with(['categorydetail'])->first();
		if($blogdetailists) {
			// Cache latest blogs for better performance (exclude current blog)
			$cacheKey = 'latest_blogs_exclude_' . $slug;
			$latestbloglists = Cache::remember($cacheKey, 1800, function () use ($slug) {
				return Blog::where('status', 1)
					->where('slug', '!=', $slug)
					->latest()
					->take(5)
					->get();
			});
			return view('blogdetail', compact('blogdetailists', 'latestbloglists'));
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
				return view('Frontend.cms.index_inner', compact('pagedata'));
			} else {
				return view('Frontend.cms.index', compact('pagedata'));
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
		
        return view('index', compact('bloglists', 'blogData'));
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
        $fromAddress = config('mail.from.address');
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
          'subject'=>$request->subject,
          'fullname' => $request->name,
          'from' =>$request->name,
          'email'=> $request->email,
          'phone' => $request->phone,
          'description' => $request->message
        ];

        Mail::to($fromAddress)->send(new \App\Mail\ContactUsMail($details));
       

        return back()->with('success', 'Thanks for sharing your interest. our team will respond to you with in 24 hours.');
	}

    /**
     * Unified contact form submission handler
     */
    public function contactSubmit(Request $request)
    {
        try {
            // Check if it's floating contact button form
            $isFloatingButton = $request->form_source === 'floating_contact_button';
            
            $request->validate([
                'name' => $isFloatingButton ? 'nullable|string|max:255' : 'required|string|max:255',
                'email' => $isFloatingButton ? 'nullable|email|max:255' : 'required|email|max:255',
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

            // Use defaults for floating button if name/email not provided
            $name = $request->name ?? 'Quick Contact Request';
            $email = $request->email ?? 'quickcontact@floating-button.local';

            // Save to Contact model
            $contact = new Contact;
            $contact->name = $name;
            $contact->contact_email = $email;
            $contact->contact_phone = $request->phone;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();

            // Save to Enquiry model
            $enquiry = new Enquiry;
            $enquiry->first_name = $name;
            $enquiry->email = $email;
            $enquiry->phone = $request->phone;
            $enquiry->subject = $request->subject;
            $enquiry->message = $request->message;
            $enquiry->save();

            // Send email notification (wrap in try-catch so email failure doesn't break submission)
            try {
                $fromAddress = config('mail.from.address');
                $subject = 'New Contact Form Submission from ' . $name;
                $details = [
                    'title' => $subject,
                    'body' => 'You have received a new contact form submission.',
                    'subject' => $request->subject,
                    'fullname' => $name,
                    'from' => $name,
                    'email' => $email,
                    'phone' => $request->phone,
                    'description' => $request->message
                ];

                Mail::to($fromAddress)->send(new \App\Mail\ContactUsMail($details));
            } catch (\Exception $mailException) {
                // Log email error but don't fail the submission
                Log::warning('Contact form email sending failed: ' . $mailException->getMessage());
            }

            // Return response based on request type
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you! Your message has been sent successfully. We\'ll get back to you within 24 hours.',
                    'redirect' => route('contact.thankyou')
                ]);
            }

            // Redirect to thank you page for non-AJAX requests
            return redirect()->route('contact.thankyou')->with('success', 'Thank you! Your message has been sent successfully. We\'ll get back to you within 24 hours.');

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
            Log::error('Contact form submission error: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, there was an error sending your message. Please try again.'
                ], 500);
            }
            
            return back()->with('error', 'Sorry, there was an error sending your message. Please try again.');
        }
    }


	public function ourservices(Request $request)
    {
		$servicequery 		= OurService::where('status', '=', 1);
		$serviceData 	= 	$servicequery->count();	//for all data
		$servicelists		=  $servicequery->orderby('id','ASC')->get();

	   return view('ourservices', compact('servicelists', 'serviceData'));
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
		
        return view('bloglatest', compact('bloglists', 'blogData', 'blogCategories', 'currentPage', 'totalPages'));
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
                
                return view('bloglatest', compact('bloglists', 'blogData', 'blogCategories', 'category', 'currentPage', 'totalPages'));
            } else {
                return redirect('/blog')->with('error', 'Category not found');
            }
        } else {
            return redirect('/blog')->with('error', 'Invalid category');
        }
    }
  
	/**
     * Blog Detail Page
     * URL: /blog/{slug}
     * Handles individual blog post display with related posts and categories
     */
	public function blogdetail(Request $request, $slug = null)
    {
		if(!isset($slug) || empty($slug)){
            return redirect('/blog')->with('error', 'Blog not found');
        }

        // Find the blog post
        $blogdetailists = Blog::where('slug', '=', $slug)
            ->where('status', '=', 1)
            ->with(['categorydetail'])
            ->first();
            
        if(!$blogdetailists) {
            abort(404, 'Blog post not found');
        }
        
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
        
        return view('blogdetail', compact('blogdetailists', 'latestbloglists', 'blogCategories'));
    }
  
	public function servicesdetail(Request $request, $slug = null)
    {
		if(isset($slug) && !empty($slug)){
			if(OurService::where('slug', '=', $slug)->exists())
			{
			$servicesdetailquery 		= OurService::where('slug', '=', $slug)->where('status', '=', 1);
			$servicesdetailists		=  $servicesdetailquery->first();

			return view('servicesdetail', compact('servicesdetailists'));
			}
			else
			{
				return redirect('/ourservices')->with('error', 'Our Services'.config('constants.not_exist'));
			}
		}
		else{
			return redirect('/ourservices')->with('error', config('constants.unauthorized'));
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
            
            $bookservice = BookService::where('id', $req_service_id)->first();
            if (!$bookservice) {
                return response()->json(['success' => false, 'message' => 'Service not found']);
            }
            
            $service = BookServiceSlotPerPerson::where('person_id', $person_id)->where('service_type', $service_type)->first();
            
            if ($service) {
                $weekendd = [];
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
                $disabledatesarray = [];
                if ($service->disabledates != '') {
                    if (str_contains($service->disabledates, ',')) {
                        $disabledatesArr = explode(',', $service->disabledates);
                        $disabledatesarray = array_map('trim', $disabledatesArr);
                    } else {
                        $disabledatesarray = [trim($service->disabledates)];
                    }
                }

                // Fetch blocked dates from BookServiceDisableSlot table (for full day blocks)
                $book_service_slot_per_person_id = $service->id ?? 1; // Default to 1 for Ajay
                $blockedSlots = BookServiceDisableSlot::select('disabledates', 'block_all')
                    ->where('book_service_slot_per_person_id', $book_service_slot_per_person_id)
                    ->where('block_all', 1) // Only full day blocks
                    ->get();
                
                // Convert blocked dates to DD/MM/YYYY format and add to disabledatesarray
                foreach ($blockedSlots as $blockedSlot) {
                    if ($blockedSlot->disabledates) {
                        try {
                            // Handle both Carbon instance (from model cast) and string formats
                            $dateObj = $blockedSlot->disabledates instanceof \Carbon\Carbon 
                                ? $blockedSlot->disabledates 
                                : \Carbon\Carbon::parse($blockedSlot->disabledates);
                            $formattedDate = $dateObj->format('d/m/Y');
                            // Avoid duplicates
                            if (!in_array($formattedDate, $disabledatesarray)) {
                                $disabledatesarray[] = $formattedDate;
                            }
                        } catch (\Exception $e) {
                            // Skip invalid dates and log error
                            Log::warning('Invalid blocked date skipped: ' . $blockedSlot->disabledates);
                        }
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
            Log::error('getdatetime error: ' . $e->getMessage());
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
            if (str_contains($selDate, '-')) {
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
            
            // Check for existing appointments on this date with active nature of enquiry
            $servicelist = Appointment::select('id', 'date', 'time')
                ->where('status', '!=', 7)
                ->whereDate('date', $datey)
                ->where('service_id', 1)
                ->whereHas('natureOfEnquiry', function($query) {
                    $query->where('status', 1);
                })
                ->get();

            $disabledtimeslotes = [];
            
            // Add existing appointment times to disabled slots
            if ($servicelist->isNotEmpty()) {
                foreach($servicelist as $list) {
                    $disabledtimeslotes[] = date('g:i A', strtotime($list->time));
                }
            }
            
            // Get manually disabled slots from BookServiceDisableSlot table
            $disabled_slot_arr = BookServiceDisableSlot::select('id','slots', 'block_all')
                ->where('book_service_slot_per_person_id', $book_service_slot_per_person_tbl_unique_id)
                ->whereDate('disabledates', $datey)
                ->get();
                
            if ($disabled_slot_arr->isNotEmpty()) {
                foreach ($disabled_slot_arr as $disabledSlot) {
                    // Skip full day blocks (block_all = 1) - these are handled in the calendar view
                    if ($disabledSlot->block_all == 1) {
                        continue;
                    }
                    
                    if (!empty($disabledSlot->slots)) {
                        // Check if it's a time range (format: "09:00-17:00") or comma-separated list
                        if (strpos($disabledSlot->slots, '-') !== false && substr_count($disabledSlot->slots, '-') === 1) {
                            // Time range format - generate 30-minute slots
                            $parts = explode('-', $disabledSlot->slots);
                            $startTime = trim($parts[0]);
                            $endTime = trim($parts[1]);
                            
                            // Parse times and generate 30-minute intervals
                            $start = strtotime($startTime);
                            $end = strtotime($endTime);
                            
                            if ($start !== false && $end !== false && $start < $end) {
                                $current = $start;
                                while ($current < $end) {
                                    // Format as 'g:i A' (e.g., '9:00 AM')
                                    $disabledtimeslotes[] = date('g:i A', $current);
                                    $current = strtotime('+30 minutes', $current);
                                }
                            }
                        } else {
                            // Comma-separated format (backward compatibility)
                            $newArray = explode(",", $disabledSlot->slots);
                            $newArray = array_map('trim', $newArray);
                            $newArray = array_filter($newArray); // Remove empty values
                            $disabledtimeslotes = array_merge($disabledtimeslotes, $newArray);
                        }
                    }
                }
            }
            
            return response()->json([
                'success' => true, 
                'disabledtimeslotes' => $disabledtimeslotes
            ]);
            
        } catch (\Exception $e) {
            Log::error('getdisableddatetime error: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Server error occurred',
                'disabledtimeslotes' => []
            ]);
        }
    }



    

	

	public function stripe($appointmentId)
    {
        $appointmentInfo = Appointment::find($appointmentId);
        if($appointmentInfo){
            $adminInfo = Admin::find($appointmentInfo->client_id);
        } else {
            $adminInfo = [];
        }
        return view('stripe', compact('appointmentId', 'appointmentInfo', 'adminInfo'));
    }

   public function stripePost(Request $request)
    {
        // Fetch appointment data early so it's available for failure scenarios
        $appointment = null;
        $appointment_id = null;
        
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

            // Fetch appointment data early for use in failure scenarios
            $appointment = Appointment::find($appointment_id);

            Stripe\Stripe::setApiKey(config('services.stripe.secret') ?? env('STRIPE_SECRET'));

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
                $appointment_status = 10; // Pending Appointment With Payment Success
                
                // Get appointment to find the correct order_hash
                $appointment = Appointment::find($appointment_id);
                $appointmentOrderHash = $appointment ? $appointment->order_hash : null;
                
                // Find existing payment record by appointment's order_hash
                $paymentRecord = null;
                if ($appointmentOrderHash) {
                    $paymentRecord = AppointmentPayment::where('order_hash', $appointmentOrderHash)->first();
                }
                
                // If not found by order_hash, try to find by appointment_id if there's a relationship
                // Otherwise create/update using the payment intent ID as order_hash
                $finalOrderHash = $appointmentOrderHash ?: ($stripe_payment_intent_id . '_' . $appointment_id);
                
                if ($paymentRecord) {
                    // Update existing payment record
                    $paymentRecord->update([
                        'stripe_payment_intent_id' => $stripe_payment_intent_id,
                        'payment_status' => $payment_status,
                        'order_status' => $order_status,
                        'stripe_payment_status' => $payment_intent->status,
                        'stripe_payment_response' => $payment_intent->toArray()
                    ]);
                    Log::info('Updated existing payment record ID: ' . $paymentRecord->id);
                } else {
                    // Create new payment record if not found
                    $paymentRecord = AppointmentPayment::create([
                        'order_hash' => $finalOrderHash,
                        'payer_email' => $email,
                        'amount' => $amount,
                        'currency' => $currency,
                        'payment_type' => $payment_type,
                        'order_date' => $order_date,
                        'name' => $cardName,
                        'stripe_payment_intent_id' => $stripe_payment_intent_id,
                        'payment_status' => $payment_status,
                        'order_status' => $order_status,
                        'stripe_payment_status' => $payment_intent->status,
                        'stripe_payment_response' => $payment_intent->toArray()
                    ]);
                    Log::info('Created new payment record ID: ' . $paymentRecord->id);
                }
                
                // Update appointment status and order_hash if needed
                $updateData = ['status' => $appointment_status];
                if (!$appointmentOrderHash) {
                    $updateData['order_hash'] = $finalOrderHash;
                }
                DB::table('appointments')->where('id', $appointment_id)->update($updateData);
                
                // Send confirmation emails after successful payment
                if ($appointment) {
                    // Get service and NatureOfEnquiry data
                    $service = BookService::find($appointment->service_id);
                    $NatureOfEnquiry = NatureOfEnquiry::find($appointment->noe_id);
                    
                    // Prepare request data for email function
                    $requestData = [
                        'date' => $appointment->date,
                        'time' => $appointment->timeslot_full ?? $appointment->time,
                        'appointment_details' => $appointment->appointment_details ?? ''
                    ];
                    
                    // Send confirmation emails after successful payment
                    $appointmentController = new \App\Http\Controllers\AppointmentBookController();
                    $emailResults = $appointmentController->sendAppointmentEmails(
                        $appointment->full_name,
                        $appointment->email,
                        $appointment->phone,
                        $requestData,
                        $service,
                        $NatureOfEnquiry,
                        $appointment->description ?? '',
                        $appointment->id
                    );
                    
                    // Log email results
                    if (!$emailResults['admin_email_sent']) {
                        Log::error('Admin email failed to send after payment', [
                            'appointment_id' => $appointment->id,
                            'error' => $emailResults['admin_email_error']
                        ]);
                    }
                    
                    if (!$emailResults['customer_email_sent']) {
                        Log::error('Customer confirmation email failed to send after payment', [
                            'appointment_id' => $appointment->id,
                            'customer_email' => $appointment->email,
                            'error' => $emailResults['customer_email_error']
                        ]);
                    }
                }
                
                // Redirect to Thank You page with appointment data
                return redirect()->route('payment.thankyou', ['appointmentId' => $appointment_id]);
            } else {
                // Payment failed - send admin pending payment email
                $this->sendAdminPendingPaymentEmailOnFailure($appointment, $appointment_id);
                
                return back()->with('error', 'Payment failed. Please try again.');
            }
        } catch (Stripe\Exception\CardException $e) {
            // Card was declined - send admin pending payment email
            if (!$appointment_id) {
                $appointment_id = $request->input('appointment_id');
            }
            $this->sendAdminPendingPaymentEmailOnFailure($appointment, $appointment_id);
            
            return back()->with('error', 'Your card was declined: ' . $e->getMessage());
        } catch (Stripe\Exception\RateLimitException $e) {
            // Too many requests made to the API too quickly - send admin pending payment email
            if (!$appointment_id) {
                $appointment_id = $request->input('appointment_id');
            }
            $this->sendAdminPendingPaymentEmailOnFailure($appointment, $appointment_id);
            
            return back()->with('error', 'Too many requests. Please try again later.');
        } catch (Stripe\Exception\InvalidRequestException $e) {
            // Invalid parameters were supplied to Stripe's API - send admin pending payment email
            if (!$appointment_id) {
                $appointment_id = $request->input('appointment_id');
            }
            $this->sendAdminPendingPaymentEmailOnFailure($appointment, $appointment_id);
            
            return back()->with('error', 'Invalid request. Please try again.');
        } catch (Stripe\Exception\AuthenticationException $e) {
            // Authentication with Stripe's API failed - send admin pending payment email
            if (!$appointment_id) {
                $appointment_id = $request->input('appointment_id');
            }
            $this->sendAdminPendingPaymentEmailOnFailure($appointment, $appointment_id);
            
            return back()->with('error', 'Authentication failed. Please contact support.');
        } catch (Stripe\Exception\ApiConnectionException $e) {
            // Network communication with Stripe failed - send admin pending payment email
            if (!$appointment_id) {
                $appointment_id = $request->input('appointment_id');
            }
            $this->sendAdminPendingPaymentEmailOnFailure($appointment, $appointment_id);
            
            return back()->with('error', 'Network error. Please try again.');
        } catch (Stripe\Exception\ApiErrorException $e) {
            // Generic Stripe error - send admin pending payment email
            if (!$appointment_id) {
                $appointment_id = $request->input('appointment_id');
            }
            $this->sendAdminPendingPaymentEmailOnFailure($appointment, $appointment_id);
            
            return back()->with('error', 'Payment error: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Something else happened - send admin pending payment email
            if (!$appointment_id) {
                $appointment_id = $request->input('appointment_id');
            }
            $this->sendAdminPendingPaymentEmailOnFailure($appointment, $appointment_id);
            
            return back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function paymentThankYou($appointmentId = null)
    {
        $appointment = null;
        if ($appointmentId) {
            $appointment = Appointment::find($appointmentId);
        }
        
        return view('payment-thankyou', compact('appointment'));
    }

    /**
     * Contact form thank you page
     */
    public function contactThankYou()
    {
        return view('contact-thankyou');
    }

    public function search_result(Request $request)
    {
        if ( isset($request->search) &&  $request->search != "" ) {
            $search_string 	= $request->search;
        } else {
            $search_string 	= 'search_string';
        }
        $query 	= CmsPage::where('title', 'LIKE', '%'.$search_string.'%')
        ->orWhere('slug', 'LIKE', '%' . $search_string . '%')
        ->orWhere('meta_title', 'LIKE', '%' . $search_string . '%')
        ->orWhere('meta_keyward', 'LIKE', '%' . $search_string . '%');

        $totalData 	= $query->count();
        $lists	= $query->sortable(['id' => 'desc'])->paginate(20);
        return view('searchresults', compact('lists', 'totalData'));
    }
  
  
    public function practiceareas(Request $request)
    { 
		return view('practiceareas');
    }

     public function case(Request $request)
    {
        $casequery 		= RecentCase::where('status', '=', 1);
		$caseData 	    = $casequery->count();	//for all data
		$caselists		= $casequery->orderby('id','DESC')->paginate(9);
        return view('case', compact('caselists', 'caseData'));
	}

    public function casedetail(Request $request, $slug = null)
    {
		if(isset($slug) && !empty($slug)){
			if(RecentCase::where('slug', '=', $slug)->exists()) {
			    $casedetailquery 	= RecentCase::where('slug', '=', $slug)->where('status', '=', 1);
			    $casedetailists		=  $casedetailquery->first();

                return view('casedetail', compact('casedetailists'));
			} else {
				return redirect('/case')->with('error', 'Case'.config('constants.not_exist'));
			}
		}
		else{
			return redirect('/case')->with('error', config('constants.unauthorized'));
		}
    }

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
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    public function migrationlaw(Request $request)
    {
        $type = 'migration-law';
		if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')->where('service_cat_id', '=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
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
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

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
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

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
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

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
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }
  
  
     //Practice area inner page
    public function divorce(Request $request)
    {
        $type = 'divorce';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    public function childcustody(Request $request)
    {
        $type = 'child-custody';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    public function familyviolence(Request $request)
    {
        $type = 'family-violence';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    public function propertysettlement(Request $request)
    {
        $type = 'property-settlement';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    public function familyviolenceorders(Request $request)
    {
        $type = 'family-violence-orders';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }
  
  
  
     public function juridicationalerrorfederalcircuitcourtapplication(Request $request)
    {
        $type = 'juridicational-error-federal-circuit-court-application';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }


    public function artapplication(Request $request)
    {
        $type = 'art-application';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }


    public function visarefusalsvisacancellation(Request $request)
    {
        $type = 'visa-refusals-visa-cancellation';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    public function federalcourtapplication(Request $request)
    {
        $type = 'federal-court-application';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }
  
  
  
     public function intervenitionorders(Request $request)
    {
        $type = 'intervenition-orders';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }


    public function traficoffences(Request $request)
    {
        $type = 'trafic-offences';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    public function drinkdrivingoffences(Request $request)
    {
        $type = 'drink-driving-offences';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    public function assualtcharges(Request $request)
    {
        $type = 'assualt-charges';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }
  
  
    
    public function businesslaw(Request $request)
    {
        $type = 'business-law';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }


    public function leasingorsellingabusiness(Request $request)
    {
        $type = 'leasing-or-selling-a-business';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    public function contractsorbusinessagreements(Request $request)
    {
        $type = 'contracts-or-business-agreements';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    public function loanagreement(Request $request)
    {
        $type = 'loan-agreement';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }
  
  
    public function conveyancing(Request $request)
    {
        $type = 'conveyancing';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    public function buildingandconstructiondisputes(Request $request)
    {
        $type = 'building-and-construction-disputes';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    public function caveatsdisputsandremoval(Request $request)
    {
        $type = 'caveats-disputs-and-removal';
        if(CmsPage::where('slug', '=', $type)->exists()) {
            //for all data
            $pagequery 	= CmsPage::where('slug', '=', $type);
            $pagedata 	= $pagequery->first();
            //Get all its related pages
            if( isset($pagedata) &&  $pagedata->id != ""){
                $relatedpagequery 	= CmsPage::select('id','service_type','service_cat_id','title','image','image_alt','slug')
                                    ->where('service_cat_id', '=', $pagedata->service_cat_id)
                                    ->where('id', '!=', $pagedata->id);
                $relatedpagedata 	= $relatedpagequery->get();
            }
            return view('practice_area', compact('type','pagedata','relatedpagedata'));
        }
        abort(404, 'Page not found');
    }

    /**
     * Validate reCAPTCHA response
     */
    private function validateRecaptcha(Request $request): bool|\Illuminate\Http\RedirectResponse
    {
        $recaptcha_response = $request->input('g-recaptcha-response');
        
        // Allow bypass for floating contact button
        if ($recaptcha_response === 'floating-button-bypass' && 
            $request->input('form_source') === 'floating_contact_button') {
            return true;
        }
        
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
     * Blog Listing Page
     * Uses query parameters for pagination and filtering
     * URLs: /blog, /blog?page=2, /blog?category=slug
     */
    public function blogExperimental(Request $request)
    {
        // Optimized: Cache blog categories as they rarely change
        $blogCategories = Cache::remember('blog_categories', 3600, function () {
            return BlogCategory::where('status', 1)->orderBy('name', 'asc')->get();
        });
        
        $blogquery = Blog::where('status', '=', 1)->with(['categorydetail']);
        
        // Filter by category if provided - using query parameter
        if ($request->has('category') && !empty($request->category)) {
            $categorySlug = $request->category;
            $category = $blogCategories->where('slug', $categorySlug)->first();
            if ($category) {
                $blogquery->where('parent_category', $category->id);
            }
        }
        
        // SEO-Optimized Pagination: 9 posts per page for optimal 3x3 grid
        $bloglists = $blogquery->orderby('id','DESC')->paginate(9);
        
        // Set custom path for pagination URLs
        $bloglists->setPath('/blog');
        $bloglists->appends($request->except('page'));
        
        $blogData = $bloglists->total();
        
        // Get current page for SEO meta tags
        $currentPage = $bloglists->currentPage();
        $totalPages = $bloglists->lastPage();
        
        return view('blog', compact('bloglists', 'blogData', 'blogCategories', 'currentPage', 'totalPages'));
    }
    
    /**
     * Blog Category Page
     * URL: /blog/category/{categorySlug}
     * Handles blog category filtering for the new blog system
     */
    public function blogCategoryExperimental(Request $request, $categorySlug = null)
    {
        // Redirect all category pages to main blog (SEO: prevent duplicate content)
        // Categories are not used, so consolidate all URLs to /blog
        return redirect('https://www.bansallawyers.com.au/blog', 301);
    }
    
    
    /**
     * Unified Slug Handler - Handles CMS Pages
     * NOTE: Blog posts are now handled by /blog/{slug} route
     */
    public function unifiedSlugHandler(Request $request, $slug = null)
    {
        if(!isset($slug) || empty($slug)){
            return redirect('/')->with('error', 'Page not found');
        }

        // Handle CMS pages only
        return $this->Page($request, $slug);
    }

    /**
     * Send admin pending payment email when Stripe payment fails
     * 
     * @param object|null $appointment
     * @param int|null $appointment_id
     * @return void
     */
    private function sendAdminPendingPaymentEmailOnFailure($appointment, $appointment_id)
    {
        try {
            if (!$appointment && $appointment_id) {
                $appointment = Appointment::find($appointment_id);
            }
            
            if (!$appointment) {
                Log::warning('Cannot send pending payment email - appointment not found', [
                    'appointment_id' => $appointment_id
                ]);
                return;
            }
            
            // Get service and NatureOfEnquiry data
            $service = BookService::find($appointment->service_id);
            $NatureOfEnquiry = NatureOfEnquiry::find($appointment->noe_id);
            
            if (!$service) {
                Log::warning('Cannot send pending payment email - service not found', [
                    'appointment_id' => $appointment_id,
                    'service_id' => $appointment->service_id
                ]);
                return;
            }
            
            // Prepare request data for email function (matching format expected by sendAdminPendingPaymentEmail)
            $requestData = [
                'date' => $appointment->date,
                'time' => $appointment->timeslot_full ?? $appointment->time,
                'appointment_details' => $appointment->appointment_details ?? ''
            ];
            
            // Send admin pending payment email
            $appointmentController = new \App\Http\Controllers\AppointmentBookController();
            $appointmentController->sendAdminPendingPaymentEmail(
                $appointment->full_name,
                $appointment->email,
                $appointment->phone,
                $requestData,
                $service,
                $NatureOfEnquiry,
                $appointment->description ?? '',
                $appointment->id
            );
            
        } catch (\Exception $e) {
            // Log error but don't throw - we don't want email failures to break the payment flow
            Log::error('Failed to send admin pending payment email on payment failure', [
                'appointment_id' => $appointment_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

}
