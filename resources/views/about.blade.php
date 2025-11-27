@extends('layouts.frontend')

@section('head')
    <!-- AOS Animation Library -->
    <link href="{{ asset('css/aos.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/aos.min.js') }}"></script>
    <!-- Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
@endsection

@section('seoinfo')
<title>About Bansal Lawyers - Leading Legal Firm in Melbourne | Expert Legal Services</title>
<meta name="description" content="Learn about Bansal Lawyers, Melbourne's trusted legal firm led by Director Ajay Bansal. Expert services in Immigration, Family, Property, and Commercial Law with over 15 years of experience." />
<meta name="keywords" content="About Bansal Lawyers, Melbourne law firm, Ajay Bansal, legal services Australia, Immigration lawyer Melbourne, Family lawyer, Property lawyer, Commercial lawyer" />
<meta name="author" content="Bansal Lawyers" />
<meta name="robots" content="index, follow" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="language" content="en-AU" />

<link rel="canonical" href="https://www.bansallawyers.com.au/about" />

<!-- Facebook Meta Tags -->
<meta property="og:url" content="<?php echo URL::to('/'); ?>/about">
<meta property="og:type" content="website">
<meta property="og:title" content="About Bansal Lawyers - Leading Legal Firm in Melbourne">
<meta property="og:description" content="Learn about Bansal Lawyers, Melbourne's trusted legal firm led by Director Ajay Bansal. Expert services in Immigration, Family, Property, and Commercial Law.">
<meta property="og:image" content="{{ asset('images/ajay-bansal2.jpg') }}">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="bansallawyers.com.au">
<meta property="twitter:url" content="<?php echo URL::to('/'); ?>/about">
<meta name="twitter:title" content="About Bansal Lawyers - Leading Legal Firm in Melbourne">
<meta name="twitter:description" content="Learn about Bansal Lawyers, Melbourne's trusted legal firm led by Director Ajay Bansal. Expert services in Immigration, Family, Property, and Commercial Law.">
<meta property="twitter:image" content="{{ asset('images/ajay-bansal2.jpg') }}">

<!-- Additional SEO Meta Tags -->
<meta name="geo.region" content="AU-VIC">
<meta name="geo.placename" content="Melbourne">
<meta name="geo.position" content="-37.8136;144.9631">
<meta name="ICBM" content="-37.8136, 144.9631">
@endsection

@section('content')

<!-- Organization microdata removed to avoid conflicts with JSON-LD schema in page head -->
<!-- The global LegalService schema in frontend.blade.php provides all necessary structured data -->

<style>
/* Modern Typography and Color Scheme */
:root {
    /* Professional Color Palette */
    --primary-navy: #0F172A;
    --primary-blue: #1E40AF;
    --accent-gold: #F59E0B;
    --accent-orange: #EA580C;
    --neutral-dark: #1F2937;
    --neutral-medium: #4B5563;
    --neutral-light: #9CA3AF;
    --neutral-bg: #F9FAFB;
    --white: #FFFFFF;
    --success-green: #059669;
    
    /* Typography */
    --font-primary: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    --font-display: 'Playfair Display', Georgia, serif;
    
    /* Spacing and Layout */
    --section-padding: 120px 0;
    --container-padding: 0 20px;
    --border-radius: 16px;
    --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-large: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Global Typography */
body {
    font-family: var(--font-primary);
    line-height: 1.7;
    color: var(--neutral-dark);
}

h1, h2, h3, h4, h5, h6 {
    font-family: var(--font-display);
    font-weight: 600;
    line-height: 1.3;
    color: var(--primary-navy);
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, var(--primary-navy) 0%, var(--primary-blue) 100%);
    color: var(--white);
    padding: var(--section-padding);
    position: relative;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset("images/Aboutus.jpg") }}') center/cover;
    opacity: 0.15;
    z-index: 1;
}

.hero-section::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 30% 20%, rgba(245, 158, 11, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 70% 80%, rgba(234, 88, 12, 0.1) 0%, transparent 50%);
    z-index: 2;
}

.hero-content {
    position: relative;
    z-index: 3;
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.hero-title {
    font-size: 4.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, var(--white) 0%, rgba(255, 255, 255, 0.9) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.4rem;
    font-weight: 400;
    margin-bottom: 2.5rem;
    opacity: 0.95;
    line-height: 1.6;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.hero-cta {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 3rem;
}

.btn-primary {
    background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-orange) 100%);
    color: var(--white);
    padding: 18px 36px;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-medium);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-large);
    color: var(--white);
    text-decoration: none;
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: var(--white);
    padding: 18px 36px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    color: var(--white);
    text-decoration: none;
}

/* Section Styles */
.section {
    padding: var(--section-padding);
}

.section-title {
    font-size: 3rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 1rem;
    color: var(--primary-navy);
}

.section-subtitle {
    font-size: 1.2rem;
    color: var(--neutral-medium);
    text-align: center;
    margin-bottom: 4rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.section-divider {
    width: 80px;
    height: 4px;
    background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-orange) 100%);
    margin: 0 auto 4rem;
    border-radius: 2px;
}

/* About Director Section */
.about-director {
    background: var(--white);
}

.director-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
    margin-top: 4rem;
}

.director-image {
    position: relative;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-large);
}

.director-image img {
    width: 100%;
    height: 600px;
    object-fit: cover;
    object-position: center top;
    transition: transform 0.3s ease;
}

.director-image:hover img {
    transform: scale(1.02);
}

.director-info {
    padding-left: 2rem;
}

.director-name {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-navy);
    margin-bottom: 1rem;
}

.director-title {
    font-size: 1.3rem;
    color: var(--accent-gold);
    font-weight: 600;
    margin-bottom: 2rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.director-description {
    font-size: 1.1rem;
    color: var(--neutral-medium);
    line-height: 1.8;
    margin-bottom: 2rem;
}

/* Practice Areas Grid */
.practice-areas {
    margin-top: 3rem;
}

.practice-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    margin-top: 3rem;
}

.practice-card {
    background: var(--white);
    padding: 2.5rem;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-light);
    transition: all 0.3s ease;
    border: 1px solid rgba(15, 23, 42, 0.05);
}

.practice-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
    border-color: var(--accent-gold);
}

.practice-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-navy) 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    color: var(--white);
    font-size: 1.5rem;
}

.practice-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--primary-navy);
    margin-bottom: 1rem;
}

.practice-description {
    color: var(--neutral-medium);
    line-height: 1.6;
}

/* Firm Story Section */
.firm-story {
    background: var(--neutral-bg);
}

.story-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
    margin-top: 4rem;
}

.story-content h3 {
    font-size: 2rem;
    color: var(--primary-navy);
    margin-bottom: 1.5rem;
}

.story-content p {
    font-size: 1.1rem;
    color: var(--neutral-medium);
    line-height: 1.8;
    margin-bottom: 1.5rem;
}

.story-features {
    list-style: none;
    padding: 0;
    margin-top: 2rem;
}

.story-features li {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    font-size: 1.1rem;
    color: var(--neutral-medium);
}

.story-features li::before {
    content: '✓';
    background: var(--success-green);
    color: var(--white);
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 0.9rem;
    font-weight: 600;
}

.story-image {
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-medium);
}

.story-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
}

/* Values Section */
.values {
    background: var(--white);
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 3rem;
    margin-top: 4rem;
}

.value-card {
    text-align: center;
    padding: 3rem 2rem;
    background: var(--neutral-bg);
    border-radius: var(--border-radius);
    transition: all 0.3s ease;
    border: 1px solid rgba(15, 23, 42, 0.05);
}

.value-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
    background: var(--white);
}

.value-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-orange) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    color: var(--white);
    font-size: 2rem;
}

.value-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-navy);
    margin-bottom: 1rem;
}

.value-description {
    color: var(--neutral-medium);
    line-height: 1.6;
}


/* Contact CTA Section */
.contact-cta {
    background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-orange) 100%);
    color: var(--white);
    text-align: center;
}

.contact-cta h2 {
    color: var(--white);
    margin-bottom: 1rem;
}

.contact-cta p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    opacity: 0.95;
}

.contact-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-white {
    background: var(--white);
    color: var(--primary-navy);
    padding: 18px 36px;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-medium);
}

.btn-white:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-large);
    color: var(--primary-navy);
    text-decoration: none;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .director-grid,
    .story-grid {
        gap: 60px;
    }
}

@media (max-width: 992px) {
    .director-grid,
    .story-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .director-info {
        padding-left: 0;
        text-align: center;
    }
    
    .values-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 3rem;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
    }
    
    .section-title {
        font-size: 2.5rem;
    }
    
    .director-name {
        font-size: 2rem;
    }
    
    .hero-cta,
    .contact-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    
    .practice-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
}

@media (max-width: 480px) {
    .hero-section {
        padding: 80px 0 60px;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .section {
        padding: 80px 0;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .director-name {
        font-size: 1.8rem;
    }
    
    .btn-primary,
    .btn-secondary,
    .btn-white {
        padding: 15px 30px;
        font-size: 1rem;
    }
    
    .practice-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}

/* Breadcrumb */
.breadcrumb-section {
    background: var(--neutral-bg);
    padding: 20px 0;
    border-bottom: 1px solid rgba(15, 23, 42, 0.1);
}

.breadcrumb {
    background: none;
    margin: 0;
    padding: 0;
}

.breadcrumb-item a {
    color: var(--primary-blue);
    text-decoration: none;
    font-weight: 500;
}

.breadcrumb-item a:hover {
    color: var(--accent-gold);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: var(--neutral-medium);
}
</style>

<!-- Breadcrumb Navigation -->
<section class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="hero-title">About Bansal Lawyers</h1>
            <p class="hero-subtitle">Your trusted legal partner in Melbourne, Australia. Led by Director Ajay Bansal, we provide exceptional legal services with integrity, expertise, and unwavering commitment to our clients' success.</p>
            <div class="hero-cta">
                <a href="#director" class="btn-primary">
                    <i class="fa fa-user"></i>
                    Meet Our Director
                </a>
                <a href="/book-an-appointment" class="btn-secondary">
                    <i class="fa fa-phone"></i>
                    Schedule Consultation
                </a>
            </div>
        </div>
    </div>
</section>

<!-- About Director Section -->
<section class="section about-director" id="director">
    <div class="container">
        <h2 class="section-title">Meet Our Director</h2>
        <div class="section-divider"></div>
        
        <div class="director-grid" data-aos="fade-up" data-aos-duration="1000">
            <div class="director-image" data-aos="fade-right" data-aos-duration="1000">
                <img src="{{ asset('images/ajay-bansal2.jpg') }}" alt="Ajay Bansal - Director of Bansal Lawyers">
            </div>
            <div class="director-info" data-aos="fade-left" data-aos-duration="1000">
                <h3 class="director-name">Ajay Bansal</h3>
                <div class="director-title">Director & Principal Lawyer</div>
                <p class="director-description">
                    Ajay Bansal is the founding Director of Bansal Lawyers, bringing over 15 years of comprehensive legal experience to our Melbourne-based practice. His deep understanding of Australian law and commitment to client success has established Bansal Lawyers as a trusted name in the legal community.
                </p>
                <p class="director-description">
                    With expertise spanning Immigration Law, Family Law, Property Law, Commercial Law, and Criminal Law, Ajay has successfully represented hundreds of clients across Australia. His approach combines legal excellence with genuine care for client outcomes, ensuring each case receives the attention and dedication it deserves.
                </p>
                <p class="director-description">
                    Ajay's philosophy centers on providing clear, practical legal advice that empowers clients to make informed decisions. His track record of successful outcomes and satisfied clients speaks to his commitment to excellence in legal practice.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Practice Areas Section -->
<section class="section practice-areas">
    <div class="container">
        <h2 class="section-title">Our Practice Areas</h2>
        <p class="section-subtitle">Comprehensive legal services tailored to meet your specific needs</p>
        <div class="section-divider"></div>
        
        <div class="practice-grid" data-aos="fade-up" data-aos-duration="1000">
            <div class="practice-card" data-aos="fade-up" data-aos-delay="100">
                <div class="practice-icon">
                    <i class="fa fa-globe"></i>
                </div>
                <h3 class="practice-title">Immigration Law</h3>
                <p class="practice-description">Expert guidance on visa applications, citizenship, deportation matters, and all immigration-related legal issues in Australia.</p>
            </div>
            
            <div class="practice-card" data-aos="fade-up" data-aos-delay="200">
                <div class="practice-icon">
                    <i class="fa fa-users"></i>
                </div>
                <h3 class="practice-title">Family Law</h3>
                <p class="practice-description">Compassionate support for divorce, child custody, property settlements, and all family-related legal matters.</p>
            </div>
            
            <div class="practice-card" data-aos="fade-up" data-aos-delay="300">
                <div class="practice-icon">
                    <i class="fa fa-building"></i>
                </div>
                <h3 class="practice-title">Property Law</h3>
                <p class="practice-description">Professional assistance with property transactions, disputes, conveyancing, and real estate legal matters.</p>
            </div>
            
            <div class="practice-card" data-aos="fade-up" data-aos-delay="400">
                <div class="practice-icon">
                    <i class="fa fa-briefcase"></i>
                </div>
                <h3 class="practice-title">Commercial Law</h3>
                <p class="practice-description">Strategic legal advice for business formation, contracts, partnerships, and commercial transactions.</p>
            </div>
            
            <div class="practice-card" data-aos="fade-up" data-aos-delay="500">
                <div class="practice-icon">
                    <i class="fa fa-gavel"></i>
                </div>
                <h3 class="practice-title">Criminal Law</h3>
                <p class="practice-description">Strong defense representation for criminal charges, traffic offenses, and criminal law matters.</p>
            </div>
            
            <div class="practice-card" data-aos="fade-up" data-aos-delay="600">
                <div class="practice-icon">
                    <i class="fa fa-suitcase"></i>
                </div>
                <h3 class="practice-title">Business Law</h3>
                <p class="practice-description">Comprehensive legal services for business operations, compliance, and corporate legal matters.</p>
            </div>
        </div>
    </div>
</section>

<!-- Firm Story Section -->
<section class="section firm-story">
    <div class="container">
        <h2 class="section-title">Our Story</h2>
        <p class="section-subtitle">Building trust through excellence in legal practice</p>
        <div class="section-divider"></div>
        
        <div class="story-grid" data-aos="fade-up" data-aos-duration="1000">
            <div class="story-content" data-aos="fade-right" data-aos-duration="1000">
                <h3>Founded on Principles of Excellence</h3>
                <p>
                    Bansal Lawyers was established with a clear vision: to provide exceptional legal services that prioritize client success and satisfaction. Our firm has grown from a small practice to become one of Melbourne's trusted legal partners.
                </p>
                <p>
                    Located in the heart of Melbourne's legal district at Level 8/278 Collins Street, we serve clients across Australia with dedication and expertise. Our modern approach to legal practice combines traditional values with contemporary solutions.
                </p>
                
                <ul class="story-features">
                    <li>Founded by Director Ajay Bansal with deep expertise in Australian law</li>
                    <li>Specialized focus on Immigration, Family, and Commercial Law</li>
                    <li>Located in Melbourne's premier legal district on Collins Street</li>
                    <li>Multilingual legal services for diverse communities</li>
                    <li>Personalized approach tailored to each client's unique needs</li>
                    <li>Commitment to clear, practical legal advice and client empowerment</li>
                </ul>
            </div>
            <div class="story-image" data-aos="fade-left" data-aos-duration="1000">
                <img src="{{ asset('images/Aboutus.jpg') }}" alt="Bansal Lawyers Office">
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section values">
    <div class="container">
        <h2 class="section-title">Our Core Values</h2>
        <p class="section-subtitle">The principles that guide our practice and define our commitment to you</p>
        <div class="section-divider"></div>
        
        <div class="values-grid" data-aos="fade-up" data-aos-duration="1000">
            <div class="value-card" data-aos="fade-up" data-aos-delay="100">
                <div class="value-icon">
                    <i class="fa fa-balance-scale"></i>
                </div>
                <h3 class="value-title">Integrity</h3>
                <p class="value-description">We uphold the highest ethical standards in all our legal practice, ensuring transparency and honesty in every client interaction.</p>
            </div>
            
            <div class="value-card" data-aos="fade-up" data-aos-delay="200">
                <div class="value-icon">
                    <i class="fa fa-star"></i>
                </div>
                <h3 class="value-title">Excellence</h3>
                <p class="value-description">We are committed to delivering exceptional legal services with meticulous attention to detail and unwavering dedication to quality.</p>
            </div>
            
            <div class="value-card" data-aos="fade-up" data-aos-delay="300">
                <div class="value-icon">
                    <i class="fa fa-users"></i>
                </div>
                <h3 class="value-title">Client Focus</h3>
                <p class="value-description">Your success is our priority. We provide personalized attention and tailored legal solutions to meet your unique needs and goals.</p>
            </div>
        </div>
    </div>
</section>


<!-- Contact CTA Section -->
<section class="section contact-cta">
    <div class="container">
        <h2 class="section-title">Ready to Get Started?</h2>
        <p class="section-subtitle">Contact us today for a consultation and let us help you with your legal needs</p>
        
        <div class="contact-buttons" data-aos="fade-up" data-aos-duration="1000">
            <a href="/contact" class="btn-white">
                <i class="fa fa-envelope"></i>
                Contact Us Today
            </a>
            <a href="/book-an-appointment" class="btn-white">
                <i class="fa fa-calendar"></i>
                Book Appointment
            </a>
        </div>
    </div>
</section>

<script>
// Initialize AOS (Animate On Scroll)
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add hover effects to cards
document.querySelectorAll('.practice-card, .value-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});
</script>

@endsection