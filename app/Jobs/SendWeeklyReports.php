<?php

namespace App\Jobs;

use App\Mail\WeeklyReport;
use App\Space;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendWeeklyReports implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {
        //
    }

    public function handle() {
        $spaces = Space::all();
        $week = date('W');

        foreach ($spaces as $space) {
            // TODO CALCULATE STATISTICS

            foreach ($space->users as $user) {
                // Only send if user wants to receive report
                if ($user->weekly_report) {
                    Mail::to($user->email)->queue(new WeeklyReport($space, $week));
                }
            }
        }
    }
}
