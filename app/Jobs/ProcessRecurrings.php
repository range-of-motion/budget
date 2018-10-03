<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Recurring;
use App\Spending;

class ProcessRecurrings implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {
        //
    }

    public function handle() {
        $recurrings = Recurring
            ::where('type', 'monthly')
            ->where('day', date('j'))
            ->where('starts_on', '<=', date('Y-m-d'))
            ->where('ends_on', '>=', date('Y-m-d'))
            ->where(function ($query) {
                $query
                    ->where('last_used_on', date('j'))
                    ->orWhere('last_used_on', null);
            })->get();

        foreach ($recurrings as $recurring) {
            $spending = new Spending;
            $spending->space_id = $recurring->space_id;
            $spending->recurring_id = $recurring->id;
            $spending->tag_id = $recurring->tag_id;
            $spending->happened_on = date('Y-m-d');
            $spending->description = $recurring->description;
            $spending->amount = $recurring->amount;
            $spending->save();

            $recurring->last_used_on = date('Y-m-d');
            $recurring->save();
        }
    }
}
