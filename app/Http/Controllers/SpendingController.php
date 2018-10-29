<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Spending;
use App\Tag;

use Auth;

class SpendingController extends Controller {
    public function index(Request $request) {
        $filter = false;

        $spendingsByMonth = [];

        for ($month = 12; $month >= 1; $month --) {
            $query = session('space')
                ->spendings()
                ->whereYear('happened_on', date('Y'))
                ->whereMonth('happened_on', $month);


            if ($import_id = $request->get('filter_by_import')) {
                $filter = 'import';

                $query->where('import_id', $import_id);
            }

            $spendingsThisMonth = $query->orderBy('happened_on', 'DESC')
                ->get();

            if (count($spendingsThisMonth)) {
                $spendingsByMonth[$month] = $spendingsThisMonth;
            }
        }

        return view('spendings.index', compact('filter', 'spendingsByMonth'));
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

        $restorableSpending = $spending->id;

        $spending->delete();

        return redirect()
            ->route('spendings.index')
            ->with([
                'restorableSpending' => $restorableSpending
            ]);
    }

    public function restore($id) {
        $spending = Spending::withTrashed()->find($id);

        if (!$spending) {
            // 404
        }

        $this->authorize('restore', $spending);

        $spending->restore();

        return redirect()->route('spendings.index');
    }
}
