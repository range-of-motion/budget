<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = ApiKey::query()
            ->where('token', $request->header('api-key'))
            ->first();

        if (!$apiKey) {
            abort(401);
        }

        $request->attributes->add(['apiKey' => $apiKey]);

        return $next($request);
    }
}
