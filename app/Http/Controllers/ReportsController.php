<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class ReportsController extends Controller {
    public function get() {
        $user = Auth::user();

        $currentYear = date('Y');

        $monthlyEarnings = [];

        for ($i = 1; $i <= 12; $i ++) {
            $monthlyEarnings[] = $user->earnings()->whereRaw('MONTH(date) = ?', [$i])->sum('amount');
        }

        $monthlySpendings = [];

        for ($i = 1; $i <= 12; $i ++) {
            $monthlySpendings[] = $user->spendings()->whereRaw('MONTH(date) = ?', [$i])->sum('amount');
        }

        return view('reports', compact('currentYear', 'monthlyEarnings', 'monthlySpendings'));
    }
}
