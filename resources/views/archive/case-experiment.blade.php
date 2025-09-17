@extends('layouts.frontend')
@section('seoinfo')
	<title>Case Studies - Experimental | Bansal Lawyers Melbourne</title>
	<meta name="description" content="Experimental case studies page showcasing Bansal Lawyers' successful outcomes in family law, immigration, property disputes, and more." />

    <meta name="keyword" content="experimental case studies, legal outcomes, family law, immigration, property disputes, Bansal Lawyers Melbourne" />

    <link rel="canonical" href="<?php echo URL::to('/'); ?>/case-experiment" />

	<!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/case-experiment">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Case Studies - Experimental | Bansal Lawyers Melbourne">
    <meta property="og:description" content="Experimental case studies page showcasing Bansal Lawyers' successful outcomes in family law, immigration, property disputes, and more.">
    <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
    <meta property="og:image:alt" content="Bansal Lawyers Logo">

	<!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/case-experiment">
    <meta name="twitter:title" content="Case Studies - Experimental | Bansal Lawyers Melbourne">
    <meta name="twitter:description" content="Experimental case studies page showcasing Bansal Lawyers' successful outcomes in family law, immigration, property disputes, and more.">
    <meta name="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
    <meta property="twitter:image:alt" content="Bansal Lawyers Logo">

@endsection
@section('content')

	<!--Content-->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/CaseStudies.jpg') }}');margin-bottom: 40px;max-height:422px !important;" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <h1 class="mb-3 bread">Recent Case Studies - Experimental</h1>
                    <p>Discover how Bansal Lawyers has consistently delivered successful outcomes in complex legal cases.</p>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span>
                        <span>Recent Case Studies - Experimental <i class="ion-ios-arrow-forward"></i></span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Case Studies Section with Modern Design -->
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 text-center">
                    <h2 class="mb-4">Our Success Stories</h2>
                    <p class="lead">Real cases, real results. See how our expertise has made a difference in our clients' lives.</p>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="row justify-content-center mb-5">
                <div class="col-md-8 text-center">
                    <div class="btn-group" role="group" aria-label="Case Study Filters">
                        <button type="button" class="btn btn-outline-primary active" data-filter="all">All Cases</button>
                        <button type="button" class="btn btn-outline-primary" data-filter="family">Family Law</button>
                        <button type="button" class="btn btn-outline-primary" data-filter="immigration">Immigration</button>
                        <button type="button" class="btn btn-outline-primary" data-filter="property">Property</button>
                        <button type="button" class="btn btn-outline-primary" data-filter="criminal">Criminal</button>
                    </div>
                </div>
            </div>

            <!-- Case Studies Grid -->
            <div class="row" id="case-studies-grid">
                @forelse(@$caselists as $index => $list)
                <div class="col-lg-4 col-md-6 mb-4 case-study-item" data-category="{{ strtolower(str_replace(' ', '-', $list->category ?? 'general')) }}">
                    <div class="card h-100 case-study-card">
                        <!-- Image Section -->
                        <div class="card-img-top position-relative">
                            <img loading="lazy" 
                                 src="{{ asset('images/blog/' . @$list->image) }}" 
                                 alt="{{@$list->image_alt ?? $list->title}}" 
                                 class="img-fluid w-100"
                                 style="height: 250px; object-fit: cover;">
                            <div class="card-overlay">
                                <div class="overlay-content">
                                    <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" class="btn btn-light btn-sm">
                                        <i class="fa fa-eye me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <span class="badge bg-primary mb-2">{{@$list->category ?? 'General'}}</span>
                                <h5 class="card-title">
                                    <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" class="text-decoration-none text-dark">
                                        {{@$list->title}}
                                    </a>
                                </h5>
                            </div>
                            
                            <p class="card-text text-muted flex-grow-1">
                                {{ str()->limit(@$list->short_description, 120) }}
                            </p>

                            <!-- Card Footer -->
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fa fa-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse(@$list->created_at)->format('M d, Y') }}
                                    </small>
                                    <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" class="btn btn-outline-primary btn-sm">
                                        Read More <i class="fa fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle me-2"></i>
                        No case studies available at the moment. Please check back later.
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Load More Button (if needed) -->
            @if(@$caselists && count(@$caselists) > 6)
            <div class="row justify-content-center mt-5">
                <div class="col-md-6 text-center">
                    <button class="btn btn-primary btn-lg" id="load-more-cases">
                        <i class="fa fa-plus me-2"></i>Load More Cases
                    </button>
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-item">
                        <h3 class="display-4 text-primary mb-2">{{@$caseData ?? 0}}</h3>
                        <p class="text-muted">Successful Cases</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-item">
                        <h3 class="display-4 text-primary mb-2">15+</h3>
                        <p class="text-muted">Years Experience</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-item">
                        <h3 class="display-4 text-primary mb-2">98%</h3>
                        <p class="text-muted">Success Rate</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="stat-item">
                        <h3 class="display-4 text-primary mb-2">500+</h3>
                        <p class="text-muted">Happy Clients</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
    /* Enhanced Card Styles */
    .case-study-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .case-study-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .card-img-top {
        position: relative;
        overflow: hidden;
    }

    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 34, 71, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .case-study-card:hover .card-overlay {
        opacity: 1;
    }

    .overlay-content {
        text-align: center;
    }

    .btn-group .btn {
        border-radius: 25px;
        margin: 0 5px;
        transition: all 0.3s ease;
    }

    .btn-group .btn.active,
    .btn-group .btn:hover {
        background-color: #002247;
        border-color: #002247;
        color: white;
    }

    .stat-item {
        padding: 2rem 1rem;
        border-radius: 10px;
        background: white;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-3px);
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .btn-group {
            flex-direction: column;
        }
        
        .btn-group .btn {
            margin: 2px 0;
            border-radius: 5px;
        }
        
        .case-study-card {
            margin-bottom: 2rem;
        }
    }

    /* Animation for filtering */
    .case-study-item {
        transition: all 0.3s ease;
    }

    .case-study-item.hidden {
        display: none;
    }

    /* Loading animation */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterButtons = document.querySelectorAll('[data-filter]');
        const caseItems = document.querySelectorAll('.case-study-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Filter items
                caseItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category').includes(filter)) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
            });
        });

        // Load more functionality
        const loadMoreBtn = document.getElementById('load-more-cases');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                // Add loading state
                this.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Loading...';
                this.disabled = true;
                
                // Simulate loading (replace with actual AJAX call)
                setTimeout(() => {
                    this.innerHTML = '<i class="fa fa-plus me-2"></i>Load More Cases';
                    this.disabled = false;
                }, 2000);
            });
        }
    });
    </script>
@endsection
