<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
use http\Env\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Illuminate\Support\Facades\Auth;

class VerifyBlocked extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

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

            return redirect()->guest("/")->with(['messageDanger' => __("general.Blocked")]);
        }
        return $next($request);
    }
}
