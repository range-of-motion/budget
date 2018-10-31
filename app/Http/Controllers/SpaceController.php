<?php

namespace App\Http\Controllers;

use App\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpaceController extends Controller {
    public function __invoke($id) {
        $space = Space::find($id);

        if ($space->users->contains(Auth::user()->id)) {
            session(['space' => $space]);
        }

        return redirect()->route('dashboard');
    }
}
