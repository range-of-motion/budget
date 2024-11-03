<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use App\Models\Spending;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    public function index(): Response
    {
        $space = Auth::user()->spaces()->first();

        $transactions = collect();

        Earning::query()
            ->where('space_id', $space->id)
            ->each(fn (Earning $earning) => $transactions->push($earning));

        Spending::query()
            ->where('space_id', $space->id)
            ->each(fn (Spending $spending) => $transactions->push($spending));

        return Inertia::render(
            'Transaction/Index',
            [
                'currency' => $space->currency->symbol,
                'transactions' => $transactions,
            ],
        );
    }

    public function create(): Response
    {
        $space = Auth::user()->spaces()->first();

        $tags = Tag::query()
            ->where('space_id', $space->id)
            ->get();

        return Inertia::render(
            'Transaction/Create',
            [
                'tags' => $tags,
            ],
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', 'in:earning,spending'],
            'tag_id' => ['nullable', 'exists:tags,id'], // TODO: CHECK IF TAG BELONGS TO USER
            'happened_on' => ['required', 'date', 'date_format:Y-m-d'],
            'description' => ['required', 'max:255'],
            'amount' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
        ]);

        $space = Auth::user()->spaces()->first();

        if ($request->input('type') === 'earning') {
            Earning::query()
                ->create([
                    'space_id' => $space->id,
                    'recurring_id' => null,
                    'happened_on' => $request->input('happened_on'),
                    'description' => $request->input('description'),
                    'amount' => (int) ($request->input('amount') * 100),
                ]);
        }

        if ($request->input('type') === 'spending') {
            Spending::query()
                ->create([
                    'space_id' => $space->id,
                    'import_id' => null,
                    'recurring_id' => null,
                    'tag_id' => $request->input('tag_id'),
                    'happened_on' => $request->input('happened_on'),
                    'description' => $request->input('description'),
                    'amount' => (int) ($request->input('amount') * 100),
                ]);
        }

        return redirect()->route('transactions.index');
    }
}
