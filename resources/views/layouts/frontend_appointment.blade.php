<!DOCTYPE html>
<html lang="en">

<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16921908782">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-16921908782');
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


    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <!-- Tailwind CSS - Consolidated styling -->
    @vite(['resources/css/app.css'])
    
    <!-- Essential custom CSS only -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/aos.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style_lawyer.min.css')}}">
    <!-- Essential JavaScript only -->
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('js/jquery-migrate-3.4.1.min.js')}}"></script>

    <style>
      .bg-dark {
          background-color: #1B4D89 !important;
      }

    </style>
	
</head>

<body>
  
  	<!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KGBFD265"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
  
    <!--Header-->
    @include('../Elements/Frontend/header')

    <!--Content-->
    @yield('content')

    <!--Footer-->
    @include('../Elements/Frontend/footer')

    <!-- END: Footer Section -->

    <!-- START: Loader -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg>
    </div>

    <!-- JavaScript Files - Consolidated jQuery 3.7.1 -->
    <!-- jQuery and jQuery Migrate already loaded above -->
    
    <!-- Core Dependencies -->
    <script src="{{ asset('js/moment.min.js')}}"></script>
    
    <!-- jQuery Plugins -->
    <script src="{{ asset('js/jquery.easing.1.3.min.js')}}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js')}}"></script>
    <script src="{{ asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{ asset('js/scrollax.min.js')}}"></script>
    
    <!-- Essential Libraries Only -->
    <script src="{{ asset('js/aos.min.js')}}"></script>
    <script src="{{ asset('js/Frontend/easing.min.js')}}"></script>
    <script src="{{ asset('js/Frontend/hoverIntent.min.js')}}"></script>
    <script src="{{ asset('js/Frontend/superfish.min.js')}}"></script>
    <script src="{{ asset('js/Frontend/wow.min.js')}}"></script>
    <script src="{{ asset('js/Frontend/sticky.min.js')}}"></script>
    
    <!-- Google Maps - Removed for appointment page -->
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&callback=initMap"></script> -->
    <script>
      function initMap(){
        if(!document.getElementById('map')) return;
        var s=document.createElement('script');
        s.src='{{ asset('js/google-map.min.js')}}';
        document.head.appendChild(s);
      }
    </script>
    
    <!-- Main Application Script -->
    <script src="{{ asset('js/main.min.js')}}"></script>

    <!-- Global Error Handler -->
    <script>
        // Global error handler to prevent getBoundingClientRect errors
        window.addEventListener('error', function(e) {
            if (e.message && e.message.includes('getBoundingClientRect')) {
                console.warn('DOM element access error prevented:', e.message);
                e.preventDefault();
                return true;
            }
        });
        
        // Additional protection for jQuery operations
        $(document).ready(function() {
            // Override jQuery methods that might cause getBoundingClientRect errors
            var originalOffset = $.fn.offset;
            $.fn.offset = function() {
                if (this.length === 0) {
                    console.warn('jQuery offset called on empty selection');
                    return { top: 0, left: 0 };
                }
                return originalOffset.apply(this, arguments);
            };
            
            // Override jQuery position method
            var originalPosition = $.fn.position;
            $.fn.position = function() {
                if (this.length === 0) {
                    console.warn('jQuery position called on empty selection');
                    return { top: 0, left: 0 };
                }
                return originalPosition.apply(this, arguments);
            };
            
            // Override jQuery width/height methods
            var originalWidth = $.fn.width;
            $.fn.width = function() {
                if (this.length === 0) {
                    console.warn('jQuery width called on empty selection');
                    return 0;
                }
                return originalWidth.apply(this, arguments);
            };
            
            var originalHeight = $.fn.height;
            $.fn.height = function() {
                if (this.length === 0) {
                    console.warn('jQuery height called on empty selection');
                    return 0;
                }
                return originalHeight.apply(this, arguments);
            };
        });
    </script>

    <!-- COMMON SCRIPTS -->
		<script type="text/javascript">
			var site_url = "<?php echo URL::to('/'); ?>";
			var redirecturl = "<?php echo URL::to('/thanks'); ?>";
		</script>

		<script>
		jQuery(document).ready(function($){
			$('.refresh').on('click', function(){
				$.ajax({
					url: '<?php echo URL::to('/'); ?>/refresh-captcha',
					type: 'GET',
					success: function(html){
						$('.code_verify .image').html(html);
					}
				});
			});
		});
		</script>
		@yield('scripts')
</body>

</html>








