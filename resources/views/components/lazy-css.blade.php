{{-- Lazy CSS Loading Component --}}
{{-- Usage: @include('components.lazy-css', ['cssFiles' => ['/css/non-critical.css', '/css/optional.css']]) --}}

@if(isset($cssFiles) && is_array($cssFiles))
    @foreach($cssFiles as $cssFile)
        @if(!app()->environment('local', 'development'))
            {{-- Production: Use lazy loading for non-critical CSS --}}
            <link rel="preload" href="{{ asset($cssFile) }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
            <noscript>
                <link rel="stylesheet" href="{{ asset($cssFile) }}">
            </noscript>
        @else
            {{-- Development: Load immediately for easier debugging --}}
            <link rel="stylesheet" href="{{ asset($cssFile) }}">
        @endif
    @endforeach
@endif

{{-- Critical CSS is loaded in the head, non-critical CSS is loaded here --}}
@if(isset($nonCriticalCSS) && is_array($nonCriticalCSS))
    @foreach($nonCriticalCSS as $cssFile)
        <div data-lazy-css="{{ asset($cssFile) }}" style="display: none;"></div>
    @endforeach
@endif
