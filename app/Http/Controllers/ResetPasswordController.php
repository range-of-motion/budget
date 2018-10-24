<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller {
    public function get(Request $request) {
        return view('reset_password', [
            'token' => $request->get('token')
        ]);
    }

    public function post(Request $request) {
        $request->validate([
            'email' => 'required_without:password|email',
            'password' => 'required_without:email|confirmed'
        ]);

        if ($email = $request->input('email') && !$request->has('token')) {
            $existingUser = User::where('email', $email)->first();

            if ($existingUser) {
                $shippingToken = null;

                $existingRecord = DB::selectOne('SELECT * FROM password_resets WHERE email = ?', [$email]);

                if (!$existingRecord) {
                    $shippingToken = str_random(100);

                    DB::table('password_resets')->insert([
                        'email' => $email,
                        'token' => $shippingToken,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    $shippingToken = $existingRecord->token;
                }

                Mail::to($email)->queue(new ResetPassword($shippingToken));
            }

            return redirect()
                ->route('login')
                ->with([
                    'alert_type' => 'success',
                    'alert_message' => 'If you registered with that address, we\'ve sent you an e-mail'
                ]);
        } else if ($request->has('token') && $request->has('password') && !$request->has('email')) {
            $token = $request->input('token');
            $password = $request->input('password');

            $record = DB::selectOne('SELECT * FROM password_resets WHERE token = ?', [$token]);

            if ($record) {
                $user = User::where('email', $record->email)->first();

                $user->password = Hash::make($password);
                $user->save();
            }

            DB::table('password_resets')->where('token', $token)->delete();

            return redirect()
                ->route('login')
                ->with([
                    'alert_type' => 'success',
                    'alert_message' => 'You\'ve successfully changed your password'
                ]);
        }

        return redirect()->route('reset_password');
    }
}
