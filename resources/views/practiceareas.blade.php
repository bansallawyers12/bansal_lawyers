@extends('layouts.frontend')
@section('seoinfo')
	<title>Immigration, family and more lawyers consultation in Melbourne</title>
	<meta name="description" content="If you are looking expert lawyers consultation in Melbourne? Get professional legal advice from experienced lawyers to guide you legal challenges with confidence." />

    <meta name="keyword" content="Discover trusted legal services in Australia with Bansal Lawyers. Specializing in family law, immigration, property disputes, and more. Get expert legal help today!" />

    <link rel="canonical" href="https://www.bansallawyers.com.au/practice-areas" />

	<!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/practice-areas">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Legal Services in Australia | Family, Immigration, Property & More">
    <meta property="og:description" content="Discover trusted legal services in Australia with Bansal Lawyers. Specializing in family law, immigration, property disputes, and more. Get expert legal help today!">
    <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="og:image:alt" content="Bansal Lawyers Logo">


	<!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/practice-areas">
    <meta name="twitter:title" content="Legal Services in Australia | Family, Immigration, Property & More">
    <meta name="twitter:description" content="Discover trusted legal services in Australia with Bansal Lawyers. Specializing in family law, immigration, property disputes, and more. Get expert legal help today!">
    <meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="twitter:image:alt" content="Bansal Lawyers Logo">

@endsection

@section('content')
<style>
    /* Modern CSS Reset and Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        line-height: 1.6;
        color: #1a1a1a;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }

    /* Hero Section */
    .hero-section {
        background-image: url('{{ asset('images/PracticeArea.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        padding: 80px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin-bottom: 40px;
        max-height: 422px !important;
    }

    .hero-section .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .hero-section .slider-text {
        height: 422px;
        display: flex;
        align-items: end;
        justify-content: center;
    }

    .hero-section .bread {
        font-size: 3rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-section .breadcrumbs {
        color: white;
        font-size: 1rem;
        opacity: 0.9;
    }

    .hero-section .breadcrumbs a {
        color: white;
        text-decoration: none;
        transition: opacity 0.3s ease;
    }

    .hero-section .breadcrumbs a:hover {
        opacity: 0.7;
        color: white;
        text-decoration: none;
    }

    /* Practice Areas Grid */
    .practice-areas-section {
        padding: 80px 0;
        max-width: 1400px;
        margin: 0 auto;
        padding-left: 20px;
        padding-right: 20px;
    }

    .section-title {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 1rem;
    }

    .section-title p {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 600px;
        margin: 0 auto;
    }

    .practice-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
    }

    .practice-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .practice-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #1e40af);
    }

    .practice-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .card-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease;
    }

    .practice-card:hover .card-icon {
        transform: scale(1.1);
    }

    .card-icon img {
        width: 40px;
        height: 40px;
        /* Removed filter - icons are already light colored */
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .card-description {
        color: #64748b;
        margin-bottom: 1.5rem;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .card-features {
        list-style: none;
        margin-bottom: 2rem;
    }

    .card-features li {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        color: #475569;
    }

    .card-features li::before {
        content: '✓';
        color: #10b981;
        font-weight: bold;
        margin-right: 0.5rem;
        font-size: 1rem;
    }

    .card-button {
        display: inline-block;
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        color: white;
        padding: 12px 24px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-button:hover {
        background: linear-gradient(135deg, #1e40af, #1e3a8a);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        color: white;
        text-decoration: none;
    }

    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 60px 0;
        margin: 60px 0;
        border-radius: 20px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        text-align: center;
    }

    .stat-item h3 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        background: linear-gradient(45deg, #ffffff, #e0e7ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-item p {
        font-size: 1.1rem;
        opacity: 0.9;
        font-weight: 300;
    }

    /* CTA Section */
    .cta-section {
        background: white;
        padding: 60px 0;
        text-align: center;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin: 60px 0;
    }

    .cta-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 1rem;
    }

    .cta-description {
        font-size: 1.1rem;
        color: #64748b;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .cta-button {
        display: inline-block;
        padding: 15px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .cta-button.primary {
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        color: white;
    }

    .cta-button.primary:hover {
        background: linear-gradient(135deg, #1e40af, #1e3a8a);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        color: white;
        text-decoration: none;
    }

    .cta-button.secondary {
        background: transparent;
        color: #3b82f6;
        border: 2px solid #3b82f6;
    }

    .cta-button.secondary:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .practice-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .practice-card {
            padding: 1.5rem;
        }

        .section-title h2 {
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }

        .cta-button {
            width: 100%;
            max-width: 300px;
        }
    }

    @media (max-width: 480px) {
        .hero-section {
            padding: 60px 0;
        }

        .hero-title {
            font-size: 2rem;
        }

        .practice-areas-section {
            padding: 60px 0;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Animation Classes */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .slide-in-left {
        opacity: 0;
        transform: translateX(-50px);
        transition: all 0.6s ease;
    }

    .slide-in-left.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .slide-in-right {
        opacity: 0;
        transform: translateX(50px);
        transition: all 0.6s ease;
    }

    .slide-in-right.visible {
        opacity: 1;
        transform: translateX(0);
    }
</style>

<!-- Hero Section -->
<section class="hero-section" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">Practice Areas</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Practice Areas <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Practice Areas Section -->
<section class="practice-areas-section">
    <div class="section-title fade-in">
        <h2>Expert Legal Services in Melbourne</h2>
        <p>If you are looking for expert lawyers consultation in Melbourne? Get professional legal advice from experienced lawyers to guide you through legal challenges with confidence.</p>
    </div>

    <div class="practice-grid">
        <!-- Family Law Card -->
        <div class="practice-card fade-in">
            <div class="card-icon">
                <img src="{{ asset('images/family-law.png') }}" alt="Compassionate Legal Support for Family Law Cases" loading="lazy">
            </div>
            <h3 class="card-title">Family Law</h3>
            <p class="card-description">Divorce, separation, children, property and other family law matters. Expert family lawyers in Melbourne providing compassionate legal support.</p>
            <ul class="card-features">
                <li>Divorce & Separation</li>
                <li>Child Custody & Support</li>
                <li>Property Settlement</li>
                <li>Family Violence Orders</li>
                <li>De Facto Relationships</li>
            </ul>
            <a href="/family-law" class="card-button">Learn More</a>
        </div>

        <!-- Migration Law Card -->
        <div class="practice-card fade-in">
            <div class="card-icon">
                <img src="{{ asset('images/immigration-law.png') }}" alt="Expert Immigration Lawyers Helping You Settle in Australia" loading="lazy">
            </div>
            <h3 class="card-title">Migration Law</h3>
            <p class="card-description">The Court can review some decisions made under the Migration Act 1958. Expert immigration lawyers helping you settle in Australia.</p>
            <ul class="card-features">
                <li>Visa Applications</li>
                <li>Appeals & Reviews</li>
                <li>Permanent Residency</li>
                <li>Citizenship</li>
                <li>Visa Compliance</li>
            </ul>
            <a href="/migration-law" class="card-button">Learn More</a>
        </div>

        <!-- Criminal Law Card -->
        <div class="practice-card fade-in">
            <div class="card-icon">
                <img src="{{ asset('images/criminal-law.png') }}" alt="Expert Criminal Defense Lawyers in Melbourne" loading="lazy">
            </div>
            <h3 class="card-title">Criminal Law</h3>
            <p class="card-description">Bankruptcy, fair work, human rights, consumer, admiralty, administrative and IP. Expert criminal lawyers in Melbourne providing strong defense representation.</p>
            <ul class="card-features">
                <li>Assault Charges</li>
                <li>Traffic Offences</li>
                <li>Drink Driving</li>
                <li>Drug Offences</li>
                <li>Court Representation</li>
            </ul>
            <a href="/criminal-law" class="card-button">Learn More</a>
        </div>

        <!-- Commercial Law Card -->
        <div class="practice-card fade-in">
            <div class="card-icon">
                <img src="{{ asset('images/commercial-law.png') }}" alt="Expert Commercial Lawyers in Melbourne" loading="lazy">
            </div>
            <h3 class="card-title">Commercial Law</h3>
            <p class="card-description">From Buying and Leasing to Dispute Resolution – Trusted Legal Guidance for All Your Property Matters. Expert commercial lawyers in Melbourne.</p>
            <ul class="card-features">
                <li>Business Formation</li>
                <li>Contract Law</li>
                <li>Corporate Governance</li>
                <li>Intellectual Property</li>
                <li>Dispute Resolution</li>
            </ul>
            <a href="/commercial-law" class="card-button">Learn More</a>
        </div>

        <!-- Property Law Card -->
        <div class="practice-card fade-in">
            <div class="card-icon">
                <img src="{{ asset('images/property-law.png') }}" alt="Expert Property Lawyers in Melbourne" loading="lazy">
            </div>
            <h3 class="card-title">Property Law</h3>
            <p class="card-description">Smart Legal Solutions for Smart Businesses – Simplifying Contracts, Mergers, Disputes, and Compliance. Expert property lawyers in Melbourne.</p>
            <ul class="card-features">
                <li>Residential & Commercial</li>
                <li>Property Leasing</li>
                <li>Development & Subdivisions</li>
                <li>Strata & Community Titles</li>
                <li>Property Disputes</li>
            </ul>
            <a href="/property-law" class="card-button">Learn More</a>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section fade-in">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>500+</h3>
                    <p>Cases Successfully Resolved</p>
                </div>
                <div class="stat-item">
                    <h3>15+</h3>
                    <p>Years of Legal Experience</p>
                </div>
                <div class="stat-item">
                    <h3>98%</h3>
                    <p>Client Satisfaction Rate</p>
                </div>
                <div class="stat-item">
                    <h3>24/7</h3>
                    <p>Legal Support Available</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section fade-in">
        <h2 class="cta-title">Get Expert Legal Help Today</h2>
        <p class="cta-description">Discover trusted legal services in Australia with Bansal Lawyers. Specializing in family law, immigration, property disputes, and more. Get professional legal advice from experienced lawyers to guide you through legal challenges with confidence.</p>
        <div class="cta-buttons">
            <a href="/contact" class="cta-button primary">Get Free Consultation</a>
            <a href="/about" class="cta-button secondary">Learn About Us</a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right').forEach(el => {
        observer.observe(el);
    });

    // Force immediate visibility check for elements already in viewport
    setTimeout(function() {
        document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right').forEach(el => {
            const rect = el.getBoundingClientRect();
            const isInViewport = rect.top < window.innerHeight && rect.bottom > 0;
            if (isInViewport && !el.classList.contains('visible')) {
                el.classList.add('visible');
            }
        });
    }, 100);

    // Add staggered animation to practice cards
    const practiceCards = document.querySelectorAll('.practice-card');
    practiceCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // Smooth scroll for anchor links
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
    practiceCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>

@endsection
