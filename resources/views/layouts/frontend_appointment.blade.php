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
    <!-- End Schema Markup -->
	
	<!-- Favicons-->
	<link rel="shortcut icon" href="{{ asset('images/logo_img/bansal_lawyers_fevicon.png')}}" type="image/png">

    <!-- Self-hosted Poppins fonts -->
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    <!-- Vite CSS - Modern optimized CSS bundle -->
    @vite(['resources/css/frontend.css', 'resources/css/vendor-frontend.css'])

    <!-- Bootstrap CSS - Primary framework for frontend -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap_lawyers.min.css') }}">
    
    <!-- Main custom styles - Keep as normal stylesheet to avoid FOUC -->
    <link rel="stylesheet" href="{{ asset('css/style_lawyer.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/layout-global.css') }}?v=1.0">
    <link rel="stylesheet" href="{{ asset('css/footer-modern.css') }}?v=1.0">

    <style>
      .bg-dark {
          background-color: #1B4D89 !important;
      }

    </style>

    <!-- Cloudflare Turnstile -->
    <link rel="preconnect" href="https://challenges.cloudflare.com" crossorigin>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
	
</head>

<body>
  
  	<!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KGBFD265"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
  
    <!--Header-->
    @include('Elements.Frontend.header')

    <!--Content-->
    <main role="main">
        @yield('content')
    </main>

    <!--Footer-->
    @include('Elements.Frontend.footer')

    <!-- END: Footer Section -->

    <!-- START: Loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg>
    </div>

    {{-- jQuery sync (not defer): booking @yield('scripts') is large and historically assumed $ is present before DOMContentLoaded registration edge-cases; Vite modules stay deferred --}}
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.min.js')}}"></script>
    {{-- No stellar/waypoints/scrollax/animateNumber on booking — unused --}}

    {{-- frontend.js imports vendor-frontend.js — do not also @vite vendor-frontend.js --}}
    @vite(['resources/js/frontend.js', 'public/js/main.js'])

    <!-- COMMON SCRIPTS -->
		<script type="text/javascript">
			var site_url = "<?php echo URL::to('/'); ?>";
			var redirecturl = "<?php echo URL::to('/thanks'); ?>";
		</script>

		@yield('scripts')

    <script src="{{ asset('js/footer-animations.js') }}?v=1.0" defer></script>
</body>

</html>
