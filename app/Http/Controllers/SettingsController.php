<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Mail\PasswordChanged;
use App\Currency;
use Auth;
use Image;
use Storage;
use Hash;
use Mail;

class SettingsController extends Controller {
    public function getIndex() {
        return redirect()->route('settings.profile');
    }

    public function postIndex(Request $request) {
        $request->validate([
            'avatar' => 'nullable|mimes:jpeg,jpg,png,gif',
            'password' => 'nullable|confirmed',
            'language' => 'nullable|in:' . implode(',', array_keys(config('app.locales'))),
            'theme' => 'nullable|in:light,dark',
            'weekly_report' => 'nullable|in:true,false',
            'currency' => 'nullable|exists:currencies,id'
        ]);

        $user = Auth::user();

        // Profile
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            $fileName = $file->hashName();

            $image = Image::make($file)
                ->fit(500);

            Storage::put('public/avatars/' . $fileName, (string) $image->encode());

            $user->avatar = $fileName;
        }

        if ($request->has('name')) {
            $user->name = $request->input('name');
        }

        // Account
        if ($request->has('email')) {
            $user->email = $request->input('email');
        }

        if ($password = $request->input('password')) {
            $user->password = Hash::make($password);
        }

        // Preferences
        if ($request->has('language')) {
            $user->language = $request->input('language');
        }

        if ($request->has('theme')) {
            $user->theme = $request->input('theme');
        }

        if ($request->has('currency')) {
            $user->currency_id = $request->input('currency');
        }

        if ($request->has('weekly_report')) {
            $user->weekly_report = $request->input('weekly_report') == 'true' ? true : false;
        }

        $user->save();

        // Notify upon changing of password
        if ($request->has('password')) {
            Mail::to($user->email)->queue(new PasswordChanged($user->updated_at));
        }

        return back();
    }

    public function getProfile() {
        return view('settings.profile');
    }

    public function getAccount() {
        return view('settings.account');
    }

    public function getSpaces() {
        return view('settings.spaces.index', [
            'spaces' => Auth::user()->spaces
        ]);
    }

    public function getPreferences() {
        return view('settings.preferences', [
            'languages' => config('app.locales'),
            'currencies' => Currency::all()
        ]);
    }
}
