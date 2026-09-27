@extends('layouts.frontend')


@section('seoinfo')

<title>Lawyers in Melbourne | Immigration, Family, Criminal & Commercial Law</title>
<meta name="description" content="Bansal Lawyers is a Melbourne law firm helping clients with immigration, family, criminal, commercial, property and civil law matters. Book a consultation today." >
<meta name="keywords" content="Lawyers in Melbourne, Immigration Lawyers Melbourne, Family Lawyers Melbourne, Criminal Lawyers Melbourne, Commercial Lawyers Melbourne, Property Lawyers Melbourne, Civil Lawyers Melbourne, Law Firm Melbourne, Legal Services Melbourne">

<link rel="canonical" href="https://www.bansallawyers.com.au/" >

<!-- Facebook Meta Tags -->
<meta property="og:url" content="<?php echo URL::to('/'); ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="Lawyers in Melbourne | Immigration, Family, Criminal & Commercial Law">
<meta property="og:description" content="Bansal Lawyers is a Melbourne law firm helping clients with immigration, family, criminal, commercial, property and civil law matters. Book a consultation today.">
<meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="og:image:alt" content="Bansal Lawyers Logo">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="bansallawyers.com.au">
<meta property="twitter:url" content="<?php echo URL::to('/'); ?>">
<meta name="twitter:title" content="Lawyers in Melbourne | Immigration, Family, Criminal & Commercial Law">
<meta name="twitter:description" content="Bansal Lawyers is a Melbourne law firm helping clients with immigration, family, criminal, commercial, property and civil law matters. Book a consultation today.">

@php
    $homeFaqs = \App\Support\PracticeHubCopy::homeFaqs();
    $homeFaqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(static function (array $faq) {
            return [
                '@type' => 'Question',
                'name' => $faq['q'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['a'],
                ],
            ];
        }, $homeFaqs),
    ];
@endphp
<script type="application/ld+json">{!! json_encode($homeFaqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
<meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="twitter:image:alt" content="Bansal Lawyers Logo">


@endsection

@section('head')
{{-- Mobile Lighthouse LCP: only preload the mobile hero --}}
<link rel="preload" as="image" href="{{ asset('images/homepage-mobile.webp') }}" type="image/webp" fetchpriority="high">
{{-- Critical above-the-fold home styles (avoids FOUC while full home.css arrives) --}}
<style>
/* Match live homepage hero exactly: left card, centered text inside */
.home-hero{position:relative;min-height:560px;height:auto;display:flex;align-items:center;overflow:hidden;background-color:#f8f9fa;padding:48px 0}
.home-hero__media{position:absolute;inset:0;z-index:0}
.home-hero__media img{width:100%;height:100%;object-fit:cover;object-position:center}
.home-hero__overlay{position:absolute;inset:0;z-index:1;background:linear-gradient(135deg,rgba(27,77,137,.3) 0%,rgba(27,77,137,.1) 50%,rgba(27,77,137,.05) 100%)}
.home-hero .container{position:relative;z-index:2;width:100%;max-width:1200px;margin:0 auto;padding:0 20px;box-sizing:border-box}
.home-hero__content{position:relative;z-index:2;width:100%;text-align:left}
.home-hero__text{background:rgba(255,255,255,.95);padding:36px 28px;border-radius:20px;box-shadow:0 8px 25px rgba(0,0,0,.15);backdrop-filter:blur(10px);max-width:460px;margin-left:0;margin-right:auto;text-align:center}
.home-hero__text h1{font-size:2.4rem;font-weight:700;color:#1B4D89;margin:0 0 12px;line-height:1.2}
.home-hero__sub{font-size:1.05rem;font-weight:600;color:#1B4D89;margin:0 0 16px;line-height:1.4}
.home-hero__text p{font-size:1rem;color:#444;margin:0 0 14px;line-height:1.6}
.home-hero__actions{display:flex;flex-direction:column;align-items:stretch;gap:10px;margin-top:8px}
.home-hero__cta{background:linear-gradient(135deg,#1B4D89,#2c5aa0);color:#fff;padding:14px 22px;border-radius:50px;text-decoration:none;font-weight:600;font-size:1rem;display:inline-flex;align-items:center;justify-content:center;gap:.5rem;box-shadow:0 8px 25px rgba(27,77,137,.3)}
.home-hero__cta--secondary{background:#fff;color:#1B4D89;border:2px solid #1B4D89;box-shadow:none}
.home-steps{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:16px}
.home-step{background:#fff;border:1px solid #f0f0f0;border-radius:15px;padding:22px 18px;box-shadow:0 10px 30px rgba(0,0,0,.08);height:100%}
.home-step strong{display:block;color:#1B4D89;font-size:1.05rem;margin:8px 0}
.home-step span{display:inline-flex;width:36px;height:36px;border-radius:50%;background:#1B4D89;color:#fff;align-items:center;justify-content:center;font-weight:700}
.home-points{max-width:720px;margin:0 auto;text-align:left}
.home-points li{margin:8px 0;color:#333;line-height:1.6}
.home-faq h3{color:#1B4D89;font-size:1.15rem;margin:22px 0 8px}
.home-faq p{color:#444;line-height:1.7;margin:0}
.home-faq a{color:#1B4D89}
@media (max-width:900px){.home-steps{grid-template-columns:1fr 1fr}}
@media (max-width:600px){.home-steps{grid-template-columns:1fr}}
.home-hero__cta svg,.home-hero__cta .white-card-icon{width:1.1em;height:1.1em;display:inline-block;flex-shrink:0}
@media (max-width:1024px) and (min-width:769px){.home-hero__text{padding:40px 28px;max-width:420px}.home-hero__text h1{font-size:2.1rem}}
@media (max-width:768px){.home-hero{height:auto;min-height:0;padding:24px 0}.home-hero__text{padding:28px 20px;margin:16px;max-width:calc(100% - 32px)}.home-hero__text h1{font-size:1.85rem}.home-hero__text p{font-size:.98rem}.home-hero__cta{padding:12px 18px;font-size:.95rem}}
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
                <h1>Lawyers in Melbourne</h1>
                <p class="home-hero__sub">Immigration, family, criminal, commercial, property and civil law</p>
                <p>Bansal Lawyers is a Melbourne-based law firm helping individuals, families, migrants, professionals, and businesses with clear legal advice across immigration, family, criminal, commercial, property, and civil law matters.</p>
                <p>We explain your options in plain language and guide you through the next steps with care and attention.</p>
                <div class="home-hero__actions">
                    <a href="/book-an-appointment" class="home-hero__cta">Book a Consultation</a>
                    <a href="tel:1300226725" class="home-hero__cta home-hero__cta--secondary">Speak With Our Legal Team</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="experimental-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 style="color: #1B4D89; font-size: 2.2rem; font-weight: 700; margin-bottom: 1rem;">Legal Help That Starts With Clear Advice</h2>
                <p style="color: #444; font-size: 1.05rem; line-height: 1.7;">When you are dealing with a legal matter, the first thing you need is clarity. Bansal Lawyers helps clients understand their position, their options, and the next steps before making important decisions.</p>
                <p style="color: #444; font-size: 1.05rem; line-height: 1.7;">We assist with immigration, family, criminal, commercial, property, and civil law matters in Melbourne. Each matter is handled with proper attention, clear communication, and practical legal guidance.</p>
                <p style="color: #1B4D89; font-weight: 600; line-height: 1.6;">Speak with <a href="/about">our team</a> at Level 8, 278 Collins St, Melbourne, or call <a href="tel:1300226725">1300 226 725</a>.</p>
            </div>
        </div>
    </div>
</section>

<section class="experimental-section" style="background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 style="color: #1B4D89; font-size: 2.2rem; font-weight: 700; margin-bottom: 1rem;">Our Legal Services</h2>
                <p style="color: #444; font-size: 1.05rem; line-height: 1.7;">Bansal Lawyers provides legal support across key areas of law for individuals, families, migrants, professionals, and business owners.</p>
            </div>
        </div>
        <div class="row">
            @foreach(\App\Support\PracticeHubCopy::cards() as $card)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="experimental-card" style="text-align: center;">
                    <div class="icon">
                        <x-white-icon :name="$card['icon']" />
                    </div>
                    <h3>{{ $card['title'] }}</h3>
                    <p>{{ $card['blurb'] }}</p>
                    <a href="{{ $card['href'] }}" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem; background: #1B4D89; color: #fff;">{{ $card['cta'] }}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="experimental-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 style="color: #1B4D89; font-size: 2.2rem; font-weight: 700; margin-bottom: 1rem; text-align: center;">Why Clients Choose Bansal Lawyers</h2>
                <p style="color: #444; font-size: 1.05rem; line-height: 1.7; text-align: center;">Clients choose Bansal Lawyers because we explain legal issues in a way that is easy to understand. We do not overcomplicate the process. We review the facts, explain the risks, and help you decide what needs to be done next.</p>
                <ul class="home-points">
                    <li>Clear and practical legal advice</li>
                    <li>Support across multiple areas of law</li>
                    <li>Careful review of documents and deadlines</li>
                    <li>Honest explanation of legal options</li>
                    <li>Professional handling of sensitive matters</li>
                    <li>Melbourne-based legal support</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="experimental-section" style="background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <h2 style="color: #1B4D89; font-size: 2.2rem; font-weight: 700;">How the Process Works</h2>
            </div>
        </div>
        <div class="home-steps">
            <div class="home-step">
                <span>1</span>
                <strong>Contact Our Team</strong>
                <p>Share a short summary of your legal matter by phone, email, or enquiry form.</p>
            </div>
            <div class="home-step">
                <span>2</span>
                <strong>Consultation and Review</strong>
                <p>We review your situation, documents, deadlines, and key legal concerns.</p>
            </div>
            <div class="home-step">
                <span>3</span>
                <strong>Clear Legal Advice</strong>
                <p>You receive practical advice about your options and possible next steps.</p>
            </div>
            <div class="home-step">
                <span>4</span>
                <strong>Preparation and Support</strong>
                <p>Where required, we assist with applications, responses, contracts, notices, negotiations, or court documents.</p>
            </div>
        </div>
    </div>
</section>

<section class="experimental-section" style="background: #1B4D89;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 style="color: #fff; font-size: 2.2rem; font-weight: 700; margin-bottom: 1rem;">Need Legal Advice Before Taking the Next Step?</h2>
                <p style="color: rgba(255,255,255,0.92); font-size: 1.05rem; line-height: 1.7;">Some legal matters have strict time limits. Visa refusals, court dates, police matters, family violence issues, contract disputes, and property settlements should not be delayed.</p>
                <p style="color: rgba(255,255,255,0.92); font-size: 1.05rem; line-height: 1.7;">If you are unsure what to do next, speak with Bansal Lawyers early and get clear advice before making important decisions.</p>
                <a href="/book-an-appointment" class="experimental-cta">Book a Consultation</a>
            </div>
        </div>
    </div>
</section>

<section class="experimental-section home-faq">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 style="color: #1B4D89; font-size: 2.2rem; font-weight: 700; margin-bottom: 1rem; text-align: center;">Frequently Asked Questions</h2>
                @php $homeFaqs = $homeFaqs ?? \App\Support\PracticeHubCopy::homeFaqs(); @endphp
                @foreach($homeFaqs as $faq)
                    <h3>{{ $faq['q'] }}</h3>
                    <p>
                        @if(!empty($faq['link_text']) && !empty($faq['link_href']))
                            {!! str_replace(e($faq['link_text']), '<a href="' . e($faq['link_href']) . '">' . e($faq['link_text']) . '</a>', e($faq['a'])) !!}
                        @else
                            {{ $faq['a'] }}
                        @endif
                    </p>
                @endforeach
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
                        $cardTitle = @$list->title ?? '';
                        $cardTitle = preg_replace('/^\d+\s*/', '', $cardTitle);
                        $cardTitle = preg_replace('/\s*([|–-]\s*(Best Lawyers|Bansal Lawyers).*$)/i', '', $cardTitle);
                    @endphp
                    {{-- Image URL pre-resolved in HomeController::index() to avoid file_exists() disk I/O here --}}
                    <div style="height: 200px; min-height: 200px; max-height: 200px; flex-shrink: 0; background-image: url('{!! asset($list->resolved_image) !!}'); background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 15px; margin-bottom: 20px;" onerror="this.style.backgroundImage='url({!! asset('images/Blog.jpg') !!})'">
                        <span class="sr-only">{{ $cardTitle }}</span>
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
                        <a href="{{ route('blog.detail', $list->slug) }}" style="color: inherit; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='#2c5aa0'" onmouseout="this.style.color='#1B4D89'">{{ $cardTitle }}</a>
                    </h4>
                    <p style="color: #666; margin-bottom: 20px; line-height: 1.5; font-size: 0.95rem;">{{ $cardTitle }}</p>
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
