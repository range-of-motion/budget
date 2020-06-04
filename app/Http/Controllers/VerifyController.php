<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class VerifyController extends Controller {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function __invoke($token) {
        $user = $this->userRepository->getByVerificationToken($token);

        if (!$user) {
            return redirect()->route('login');
        }

        $this->userRepository->verifyById($user->id);

        return redirect()
            ->route('login')
            ->with([
                'alert_type' => 'success',
                'alert_message' => 'You\'ve succesfully verified'
            ]);;
    }
}
