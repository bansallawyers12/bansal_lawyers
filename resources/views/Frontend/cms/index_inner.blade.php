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


	<link rel="canonical" href="https://www.bansallawyers.com.au/{{@$pagedata->slug}}" />
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
    <meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="twitter:image:alt" content="Bansal Lawyers Logo">
@endsection

@section('head')
<link rel="stylesheet" href="{{ asset('css/cms-inner.css') }}?v=1.0">
@endsection

@section('content')
<article class="content-section">
<?php echo $pagedata->content; ?>
</article>
@endsection
