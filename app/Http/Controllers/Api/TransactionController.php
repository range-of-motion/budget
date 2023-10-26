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
}
