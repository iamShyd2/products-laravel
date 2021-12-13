<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Invite;

class RequireInvitationToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $invite = Invite::where(["token" => $request->token])->first();
        if(!$invite) return response("", 403);
        $request->invite = $invite;
        return $next($request);
    }
}
