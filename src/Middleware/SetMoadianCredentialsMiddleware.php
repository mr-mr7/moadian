<?php

namespace Jooyeshgar\Moadian\Middleware;

use Closure;
use Jooyeshgar\Moadian\Facades\Moadian;
class SetMoadianCredentialsMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            Moadian::forUser(auth()->id());
        }

        return $next($request);
    }
}