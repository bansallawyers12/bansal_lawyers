<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ConvertImagesToNextGen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:convert-nextgen 
                            {--storage : Convert images in storage/app/public}
                            {--public : Convert images in public/images}
                            {--all : Convert all images}
                            {--force : Overwrite existing next-gen images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert existing images to next-gen formats (WebP and AVIF)';

    protected ImageService $imageService;

    /**
     * Execute the console command.
     */
    public function handle(ImageService $imageService)
    {
        $this->imageService = $imageService;
        
        $convertStorage = $this->option('storage') || $this->option('all');
        $convertPublic = $this->option('public') || $this->option('all');
        
        if (!$convertStorage && !$convertPublic) {
            $this->error('Please specify --storage, --public, or --all');
            return 1;
        }

        $this->info('Starting image conversion to next-gen formats...');
        $this->newLine();

        $totalConverted = 0;
        $totalSkipped = 0;
        $totalErrors = 0;

        if ($convertStorage) {
            $this->info('Converting images in storage/app/public...');
            [$converted, $skipped, $errors] = $this->convertStorageImages();
            $totalConverted += $converted;
            $totalSkipped += $skipped;
            $totalErrors += $errors;
            $this->newLine();
        }

        if ($convertPublic) {
            $this->info('Converting images in public/images...');
            [$converted, $skipped, $errors] = $this->convertPublicImages();
            $totalConverted += $converted;
            $totalSkipped += $skipped;
            $totalErrors += $errors;
        }

        $this->newLine();
        $this->info("Conversion complete!");
        $this->table(
            ['Status', 'Count'],
            [
                ['Converted', $totalConverted],
                ['Skipped', $totalSkipped],
                ['Errors', $totalErrors],
            ]
        );

        return 0;
    }

    /**
     * Convert images in storage/app/public
     */
    protected function convertStorageImages(): array
    {
        $converted = 0;
        $skipped = 0;
        $errors = 0;

        $directories = ['blogs', 'recent_cases', 'pages', 'cms_pages'];

        foreach ($directories as $directory) {
            if (!Storage::disk('public')->exists($directory)) {
                continue;
            }

            $files = Storage::disk('public')->allFiles($directory);
            
            $imageFiles = array_filter($files, function($file) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp']);
            });

            foreach ($imageFiles as $file) {
                try {
                    $pathInfo = pathinfo($file);
                    $webpExists = Storage::disk('public')->exists($pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp');
                    $avifExists = Storage::disk('public')->exists($pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.avif');

                    if (!$this->option('force') && $webpExists && $avifExists) {
                        $this->line("  Skipping {$file} (next-gen versions already exist)");
                        $skipped++;
                        continue;
                    }

                    $this->line("  Converting {$file}...");
                    $result = $this->imageService->convertExisting($file, 'public');
                    
                    if ($result['webp'] || $result['avif']) {
                        $converted++;
                        $formats = array_filter([$result['webp'] ? 'WebP' : null, $result['avif'] ? 'AVIF' : null]);
                        $this->info("    ✓ Created: " . implode(', ', $formats));
                    } else {
                        $skipped++;
                        $this->warn("    ⚠ No next-gen versions created");
                    }
                    
                } catch (\Exception $e) {
                    $errors++;
                    $this->error("    ✗ Error: {$e->getMessage()}");
                }
            }
        }

        return [$converted, $skipped, $errors];
    }

    /**
     * Convert images in public/images
     */
    protected function convertPublicImages(): array
    {
        $converted = 0;
        $skipped = 0;
        $errors = 0;

        $publicImgPath = public_path('images');
        
        if (!is_dir($publicImgPath)) {
            $this->warn('Public images directory not found');
            return [0, 0, 0];
        }

        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
        $files = File::allFiles($publicImgPath);

        foreach ($files as $file) {
            $extension = strtolower($file->getExtension());
            
            if (!in_array($extension, $imageExtensions)) {
                continue;
            }

            try {
                $relativePath = str_replace(public_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $relativePath = str_replace('\\', '/', $relativePath);
                
                $webpPath = $file->getPath() . '/' . $file->getFilenameWithoutExtension() . '.webp';
                $avifPath = $file->getPath() . '/' . $file->getFilenameWithoutExtension() . '.avif';

                if (!$this->option('force') && file_exists($webpPath) && file_exists($avifPath)) {
                    $this->line("  Skipping {$relativePath} (next-gen versions already exist)");
                    $skipped++;
                    continue;
                }

                $this->line("  Converting {$relativePath}...");
                $result = $this->imageService->convertPublicImage($relativePath);
                
                if ($result['webp'] || $result['avif']) {
                    $converted++;
                    $formats = array_filter([$result['webp'] ? 'WebP' : null, $result['avif'] ? 'AVIF' : null]);
                    $this->info("    ✓ Created: " . implode(', ', $formats));
                } else {
                    $skipped++;
                    $this->warn("    ⚠ No next-gen versions created");
                }
                
            } catch (\Exception $e) {
                $errors++;
                $this->error("    ✗ Error: {$e->getMessage()}");
            }
        }

        return [$converted, $skipped, $errors];
    }
}
