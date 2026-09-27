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
      "description": "Bansal Lawyers is a Melbourne law firm helping clients with immigration, family, criminal, commercial, property and civil law matters. Book a consultation today.",
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
      "telephone": "+61422905860",
      "email": "info@bansallawyers.com.au",
      "contactPoint": [{
        "@type": "ContactPoint",
        "telephone": "1300 226 725",
        "contactType": "customer service",
        "areaServed": "AU",
        "availableLanguage": ["English"]
      }],
      "url": "https://www.bansallawyers.com.au/",
      "openingHours": "Mo-Fr 09:30-18:00",
      "openingHoursSpecification": [{
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
        "opens": "09:30",
        "closes": "18:00"
      }],
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
            "name": "Immigration Lawyers",
            "description": "Help with visa applications, refusals, cancellations, ART appeals, and citizenship matters."
          },
          {
            "@type": "Offer",
            "name": "Family Lawyers",
            "description": "Advice for divorce, separation, parenting arrangements, property settlement, and intervention orders."
          },
          {
            "@type": "Offer",
            "name": "Criminal Lawyers",
            "description": "Legal support for criminal charges, traffic offences, bail applications, and court representation."
          },
          {
            "@type": "Offer",
            "name": "Commercial Lawyers",
            "description": "Assistance with business contracts, loan agreements, disputes, and debt recovery."
          },
          {
            "@type": "Offer",
            "name": "Property Lawyers",
            "description": "Legal advice for buying, selling, leases, conveyancing-related support, and property disputes."
          },
          {
            "@type": "Offer",
            "name": "Civil Lawyers",
            "description": "Support for civil disputes, legal notices, debt disputes, and court-related processes."
          }
        ]
      }
    }
    </script>
    @endverbatim
	
	<link rel="shortcut icon" href="{{ asset('images/logo_img/bansal_lawyers_fevicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    {{-- Phase 10: no style_lawyer — Vite frontend.css + theme-ftco --}}
    @vite(['resources/css/frontend.css', 'resources/css/vendor-frontend.css'])
    <link rel="stylesheet" href="{{ asset('css/layout-global.min.css') }}?v=1.0">
    <link rel="stylesheet" href="{{ asset('css/footer-modern.min.css') }}?v=1.0">

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

    <script src="{{ asset('js/footer-animations.min.js') }}?v=1.0" defer></script>

    @stack('scripts')
    @yield('scripts')
</body>

</html>
