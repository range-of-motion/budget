<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale {
    public function handle($request, Closure $next) {
        $user = \Auth::user();

        \App::setLocale($user->language);

        return $next($request);
    }
}
