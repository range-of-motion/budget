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
            'interval' => 'required|in:' . implode(',', $this->getSupportedIntervals()),
            'day' => ['required',
                'regex:/\b(0?[1-9]|[12][0-9]|3[01])\b/',
            ],
            'start' => 'date|date_format:Y-m-d',
            'end' => 'nullable|date|date_format:Y-m-d',
            'tag' => 'nullable|exists:tags,id', // TODO CHECK IF TAG BELONGS TO USER
            'description' => 'required|max:255',
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
            'currency_id' => 'required|exists:currencies,id'
        ];
    }

    public function getSupportedIntervals(): array
    {
        return [
            'yearly',
            'monthly',
            'biweekly',
            'weekly',
            'daily'
        ];
    }

    public function getDueYearly(): Collection
    {
        $dateToday = date('Y-m-d');
        $dateYearAgo = date('Y-m-d', strtotime('-1 year'));

        return Recurring::where('interval', 'yearly')
            ->where('starts_on', '<=', $dateToday)
            ->where(function ($query) use ($dateToday) {
                $query
                    ->where('ends_on', '>=', $dateToday)
                    ->orWhere('ends_on', null);
            })
            ->where(function ($query) use ($dateYearAgo) {
                $query
                    ->where('last_used_on', '<=', $dateYearAgo)
                    ->orWhere('last_used_on', null);
            })
            ->get();
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
        $dateToday = date('Y-m-d');
        $lastDateCurrentMonth = date('Y-m-d', strtotime('last day of this month'));

        $dateMonthAgo = date('Y-m-d', strtotime('-1 month'));
        $lastDateLastMonth = date('Y-m-d', strtotime('last day of last month'));

        $query = Recurring::where('interval', 'monthly')
            ->where('starts_on', '<=', $dateToday)
            ->where(function ($query) use ($dateToday) {
                $query
                    ->where('ends_on', '>=', $dateToday)
                    ->orWhere('ends_on', null);
            });

        if ($dateToday === $lastDateCurrentMonth) {
            $query->where(function ($query) use ($lastDateLastMonth) {
                $query
                    ->where('last_used_on', '<=', $lastDateLastMonth)
                    ->orWhere('last_used_on', null);
            });
        } else {
            $query->where(function ($query) use ($dateMonthAgo) {
                $query
                    ->where('last_used_on', '<=', $dateMonthAgo)
                    ->orWhere('last_used_on', null);
            });
        }

        return $query->get();
    }

    public function getDueBiweekly(): Collection
    {
        $dateToday = date('Y-m-d');
        $dateTwoWeeksAgo = date('Y-m-d', strtotime('-2 weeks'));

        return Recurring::where('interval', 'biweekly')
            ->where('starts_on', '<=', $dateToday)
            ->where(function ($query) use ($dateToday) {
                $query
                    ->where('ends_on', '>=', $dateToday)
                    ->orWhere('ends_on', null);
            })
            ->where(function ($query) use ($dateTwoWeeksAgo) {
                $query
                    ->where('last_used_on', '<=', $dateTwoWeeksAgo)
                    ->orWhere('last_used_on', null);
            })
            ->get();
    }

    public function getDueWeekly(): Collection
    {
        $dateToday = date('Y-m-d');
        $dateWeekAgo = date('Y-m-d', strtotime('-1 week'));

        return Recurring::where('interval', 'weekly')
            ->where('starts_on', '<=', $dateToday)
            ->where(function ($query) use ($dateToday) {
                $query
                    ->where('ends_on', '>=', $dateToday)
                    ->orWhere('ends_on', null);
            })
            ->where(function ($query) use ($dateWeekAgo) {
                $query
                    ->where('last_used_on', '<=', $dateWeekAgo)
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
        string $interval,
        int $day,
        string $startDate,
        ?string $endDate,
        ?int $tagId,
        string $description,
        string $amount,
        int $currencyId
    ): Recurring {
        if ($type !== 'earning' && $type !== 'spending') {
            throw new Exception('Unknown type "' . $type . '"');
        }

        if (!in_array($interval, $this->getSupportedIntervals())) {
            throw new Exception('Unknown interval "' . $interval . '"');
        }

        return Recurring::create([
            'space_id' => $spaceId,
            'type' => $type,
            'interval' => $interval,
            'day' => $day,
            'starts_on' => $startDate,
            'ends_on' => $endDate,
            'tag_id' => $tagId,
            'description' => $description,
            'amount' => $amount,
            'currency_id' => $currencyId
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
