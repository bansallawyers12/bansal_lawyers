{{-- Lazy JavaScript Loading Component --}}
{{-- Usage: @include('components.lazy-js', ['jsFiles' => ['/js/non-critical.js', '/js/optional.js']]) --}}

@if(isset($jsFiles) && is_array($jsFiles))
    @foreach($jsFiles as $jsFile)
        @if(!app()->environment('local', 'development'))
            {{-- Production: Use lazy loading for non-critical JS --}}
            <div data-lazy-js="{{ asset($jsFile) }}" style="display: none;"></div>
        @else
            {{-- Development: Load immediately for easier debugging --}}
            <script src="{{ asset($jsFile) }}"></script>
        @endif
    @endforeach
@endif

{{-- For JavaScript that should load when specific elements come into view --}}
@if(isset($conditionalJS) && is_array($conditionalJS))
    @foreach($conditionalJS as $jsFile)
        <div data-lazy-js="{{ asset($jsFile) }}" style="display: none;"></div>
    @endforeach
@endif
