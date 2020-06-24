<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Spending;
use App\Repositories\SpendingRepository;
use Illuminate\Http\Request;

class SpendingController extends Controller
{
    private $spendingRepository;

    public function __construct(SpendingRepository $spendingRepository)
    {
        $this->spendingRepository = $spendingRepository;
    }

    public function create()
    {
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

    public function store(Request $request)
    {
        $request->validate($this->spendingRepository->getValidationRules());

        $this->spendingRepository->create(
            session('space')->id,
            null,
            null,
            $request->input('tag_id'),
            $request->input('date'),
            $request->input('description'),
            Helper::rawNumberToInteger($request->input('amount'))
        );

        return redirect()->route('dashboard');
    }

    public function edit(Spending $spending)
    {
        $this->authorize('edit', $spending);

        $tags = session('space')->tags()->orderBy('created_at', 'DESC')->get();

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
