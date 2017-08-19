<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller {
    public function index() {
        return view('settings.index');
    }

    public function store(Request $request) {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->route('settings.index');
    }
}
