<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class DashboardController extends Controller {
    public function __invoke() {
        $space_id = session('space')->id;

        $totalEarnings = session('space')
            ->earnings()
            ->whereRaw('MONTH(happened_on) = ?', [date('m')])
            ->sum('amount');

        $totalSpendings = session('space')
            ->spendings()
            ->whereRaw('MONTH(happened_on) = ?', [date('m')])
            ->sum('amount');

        $recentEarnings = session('space')
            ->earnings()
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->get();

        $recentSpendings = session('space')
            ->spendings()
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->get();

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
            'recentEarnings' => $recentEarnings,
            'recentSpendings' => $recentSpendings,

            'month' => date('n'),
            'totalEarnings' => $totalEarnings,
            'totalSpendings' => $totalSpendings,
            'mostExpensiveTags' => $mostExpensiveTags,
        ]);
    }
}
