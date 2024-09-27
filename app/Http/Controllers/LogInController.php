<?php

namespace App\Http\Controllers;

use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LogInController extends Controller
{
    public function index()
    {
        return Inertia::render('LogIn', [
            'register_url' => route('register'),
        ]);
    }

    public function store(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::getUser();

            LoginAttempt::query()
                ->create([
                    'user_id' => $user->id,
                    'ip' => $request->ip(),
                    'failed' => false,
                ]);

            return redirect()->route('dashboard');
        }

        $userByEmail = User::query()
            ->where('email', $request->input('email'))
            ->first();

        LoginAttempt::query()
            ->create([
                'user_id' => $userByEmail ? $userByEmail->id : null,
                'ip' => $request->ip(),
                'failed' => true,
            ]);

        return redirect()->route('log-in');
    }
}
