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
@endsection
@section('content')
    <style>
        /* General Body Styling */
        body {
            font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
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

        .content-section h1, .content-section h2, .content-section h3 {
            font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
            line-height: 1.2em;
            color: #1B4D89;
        }
        .content-section h1{
            font-size: 30px;
        }
        .content-section h2{
            font-size: 26px;
        }
        .content-section h3{
            font-size: 22px;
        }
        .content-section p {
            color: #666;
            font-size: 18px;
            line-height: 1.7em;
            font-weight: 500;
            -webkit-font-smoothing: antialiased;
            padding-bottom: 1em;
        }
        .content-section ul li {
            list-style-type: none;
            margin-bottom: 10px;
        }
    </style>
    <style>
        .field--name-field-learn-more-about {
			font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
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
			font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
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
			font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
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
			color: #FFFFFF !important;
			font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
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
            font-size: 30px;
            padding-top: 18px;
            font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
            line-height: 1.2em;
            color: #1B4D89;
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
            color: #1B4D89;
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
            border-radius: 0 !important;
        }

        .contactus_div {
            margin-left: 0px;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .15);
            background-color: #1B4D89;
            border: 0 solid #1B4D89;
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

            /*.contactus_div {
                width: 121%;
            }*/
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
      
      
       @media (min-width: 360px) and (max-width: 730px) {
            .contactus_div {
                width: 100%;
            }
        }
      
        
    </style>

    <div class="full_side">
        <!-- Start left-side Code -->
        <div class="content-section left-side">
            <?php
            if( isset($type) && $type == "family-law" )
            { ?>

               <h1>Family Law</h1>
                <p>Your Guide to Separation, Parenting, and Property Settlements</p>

                <h2>Family Law in Australia</h2>

                <p>At Bansal Lawyers, we always focus on family law in Australia. That I why we offer the best expert legal advice to help the client and their families rights. Our team will provide support to the clients for dealing and separation over parenting disputes, and also in property settlements. If you are married or in de facto relationship, Our team of best lawyers in Australia, is here to help you to get positive outcome and always try to make understand the family law in Australia.</p>

                <h2>Overview of Family Law in Australia</h2>

                <p>What is family law in Australia?</p>

                <p>Family law in Australia is a governed primarily by the family law act 1975, which implement across the nation. In western Australia has it’s own legal framework for de facto relationships, it a commonwealth system that applies to all married couples. In WA, de facto couples. In West Australia, couples who are in de facto relationship must clear the property and parenting disputes through law under the state, while if you are a married couple you have to follow the national Family Law System.</p>

                <p>In Western Australia Family court is the only on court which handling family law matters in the state, other side across Australia, cases related to family law are deal by the Family Court Australia and Federal Circuit Court of Australia.</p>

                <p>What are the key areas of Family Law.</p>

                <h3>1. Separation and Divorce</h3>

                <p>Marriage: In Australia, People get divorce on no-fault basis like no need to prove that you are in wrong doing infidelity. After the 12 months of separation, you can apply for a divorce. For marriage with time less than 2 years, couples must be required to attend the counseling with meditation before filing for divorce, until any family violence is involved.</p>

                <p>De facto Relationships: Living with your partner in Australia from past 2 years, you considered as a de facto relationship. When you get separation in de facto relationships don’t required a normal divorce until children and property got involved.</p>

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

                <p>If you're facing a family law issue, don’t navigate it alone. Contact Bansal Lawyers today to schedule a consultation with our experienced family law team. We are dedicated to helping you resolve your family law matters efficiently, with empathy and expertise.</p>
               
            <?php
            }

            else if( isset($type) && $type == "migration-law" )
            { ?>

                <h1>Migration Law</h1>

                <p>Let’s start with you to understand Australian Immigration System</p>

                <h2>Immigration Law Services Across Australia</h2>

                <p>In Australia Immigration Law always get change and it’s too complex to understand. So Bansal Lawyers help you to know the legal process, when you are applying for the visa, trying to get Australian Permanent Residency or You need to assistance regarding appeals. Our Best Immigration Lawyers team in Melbourne Australia, provides you the clear and personalized advice that help you to get solution you need.</p>

                <h2>How We Can Help You</h2>

                <p>At Bansal Lawyers, experienced immigration lawyers in Melbourne Australia provide full support for your immigration journey. If you are applying for any Australian Visa, appeal for any immigration decision, or looking for Australian PR, we are here to help you in these matters step to step of the way.</p>

                <ul>
                    <li><strong>Visa Applications:</strong> Our team provides expert assistance with all types of Australian visa applications, including student, partner, skilled, business, and visitor visas. We ensure that your application is complete, accurate, and aligned with current immigration laws, increasing your chances of a successful outcome.</li>
                    <li><strong> Appeals &amp; Reviews:</strong> If your visa has been refused or cancelled, we can represent you in appeals and reviews before the Administrative Appeals Tribunal (AAT) or the Federal Court. We prepare and present strong legal arguments to support your case and advocate for your rights throughout the process.</li>
                    <li><strong>Permanent Residency &amp; Citizenship:</strong> We guide you through every step of obtaining permanent residency and Australian citizenship. From eligibility assessments to document preparation and lodgement, we provide clear advice and reliable support tailored to your specific situation.</li>
                    <li><strong>Visa Compliance:</strong> Maintaining visa compliance is critical to your stay in Australia. We assist individuals and employers in understanding and meeting visa conditions, helping you avoid serious issues such as visa cancellations, warnings, or removal from the country.</li>
                </ul>

                <h2>Eligibility Criteria for Australian Visas</h2>

                <p>Each and every visa has it’s specific requirements. Same eligibility are include:</p>

                <ul>
                    <li><strong>Student Visas:</strong> You must be enrolled in an approved educational institution.</li>
                    <li><strong>Work Visas:</strong> An employment offer or sponsorship is often needed.</li>
                    <li><strong>Family Visas:</strong> A sponsor, usually an Australian citizen or permanent resident, is required.</li>
                </ul>

                <h2>Types of Australian Visas</h2>

                <p>Australian Immigration provides a range of visa options. Some of the most common are written below:</p>

                <ul>
                    <li><strong>Visitor &amp; Tourism Visas:</strong> Visitor Visa (Subclass 600), Electronic Travel Authority (Subclass 601), eVisitor Visa (Subclass 651), Transit Visa (Subclass 771</li>
                    <li><strong>Study &amp; Training Visas:</strong> Student Visa (Subclass 500), Student Guardian Visa (Subclass 590), Training Visa (Subclass 407).</li>
                    <li><strong>Work Visas:</strong> Temporary Skill Shortage Visa (Subclass 482), Employer Nomination Scheme Visa (Subclass 186), Regional Sponsored Migration Scheme Visa (Subclass 187).</li>
                    <li><strong>Family &amp; Partner Visas:</strong> Partner Visa (Subclass 820/801 and 309/100), Child Visa (Subclass 101 and 802), Parent Visas (various subclasses), Prospective Marriage Visa (Subclass 300).</li>
                    <li><strong>Permanent Residency Visas:</strong> Skilled Independent Visa (Subclass 189), Skilled Nominated Visa (Subclass 190), Regional Visa (Subclass 191).</li>
                    <li><strong>Humanitarian &amp; Refugee Visas:</strong> Protection Visa (Subclass 866), Refugee Visas (Subclasses 200, 201, 203, and 204), Safe Haven Enterprise Visa (Subclass 790).</li>
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

                <p>At Bansal Lawyers, Best Immigration Lawyer in Melbourne will help you to understand Australia’s Complicated immigration rules and guide you step by step for visa process.</p>

                <h2>The Role of a Registered Migration Agent</h2>

                <p>The Migration Agents Registration Authority is authorized a registered migration agent to give immigration advice and assistance. The Registered agents must be stay up to date with immigration rules and laws also follow a strict code of Conduct.</p>

                <p>Registered migration agents can assist with:</p>

                <ul>
                    <li>Preparing visa applications.</li>
                    <li>Providing advice on visa eligibility.</li>
                    <li>Representing you in tribunal or court.</li>
                    <li><span><span><span><span><span><span>Requesting ministerial intervention.</span></span></span></span></span></span></li>
                </ul>

                <p>However, migration agents cannot guarantee visa approval or expedite processing.</p>

                <h2>Why Choose Bansal Lawyers?</h2>

                <p>Here’s why Bansal Lawyers is the right choice as Immigration Lawyer for your immigration needs:</p>

                <ul>
                    <li><strong>Expertise Across All Areas of Immigration:</strong> We handle everything from simple visa applications to complex Federal Court appeals.</li>
                    <li><strong>Personalized Legal Services:</strong> We offer tailored advice based on your unique situation.</li>
                    <li><strong>Registered Professionals:</strong> Our lawyers are registered with MARA, ensuring compliance with Australian immigration regulations.</li>
                    <li><strong>Honest, Transparent Advice:</strong> We provide clear and realistic assessments of your case and visa prospects.</li>
                </ul>
          
				<p>Bansal Lawyers, best migration lawyers are committed to making your immigration journey easy, smooth as possible. If you are trying to apply for a Australian visa, looking for Australian permanent residency, or challenging a decision through appeals, our experienced immigration lawyers in Melbourne provide expert guidance, reliable representation, and practical solutions tailored to your needs. With our trusted legal support, you can approach the complex Australian immigration system with clarity and confidence.</p>
                
          		<p>Contact us today to learn how we can assist with your immigration law needs.</p>

            <?php
            }

            else if( isset($type) && $type == "criminal-law" )
            { ?>

               <h1>Criminal Law</h1>

                <p>Are you facing assault charges in Australia but don&rsquo;t know the legal rights for your opinion to save your future. Don&rsquo;t worry Bansal Lawyers, help you to provide Expert Criminal Law Services in Melbourne, Australia.</p>

                <p>If you have been charged with assault in Australia then you have to take a professional legal help immediately. Assault charges in Australia is very serious crime which has long term effect on your life that create a criminal record which make trouble to find a job, got travel restriction with visa cancelation for some countries also.</p>

                <p>At Bansal Lawyers, our best criminal lawyers with knowledge and experience to deal with these type of cases provides you the best legal help and guidance throughout the process. Whatever you have been charged with normal assault, Assault charges which include actual body harm or more series offence with grievous body harm, we provide a free consultation to discuss on clients case.</p>

                <h2>Your Rights and the Prosecution&rsquo;s Burden of Proof</h2>

                <p>In Australia, the legal system upholds the principle of innocent until proven guilty. The prosecution lawyer from the authority must need to prove the charges against you with strong and clear evidence which shows that you committed the offence without any reasonable concerns.</p>

                <h2>Types of Assault Charges in Australia</h2>

                <ul>
                    <li><strong>Common Assault:</strong> This occurs when a person intentionally or recklessly causes another to fear immediate and unlawful violence, or makes physical contact without consent. It does not usually result in visible injuries but can include slapping, pushing, or threats of violence.</li>
                    <li><strong>Assault Occasioning Actual Bodily Harm (ABH):</strong> ABH refers to an assault that causes more than just transient or trifling harm. Injuries under this category can include bruises, scratches, swelling, or minor fractures. It indicates that some degree of injury or pain was inflicted.</li>
                    <li><strong>Assault Occasioning Grievous Bodily Harm (GBH):</strong> This is a much more serious offence, involving severe physical harm or life-threatening injuries. GBH can include deep cuts, broken bones, permanent disfigurement, or injuries requiring surgery. It is considered one of the most serious types of assault under criminal law.</li>
                </ul>

                <p>In some cases multiple charges filed for the same incident in order to secure to find guilty by the court for at least one offence.</p>

                <h2>Where Will Your Assault Case Be Heard?</h2>

                <p>The court where your assault case is heard depends on the severity of the charge and the laws in the state or territory where the offence occurred. Minor assault charges are typically dealt with in Magistrates Courts or Local Courts, while more serious cases, such as ABH or GBH, may be heard in higher courts like District, County, or Supreme Courts.</p>

                <h2>Factors Affecting the Seriousness of Your Assault Charges</h2>
<p>When facing assault charges, several key factors influence how serious the charge will be and what penalties you might face. Understanding these elements can help you prepare for your legal defence and assess the potential consequences.</p>
                <ul>
                    <li><strong>Extent of injuries caused to the victim:</strong> The level of harm inflicted on the victim plays a major role in determining the severity of the charge. Minor injuries may result in a charge of common assault, while serious bodily harm or permanent damage can escalate the offence to aggravated assault or recklessly causing serious injury. The more severe the injury, the harsher the potential penalty.</li>
                    <li><strong>Use of a weapon or threat of violence:</strong> If a weapon—such as a knife, firearm, or even a blunt object—was used or brandished during the assault, the charge becomes significantly more serious. Even threatening to use a weapon can elevate the offence to a more severe category, often resulting in longer prison terms and higher fines.</li>
                    <li><strong>Location of the offence (e.g., in the presence of children or at the victim&rsquo;s home):</strong> Where the assault took place is also considered. Committing an assault in sensitive or protected areas—such as in the victim’s home, in the presence of children, or in public spaces like schools or hospitals—can lead to aggravated charges. These settings are considered particularly vulnerable and add weight to the seriousness of the crime.</li>
                    <li><strong>The victim&#39;s role (such as a police officer or emergency worker):</strong> If the victim holds a position of public trust or authority—such as a police officer, paramedic, teacher, or emergency service worker—the assault is treated with greater severity. Assaults against such individuals are seen as attacks on public order and safety, and they attract more significant legal consequences.</li>
                    <li><strong>Your criminal history and whether the offence was premeditated or impulsive:</strong> Your prior criminal record plays a crucial role. A history of violence or repeat offences will likely result in tougher sentencing. Additionally, the court considers whether the act was premeditated (planned in advance) or impulsive (done in the heat of the moment). Premeditated assaults are generally punished more severely, as they indicate deliberate intent to harm.</li>
                </ul>

                <h2>Penalties for Assault Offences in Australia</h2>

                <ul>
                    <li><strong>Common Assault:</strong> Up to 2 years&rsquo; imprisonment.</li>
                    <li><strong>Assault Occasioning Actual Bodily Harm (ABH):</strong> Up to 5 years&rsquo; imprisonment, or 7 years if committed with others.</li>
                    <li><strong>Grievous Bodily Harm (GBH):</strong> Up to 25 years&rsquo; imprisonment, depending on intent and whether the offence was committed with recklessness or deliberate harm.</li>
                </ul>

                <p><strong>Disclaimer:</strong> This content is intended to provide general information about assault charges in Australia and is not a substitute for legal advice. The laws surrounding assault can vary by state and territory, and the outcome of any case will depend on its specific circumstances. For tailored legal advice, please contact our team of expert lawyers.</p>

			<?php
            }
            else if( isset($type) && $type == "commercial-law" )
            { ?>

                <h1>Commercial Law Experts in Australia</h1>

                <p>Complete Legal Solution for Businesses and Corporations</p>

                <h2>What is Commercial Law?</h2>

                <p>Commercial law is also called as business law, which deals with the rules that the business must follow them. Commercial law in Australia, covers a wide range of legal services related to the business operations, contracts, Purchase and Merger of the company, protecting business ideas with brands and provide solution for business disputes. Commercial law helps business to follow the rules and protect it while running their work in Australia.</p>

                <h3>Our Expertise in Commercial Law</h3>
          <p>At Bansal Lawyers, provides the trusted Commercial Law Service in Melbourne, Australia. Our team give best legal advice for all types of businesses. If you are starting a small company or managing large organization in Australia, Our experienced commercial lawyers are here to support your success with practical and results-driven legal solutions.</p>
<p>Understanding commercial law in Australia can be challenging, but our team make it easier by combining our legal skills with effective knowledge of commercial law – it demands a deep understanding of business operations and industry dynamics. At Bansal Lawyers, we help our clients to protect their interests, reduce risks, and also help them to grow successfully with the deep knowledge of commercial law in Australia to protect their business.</p>
                <p>Bansal Lawyers Commercial Law Experts in Australia offers services include:</p>

                <ul>
                    <li><strong>Business Formation and Structuring:</strong> Advising on the best structure for your business (e.g., sole trader, partnership, company) to minimize risks and maximize growth.</li>
                    <li><strong>Contract Law:</strong> Providing the services for write, review and negotiating business commercial contracts, like agreements of service, supplier contracts, and confidential non-disclosure agreements.</li>
                    <li><strong>Corporate Governance:</strong> Providing of legal support on corporate governance matters, ensuring compliance with Australian Securities and Investments Commission (ASIC) regulations and laws.</li>
                    <li><strong>Intellectual Property Protection:</strong> Assist you with trademark registration, patent applications, and protecting business innovations and branding.</li>
                    <li><strong>Mergers and Acquisitions:</strong> Offering advice for mergers, acquisitions, business sales, and due diligence processes to ensure smooth transactions.</li>
                    <li><strong>Dispute Resolution:</strong> Representing the businesses in commercial disputes, including mediation, arbitration, and litigation in state or federal courts.</li>
                    <li><strong>Employment Law:</strong> Advising businesses on employee contracts, workplace policies, termination, and disputes to comply with Australian Fair Work regulations.</li>
                    <li><strong>Franchise Law:</strong> Providing legal services for franchise agreements, compliance with franchise codes, and resolving franchise disputes.</li>
                    <li><strong>Consumer Protection and Competition Law:</strong> Advising businesses on complying with Australian Consumer Law (ACL), including advertising practices, product liability, and fair trading laws.</li>
                </ul>
<p>Bansal Lawyers always try to build long-term relationships with our clients whether a client need day-to-day legal advice or complicated commercial legal issues, our team is here to provide reliable support at every stage of your business journey. We tailor our legal strategies to suit your specific goals and industry requirements, ensuring cost-effective and efficient outcomes.</p>
                          <h3>Why Do You Need a Commercial Lawyer?</h3>

                <p>Operating a business in Australia means to work with many rules and regulations. Bansal Lawyers can assist you with:</p>

                <ul>
                    <li>Help You to Understand the Australian Laws and How to follow the rules with federal and state laws.</li>
                    <li>Protecting your business by creating strong contracts and legal structures.</li>
                    <li>Reducing the chances of legal risks and liabilities.</li>
                    <li>Ensure to legally protected your intellectual property and trademarks.</li>
                    <li>Resolving business disputes quickly and smoothly, without harming your brand reputation.</li>
                </ul>

                <p>No matter if you are starting a new business, signing new contracts, or running existing company, our team must provide clear, supportive advice to help you to grow and avoid legal issues.</p>

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
                    <li><strong>Expert Legal Advice:</strong> We provide complete legal support for businesses across all sectors.</li>
                    <li><strong>Tailored Solutions:</strong> We offer practical, business-focused legal advice to help you achieve your goals.</li>
                    <li><strong>Experience:</strong> With years of experience in Australian commercial law, we understand the legal landscape and help you navigate it successfully.</li>
                    <li><strong>Client-Centered Approach:</strong> Your success is our priority. We work closely with you to deliver the best legal solutions.</li>
                </ul>
          <p>If you’re seeking commercial law experts in Australia, contact Bansal Lawyers today. Our dedicated team is ready to provide the legal support your business needs to thrive in a competitive environment.</p>

            <?php
            }

            else if(  isset($type) && $type == "property-law" )
            { ?>
                <h1>Property Law Experts in Australia</h1>

                <p>Your Trusted Guide for buying, renting or solving Property Based Legal Issues</p>

                <h2>What is Property Law?</h2>

                <p>Property law helps us to get ownership, using and transferring land of real estate and personal property. This law includes all legal issues when to buy residential land and commercial land for business, dispute over property, rental agreements. In Australia all State laws are different in each and every part of Australian territories, so it’s important to have an expert lawyer who understands the rules and laws of your area requirements. Lawyer with proper skill of property law in Australia can provide you the process of settlement, suggest contract reviews, due diligence, zoning compliance, and negotiations. In Australia these Property lawyers also help in resolving legal matters like title defects, encumbrances, or boundary disputes, ensuring your rights are protected throughout the transaction.</p>
          		
                <h2>Our Property Law Services</h2>
          
<p>In Australia Bansal Lawyers with the team of best property lawyers in Melbourne offers proper legal support for all property related matters for property. We provide service related to contract drafting, developer, buyer or investor, which conveyancing, due diligence, assistance with off-the-plan purchases, resolving property disputes, handling lease agreements, and advising on zoning and planning issues. We ensure your transactions are smooth, legally sound, and in compliance with local regulations. With the deep knowledge of property law across various Australian states, we’re committed to protecting your interests and achieving the best outcomes.</p>
          
                <h3>Our Services Include:</h3>

                <ul>
                    <li><strong>Residential &amp; Commercial Transactions:</strong> We guide you through the entire process of buying or selling a home, office, or commercial property. With our team of experienced lawyers helps client with review and understand sale contracts to make sure your interests are protected.</li>
                    <li><strong>Property Leasing:</strong> In Australia, you are an owner of land, or living on rent, our team of property lawyers provide you help for writing, checking and review agreements related to rent and lease for property to make sure that these agreements meet the law and your specific needs.</li>
                    <li><strong>Development &amp; Subdivisions:</strong> In Australia you are trying to develop you land or planning to divide the property, we provide legal advice on zoning laws, planning approvals, and council applications to help your project move forward smoothly.</li>
                    <li><strong>Strata and Community Titles:</strong> We assist with issues related to shared property arrangements, including drafting and interpreting by-laws, managing strata schemes, and resolving disputes among owners or occupants.</li>
                    <li><strong>Property Disputes:</strong> Our team helps resolve a wide range of property-related disputes such as boundary disagreements, conflicts between co-owners, and property damage claims through negotiation or legal action if necessary.</li>
                    <li><strong>Mortgages and Financing:</strong> We offer legal support on mortgage agreements, refinancing loans, and setting up secure financial arrangements, making sure all documents are clear and legally sound.</li>
                    <li><strong>Foreign Investments:</strong> If you're an overseas investor looking to buy property in Australia, we guide you through the Foreign Investment Review Board (FIRB) rules and help with all the necessary legal steps.</li>
                    <li><strong>Compulsory Acquisition:</strong> If the government takes your property for public use, we provide legal support to ensure you receive fair compensation and protect your rights throughout the acquisition process.</li>
                </ul>

                <h2>Why Choose Bansal Lawyers?</h2>
          <p>At Bansal Lawyers with the team of Legal Experts in Property Law in Melbourne, Australia is always committed for providing clear, practical and focused on positive result outcome with every client. With years of experience in all aspects of Australian property law, we provide personalised advice which clients need.</p>
          <p>If you are buying your first home, making or developing commercial property, or navigating a complicated dispute. Our team combines legal expertise with a client-focused approach, ensuring you stay informed and supported throughout every stage of your matter. Bansal Lawyers knows about the different laws in Australian states, as per the knowledge of these laws our team work immediately to protect your rights, and aim to make legal processes as smooth and stress-free as possible. Your success is our priority.</p>

                <ul>
                    <li><strong>Extensive Experience:</strong> We have many years of experience handling all kinds of property matters, including buying and selling homes, commercial buildings, and industrial properties. You can trust us to understand the legal side of your property needs.</li>
                    <li><strong>Tailored Advice:</strong> Every client’s situation is different. We take the time to understand your specific goals and give you legal advice that is suited just for you.</li>
                    <li><strong>Transparent Pricing:</strong> We believe in honesty and clarity when it comes to costs. Many of our property law services are offered at fixed fees, so you know what to expect with no surprise charges.</li>
                    <li><strong>Client-Centric Approach:</strong> Our priority is helping you get the best possible result. We focus on your needs and keep you informed throughout the legal process to make everything easier for you.</li>
                </ul>

                <h2>Get Expert Property Law Assistance</h2>

                <p>If you want to buy, sell, agreement for land for rent in Australia and need solution for property legal issues, Bansal Lawyers is here with experienced team to help you. Contact us today for professional legal support across Australia.</p>

                <p><strong>Disclaimer:</strong> Disclaimer: The content provided is for general purposes only and does not substitute professional legal advice. For personalized assistance, please reach out to us.</p>

            <?php
            } ?>
        </div>
        <!-- End left-side Code -->

        <!-- Start right-side Code -->
        <div class="field field--name-field-learn-more-about field--type-entity-reference-revisions field--label-hidden field__item right-side">
            <div class="paragraph paragraph--type--learn-more-about-list paragraph--view-mode--default">
                <div class="layout layout--onecol">
                    <div class="layout__region layout__region--content">
                        <div class="field field--name-field-learn-more-about field--type-entity-reference-revisions field--label-above right-side-exact">
                            <!-- Start Related pages -->
                            <div class="field__items flex-container widget-post" >
                                <div class="widget-header mb-4">
                                    <h5 class="title">Related pages</h5>
                                </div>
                                <div class="elementor-widget-container">
                                    <div class="elementor-posts-container elementor-posts elementor-posts--skin-cards elementor-grid elementor-has-item-ratio">
                                        @foreach (@$relatedpagedata as $list)
                                            <article class="elementor-post elementor-grid-item post-13164 post type-post status-publish format-standard has-post-thumbnail hentry category-school-abuse tag-nsw">
                                                <div class="elementor-post__card">
                                                    <a class="elementor-post__thumbnail__link" href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" tabindex="-1">
                                                        <div class="elementor-post__thumbnail">
                                                            <img decoding="async" width="150" height="150" src="{{ asset('images/' . @$list->image) }}" alt="{{@$list->image_alt}}">
                                                        </div>
                                                    </a>
                                                    <div class="elementor-post__text">
                                                        <h3 class="elementor-post__title">
                                                            <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}">{{@$list->title}}</a>
                                                        </h3>
                                                        <a class="elementor-post__read-more" href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" aria-label="Read more about {{@$list->title}}" tabindex="-1"> Read This More » </a>
                                                    </div>
                                                </div>
                                            </article>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- End Related pages -->

                            <!-- Start Contact Us Form -->
                            <div class="field__items flex-container widget-post" >
                                <!--<div class="widget-header mb-4">
                                    <h5 class="title">Contact Us</h5>
                                </div>-->

                                <div class="elementor-widget-container">
                                    <div class="elementor-posts-container elementor-posts elementor-posts--skin-cards elementor-grid elementor-has-item-ratio">
                                        <div class="row d-md-flex justify-content-end contactus_div">
                                            @if ($message = Session::get('success'))
                                                <div class="alert alert-success" style="margin: 10px 10px 10px 10px;">
                                                    <p>{{ $message }}</p>
                                                </div>
                                            @endif

                                            <div style="height: 94px;padding-top: 10px;font-weight: 400;">
                                                <img src="{{ asset('images/bansal_2.jpg') }}" width="70" height="80" alt="Ajay Bansal - CEO of Bansal Lawyers">

                                                <div style="color: #FFF;font-size: 16px;float: right;padding-top: 20px;width: 71%;">
                                                    There's No Legal Puzzle,<br>
                                                    We Can't Solve.
                                                </div>
                                            </div>c

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
                                                    <input type="submit" value="GET LEGAL ADVICE" class="btn btn-primary submit_cls">
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

	<script src="{{asset('public/js/jquery-3.6.0.min.js')}}"></script>
    <script>
    jQuery(document).ready(function($){

        function updateLeftSideWidth() {
            let currentUrl = window.location.href;
            let url = new URL(currentUrl);
            let pathname = url.pathname;
            let page = pathname.substring(pathname.lastIndexOf('/') + 1);  // 'property-law'
            //console.log('Page URL segment:', page);
            var windowWidth = $(window).width(); //alert('mainpage='+windowWidth);
            if ( ( page === 'property-law' || page === 'criminal-law' )  &&  windowWidth > 768 ) {
                var left_side_height = $('.left-side').height();   console.log('left_side_height=' +left_side_height);
                var right_side_height = $('.right-side-exact').height(); console.log('right_side_height=' +right_side_height);
                if(right_side_height > left_side_height ){
                    var left_side_height_upd  = left_side_height;
                    var left_side_height_upd_px = left_side_height_upd+'px';

                    $('.right-side-exact').css({"height":left_side_height_upd_px});
                    $('.right-side-exact').css({"overflow": 'scroll' });
                }
            }
        }

        // Left side width load
        updateLeftSideWidth();

        // Update Left side width on window resize
        $(window).resize(function () {
            updateLeftSideWidth();
        });

    });
    </script>

    @endsection
