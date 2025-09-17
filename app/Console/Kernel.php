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
        '\App\\Console\\Commands\\BirthDate',
        '\App\\Console\\Commands\\InPersonCompleteTaskRemoval',
        '\App\\Console\\Commands\\WpAppointmentToCrm',
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
        $schedule->command('BirthDate:birthdate')->daily();
        
        //InPerson Complete Task Removal daily 1 time
        $schedule->command('InPersonCompleteTaskRemoval:daily')->daily();
        
        $schedule->command('WpAppointmentToCrm:daily')->everyFiveMinutes();
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
