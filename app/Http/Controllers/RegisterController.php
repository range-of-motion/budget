<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\VerifyRegistration;
use App\Currency;
use App\User;
use App\Space;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required', 'email', 'unique:users',
            'password' => 'required', 'confirmed',
            'currency' => 'required', 'exists:currencies,id'
        ]);
    }

    public function index() {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $currencies = [];

        foreach (Currency::all() as $currency) {
            $currencies[] = ['key' => $currency->id, 'label' => $currency->symbol];
        }

        return view('register', compact('currencies'));
    }

    public function store(Request $request) {
        $this->validator($request->all())->validate();

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

        return redirect()
            ->route('login')
            ->with([
                'alert_type' => 'success',
                'alert_message' => 'created_account'
            ]);
    }

    public function resendVerifyRegistration() {
        $user = Auth::user();

        if($user === null) {
            $user = User::where('email', session()->pull('email'))->first();
        }

        if($user === null) {
            return redirect()
                ->route('login')
                ->with([
                    'alert_type' => 'danger',
                    'alert_message' => 'no_account_found'
                ]);
        }

        if ($user->verification_token === null) {
            return redirect()
                ->route('dashboard')
                ->with([
                    'alert_type' => 'danger',
                    'alert_message' => 'already_verified'
                ]);
        }

        $user->verification_token = str_random(100);
        $user->save();

        Mail::to($user->email)->queue(new VerifyRegistration($user));

        return redirect()
            ->route('login')
            ->with([
                'alert_type' => 'success',
                'alert_message' => 'resent_email'
            ]);
    }
}
