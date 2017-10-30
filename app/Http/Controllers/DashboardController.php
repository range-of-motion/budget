<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class DashboardController extends Controller {
    public function index($year = null, $month = null) {
        if (!$year && !$month) {
            $year = date('Y');

            $month = date('n');
        }

        $previousYear = $year;
        $previousMonth = $month - 1;
        $nextYear = $year;
        $nextMonth = $month + 1;

        if ($previousMonth < 1) {
            $previousYear --;
            $previousMonth = 12;
        } else if ($nextMonth > 12) {
            $nextYear ++;
            $nextMonth = 1;
        }

        $user = Auth::user();

        $currency = $user->currency;

        $earnings = $user->earnings()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        $spendings = $user->spendings()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        $budgets = $user->budgets()
          ->where('year', $year)
          ->where('month', $month)
          ->get();

        return view('dashboard.index', compact(
            'year',
            'month',
            'previousYear',
            'nextYear',
            'previousMonth',
            'nextMonth',
            'currency',
            'earnings',
            'spendings',
            'budgets'
        ));
    }
}
