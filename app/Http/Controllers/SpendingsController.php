<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Spending;
use App\Tag;

use Auth;

class SpendingsController extends Controller {
    public function index(Request $request) {
        $user = Auth::user();

        $spendings = $user
            ->spendings()
            ->orderBy('happened_on', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('spendings.index', compact('spendings'));
    }

    public function create() {
        $tags = Tag::where('user_id', Auth::user()->id)->get();

        return view('spendings.create', compact('tags'));
    }

    public function store(Request $request) {
        $request->validate([
            'tag_id' => 'nullable|exists:tags,id', // TODO CHECK IF TAG BELONGS TO USER
            'date' => 'required|date|date_format:Y-m-d',
            'description' => 'required|max:255',
            'amount' => 'required|regex:/^\d*(\.\d{1,2})?$/'
        ]);

        $spending = new Spending;

        $spending->user_id = Auth::user()->id;
        $spending->tag_id = $request->input('tag_id');
        $spending->happened_on = $request->input('date');
        $spending->description = $request->input('description');
        $spending->amount = $request->input('amount');

        $spending->save();

        return redirect()->route('dashboard');
    }

    public function show(Spending $spending) {
        $user = Auth::user();

        $currency = $user->currency;

        return view('spendings.show', compact('currency', 'spending'));
    }

    public function destroy(Spending $spending) {
        $year = date('Y', strtotime($spending->date));
        $month = date('n', strtotime($spending->date));

        $spending->delete();

        return redirect()->route('dashboard', compact('year', 'month'));
    }
}
