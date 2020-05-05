<?php

namespace App\Http\Controllers;

use App\Repositories\TagRepository;
use Illuminate\Http\Request;

use App\Models\Earning;
use App\Models\Recurring;
use App\Models\Spending;
use Auth;
use DB;

class DashboardController extends Controller {
    public function __invoke() {
        $space_id = session('space')->id;
        $currentYear = date('Y');
        $currentMonth = date('m');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

        $balance = session('space')->monthlyBalance($currentYear, $currentMonth);
        $recurrings = session('space')->monthlyRecurrings($currentYear, $currentMonth);
        $leftToSpend = max($balance - $recurrings, 0);

        $totalSpent = session('space')->spendings()->whereRaw('YEAR(happened_on) = ? AND MONTH(happened_on) = ?', [$currentYear, $currentMonth])->sum('amount');

        $tagRepository = new TagRepository();
        $mostExpensiveTags = $tagRepository->getMostExpensiveTags($space_id, 3, $currentYear, $currentMonth);

        $balanceTick = 0;
        $dailyBalance = [];
        for ($i = 1; $i <= $daysInMonth; $i ++) {
            $balanceTick -= session('space')
                ->spendings()
                ->where('happened_on', $currentYear . '-' . $currentMonth . '-' . $i)
                ->sum('amount');

            $balanceTick += session('space')
                ->earnings()
                ->where('happened_on', $currentYear . '-' . $currentMonth . '-' . $i)
                ->sum('amount');

            $dailyBalance[$i] = number_format($balanceTick / 100, 2);
        }

        return view('dashboard', [
            'month' => date('n'),

            'balance' => $balance,
            'recurrings' => $recurrings,
            'leftToSpend' => $leftToSpend,

            'totalSpent' => $totalSpent,
            'mostExpensiveTags' => $mostExpensiveTags,

            'daysInMonth' => $daysInMonth,
            'dailyBalance' => $dailyBalance
        ]);
    }
}
