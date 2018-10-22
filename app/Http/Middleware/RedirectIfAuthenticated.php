<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if( Auth::user()->is_admin  == 1 && Auth::user()->is_vendor == 0 ){
                return redirect('/admin');
            }elseif(Auth::user()->is_vendor  == 1 && Auth::user()->is_admin == 0){
                return redirect('/vendor');
            }
        }

        return $next($request);
    }
}
