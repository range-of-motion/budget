<?php

namespace App\Events;

use App\Models\Activity;
use App\Models\Tag;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Auth;

class TagCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(Tag $tag)
    {
        $userId = null;

        if (Auth::check()) {
            $userId = Auth::user()->id;
        } elseif (request()->get('apiKey')) {
            $userId = request()->get('apiKey')->user_id;
        }

        Activity::create([
            'space_id' => $tag->space_id,
            'user_id' => $userId,
            'entity_id' => $tag->id,
            'entity_type' => 'tag',
            'action' => 'tag.created'
        ]);
    }
}
