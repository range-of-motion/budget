<?php

namespace App\Http\Controllers;

use App\Actions\SendVerificationMailAction;
use App\Exceptions\UserAlreadyVerifiedException;
use App\Exceptions\VerificationMailRateLimitException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResendVerificationMailController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            (new SendVerificationMailAction())->execute(Auth::user()->id);

            $request->session()->flash('verification_mail_status', 'success');
        } catch (UserAlreadyVerifiedException $e) {
            $request->session()->flash('verification_mail_status', 'already_verified');
        } catch (VerificationMailRateLimitException $e) {
            $request->session()->flash('verification_mail_status', 'rate_limited');
        }

        return redirect()->route('dashboard');
    }
}
