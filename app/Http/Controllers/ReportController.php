<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller {
    public function index() {
        return view('reports.index');
    }

    private function weeklyReport2018() {
        $weeks = [];
        $balance = 0;

        for ($i = 1; $i <= 52; $i ++) {
            $balance += session('space')
                ->earnings()
                ->whereRaw('YEARWEEK(happened_on) = ?', [2018 . sprintf('%02d', $i)])
                ->sum('amount');

            $balance -= session('space')
                ->spendings()
                ->whereRaw('YEARWEEK(happened_on) = ?', [2018 . sprintf('%02d', $i)])
                ->sum('amount');

            $weeks[$i] = number_format($balance / 100, 2, '.', '');
        }

        return view('reports.weekly_report', [
            'year' => 2018,
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

    public function show($slug) {
        switch ($slug) {
            case 'weekly-report-2018':
                return $this->weeklyReport2018();

            case 'most-expensive-tags':
                return $this->mostExpensiveTags();

            default:
                return '404';
        }
    }
}
