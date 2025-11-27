@extends('layouts.frontend')

@section('seoinfo')
    <?php if( isset($blogdetailists->meta_title) && $blogdetailists->meta_title != "") { ?>
        <title>{{@$blogdetailists->meta_title}}</title>
    <?php }  else { ?>
        <title>{{@$blogdetailists->title}} - Bansal Lawyers Blog</title>
    <?php } ?>

    <?php if( isset($blogdetailists->meta_description) && $blogdetailists->meta_description != "") { ?>
        <meta name="description" content="{{@$blogdetailists->meta_description}}" />
    <?php }  else { ?>
        <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags(@$blogdetailists->description), 160) }}" />
    <?php } ?>

    <?php if( isset($blogdetailists->meta_keyword) && $blogdetailists->meta_keyword != "") { ?>
        <meta name="keyword" content="{{@$blogdetailists->meta_keyword}}" />
    <?php }  else { ?>
        <meta name="keyword" content="Bansal Lawyers, Legal Blog, {{@$blogdetailists->title}}" />
    <?php } ?>

    <link rel="canonical" href="<?php echo URL::to('/'); ?>/{{@$blogdetailists->slug}}" />
    
    <!-- Robots Meta Tags -->
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="bingbot" content="index, follow">

	 <!-- Facebook Meta Tags -->
     <meta property="og:url" content="<?php echo URL::to('/'); ?>/{{@$blogdetailists->slug}}">
     <meta property="og:type" content="article">
     <meta property="og:title" content="{{@$blogdetailists->meta_title ?: $blogdetailists->title}}">
     <meta property="og:description" content="{{@$blogdetailists->meta_description ?: \Illuminate\Support\Str::limit(strip_tags(@$blogdetailists->description), 160)}}">
     <meta property="og:image" content="{{ isset($blogdetailists->image) && $blogdetailists->image != '' ? asset('images/blog/' . $blogdetailists->image) : asset('images/logo/Bansal_Lawyers.png') }}">
     <meta property="og:image:alt" content="{{@$blogdetailists->title}}">
     <meta property="article:published_time" content="{{@$blogdetailists->created_at}}">
     <meta property="article:modified_time" content="{{@$blogdetailists->updated_at}}">
     @if(isset($blogdetailists->categorydetail) && $blogdetailists->categorydetail)
     <meta property="article:section" content="{{$blogdetailists->categorydetail->name}}">
     @endif

     <!-- Twitter Meta Tags -->
     <meta name="twitter:card" content="summary_large_image">
     <meta property="twitter:domain" content="bansallawyers.com.au">
     <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/{{@$blogdetailists->slug}}">
     <meta name="twitter:title" content="{{@$blogdetailists->meta_title ?: $blogdetailists->title}}">
     <meta name="twitter:description" content="{{@$blogdetailists->meta_description ?: \Illuminate\Support\Str::limit(strip_tags(@$blogdetailists->description), 160)}}">
     <meta property="twitter:image" content="{{ isset($blogdetailists->image) && $blogdetailists->image != '' ? asset('images/blog/' . $blogdetailists->image) : asset('images/logo/Bansal_Lawyers.png') }}">
     <meta property="twitter:image:alt" content="{{@$blogdetailists->title}}">

     <!-- Article Schema Markup -->
     <script type="application/ld+json">
     {
       "@context": "https://schema.org",
       "@type": "Article",
       "headline": "{{@$blogdetailists->title}}",
       "description": "{{@$blogdetailists->meta_description ?: \Illuminate\Support\Str::limit(strip_tags(@$blogdetailists->description), 160)}}",
       "image": "{{ isset($blogdetailists->image) && $blogdetailists->image != '' ? asset('images/blog/' . $blogdetailists->image) : asset('images/logo/Bansal_Lawyers.png') }}",
       "author": {
         "@type": "Organization",
         "name": "Bansal Lawyers",
         "url": "{{ URL::to('/') }}"
       },
       "publisher": {
         "@type": "Organization",
         "name": "Bansal Lawyers",
         "logo": {
           "@type": "ImageObject",
           "url": "{{ asset('images/logo/Bansal_Lawyers.png') }}"
         }
       },
       "datePublished": "{{@$blogdetailists->created_at}}",
       "dateModified": "{{@$blogdetailists->updated_at}}",
       "mainEntityOfPage": {
         "@type": "WebPage",
         "@id": "{{ URL::to('/') }}/{{@$blogdetailists->slug}}"
       },
       "url": "{{ URL::to('/') }}/{{@$blogdetailists->slug}}",
       @if(isset($blogdetailists->categorydetail) && $blogdetailists->categorydetail)
       "articleSection": "{{$blogdetailists->categorydetail->name}}",
       @endif
       "keywords": "{{@$blogdetailists->meta_keyword ?: 'Bansal Lawyers, Legal Blog, ' . $blogdetailists->title}}"
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
           "item": "{{ URL::to('/') }}"
         },
         {
           "@type": "ListItem",
           "position": 2,
           "name": "Blog",
           "item": "{{ URL::to('/blog') }}"
         },
         {
           "@type": "ListItem",
           "position": 3,
           "name": "{{@$blogdetailists->title}}",
           "item": "{{ URL::to('/') }}/{{@$blogdetailists->slug}}"
         }
       ]
     }
     </script>

     <!-- FAQ Schema (if applicable) -->
     <script type="application/ld+json">
     {
       "@context": "https://schema.org",
       "@type": "FAQPage",
       "mainEntity": [
         {
           "@type": "Question",
           "name": "What legal services does Bansal Lawyers provide?",
           "acceptedAnswer": {
             "@type": "Answer",
             "text": "Bansal Lawyers provides comprehensive legal services including Immigration Law, Family Law, Property Law, Commercial Law, Criminal Law, and Business Law. We serve individuals, families, and businesses across Australia with expert legal guidance and representation."
           }
         },
         {
           "@type": "Question",
           "name": "Why choose Bansal Lawyers for legal services?",
           "acceptedAnswer": {
             "@type": "Answer",
             "text": "Bansal Lawyers offers experienced legal professionals, personalized attention, competitive pricing, and a track record of successful outcomes. Our team is committed to providing the best legal solutions tailored to your specific needs."
           }
         }
       ]
     }
     </script>

     <!-- Local Business Schema -->
     <script type="application/ld+json">
     {
       "@context": "https://schema.org",
       "@type": "LegalService",
       "name": "Bansal Lawyers",
       "image": "{{ asset('images/logo/Bansal_Lawyers.png') }}",
       "description": "Expert legal services in Melbourne for Immigration Law, Family Law, Property disputes, and more. Trusted legal advice in Australia.",
       "address": {
         "@type": "PostalAddress",
         "streetAddress": "Level 8/278 Collins St",
         "addressLocality": "Melbourne",
         "addressRegion": "VIC",
         "postalCode": "3000",
         "addressCountry": "AU",
         "geo": {
           "@type": "GeoCoordinates",
           "latitude": "-37.8136",
           "longitude": "144.9631"
         }
       },
       "telephone": "+61 0422905860",
       "email": "Info@bansallawyers.com.au",
       "url": "{{ URL::to('/') }}",
       "openingHours": "Mo-Fr 09:00-17:00",
       "priceRange": "$$$",
       "areaServed": {
         "@type": "City",
         "name": "Melbourne"
       },
       "serviceArea": {
         "@type": "Country",
         "name": "Australia"
       },
       "hasOfferCatalog": {
         "@type": "OfferCatalog",
         "name": "Legal Services",
         "itemListElement": [
           {
             "@type": "Offer",
             "itemOffered": {
               "@type": "Service",
               "name": "Immigration Law",
               "description": "Expert legal services for visas, appeals, and migration advice."
             }
           },
           {
             "@type": "Offer",
             "itemOffered": {
               "@type": "Service",
               "name": "Family Law",
               "description": "Legal support for family-related matters including divorce and custody."
             }
           },
           {
             "@type": "Offer",
             "itemOffered": {
               "@type": "Service",
               "name": "Property Law",
               "description": "Legal services for property transactions and disputes."
             }
           }
         ]
       }
     }
     </script>

@endsection
@section('content')

<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/bg_1.jpg') }}');display:none;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h2 class="mb-3 bread" id="blog-title">Blog</h2>
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

.category-badge {
    margin-left: 15px;
}

.badge {
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    text-decoration: none;
}

.badge-primary {
    color: #fff;
    background-color: #1B4D89;
}

.badge-primary:hover {
    color: #fff;
    background-color: #0d3a6b;
    text-decoration: none;
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
    <?php //echo $blogdetailists->description; ?>
    <div class="blog-entry justify-content-end left-side">
        <div class="et_pb_title_container">
            <h1 class="entry-title">{{@$blogdetailists->title}}</h1>
            <p class="post-meta">
                <span class="published"><?php echo date('M d,Y', strtotime($blogdetailists->created_at));?></span>
                @if(isset($blogdetailists->categorydetail) && $blogdetailists->categorydetail)
                    <span class="category-badge">
                        <a href="{{ route('blog.category', $blogdetailists->categorydetail->slug) }}" class="badge badge-primary">{{ $blogdetailists->categorydetail->name }}</a>
                    </span>
                @endif
                <span class="reading-time" style="margin-left: 15px;">
                    <i class="ion-ios-time mr-1"></i>
                    {{ ceil(str_word_count(strip_tags($blogdetailists->description)) / 200) }} min read
                </span>
                <span class="word-count" style="margin-left: 15px;">
                    <i class="ion-ios-document mr-1"></i>
                    {{ str_word_count(strip_tags($blogdetailists->description)) }} words
                </span>
            </p>
        </div>
      	<?php 
		if( isset($blogdetailists->image) &&  $blogdetailists->image != "") {
          ?>
  			 <div class="et_pb_title_featured_container">
                <span class="et_pb_image_wrap">
                    <picture>
                        <source media="(min-width: 768px)" srcset="{{ asset('images/blog/' . @$blogdetailists->image) }}">
                        <source media="(max-width: 767px)" srcset="{{ asset('images/blog/' . @$blogdetailists->image) }}">
                        <img fetchpriority="high" 
                             decoding="async"  
                             src="{{ asset('images/blog/' . @$blogdetailists->image) }}" 
                             alt="{{@$blogdetailists->title}} - Legal Blog Post by Bansal Lawyers" 
                             class="wp-image-512"
                             width="800" 
                             height="400"
                             loading="eager">
                    </picture>
                </span>
            </div>
  
		<?php } ?>
       
        <div class="et_pb_text_inner">
            <?php echo $blogdetailists->description; ?>
            
            <!-- Author Information -->
            <div class="author-info" style="margin-top: 40px; padding: 20px; background: #f8f9fa; border-radius: 10px; border-left: 4px solid #1B4D89;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 60px; height: 60px; border-radius: 50%; background: #1B4D89; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 24px;">
                        AB
                    </div>
                    <div>
                        <h4 style="margin: 0; color: #1B4D89; font-size: 1.2rem;">Ajay Bansal</h4>
                        <p style="margin: 5px 0 0 0; color: #666; font-size: 0.9rem;">Director, Bansal Lawyers</p>
                        <p style="margin: 5px 0 0 0; color: #888; font-size: 0.85rem;">Expert legal services in Melbourne for Immigration Law, Family Law, Property disputes, and more.</p>
                    </div>
                </div>
            </div>

            <!-- Last Updated Information -->
            @if($blogdetailists->updated_at != $blogdetailists->created_at)
            <div class="updated-info" style="margin-top: 20px; padding: 15px; background: #e8f4fd; border-radius: 8px; border-left: 4px solid #17a2b8;">
                <p style="margin: 0; color: #0c5460; font-size: 0.9rem;">
                    <i class="ion-ios-refresh mr-2"></i>
                    Last updated: {{ date('M d, Y', strtotime($blogdetailists->updated_at)) }}
                </p>
            </div>
            @endif
            
            <!-- FAQ Section -->
            <div class="faq-section" style="margin-top: 40px; padding: 30px; background: #f8f9fa; border-radius: 15px; border-left: 4px solid #1B4D89;">
                <h3 style="color: #1B4D89; margin-bottom: 25px; font-size: 1.5rem; font-weight: 600;">
                    <i class="ion-ios-help-circle mr-2"></i>Frequently Asked Questions
                </h3>
                
                @php
                    $faqs = [
                        [
                            'question' => 'What legal services does Bansal Lawyers provide?',
                            'answer' => 'Bansal Lawyers provides comprehensive legal services including Immigration Law, Family Law, Property Law, Commercial Law, Criminal Law, and Business Law. We serve individuals, families, and businesses across Australia with expert legal guidance and representation.'
                        ],
                        [
                            'question' => 'Why should I choose Bansal Lawyers for my legal needs?',
                            'answer' => 'Bansal Lawyers offers experienced legal professionals, personalized attention, competitive pricing, and a track record of successful outcomes. Our team is committed to providing the best legal solutions tailored to your specific needs with a focus on achieving positive results.'
                        ],
                        [
                            'question' => 'How can I schedule a consultation with Bansal Lawyers?',
                            'answer' => 'You can schedule a consultation by calling us at 1300 BANSAL (1300 226 725), emailing us at info@bansallawyers.com.au, or using our online booking system. We offer flexible appointment times to accommodate your schedule.'
                        ],
                        [
                            'question' => 'What areas of law does Bansal Lawyers specialize in?',
                            'answer' => 'We specialize in Immigration Law (visas, appeals, migration advice), Family Law (divorce, custody, property settlements), Property Law (transactions, disputes), Commercial Law (business formation, contracts), and Criminal Law (defense representation).'
                        ]
                    ];
                @endphp
                
                <div class="faq-container">
                    @foreach($faqs as $index => $faq)
                    <div class="faq-item" style="margin-bottom: 20px; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <div class="faq-question" style="padding: 20px; cursor: pointer; background: #1B4D89; color: white; font-weight: 600; font-size: 1rem; transition: background-color 0.3s ease;" onclick="toggleFAQ({{ $index }})">
                            <span style="float: right; transition: transform 0.3s ease;" id="faq-icon-{{ $index }}">+</span>
                            {{ $faq['question'] }}
                        </div>
                        <div class="faq-answer" id="faq-answer-{{ $index }}" style="padding: 0 20px; max-height: 0; overflow: hidden; transition: all 0.3s ease; background: white;">
                            <div style="padding: 20px 0; color: #666; line-height: 1.6;">
                                {{ $faq['answer'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- CTAs temporarily disabled for testing -->
        </div>
        
        <!-- Related Articles Section -->
        <div class="related-articles" style="margin-top: 50px; padding: 30px; background: #f8f9fa; border-radius: 15px; border-left: 4px solid #1B4D89;">
            <h3 style="color: #1B4D89; margin-bottom: 25px; font-size: 1.5rem; font-weight: 600;">
                <i class="ion-ios-paper mr-2"></i>You Might Also Like
            </h3>
            <div class="row">
                @foreach(@$latestbloglists->take(3) as $related)
                    @if($related->id != $blogdetailists->id)
                    <div class="col-md-4 mb-3">
                        <div class="related-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: transform 0.3s ease; height: 100%;">
                            <div class="related-image" style="height: 150px; overflow: hidden;">
                                @if(isset($related->image) && $related->image != "")
                                    <img src="{{ asset('images/blog/' . $related->image) }}" 
                                         alt="{{ $related->title }} - Legal Blog Post by Bansal Lawyers"
                                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                         loading="lazy">
                                @else
                                    <img src="{{ asset('images/Blog.jpg') }}" 
                                         alt="{{ $related->title }} - Legal Blog Post by Bansal Lawyers"
                                         style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                         loading="lazy">
                                @endif
                            </div>
                            <div class="related-content" style="padding: 20px;">
                                <h5 style="margin: 0 0 10px 0; font-size: 1rem; line-height: 1.3; color: #1B4D89; font-weight: 600;">
                                    <a href="<?php echo URL::to('/'); ?>/{{@$related->slug}}" 
                                       style="color: #1B4D89; text-decoration: none; transition: color 0.3s ease;">
                                        {{@$related->title}}
                                    </a>
                                </h5>
                                <p style="margin: 0; font-size: 0.85rem; color: #666; line-height: 1.4;">
                                    {{ \Illuminate\Support\Str::limit(strip_tags(@$related->description), 80) }}
                                </p>
                                <div style="margin-top: 10px; font-size: 0.8rem; color: #888;">
                                    <i class="ion-ios-calendar mr-1"></i>
                                    {{ date('M d, Y', strtotime($related->created_at)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>


    <div class="right-side">
        
        <aside class="col-lg-11 col-md-11 col-sm-11 mx-auto aside">
            <div class="widget widget-post">
               <div class="widget-header mb-4">
                  <h5 class="title">Latest Blog</h5>
               </div>
               <ul class="widget-wrapper">
                    @foreach (@$latestbloglists as $list)
                    <li class="row justify-content-between mt-2 p-1">
                        <div class="post-thumb">
                        <a href="<?php echo URL::to('/'); ?>/{{ @$list->slug }}" 
   class="d-block" 
   hreflang="en">
    @if(isset($list->image) && $list->image != "")
        <img src="{{ asset('images/blog/' . $list->image) }}" 
             alt="{{ $list->title }} - Legal Blog Post by Bansal Lawyers" 
             class="img-bd-7"
             width="100" 
             height="75"
             loading="lazy">
    @else
        <img src="{{ asset('images/Blog.jpg') }}" 
             alt="{{ $list->title }} - Legal Blog Post by Bansal Lawyers" 
             class="img-bd-7"
             width="100" 
             height="75"
             loading="lazy">
    @endif
</a>
                        </div>

                        <div class="post-content">
                            <a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}">
                                <h2>{{@$list->title}}</h2>
                            </a>
                            <p><?php echo date('M d,Y', strtotime($list->created_at));?></p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
         </aside>
    </div>

</section>

<!-- Mobile Sticky CTA temporarily disabled for testing -->

@endsection
