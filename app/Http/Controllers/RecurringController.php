<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recurring;
use Auth;
use App\Jobs\ProcessRecurrings;

class RecurringController extends Controller {
    public function index() {
        return view('recurrings.index', [
            'recurrings' => session('space')->recurrings()->orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function show(Recurring $recurring) {
        $this->authorize('view', $recurring);

        return view('recurrings.show', compact('recurring'));
    }

    public function create() {
        $tags = [];

        foreach (session('space')->tags as $tag) {
            $tags[] = ['key' => $tag->id, 'label' => $tag->name];
        }

        return view('recurrings.create', compact('tags'));
    }

    public function store(Request $request) {
        $request->validate([
            'day' => ['required',
                      'regex:/\b(0?[1-9]|[12][0-9]|3[01])\b/',
                    ],
            'end' => 'nullable|date|date_format:Y-m-d',
            'tag' => 'nullable|exists:tags,id', // TODO CHECK IF TAG BELONGS TO USER
            'description' => 'required|max:255',
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/'
        ]);

        $user = Auth::user();

        $recurring = new Recurring;

        $recurring->space_id = session('space')->id;
        $recurring->type = 'monthly';
        $recurring->day = ltrim($request->input('day'), '0');
        $recurring->starts_on = date('Y-m-d');
        $recurring->ends_on = $request->input('end');
        $recurring->tag_id = $request->input('tag');
        $recurring->description = $request->input('description');
        $recurring->amount = (int) ($request->input('amount') * 100);

        $recurring->save();
        ProcessRecurrings::dispatch();

        return redirect()->route('recurrings.show', ['recurring' => $recurring->id]);
    }
}
