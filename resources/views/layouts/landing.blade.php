<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17598989873"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'AW-17598989873', {
        cookie_domain: 'bansallawyers.com.au'
      });
    </script>
    <!-- End Google Tag Manager -->

    <!-- Google Analytics 4 -->
    @if(\App\Helpers\Helper::isAnalyticsEnabled())
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.id') }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ config("services.google_analytics.id") }}', {
        'send_page_view': true,
        'anonymize_ip': true,
        'cookie_domain': 'bansallawyers.com.au',
        'cookie_flags': 'SameSite=None;Secure'
      });
    </script>
    @endif

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="v3RcCNNqLVXDQoEWlV1SzP3SHNvhWws-YuzpLxWuk8A" />
    
    @yield('seoinfo')

    @yield('schema')
  
    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('images/logo_img/bansal_lawyers_fevicon.png')}}" type="image/png">
  
    <!-- DNS Prefetch for external domains -->
    <link rel="dns-prefetch" href="https://www.google.com">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    
    <!-- Self-hosted Poppins fonts -->
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    
    <!-- Vite CSS — Phase 8: no Bootstrap / no style_lawyer (landing is self-contained) -->
    @vite(['resources/css/frontend.css', 'resources/css/vendor-frontend.css'])
    
    <!-- Lucide icons loaded via Vite (vendor-frontend via frontend.js) -->
    
    <!-- Meta Pixel Code -->
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
  
    <!--Content Only - No Header/Footer-->
    <main role="main" style="padding: 0; margin: 0;">
        @yield('content')
    </main>

    {{-- Phase 4: landing — no Bootstrap JS / jQuery / Bootstrap CSS --}}
    @vite(['resources/js/frontend.js', 'public/js/main.js'])
    
    @yield('scripts')
</body>

</html>
