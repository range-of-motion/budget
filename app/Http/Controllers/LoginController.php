<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function index() {
        return view('login.index');
    }

    public function store(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('login.index');
        }
    }
}
