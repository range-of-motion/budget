<?php

namespace App\Repositories;

use App\Models\Recurring;
use Exception;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * Grabs recurrings that checks all of the following statements
     *  targeted day is today, or in future if today is last day of the month
     *  has a starting date of today, or earlier
     *  has no expiration date, or one that is in the future
     *  has not been used yet, or prior to today
     */
    public function getDueMonthly(): Collection
    {
        $dayOfMonth = (int) date('j');

        $dateToday = date('Y-m-d');
        $daysInMonth = (int) date('t');

        return Recurring::where('interval', 'monthly')
            ->when($daysInMonth == $dayOfMonth, function ($query) use ($dayOfMonth) {
                return $query->where('day', '>=', $dayOfMonth);
            }, function ($query) use ($dayOfMonth) {
                return $query->where('day', $dayOfMonth);
            })
            ->where('starts_on', '<=', $dateToday)
            ->where(function ($query) use ($dateToday) {
                $query
                    ->where('ends_on', '>=', $dateToday)
                    ->orWhere('ends_on', null);
            })
            ->where(function ($query) use ($dateToday) {
                $query
                    ->where('last_used_on', '<', $dateToday)
                    ->orWhere('last_used_on', null);
            })
            ->get();
    }

    public function getDueDaily(): Collection
    {
        $dateToday = date('Y-m-d');

        return Recurring::where('interval', 'daily')
            ->where('starts_on', '<=', $dateToday)
            ->where(function ($query) use ($dateToday) {
                $query
                    ->where('ends_on', '>=', $dateToday)
                    ->orWhere('ends_on', null);
            })
            ->where(function ($query) use ($dateToday) {
                $query
                    ->where('last_used_on', '<', $dateToday)
                    ->orWhere('last_used_on', null);
            })
            ->get();
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

    public function update(int $id, array $data): void
    {
        $recurring = Recurring::find($id);

        if (!$recurring) {
            throw new Exception('Could not find recurring with ID ' . $id);
        }

        $recurring->fill($data)->save();
    }
}
