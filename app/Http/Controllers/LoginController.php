<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function index() {
        return view('login');
    }

    public function store(Request $request) {
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'verification_token' => null
        ])) {
            $user = Auth::user();

            session(['space' => $user->spaces[0]]);

            return redirect()->route('dashboard');
        } else {
            $request->flash();

            return redirect()
                ->route('login')
                ->with([
                    'alert_type' => 'danger',
                    'alert_message' => 'Failed to login'
                ]);
        }
    }
}
