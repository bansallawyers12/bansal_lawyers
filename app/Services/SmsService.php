<?php

namespace App\Services;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Send appointment confirmation SMS
     */
    public static function sendAppointmentConfirmation($appointment)
    {
        $message = self::buildAppointmentConfirmationMessage($appointment);
        return self::sendSms($appointment['phone'], $message);
    }

    /**
     * Send appointment reminder SMS
     */
    public static function sendAppointmentReminder($appointment)
    {
        $message = self::buildAppointmentReminderMessage($appointment);
        return self::sendSms($appointment['phone'], $message);
    }

    /**
     * Send appointment cancellation SMS
     */
    public static function sendAppointmentCancellation($appointment)
    {
        $message = self::buildAppointmentCancellationMessage($appointment);
        return self::sendSms($appointment['phone'], $message);
    }

    /**
     * Send appointment rescheduled SMS
     */
    public static function sendAppointmentRescheduled($appointment)
    {
        $message = self::buildAppointmentRescheduledMessage($appointment);
        return self::sendSms($appointment['phone'], $message);
    }

    /**
     * Build appointment confirmation message
     */
    private static function buildAppointmentConfirmationMessage($appointment)
    {
        $name = $appointment['fullname'] ?? 'Valued Client';
        $date = $appointment['date'] ?? 'TBD';
        $time = $appointment['time'] ?? 'TBD';
        $service = $appointment['service'] ?? 'Legal Consultation';
        
        return "Hi {$name}, your appointment with Bansal Lawyers is confirmed for {$date} at {$time}. Service: {$service}. Please arrive 10 mins early. Call +61312345678 for queries. - Bansal Lawyers";
    }

    /**
     * Build appointment reminder message
     */
    private static function buildAppointmentReminderMessage($appointment)
    {
        $name = $appointment['fullname'] ?? 'Valued Client';
        $date = $appointment['date'] ?? 'TBD';
        $time = $appointment['time'] ?? 'TBD';
        
        return "Reminder: Hi {$name}, your appointment with Bansal Lawyers is tomorrow ({$date}) at {$time}. Please arrive 10 mins early. Call +61312345678 to reschedule. - Bansal Lawyers";
    }

    /**
     * Build appointment cancellation message
     */
    private static function buildAppointmentCancellationMessage($appointment)
    {
        $name = $appointment['fullname'] ?? 'Valued Client';
        $date = $appointment['date'] ?? 'TBD';
        
        return "Hi {$name}, your appointment with Bansal Lawyers on {$date} has been cancelled. To reschedule, call +61312345678 or visit our website. - Bansal Lawyers";
    }

    /**
     * Build appointment rescheduled message
     */
    private static function buildAppointmentRescheduledMessage($appointment)
    {
        $name = $appointment['fullname'] ?? 'Valued Client';
        $oldDate = $appointment['old_date'] ?? 'TBD';
        $newDate = $appointment['date'] ?? 'TBD';
        $newTime = $appointment['time'] ?? 'TBD';
        
        return "Hi {$name}, your appointment with Bansal Lawyers has been rescheduled from {$oldDate} to {$newDate} at {$newTime}. Call +61312345678 for queries. - Bansal Lawyers";
    }

    /**
     * Send SMS using Twilio
     */
    private static function sendSms($phoneNumber, $message)
    {
        try {
            // Format phone number for Australian numbers
            $formattedPhone = self::formatPhoneNumber($phoneNumber);
            
            // Send SMS using existing Helper class
            $result = Helper::sendSms($formattedPhone, $message);
            
            // Log the SMS attempt
            Log::info('SMS sent successfully', [
                'phone' => $formattedPhone,
                'message' => $message,
                'result' => $result
            ]);
            
            return [
                'success' => true,
                'message' => 'SMS sent successfully',
                'result' => $result
            ];
            
        } catch (\Exception $e) {
            Log::error('SMS sending failed', [
                'phone' => $phoneNumber,
                'message' => $message,
                'error' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'message' => 'SMS sending failed: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Format phone number for Australian numbers
     */
    private static function formatPhoneNumber($phoneNumber)
    {
        // Remove all non-numeric characters
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // If it starts with 0, replace with +61
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '+61' . substr($phoneNumber, 1);
        }
        // If it doesn't start with +, add +61
        elseif (substr($phoneNumber, 0, 1) !== '+') {
            $phoneNumber = '+61' . $phoneNumber;
        }
        
        return $phoneNumber;
    }

    /**
     * Send custom SMS message
     */
    public static function sendCustomSms($phoneNumber, $message)
    {
        return self::sendSms($phoneNumber, $message);
    }

    /**
     * Send bulk SMS messages
     */
    public static function sendBulkSms($recipients, $message)
    {
        $results = [];
        
        foreach ($recipients as $recipient) {
            $results[] = [
                'phone' => $recipient['phone'],
                'name' => $recipient['name'] ?? 'Unknown',
                'result' => self::sendSms($recipient['phone'], $message)
            ];
        }
        
        return $results;
    }
}
