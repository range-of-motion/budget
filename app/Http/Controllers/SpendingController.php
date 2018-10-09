<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Spending;
use App\Tag;

use Auth;

class SpendingController extends Controller {
    public function index(Request $request) {
        $spendingsByMonth = [];

        for ($month = 12; $month >= 1; $month --) {
            $spendingsByMonth[$month] = session('space')
                ->spendings()
                ->whereYear('happened_on', date('Y'))
                ->whereMonth('happened_on', $month)
                ->orderBy('happened_on', 'DESC')
                ->get();
        }

        return view('spendings.index', compact('spendingsByMonth'));
    }

    public function create() {
        $tags = session('space')->tags()->orderBy('created_at', 'DESC')->get();

        return view('spendings.create', compact('tags'));
    }

    public function store(Request $request) {
        $request->validate([
            'tag_id' => 'nullable|exists:tags,id', // TODO CHECK IF TAG BELONGS TO USER
            'date' => 'required|date|date_format:Y-m-d',
            'description' => 'required|max:255',
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/'
        ]);

        $spending = new Spending;

        $spending->space_id = session('space')->id;
        $spending->tag_id = $request->input('tag_id');
        $spending->happened_on = $request->input('date');
        $spending->description = $request->input('description');
        $spending->amount = (int) ($request->input('amount') * 100);

        $spending->save();

        return redirect()->route('dashboard');
    }

    public function destroy(Spending $spending) {
        $this->authorize('delete', $spending);

        $spending->delete();

        return redirect()->route('spendings.index');
    }
}
