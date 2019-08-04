<?php

namespace App\Http\Controllers;

use App\LoginAttempt;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function index() {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'verification_token' => null
        ])) {
            $user = Auth::user();

            LoginAttempt::create([
                'user_id' => $user->id,
                'ip' => $request->ip(),
                'failed' => false
            ]);

            session(['space' => $user->spaces[0]]);

            session()->forget('email');

            return redirect()->route('dashboard');
        } else {
            $user = User::where('email', $request->input('email'))->first();

            LoginAttempt::create([
                'user_id' => $user ? $user->id : null,
                'ip' => $request->ip(),
                'failed' => true
            ]);

            $request->flash();

            if($user !== null and $user->verification_token !== null) {
                session(['email' => $request->input('email')]);

                return redirect()
                    ->route('login')
                    ->with([
                        'alert_type' => 'danger',
                        'alert_message' => 'login_failed.verify_account'
                    ]);
            } elseif($user !== null and $user->verification_token === null) {
                return redirect()
                    ->route('login')
                    ->with([
                        'alert_type' => 'danger',
                        'alert_message' => 'login_failed.wrong_password'
                    ]);
            } elseif($user === null) {
                return redirect()
                    ->route('login')
                    ->with([
                        'alert_type' => 'danger',
                        'alert_message' => 'no_account_found'
                    ]);
            } else {
                return redirect()
                    ->route('login')
                    ->with([
                        'alert_type' => 'danger',
                        'alert_message' => 'login_failed.simple'
                    ]);
            }
        }
    }
}
