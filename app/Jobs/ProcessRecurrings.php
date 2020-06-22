<?php

namespace App\Jobs;

use App\Models\Earning;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Recurring;
use App\Models\Spending;
use Exception;

class ProcessRecurrings implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $day = (int) date('j');

        $recurrings = Recurring::where('interval', 'monthly')
            ->when((int) date('t')  == $day, function ($query) use ($day) {
                return $query->where('day', '>=', $day);
            }, function ($query) use ($day) {
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
            if ($recurring->type !== 'earning' && $recurring->type !== 'spending') {
                throw new Exception('Unknown type "' . $recurring->type . '" for recurring');
            }

            if ($recurring->type === 'earning') {
                $earning = new Earning();
                $earning->space_id = $recurring->space_id;
                $earning->recurring_id = $recurring->id;
                $earning->happened_on = date('Y-m-d');
                $earning->description = $recurring->description;
                $earning->amount = $recurring->amount;
                $earning->save();
            }

            if ($recurring->type === 'spending') {
                $spending = new Spending();
                $spending->space_id = $recurring->space_id;
                $spending->recurring_id = $recurring->id;
                $spending->tag_id = $recurring->tag_id;
                $spending->happened_on = date('Y-m-d');
                $spending->description = $recurring->description;
                $spending->amount = $recurring->amount;
                $spending->save();
            }

            $recurring->last_used_on = date('Y-m-d');
            $recurring->save();
        }
    }
}
