<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Spending;
use App\Tag;

use Auth;

class SpendingsController extends Controller {
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

    public function show($id) {
        $user = Auth::user();

        $currency = $user->currency;

        $spending = Spending::find($id);

        if ($spending->user_id === $user->id) {
            return view('spendings.show', compact('currency', 'spending'));
        }

        return view('errors.404');
    }

    public function destroy($id) {
        $spending = Spending::find($id);

        $year = date('Y', strtotime($spending->date));
        $month = date('n', strtotime($spending->date));

        $spending->delete();

        return redirect()->route('dashboard', compact('year', 'month'));
    }
}
