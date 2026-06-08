<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        // Check if GD extension is available
        if (extension_loaded('gd')) {
            $this->manager = ImageManager::usingDriver(Driver::class);
        }
    }

    /**
     * Upload and convert image to WebP format
     * 
     * @param UploadedFile $file
     * @param string $directory
     * @param string $disk
     * @return array ['original' => path, 'webp' => path|null]
     */
    public function uploadAndConvert(UploadedFile $file, string $directory, string $disk = 'public'): array
    {
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $timestamp = time();
        
        // Generate unique filename
        $baseFilename = $filename . '_' . $timestamp;
        
        $extension = strtolower($file->getClientOriginalExtension());

        // Store original file
        $originalPath = $file->store($directory, $disk);
        
        $paths = [
            'original' => $originalPath,
        ];
        
        try {
            // Get the full path to the original file
            $fullPath = Storage::disk($disk)->path($originalPath);
            
            // Generate WebP version when original isn't already WebP
            if ($extension !== 'webp') {
                $webpPath = $this->convertToWebP($fullPath, $directory, $baseFilename, $disk);
                if ($webpPath) {
                    $paths['webp'] = $webpPath;
                }
            }
            
        } catch (\Exception $e) {
            // Log error but continue - we still have the original
            \Log::warning('Image conversion failed: ' . $e->getMessage());
        }
        
        return $paths;
    }

    /**
     * Convert image to WebP format
     */
    protected function convertToWebP(string $sourcePath, string $directory, string $baseFilename, string $disk): ?string
    {
        try {
            if (!extension_loaded('gd')) {
                return null;
            }

            // Load the image
            $image = $this->manager->decodePath($sourcePath);
            
            // Generate WebP path
            $webpFilename = $baseFilename . '.webp';
            $webpPath = $directory . '/' . $webpFilename;
            $webpFullPath = Storage::disk($disk)->path($webpPath);
            
            // Ensure directory exists
            $webpDir = dirname($webpFullPath);
            if (!is_dir($webpDir)) {
                mkdir($webpDir, 0755, true);
            }
            
            // Convert and save as WebP with quality 85
            $image->save($webpFullPath, quality: 85);
            
            return $webpPath;
            
        } catch (\Exception $e) {
            \Log::warning('WebP conversion failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Convert existing image file to WebP
     * 
     * @param string $imagePath Relative path to the image in storage
     * @param string $disk Storage disk name
     * @return array ['webp' => path|null]
     */
    public function convertExisting(string $imagePath, string $disk = 'public'): array
    {
        $paths = [
            'webp' => null,
        ];
        
        try {
            if (!Storage::disk($disk)->exists($imagePath)) {
                return $paths;
            }
            
            $fullPath = Storage::disk($disk)->path($imagePath);
            $directory = dirname($imagePath);
            $filename = pathinfo($imagePath, PATHINFO_FILENAME);
            
            $extension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
            
            // Generate WebP version
            if ($extension !== 'webp') {
                $paths['webp'] = $this->convertToWebP($fullPath, $directory, $filename, $disk);
            }
            
        } catch (\Exception $e) {
            \Log::error('Existing image conversion failed: ' . $e->getMessage());
        }
        
        return $paths;
    }

    /**
     * Convert image from public directory (not storage)
     * 
     * @param string $publicPath Relative path from public directory (e.g., 'images/blog/image.jpg')
     * @return array ['webp' => path|null]
     */
    public function convertPublicImage(string $publicPath): array
    {
        $paths = [
            'webp' => null,
        ];
        
        try {
            $fullPath = public_path($publicPath);
            
            if (!file_exists($fullPath)) {
                return $paths;
            }
            
            $directory = dirname($publicPath);
            $filename = pathinfo($publicPath, PATHINFO_FILENAME);
            
            // For public images, we'll save directly to public directory
            $webpFilename = $filename . '.webp';
            $webpPath = public_path($directory . '/' . $webpFilename);
            
            if (extension_loaded('gd')) {
                $image = $this->manager->decodePath($fullPath);
                
                // Create directory if needed
                $webpDir = dirname($webpPath);
                if (!is_dir($webpDir)) {
                    mkdir($webpDir, 0755, true);
                }
                
                $image->save($webpPath, quality: 85);
                $paths['webp'] = $directory . '/' . $webpFilename;
            }
            
        } catch (\Exception $e) {
            \Log::error('Public image conversion failed: ' . $e->getMessage());
        }
        
        return $paths;
    }

    /**
     * Delete image and its next-gen versions
     * 
     * @param string $imagePath
     * @param string $disk
     */
    public function deleteWithVersions(string $imagePath, string $disk = 'public'): void
    {
        try {
            // Delete original
            Storage::disk($disk)->delete($imagePath);
            
            // Delete WebP version
            $webpPath = $this->getNextGenPath($imagePath, 'webp');
            Storage::disk($disk)->delete($webpPath);
            
        } catch (\Exception $e) {
            \Log::warning('Image deletion failed: ' . $e->getMessage());
        }
    }

    /**
     * Get the next-gen format path for an image
     */
    protected function getNextGenPath(string $originalPath, string $format): string
    {
        $info = pathinfo($originalPath);
        return $info['dirname'] . '/' . $info['filename'] . '.' . $format;
    }

    /**
     * Generate WebP version of an image (legacy method for backward compatibility)
     * 
     * @param string $imagePath Full path to the original image
     * @param int $quality WebP quality (1-100), default 85
     * @return string|null WebP filename or null on failure
     */
    public function generateWebP($imagePath, $quality = 85)
    {
        try {
            // Check if file exists
            if (!file_exists($imagePath)) {
                return null;
            }

            // Get image info
            $pathInfo = pathinfo($imagePath);
            $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';

            // Skip if WebP already exists
            if (file_exists($webpPath)) {
                return $pathInfo['filename'] . '.webp';
            }

            // Generate WebP
            if (!extension_loaded('gd')) {
                return null;
            }

            $image = $this->manager->decodePath($imagePath);
            
            $image->save($webpPath, quality: $quality);

            return $pathInfo['filename'] . '.webp';
        } catch (\Exception $e) {
            // Log error but don't break the upload
            \Log::warning('WebP conversion failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Generate responsive image sizes
     * 
     * @param string $imagePath Full path to the original image
     * @param array $sizes Array of sizes like ['small' => 400, 'medium' => 800, 'large' => 1200]
     * @return array Array of generated filenames
     */
    public function generateResponsiveSizes($imagePath, $sizes = [])
    {
        $generated = [];
        
        try {
            if (!file_exists($imagePath)) {
                return $generated;
            }

            if (!extension_loaded('gd')) {
                return $generated;
            }

            $pathInfo = pathinfo($imagePath);
            $originalWidth = $this->manager->decodePath($imagePath)->width();

            // Default sizes if not provided
            if (empty($sizes)) {
                $sizes = [
                    'small' => 400,
                    'medium' => 800,
                    'large' => 1200
                ];
            }

            foreach ($sizes as $name => $width) {
                // Don't upscale
                if ($width >= $originalWidth) {
                    continue;
                }

                $resizedPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_' . $name . '.webp';

                $this->manager->decodePath($imagePath)
                    ->scale(width: $width)
                    ->save($resizedPath, quality: 85);

                $generated[$name] = $pathInfo['filename'] . '_' . $name . '.webp';
            }
        } catch (\Exception $e) {
            \Log::warning('Responsive image generation failed: ' . $e->getMessage());
        }

        return $generated;
    }

    /**
     * Delete WebP and responsive versions of an image (legacy method)
     * 
     * @param string $originalFilename Original image filename
     * @param string $filePath Directory path
     */
    public function deleteImageVariants($originalFilename, $filePath)
    {
        $pathInfo = pathinfo($originalFilename);
        $baseName = $pathInfo['filename'];
        $directory = rtrim($filePath, '/');

        // Delete WebP version
        $webpPath = $directory . '/' . $baseName . '.webp';
        if (file_exists($webpPath)) {
            @unlink($webpPath);
        }

        // Delete responsive sizes
        $sizes = ['small', 'medium', 'large'];
        foreach ($sizes as $size) {
            $sizePath = $directory . '/' . $baseName . '_' . $size . '.webp';
            if (file_exists($sizePath)) {
                @unlink($sizePath);
            }
        }
    }

    /**
     * Upload and convert image using direct file path (for legacy support)
     * This method works with the old file system approach using public_path()
     * 
     * @param string $fullPath Full path to the uploaded file
     * @param string $directory Directory where file was saved
     * @param string $filename Filename of the uploaded file
     * @return array ['webp' => path|null]
     */
    public function convertUploadedFile(string $fullPath, string $directory, string $filename): array
    {
        $paths = [
            'webp' => null,
        ];
        
        try {
            if (!file_exists($fullPath)) {
                return $paths;
            }
            
            $pathInfo = pathinfo($fullPath);
            $baseFilename = $pathInfo['filename'];
            $extension = strtolower($pathInfo['extension']);
            
            // Generate WebP version
            if ($extension !== 'webp') {
                $webpPath = $directory . '/' . $baseFilename . '.webp';
                
                if (!file_exists($webpPath)) {
                    if (extension_loaded('gd')) {
                        $image = $this->manager->decodePath($fullPath);
                        $image->save($webpPath, quality: 85);
                        $paths['webp'] = $baseFilename . '.webp';
                    }
                } else {
                    $paths['webp'] = $baseFilename . '.webp';
                }
            }
            
        } catch (\Exception $e) {
            \Log::warning('File path conversion failed: ' . $e->getMessage());
        }
        
        return $paths;
    }

    /**
     * Check if WebP is supported by the server
     * 
     * @return bool
     */
    public function isWebPSupported()
    {
        return function_exists('imagewebp') || extension_loaded('imagick');
    }
}
