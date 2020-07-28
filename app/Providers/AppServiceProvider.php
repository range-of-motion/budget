<?php

namespace App\Providers;

use App\Helper;
use App\Models\Space;
use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function ($view) {
            $selectedSpace = session('space_id') ? Space::find(session('space_id')) : null;

            $versionFileExists = file_exists(base_path() . '/version.txt');
            $versionNumber = $versionFileExists ? file_get_contents(base_path() . '/version.txt') : '-';

            $view->with([
                'userName' => Auth::check() ? Auth::user()->name : null,
                'currency' => $selectedSpace ? $selectedSpace->currency->symbol : '-',
                'selectedSpace' => $selectedSpace,
                'arePlansEnabled' => Helper::arePlansEnabled(),
                'suggestionBoxEnabled' => env('SUGGESTION_BOX_ENABLED', false),
                'versionNumber' => $versionNumber
            ]);
        });
    }

    public function register()
    {
        //
    }
}
