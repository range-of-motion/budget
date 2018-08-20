<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Earning;

use Auth;

class EarningsController extends Controller {
    public function index() {
        $user = Auth::user();

        $earnings = $user
            ->earnings()
            ->orderBy('happened_on', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('earnings.index', compact('earnings'));
    }

    public function create() {
        return view('earnings.create');
    }

    public function store(Request $request) {
        $request->validate([
            'date' => 'required|date|date_format:Y-m-d',
            'description' => 'required|max:255',
            'amount' => 'required|regex:/^\d*(\.\d{1,2})?$/'
        ]);

        $earning = new Earning;

        $earning->user_id = Auth::user()->id;
        $earning->happened_on = $request->input('date');
        $earning->description = $request->input('description');
        $earning->amount = $request->input('amount');

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
