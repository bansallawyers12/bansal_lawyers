{{-- Advanced Asset Loading Strategy Component --}}
{{-- Provides intelligent loading based on connection speed, device capabilities, and user behavior --}}

@php
    $isSlowConnection = request()->header('Save-Data') === 'on' || 
                       (request()->header('Connection') === 'slow-2g' || 
                        request()->header('Connection') === '2g');
    
    $isMobile = request()->header('User-Agent') && 
                preg_match('/Mobile|Android|iPhone|iPad/', request()->header('User-Agent'));
    
    $isLowEndDevice = request()->header('Device-Memory') && 
                      (int) request()->header('Device-Memory') <= 2;
    
    $loadStrategy = $isSlowConnection || $isMobile || $isLowEndDevice ? 'conservative' : 'aggressive';
@endphp

{{-- Connection-aware loading strategy --}}
<script>
window.AssetLoader = {
    strategy: '{{ $loadStrategy }}',
    isSlowConnection: {{ $isSlowConnection ? 'true' : 'false' }},
    isMobile: {{ $isMobile ? 'true' : 'false' }},
    isLowEndDevice: {{ $isLowEndDevice ? 'true' : 'false' }},
    
    // Intelligent preloading based on strategy
    preloadCritical: function() {
        const criticalAssets = [
            { href: '{{ asset("build/critical.css") }}', as: 'style' },
            { href: '{{ asset("build/assets/app-frontend") }}.js', as: 'script' }
        ];
        
        criticalAssets.forEach(asset => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.href = asset.href;
            link.as = asset.as;
            link.crossOrigin = 'anonymous';
            document.head.appendChild(link);
        });
    },
    
    // Progressive enhancement loading
    loadProgressively: function() {
        if (this.strategy === 'conservative') {
            // Load only essential assets immediately
            this.loadEssential();
            
            // Load non-critical assets on user interaction
            document.addEventListener('scroll', this.loadOnInteraction.bind(this), { once: true });
            document.addEventListener('click', this.loadOnInteraction.bind(this), { once: true });
        } else {
            // Aggressive loading for fast connections
            this.loadAll();
        }
    },
    
    loadEssential: function() {
        // Load only above-the-fold assets
        const essentialAssets = [
            '{{ asset("build/assets/css-frontend") }}.css',
            '{{ asset("build/assets/vendor-bootstrap") }}.js'
        ];
        
        essentialAssets.forEach(asset => {
            if (asset.endsWith('.css')) {
                this.loadCSS(asset);
            } else {
                this.loadJS(asset);
            }
        });
    },
    
    loadOnInteraction: function() {
        // Load remaining assets after user interaction
        const nonCriticalAssets = [
            '{{ asset("build/assets/vendor-animations") }}.js',
            '{{ asset("build/assets/vendor-datatables") }}.js',
            '{{ asset("build/assets/app-frontend") }}.js'
        ];
        
        nonCriticalAssets.forEach(asset => {
            this.loadJS(asset);
        });
    },
    
    loadAll: function() {
        // Load all assets for fast connections
        const allAssets = [
            { href: '{{ asset("build/assets/css-frontend") }}.css', type: 'css' },
            { href: '{{ asset("build/assets/vendor-bootstrap") }}.js', type: 'js' },
            { href: '{{ asset("build/assets/vendor-animations") }}.js', type: 'js' },
            { href: '{{ asset("build/assets/app-frontend") }}.js', type: 'js' }
        ];
        
        allAssets.forEach(asset => {
            if (asset.type === 'css') {
                this.loadCSS(asset.href);
            } else {
                this.loadJS(asset.href);
            }
        });
    },
    
    loadCSS: function(href) {
        if (document.querySelector(`link[href="${href}"]`)) return;
        
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = href;
        link.media = 'print';
        link.onload = () => { link.media = 'all'; };
        document.head.appendChild(link);
    },
    
    loadJS: function(src) {
        if (document.querySelector(`script[src="${src}"]`)) return;
        
        const script = document.createElement('script');
        script.src = src;
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    }
};

// Initialize based on strategy
document.addEventListener('DOMContentLoaded', function() {
    window.AssetLoader.preloadCritical();
    
    // Delay progressive loading slightly to prioritize critical rendering
    setTimeout(() => {
        window.AssetLoader.loadProgressively();
    }, 100);
});
</script>

{{-- Resource hints for better performance --}}
@if($loadStrategy === 'aggressive')
    {{-- Preconnect to external domains --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    {{-- Prefetch likely next page resources --}}
    @if(request()->is('*'))
        <link rel="prefetch" href="{{ asset('build/assets/app-frontend') }}.js">
        <link rel="prefetch" href="{{ asset('build/assets/vendor-animations') }}.js">
    @endif
@endif

{{-- Service Worker removed to prevent request interference --}}

{{-- Performance monitoring --}}
<script>
// Monitor asset loading performance
window.addEventListener('load', function() {
    if (window.performance && window.performance.getEntriesByType) {
        const resources = window.performance.getEntriesByType('resource');
        const cssResources = resources.filter(r => r.name.includes('.css'));
        const jsResources = resources.filter(r => r.name.includes('.js'));
        
        // Log performance metrics
        console.log(`Loaded ${cssResources.length} CSS files in ${Math.max(...cssResources.map(r => r.responseEnd))}ms`);
        console.log(`Loaded ${jsResources.length} JS files in ${Math.max(...jsResources.map(r => r.responseEnd))}ms`);
        
        // Send metrics to analytics if available
        if (window.gtag) {
            window.gtag('event', 'asset_loading_performance', {
                'css_count': cssResources.length,
                'js_count': jsResources.length,
                'load_strategy': window.AssetLoader.strategy
            });
        }
    }
});
</script>
