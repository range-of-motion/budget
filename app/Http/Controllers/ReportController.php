<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller {
    public function index() {
        return view('reports.index');
    }

    public function show($slug) {
        if ($slug == 'weekly-report-2018') {
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

        return '404';
    }
}
