@extends('layouts.frontend')

@section('seoinfo')
    <?php if( isset($blogdetailists->meta_title) && $blogdetailists->meta_title != "") { ?>
        <title>{{@$blogdetailists->meta_title}}</title>
    <?php }  else { ?>
        <title>Bansal Lawyers</title>
    <?php } ?>

    <?php if( isset($blogdetailists->meta_description) && $blogdetailists->meta_description != "") { ?>
        <meta name="description" content="{{@$blogdetailists->meta_description}}" />
    <?php }  else { ?>
        <meta name="description" content="Bansal Lawyers" />
    <?php } ?>

    <?php if( isset($blogdetailists->meta_keyword) && $blogdetailists->meta_keyword != "") { ?>
        <meta name="keyword" content="{{@$blogdetailists->meta_keyword}}" />
    <?php }  else { ?>
        <meta name="keyword" content="Bansal Lawyers" />
    <?php } ?>

    <link rel="canonical" href="<?php echo URL::to('/'); ?>/{{@$blogdetailists->slug}}" />

	 <!-- Facebook Meta Tags -->
     <meta property="og:url" content="<?php echo URL::to('/'); ?>/{{@$blogdetailists->slug}}">
     <meta property="og:type" content="website">
     <meta property="og:title" content="{{@$blogdetailists->meta_title}}">
     <meta property="og:description" content="{{@$blogdetailists->meta_description}}">
     <meta property="og:image" content="<?php echo URL::to('/'); ?>/public/images/logo/Bansal_Lawyers.png">
     <meta property="og:image:alt" content="Bansal Lawyers Logo">

     <!-- Twitter Meta Tags -->
     <meta name="twitter:card" content="summary_large_image">
     <meta property="twitter:domain" content="bansallawyers.com.au">
     <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/{{@$blogdetailists->slug}}">
     <meta name="twitter:title" content="{{@$blogdetailists->meta_title}}">
     <meta name="twitter:description" content="{{@$blogdetailists->meta_description}}">
     <meta property="twitter:image" content="<?php echo URL::to('/'); ?>/public/images/logo/Bansal_Lawyers.png">
     <meta property="twitter:image:alt" content="Bansal Lawyers Logo">



@endsection
@section('content')

<section class="hero-wrap hero-wrap-2" style="background-image: url('public/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread" id="blog-title">Blog</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span><a href="/blog">Blog <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Blog Detail <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>

<style>
/*.container{
    color:#000;
    font-family: "Anton", Sans-serif;
}
h1 {
    font-size: 41px;
    font-weight: 500;
    line-height: 1;
}
.bg-light {
    background: #fff !important;
}
#blog-list {
    max-width: 850px !important;
    margin: auto;
}
p {
    margin-top: 0;
    margin-bottom: 15px !important;
}
h2{
    font-size: 20px;
    font-weight: 700;
}*/

.et_pb_title_container {
    display: block;
    /* max-width: 100%; */
    word-wrap: break-word;
    /*z-index: 98;
    position: relative;*/
}

.entry-title {
    font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
    font-size: 50px;
    line-height: 1.2em;
    color: #1B4D89;
    padding-bottom: 10px;
    font-weight: 500;
}

.blog-entry {
    width: 60%;
    max-width: 1080px;
    margin: auto;
    position: relative;
}

.post-meta {
    font-family: Manrope, Helvetica, Arial, Lucida, sans-serif;
    color: #1B4D89 !important;
}

.et_pb_title_featured_container {
    margin-top: 10px;
    line-height: 0;
    position: relative;
    margin-left: auto;
    margin-right: auto;
}

.et_pb_title_featured_container .et_pb_image_wrap {
    display: inline-block;
    position: relative;
    max-width: 100%;
    width: 100%;
}

.et_pb_title_featured_container img {
    height: auto;
    max-height: none;
    width: 100%;
}



.et_pb_text_inner {
    position: relative;
    word-wrap: break-word;
    width: 80%;
    max-width: 1080px;
    margin: auto;



    background-color: #fff;
    background-position: 50%;
    background-size: 100%;
    background-size: cover;

    font-family: Manrope, Helvetica, Arial, Lucida, sans-serif;

}

.et_pb_text_inner {
    padding: 54px;
    margin-top: 25px;
    width: 100%;
    color: #666;
    font-size: 18px;
    background-color: #fff;
    line-height: 1.7em;
    font-weight: 500;
    -webkit-font-smoothing: antialiased;

}

.et_pb_text_inner h1{
    font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
    line-height: 1.2em;
    font-size: 30px;
    color: #1B4D89;
}
.et_pb_text_inner h2{
    font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
    line-height: 1.2em;
    font-size: 26px;
    color: #1B4D89;
}

.et_pb_text_inner h3{
    font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
    line-height: 1.2em;
    font-size: 22px;
    color: #1B4D89;
}

.et_pb_text_inner p {
    padding-bottom: 1em;
}

.et_pb_text_inner a, .et_pb_text_inner a:hover{
    color: #1B4D89 !important;

}

</style>

<section class="ftco-section bg-light">
    <?php //echo $blogdetailists->description; ?>

    <div class="blog-entry justify-content-end">

        <div class="et_pb_title_container">
            <h1 class="entry-title">{{@$blogdetailists->title}}</h1>
            <p class="post-meta"><span class="published"><?php echo date('M d,Y', strtotime($blogdetailists->created_at));?></span></p>
        </div>

        <div class="et_pb_title_featured_container">
            <span class="et_pb_image_wrap">
                <img fetchpriority="high" decoding="async"  src="public/img/blog/{{@$blogdetailists->image}}" class="wp-image-512">
            </span>
        </div>


        <div class="et_pb_text_inner">
            <?php echo $blogdetailists->description; ?>
        </div>
    </div>




</section>
@endsection
