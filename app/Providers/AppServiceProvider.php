<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Auth;

class AppServiceProvider extends ServiceProvider {
    public function boot() {
        view()->composer('*', function($view) {
            $view->with([
                'userName' => Auth::check() ? Auth::user()->name : null,
                'currency' => Auth::check() ? Auth::user()->currency->symbol : null
            ]);
        });
    }

    public function register() {
        //
    }
}
