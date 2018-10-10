<?php

namespace App\Jobs;

use App\Mail\WeeklyReport;
use App\Space;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendWeeklyReports implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {
        //
    }

    public function handle() {
        $spaces = Space::all();
        $week = date('W');
        $lastWeekDate = date('Y-m-d', strtotime('-7 days'));
        $currentDate = date('Y-m-d');

        foreach ($spaces as $space) {
            $totalSpent = DB::select('SELECT SUM(amount) AS foo FROM spendings WHERE space_id = ? AND happened_on >= ? AND happened_on <= ?', [$space->id, $lastWeekDate, $currentDate])[0]->foo;

            foreach ($space->users as $user) {
                // Only send if user wants to receive report
                if ($user->weekly_report) {
                    Mail::to($user->email)->queue(new WeeklyReport(
                        $space,
                        $week,
                        $totalSpent
                    ));
                }
            }
        }
    }
}
