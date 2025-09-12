<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

echo "Registered service providers:\n";
$providers = $app->getLoadedProviders();
foreach ($providers as $provider => $loaded) {
    if ($loaded) {
        echo "- $provider\n";
    }
}

echo "\nChecking if CacheServiceProvider is loaded...\n";
if (isset($providers[Illuminate\Cache\CacheServiceProvider::class])) {
    echo "CacheServiceProvider is loaded: " . ($providers[Illuminate\Cache\CacheServiceProvider::class] ? 'YES' : 'NO') . "\n";
} else {
    echo "CacheServiceProvider is NOT in the loaded providers list\n";
}

echo "\nChecking bound services:\n";
$bindings = $app->getBindings();
foreach ($bindings as $key => $binding) {
    if (strpos($key, 'cache') !== false) {
        echo "- $key\n";
    }
}
