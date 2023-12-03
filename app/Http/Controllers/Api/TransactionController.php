<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Earning;
use App\Models\Spending;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        /** @var ApiKey $apiKey */
        $apiKey = $request->get('apiKey');

        $transactions = collect();

        foreach (Earning::query()->where('space_id', $apiKey->user->spaces()->first()->id)->get() as $earning) {
            $transactions->push($earning);
        }

        foreach (Spending::query()->where('space_id', $apiKey->user->spaces()->first()->id)->get() as $spending) {
            $transactions->push($spending);
        }

        return TransactionResource::collection($transactions);
    }

    public function store(Request $request)
    {
        /** @var ApiKey $apiKey */
        $apiKey = $request->get('apiKey');

        $spaceId = $apiKey->user->spaces()->first()->id;

        $request->validate([
            'type' => ['required', 'in:earning,spending'],
            'tag_id' => ['nullable', 'exists:tags,id'], // TODO: CHECK IF TAG BELONGS TO USER
            'happened_on' => ['required', 'date', 'date_format:Y-m-d'],
            'description' => ['required', 'max:255'],
            'amount' => ['required', 'regex:/^\d*(\.\d{1,2})?$/'],
        ]);

        if ($request->input('type') === 'earning') {
            Earning::create([
                'space_id' => $spaceId,
                'recurring_id' => null, // TODO
                'happened_on' => $request->input('happened_on'),
                'description' => $request->input('description'),
                'amount' => (int) ($request->input('amount') * 100),
            ]);
        }

        if ($request->input('type') === 'spending') {
            Spending::create([
                'space_id' => $spaceId,
                'import_id' => null, // TODO
                'recurring_id' => null, // TODO
                'tag_id' => $request->input('tag_id'),
                'happened_on' => $request->input('happened_on'),
                'description' => $request->input('description'),
                'amount' => (int) ($request->input('amount') * 100),
            ]);
        }

        return [];
    }
}
