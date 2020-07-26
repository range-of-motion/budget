<?php

namespace App\Http\Middleware;

use App\Helper;
use Closure;

class RedirectIfStripeAbsent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Helper::arePlansEnabled()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
