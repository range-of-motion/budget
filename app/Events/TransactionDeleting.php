<?php

namespace App\Events;

use App\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TransactionDeleting {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct($transaction) {
        Notification::create([
            'space_id' => $transaction->space_id,
            'user_id' => \Auth::user()->id,
            'action' => 'transaction.deleted'
        ]);
    }
}
