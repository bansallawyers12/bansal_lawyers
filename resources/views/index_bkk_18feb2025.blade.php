@extends('layouts.frontend')


@section('seoinfo')

<title>Best Immigration Lawyer in Melbourne | Expert Legal Help</title>
<meta name="description" content="Bansal Lawyers provides the best immigration lawyers in Melbourne, offering expert legal services for visas, appeals, and migration advice. Get your consultation today!" >

<link rel="canonical" href="<?php echo URL::to('/'); ?>" >

<!-- Facebook Meta Tags -->
<meta property="og:url" content="<?php echo URL::to('/'); ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="Best Immigration Lawyer in Melbourne | Expert Legal Help">
<meta property="og:description" content="Bansal Lawyers provides the best immigration lawyers in Melbourne, offering expert legal services for visas, appeals, and migration advice. Get your consultation today!">
<meta property="og:image" content="@smartasset('images/logo/Bansal_Lawyers.png')">
<meta property="og:image:alt" content="Bansal Lawyers Logo">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="bansallawyers.com.au">
<meta property="twitter:url" content="<?php echo URL::to('/'); ?>">
<meta name="twitter:title" content="Best Immigration Lawyer in Melbourne | Expert Legal Help">
<meta name="twitter:description" content="Bansal Lawyers provides the best immigration lawyers in Melbourne, offering expert legal services for visas, appeals, and migration advice. Get your consultation today!">
<meta property="twitter:image" content="@smartasset('images/logo/Bansal_Lawyers.png')">
<meta property="twitter:image:alt" content="Bansal Lawyers Logo">


@endsection

@section('content')

<div class="hero-wrap js-fullheight" data-stellar-background-ratio="0.5">
    <img src="@smartasset('images/coart_1.jpeg')" id="hero-image" alt="Experienced Lawyers Providing Legal Solutions in Australia" class="hero-image" loading="eager">
  
    
    <script src="@smartasset('js/jquery-3.6.0.min.js')"></script>
    <script>
 
  $(document).ready(function () { //alert('ready');
      function updateHeroImage() {
          var windowWidth = $(window).width();    //alert('windowWidth='+windowWidth);
          var imageElement = $("#hero-image");    

          if (windowWidth < 768) {
              // Mobile Image
              imageElement.attr("src", "@smartasset('images/coart_1-mobile.jpg')");
          } else if (windowWidth >= 768 && windowWidth < 1024) {
              // Tablet Image
              imageElement.attr("src", "@smartasset('images/coart_1-tablet.jpg')");
          } else {
              // Desktop Image
              imageElement.attr("src", "@smartasset('images/coart_1.jpeg')");
          }
      }

      // Run on page load
      updateHeroImage();

      // Update image on window resize
      $(window).resize(function () {
          updateHeroImage();
      });
  });
</script>

    <!--<img src="@smartasset('images/coart_11.avif')" srcset="https://www.bansallawyers.com.au/public/images/coart_11-small.avif 480w,https://www.bansallawyers.com.au/public/images/coart_11.avif 768w,https://www.bansallawyers.com.au/public/images/coart_11.avif 1280w" sizes="(max-width: 480px) 100vw, (max-width: 768px) 50vw, 33vw" alt="Hero Image" class="hero-image" loading="eager">-->
  
      <!--<img src="@smartasset('images/coart_1.png')" srcset="https://www.bansallawyers.com.au/public/images/coart_1-small.png 480w,https://www.bansallawyers.com.au/public/images/coart_1-medium.png 768w,https://www.bansallawyers.com.au/public/images/coart_1.png 1280w" sizes="(max-width: 480px) 100vw, (max-width: 768px) 50vw, 33vw" alt="Hero Image" class="hero-image" loading="eager">-->

    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
            data-scrollax-parent="true">
            <div class="col-md-8 ftco-animate">
                <h2 class="subheading animated-typing" id="welcome-text">Welcome To Bansal Lawyers</h2>
                <h1 class="mb-4">
                    There's No Legal Puzzle,<br>
                    <span class="dynamic-text">We Can't Solve.</span>
                </h1>
                <p class="mb-4">
                    With a proven track record of success, we provide expert legal representation to safeguard your
                    rights, freedom, and future. Trust Bansal Lawyers to stand by your side.
                </p>
                <p>
                    <a href="/book-an-appointment" class="btn btn-primary mr-md-4 py-2 px-4">Schedule Your Consultation
                        <span class="ion-ios-arrow-forward"></span>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

    <!-- START: Services Section -->
    <section class="ftco-section ftco-no-pt">
        <div class="container">
            <div class="row">
                <!-- START: Left Column (Heading and Button) -->
                <div class="col-lg-3 py-5">
                    <div class="heading-section ftco-animate">
                        <span class="subheading">Our Expertise</span>
                        <h2 class="mb-4">Why Choose Bansal Lawyers?</h2>
                        <p>At Bansal Lawyers, we offer trusted legal guidance with a personal touch. Your trust inspires
                            us to work harder and achieve the best outcomes for you.</p>
                        <p><a href="/book-an-appointment" class="btn btn-primary py-3 px-4">Book Your Consultation</a></p>
                    </div>
                </div>
                <!-- END: Left Column (Heading and Button) -->

                <!-- START: Right Column (Service Details) -->
                <div class="col-lg-9 services-wrap px-4 pt-5">
                    <div class="row pt-md-3">
                        <!-- START: Service 1 -->
                        <div class="col-md-4 d-flex align-items-stretch">
                            <div class="services text-center">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-auction"></span>
                                </div>
                                <div class="text">
                                    <h3>Dedicated to Justice</h3>
                                    <p>Bansal Lawyers fights for what is right, ensuring your case is handled with care
                                        and dedication.</p>
                                </div>

                            </div>
                        </div>
                        <!-- END: Service 1 -->

                        <!-- START: Service 2 -->
                        <div class="col-md-4 d-flex align-items-stretch">
                            <div class="services text-center">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-lawyer"></span>
                                </div>
                                <div class="text">
                                    <h3>Customized Support</h3>
                                    <p>At Bansal Lawyers, we create tailored strategies to fit the unique needs of your
                                        case.</p>
                                </div>
                            </div>
                        </div>
                        <!-- END: Service 2 -->

                        <!-- START: Service 3 -->
                        <div class="col-md-4 d-flex align-items-stretch">
                            <div class="services text-center">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="flaticon-lawyer"></span>
                                </div>
                                <div class="text">
                                    <h3>Experienced Team</h3>
                                    <p>With years of experience, Bansal Lawyers provides expert advice and strong
                                        representation for every client.</p>
                                </div>

                            </div>
                        </div>
                        <!-- END: Service 3 -->
                    </div>
                </div>
                <!-- END: Right Column (Service Details) -->
            </div>
        </div>
    </section>
    <!-- END: Services Section -->


    <!-- START: About Section -->
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex">
                <!-- START: Video Section -->
                <div class="col-md-6 d-flex">
                    <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center"
                        style="background-image: url('@smartasset('images/bansal_2.jpg')');background-position: top center;">
                      <img src="@smartasset('images/bansal_2.jpg')" alt="Ajay Bansal - CEO of Bansal Lawyers" style="display:none;">
                        <a href="javascript:void(0);"
                            class="icon-video d-flex justify-content-center align-items-center"
                            onclick="openVideoModal()">
                            <span class="icon-play"></span>
                        </a>
                    </div>
                </div>
                <!-- END: Video Section -->

                <!-- Modal for YouTube Video -->
                <div id="videoModal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <span class="close" onclick="closeVideoModal()">&times;</span>
                        <iframe id="videoIframe"  style="width:100%; height:400px; border: none;" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                    </div>
                </div>





                <!-- START: Text Content Section -->
                <div class="col-md-6 pl-md-5">
                    <div class="row justify-content-start pt-3 pb-3">
                        <div class="col-md-12 heading-section ftco-animate">
                            <span class="subheading">Welcome to Bansal Lawyers</span>
                            <h2 class="mb-4">Committed to Fighting for Your Rights and Justice</h2>
                            <p>At Bansal Lawyers, we are dedicated to protecting your rights and providing solutions
                                tailored to your legal needs. Led by Ajay Bansal, our CEO known for his strong
                                leadership and innovative thinking, we combine deep legal expertise with a modern
                                approach. Justice isn’t just a goal for us—it’s our commitment to you, driven by a
                                passion for building strong relationships and delivering exceptional results.</p>
                            <div class="tabulation-2 mt-4">
                                <!-- START: Tab Navigation -->
                                <ul class="nav nav-pills nav-fill d-md-flex d-block">
                                    <li class="nav-item mb-md-0 mb-2">
                                        <a class="nav-link active py-2" data-toggle="tab" href="#home1">Our Mission</a>
                                    </li>
                                    <li class="nav-item px-lg-2 mb-md-0 mb-2">
                                        <a class="nav-link py-2" data-toggle="tab" href="#home2">Our Vision</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-2 mb-md-0 mb-2" data-toggle="tab" href="#home3">Our
                                            Values</a>
                                    </li>
                                </ul>
                                <!-- END: Tab Navigation -->

                                <!-- START: Tab Content -->
                                <div class="tab-content bg-light rounded mt-2">
                                    <!-- Mission Tab -->
                                    <div class="tab-pane container p-0 active" id="home1">
                                        <p>Our mission is to deliver personalized and high-quality legal services to
                                            protect your rights and achieve justice. We aim to build lasting trust with
                                            every client we serve.</p>
                                    </div>
                                    <!-- Vision Tab -->
                                    <div class="tab-pane container p-0 fade" id="home2">
                                        <p>Our vision is to be recognized as a trusted law firm committed to ethical
                                            practices, client success, and delivering outstanding legal solutions.</p>
                                    </div>
                                    <!-- Values Tab -->
                                    <div class="tab-pane container p-0 fade" id="home3">
                                        <p>We value integrity, professionalism, and relentless dedication to serving our
                                            clients with fairness and respect for the law.</p>
                                    </div>
                                </div>
                                <!-- END: Tab Content -->
                            </div>

                            <div class="years d-flex mt-4 mt-md-5">
                                <h4>
                                    <span>Your Trusted Legal Partner</span>
                                </h4>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- END: Text Content Section -->
            </div>
        </div>
    </section>
    <!-- END: About Section -->



    <!-- START: Case Studies Section -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-10 text-center heading-section ftco-animate">
                    <span class="subheading">Our Commitment to Excellence</span>
                    <h2 class="mb-4">Building Trust, Delivering Results</h2>
                    <p>At Bansal Lawyers, we are passionate about providing exceptional legal services tailored to your
                        unique needs. Explore how our expertise and dedication make a difference in our clients’ lives.
                    </p>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-case owl-carousel ftco-owl">
                        <!-- Case 1 -->
                        <div class="item">
                            <div class="case img d-flex align-items-center justify-content-center"
                                style="background-image: url('@smartasset('images/case-1.jpg')');">
                                <div class="text text-center">
                                    <h3><a href="/case">Corporate Legal Dispute</a></h3>
                                    <span>Business Law</span>
                                </div>
                            </div>
                        </div>
                        <!-- Case 2 -->
                        <div class="item">
                            <div class="case img d-flex align-items-center justify-content-center"
                                style="background-image: url('@smartasset('images/case-2.jpg')');">
                                <div class="text text-center">
                                    <h3><a href="/case">Family Estate Settlement</a></h3>
                                    <span>Estate Planning</span>
                                </div>
                            </div>
                        </div>
                        <!-- Case 3 -->
                        <div class="item">
                            <div class="case img d-flex align-items-center justify-content-center"
                                style="background-image: url('@smartasset('images/case-3.jpg')');">
                                <div class="text text-center">
                                    <h3><a href="/case">Wrongful Termination Defense</a></h3>
                                    <span>Employment Law</span>
                                </div>
                            </div>
                        </div>
                        <!-- Case 4 -->
                        <div class="item">
                            <div class="case img d-flex align-items-center justify-content-center"
                                style="background-image: url('@smartasset('images/case-4.jpg')');">
                                <div class="text text-center">
                                    <h3><a href="/case">Criminal Defense Victory</a></h3>
                                    <span>Criminal Law</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center mt-4">
                    <a href="/case" class="btn btn-primary px-5">Explore All Success Stories</a>
                </div>
            </div>
        </div>
    </section>
    <!-- END: Case Studies Section -->


    <section class="ftco-consultation ftco-section ftco-no-pt ftco-no-pb img"
        style="background-image: url('@smartasset('images/bg_2.jpg')');">
        <div class="overlay"></div>
        <div class="container">

            <div class="row d-md-flex justify-content-end">
                <div class="col-md-6 half p-3 py-5 pl-md-5 ftco-animate heading-section heading-section-white">
                    <!--<span class="subheading">Booking an Appointment</span>
                    <h2 class="mb-4">Free Consultation</h2>-->
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" style="margin-left:10px;margin-right:10px;">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <h2 class="mb-4">Contact Us</h2>
                    <form action="<?php echo URL::to('/'); ?>/contact_lawyer" method="POST" enctype="multipart/form-data" class="consultation">
                        
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" id="message" cols="30" rows="7" class="form-control"
                                placeholder="Message" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- START: Testimonial Section -->
    <section class="ftco-section testimony-section">
        <div class="container">
            <!-- Section Heading -->
            <div class="row justify-content-center">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Client Testimonials</span>
                    <h2 class="mb-4">What Our Clients Say</h2>
                    <p>Hear from some of our valued clients about their experiences working with us. Your success is our
                        priority.</p>
                </div>
            </div>
            <!-- Testimonial Carousel -->
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        <!-- Testimonial Item 1 -->
                        <div class="item">
                            <div class="testimony-wrap py-4 px-3">
                                <div class="text">
                                    <p class="mb-4">Bansal Lawyers turned a daunting process into a manageable one. Their team was always available to answer my questions and address my concerns. Their professionalism and expertise are unmatched.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img user-circle">S</div>
                                        <div class="pl-3">
                                            <p class="name">Sonu Choudhary</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Item 2 -->
                        <div class="item">
                            <div class="testimony-wrap py-4 px-3">
                                <div class="text">
                                    <p class="mb-4">From the very first consultation, Bansal Lawyers impressed me with their professionalism. They provided honest advice and ensured my case was handled with utmost care. Their expertise turned my legal challenges into a seamless experience.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img user-circle">R</div>
                                        <div class="pl-3">
                                            <p class="name">Ruhi Bagga</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Item 3 -->
                        <div class="item">
                            <div class="testimony-wrap py-4 px-3">
                                <div class="text">
                                    <p class="mb-4">Thanks to Bansal Lawyers, my visa was approved quickly and without any issues. They provided clear guidance and ensured all paperwork was flawless. I’m grateful for their dedication and expertise."</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img user-circle">D</div>
                                        <div class="pl-3">
                                            <p class="name">Dhiman Guru</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Item 4 -->
                        <div class="item">
                            <div class="testimony-wrap py-4 px-3">
                                <div class="text">
                                    <p class="mb-4">I can’t thank Bansal Lawyers enough for their help with my visa application. They were meticulous, responsive, and always approachable. Their expertise made all the difference in achieving a positive outcome</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img user-circle">M</div>
                                        <div class="pl-3">
                                            <p class="name">Manjeet Singh</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Item 5 -->
                        <div class="item">
                            <div class="testimony-wrap py-4 px-3">
                                <div class="text">
                                    <p class="mb-4">I really appreciate their dedication and personal approach, which made a complicated process much simpler. I highly recommend Bansal Lawyers to anyone looking for reliable and expert legal. They are a team you can trust.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img user-circle">A</div>
                                        <div class="pl-3">
                                            <p class="name">Anisha Dhirwan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4 px-3">
                                <div class="text">
                                    <p class="mb-4">Bansal  Lawyers exceeded my expectations in every way. Their team was attentive, thorough, and always approachable. They took the time to understand my situation and worked hard to deliver the best outcome possible.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img user-circle">P</div>
                                        <div class="pl-3">
                                            <p class="name">Prabhjot Kaur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4 px-3">
                                <div class="text">
                                    <p class="mb-4">The team at Bansal Lawyers is exceptional. They listened to my concerns, explained the process clearly, and delivered results. Their support made all the difference in my legal journey.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img user-circle">P</div>
                                        <div class="pl-3">
                                            <p class="name">Parminder Ghill</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: Testimonial Section -->



    <!-- START: Blog Section -->
    <section class="ftco-section bg-light">
        <div class="container">
            <!-- Section Heading -->
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Our Blog</span>
                    <h2>Latest Insights</h2>
                    <p>Stay informed with our expert articles on legal trends, industry news, and professional insights.
                    </p>
                </div>
            </div>

            <!-- Blog Articles -->
            <div class="row d-flex">
                @foreach (@$bloglists as $list)
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry">
                        <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" class="block-20"
                            style="background-image: url('public/img/blog/{{@$list->image}}');color:#1B4D89 !important;">
                        </a>
                        <div class="text p-4">
                            <div class="topper d-flex align-items-center">
                                <div class="one py-2 pl-3 pr-1 align-self-stretch">
                                    <span class="day"><?php echo date('d', strtotime($list->created_at));?></span>
                                </div>
                                <div class="two pl-0 pr-3 py-2 align-self-stretch">
                                    <span class="yr"><?php echo date('Y', strtotime($list->created_at));?></span>
                                    <span class="mos"><?php echo date('M', strtotime($list->created_at));?></span>
                                </div>
                            </div>
                            <h3 class="heading"><a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}">{{@$list->title}}</a></h3>
                            <!-- <div class="meta">
                                <span class="day" style="color: black;"><?php echo date('d', strtotime($list->created_at));?></span>
                                <span class="mos" style="color: black;"><?php echo date('M', strtotime($list->created_at));?></span>
                                <span class="yr" style="color: black;"><?php echo date('Y', strtotime($list->created_at));?></span>
                            </div> -->
                            <p>{{@$list->title}}</p>
                            <p><a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" class="btn btn-primary">Read More</a></p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- END: Blog Section -->

@endsection

@section('scripts')
  

@endsection
