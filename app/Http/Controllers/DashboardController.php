<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class DashboardController extends Controller {
    public function index() {
        $user = Auth::user();

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
            'recentEarnings' => $recentEarnings,
            'recentSpendings' => $recentSpendings
        ]);
    }
}
