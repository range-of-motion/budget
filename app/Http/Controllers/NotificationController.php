<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller {
    public function index() {
        return view('notifications.index', [
            'notifications' => session('space')->notifications()->latest()->get()
        ]);
    }
}
