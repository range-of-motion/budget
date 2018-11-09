<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Earning;
use App\Recurring;
use App\Spending;
use Auth;
use DB;

class DashboardController extends Controller {
    public function __invoke() {
        $space_id = session('space')->id;
        $currentYear = date('Y');
        $currentMonth = date('m');

        $balance = session('space')->monthlyBalance($currentYear, $currentMonth);
        $recurrings = session('space')->monthlyRecurrings($currentYear, $currentMonth);
        $leftToSpend = $balance - $recurrings;

        $totalSpent = session('space')->spendings()->whereRaw('YEAR(happened_on) = ? AND MONTH(happened_on) = ?', [$currentYear, $currentMonth])->sum('amount');
        $mostExpensiveTags = DB::select('
            SELECT
                tags.name AS name,
                SUM(spendings.amount) AS amount
            FROM
                tags
            LEFT OUTER JOIN
                spendings ON tags.id = spendings.tag_id
            WHERE
                tags.space_id = ?
                AND MONTH(happened_on) = ?
            GROUP BY
                tags.id
            HAVING
                SUM(spendings.amount) > 0
            ORDER BY
                SUM(spendings.amount) DESC
            LIMIT 3;
        ', [$space_id, date('m')]);

        return view('dashboard', [
            'month' => date('n'),

            'balance' => $balance,
            'recurrings' => $recurrings,
            'leftToSpend' => $leftToSpend,

            'totalSpent' => $totalSpent,
            'mostExpensiveTags' => $mostExpensiveTags
        ]);
    }
}
