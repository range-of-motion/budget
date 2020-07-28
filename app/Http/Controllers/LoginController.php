<?php

namespace App\Http\Controllers;

use App\Actions\StoreSpaceInSessionAction;
use App\Models\User;
use App\Repositories\LoginAttemptRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $loginAttemptRepository;

    public function __construct(LoginAttemptRepository $loginAttemptRepository)
    {
        $this->loginAttemptRepository = $loginAttemptRepository;
    }

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

            $this->loginAttemptRepository->create($user->id, $request->ip(), false);

            (new StoreSpaceInSessionAction())->execute($user->spaces[0]->id);

            return redirect()->route('dashboard');
        } else {
            if ($request->input('email')) {
                $user = User::where('email', $request->input('email'))->first();

                $this->loginAttemptRepository->create($user ? $user->id : null, $request->ip(), true);
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
