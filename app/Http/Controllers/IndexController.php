<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class IndexController extends Controller {
    public function index() {
        if (Auth::check() && Auth::user()->verification_token === null) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login');
    }
}
