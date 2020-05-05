<?php

namespace App\Events;

use App\Models\Activity;
use App\Models\Tag;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class TagDeleted {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Tag $tag) {
        $userId = null;

        if (Auth::check()) {
            $userId = Auth::user()->id;
        }

        Activity::create([
            'space_id' => $tag->space_id,
            'user_id' => $userId,
            'entity_id' => $tag->id,
            'entity_type' => 'tag',
            'action' => 'tag.deleted'
        ]);
    }
}
