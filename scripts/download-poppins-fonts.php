<?php
/**
 * PHP script to download missing Poppins font files from Google Fonts
 * 
 * Usage: php scripts/download-poppins-fonts.php
 * 
 * This script downloads the missing Poppins font weights (300, 500, 700, 800)
 * from Google Fonts and saves them to public/fonts/poppins/
 */

// Font weights to download
$fontWeights = [
    ['weight' => 300, 'name' => 'poppins-light'],
    ['weight' => 500, 'name' => 'poppins-medium'],
    ['weight' => 700, 'name' => 'poppins-bold'],
    ['weight' => 800, 'name' => 'poppins-extrabold']
];

// Output directory
$outputDir = __DIR__ . '/../public/fonts/poppins';

// Ensure output directory exists
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

echo "🚀 Starting Poppins font download...\n\n";

foreach ($fontWeights as $font) {
    $filepath = $outputDir . '/' . $font['name'] . '.woff2';
    
    // Skip if file already exists
    if (file_exists($filepath)) {
        echo "⏭️  Skipping {$font['name']}.woff2 (already exists)\n";
        continue;
    }
    
    try {
        echo "📥 Downloading {$font['name']}.woff2 (weight: {$font['weight']})...\n";
        
        // Get CSS from Google Fonts API
        $cssUrl = "https://fonts.googleapis.com/css2?family=Poppins:wght@{$font['weight']}&display=swap";
        $cssContent = file_get_contents($cssUrl);
        
        // Extract WOFF2 URL from CSS
        if (preg_match('/url\(([^)]+\.woff2[^)]*)\)/', $cssContent, $matches)) {
            $fontUrl = trim($matches[1], '\'"');
            
            $urlPreview = strlen($fontUrl) > 80 ? substr($fontUrl, 0, 80) . '...' : $fontUrl;
            echo "   URL: {$urlPreview}\n";
            
            // Download the font file
            $fontData = file_get_contents($fontUrl);
            
            if ($fontData !== false) {
                file_put_contents($filepath, $fontData);
                
                // Check file size
                $fileSizeKB = round(filesize($filepath) / 1024, 2);
                echo "✅ Downloaded {$font['name']}.woff2 ({$fileSizeKB} KB)\n\n";
            } else {
                echo "❌ Failed to download font file\n\n";
            }
            
        } else {
            echo "❌ Could not find WOFF2 URL for weight {$font['weight']}\n\n";
        }
        
    } catch (Exception $e) {
        echo "❌ Error downloading {$font['name']}.woff2: {$e->getMessage()}\n\n";
    }
}

echo "✨ Font download complete!\n";
echo "\n📁 Fonts saved to: {$outputDir}\n";

// List all Poppins fonts
echo "\n📋 Current Poppins font files:\n";
$files = glob($outputDir . '/*.woff2');
foreach ($files as $file) {
    $filename = basename($file);
    $sizeKB = round(filesize($file) / 1024, 2);
    echo "   - {$filename} ({$sizeKB} KB)\n";
}

