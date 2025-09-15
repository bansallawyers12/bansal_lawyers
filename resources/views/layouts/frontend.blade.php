<!DOCTYPE html>
<html lang="en">

<head>
    
  
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KGBFD265');</script>
<!-- End Google Tag Manager -->

<!-- Enhanced Analytics & Tracking -->
<script>
// Blog engagement tracking
function trackBlogEngagement() {
    // Track scroll depth
    let maxScroll = 0;
    window.addEventListener('scroll', function() {
        const scrollPercent = Math.round((window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100);
        if (scrollPercent > maxScroll) {
            maxScroll = scrollPercent;
            if (maxScroll % 25 === 0) { // Track at 25%, 50%, 75%, 100%
                gtag('event', 'scroll_depth', {
                    'event_category': 'Blog Engagement',
                    'event_label': maxScroll + '%',
                    'value': maxScroll
                });
            }
        }
    });

    // Track reading time
    let startTime = Date.now();
    let readingTime = 0;
    let isReading = true;
    
    window.addEventListener('beforeunload', function() {
        readingTime = Math.round((Date.now() - startTime) / 1000);
        if (readingTime > 10) { // Only track if user spent more than 10 seconds
            gtag('event', 'reading_time', {
                'event_category': 'Blog Engagement',
                'event_label': 'Time on Page',
                'value': readingTime
            });
        }
    });

    // Track social shares
    document.addEventListener('click', function(e) {
        if (e.target.matches('.experimental-share-btn, .share-btn')) {
            const platform = e.target.classList.contains('facebook') ? 'Facebook' : 
                           e.target.classList.contains('twitter') ? 'Twitter' : 
                           e.target.classList.contains('linkedin') ? 'LinkedIn' : 'Unknown';
            
            gtag('event', 'social_share', {
                'event_category': 'Social Media',
                'event_label': platform,
                'value': 1
            });
        }
    });

    // Track internal link clicks
    document.addEventListener('click', function(e) {
        if (e.target.matches('a[href*="bansallawyers.com.au"]')) {
            gtag('event', 'internal_link_click', {
                'event_category': 'Navigation',
                'event_label': e.target.href,
                'value': 1
            });
        }
    });
}

// Initialize tracking when DOM is ready
document.addEventListener('DOMContentLoaded', trackBlogEngagement);

// FAQ Toggle Function
function toggleFAQ(index) {
    const answer = document.getElementById('faq-answer-' + index);
    const icon = document.getElementById('faq-icon-' + index);
    
    if (answer.style.maxHeight === '0px' || answer.style.maxHeight === '') {
        // Open FAQ
        answer.style.maxHeight = answer.scrollHeight + 'px';
        answer.style.padding = '0 20px';
        icon.textContent = '−';
        icon.style.transform = 'rotate(180deg)';
    } else {
        // Close FAQ
        answer.style.maxHeight = '0px';
        answer.style.padding = '0 20px';
        icon.textContent = '+';
        icon.style.transform = 'rotate(0deg)';
    }
}
</script>


    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="google-site-verification" content="v3RcCNNqLVXDQoEWlV1SzP3SHNvhWws-YuzpLxWuk8A" />
    @yield('seoinfo')
  
    <!-- Schema Markup -->
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
                    'addressCountry' => [
                        '@type' => 'Country',
                        'name' => 'Australia',
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
  	<!-- End Schema Markup -->
  
     <!-- Favicons-->
	<link rel="shortcut icon" href="{{ asset('images/logo_img/bansal_lawyers_fevicon.png')}}" type="image/png">
  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" media="print" onload="this.media='all'">

    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css/aos.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css/flaticon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style_lawyer.min.css')}}">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap_lawyers.min.css')}}" media="print" onload="this.media='all'">


    <!-- Bootstrap JS and jQuery - Consolidated -->
    <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('js/jquery-migrate-3.4.1.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap_lawyers.bundle.min.js')}}"></script>
  
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
  
    <style>
      /* Global mobile fixes */
      * {
        box-sizing: border-box;
      }
      
      body {
        overflow-x: hidden;
        max-width: 100vw;
      }
      
      .container, .container-fluid {
        max-width: 100%;
        overflow-x: hidden;
      }
      
      /*slider Css*/
    .hero-wrap {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }
    
    /* Ensure hero section content stays within bounds */
    .hero-wrap .container {
        max-width: 100% !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    
    .hero-wrap .row {
        margin-left: 0 !important;
        margin-right: 0 !important;
        max-width: 100% !important;
    }
    
    /* Desktop text containment within blue area */
    @media (min-width: 992px) {
        .bansal_left_text {
            max-width: 45% !important;
            width: 45% !important;
            padding-right: 20px !important;
            padding-left: 20px !important;
            box-sizing: border-box !important;
            overflow: hidden !important;
            position: relative !important;
            flex: 0 0 45% !important;
        }
        
        .bansal_left_text h6,
        .bansal_left_text h3,
        .bansal_left_text h1,
        .bansal_left_text p {
            max-width: 100% !important;
            width: 100% !important;
            box-sizing: border-box !important;
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
        }
        
        /* Ensure text doesn't extend beyond container */
        .slider-text .row {
            max-width: 100% !important;
        }
        
        .slider-text .container {
            max-width: 100% !important;
        }
        
        /* Create visual boundary for blue area */
        .slider-text::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 45%;
            height: 100%;
            background: rgba(27, 77, 137, 0.8);
            z-index: -1;
        }
    }
    
    /* Tablet adjustments */
    @media (min-width: 768px) and (max-width: 991px) {
        .bansal_left_text {
            max-width: 70% !important;
            width: 70% !important;
            padding-right: 20px !important;
        }
    }

    .hero-image {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1; /* Send the image behind the overlay and content */
    }

    /*.bg-dark {
        background-color: #1B4D89 !important;
    }  */

       /*Contactus form Css*/
       .alert-success {
            color: #155724;
            background-color: grey;
            border-color: grey;

            /*color: #FFF;
            background-color: #1B4D89;
            border-color: #1B4D89;*/
        }

      @media (max-width: 767.98px) {
        .ftco-section {
          background-size: cover;
          background-position: -50px center !important;
        }
      }
           
     /*Footer Css*/
    .fraction {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
    }
    .fraction .numerator {
        font-size: smaller;
    }
    .fraction .denominator {
        font-size: smaller;
        /*border-top: 1px solid;*/
        line-height: 0.8;
    }
      
      
      
    /*carousel Css center tile heightlight Code Start*/
    .carousel-case .owl-item {
        transition: transform 0.5s ease-in-out;
        filter: brightness(80%);
    }

    .carousel-case .owl-item.center {
        transform: scale(1.2);  /* Scale up the center item */
        filter: brightness(100%);
    }
    /*carousel Css center tile heightlight Code End*/
    
    /* Testimonials Section CSS */
    .testimony-section {
        padding: 60px 0;
        background-color: #f8f9fa;
    }
    
    .testimony-section .heading-section {
        margin-bottom: 50px;
    }
    
    .testimony-section .subheading {
        color: #1B4D89;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .testimony-section h2 {
        color: #333;
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .testimony-section p {
        color: #666;
        font-size: 16px;
        line-height: 1.6;
    }
    
    /* Testimonial Cards */
    .testimony-wrap {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        margin: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .testimony-wrap:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    .testimony-wrap .text {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .testimony-wrap .text p {
        color: #333;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
        flex: 1;
    }
    
    .testimony-wrap .d-flex {
        margin-top: auto;
    }
    
    .user-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #1B4D89;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
    }
    
    .testimony-wrap .name {
        color: #333;
        font-weight: 600;
        font-size: 16px;
        margin: 0;
    }
    
    /* Owl Carousel Customization */
    .carousel-testimony .owl-stage-outer {
        overflow: hidden;
        padding: 20px 0;
    }
    
    .carousel-testimony .owl-stage {
        display: flex;
        align-items: stretch;
    }
    
    .carousel-testimony .owl-item {
        display: flex;
        align-items: stretch;
        float: left;
    }
    
    .carousel-testimony .item {
        width: 100%;
        height: 100%;
    }
    
    /* Ensure proper carousel behavior */
    .carousel-testimony {
        position: relative;
    }
    
    .carousel-testimony .owl-dots {
        text-align: center;
        margin-top: 30px;
    }
    
    .carousel-testimony .owl-dot {
        display: inline-block;
        margin: 0 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ddd;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    
    .carousel-testimony .owl-dot.active {
        background: #1B4D89;
    }
      
     .img-video {
        border: 5px solid #1b4d89; /* Change color as needed */
        border-radius: 10px; /* Optional: Adds rounded corners */
        height: 684px;
        margin-top: 23px;
     }
     
     /* Mobile-specific img-video height override */
     @media (max-width: 767.98px) {
       .img-video {
         height: 250px !important;
         margin-top: 10px !important;
         margin-bottom: 20px !important;
       }
       
       /* Ensure proper spacing between about section and contact section */
       .ftco-section.ftco-no-pt.ftco-no-pb {
         padding-bottom: 2em !important;
       }
       
        /* Center and make bg_2.jpg image cover the entire box for mobile */
        .ftco-consultation .col-md-6 img {
          display: block;
          margin: 0 auto;
          width: 100%;
          max-width: 100%;
          height: 350px;
          object-fit: cover;
          object-position: center center;
          border-radius: 10px;
          box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
          position: relative;
          left: 50%;
          transform: translateX(-50%);
        }
        
        /* Center the image container and make it occupy more space on mobile */
        .ftco-consultation .row .col-md-6:first-child {
          text-align: center;
          margin-bottom: 30px;
          padding: 15px;
          display: flex;
          justify-content: center;
          align-items: center;
          width: 100%;
          max-width: 100%;
          position: relative;
          overflow: hidden;
        }
        
        /* Make the contact section row stack vertically on mobile */
        .ftco-consultation .row {
          flex-direction: column;
        }
        
        /* Ensure both columns take full width on mobile */
        .ftco-consultation .col-md-6 {
          width: 100%;
          max-width: 100%;
        }
     }
      
      
     /*Contactus page redesign Code Start*/
     .ftco-consultation .overlay{
        background: none !important;
    }
    .heading-section.heading-section-white h2 {
        color: #1B4D89 !important;
    }
    .consultation .form-control {
        border-radius: 10px;
        color: #FFF !important;
        background-color: #1B4D89 !important;
    }
    /*Contactus page redesign Code End*/
      
     /* Building Trust, Delivering Results Tiles start */
    .text h3 a {
        font-weight: 700;
        color: #000;
    }

    .text h3 a:hover {
        color: #000;
    }

    .text span {
        color: #000;
    }
    /* Building Trust, Delivering Results Tiles end */
      
      
      
     .hero-image {
       height: auto !important;
     }

      .hero-wrap {
        height: 580px !important;
        max-height: 580px !important;
      }
      
      
     /* Desktop View (1024px and above) - Testimonials */
     @media (min-width: 1024px) {
          .testimony-section {
            padding: 80px 0;
          }
          
          .testimony-section h2 {
            font-size: 42px;
          }
          
          .testimony-wrap {
            margin: 15px;
          }
          
          .carousel-testimony .owl-stage-outer {
            padding: 30px 0;
          }
          
          /* Show 3 testimonials per row on desktop */
          .carousel-testimony .owl-item {
            width: 33.333% !important;
          }
          
          .carousel-testimony .owl-stage-outer {
            overflow: hidden;
          }
     }
     
     /* Tablet View (768px to 1023px) - Testimonials */
     @media (min-width: 768px) and (max-width: 1023px) {
          .testimony-section {
            padding: 60px 0;
          }
          
          .testimony-section h2 {
            font-size: 32px;
          }
          
          .testimony-wrap {
            margin: 10px;
          }
          
          .carousel-testimony .owl-stage-outer {
            padding: 20px 0;
          }
          
          /* Show 2 testimonials per row on tablet */
          .carousel-testimony .owl-item {
            width: 50% !important;
          }
          
          .carousel-testimony .owl-stage-outer {
            overflow: hidden;
          }
          
          .testimony-wrap .text p {
            font-size: 14px;
          }
     }
     
     /* Mobile View (767px and below) - Testimonials */
     @media (max-width: 767px) {
          .testimony-section {
            padding: 40px 0;
          }
          
          .testimony-section h2 {
            font-size: 28px;
          }
          
          .testimony-section p {
            font-size: 14px;
          }
          
          .testimony-wrap {
            margin: 5px;
            padding: 20px 15px !important;
          }
          
          .testimony-wrap .text p {
            font-size: 14px;
            line-height: 1.5;
          }
          
          .carousel-testimony .owl-stage-outer {
            padding: 10px 0;
            overflow: hidden;
          }
          
          /* Show 1 testimonial per row on mobile */
          .carousel-testimony .owl-item {
            width: 100% !important;
          }
          
          .carousel-testimony .owl-stage-outer {
            overflow: hidden;
          }
          
          .user-circle {
            width: 40px;
            height: 40px;
            font-size: 16px;
          }
          
          .testimony-wrap .name {
            font-size: 14px;
          }
          
          /* Prevent horizontal overflow */
          .testimony-section .container {
            max-width: 100% !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
          }
          
          .testimony-section .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
          }
          
          .testimony-section .col-md-12 {
            padding-left: 0 !important;
            padding-right: 0 !important;
          }
     }
     
     /* Small Mobile View (480px and below) - Testimonials */
     @media (max-width: 480px) {
          .testimony-section {
            padding: 30px 0;
          }
          
          .testimony-section h2 {
            font-size: 24px;
          }
          
          .testimony-section .subheading {
            font-size: 14px;
          }
          
          .testimony-wrap {
            margin: 5px;
            padding: 15px 10px !important;
          }
          
          .testimony-wrap .text p {
            font-size: 13px;
            line-height: 1.4;
          }
          
          .user-circle {
            width: 35px;
            height: 35px;
            font-size: 14px;
          }
          
          .testimony-wrap .name {
            font-size: 13px;
          }
     }
     
     /* General responsive fixes for hero section */
     @media (max-width: 768px) {
          .hero-wrap {
              height: 580px !important;
              max-height: 580px !important;
          }
        
          .bansal_left_text {
            max-width:100% !important;
            width: 100% !important;
            padding: 0 15px !important;
          }
          .bansal_txt {
             width:100% !important;
             max-width: 100% !important;
          }
        
          .hero-image {
            height: 100% !important;
          }
          
          /* Fix horizontal overflow issues */
          .container {
            max-width: 100% !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
          }
          
          .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
          }
          
          .col-lg-6, .col-md-8, .col-sm-12 {
            padding-left: 0 !important;
            padding-right: 0 !important;
          }
          
          /* Ensure text doesn't overflow */
          h1, h3, p {
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
            max-width: 100% !important;
          }
          
          /* Fix button responsiveness */
          .btn {
            width: 100% !important;
            max-width: 100% !important;
            margin-bottom: 10px !important;
          }
       }
      
      
       @media (max-width: 1250px) {
          .hero-wrap {
              height: 680px !important;
              max-height: 680px !important;
          }
     }
     
     /* iPhone and small mobile devices */
     @media (max-width: 480px) {
          .hero-wrap {
              height: 500px !important;
              max-height: 500px !important;
          }
          
          .bansal_left_text h6 {
            font-size: 20px !important;
          }
          
          .bansal_left_text h3 {
            font-size: 24px !important;
          }
          
          .bansal_left_text h1 {
            font-size: 28px !important;
          }
          
          .bansal_txt {
            font-size: 11px !important;
          }
          
          /* Prevent horizontal scrolling */
          body {
            overflow-x: hidden !important;
          }
          
          .container-fluid {
            padding-left: 10px !important;
            padding-right: 10px !important;
          }
     }
     
     /* Extra small devices */
     @media (max-width: 360px) {
          .bansal_left_text h6 {
            font-size: 18px !important;
          }
          
          .bansal_left_text h3 {
            font-size: 20px !important;
          }
          
          .bansal_left_text h1 {
            font-size: 24px !important;
          }
          
          .bansal_txt {
            font-size: 10px !important;
          }
     }
     
     /* Mobile navigation fixes */
     @media (max-width: 768px) {
          .navbar-brand img {
            max-width: 150px !important;
            height: auto !important;
          }
          
          .navbar-toggler {
            border: none !important;
            padding: 4px 8px !important;
          }
          
          .navbar-collapse {
            background-color: rgba(0, 0, 0, 0.9) !important;
            margin-top: 10px !important;
            padding: 15px !important;
            border-radius: 5px !important;
          }
          
          .nav-link {
            padding: 10px 0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
          }
          
          .nav-link:last-child {
            border-bottom: none !important;
          }
     }

     /* Fix logo visibility on scroll - Instant switching CSS */
     .ftco-navbar-light.scrolled {
       margin-top: 0 !important; /* Remove negative margin that hides logo */
       padding-top: 10px !important; /* Add padding to ensure logo is visible */
       padding-bottom: 10px !important;
       transition: none !important; /* No transitions for instant switching */
     }

     /* Fix navbar overlap issue */
     body {
       padding-top: 0;
     }

     .ftco-navbar-light.scrolled {
       margin-top: 0 !important;
     }

     /* Add proper spacing for content when navbar is fixed */
     .ftco-navbar-light.scrolled ~ * {
       margin-top: 80px;
     }

     /* Specific fix for blog pages */
     .ftco-navbar-light.scrolled + .experimental-breadcrumb,
     .ftco-navbar-light.scrolled + .experimental-blog-detail-hero,
     .ftco-navbar-light.scrolled + .hero-wrap,
     .ftco-navbar-light.scrolled + .ftco-section {
       margin-top: 80px;
     }

     /* Ensure logo is always visible and properly sized */
     .ftco-navbar-light.scrolled .navbar-brand {
       display: block !important;
       visibility: visible !important;
       opacity: 1 !important;
       transition: none !important; /* No transitions for instant switching */
     }

     .ftco-navbar-light.scrolled .navbar-brand img {
       height: 40px !important; /* Slightly smaller for scrolled state */
       max-width: 100% !important;
       object-fit: contain !important;
       width: auto !important;
       display: block !important;
       visibility: visible !important;
       opacity: 1 !important;
       transition: none !important; /* No transitions for instant switching */
     }

     /* Remove all transitions for instant logo switching */
     .navbar-brand img {
       transition: none !important; /* No transitions for instant switching */
     }

     /* Mobile specific fixes for scrolled navbar */
     @media (max-width: 768px) {
       .ftco-navbar-light.scrolled {
         padding-top: 5px !important;
         padding-bottom: 5px !important;
       }
       
       .ftco-navbar-light.scrolled .navbar-brand img {
         height: 35px !important; /* Smaller for mobile */
         max-width: 120px !important;
       }
     }

     /* Tablet specific fixes */
     @media (min-width: 769px) and (max-width: 1024px) {
       .ftco-navbar-light.scrolled .navbar-brand img {
         height: 42px !important;
         max-width: 140px !important;
       }
     }

     /* Desktop specific fixes */
     @media (min-width: 1025px) {
       .ftco-navbar-light.scrolled .navbar-brand img {
         height: 45px !important;
         max-width: 160px !important;
       }
     }
      
      
   
      
     
     
     
	</style>
  
	<!-- jQuery and jQuery Migrate already loaded above -->
	<script>
	$(document).ready(function () {
        function updateHeroImage() {
            var windowWidth = $(window).width();
          	var windowHeight = $(window).height();
            var imageElement = $("#hero-image");    

            if (windowWidth < 768) {
                // Mobile Image
                //imageElement.attr("src", "{{ asset('images/coart_1-mobile.jpg') }}");
                imageElement.attr("src", "{{ asset('images/coart_1.jpg') }}");
            } else if (windowWidth >= 768 && windowWidth < 1024) {
                // Tablet Image
                //imageElement.attr("src", "{{ asset('images/coart_1-tablet.jpg') }}");
                imageElement.attr("src", "{{ asset('images/coart_1.jpg') }}");
            } else {
                // Desktop Image
                imageElement.attr("src", "{{ asset('images/coart_1.jpg') }}");
            }
        }

        // Run on page load
        updateHeroImage();

        // Update image on window resize
        $(window).resize(function () {
            updateHeroImage();
        });
      
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
        
        // Initialize Testimonials Carousel with error handling
        function initTestimonialsCarousel() {
            if ($('.carousel-testimony').length && typeof $.fn.owlCarousel !== 'undefined') {
                $('.carousel-testimony').owlCarousel({
                    loop: true,
                    margin: 20,
                    nav: false,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    center: false,
                    stagePadding: 0,
                    responsive: {
                        0: {
                            items: 1,
                            margin: 10,
                            stagePadding: 10
                        },
                        768: {
                            items: 2,
                            margin: 15,
                            stagePadding: 15
                        },
                        1024: {
                            items: 3,
                            margin: 20,
                            stagePadding: 20
                        }
                    }
                });
            } else {
                // Retry after a short delay if Owl Carousel is not loaded yet
                setTimeout(initTestimonialsCarousel, 100);
            }
        }
        
        // Initialize carousel
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
        $(document).ready(function() {
            var logoElement = $('#image_logo');
            if (logoElement.length) {
                // Force logo to be visible with immediate CSS
                logoElement.css({
                    'display': 'block',
                    'visibility': 'visible',
                    'opacity': '1',
                    'transition': 'none'
                });
                
                // Ensure parent navbar brand is visible
                logoElement.closest('.navbar-brand').css({
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
        });
    });
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

    <!-- JavaScript Files - Optimized Loading Order -->
    <!-- jQuery and jQuery Migrate already loaded above -->
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.min.js')}}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js')}}"></script>
    <script src="{{ asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('js/aos.min.js')}}"></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{ asset('js/scrollax.min.js')}}"></script>
    
    <!-- Google Maps will be loaded with proper error handling below -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&loading=async&callback=initMap"></script>
    <script>
        // Wait for Google Maps to load before loading google-map.min.js
        function initMap() {
            // Only proceed if a map container exists
            if (!document.getElementById('map') && !document.getElementById('google-map')) return;
            // Load google-map.min.js only after Google Maps is ready
            var script = document.createElement('script');
            script.src = "{{ asset('js/google-map.min.js')}}";
            document.head.appendChild(script);
        }
        
        // Handle Google Maps loading errors
        window.gm_authFailure = function() {
            // Authentication failed - handled silently
        };
        
        // Fallback if Google Maps fails to load
        setTimeout(function() {
            if (typeof google === 'undefined' || !google.maps) {
                // Google Maps failed to load - handled silently
            }
        }, 10000);
    </script>
    <script src="{{ asset('js/main.min.js')}}"></script>
</body>

</html>
