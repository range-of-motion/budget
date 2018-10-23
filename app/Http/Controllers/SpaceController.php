<?php

namespace App\Http\Controllers;

use App\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller {
    public function __invoke($id) {
        $space = Space::find($id);

        if ($space->users->contains(Auh::user()->id)) {
            return redirect()->route('dashboard');
        }

        session(['space' => $space]);

        return redirect()->route('dashboard');
    }
}
