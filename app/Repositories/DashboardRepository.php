<?php

namespace App\Repositories;

use App\Helper;

class DashboardRepository
{
    public function getBalance(string $year, string $month)
    {
        return session('space')->monthlyBalance($year, $month);
    }

    public function getRecurrings(string $year, string $month)
    {
        return session('space')->monthlyRecurrings($year, $month);
    }

    public function getLeftToSpend(string $year, string $month)
    {
        $balance = $this->getBalance($year, $month);
        $sumRecurrings = $this->getRecurrings($year, $month);

        return max($balance - $sumRecurrings, 0);
    }

    // TODO MOVE TO SPENDINGREPOSITORY IN FUTURE
    public function getTotalAmountSpent(string $year, string $month)
    {
        return session('space')
            ->spendings()
            ->whereRaw('YEAR(happened_on) = ? AND MONTH(happened_on) = ?', [$year, $month])
            ->sum('amount');
    }

    public function getDailyBalance(string $year, string $month): array
    {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $balanceTick = 0;
        $dailyBalance = [];

        for ($i = 1; $i <= $daysInMonth; $i ++) {
            $balanceTick -= session('space')
                ->spendings()
                ->where('happened_on', $year . '-' . $month . '-' . $i)
                ->sum('amount');

            $balanceTick += session('space')
                ->earnings()
                ->where('happened_on', $year . '-' . $month . '-' . $i)
                ->sum('amount');

            $dailyBalance[$i] = Helper::formatNumber($balanceTick / 100);
        }

        return $dailyBalance;
    }
}
