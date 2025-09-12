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
	<link rel="shortcut icon" href="{{ @smartasset('img/logo_img/bansal_lawyers_fevicon.png')}}" type="image/png">


    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ @smartasset('css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ @smartasset('css/animate.min.css')}}">

    <link rel="stylesheet" href="{{ @smartasset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ @smartasset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ @smartasset('css/magnific-popup.min.css')}}">

    <link rel="stylesheet" href="{{ @smartasset('css/aos.min.css')}}">

    <link rel="stylesheet" href="{{ @smartasset('css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{ @smartasset('css/flaticon.min.css')}}">
    <link rel="stylesheet" href="{{ @smartasset('css/icomoon.min.css')}}">
    <link rel="stylesheet" href="{{ @smartasset('css/style_lawyer.min.css')}}">


     <!-- BASE CSS -->
     <link href="{{ @smartasset('css/Frontend/bootstrap.min.css')}}" rel="stylesheet">
     <link href="{{ @smartasset('css/Frontend/owl.carousel.min.css')}}" rel="stylesheet">
     <link href="{{ @smartasset('css/Frontend/animate.min.css')}}" rel="stylesheet">
     <link href="{{ @smartasset('css/Frontend/magnific-popup.min.css')}}" rel="stylesheet">
     <link href="{{ @smartasset('css/Frontend/font-awesome.min.css')}}" rel="stylesheet">
     <link href="{{ @smartasset('css/Frontend/ETmodules.min.css')}}" rel="stylesheet">
     <link href="{{ @smartasset('css/Frontend/bootstrap-datepicker.min.css')}}" rel="stylesheet">
     <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">-->
     <link href="{{ @smartasset('css/Frontend/custom-icon.min.css')}}" rel="stylesheet">
     <link href="{{ @smartasset('css/Frontend/classy-nav.min.css')}}" rel="stylesheet">
     <link href="{{ @smartasset('css/Frontend/style.min.css')}}" rel="stylesheet">
     <link href="{{ @smartasset('css/Frontend/custom.min.css')}}" rel="stylesheet">
     <link href="{{ @smartasset('css/Frontend/responsive.min.css')}}" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ @smartasset('css/bootstrap_lawyers.min.css')}}">
    <!-- Bootstrap JS and jQuery -->
    <script src="{{ @smartasset('js/jquery_lawyers-3.6.0.min.js')}}"></script>
    <script src="{{ @smartasset('js/bootstrap_lawyers.bundle.min.js')}}"></script>

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

    <!-- JavaScript Files -->
    <script src="{{ @smartasset('js/jquery.min.js')}}"></script>
    <script src="{{ @smartasset('js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{ @smartasset('js/popper.min.js')}}"></script>
    <script src="{{ @smartasset('js/bootstrap.min.js')}}"></script>
    <script src="{{ @smartasset('js/jquery.easing.1.3.min.js')}}"></script>
    <script src="{{ @smartasset('js/jquery.waypoints.min.js')}}"></script>
    <script src="{{ @smartasset('js/jquery.stellar.min.js')}}"></script>
    <script src="{{ @smartasset('js/owl.carousel.min.js')}}"></script>
    <script src="{{ @smartasset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ @smartasset('js/aos.min.js')}}"></script>
    <script src="{{ @smartasset('js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{ @smartasset('js/scrollax.min.js')}}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&callback=initMap"></script>
    <script>
      function initMap(){
        if(!document.getElementById('map')) return;
        var s=document.createElement('script');
        s.src='{{ @smartasset('js/google-map.min.js')}}';
        document.head.appendChild(s);
      }
    </script>
    <script src="{{ @smartasset('js/main.min.js')}}"></script>


    <!-- COMMON SCRIPTS -->
		<script type="text/javascript">
			var site_url = "<?php echo URL::to('/'); ?>";
			var redirecturl = "<?php echo URL::to('/thanks'); ?>";
		</script>

		<script src="{{ @smartasset('js/Frontend/jquery-2.2.4.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/popper.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/bootstrap.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/plugins.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/active.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/jquery.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/jquery-migrate.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/bootstrap.bundle.min.js')}}"></script>
		<script src="{{ @smartasset('js/moment.min.js')}}"></script>

		<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>-->
  		<script src="{{ @smartasset('js/Frontend/bootstrap-datepicker.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/easing.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/hoverIntent.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/superfish.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/wow.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/owl.carousel.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/magnific-popup.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/sticky.min.js')}}"></script>
		<script src="{{ @smartasset('js/Frontend/main.min.js')}}"></script>

		<script src="{{ @smartasset('js/Frontend/font_awesome5.min.js')}}"></script>

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








