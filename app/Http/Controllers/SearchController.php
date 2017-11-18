<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Earning;
use App\Spending;

class SearchController extends Controller {
    public function index(Request $request) {
        $user = \Auth::user();

        $currency = $user->currency;

        $query = $request->get('query');

        $earnings = [];

        $spendings = [];

        if ($request->has('query')) {
            $earnings = Earning::where('description', 'like', '%' . $query . '%')->get();

            $spendings = Spending::where('description', 'like', '%' . $query . '%')->get();
        }

        return view('search', compact('currency', 'query', 'earnings', 'spendings'));
    }
}
