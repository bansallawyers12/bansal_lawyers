<!DOCTYPE html>
<html lang="en">

<head>
    
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y5R6G1TRVV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Y5R6G1TRVV', {
    cookie_domain: 'bansallawyers.com.au'
  });
</script>
<!-- End Google Tag Manager -->

{{-- Google Analytics 4 (commented out - duplicate of gtag block above)
@if(\App\Helpers\Helper::isAnalyticsEnabled())
<script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.id') }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ config("services.google_analytics.id") }}', {
    'send_page_view': true,
    'anonymize_ip': true,
    'cookie_flags': 'SameSite=None;Secure'
  });
</script>
@endif
--}}



    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="google-site-verification" content="v3RcCNNqLVXDQoEWlV1SzP3SHNvhWws-YuzpLxWuk8A" />
    @yield('seoinfo')
  
    <!-- Schema Markup (key landing pages only — reduces HTML bloat on inner pages) -->
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
                    'geo' => [
                        '@type' => 'GeoCoordinates',
                        'latitude' => '-37.8136',
                        'longitude' => '144.9631',
                    ],
                ],
                'telephone' => '+61 0422905860',
                'email' => 'Info@bansallawyers.com.au',
                'url' => 'https://www.bansallawyers.com.au',
                'openingHours' => 'Mo-Fr 09:00-17:00',
                'priceRange' => '$$$',
                'sameAs' => [
                    'https://www.facebook.com/profile.php?id=61562008576642',
                    'https://www.instagram.com/bansallawyers?igsh=N21ubnVkeDhibjVw',
                ],
                'areaServed' => [
                    '@type' => 'AdministrativeArea',
                    'name' => 'Melbourne',
                ],
                'hasOfferCatalog' => [
                    '@type' => 'OfferCatalog',
                    'name' => 'Legal Services',
                    'itemListElement' => [
                        ['@type' => 'Offer', 'name' => 'Immigration Law', 'description' => 'Expert legal services for visas, appeals, and migration advice.'],
                        ['@type' => 'Offer', 'name' => 'Family Law', 'description' => 'Legal support for family-related matters including divorce and custody.'],
                        ['@type' => 'Offer', 'name' => 'Criminal Law', 'description' => 'Defense representation for criminal cases.'],
                        ['@type' => 'Offer', 'name' => 'Commercial Law', 'description' => 'Legal advice and representation for business and commercial matters.'],
                        ['@type' => 'Offer', 'name' => 'Property Law', 'description' => 'Legal services for property transactions and disputes.'],
                    ],
                ],
            ];
        @endphp
        <script type="application/ld+json">{!! json_encode($schemaLegalService, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    @endif
  	<!-- End Schema Markup -->
  
     <!-- Favicons-->
	<link rel="shortcut icon" href="{{ asset('images/logo_img/bansal_lawyers_fevicon.png')}}" type="image/png">
  
    <!-- DNS Prefetch for external domains -->
    <link rel="dns-prefetch" href="https://www.google.com">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://www.facebook.com">
    <link rel="dns-prefetch" href="https://connect.facebook.net">
    
    <!-- Preconnect to other external resources -->
    <link rel="preconnect" href="https://www.google.com">
    <link rel="preconnect" href="https://challenges.cloudflare.com" crossorigin>
    
    <!-- Self-hosted Poppins fonts (fonts.css declares @font-face; no separate preload needed) -->
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    {{-- Theme first, then Vite so grid/utilities/buttons (#1B4D89) win over style_lawyer BS-era rules --}}
    <link rel="stylesheet" href="{{ asset('css/style_lawyer.min.css')}}">
    @vite(['resources/css/frontend.css', 'resources/css/vendor-frontend.css'])

    <link rel="stylesheet" href="{{ asset('css/layout-global.css') }}?v=1.0">
    <link rel="stylesheet" href="{{ asset('css/footer-modern.css') }}?v=1.0">

  <!-- Hotjar Tracking Code for https://www.bansallawyers.com.au/migration-law -->
<script>
    // Only load Hotjar on HTTPS (production) to avoid console warnings
    if (location.protocol === 'https:') {
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:6499398,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    }
</script>

    @yield('head')
    
  
</head>

<body>
  
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KGBFD265"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
  
    <noscript>
      <img height="1" width="1" style="display:none;" src="https://www.facebook.com/tr?id=628232819622737&ev=PageView&noscript=1" alt="Bansal Lawyers FB Pixel" >
    </noscript>
  
    <!--Header-->
    @include('Elements.Frontend.header')

    <!--Content-->
    <main role="main">
        @yield('content')
    </main>

    <!--Footer-->
    @include('Elements.Frontend.footer')

    <!-- Floating Contact Button (hidden on contact page â€” dedicated form is already on-page) -->
    @if(!Request::is('contact'))
    @include('components.floating-contact-button')
    @endif

    <!-- END: Footer Section -->

    <!-- START: Loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg>
    </div>

    {{-- Phase 4: no Bootstrap JS / jQuery / Stellar / Waypoints on marketing pages --}}
    <!-- Cloudflare Turnstile -->
    <link rel="preconnect" href="https://challenges.cloudflare.com" crossorigin>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

    {{-- frontend.js imports vendor-frontend.js — do not also @vite vendor-frontend.js --}}
    @vite(['resources/js/frontend.js', 'public/js/main.js'])

    <script src="{{ asset('js/analytics-engagement.js') }}?v=1.0" defer></script>
    <script src="{{ asset('js/footer-animations.js') }}?v=1.0" defer></script>

    @yield('scripts')

    <!-- Meta Pixel Code — deferred to end of body so it doesn't block HTML parsing -->
    <script>
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
    </script>
    <!-- End Meta Pixel Code -->
</body>

</html>
