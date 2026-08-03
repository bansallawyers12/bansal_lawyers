@extends('layouts.frontend')

@section('seoinfo')
<?php
    $metaTitle = (isset($pagedata->meta_title) && $pagedata->meta_title != "") ? $pagedata->meta_title : "Recent Case Law Updates | Legal Precedents & Court Decisions | Bansal Lawyers Melbourne";
    $metaDescription = (isset($pagedata->meta_description) && $pagedata->meta_description != "") ? $pagedata->meta_description : "Stay informed with the latest case law updates and legal precedents. Expert analysis of important court decisions in family law, immigration, property disputes, and more from Bansal Lawyers Melbourne.";
    $metaKeywords = (isset($pagedata->meta_keyward) && $pagedata->meta_keyward != "") ? $pagedata->meta_keyward : "case law updates, legal precedents, court decisions, legal analysis, Australian law, family law, immigration law, property disputes, criminal law, commercial law, Melbourne lawyers, Victoria legal services, High Court decisions, Federal Court cases, Supreme Court judgments, legal commentary, law firm Melbourne, Bansal Lawyers, Australian legal system, recent judgments, legal developments, court rulings";
?>
<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $metaDescription }}" />
<meta name="keyword" content="{{ $metaKeywords }}" />

<link rel="canonical" href="https://www.bansallawyers.com.au/case" />

<meta property="og:url" content="<?php echo URL::to('/'); ?>/case">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="og:image:alt" content="Bansal Lawyers Logo">
<meta property="og:site_name" content="Bansal Lawyers">
<meta property="og:locale" content="en_AU">

<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="bansallawyers.com.au">
<meta property="twitter:url" content="<?php echo URL::to('/'); ?>/case">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="twitter:image:alt" content="Bansal Lawyers Logo">

<meta name="author" content="Bansal Lawyers">
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="7 days">
@endsection

@section('preload')
@php
    // Preload the first card LCP image when lists available from controller
    $firstCase = isset($caselists) ? $caselists->first() : null;
    $firstCaseImg = ($firstCase && isset($firstCase->image) && $firstCase->image != "")
        ? asset('images/blog/' . $firstCase->image)
        : asset('images/CaseStudies-card.webp');
@endphp
<link rel="preload" as="image" href="{{ $firstCaseImg }}" fetchpriority="high">
@endsection

@section('head')
{{-- Critical ATF only — matches production hero; photo is non-LCP (20% opacity) and deferred --}}
<style>
.page-case .container{max-width:1300px!important;width:100%;margin-left:auto;margin-right:auto;padding-left:15px;padding-right:15px;box-sizing:border-box}
.page-case .experimental-case-hero{background:linear-gradient(135deg,#0a1a2e 0%,#16213e 50%,#1B4D89 100%)!important;color:#fff!important;padding:80px 0!important;text-align:center!important;position:relative!important;overflow:hidden!important}
.page-case .experimental-case-hero .container{position:relative!important;z-index:2!important}
.page-case .experimental-case-hero h1{font-size:3.5rem!important;font-weight:700!important;margin:0 0 1rem!important;text-shadow:2px 2px 8px rgba(0,0,0,.6)!important;color:#fff!important;line-height:1.2!important}
.page-case .experimental-case-hero p{font-size:1.3rem!important;margin:0 auto 2rem!important;max-width:700px!important;text-shadow:1px 1px 3px rgba(0,0,0,.4)!important;color:#f1f3f4!important;line-height:1.6!important}
.page-case .experimental-case-hero .breadcrumbs{margin-bottom:0!important}
/* Reserve card column layout so deferred Bootstrap cannot cause CLS */
.page-case .ftco-section{padding:3rem 0}
.page-case .bg-light{background-color:#f8f9fa!important}
.page-case .row{display:flex;flex-wrap:wrap;margin-left:-15px;margin-right:-15px}
.page-case .col-md-4,.page-case .col-lg-4{width:100%;padding-left:15px;padding-right:15px;box-sizing:border-box}
.page-case .experimental-case-card{background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.1);height:100%;border:1px solid #f0f0f0;margin-bottom:30px;display:flex;flex-direction:column}
.page-case .experimental-case-image{height:250px!important;min-height:250px!important;max-height:250px!important;background:#e8eef5;position:relative;overflow:hidden;flex:0 0 250px}
.page-case .experimental-case-image img{width:100%;height:100%;object-fit:cover;display:block}
.page-case .experimental-case-content{padding:30px;display:flex;flex-direction:column;flex:1 1 auto}
@media (min-width:768px){.page-case .col-md-4,.page-case .col-lg-4{width:33.333333%} .page-case{}.page-case .experimental-case-hero h1{font-size:3.5rem!important}}
@media (max-width:767px){.page-case .experimental-case-hero h1{font-size:2.5rem!important}.page-case .experimental-case-hero p{font-size:1.1rem!important}.page-case .experimental-case-image{height:200px!important;min-height:200px!important;max-height:200px!important;flex-basis:200px}}
</style>
@vite(['resources/css/pages/case.css'])
@endsection

@section('content')
<div class="page-case">

<!-- Modern Case Law Information Hero Section -->
<div class="experimental-case-hero">
    <div class="container">
        <h1>Recent Case Law Updates</h1>
        <p>Stay informed with the latest case law developments and legal precedents. Our team provides insights and analysis on important court decisions that may impact your legal matters across various areas of Australian law.</p>
        <p class="breadcrumbs">
            <span class="mr-2"><a href="/" style="color: #f1f3f4; text-decoration: none;">Home <i data-lucide="arrow-right" aria-hidden="true"></i></a></span>
            <span style="color: #f1f3f4;">Recent Case Law Updates <i data-lucide="arrow-right" aria-hidden="true"></i></span>
        </p>
    </div>
</div>

<!-- Main Case Law Information Section -->
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row" id="case-law-list">
            @forelse(@$caselists as $list)
                @php
                    $caseImage = (isset($list->image) && $list->image != "")
                        ? asset('images/blog/' . $list->image)
                        : asset('images/CaseStudies-card.webp');
                    // First card is LCP on mobile — never loading=lazy
                    $isLcpCandidate = $loop->first;
                @endphp
                <div class="col-md-4 col-lg-4 mb-4">
                    <div class="experimental-case-card">
                        <div class="experimental-case-image">
                            <img src="{{ $caseImage }}"
                                 alt="{{ $list->title }}"
                                 width="400"
                                 height="250"
                                 @if($isLcpCandidate)
                                   fetchpriority="high"
                                   loading="eager"
                                   decoding="sync"
                                 @else
                                   loading="lazy"
                                   decoding="async"
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
                                <i data-lucide="calendar" class="mr-2" aria-hidden="true"></i>
                                {{ \Carbon\Carbon::parse(@$list->created_at)->format('M d, Y') }}
                            </div>

                            <div class="experimental-case-excerpt">
                                {{ $list->short_description ? \Illuminate\Support\Str::limit(strip_tags($list->short_description), 120, '...') : 'Legal analysis and case summary available.' }}
                            </div>

                            <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}"
                               class="experimental-read-more">
                                Read Analysis <i data-lucide="arrow-right" aria-hidden="true"></i>
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

</div>
@endsection
