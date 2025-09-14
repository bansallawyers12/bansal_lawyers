@extends('layouts.frontend')
@section('seoinfo')
    <title>Migration Law - Expert Immigration Lawyers Melbourne | Bansal Lawyers - Experimental</title>
    <meta name="description" content="Expert immigration lawyers in Melbourne helping with visa applications, appeals, and permanent residency. Get professional migration law advice from Bansal Lawyers." />
    <meta name="keyword" content="immigration lawyer Melbourne, migration law, visa applications, permanent residency, AAT appeals, migration agent" />
    <link rel="canonical" href="{{ url('/migration-law-experimental') }}" />

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url('/migration-law-experimental') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Migration Law - Expert Immigration Lawyers Melbourne | Bansal Lawyers - Experimental">
    <meta property="og:description" content="Expert immigration lawyers in Melbourne helping with visa applications, appeals, and permanent residency. Get professional migration law advice from Bansal Lawyers.">
    <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
    <meta property="og:image:alt" content="Bansal Lawyers Logo">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="{{ url('/migration-law-experimental') }}">
    <meta name="twitter:title" content="Migration Law - Expert Immigration Lawyers Melbourne | Bansal Lawyers - Experimental">
    <meta name="twitter:description" content="Expert immigration lawyers in Melbourne helping with visa applications, appeals, and permanent residency. Get professional migration law advice from Bansal Lawyers.">
    <meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
    <meta property="twitter:image:alt" content="Bansal Lawyers Logo">

	<!-- Schema Markup for Migration Law Services -->
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "LegalService",
		"name": "Migration Law Services - Bansal Lawyers",
		"description": "Expert immigration lawyers in Melbourne helping with visa applications, appeals, and permanent residency. Get professional migration law advice from Bansal Lawyers.",
		"url": "{{ url('/migration-law-experimental') }}",
		"logo": "{{ url('/') }}{{ asset('images/logo/Bansal_Lawyers.png') }}",
		"image": "{{ url('/') }}{{ asset('images/logo/Bansal_Lawyers.png') }}",
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
		"serviceType": "Immigration Law",
		"hasOfferCatalog": {
			"@type": "OfferCatalog",
			"name": "Immigration Law Services",
			"itemListElement": [
				{
					"@type": "Offer",
					"itemOffered": {
						"@type": "Service",
						"name": "Visa Applications",
						"description": "Expert assistance with all types of Australian visa applications"
					}
				},
				{
					"@type": "Offer",
					"itemOffered": {
						"@type": "Service",
						"name": "Appeals & Reviews",
						"description": "Representation in AAT and Federal Court appeals"
					}
				},
				{
					"@type": "Offer",
					"itemOffered": {
						"@type": "Service",
						"name": "Permanent Residency",
						"description": "Guidance through permanent residency and citizenship process"
					}
				},
				{
					"@type": "Offer",
					"itemOffered": {
						"@type": "Service",
						"name": "Visa Compliance",
						"description": "Assistance with visa compliance and conditions"
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
				"item": "{{ url('/') }}"
			},
			{
				"@type": "ListItem",
				"position": 2,
				"name": "Practice Areas",
				"item": "{{ url('/practice-areas-experimental') }}"
			},
			{
				"@type": "ListItem",
				"position": 3,
				"name": "Migration Law",
				"item": "{{ url('/migration-law-experimental') }}"
			}
		]
	}
	</script>

	<!-- FAQ Schema -->
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity": [
			{
				"@type": "Question",
				"name": "What types of visas can Bansal Lawyers help with?",
				"acceptedAnswer": {
					"@type": "Answer",
					"text": "We assist with all types of Australian visas including student visas, partner visas, skilled visas, business visas, visitor visas, and permanent residency applications."
				}
			},
			{
				"@type": "Question",
				"name": "How long does a visa application take?",
				"acceptedAnswer": {
					"@type": "Answer",
					"text": "Processing times vary by visa type. Student visas typically take 1-4 months, partner visas 12-24 months, and skilled visas 6-12 months. We provide accurate timelines based on current processing times."
				}
			},
			{
				"@type": "Question",
				"name": "What if my visa is refused?",
				"acceptedAnswer": {
					"@type": "Answer",
					"text": "If your visa is refused, we can help you appeal the decision through the Administrative Appeals Tribunal (AAT) or Federal Court. We review the refusal reasons and prepare strong legal arguments for your case."
				}
			},
			{
				"@type": "Question",
				"name": "Do I need a migration agent for my visa application?",
				"acceptedAnswer": {
					"@type": "Answer",
					"text": "While not mandatory, using a registered migration agent significantly increases your chances of success. We ensure your application is complete, accurate, and complies with current immigration laws."
				}
			}
		]
	}
	</script>

@endsection

@section('content')

<style>
/* Experimental Migration Law Page Styles */
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

.content-section {
    padding: 80px 0;
    background: var(--white);
}

.content-section h1, .content-section h2, .content-section h3 {
    font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
    line-height: 1.2em;
    color: var(--primary-color);
}

.content-section h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.content-section h2 {
    font-size: 2rem;
    margin: 2rem 0 1rem 0;
}

.content-section h3 {
    font-size: 1.5rem;
    margin: 1.5rem 0 1rem 0;
}

.content-section p {
    color: var(--text-dark);
    font-size: 1.1rem;
    line-height: 1.7em;
    font-weight: 500;
    margin-bottom: 1.5rem;
}

.content-section ul {
    margin-bottom: 1.5rem;
}

.content-section ul li {
    color: var(--text-dark);
    font-size: 1.1rem;
    line-height: 1.6em;
    margin-bottom: 0.8rem;
}

.content-section ul li strong {
    color: var(--primary-color);
}

.sidebar {
    background: var(--bg-light);
    padding: 40px 30px;
    border-radius: 15px;
    box-shadow: var(--shadow);
    height: fit-content;
    position: sticky;
    top: 100px;
}

.sidebar h5 {
    color: var(--primary-color);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
}

.related-page {
    background: var(--white);
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.related-page:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.related-page img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;
}

.related-page h6 {
    color: var(--primary-color);
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
}

.related-page a {
    color: var(--accent-color);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.related-page a:hover {
    color: var(--primary-color);
}

.contact-form {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 30px;
    border-radius: 15px;
    margin-top: 30px;
}

.contact-form h5 {
    color: var(--white);
    margin-bottom: 20px;
    text-align: center;
}

.contact-form .form-control {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.3);
    color: var(--white);
    border-radius: 8px;
    padding: 12px 15px;
    margin-bottom: 15px;
}

.contact-form .form-control::placeholder {
    color: rgba(255,255,255,0.7);
}

.contact-form .form-control:focus {
    background: rgba(255,255,255,0.2);
    border-color: var(--accent-color);
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
    color: var(--white);
}

.contact-form .btn {
    background: var(--gradient-accent);
    border: none;
    padding: 12px 30px;
    border-radius: 50px;
    color: var(--white);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    width: 100%;
    transition: all 0.3s ease;
}

.contact-form .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(255, 107, 53, 0.3);
}

@media (max-width: 768px) {
    .experimental-hero h1 {
        font-size: 2.5rem;
    }
    
    .content-section h1 {
        font-size: 2rem;
    }
    
    .content-section h2 {
        font-size: 1.5rem;
    }
    
    .sidebar {
        margin-top: 40px;
        position: static;
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
                <li class="breadcrumb-item">
                    <a href="/practice-areas-experimental" style="color: #1B4D89; text-decoration: none;">Practice Areas</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color: #6c757d;">
                    Migration Law
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- Experimental Hero Section -->
<section class="experimental-hero">
    <div class="container">
        <h1>Migration Law</h1>
        <p>Let's start with you to understand Australian Immigration System</p>
    </div>
</section>

<!-- Main Content Section -->
<section class="content-section">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="content-section">
                    <h1>Migration Law</h1>
                    <p>Let's start with you to understand Australian Immigration System</p>

                    <h2>Immigration Law Services Across Australia</h2>
                    <p>In Australia Immigration Law always get change and it's too complex to understand. So Bansal Lawyers help you to know the legal process, when you are applying for the visa, trying to get Australian Permanent Residency or You need to assistance regarding appeals. Our Best Immigration Lawyers team in Melbourne Australia, provides you the clear and personalized advice that help you to get solution you need.</p>

                    <h2>How We Can Help You</h2>
                    <p>At Bansal Lawyers, experienced immigration lawyers in Melbourne Australia provide full support for your immigration journey. If you are applying for any Australian Visa, appeal for any immigration decision, or looking for Australian PR, we are here to help you in these matters step to step of the way.</p>

                    <ul>
                        <li><strong>Visa Applications:</strong> Our team provides expert assistance with all types of Australian visa applications, including student, partner, skilled, business, and visitor visas. We ensure that your application is complete, accurate, and aligned with current immigration laws, increasing your chances of a successful outcome.</li>
                        <li><strong>Appeals & Reviews:</strong> If your visa has been refused or cancelled, we can represent you in appeals and reviews before the Administrative Appeals Tribunal (AAT) or the Federal Court. We prepare and present strong legal arguments to support your case and advocate for your rights throughout the process.</li>
                        <li><strong>Permanent Residency & Citizenship:</strong> We guide you through every step of obtaining permanent residency and Australian citizenship. From eligibility assessments to document preparation and lodgement, we provide clear advice and reliable support tailored to your specific situation.</li>
                        <li><strong>Visa Compliance:</strong> Maintaining visa compliance is critical to your stay in Australia. We assist individuals and employers in understanding and meeting visa conditions, helping you avoid serious issues such as visa cancellations, warnings, or removal from the country.</li>
                    </ul>

                    <h2>Eligibility Criteria for Australian Visas</h2>
                    <p>Each and every visa has it's specific requirements. Same eligibility are include:</p>

                    <ul>
                        <li><strong>Student Visas:</strong> You must be enrolled in an approved educational institution.</li>
                        <li><strong>Work Visas:</strong> An employment offer or sponsorship is often needed.</li>
                        <li><strong>Family Visas:</strong> A sponsor, usually an Australian citizen or permanent resident, is required.</li>
                    </ul>

                    <h2>Types of Australian Visas</h2>
                    <p>Australian Immigration provides a range of visa options. Some of the most common are written below:</p>

                    <ul>
                        <li><strong>Visitor & Tourism Visas:</strong> Visitor Visa (Subclass 600), Electronic Travel Authority (Subclass 601), eVisitor Visa (Subclass 651), Transit Visa (Subclass 771)</li>
                        <li><strong>Study & Training Visas:</strong> Student Visa (Subclass 500), Student Guardian Visa (Subclass 590), Training Visa (Subclass 407).</li>
                        <li><strong>Work Visas:</strong> Temporary Skill Shortage Visa (Subclass 482), Employer Nomination Scheme Visa (Subclass 186), Regional Sponsored Migration Scheme Visa (Subclass 187).</li>
                        <li><strong>Family & Partner Visas:</strong> Partner Visa (Subclass 820/801 and 309/100), Child Visa (Subclass 101 and 802), Parent Visas (various subclasses), Prospective Marriage Visa (Subclass 300).</li>
                        <li><strong>Permanent Residency Visas:</strong> Skilled Independent Visa (Subclass 189), Skilled Nominated Visa (Subclass 190), Regional Visa (Subclass 191).</li>
                        <li><strong>Humanitarian & Refugee Visas:</strong> Protection Visa (Subclass 866), Refugee Visas (Subclasses 200, 201, 203, and 204), Safe Haven Enterprise Visa (Subclass 790).</li>
                        <li><strong>Bridging Visas:</strong> Bridging Visa A (Subclass 010), Bridging Visa B (Subclass 020), Bridging Visa E (Subclasses 050 and 051).</li>
                    </ul>

                    <h2>Legislation Governing Immigration in Australia</h2>
                    <p>Immigration system in Australia is governed by the Australian Migration Act 1958 (Cth). This law includes:</p>

                    <ul>
                        <li>Visa eligibility and requirements.</li>
                        <li>Responsibilities of visa applicants and sponsors.</li>
                        <li>The appeal process.</li>
                        <li>Professional standards for migration agents.</li>
                    </ul>

                    <p>At Bansal Lawyers, Best Immigration Lawyer in Melbourne will help you to understand Australia's Complicated immigration rules and guide you step by step for visa process.</p>

                    <h2>The Role of a Registered Migration Agent</h2>
                    <p>The Migration Agents Registration Authority is authorized a registered migration agent to give immigration advice and assistance. The Registered agents must be stay up to date with immigration rules and laws also follow a strict code of Conduct.</p>

                    <p>Registered migration agents can assist with:</p>

                    <ul>
                        <li>Preparing visa applications.</li>
                        <li>Providing advice on visa eligibility.</li>
                        <li>Representing you in tribunal or court.</li>
                        <li>Requesting ministerial intervention.</li>
                    </ul>

                    <p>However, migration agents cannot guarantee visa approval or expedite processing.</p>

                    <h2>Why Choose Bansal Lawyers?</h2>
                    <p>Here's why Bansal Lawyers is the right choice as Immigration Lawyer for your immigration needs:</p>

                    <ul>
                        <li><strong>Expertise Across All Areas of Immigration:</strong> We handle everything from simple visa applications to complex Federal Court appeals.</li>
                        <li><strong>Personalized Legal Services:</strong> We offer tailored advice based on your unique situation.</li>
                        <li><strong>Registered Professionals:</strong> Our lawyers are registered with MARA, ensuring compliance with Australian immigration regulations.</li>
                        <li><strong>Honest, Transparent Advice:</strong> We provide clear and realistic assessments of your case and visa prospects.</li>
                    </ul>

                    <p>Bansal Lawyers, best migration lawyers are committed to making your immigration journey easy, smooth as possible. If you are trying to apply for a Australian visa, looking for Australian permanent residency, or challenging a decision through appeals, our experienced immigration lawyers in Melbourne provide expert guidance, reliable representation, and practical solutions tailored to your needs. With our trusted legal support, you can approach the complex Australian immigration system with clarity and confidence.</p>

                    <p>Contact us today to learn how we can assist with your immigration law needs.</p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <h5>Related pages</h5>
                    
                    <!-- Related Page 1 -->
                    <div class="related-page">
                        <img src="{{ asset('images/criminal-law.png') }}" alt="Criminal Defense Lawyers Melbourne - Assault Charges and Legal Defense" width="60" height="60">
                        <h6>Jurisdictional Error/ Federal Circuit Court Application</h6>
                        <a href="/criminal-law-experimental">READ THIS MORE >></a>
                    </div>

                    <!-- Related Page 2 -->
                    <div class="related-page">
                        <img src="{{ asset('images/family-law.png') }}" alt="Family Law Lawyers Melbourne - Divorce, Separation and Child Custody" width="60" height="60">
                        <h6>Family Law Services</h6>
                        <a href="/family-law-experimental">READ THIS MORE >></a>
                    </div>

                    <!-- Related Page 3 -->
                    <div class="related-page">
                        <img src="{{ asset('images/commercial-law.png') }}" alt="Commercial Law Lawyers Melbourne - Business Contracts and Legal Solutions" width="60" height="60">
                        <h6>Commercial Law Services</h6>
                        <a href="/commercial-law-experimental">READ THIS MORE >></a>
                    </div>

                    <!-- Contact Form -->
                    <div class="contact-form">
                        <h5>Get Legal Advice</h5>
                        <form action="{{ url('/contact_lawyer') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control" rows="4" placeholder="Message" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn">GET LEGAL ADVICE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
