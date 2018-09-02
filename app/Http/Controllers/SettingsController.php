<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Image;
use Storage;

class SettingsController extends Controller {
    public function index() {
        $user = Auth::user();

        return view('settings', [
            'languages' => config('app.locales'),
            'tags' => $user->tags
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'avatar' => 'nullable|mimes:jpeg,jpg,png,gif',
            // TODO VALIDATE OTHER FIELDS
            'language' => 'required|in:' . implode(',', array_keys(config('app.locales')))
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
