<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Mail\PasswordChanged;
use Auth;
use Image;
use Storage;
use Hash;
use Mail;

class SettingsController extends Controller {
    public function index() {
        return view('settings', [
            'languages' => config('app.locales')
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'avatar' => 'nullable|mimes:jpeg,jpg,png,gif',
            'password' => 'nullable|confirmed',
            'language' => 'required|in:' . implode(',', array_keys(config('app.locales'))),
            'theme' => 'required|in:light,dark'
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

        if ($password = $request->input('password')) {
            $user->password = Hash::make($password);
        }

        $user->language = $request->input('language');
        $user->theme = $request->input('theme');

        $user->save();

        // If password changed
        if ($request->input('password')) {
            Mail::to($user->email)->queue(new PasswordChanged($user->updated_at));
        }

        return redirect()->route('settings');
    }
}
