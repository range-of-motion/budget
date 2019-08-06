<?php

namespace App\Http\Controllers;

use App\Rules\TagBelongsToUser;
use Illuminate\Http\Request;

use App\Earning;

use Auth;
use Illuminate\Support\Facades\Validator;

class EarningController extends Controller {
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tag_id' => ['nullable', 'exists:tags,id', new TagBelongsToUser],
            'date' => 'required', 'date', 'date_format:Y-m-d',
            'description' => 'required', 'max:255',
            'amount' => 'required', 'regex:/^\d*(\.\d{2})?$/'
        ]);
    }

    public function index() {
        $earningsByMonth = [];

        for ($month = 12; $month >= 1; $month --) {
            $query = session('space')
                ->earnings()
                ->whereYear('happened_on', date('Y'))
                ->whereMonth('happened_on', $month);

            $earningsThisMonth = $query->orderBy('happened_on', 'DESC')
                ->get();

            if (count($earningsThisMonth)) {
                $earningsByMonth[$month] = $earningsThisMonth;
            }
        }

        return view('earnings.index', compact('earningsByMonth'));
    }

    public function create() {
        return view('earnings.create');
    }

    public function store(Request $request) {
        $this->validator($request->all())->validate();

        $earning = new Earning;

        $earning->space_id = session('space')->id;
        $earning->tag_id = $request->input('tag_id');
        $earning->happened_on = $request->input('date');
        $earning->description = $request->input('description');
        $earning->amount = (int) ($request->input('amount') * 100);

        $earning->save();

        return redirect()->route('dashboard');
    }

    public function edit(Earning $earning) {
        $this->authorize('edit', $earning);

        return view('earnings.edit', compact('earning'));
    }

    public function update(Request $request, Earning $earning) {
        $this->authorize('update', $earning);

        $this->validator($request->all())->validate();

        $earning->fill([
            'happened_on' => $request->input('date'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount')
        ])->save();

        return redirect()->route('earnings.index');
    }

    public function destroy(Earning $earning) {
        $this->authorize('delete', $earning);

        $restorableEarning = $earning->id;

        $earning->delete();

        return redirect()
            ->route('earnings.index')
            ->with([
                'restorableEarning' => $restorableEarning
            ]);
    }

    public function restore($id) {
        $earning = Earning::withTrashed()->find($id);

        if (!$earning) {
            return (view('errors.404'));
        }

        $this->authorize('restore', $earning);

        $earning->restore();

        return redirect()->route('earnings.index');
    }
}
