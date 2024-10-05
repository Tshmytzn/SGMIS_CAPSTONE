<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Election;
use Carbon\Carbon;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $elect = Election::where('elect_status', '1')->first();
            if ($elect) {
                $electEnd = Carbon::parse($elect->elect_end); // Parse elect_end as a Carbon object
                $currentDateTime = Carbon::now(); // Get the current date and time
                if ($electEnd->lessThan($currentDateTime)) {
                    $elect->update([
                        'elect_status' => '2'
                    ]);
                } else {
                    
                }
            } else {
               
            }
            
        })->everyMinute(); 
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
