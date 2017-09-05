<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class BudgetsController extends Controller {
    public function index() {
        $user = Auth::user();

        $currency = $user->currency->symbol;

        $budgets = $user->budgets()
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'DESC')
            ->get();

        return view('budgets.index', compact('currency', 'budgets'));
    }
}
