<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller {
    public function index() {
        return view('activities.index', [
            'activities' => session('space')->activities()->latest()->get()
        ]);
    }
}
