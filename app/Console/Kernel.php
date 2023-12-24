<?php

namespace App\Console;

use App\Helper;
use App\Jobs\FetchConversionRates;
use App\Jobs\ProcessRecurrings;
use App\Jobs\SendWeeklyReports;
use App\Jobs\SyncStripeSubscriptions;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * @codeCoverageIgnore
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(new SyncStripeSubscriptions())->everyMinute()->when(function () {
            return Helper::arePlansEnabled();
        });

        // Daily
        $schedule->job(new ProcessRecurrings())->daily();
        $schedule->job(new FetchConversionRates())->daily();

        $schedule->job(new SendWeeklyReports())->weekly()->fridays()->at('21:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
