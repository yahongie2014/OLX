<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Facades\Auth;
use Closure;

use App\Admin;
use App\Language;
use App;
class setLanguage
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

        //set language
        if(Session::has('userLanguage'))
            $userLanguage = Session::get('userLanguage.symbol');
        else{
            // get user language symbol
            $userLanguage = Language::find(Auth::user()->language_id)->symbol;
        }

        App::setLocale($userLanguage);
        return $next($request);
    }
}
