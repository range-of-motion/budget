<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Repositories\TagRepository;
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

            $weeks[$i] = Helper::formatNumber($balance / 100);
        }

        return view('reports.weekly_report', [
            'year' => $year,
            'weeks' => $weeks
        ]);
    }

    private function mostExpensiveTags() {
        $totalSpent = session('space')->spendings()->sum('amount');

        $tagRepository = new TagRepository();
        $mostExpensiveTags = $tagRepository->getMostExpensiveTags(session('space')->id);

        return view('reports.most_expensive_tags', compact('totalSpent', 'mostExpensiveTags'));
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
