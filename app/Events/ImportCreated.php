<?php

namespace App\Events;

use App\Models\Import;
use App\Models\Activity;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Auth;

class ImportCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(Import $import)
    {
        Activity::create([
            'space_id' => $import->space_id,
            'user_id' => Auth::user()->id,
            'entity_id' => $import->id,
            'entity_type' => 'import',
            'action' => 'import.created'
        ]);
    }
}
