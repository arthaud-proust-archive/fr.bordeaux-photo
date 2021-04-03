<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MaintenanceCheck
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
        // dd(Auth::user());
        if(
            !config('app.maintenance') ||
            Auth::check() || 
            $request->query->get('token') == config('app.maintenance_token') 
        ) {
            return $next($request);
        } else {
            return redirect()->route('maintenance');
        }
    }
}
