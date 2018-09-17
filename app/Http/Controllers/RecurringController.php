<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Recurring;
use Auth;

class RecurringController extends Controller {
    public function index() {
        $user = Auth::user();

        return view('recurrings.index', [
            'currency' => $user->currency,
            'recurrings' => $user->recurrings()->orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function show($id) {
        $recurring = Recurring::find($id);

        if (!$recurring) {
            // REEE
        }

        $this->authorize('view', $recurring);

        return view('recurrings.show', [
            'recurring' => $recurring
        ]);
    }
}
