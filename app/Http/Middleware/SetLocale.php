<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (\Auth::check()) {
            $user = \Auth::user();

            \App::setLocale($user->language);
            Carbon::setLocale($user->language);
        }

        return $next($request);
    }
}
