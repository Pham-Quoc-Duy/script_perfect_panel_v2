<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Route Caching
    |--------------------------------------------------------------------------
    | Enable route caching for production to speed up route resolution
    | Run: php artisan route:cache
    */
    'route_cache' => env('ROUTE_CACHE', false),

    /*
    |--------------------------------------------------------------------------
    | Config Caching
    |--------------------------------------------------------------------------
    | Enable config caching for production
    | Run: php artisan config:cache
    */
    'config_cache' => env('CONFIG_CACHE', false),

    /*
    |--------------------------------------------------------------------------
    | View Caching
    |--------------------------------------------------------------------------
    | Cache compiled views for faster rendering
    */
    'view_cache' => env('VIEW_CACHE', true),

    /*
    |--------------------------------------------------------------------------
    | Query Caching
    |--------------------------------------------------------------------------
    | Cache database queries for frequently accessed data
    */
    'query_cache_ttl' => env('QUERY_CACHE_TTL', 3600), // 1 hour

    /*
    |--------------------------------------------------------------------------
    | Asset Versioning
    |--------------------------------------------------------------------------
    | Use asset versioning to bust cache when files change
    */
    'asset_versioning' => env('ASSET_VERSIONING', true),
];
