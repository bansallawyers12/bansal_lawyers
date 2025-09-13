@extends('layouts.frontend')
@section('seoinfo')
	<title>Case Studies | Successful Legal Results with Bansal Lawyers Melbourne</title>
	<meta name="description" content="Discover Bansal Lawyers&#039; case studies showcasing successful outcomes in family law, immigration, property disputes, and more. See how our expert legal team in Melbourne can help you achieve the best possible result." />

    <meta name="keyword" content="Discover Bansal Lawyers&#039; case studies showcasing successful outcomes in family law, immigration, property disputes, and more. See how our expert legal team in Melbourne can help you achieve the best possible result." />

    <link rel="canonical" href="<?php echo URL::to('/'); ?>/case" />

	<!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/case">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Case Studies | Successful Legal Results with Bansal Lawyers Melbourne">
    <meta property="og:description" content="Discover Bansal Lawyers&#039; case studies showcasing successful outcomes in family law, immigration, property disputes, and more. See how our expert legal team in Melbourne can help you achieve the best possible result.">
    <meta property="og:image" content="{{ asset('img/logo/Bansal_Lawyers.png') }}">
    <meta property="og:image:alt" content="Bansal Lawyers Logo">

	<!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/case">
    <meta name="twitter:title" content="Case Studies | Successful Legal Results with Bansal Lawyers Melbourne">
    <meta name="twitter:description" content="Discover Bansal Lawyers&#039; case studies showcasing successful outcomes in family law, immigration, property disputes, and more. See how our expert legal team in Melbourne can help you achieve the best possible result.">
    <meta name="twitter:image" content="{{ asset('img/logo/Bansal_Lawyers.png') }}">
    <meta property="twitter:image:alt" content="Bansal Lawyers Logo">

@endsection
@section('content')


	<!--Content-->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('img/CaseStudies.jpg') }}');margin-bottom: 40px;max-height:422px !important;" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <h1 class="mb-3 bread">Recent Case Studies</h1>
                    <p>Discover how Bansal Lawyers has consistently delivered successful outcomes in complex legal cases.</p>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span>
                        <span>Recent Case Studies  <i class="ion-ios-arrow-forward"></i></span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="layout__region layout__region--content">
            <div class="field field--name-field-add-card-item field--type-entity-reference-revisions field--label-hidden field__items-card-block">
                <div class="container" style="margin-top: 35px;margin-bottom: 35px;">
                    <div class="row">
                      
                        @foreach (@$caselists as $list)
                        <div class="field__item-card col-lg-3">
                            <div class="paragraph paragraph--type--family-law-card paragraph--view-mode--default">
                                <div class="card clearfix">
                                    <div class="card-header">
                                        <div class="field field--name-field-icon field--type-entity-reference field--label-hidden field__item">
                                          <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" target="_blank">
                                                <img loading="lazy" src="{{ asset('img/blog/' . @$list->image) }}" alt="{{@$list->image_alt}}" style="width:50%;">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-block card-body">
                                        <div class="field field--name-field-title field--type-string-long field--label-hidden field__item">
                                          <a style="color: #fff;" href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" target="_blank">{{@$list->title}}</a>
                                       </div>
                                        <div class="field field--name-field-block-summary field--type-string-long field--label-hidden field__item">{{@$list->short_description}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        

                        
                    </div>

                   
                </div>
            </div>
        </div>
        <style>
        img.image-style-icon-92-x-92 {
            height: 60px;
            width: 60px;
        }

        .layout--onecol .layout__region {
            width: 100%;
        }

        .container {
            max-width: 1300px !important;
            background: none;
        }

        .field--name-field-add-card-item .row {
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -webkit-flex-direction: row;
            -ms-flex-direction: row;
            flex-direction: row;
        }

        .field__item-card.col-lg-3 {
            margin-right: 2rem;
            width: 356px;
            margin-bottom: 6rem;
        }

        .card {
            background: #002247;
            border-radius: 20px;
            padding: 1rem;
        }

        .card .card-header {
            padding: 0.5rem 1rem 0rem 1rem;
        }

        .card-header:first-child {
            border-radius: var(--bs-card-inner-border-radius) var(--bs-card-inner-border-radius) 0 0;
        }

        .card-header,.card-footer {
            background: transparent;
            border: 0;
        }

        .field--type-entity-reference {
            margin: 0 0 1.2rem;
        }

        .content img {
            max-width: 100%;
            height: auto;
        }

        .card .card-body {
            padding: 0rem 1rem;
        }

        .card .field--name-field-block-summary {
            font-size: 1rem;
            line-height: 1.5rem;
            color: #FFF;
        }

        .card-footer:last-child {
            border-radius: 0 0 var(--bs-card-inner-border-radius) var(--bs-card-inner-border-radius);
        }

        .field--name-field-card-block .field--name-field-link-to-content-page {
            margin-bottom: 1.25rem;
        }

        .card .card-header {
            padding: 0.5rem 1rem 0rem 1rem;
        }

        .card-header:first-child {
            border-radius: var(--bs-card-inner-border-radius) var(--bs-card-inner-border-radius) 0 0;
        }

        .content img {
            max-width: 100%;
            height: auto;
        }

        .card .card-body {
            padding: 0rem 1rem;
        }

        .card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            color: var(--bs-card-color);
        }

        .field--name-field-card-block .field--name-field-link-to-content-page {
            margin-bottom: 1.25rem;
        }

        .field--name-field-card-block .field--name-field-link-to-content-page a {
            padding: 2rem 1rem 2rem 1rem;
            background: #fff;
            border-radius: 100px;
            font-size: 0;
        }

        .clearfix::after {
            display: block;
            clear: both;
            content: "";
        }

        .field__item-card.col-lg-3 {
            margin-right: 2rem;
            width: 356px;
            margin-bottom: 6rem;
        }

        .row>* {
            -webkit-flex-shrink: 0;
            -ms-flex-negative: 0;
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x)* 0.5);
            padding-left: calc(var(--bs-gutter-x)* 0.5);
            margin-top: var(--bs-gutter-y);
        }

        .card .field--name-field-title {
            font-style: normal;
            font-weight: 600;
            font-size: 30px;
            text-transform: uppercase;
            padding-bottom: 10px;
            color: #FFF;
        }

        .card .card-footer {
            padding: 1.5rem 1rem;
        }

        .field--name-field-card-block .field--name-field-link-to-content-page {
            margin-bottom: 1.25rem;
        }

        @media (min-width: 62rem) {
            .col-lg-3 {
                -webkit-box-flex: 0;
                -webkit-flex: 0 0 auto;
                -ms-flex: 0 0 auto;
                flex: 0 0 auto;
                width: 25%;
            }
        }
        </style>
    </section>
@endsection
