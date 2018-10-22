<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache connection that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    | Supported: "apc", "array", "database", "file", "memcached", "redis"
    |
    */

    'default' => env('CACHE_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    */

    'stores' => [

        'apc' => [
            'driver' => 'apc',
        ],

        'array' => [
            'driver' => 'array',
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'cache',
            'connection' => null,
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
            ],
            'servers' => array_map(function($s) {
                $parts = explode(":", $s);
                return [
                    'host' => $parts[0],
                    'port' => $parts[1],
                    'weight' => 100,
                ];
            })
        ],

        'redis' => [
            'client' => 'predis',
            'default' => [
                "user" => env('REDIS_USER','h'),
                'host' => env('REDIS_HOST', 'ec2-18-205-186-65.compute-1.amazonaws.com'),
                'password' => env('REDIS_PASSWORD',"p863e3df0d808ce70f6735a730a8e8c67af7f333fda363c8e4227e78613ac4265"),
                'port' => env('REDIS_PORT', 30649),
                'URI' => env('REDIS_URI', "redis://h:p863e3df0d808ce70f6735a730a8e8c67af7f333fda363c8e4227e78613ac4265@ec2-18-205-186-65.compute-1.amazonaws.com:30649"),
                'database' => 0,
            ],

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing a RAM based store such as APC or Memcached, there might
    | be other applications utilizing the same cache. So, we'll specify a
    | value to get prefixed to all our keys so we can avoid collisions.
    |
    */

    'prefix' => env(
        'CACHE_PREFIX',
        str_slug(env('APP_NAME', 'laravel'), '_').'_cache'
    ),

];
