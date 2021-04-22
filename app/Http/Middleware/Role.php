<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        foreach(json_decode(Auth::user()->role) as $userRole) {
            if(in_array($userRole, explode(',', $roles))) {
                return $next($request);
            }
        }
        abort(403);
    }
}
