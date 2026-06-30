@extends('layouts.frontend')

@section('seoinfo')
@php
    // Force canonical URLs to always use www for SEO consistency
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

<!-- Facebook Meta Tags -->
<meta property="og:url" content="{{ $ogUrl }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ isset($currentPage) && $currentPage > 1 ? 'Legal Insights & Updates - Page ' . $currentPage . ' | Bansal Lawyers Blog Melbourne' : 'Legal Insights & Updates | Bansal Lawyers Blog Melbourne' }}">
<meta property="og:description" content="{{ isset($currentPage) && $currentPage > 1 ? 'Browse page ' . $currentPage . ' of our legal insights and updates. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more from Bansal Lawyers Melbourne.' : 'Stay informed with Bansal Lawyers\' blog. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more. Benefit from the knowledge of our experienced Melbourne team.' }}">
<meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="og:image:alt" content="Bansal Lawyers Logo">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="bansallawyers.com.au">
<meta property="twitter:url" content="{{ $ogUrl }}">
<meta name="twitter:title" content="{{ isset($currentPage) && $currentPage > 1 ? 'Legal Insights & Updates - Page ' . $currentPage . ' | Bansal Lawyers Blog Melbourne' : 'Legal Insights & Updates | Bansal Lawyers Blog Melbourne' }}">
<meta name="twitter:description" content="{{ isset($currentPage) && $currentPage > 1 ? 'Browse page ' . $currentPage . ' of our legal insights and updates. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more from Bansal Lawyers Melbourne.' : 'Stay informed with Bansal Lawyers\' blog. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more. Benefit from the knowledge of our experienced Melbourne team.' }}">
<meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta property="twitter:image:alt" content="Bansal Lawyers Logo">

<!-- Structured Data for Pagination - Temporarily disabled for testing -->
@endsection

@section('head')
<link rel="stylesheet" href="{{ asset('css/blog-listing.css') }}?v=1.0">
@endsection

@section('content')
<!-- Experimental Blog Hero Section -->
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

<!-- Blog Statistics -->
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

<!-- Main Content Section -->
<section class="ftco-section bg-light">
    <div class="container">
        <!-- Category Filter Section -->
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
        
        <!-- Blog Posts Grid -->
        <div class="row" id="blog-list">
            @forelse($bloglists as $list)
                <div class="col-md-4 col-lg-4 mb-4">
                    <div class="experimental-blog-card">
                        @php
                            $imagePath = isset($list->image) && $list->image != "" 
                                ? 'images/blog/' . $list->image 
                                : 'images/Blog.jpg';
                            $pathInfo = pathinfo($imagePath);
                            $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
                            // Check for optimized 400px version for blog listing
                            $webpPath400 = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '-400.webp';
                            $hasWebP = file_exists(public_path($webpPath));
                            $hasWebP400 = file_exists(public_path($webpPath400));
                            // Use 400px version for listing if available, otherwise use full size
                            $optimizedWebpPath = $hasWebP400 ? $webpPath400 : ($hasWebP ? $webpPath : $imagePath);
                        @endphp
                        <div class="experimental-blog-image" 
                             style="background-image: url('{!! asset($optimizedWebpPath) !!}');">
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
                                <i data-lucide="calendar" class="mr-2"></i>
                                {{ date('M d, Y', strtotime($list->created_at)) }}
                            </div>
                            
                            <div class="experimental-blog-excerpt">
                                {{ $list->description ? \Illuminate\Support\Str::limit(strip_tags($list->description), 120, '...') : 'No description available.' }}
                            </div>
                            
                            <a href="{{ route('blog.detail', $list->slug) }}" 
                               class="experimental-read-more">
                                Read More <i data-lucide="arrow-right"></i>
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
                            View All Posts <i data-lucide="arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination Section -->
        @if($bloglists->hasPages())
            <div class="row">
                <div class="col-md-12">
                    {{ $bloglists->links() }}
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
