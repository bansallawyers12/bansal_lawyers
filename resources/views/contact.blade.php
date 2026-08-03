@extends('layouts.frontend')

@section('seoinfo')
	<title>Legal Help in Melbourne | Best Law Firm – Bansal Lawyers - Modern</title>
    <meta name="description" content="Contact Bansal Lawyers, one of the best law firms in Melbourne, Australia, for expert legal assistance. Our skilled team specializes in divorce, visa applications, real estate matters, and more. .Reach out today!" />

    <link rel="canonical" href="https://www.bansallawyers.com.au/contact" />
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/contact">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Get Expert Legal Assistance from Best law firms in Melbourne Australia | Bansal Lawyers">
    <meta property="og:description" content="Contact Bansal Lawyers, one of the best law firms in Melbourne, Australia, for expert legal assistance. Our skilled team specializes in divorce, visa applications, real estate matters, and more. .Reach out today!">
    <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="og:image:alt" content="Bansal Lawyers Logo">

    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/contact">
    <meta name="twitter:title" content="Get Expert Legal Assistance from Best law firms in Melbourne Australia | Bansal Lawyers">
    <meta name="twitter:description" content="Contact Bansal Lawyers, one of the best law firms in Melbourne, Australia, for expert legal assistance. Our skilled team specializes in divorce, visa applications, real estate matters, and more. .Reach out today!">
    <meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="twitter:image:alt" content="Bansal Lawyers Logo">
@endsection

@section('preload')
<link rel="preload" as="image" href="{{ asset('images/Contactus.webp') }}" type="image/webp" fetchpriority="high">
@endsection

@section('head')
{{-- Critical ATF only — full page CSS deferred; LCP is hero (WebP, preloaded) --}}
<style>
.page-contact .modern-hero{background:linear-gradient(135deg,#1B4D89 0%,#2c5aa0 100%);color:#fff;padding:120px 0 80px;position:relative;overflow:hidden;min-height:100vh;display:flex;align-items:center}
.page-contact .modern-hero::before{content:'';position:absolute;inset:0;background:url('/images/Contactus.webp') center/cover;opacity:.2;z-index:1}
.page-contact .modern-hero::after{content:'';position:absolute;inset:0;background:radial-gradient(circle at 20% 80%,rgba(255,107,53,.3) 0%,transparent 50%),radial-gradient(circle at 80% 20%,rgba(255,142,83,.3) 0%,transparent 50%),radial-gradient(circle at 40% 40%,rgba(255,255,255,.1) 0%,transparent 50%);z-index:2}
.page-contact .modern-hero .container{position:relative;z-index:3}
.page-contact .modern-hero-content{text-align:center;max-width:800px;margin:0 auto}
.page-contact .modern-hero h1{font-size:4rem;font-weight:800;margin:0 0 1.5rem;line-height:1.2;background:linear-gradient(45deg,#fff,#f0f0f0);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;color:transparent}
.page-contact .modern-hero .subtitle{font-size:1.4rem;margin:0 0 2rem;opacity:.9;font-weight:300;line-height:1.6}
.page-contact .modern-cta-buttons{display:flex;gap:20px;justify-content:center;flex-wrap:wrap;margin-top:3rem}
.page-contact .modern-cta-primary{background:linear-gradient(135deg,#FF6B35,#FF8E53);color:#fff;padding:18px 40px;border-radius:50px;font-size:1.1rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:10px;box-shadow:0 8px 25px rgba(255,107,53,.3)}
.page-contact .modern-cta-secondary{background:rgba(255,255,255,.1);color:#fff;padding:18px 40px;border:2px solid rgba(255,255,255,.3);border-radius:50px;font-size:1.1rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:10px}
.page-contact .modern-cta-primary svg,.page-contact .modern-cta-secondary svg{width:1.15em;height:1.15em;flex-shrink:0}
/* Icons must be white on blue even before deferred page CSS loads */
.page-contact .modern-contact-item .icon{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#1B4D89,#2c5aa0);display:flex;align-items:center;justify-content:center;margin:0 auto 25px;color:#fff}
.page-contact .modern-contact-item .icon .contact-card-icon{width:32px;height:32px;display:block;flex-shrink:0;max-width:none;opacity:1}
.page-contact .modern-cta-primary svg,.page-contact .modern-cta-secondary svg,.page-contact .modern-contact-item .icon svg{stroke:#fff!important;fill:none!important;color:#fff}
@media (max-width:768px){.page-contact .modern-hero h1{font-size:2.5rem}.page-contact .modern-hero .subtitle{font-size:1.1rem}.page-contact .modern-cta-buttons{flex-direction:column;align-items:center}}
@media (max-width:480px){.page-contact .modern-hero{padding:80px 0 60px}.page-contact .modern-hero h1{font-size:2rem}}
</style>
<link rel="stylesheet" href="{{ \Illuminate\Support\Facades\Vite::asset('resources/css/pages/contact.css') }}" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="{{ \Illuminate\Support\Facades\Vite::asset('resources/css/pages/contact.css') }}"></noscript>
@endsection

@section('content')
<div class="page-contact">

<!-- Modern Hero Section -->
<section class="modern-hero">
    <div class="floating-elements" aria-hidden="true">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>
    <div class="container">
        <div class="modern-hero-content" data-aos="fade-up" data-aos-duration="1000">
            <h1>Let's Start Your Legal Journey</h1>
            <p class="subtitle">Get expert legal assistance from Melbourne's most trusted law firm. We're here to help you navigate complex legal matters with confidence and clarity.</p>
            <div class="modern-cta-buttons">
                <a href="#contact-form" class="modern-cta-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                    Send Message Now
                </a>
                <a href="tel:+61422905860" class="modern-cta-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    Call Us Directly
                </a>
            </div>
        </div>
    </div>
</section>

<section class="container py-4">
    <article>
        <h2>Contact Our Melbourne Lawyers</h2>
        <p>Bansal Lawyers provides expert legal services from our Collins Street office in the Melbourne CBD. Our team assists clients across Victoria and Australia with migration and visa matters, family law, criminal defence, commercial and business law, and property and conveyancing.</p>
        <p>When you contact us, we listen to your situation, explain your legal options in plain language, and outline sensible next steps. You can reach us by phone, email, or the form below — we aim to respond promptly during business hours, Monday to Friday.</p>
        <p>If your matter is urgent, call <a href="tel:+61422905860">0422 905 860</a> or our national line <a href="tel:1300226725">1300 BANSAL (1300 226 725)</a>. For a paid consultation with a lawyer, you can also <a href="/book-an-appointment">book an appointment online</a>.</p>
    </article>
</section>

<!-- Modern Contact Section -->
<section class="modern-contact-section">
    <div class="container">
        <!-- Contact Information -->
        <div class="modern-contact-info" data-aos="fade-up" data-aos-duration="1000">
            <h2>Get In Touch</h2>
            @php
                // White stroke baked into data URIs so icons never depend on currentColor/CSS vars
                $contactIcon = static function (string $inner) {
                    $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . $inner . '</svg>';
                    return 'data:image/svg+xml,' . rawurlencode($svg);
                };
                $iconMap = $contactIcon('<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>');
                $iconPhone = $contactIcon('<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>');
                $iconMail = $contactIcon('<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>');
            @endphp
            <div class="modern-contact-grid">
                <div class="modern-contact-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon" aria-hidden="true">
                        <img class="contact-card-icon" src="{{ $iconMap }}" width="32" height="32" alt="" decoding="async">
                    </div>
                    <h4>Visit Our Office</h4>
                    <p><a href="https://g.co/kgs/Hw16bN8" target="_blank" rel="noopener noreferrer">Level 8/278 Collins St,<br>Melbourne VIC 3000,<br>Australia</a></p>
                </div>
                <div class="modern-contact-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon" aria-hidden="true">
                        <img class="contact-card-icon" src="{{ $iconPhone }}" width="32" height="32" alt="" decoding="async">
                    </div>
                    <h4>Call Us Now</h4>
                    <p><a href="tel:+61422905860">(+61) 0422905860</a><br>
                    <a href="tel:1300226725">1300 BANSAL<br>(1300 226 725)</a></p>
                </div>
                <div class="modern-contact-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon" aria-hidden="true">
                        <img class="contact-card-icon" src="{{ $iconMail }}" width="32" height="32" alt="" decoding="async">
                    </div>
                    <h4>Email Us</h4>
                    <p><a href="mailto:Info@bansallawyers.com.au">Info@bansallawyers.com.au</a></p>
                </div>
            </div>
        </div>

        <!-- Contact Form and Map Section -->
        <div class="photo-contact-section" id="contact-form" data-aos="fade-up" data-aos-duration="1000">
            <div class="photo-background" aria-hidden="true"></div>
            <div class="photo-overlay">
                <div class="container">
                    <div class="row align-items-center min-vh-100">
                        <div class="col-lg-6">
                            <div class="form-overlay-card" data-aos="fade-right" data-aos-duration="1000">
                                @include('components.unified-contact-form', [
                                    'variant' => 'default',
                                    'showTitle' => true,
                                    'title' => 'Send us a Message',
                                    'subtitle' => 'Get expert legal assistance from Melbourne\'s most trusted law firm',
                                    'buttonText' => 'Send Message',
                                    'buttonClass' => 'btn-primary',
                                    'formId' => 'contact-page-form',
                                    'containerClass' => 'contact-form-overlay',
                                    'source' => 'contact-page',
                                    'showPhoto' => true,
                                    'photoUrl' => asset('images/bansal_2.webp'),
                                    'photoAlt' => 'Ajay Bansal - CEO of Bansal Lawyers'
                                ])
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="map-overlay-card" data-aos="fade-left" data-aos-duration="1000">
                                {{-- Map loads when near viewport so LCP/TBT stay clean --}}
                                <div
                                    class="map-container"
                                    data-map-src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.645409146537!2d144.9631536153164!3d-37.81664617975151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d43c60387b1%3A0xd9be68c8b39a6074!2sLevel%208%2F278%20Collins%20St%2C%20Melbourne%20VIC%203000%2C%20Australia!5e0!3m2!1sen!2sus!4v1696731567597!5m2!1sen!2sus"
                                    data-map-title="Bansal Lawyers office location on Google Maps"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</div>

<script>
document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
        var href = this.getAttribute('href');
        if (!href || href === '#') return;
        var target = document.querySelector(href);
        if (!target) return;
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});
</script>
@endsection
