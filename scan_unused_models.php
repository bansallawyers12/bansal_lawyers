<?php
// Simple static scan for unused Eloquent models by text reference
// Looks for either "\\App\\Models\\ModelName" or "use App\\Models\\ModelName;" in .php and .blade.php files

error_reporting(E_ALL);
ini_set('display_errors', '1');

$root = __DIR__;
$modelsDir = $root . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Models';

function listFiles(string $dir): array {
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS));
    $files = [];
    foreach ($rii as $file) {
        if (!$file->isFile()) continue;
        $path = $file->getPathname();
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext === 'php' || $ext === 'blade') {
            $files[] = $path;
        } elseif ($ext === 'php_22-01-2024' || $ext === 'blade.php') {
            $files[] = $path;
        }
    }
    return $files;
}

function fileContainsAny(string $path, array $needles): bool {
    $contents = @file_get_contents($path);
    if ($contents === false) return false;
    foreach ($needles as $needle) {
        if (strpos($contents, $needle) !== false) return true;
    }
    return false;
}

if (!is_dir($modelsDir)) {
    fwrite(STDERR, "Models directory not found: $modelsDir\n");
    exit(2);
}

$allCodeFiles = listFiles($root);
$allModels = glob($modelsDir . DIRECTORY_SEPARATOR . '*.php');
$unused = [];

foreach ($allModels as $modelPath) {
    $modelFile = basename($modelPath);
    $modelName = substr($modelFile, 0, -4); // strip .php
    // Skip special case base model names if any
    if ($modelName === 'Model') continue;

    $needles = [
        '\\App\\Models\\' . $modelName,
        'use App\\Models\\' . $modelName . ';',
    ];

    $hasRef = false;
    foreach ($allCodeFiles as $codePath) {
        if ($codePath === $modelPath) continue; // ignore self
        if (fileContainsAny($codePath, $needles)) {
            $hasRef = true;
            break;
        }
    }

    if (!$hasRef) {
        $unused[] = $modelName;
    }
}

sort($unused);
if (empty($unused)) {
    echo "No zero-reference models found.\n";
} else {
    echo "Zero-reference models (candidates for removal):\n";
    foreach ($unused as $name) {
        echo "- $name\n";
    }
}

// Also print a count summary
echo "Total models scanned: " . count($allModels) . "\n";
echo "Candidates: " . count($unused) . "\n";


