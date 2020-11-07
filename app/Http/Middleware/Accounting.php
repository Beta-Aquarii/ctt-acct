<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Accounting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null){
        
        if (Auth::guard($guard)->check() && auth()->user()->level == 2) {
            return $next($request);
        }

        return redirect('/admin');

    }
}
