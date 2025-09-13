@extends('layouts.frontend')


@section('seoinfo')

<title>Best Immigration Lawyer in Melbourne Australia | Bansal Lawyers - Experimental</title>
<meta name="description" content="Looking for top-rated lawyers in Australia? Bansal Lawyers offers expert legal services in immigration, family, criminal, and business law. Get legal help today!" >

<link rel="canonical" href="<?php echo URL::to('/'); ?>" >

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

/* Experimental Design Styles */
.experimental-banner {
    background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
    color: white;
    padding: 60px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.experimental-banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset('images/coart_1.jpg') }}') center/cover;
    opacity: 0.3;
    z-index: 1;
}

.experimental-banner .container {
    position: relative;
    z-index: 2;
}

.experimental-banner h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.experimental-banner p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
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
    padding: 80px 0;
}

.experimental-card {
    background: white;
    border-radius: 15px;
    padding: 40px 30px;
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
    padding: 80px 0;
}

.experimental-about-content {
    background: white;
    border-radius: 20px;
    padding: 60px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.experimental-testimonial {
    background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
    color: white;
    padding: 80px 0;
}

.experimental-testimonial-card {
    background: rgba(255,255,255,0.1);
    border-radius: 15px;
    padding: 40px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    margin: 20px 0;
}

.experimental-testimonial-card p {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 30px;
    font-style: italic;
}

.experimental-testimonial-card .author {
    display: flex;
    align-items: center;
    gap: 15px;
}

.experimental-testimonial-card .author-avatar {
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
}

@media (max-width: 768px) {
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
}
</style>

<!-- Experimental Hero Section -->
<div class="experimental-banner">
    <div class="container">
        <h1>WELCOME TO BANSAL LAWYERS</h1>
        <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem; font-weight: 600;">There's No Legal Puzzle That We Can't Solve</h2>
        <p style="font-size: 1.2rem; max-width: 800px; margin: 0 auto 2rem;">
            Bansal Lawyers is your trusted legal service provider in Melbourne, Australia. Our Team is expert in Australian Law and have strong track record of success in helping individuals and families living in Australia. Our team of highly skilled lawyers dedicated to protecting your rights, defending your future in Australia.
        </p>
        <p style="font-size: 1.1rem; max-width: 700px; margin: 0 auto 2.5rem;">
            We provide legal services for Immigration Law, including ART/AAT Appeals. Also provide services with legal support for family law, criminal law, child custody, property settlements, and civil law matters.
        </p>
        <h3 style="font-size: 2rem; margin-bottom: 2rem; font-weight: 600;">Best Lawyers in Melbourne Australia</h3>
        <a href="/book-an-appointment" class="experimental-cta">
            Schedule Your Consultation <i class="ion-ios-arrow-forward ml-2"></i>
        </a>
    </div>
</div>

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
                            <h3>Dedicated to Justice</h3>
                            <p>At Bansal Lawyers, our team is always committed to get justice and protect the client rights with our experience. Our top legal professional lawyers in Melbourne work for safeguard your interest and secure the possible results for you.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="experimental-card">
                            <div class="icon">
                                <span class="flaticon-lawyer"></span>
                            </div>
                            <h3>Customized Support</h3>
                            <p>Bansal Lawyers, Expert Legal assistance in Melbourne always review all cases smoothly like Family Law, Divorce, Property Law and Others in Melbourne Australia. We plan legal strategies to find the path for the specific needs.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="experimental-card">
                            <div class="icon">
                                <span class="flaticon-lawyer"></span>
                            </div>
                            <h3>Experienced Team</h3>
                            <p>Our Experienced Team with high experience of years in the legal field in Australia, Bansal Lawyers provides best legal services which supported by a team of highly skilled & professional lawyers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experimental About Section -->
<section class="experimental-about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <div class="experimental-about-content">
                    <span style="color: #1B4D89; font-weight: 600; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Welcome to Bansal Lawyers</span>
                    <h2 style="color: #1B4D89; font-size: 2.5rem; font-weight: 700; margin: 1rem 0;">Meet Ajay Bansal – Director of Bansal Lawyers</h2>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 2rem;">
                        Meet our Director AJAY BANSAL of Bansal Lawyers your trusted legal expert in Melbourne, Australia. With years of professional experience in legal field in Australia, Ajay Bansal is committed to provide legal services to individuals, family, & business across Australia.
                    </p>
                    <p style="color: #666; line-height: 1.6; margin-bottom: 2rem;">
                        He knows to get results in all legal issues in Australia like Immigration Law, Family Law, Property disputes, and many more legal services etc. Ajay is known for providing best solution in legal issues in Australia, he always focused to provide clients clear and satisfied legal advice makes him one of the top lawyers in Melbourne.
                    </p>
                    <div class="mt-4">
                        <h4 style="color: #1B4D89; font-weight: 600;">Your Trusted Legal Partner</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <img src="{{ asset('images/bansal_2.jpg') }}" alt="Ajay Bansal - CEO of Bansal Lawyers" class="img-fluid rounded" style="box-shadow: 0 15px 35px rgba(0,0,0,0.1); border-radius: 20px !important;">
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
                <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">What Our Clients Say</h2>
                <p style="font-size: 1.1rem; opacity: 0.9;">Hear from some of our valued clients about their experiences working with us. Your success is our priority.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
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
            <div class="col-md-6 mb-4">
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
            <div class="col-md-6 mb-4">
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
            <div class="col-md-6 mb-4">
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
        </div>
    </div>
</section>

<!-- Experimental Blog Section -->
<section class="experimental-section" style="background: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <h2 style="color: #1B4D89; font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">Latest Insights</h2>
                <p style="color: #666; font-size: 1.1rem;">Stay informed with our expert articles on legal trends, industry news, and professional insights.</p>
            </div>
        </div>
        <div class="row">
            @foreach (@$bloglists as $list)
            <div class="col-md-4 mb-4">
                <div class="experimental-card">
                    <div style="height: 200px; background-image: url('{{ !empty(@$list->image) ? asset('images/blog/' . @$list->image) : asset('images/Blog.jpg') }}'); background-size: cover; background-position: center; border-radius: 15px; margin-bottom: 20px;" onerror="this.style.backgroundImage='url({{ asset('images/Blog.jpg') }})'"></div>
                    <div class="d-flex align-items-center mb-3">
                        <div style="background: #1B4D89; color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.9rem; font-weight: 600;">
                            <?php echo date('d M', strtotime($list->created_at));?>
                        </div>
                        <div class="ml-3">
                            <div style="color: #1B4D89; font-weight: 600;"><?php echo date('Y', strtotime($list->created_at));?></div>
                        </div>
                    </div>
                    @if(isset($list->categorydetail) && $list->categorydetail)
                        <div class="mb-3">
                            <a href="{{ route('blog.category', $list->categorydetail->slug) }}" class="badge badge-primary">{{ $list->categorydetail->name }}</a>
                        </div>
                    @endif
                    <h4 style="color: #1B4D89; font-weight: 600; margin-bottom: 15px;">
                        <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" style="color: inherit; text-decoration: none;">{{@$list->title}}</a>
                    </h4>
                    <p style="color: #666; margin-bottom: 20px;">{{@$list->title}}</p>
                    <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" class="experimental-cta" style="padding: 10px 20px; font-size: 0.9rem;">Read More</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Experimental Contact Section -->
<section class="experimental-section" style="background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <img src="{{ asset('images/bg_2.jpg') }}" alt="Contact Bansal Lawyers" class="img-fluid rounded" style="box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            </div>
            <div class="col-lg-6">
                <div style="background: rgba(255,255,255,0.1); border-radius: 20px; padding: 50px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" style="margin-bottom: 30px;">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 2rem;">Contact Us</h2>
                    <form action="<?php echo URL::to('/'); ?>/contact_lawyer" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Your Name" required style="border-radius: 10px; border: none; padding: 15px; font-size: 1rem;">
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required style="border-radius: 10px; border: none; padding: 15px; font-size: 1rem;">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required style="border-radius: 10px; border: none; padding: 15px; font-size: 1rem;">
                        </div>
                        <div class="form-group mb-4">
                            <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Message" required style="border-radius: 10px; border: none; padding: 15px; font-size: 1rem;"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="experimental-cta" style="width: 100%; text-align: center; border: none; background: white; color: #1B4D89; padding: 15px 30px; border-radius: 50px; font-weight: 600; font-size: 1.1rem;">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')

@endsection
