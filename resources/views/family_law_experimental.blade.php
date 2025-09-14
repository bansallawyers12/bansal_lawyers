@extends('layouts.frontend')
@section('seoinfo')
    <title>Family Law Lawyers Melbourne | Divorce, Separation & Child Custody | Bansal Lawyers - Experimental</title>
    <meta name="description" content="Expert family law lawyers in Melbourne helping with divorce, separation, child custody, property settlements. Get professional family law advice from Bansal Lawyers." />
    <meta name="keyword" content="family law Melbourne, divorce lawyer, separation lawyer, child custody, property settlement, family law advice, parenting arrangements" />
    <link rel="canonical" href="<?php echo URL::to('/'); ?>/family-law-experimental" />

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/family-law-experimental">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Family Law Lawyers Melbourne | Divorce, Separation & Child Custody | Bansal Lawyers - Experimental">
    <meta property="og:description" content="Expert family law lawyers in Melbourne helping with divorce, separation, child custody, property settlements. Get professional family law advice from Bansal Lawyers.">
    <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
    <meta property="og:image:alt" content="Bansal Lawyers Logo">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/family-law-experimental">
    <meta name="twitter:title" content="Family Law Lawyers Melbourne | Divorce, Separation & Child Custody | Bansal Lawyers - Experimental">
    <meta name="twitter:description" content="Expert family law lawyers in Melbourne helping with divorce, separation, child custody, property settlements. Get professional family law advice from Bansal Lawyers.">
    <meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
    <meta property="twitter:image:alt" content="Bansal Lawyers Logo">

	<!-- Schema Markup for Family Law Services -->
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "LegalService",
		"name": "Family Law Services - Bansal Lawyers",
		"description": "Expert family law lawyers in Melbourne helping with divorce, separation, child custody, property settlements. Get professional family law advice from Bansal Lawyers.",
		"url": "<?php echo URL::to('/'); ?>/family-law-experimental",
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
		"serviceType": "Family Law",
		"hasOfferCatalog": {
			"@type": "OfferCatalog",
			"name": "Family Law Services",
			"itemListElement": [
				{
					"@type": "Offer",
					"itemOffered": {
						"@type": "Service",
						"name": "Divorce and Separation",
						"description": "Expert guidance for divorce and separation proceedings"
					}
				},
				{
					"@type": "Offer",
					"itemOffered": {
						"@type": "Service",
						"name": "Child Custody and Parenting Arrangements",
						"description": "Legal support for child custody and parenting arrangements"
					}
				},
				{
					"@type": "Offer",
					"itemOffered": {
						"@type": "Service",
						"name": "Property Settlement",
						"description": "Assistance with property settlement after separation"
					}
				},
				{
					"@type": "Offer",
					"itemOffered": {
						"@type": "Service",
						"name": "Spousal Maintenance",
						"description": "Legal advice on spousal maintenance matters"
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
			},
			{
				"@type": "ListItem",
				"position": 3,
				"name": "Family Law",
				"item": "<?php echo URL::to('/'); ?>/family-law-experimental"
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
				"name": "What is family law in Australia?",
				"acceptedAnswer": {
					"@type": "Answer",
					"text": "Family law in Australia is governed primarily by the Family Law Act 1975, which applies across the nation. It covers divorce, separation, child custody, property settlements, and other family-related legal matters."
				}
			},
			{
				"@type": "Question",
				"name": "How long does a divorce take in Australia?",
				"acceptedAnswer": {
					"@type": "Answer",
					"text": "In Australia, you can apply for a divorce after 12 months of separation. The divorce process typically takes 4-6 months from the time of application to finalization."
				}
			},
			{
				"@type": "Question",
				"name": "What are the key areas of family law?",
				"acceptedAnswer": {
					"@type": "Answer",
					"text": "The key areas include separation and divorce, parenting arrangements, child support, property settlement, spousal maintenance, and family dispute resolution (mediation)."
				}
			}
		]
	}
	</script>

@endsection

@section('content')

<style>
/* Experimental Family Law Page Styles */
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
                    Family Law
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- Experimental Hero Section -->
<section class="experimental-hero">
    <div class="container">
        <h1>Family Law</h1>
        <p>Your Guide to Separation, Parenting, and Property Settlements</p>
    </div>
</section>

<!-- Main Content Section -->
<section class="content-section">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="content-section">
                    <h1>Family Law</h1>
                    <p>Your Guide to Separation, Parenting, and Property Settlements</p>

                    <h2>Family Law in Australia</h2>
                    <p>At Bansal Lawyers, we always focus on family law in Australia. That I why we offer the best expert legal advice to help the client and their families rights. Our team will provide support to the clients for dealing and separation over parenting disputes, and also in property settlements. If you are married or in de facto relationship, Our team of best lawyers in Australia, is here to help you to get positive outcome and always try to make understand the family law in Australia.</p>

                    <h2>Overview of Family Law in Australia</h2>
                    <p>What is family law in Australia?</p>

                    <p>Family law in Australia is a governed primarily by the family law act 1975, which implement across the nation. In western Australia has it's own legal framework for de facto relationships, it a commonwealth system that applies to all married couples. In WA, de facto couples. In West Australia, couples who are in de facto relationship must clear the property and parenting disputes through law under the state, while if you are a married couple you have to follow the national Family Law System.</p>

                    <p>In Western Australia Family court is the only on court which handling family law matters in the state, other side across Australia, cases related to family law are deal by the Family Court Australia and Federal Circuit Court of Australia.</p>

                    <p>What are the key areas of Family Law.</p>

                    <h3>1. Separation and Divorce</h3>
                    <p>Marriage: In Australia, People get divorce on no-fault basis like no need to prove that you are in wrong doing infidelity. After the 12 months of separation, you can apply for a divorce. For marriage with time less than 2 years, couples must be required to attend the counseling with meditation before filing for divorce, until any family violence is involved.</p>

                    <p>De facto Relationships: Living with your partner in Australia from past 2 years, you considered as a de facto relationship. When you get separation in de facto relationships don't required a normal divorce until children and property got involved.</p>

                    <h3>2. Parenting Arrangements</h3>
                    <p>After separation in Australia after divorce, you will get one thing better to know that the court first consider the child where want to go with. Parents must reach the agreement about important matters about child primary considerations such as:</p>

                    <p>Children Living Arrangement</p>
                    <p>Schooling and Education</p>
                    <p>Time Spent with Family Members</p>
                    <p>Medical care and Treatment</p>

                    <p>Had to make informal agreements (verbal and written), by the Parents, or Provide these arrangements through the consent orders, which are legal and valid by the court. If both parents cannot reach the agreement process, will able to required for attend the meditation before the appearing the court for considers the case.</p>

                    <h3>3. Child Support</h3>
                    <p>Child support means to make the children future secure with contributing financial help for their children. Parents help to manage child support payment through:</p>

                    <p>Parents get to manage self manage agreements</p>
                    <p>Register Assessment based on income and care arrangements through service Australia</p>
                    <p>Courts orders for typical cases related to the children who are above then 18 years</p>

                    <h3>4. Property Settlement</h3>
                    <p>It is necessary to know that how the divide assets and debts after separation. If you are married or in de facto relationship, you must be filed property settlement applications:</p>

                    <p>If you are married have to submit property settlement within 12 months of divorce</p>
                    <p>If you are de facto couples have to submit property settlement within 2 years of sepration</p>

                    <p>Settlements can be reached informally, formalized through Consent Orders, or determined by the court if no agreement is made. Courts consider contributions (financial and non-financial) and future needs (such as health and care responsibilities).</p>

                    <h3>5. Spousal Maintenance</h3>
                    <p>In Australia Spousal maintenance might be needed due to one partner is not able to support themselves after separation. Then the court looks after the conditions like age, income source, health condition, and other financial issues which impact of the relationship before making a decision.</p>

                    <h3>6. Family Dispute Resolution (Mediation)</h3>
                    <p>Mediation is very important step to get solution for the family law issues, especially about property issues and parenting. Before going to court, people always try to resolve the issues with the help of FDR Family Dispute Resolution to reach an agreement. At the point If mediation does not works, then you need Section 60l Certificate may be needed to take the matter to court.</p>

                    <h2>Why Choose Bansal Lawyers for Your Family Law Matters?</h2>
                    <p>At Bansal Lawyers, team of best family lawyers in Melbourne understand that the family law matters can be emotionally difficult also challenging and legally complicated. Bansal Lawyers with best experienced family lawyers always is here to support you with the best guidance through the entire process, whether you are going through dealing with separation, divorce, property settlements, or parenting disputes. We offer clear, practical and personalized legal advice tailored to your situation, ensuring the best possible outcome for you and your family.</p>

                    <h2>Contact Bansal Lawyers Today</h2>
                    <p>If you're facing a family law issue, don't navigate it alone. Contact Bansal Lawyers today to schedule a consultation with our experienced family law team. We are dedicated to helping you resolve your family law matters efficiently, with empathy and expertise.</p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <h5>Related pages</h5>
                    
                    <!-- Related Page 1 -->
                    <div class="related-page">
                        <img src="{{ asset('images/migration-law.png') }}" alt="Expert Immigration Lawyers Melbourne - Visa Applications and Appeals" width="60" height="60">
                        <h6>Migration Law Services</h6>
                        <a href="/migration-law-experimental">READ THIS MORE >></a>
                    </div>

                    <!-- Related Page 2 -->
                    <div class="related-page">
                        <img src="{{ asset('images/criminal-law.png') }}" alt="Criminal Defense Lawyers Melbourne - Assault Charges and Legal Defense" width="60" height="60">
                        <h6>Criminal Law Services</h6>
                        <a href="/criminal-law-experimental">READ THIS MORE >></a>
                    </div>

                    <!-- Related Page 3 -->
                    <div class="related-page">
                        <img src="{{ asset('images/property-law.png') }}" alt="Property Law Lawyers Melbourne - Real Estate and Property Legal Services" width="60" height="60">
                        <h6>Property Law Services</h6>
                        <a href="/property-law-experimental">READ THIS MORE >></a>
                    </div>

                    <!-- Contact Form -->
                    <div class="contact-form">
                        <h5>Get Legal Advice</h5>
                        <form action="<?php echo URL::to('/'); ?>/contact_lawyer" method="POST" enctype="multipart/form-data">
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
