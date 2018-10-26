<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Earning;

use Auth;

class EarningController extends Controller {
    protected function validationRules() {
        return [
            'date' => 'required|date|date_format:Y-m-d',
            'description' => 'required|max:255',
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/'
        ];
    }

    public function index() {
        $user = Auth::user();

        $earnings = session('space')
            ->earnings()
            ->orderBy('happened_on', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('earnings.index', compact('earnings'));
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

        $request->validate($this->validationRules());

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
            // 404
        }

        $this->authorize('restore', $earning);

        $earning->restore();

        return redirect()->route('earnings.index');
    }
}
