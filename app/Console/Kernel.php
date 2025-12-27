<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        '\App\\Console\\Commands\\CronJob',
        '\App\\Console\\Commands\\InPersonCompleteTaskRemoval',
        '\App\\Console\\Commands\\WpAppointmentToCrm',
        '\App\\Console\\Commands\\SendAppointmentReminders',
        '\App\\Console\\Commands\\SendImmediateReminders',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('CronJob:cronjob')->daily();
        
        //InPerson Complete Task Removal daily 1 time
        $schedule->command('InPersonCompleteTaskRemoval:daily')->daily();
        
        $schedule->command('WpAppointmentToCrm:daily')->everyFiveMinutes();
        
        // Appointment reminder system
        $schedule->command('appointments:send-reminders --hours=24')->dailyAt('09:00');
        $schedule->command('appointments:send-reminders --hours=48')->dailyAt('09:00');
        $schedule->command('appointments:send-immediate-reminders --hours=2')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
       // $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
