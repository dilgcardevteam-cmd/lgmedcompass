<?php

namespace App\Console;

use App\Http\Controllers\DocumentController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('documents:delete-old')->daily();
        $schedule->command('holidays:import')->yearly();

        // Send deadline notifications once per day at 8:00 AM (instead of hourly)
        $schedule->call(function () {
            app(DocumentController::class)->sendDeadlineNotifications();
        })->dailyAt('08:00');

        // Mark overdue schedules hourly (or as often as needed)
        $schedule->call(function () {
            app(DocumentController::class)->markOverdueSchedules();
        })->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
