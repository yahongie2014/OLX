<?php


namespace App\Http;


use Illuminate\Foundation\Http\Kernel as HttpKernel;


class Kernel extends HttpKernel

{

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */

    protected $middleware = [

        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,

    ];


    /**
     * The application's route middleware groups.
     *
     * @var array
     */

    protected $middlewareGroups = [

        'web' => [

            \App\Http\Middleware\EncryptCookies::class,

            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,

        ],


        'api' => [
            'throttle:60,1',
            'bindings',
        ],

        'admin' => [
            \Illuminate\Auth\Middleware\Authenticate::class,
            \App\Http\Middleware\IsUserAdmin::class,
        ],

        'vendor' => [
            \Illuminate\Auth\Middleware\Authenticate::class,
            \App\Http\Middleware\Vendor::class,

        ],
        'VendorAccess' => [
            \Illuminate\Auth\Middleware\Authenticate::class,
            \App\Http\Middleware\VendorAccess::class,

        ],



    ];


    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */

    protected $routeMiddleware = [

        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'cors' => \App\Http\Middleware\CORS::class,
        'setlanguage' => \App\Http\Middleware\setLanguage::class,
        'Localization' => \App\Http\Middleware\Localization::class,
        'Admin' => \App\Http\Middleware\IsUserAdmin::class,
        'Providers' => \App\Http\Middleware\Vendor::class,
        'VendorAccess' => \App\Http\Middleware\VendorAccess::class,
        'Verify' => \App\Http\Middleware\UserVerify::class,
        'Blocked' => \App\Http\Middleware\VerifyBlocked::class,

    ];

}
