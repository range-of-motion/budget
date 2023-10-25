<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Earning;
use App\Models\Spending;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = collect();

        foreach (Earning::all() as $earning) {
            $transactions->push($earning);
        }

        foreach (Spending::all() as $spending) {
            $transactions->push($spending);
        }

        return TransactionResource::collection($transactions);
    }
}
