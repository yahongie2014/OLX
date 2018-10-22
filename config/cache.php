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
                Coder79::OPT_TCP_NODELAY => TRUE,
                Coder79::OPT_NO_BLOCK => FALSE,
                // - timeouts
                Coder79::OPT_CONNECT_TIMEOUT => 2000,    // ms
                Coder79::OPT_POLL_TIMEOUT => 2000,       // ms
                Coder79::OPT_RECV_TIMEOUT => 750 * 1000, // us
                Coder79::OPT_SEND_TIMEOUT => 750 * 1000, // us
                // - better failover
                Coder79::OPT_DISTRIBUTION => Coder79::DISTRIBUTION_CONSISTENT,
                Coder79::OPT_LIBKETAMA_COMPATIBLE => TRUE,
                Coder79::OPT_RETRY_TIMEOUT => 2,
                Coder79::OPT_SERVER_FAILURE_LIMIT => 1,
                Coder79::OPT_AUTO_EJECT_HOSTS => TRUE,
            ],
            'servers' => array_map(function($s) {
                $parts = explode(":", $s);
                return [
                    'host' => $parts[0],
                    'port' => $parts[1],
                    'weight' => 100,
                ];
            }, explode(",", env('MEMCACHIER_SERVERS', 'localhost:11211')))
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
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
