<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class DashboardController extends Controller {
    public function index() {
        $user = Auth::user();

        $year = date('Y');
        $month = date('n');

        $currency = $user->currency;

        $earnings = $user->earnings()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');

        $spendings = $user->spendings()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');

        return view('dashboard.index', compact('currency', 'month', 'earnings', 'spendings'));
    }
}
