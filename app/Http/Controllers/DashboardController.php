<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class DashboardController extends Controller {
    public function index() {
        $user = Auth::user();

        $spendingsToday = $user->spendings()->whereRaw('DATE(date) = ?', [date('Y-m-d')])->sum('amount') * 100;
        $spendingsMonth = $user->spendings()->whereRaw('MONTH(date) = ?', [date('m')])->sum('amount') * 100;

        $recentEarnings = $user
            ->earnings()
            ->orderBy('date', 'DESC')
            ->limit(3)
            ->get();

        $recentSpendings = $user
            ->spendings()
            ->orderBy('date', 'DESC')
            ->limit(3)
            ->get();

        return view('dashboard', [
            'currency' => $user->currency,

            'spendingsToday' => $spendingsToday,
            'spendingsMonth' => $spendingsMonth,

            'recentEarnings' => $recentEarnings,
            'recentSpendings' => $recentSpendings
        ]);
    }
}
