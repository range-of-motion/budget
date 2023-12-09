<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->user
                ? ['id' => $this->user->id, 'name' => $this->user->name]
                : null,
            'entity_id' => $this->entity_id,
            'entity_type' => $this->entity_type,
            'action' => $this->action,
            'occurred_at' => $this->created_at,
        ];
    }
}
