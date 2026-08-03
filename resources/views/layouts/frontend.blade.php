<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="v3RcCNNqLVXDQoEWlV1SzP3SHNvhWws-YuzpLxWuk8A" />
    {{-- Page LCP preloads first so they outrank deferred CSS/fonts --}}
    @yield('preload')
    @yield('seoinfo')

    @if(Request::is('/') || Request::is('about') || Request::is('contact'))
        @php
            $schemaLegalService = [
                '@context' => 'https://schema.org',
                '@type' => 'LegalService',
                'name' => 'Bansal Lawyers',
                'image' => 'https://www.bansallawyers.com.au/images/logo/Bansal_Lawyers.png',
                'description' => 'Bansal Lawyers provides the best immigration lawyers in Melbourne, offering expert legal services for visas, appeals, and migration advice.',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Level 8/278 Collins St',
                    'addressLocality' => 'Melbourne',
                    'addressRegion' => 'VIC',
                    'postalCode' => '3000',
                    'addressCountry' => 'AU',
                ],
                'telephone' => '+61 0422905860',
                'email' => 'Info@bansallawyers.com.au',
                'url' => 'https://www.bansallawyers.com.au',
                'openingHours' => 'Mo-Fr 09:00-17:00',
                'priceRange' => '$$$',
                'areaServed' => 'Melbourne',
            ];
        @endphp
        <script type="application/ld+json">{!! json_encode($schemaLegalService, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    @endif

    <link rel="icon" href="{{ asset('images/logo_img/bansal_lawyers_fevicon.png') }}" type="image/png">

    {{-- Critical above-the-fold CSS (keeps FCP fast while main bundle defers) --}}
    <style>
        html{scroll-behavior:smooth}
        body{margin:0;font-family:Poppins,system-ui,-apple-system,sans-serif;color:#333;background:#fff;-webkit-font-smoothing:antialiased}
        img{max-width:100%;height:auto}
        .container{width:100%;max-width:1200px;margin:0 auto;padding:0 20px;box-sizing:border-box}
        [x-cloak]{display:none!important}
        .ftco-animate{opacity:1!important;visibility:visible!important}
        /* Critical floating Call Now (full styles load deferred) */
        .floating-contact-btn{position:fixed;bottom:20px;right:20px;z-index:9999}
        .floating-btn-mobile-call{display:none;align-items:center;gap:8px;background:#1B4D89;color:#fff;text-decoration:none;padding:12px 18px;border-radius:50px;font-weight:600;box-shadow:0 4px 20px rgba(27,77,137,.35)}
        @media (max-width:768px){.floating-btn-main{display:none!important}.floating-btn-mobile-call{display:inline-flex!important}}
        @media (min-width:769px){.floating-btn-mobile-call{display:none!important}}
    </style>

    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}?v=1.3" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ asset('css/fonts.css') }}?v=1.3"></noscript>

    {{-- Large app CSS: non-blocking --}}
    <link rel="stylesheet" href="{{ \Illuminate\Support\Facades\Vite::asset('resources/css/frontend.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('css/layout-global.min.css') }}?v=1.2" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('css/footer-modern.min.css') }}?v=1.2" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="{{ \Illuminate\Support\Facades\Vite::asset('resources/css/frontend.css') }}">
        <link rel="stylesheet" href="{{ asset('css/layout-global.min.css') }}?v=1.2">
        <link rel="stylesheet" href="{{ asset('css/footer-modern.min.css') }}?v=1.2">
    </noscript>

    @yield('head')
</head>

<body>
    @if(app()->environment('production'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KGBFD265" height="0" width="0" style="display:none;visibility:hidden" title="Google Tag Manager"></iframe></noscript>
    <noscript><img height="1" width="1" style="display:none;" src="https://www.facebook.com/tr?id=628232819622737&ev=PageView&noscript=1" alt=""></noscript>
    @endif

    @include('Elements.Frontend.header')

    <main role="main">
        @yield('content')
    </main>

    @include('Elements.Frontend.footer')

    @if(!Request::is('contact'))
    @include('components.floating-contact-button')
    @endif

    @vite(['resources/js/frontend.js'])

    @yield('scripts')

    {{-- Analytics only on real production HTTPS — never during local Lighthouse --}}
    @if(app()->environment('production'))
    <script>
    (function () {
      if (location.protocol !== 'https:') return;
      var loaded = false;
      function loadAnalytics() {
        if (loaded) return;
        loaded = true;
        window.removeEventListener('scroll', loadAnalytics);
        window.removeEventListener('pointerdown', loadAnalytics);
        window.removeEventListener('keydown', loadAnalytics);

        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        window.gtag = gtag;
        var ga = document.createElement('script');
        ga.src = 'https://www.googletagmanager.com/gtag/js?id=G-Y5R6G1TRVV';
        ga.async = true;
        ga.onload = function () {
          gtag('js', new Date());
          gtag('config', 'G-Y5R6G1TRVV', { cookie_domain: 'bansallawyers.com.au', anonymize_ip: true });
        };
        document.head.appendChild(ga);

        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '628232819622737');
        fbq('track', 'PageView');

        var s1 = document.createElement('script');
        s1.src = @json(asset('js/analytics-engagement.min.js') . '?v=1.1');
        s1.defer = true;
        document.body.appendChild(s1);
        var s2 = document.createElement('script');
        s2.src = @json(asset('js/footer-animations.min.js') . '?v=1.1');
        s2.defer = true;
        document.body.appendChild(s2);

        @if(Request::is('migration-law') || Request::is('migration-law/*'))
        (function(h,o,t,j,a,r){
          h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
          h._hjSettings={hjid:6499398,hjsv:6};
          a=o.getElementsByTagName('head')[0];
          r=o.createElement('script');r.async=1;
          r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
          a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        @endif
      }

      window.addEventListener('scroll', loadAnalytics, { passive: true, once: true });
      window.addEventListener('pointerdown', loadAnalytics, { once: true });
      window.addEventListener('keydown', loadAnalytics, { once: true });
      setTimeout(loadAnalytics, 8000);
    })();
    </script>
    @endif
</body>

</html>
