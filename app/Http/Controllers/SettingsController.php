<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Storage;

class SettingsController extends Controller {
    public function index() {
        $user = Auth::user();

        //
        $languages = ['en', 'nl', 'dk'];

        $tags = $user->tags;

        return view('settings', compact('languages', 'tags'));
    }

    public function store(Request $request) {
        $request->validate([
            'avatar' => 'nullable|mimes:jpeg,jpg,png,gif'
            // TODO VALIDATE OTHER FIELDS
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            $fileName = $file->hashName();

            $image = Image::make($file)
                ->fit(500);

            Storage::put('public/avatars/' . $fileName, (string) $image->encode());

            $user->avatar = $fileName;
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->language = $request->input('language');

        $user->save();

        return redirect()->route('settings');
    }
}
