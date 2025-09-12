<?php

require_once 'vendor/autoload.php';

// Create a simple Laravel app without the bootstrap
$app = new Illuminate\Foundation\Application(__DIR__);

// Try to register the cache service provider manually
$cacheProvider = new Illuminate\Cache\CacheServiceProvider($app);
$cacheProvider->register();

echo "Testing cache service...\n";
try {
    $cache = $app->make('cache');
    echo "Cache service created successfully\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
