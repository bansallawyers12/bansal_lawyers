@extends('layouts.frontend')

@section('seoinfo')
@php
    $canonicalUrl = isset($currentPage) && $currentPage > 1
        ? 'https://www.bansallawyers.com.au/blog?page=' . $currentPage
        : 'https://www.bansallawyers.com.au/blog';
    $ogUrl = $canonicalUrl;
@endphp

@if(isset($currentPage) && $currentPage > 1)
    <title>Legal Insights & Updates - Page {{ $currentPage }} | Bansal Lawyers Blog Melbourne</title>
    <meta name="description" content="Browse page {{ $currentPage }} of our legal insights and updates. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more from Bansal Lawyers Melbourne." />
    <meta name="robots" content="noindex, follow">
    <link rel="canonical" href="{{ $canonicalUrl }}" />
@else
    <title>Legal Insights & Updates | Bansal Lawyers Blog Melbourne</title>
    <meta name="description" content="Stay informed with Bansal Lawyers' blog. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more. Benefit from the knowledge of our experienced Melbourne team." />
    <link rel="canonical" href="{{ $canonicalUrl }}" />
@endif

<meta property="og:url" content="{{ $ogUrl }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ isset($currentPage) && $currentPage > 1 ? 'Legal Insights & Updates - Page ' . $currentPage . ' | Bansal Lawyers Blog Melbourne' : 'Legal Insights & Updates | Bansal Lawyers Blog Melbourne' }}">
<meta property="og:description" content="{{ isset($currentPage) && $currentPage > 1 ? 'Browse page ' . $currentPage . ' of our legal insights and updates. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more from Bansal Lawyers Melbourne.' : 'Stay informed with Bansal Lawyers\' blog. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more. Benefit from the knowledge of our experienced Melbourne team.' }}">
<meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="og:image:alt" content="Bansal Lawyers Logo">

<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="bansallawyers.com.au">
<meta property="twitter:url" content="{{ $ogUrl }}">
<meta name="twitter:title" content="{{ isset($currentPage) && $currentPage > 1 ? 'Legal Insights & Updates - Page ' . $currentPage . ' | Bansal Lawyers Blog Melbourne' : 'Legal Insights & Updates | Bansal Lawyers Blog Melbourne' }}">
<meta name="twitter:description" content="{{ isset($currentPage) && $currentPage > 1 ? 'Browse page ' . $currentPage . ' of our legal insights and updates. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more from Bansal Lawyers Melbourne.' : 'Stay informed with Bansal Lawyers\' blog. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more. Benefit from the knowledge of our experienced Melbourne team.' }}">
<meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="twitter:image:alt" content="Bansal Lawyers Logo">
@endsection

@section('preload')
@php
    $firstBlog = isset($bloglists) ? $bloglists->first() : null;
    $firstImg = 'images/Blog.webp';
    if ($firstBlog && isset($firstBlog->image) && $firstBlog->image != '') {
        $base = 'images/blog/' . pathinfo($firstBlog->image, PATHINFO_FILENAME);
        if (file_exists(public_path($base . '-400.webp'))) {
            $firstImg = $base . '-400.webp';
        } elseif (file_exists(public_path($base . '.webp'))) {
            $firstImg = $base . '.webp';
        } else {
            $firstImg = 'images/blog/' . $firstBlog->image;
        }
    }
@endphp
<link rel="preload" as="image" href="{{ asset($firstImg) }}" fetchpriority="high">
@endsection

@section('head')
<style>
/* Critical ATF — matches production hero + freezes card grid against deferred CSS */
.page-blog .experimental-blog-hero{background:linear-gradient(135deg,#0a1a2e,#16213e,#1b4d89)!important;color:#fff!important;padding:80px 0!important;text-align:center!important;position:relative!important;overflow:hidden!important}
.page-blog .experimental-blog-hero .container{position:relative!important;z-index:2!important}
.page-blog .experimental-blog-hero h1{font-size:3.5rem!important;font-weight:700!important;margin:0 0 1rem!important;text-shadow:2px 2px 8px rgba(0,0,0,.6)!important;color:#fff!important;line-height:1.2!important}
.page-blog .experimental-blog-hero p{font-size:1.3rem!important;margin:0 auto 2rem!important;max-width:700px!important;text-shadow:1px 1px 3px rgba(0,0,0,.4)!important;color:#f1f3f4!important;line-height:1.6!important}
.page-blog .experimental-blog-stats{background:#f8f9fa;padding:20px 0;text-align:center;margin-bottom:40px}
.page-blog .experimental-stats-item{display:inline-block;margin:0 20px;text-align:center}
.page-blog .experimental-stats-number{font-size:2rem;font-weight:700;color:#1b4d89;display:block}
.page-blog .experimental-stats-label{color:#666;font-size:.9rem;text-transform:uppercase;letter-spacing:1px}
.page-blog .bg-light{background-color:#f8f9fa!important}
.page-blog .ftco-section{padding:3rem 0}
.page-blog #blog-list.row{display:flex;flex-wrap:wrap;margin-left:-15px;margin-right:-15px}
.page-blog #blog-list .col-md-4,.page-blog #blog-list .col-lg-4{width:100%;padding-left:15px;padding-right:15px;box-sizing:border-box}
.page-blog .experimental-blog-card{background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.1);height:100%;border:1px solid #f0f0f0;display:flex;flex-direction:column}
.page-blog .experimental-blog-image{width:100%;height:250px!important;min-height:250px!important;max-height:250px!important;flex:0 0 250px!important;background:#f8f9fa;position:relative;overflow:hidden}
.page-blog .experimental-blog-image img{width:100%;height:100%;object-fit:cover;object-position:center top;display:block}
@media (min-width:768px){.page-blog #blog-list .col-md-4,.page-blog #blog-list .col-lg-4{width:33.333333%;max-width:33.333333%;flex:0 0 33.333333%}}
@media (max-width:767px){.page-blog .experimental-blog-hero h1{font-size:2.5rem!important}.page-blog .experimental-blog-hero p{font-size:1.1rem!important}.page-blog .experimental-blog-image{height:200px!important;min-height:200px!important;max-height:200px!important;flex:0 0 200px!important}.page-blog .experimental-stats-item{margin:10px}}
</style>
<link rel="stylesheet" href="{{ \Illuminate\Support\Facades\Vite::asset('resources/css/pages/blog.css') }}" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="{{ \Illuminate\Support\Facades\Vite::asset('resources/css/pages/blog.css') }}"></noscript>
@endsection

@section('content')
<div class="page-blog">

<div class="experimental-blog-hero">
    <div class="container">
        <h1>
            @if(isset($category) && $category)
                {{ $category->name }} - Legal Insights
            @else
                Legal Insights & Updates
            @endif
        </h1>
        <p>Stay informed with our expert articles on legal trends, industry news, and professional insights. Our Melbourne lawyers publish practical guidance on family law, migration and visa matters, criminal defence, commercial disputes, and property law so you can understand your options before taking the next step.</p>
        <p>Whether you are dealing with a visa refusal, separation, business contract, or property transaction, browse articles written by the team at Bansal Lawyers — or <a href="/contact">contact us</a> for advice tailored to your situation.</p>
    </div>
</div>

<div class="experimental-blog-stats">
    <div class="container">
        <div class="experimental-stats-item">
            <span class="experimental-stats-number">{{ $blogData ?? 0 }}</span>
            <span class="experimental-stats-label">Total Articles</span>
        </div>
        <div class="experimental-stats-item">
            <span class="experimental-stats-number">{{ $blogCategories->count() ?? 0 }}</span>
            <span class="experimental-stats-label">Categories</span>
        </div>
        <div class="experimental-stats-item">
            <span class="experimental-stats-number">100%</span>
            <span class="experimental-stats-label">Expert Content</span>
        </div>
    </div>
</div>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="experimental-category-filter">
                    <h4>Filter by Category:</h4>
                    <div class="experimental-category-buttons">
                        <a href="{{ route('blog.index') }}" class="experimental-category-btn {{ !request('category') && !isset($category) ? 'active' : '' }}">All Categories</a>
                        @foreach($blogCategories as $cat)
                            <a href="{{ route('blog.index') }}"
                               class="experimental-category-btn {{ (isset($category) && $category->id == $cat->id) ? 'active' : '' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="blog-list">
            @forelse($bloglists as $list)
                @php
                    $imagePath = isset($list->image) && $list->image != ""
                        ? 'images/blog/' . $list->image
                        : 'images/Blog.webp';
                    $pathInfo = pathinfo($imagePath);
                    $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
                    $webpPath400 = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '-400.webp';
                    $hasWebP = file_exists(public_path($webpPath));
                    $hasWebP400 = file_exists(public_path($webpPath400));
                    $optimizedWebpPath = $hasWebP400 ? $webpPath400 : ($hasWebP ? $webpPath : $imagePath);
                    $isLcp = $loop->first;
                @endphp
                <div class="col-md-4 col-lg-4 mb-4">
                    <div class="experimental-blog-card">
                        <div class="experimental-blog-image">
                            <img src="{!! asset($optimizedWebpPath) !!}"
                                 alt="{{ $list->title }}"
                                 width="400"
                                 height="250"
                                 @if($isLcp)
                                   fetchpriority="high"
                                   loading="eager"
                                   decoding="sync"
                                 @else
                                   loading="lazy"
                                   decoding="async"
                                 @endif>
                        </div>
                        <div class="experimental-blog-content">
                            @if(isset($list->categorydetail) && $list->categorydetail)
                                <a href="{{ route('blog.index') }}"
                                   class="experimental-blog-category">
                                    {{ $list->categorydetail->name }}
                                </a>
                            @endif

                            <h3 class="experimental-blog-title">
                                <a href="{{ route('blog.detail', $list->slug) }}">
                                    {{ $list->title }}
                                </a>
                            </h3>

                            <div class="experimental-blog-meta">
                                <i data-lucide="calendar" class="mr-2" aria-hidden="true"></i>
                                {{ date('M d, Y', strtotime($list->created_at)) }}
                            </div>

                            <div class="experimental-blog-excerpt">
                                {{ $list->description ? \Illuminate\Support\Str::limit(strip_tags($list->description), 120, '...') : 'No description available.' }}
                            </div>

                            <a href="{{ route('blog.detail', $list->slug) }}"
                               class="experimental-read-more">
                                Read More <i data-lucide="arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12 text-center">
                    <div class="experimental-blog-card" style="padding: 60px 30px;">
                        <h3 style="color: #1B4D89; margin-bottom: 20px;">No Blog Posts Found</h3>
                        <p style="color: #666; font-size: 1.1rem;">
                            @if(isset($category) && $category)
                                No articles found in the "{{ $category->name }}" category.
                            @else
                                No blog posts are available at the moment.
                            @endif
                        </p>
                        <a href="{{ route('blog.index') }}" class="experimental-read-more">
                            View All Posts <i data-lucide="arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        @if($bloglists->hasPages())
            <div class="row">
                <div class="col-md-12">
                    {{ $bloglists->links('pagination.custom') }}
                </div>
            </div>
        @endif
    </div>
</section>

</div>
@endsection
