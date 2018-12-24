<?php

namespace App\Events;

use App\Notification;
use App\Recurring;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class RecurringDeleted {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Recurring $recurring) {
        Notification::create([
            'space_id' => $recurring->space_id,
            'user_id' => Auth::user()->id,
            'entity_id' => $recurring->id,
            'entity_type' => 'recurring',
            'action' => 'recurring.deleted'
        ]);
    }
}
