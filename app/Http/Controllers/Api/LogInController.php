<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LogInController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        if (
            Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ])
        ) {
            $userId = Auth::user()->id;

            LoginAttempt::query()
                ->create([
                    'user_id' => $userId,
                    'ip' => $request->ip(),
                    'failed' => false,
                ]);

            $apiKey = ApiKey::create([
                'user_id' => $userId,
                'token' => Str::random(32),
            ]);

            return response()
                ->json([
                    'token' => $apiKey->token,
                    'language' => Auth::user()->language,
                    'theme' => Auth::user()->theme,
                ]);
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

        return response()
            ->json(['error' => 'UNABLE_TO_LOG_IN'], 403);
    }
}
