<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;

use Auth;

class AppServiceProvider extends ServiceProvider {
    public function boot() {
        Builder::defaultStringLength(191);
        
        view()->composer('*', function($view) {
            $view->with([
                'userName' => Auth::check() ? Auth::user()->name : null,
                'currency' => Auth::check() ? session('space') ? session('space')->currency->symbol : '-' : null
            ]);
        });
    }

    public function register() {
        //
    }
}
