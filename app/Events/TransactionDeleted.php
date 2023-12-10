<?php

namespace App\Events;

use App\Models\Earning;
use App\Models\Activity;
use App\Models\Spending;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Auth;

class TransactionDeleted
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct($transaction)
    {
        $userId = null;

        if (Auth::check()) {
            $userId = Auth::user()->id;
        } elseif (request()->get('apiKey')) {
            $userId = request()->get('apiKey')->user_id;
        }

        if ($transaction instanceof Earning) {
            $entityType = 'earning';
        }

        if ($transaction instanceof Spending) {
            $entityType = 'spending';
        }

        Activity::create([
            'space_id' => $transaction->space_id,
            'user_id' => $userId,
            'entity_id' => $transaction->id,
            'entity_type' => $entityType,
            'action' => 'transaction.deleted'
        ]);
    }
}
