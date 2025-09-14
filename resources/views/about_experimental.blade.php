@extends('layouts.frontend')

@section('head')
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endsection

@section('seoinfo')
<title>Meet Ajay Bansal - Director of Bansal Lawyers | Melbourne Legal Expert</title>
<meta name="description" content="Meet Ajay Bansal, Director of Bansal Lawyers. Expert legal services in Melbourne for Immigration Law, Family Law, Property disputes, and more. Trusted legal advice in Australia." />
<meta name="keywords" content="Ajay Bansal, Director, Bansal Lawyers, Melbourne lawyer, Immigration lawyer, Family lawyer, Property lawyer, Commercial lawyer, Criminal lawyer, Legal expert Australia" />
<meta name="author" content="Ajay Bansal" />
<meta name="robots" content="index, follow" />

<link rel="canonical" href="<?php echo URL::to('/'); ?>/about" />

<!-- Facebook Meta Tags -->
<meta property="og:url" content="<?php echo URL::to('/'); ?>/about">
<meta property="og:type" content="profile">
<meta property="og:title" content="Meet Ajay Bansal - Director of Bansal Lawyers | Melbourne Legal Expert">
<meta property="og:description" content="Meet Ajay Bansal, Director of Bansal Lawyers. Expert legal services in Melbourne for Immigration Law, Family Law, Property disputes, and more. Trusted legal advice in Australia.">
<meta property="og:image" content="{{ asset('images/ajay-bansal2.jpg') }}">
<meta property="og:image:alt" content="Ajay Bansal - Director of Bansal Lawyers">
<meta property="profile:first_name" content="Ajay">
<meta property="profile:last_name" content="Bansal">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="bansallawyers.com.au">
<meta property="twitter:url" content="<?php echo URL::to('/'); ?>/about">
<meta name="twitter:title" content="Meet Ajay Bansal - Director of Bansal Lawyers | Melbourne Legal Expert">
<meta name="twitter:description" content="Meet Ajay Bansal, Director of Bansal Lawyers. Expert legal services in Melbourne for Immigration Law, Family Law, Property disputes, and more. Trusted legal advice in Australia.">
<meta property="twitter:image" content="{{ asset('images/ajay-bansal2.jpg') }}">
<meta property="twitter:image:alt" content="Ajay Bansal - Director of Bansal Lawyers">

<!-- Additional SEO Meta Tags -->
<meta name="geo.region" content="AU-VIC">
<meta name="geo.placename" content="Melbourne">
<meta name="geo.position" content="-37.8136;144.9631">
<meta name="ICBM" content="-37.8136, 144.9631">
@endsection

@section('content')

<!-- Hidden structured data for SEO -->
<div style="display: none;" itemscope itemtype="https://schema.org/Person">
    <span itemprop="name">Ajay Bansal</span>
    <span itemprop="jobTitle">Director</span>
    <span itemprop="description">Expert legal services in Melbourne for Immigration Law, Family Law, Property disputes, and more. Trusted legal advice in Australia.</span>
    <div itemprop="worksFor" itemscope itemtype="https://schema.org/Organization">
        <span itemprop="name">Bansal Lawyers</span>
        <span itemprop="legalName">Bansal Lawyers</span>
        <span itemprop="url">https://www.bansallawyers.com.au</span>
        <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
            <span itemprop="streetAddress">Level 8/278 Collins Street</span>
            <span itemprop="addressLocality">Melbourne</span>
            <span itemprop="addressRegion">VIC</span>
            <span itemprop="postalCode">3000</span>
            <span itemprop="addressCountry">Australia</span>
        </div>
        <div itemprop="geo" itemscope itemtype="https://schema.org/GeoCoordinates">
            <meta itemprop="latitude" content="-37.8136">
            <meta itemprop="longitude" content="144.9631">
        </div>
        <span itemprop="telephone">+61422905860</span>
        <span itemprop="email">Info@bansallawyers.com.au</span>
        <div itemprop="sameAs">
            <a href="https://www.facebook.com/profile.php?id=61562008576642">Facebook</a>
            <a href="https://www.instagram.com/bansallawyers?igsh=N21ubnVkeDhibjVw">Instagram</a>
            <a href="https://www.linkedin.com/company/bansallawyers">LinkedIn</a>
            <a href="https://twitter.com/BansalLawyers">Twitter</a>
            <a href="https://www.youtube.com/@BansalLawyers">YouTube</a>
        </div>
    </div>
    <div itemprop="knowsAbout">
        <span>Immigration Law</span>
        <span>Family Law</span>
        <span>Property Law</span>
        <span>Commercial Law</span>
        <span>Criminal Law</span>
        <span>Australian Law</span>
    </div>
    <div itemprop="alumniOf" itemscope itemtype="https://schema.org/EducationalOrganization">
        <span itemprop="name">Legal Education Australia</span>
    </div>
</div>

<style>
/* Modern About Page Styles - Out of the Box Design */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --text-dark: #2c3e50;
    --text-light: #7f8c8d;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --shadow: 0 20px 40px rgba(0,0,0,0.1);
    --shadow-hover: 0 30px 60px rgba(0,0,0,0.15);
    --gradient-primary: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
    --gradient-accent: linear-gradient(135deg, #FF6B35 0%, #FF8E53 100%);
}

/* Modern Hero Section with Geometric Patterns */
.modern-hero {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.modern-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset("images/Aboutus.jpg") }}') center/cover;
    opacity: 0.2;
    z-index: 1;
}

.modern-hero::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(255, 107, 53, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 142, 83, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    z-index: 2;
}

.modern-hero .container {
    position: relative;
    z-index: 3;
}

.modern-hero-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.modern-hero h1 {
    font-size: 4rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    background: linear-gradient(45deg, #ffffff, #f0f0f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
}

.modern-hero .subtitle {
    font-size: 1.4rem;
    margin-bottom: 2rem;
    opacity: 0.9;
    font-weight: 300;
    line-height: 1.6;
}

.modern-cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 3rem;
}

.modern-cta-primary {
    background: var(--gradient-accent);
    color: var(--white);
    padding: 18px 40px;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
}

.modern-cta-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(255, 107, 53, 0.4);
    color: var(--white);
    text-decoration: none;
}

.modern-cta-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: var(--white);
    padding: 18px 40px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.modern-cta-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-3px);
    color: var(--white);
    text-decoration: none;
}

/* Floating Elements */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    z-index: 2;
}

.floating-element {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.floating-element:nth-child(1) {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.floating-element:nth-child(2) {
    width: 120px;
    height: 120px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.floating-element:nth-child(3) {
    width: 60px;
    height: 60px;
    top: 40%;
    right: 30%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* About Content Section */
.modern-about-section {
    padding: 100px 0;
    background: var(--bg-light);
    position: relative;
}

.modern-about-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: linear-gradient(180deg, var(--primary-color), transparent);
    opacity: 0.1;
}

.modern-about-content {
    background: var(--white);
    border-radius: 30px;
    padding: 60px;
    box-shadow: var(--shadow);
    margin-bottom: 60px;
    position: relative;
    overflow: hidden;
}

.modern-about-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: var(--gradient-accent);
}

.modern-about-content h2 {
    color: var(--text-dark);
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 3rem;
    text-align: center;
    position: relative;
}

.modern-about-content h2::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: var(--gradient-accent);
    border-radius: 2px;
}

.about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    margin-bottom: 40px;
}

.about-image-container {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow);
}

.about-image-container img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    object-position: center top;
    transition: transform 0.3s ease;
    border-radius: 20px;
}

.about-image-container:hover img {
    transform: scale(1.05);
}

.director-portrait {
    width: 100%;
    height: 500px;
    object-fit: cover;
    object-position: center top;
    border-radius: 20px;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
}

.director-portrait:hover {
    transform: scale(1.02);
    box-shadow: var(--shadow-hover);
}

.about-text-content h3 {
    color: var(--primary-color);
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
    line-height: 1.2;
}

.about-text-content .subheading {
    color: var(--accent-color);
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.about-text-content p {
    color: var(--text-light);
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 2rem;
}

/* Mission, Vision, Values Section */
.mvv-section {
    background: var(--white);
    border-radius: 30px;
    padding: 60px;
    box-shadow: var(--shadow);
    margin-bottom: 60px;
    position: relative;
    overflow: hidden;
}

.mvv-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: var(--gradient-accent);
}

.mvv-section h3 {
    color: var(--text-dark);
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 3rem;
    text-align: center;
    position: relative;
}

.mvv-section h3::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: var(--gradient-accent);
    border-radius: 2px;
}

.mvv-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
    margin-top: 40px;
}

.mvv-card {
    text-align: center;
    padding: 40px 30px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 20px;
    transition: all 0.4s ease;
    position: relative;
    border: 1px solid rgba(27, 77, 137, 0.1);
}

.mvv-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 20px;
}

.mvv-card:hover::before {
    opacity: 0.05;
}

.mvv-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-hover);
    border-color: var(--accent-color);
}

.mvv-card .icon {
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 2rem;
    color: var(--white);
    position: relative;
    z-index: 2;
    transition: all 0.3s ease;
}

.mvv-card:hover .icon {
    background: var(--gradient-accent);
    transform: scale(1.1);
}

.mvv-card h4 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 15px;
    font-size: 1.5rem;
    position: relative;
    z-index: 2;
}

.mvv-card p {
    color: var(--text-light);
    margin: 0;
    line-height: 1.6;
    position: relative;
    z-index: 2;
}

/* Stats Section */
.stats-section {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset("images/Aboutus.jpg") }}') center/cover;
    opacity: 0.1;
    z-index: 1;
}

.stats-section .container {
    position: relative;
    z-index: 2;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
    text-align: center;
}

.stat-item {
    padding: 30px 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
}

.stat-number {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 10px;
    color: var(--accent-color);
}

.stat-label {
    font-size: 1.1rem;
    font-weight: 600;
    opacity: 0.9;
}

/* Responsive Design */
@media (max-width: 992px) {
    .about-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .mvv-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
}

@media (max-width: 768px) {
    .modern-hero h1 {
        font-size: 2.5rem;
    }
    
    .modern-hero .subtitle {
        font-size: 1.1rem;
    }
    
    .modern-cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .modern-about-content,
    .mvv-section {
        padding: 40px 25px;
    }
    
    .about-text-content h3 {
        font-size: 2rem;
    }
    
    .modern-about-content h2,
    .mvv-section h3 {
        font-size: 2rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .stat-number {
        font-size: 2.5rem;
    }
}

@media (max-width: 480px) {
    .modern-hero {
        padding: 80px 0 60px;
    }
    
    .modern-hero h1 {
        font-size: 2rem;
    }
    
    .modern-about-content,
    .mvv-section {
        padding: 30px 20px;
    }
    
    .about-text-content h3 {
        font-size: 1.8rem;
    }
    
    .modern-about-content h2,
    .mvv-section h3 {
        font-size: 1.8rem;
    }
    
    .mvv-card {
        padding: 30px 20px;
    }
    
    .stat-item {
        padding: 25px 15px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}
</style>

<!-- Modern Hero Section -->
<section class="modern-hero">
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>
    <div class="container">
        <div class="modern-hero-content" data-aos="fade-up" data-aos-duration="1000">
            <h1>Meet Ajay Bansal</h1>
            <p class="subtitle">Director of Bansal Lawyers - Your trusted legal expert in Melbourne, Australia. Committed to providing exceptional legal services with clear, satisfied legal advice.</p>
            <div class="modern-cta-buttons">
                <a href="#about-content" class="modern-cta-primary">
                    <i class="fa fa-user"></i>
                    Learn More About Us
                </a>
                <a href="/contact" class="modern-cta-secondary">
                    <i class="fa fa-phone"></i>
                    Schedule Consultation
                </a>
            </div>
        </div>
    </div>
</section>

<!-- About Content Section -->
<section class="modern-about-section" id="about-content">
    <div class="container">
        <div class="modern-about-content" data-aos="fade-up" data-aos-duration="1000">
            <h2>Welcome to Bansal Lawyers</h2>
            <div class="about-grid">
                <div class="about-image-container" data-aos="fade-right" data-aos-duration="1000" itemscope itemtype="https://schema.org/Person">
                    <img src="{{ asset('images/ajay-bansal2.jpg') }}" alt="Ajay Bansal - Director of Bansal Lawyers" class="director-portrait" itemprop="image">
                </div>
                <div class="about-text-content" data-aos="fade-left" data-aos-duration="1000" itemscope itemtype="https://schema.org/Person">
                    <div class="subheading">Meet Our Director</div>
                    <h3 itemprop="name">MEET AJAY BANSAL – DIRECTOR OF BANSAL LAWYERS</h3>
                    <p itemprop="description">Meet our Director <span itemprop="name">AJAY BANSAL</span> of Bansal Lawyers your trusted legal expert in Melbourne, Australia. With years of professional experience in legal field in Australia, <span itemprop="name">Ajay Bansal</span> is committed to provide legal services to individuals, family, & business across Australia. He knows to get results in all legal issues in Australia like Immigration Law, Family Law, Property disputes, and many more legal services etc.</p>
                    <p><span itemprop="jobTitle">Director</span> Ajay is known for providing best solution in legal issues in Australia, he always focused to provide clients clear and satisfied legal advice makes him one of the top lawyers in Melbourne. He had a knowledge of Australian Law which helps him to make positive commitment with client for providing best results and solution outcome.</p>
                </div>
            </div>
        </div>

        <!-- Mission, Vision, Values Section -->
        <div class="mvv-section" data-aos="fade-up" data-aos-duration="1000" itemscope itemtype="https://schema.org/Organization">
            <h3 itemprop="name">Our Foundation</h3>
            <div class="mvv-grid">
                <div class="mvv-card" data-aos="fade-up" data-aos-delay="100" itemscope itemtype="https://schema.org/Thing">
                    <div class="icon">
                        <i class="fa fa-bullseye"></i>
                    </div>
                    <h4 itemprop="name">Our Mission</h4>
                    <p itemprop="description">At Bansal Lawyers, our mission is to offer best legal services that help to protect rights of our client. If you need a legal advice and representation, we are here to help you with our experienced team of lawyers.</p>
                </div>
                <div class="mvv-card" data-aos="fade-up" data-aos-delay="200" itemscope itemtype="https://schema.org/Thing">
                    <div class="icon">
                        <i class="fa fa-eye"></i>
                    </div>
                    <h4 itemprop="name">Our Vision</h4>
                    <p itemprop="description">To be the leading law firm in Melbourne, providing exceptional legal services with integrity, professionalism, and dedication to achieving the best outcomes for our clients.</p>
                </div>
                <div class="mvv-card" data-aos="fade-up" data-aos-delay="300" itemscope itemtype="https://schema.org/Thing">
                    <div class="icon">
                        <i class="fa fa-heart"></i>
                    </div>
                    <h4 itemprop="name">Our Values</h4>
                    <p itemprop="description">We uphold the highest standards of legal practice, ensuring transparency, client satisfaction, and continuous improvement in all our legal services across Australia.</p>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section" data-aos="fade-up" data-aos-duration="1000" itemscope itemtype="https://schema.org/Organization">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="100" itemscope itemtype="https://schema.org/QuantitativeValue">
                        <div class="stat-number" itemprop="value">500+</div>
                        <div class="stat-label" itemprop="name">Cases Won</div>
                    </div>
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="200" itemscope itemtype="https://schema.org/QuantitativeValue">
                        <div class="stat-number" itemprop="value">15+</div>
                        <div class="stat-label" itemprop="name">Years Experience</div>
                    </div>
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="300" itemscope itemtype="https://schema.org/QuantitativeValue">
                        <div class="stat-number" itemprop="value">1000+</div>
                        <div class="stat-label" itemprop="name">Happy Clients</div>
                    </div>
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="400" itemscope itemtype="https://schema.org/QuantitativeValue">
                        <div class="stat-number" itemprop="value">24/7</div>
                        <div class="stat-label" itemprop="name">Legal Support</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern Footer Section -->
<footer class="modern-footer" role="contentinfo" itemscope itemtype="https://schema.org/LegalService">
    <div class="container">
        <div class="footer-content">
            <!-- Company Information & Social Media -->
            <div class="footer-column">
                <div class="company-info" itemprop="name">
                    <h2 class="company-name" itemprop="legalName">BANSAL LAWYERS</h2>
                    <p class="company-tagline">A LAW FIRM</p>
                    <p class="company-description" itemprop="description">Professional legal services provided with expertise and care in Melbourne and beyond. Specializing in Immigration Law, Family Law, Property Law, Commercial Law, and Criminal Law.</p>
                </div>
                <div class="social-media">
                    <a href="https://www.facebook.com/profile.php?id=61562008576642" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/bansallawyers?igsh=N21ubnVkeDhibjVw" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Instagram">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/bansallawyers" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="LinkedIn">
                        <i class="fa fa-linkedin"></i>
                    </a>
                    <a href="https://twitter.com/BansalLawyers" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="X (Twitter)">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="https://www.youtube.com/@BansalLawyers" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="YouTube">
                        <i class="fa fa-youtube-play"></i>
                    </a>
                </div>
            </div>

            <!-- Practice Areas -->
            <div class="footer-column">
                <h3 class="footer-heading">Practice Areas</h3>
                <ul class="footer-links" itemscope itemtype="https://schema.org/Service">
                    <li><a href="/family-law" itemprop="url"><i class="fa fa-arrow-right"></i> <span itemprop="name">Family Law</span></a></li>
                    <li><a href="/migration-law" itemprop="url"><i class="fa fa-arrow-right"></i> <span itemprop="name">Migration Law</span></a></li>
                    <li><a href="/criminal-law" itemprop="url"><i class="fa fa-arrow-right"></i> <span itemprop="name">Criminal Law</span></a></li>
                    <li><a href="/commercial-law" itemprop="url"><i class="fa fa-arrow-right"></i> <span itemprop="name">Commercial Law</span></a></li>
                    <li><a href="/property-law" itemprop="url"><i class="fa fa-arrow-right"></i> <span itemprop="name">Property Law</span></a></li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="footer-column">
                <h3 class="footer-heading">Have a Question?</h3>
                <div class="contact-info" itemscope itemtype="https://schema.org/PostalAddress">
                    <div class="contact-item">
                        <i class="fa fa-map-marker"></i>
                        <a href="https://g.co/kgs/Hw16bN8" target="_blank" rel="noopener noreferrer" itemprop="url">
                            <span itemprop="streetAddress">Level 8/278 Collins Street</span><br>
                            <span itemprop="addressLocality">Melbourne</span> <span itemprop="addressRegion">VIC</span> <span itemprop="postalCode">3000</span><br>
                            <span itemprop="addressCountry">Australia</span>
                        </a>
                    </div>
                    <div class="contact-item">
                        <i class="fa fa-phone"></i>
                        <a href="tel:+61422905860" itemprop="telephone">(+61) 0422 905 860</a>
                    </div>
                    <div class="contact-item">
                        <i class="fa fa-phone"></i>
                        <span itemprop="telephone">1300 BANSAL<br>(1300 226 725)</span>
                    </div>
                    <div class="contact-item">
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:Info@bansallawyers.com.au" itemprop="email">Info@bansallawyers.com.au</a>
                    </div>
                </div>
            </div>

            <!-- Business Hours -->
            <div class="footer-column">
                <h3 class="footer-heading">Business Hours</h3>
                <div class="business-hours" itemscope itemtype="https://schema.org/OpeningHoursSpecification">
                    <div class="hours-section">
                        <h4>Opening Hours:</h4>
                        <p itemprop="dayOfWeek" content="Monday,Tuesday,Wednesday,Thursday,Friday">Monday - Friday: <time itemprop="opens" content="10:00">10:00 AM</time> to <time itemprop="closes" content="17:30">5:30 PM</time></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom">
            <p>&copy; 2025 All rights reserved | Bansal Lawyers</p>
        </div>
    </div>
</footer>

<style>
/* Modern Footer Styles - Optimized for Performance */
.modern-footer {
    background: linear-gradient(135deg, #1B4D89 0%, #2C5F8A 100%);
    color: #ffffff;
    padding: 50px 0 20px;
    position: relative;
}

.footer-content {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 30px;
    margin-bottom: 30px;
}

.footer-column {
    padding: 0 15px;
}

.company-info {
    margin-bottom: 30px;
}

.company-name {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 8px;
    color: #ffffff;
    line-height: 1.2;
}

.company-tagline {
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 15px;
    color: #ffffff;
    opacity: 0.9;
}

.company-description {
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 0;
    color: #ffffff;
    opacity: 0.8;
}

.social-media {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.social-icon {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 1rem;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.social-icon:hover {
    background: #FF6B35;
    color: #ffffff;
    text-decoration: none;
}

.footer-heading {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #ffffff;
    position: relative;
}

.footer-heading::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 30px;
    height: 2px;
    background: #FF6B35;
    border-radius: 1px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: #ffffff;
    text-decoration: none;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: color 0.3s ease;
    opacity: 0.8;
}

.footer-links a:hover {
    color: #FF6B35;
    opacity: 1;
    text-decoration: none;
}

.footer-links a i {
    font-size: 0.7rem;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    color: #ffffff;
    opacity: 0.8;
}

.contact-item i {
    font-size: 1rem;
    color: #FF6B35;
    margin-top: 2px;
    flex-shrink: 0;
}

.contact-item a {
    color: #ffffff;
    text-decoration: none;
    transition: color 0.3s ease;
    line-height: 1.4;
    font-size: 0.9rem;
}

.contact-item a:hover {
    color: #FF6B35;
    text-decoration: none;
}

.contact-item span {
    line-height: 1.4;
    font-size: 0.9rem;
}

.business-hours {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.hours-section h4 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 6px;
    color: #ffffff;
}

.hours-section p {
    margin: 0;
    color: #ffffff;
    opacity: 0.8;
    font-size: 0.85rem;
    line-height: 1.4;
}

.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    padding-top: 20px;
    text-align: center;
}

.footer-bottom p {
    margin: 0;
    color: var(--white);
    opacity: 0.7;
    font-size: 0.9rem;
}

/* Responsive Design - Optimized */
@media (max-width: 992px) {
    .footer-content {
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }
    
    .company-name {
        font-size: 1.8rem;
    }
}

@media (max-width: 768px) {
    .modern-footer {
        padding: 35px 0 15px;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .company-name {
        font-size: 1.6rem;
    }
    
    .social-media {
        justify-content: center;
    }
    
    .footer-heading {
        font-size: 1.1rem;
    }
}

@media (max-width: 480px) {
    .modern-footer {
        padding: 25px 0 10px;
    }
    
    .company-name {
        font-size: 1.4rem;
    }
    
    .company-tagline {
        font-size: 0.9rem;
    }
    
    .social-icon {
        width: 35px;
        height: 35px;
        font-size: 0.9rem;
    }
    
    .footer-heading {
        font-size: 1rem;
    }
}
</style>

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

// Smooth scrolling for CTA buttons
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
document.querySelectorAll('.mvv-card, .stat-item').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-10px)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});
</script>

@endsection
