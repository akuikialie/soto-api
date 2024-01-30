<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\GenerateMessage::class,
        Commands\SendMessage::class,
        Commands\GenerateEmployeePresence::class,
        Commands\SendNotificationWhatsappKlinikoo::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('generate-message:cron')
        //          ->everyMinute();
        // $schedule->command('send-message:cron')
        //          ->everyTwoMinutes();
        // $schedule->command('generate-employee-presence:cron')
        //          //->everyTwoMinutes();
        //           ->everyMinute();
        $schedule->command('send-notification-whatsapp:klinikoo')
                 ->everyMinute();
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
