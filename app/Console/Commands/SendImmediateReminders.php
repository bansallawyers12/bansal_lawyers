<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NotificationService;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendImmediateReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:send-immediate-reminders {--hours=2 : Hours before appointment to send reminder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send immediate appointment reminders to clients';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hours = $this->option('hours');
        $this->info("Sending immediate appointment reminders for appointments in {$hours} hours...");
        
        // Calculate the target date range
        $targetDate = Carbon::now()->addHours($hours);
        $startOfDay = $targetDate->copy()->startOfDay();
        $endOfDay = $targetDate->copy()->endOfDay();
        
        // Get appointments that need immediate reminders
        $appointments = Appointment::where('status', 10) // Confirmed appointments
            ->whereBetween('date', [$startOfDay->format('Y-m-d'), $endOfDay->format('Y-m-d')])
            ->where('time', '>=', $targetDate->format('H:i:s'))
            ->where('immediate_reminder_sent', false) // Only send if not already sent
            ->get();
        
        $this->info("Found " . $appointments->count() . " appointments for immediate reminder.");
        
        $successCount = 0;
        $failureCount = 0;
        
        foreach ($appointments as $appointment) {
            try {
                // Prepare appointment data for notification
                $appointmentData = [
                    'fullname' => $appointment->full_name,
                    'email' => $appointment->email,
                    'phone' => $appointment->phone ?? '',
                    'date' => Carbon::parse($appointment->date)->format('l, F j, Y'),
                    'time' => Carbon::parse($appointment->time)->format('g:i A'),
                    'service' => $appointment->service->name ?? 'Legal Consultation',
                    'appointment_details' => $appointment->appointment_details ?? 'In-person consultation',
                    'NatureOfEnquiry' => $appointment->natureOfEnquiry->name ?? 'General Inquiry',
                    'duration' => '60 minutes'
                ];
                
                // Send immediate reminder notification
                $results = NotificationService::sendAppointmentReminder($appointmentData);
                
                // Mark immediate reminder as sent
                $appointment->update(['immediate_reminder_sent' => true]);
                
                $this->line("✓ Immediate reminder sent for appointment ID: {$appointment->id} - {$appointment->full_name}");
                $successCount++;
                
                // Log the reminder
                Log::info('Immediate appointment reminder sent', [
                    'appointment_id' => $appointment->id,
                    'client_name' => $appointment->full_name,
                    'appointment_date' => $appointment->date,
                    'appointment_time' => $appointment->time,
                    'results' => $results
                ]);
                
            } catch (\Exception $e) {
                $this->error("✗ Failed to send immediate reminder for appointment ID: {$appointment->id} - {$e->getMessage()}");
                $failureCount++;
                
                Log::error('Immediate appointment reminder failed', [
                    'appointment_id' => $appointment->id,
                    'error' => $e->getMessage()
                ]);
            }
        }
        
        $this->info("Immediate reminder sending completed. Success: {$successCount}, Failures: {$failureCount}");
        
        return Command::SUCCESS;
    }
}
