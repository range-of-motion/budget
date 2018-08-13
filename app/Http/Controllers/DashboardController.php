<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class DashboardController extends Controller {
    public function index() {
        $user = Auth::user();

        $spendingsToday = $user
            ->spendings()
            ->whereRaw('DATE(happened_on) = ?', [date('Y-m-d')])
            ->sum('amount');

        $spendingsMonth = $user
            ->spendings()
            ->whereRaw('MONTH(happened_on) = ?', [date('m')])
            ->sum('amount');

        $recentEarnings = $user
            ->earnings()
            ->orderBy('happened_on', 'DESC')
            ->limit(3)
            ->get();

        $recentSpendings = $user
            ->spendings()
            ->orderBy('happened_on', 'DESC')
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
