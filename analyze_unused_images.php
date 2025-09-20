<?php
/**
 * Script to analyze unused images in the Bansal Lawyers project
 * This script will check all image files and identify which ones are not referenced in the codebase
 */

// Get all image files from public directory
function getAllImageFiles($directory) {
    $images = [];
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
    
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $extension = strtolower($file->getExtension());
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'ico', 'webp', 'avif'])) {
                $relativePath = str_replace('\\', '/', substr($file->getPathname(), strlen($directory) + 1));
                $images[] = $relativePath;
            }
        }
    }
    
    return $images;
}

// Search for image references in files
function searchImageReferences($imagePath, $searchDirectories) {
    $references = [];
    $filename = basename($imagePath);
    
    // Simple search patterns
    $searchTerms = [
        $imagePath,
        $filename,
        'images/' . $filename,
        'img/' . $filename
    ];
    
    foreach ($searchDirectories as $dir) {
        if (!is_dir($dir)) continue;
        
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
        
        foreach ($iterator as $file) {
            if ($file->isFile() && in_array($file->getExtension(), ['php', 'blade.php', 'css', 'js', 'html'])) {
                $content = file_get_contents($file->getPathname());
                
                foreach ($searchTerms as $term) {
                    if (strpos($content, $term) !== false) {
                        $references[] = [
                            'file' => $file->getPathname(),
                            'term' => $term
                        ];
                        break 2; // Found a reference, no need to check other terms for this file
                    }
                }
            }
        }
    }
    
    return $references;
}

function getLineNumber($content, $term) {
    $lines = explode("\n", $content);
    foreach ($lines as $lineNum => $line) {
        if (strpos($line, $term) !== false) {
            return $lineNum + 1;
        }
    }
    return null;
}

// Main analysis
echo "=== BANSAL LAWYERS - UNUSED IMAGES ANALYSIS ===\n\n";

$publicDir = __DIR__ . '/public';
$searchDirs = [
    __DIR__ . '/resources',
    __DIR__ . '/app',
    __DIR__ . '/config',
    __DIR__ . '/routes'
];

echo "1. Scanning image files...\n";
$allImages = getAllImageFiles($publicDir);
echo "Found " . count($allImages) . " image files\n\n";

echo "2. Analyzing image usage...\n";
$usedImages = [];
$unusedImages = [];
$totalImages = count($allImages);
$processed = 0;

foreach ($allImages as $imagePath) {
    $processed++;
    if ($processed % 50 == 0) {
        echo "Processed $processed/$totalImages images...\n";
    }
    
    $references = searchImageReferences($imagePath, $searchDirs);
    
    if (!empty($references)) {
        $usedImages[$imagePath] = $references;
    } else {
        $unusedImages[] = $imagePath;
    }
}

echo "\n3. Analysis Complete!\n\n";

// Generate report
echo "=== USAGE REPORT ===\n";
echo "Total Images: " . count($allImages) . "\n";
echo "Used Images: " . count($usedImages) . "\n";
echo "Unused Images: " . count($unusedImages) . "\n";
echo "Usage Percentage: " . round((count($usedImages) / count($allImages)) * 100, 2) . "%\n\n";

if (!empty($unusedImages)) {
    echo "=== UNUSED IMAGES ===\n";
    foreach ($unusedImages as $unused) {
        echo "- $unused\n";
    }
    echo "\n";
}

// Save detailed report to file
$reportFile = __DIR__ . '/unused_images_report.txt';
$report = "BANSAL LAWYERS - UNUSED IMAGES ANALYSIS\n";
$report .= "Generated on: " . date('Y-m-d H:i:s') . "\n\n";
$report .= "Total Images: " . count($allImages) . "\n";
$report .= "Used Images: " . count($usedImages) . "\n";
$report .= "Unused Images: " . count($unusedImages) . "\n";
$report .= "Usage Percentage: " . round((count($usedImages) / count($allImages)) * 100, 2) . "%\n\n";

if (!empty($unusedImages)) {
    $report .= "UNUSED IMAGES:\n";
    $report .= "==============\n";
    foreach ($unusedImages as $unused) {
        $report .= "- $unused\n";
    }
    $report .= "\n";
}

$report .= "USED IMAGES (with references):\n";
$report .= "==============================\n";
foreach ($usedImages as $image => $refs) {
    $report .= "- $image\n";
    foreach ($refs as $ref) {
        $report .= "  -> " . basename($ref['file']) . " (found: " . $ref['term'] . ")\n";
    }
    $report .= "\n";
}

file_put_contents($reportFile, $report);
echo "Detailed report saved to: unused_images_report.txt\n";

echo "\n=== TOP 10 LARGEST UNUSED IMAGES ===\n";
$unusedWithSizes = [];
foreach ($unusedImages as $unused) {
    $fullPath = $publicDir . '/' . $unused;
    if (file_exists($fullPath)) {
        $unusedWithSizes[$unused] = filesize($fullPath);
    }
}
arsort($unusedWithSizes);
$topUnused = array_slice($unusedWithSizes, 0, 10, true);
foreach ($topUnused as $image => $size) {
    echo "- $image (" . round($size / 1024, 2) . " KB)\n";
}

echo "\nAnalysis complete!\n";
?>
