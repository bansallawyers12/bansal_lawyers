<?php

namespace App\Services;

use App\Mail\AppointmentMail;
use App\Mail\AppointmentReminderMail;
use App\Mail\AppointmentCancelledMail;
use App\Services\SmsService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Send appointment confirmation (Email + SMS)
     */
    public static function sendAppointmentConfirmation($appointment, $sendEmail = true, $sendSms = true)
    {
        $results = [];
        
        // Send email
        if ($sendEmail) {
            try {
                Mail::to($appointment['email'])->send(new AppointmentMail($appointment));
                $results['email'] = ['success' => true, 'message' => 'Email sent successfully'];
                Log::info('Appointment confirmation email sent', ['email' => $appointment['email']]);
            } catch (\Exception $e) {
                $results['email'] = ['success' => false, 'message' => 'Email failed: ' . $e->getMessage()];
                Log::error('Appointment confirmation email failed', ['email' => $appointment['email'], 'error' => $e->getMessage()]);
            }
        }
        
        // Send SMS
        if ($sendSms && !empty($appointment['phone'])) {
            $results['sms'] = SmsService::sendAppointmentConfirmation($appointment);
        }
        
        return $results;
    }

    /**
     * Send appointment reminder (Email + SMS)
     */
    public static function sendAppointmentReminder($appointment, $sendEmail = true, $sendSms = true)
    {
        $results = [];
        
        // Send email
        if ($sendEmail) {
            try {
                Mail::to($appointment['email'])->send(new AppointmentReminderMail($appointment));
                $results['email'] = ['success' => true, 'message' => 'Reminder email sent successfully'];
                Log::info('Appointment reminder email sent', ['email' => $appointment['email']]);
            } catch (\Exception $e) {
                $results['email'] = ['success' => false, 'message' => 'Reminder email failed: ' . $e->getMessage()];
                Log::error('Appointment reminder email failed', ['email' => $appointment['email'], 'error' => $e->getMessage()]);
            }
        }
        
        // Send SMS
        if ($sendSms && !empty($appointment['phone'])) {
            $results['sms'] = SmsService::sendAppointmentReminder($appointment);
        }
        
        return $results;
    }

    /**
     * Send appointment cancellation (Email + SMS)
     */
    public static function sendAppointmentCancellation($appointment, $sendEmail = true, $sendSms = true)
    {
        $results = [];
        
        // Send email
        if ($sendEmail) {
            try {
                Mail::to($appointment['email'])->send(new AppointmentCancelledMail($appointment));
                $results['email'] = ['success' => true, 'message' => 'Cancellation email sent successfully'];
                Log::info('Appointment cancellation email sent', ['email' => $appointment['email']]);
            } catch (\Exception $e) {
                $results['email'] = ['success' => false, 'message' => 'Cancellation email failed: ' . $e->getMessage()];
                Log::error('Appointment cancellation email failed', ['email' => $appointment['email'], 'error' => $e->getMessage()]);
            }
        }
        
        // Send SMS
        if ($sendSms && !empty($appointment['phone'])) {
            $results['sms'] = SmsService::sendAppointmentCancellation($appointment);
        }
        
        return $results;
    }

    /**
     * Send appointment rescheduled (Email + SMS)
     */
    public static function sendAppointmentRescheduled($appointment, $sendEmail = true, $sendSms = true)
    {
        $results = [];
        
        // Send email (using reminder template with rescheduled content)
        if ($sendEmail) {
            try {
                $appointment['title'] = 'Appointment Rescheduled';
                Mail::to($appointment['email'])->send(new AppointmentReminderMail($appointment));
                $results['email'] = ['success' => true, 'message' => 'Rescheduled email sent successfully'];
                Log::info('Appointment rescheduled email sent', ['email' => $appointment['email']]);
            } catch (\Exception $e) {
                $results['email'] = ['success' => false, 'message' => 'Rescheduled email failed: ' . $e->getMessage()];
                Log::error('Appointment rescheduled email failed', ['email' => $appointment['email'], 'error' => $e->getMessage()]);
            }
        }
        
        // Send SMS
        if ($sendSms && !empty($appointment['phone'])) {
            $results['sms'] = SmsService::sendAppointmentRescheduled($appointment);
        }
        
        return $results;
    }

    /**
     * Send custom notification
     */
    public static function sendCustomNotification($recipients, $message, $type = 'both')
    {
        $results = [];
        
        foreach ($recipients as $recipient) {
            $recipientResults = [];
            
            // Send email
            if (($type === 'email' || $type === 'both') && !empty($recipient['email'])) {
                try {
                    Mail::raw($message, function ($mail) use ($recipient) {
                        $mail->to($recipient['email'])
                             ->subject('Notification from Bansal Lawyers');
                    });
                    $recipientResults['email'] = ['success' => true, 'message' => 'Email sent successfully'];
                } catch (\Exception $e) {
                    $recipientResults['email'] = ['success' => false, 'message' => 'Email failed: ' . $e->getMessage()];
                }
            }
            
            // Send SMS
            if (($type === 'sms' || $type === 'both') && !empty($recipient['phone'])) {
                $recipientResults['sms'] = SmsService::sendCustomSms($recipient['phone'], $message);
            }
            
            $results[] = [
                'recipient' => $recipient,
                'results' => $recipientResults
            ];
        }
        
        return $results;
    }

    /**
     * Get notification preferences for a user
     */
    public static function getNotificationPreferences($userId)
    {
        // This would typically come from a database table
        // For now, return default preferences
        return [
            'email_enabled' => true,
            'sms_enabled' => true,
            'appointment_reminders' => true,
            'appointment_confirmations' => true,
            'appointment_cancellations' => true,
            'marketing_emails' => false,
            'reminder_frequency' => '24_hours' // 24_hours, 2_hours, 1_hour
        ];
    }

    /**
     * Update notification preferences for a user
     */
    public static function updateNotificationPreferences($userId, $preferences)
    {
        // This would typically update a database table
        // For now, just log the update
        Log::info('Notification preferences updated', [
            'user_id' => $userId,
            'preferences' => $preferences
        ]);
        
        return true;
    }
}
