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

@section('head')
{{-- Mobile Lighthouse LCP: only preload the mobile hero --}}
<link rel="preload" as="image" href="{{ asset('images/homepage-mobile.webp') }}" type="image/webp" fetchpriority="high">
{{-- Critical above-the-fold home styles (avoids FOUC while full home.css arrives) --}}
<style>
/* Match live homepage hero exactly: left card, centered text inside */
.home-hero{position:relative;min-height:600px;height:100vh;display:flex;align-items:center;overflow:hidden;background-color:#f8f9fa}
.home-hero__media{position:absolute;inset:0;z-index:0}
.home-hero__media img{width:100%;height:100%;object-fit:cover;object-position:center}
.home-hero__overlay{position:absolute;inset:0;z-index:1;background:linear-gradient(135deg,rgba(27,77,137,.3) 0%,rgba(27,77,137,.1) 50%,rgba(27,77,137,.05) 100%)}
.home-hero .container{position:relative;z-index:2;width:100%;max-width:1200px;margin:0 auto;padding:0 20px;box-sizing:border-box}
.home-hero__content{position:relative;z-index:2;width:100%;text-align:left}
.home-hero__text{background:rgba(255,255,255,.95);padding:50px 40px;border-radius:20px;box-shadow:0 8px 25px rgba(0,0,0,.15);backdrop-filter:blur(10px);max-width:400px;margin-left:0;margin-right:auto;text-align:center}
.home-hero__text h1{font-size:3rem;font-weight:700;color:#1B4D89;margin:0 0 20px;line-height:1.2}
.home-hero__text h2{font-size:1.8rem;font-weight:600;color:#1B4D89;margin:0 0 15px;line-height:1.3}
.home-hero__text p{font-size:1.1rem;color:#666;margin:0 0 30px;line-height:1.6}
.home-hero__cta{background:linear-gradient(135deg,#1B4D89,#2c5aa0);color:#fff;padding:15px 35px;border-radius:50px;text-decoration:none;font-weight:600;font-size:1.1rem;display:inline-flex;align-items:center;justify-content:center;gap:.5rem;box-shadow:0 8px 25px rgba(27,77,137,.3)}
.home-hero__cta svg,.home-hero__cta .white-card-icon{width:1.1em;height:1.1em;display:inline-block;flex-shrink:0}
@media (max-width:1024px) and (min-width:769px){.home-hero__text{padding:45px 35px;max-width:380px}.home-hero__text h1{font-size:2.4rem}.home-hero__text h2{font-size:1.5rem}}
@media (max-width:768px){.home-hero{height:80vh;min-height:500px}.home-hero__text{padding:35px 25px;margin:20px;max-width:calc(100% - 40px)}.home-hero__text h1{font-size:2.2rem}.home-hero__text h2{font-size:1.4rem}.home-hero__text p{font-size:1rem}.home-hero__cta{padding:12px 25px;font-size:1rem}}
</style>
@vite(['resources/css/pages/home.css'])
@endsection

@section('content')


<!-- New Hero Section -->
<section class="home-hero">
    <picture class="home-hero__media">
        <source media="(min-width: 1920px)" srcset="{{ asset('images/homepage@2x.webp') }}" type="image/webp">
        <source media="(min-width: 1200px)" srcset="{{ asset('images/homepage.webp') }}" type="image/webp">
        <source media="(min-width: 768px)" srcset="{{ asset('images/homepage-tablet.webp') }}" type="image/webp">
        <img src="{{ asset('images/homepage-mobile.webp') }}"
             alt="Bansal Lawyers Melbourne"
             width="768"
             height="1024"
             fetchpriority="high"
             decoding="async">
    </picture>
    <div class="home-hero__overlay"></div>
    <div class="container">
        <div class="home-hero__content">
            <div class="home-hero__text">
                <h1>Bansal Lawyers</h1>
                <h2>There is no legal puzzle that we can't solve</h2>
                <p>Expert legal services in Melbourne, Australia. We handle your legal matters with professionalism and care, so you can focus on what matters most.</p>
                <a href="/book-an-appointment" class="home-hero__cta">
                    Start Your Legal Consultation <x-white-icon name="arrow-right" :size="18" class="ms-2" />
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
                                <x-white-icon name="gavel" />
                            </div>
                            <h3>Your Success is Our Mission</h3>
                            <p>We don't just handle cases – we build relationships. Every client's story matters to us, and we fight passionately for the outcomes that will change your life for the better. Your victory is our greatest reward.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="experimental-card">
                            <div class="icon">
                                <x-white-icon name="users" />
                            </div>
                            <h3>We Speak Your Language</h3>
                            <p>Understanding your unique situation is our first priority. We take time to listen, explain everything in plain English, and create a personalized strategy that fits your specific needs and goals.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="experimental-card">
                            <div class="icon">
                                <x-white-icon name="award" />
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
                        <x-white-icon name="users" />
                    </div>
                    <h3>Family Law</h3>
                    <p>Divorce, separation, children, property and other family law matters. Expert guidance for complex family situations.</p>
                    <a href="/family-law" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem;">Learn more about Family Law</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="experimental-card" style="text-align: center;">
                    <div class="icon">
                        <x-white-icon name="handshake" />
                    </div>
                    <h3>Migration Law</h3>
                    <p>Visa applications, appeals, permanent residency, and citizenship matters. Your pathway to Australia.</p>
                    <a href="/migration-law" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem;">Learn more about Migration Law</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="experimental-card" style="text-align: center;">
                    <div class="icon">
                        <x-white-icon name="gavel" />
                    </div>
                    <h3>Criminal Law</h3>
                    <p>Assault charges, traffic offenses, and criminal defense. Protecting your rights and future in Australia.</p>
                    <a href="/criminal-law" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem;">Learn more about Criminal Law</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="experimental-card" style="text-align: center;">
                    <div class="icon">
                        <x-white-icon name="briefcase" />
                    </div>
                    <h3>Commercial Law</h3>
                    <p>Business formation, contracts, corporate governance, and commercial disputes. Supporting your business growth.</p>
                    <a href="/commercial-law" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem;">Learn more about Commercial Law</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="experimental-card" style="text-align: center;">
                    <div class="icon">
                        <x-white-icon name="house" />
                    </div>
                    <h3>Property Law</h3>
                    <p>Property transactions, leasing, development, and property disputes. Securing your property interests.</p>
                    <a href="/property-law" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem;">Learn more about Property Law</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="experimental-card" style="text-align: center; background: linear-gradient(135deg, #1B4D89, #2c5aa0); color: white;">
                    <div class="icon" style="background: rgba(255,255,255,0.2);">
                        <x-white-icon name="scale" />
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
                    {{-- Image URL pre-resolved in HomeController::index() to avoid file_exists() disk I/O here --}}
                    <div style="height: 200px; min-height: 200px; max-height: 200px; flex-shrink: 0; background-image: url('{!! asset($list->resolved_image) !!}'); background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 15px; margin-bottom: 20px;" onerror="this.style.backgroundImage='url({!! asset('images/Blog.jpg') !!})'">
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
                            <a href="{{ route('blog.index') }}" class="badge badge-primary">{{ $list->categorydetail->name }}</a>
                        </div>
                    @endif
                    <h4 style="color: #1B4D89; font-weight: 600; margin-bottom: 15px; line-height: 1.4;">
                        <a href="{{ route('blog.detail', $list->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#2c5aa0'" onmouseout="this.style.color='#1B4D89'">{{@$list->title}}</a>
                    </h4>
                    <p style="color: #666; margin-bottom: 20px; line-height: 1.5; font-size: 0.95rem;">{{@$list->title}}</p>
                    <a href="{{ route('blog.detail', $list->slug) }}" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px;">
                        Read More <x-white-icon name="arrow-right" :size="14" color="#ffffff" />
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Experimental Contact Section -->
<section class="experimental-section" style="background: #1B4D89; position: relative; overflow: hidden; padding: 80px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="text-center">
                    <img src="{!! asset('images/bg_2.webp') !!}" 
                         srcset="{!! asset('images/bg_2.webp') !!} 1x, 
                                 {!! asset('images/bg_2@2x.webp') !!} 2x" 
                         sizes="(max-width: 768px) 100vw, 674px" 
                         alt="Contact Bansal Lawyers" 
                         class="img-fluid rounded" 
                         style="box-shadow: 0 20px 40px rgba(0,0,0,0.3); border-radius: 20px !important; max-width: 100%; height: auto;" 
                         loading="eager" 
                         width="674" 
                         height="405">
                    <div class="mt-4">
                        <h3 style="font-size: 1.8rem; font-weight: 600; margin-bottom: 1rem; color: #fff;">Get in Touch Today</h3>
                        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.9); line-height: 1.6;">
                            Ready to discuss your legal needs? Our experienced team is here to provide you with expert legal guidance and support.
                        </p>
                        <div class="mt-4">
                            <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                                <x-white-icon name="phone" :size="24" class="me-3" style="margin-right: 15px;" />
                                <span style="font-size: 1.1rem; font-weight: 500; color: #fff;">1300 BANSAL (1300 226 725)</span>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: center;">
                                <x-white-icon name="mail" :size="24" style="margin-right: 15px;" />
                                <span style="font-size: 1.1rem; font-weight: 500; color: #fff;">info@bansallawyers.com.au</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div style="background: #fff; border-radius: 12px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" style="margin-bottom: 15px; border-radius: 8px; border: none; background: #28a745; color: white; padding: 8px 12px; font-size: 0.85rem;">
                            <i data-lucide="circle-check" style="margin-right: 6px;"></i>
                            <strong>Success!</strong> {{ $message }}
                        </div>
                    @endif
                    
                    @if ($errors instanceof \Illuminate\Support\ViewErrorBag && $errors->any())
                        <div class="alert alert-danger" style="margin-bottom: 15px; border-radius: 8px; border: none; background: #dc3545; color: white; padding: 8px 12px; font-size: 0.85rem;">
                            <i data-lucide="triangle-alert" style="margin-right: 6px;"></i>
                            <strong>Please correct the following errors:</strong>
                            <ul style="margin: 6px 0 0 0; padding-left: 12px; font-size: 0.8rem;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="text-center mb-4">
                        <span style="color: #1B4D89; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Get Legal Help</span>
                        <h2 style="font-size: 1.8rem; font-weight: 700; margin: 0.5rem 0 0.2rem; color: #1B4D89;">Contact Our Melbourne Lawyers</h2>
                        <p style="font-size: 0.9rem; color: #666; margin-bottom: 0;">Send us a message and we'll get back to you with expert legal advice</p>
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
{{-- Turnstile is loaded by the global frontend layout --}}

<!-- Swiper.js initialization is handled in resources/js/frontend.js -->

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
`;
document.head.appendChild(style);
</script>
@endsection
