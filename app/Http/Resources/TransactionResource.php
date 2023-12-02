<?php

namespace App\Http\Resources;

use App\Models\Earning;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $isEarning = get_class($this->resource) === Earning::class;

        return [
            'id' => $this->id,
            'tag' => !$isEarning && $this->tag_id ? new TagResource($this->tag) : null,
            'type' => $isEarning ? 'earning' : 'spending',
            'happened_on' => $this->happened_on,
            'description' => $this->description,
            'amount' => $this->amount,
        ];
    }
}
