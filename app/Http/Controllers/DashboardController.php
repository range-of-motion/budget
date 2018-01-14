<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

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

        $spendingsByTag = DB::select('
            SELECT
                tags.id,
                tags.name,
                SUM(spendings.amount) AS spendings
            FROM tags
            INNER JOIN spendings
                ON spendings.tag_id = tags.id
            WHERE YEAR(spendings.date) = ? AND MONTH(spendings.date) = ?
            GROUP BY tags.id
            ORDER BY spendings DESC
        ', [$year, $month]);

        $totalEarnings = $user->earnings()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');

        $totalSpendings = $user->spendings()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');

        $balance = $totalEarnings - $totalSpendings;

        $earnings = $user->earnings()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'DESC')
            ->get();

        $spendings = $user->spendings()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'DESC')
            ->get();

        $budgets = $user->budgets()
            ->where('year', $year)
            ->where('month', $month)
            ->get();

        $spendingsByTags = [];

        foreach ($spendings as $spending) {
            if ($spending->tag) {
                if (!isset($spendingsByTag[$spending->tag->name])) {
                    $spendingsByTags[$spending->tag->name] = 0;
                }

                $spendingsByTags[$spending->tag->name] += $spending->amount;
            }
        }

        return view('dashboard', compact(
            'year',
            'month',
            'previousYear',
            'nextYear',
            'previousMonth',
            'nextMonth',
            'currency',
            '$spendingsByTag',
            'totalEarnings',
            'totalSpendings',
            'balance',
            'earnings',
            'spendings',
            'budgets',
            'spendingsByTags'
        ));
    }
}
