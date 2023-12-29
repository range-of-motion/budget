<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserAction;
use App\Actions\StoreSpaceInSessionAction;
use App\Actions\SendVerificationMailAction;
use App\Models\Currency;
use App\Models\LoginAttempt;
use App\Models\Space;
use App\Models\User;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        if (config('app.disable_registration')) {
            abort(404);
        }

        return view('register', [
            'currencies' => Currency::orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        if (config('app.disable_registration')) {
            abort(404);
        }

        $request->validate(User::getValidationRulesForRegistration());

        $user = (new CreateUserAction())->execute($request->name, $request->email, $request->password);

        $space = Space::query()
            ->create([
                'currency_id' => $request->currency,
                'name' => $user->name . '\'s Space',
            ]);

        $user->spaces()->attach($space->id, ['role' => 'admin']);

        (new SendVerificationMailAction())->execute($user->id);

        Auth::loginUsingId($user->id);

        LoginAttempt::query()
            ->create([
                'user_id' => $user->id,
                'ip' => $request->ip(),
                'failed' => false,
            ]);

        (new StoreSpaceInSessionAction())->execute($user->spaces[0]->id);

        return redirect()
            ->route('dashboard');
    }
}
