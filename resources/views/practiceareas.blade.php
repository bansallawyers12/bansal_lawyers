@extends('layouts.frontend')

@section('seoinfo')
<?php
    $metaTitle = (isset($pagedata->meta_title) && $pagedata->meta_title != "") ? $pagedata->meta_title : "Immigration, family and more lawyers consultation in Melbourne";
    $metaDescription = (isset($pagedata->meta_description) && $pagedata->meta_description != "") ? $pagedata->meta_description : "If you are looking expert lawyers consultation in Melbourne? Get professional legal advice from experienced lawyers to guide you legal challenges with confidence.";
    $metaKeywords = (isset($pagedata->meta_keyward) && $pagedata->meta_keyward != "") ? $pagedata->meta_keyward : "Discover trusted legal services in Australia with Bansal Lawyers. Specializing in family law, immigration, property disputes, and more. Get expert legal help today!";
?>
<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $metaDescription }}" />
<meta name="keyword" content="{{ $metaKeywords }}" />

<link rel="canonical" href="https://www.bansallawyers.com.au/practice-areas" />

<meta property="og:url" content="<?php echo URL::to('/'); ?>/practice-areas">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="og:image:alt" content="Bansal Lawyers Logo">

<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="bansallawyers.com.au">
<meta property="twitter:url" content="<?php echo URL::to('/'); ?>/practice-areas">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="twitter:image:alt" content="Bansal Lawyers Logo">
@endsection

@section('preload')
{{-- Mobile Lighthouse LCP --}}
<link rel="preload" as="image" href="{{ asset('images/PracticeArea-mobile.webp') }}" type="image/webp" media="(max-width: 767px)" fetchpriority="high">
<link rel="preload" as="image" href="{{ asset('images/PracticeArea.webp') }}" type="image/webp" media="(min-width: 768px)" fetchpriority="high">
@endsection

@section('head')
<style>
/* Critical ATF hero — freezes layout before deferred CSS */
.page-practice-areas .hero-section{position:relative;color:#fff;text-align:center;overflow:hidden;margin-bottom:40px;max-height:422px!important;height:422px;background-color:#1a1a1a}
.page-practice-areas .hero-section__media{position:absolute;inset:0;z-index:0}
.page-practice-areas .hero-section__media img{width:100%!important;height:100%!important;object-fit:cover!important;object-position:center!important;display:block!important;max-width:none!important}
.page-practice-areas .hero-section .overlay{position:absolute;inset:0;background:rgba(0,0,0,.3);z-index:1;pointer-events:none}
.page-practice-areas .hero-section__inner{position:relative;z-index:2;height:100%;max-width:1200px;margin:0 auto;padding:0 20px;box-sizing:border-box;display:flex;align-items:flex-end;justify-content:center}
.page-practice-areas .hero-section__copy{padding-bottom:3rem;text-align:center;width:100%;max-width:800px}
.page-practice-areas .hero-section .bread{font-size:3rem;font-weight:700;color:#fff;margin:0 0 1rem;text-shadow:2px 2px 4px rgba(0,0,0,.5);line-height:1.2}
.page-practice-areas .hero-section .breadcrumbs{color:#fff;font-size:1rem;opacity:.9;margin:0}
.page-practice-areas .hero-section .breadcrumbs a{color:#fff;text-decoration:none}
@media (max-width:768px){.page-practice-areas .hero-section{height:320px;max-height:320px!important}.page-practice-areas .hero-section .bread{font-size:2.5rem}.page-practice-areas .hero-section__copy{padding-bottom:2rem}}
@media (max-width:480px){.page-practice-areas .hero-section{height:260px;max-height:260px!important}.page-practice-areas .hero-section .bread{font-size:2rem}}
</style>
@vite(['resources/css/pages/practice-areas.css'])
@endsection

@section('content')
<div class="page-practice-areas">

<!-- Hero Section -->
<section class="hero-section">
    <picture class="hero-section__media">
        <source media="(min-width: 768px)" srcset="{{ asset('images/PracticeArea.webp') }}" type="image/webp">
        <img src="{{ asset('images/PracticeArea-mobile.webp') }}"
             alt="Bansal Lawyers practice areas"
             width="800"
             height="250"
             fetchpriority="high"
             decoding="sync">
    </picture>
    <div class="overlay"></div>
    <div class="hero-section__inner">
        <div class="hero-section__copy">
            <h1 class="bread">Practice Areas</h1>
            <p class="breadcrumbs">
                <span class="mr-2"><a href="/">Home <i data-lucide="arrow-right" aria-hidden="true"></i></a></span>
                <span>Practice Areas <i data-lucide="arrow-right" aria-hidden="true"></i></span>
            </p>
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
        <div class="practice-card fade-in">
            <div class="card-icon">
                <img src="{{ asset('images/family-law.png') }}" alt="Compassionate Legal Support for Family Law Cases" width="40" height="40" loading="lazy" decoding="async">
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
            <a href="/family-law" class="card-button">Learn more about Family Law</a>
        </div>

        <div class="practice-card fade-in">
            <div class="card-icon">
                <img src="{{ asset('images/immigration-law.png') }}" alt="Expert Immigration Lawyers Helping You Settle in Australia" width="40" height="40" loading="lazy" decoding="async">
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
            <a href="/migration-law" class="card-button">Learn more about Migration Law</a>
        </div>

        <div class="practice-card fade-in">
            <div class="card-icon">
                <img src="{{ asset('images/criminal-law.png') }}" alt="Expert Criminal Defense Lawyers in Melbourne" width="40" height="40" loading="lazy" decoding="async">
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
            <a href="/criminal-law" class="card-button">Learn more about Criminal Law</a>
        </div>

        <div class="practice-card fade-in">
            <div class="card-icon">
                <img src="{{ asset('images/commercial-law.png') }}" alt="Expert Commercial Lawyers in Melbourne" width="40" height="40" loading="lazy" decoding="async">
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
            <a href="/commercial-law" class="card-button">Learn more about Commercial Law</a>
        </div>

        <div class="practice-card fade-in">
            <div class="card-icon">
                <img src="{{ asset('images/property-law.png') }}" alt="Expert Property Lawyers in Melbourne" width="40" height="40" loading="lazy" decoding="async">
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
            <a href="/property-law" class="card-button">Learn more about Property Law</a>
        </div>
    </div>

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

    <div class="cta-section fade-in">
        <h2 class="cta-title">Get Expert Legal Help Today</h2>
        <p class="cta-description">Discover trusted legal services in Australia with Bansal Lawyers. Specializing in family law, immigration, property disputes, and more. Get professional legal advice from experienced lawyers to guide you through legal challenges with confidence.</p>
        <div class="cta-buttons">
            <a href="/contact" class="cta-button primary">Get Free Consultation</a>
            <a href="/about" class="cta-button secondary">Learn About Us</a>
        </div>
    </div>
</section>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.page-practice-areas .fade-in, .page-practice-areas .slide-in-left, .page-practice-areas .slide-in-right').forEach(function (el) {
        observer.observe(el);
    });

    setTimeout(function () {
        document.querySelectorAll('.page-practice-areas .fade-in, .page-practice-areas .slide-in-left, .page-practice-areas .slide-in-right').forEach(function (el) {
            var rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0 && !el.classList.contains('visible')) {
                el.classList.add('visible');
            }
        });
    }, 100);
});
</script>
@endsection
