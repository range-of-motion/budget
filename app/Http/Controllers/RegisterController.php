<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

use App\Mail\VerifyRegistration;
use App\Currency;
use App\User;
use App\Space;
use Hash;
use Illuminate\Support\Facades\Auth;
use Mail;

class RegisterController extends Controller {
    public function index() {
        $currencies = [];

        foreach (Currency::all() as $currency) {
            $currencies[] = ['key' => $currency->id, 'label' => $currency->symbol];
        }

        return view('register', compact('currencies'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'currency' => 'required|exists:currencies,id'
        ]);

        // User
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_token = str_random(100);

        $user->save();

        // Space
        $space = new Space;

        $space->currency_id = $request->currency;
        $space->name = $user->name . '\'s Space';

        $space->save();

        $user->spaces()->attach($space->id, ['role' => 'admin']);

        Mail::to($user->email)->queue(new VerifyRegistration($user));

        Auth::loginUsingId($user->id);

        return redirect()
            ->route('dashboard');
    }
}
