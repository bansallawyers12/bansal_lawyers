@extends('layouts.frontend')

@section('seoinfo')
    <?php if( isset($casedetailists->meta_title) && $casedetailists->meta_title != "") { ?>
        <title>{{@$casedetailists->meta_title}}</title>
    <?php }  else { ?>
        <title>Bansal Lawyers</title>
    <?php } ?>

    <?php if( isset($casedetailists->meta_description) && $casedetailists->meta_description != "") { ?>
        <meta name="description" content="{{@$casedetailists->meta_description}}" />
    <?php }  else { ?>
        <meta name="description" content="Bansal Lawyers" />
    <?php } ?>

    <?php if( isset($casedetailists->meta_keyword) && $casedetailists->meta_keyword != "") { ?>
        <meta name="keyword" content="{{@$blogdetailists->meta_keyword}}" />
    <?php }  else { ?>
        <meta name="keyword" content="Bansal Lawyers" />
    <?php } ?>

    <link rel="canonical" href="<?php echo URL::to('/'); ?>/{{@$casedetailists->slug}}" />

	 <!-- Facebook Meta Tags -->
     <meta property="og:url" content="<?php echo URL::to('/'); ?>/{{@$casedetailists->slug}}">
     <meta property="og:type" content="website">
     <meta property="og:title" content="{{@$casedetailists->meta_title}}">
     <meta property="og:description" content="{{@$casedetailists->meta_description}}">
     <meta property="og:image" content="asset('images/logo/Bansal_Lawyers.png')">
     <meta property="og:image:alt" content="Bansal Lawyers Logo">

     <!-- Twitter Meta Tags -->
     <meta name="twitter:card" content="summary_large_image">
     <meta property="twitter:domain" content="bansallawyers.com.au">
     <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/{{@$casedetailists->slug}}">
     <meta name="twitter:title" content="{{@$casedetailists->meta_title}}">
     <meta name="twitter:description" content="{{@$casedetailists->meta_description}}">
     <meta property="twitter:image" content="asset('images/logo/Bansal_Lawyers.png')">
     <meta property="twitter:image:alt" content="Bansal Lawyers Logo">



@endsection
@section('content')

<section class="hero-wrap hero-wrap-2" style="background-image: url('asset('images/bg_1.jpg')');display:none;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h2 class="mb-3 bread" id="blog-title">Case Detail</h2>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span><a href="/case">Recent Case Studies <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Case Detail <i class="ion-ios-arrow-forward"></i></span>
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
    font-size: 2em;
    line-height: 1.2em;
    color: #1B4D89;
    padding-bottom: 10px;
    font-weight: 500;
}

.blog-entry {
    /*width: 60%;
    max-width: 1080px;
    margin: auto;*/
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
    margin-top: 25px;
    width: 100%;
    color: #666;
    font-size: 18px;
    background-color: #fff;
    line-height: 1.7em;
    font-weight: 500;
    -webkit-font-smoothing: antialiased;
}

.et_pb_text_inner {
    color: #212529 !important;
    font-size: 1rem !important;
    line-height: 1.5 !important;
    font-weight: 400 !important;
}

.et_pb_text_inner h1{
    font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
    line-height: 1.2em;
    font-size: 30px;
    color: #1B4D89;
    padding-top: 10px;
}
.et_pb_text_inner h2{
    font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
    line-height: 1.2em;
    font-size: 26px;
    color: #1B4D89;
    padding-top: 10px;
}

.et_pb_text_inner h3{
    font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
    line-height: 1.2em;
    font-size: 22px;
    color: #1B4D89;
    padding-top: 10px;
}

.et_pb_text_inner p {
    padding-bottom: 1em;
    padding: 10px 10px 10px 10px;
}

.et_pb_text_inner a, .et_pb_text_inner a:hover{
    color: #1B4D89 !important;

}


.ftco-section {
    padding: 5em 0 !important;

}


.aside {
    position: sticky;
    top: 120px;
}
.ml-auto, .mx-auto {
    margin-left: auto !important;
}

.mr-auto, .mx-auto {
    margin-right: auto !important;
}

.widget-post {
    border: 1px solid #ddd;
    box-shadow: 1px 2px 5px #ccc;
    min-height: 400px;
    padding: 20px;
}

.widget-post .widget-header {
    font-size: 2rem;
    color: #1d184b;
}

.mb-4, .my-4 {
    margin-bottom: 1.5rem !important;
}

ul.widget-wrapper {
    margin: 0;
    padding: 0;
    list-style-type: none;
}

.widget-post .widget-wrapper li {
    border-bottom: 1px solid #ddd;
    width: 96%;
    list-style-type: none;
}
ul,li {
    list-style-type: none;
}

.p-1 {
    padding: 0.25rem !important;
}

.mt-2, .my-2 {
    margin-top: 0.5rem !important;
}
.row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    width: 100%;
    max-width: 100%;
}

.widget-post .widget-wrapper li {
    border-bottom: 1px solid #ddd;
    width: 96%;
}
.p-1 {
    padding: 0.25rem !important;
}

.mt-2, .my-2 {
    margin-top: 0.5rem !important;
}

.widget-post .widget-wrapper li .post-thumb {
    width: 30%;
}

.d-block {
    display: block !important;
    color: #282828;
    text-decoration: none;
}
.widget-post .widget-wrapper li .post-content {
    padding-left: 0.5rem;
}
.post-content a {
    color: #282828;
    text-decoration: none;
}

.widget-post .widget-wrapper li img {
    width: 100px;
}
.img-bd-7 {
    border-radius: 7px;
}

.widget-post .widget-wrapper li .post-content {
    padding-left: 0.5rem;
}

.widget-post .widget-wrapper li .post-content {
    width: 70%;
}

.widget-post .widget-wrapper li .post-content p {
    color: #555;
    font-size: 13px;
}
.widget-post .widget-wrapper li .post-content h2 {
    color: #1d184b;
    font-family: "Poppins", sans-serif !important;
    font-size: 13px;
    margin-bottom: 4px;
    line-height: 1.2;
    font-weight: 600;
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
    }
    .widget-post .widget-wrapper li .post-content{
        padding-left: 30px !important;
    }
}

@media (min-width: 769px) {
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
    }
}
</style>

<section class="ftco-section bg-light">
    <?php //echo $casedetailists->description; ?>
    <div class="blog-entry justify-content-end left-side">
        <div class="et_pb_title_container">
            <h1 class="entry-title">{{@$casedetailists->title}}</h1>
            <p class="post-meta"><span class="published"><?php echo date('M d,Y', strtotime($casedetailists->created_at));?></span></p>
        </div>
      	<?php
		if( isset($casedetailists->image) &&  $casedetailists->image != "") {
          ?>
  			 <div class="et_pb_title_featured_container">
                <span class="et_pb_image_wrap">
                    <img fetchpriority="high" decoding="async"  src="{{ asset('img/blog/' . @$casedetailists->image) }}" alt="{{@$casedetailists->slug}}" class="wp-image-512">
                </span>
            </div>

		<?php } ?>

        <div class="et_pb_text_inner">
            <?php echo $casedetailists->description; ?>
        </div>
    </div>




</section>
@endsection
