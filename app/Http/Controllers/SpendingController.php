<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;

use App\Models\Spending;
use App\Models\Tag;

use Auth;

class SpendingController extends Controller {
    public function create() {
        $tags = session('space')->tags()->orderBy('created_at', 'DESC')->get();

        return view('spendings.create', compact('tags'));
    }

    public function show(Request $request, Spending $spending)
    {
        $this->authorize('view', $spending);

        return view('spendings.show', [
            'spending' => $spending
        ]);
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
        $spending->amount = Helper::rawNumberToInteger($request->input('amount'));

        $spending->save();

        return redirect()->route('dashboard');
    }

    public function edit(Spending $spending) {
        $this->authorize('edit', $spending);

        $tags = session('space')->tags()->orderBy('created_at', 'DESC')->get();

        return view('spendings.edit', compact('tags', 'spending'));
    }

    public function update(Request $request, Spending $spending) {
        $this->authorize('update', $spending);

        // TODO MOVE TO CENTRAL PLACE FOR REUSABILITY
        $request->validate([
            'tag_id' => 'nullable|exists:tags,id', // TODO CHECK IF TAG BELONGS TO USER
            'date' => 'required|date|date_format:Y-m-d',
            'description' => 'required|max:255',
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/'
        ]);

        $spending->fill([
            'tag_id' => $request->input('tag_id'),
            'happened_on' => $request->input('date'),
            'description' => $request->input('description'),
            'amount' => Helper::rawNumberToInteger($request->input('amount'))
        ])->save();

        return redirect()->route('transactions.index');
    }

    public function destroy(Spending $spending) {
        $this->authorize('delete', $spending);

        $restorableSpending = $spending->id;

        $spending->delete();

        return redirect()
            ->route('transactions.index');
    }

    public function restore($id) {
        $spending = Spending::withTrashed()->find($id);

        if (!$spending) {
            // 404
        }

        $this->authorize('restore', $spending);

        $spending->restore();

        return redirect()->route('transactions.index');
    }
}
