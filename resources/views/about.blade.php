@extends('layouts.frontend')

@section('head')
{{-- Critical above-fold about styles + optimized LCP background (WebP) --}}
<link rel="preload" as="image" href="{{ asset('images/Aboutus.webp') }}" type="image/webp" fetchpriority="high">
<style>
.page-about .breadcrumb-section{background:#F9FAFB;padding:20px 0;border-bottom:1px solid rgba(15,23,42,.1)}
.page-about .breadcrumb{background:none;margin:0;padding:0}
.page-about .breadcrumb-item a{color:#1E40AF;text-decoration:none;font-weight:500}
.page-about .breadcrumb-item.active{color:#4B5563}
.page-about .hero-section{background:linear-gradient(135deg,#0F172A 0%,#1E40AF 100%);color:#fff;padding:120px 0;position:relative;overflow:hidden;min-height:100vh;display:flex;align-items:center}
.page-about .hero-section::before{content:'';position:absolute;inset:0;background:url('/images/Aboutus.webp') center/cover;opacity:.15;z-index:1}
.page-about .hero-section::after{content:'';position:absolute;inset:0;background:radial-gradient(circle at 30% 20%,rgba(245,158,11,.1) 0%,transparent 50%),radial-gradient(circle at 70% 80%,rgba(234,88,12,.1) 0%,transparent 50%);z-index:2}
.page-about .hero-content{position:relative;z-index:3;max-width:800px;margin:0 auto;text-align:center}
.page-about .hero-title{font-size:4.5rem;font-weight:700;margin:0 0 1.5rem;line-height:1.2;background:linear-gradient(135deg,#fff 0%,rgba(255,255,255,.9) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;color:transparent}
.page-about .hero-subtitle{font-size:1.4rem;font-weight:400;margin:0 auto 2.5rem;max-width:600px;line-height:1.6;opacity:.95;color:rgba(255,255,255,.95)}
.page-about .hero-cta{display:flex;gap:20px;justify-content:center;flex-wrap:wrap;margin-top:3rem}
@media (max-width:768px){.page-about .hero-title{font-size:3rem}.page-about .hero-subtitle{font-size:1.2rem}}
@media (max-width:480px){.page-about .hero-section{padding:80px 0 60px}.page-about .hero-title{font-size:2.5rem}}
</style>
@vite(['resources/css/pages/about.css'])
@endsection

@section('seoinfo')
<?php 
    // Use dynamic meta title and description from CMS page if available, otherwise use defaults
    $metaTitle = (isset($pagedata->meta_title) && $pagedata->meta_title != "") ? $pagedata->meta_title : "About Bansal Lawyers - Leading Legal Firm in Melbourne | Expert Legal Services";
    $metaDescription = (isset($pagedata->meta_description) && $pagedata->meta_description != "") ? $pagedata->meta_description : "Learn about Bansal Lawyers, Melbourne's trusted legal firm led by Director Ajay Bansal. Expert services in Immigration, Family, Property, and Commercial Law with over 15 years of experience.";
    $metaKeywords = (isset($pagedata->meta_keyward) && $pagedata->meta_keyward != "") ? $pagedata->meta_keyward : "About Bansal Lawyers, Melbourne law firm, Ajay Bansal, legal services Australia, Immigration lawyer Melbourne, Family lawyer, Property lawyer, Commercial lawyer";
?>
<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $metaDescription }}" />
<meta name="keywords" content="{{ $metaKeywords }}" />
<meta name="author" content="Bansal Lawyers" />
<meta name="robots" content="index, follow" />
<meta name="language" content="en-AU" />

<link rel="canonical" href="https://www.bansallawyers.com.au/about" />

<!-- Facebook Meta Tags -->
<meta property="og:url" content="<?php echo URL::to('/'); ?>/about">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:image" content="{{ asset('images/ajay-bansal2.webp') }}">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="bansallawyers.com.au">
<meta property="twitter:url" content="<?php echo URL::to('/'); ?>/about">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta property="twitter:image" content="{{ asset('images/ajay-bansal2.webp') }}">

<!-- Additional SEO Meta Tags -->
<meta name="geo.region" content="AU-VIC">
<meta name="geo.placename" content="Melbourne">
<meta name="geo.position" content="-37.8136;144.9631">
<meta name="ICBM" content="-37.8136, 144.9631">
@endsection

@section('content')

<div class="page-about">

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
                    <x-white-icon name="user" :size="20" />
                    Meet Our Director
                </a>
                <a href="/book-an-appointment" class="btn-secondary">
                    <x-white-icon name="phone" :size="20" />
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
                <img src="{{ asset('images/ajay-bansal2.webp') }}"
                     alt="Ajay Bansal - Director of Bansal Lawyers"
                     width="500"
                     height="600"
                     loading="lazy"
                     decoding="async">
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

<!-- Team Member: Michael Saleh -->
<section class="section team-member-section" id="michael-saleh">
    <div class="container">
        <h2 class="section-title">Meet Our Solicitor</h2>
        <div class="section-divider"></div>

        <div class="team-member-grid" data-aos="fade-up" data-aos-duration="1000">
            <div class="team-member-image" data-aos="fade-right" data-aos-duration="1000">
                <img src="{{ asset('images/michael-saleh.png') }}"
                     alt="Michael Saleh - Solicitor at Bansal Lawyers"
                     width="500"
                     height="600"
                     loading="lazy"
                     decoding="async">
            </div>
            <div class="team-member-info" data-aos="fade-left" data-aos-duration="1000">
                <h3 class="team-member-name">Michael Saleh</h3>
                <div class="team-member-title">Solicitor</div>
                <span class="team-member-badge">
                    <x-white-icon name="badge-check" :size="18" />
                    Admitted &ndash; Supreme Court of Victoria
                </span>
                <p class="team-member-description">
                    Michael Saleh is a dedicated solicitor at Bansal Lawyers, admitted to the Supreme Court of Victoria and holding a Bachelor of Laws and Graduate Diploma of Legal Practice.
                </p>
                <p class="team-member-description">
                    He brings hands-on experience across criminal law, family law, civil litigation, and commercial matters, with appearances in the Magistrates' Court, Federal Circuit and Family Court of Australia, and VCAT.
                </p>
                <p class="team-member-description">
                    Michael is also bilingual in Arabic, allowing him to serve a broader range of clients with clarity and cultural sensitivity.
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
                    <x-white-icon name="globe" :size="28" />
                </div>
                <h3 class="practice-title">Immigration Law</h3>
                <p class="practice-description">Expert guidance on visa applications, citizenship, deportation matters, and all immigration-related legal issues in Australia.</p>
            </div>
            
            <div class="practice-card" data-aos="fade-up" data-aos-delay="200">
                <div class="practice-icon">
                    <x-white-icon name="users" :size="28" />
                </div>
                <h3 class="practice-title">Family Law</h3>
                <p class="practice-description">Compassionate support for divorce, child custody, property settlements, and all family-related legal matters.</p>
            </div>
            
            <div class="practice-card" data-aos="fade-up" data-aos-delay="300">
                <div class="practice-icon">
                    <x-white-icon name="building-2" :size="28" />
                </div>
                <h3 class="practice-title">Property Law</h3>
                <p class="practice-description">Professional assistance with property transactions, disputes, conveyancing, and real estate legal matters.</p>
            </div>
            
            <div class="practice-card" data-aos="fade-up" data-aos-delay="400">
                <div class="practice-icon">
                    <x-white-icon name="briefcase" :size="28" />
                </div>
                <h3 class="practice-title">Commercial Law</h3>
                <p class="practice-description">Strategic legal advice for business formation, contracts, partnerships, and commercial transactions.</p>
            </div>
            
            <div class="practice-card" data-aos="fade-up" data-aos-delay="500">
                <div class="practice-icon">
                    <x-white-icon name="gavel" :size="28" />
                </div>
                <h3 class="practice-title">Criminal Law</h3>
                <p class="practice-description">Strong defense representation for criminal charges, traffic offenses, and criminal law matters.</p>
            </div>
            
            <div class="practice-card" data-aos="fade-up" data-aos-delay="600">
                <div class="practice-icon">
                    <x-white-icon name="briefcase" :size="28" />
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
                <img src="{{ asset('images/Aboutus.jpg') }}"
                     alt="Bansal Lawyers Office"
                     width="800"
                     height="400"
                     loading="lazy"
                     decoding="async">
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
                    <x-white-icon name="scale" :size="36" />
                </div>
                <h3 class="value-title">Integrity</h3>
                <p class="value-description">We uphold the highest ethical standards in all our legal practice, ensuring transparency and honesty in every client interaction.</p>
            </div>
            
            <div class="value-card" data-aos="fade-up" data-aos-delay="200">
                <div class="value-icon">
                    <x-white-icon name="star" :size="36" />
                </div>
                <h3 class="value-title">Excellence</h3>
                <p class="value-description">We are committed to delivering exceptional legal services with meticulous attention to detail and unwavering dedication to quality.</p>
            </div>
            
            <div class="value-card" data-aos="fade-up" data-aos-delay="300">
                <div class="value-icon">
                    <x-white-icon name="users" :size="36" />
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
                <x-white-icon name="mail" :size="20" color="#0F172A" />
                Contact Us Today
            </a>
            <a href="/book-an-appointment" class="btn-white">
                <x-white-icon name="calendar" :size="20" color="#0F172A" />
                Book Appointment
            </a>
        </div>
    </div>
</section>

</div>

@endsection

@section('scripts')
<script>
document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
        var target = document.querySelector(this.getAttribute('href'));
        if (!target) return;
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});
</script>
@endsection
