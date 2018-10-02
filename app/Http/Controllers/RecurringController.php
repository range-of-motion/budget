<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recurring;
use Auth;

class RecurringController extends Controller {
    public function index() {
        $user = Auth::user();

        return view('recurrings.index', [
            'currency' => $user->currency,
            'recurrings' => $user->recurrings()->orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function show(Recurring $recurring) {
        $this->authorize('view', $recurring);

        return view('recurrings.show', compact('recurring'));
    }

    public function create() {
        $user = Auth::user();

        return view('recurrings.create', [
            'tags' => $user->tags
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'day' => 'required|integer|between:1,28',
            'end' => 'required|date|date_format:Y-m-d',
            'tag' => 'nullable|exists:tags,id', // TODO CHECK IF TAG BELONGS TO USER
            'description' => 'required|max:255',
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/'
        ]);

        $user = Auth::user();

        $recurring = new Recurring;

        $recurring->user_id = $user->id;
        $recurring->type = 'monthly';
        $recurring->day = $request->input('day');
        $recurring->starts_on = date('Y-m-d');
        $recurring->ends_on = $request->input('end');
        $recurring->tag_id = $request->input('tag');
        $recurring->description = $request->input('description');
        $recurring->amount = (int) ($request->input('amount') * 100);

        $recurring->save();

        return redirect()->route('recurrings.show', ['id' => $recurring->id]);
    }
}
