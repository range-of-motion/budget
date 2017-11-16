<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Earning;
use App\Spending;

class SearchController extends Controller {
    public function index(Request $request) {
        $user = \Auth::user();

        $currency = $user->currency;

        $earnings = [];

        $spendings = [];

        if ($request->has('query')) {
            $earnings = Earning::where('description', 'like', '%' . $request->get('query') . '%')->get();

            $spendings = Spending::where('description', 'like', '%' . $request->get('query') . '%')->get();
        }

        return view('search.index', compact('currency', 'earnings', 'spendings'));
    }
}
