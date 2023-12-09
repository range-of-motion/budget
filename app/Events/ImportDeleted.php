<?php

namespace App\Events;

use App\Models\Import;
use App\Models\Activity;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Auth;

class ImportDeleted
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(Import $import)
    {
        $userId = null;

        if (Auth::check()) {
            $userId = Auth::user()->id;
        } elseif (request()->get('apiKey')) {
            $userId = request()->get('apiKey')->user_id;
        }

        Activity::create([
            'space_id' => $import->space_id,
            'user_id' => $userId,
            'entity_id' => $import->id,
            'entity_type' => 'import',
            'action' => 'import.deleted'
        ]);
    }
}
