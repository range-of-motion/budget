<?php

namespace App\Http\Controllers;

use App\Rules\TagBelongsToUser;
use Illuminate\Http\Request;

use App\Spending;

use Auth;
use Illuminate\Support\Facades\Validator;

class SpendingController extends Controller {
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tag_id' => ['nullable', 'exists:tags,id', new TagBelongsToUser],
            'date' => 'required', 'date', 'date_format:Y-m-d',
            'description' => 'required', 'max:255',
            'amount' => 'required', 'regex:/^\d*(\.\d{2})?$/'
        ]);
    }

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
        $this->validator($request->all())->validate();

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
            return (view('errors.404'));
        }

        $this->authorize('restore', $spending);

        $spending->restore();

        return redirect()->route('spendings.index');
    }
}
