<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LogInController extends Controller
{
    public function index()
    {
        return Inertia::render('LogIn');
    }
}
