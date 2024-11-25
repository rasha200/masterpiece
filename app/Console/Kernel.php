<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\AvailabilityTime;
use Illuminate\Support\Facades\Log;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
       // Reset availability every Friday at midnight
    $schedule->call(function () {
        // Get the upcoming Friday (next Friday)
        $nextFriday = Carbon::now()->next(Carbon::THURSDAY);

 // Log the action to verify that the task is being executed
 Log::info('Scheduler executed on: ' . Carbon::now()->toDateTimeString());

        // Get all time slots for the next week, starting from the next Friday
        AvailabilityTime::where('day_of_week', 'Thursday') // Only the 'Friday' slots
            ->update(['is_available' => 'true']); // Reset all Friday slots to available

            

        // Similarly, do this for the other days (Monday to Thursday)
        $daysOfWeek = ['Thursday', 'Friday', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday'];

        foreach ($daysOfWeek as $day) {
            AvailabilityTime::where('day_of_week', $day)
                ->update(['is_available' => 'true']);

                // Log the update for each day
            Log::info('Availability reset for: ' . $day);
        }

    })->weeklyOn(3, '0:00'); // 3 = Wednesday, at midnight
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
