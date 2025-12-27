<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Storage;

class NextGenImage extends Component
{
    public string $src;
    public ?string $alt;
    public ?string $class;
    public ?string $imgClass;
    public ?string $loading;
    public ?string $width;
    public ?string $height;
    public bool $isPublic;
    public ?string $sizes;
    
    public ?string $webpSrc = null;
    public ?string $avifSrc = null;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $src,
        ?string $alt = null,
        ?string $class = null,
        ?string $imgClass = null,
        ?string $loading = 'lazy',
        ?string $width = null,
        ?string $height = null,
        bool $isPublic = false,
        ?string $sizes = null
    ) {
        // Decode any HTML entities in the source path (e.g., &amp; to &)
        // This prevents double-encoding issues when filenames contain special characters
        $this->src = html_entity_decode($src, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $this->alt = $alt ?? '';
        $this->class = $class;
        $this->imgClass = $imgClass;
        $this->loading = $loading;
        $this->width = $width;
        $this->height = $height;
        $this->isPublic = $isPublic;
        $this->sizes = $sizes;
        
        // Determine next-gen image paths
        $this->determineNextGenPaths();
    }

    /**
     * Determine if WebP and AVIF versions exist
     */
    protected function determineNextGenPaths(): void
    {
        $pathInfo = pathinfo($this->src);
        $directory = $pathInfo['dirname'];
        $filename = $pathInfo['filename'];
        
        if ($this->isPublic) {
            // For public images (e.g., images/blog/image.jpg)
            $webpPath = $directory . '/' . $filename . '.webp';
            $avifPath = $directory . '/' . $filename . '.avif';
            
            if (file_exists(public_path($webpPath))) {
                $this->webpSrc = asset($webpPath);
            }
            
            if (file_exists(public_path($avifPath))) {
                $this->avifSrc = asset($avifPath);
            }
        } else {
            // For storage images (e.g., storage/blogs/filename.jpg)
            // Strip 'storage/' prefix from the beginning only for Storage::disk('public') operations
            $storagePath = preg_replace('#^storage/#', '', $this->src);
            $storagePathInfo = pathinfo($storagePath);
            $storageDirectory = $storagePathInfo['dirname'];
            $storageFilename = $storagePathInfo['filename'];
            
            // Handle case where directory is just "." (no subdirectory)
            $webpPath = ($storageDirectory !== '.') 
                ? $storageDirectory . '/' . $storageFilename . '.webp'
                : $storageFilename . '.webp';
            $avifPath = ($storageDirectory !== '.') 
                ? $storageDirectory . '/' . $storageFilename . '.avif'
                : $storageFilename . '.avif';
            
            if (Storage::disk('public')->exists($webpPath)) {
                $this->webpSrc = Storage::disk('public')->url($webpPath);
            }
            
            if (Storage::disk('public')->exists($avifPath)) {
                $this->avifSrc = Storage::disk('public')->url($avifPath);
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.next-gen-image');
    }
}
