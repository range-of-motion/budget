<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\ApiKey;
use App\Models\Earning;
use App\Models\Spending;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $apiKey = ApiKey::query()
            ->where('token', $request->header('api-key'))
            ->first();

        if (!$apiKey) {
            abort(401);
        }

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
        $apiKey = ApiKey::query()
            ->where('token', $request->header('api-key'))
            ->first();

        if (!$apiKey) {
            abort(401);
        }

        $spaceId = $apiKey->user->spaces()->first()->id;

        $request->validate([
            'type' => 'in:earning,spending',
            // TODO
        ]);

        if ($request->input('type') === 'earning') {
            Earning::create([
                'space_id' => $spaceId,
                'recurring_id' => null, // TODO
                'happened_on' => $request->input('happened_on'),
                'description' => $request->input('description'),
                'amount' => $request->input('amount')
            ]);
        }

        if ($request->input('type') === 'spending') {
            Spending::create([
                'space_id' => $spaceId,
                'import_id' => null, // TODO
                'recurring_id' => null, // TODO
                'tag_id' => null, // TODO
                'happened_on' => $request->input('happened_on'),
                'description' => $request->input('description'),
                'amount' => $request->input('amount')
            ]);
        }

        return [];
    }
}
