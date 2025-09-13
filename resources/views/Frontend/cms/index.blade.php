@extends('layouts.frontend')

    @section('seoinfo')
    <?php if( isset($pagedata->meta_title) && $pagedata->meta_title != "") { ?>
        <title>{{@$pagedata->meta_title}}</title>
    <?php }  else { ?>
        <title>Bansal Lawyers</title>
    <?php } ?>

    <?php if( isset($pagedata->meta_description) && $pagedata->meta_description != "") { ?>
        <meta name="description" content="{{@$pagedata->meta_description}}" />
    <?php }  else { ?>
        <meta name="description" content="Bansal Lawyers" />
    <?php } ?>

    <?php if( isset($pagedata->meta_keyward) && $pagedata->meta_keyward != "") { ?>
        <meta name="keyword" content="{{@$pagedata->meta_keyward}}" />
    <?php }  else { ?>
        <meta name="keyword" content="Bansal Lawyers" />
    <?php } ?>


	<link rel="canonical" href="<?php echo URL::to('/'); ?>/{{@$pagedata->slug}}" />

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/{{@$pagedata->slug}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{@$pagedata->meta_title}}">
    <meta property="og:description" content="{{@$pagedata->meta_description}}">
    <meta property="og:image" content="{{ asset('img/logo/Bansal_Lawyers.png') }}">
	<meta property="og:image:alt" content="Bansal Lawyers Logo">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/{{@$pagedata->slug}}">
    <meta name="twitter:title" content="{{@$pagedata->meta_title}}">
    <meta name="twitter:description" content="{{@$pagedata->meta_description}}">
    <meta property="twitter:image" content="{{ asset('img/logo/Bansal_Lawyers.png') }}">
	<meta property="twitter:image:alt" content="Bansal Lawyers Logo">
@endsection

@section('content')
	<?php
    if( isset($pagedata->slug) ) {
        if($pagedata->slug == "about" ) {
            $bg_image = asset('img/Aboutus.jpg');
        } else if($pagedata->slug == "practice-areas" ) {
            $bg_image = asset('img/PracticeArea.jpg');
        } else if($pagedata->slug == "case" ) {
            $bg_image = asset('img/CaseStudies.jpg');
        } else if($pagedata->slug == "blog" ) {
            $bg_image = asset('img/Blog.jpg');
        } else {
            $bg_image = asset('img/bg_1.jpg');
        }
    } else {
        $bg_image = asset('img/bg_1.jpg');
    }?>
	<section class="hero-wrap hero-wrap-2" style="background-image: url('<?php echo $bg_image;?>');margin-bottom: 40px;max-height:422px !important;" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <h1 class="mb-3 bread">{{@$pagedata->title}}</h1>

                    <?php if( isset($pagedata->slug) && $pagedata->slug == "case" ) { ?>
                        <p>Discover how Bansal Lawyers has consistently delivered successful outcomes in complex legal cases.</p>
                    <?php } ?>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span>
                        <span>{{@$pagedata->title}} <i class="ion-ios-arrow-forward"></i></span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <?php echo $pagedata->content; ?>
    </section>
@endsection
