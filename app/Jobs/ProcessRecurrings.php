<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Recurring;
use App\Spending;
use App\Earning;

class ProcessRecurrings implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct() {
        //
    }

    public function handle() {
        $day = (int) date('j');

        $recurrings = Recurring
            ::where('type', 'monthly')
            ->when((int) date('t')  == $day, 
            function ($query) use ($day) {
                return $query->where('day', '>=', $day);
            }, 
            function ($query) use ($day) {
                return $query->where('day', $day);
            })
            ->where('starts_on', '<=', date('Y-m-d'))
            ->where(function ($query) {
                $query
                    ->where('ends_on', '>=', date('Y-m-d'))
                    ->orWhere('ends_on', null);
            })->where(function ($query) {
                $query
                    ->where('last_used_on', '<', date('Y-m-d'))
                    ->orWhere('last_used_on', null);
            })->get();

        foreach ($recurrings as $recurring) {
            if ($recurring->earning) {
                $transaction = new Earning;
            } else {
                $transaction = new Spending;
            }
            $transaction->space_id = $recurring->space_id;
            $transaction->recurring_id = $recurring->id;
            $transaction->tag_id = $recurring->tag_id;
            $transaction->happened_on = date('Y-m-d');
            $transaction->description = $recurring->description;
            $transaction->amount = $recurring->amount;
            $transaction->save();

            $recurring->last_used_on = date('Y-m-d');
            $recurring->save();
        }
    }
}
