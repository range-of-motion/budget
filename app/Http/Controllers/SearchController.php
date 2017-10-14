<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Earning;
use App\Spending;

class SearchController extends Controller {
    public function index(Request $request) {
        $data = [];

        if ($request->has('query')) {
            $data['query'] = $request->get('query');
            
            $data['earnings'] = Earning::where('description', 'like', '%' . $request->get('query') . '%')->get();
            
            $data['spendings'] = Spending::where('description', 'like', '%' . $request->get('query') . '%')->get();
        }

        return view('search.index', $data);
    }
}
