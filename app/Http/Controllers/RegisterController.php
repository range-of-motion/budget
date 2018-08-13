<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

use App\Currency;
use App\User;
use Hash;

class RegisterController extends Controller {
    public function index() {
        $currencies = Currency::all();

        return view('register', compact('currencies'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'currency' => 'required'
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->currency_id = $request->currency;
        $user->language = 'en';

        $user->save();

        return redirect('/register');
    }
}
