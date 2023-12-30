<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Space;
use App\Models\Spending;
use App\Models\Tag;
use App\Repositories\ConversionRateRepository;
use App\Repositories\SpendingRepository;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    private $spendingRepository;
    private $conversionRateRepository;

    public function __construct(
        SpendingRepository $spendingRepository,
        ConversionRateRepository $conversionRateRepository
    ) {
        $this->spendingRepository = $spendingRepository;
        $this->conversionRateRepository = $conversionRateRepository;
    }

    public function create()
    {
        $tags = Tag::query()
            ->where('space_id', session('space_id'))
            ->latest()
            ->get();

        return view('spendings.create', ['tags' => $tags]);
    }

    public function show(Request $request, Spending $spending)
    {
        $this->authorize('view', $spending);

        return view('spendings.show', [
            'spending' => $spending
        ]);
    }

    public function store(Request $request)
    {
        $request->validate($this->spendingRepository->getValidationRules());

        $amount = Helper::rawNumberToInteger($request->input('amount'));

        // Convert amount if a different currency was selected
        if ($request->has('currency_id') && $request->currency_id !== Space::find(session('space_id'))->currency_id) {
            $amount = $this->conversionRateRepository->convert(
                $request->currency_id,
                Space::find(session('space_id'))->currency_id,
                $amount
            );
        }

        $this->spendingRepository->create(
            session('space_id'),
            null,
            null,
            $request->input('tag_id'),
            $request->input('date'),
            $request->input('description'),
            $amount
        );

        return redirect()->route('dashboard');
    }

    public function edit(Spending $spending)
    {
        $this->authorize('edit', $spending);

        $tags = Tag::query()
            ->where('space_id', session('space_id'))
            ->latest()
            ->get();

        return view('spendings.edit', compact('tags', 'spending'));
    }

    public function update(Request $request, Spending $spending)
    {
        $this->authorize('update', $spending);

        $request->validate($this->spendingRepository->getValidationRules());

        $this->spendingRepository->update($spending->id, [
            'tag_id' => $request->input('tag_id'),
            'happened_on' => $request->input('date'),
            'description' => $request->input('description'),
            'amount' => Helper::rawNumberToInteger($request->input('amount'))
        ]);

        return redirect()->route('transactions.index');
    }

    public function destroy(Spending $spending)
    {
        $this->authorize('delete', $spending);

        $restorableSpending = $spending->id;

        $spending->delete();

        return redirect()
            ->route('transactions.index');
    }

    public function restore($id)
    {
        $spending = Spending::withTrashed()->find($id);

        if (!$spending) {
            // 404
        }

        $this->authorize('restore', $spending);

        $spending->restore();

        return redirect()->route('transactions.index');
    }
}
