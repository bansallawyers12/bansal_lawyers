<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImageService;
use Illuminate\Support\Facades\File;

class ConvertImagesToWebP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:convert-webp {path?} {--force : Force conversion even if WebP exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert existing images to WebP format';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $imageService = new ImageService();
        
        // Check if WebP is supported
        if (!$imageService->isWebPSupported()) {
            $this->error('WebP is not supported on this server. Please install GD or Imagick extension.');
            return 1;
        }

        $path = $this->argument('path') ?: public_path('images/blog');
        $force = $this->option('force');

        if (!is_dir($path)) {
            $this->error("Directory not found: {$path}");
            return 1;
        }

        $this->info("Converting images in: {$path}");
        $this->info("Force mode: " . ($force ? 'ON' : 'OFF'));
        $this->newLine();

        $extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $files = File::allFiles($path);
        $converted = 0;
        $skipped = 0;
        $failed = 0;

        foreach ($files as $file) {
            $extension = strtolower($file->getExtension());
            
            if (!in_array($extension, $extensions)) {
                continue;
            }

            $imagePath = $file->getPathname();
            $pathInfo = pathinfo($imagePath);
            $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';

            // Skip if WebP already exists and not forcing
            if (!$force && file_exists($webpPath)) {
                $skipped++;
                $this->line("Skipped (WebP exists): {$file->getFilename()}");
                continue;
            }

            try {
                $result = $imageService->generateWebP($imagePath);
                if ($result) {
                    $converted++;
                    $this->info("✓ Converted: {$file->getFilename()}");
                } else {
                    $failed++;
                    $this->warn("✗ Failed: {$file->getFilename()}");
                }
            } catch (\Exception $e) {
                $failed++;
                $this->error("✗ Error converting {$file->getFilename()}: " . $e->getMessage());
            }
        }

        $this->newLine();
        $this->info("Conversion complete!");
        $this->info("Converted: {$converted}");
        $this->info("Skipped: {$skipped}");
        if ($failed > 0) {
            $this->warn("Failed: {$failed}");
        }

        return 0;
    }
}

