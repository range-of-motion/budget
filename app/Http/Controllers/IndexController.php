<?php

namespace App\Http\Controllers;

use Auth;

class IndexController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login');
    }
}
