<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Budget;

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

    public function create() {
        $tags = Auth::user()->tags;

        return view('budgets.create', compact('tags'));
    }

    public function store(Request $request) {
        $budget = new Budget;

        $budget->user_id = Auth::user()->id;
        $budget->tag_id = $request->tag;
        $budget->year = $request->year;
        $budget->month = $request->month;
        $budget->amount = $request->amount;

        $budget->save();

        return redirect('/budgets');
    }
}
