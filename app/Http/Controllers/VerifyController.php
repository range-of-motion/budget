<?php

namespace App\Http\Controllers;

use App\Actions\VerifyUserAction;
use App\Models\User;

class VerifyController extends Controller
{
    public function __invoke($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        (new VerifyUserAction())->execute($user->id);

        return redirect()
            ->route('login')
            ->with([
                'alert_type' => 'success',
                'alert_message' => 'You\'ve succesfully verified'
            ]);
    }
}
