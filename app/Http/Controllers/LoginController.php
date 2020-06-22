<?php

namespace App\Http\Controllers;

use App\Repositories\LoginAttemptRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    private $userRepository;
    private $loginAttemptRepository;

    public function __construct(UserRepository $userRepository, LoginAttemptRepository $loginAttemptRepository)
    {
        $this->userRepository = $userRepository;
        $this->loginAttemptRepository = $loginAttemptRepository;
    }

    public function index() {
        return view('login');
    }

    public function store(Request $request) {
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
            $user = Auth::user();

            $this->loginAttemptRepository->create($user->id, $request->ip(), false);

            session(['space' => $user->spaces[0]]);

            return redirect()->route('dashboard');
        } else {
            $user = $this->userRepository->getByEmail($request->input('email'));

            $this->loginAttemptRepository->create($user ? $user->id : null, $request->ip(), true);

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
