<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Auth;

class VerifyBlocked
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->is_verify != 1 || Auth::user()->is_blocked == 1) {
            Auth::logout();
            Session::flush();
            return redirect()->guest("login")->with(['messageDanger' => __("general.Blocked")]);
        }
        return $next($request);
    }
}
