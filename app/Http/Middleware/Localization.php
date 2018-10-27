<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Foundation\Application;

class Localization
{

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // read the language from the request header
        $locale = $request->header('Content-Language');

        // if the header is missed
        if(!$locale){
            // take the default local language
            $locale = $this->app->config->get('app.locale');
        }

        // check the languages defined is supported
        if (!array_key_exists($locale, $this->app->config->get('app.supported_languages'))) {
            // respond with error
            return response()->json(["message" => "Language not supported","errors" => "Language not supported"],"403" );
        }

        // set the local language
        $this->app->setLocale($locale);

        $response = $next($request);

        $response->headers->set('Content-Language', $locale);

        return $response;
    }
}
