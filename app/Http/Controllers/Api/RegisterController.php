<?php

namespace App\Http\Controllers\Api;

use App\Actions\SendVerificationMailAction;
use App\Http\Controllers\Controller;
use App\Models\Space;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        if (config('app.disable_registration')) {
            abort(404);
        }

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'currency' => ['required', 'exists:currencies,id'],
        ]);

        $user = User::query()
            ->create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'verification_token' => Str::random(100),
            ]);

        $space = Space::query()
            ->create([
                'currency_id' => $request->input('currency'),
                'name' => $user->name . '\'s Space',
            ]);

        $user->spaces()->attach($space->id, ['role' => 'admin']);

        (new SendVerificationMailAction())->execute($user->id);

        return [
            'success' => true,
        ];
    }
}
