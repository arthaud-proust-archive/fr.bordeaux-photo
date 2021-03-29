<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Maintenance
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
        if(config('app.maintenance')) {
            if(
            Auth::check() || 
            $request->routeIs('maintenance') || 
            $request->routeIs('login') || 
            $request->query->get('token') == config('app.maintenance_token') 
            ) {
                return $next($request);
            } else {
                return redirect()->route('maintenance');
            }
        } else {
            return $next($request);
        }
    }
}
