<?php

require_once __DIR__.'/../vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

$app = Application::configure(basePath: __DIR__.'/../')
    ->withRouting(
        web: base_path('routes/web.php'),
        api: base_path('routes/api.php'),
        commands: base_path('routes/console.php'),
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Minimal middleware setup
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Minimal exception handling
    })
    ->create();

// Only register the cache service provider
$app->register(Illuminate\Cache\CacheServiceProvider::class);

return $app;
