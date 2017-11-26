<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Earning;

use Auth;

class EarningsController extends Controller {
    public function create() {
        return view('earnings.create');
    }

    public function store(Request $request) {
        $date = $request->input('date');
        $description = $request->input('description');
        $amount = $request->input('amount');

        $earning = new Earning;

        $earning->user_id = Auth::user()->id;
        $earning->date = $date;
        $earning->description = $description;
        $earning->amount = $amount;

        $earning->save();

        return redirect()->route('dashboard');
    }

    public function show(Earning $earning) {
        $user = Auth::user();

        $currency = $user->currency;

        return view('earnings.show', compact('currency', 'earning'));
    }

    public function destroy(Earning $earning) {
        $year = date('Y', strtotime($earning->date));
        $month = date('n', strtotime($earning->date));

        $earning->delete();

        return redirect()->route('dashboard', compact('year', 'month'));
    }
}
