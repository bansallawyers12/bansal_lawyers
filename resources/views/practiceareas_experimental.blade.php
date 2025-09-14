@extends('layouts.frontend')
@section('seoinfo')
	<title>Immigration, family and more lawyers consultation in Melbourne - Experimental</title>
	<meta name="description" content="If you are looking expert lawyers consultation in Melbourne? Get professional legal advice from experienced lawyers to guide you legal challenges with confidence." />

    <meta name="keyword" content="Discover trusted legal services in Australia with Bansal Lawyers. Specializing in family law, immigration, property disputes, and more. Get expert legal help today!" />

    <link rel="canonical" href="<?php echo URL::to('/'); ?>/practice-areas-experimental" />

	<!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/practice-areas-experimental">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Legal Services in Australia | Family, Immigration, Property & More - Experimental">
    <meta property="og:description" content="Discover trusted legal services in Australia with Bansal Lawyers. Specializing in family law, immigration, property disputes, and more. Get expert legal help today!">
    <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="og:image:alt" content="Bansal Lawyers Logo">


	<!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/practice-areas-experimental">
    <meta name="twitter:title" content="Legal Services in Australia | Family, Immigration, Property & More - Experimental">
    <meta name="twitter:description" content="Discover trusted legal services in Australia with Bansal Lawyers. Specializing in family law, immigration, property disputes, and more. Get expert legal help today!">
	<meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="twitter:image:alt" content="Bansal Lawyers Logo">

	<!-- Schema Markup for Legal Services -->
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "LegalService",
		"name": "Bansal Lawyers - Practice Areas",
		"description": "Comprehensive legal services across multiple practice areas including family law, immigration, criminal law, commercial law, and property law in Melbourne, Australia.",
		"url": "<?php echo URL::to('/'); ?>/practice-areas-experimental",
		"logo": "<?php echo URL::to('/'); ?>{{ asset('images/logo/Bansal_Lawyers.png') }}",
		"image": "<?php echo URL::to('/'); ?>{{ asset('images/logo/Bansal_Lawyers.png') }}",
		"address": {
			"@type": "PostalAddress",
			"streetAddress": "Level 8/278 Collins St",
			"addressLocality": "Melbourne",
			"addressRegion": "VIC",
			"postalCode": "3000",
			"addressCountry": "AU"
		},
		"telephone": "+61 0422905860",
		"email": "Info@bansallawyers.com.au",
		"areaServed": {
			"@type": "City",
			"name": "Melbourne"
		},
		"serviceType": [
			"Family Law",
			"Immigration Law", 
			"Criminal Law",
			"Commercial Law",
			"Property Law"
		],
		"hasOfferCatalog": {
			"@type": "OfferCatalog",
			"name": "Legal Services",
			"itemListElement": [
				{
					"@type": "Offer",
					"itemOffered": {
						"@type": "Service",
						"name": "Family Law Services",
						"description": "Divorce, separation, children, property and other family law matters"
					}
				},
				{
					"@type": "Offer", 
					"itemOffered": {
						"@type": "Service",
						"name": "Immigration Law Services",
						"description": "Visa applications, appeals, permanent residency, and citizenship matters"
					}
				},
				{
					"@type": "Offer",
					"itemOffered": {
						"@type": "Service", 
						"name": "Criminal Law Services",
						"description": "Assault charges, traffic offenses, and criminal defense"
					}
				},
				{
					"@type": "Offer",
					"itemOffered": {
						"@type": "Service",
						"name": "Commercial Law Services", 
						"description": "Business contracts, disputes, mergers, and acquisitions"
					}
				},
				{
					"@type": "Offer",
					"itemOffered": {
						"@type": "Service",
						"name": "Property Law Services",
						"description": "Real estate transactions, property disputes, and leasing agreements"
					}
				}
			]
		}
	}
	</script>

	<!-- Breadcrumb Schema -->
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "BreadcrumbList",
		"itemListElement": [
			{
				"@type": "ListItem",
				"position": 1,
				"name": "Home",
				"item": "<?php echo URL::to('/'); ?>"
			},
			{
				"@type": "ListItem",
				"position": 2,
				"name": "Practice Areas",
				"item": "<?php echo URL::to('/'); ?>/practice-areas-experimental"
			}
		]
	}
	</script>

@endsection
@section('content')

<style>
/* Experimental Practice Areas Page Styles */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --text-dark: #2c3e50;
    --text-light: #7f8c8d;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --shadow: 0 20px 40px rgba(0,0,0,0.1);
    --shadow-hover: 0 30px 60px rgba(0,0,0,0.15);
    --gradient-primary: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
    --gradient-accent: linear-gradient(135deg, #FF6B35 0%, #FF8E53 100%);
}

.experimental-hero {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
    text-align: center;
}

.experimental-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset("images/PracticeArea.jpg") }}') center/cover;
    opacity: 0.3;
    z-index: 1;
}

.experimental-hero .container {
    position: relative;
    z-index: 2;
}

.experimental-hero h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.experimental-hero p {
    font-size: 1.3rem;
    max-width: 800px;
    margin: 0 auto;
    opacity: 0.95;
}

.experimental-practice-grid {
    padding: 80px 0;
    background: var(--bg-light);
}

.practice-card {
    background: var(--white);
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.practice-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: var(--gradient-primary);
}

.practice-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-hover);
}

.practice-card .icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 30px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--white);
}

.practice-card h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 20px;
}

.practice-card p {
    color: var(--text-light);
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 30px;
}

.practice-card .btn {
    background: var(--gradient-accent);
    border: none;
    padding: 12px 30px;
    border-radius: 50px;
    color: var(--white);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.practice-card .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(255, 107, 53, 0.3);
}

.section-title {
    text-align: center;
    margin-bottom: 60px;
}

.section-title h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 20px;
}

.section-title p {
    font-size: 1.2rem;
    color: var(--text-light);
    max-width: 600px;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .experimental-hero h1 {
        font-size: 2.5rem;
    }
    
    .practice-card {
        margin-bottom: 30px;
    }
    
    .section-title h2 {
        font-size: 2rem;
    }
}
</style>

<!-- Breadcrumb Navigation -->
<section class="breadcrumb-section" style="background: #f8f9fa; padding: 20px 0; border-bottom: 1px solid #e9ecef;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="margin: 0; background: none; padding: 0;">
                <li class="breadcrumb-item">
                    <a href="/" style="color: #1B4D89; text-decoration: none;">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color: #6c757d;">
                    Practice Areas
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- Experimental Hero Section -->
<section class="experimental-hero">
    <div class="container">
        <h1>Practice Areas</h1>
        <p>Comprehensive Legal Services Across Multiple Practice Areas</p>
    </div>
</section>

<!-- Experimental Practice Areas Grid -->
<section class="experimental-practice-grid">
    <div class="container">
        <div class="section-title">
            <h2>Our Legal Expertise</h2>
            <p>We provide comprehensive legal services across multiple practice areas to meet all your legal needs in Australia. Our experienced lawyers in Melbourne specialize in various areas of Australian law.</p>
        </div>
        
        <div class="row">
            <!-- Family Law Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="practice-card">
                    <div class="icon">
                        <i class="flaticon-family"></i>
                    </div>
                    <h3>Family Law</h3>
                    <p>Divorce, separation, children, property and other family law matters. Expert guidance for complex family situations.</p>
                    <a href="/family-law-experimental" class="btn">Read This More</a>
                </div>
            </div>

            <!-- Migration Law Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="practice-card">
                    <div class="icon">
                        <i class="flaticon-handshake"></i>
                    </div>
                    <h3>Migration Law</h3>
                    <p>The Court can review some decisions made under the Migration Act 1958. Your pathway to Australia.</p>
                    <a href="/migration-law-experimental" class="btn">Read This More</a>
                </div>
            </div>

            <!-- Criminal Law Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="practice-card">
                    <div class="icon">
                        <i class="flaticon-auction"></i>
                    </div>
                    <h3>Criminal Law</h3>
                    <p>Bankruptcy, fair work, human rights, consumer, admiralty, administrative and IP. Protecting your rights and future.</p>
                    <a href="/criminal-law-experimental" class="btn">Read This More</a>
                </div>
            </div>

            <!-- Commercial Law Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="practice-card">
                    <div class="icon">
                        <i class="flaticon-handshake"></i>
                    </div>
                    <h3>Commercial Law</h3>
                    <p>From Buying and Leasing to Dispute Resolution – Trusted Legal Guidance for All Your Property Matters</p>
                    <a href="/commercial-law-experimental" class="btn">Read This More</a>
                </div>
            </div>

            <!-- Property Law Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="practice-card">
                    <div class="icon">
                        <i class="flaticon-auction"></i>
                    </div>
                    <h3>Property Law</h3>
                    <p>Smart Legal Solutions for Smart Businesses – Simplifying Contracts, Mergers, Disputes, and Compliance</p>
                    <a href="/property-law-experimental" class="btn">Read This More</a>
                </div>
            </div>

            <!-- All Practice Areas Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="practice-card" style="background: var(--gradient-primary); color: var(--white);">
                    <div class="icon" style="background: rgba(255,255,255,0.2);">
                        <i class="flaticon-auction"></i>
                    </div>
                    <h3 style="color: var(--white);">All Practice Areas</h3>
                    <p style="color: rgba(255,255,255,0.9);">View our complete range of legal services and find the right solution for your needs.</p>
                    <a href="/practice-areas-experimental" class="btn" style="background: var(--white); color: var(--primary-color);">View All Services</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
