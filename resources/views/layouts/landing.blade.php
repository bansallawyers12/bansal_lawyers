<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17598989873"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'AW-17598989873');
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
        'cookie_flags': 'SameSite=None;Secure'
      });
    </script>
    @endif

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="v3RcCNNqLVXDQoEWlV1SzP3SHNvhWws-YuzpLxWuk8A" />
    
    @yield('seoinfo')
  
    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('images/logo_img/bansal_lawyers_fevicon.png')}}" type="image/png">
  
    <!-- DNS Prefetch for external domains -->
    <link rel="dns-prefetch" href="https://maps.googleapis.com">
    <link rel="dns-prefetch" href="https://www.google.com">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    
    <!-- Self-hosted Poppins fonts -->
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    
    <!-- Vite CSS -->
    @vite(['resources/css/frontend.css'])
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap_lawyers.min.css') }}">
    
    <!-- Icon fonts - Font Awesome loaded via Vite in vendor-frontend.css -->
    <link rel="stylesheet" href="{{ asset('css/flaticon.min.css') }}?v={{ time() }}">
    
    <!-- Magnific Popup CSS for lightbox functionality -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.min.css') }}">
    
    <!-- Vendor bundles -->
    @vite(['resources/css/vendor-frontend.css'])
    
    <!-- Main custom styles -->
    <link rel="stylesheet" href="{{ asset('css/style_lawyer.min.css')}}">
    
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

    <!-- JavaScript Files -->
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}" defer></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}" defer></script>
    <script src="{{ asset('js/jquery.easing.1.3.min.js')}}" defer></script>
    
    <!-- Vendor bundles -->
    @vite(['resources/js/vendor-frontend.js'])
    
    <!-- Magnific Popup for lightbox functionality -->
    <script src="{{ asset('js/jquery.magnific-popup.min.js')}}" defer></script>
    
    <!-- Vite JS -->
    @vite(['resources/js/frontend.js'])
    
    <!-- Main script -->
    <script src="{{ asset('js/main.js') }}?v={{ time() }}" defer></script>
    
    @yield('scripts')
</body>

</html>
