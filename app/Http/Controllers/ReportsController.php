<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Earning;
use App\Spending;
use App\Budget;

use Auth;

class ReportsController extends Controller {
    public function index() {
        $user = Auth::user();

        $budgets = Budget::where('user_id', $user->id)
            ->groupBy('year', 'month')
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'DESC')
            ->get(['id', 'year', 'month']);

        return view('reports.index', compact('budgets'));
    }

    public function show($year, $month) {
        $user = Auth::user();

        $currency = view('partials.currency');

        $earnings = Earning::where('user_id', $user->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');

        $spendings = Spending::where('user_id', $user->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');

        $budgets = Budget::where('user_id', $user->id)
            ->where('year', $year)
            ->where('month', $month)
            ->get();

        return view('reports.show', compact('year', 'month', 'currency', 'earnings', 'spendings', 'budgets'));
    }
}
