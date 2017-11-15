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

        return view('register.index', compact('currencies'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'currency_id' => 'required'
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
