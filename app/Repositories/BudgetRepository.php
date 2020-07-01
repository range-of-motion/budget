<?php

namespace App\Repositories;

use App\Models\Budget;
use App\Models\Spending;
use Exception;

class BudgetRepository
{
    public function getActive()
    {
        $today = date('Y-m-d');

        return Budget::whereRaw('space_id = ?', [session('space')->id])
            ->whereRaw('starts_on <= ?', [$today])
            ->whereRaw('(ends_on >= ? OR ends_on IS NULL)', [$today])
            ->get();
    }

    public function getById(int $id): ?Budget
    {
        return Budget::find($id);
    }

    public function getSpentById(int $id): int
    {
        $budget = $this->getById($id);

        if (!$budget) {
            throw new Exception('Could not find budget (where ID is ' . $id . ')');
        }

        if ($budget->period === 'yearly') {
            return Spending::where('space_id', session('space')->id)
                ->where('tag_id', $budget->tag->id)
                ->whereRaw('YEAR(happened_on) = ?', [date('Y')])
                ->sum('amount');
        }

        if ($budget->period === 'monthly') {
            return Spending::where('space_id', session('space')->id)
                ->where('tag_id', $budget->tag->id)
                ->whereRaw('MONTH(happened_on) = ?', [date('n')])
                ->whereRaw('YEAR(happened_on) = ?', [date('Y')])
                ->sum('amount');
        }

        if ($budget->period === 'weekly') {
            return Spending::where('space_id', session('space')->id)
                ->where('tag_id', $budget->tag->id)
                ->whereRaw('WEEK(happened_on) = WEEK(NOW())')
                ->sum('amount');
        }

        if ($budget->period === 'daily') {
            return Spending::where('space_id', session('space')->id)
                ->where('tag_id', $budget->tag->id)
                ->whereRaw('happened_on = ?', [date('Y-m-d')])
                ->sum('amount');
        }

        throw new Exception('No clue what to do with period "' . $budget->period . '"');
    }
}
