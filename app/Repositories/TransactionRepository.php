<?php

namespace App\Repositories;

use App\Helper;
use App\Models\Earning;
use App\Models\Spending;

class TransactionRepository
{
    public function getWeeklyBalance(string $year): array
    {
        $weeks = [];
        $balance = 0;

        $weekMode = 3;

        if (date('w', strtotime($year . '-01-01')) == 1) {
            $weekMode = 7;
        }

        for ($i = 1; $i <= 53; $i++) { // This used to be 52, IDK what happens after we moved it to 53
            $balance += Earning::ofSpace(session('space_id'))
                ->whereRaw('YEAR(happened_on) = ? AND WEEK(happened_on, ?) = ?', [$year, $weekMode, $i])
                ->sum('amount');

            $balance -= Spending::ofSpace(session('space_id'))
                ->whereRaw('YEAR(happened_on) = ? AND WEEK(happened_on, ?) = ?', [$year, $weekMode, $i])
                ->sum('amount');

            $weeks[$i] = Helper::formatNumber($balance / 100);
        }

        return $weeks;
    }

    /**
     * Get All Transaction from month and year
     * @param int $month
     * @param int $year
     * @param array $filterBy
     * @return array
     */
    public function getTransactionsByYearMonth(int $month, int $year, array $filterBy = []): array
    {
        $transactions = [];
        $ignoreEarnings = false;
        $earnings = Earning::ofSpace(session('space_id'))
            ->whereRaw('YEAR(`happened_on`) = ? AND MONTH(`happened_on`) = ?', [$year, $month]);

        $spendings = Spending::ofSpace(session('space_id'))
            ->whereRaw('YEAR(happened_on) = ? AND MONTH(happened_on) = ?', [$year, $month]);

        if ($filterBy) {
            if (array_key_exists("tag", $filterBy)) {
                $spendings->whereIn('tag_id', [$filterBy['tag']]);
                $ignoreEarnings = true;
            }
        }

        //If we filter by tag, not show earning because not tag on this
        if (!$ignoreEarnings) {
            foreach ($earnings->get() as $transaction) {
                $transactions[] = $transaction;
            }
        }

        foreach ($spendings->get() as $transaction) {
            $transactions[] = $transaction;
        }

        // Sort transactions
        usort($transactions, function ($a, $b) {
            return $a->happened_on < $b->happened_on;
        });

        return $transactions;
    }
}
