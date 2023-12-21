<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImportResource extends JsonResource
{
    /** @var Import $resource */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'status' => $this->resource->status,
            'created_at' => $this->resource->created_at,
        ];
    }
}
