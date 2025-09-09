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

            .contactus_div {
                width: 121%;
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
            <?php
            if( isset($type) && $type == "divorce" )
            { ?>
                <h1>Divorce</h1>

                <p><span><span><strong><span ><span >Understanding Divorce in Australia</span></span></strong></span></span></p>

                <p><span><span><span ><span >Divorce marks the legal end of a marriage in Australia. The process is governed by the <strong>Family Law Act 1975</strong>, which establishes the grounds for divorce and the procedures involved.</span></span></span></span></p>

                <p><span ><span><strong><span ><span >No-Fault Divorce</span></span></strong></span></span></p>

                <p><span ><span><span ><span >Australia operates under a <strong>no-fault divorce system</strong>, meaning that a divorce can be granted without proving that either party was at fault, such as infidelity or abandonment. The only requirement is that the marriage has broken down irretrievably.</span></span></span></span></p>

                <p><span ><span><strong><span ><span >Grounds for Divorce</span></span></strong></span></span></p>

                <p><span ><span><span ><span >To apply for a divorce, you must prove that:</span></span></span></span></p>

                <ul>
                    <li><span ><span><span ><span >You have been separated for at least <strong>12 months</strong>.</span></span></span></span></li>
                    <li><span ><span><span ><span >There is no likelihood of reconciliation.</span></span></span></span></li>
                </ul>

                <p><span ><span><strong><span ><span >Divorce Application Process</span></span></strong></span></span></p>

                <ol>
                    <li><span ><span><strong><span ><span >Separation</span></span></strong><span ><span >: Both parties must be separated for at least 12 months before applying for a divorce.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Filing for Divorce</span></span></strong><span ><span >: Either party can apply for a divorce, or the application can be joint.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Court Hearing</span></span></strong><span ><span >: If there are no children under 18, the court may approve the divorce without a hearing. If children are involved, the court will assess the arrangements for their care.</span></span></span></span></li>
                </ol>

                <p><span ><span><strong><span ><span >Dealing with Divorce Issues</span></span></strong></span></span></p>

                <p><span ><span><span ><span >While divorce itself is a legal process, there may be other matters that need to be addressed, such as:</span></span></span></span></p>

                <ul>
                    <li><span ><span><strong><span ><span >Parenting arrangements</span></span></strong><span ><span > (if children are involved)</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Property settlements</span></span></strong><span ><span > (division of assets)</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Spousal maintenance</span></span></strong><span ><span > (financial support after divorce)</span></span></span></span></li>
                </ul>

                <div style="border-bottom:solid windowtext 1.0pt; padding:0in 0in 1.0pt 0in">
                <p><span ><span><span ><span >At Bansal Lawyers, we provide expert advice on navigating the divorce process, ensuring that your legal rights are protected every step of the way.</span></span></span></span></p>
                </div>

            <?php
            }

            else if( isset($type) && $type == "child-custody" )
            { ?>

                <h1>Child Custody</h1>

                <p><span ><span><strong><span ><span >Understanding Child Custody in Australia</span></span></strong></span></span></p>

                <p><span ><span><span ><span >Child custody matters are among the most emotionally charged aspects of family law. In Australia, <strong>parenting arrangements</strong> are focused on the <strong>best interests of the child</strong>.</span></span></span></span></p>

                <p><span ><span><strong><span ><span >Best Interests of the Child</span></span></strong></span></span></p>

                <p><span ><span><span ><span >The Family Law Act 1975 outlines that the primary consideration in any child custody matter is the <strong>best interests of the child</strong>. This includes ensuring that the child has a meaningful relationship with both parents, unless doing so would be harmful.</span></span></span></span></p>

                <p><span ><span><strong><span ><span >Types of Parenting Arrangements</span></span></strong></span></span></p>

                <ul>
                    <li><span ><span><strong><span ><span >Living Arrangements</span></span></strong><span ><span >: This refers to where the child will primarily live and how time will be spent with each parent.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Parental Responsibility</span></span></strong><span ><span >: This includes decisions about the child&rsquo;s education, health, and general welfare.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Contact with Family Members</span></span></strong><span ><span >: This involves time spent with extended family, such as grandparents.</span></span></span></span></li>
                </ul>

                <p style="margin-left:48px"><span ><span><span ><span >There are two main types of child custody arrangements:</span></span></span></span></p>

                <ul>
                    <li><span ><span><strong><span ><span >Sole Custody</span></span></strong><span ><span >: One parent has the legal right to make all decisions about the child, including those related to education, health, and other important matters.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Joint Custody</span></span></strong><span ><span >: Both parents share responsibility for major decisions about the child&rsquo;s life, although this doesn&rsquo;t necessarily imply equal time spent with the child.</span></span></span></span></li>
                </ul>

                <p style="margin-left:48px">&nbsp;</p>

                <p><span ><span><strong><span ><span >Court&#39;s Role in Custody Matters</span></span></strong></span></span></p>

                <p><span ><span><span ><span >If parents cannot agree on custody or parenting arrangements, the case may go to court. The court will consider factors such as:</span></span></span></span></p>

                <ul>
                    <li><span ><span><span ><span >The child&rsquo;s wishes (if they are old enough)</span></span></span></span></li>
                    <li><span ><span><span ><span >The ability of each parent to meet the child&rsquo;s needs</span></span></span></span></li>
                    <li><span ><span><span ><span >Any history of abuse or violence</span></span></span></span></li>
                </ul>

                <p><span ><span><strong><span ><span >Reaching an Agreement</span></span></strong></span></span></p>

                <p><span ><span><span ><span >Parents are encouraged to resolve disputes through <strong>Family Dispute Resolution (FDR)</strong> before seeking court intervention. If FDR fails, parents may proceed to court, where orders for custody can be made.</span></span></span></span></p>

                <div style="border-bottom:solid windowtext 1.0pt; padding:0in 0in 1.0pt 0in">
                <p><span ><span><span ><span >Bansal Lawyers can assist in negotiating parenting arrangements and represent you in court if necessary.</span></span></span></span></p>
                </div>


            <?php
            }

            else if( isset($type) && $type == "family-violence" )
            { ?>

                <h1>Family Violence and Family Violence Orders</h1>

                <p><span ><span><strong><span ><span >Family Violence in Australia</span></span></strong></span></span></p>

                <p><span ><span><span ><span >Family violence is a serious issue that can have a significant impact on individuals and families. It includes physical, emotional, psychological, financial, and sexual abuse. If you are experiencing family violence, it is crucial to seek legal assistance to ensure your safety and well-being.</span></span></span></span></p>

                <p><span ><span><strong><span ><span >What is Family Violence?</span></span></strong></span></span></p>

                <p><span ><span><span ><span >Family violence involves abusive behaviour by one family member towards another, which can occur in relationships such as marriage, de facto relationships, or even between parents and children. The types of family violence include:</span></span></span></span></p>

                <ul>
                    <li><span ><span><strong><span ><span >Physical Abuse</span></span></strong><span ><span >: Hitting, slapping, pushing, or any form of physical harm.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Emotional and Psychological Abuse</span></span></strong><span ><span >: Threats, intimidation, and controlling behaviours.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Financial Abuse</span></span></strong><span ><span >: Withholding money, controlling financial decisions, or preventing access to financial resources.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Sexual Abuse</span></span></strong><span ><span >: Unwanted sexual behaviour or coercion.</span></span></span></span></li>
                </ul>

                <p><span ><span><strong><span ><span >Family Violence Orders (FVOs)</span></span></strong></span></span></p>

                <p><span ><span><span ><span >In response to family violence, individuals may apply for <strong>Family Violence Orders (FVOs)</strong> to protect themselves from harm. There are two main types of orders:</span></span></span></span></p>

                <ol>
                    <li><span ><span><strong><span ><span >Intervention Orders</span></span></strong><span ><span >: Issued by the court to prevent further abuse. These orders can include conditions such as restraining the abuser from approaching the victim or contacting them.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Protection Orders</span></span></strong><span ><span >: These orders are similar to intervention orders but are specifically designed to ensure the safety of those at risk of family violence.</span></span></span></span></li>
                </ol>

                <p><span ><span><strong><span ><span >Seeking Legal Assistance</span></span></strong></span></span></p>

                <div style="border-bottom:solid windowtext 1.0pt; padding:0in 0in 1.0pt 0in">
                <p><span ><span><span ><span >If you are experiencing family violence, it&rsquo;s important to seek help immediately. Our experienced family lawyer at Bansal Lawyers can guide you through the process of obtaining a family violence order and ensure you have the protection you need.</span></span></span></span></p>
                </div>

            <?php
            }
            else if( isset($type) && $type == "property-settlement" )
            { ?>

                <h1>Property settlement</h1>

                <p><span ><span><strong><span ><span >What is Property Settlement?</span></span></strong></span></span></p>

                <p><span ><span><span ><span >Property settlement involves the division of assets and debts after separation. Whether you are married or in a de facto relationship, the court will consider various factors to determine how property is divided.</span></span></span></span></p>

                <p><span ><span><strong><span ><span >Key Factors in Property Settlement</span></span></strong></span></span></p>

                <ol>
                    <li><span ><span><strong><span ><span >Contributions</span></span></strong><span ><span >: Both financial and non-financial contributions made by each party, including homemaking, childcare, and financial support.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Future Needs</span></span></strong><span ><span >: The future needs of each party, including the care of children, health considerations, income, and age.</span></span></span></span></li>
                </ol>

                <p><span ><span><strong><span ><span >Time Limits for Property Settlement</span></span></strong></span></span></p>

                <ul>
                    <li><span ><span><strong><span ><span >Married Couples</span></span></strong><span ><span >: Property settlement must be filed within <strong>12 months</strong> after the divorce is finalized.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >De Facto Couples</span></span></strong><span ><span >: Property settlement must be filed within <strong>2 years</strong> of separation.</span></span></span></span></li>
                </ul>

                <p><span ><span><strong><span ><span >Methods of Settling Property Disputes</span></span></strong></span></span></p>

                <p><span ><span><span ><span >Property disputes can be resolved in several ways:</span></span></span></span></p>

                <ul>
                    <li><span ><span><strong><span ><span >Informal Agreement</span></span></strong><span ><span >: Couples may agree on a settlement without court intervention.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Consent Orders</span></span></strong><span ><span >: These are formalized agreements that are legally binding.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Court Orders</span></span></strong><span ><span >: If an agreement cannot be reached, the court will decide the division of assets.</span></span></span></span></li>
                </ul>

                <p><span ><span><strong><span ><span >Our Role in Property Settlement</span></span></strong></span></span></p>

                <div style="border-bottom:solid windowtext 1.0pt; padding:0in 0in 1.0pt 0in">
                <p><span ><span><span ><span >At Bansal Lawyers, we guide you through the property settlement process, ensuring that your rights are protected and that the outcome is fair and reasonable.</span></span></span></span></p>
                </div>

            <?php
            }

            else if(  isset($type) && $type == "family-violence-orders" )
            { ?>
                <h1>Family Law Mediation and Dispute Resolution</h1>

                <p><span ><span><strong><span ><span >Mediation in Family Law</span></span></strong></span></span></p>

                <p><span ><span><span ><span >Family disputes, especially those involving parenting or property matters, can often be resolved through <strong>Family Dispute Resolution (FDR)</strong>, which is a form of mediation.</span></span></span></span></p>

                <p><span ><span><strong><span ><span >Why Mediation?</span></span></strong></span></span></p>

                <p><span ><span><span ><span >Mediation is a less formal and often less costly way to resolve family law issues. It allows both parties to express their concerns and reach a mutually agreeable solution with the help of a neutral third-party mediator.</span></span></span></span></p>

                <p><span ><span><strong><span ><span >Mediation Process</span></span></strong></span></span></p>

                <ul>
                    <li><span ><span><span ><span >Both parties attend the session with their mediator.</span></span></span></span></li>
                    <li><span ><span><span ><span >Discussions are confidential, and no decisions are made without both parties&rsquo; consent.</span></span></span></span></li>
                    <li><span ><span><span ><span >If mediation results in an agreement, it can be formalized through <strong>Consent Orders</strong>.</span></span></span></span></li>
                    <li><span ><span><span ><span >If mediation fails, a <strong>Section 60I Certificate</strong> may be issued, allowing the matter to proceed to court.</span></span></span></span></li>
                </ul>

                <p><span ><span><strong><span ><span >Benefits of Mediation</span></span></strong></span></span></p>

                <ul>
                    <li><span ><span><strong><span ><span >Cost-effective</span></span></strong><span ><span >: Mediation is usually less expensive than court proceedings.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Less Stressful</span></span></strong><span ><span >: Mediation is generally quicker and less adversarial than going to court.</span></span></span></span></li>
                    <li><span ><span><strong><span ><span >Confidential</span></span></strong><span ><span >: The process is private, and nothing discussed can be used in court.</span></span></span></span></li>
                </ul>
            <?php
            } 
          

            else if(  isset($type) && $type == "juridicational-error-federal-circuit-court-application" )
            { ?>

                <h1>Juridicational Error/Federal Circuit Court Application</h1>

                <p><span ><span ><strong><span ><span >What is Jurisdictional Error?</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >In migration law, a <strong>jurisdictional error</strong> occurs when a decision-maker (such as the Department of Home Affairs or the Administrative Review Tribunal) makes an error that affects the lawfulness of their decision. This can occur if the decision-maker:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Fails to follow proper legal procedures</span></span></strong><span ><span >.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Makes an incorrect interpretation of the law</span></span></strong><span ><span >.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Acts beyond their legal powers</span></span></strong><span ><span > (i.e., exceeding the scope of authority granted by the Migration Act 1958).</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Ignores relevant evidence</span></span></strong><span ><span > or <strong>relies on irrelevant information</strong> in making the decision.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Makes decisions that are irrational</span></span></strong><span ><span > or unreasonable in the context of the law and facts.</span></span></span></span></li>
                </ul>

                <p><span ><span ><span ><span >Jurisdictional errors can lead to unlawful decisions that may be overturned by the court.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >How Can Jurisdictional Errors Affect Your Case?</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >If a migration decision involves a jurisdictional error, the decision may be challenged in court. For example, if you believe that the Department of Home Affairs or the ART has made a jurisdictional error in refusing or cancelling your visa, you can apply to the Federal Court to seek a judicial review.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >How Bansal Lawyers Can Help with Jurisdictional Errors</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >At <strong>Bansal Lawyers</strong>, we have extensive experience in identifying and challenging jurisdictional errors in migration cases. We can assist you by:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Reviewing the decision</span></span></strong><span ><span >: We will carefully analyse the migration decision to identify any potential jurisdictional errors.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Advising on the legal grounds for review</span></span></strong><span ><span >: If a jurisdictional error exists, we will advise you on the best course of action to seek a judicial review.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Representing you in court</span></span></strong><span ><span >: If necessary, we will represent you in the Federal Court, seeking to have the migration decision overturned based on jurisdictional error.</span></span></span></span></li>
                </ul>

            <?php
            }


            else if(  isset($type) && $type == "art-application" )
            { ?>

                <h1>AT/AATs Application (Administrative Review Tribunal Application)</h1>

                <p><span ><span ><strong><span ><span >What is an ART Application?</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >An <strong>Administrative Review Tribunal (ART) application</strong> allows an individual to challenge decisions made by the Department of Home Affairs or the Australian government regarding their visa application. If you&rsquo;ve had a visa application refused or a visa cancelled, you can apply to the <strong>Administrative Review Tribunal (ART)</strong> for a review of that decision.</span></span></span></span></p>

                <p><span ><span ><span ><span >The ART application is an important step in the process of seeking an independent review of an immigration decision. The ART is responsible for reviewing a broad range of migration decisions, including:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><span ><span >Visa refusals and cancellations.</span></span></span></span></li>
                    <li><span ><span ><span ><span >Visa condition impositions.</span></span></span></span></li>
                    <li><span ><span ><span ><span >Denial of permanent residency or citizenship applications.</span></span></span></span></li>
                </ul>

                <p><span ><span ><strong><span ><span >When Can You Apply?</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >You can lodge an ART application if your visa has been refused, cancelled, or if other adverse decisions have been made regarding your migration status. However, there are strict time limits for lodging an ART application. Typically, you must apply for a review within <strong>28 days</strong> of receiving the decision.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >How Bansal Lawyers Can Assist with ART Applications</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >Navigating the ART process can be complex and requires thorough knowledge of Australian immigration law. At <strong>Bansal Lawyers</strong>, our migration experts provide comprehensive assistance by:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Assessing the grounds for appeal</span></span></strong><span ><span >: We will evaluate the reasons behind the decision and advise you on the best approach to challenging it.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Preparing the application</span></span></strong><span ><span >: Our team will handle all the paperwork, ensuring that your application is submitted correctly and on time.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Representation in hearings</span></span></strong><span ><span >: If your case proceeds to an oral hearing, we can represent you before the Administrative Review Tribunal, advocating for your rights and interests.</span></span></span></span></li>
                </ul>

                <div style="border-bottom:solid windowtext 1.0pt; padding:0in 0in 1.0pt 0in">
                <p><span ><span ><span ><span >We will work tirelessly to provide you with the best possible chance of success in your ART application.</span></span></span></span></p>
                </div>

            <?php
            }


            else if(  isset($type) && $type == "visa-refusals-visa-cancellation" )
            { ?>

                <h1>Visa Refusals/Visa Cancellation</h1>

                <p><span ><span ><strong><span ><span >Visa Refusal</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >Visa refusal occurs when the Department of Home Affairs or the relevant immigration authorities deny an applicant the right to enter, stay, or remain in Australia. There are many reasons why a visa might be refused, including:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Failure to meet visa criteria</span></span></strong><span ><span >: Each visa category has specific requirements, and failure to meet these criteria could lead to a refusal.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Character issues</span></span></strong><span ><span >: If the applicant does not meet the character requirements set out by Australian law, their visa may be refused.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Health-related concerns</span></span></strong><span ><span >: Applicants who fail the health assessment may face refusal.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Inaccurate or incomplete information</span></span></strong><span ><span >: Providing false information or incomplete documentation can result in a visa refusal.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Visa history</span></span></strong><span ><span >: A history of visa violations or overstaying in Australia can also be a factor.</span></span></span></span></li>
                </ul>

                <p><span ><span ><strong><span ><span >Visa Cancellation</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >Visa cancellation refers to the revocation of an individual&rsquo;s visa by the Australian government after it has been granted. This can occur at any point during an individual&rsquo;s stay in Australia and can be triggered for various reasons, including:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Non-compliance with visa conditions</span></span></strong><span ><span >: Violating the conditions of the visa, such as working without authorization, studying without the proper visa, or overstaying the visa period.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Criminal conduct</span></span></strong><span ><span >: If a visa holder is convicted of a serious crime or engages in behaviour deemed detrimental to Australian society, their visa may be cancelled.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >False information or fraud</span></span></strong><span ><span >: If a visa holder is found to have provided false information in their visa application, it could lead to visa cancellation.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Health or character issues</span></span></strong><span ><span >: If the visa holder&rsquo;s health or character is found to be incompatible with the visa requirements, the Department of Home Affairs may cancel the visa.</span></span></span></span></li>
                </ul>

                <p><span ><span ><strong><span ><span >How Bansal Lawyers Can Help</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >If your visa has been refused or cancelled, our experienced migration lawyers at Bansal Lawyers can help you understand your options and, where appropriate, challenge the decision. Our team can assist you in the following ways:</span></span></span></span></p>

                <div style="border-bottom:solid windowtext 1.0pt; margin-left:24px; padding:0in 0in 1.0pt 0in">
                <ul>
                    <li><span ><span ><strong><span ><span >Providing expert legal advice</span></span></strong><span ><span >: We offer guidance on whether you are eligible for another visa or if other remedies are available under Australian immigration law.</span></span></span></span></li>
                </ul>
                </div>

                <ul>
                    <li><span ><span ><strong><span ><span >Reviewing visa refusal or cancellation decisions</span></span></strong><span ><span >: Our team will carefully review the reasons for refusal or cancellation to ensure all factors are considered.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Appealing a refusal or cancellation</span></span></strong><span ><span >: We can help file an appeal with the Administrative Review Tribunal (ART) or represent you in court if necessary.</span></span></span></span></li>
                </ul>
            <?php
            }


            else if(  isset($type) && $type == "federal-court-application" )
            { ?>

                <h1>Federal Court Application</h1>

                <p><span ><span ><strong><span ><span >When to Apply to the Federal Court</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >If you have received an adverse decision from the Administrative Review Tribunal (ART) regarding your visa, you may be able to appeal the decision to the <strong>Federal Court</strong>. This typically occurs when:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><span ><span >The decision involves a <strong>jurisdictional error</strong>, as discussed earlier.</span></span></span></span></li>
                    <li><span ><span ><span ><span >The decision is based on incorrect interpretation or application of the Migration Act or Migration Regulations.</span></span></span></span></li>
                    <li><span ><span ><span ><span >There are issues of law that need clarification by the higher court.</span></span></span></span></li>
                </ul>

                <p><span ><span ><span ><span >A <strong>Federal Court application</strong> is a serious legal step and is typically sought when the individual has exhausted all other review options, such as the ART application. In some cases, the Federal Circuit and Family Court of Australia may have jurisdiction and can be a more cost-effective option.</span></span></span></span></p>

                <p><span ><span ><strong><span><span >Who Is Involved in a Court Case?</span></span></strong></span></span></p>

                <p><br />
                <span ><span ><span ><span >In legal proceedings, the people involved are called parties. The main parties in a case are:<br />
                &bull; <strong>Applicant</strong>: If you apply to the Court to start a matter, you are called the applicant. If you are starting an appeal, you are called the appellant.<br />
                &bull; <strong>Respondent</strong>: If a case is brought against you, you are the respondent (or defendant in certain matters).<br />
                &bull; <strong>Self-represented litigant</strong>: If you represent yourself in the case without a lawyer, you are treated as a self-represented litigant.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >What Forms Do I Need?</span></span></strong><br />
                <span ><span >To start a matter in the Federal Court, you need to prepare an application form. The most commonly used form is Form 15 - Originating Application. Depending on your case, you may need additional supporting documents such as an affidavit (Form 59) or a statement of claim (Form 17).<br />
                Some cases may require a Genuine Steps Statement (Form 16), which outlines the steps taken to resolve the dispute before starting the court process.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >How Do I Submit My Documents?</span></span></strong><br />
                <span ><span >Once you have completed the necessary forms and documents, you need to lodge them with the Court. This can be done in several ways:<br />
                &bull; <strong>Elodgement via the Court&rsquo;s online system</strong>.<br />
                &bull; <strong>Submitting in person at a local Registry</strong>.<br />
                &bull; <strong>Mailing or faxing the documents</strong>.<br />
                Once the documents are lodged and accepted, they will be filed, and you will receive a Notice of Filing confirming the submission.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >What Happens After Filing My Application?</span></span></strong><br />
                <span ><span >Once your documents are filed correctly, the Court will issue a Notice of Filing and Hearing which includes the date and time of the first hearing. This confirms that the Court has accepted the documents and your case will proceed.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >How Do I Serve Documents on Other Parties?</span></span></strong><br />
                <span ><span >After filing, you must serve copies of your application on the other party. You can do this by:<br />
                &bull; Personally delivering the documents.<br />
                &bull; Arranging for someone else to deliver them on your behalf.<br />
                The rules require that documents be served at least 5 days before the case management hearing.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >Do I Have to Pay Any Fees?</span></span></strong><br />
                <span ><span >The Federal Court may require payment of fees at various stages, including:<br />
                &bull; Filing your application.<br />
                &bull; Paying for mediation or hearing fees.<br />
                &bull; Paying for each day your case is heard in Court.<br />
                If you cannot afford the fees, you can apply for an exemption or deferral. You may also be required to provide security for costs if there is concern that you may not be able to cover the other party&#39;s costs if you lose.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >Can the Court Refuse to Accept Documents for Filing?</span></span></strong><br />
                <span ><span >The Court may refuse to accept your documents for filing if:<br />
                &bull; They are incomplete or not properly signed.<br />
                &bull; The document is deemed frivolous or vexatious by a Judicial Registrar.<br />
                &bull; The Court has issued a directive not to accept the document.</span></span></span></span></p>

                <p>&nbsp;</p>

                <p><span ><span ><strong><span ><span >How Bansal Lawyers Can Assist with Federal Court Applications</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >At <strong>Bansal Lawyers</strong>, we provide expert legal services in handling applications to the Federal Court. Our services include:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Determining whether your case involves a jurisdictional error or legal issue</span></span></strong><span ><span >: We carefully assess the case to see if it is appropriate to take it to the Federal Court.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Preparing and filing the application</span></span></strong><span ><span >: Our team handles the entire application process, ensuring compliance with court procedures and deadlines.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Representing you in Federal Court hearings</span></span></strong><span ><span >: If your case proceeds to the Federal Court, we will advocate for your rights, presenting compelling arguments to secure the best outcome for you.</span></span></span></span></li>
                </ul>

                <p><span ><span >Federal Court applications in migration matters are highly specialized, and it is crucial to have a lawyer with in-depth experience. <strong>Bansal Lawyers</strong> has a proven track record of successfully handling such complex cases.</span></span></p>
            <?php
            }



 
            else if(  isset($type) && $type == "intervenition-orders" )
            { ?>
                <h1>Intervenition Orders &ndash; Protecting Your Rights and Safety</h1>

                <p><span ><span ><span ><span >If you are experiencing domestic violence, harassment, or threats, an <strong>Intervention Order</strong> may be necessary to protect yourself and your loved ones. An Intervention Order is a legal order that can place restrictions on someone who is causing harm or distress to another person. Whether you need to <strong>protect yourself from a partner, family member, or acquaintance</strong>, Bansal Lawyers is here to guide you through the process.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >What is an Intervention Order?</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >An Intervention Order, also known as a <strong>Protection Order</strong>, is a legal order issued by the court to prevent someone from engaging in certain behaviour that causes harm or intimidation. It can include conditions such as:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >No contact</span></span></strong><span ><span > with the protected person.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Exclusion from the home</span></span></strong><span ><span > or certain premises.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Prohibition of specific behaviours</span></span></strong><span ><span >, like stalking, threats, or assault.</span></span></span></span></li>
                </ul>

                <p><span ><span ><strong><span ><span >When Can You Apply for an Intervention Order?</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >You can apply for an Intervention Order if you are experiencing any of the following:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Physical or emotional abuse</span></span></strong><span ><span >.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Threats</span></span></strong><span ><span > of violence.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Harassment</span></span></strong><span ><span > or <strong>stalking</strong>.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Damage to property</span></span></strong><span ><span >.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Controlling behaviour</span></span></strong><span ><span >, including restrictions on your freedom.</span></span></span></span></li>
                </ul>

                <p><span ><span ><span ><span >At <strong>Bansal Lawyers</strong>, we work with you to ensure your safety is the priority. Whether you are seeking an <strong>Apprehended Domestic Violence Order (ADVO)</strong> or a <strong>Personal Safety Intervention Order (PSIO)</strong>, we provide expert legal advice and representation to help you secure the protection you need.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >The Court Process for an Intervention Order</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >The process to obtain an Intervention Order involves:</span></span></span></span></p>

                <ol>
                    <li><span ><span ><strong><span ><span >Filing an application</span></span></strong><span ><span > at your local court.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Court hearing</span></span></strong><span ><span >, where both parties will have the opportunity to present evidence.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Order granted</span></span></strong><span ><span > if the court believes that the order is necessary to protect your safety.</span></span></span></span></li>
                </ol>

                <p><span ><span ><span ><span >If you need urgent assistance, we can help expedite the process and guide you every step of the way. <strong>Contact us today</strong> for a confidential consultation.</span></span></span></span></p>


            <?php
            }

            else if(  isset($type) && $type == "trafic-offences" )
            { ?>
                <h1>Traffic Offences &ndash; Expert Legal Advice for Drivers in Trouble</h1>

                <p><span ><span ><span ><span >Traffic offences can lead to serious consequences, including fines, license suspensions, and even imprisonment in some cases. At <strong>Bansal Lawyers</strong>, we understand how stressful it can be to face charges related to <strong>driving offences</strong>. Whether you&rsquo;re facing charges for speeding, driving without a valid license, or more serious offences like dangerous driving, we offer expert legal support to protect your rights.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >Types of Traffic Offences in Australia</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >Traffic offences can be categorized into <strong>minor</strong> and <strong>major</strong> offences. Some common charges include:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Speeding offences</span></span></strong><span ><span >: Exceeding the speed limit, including high-range speeding.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Driving without a valid license</span></span></strong><span ><span >: Driving when your license is expired, suspended, or disqualified.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Reckless driving</span></span></strong><span ><span >: Driving in a manner that endangers the safety of others.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Driving under the influence of drugs or alcohol</span></span></strong><span ><span >: A serious offence that can lead to significant penalties.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Failing to stop after an accident</span></span></strong><span ><span >: Leaving the scene of a crash without reporting the incident.</span></span></span></span></li>
                </ul>

                <p><span ><span ><strong><span ><span >Penalties for Traffic Offences</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >The penalties for traffic offences vary depending on the severity of the offence and whether any aggravating factors were involved. For example:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Speeding offences</span></span></strong><span ><span >: Fines and demerit points.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Reckless driving</span></span></strong><span ><span >: Can result in disqualification of your driver&rsquo;s license and heavy fines.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Driving under the influence (DUI)</span></span></strong><span ><span >: Possible license suspension, fines, or imprisonment.</span></span></span></span></li>
                </ul>

                <p><span ><span ><span ><span >If you&rsquo;ve been charged with a traffic offence, <strong>Bansal Lawyers</strong> will help you understand the charges, potential consequences, and the best possible defence for your case.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >How We Can Help</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >Our team of criminal lawyers will assess your case, explore potential defences, and guide you through the court process. <strong>Contact us today</strong> to discuss your case in detail and get the legal help you need.</span></span></span></span></p>


            <?php
            }


            else if(  isset($type) && $type == "drink-driving-offences" )
            { ?>

                <h1>Drink and Drive Offences &ndash; Navigating DUI Charges with Expert Legal Support</h1>

                <p><span ><span ><span ><span >Being charged with a <strong>Drink Driving offence</strong> is a serious matter that can have lasting consequences on your life. At <strong>Bansal Lawyers</strong>, we are committed to helping you navigate the complexities of Drink Driving charges and providing you with the best legal representation possible.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >What is Drink Driving?</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >Drink driving occurs when a person operates a vehicle while impaired by alcohol or drugs. In Australia, there are strict <strong>blood alcohol concentration (BAC)</strong> limits that all drivers must adhere to. The legal limit varies depending on the type of driver:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Standard drivers</span></span></strong><span ><span >: 0.05 BAC.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Learner or provisional drivers</span></span></strong><span ><span >: Zero tolerance &ndash; any alcohol in the system can result in a charge.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Heavy vehicle drivers</span></span></strong><span ><span >: Lower BAC limits, often 0.02.</span></span></span></span></li>
                </ul>

                <p><span ><span ><strong><span ><span >Penalties for Drink Driving</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >Penalties for drink driving depend on various factors such as your BAC level, your driving history, and whether you&rsquo;ve previously been convicted for similar offences. Common penalties include:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Fines</span></span></strong><span ><span >.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Demerit points</span></span></strong><span ><span >.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >License suspension</span></span></strong><span ><span > or disqualification.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Imprisonment</span></span></strong><span ><span > in extreme cases.</span></span></span></span></li>
                </ul>

                <p><span ><span ><strong><span ><span >Possible Defences for Drink Driving Charges</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >There are several defences you may be able to raise, including:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Incorrect readings</span></span></strong><span ><span > from breath or blood tests.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Faulty equipment</span></span></strong><span ><span > or <strong>procedural errors</strong> during the test.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Medical conditions</span></span></strong><span ><span > that affect BAC readings.</span></span></span></span></li>
                </ul>

                <p><span ><span ><strong><span ><span >How Bansal Lawyers Can Help</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >Our experienced team will assess the circumstances of your charge, gather relevant evidence, and explore all available legal defences. We understand the impact a Drink Driving charge can have on your life and will work diligently to help you achieve the best possible outcome.</span></span></span></span></p>

                <p><span ><span ><span ><span >If you&rsquo;ve been charged with a Drink Driving offence, <strong>contact Bansal Lawyers</strong> for expert legal advice and representation.</span></span></span></span></p>

            <?php
            }


            else if(  isset($type) && $type == "assualt-charges" )
            { ?>

                <h1>Assault Charges &ndash; Expert Legal Guidance for Defending Your Case</h1>

                <p><span ><span ><span ><span >Facing an <strong>assault charge</strong> can be overwhelming. Assault is a serious criminal offence in Australia, and the penalties can be severe. Whether you&rsquo;ve been charged with <strong>common assault</strong>, <strong>assault occasioning actual bodily harm (ABH)</strong>, or <strong>grievous bodily harm (GBH)</strong>, Bansal Lawyers is here to provide you with the support and legal representation you need.</span></span></span></span></p>

                <p><span ><span ><strong><span ><span >Types of Assault Charges</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >Assault can range from minor incidents to serious cases involving significant injury. Common charges include:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Common Assault</span></span></strong><span ><span >: Occurs when physical contact is made without consent but without significant injury.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Assault Occasioning Actual Bodily Harm (ABH)</span></span></strong><span ><span >: Involves injuries that are not life-threatening but cause harm to the victim.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Grievous Bodily Harm (GBH)</span></span></strong><span ><span >: Refers to serious, often life-threatening injuries.</span></span></span></span></li>
                </ul>

                <p><span ><span ><strong><span ><span >Penalties for Assault</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >Penalties for assault charges can be severe, especially if there are aggravating factors involved, such as the use of a weapon or the involvement of vulnerable victims. The penalties include:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Common Assault</span></span></strong><span ><span >: Up to 2 years&rsquo; imprisonment.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Assault Occasioning Actual Bodily Harm (ABH)</span></span></strong><span ><span >: Up to 5 years&rsquo; imprisonment (up to 7 years if committed in company).</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Grievous Bodily Harm (GBH)</span></span></strong><span ><span >: Up to 25 years&rsquo; imprisonment.</span></span></span></span></li>
                </ul>

                <p><span ><span ><strong><span ><span >Defences to Assault Charges</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >Depending on the circumstances of the case, possible defences to assault charges include:</span></span></span></span></p>

                <ul>
                    <li><span ><span ><strong><span ><span >Self-defence</span></span></strong><span ><span >: If you were protecting yourself or others from harm.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >Lack of intent</span></span></strong><span ><span >: If the assault was accidental or unintentional.</span></span></span></span></li>
                    <li><span ><span ><strong><span ><span >False allegations</span></span></strong><span ><span >: When the accusation is false or exaggerated.</span></span></span></span></li>
                </ul>

                <p><span ><span ><strong><span ><span >How Bansal Lawyers Can Help</span></span></strong></span></span></p>

                <p><span ><span ><span ><span >Our experienced criminal lawyers will work to develop a solid defence strategy, review evidence, and guide you through the legal process. We are dedicated to helping you protect your rights and achieving the best possible result in your case.</span></span></span></span></p>

                <p><span ><span ><span ><span >If you&rsquo;ve been charged with an assault, <strong>contact Bansal Lawyers</strong> today for expert legal advice and support.</span></span></span></span></p>

            <?php
            }
            

			
			else if(  isset($type) && $type == "business-law" )
            { ?>

                <h1>Business Law: Expert Legal Guidance for Your Business Success</h1>

                <p><span ><span ><strong><span><span>What is Business Law?</span></span></strong></span></span></p>

                <p><span ><span ><span><span>Business law encompasses a wide range of legal areas that govern how businesses are run, from formation and structuring to compliance and dispute resolution. In Australia, business law plays a critical role in shaping how businesses operate and interact with customers, suppliers, and the government. It includes everything from contracts, corporate governance, intellectual property, and tax compliance to commercial disputes and employment law.</span></span></span></span></p>

                <p><span ><span ><span><span>At <strong>Bansal Lawyers</strong>, we offer expert legal services for businesses of all sizes, helping you navigate the complexities of Australian business law. Whether you&rsquo;re starting a new business or managing an established one, our legal team is here to help you thrive while minimizing legal risks.</span></span></span></span></p>

                <p><span ><span ><strong><span><span>Our Business Law Services Include:</span></span></strong></span></span></p>

                <ul>
                    <li><span ><span ><strong><span><span>Business Formation and Structuring</span></span></strong><span><span>: Choosing the right legal structure for your business (sole trader, partnership, company) to maximize growth and minimize risks.</span></span></span></span></li>
                    <li><span ><span ><strong><span><span>Commercial Contracts</span></span></strong><span><span>: Drafting, reviewing, and negotiating contracts with clients, suppliers, and business partners to protect your interests.</span></span></span></span></li>
                    <li><span ><span ><strong><span><span>Corporate Governance</span></span></strong><span><span>: Ensuring compliance with the Australian Securities and Investments Commission (ASIC) regulations and managing shareholder relations.</span></span></span></span></li>
                    <li><span ><span ><strong><span><span>Intellectual Property Protection</span></span></strong><span><span>: Assisting with trademarks, patents, and copyright registration to protect your innovations and ideas.</span></span></span></span></li>
                    <li><span ><span ><strong><span><span>Employment Law</span></span></strong><span><span>: Helping businesses comply with Fair Work laws, including employee contracts, workplace policies, and resolving employee disputes.</span></span></span></span></li>
                    <li><span ><span ><strong><span><span>Dispute Resolution</span></span></strong><span><span>: Offering mediation, arbitration, and litigation services to resolve business disputes efficiently.</span></span></span></span></li>
                </ul>

                <p><span ><span ><strong><span><span>Why Choose Bansal Lawyers for Business Law?</span></span></strong></span></span></p>

                <ul>
                    <li><span ><span ><strong><span><span>Expertise</span></span></strong><span><span>: With years of experience, we provide in-depth knowledge and practical advice for businesses in all industries.</span></span></span></span></li>
                    <li><span ><span ><strong><span><span>Tailored Solutions</span></span></strong><span><span>: We understand that each business is unique, offering customized solutions to fit your specific needs.</span></span></span></span></li>
                    <li><span ><span ><strong><span><span>Client-Centred Approach</span></span></strong><span><span>: Our priority is your business&rsquo;s success, and we work closely with you to deliver the best legal outcomes.</span></span></span></span></li>
                </ul>

            <?php
            }


            else if(  isset($type) && $type == "leasing-or-selling-a-business" )
            { ?>
                <h1>Leasing or Selling a Business: Legal Support for Smooth Transactions</h1>
                <span><span><strong><span><span>Leasing a Business: What You Need to Know</span></span></strong></span></span>

                <p>&nbsp;</p>

                <p><span><span><span><span>Leasing a commercial property for your business is a crucial decision. Whether you are entering a new lease or renewing an existing one, it&#39;s important to understand your legal rights and obligations. A lease agreement can have significant financial and operational implications, and having an experienced lawyer by your side can help avoid pitfalls.</span></span></span></span></p>

                <p><span><span><span><span>At <strong>Bansal Lawyers</strong>, we provide expert legal advice on leasing commercial properties, from negotiating lease terms to resolving disputes with landlords. Our goal is to help you secure favorable lease agreements and minimize any risks that may arise during your lease tenure.</span></span></span></span></p>

                <p><span><span><strong><span><span>Our Leasing Services Include:</span></span></strong></span></span></p>

                <ul>
                    <li><span><span><strong><span><span>Lease Negotiation</span></span></strong><span><span>: We assist in negotiating favorable lease terms, including rent, renewal options, and exit clauses, ensuring your business&rsquo;s long-term interests are protected.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Lease Reviews</span></span></strong><span><span>: We review existing leases to ensure compliance with applicable laws and identify any hidden costs or potential risks.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Dispute Resolution</span></span></strong><span><span>: If issues arise during your lease, we offer mediation, arbitration, or litigation services to resolve disputes swiftly and efficiently.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Advice on Lease Termination</span></span></strong><span><span>: We provide guidance on how to terminate or exit a lease early, ensuring that your business complies with contractual terms and avoids penalties.</span></span></span></span></li>
                </ul>

                <p><span><span><strong><span><span>Selling a Business: Legal Considerations</span></span></strong></span></span></p>

                <p><span><span><span><span>Selling a business involves a thorough understanding of both the legal and financial aspects of the transaction. Whether you are selling your entire business or just part of it, there are several steps involved, including due diligence, drafting sale agreements, and addressing employee and contractual obligations.</span></span></span></span></p>

                <p><span><span><strong><span><span>Our Business Sale Services Include:</span></span></strong></span></span></p>

                <ul>
                    <li><span><span><strong><span><span>Sale Agreement Drafting</span></span></strong><span><span>: We ensure that the sale agreement is legally sound, outlining all key terms, conditions, and responsibilities.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Due Diligence</span></span></strong><span><span>: We help with the due diligence process to ensure that all relevant financial, legal, and operational information is disclosed and understood by both parties.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Employee and Contractual Obligations</span></span></strong><span><span>: We assist in managing employee transfers and resolving any issues with supplier or client contracts that may arise during the sale.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Tax Considerations</span></span></strong><span><span>: Our legal team advises on the tax implications of the sale, including capital gains tax and other potential tax liabilities.</span></span></span></span></li>
                </ul>

                <p><span><span><strong><span><span>Why Choose Bansal Lawyers for Leasing or Selling Your Business?</span></span></strong></span></span></p>

                <ul>
                    <li><span><span><strong><span><span>Expert Advice</span></span></strong><span><span>: We provide thorough and strategic legal advice, helping you navigate complex lease and business sale transactions.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Risk Mitigation</span></span></strong><span><span>: Our goal is to protect your interests and minimize any potential legal or financial risks throughout the process.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Seamless Transactions</span></span></strong><span><span>: We work efficiently to ensure smooth leasing or sale transactions, reducing delays and disputes.</span></span></span></span></li>
                </ul>
            <?php
            }


            else if(  isset($type) && $type == "contracts-or-business-agreements" )
            { ?>
                <h1>Contracts and Business Agreements: Protecting Your Interests</h1>

                <p><span><span><strong><span><span>Why Are Business Contracts Important?</span></span></strong></span></span></p>

                <p><span><span><span><span>Contracts and business agreements are essential in any commercial relationship. They set the terms, conditions, and expectations between parties, ensuring that everyone is on the same page and minimizing the risk of misunderstandings or legal disputes. A well-drafted contract protects your business, defines the scope of work, and establishes your rights and obligations.</span></span></span></span></p>

                <p><span><span><span><span>At <strong>Bansal Lawyers</strong>, we provide expert legal services to draft, review, and negotiate a wide range of business contracts. Whether you&#39;re entering into agreements with clients, suppliers, employees, or other businesses, we ensure that your contracts are clear, enforceable, and legally compliant.</span></span></span></span></p>

                <p><span><span><strong><span><span>Our Contract and Business Agreement Services Include:</span></span></strong></span></span></p>

                <ul>
                    <li><span><span><strong><span><span>Contract Drafting</span></span></strong><span><span>: We help you draft clear, legally binding contracts for all types of business relationships, including service agreements, supply contracts, and partnership agreements.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Contract Review</span></span></strong><span><span>: We review your existing contracts to identify potential risks and ensure compliance with Australian law.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Negotiation Support</span></span></strong><span><span>: Our team can assist in negotiating favorable terms to ensure your contracts protect your interests and minimize legal risks.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Dispute Resolution</span></span></strong><span><span>: If a contract dispute arises, we offer mediation, arbitration, or litigation services to resolve the issue efficiently.</span></span></span></span></li>
                </ul>

                <p><span><span><strong><span><span>Why Choose Bansal Lawyers for Contracts and Business Agreements?</span></span></strong></span></span></p>

                <ul>
                    <li><span><span><strong><span><span>Thorough Legal Expertise</span></span></strong><span><span>: We have extensive experience in drafting and negotiating contracts that protect your business&rsquo;s interests.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Attention to Detail</span></span></strong><span><span>: We ensure that every contract is comprehensive, legally enforceable, and free from ambiguity.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Risk Reduction</span></span></strong><span><span>: Our services are designed to minimize the risk of contractual disputes and help you avoid costly litigation.</span></span></span></span></li>
                </ul>
            <?php
            }

            else if(  isset($type) && $type == "loan-agreement" )
            { ?>
                <h1>Loan Agreements: Securing Your Financial Transactions</h1>

                <p><span><span><strong><span><span>What is a Loan Agreement?</span></span></strong></span></span></p>

                <p><span><span><span><span>A loan agreement is a legally binding contract between a lender and a borrower that outlines the terms of a loan. It specifies the loan amount, interest rates, repayment schedules, and any collateral or guarantees associated with the loan. Loan agreements are vital in ensuring that both parties understand their responsibilities and obligations and that the loan transaction is conducted fairly.</span></span></span></span></p>

                <p><span><span><span><span>At <strong>Bansal Lawyers</strong>, we provide expert legal services in drafting, reviewing, and negotiating loan agreements. Whether you are a business seeking financing or a lender, we help ensure that the loan terms are clear, fair, and legally enforceable.</span></span></span></span></p>

                <p><span><span><strong><span><span>Our Loan Agreement Services Include:</span></span></strong></span></span></p>

                <ul>
                    <li><span><span><strong><span><span>Drafting Loan Agreements</span></span></strong><span><span>: We help draft loan agreements that clearly outline the terms of the loan, including repayment schedules, interest rates, and consequences of default.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Loan Agreement Review</span></span></strong><span><span>: We review loan agreements to ensure they are fair, compliant with Australian law, and protect your financial interests.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Negotiation</span></span></strong><span><span>: Our legal team assists in negotiating loan terms to ensure they align with your financial goals and protect your business or investment.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Dispute Resolution</span></span></strong><span><span>: If a dispute arises regarding a loan agreement, we provide mediation, arbitration, or litigation services to resolve the matter efficiently.</span></span></span></span></li>
                </ul>

                <p><span><span><strong><span><span>Why Choose Bansal Lawyers for Loan Agreements?</span></span></strong></span></span></p>

                <ul>
                    <li><span><span><strong><span><span>Expert Legal Advice</span></span></strong><span><span>: We offer clear and comprehensive advice on all aspects of loan agreements, helping you understand the risks and obligations involved.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Risk Mitigation</span></span></strong><span><span>: Our team ensures that your loan agreements are structured to minimize financial and legal risks.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Efficient Legal Solutions</span></span></strong><span><span>: We provide prompt and effective services to ensure smooth loan transactions and quick resolutions to any issues that may arise.</span></span></span></span></li>
                </ul>
            <?php
            }
            
				
          	else if(  isset($type) && $type == "conveyancing" )
            { ?>

                <h1>Conveyancing Services</h1>

                <p><span><span><span><span>Conveyancing is the legal process involved in transferring ownership of a property from one party to another. Whether you&#39;re buying or selling property, conveyancing ensures that all legal requirements are met, contracts are properly drafted, and any potential issues are resolved before the transaction is completed.</span></span></span></span></p>

                <p><span><span><span><span>At <strong>Bansal Lawyers</strong>, our experienced team of conveyancers provide comprehensive legal assistance throughout the entire conveyancing process. We focus on protecting your interests, ensuring that the sale or purchase is legally sound, and that all necessary documents are handled correctly. Our services include:</span></span></span></span></p>

                <ul>
                    <li><span><span><strong><span><span>Reviewing and drafting sale contracts</span></span></strong><span><span>: We review all documents to ensure they reflect your best interests.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Due diligence checks</span></span></strong><span><span>: Ensuring the property has no legal encumbrances or issues.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Negotiating terms of sale</span></span></strong><span><span>: We negotiate terms that are fair and beneficial to you.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Liaising with real estate agents, lenders, and other parties</span></span></strong><span><span>: We coordinate with all involved to ensure a smooth transaction.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Handling settlement</span></span></strong><span><span>: We oversee the settlement process to ensure all legal and financial aspects are completed correctly.</span></span></span></span></li>
                </ul>

                <p><span><span><span><span>Whether you&rsquo;re buying your first home or selling an investment property, <strong>Bansal Lawyers</strong> provides expert advice and legal services to guide you through the conveyancing process efficiently.</span></span></span></span></p>
            <?php
            }

            else if(  isset($type) && $type == "building-and-construction-disputes" )
            { ?>
                <h1>Building and Construction Disputes</h1>

                <p><span><span><span><span>The construction industry often involves complex legal issues and disputes, whether related to residential, commercial, or industrial projects. Disagreements can arise between contractors, builders, developers, suppliers, and clients regarding contracts, delays, defects, or payment issues.</span></span></span></span></p>

                <p><span><span><span><span>At <strong>Bansal Lawyers</strong>, we have extensive experience in resolving building and construction disputes. Our team offers expert legal advice and representation to ensure that your rights are protected, and your matter is resolved fairly. We assist with:</span></span></span></span></p>

                <ul>
                    <li><span><span><strong><span><span>Contract disputes</span></span></strong><span><span>: Resolving conflicts regarding the terms and conditions of building contracts.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Defects and warranty claims</span></span></strong><span><span>: Addressing issues with substandard work, defects, or breaches of warranty.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Payment disputes</span></span></strong><span><span>: Assisting with non-payment or underpayment claims, including progress claims and final payments.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Construction delays</span></span></strong><span><span>: Helping clients address delays in construction, including claims for compensation.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Workplace safety and compliance</span></span></strong><span><span>: Ensuring your construction project adheres to safety regulations and relevant laws.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Insurance claims</span></span></strong><span><span>: Assistance with resolving claims for property damage or construction defects.</span></span></span></span></li>
                </ul>

                <p><span><span><span><span>Whether you are a builder, contractor, developer, or property owner, <strong>Bansal Lawyers</strong> provides strategic legal solutions to ensure a swift and fair resolution of your building and construction disputes.</span></span></span></span></p>
            <?php
            }

            else if(  isset($type) && $type == "caveats-disputs-and-removal" )
            { ?>
                <h1>Caveats disputs and removal</h1>

                <p><span><span><span><span>A caveat is a legal notice lodged with the land registry to protect an interest in a property. It serves as a warning to potential buyers or lenders that there is a legal claim or interest in the property. However, caveats can sometimes be disputed, especially if they are lodged improperly or without merit.</span></span></span></span></p>

                <p><span><span><span><span>At <strong>Bansal Lawyers</strong>, we specialize in handling caveat disputes and the removal of caveats. Our team provides advice and legal representation to resolve issues related to caveats efficiently. We can assist with:</span></span></span></span></p>

                <ul>
                    <li><span><span><strong><span><span>Caveat disputes</span></span></strong><span><span>: Resolving conflicts where a caveat is lodged incorrectly, without a valid claim, or against your interest.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Caveat removal</span></span></strong><span><span>: Taking legal action to remove a caveat that has been wrongfully placed on your property.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Lodging a caveat</span></span></strong><span><span>: Providing guidance for properly lodging a caveat when you need to protect your legal interest in a property.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Negotiating settlements</span></span></strong><span><span>: We work to reach amicable solutions when disputes arise over caveats, helping you avoid lengthy legal battles.</span></span></span></span></li>
                    <li><span><span><strong><span><span>Court action</span></span></strong><span><span>: If necessary, we represent you in court to protect your rights or have a caveat removed.</span></span></span></span></li>
                </ul>

                <p><span><span><span><span>Caveat disputes can be complex and require careful attention. With <strong>Bansal Lawyers</strong> on your side, you can navigate these issues with confidence and work towards a favourable outcome.</span></span></span></span></p>

            <?php
            }
            
          ?>
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
                                                        <a class="elementor-post__read-more" href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" aria-label="Read more about {{@$list->title}}" tabindex="-1"> Read More » </a>
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
                                            </div>

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

    <script src="{{asset('/public/js/jquery-3.6.0.min.js')}}"></script>
    <script>
    jQuery(document).ready(function($){

        function updateLeftSideWidth() {
            let currentUrl = window.location.href;
            let url = new URL(currentUrl);
            let pathname = url.pathname;
            let page = pathname.substring(pathname.lastIndexOf('/') + 1);  // 'property-law'
            //console.log('Page URL segment:', page);
            var windowWidth = $(window).width();
            if ( ( page === 'divorce' || page === 'child-custody' || page === 'family-violence' || page === 'property-settlement' || page === 'family-violence-orders' || page === 'juridicational-error-federal-circuit-court-application' || page === 'art-application' || page === 'visa-refusals-visa-cancellation'  || page === 'intervenition-orders' || page === 'trafic-offences' || page === 'drink-driving-offences' || page === 'assualt-charges' || page === 'business-law'  || page === 'leasing-or-selling-a-business'  || page === 'contracts-or-business-agreements'  || page === 'loan-agreement' || page === 'conveyancing'  || page === 'building-and-construction-disputes'  || page === 'caveats-disputs-and-removal' )  &&  windowWidth > 768 ) {
                var left_side_height = $('.left-side').height();   console.log('left_side_height=' +left_side_height);
                var right_side_height = $('.right-side-exact').height(); console.log('right_side_height=' +right_side_height);
                if(right_side_height > left_side_height ){
                    var left_side_height_upd  = left_side_height+46;
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


