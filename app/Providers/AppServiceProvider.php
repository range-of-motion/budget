<?php

namespace App\Providers;

use App\Models\Space;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        JsonResource::withoutWrapping();

        view()->composer('*', function ($view) {
            $selectedSpace = session('space_id') ? Space::find(session('space_id')) : null;

            $versionFileExists = file_exists(base_path() . '/version.txt');
            $versionNumber = $versionFileExists ? file_get_contents(base_path() . '/version.txt') : '-';

            $view->with([
                'userName' => Auth::check() ? Auth::user()->name : null,
                'currency' => $selectedSpace ? $selectedSpace->currency->symbol : '-',
                'selectedSpace' => $selectedSpace,
                'versionNumber' => $versionNumber
            ]);
        });
    }

    public function register()
    {
        //
    }
}
