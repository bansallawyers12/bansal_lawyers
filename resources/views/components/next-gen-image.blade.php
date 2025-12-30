@if($avifSrc || $webpSrc)
<picture {{ $attributes->merge(['class' => $class]) }}>
    @if($avifSrc)
    <source srcset="{!! $avifSrc !!}" type="image/avif" {!! $sizes ? 'sizes="' . $sizes . '"' : '' !!}>
    @endif
    
    @if($webpSrc)
    <source srcset="{!! $webpSrc !!}" type="image/webp" {!! $sizes ? 'sizes="' . $sizes . '"' : '' !!}>
    @endif
    
    <img 
        src="{!! asset($src) !!}" 
        alt="{{ $alt }}"
        {!! $imgClass ? 'class="' . $imgClass . '"' : '' !!}
        {!! $loading ? 'loading="' . $loading . '"' : '' !!}
        {!! $width ? 'width="' . $width . '"' : '' !!}
        {!! $height ? 'height="' . $height . '"' : '' !!}
        onerror="this.onerror=null; this.src='{{ asset('images/Blog.jpg') }}';"
    >
</picture>
@else
<img 
    src="{!! asset($src) !!}" 
    alt="{{ $alt }}"
    {{ $attributes->merge(['class' => $imgClass]) }}
    {!! $loading ? 'loading="' . $loading . '"' : '' !!}
    {!! $width ? 'width="' . $width . '"' : '' !!}
    {!! $height ? 'height="' . $height . '"' : '' !!}
    onerror="this.onerror=null; this.src='{{ asset('images/Blog.jpg') }}';"
>
@endif
