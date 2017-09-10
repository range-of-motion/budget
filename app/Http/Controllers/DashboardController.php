<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class DashboardController extends Controller {
    public function index() {
        $currency = Auth::user()->currency;

        return view('dashboard.index', compact('currency'));
    }
}
