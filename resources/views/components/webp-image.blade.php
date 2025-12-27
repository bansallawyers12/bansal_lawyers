@php
    // Helper component for WebP images with fallback
    $imagePath = $imagePath ?? '';
    $alt = $alt ?? '';
    $class = $class ?? '';
    $width = $width ?? '';
    $height = $height ?? '';
    $loading = $loading ?? 'lazy';
    $fetchpriority = $fetchpriority ?? '';
    
    if (empty($imagePath)) {
        return;
    }
    
    $imagePath = ltrim($imagePath, '/');
    $pathInfo = pathinfo($imagePath);
    $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
    $hasWebP = file_exists(public_path($webpPath));
@endphp

<picture>
    @if($hasWebP)
        <source type="image/webp" srcset="{!! asset($webpPath) !!}">
    @endif
    <img src="{!! asset($imagePath) !!}" 
         alt="{{ $alt }}"
         @if($class) class="{{ $class }}" @endif
         @if($width) width="{{ $width }}" @endif
         @if($height) height="{{ $height }}" @endif
         loading="{{ $loading }}"
         @if($fetchpriority) fetchpriority="{{ $fetchpriority }}" @endif>
</picture>

