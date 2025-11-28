@extends('layouts.frontend')

@section('seoinfo')
@php
    $baseUrl = isset($category) && $category 
        ? url('/blog/category/' . $category->slug)
        : url('/blog');
    $canonicalUrl = isset($currentPage) && $currentPage > 1 
        ? $baseUrl . '/page-' . $currentPage
        : $baseUrl;
    $ogUrl = isset($currentPage) && $currentPage > 1 
        ? $baseUrl . '/page-' . $currentPage
        : $baseUrl;
@endphp

@if(isset($currentPage) && $currentPage > 1)
    <title>Legal Insights & Updates - Page {{ $currentPage }} | Bansal Lawyers Blog Melbourne</title>
    <meta name="description" content="Browse page {{ $currentPage }} of our legal insights and updates. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more from Bansal Lawyers Melbourne." />
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

@section('content')
<style>
/* Experimental Blog Styles */
.experimental-blog-hero {
    background: linear-gradient(135deg, #0a1a2e 0%, #16213e 50%, #1B4D89 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.experimental-blog-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset('images/Blog.jpg') }}') center/cover;
    opacity: 0.2;
    z-index: 1;
}

.experimental-blog-hero .container {
    position: relative;
    z-index: 2;
}

.experimental-blog-hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
    color: #ffffff;
}

.experimental-blog-hero p {
    font-size: 1.3rem;
    margin-bottom: 2rem;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
    color: #f1f3f4;
    line-height: 1.6;
}

.experimental-category-filter {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 40px;
    border: 1px solid #f0f0f0;
}

.experimental-category-filter h4 {
    color: #1B4D89;
    margin-bottom: 20px;
    font-weight: 600;
    font-size: 1.3rem;
}

.experimental-category-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.experimental-category-btn {
    padding: 12px 25px;
    border: 2px solid #1B4D89;
    color: #1B4D89;
    background: transparent;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-block;
}

.experimental-category-btn:hover,
.experimental-category-btn.active {
    background: #1B4D89;
    color: #fff;
    border-color: #1B4D89;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(27, 77, 137, 0.3);
    text-decoration: none;
}

.experimental-blog-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
    border: 1px solid #f0f0f0;
    margin-bottom: 30px;
}

.experimental-blog-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.experimental-blog-image {
    height: 250px;
    background-size: cover;
    background-position: center;
    position: relative;
    overflow: hidden;
}

.experimental-blog-image::after {
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

.experimental-blog-card:hover .experimental-blog-image::after {
    opacity: 1;
}

.experimental-blog-content {
    padding: 30px;
}

.experimental-blog-category {
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

.experimental-blog-category:hover {
    background: #0d3a6b;
    color: white;
    text-decoration: none;
    transform: scale(1.05);
}

.experimental-blog-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1B4D89;
    margin-bottom: 15px;
    line-height: 1.3;
    font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
}

.experimental-blog-title a {
    color: #1B4D89;
    text-decoration: none;
    transition: color 0.3s ease;
}

.experimental-blog-title a:hover {
    color: #0d3a6b;
    text-decoration: none;
}

.experimental-blog-meta {
    color: #666;
    font-size: 0.95rem;
    margin-bottom: 15px;
    font-weight: 500;
}

.experimental-blog-excerpt {
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

.experimental-blog-stats {
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

@media (max-width: 768px) {
    .experimental-blog-hero h1 {
        font-size: 2.5rem;
    }
    
    .experimental-blog-hero p {
        font-size: 1.1rem;
    }
    
    .experimental-category-buttons {
        justify-content: center;
    }
    
    .experimental-blog-image {
        height: 200px;
    }
    
    .experimental-blog-content {
        padding: 20px;
    }
    
    .experimental-stats-item {
        margin: 10px;
    }
}

/* Ensure equal card height and align button at bottom */
.experimental-blog-card {
    display: flex;
    flex-direction: column;
}

.experimental-blog-content {
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
}

.experimental-read-more {
    margin-top: auto;
    align-self: flex-start;
}
</style>

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
        <p>Stay informed with our expert articles on legal trends, industry news, and professional insights. Get the latest updates on Australian law and legal developments from our experienced Melbourne team.</p>
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
                            <a href="{{ route('blog.category', $cat->slug) }}" 
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
                            $hasWebP = file_exists(public_path($webpPath));
                        @endphp
                        <div class="experimental-blog-image" 
                             @if($hasWebP)
                                 style="background-image: url('{{ asset($webpPath) }}'); background-image: -webkit-image-set(url('{{ asset($webpPath) }}') 1x, url('{{ asset($imagePath) }}') 1x); background-image: image-set(url('{{ asset($webpPath) }}') type('image/webp'), url('{{ asset($imagePath) }}') type('image/jpeg'));"
                             @else
                                 style="background-image: url('{{ asset($imagePath) }}');"
                             @endif>
                        </div>
                        <div class="experimental-blog-content">
                            @if(isset($list->categorydetail) && $list->categorydetail)
                                <a href="{{ route('blog.category', $list->categorydetail->slug) }}" 
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
                                <i class="ion-ios-calendar mr-2"></i>
                                {{ date('M d, Y', strtotime($list->created_at)) }}
                            </div>
                            
                            <div class="experimental-blog-excerpt">
                                {{ $list->description ? \Illuminate\Support\Str::limit(strip_tags($list->description), 120, '...') : 'No description available.' }}
                            </div>
                            
                            <a href="{{ route('blog.detail', $list->slug) }}" 
                               class="experimental-read-more">
                                Read More <i class="ion-ios-arrow-forward"></i>
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
                            View All Posts <i class="ion-ios-arrow-forward"></i>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination Section -->
        @if($bloglists->hasPages())
            <div class="row">
                <div class="col-md-12">
                    {{ $bloglists->links('pagination.custom') }}
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
