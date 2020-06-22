<?php

namespace App\Repositories;

use App\Models\Recurring;
use Exception;

class RecurringRepository
{
    public function getValidationRules(): array
    {
        return [
            'type' => 'required|in:earning,spending',
            'day' => ['required',
                'regex:/\b(0?[1-9]|[12][0-9]|3[01])\b/',
            ],
            'end' => 'nullable|date|date_format:Y-m-d',
            'tag' => 'nullable|exists:tags,id', // TODO CHECK IF TAG BELONGS TO USER
            'description' => 'required|max:255',
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/'
        ];
    }

    public function create(
        int $spaceId,
        string $type,
        int $day,
        ?string $endDate,
        ?int $tagId,
        string $description,
        string $amount
    ): Recurring {
        if ($type !== 'earning' && $type !== 'spending') {
            throw new Exception('Unknown type "' . $type . '"');
        }

        return Recurring::create([
            'space_id' => $spaceId,
            'type' => $type,
            'interval' => 'monthly',
            'day' => $day,
            'starts_on' => date('Y-m-d'),
            'ends_on' => $endDate,
            'tag_id' => $tagId,
            'description' => $description,
            'amount' => $amount
        ]);
    }
}
