<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VendorAccess
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
        if( Auth::user()->is_vendor  != 1 ) {
            return response()->json(["message" => "You Are not Vendor","errors" => "Please Login As Vendor"],"403" );
        }
        return $next($request);

    }
}
