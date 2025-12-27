@extends('layouts.frontend')


@section('seoinfo')

<title>Best Immigration Lawyer in Melbourne Australia | Bansal Lawyers - Experimental</title>
<meta name="description" content="Looking for top-rated lawyers in Australia? Bansal Lawyers offers expert legal services in immigration, family, criminal, and business law. Get legal help today!" >

<link rel="canonical" href="https://www.bansallawyers.com.au" >

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

/* New Hero Design Styles */
.hero-section {
    position: relative;
    height: 100vh;
    min-height: 600px;
    background: url('{{ asset('images/homepage-mobile.webp') }}') center center/cover no-repeat;
    background-color: #f8f9fa;
    display: flex;
    align-items: center;
    overflow: hidden;
}

/* Responsive background images for hero section */
@media (min-width: 768px) {
    .hero-section {
        background-image: url('{{ asset('images/homepage-tablet.webp') }}');
    }
}

@media (min-width: 1200px) {
    .hero-section {
        background-image: url('{{ asset('images/homepage.webp') }}');
    }
}

@media (min-width: 1920px) {
    .hero-section {
        background-image: url('{{ asset('images/homepage@2x.webp') }}');
    }
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(27, 77, 137, 0.3) 0%, rgba(27, 77, 137, 0.1) 50%, rgba(27, 77, 137, 0.05) 100%);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
}

.hero-text-overlay {
    background: rgba(255, 255, 255, 0.95);
    padding: 50px 40px;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    backdrop-filter: blur(10px);
    max-width: 400px;
    margin-left: 0;
}

.hero-text-overlay h1 {
    font-size: 3rem;
    font-weight: 700;
    color: #1B4D89;
    margin-bottom: 20px;
    line-height: 1.2;
}

.hero-text-overlay h2 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #1B4D89;
    margin-bottom: 15px;
    line-height: 1.3;
}

.hero-text-overlay p {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 30px;
    line-height: 1.6;
}

.hero-cta {
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: white;
    padding: 15px 35px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(27, 77, 137, 0.3);
    border: none;
}

.hero-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(27, 77, 137, 0.4);
    color: white;
    text-decoration: none;
}

/* SEO Hidden Content */
.seo-hidden-content {
    position: absolute;
    left: -9999px;
    top: -9999px;
    opacity: 0;
    visibility: hidden;
    height: 0;
    width: 0;
    overflow: hidden;
}

.experimental-cta {
    background: #fff;
    color: #1B4D89;
    padding: 15px 30px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.experimental-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    color: #1B4D89;
    text-decoration: none;
}

.experimental-section {
    padding: 60px 0;
}

.experimental-card {
    background: white;
    border-radius: 15px;
    padding: 30px 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    border: 1px solid #f0f0f0;
}

.experimental-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.experimental-card .icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    font-size: 2rem;
    color: white;
}

.experimental-card h3 {
    color: #1B4D89;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
}

.experimental-card p {
    color: #666;
    line-height: 1.6;
    text-align: center;
}

.experimental-about {
    background: #f8f9fa;
    padding: 60px 0;
}

.experimental-about-content {
    background: white;
    border-radius: 20px;
    padding: 45px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}


/* Tablet Responsive Styles */
@media (max-width: 1024px) and (min-width: 769px) {
    .hero-text-overlay {
        padding: 45px 35px;
        max-width: 380px;
    }
    
    .hero-text-overlay h1 {
        font-size: 2.4rem;
    }
    
    .hero-text-overlay h2 {
        font-size: 1.5rem;
    }
}

/* Mobile Responsive Styles */
@media (max-width: 768px) {
    .hero-section {
        height: 80vh;
        min-height: 500px;
    }
    
    .hero-text-overlay {
        padding: 35px 25px;
        margin: 20px;
        max-width: calc(100% - 40px);
    }
    
    .hero-text-overlay h1 {
        font-size: 2.2rem;
    }
    
    .hero-text-overlay h2 {
        font-size: 1.4rem;
    }
    
    .hero-text-overlay p {
        font-size: 1rem;
    }
    
    .hero-cta {
        padding: 12px 25px;
        font-size: 1rem;
    }
    
    .experimental-banner h1 {
        font-size: 2.5rem;
    }
    
    .experimental-banner p {
        font-size: 1rem;
    }
    
    .experimental-about-content {
        padding: 30px;
    }
    
    .experimental-card {
        padding: 30px 20px;
    }
    
    /* Contact Section Mobile Styles */
    .experimental-section[style*="background: linear-gradient"] {
        padding: 40px 0 !important;
    }
    
    .experimental-section[style*="background: linear-gradient"] .container > .row > div {
        padding: 0 15px;
    }
    
    .experimental-section[style*="background: linear-gradient"] .container > .row > div > div[style*="background: rgba(255,255,255,0.15)"] {
        padding: 20px 12px !important;
        margin: 10px 0;
    }
    
    .experimental-section[style*="background: linear-gradient"] h2 {
        font-size: 1.6rem !important;
    }
    
    .experimental-section[style*="background: linear-gradient"] h3 {
        font-size: 1.2rem !important;
    }
    
    .experimental-section[style*="background: linear-gradient"] .g-recaptcha {
        transform: scale(0.7);
        transform-origin: center;
    }
    
    .experimental-section[style*="background: linear-gradient"] .form-group {
        margin-bottom: 0.8rem !important;
    }
    
    .experimental-section[style*="background: linear-gradient"] input,
    .experimental-section[style*="background: linear-gradient"] textarea {
        padding: 8px 10px !important;
        font-size: 0.85rem !important;
    }
    
    .experimental-section[style*="background: linear-gradient"] label {
        font-size: 0.8rem !important;
    }
}

/* Home Contact Form Custom Styles */
.home-contact-form-container {
    background: transparent !important;
    box-shadow: none !important;
    padding: 0 !important;
    margin: 0 !important;
}

.home-contact-form-container .contact-form .form-group {
    margin-bottom: 15px !important;
}

.home-contact-form-container .contact-form .form-label {
    color: white !important;
    font-weight: 600 !important;
    margin-bottom: 3px !important;
    display: block !important;
    font-size: 0.85rem !important;
}

.home-contact-form-container .contact-form .form-control {
    border-radius: 8px !important;
    border: 2px solid rgba(255,255,255,0.3) !important;
    padding: 8px 12px !important;
    font-size: 0.9rem !important;
    background: rgba(255,255,255,0.9) !important;
    color: #333 !important;
    transition: all 0.3s ease !important;
}

.home-contact-form-container .contact-form .form-control:focus {
    border-color: #fff !important;
    background: rgba(255,255,255,1) !important;
    outline: none !important;
    box-shadow: none !important;
}

.home-contact-form-container .contact-form .form-control::placeholder {
    color: #999 !important;
    font-style: italic !important;
}

.home-contact-form-container .g-recaptcha {
    display: flex !important;
    justify-content: center !important;
    transform: scale(0.8) !important;
    margin: 10px 0 !important;
}

/* Custom reCAPTCHA styling for better integration */
.home-contact-form-container .g-recaptcha > div {
    background: rgba(255,255,255,0.1) !important;
    border: 2px solid rgba(255,255,255,0.3) !important;
    border-radius: 8px !important;
    backdrop-filter: blur(10px) !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    transition: all 0.3s ease !important;
}

.home-contact-form-container .g-recaptcha > div:hover {
    border-color: rgba(255,255,255,0.5) !important;
    box-shadow: 0 6px 20px rgba(0,0,0,0.2) !important;
}

/* Style the reCAPTCHA iframe */
.home-contact-form-container .g-recaptcha iframe {
    border-radius: 6px !important;
    background: transparent !important;
}

/* Style the reCAPTCHA checkbox area */
.home-contact-form-container .g-recaptcha .recaptcha-checkbox-border {
    border-radius: 6px !important;
    background: rgba(255,255,255,0.9) !important;
    border: 1px solid rgba(255,255,255,0.3) !important;
}

.home-contact-form-container .g-recaptcha .recaptcha-checkbox-checkmark {
    background: #1B4D89 !important;
}

/* Style the reCAPTCHA text */
.home-contact-form-container .g-recaptcha .recaptcha-checkbox-text {
    color: #333 !important;
    font-weight: 500 !important;
}

/* Alternative: Hide reCAPTCHA and show custom message */
.home-contact-form-container .g-recaptcha-custom {
    background: rgba(255,255,255,0.1) !important;
    border: 2px solid rgba(255,255,255,0.3) !important;
    border-radius: 8px !important;
    padding: 15px !important;
    text-align: center !important;
    color: white !important;
    font-size: 0.9rem !important;
    backdrop-filter: blur(10px) !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    margin: 10px 0 !important;
}

.home-contact-form-container .g-recaptcha-custom i {
    font-size: 1.2rem !important;
    margin-right: 8px !important;
    color: #1B4D89 !important;
}

.home-contact-form-container .btn-experimental-cta {
    width: 100% !important;
    text-align: center !important;
    border: none !important;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%) !important;
    color: #1B4D89 !important;
    padding: 10px 20px !important;
    border-radius: 30px !important;
    font-weight: 700 !important;
    font-size: 0.95rem !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
    transition: all 0.3s ease !important;
    position: relative !important;
    overflow: hidden !important;
}

.home-contact-form-container .btn-experimental-cta:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3) !important;
    color: #1B4D89 !important;
}

.home-contact-form-container .btn-experimental-cta:active {
    transform: translateY(0) !important;
}

.home-contact-form-container .btn-experimental-cta:disabled {
    opacity: 0.7 !important;
    cursor: not-allowed !important;
    transform: none !important;
    background: #6c757d !important;
}

.home-contact-form-container .invalid-feedback {
    color: #ff6b6b !important;
    font-size: 0.8rem !important;
    margin-top: 5px !important;
    display: block !important;
}

.home-contact-form-container .contact-form-messages .alert {
    border-radius: 8px !important;
    border: none !important;
    padding: 8px 12px !important;
    font-size: 0.85rem !important;
    margin-bottom: 15px !important;
}

.home-contact-form-container .contact-form-messages .alert-success {
    background: rgba(40, 167, 69, 0.9) !important;
    color: white !important;
}

.home-contact-form-container .contact-form-messages .alert-danger {
    background: rgba(220, 53, 69, 0.9) !important;
    color: white !important;
}
</style>

<!-- New Hero Section -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-text-overlay">
                <h1>Bansal Lawyers</h1>
                <h2>There is no legal puzzle that we can't solve</h2>
                <p>Expert legal services in Melbourne, Australia. We handle your legal matters with professionalism and care, so you can focus on what matters most.</p>
                <a href="/book-an-appointment" class="hero-cta">
                    Start Your Legal Consultation <i class="ion-ios-arrow-forward ms-2"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- SEO Hidden Content -->
    <div class="seo-hidden-content">
        <h1>Best Immigration Lawyer in Melbourne Australia | Bansal Lawyers</h1>
        <h2>Expert Legal Services in Melbourne</h2>
        <p>Bansal Lawyers is your trusted legal service provider in Melbourne, Australia. Our team is expert in Australian Law and has a strong track record of success in helping individuals and families living in Australia. Our team of highly skilled lawyers is dedicated to protecting your rights and defending your future in Australia.</p>
        <p>We provide comprehensive legal services including Immigration Law, Family Law, Criminal Law, Child Custody, Property Settlements, and Civil Law matters. Our experienced lawyers specialize in ART/AAT Appeals, visa applications, and all aspects of Australian immigration law.</p>
        <h3>Best Lawyers in Melbourne Australia</h3>
        <p>Bansal Lawyers, the best immigration lawyer in Melbourne and leading law firm in Melbourne, assists you with all legal challenges. Our focus on client satisfaction ensures the best results in Family Law Matters, Criminal Law Defense, Immigration Law Concerns, and any other legal issue.</p>
        <p>Contact us today for expert legal guidance and support. We are committed to providing personalized legal assistance and achieving the best possible outcomes for our clients.</p>
        <ul>
            <li>Immigration Law Services</li>
            <li>Family Law Matters</li>
            <li>Criminal Law Defense</li>
            <li>Property Law</li>
            <li>Commercial Law</li>
            <li>Civil Law</li>
        </ul>
    </div>
</section>

<!-- Experimental Services Section -->
<section class="experimental-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="text-center mb-5">
                    <h2 style="color: #1B4D89; font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">Why Choose Bansal Lawyers?</h2>
                    <p style="color: #666; font-size: 1.1rem; line-height: 1.6; margin-bottom: 2rem;">
                        At Bansal Lawyers, the best immigration lawyer in Melbourne provides all legal services with personal assistance. Our focus on client satisfaction to provide best results in Family Law Matters, Criminal Law Defense, Immigration Law Concerns or any other legal issue.
                    </p>
                    <a href="/book-an-appointment" class="experimental-cta">Book Your Consultation</a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="experimental-card">
                            <div class="icon">
                                <span class="flaticon-auction"></span>
                            </div>
                            <h3>Your Success is Our Mission</h3>
                            <p>We don't just handle cases – we build relationships. Every client's story matters to us, and we fight passionately for the outcomes that will change your life for the better. Your victory is our greatest reward.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="experimental-card">
                            <div class="icon">
                                <span class="flaticon-lawyer"></span>
                            </div>
                            <h3>We Speak Your Language</h3>
                            <p>Understanding your unique situation is our first priority. We take time to listen, explain everything in plain English, and create a personalized strategy that fits your specific needs and goals.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="experimental-card">
                            <div class="icon">
                                <span class="flaticon-lawyer"></span>
                            </div>
                            <h3>Proven Track Record</h3>
                            <p>With years of experience helping families and individuals in Australia, we've successfully guided hundreds of clients through complex legal challenges. Your case is in capable, caring hands.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experimental Practice Areas Section -->
<section class="experimental-section" style="background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <span style="color: #1B4D89; font-weight: 600; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Legal Expertise</span>
                <h2 style="color: #1B4D89; font-size: 2.5rem; font-weight: 700; margin: 1rem 0;">Our Practice Areas</h2>
                <p style="color: #666; font-size: 1.1rem; line-height: 1.6;">We provide comprehensive legal services across multiple practice areas to meet all your legal needs in Australia. Our experienced lawyers in Melbourne specialize in various areas of Australian law.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="experimental-card" style="text-align: center;">
                    <div class="icon">
                        <span class="flaticon-family"></span>
                    </div>
                    <h3>Family Law</h3>
                    <p>Divorce, separation, children, property and other family law matters. Expert guidance for complex family situations.</p>
                    <a href="/family-law" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem;">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="experimental-card" style="text-align: center;">
                    <div class="icon">
                        <span class="flaticon-handshake"></span>
                    </div>
                    <h3>Migration Law</h3>
                    <p>Visa applications, appeals, permanent residency, and citizenship matters. Your pathway to Australia.</p>
                    <a href="/migration-law" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem;">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="experimental-card" style="text-align: center;">
                    <div class="icon">
                        <span class="flaticon-auction"></span>
                    </div>
                    <h3>Criminal Law</h3>
                    <p>Assault charges, traffic offenses, and criminal defense. Protecting your rights and future in Australia.</p>
                    <a href="/criminal-law" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem;">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="experimental-card" style="text-align: center;">
                    <div class="icon">
                        <span class="flaticon-lawyer"></span>
                    </div>
                    <h3>Commercial Law</h3>
                    <p>Business formation, contracts, corporate governance, and commercial disputes. Supporting your business growth.</p>
                    <a href="/commercial-law" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem;">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="experimental-card" style="text-align: center;">
                    <div class="icon">
                        <span class="flaticon-house"></span>
                    </div>
                    <h3>Property Law</h3>
                    <p>Property transactions, leasing, development, and property disputes. Securing your property interests.</p>
                    <a href="/property-law" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem;">Learn More</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="experimental-card" style="text-align: center; background: linear-gradient(135deg, #1B4D89, #2c5aa0); color: white;">
                    <div class="icon" style="background: rgba(255,255,255,0.2);">
                        <span class="flaticon-auction"></span>
                    </div>
                    <h3 style="color: white;">All Practice Areas</h3>
                    <p style="color: rgba(255,255,255,0.9);">View our complete range of legal services and find the right solution for your needs.</p>
                    <a href="/practice-areas" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem; background: white; color: #1B4D89;">View All Services</a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Experimental Testimonials Section -->
<section class="experimental-testimonial">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <span style="color: #1B4D89; font-weight: 600; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Client Success Stories</span>
                <h2 style="font-size: 2.5rem; font-weight: 700; margin: 1rem 0; color: #333;">What Our Clients Say</h2>
                <p style="font-size: 1.1rem; color: #666;">Hear from some of our valued clients about their experiences working with us. Your success is our priority.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="swiper carousel-testimony">
                    <div class="swiper-wrapper">
                        <!-- Testimonial Item 1 -->
                        <div class="swiper-slide">
                            <div class="experimental-testimonial-card">
                                <p>"Bansal Lawyers turned a daunting process into a manageable one. Their team was always available to answer my questions and address my concerns. Their professionalism and expertise are unmatched."</p>
                                <div class="author">
                                    <div class="author-avatar">S</div>
                                    <div>
                                        <h5 style="margin: 0; font-weight: 600;">Sonu Choudhary</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Item 2 -->
                        <div class="swiper-slide">
                            <div class="experimental-testimonial-card">
                                <p>"From the very first consultation, Bansal Lawyers impressed me with their professionalism. They provided honest advice and ensured my case was handled with utmost care. Their expertise turned my legal challenges into a seamless experience."</p>
                                <div class="author">
                                    <div class="author-avatar">R</div>
                                    <div>
                                        <h5 style="margin: 0; font-weight: 600;">Ruhi Bagga</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Item 3 -->
                        <div class="swiper-slide">
                            <div class="experimental-testimonial-card">
                                <p>"Thanks to Bansal Lawyers, my visa was approved quickly and without any issues. They provided clear guidance and ensured all paperwork was flawless. I'm grateful for their dedication and expertise."</p>
                                <div class="author">
                                    <div class="author-avatar">D</div>
                                    <div>
                                        <h5 style="margin: 0; font-weight: 600;">Dhiman Guru</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Item 4 -->
                        <div class="swiper-slide">
                            <div class="experimental-testimonial-card">
                                <p>"I can't thank Bansal Lawyers enough for their help with my visa application. They were meticulous, responsive, and always approachable. Their expertise made all the difference in achieving a positive outcome."</p>
                                <div class="author">
                                    <div class="author-avatar">M</div>
                                    <div>
                                        <h5 style="margin: 0; font-weight: 600;">Manjeet Singh</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Item 5 -->
                        <div class="swiper-slide">
                            <div class="experimental-testimonial-card">
                                <p>"I really appreciate their dedication and personal approach, which made a complicated process much simpler. I highly recommend Bansal Lawyers to anyone looking for reliable and expert legal. They are a team you can trust."</p>
                                <div class="author">
                                    <div class="author-avatar">A</div>
                                    <div>
                                        <h5 style="margin: 0; font-weight: 600;">Anisha Dhirwan</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Item 6 -->
                        <div class="swiper-slide">
                            <div class="experimental-testimonial-card">
                                <p>"Bansal Lawyers exceeded my expectations in every way. Their team was attentive, thorough, and always approachable. They took the time to understand my situation and worked hard to deliver the best outcome possible."</p>
                                <div class="author">
                                    <div class="author-avatar">P</div>
                                    <div>
                                        <h5 style="margin: 0; font-weight: 600;">Prabhjot Kaur</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial Item 7 -->
                        <div class="swiper-slide">
                            <div class="experimental-testimonial-card">
                                <p>"The team at Bansal Lawyers is exceptional. They listened to my concerns, explained the process clearly, and delivered results. Their support made all the difference in my legal journey."</p>
                                <div class="author">
                                    <div class="author-avatar">P</div>
                                    <div>
                                        <h5 style="margin: 0; font-weight: 600;">Parminder Ghill</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Blog Section -->
<section class="experimental-section" style="background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <span style="color: #1B4D89; font-weight: 600; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Our Blog</span>
                <h2 style="color: #1B4D89; font-size: 2.5rem; font-weight: 700; margin: 1rem 0;">Latest Legal Insights</h2>
                <p style="color: #666; font-size: 1.1rem; line-height: 1.6;">Stay informed with our expert articles on legal trends, industry news, and professional insights. Get the latest updates on Australian law and legal developments.</p>
            </div>
        </div>
        <div class="row">
            @foreach (@$bloglists as $list)
            <div class="col-md-4 mb-4">
                <div class="experimental-card">
                    @php
                        $imagePath = !empty(@$list->image) ? 'images/blog/' . @$list->image : 'images/Blog.jpg';
                        $pathInfo = pathinfo($imagePath);
                        $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
                        // Check for optimized 400px version for blog listing
                        $webpPath400 = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '-400.webp';
                        $hasWebP = file_exists(public_path($webpPath));
                        $hasWebP400 = file_exists(public_path($webpPath400));
                        // Use 400px version for listing if available, otherwise use full size
                        $optimizedWebpPath = $hasWebP400 ? $webpPath400 : ($hasWebP ? $webpPath : $imagePath);
                    @endphp
                    <div style="height: 200px; background-image: url('{{ asset($optimizedWebpPath) }}'); background-size: cover; background-position: center; border-radius: 15px; margin-bottom: 20px;" onerror="this.style.backgroundImage='url({{ asset('images/Blog.jpg') }})'">
                        <span class="sr-only">{{ @$list->title }}</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div style="background: #1B4D89; color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.9rem; font-weight: 600;">
                            <?php echo date('d M', strtotime($list->created_at));?>
                        </div>
                        <div class="ms-3">
                            <div style="color: #1B4D89; font-weight: 600;"><?php echo date('Y', strtotime($list->created_at));?></div>
                        </div>
                    </div>
                    @if(isset($list->categorydetail) && $list->categorydetail)
                        <div class="mb-3">
                            <a href="{{ route('blog.category', $list->categorydetail->slug) }}" class="badge badge-primary">{{ $list->categorydetail->name }}</a>
                        </div>
                    @endif
                    <h4 style="color: #1B4D89; font-weight: 600; margin-bottom: 15px; line-height: 1.4;">
                        <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" style="color: inherit; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#2c5aa0'" onmouseout="this.style.color='#1B4D89'">{{@$list->title}}</a>
                    </h4>
                    <p style="color: #666; margin-bottom: 20px; line-height: 1.5; font-size: 0.95rem;">{{@$list->title}}</p>
                    <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px;">
                        Read More <i class="ion-ios-arrow-forward" style="font-size: 0.8rem;"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Experimental Contact Section -->
<section class="experimental-section" style="background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%); color: white; position: relative; overflow: hidden;">
    <!-- Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 1px, transparent 1px), radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 1px, transparent 1px), radial-gradient(circle at 50% 10%, rgba(255,255,255,0.05) 0.5px, transparent 0.5px), radial-gradient(circle at 10% 60%, rgba(255,255,255,0.05) 0.5px, transparent 0.5px), radial-gradient(circle at 90% 40%, rgba(255,255,255,0.05) 0.5px, transparent 0.5px); background-size: 20px 20px, 20px 20px, 15px 15px, 15px 15px, 15px 15px; opacity: 0.3; z-index: 1;"></div>
    
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="text-center">
                    <img src="{{ asset('images/bg_2.webp') }}" 
                         srcset="{{ asset('images/bg_2.webp') }} 1x, 
                                 {{ asset('images/bg_2@2x.webp') }} 2x" 
                         sizes="(max-width: 768px) 100vw, 674px" 
                         alt="Contact Bansal Lawyers" 
                         class="img-fluid rounded" 
                         style="box-shadow: 0 20px 40px rgba(0,0,0,0.3); border-radius: 20px !important; max-width: 100%; height: auto;" 
                         loading="eager" 
                         width="674" 
                         height="405">
                    <div class="mt-4">
                        <h3 style="font-size: 1.8rem; font-weight: 600; margin-bottom: 1rem;">Get in Touch Today</h3>
                        <p style="font-size: 1.1rem; opacity: 0.9; line-height: 1.6;">
                            Ready to discuss your legal needs? Our experienced team is here to provide you with expert legal guidance and support.
                        </p>
                        <div class="mt-4">
                            <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                                <i class="ion-ios-telephone" style="font-size: 1.5rem; margin-right: 15px; color: #fff;"></i>
                                <span style="font-size: 1.1rem; font-weight: 500;">1300 BANSAL (1300 226 725)</span>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: center;">
                                <i class="ion-ios-email" style="font-size: 1.5rem; margin-right: 15px; color: #fff;"></i>
                                <span style="font-size: 1.1rem; font-weight: 500;">info@bansallawyers.com.au</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div style="background: rgba(255,255,255,0.15); border-radius: 15px; padding: 25px; backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.3); box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" style="margin-bottom: 15px; border-radius: 8px; border: none; background: rgba(40, 167, 69, 0.9); color: white; padding: 8px 12px; font-size: 0.85rem;">
                            <i class="ion-ios-checkmark-circle" style="margin-right: 6px;"></i>
                            <strong>Success!</strong> {{ $message }}
                        </div>
                    @endif
                    
                    @if ($errors->any())
                        <div class="alert alert-danger" style="margin-bottom: 15px; border-radius: 8px; border: none; background: rgba(220, 53, 69, 0.9); color: white; padding: 8px 12px; font-size: 0.85rem;">
                            <i class="ion-ios-warning" style="margin-right: 6px;"></i>
                            <strong>Please correct the following errors:</strong>
                            <ul style="margin: 6px 0 0 0; padding-left: 12px; font-size: 0.8rem;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="text-center mb-2">
                        <span style="color: rgba(255,255,255,0.9); font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Get Legal Help</span>
                        <h2 style="font-size: 1.8rem; font-weight: 700; margin: 0.5rem 0 0.2rem;">Contact Our Melbourne Lawyers</h2>
                        <p style="font-size: 0.9rem; opacity: 0.9; margin-bottom: 0;">Send us a message and we'll get back to you with expert legal advice</p>
                    </div>
                    
                    <!-- Unified Contact Form Component -->
                    @include('components.unified-contact-form', [
                        'variant' => 'inline',
                        'showTitle' => false,
                        'formId' => 'home-contact-form',
                        'source' => 'home-page',
                        'buttonText' => 'Send Message',
                        'buttonClass' => 'btn-experimental-cta',
                        'containerClass' => 'home-contact-form-container'
                    ])
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<!-- Google reCAPTCHA v2 Script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!-- Video Modal Functions -->
<script>
function openVideoModal() {
    document.getElementById('videoModal').style.display = 'block';
    // Replace with your actual YouTube video URL
    document.getElementById('videoIframe').src = 'https://www.youtube.com/embed/YOUR_VIDEO_ID?autoplay=1&rel=0';
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

function closeVideoModal() {
    document.getElementById('videoModal').style.display = 'none';
    document.getElementById('videoIframe').src = ''; // Stop video playback
    document.body.style.overflow = 'auto'; // Restore scrolling
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    const modal = document.getElementById('videoModal');
    if (event.target === modal) {
        closeVideoModal();
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeVideoModal();
    }
});
</script>

<!-- Swiper.js initialization is handled in the layout file -->

<!-- Additional styles for home contact form -->
<script>
// Add CSS for loading animation and form validation
const style = document.createElement('style');
style.textContent = `
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .home-contact-form-container .is-valid {
        border-color: #28a745 !important;
        background-color: rgba(40, 167, 69, 0.1) !important;
    }
    
    .home-contact-form-container .is-invalid {
        border-color: #dc3545 !important;
        background-color: rgba(220, 53, 69, 0.1) !important;
    }
    
    /* Enhanced reCAPTCHA styling */
    .home-contact-form-container .g-recaptcha {
        position: relative;
        overflow: hidden;
    }
    
    .home-contact-form-container .g-recaptcha::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        border-radius: 8px;
        pointer-events: none;
        z-index: 1;
    }
    
    .home-contact-form-container .g-recaptcha > div {
        position: relative;
        z-index: 2;
    }
`;
document.head.appendChild(style);

// Enhanced reCAPTCHA styling and interaction
document.addEventListener('DOMContentLoaded', function() {
    // Wait for reCAPTCHA to load
    const checkRecaptcha = setInterval(function() {
        const recaptchaElement = document.querySelector('.home-contact-form-container .g-recaptcha > div');
        if (recaptchaElement) {
            clearInterval(checkRecaptcha);
            
            // Add custom styling classes
            recaptchaElement.classList.add('recaptcha-styled');
            
            // Add hover effects
            recaptchaElement.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.02)';
                this.style.transition = 'all 0.3s ease';
            });
            
            recaptchaElement.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
            
            // Add focus effects
            const iframe = recaptchaElement.querySelector('iframe');
            if (iframe) {
                iframe.addEventListener('load', function() {
                    // Add subtle animation when reCAPTCHA loads
                    recaptchaElement.style.animation = 'fadeInUp 0.5s ease-out';
                });
            }
        }
    }, 100);
    
    // Add fadeInUp animation
    const animationStyle = document.createElement('style');
    animationStyle.textContent = `
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(animationStyle);
});
</script>
@endsection
