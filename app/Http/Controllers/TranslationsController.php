<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TranslationsController extends Controller
{
    public function __invoke()
    {
        $strings = [];

        foreach (glob(app()->langPath() . '/' . Auth::user()->language . '/*.php') as $file) {
            $fileName = basename($file, '.php');

            $strings[$fileName] = require $file;
        }

        return 'window.i18n = ' . json_encode($strings) . ';';
    }
}
