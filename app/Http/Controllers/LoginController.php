<?php

namespace App\Http\Controllers;

use App\Actions\StoreSpaceInSessionAction;
use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        if (
            Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ])
        ) {
            $user = Auth::user();

            LoginAttempt::query()
                ->create([
                    'user_id' => $user->id,
                    'ip' => $request->ip(),
                    'failed' => false,
                ]);

            (new StoreSpaceInSessionAction())->execute($user->spaces[0]->id);

            return redirect()->route('dashboard');
        } else {
            if ($request->input('email')) {
                $user = User::where('email', $request->input('email'))->first();

                LoginAttempt::query()
                    ->create([
                        'user_id' => $user ? $user->id : null,
                        'ip' => $request->ip(),
                        'failed' => true,
                    ]);
            }

            $request->flash();

            return redirect()
                ->route('login')
                ->with([
                    'alert_type' => 'danger',
                    'alert_message' => 'Failed to login'
                ]);
        }
    }
}
