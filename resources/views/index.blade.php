@extends('layouts.frontend')


@section('seoinfo')

<title>Best Immigration Lawyer in Melbourne Australia | Bansal Lawyers</title>
<meta name="description" content="Looking for top-rated lawyers in Australia? Bansal Lawyers offers expert legal services in immigration, family, criminal, and business law. Get legal help today!" >

<link rel="canonical" href="<?php echo URL::to('/'); ?>" >

<!-- Facebook Meta Tags -->
<meta property="og:url" content="<?php echo URL::to('/'); ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="Best Immigration Lawyer in Melbourne Australia | Bansal Lawyers">
<meta property="og:description" content="Looking for top-rated lawyers in Australia? Bansal Lawyers offers expert legal services in immigration, family, criminal, and business law. Get legal help today!">
<meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="og:image:alt" content="Bansal Lawyers Logo">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="bansallawyers.com.au">
<meta property="twitter:url" content="<?php echo URL::to('/'); ?>">
<meta name="twitter:title" content="Best Immigration Lawyer in Melbourne Australia | Bansal Lawyers">
<meta name="twitter:description" content="Looking for top-rated lawyers in Australia? Bansal Lawyers offers expert legal services in immigration, family, criminal, and business law. Get legal help today!">
<meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="twitter:image:alt" content="Bansal Lawyers Logo">


@endsection

@section('content')

<style>
.badge {
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    text-decoration: none;
}

.badge-primary {
    color: #fff;
    background-color: #1B4D89;
}

.badge-primary:hover {
    color: #fff;
    background-color: #0d3a6b;
    text-decoration: none;
}

.blog-category {
    margin-bottom: 10px;
}
</style>

<div class="hero-wrap js-fullheight" data-stellar-background-ratio="0.5">
    <img src="{{ asset('images/coart_1.jpg') }}" id="hero-image" alt="Top-rated lawyers in Australia – Expert legal services" class="hero-image"  loading="eager">
  
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true" style="max-height:565px !important;">
            <div class="col-md-6 ftco-animate bansal_left_text">
                <h6 style="font-size:30px;color:white;">WELCOME TO BANSAL LAWYERS</h6>
                
                 <h3 class="subheading animated-typing" id="welcome-text" style="font-size: 32px;max-width: 100%;width: 100%;white-space: initial;font-weight: 700;">There's No Legal Puzzle That We Can't Solve</h3>

                <p class="mb-4 bansal_txt" style="font-size:12px;max-width: 100%;width: 100%;text-align:justify;">
                    Bansal Lawyers is your trusted legal service provider in Melbourne, Australia. Our Team is expert in Australian Law and have strong track record of success in helping individuals and families living in Australia. Our team of highly skilled lawyers dedicated to protecting your rights, defending your future in Australia. We provide legal services for Immigration Law, including ART/AAT Appeals. Also provide services with legal support for family law, criminal law, child custody, property settlements, and civil law matters.
                </p>
              <p class="mb-4 bansal_txt" style="font-size:12px;max-width: 100%;width: 100%;text-align:justify;">
                Bansal Lawyers, the best immigration lawyer in Melbourne also the leading law firm in Melbourne assist you for all legal challenges. Book your consultation with us today.
              </p>
              
                <!--<h1 class="mb-4">
                    There's No Legal Puzzle,<br>
                    <span class="dynamic-text">We Can't Solve.</span>
                </h1>-->
              <h1 class="mb-4" style="font-size:36px;max-width: 100%;width: 100%;text-align:justify;">Best Lawyers in Melbourne Australia</h1>
                
                <p class="mb-4">
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
                        <span class="subheading">Trusted Legal Expertise</span>
                        <h2 class="mb-4">Why Choose Bansal Lawyers?</h2>
                        <p style="text-align:justify;">At Bansal Lawyers, the best immigration lawyer in Melbourne provides all legal services with personal assistance. Our focus on client satisfaction to provide best results in Family Law Matters, Criminal Law Defense, Immigration Law Concerns or any other legal issue, Our team of experienced top lawyers in Melbourne is here to support you through all process.</p>
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
                                    <p style="text-align:justify;">At Bansal Lawyers, our team is always committed to get justice and protect the client rights with our experience. Our top legal professional lawyers in Melbourne work for safeguard your interest and secure the possible results for you. Get best legal service in Melbourne Australia which helps to get you positive results.</p>
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
                                    <p style="text-align:justify;">Bansal Lawyers, Expert Legal assistance in Melbourne always review all cases smoothly like Family Law, Divorce, Property Law and Others in Melbourne Australia. We plan legal strategies to find the path for the specific needs of Legal terms. Bansal Lawyers is a trustable law firm in Melbourne which provide the best service to their clients as per their needs.</p>
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
                                    <p style="text-align:justify;">Our Experienced Team with high experience of years in the legal field in Australia, Bansal Lawyers provides best legal services which supported by a team of highly skilled & professional lawyers.</p>
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
                        style="background-image: url('{{ asset('images/bansal_2.jpg') }}');background-position: top center;">
                      <img src="{{ asset('images/bansal_2.jpg') }}" alt="Ajay Bansal - CEO of Bansal Lawyers" style="display:none;">
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
                            <h2 class="mb-4">Meet Ajay Bansal – Director of Bansal Lawyers</h2>
                            <p>Meet our Director AJAY BANSAL of Bansal Lawyers your trusted legal expert in Melbourne, Australia. With years of professional experience in legal field in Australia, Ajay Bansal is committed to provide legal services to individuals, family, & business across Australia. He knows to get results in all legal issues in Australia like Immigration Law, Family Law, Property disputes, and many more legal services etc. Ajay is known for providing best solution in legal issues in Australia, he always focused to provide clients clear and satisfied legal advice makes him one of the top lawyers in Melbourne. He had a knowledge of Australian Law which helps him to make positive commitment with client for providing best results and solution outcome.
                            </p>
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
                                        <p>At Bansal Lawyers, our mission is to offer best legal services in Melbourne and across Australia that help to protect rights of our client. If you need a professional legal advice and are looking for experienced lawyers in Melbourne to get legal solution with positive outcome. Bansal Lawyers is here to help you.</p>
                                    </div>
                                    <!-- Vision Tab -->
                                    <div class="tab-pane container p-0 fade" id="home2">
                                        <p>Our vision is clear that we are the leading law firm in Melbourne Australia with a team of top-rated lawyers in our team to provide best legal solution to the client to protect their rights in Australia. We provide effective and trusted legal solutions in various laws, which help the client get positive outcomes that make a real difference.</p>
                                    </div>
                                    <!-- Values Tab -->
                                    <div class="tab-pane container p-0 fade" id="home3">
                                        <p>
                                            <span style="font-size:11pt">
                                                <span style="font-family:Cambria,&quot;serif&quot;">
                                                    <span style="font-size:14.0pt">
                                                        <span style="font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">At Bansal Lawyers, we provide effective legal services in Melbourne and across Australia as following values to our clients to get solution:<br />
                                                        &bull; <strong>Integrity:</strong> We work with the highest standards of honesty and ethics.<br />
                                                        &bull; <strong>Excellence:</strong> We striving for excellence in every case we handle.<br />
                                                        &bull; <strong>Commitment:</strong> Our Dedication to your rights and the pursuit of justice.<br />
                                                        &bull; <strong>Client-Centered Approach:</strong> Our Prioritizing your needs and goals at every step.<br />
                                                        &bull; <strong>Innovation:</strong> Our way to get modern solutions and creative legal strategies.
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </p>
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
                    <h3 class="mb-4">Building Trust, Delivering Results</h3>
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
                            <div class="case img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('images/Corporate_Legal_Separation_Corporate_Law.png') }}');">
                                
                            </div>
                          
                            <div class="text text-center">
                                <h3><a href="/case">Corporate Legal Dispute</a></h3>
                                <span>Business Law</span>
                            </div>
                        </div>
                        <!-- Case 2 -->
                        <div class="item">
                            <div class="case img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('images/Family_Law_Resolution.png') }}');">
                                
                            </div>
                            <div class="text text-center">
                                <h3><a href="/case">Family Estate Settlement</a></h3>
                                <span>Estate Planning</span>
                            </div>
                        </div>
                        <!-- Case 3 -->
                        <div class="item">
                            <div class="case img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('images/Employment_Law_Dispute_Labor_Law.png') }}');">
                                
                            </div>
                            
                            <div class="text text-center">
                               <h3><a href="/case">Wrongful Termination Defense</a></h3>
                               <span>Employment Law</span>
                           </div>
                        </div>
                        <!-- Case 4 -->
                        <div class="item">
                            <div class="case img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('images/Criminal_Defense_Victory_Criminal_Law.png') }}');">
                                
                            </div>
                          
                            <div class="text text-center">
                              <h3><a href="/case">Criminal Defense Victory</a></h3>
                              <span>Criminal Law</span>
                          </div>
                        </div>

                        <!-- Case 5 -->
                        <div class="item">
                            <div class="case img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('images/Intellectual_Property_Protection_IP_Law.png') }}');">
                                
                            </div>
                            <div class="text text-center">
                                <h3><a href="/case">Intellectual Property Protection</a></h3>
                                <span>Intellectual Law</span>
                            </div>
                        </div>

                        <!-- Case 6-->
                        <div class="item">
                            <div class="case img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('images/Real_Estate_Transaction_Real_Estate_Law.png') }}');">
                                
                            </div>
                          
                            <div class="text text-center">
                                <h3><a href="/case">Real Estate Law</a></h3>
                                <span>Real Estate Law</span>
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


    <section class="ftco-consultation ftco-section ftco-no-pt ftco-no-pb img">
        <div class="overlay"></div>
        <div class="container">

            <div class="row d-md-flex justify-content-end">
              
              	 <div class="col-md-6">
                    <img src="{{ asset('images/bg_2.jpg') }}" alt="Ajay Bansal">
                 </div>
              
                <div class="col-md-6 half p-3 py-5 pl-md-5 ftco-animate heading-section heading-section-white">
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
                    <h3>Latest Insights</h3>
                    <p>Stay informed with our expert articles on legal trends, industry news, and professional insights.
                    </p>
                </div>
            </div>

            <!-- Blog Articles -->
            <div class="row d-flex">
                @foreach (@$bloglists as $list)
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry">
                        <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" 
   class="block-20" 
   style="background-image: url('{{ !empty(@$list->image) ? asset('images/blog/' . @$list->image) : asset('images/Blog.jpg') }}'); color:#1B4D89 !important;"
   onerror="this.style.backgroundImage='url({{ asset('images/Blog.jpg') }})'">
   <span class="sr-only">{{ @$list->title }}</span>
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
                            @if(isset($list->categorydetail) && $list->categorydetail)
                                <div class="blog-category mb-2">
                                    <a href="{{ route('blog.category', $list->categorydetail->slug) }}" class="badge badge-primary">{{ $list->categorydetail->name }}</a>
                                </div>
                            @endif
                            <!-- <div class="meta">
                                <span class="day" style="color: black;"><?php echo date('d', strtotime($list->created_at));?></span>
                                <span class="mos" style="color: black;"><?php echo date('M', strtotime($list->created_at));?></span>
                                <span class="yr" style="color: black;"><?php echo date('Y', strtotime($list->created_at));?></span>
                            </div> -->
                            <p>{{@$list->title}}</p>
                            <p><a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" class="btn btn-primary">Read This More</a></p>
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
