<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class DashboardMiddleware
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
        if (Auth::check() && Auth::user() &&  (Auth::user()->hasRole('admin')||Auth::user()->hasRole('manager')||Auth::user()->hasRole('staff'))) {
            return $next($request);
        }else{
            return redirect ()->route('dashboards-login');
        }
    }
}
