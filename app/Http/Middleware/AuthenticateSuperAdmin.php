<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthenticateSuperAdmin
{

    public function handle(Request $request, Closure $next)
    {
        if(!auth()->user()->hasRole("Super Admin")) return response("", 403);

        return $next($request);

    }
}
