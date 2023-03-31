<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class GenerateTranslationsString
{
    public function execute(): string
    {
        $language = Auth::check() ? Auth::user()->language : 'en';

        $strings = [];

        foreach (glob(app()->langPath() . '/' . $language . '/*.php') as $file) {
            $fileName = basename($file, '.php');

            $strings[$fileName] = require $file;
        }

        return 'window.translations = ' . json_encode($strings) . ';';
    }
}
