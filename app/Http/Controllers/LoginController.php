<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function index() {
        return view('login');
    }

    public function store(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            return redirect()->route('dashboard_get');
        } else {
            return redirect()->route('login_get');
        }
    }
}
