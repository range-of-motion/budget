<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Space;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function index()
    {
        return Inertia::render('Register', [
            'currencies' => Currency::all(),
            'log_in_url' => route('log-in'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'currency_id' => ['required', 'exists:currencies,id'],
        ]);

        $user = User::query()
            ->create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

        $space = Space::query()
            ->create([
                'currency_id' => $request->input('currency_id'),
                'name' => sprintf('%s\'s Space', $user->name),
            ]);

        $user->spaces()->attach($space->id, ['role' => 'admin']);

        // TODO: Send verification mail

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
