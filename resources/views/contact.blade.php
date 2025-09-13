@extends('layouts.frontend')

@section('head')
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('seoinfo')
	<title>Legal Help in Melbourne | Best Law Firm – Bansal Lawyers</title>
    <meta name="description" content="Contact Bansal Lawyers, one of the best law firms in Melbourne, Australia, for expert legal assistance. Our skilled team specializes in divorce, visa applications, real estate matters, and more. .Reach out today!" />

    <link rel="canonical" href="<?php echo URL::to('/'); ?>/contact" />
        <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/contact">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Get Expert Legal Assistance from Best law firms in Melbourne Australia | Bansal Lawyers">
    <meta property="og:description" content="Contact Bansal Lawyers, one of the best law firms in Melbourne, Australia, for expert legal assistance. Our skilled team specializes in divorce, visa applications, real estate matters, and more. .Reach out today!">
    <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="og:image:alt" content="Bansal Lawyers Logo">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/contact">
    <meta name="twitter:title" content="Get Expert Legal Assistance from Best law firms in Melbourne Australia | Bansal Lawyers">
    <meta name="twitter:description" content="Contact Bansal Lawyers, one of the best law firms in Melbourne, Australia, for expert legal assistance. Our skilled team specializes in divorce, visa applications, real estate matters, and more. .Reach out today!">
    <meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="twitter:image:alt" content="Bansal Lawyers Logo">

@endsection
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/Contactus.jpg');max-height:422px !important;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">Contact Us</h1>
                <p>We’re here to assist you with your legal needs. Get in touch with Bansal Lawyers today!</p>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Contact <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
 </section>

<section class="ftco-section contact-section">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-12 mb-4">
                <h2 class="h3">Contact Information</h2>
            </div>
            <div class="w-100"></div>
                <div class="col-md-3">
                  <p><span>Address:</span> Level 8/278 Collins St, Melbourne VIC 3000, Australia</p>
                </div>
                <div class="col-md-3">
                  <p><span>Phone:</span> <a href="tel://(+61) 0422905860">(+61) 0422905860</a></p>

                   <!-- <p>
                     <span>Phone:</span>
                     <span class="fraction_left" style="font-size: larger;color:#1a1a1a;">1300</span>
                     <span class="fraction">
                       <span class="numerator" style="color:#1a1a1a;">BANSAL</span>
                       <span class="denominator" style="color:#1a1a1a;">226725</span>
                     </span>
                  </p> -->
									<p style="display: flex;">
										<span>Phone:</span>
										<span class="fraction_left" style="color:#1a1a1a;margin-left: 5px;">1300 BANSAL<br>(1300 226 725)</span>
								 </p>


                </div>
                <div class="col-md-3">
                  <p><span>Email:</span> <a href="mailto:Info@bansallawyers.com.au">Info@bansallawyers.com.au</a></p>
                </div>
                <div class="col-md-3">
                  <p><span>Website:</span> <a href="https://www.bansallawyers.com.au/">bansallawyers.com.au</a></p>
                </div>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success" style="margin-left:10px;margin-right:10px;">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row block-9 no-gutters">
                <div class="col-lg-6 order-md-last d-flex">

                    <!-- Form modified to use mailto: -->
                    <form action="<?php echo URL::to('/'); ?>/contact_lawyer" method="POST" enctype="multipart/form-data" class="bg-light p-5 contact-form">
                        @csrf
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
                          <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Message"
                            required></textarea>
                        </div>
                        
                        <!-- Google reCAPTCHA -->
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <div class="text-danger mt-2">
                                    <small>{{ $errors->first('g-recaptcha-response') }}</small>
                                </div>
                            @endif
                        </div>
                        
                        <div class="form-group">
                          <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>

                <!-- Embed Google Map -->
                <div class="col-lg-6 d-flex">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.645409146537!2d144.9631536153164!3d-37.81664617975151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d43c60387b1%3A0xd9be68c8b39a6074!2sLevel%208%2F278%20Collins%20St%2C%20Melbourne%20VIC%203000%2C%20Australia!5e0!3m2!1sen!2sus!4v1696731567597!5m2!1sen!2sus"
                    width="100%" height="561" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
