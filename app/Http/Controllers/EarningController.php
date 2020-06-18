<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;

use App\Models\Earning;

use Auth;

class EarningController extends Controller {
    protected function validationRules() {
        return [
            'date' => 'required|date|date_format:Y-m-d',
            'description' => 'required|max:255',
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/'
        ];
    }

    public function show(Request $request, Earning $earning)
    {
        $this->authorize('view', $earning);

        return view('earnings.show', [
            'earning' => $earning
        ]);
    }

    public function create() {
        return view('earnings.create');
    }

    public function store(Request $request) {
        $request->validate($this->validationRules());

        $earning = new Earning;

        $earning->space_id = session('space')->id;
        $earning->happened_on = $request->input('date');
        $earning->description = $request->input('description');
        $earning->amount = Helper::rawNumberToInteger($request->input('amount'));

        $earning->save();

        return redirect()->route('dashboard');
    }

    public function edit(Earning $earning) {
        $this->authorize('edit', $earning);

        return view('earnings.edit', compact('earning'));
    }

    public function update(Request $request, Earning $earning) {
        $this->authorize('update', $earning);

        $request->validate($this->validationRules());

        $earning->fill([
            'happened_on' => $request->input('date'),
            'description' => $request->input('description'),
            'amount' => Helper::rawNumberToInteger($request->input('amount'))
        ])->save();

        return redirect()->route('transactions.index');
    }

    public function destroy(Earning $earning) {
        $this->authorize('delete', $earning);

        $restorableEarning = $earning->id;

        $earning->delete();

        return redirect()
            ->route('transactions.index');
    }

    public function restore($id) {
        $earning = Earning::withTrashed()->find($id);

        if (!$earning) {
            // 404
        }

        $this->authorize('restore', $earning);

        $earning->restore();

        return redirect()->route('transactions.index');
    }
}
