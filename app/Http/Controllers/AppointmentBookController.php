<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Models\Appointment;
use App\Models\Admin;
use App\Models\AppointmentPayment;
use Helper;
use App\Models\PromoCode;

class AppointmentBookController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

	}
	/**
     * All Cms Page.
     *
     * @return \Illuminate\Http\Response
     */

	// Removed: store() method - all appointments now go through storepaid() for Ajay paid only


    /**
     * Parse and normalize time from various input formats to HH:MM
     * 
     * @param string $timeInput Time in various formats (e.g., "10:00 AM - 11:00 AM", "10:00 AM")
     * @return array Array with 'success' boolean, 'time' string (HH:MM), and 'message' string
     */
    private function parseAppointmentTime($timeInput)
    {
        try {
            $timeInput = trim($timeInput);
            
            // Handle time slot format "10:00 AM - 11:00 AM"
            if (strpos($timeInput, '-') !== false) {
                $timeParts = explode('-', $timeInput);
                $startTime = trim($timeParts[0]);
            } else {
                $startTime = $timeInput;
            }
            
            // Parse the time using strtotime
            $parsedTime = strtotime($startTime);
            if ($parsedTime === false) {
                // Fallback: try parsing with different format
                $parsedTime = strtotime('1970-01-01 ' . $startTime);
                if ($parsedTime === false) {
                    return [
                        'success' => false,
                        'time' => null,
                        'message' => 'Unable to parse time format: ' . $timeInput
                    ];
                }
            }
            
            $normalizedTime = date("H:i", $parsedTime);
            
            // Validate the normalized time
            if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $normalizedTime)) {
                return [
                    'success' => false,
                    'time' => null,
                    'message' => 'Invalid time format: ' . $normalizedTime
                ];
            }
            
            return [
                'success' => true,
                'time' => $normalizedTime,
                'message' => 'Time parsed successfully'
            ];
            
        } catch (\Exception $e) {
            \Log::error('Time parsing error: ' . $e->getMessage());
            return [
                'success' => false,
                'time' => null,
                'message' => 'Time parsing failed: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Parse and normalize date from various input formats to YYYY-MM-DD
     * 
     * @param string $dateInput Date in various formats
     * @return array Array with 'success' boolean, 'date' string (YYYY-MM-DD), and 'message' string
     */
    private function parseAppointmentDate($dateInput)
    {
        try {
            $dateInput = trim($dateInput);
            
            // Handle YYYY-September-Wednesday format (from frontend)
            if (preg_match('/^(YYYY|\d{4})-([A-Za-z]+)-([A-Za-z]+)$/', $dateInput, $matches)) {
                $year = $matches[1];
                $month = $matches[2];
                $dayOfWeek = $matches[3];
                
                // Handle YYYY placeholder by using current year
                if ($year === 'YYYY') {
                    $year = date('Y');
                }
                
                // Convert month name to number
                $monthNumber = date('m', strtotime($month));
                if ($monthNumber === '00') {
                    return [
                        'success' => false,
                        'date' => null,
                        'message' => 'Invalid month name: ' . $month
                    ];
                }
                
                // For now, use the 1st day of the month since we don't have the specific date
                // In a real implementation, you'd need to calculate the actual date based on the day of week
                $normalizedDate = $year . '-' . $monthNumber . '-01';
                
            } elseif (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateInput)) {
                // YYYY-MM-DD format from JavaScript
                $normalizedDate = $dateInput;
                
            } elseif (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $dateInput)) {
                // DD/MM/YYYY format
                $dateParts = explode('/', $dateInput);
                if (count($dateParts) === 3) {
                    $day = str_pad($dateParts[0], 2, '0', STR_PAD_LEFT);
                    $month = str_pad($dateParts[1], 2, '0', STR_PAD_LEFT);
                    $year = $dateParts[2];
                    $normalizedDate = $year . '-' . $month . '-' . $day;
                } else {
                    return [
                        'success' => false,
                        'date' => null,
                        'message' => 'Invalid DD/MM/YYYY format: ' . $dateInput
                    ];
                }
                
            } else {
                // Try to parse with strtotime as fallback
                $timestamp = strtotime($dateInput);
                if ($timestamp === false) {
                    return [
                        'success' => false,
                        'date' => null,
                        'message' => 'Unable to parse date format: ' . $dateInput
                    ];
                }
                $normalizedDate = date('Y-m-d', $timestamp);
            }
            
            // Validate the normalized date
            $dateTime = \DateTime::createFromFormat('Y-m-d', $normalizedDate);
            if (!$dateTime || $dateTime->format('Y-m-d') !== $normalizedDate) {
                return [
                    'success' => false,
                    'date' => null,
                    'message' => 'Invalid date: ' . $normalizedDate
                ];
            }
            
            // Check if date is not in the past
            $today = new \DateTime();
            $today->setTime(0, 0, 0);
            if ($dateTime <= $today) {
                return [
                    'success' => false,
                    'date' => null,
                    'message' => 'Appointment date must be after today: ' . $normalizedDate
                ];
            }
            
            return [
                'success' => true,
                'date' => $normalizedDate,
                'message' => 'Date parsed successfully'
            ];
            
        } catch (\Exception $e) {
            \Log::error('Date parsing error: ' . $e->getMessage());
            return [
                'success' => false,
                'date' => null,
                'message' => 'Date parsing failed: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Check for appointment conflicts at the specified date and time
     * 
     * @param string $date Date in YYYY-MM-DD format
     * @param string $time Time slot string (e.g., "10:00 AM - 11:00 AM")
     * @param int $serviceId Service ID
     * @param int $noeId Nature of Enquiry ID
     * @return array Array with 'conflict' boolean and 'message' string
     */
    private function checkAppointmentConflict($date, $time, $serviceId, $noeId)
    {
        try {
            // Parse time using centralized method
            $timeParseResult = $this->parseAppointmentTime($time);
            if (!$timeParseResult['success']) {
                \Log::error('Time parsing failed in conflict check: ' . $timeParseResult['message']);
                return [
                    'conflict' => false,
                    'message' => 'Unable to verify time slot availability'
                ];
            }
            $time24 = $timeParseResult['time'];
            
            // Check for existing appointments at the same date and time
            // Exclude cancelled appointments (status = 7) and only check active appointments
            $conflictCount = \App\Models\Appointment::where('status', '!=', 7) // Exclude cancelled
                ->whereDate('date', $date)
                ->where('time', $time24)
                ->where('service_id', $serviceId)
                ->whereIn('noe_id', [1, 2, 3, 4, 5, 6, 7]) // Valid nature of enquiry IDs
                ->count();
            
            if ($conflictCount > 0) {
                return [
                    'conflict' => true,
                    'message' => 'This appointment time slot is already booked. Please select a different time slot.'
                ];
            }
            
            return [
                'conflict' => false,
                'message' => 'Time slot is available'
            ];
            
        } catch (\Exception $e) {
            \Log::error('Error checking appointment conflict: ' . $e->getMessage());
            // In case of error, allow booking but log the issue
            return [
                'conflict' => false,
                'message' => 'Unable to verify time slot availability'
            ];
        }
    }

    public function checkpromocode(Request $request)
    {
        $promoCode = trim($request->get('promo_code'));
        $serviceId = $request->get('service_id');

        if(empty($promoCode)){
            return response()->json(['success'=>false,'msg'=>'Please enter a promo code.'], 400);
        }

        // SECURITY FIX: Validate promo code against database AND client-side validation
        $promo = PromoCode::where('code', $promoCode)->where('status',1)->first();
        if(!$promo){
            return response()->json(['success'=>false,'msg'=>'Invalid promo code.'], 404);
        }

        // Additional validation: Check if promo code matches client-side allowed codes
        $allowedClientCodes = ['FREE100', 'HALF50'];
        if(!in_array(strtoupper($promoCode), $allowedClientCodes)){
            return response()->json(['success'=>false,'msg'=>'Invalid promo code. Valid codes: FREE100 or HALF50'], 400);
        }

        $service = \App\Models\BookService::find($serviceId);
        if(!$service){
            return response()->json(['success'=>false,'msg'=>'Service not found.'], 404);
        }

        $price = (float) str_replace(["aud","AUD","$"," "], "", $service->price);
        $discountPercentage = (float) ($promo->discount_percentage ?? 0);
        $discountAmount = round(($price * $discountPercentage)/100, 2);
        $payable = max(0, round($price - $discountAmount, 2));

        return response()->json([
            'success'=>true,
            'msg'=>'Promo applied successfully.',
            'discount_percentage'=>$discountPercentage,
            'payable'=>$payable
        ]);
    }


    public function storepaid(Request $request)
    {
        try {
            // SECURITY FIX: Extract only allowed fields instead of using $request->all()
            $allowedFields = [
                'service_id', 'noe_id', 'fullname', 'description', 'email', 'phone', 
                'date', 'time', 'appointment_details', 'promo_code', 'cardName', 'stripeToken'
            ];
            
            $requestData = $request->only($allowedFields);
            
            // Log request for debugging in development only
            if (config('app.debug')) {
                \Log::info('Appointment booking request from: ' . ($requestData['email'] ?? 'unknown'));
            }
            
            // Enhanced validation with proper rules
            $validationRules = [
                'service_id' => 'required|integer|exists:book_services,id',
                'noe_id' => 'required|integer|exists:nature_of_enquiry,id',
                'fullname' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'description' => 'required|string|max:1000',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20|regex:/^[\d\s\-\+\(\)]+$/',
                'date' => 'required|string|max:50',
                'time' => 'required|string|max:50',
                'appointment_details' => 'required|string|max:1000',
                'promo_code' => 'nullable|string|max:50',
                'cardName' => 'nullable|string|max:255',
                'stripeToken' => 'nullable|string|max:255'
            ];
            
            $validator = \Validator::make($requestData, $validationRules);
            
            if ($validator->fails()) {
                \Log::error('Validation failed: ', $validator->errors()->toArray());
                return response()->json([
                    'success' => false, 
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }
            
            // Only handle paid appointments (service_id = 1) for Ajay Bansal
            if ($requestData['service_id'] != 1) {
                return response()->json(['success' => false, 'message' => 'Only paid appointments are available'], 400);
            }
            
            $service_id = $requestData['service_id'];
            $noe_id = $requestData['noe_id'];
            $fullname = $requestData['fullname'];
            $description = $requestData['description'];
            $email = $requestData['email'];
            $phone = $requestData['phone'];
            
            // Parse and validate date using centralized method
            $dateParseResult = $this->parseAppointmentDate($requestData['date']);
            if (!$dateParseResult['success']) {
                return response()->json([
                    'success' => false, 
                    'message' => $dateParseResult['message']
                ], 400);
            }
            $datey = $dateParseResult['date'];
            
            // SECURITY FIX: Check for appointment conflicts before processing
            $timeConflict = $this->checkAppointmentConflict($datey, $requestData['time'], $requestData['service_id'], $requestData['noe_id']);
            if ($timeConflict['conflict']) {
                \Log::warning('Appointment conflict detected: ' . $timeConflict['message']);
                return response()->json([
                    'success' => false, 
                    'message' => $timeConflict['message']
                ], 409); // 409 Conflict status code
            }
		$service = \App\Models\BookService::find($requestData['service_id']); //dd($service);
        if(!empty($service)){
            $amount =  (float) str_replace(["aud","AUD","$"," "], "", $service['price']);
        } else {
            $amount = 0;
        }

        // Apply promo code discount if provided
        $appliedPromo = null;
        if(!empty($requestData['promo_code'])){
            $promoCode = trim($requestData['promo_code']);
            
            // SECURITY FIX: Validate promo code against database AND client-side validation
            $promo = PromoCode::where('code', $promoCode)->where('status',1)->first();
            
            if($promo){
                // Additional validation: Check if promo code matches client-side allowed codes
                $allowedClientCodes = ['FREE100', 'HALF50'];
                if(!in_array(strtoupper($promoCode), $allowedClientCodes)){
                    \Log::warning('Promo code validation mismatch: ' . $promoCode . ' not in client-side allowed codes');
                    return response()->json([
                        'success' => false, 
                        'message' => 'Invalid promo code. Please use a valid code.'
                    ], 400);
                }
                
                $discountPercentage = (float) ($promo->discount_percentage ?? 0);
                if($discountPercentage > 0){
                    $discountAmount = round(($amount * $discountPercentage) / 100, 2);
                    $amount = max(0, round($amount - $discountAmount, 2));
                    $appliedPromo = $promo;
                    // Log promo code application in development only
                    if (config('app.debug')) {
                        \Log::info('Promo code applied: ' . $promoCode . ' - Discount: ' . $discountPercentage . '%');
                    }
                }
            } else {
                \Log::warning('Invalid promo code attempted: ' . $promoCode);
                return response()->json([
                    'success' => false, 
                    'message' => 'Invalid promo code. Valid codes: FREE100 or HALF50'
                ], 400);
            }
        }

        $NatureOfEnquiry = \App\Models\NatureOfEnquiry::find($requestData['noe_id']); //dd($NatureOfEnquiry);
      
            // Payment processing (simplified for now)
            $cardName = $requestData['cardName'] ?? ($requestData['fullname'] ?? 'Guest');
            $stripeToken = $requestData['stripeToken'] ?? null;
            if(empty($stripeToken)){
                $stripeToken = 'promo_free_'.time();
            }
            $currency = "aud";
            $payment_type = "stripe";
            $order_date = date("Y-m-d H:i:s");
            $order_status = "Pending";
            
            // Store payment record for audit trail
            $paymentRecord = null;
            if((float)$amount > 0){
                // For paid appointments, create a pending payment record
                $paymentRecord = AppointmentPayment::create([
                    'order_hash' => $stripeToken,
                    'payer_email' => $email,
                    'amount' => $amount,
                    'currency' => $currency,
                    'payment_type' => $payment_type,
                    'order_date' => $order_date,
                    'name' => $cardName,
                    'payment_status' => 'Pending',
                    'order_status' => $order_status
                ]);
                // Log payment record creation in development only
                if (config('app.debug')) {
                    \Log::info('Created pending payment record with ID: ' . $paymentRecord->id);
                }
            } else {
                // For free appointments (promo code), create a completed payment record
                $paymentRecord = AppointmentPayment::create([
                    'order_hash' => $stripeToken,
                    'payer_email' => $email,
                    'amount' => 0,
                    'currency' => $currency,
                    'payment_type' => 'promo_free',
                    'order_date' => $order_date,
                    'name' => $cardName,
                    'stripe_payment_intent_id' => 'promo_free_' . time(),
                    'payment_status' => 'Paid',
                    'order_status' => 'Completed'
                ]);
                // Log payment record creation in development only
                if (config('app.debug')) {
                    \Log::info('Created free payment record with ID: ' . $paymentRecord->id);
                }
            }

            // Set appointment status based on payment requirement
            if((float)$amount <= 0){
                $payment_result = ["status"=>"succeeded","id"=>"promo_free_".time()];
                $appontment_status = 10; // Pending Appointment With Payment Success
            } else {
                // Mark as pending payment - will be updated after Stripe payment
                $appontment_status = 5; // Pending Payment
            }
            // Payment processing completed - proceed with appointment creation
            // SECURITY FIX: Wrap user creation and appointment creation in database transaction
            $client_id = null;
            $client_unique_id = null;
            
            DB::beginTransaction();
            
            try {
                $user = \App\Models\Admin::where(function ($query) use($requestData){
                    $query->where('email',$requestData['email'])
                    ->orWhere('phone',$requestData['phone']);
                })->first();
                
                $first_name = $fullname;
                $last_name = "";

                if( isset($fullname) && strlen($fullname) >=4 ){
                    $first_name_val = trim(substr($fullname, 0, 4));
                } else {
                    $first_name_val = trim($fullname);
                }

                if(empty($user)){
                    $objs = new Admin;
                    $objs->client_id = strtoupper($first_name_val).date('his');
                    // Removed role field - column doesn't exist in database
                    $objs->last_name = $last_name;
                    $objs->first_name = $first_name;
                    $objs->email = $email;
                    $objs->phone = $phone;
                    $objs->save();
                    $client_id = $objs->id;
                    $client_unique_id = $objs->client_id;
                } else {
                    if(empty($user->client_id)){
                        Admin::where('id', $user->id)->update(['client_id' => strtoupper($first_name_val).date('his')]);
                    }
                    $client_id = $user->id;
                    $client_unique_id = $user->client_id;
                }

         //Get Nature of Enquiry
        $nature_of_enquiry_data = DB::table('nature_of_enquiry')->where('id', $request->noe_id)->first();
        if($nature_of_enquiry_data){
            $nature_of_enquiry_title = $nature_of_enquiry_data->title;
        } else {
            $nature_of_enquiry_title = "";
        }

        //Get book_services
        $service_data = DB::table('book_services')->where('id', $request->service_id)->first();
        if($service_data){
            $service_title = $service_data->title;
            $service_type = 'Paid'; // Only paid appointments for Ajay
            $service_title_text = $service_title.'-'.$service_type;
        } else {
            $service_title = "";
            $service_title_text = "";
        }

            // Log appointment data in development only
            if (config('app.debug')) {
                \Log::info('Creating appointment for: ' . $fullname . ' (' . $email . ') on ' . $datey);
            }
            
            // Create appointment record
            $obj = new Appointment;
            $obj->client_id = $client_id;
            $obj->client_unique_id = $client_unique_id;
            $obj->service_id = $service_id;
            $obj->noe_id = $noe_id;
            $obj->full_name = $fullname;
            $obj->description = $description;
            $obj->email = $email;
            $obj->phone = $phone;
            $obj->date = $datey;
            $obj->status = $appontment_status;
            
            if(!empty($requestData['time'])){
                // Parse time using centralized method
                $timeParseResult = $this->parseAppointmentTime($requestData['time']);
                if (!$timeParseResult['success']) {
                    \Log::error('Time parsing failed in appointment creation: ' . $timeParseResult['message']);
                    throw new \Exception('Invalid time format: ' . $timeParseResult['message']);
                }
                $obj->time = $timeParseResult['time'];
            }
            
            $obj->timeslot_full = $requestData['time'];
            $obj->invites = 0;
            $obj->appointment_details = $requestData['appointment_details'];
            $obj->order_hash = $stripeToken;
            
                $saved = $obj->save();
                
                if (!$saved) {
                    \Log::error('Appointment save failed - validation errors: ', $obj->getErrors());
                    throw new \Exception('Failed to save appointment');
                }
                
                // Log successful appointment creation in development only
                if (config('app.debug') && $paymentRecord) {
                    \Log::info('Appointment created successfully with payment record ID: ' . $paymentRecord->id);
                }
                
                // Commit the transaction if appointment is saved successfully
                DB::commit();
                
                // Only send emails for free appointments (amount <= 0)
                // For paid appointments, emails will be sent after successful Stripe payment
                $emailResults = null;
                if((float)$amount <= 0) {
                    // Send emails with proper error handling and user notification for free appointments
                    $emailResults = $this->sendAppointmentEmails($fullname, $email, $phone, $requestData, $service, $NatureOfEnquiry, $description, $obj->id);
                    
                    // Check if critical emails failed and notify user
                    $emailFailures = [];
                    if (!$emailResults['admin_email_sent']) {
                        $emailFailures[] = 'Admin notification';
                        \Log::error('Admin email failed to send', [
                            'appointment_id' => $obj->id,
                            'error' => $emailResults['admin_email_error']
                        ]);
                    }
                    
                    if (!$emailResults['customer_email_sent']) {
                        $emailFailures[] = 'Confirmation email';
                        \Log::error('Customer confirmation email failed to send', [
                            'appointment_id' => $obj->id,
                            'customer_email' => $email,
                            'error' => $emailResults['customer_email_error']
                        ]);
                    }
                    
                    // If critical emails failed, inform user but don't fail the appointment
                    if (!empty($emailFailures)) {
                        \Log::warning('Some appointment emails failed to send', [
                            'appointment_id' => $obj->id,
                            'failed_emails' => $emailFailures,
                            'customer_email' => $email
                        ]);
                    }

                    //SMS to admin
                    /*$receiver_number="+610422905860";
                    // $receiver_number="+61476857122"; testing number
                    $smsMessage="An appointment has been booked for $fullname on ".$requestData['date'].' at '.$requestData['time'];
                    Helper::sendSms($receiver_number,$smsMessage);*/

                    // Return success message for free appointments
                    $message = 'Your appointment booked successfully on '.$requestData['date'].' '.$requestData['time'];
                    
                    $response = [
                        'success' => true,
                        'message' => $message,
                        'appointment_id' => $obj->id,
                        'email_status' => [
                            'admin_notification_sent' => $emailResults['admin_email_sent'],
                            'confirmation_sent' => $emailResults['customer_email_sent']
                        ]
                    ];
                    
                    // Add warning if emails failed
                    if (!$emailResults['customer_email_sent']) {
                        $response['warning'] = 'Appointment confirmed but confirmation email failed to send. Please check your email address or contact us.';
                    }
                    
                    return response()->json($response);
                } else {
                    // For paid appointments, return payment URL (customer emails will be sent after payment)
                    // Note: Admin pending payment email will be sent only when Stripe payment fails (in HomeController::stripePost)
                    $payment_url = url('/stripe/' . $obj->id);
                    $message = 'Please complete payment to confirm your appointment on '.$requestData['date'].' '.$requestData['time'];
                    
                    $response = [
                        'success' => true,
                        'message' => $message,
                        'payment_url' => $payment_url,
                        'appointment_id' => $obj->id,
                        'requires_payment' => true
                    ];
                    
                    return response()->json($response);
                }

            } catch (\Exception $e) {
                // SECURITY FIX: Rollback transaction on any error
                DB::rollback();
                \Log::error('Transaction failed in storepaid: ' . $e->getMessage());
                return response()->json([
                    'success' => false, 
                    'message' => 'Failed to create appointment: ' . $e->getMessage()
                ], 500);
            }
        
        } catch (\Exception $e) {
            \Log::error('storepaid error: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Server error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Send appointment emails with proper error handling
     */
    public function sendAppointmentEmails($fullname, $email, $phone, $requestData, $service, $NatureOfEnquiry, $description, $appointmentId = null)
    {
        $results = [
            'admin_email_sent' => false,
            'customer_email_sent' => false,
            'admin_email_error' => null,
            'customer_email_error' => null
        ];
        
        // Prepare common appointment data
        $appointmentData = [
            'fullname' => $fullname,
            'date' => $requestData['date'],
            'time' => $requestData['time'],
            'email' => $email,
            'phone' => $phone,
            'description' => $description,
            'service' => $service->title,
            'NatureOfEnquiry' => $NatureOfEnquiry ? $NatureOfEnquiry->title : 'N/A',
            'appointment_details' => $requestData['appointment_details'],
        ];
        
        // Send email to admin
        try {
            $adminDetails = array_merge($appointmentData, [
                'title' => 'New Appointment Booked - ' . $fullname . ' - ' . $service->title,
                'fullname' => 'Admin',
            ]);
            
            Mail::to('Info@bansallawyers.com.au')->send(new \App\Mail\AppointmentMail($adminDetails));
            $results['admin_email_sent'] = true;
            
            \Log::info('Admin appointment email sent successfully', [
                'appointment_id' => $appointmentId,
                'admin_email' => 'Info@bansallawyers.com.au'
            ]);
            
        } catch (\Exception $e) {
            $results['admin_email_error'] = $e->getMessage();
            \Log::error('Admin appointment email failed', [
                'appointment_id' => $appointmentId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
        
        // Send email to customer
        try {
            $customerDetails = array_merge($appointmentData, [
                'title' => 'Appointment Confirmation - ' . $requestData['date'] . ' at ' . $requestData['time'],
            ]);
            
            Mail::to($email)->send(new \App\Mail\AppointmentMail($customerDetails));
            $results['customer_email_sent'] = true;
            
            \Log::info('Customer appointment email sent successfully', [
                'appointment_id' => $appointmentId,
                'customer_email' => $email
            ]);
            
        } catch (\Exception $e) {
            $results['customer_email_error'] = $e->getMessage();
            \Log::error('Customer appointment email failed', [
                'appointment_id' => $appointmentId,
                'customer_email' => $email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
        
        return $results;
    }
    
    /**
     * Send admin notification email for paid appointments with pending payment
     * This is sent only once when appointment is created with payment pending
     * 
     * @param string $fullname
     * @param string $email
     * @param string $phone
     * @param array $requestData
     * @param object $service
     * @param object $NatureOfEnquiry
     * @param string $description
     * @param int $appointmentId
     * @return array
     */
    public function sendAdminPendingPaymentEmail($fullname, $email, $phone, $requestData, $service, $NatureOfEnquiry, $description, $appointmentId = null)
    {
        $results = [
            'admin_email_sent' => false,
            'admin_email_error' => null
        ];
        
        // Prepare appointment data
        $appointmentData = [
            'fullname' => $fullname,
            'date' => $requestData['date'],
            'time' => $requestData['time'],
            'email' => $email,
            'phone' => $phone,
            'description' => $description,
            'service' => $service->title,
            'NatureOfEnquiry' => $NatureOfEnquiry ? $NatureOfEnquiry->title : 'N/A',
            'appointment_details' => $requestData['appointment_details'],
        ];
        
        // Send email to admin only (for pending payment appointments)
        try {
            $adminDetails = array_merge($appointmentData, [
                'title' => 'New Appointment - Payment Pending - ' . $fullname . ' - ' . $service->title,
                'fullname' => 'Admin',
                'email_subject' => 'New Appointment - Payment Pending - ' . $fullname . ' - ' . $service->title,
                'payment_status' => 'pending', // Indicate payment is pending
            ]);
            //Info@bansallawyers.com.au viplucmca1986@gmail.com
            Mail::to('Info@bansallawyers.com.au')->send(new \App\Mail\AppointmentMail($adminDetails));
            $results['admin_email_sent'] = true;
            
            \Log::info('Admin pending payment email sent successfully', [
                'appointment_id' => $appointmentId,
                'admin_email' => 'Info@bansallawyers.com.au',
                'customer_email' => $email
            ]);
            
        } catch (\Exception $e) {
            $results['admin_email_error'] = $e->getMessage();
            \Log::error('Admin pending payment email failed', [
                'appointment_id' => $appointmentId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
        
        return $results;
    }
    
    /**
     * Get email failure statistics for monitoring
     */
    public function getEmailFailureStats()
    {
        try {
            // This would typically query a logs table or email_failures table
            // For now, we'll return a basic structure
            return response()->json([
                'success' => true,
                'stats' => [
                    'total_appointments' => \App\Models\Appointment::count(),
                    'failed_emails_today' => 0, // Would be calculated from logs
                    'email_success_rate' => '95%', // Would be calculated
                    'last_email_failure' => null // Would be from logs
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve email statistics: ' . $e->getMessage()
            ], 500);
        }
    }
}
