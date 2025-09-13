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
            font-size: 1.1rem;
            line-height: 1.6;
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
            color: #333;
            margin-top: 20px;
            font-size: 1.5rem;
            text-align: left;
            /* Align subheadings to the left */
        }
    </style>
<?php echo $pagedata->content; ?>
@endsection

