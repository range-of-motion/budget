<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use App\Models\Spending;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index()
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
}
