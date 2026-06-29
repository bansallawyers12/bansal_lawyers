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
    <link rel="dns-prefetch" href="https://maps.googleapis.com">
    <link rel="dns-prefetch" href="https://www.google.com">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://www.facebook.com">
    <link rel="dns-prefetch" href="https://connect.facebook.net">
    
    <!-- Preconnect to other external resources -->
    <link rel="preconnect" href="https://maps.googleapis.com">
    <link rel="preconnect" href="https://www.google.com">
    <link rel="preconnect" href="https://challenges.cloudflare.com" crossorigin>
    
    <!-- Self-hosted Poppins fonts (fonts.css declares @font-face; no separate preload needed) -->
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    <!-- Vite CSS - Modern optimized CSS bundle -->
    @vite(['resources/css/frontend.css', 'resources/css/vendor-frontend.css'])

    <!-- Bootstrap CSS - Primary framework for frontend -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap_lawyers.min.css') }}">
    
    <!-- Icon fonts - Load synchronously to ensure icons display correctly -->
    <link rel="stylesheet" href="{{ asset('css/flaticon.min.css') }}?v=1.0.0">
    
    <!-- AOS CSS - only on pages that use AOS animations -->
    @if(Request::is('about') || Request::is('contact') || Request::is('contact/*'))
    <link rel="stylesheet" href="{{ asset('css/aos.min.css')}}">
    @endif
    
    <!-- Main custom styles - Keep as normal stylesheet to avoid FOUC -->
    <!-- Note: High unused percentage reported, but needed for layout structure -->
    <link rel="stylesheet" href="{{ asset('css/style_lawyer.min.css')}}">
    
    <!-- Non-critical CSS - only on pages that use these features -->
    @if(Request::is('practiceareas') || Request::is('blog*') || Request::is('cms/*'))
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    @endif
    @if(Request::is('practiceareas') || Request::is('blog*') || Request::is('cms/*') || Request::is('case*'))
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.min.css') }}">
    @endif
  
    {{-- Facebook Pixel moved to end of body to avoid blocking HTML parsing --}}
  
    <link rel="stylesheet" href="{{ asset('css/layout-global.css') }}?v=1.0">
    <link rel="stylesheet" href="{{ asset('css/footer-modern.css') }}?v=1.0">
  
	<!-- Inline scripts - will execute after jQuery loads -->
	<script>
	// Polyfill for rel="preload" as="style" onload pattern
	(function() {
		var preloadLinks = document.querySelectorAll('link[rel="preload"][as="style"]');
		preloadLinks.forEach(function(link) {
			if (link.onload === null || typeof link.onload !== 'function') {
				link.onload = function() {
					this.rel = 'stylesheet';
					this.onload = null;
				};
			}
		});
	})();
	
	// Wait for jQuery to load before executing
	(function() {
		function initWhenJQueryReady() {
			if (typeof jQuery !== 'undefined' && typeof jQuery.fn !== 'undefined') {
				// jQuery is ready, execute all jQuery-dependent code
				jQuery(document).ready(function ($) {
        // Removed updateHeroImage() function - hero section uses CSS background-image
        // No #hero-image element exists in the current implementation
        // If converting to <img> tag in future, this function can be restored
      
        $('.nav-link').click(function () {
          // Check if the clicked tab is "Our Values"
          if ($(this).attr('href') === '#home3') {
            // Set the height of the image (desktop only)
            if (window.innerWidth > 767) {
              $('.img-video').css('height', '823px');
            }
          } else {
            // Reset height for other tabs (desktop only)
            if (window.innerWidth > 767) {
              $('.img-video').css('height', '684px');
            }
          }
        });
        
        // Initialize Testimonials Carousel for homepage with Swiper.js
        function initTestimonialsCarousel() {
            if (document.querySelector('.carousel-testimony') && typeof Swiper !== 'undefined') {
                new Swiper('.carousel-testimony', {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: true,
                    autoplay: {
                        delay: 8000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    speed: 800,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 30,
                        },
                        1024: {
                            slidesPerView: 2,
                            spaceBetween: 30,
                        },
                    },
                });
            } else {
                // Retry after a short delay if Swiper is not loaded yet
                setTimeout(initTestimonialsCarousel, 100);
            }
        }
        
        // Initialize testimonials carousel
        initTestimonialsCarousel();

        // Fix logo visibility on scroll - Ultra-fast instant switching (High Priority)
        var isScrolled = false;
        var logoElement = null;
        var navbar = null;
        
        // Cache logo paths for maximum performance
        var defaultLogoPath = "{{ asset('images/logo/Bansal_Lawyers.png') }}";
        var scrolledLogoPath = "{{ asset('images/logo/Bansal_Lawyers_scroll.png') }}";
        
        // Initialize logo elements with error handling
        function initLogoElements() {
            if (!logoElement) {
                logoElement = $('#image_logo');
            }
            if (!navbar) {
                navbar = $('.ftco_navbar');
            }
        }
        
        // Ultra-optimized scroll handler with immediate switching and error handling
        function updateLogo() {
            try {
                initLogoElements();
                
                if (!logoElement || !navbar) return;
                
                var scrollTop = $(window).scrollTop();
                
                // Immediate logo switching - no conditions, just direct switching
                if (scrollTop > 150) {
                    if (!isScrolled) {
                        isScrolled = true;
                        navbar.addClass('scrolled');
                        logoElement.attr('src', scrolledLogoPath);
                    }
                } else {
                    if (isScrolled) {
                        isScrolled = false;
                        navbar.removeClass('scrolled sleep');
                        logoElement.attr('src', defaultLogoPath);
                    }
                }
            } catch (error) {
                // Error handled silently
            }
        }
        
        // Use immediate scroll handler for fastest response with error handling
        $(window).on('scroll.logo', function() {
            try {
                updateLogo();
            } catch (error) {
                // Error handled silently
            }
        });

        // Add error handling for logo loading
        $('#image_logo').on('error', function() {
            // Fallback to default logo if scrolled logo fails to load
            $(this).attr('src', "{{ asset('images/logo/Bansal_Lawyers.png') }}?timestamp=" + new Date().getTime());
        });

        // Aggressive preloading for instant logo switching
        function preloadLogos() {
            var defaultLogo = new Image();
            var scrolledLogo = new Image();
            
            // Force immediate loading
            defaultLogo.src = "{{ asset('images/logo/Bansal_Lawyers.png') }}?v=" + Date.now();
            scrolledLogo.src = "{{ asset('images/logo/Bansal_Lawyers_scroll.png') }}?v=" + Date.now();
        }

        // Start preloading immediately when script loads
        preloadLogos();

        // Ensure logo is visible on page load and preload images
        document.addEventListener('DOMContentLoaded', function() {
            var logoElement = document.getElementById('image_logo');
            if (!logoElement) return;
            var $logoElement = $(logoElement);
            if ($logoElement.length) {
                // Force logo to be visible with immediate CSS
                $logoElement.css({
                    'display': 'block',
                    'visibility': 'visible',
                    'opacity': '1',
                    'transition': 'none'
                });
                
                // Ensure parent navbar brand is visible
                $logoElement.closest('.navbar-brand').css({
                    'display': 'block',
                    'visibility': 'visible',
                    'opacity': '1',
                    'transition': 'none'
                });
            }
            
            // Handle blog image 404 errors
            $('.block-20').each(function() {
                var $this = $(this);
                var bgImage = $this.css('background-image');
                if (bgImage && bgImage.includes('img/blog/')) {
                    // Test if the image exists
                    var img = new Image();
                    img.onload = function() {
                        // Image exists, do nothing
                    };
                    img.onerror = function() {
                        // Image doesn't exist, use fallback
                        $this.css('background-image', 'url({{ asset("images/Blog.jpg") }})');
                    };
                    // Extract URL from background-image CSS
                    var urlMatch = bgImage.match(/url\(['"]?([^'"]+)['"]?\)/);
                    if (urlMatch) {
                        img.src = urlMatch[1];
                    }
                }
            });
            
            // Global error handler for missing images to suppress 404 console errors
            // This handles cases where images are referenced but don't exist (e.g., cached references)
            window.addEventListener('error', function(e) {
                // Handle image loading errors
                if (e.target && e.target.tagName === 'IMG') {
                    var img = e.target;
                    var src = img.src || img.getAttribute('src');
                    
                    // Check if it's a missing blog image (including images with spaces in filename)
                    if (src && (src.includes('blog/') || src.includes('Top') || src.includes('legal') || src.includes('Service'))) {
                        // Suppress console error for known missing images
                        e.preventDefault();
                        e.stopPropagation();
                        
                        // Try to use fallback image
                        if (!img.hasAttribute('data-fallback-applied')) {
                            img.setAttribute('data-fallback-applied', 'true');
                            img.src = '{{ asset("images/Blog.jpg") }}';
                            img.onerror = null; // Prevent infinite loop
                        }
                        return true; // Prevent default error handling
                    }
                }
            }, true); // Use capture phase to catch errors early
            
            // Also handle unhandled promise rejections for image loading
            window.addEventListener('unhandledrejection', function(e) {
                if (e.reason && e.reason.message && e.reason.message.includes('404')) {
                    var message = e.reason.message;
                    if (message.includes('blog/') || message.includes('Top') || message.includes('legal')) {
                        e.preventDefault();
                        return true;
                    }
                }
            });
        });
			});
		} else {
			// jQuery not loaded yet, retry after short delay
			setTimeout(initWhenJQueryReady, 50);
		}
	}
	// Start checking for jQuery immediately
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initWhenJQueryReady);
	} else {
		initWhenJQueryReady();
	}
	})();
  	</script>
  
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

    <!-- Global Error Handler - Must load FIRST to catch Stellar.js errors -->
    <script>
        // Global error handler to catch Stellar.js particles undefined error
        // This must run IMMEDIATELY before any deferred scripts load
        (function() {
            window.addEventListener('error', function(e) {
                // Catch Stellar.js particles undefined error and prevent it from breaking the page
                if (e.message && (
                    e.message.includes('particles is undefined') ||
                    (e.message.includes("can't access property") && e.message.includes('particles')) ||
                    (e.message.includes('length') && e.message.includes('particles') && e.message.includes('undefined')) ||
                    (e.filename && e.filename.includes('stellar'))
                )) {
                    console.warn('Stellar.js error caught and suppressed:', e.message);
                    e.preventDefault();
                    e.stopPropagation();
                    return true; // Prevent default error handling
                }
            }, true); // Use capture phase to catch errors early
        })();
    </script>
    
    <!-- JavaScript Files - Optimized Loading with Defer for Parallel Loading -->
    <!-- Load jQuery first with defer (non-blocking, executes in order) -->
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}" defer></script>
    
    <!-- Core dependencies - all with defer for parallel loading -->
    <!-- Note: popper.min.js removed - already included in bootstrap.bundle.min.js -->
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}" defer></script>
    <script src="{{ asset('js/jquery.easing.1.3.min.js')}}" defer></script>
    <!-- Conditional plugins - only loaded if needed on specific pages -->
    @if(Request::is('practiceareas') || Request::is('cms/*') || Request::is('archive/*'))
    <script src="{{ asset('js/jquery.waypoints.min.js')}}" defer></script>
    <script src="{{ asset('js/jquery.stellar.min.js')}}" defer></script>
    <script src="{{ asset('js/scrollax.min.js')}}" defer></script>
    @endif
    @if(Request::is('practiceareas') || Request::is('blog*') || Request::is('cms/*') || Request::is('case*'))
    <script src="{{ asset('js/jquery.magnific-popup.min.js')}}" defer></script>
    @endif
    
    <!-- AOS JS - Only load on pages that use AOS animations -->
    @if(Request::is('about') || Request::is('contact') || Request::is('contact/*'))
    <script src="{{ asset('js/aos.min.js')}}" defer></script>
    @endif
    
    <script src="{{ asset('js/jquery.animateNumber.min.js')}}" defer></script>
    
    <!-- Google Maps â€” only load the API when this page actually has a map container -->
    <script>
        (function() {
            if (!document.getElementById('map') && !document.getElementById('google-map')) return;

            window.initMap = function() {
                function waitForJQuery(cb) {
                    if (typeof jQuery !== 'undefined') { cb(); }
                    else { setTimeout(function() { waitForJQuery(cb); }, 50); }
                }
                waitForJQuery(function() {
                    var s = document.createElement('script');
                    s.src = "{{ asset('js/google-map.min.js') }}";
                    s.defer = true;
                    document.head.appendChild(s);
                });
            };
            window.gm_authFailure = function() {};

            var mapScript = document.createElement('script');
            mapScript.async = true;
            mapScript.defer = true;
            mapScript.src = 'https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&loading=async&callback=initMap';
            document.head.appendChild(mapScript);
        })();
    </script>
    
    <!-- Cloudflare Turnstile -->
    <link rel="preconnect" href="https://challenges.cloudflare.com" crossorigin>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    
    <!-- Vendor + app JS bundles (single vite call reduces duplicate modulepreload tags) -->
    @vite(['resources/js/vendor-frontend.js', 'resources/js/frontend.js', 'public/js/main.js'])

    <script src="{{ asset('js/analytics-engagement.js') }}?v=1.0" defer></script>
    <script src="{{ asset('js/footer-animations.js') }}?v=1.0" defer></script>

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
