<?php

namespace App\Services;

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Exception;

class ImageService
{
    /**
     * Generate WebP version of an image
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
            $img = Image::read($imagePath);
            
            // Convert to WebP format
            $img->encode(new \Intervention\Image\Encoders\WebpEncoder(quality: $quality))
                ->save($webpPath);

            return $pathInfo['filename'] . '.webp';
        } catch (Exception $e) {
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

            $pathInfo = pathinfo($imagePath);
            $img = Image::read($imagePath);
            $originalWidth = $img->width();
            $originalHeight = $img->height();

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

                $height = (int) ($originalHeight * ($width / $originalWidth));
                $resizedPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_' . $name . '.webp';

                // Resize and save as WebP
                $img->scale(width: $width, height: $height)
                    ->encode(new \Intervention\Image\Encoders\WebpEncoder(quality: 85))
                    ->save($resizedPath);

                $generated[$name] = $pathInfo['filename'] . '_' . $name . '.webp';
            }
        } catch (Exception $e) {
            \Log::warning('Responsive image generation failed: ' . $e->getMessage());
        }

        return $generated;
    }

    /**
     * Delete WebP and responsive versions of an image
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
     * Check if WebP is supported by the server
     * 
     * @return bool
     */
    public function isWebPSupported()
    {
        return function_exists('imagewebp') || extension_loaded('imagick');
    }
}

