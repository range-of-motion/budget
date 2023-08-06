<?php

namespace App\Http\Controllers;

class PrototypeController extends Controller
{
    public function __invoke()
    {
        return view('prototype');
    }
}
