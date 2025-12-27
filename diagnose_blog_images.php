<?php
/**
 * Blog Image Diagnostic Script - Extended Analysis
 * Analyzes database entries vs actual files with update history
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Blog;

echo "=== BLOG IMAGE DIAGNOSTIC REPORT (EXTENDED) ===\n";
echo "Generated: " . date('Y-m-d H:i:s') . "\n\n";

// Get all active blogs with images
$blogs = Blog::where('status', 1)
    ->whereNotNull('image')
    ->where('image', '!=', '')
    ->select('id', 'slug', 'title', 'image', 'created_at', 'updated_at')
    ->orderBy('updated_at', 'desc')
    ->get();

echo "Total active blogs: " . Blog::where('status', 1)->count() . "\n";
echo "Blogs with images: " . $blogs->count() . "\n\n";

// Show all blog image filenames
echo "--- ALL BLOG IMAGE FILENAMES IN DATABASE ---\n";
$filenameGroups = [];
foreach ($blogs as $blog) {
    $exists = file_exists(public_path('images/blog/' . $blog->image));
    $webpExists = file_exists(public_path('images/blog/' . pathinfo($blog->image, PATHINFO_FILENAME) . '.webp'));
    
    echo sprintf(
        "ID: %2d | %-50s | %s\n  File: %s%s\n  Updated: %s\n\n",
        $blog->id,
        substr($blog->slug, 0, 50),
        $exists ? '✓' : '✗',
        $blog->image,
        $webpExists ? ' (WebP ✓)' : ' (WebP ✗)',
        $blog->updated_at
    );
    
    // Group by filename for duplicates check
    if (!isset($filenameGroups[$blog->image])) {
        $filenameGroups[$blog->image] = 0;
    }
    $filenameGroups[$blog->image]++;
}

// Check for recent updates (last 30 days)
$recentUpdates = Blog::where('status', 1)
    ->where('updated_at', '>', now()->subDays(30))
    ->whereNotNull('image')
    ->where('image', '!=', '')
    ->count();

echo "--- UPDATE HISTORY ---\n";
echo "Blogs updated in last 30 days: $recentUpdates\n";
echo "Oldest blog update: " . $blogs->min('updated_at') . "\n";
echo "Newest blog update: " . $blogs->max('updated_at') . "\n\n";

// Check for the specific blogs mentioned in error report
$problematicSlugs = [
    'closing-loopholes-reforms-independent-contractors',
    'what-is-the-civil-dispute-resolution-act-2011-australia'
];

echo "--- SPECIFIC BLOGS MENTIONED IN ERROR REPORT ---\n";
foreach ($problematicSlugs as $slug) {
    $blog = Blog::where('slug', $slug)->first();
    if ($blog) {
        $exists = file_exists(public_path('images/blog/' . $blog->image));
        $webpPath = 'images/blog/' . pathinfo($blog->image, PATHINFO_FILENAME) . '.webp';
        $webpExists = file_exists(public_path($webpPath));
        
        echo "Slug: $slug\n";
        echo "  DB Image: {$blog->image}\n";
        echo "  File exists: " . ($exists ? 'YES' : 'NO') . "\n";
        echo "  WebP exists: " . ($webpExists ? 'YES' : 'NO') . "\n";
        echo "  Last updated: {$blog->updated_at}\n\n";
    } else {
        echo "Slug: $slug - NOT FOUND IN DATABASE\n\n";
    }
}

// Check if Top_10_legal_Service_in_Australia.jpg is used
echo "--- CHECK FOR ERROR REPORT FILENAME ---\n";
$errorFilename = 'Top_10_legal_Service_in_Australia.jpg';
$blogsUsingErrorFile = Blog::where('image', $errorFilename)->get();
if ($blogsUsingErrorFile->count() > 0) {
    echo "FOUND: $errorFilename is used by " . $blogsUsingErrorFile->count() . " blog(s):\n";
    foreach ($blogsUsingErrorFile as $b) {
        echo "  - ID {$b->id}: {$b->slug}\n";
    }
} else {
    echo "NOT FOUND: $errorFilename is not used in any blog post\n";
}
echo "\n";

// Analyze WebP coverage
$totalWithImages = $blogs->count();
$withWebP = 0;
$with400WebP = 0;
$with800WebP = 0;

foreach ($blogs as $blog) {
    $basename = pathinfo($blog->image, PATHINFO_FILENAME);
    if (file_exists(public_path('images/blog/' . $basename . '.webp'))) {
        $withWebP++;
    }
    if (file_exists(public_path('images/blog/' . $basename . '-400.webp'))) {
        $with400WebP++;
    }
    if (file_exists(public_path('images/blog/' . $basename . '-800.webp'))) {
        $with800WebP++;
    }
}

echo "--- WEBP COVERAGE ---\n";
echo "Blogs with images: $totalWithImages\n";
echo "With WebP version: $withWebP (" . round($withWebP/$totalWithImages*100, 1) . "%)\n";
echo "With 400px WebP: $with400WebP (" . round($with400WebP/$totalWithImages*100, 1) . "%)\n";
echo "With 800px WebP: $with800WebP (" . round($with800WebP/$totalWithImages*100, 1) . "%)\n";

echo "\n=== END OF REPORT ===\n";
