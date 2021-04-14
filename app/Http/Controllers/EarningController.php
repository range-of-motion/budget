<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;
use App\Models\Earning;
use App\Models\Space;
use App\Repositories\ConversionRateRepository;
use App\Repositories\EarningRepository;

class EarningController extends Controller
{
    private $earningRepository;
    private $conversionRateRepository;

    public function __construct(
        EarningRepository $earningRepository,
        ConversionRateRepository $conversionRateRepository
    ) {
        $this->earningRepository = $earningRepository;
        $this->conversionRateRepository = $conversionRateRepository;
    }

    public function show(Request $request, Earning $earning)
    {
        $this->authorize('view', $earning);

        return view('earnings.show', [
            'earning' => $earning
        ]);
    }

    public function create()
    {
        return view('earnings.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->earningRepository->getValidationRules());

        $amount = Helper::rawNumberToInteger($request->input('amount'));

        // Convert amount if a different currency was selected
        if ($request->has('currency_id') && $request->currency_id !== Space::find(session('space_id'))->currency_id) {
            $amount = $this->conversionRateRepository->convert(
                $request->currency_id,
                Space::find(session('space_id'))->currency_id,
                $amount
            );
        }

        $this->earningRepository->create(
            session('space_id'),
            null,
            $request->input('date'),
            $request->input('description'),
            $amount
        );

        return redirect()->route('dashboard');
    }

    public function edit(Earning $earning)
    {
        $this->authorize('edit', $earning);

        return view('earnings.edit', compact('earning'));
    }

    public function update(Request $request, Earning $earning)
    {
        $this->authorize('update', $earning);

        $request->validate($this->earningRepository->getValidationRules());

        $this->earningRepository->update($earning->id, [
            'happened_on' => $request->input('date'),
            'description' => $request->input('description'),
            'amount' => Helper::rawNumberToInteger($request->input('amount'))
        ]);

        return redirect()->route('transactions.index');
    }

    public function destroy(Earning $earning)
    {
        $this->authorize('delete', $earning);

        $restorableEarning = $earning->id;

        $earning->delete();

        return redirect()
            ->route('transactions.index');
    }

    public function restore($id)
    {
        $earning = Earning::withTrashed()->find($id);

        if (!$earning) {
            // 404
        }

        $this->authorize('restore', $earning);

        $earning->restore();

        return redirect()->route('transactions.index');
    }
}
