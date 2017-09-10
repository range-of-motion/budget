<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Currency;
use App\User;
use Hash;

class RegisterController extends Controller {
    public function index() {
        $currencies = Currency::all();

        return view('register.index', compact('currencies'));
    }

    public function store(Request $request) {
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->currency_id = $request->currency;

        $user->save();

        return redirect('/register');
    }
}
