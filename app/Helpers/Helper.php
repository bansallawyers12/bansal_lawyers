<?php
namespace App\Helpers; // Your helpers namespace 
use App\Models\User;
use App\Models\Company;
use Auth;
use Exception;
use Twilio\Rest\Client;

class Helper
{
    public static function sendSms($receiverNumber,$message){
        $receiverNumber = $receiverNumber ?? "+610422905860";
        $message = $message;
    
        try {
            
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
    
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
            $res="SMS sent successfully.";
            return json_encode($res);
    
        } catch (Exception $e) {
            return json_encode($e->getMessage());
            // dd("Error: ". $e->getMessage());
        }
    }
    public static function changeDateFormate($date,$date_format){
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
    }
    public static function getUserCompany(): ?object
    {
        $companyId = Auth::user()->comp_id;
        return Company::find($companyId);
    }
    
    /**
     * Get asset path with automatic public/ prefix handling
     * Works for both local development and production
     */
    public static function assetPath($path)
    {
        // Remove leading slash if present
        $path = ltrim($path, '/');
        
        // Check if we're in local development (artisan serve)
        if (app()->environment('local') && request()->getHost() === '127.0.0.1') {
            // Local development - no public/ prefix needed
            return asset($path);
        }
        
        // Production or other environments - add public/ prefix
        return asset('public/' . $path);
    }
}
