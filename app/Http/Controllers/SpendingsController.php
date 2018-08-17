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
        $tag_id = $request->input('tag_id');
        $date = $request->input('date');
        $description = $request->input('description');
        $amount = $request->input('amount');

        $spending = new Spending;

        $spending->user_id = Auth::user()->id;
        $spending->tag_id = $tag_id;
        $spending->date = $date;
        $spending->description = $description;
        $spending->amount = $amount;

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
