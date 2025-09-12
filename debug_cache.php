<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

try {
    echo "Testing cache service...\n";
    $cache = $app->make('cache');
    echo "Cache service created successfully\n";
    
    echo "Testing cache.store...\n";
    $cacheStore = $app->make('cache.store');
    echo "Cache store created successfully\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
