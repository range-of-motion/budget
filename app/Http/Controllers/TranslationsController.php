<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TranslationsController extends Controller
{
    public function __invoke()
    {
        $strings = [];

        foreach (glob(resource_path('lang/' . Auth::user()->language . '/*.php')) as $file) {
            $fileName = basename($file, '.php');

            $strings[$fileName] = require $file;
        }

        return 'window.i18n = ' . json_encode($strings) . ';';
    }
}
