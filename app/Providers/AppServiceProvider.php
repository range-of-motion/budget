<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Auth;

class AppServiceProvider extends ServiceProvider {
    public function boot() {
        view()->composer('*', function($view) {
            $versionNumber = file_exists(base_path() . '/version.txt') ? file_get_contents(base_path() . '/version.txt') : '-';

            $view->with([
                'userName' => Auth::check() ? Auth::user()->name : null,
                'currency' => Auth::check() ? session('space') ? session('space')->currency->symbol : '-' : null,
                'versionNumber' => $versionNumber
            ]);
        });
    }

    public function register() {
        //
    }
}
