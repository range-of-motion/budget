<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller {
    public function index() {
        return view('reports.index');
    }

    private function weeklyReport($year) {
        $weeks = [];
        $balance = 0;

        $weekMode = 3;

        if (date('w', strtotime($year . '-01-01')) == 1) {
            $weekMode = 7;
        }

        for ($i = 1; $i <= 53; $i ++) { // This used to be 52, IDK what happens after we moved it to 53
            $balance += session('space')
                ->earnings()
                ->whereRaw('YEAR(happened_on) = ? AND WEEK(happened_on, ?) = ?', [$year, $weekMode, $i])
                ->sum('amount');

            $balance -= session('space')
                ->spendings()
                ->whereRaw('YEAR(happened_on) = ? AND WEEK(happened_on, ?) = ?', [$year, $weekMode, $i])
                ->sum('amount');

            $weeks[$i] = number_format($balance / 100, 2, '.', '');
        }

        return view('reports.weekly_report', [
            'year' => $year,
            'weeks' => $weeks
        ]);
    }

    private function mostExpensiveTags() {
        $mostExpensiveTags = DB::select('
                SELECT
                    tags.name AS name,
                    tags.color AS color,
                    SUM(spendings.amount) AS amount
                FROM
                    tags
                LEFT OUTER JOIN
                    spendings ON tags.id = spendings.tag_id AND spendings.deleted_at IS NULL
                WHERE
                    tags.space_id = ?
                GROUP BY
                    tags.id
                # HAVING
                    # SUM(spendings.amount) > 0
                ORDER BY
                    SUM(spendings.amount) DESC;
            ', [session('space')->id]);

        $totalSpent = session('space')->spendings()->sum('amount');

        return view('reports.most_expensive_tags', compact('mostExpensiveTags', 'totalSpent'));
    }

    public function show(Request $request, $slug) {
        switch ($slug) {
            case 'weekly-report':
                $year = date('Y');

                if ($request->get('year')) {
                    $year = $request->get('year');
                }

                return $this->weeklyReport($year);

            case 'most-expensive-tags':
                return $this->mostExpensiveTags();

            default:
                return '404';
        }
    }
}
