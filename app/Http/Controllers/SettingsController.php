<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller {
    public function index() {
        $languages = ['en', 'nl'];

        return view('settings', compact('languages'));
    }

    public function store(Request $request) {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->language = $request->input('language');

        $user->save();

        return redirect()->route('settings');
    }
}
