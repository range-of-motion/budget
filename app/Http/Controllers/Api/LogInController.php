<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogInController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (
            Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ])
        ) {
            LoginAttempt::create([
                'user_id' => Auth::user()->id,
                'ip' => $request->ip(),
                'failed' => false,
            ]);

            return response()
                ->json([
                    'token' => 'TOKEN_GOES_HERE',
                ]);
        } else {
            $userByEmail = User::query()
                ->where('email', $request->input('email'))
                ->first();

            LoginAttempt::create([
                'user_id' => $userByEmail ? $userByEmail->id : null,
                'ip' => $request->ip(),
                'failed' => true,
            ]);

            return response()
                    ->json(['error' => 'UNABLE_TO_LOG_IN']);
        }
    }
}
