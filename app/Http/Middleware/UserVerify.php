<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( Auth::user()->is_verify  != 1 ) {

            return response()->json(["message" => "You Are not Verified","errors" => "Please Verify Account"],"403" );
        }

        return $next($request);
    }
}
