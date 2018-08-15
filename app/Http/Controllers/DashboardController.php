<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class DashboardController extends Controller {
    public function __invoke() {
        $user = Auth::user();

        $spendingsToday = $user
            ->spendings()
            ->whereRaw('DATE(happened_on) = ?', [date('Y-m-d')])
            ->sum('amount');

        $spendingsMonth = $user
            ->spendings()
            ->whereRaw('MONTH(happened_on) = ?', [date('m')])
            ->sum('amount');

        $mostExpensiveTag = DB::select('
            SELECT
                tags.name AS name,
                SUM(spendings.amount) AS amount
            FROM
                tags
            LEFT OUTER JOIN
                spendings ON tags.id = spendings.tag_id
            WHERE
                tags.user_id = ?
            GROUP BY
                tags.id
            ORDER BY
                SUM(spendings.amount) DESC
            LIMIT 1;
        ', [$user->id])[0];

        $mostExpensiveWeekday = DB::select('
            SELECT
                WEEKDAY(spendings.happened_on) AS weekday
            FROM
                spendings
            WHERE
                spendings.user_id = ?
            GROUP BY
                WEEKDAY(spendings.happened_on)
            ORDER BY
                SUM(spendings.amount) DESC
            LIMIT 1;
        ', [$user->id]);

        return view('dashboard', [
            'currency' => $user->currency,

            'spendingsToday' => $spendingsToday,
            'spendingsMonth' => $spendingsMonth,
            'mostExpensiveTag' => $mostExpensiveTag,
            'mostExpensiveWeekday' => $mostExpensiveWeekday,

            'earningsCount' => $user->earnings->count(),
            'spendingsCount' => $user->spendings->count()
        ]);
    }
}
