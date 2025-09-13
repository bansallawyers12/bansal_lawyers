@extends('layouts.frontend')

@section('head')
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('seoinfo')
	<title>Legal Help in Melbourne | Best Law Firm – Bansal Lawyers - Experimental</title>
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

<style>
/* Experimental Contact Page Styles */
.experimental-hero {
    background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
    color: white;
    padding: 100px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.experimental-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('images/Contactus.jpg') center/cover;
    opacity: 0.3;
    z-index: 1;
}

.experimental-hero .container {
    position: relative;
    z-index: 2;
}

.experimental-hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.experimental-hero p {
    font-size: 1.3rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.experimental-breadcrumb {
    background: rgba(255,255,255,0.1);
    padding: 15px 30px;
    border-radius: 50px;
    display: inline-block;
    backdrop-filter: blur(10px);
}

.experimental-breadcrumb a {
    color: white;
    text-decoration: none;
    font-weight: 500;
}

.experimental-breadcrumb a:hover {
    color: #f0f0f0;
    text-decoration: none;
}

.experimental-contact-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.experimental-contact-info {
    background: white;
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    margin-bottom: 40px;
}

.experimental-contact-info h2 {
    color: #1B4D89;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
    text-align: center;
}

.experimental-contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.experimental-contact-item {
    text-align: center;
    padding: 30px 20px;
    background: #f8f9fa;
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.experimental-contact-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.experimental-contact-item .icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 1.5rem;
    color: white;
}

.experimental-contact-item h4 {
    color: #1B4D89;
    font-weight: 600;
    margin-bottom: 10px;
}

.experimental-contact-item p {
    color: #666;
    margin: 0;
    line-height: 1.5;
}

.experimental-contact-item a {
    color: #1B4D89;
    text-decoration: none;
    font-weight: 500;
}

.experimental-contact-item a:hover {
    color: #2c5aa0;
    text-decoration: none;
}

.experimental-form-section {
    background: white;
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.experimental-form-section h3 {
    color: #1B4D89;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 2rem;
    text-align: center;
}

.experimental-form-group {
    margin-bottom: 25px;
}

.experimental-form-group label {
    color: #1B4D89;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}

.experimental-form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 1rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    background: #f8f9fa;
}

.experimental-form-control:focus {
    outline: none;
    border-color: #1B4D89;
    box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.1);
    background: white;
}

.experimental-form-control::placeholder {
    color: #999;
}

.experimental-textarea {
    min-height: 120px;
    resize: vertical;
}

.experimental-submit-btn {
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: white;
    padding: 15px 40px;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: block;
    margin: 0 auto;
    box-shadow: 0 4px 15px rgba(27, 77, 137, 0.3);
}

.experimental-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(27, 77, 137, 0.4);
}

.experimental-map-section {
    background: white;
    border-radius: 20px;
    padding: 0;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    overflow: hidden;
}

.experimental-map-section iframe {
    width: 100%;
    height: 400px;
    border: none;
}

.experimental-alert {
    background: #d4edda;
    color: #155724;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 30px;
    border: 1px solid #c3e6cb;
}

@media (max-width: 768px) {
    .experimental-hero h1 {
        font-size: 2.5rem;
    }
    
    .experimental-hero p {
        font-size: 1.1rem;
    }
    
    .experimental-contact-info,
    .experimental-form-section {
        padding: 30px 20px;
    }
    
    .experimental-contact-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}
</style>

<!-- Experimental Hero Section -->
<section class="experimental-hero">
    <div class="container">
        <h1>Contact Us</h1>
        <p>We're here to assist you with your legal needs. Get in touch with Bansal Lawyers today!</p>
        <div class="experimental-breadcrumb">
            <span><a href="/">Home</a> <i class="ion-ios-arrow-forward"></i></span>
            <span>Contact</span>
        </div>
    </div>
</section>

<!-- Experimental Contact Section -->
<section class="experimental-contact-section">
    <div class="container">
        <!-- Contact Information -->
        <div class="experimental-contact-info">
            <h2>Contact Information</h2>
            <div class="experimental-contact-grid">
                <div class="experimental-contact-item">
                    <div class="icon">
                        <i class="fa fa-map-marker-alt"></i>
                    </div>
                    <h4>Address</h4>
                    <p>Level 8/278 Collins St,<br>Melbourne VIC 3000,<br>Australia</p>
                </div>
                <div class="experimental-contact-item">
                    <div class="icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <h4>Phone</h4>
                    <p><a href="tel://(+61) 0422905860">(+61) 0422905860</a><br>
                    <a href="tel://1300226725">1300 BANSAL<br>(1300 226 725)</a></p>
                </div>
                <div class="experimental-contact-item">
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <h4>Email</h4>
                    <p><a href="mailto:Info@bansallawyers.com.au">Info@bansallawyers.com.au</a></p>
                </div>
                <div class="experimental-contact-item">
                    <div class="icon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <h4>Website</h4>
                    <p><a href="https://www.bansallawyers.com.au/">bansallawyers.com.au</a></p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-6 mb-4">
                <div class="experimental-form-section">
                    @if ($message = Session::get('success'))
                        <div class="experimental-alert">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    
                    <h3>Send us a Message</h3>
                    <form action="<?php echo URL::to('/'); ?>/contact_lawyer" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="experimental-form-group">
                            <label for="name">Your Name</label>
                            <input type="text" class="experimental-form-control" name="name" placeholder="Enter your full name" required>
                        </div>
                        <div class="experimental-form-group">
                            <label for="email">Your Email</label>
                            <input type="email" class="experimental-form-control" name="email" placeholder="Enter your email address" required>
                        </div>
                        <div class="experimental-form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="experimental-form-control" name="subject" placeholder="What is this about?" required>
                        </div>
                        <div class="experimental-form-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" class="experimental-form-control experimental-textarea" placeholder="Tell us about your legal needs..." required></textarea>
                        </div>
                        
                        <!-- Google reCAPTCHA -->
                        <div class="experimental-form-group">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <div class="text-danger mt-2">
                                    <small>{{ $errors->first('g-recaptcha-response') }}</small>
                                </div>
                            @endif
                        </div>
                        
                        <button type="submit" class="experimental-submit-btn">
                            Send Message <i class="fa fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Google Map -->
            <div class="col-lg-6">
                <div class="experimental-map-section">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.645409146537!2d144.9631536153164!3d-37.81664617975151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d43c60387b1%3A0xd9be68c8b39a6074!2sLevel%208%2F278%20Collins%20St%2C%20Melbourne%20VIC%203000%2C%20Australia!5e0!3m2!1sen!2sus!4v1696731567597!5m2!1sen!2sus"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
