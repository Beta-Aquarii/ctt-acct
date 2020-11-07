<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null){

        if(Auth::guard($guard)->check()) {
            if($request->user()->level == 0){
                return $next($request);
            }elseif($request->user()->level == 1){
                return redirect('/reservation');
            }elseif($request->user()->level == 2){
                return redirect('/accounting');
            }
        }

        return redirect('/admin');
        
    }
}
