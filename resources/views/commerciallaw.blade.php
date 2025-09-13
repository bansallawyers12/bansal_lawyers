@extends('layouts.frontend')
@section('seoinfo')
    <?php if( isset($pagedata->meta_title) && $pagedata->meta_title != "") { ?>
        <title>{{@$pagedata->meta_title}}</title>
    <?php }  else { ?>
        <title>Commercial Lawyers Melbourne | Business Contracts & Legal Solutions Australia | Bansal Lawyers</title>
    <?php } ?>

    <?php if( isset($pagedata->meta_description) && $pagedata->meta_description != "") { ?>
        <meta name="description" content="{{@$pagedata->meta_description}}" />
    <?php }  else { ?>
        <meta name="description" content="Need expert commercial law advice? Bansal Lawyers in Melbourne specializes in business contracts, disputes, and legal solutions. Get professional legal guidance for your business today!" />
    <?php } ?>

    <?php if( isset($pagedata->meta_keyward) && $pagedata->meta_keyward != "") { ?>
        <meta name="keyword" content="{{@$pagedata->meta_keyward}}" />
    <?php }  else { ?>
        <meta name="keyword" content="Need expert commercial law advice? Bansal Lawyers in Melbourne specializes in business contracts, disputes, and legal solutions. Get professional legal guidance for your business today!" />
    <?php } ?>

	<?php
	if( isset($pagedata->slug) && $pagedata->slug != "")
    { ?>
        <link rel="canonical" href="<?php echo URL::to('/'); ?>/{{@$pagedata->slug}}" />

        <!-- Facebook Meta Tags -->
        <meta property="og:url" content="<?php echo URL::to('/'); ?>/{{@$pagedata->slug}}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{@$pagedata->meta_title}}">
        <meta property="og:description" content="{{@$pagedata->meta_description}}">
        <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
        <meta property="og:image:alt" content="Bansal Lawyers Logo">

        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="bansallawyers.com.au">
        <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/{{@$pagedata->slug}}">
        <meta name="twitter:title" content="{{@$pagedata->meta_title}}">
        <meta name="twitter:description" content="{{@$pagedata->meta_description}}">
        <meta name="twitter:title" content="{{@$pagedata->meta_title}}">
        <meta name="twitter:description" content="{{@$pagedata->meta_description}}">
        <meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
        <meta property="twitter:image:alt" content="Bansal Lawyers Logo">
    <?php
    }
	else
    { ?>
        <link rel="canonical" href="<?php echo URL::to('/'); ?>/commercial-law" />


        <!-- Facebook Meta Tags -->
        <meta property="og:url" content="<?php echo URL::to('/'); ?>/commercial-law">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Commercial Lawyers Melbourne | Business Contracts & Legal Solutions Australia | Bansal Lawyers">
        <meta property="og:description" content="Need expert commercial law advice? Bansal Lawyers in Melbourne specializes in business contracts, disputes, and legal solutions. Get professional legal guidance for your business today!">
        <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
        <meta property="og:image:alt" content="Bansal Lawyers Logo">

        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="bansallawyers.com.au">
        <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/commercial-law">
        <meta name="twitter:title" content="Commercial Lawyers Melbourne | Business Contracts & Legal Solutions Australia | Bansal Lawyers">
        <meta name="twitter:description" content="Need expert commercial law advice? Bansal Lawyers in Melbourne specializes in business contracts, disputes, and legal solutions. Get professional legal guidance for your business today!">
        <meta name="twitter:title" content="Commercial Lawyers Melbourne | Business Contracts & Legal Solutions Australia | Bansal Lawyers">
        <meta name="twitter:description" content="Need expert commercial law advice? Bansal Lawyers in Melbourne specializes in business contracts, disputes, and legal solutions. Get professional legal guidance for your business today!">
        <meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
        <meta property="twitter:image:alt" content="Bansal Lawyers Logo">
    <?php
    } ?>

@endsection
@section('content')
    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Content Section */
        .content-section {
            width: 100%;
            max-width: 1200px;
            margin: 30px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .content-section h1 {
            font-size: 3rem;
            color: #002247;
            /* Main heading color */
            text-align: center;
            /* Center-aligned heading */
            margin-bottom: 20px;
        }

        .content-section h2 {
            font-size: 2rem;
            color: #333;
            /* Subheading color */
            margin-bottom: 15px;
            text-align: left;
            /* Align subheadings to the left */
        }

        .content-section p {
            /*font-size: 1.1rem;
            line-height: 1.6;*/
            margin-bottom: 20px;
            text-align: left;
            /* Align paragraphs to the left */
            color: #333;
            /* Paragraph color */
        }

        .content-section ul {
            margin: 20px 0;
            padding-left: 40px;
            /* Add space for the bullets */
        }

        .content-section ul li {
            list-style-type: disc;
            margin-bottom: 10px;
            color: #002247;
            /* Bullet point text color */
            text-align: left;
            /* Align bullet points to the left */
        }

        .content-section h3 {
            color: #002247;
            margin-top: 20px;
            font-size: 1.5rem;
            text-align: left;
            /* Align subheadings to the left */
        }
    </style>
    <style>
        .field--name-field-learn-more-about {
			font-family: "Archivo", Arial, Verdana, sans-serif;
			font-style: normal;
			font-weight: 600;
			font-size: 1.0625rem;
			line-height: 132%;
			letter-spacing: -0.01em;
		}

		.field--name-field-learn-more-about .paragraph--type--learn-more-about-list {
			padding: 3.5rem 0 3rem 0;
		}

		.field--name-field-learn-more-about {
			font-family: "Archivo", Arial, Verdana, sans-serif;
			font-style: normal;
			font-weight: 600;
			font-size: 1.0625rem;
			line-height: 132%;
			letter-spacing: -0.01em;
		}

		.field--name-field-learn-more-about .layout--onecol {
			-webkit-align-self: center;
			-ms-flex-item-align: center;
			align-self: center;
		}

		.field--name-field-learn-more-about .layout__region--content {
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-webkit-align-items: center;
			-ms-flex-align: center;
			align-items: center;
		}


		.field--name-field-learn-more-about {
			font-family: "Archivo", Arial, Verdana, sans-serif;
			font-style: normal;
			font-weight: 600;
			font-size: 1.0625rem;
			line-height: 132%;
			letter-spacing: -0.01em;
		}

		.field--name-field-learn-more-about .field__label, .field--name-field-learn-more-about .field--name-field-related-item {
			height: 32px;
		}

		.flex-container {
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-flex-wrap: wrap;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
		}

		.field--name-paragraph--learn-more-about {
			width: 302px;
			height: 96px;
			background: grey;
			margin: 1rem 2rem 1rem 0;
			padding: 0.5rem 1rem 0.5rem 0.5rem;
			/*border-radius: 34px;*/
			-webkit-box-shadow: 0px 0px 16px rgba(0, 0, 0, 0.06);
			box-shadow: 0px 0px 16px rgba(0, 0, 0, 0.06);
			-webkit-transition: all 0.3s ease;
			-o-transition: all 0.3s ease;
			transition: all 0.3s ease;
		}

		.fl-buttons {
			background: #1B4D89 !important;
			display: inline-grid;
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-pack: justify;
			-webkit-justify-content: space-between;
			-ms-flex-pack: justify;
			justify-content: space-between;
		}


		.field--name-field-learn-more-about .layout--onecol {
			-webkit-align-self: center;
			-ms-flex-item-align: center;
			align-self: center;
		}

		.field--name-field-learn-more-about .layout__region--content {
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-webkit-align-items: center;
			-ms-flex-align: center;
			align-items: center;
		}

		.field--name-field-learn-more-about .field--type-entity-reference {
			margin: 0 !important;
		}

		.content img {
			max-width: 100%;
			height: auto;
		}

		.field--name-field-learn-more-about img {
			padding-left: 0.5rem;
		}

		.fl-buttons a {
			/*padding: 0 1rem;
			margin-right: 0.1875rem;
			max-width: 185px;*/
			color: #FFFFFF !important;
			font-family: "Archivo", Arial, Verdana, sans-serif;
			font-style: normal;
			font-weight: 600;
			font-size: 1.0625rem;
			line-height: 132%;
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-webkit-align-items: center;
			-ms-flex-align: center;
			align-items: center;
			letter-spacing: -0.01em;
			align-items: center;
			background-repeat: no-repeat;
			-webkit-background-size: 4rem 4rem;
			background-size: 4rem;
			background-position: left;
		}

        .widget-post {
            /*border: 1px solid #ddd;
            box-shadow: 1px 2px 5px #ccc;*/
            min-height: 400px;
            padding: 20px;
        }

        .widget-post .widget-header {
            font-size: 2rem;
            /*margin-top:36px;*/
        }

        .elementor-widget-container {
            transition: background .3s, border .3s, border-radius .3s, box-shadow .3s, transform var(--e-transform-transition-duration, .4s);
            --grid-row-gap: 35px;
            --grid-column-gap: 30px;
        }

        .elementor-grid {
            display: grid;
            grid-column-gap: var(--grid-column-gap);
            grid-row-gap: var(--grid-row-gap);
            grid-template-columns: repeat(1, 1fr);
        }

        .title {
            line-height: 1;
            margin: 0px;
            padding-top: 25px;
            font-size: 1.75rem;
            margin-block-start: .5rem;
            margin-block-end: 1rem;
            font-family: inherit;
            font-weight: 500;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
        }

        .elementor-posts .elementor-post {
            display: flex;
            flex-direction: column;
            transition-duration: .25s;
            transition-property: background, border, box-shadow;
        }

        .elementor-posts-container .elementor-post {
            margin: 0;
            padding: 0;
        }

        .elementor-grid .elementor-grid-item {
            min-width: 0;
        }

        .elementor-posts .elementor-post__card {
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .15);
            background-color: #fff;
            border: 0 solid #69727d;
            border-radius: 3px;
            display: flex;
            flex-direction: column;
            min-height: 100%;
            overflow: hidden;
            position: relative;
            transition: all .25s;
            width: 100%;
        }

        .elementor-post__thumbnail {
            margin: 20px 20px 0px 20px;
        }

        .elementor-post__thumbnail__link {
            width: 100%;
        }

        .elementor-posts--thumbnail-top .elementor-post__thumbnail__link {
            margin-bottom: 20px;
        }

        .elementor-posts-container .elementor-post__thumbnail__link {
            display: block;
            position: relative;
            width: 100%;
        }

        .elementor-post__text {
            /*margin-top: 20px;*/
            margin-bottom: 0;
            padding: 0 30px;
            width: 100%;
            display: var(--item-display, block);
            flex-direction: column;
            flex-grow: 1;
            box-sizing: border-box;
        }

        .elementor-post__title {
            font-size: 21px;
            margin: 0;
            margin-block-start: .5rem;
            margin-block-end: 1rem;
            font-family: inherit;
            font-weight: 500;
            line-height: 1.2;
            color: inherit;
        }

        .elementor-post__text a {
            color: #002247;
            text-decoration: underline;
        }
        .elementor-post__read-more {
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .mb-4, .my-4 {
            margin-bottom : 0px !important;
        }

        .consultation .form-control {
            height: 52px !important;
            width: 85%;
            margin: 20px 0px 20px 20px;
            border: 1px solid grey !important;
            background: #002247 !important;
            color: #FFF !important;
        }

        .contactus_div {
            margin-left: 0px;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .15);
            background-color: #fff;
            border: 0 solid #69727d;
            border-radius: 3px;
            display: flex;
            flex-direction: column;
            min-height: 100%;
            overflow: hidden;
            position: relative;
            transition: all .25s;
            width: 100%;
        }

        @media (max-width: 768px) {
            .left-side{
                flex: 0 0 100%;
                max-width: 100%;
                padding-left: 10px;
                padding-right: 10px;
            }
            .right-side{
                flex: 0 0 100%;
                max-width: 100%;
                margin-top: -25px;
                border-radius: 8px;
            }

            .contactus_div {
                width: 127%;
            }
        }

        @media (min-width: 769px) {
            .full_side{
                margin: 80px 40px 0 25px;
            }
            .left-side{
                flex: 0 0 66.666667%;
                max-width: 66.666667%;
                display: inline-block;
                padding-left: 30px;
            }
            .right-side{
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
                float: right;
                padding-left: 25px;
                margin-top: -25px;
                border-radius: 8px;
                padding-right: 100px;
            }
        }
    </style>

    <div class="full_side">
        <!-- Start left-side Code -->
        <div class="content-section left-side">
            <h1>Commercial Law Experts in Australia</h1>

            <p>Comprehensive Legal Solutions for Businesses and Corporations</p>

            <h2>What is Commercial Law?</h2>

            <p>Commercial law, also known as business law, governs the legal rights, relations, and conduct of businesses and commercial entities. In Australia, commercial law includes a wide range of legal services related to business operations, including contracts, mergers, acquisitions, intellectual property, and dispute resolution. Commercial law is essential for businesses to ensure compliance with Australian regulations and protect their interests.</p>
          <p>At Bansal Lawyers, provides the trusted Commercial Law Service in Melbourne, Australia. Our team give best legal advice for all types of businesses. If you are starting a small company or Managing large organization in Australia, Our experienced commercial lawyers are here to support your success with practical and results-driven legal solutions.</p>
          <p>Understanding commercial law in Australia can be challenging, but our team make it easier by combining our legal skills with effective knowledge of commercial law – it demands a deep understanding of business operations and industry dynamics. At Bansal Lawyers, we combine our legal expertise with commercial insight to help clients protect their interests, manage risks, and achieve long-term growth.</p>

            <h3>Our Expertise in Commercial Law</h3>

            <p>At Bansal Lawyers, we offer expert legal services across various aspects of commercial law. Our services include:</p>

            <ul>
                <li><strong>Business Formation and Structuring:</strong> Advising on the best structure for your business (e.g., sole trader, partnership, company) to minimize risks and maximize growth.</li>
                <li><strong>Contract Law:</strong> Drafting, reviewing, and negotiating commercial contracts, including service agreements, supplier contracts, and non-disclosure agreements.</li>
                <li><strong>Corporate Governance:</strong> Providing legal support on corporate governance matters, ensuring compliance with Australian Securities and Investments Commission (ASIC) regulations and laws.</li>
                <li><strong>Intellectual Property Protection:</strong> Assisting with trademark registration, patent applications, and protecting business innovations and branding.</li>
                <li><strong>Mergers and Acquisitions:</strong> Offering advice on mergers, acquisitions, business sales, and due diligence processes to ensure smooth transactions.</li>
                <li><strong>Dispute Resolution:</strong> Representing businesses in commercial disputes, including mediation, arbitration, and litigation in state or federal courts.</li>
                <li><strong>Employment Law:</strong> Advising businesses on employee contracts, workplace policies, termination, and disputes to comply with Australian Fair Work regulations.</li>
                <li><strong>Franchise Law:</strong> Providing legal services for franchise agreements, compliance with franchise codes, and resolving franchise disputes.</li>
                <li><strong>Consumer Protection and Competition Law:</strong> Advising businesses on complying with Australian Consumer Law (ACL), including advertising practices, product liability, and fair trading laws.</li>
            </ul>
<p>We believe to build long-term relationships with our clients. If you need day-to-day legal advice or complicated commercial legal issues, our team is here to provide reliable support at every stage of your business journey. We tailor our legal strategies to suit your specific goals and industry requirements, ensuring cost-effective and efficient outcomes.</p>
            <h3>Why Do You Need a Commercial Lawyer?</h3>

            <p>Operating a business in Australia involves navigating a complex regulatory environment. A commercial lawyer can assist you with:</p>

            <ul>
                <li>Understanding and complying with federal and state laws.</li>
                <li>Protecting your business through well-drafted contracts and legal structures.</li>
                <li>Minimizing legal risks and liabilities.</li>
                <li>Ensuring your intellectual property and trademarks are legally protected.</li>
                <li>Resolving business disputes efficiently, without harming your brand reputation.</li>
            </ul>

            <p>Whether you are starting a new business, entering into contracts, or managing an established company, our team provides tailored advice to help you succeed and mitigate legal risks.</p>

            <h3>Business Formation and Structuring</h3>

            <p>Deciding the right structure for your business is critical. We assist with:</p>

            <ul>
                <li>Choosing between a sole proprietorship, partnership, or company.</li>
                <li>Registering your business with the Australian Securities and Investments Commission (ASIC).</li>
                <li>Advising on the legal and tax implications of your chosen structure.</li>
            </ul>

            <h3>Contract Law</h3>

            <p>Commercial contracts are essential to protect the rights and obligations of businesses. Our contract law services include:</p>

            <ul>
                <li>Drafting and reviewing contracts for suppliers, clients, and partners.</li>
                <li>Negotiating contract terms to avoid legal disputes.</li>
                <li>Ensuring that your contracts comply with Australian laws and protect your interests.</li>
            </ul>

            <h3>Dispute Resolution</h3>

            <p>Commercial disputes can arise over many matters, from contract disagreements to intellectual property violations. We offer:</p>

            <ul>
                <li>Mediation and negotiation to resolve disputes without litigation.</li>
                <li>Litigation services for complex commercial disputes in state and federal courts.</li>
                <li>Arbitration services for alternative dispute resolution (ADR).</li>
            </ul>

            <h3>Intellectual Property Protection</h3>

            <p>Protecting your intellectual property is vital to your business&#39;s success. We assist with:</p>

            <ul>
                <li>Trademark registration and enforcement.</li>
                <li>Patent applications and protection.</li>
                <li>Copyright registration and disputes.</li>
            </ul>

            <h3>Why Choose Bansal Lawyers for Your Commercial Legal Needs?</h3>
          <p>At Bansal Lawyers, we know and understand that in the business time always matter. That is why we will respond quickly, communicate with clients very clearly, and take action fast to solve your legal issues with minimal disruption to your operations.</p>
          <p>With lots of experience also with strong track record of handling major and high-profile commercial cases, our legal firm in Melbourne are fully prepared to help you through even the toughest legal challenges. We are committed to providing professional, honest and top-tier legal service and always focus on getting the best possible positive results.</p>
            <ul>
                <li><strong>Expert Legal Advice:</strong> We provide comprehensive legal support for businesses across all sectors.</li>
                <li><strong>Tailored Solutions:</strong> We offer practical, business-focused legal advice to help you achieve your goals.</li>
                <li><strong>Experience:</strong> With years of experience in Australian commercial law, we understand the legal landscape and help you navigate it successfully.</li>
                <li><strong>Client-Centered Approach:</strong> Your success is our priority. We work closely with you to deliver the best legal solutions.</li>
            </ul>
          <p>If you’re seeking commercial law experts in Australia, contact Bansal Lawyers today. Our dedicated team is ready to provide the legal support your business needs to thrive in a competitive environment.</p>
        </div>
        <!-- End left-side Code -->

        <!-- Start right-side Code -->
        <div class="field field--name-field-learn-more-about field--type-entity-reference-revisions field--label-hidden field__item right-side">
            <div class="paragraph paragraph--type--learn-more-about-list paragraph--view-mode--default">
                <div class="layout layout--onecol">
                    <div class="layout__region layout__region--content">
                        <div class="field field--name-field-learn-more-about field--type-entity-reference-revisions field--label-above">
                            <!-- Start Related pages -->
                            <div class="field__items flex-container widget-post" >
                                <div class="widget-header mb-4">
                                    <h5 class="title">Related pages</h5>
                                </div>

                                <div class="elementor-widget-container">
                                    <div class="elementor-posts-container elementor-posts elementor-posts--skin-cards elementor-grid elementor-has-item-ratio">

                                        <article class="elementor-post elementor-grid-item post-13164 post type-post status-publish format-standard has-post-thumbnail hentry category-school-abuse tag-nsw">
                                            <div class="elementor-post__card">
                                                <a class="elementor-post__thumbnail__link" href="/business-law" tabindex="-1">
                                                    <div class="elementor-post__thumbnail">
                                                        <img decoding="async" width="150" height="150" src="{{ asset('images/Business_Law.png') }}" alt="Business Law">
                                                    </div>
                                                </a>
                                                <div class="elementor-post__text">
                                                    <h3 class="elementor-post__title">
                                                        <a href="/business-law">Business Law</a>
                                                    </h3>
                                                    <a class="elementor-post__read-more" href="/business-law" aria-label="Read more about Business Law" tabindex="-1"> Read This More » </a>
                                                </div>
                                            </div>
                                        </article>


                                        <article class="elementor-post elementor-grid-item post-13164 post type-post status-publish format-standard has-post-thumbnail hentry category-school-abuse tag-nsw">
                                            <div class="elementor-post__card">
                                                <a class="elementor-post__thumbnail__link" href="/leasing-or-selling-a-business" tabindex="-1">
                                                    <div class="elementor-post__thumbnail">
                                                        <img decoding="async" width="150" height="150" src="{{ asset('images/leasing_and_selling_business.png') }}" alt="Leasing or selling a business">
                                                    </div>
                                                </a>
                                                <div class="elementor-post__text">
                                                    <h3 class="elementor-post__title">
                                                        <a href="/leasing-or-selling-a-business">Leasing or selling a business</a>
                                                    </h3>
                                                    <a class="elementor-post__read-more" href="/leasing-or-selling-a-business" aria-label="Read more about Leasing or selling a business" tabindex="-1"> Read This More » </a>
                                                </div>
                                            </div>
                                        </article>

                                        <article class="elementor-post elementor-grid-item post-13164 post type-post status-publish format-standard has-post-thumbnail hentry category-school-abuse tag-nsw">
                                            <div class="elementor-post__card">
                                                <a class="elementor-post__thumbnail__link" href="/leasing-or-selling-a-business" tabindex="-1">
                                                    <div class="elementor-post__thumbnail">
                                                        <img decoding="async" width="150" height="150" src="{{ asset('images/contract_or_business_agreement.png') }}" alt="Contracts or Business Agreements">
                                                    </div>
                                                </a>
                                                <div class="elementor-post__text">
                                                    <h3 class="elementor-post__title">
                                                        <a href="/contracts-or-business-agreements">Contracts or Business Agreements</a>
                                                    </h3>
                                                    <a class="elementor-post__read-more" href="/contracts-or-business-agreements" aria-label="Read more about Contracts or Business Agreements" tabindex="-1"> Read This More » </a>
                                                </div>
                                            </div>
                                        </article>


                                        <article class="elementor-post elementor-grid-item post-13164 post type-post status-publish format-standard has-post-thumbnail hentry category-school-abuse tag-nsw">
                                            <div class="elementor-post__card">
                                                <a class="elementor-post__thumbnail__link" href="/leasing-or-selling-a-business" tabindex="-1">
                                                    <div class="elementor-post__thumbnail">
                                                        <img decoding="async" width="150" height="150" src="{{ asset('images/loan_agreement.png') }}" alt="Loan Agreement">
                                                    </div>
                                                </a>
                                                <div class="elementor-post__text">
                                                    <h3 class="elementor-post__title">
                                                        <a href="/loan-agreement">Loan Agreement</a>
                                                    </h3>
                                                    <a class="elementor-post__read-more" href="/loan-agreement" aria-label="Read more about Loan Agreement" tabindex="-1"> Read This More » </a>
                                                </div>
                                            </div>
                                        </article>

                                    </div>
                                </div>










                            </div>
                            <!-- End Related pages -->

                            <!-- Start Contact Us Form -->
                            <div class="field__items flex-container widget-post" >
                                <div class="widget-header mb-4">
                                    <h5 class="title">Contact Us</h5>
                                </div>

                                <div class="elementor-widget-container">
                                    <div class="elementor-posts-container elementor-posts elementor-posts--skin-cards elementor-grid elementor-has-item-ratio">
                                        <div class="row d-md-flex justify-content-end contactus_div">
                                            @if ($message = Session::get('success'))
                                                <div class="alert alert-success" style="margin: 10px 10px 10px 10px;">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @endif
                                            <form action="<?php echo URL::to('/'); ?>/contact_lawyer" method="POST" enctype="multipart/form-data" class="consultation">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="name" style="margin-top: 20px;" placeholder="Your Name" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
                                                </div>
                                                <div class="form-group" style="text-align: center;">
                                                    <input type="submit" value="Send Message" class="btn btn-primary submit_cls">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Contact Us Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End right-side Code -->
    </div>
    @endsection
