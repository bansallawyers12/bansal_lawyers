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
   
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
    <meta name="google-site-verification" content="v3RcCNNqLVXDQoEWlV1SzP3SHNvhWws-YuzpLxWuk8A" />
  
     @yield('seoinfo')
  
    <!-- Schema Markup -->
    @verbatim
     <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LegalService",
      "name": "Bansal Lawyers",
      "image": "https://www.bansallawyers.com.au/images/logo/Bansal_Lawyers.png",
      "description": "Bansal Lawyers provides the best immigration lawyers in Melbourne, offering expert legal services for visas, appeals, and migration advice.",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Level 8/278 Collins St",
        "addressLocality": "Melbourne",
        "addressRegion": "VIC",
        "postalCode": "3000",
        "addressCountry": {
          "@type": "Country",
          "name": "Australia"
        }
      },
      "telephone": "+61 0422905860",
      "email": "Info@bansallawyers.com.au",
      "url": "https://www.bansallawyers.com.au/",
      "openingHours": "Mo-Fr 09:00-17:00",
      "priceRange": "$$$",
      "sameAs": [
        "https://www.facebook.com/profile.php?id=61562008576642",
        "https://www.instagram.com/bansallawyers?igsh=N21ubnVkeDhibjVw"
      ],
      "areaServed": {
        "@type": "AdministrativeArea",
        "name": "Melbourne"
      },
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Legal Services",
        "itemListElement": [
          {
            "@type": "Offer",
            "name": "Immigration Law",
            "description": "Expert legal services for visas, appeals, and migration advice."
          },
          {
            "@type": "Offer",
            "name": "Family Law",
            "description": "Legal support for family-related matters including divorce and custody."
          },
          {
            "@type": "Offer",
            "name": "Criminal Law",
            "description": "Defense representation for criminal cases."
          },
          {
            "@type": "Offer",
            "name": "Commercial Law",
            "description": "Legal advice and representation for business and commercial matters."
          },
          {
            "@type": "Offer",
            "name": "Property Law",
            "description": "Legal services for property transactions and disputes."
          }
        ]
      }
    }
    </script>
    @endverbatim
	
	<link rel="shortcut icon" href="{{ asset('images/logo_img/bansal_lawyers_fevicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    {{-- Theme first; Vite grid/utilities win (Phase 7–8) --}}
    <link rel="stylesheet" href="{{ asset('css/style_lawyer.min.css')}}">
    @vite(['resources/css/frontend.css', 'resources/css/vendor-frontend.css'])
    <link rel="stylesheet" href="{{ asset('css/layout-global.css') }}?v=1.0">
    <link rel="stylesheet" href="{{ asset('css/footer-modern.css') }}?v=1.0">

    <style>
      .bg-dark {
          background-color: #1B4D89 !important;
      }
    </style>

    <link rel="preconnect" href="https://challenges.cloudflare.com" crossorigin>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

    @stack('head')
</head>

<body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KGBFD265"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  
    @include('Elements.Frontend.header')

    <main role="main">
        @yield('content')
    </main>

    @include('Elements.Frontend.footer')

    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg>
    </div>

    {{-- Phase 7: no jQuery — booking uses appointment-form Vite module (Alpine + Axios) --}}
    @vite(['public/js/main.js'])

    <script type="text/javascript">
        var site_url = "{{ url('/') }}";
        var redirecturl = "{{ url('/thanks') }}";
    </script>

    <script src="{{ asset('js/footer-animations.js') }}?v=1.0" defer></script>

    @stack('scripts')
    @yield('scripts')
</body>

</html>
