<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class SettingsController extends Controller {
    public function index() {
        $user = Auth::user();

        //
        $languages = ['en', 'nl'];

        $tags = $user->tags;

        return view('settings', compact('languages', 'tags'));
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
