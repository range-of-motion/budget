<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class DashboardController extends Controller {
    public function __invoke() {
        $user = Auth::user();

        $totalSpendings = $user
            ->spendings()
            ->whereRaw('MONTH(happened_on) = ?', [date('m')])
            ->sum('amount');

        $mostExpensiveTag = DB::select('
            SELECT
                tags.name AS name
            FROM
                tags
            LEFT OUTER JOIN
                spendings ON tags.id = spendings.tag_id
            WHERE
                tags.user_id = ?
                AND MONTH(happened_on) = ?
            GROUP BY
                tags.id
            HAVING
                SUM(spendings.amount) > 0
            ORDER BY
                SUM(spendings.amount) DESC
            LIMIT 1;
        ', [$user->id, date('m')]);

        $mostExpensiveWeekday = DB::select('
            SELECT
                WEEKDAY(spendings.happened_on) AS weekday
            FROM
                spendings
            WHERE
                spendings.user_id = ?
                AND MONTH(happened_on) = ?
            GROUP BY
                WEEKDAY(spendings.happened_on)
            ORDER BY
                SUM(spendings.amount) DESC
            LIMIT 1;
        ', [$user->id, date('m')]);

        $recentSpendings = $user
            ->spendings()
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->get();

        $tagsBreakdown = DB::select('
            SELECT
                tags.name AS name,
                SUM(spendings.amount) AS amount
            FROM
                tags
            LEFT OUTER JOIN
                spendings ON tags.id = spendings.tag_id
            WHERE
                tags.user_id = ?
                AND MONTH(happened_on) = ?
            GROUP BY
                tags.id
            HAVING
                SUM(spendings.amount) > 0;
        ', [$user->id, date('m')]);

        return view('dashboard', [
            'currency' => $user->currency,

            'month' => date('n'),

            'totalSpendings' => $totalSpendings,
            'mostExpensiveTag' => $mostExpensiveTag,
            'mostExpensiveWeekday' => $mostExpensiveWeekday,

            'recentSpendings' => $recentSpendings,
            'tagsBreakdown' => $tagsBreakdown,

            'earningsCount' => $user->earnings->count(),
            'spendingsCount' => $user->spendings->count()
        ]);
    }
}
