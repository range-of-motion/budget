<?php

namespace App\Events;

use App\Earning;
use App\Notification;
use App\Spending;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TransactionCreated {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct($transaction) {
        if ($transaction instanceof Earning) {
            $entityType = 'earning';
        }

        if ($transaction instanceof Spending) {
            $entityType = 'spending';
        }

        Notification::create([
            'space_id' => $transaction->space_id,
            'user_id' => \Auth::user()->id,
            'entity_id' => $transaction->id,
            'entity_type' => $entityType,
            'action' => 'transaction.created'
        ]);
    }
}
