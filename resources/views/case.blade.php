@extends('layouts.frontend')
@section('seoinfo')
	<title>Recent Case Law Updates | Legal Precedents & Court Decisions | Bansal Lawyers Melbourne</title>
	<meta name="description" content="Stay informed with the latest case law updates and legal precedents. Expert analysis of important court decisions in family law, immigration, property disputes, and more from Bansal Lawyers Melbourne." />

    <meta name="keyword" content="case law updates, legal precedents, court decisions, legal analysis, Australian law, family law, immigration law, property disputes, criminal law, commercial law, Melbourne lawyers, Victoria legal services, High Court decisions, Federal Court cases, Supreme Court judgments, legal commentary, law firm Melbourne, Bansal Lawyers, Australian legal system, recent judgments, legal developments, court rulings" />

    <link rel="canonical" href="https://www.bansallawyers.com.au/case" />

	<!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/case">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Recent Case Law Updates | Legal Precedents & Court Decisions | Bansal Lawyers Melbourne">
    <meta property="og:description" content="Stay informed with the latest case law updates and legal precedents. Expert analysis of important court decisions in family law, immigration, property disputes, and more from Bansal Lawyers Melbourne.">
    <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
    <meta property="og:image:alt" content="Bansal Lawyers Logo">
    <meta property="og:site_name" content="Bansal Lawyers">
    <meta property="og:locale" content="en_AU">

	<!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/case">
    <meta name="twitter:title" content="Recent Case Law Updates | Legal Precedents & Court Decisions | Bansal Lawyers Melbourne">
    <meta name="twitter:description" content="Stay informed with the latest case law updates and legal precedents. Expert analysis of important court decisions in family law, immigration, property disputes, and more from Bansal Lawyers Melbourne.">
    <meta name="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
    <meta property="twitter:image:alt" content="Bansal Lawyers Logo">

    <!-- Additional SEO Meta Tags -->
    <meta name="author" content="Bansal Lawyers">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="7 days">

@endsection
@section('content')

<!-- Modern Case Law Information Hero Section -->
<div class="experimental-case-hero">
    <div class="container">
        <h1>Recent Case Law Updates</h1>
        <p>Stay informed with the latest case law developments and legal precedents. Our team provides insights and analysis on important court decisions that may impact your legal matters across various areas of Australian law.</p>
        <p class="breadcrumbs">
            <span class="mr-2"><a href="/" style="color: #f1f3f4; text-decoration: none;">Home <i class="fa fa-arrow-right"></i></a></span>
            <span style="color: #f1f3f4;">Recent Case Law Updates <i class="fa fa-arrow-right"></i></span>
        </p>
    </div>
</div>

<!-- Main Case Law Information Section -->
<section class="ftco-section bg-light">
    <div class="container">
        <!-- Case Law Information Grid -->
        <div class="row" id="case-law-list">
            @forelse(@$caselists as $list)
                <div class="col-md-4 col-lg-4 mb-4">
                    <div class="experimental-case-card">
                        <div class="experimental-case-image" 
                             @if(isset($list->image) && $list->image != "")
                                 style="background-image: url('{!! asset('images/blog/' . $list->image) !!}');"
                             @else
                                 style="background-image: url('{!! asset('images/CaseStudies.jpg') !!}');"
                             @endif>
                        </div>
                        <div class="experimental-case-content">
                            @if(isset($list->category) && $list->category)
                                <span class="experimental-case-category">
                                    {{ $list->category }}
                                </span>
                            @endif
                            
                            <h3 class="experimental-case-title">
                                <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}">
                                    {{ $list->title }}
                                </a>
                            </h3>
                            
                            <div class="experimental-case-meta">
                                <i class="fa fa-calendar mr-2"></i>
                                {{ \Carbon\Carbon::parse(@$list->created_at)->format('M d, Y') }}
                            </div>
                            
                            <div class="experimental-case-excerpt">
                                {{ $list->short_description ? \Illuminate\Support\Str::limit(strip_tags($list->short_description), 120, '...') : 'Legal analysis and case summary available.' }}
                            </div>
                            
                            <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" 
                               class="experimental-read-more">
                                Read Analysis <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12 text-center">
                    <div class="experimental-case-card" style="padding: 60px 30px;">
                        <h3 style="color: #1B4D89; margin-bottom: 20px;">No Case Law Updates Found</h3>
                        <p style="color: #666; font-size: 1.1rem;">
                            No case law updates are available at the moment. Please check back later for the latest legal precedents and court decisions.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
        
        @if(method_exists($caselists, 'hasPages') && $caselists->hasPages())
        <div class="row mt-4">
            <div class="col-md-12">
                {{ $caselists->links() }}
            </div>
        </div>
        @endif
    </div>
</section>


<style>
/* Modern Case Studies Styles - Matching Blog Experimental */
.experimental-case-hero {
    background: linear-gradient(135deg, #0a1a2e 0%, #16213e 50%, #1B4D89 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.experimental-case-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset('images/CaseStudies.jpg') }}') center/cover;
    opacity: 0.2;
    z-index: 1;
}

.experimental-case-hero .container {
    position: relative;
    z-index: 2;
}

.experimental-case-hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
    color: #ffffff;
}

.experimental-case-hero p {
    font-size: 1.3rem;
    margin-bottom: 2rem;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
    color: #f1f3f4;
    line-height: 1.6;
}

.experimental-case-stats {
    background: #f8f9fa;
    padding: 20px 0;
    text-align: center;
    margin-bottom: 40px;
}

.experimental-stats-item {
    display: inline-block;
    margin: 0 20px;
    text-align: center;
}

.experimental-stats-number {
    font-size: 2rem;
    font-weight: 700;
    color: #1B4D89;
    display: block;
}

.experimental-stats-label {
    color: #666;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.experimental-case-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
    border: 1px solid #f0f0f0;
    margin-bottom: 30px;
}

.experimental-case-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.experimental-case-image {
    height: 250px !important;
    min-height: 250px !important;
    max-height: 250px !important;
    flex: 0 0 250px !important;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    overflow: hidden;
}

.experimental-case-image::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(27, 77, 137, 0.1), rgba(27, 77, 137, 0.3));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.experimental-case-card:hover .experimental-case-image::after {
    opacity: 1;
}

.experimental-case-content {
    padding: 30px;
}

.experimental-case-category {
    display: inline-block;
    background: #1B4D89;
    color: white;
    padding: 6px 15px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 15px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.experimental-case-category:hover {
    background: #0d3a6b;
    color: white;
    text-decoration: none;
    transform: scale(1.05);
}

.experimental-case-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1B4D89;
    margin-bottom: 15px;
    line-height: 1.3;
    font-family: 'Poppins', sans-serif;
}

.experimental-case-title a {
    color: #1B4D89;
    text-decoration: none;
    transition: color 0.3s ease;
}

.experimental-case-title a:hover {
    color: #0d3a6b;
    text-decoration: none;
}

.experimental-case-meta {
    color: #666;
    font-size: 0.95rem;
    margin-bottom: 15px;
    font-weight: 500;
}

.experimental-case-excerpt {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 0.95rem;
}

.experimental-read-more {
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: white;
    padding: 12px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.experimental-read-more:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(27, 77, 137, 0.3);
    color: white;
    text-decoration: none;
}

.container {
    max-width: 1300px !important;
}

@media (max-width: 768px) {
    .experimental-case-hero h1 {
        font-size: 2.5rem;
    }
    
    .experimental-case-hero p {
        font-size: 1.1rem;
    }
    
    .experimental-case-image {
        height: 200px;
        min-height: 200px;
        max-height: 200px;
        flex-shrink: 0;
    }
    
    .experimental-case-content {
        padding: 20px;
    }
    
    .experimental-stats-item {
        margin: 10px;
    }
}

/* Ensure equal card height and align button at bottom */
.experimental-case-card {
    display: flex;
    flex-direction: column;
}

.experimental-case-content {
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
}

.experimental-read-more {
    margin-top: auto;
    align-self: flex-start;
}
</style>

@endsection