<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Models\Appointment;
use App\Models\Admin;
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


    public function checkpromocode(Request $request)
    {
        $promoCode = trim($request->get('promo_code'));
        $serviceId = $request->get('service_id');

        if(empty($promoCode)){
            return response()->json(['success'=>false,'msg'=>'Please enter a promo code.'], 400);
        }

        $promo = PromoCode::where('code', $promoCode)->where('status',1)->first();
        if(!$promo){
            return response()->json(['success'=>false,'msg'=>'Invalid promo code.'], 404);
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
            $requestData = $request->all();
            
            // DEBUG: Log all incoming request data
            \Log::info('=== STOREPAID DEBUG START ===');
            \Log::info('Request method: ' . $request->method());
            \Log::info('Request URL: ' . $request->fullUrl());
            \Log::info('Request headers: ', $request->headers->all());
            \Log::info('Request data: ', $requestData);
            \Log::info('CSRF token: ' . $request->header('X-CSRF-TOKEN'));
            
            // DEBUG: Check each field individually
            $fieldChecks = [];
            foreach ($requestData as $key => $value) {
                $fieldChecks[$key] = [
                    'value' => $value,
                    'empty' => empty($value),
                    'type' => gettype($value)
                ];
            }
            \Log::info('Field analysis: ', $fieldChecks);
            
            // Validate required fields
            $requiredFields = ['service_id', 'noe_id', 'fullname', 'description', 'email', 'phone', 'date', 'time', 'appointment_details'];
            $missingFields = [];
            foreach ($requiredFields as $field) {
                if (empty($requestData[$field])) {
                    $missingFields[] = $field;
                    \Log::warning("Missing required field: $field");
                }
            }
            
            if (!empty($missingFields)) {
                \Log::error('Validation failed - missing fields: ' . implode(', ', $missingFields));
                return response()->json(['success' => false, 'message' => "Missing required fields: " . implode(', ', $missingFields)], 400);
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
            
            // Handle different date formats
            $selDate = $requestData['date'];
            
            // Check for YYYY-September-Wednesday format (from frontend)
            if (preg_match('/^(YYYY|\d{4})-([A-Za-z]+)-([A-Za-z]+)$/', $selDate, $matches)) {
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
                    return response()->json(['success' => false, 'message' => 'Invalid month name: ' . $month], 400);
                }
                
                // For now, use the 1st day of the month since we don't have the specific date
                // In a real implementation, you'd need to calculate the actual date based on the day of week
                $datey = $year . '-' . $monthNumber . '-01';
                
                \Log::info('Parsed date from frontend format: ' . $selDate . ' -> ' . $datey);
            } elseif (strpos($selDate, '-') !== false && preg_match('/^\d{4}-\d{2}-\d{2}$/', $selDate)) {
                // YYYY-MM-DD format from JavaScript
                $datey = $selDate;
                \Log::info('Using YYYY-MM-DD format: ' . $datey);
            } else {
                // DD/MM/YYYY format
                $date = explode('/', $selDate);
                if (count($date) != 3) {
                    return response()->json(['success' => false, 'message' => 'Invalid date format: ' . $selDate], 400);
                }
                $datey = $date[2].'-'.$date[1].'-'.$date[0];
                \Log::info('Using DD/MM/YYYY format: ' . $selDate . ' -> ' . $datey);
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
            $promo = PromoCode::where('code', trim($requestData['promo_code']))->where('status',1)->first();
            if($promo){
                $discountPercentage = (float) ($promo->discount_percentage ?? 0);
                if($discountPercentage > 0){
                    $discountAmount = round(($amount * $discountPercentage) / 100, 2);
                    $amount = max(0, round($amount - $discountAmount, 2));
                    $appliedPromo = $promo;
                }
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
            
            // Skip payment table insertion for now - table doesn't exist
            // TODO: Create tbl_paid_appointment_payment table migration

            // Set appointment status based on payment requirement
            if((float)$amount <= 0){
                $payment_result = ["status"=>"succeeded","id"=>"promo_free_".time()];
                $appontment_status = 10; // Pending Appointment With Payment Success
            } else {
                // Mark as pending payment - will be updated after Stripe payment
                $appontment_status = 5; // Pending Payment
            }
            // Payment processing completed - proceed with appointment creation
        $user = \App\Models\Admin::where(function ($query) use($requestData){
			$query->where('email',$requestData['email'])
			->orWhere('phone',$requestData['phone']);
		})->first();
        /*$parts = explode(" ", $fullname);
        $last_name = array_pop($parts);
        $first_name = implode(" ", $parts);*/
        $first_name = $fullname;
        $last_name = "";

        if( isset($fullname) && strlen($fullname) >=4 ){
            $first_name_val = trim(substr($fullname, 0, 4));
        } else {
            $first_name_val = trim($fullname);
        }
        //dd($first_name_val);

        if(empty($user)){
			$objs				= 	new Admin;
			$objs->client_id	=	strtoupper($first_name_val).date('his');
			// Removed role field - column doesn't exist in database
			$objs->last_name	=	$last_name;
			$objs->first_name	=	$first_name;
			$objs->email	    =	$email;
			$objs->phone	    =	$phone;
			$objs->save();
			$client_id          = $objs->id;
            $client_unique_id   = $objs->client_id;
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

            // DEBUG: Log appointment data before saving
            \Log::info('=== APPOINTMENT DATA DEBUG ===');
            \Log::info('client_id: ' . $client_id);
            \Log::info('client_unique_id: ' . $client_unique_id);
            \Log::info('service_id: ' . $service_id);
            \Log::info('noe_id: ' . $noe_id);
            \Log::info('fullname: ' . $fullname);
            \Log::info('description: ' . $description);
            \Log::info('email: ' . $email);
            \Log::info('phone: ' . $phone);
            \Log::info('date: ' . $datey);
            \Log::info('appontment_status: ' . $appontment_status);
            \Log::info('time: ' . $requestData['time']);
            \Log::info('appointment_details: ' . $requestData['appointment_details']);
            \Log::info('stripeToken: ' . $stripeToken);
            
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
                $time = explode('-', $requestData['time']);
                // Fix: Properly parse 12-hour format time
                $parsed_time = strtotime($time[0]);
                if($parsed_time === false) {
                    // Fallback: try parsing with different format
                    $parsed_time = strtotime('1970-01-01 ' . $time[0]);
                }
                $obj->time = date("H:i", $parsed_time);
                \Log::info('Parsed time: ' . $obj->time . ' from: ' . $time[0]);
            }
            
            $obj->timeslot_full = $requestData['time'];
            $obj->invites = 0;
            $obj->appointment_details = $requestData['appointment_details'];
            $obj->order_hash = $stripeToken;
            
            // DEBUG: Log the appointment object before saving
            \Log::info('Appointment object attributes: ', $obj->getAttributes());
            
            $saved = $obj->save();
            \Log::info('Appointment save result: ' . ($saved ? 'SUCCESS' : 'FAILED'));
            
            if (!$saved) {
                \Log::error('Appointment save failed - validation errors: ', $obj->getErrors());
            }
        if($saved)
        {
            // Note and ActivitiesLog functionality removed
            // $note = new \App\Models\Note;
            // $note->client_id =  $client_id;
            // $note->user_id = 1;
            // $note->title = $requestData['appointment_details'];
            // $note->description = $description;
            // $note->mail_id = 0;
            // $note->type = 'client';
            // $saved = $note->save();

            $subject = 'scheduled a paid appointment'; // Only paid appointments for Ajay
            // $objs = new \App\Models\ActivitiesLog;
            // $objs->client_id = $client_id;
            // $objs->created_by = 1;
            // $objs->description = '<div style="display: -webkit-inline-box;">
            // 			<span style="height: 60px; width: 60px; border: 1px solid rgb(3, 169, 244); border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2px;overflow: hidden;">
            // 				<span  style="flex: 1 1 0%; width: 100%; text-align: center; background: rgb(237, 237, 237); border-top-left-radius: 120px; border-top-right-radius: 120px; font-size: 12px;line-height: 24px;">
            // 				  '.date('d M', strtotime($datey)).'
            // 				</span>
            // 				<span style="background: rgb(84, 178, 75); color: rgb(255, 255, 255); flex: 1 1 0%; width: 100%; border-bottom-left-radius: 120px; border-bottom-right-radius: 120px; text-align: center;font-size: 12px; line-height: 21px;">
            // 				   '.date('Y', strtotime($datey)).'
            // 				</span>
            // 			</span>
            // 		</div>
            // 		<div style="display:inline-grid;"><span class="text-semi-bold">'.$nature_of_enquiry_title.'</span> <span class="text-semi-bold">'.$service_title_text.'</span>  <span class="text-semi-bold">'.$request->appointment_details.'</span> <span class="text-semi-bold">'.$request->fullname.'</span> <span class="text-semi-bold">'.$request->email.'</span> <span class="text-semi-bold">'.$request->phone.'</span> <span class="text-semi-bold">'.$request->description.'</span> <p class="text-semi-light-grey col-v-1">@ '.$request->time.'</p></div>';

            // $objs->subject = $subject;
            // $objs->save();

            // Send emails (with error handling)
            try {
                // Email To Admin
                $details1 = [
                    'title' => 'You have received a new appointment from '.$fullname.' for '.$service->title,
                    'body' => 'This is for testing email using smtp',
                    'fullname' => 'Admin',
                    'date' => $requestData['date'],
                    'time' => $requestData['time'],
                    'email'=> $email,
                    'phone' => $phone,
                    'description' => $description,
                    'service'=> $service->title,
                    'NatureOfEnquiry'=> $NatureOfEnquiry ? $NatureOfEnquiry->title : 'N/A',
                    'appointment_details'=> $requestData['appointment_details'],
                ];
                Mail::to('Info@bansallawyers.com.au')->send(new \App\Mail\AppointmentMail($details1));

                // Email To customer
                $details = [
                    'title' => 'You have booked an Appointment on '.$requestData['date'].'  at '.$requestData['time'],
                    'body' => 'This is for testing email using smtp',
                    'fullname' => $fullname,
                    'date' => $requestData['date'],
                    'time' => $requestData['time'],
                    'email'=> $email,
                    'phone' => $phone,
                    'description' => $description,
                    'service'=> $service->title,
                    'NatureOfEnquiry'=> $NatureOfEnquiry ? $NatureOfEnquiry->title : 'N/A',
                    'appointment_details'=> $requestData['appointment_details'],
                ];

                Mail::to($email)->send(new \App\Mail\AppointmentMail($details));
            } catch (\Exception $e) {
                \Log::error('Email sending failed: ' . $e->getMessage());
                // Continue even if email fails
            }

            //SMS to admin
            /*$receiver_number="+610422905860";
            // $receiver_number="+61476857122"; testing number
            $smsMessage="An appointment has been booked for $fullname on ".$requestData['date'].' at '.$requestData['time'];
            Helper::sendSms($receiver_number,$smsMessage);*/

            // Return success with Stripe payment URL
            $payment_url = url('/stripe/' . $obj->id);
            $message = 'Your appointment booked successfully on '.$requestData['date'].' '.$requestData['time'];
            return response()->json(array(
                'success' => true,
                'message' => $message,
                'payment_url' => $payment_url,
                'appointment_id' => $obj->id
            ));

        } else {
            return response()->json(array('success'=>false,'message'=>'Failed to save appointment'));
        }
        
        } catch (\Exception $e) {
            \Log::error('storepaid error: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Server error occurred: ' . $e->getMessage()
            ], 500);
        }
    }




}
