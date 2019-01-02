<?php

namespace App\Http\Controllers;

use App\LoginAttempt;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function index() {
        return view('login');
    }

    public function store(Request $request) {
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
            $user = Auth::user();

            LoginAttempt::create([
                'user_id' => $user->id,
                'ip' => $request->ip(),
                'failed' => false
            ]);

            session(['space' => $user->spaces[0]]);

            return redirect()->route('dashboard');
        } else {
            $user = User::where('email', $request->input('email'))->first();

            LoginAttempt::create([
                'user_id' => $user ? $user->id : null,
                'ip' => $request->ip(),
                'failed' => true
            ]);

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
