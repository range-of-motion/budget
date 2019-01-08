<?php

namespace App\Events;

use App\Import;
use App\Activity;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class ImportCreated {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Import $import) {
        Activity::create([
            'space_id' => $import->space_id,
            'user_id' => Auth::user()->id,
            'entity_id' => $import->id,
            'entity_type' => 'import',
            'action' => 'import.created'
        ]);
    }
}
