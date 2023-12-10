<?php

namespace App\Events;

use App\Models\Activity;
use App\Models\Recurring;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Auth;

class RecurringDeleted
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(Recurring $recurring)
    {
        $userId = null;

        if (Auth::check()) {
            $userId = Auth::user()->id;
        } elseif (request()->get('apiKey')) {
            $userId = request()->get('apiKey')->user_id;
        }

        Activity::create([
            'space_id' => $recurring->space_id,
            'user_id' => $userId,
            'entity_id' => $recurring->id,
            'entity_type' => 'recurring',
            'action' => 'recurring.deleted'
        ]);
    }
}
