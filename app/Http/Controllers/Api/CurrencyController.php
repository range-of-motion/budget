<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        return CurrencyResource::collection(Currency::all());
    }
}
