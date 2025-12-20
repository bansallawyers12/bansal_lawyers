@extends('layouts.frontend')
@section('seoinfo')
    <?php if( isset($casedetailists->meta_title) && $casedetailists->meta_title != "") { ?>
        <title>{{@$casedetailists->meta_title}}</title>
    <?php }  else { ?>
        <title>{{ @$casedetailists->title ?? 'Case Study' }}</title>
    <?php } ?>

    <?php if( isset($casedetailists->meta_description) && $casedetailists->meta_description != "") { ?>
        <meta name="description" content="{{@$casedetailists->meta_description}}" />
    <?php }  else { ?>
        <meta name="description" content="{{ Str::limit(strip_tags(@$casedetailists->description ?? ''), 150) }}" />
    <?php } ?>

    <link rel="canonical" href="https://www.bansallawyers.com.au/{{@$casedetailists->slug}}" />

    <!-- OG/Twitter -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/{{@$casedetailists->slug}}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{@$casedetailists->meta_title ?? @$casedetailists->title}}">
    <meta property="og:description" content="{{@$casedetailists->meta_description ?? Str::limit(strip_tags(@$casedetailists->description ?? ''), 150)}}">
    <meta property="og:image" content="{{ isset($casedetailists->image) && $casedetailists->image ? asset('images/blog/' . $casedetailists->image) : asset('images/logo/Bansal_Lawyers.png') }}">
    <meta property="og:image:alt" content="Bansal Lawyers">
    <meta name="twitter:card" content="summary_large_image">
@endsection
@section('content')
    <style>
        /* Blog-style layout for case detail */
        .ftco-section { padding: 5em 0 !important; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .blog-entry .text .heading { font-size: 24px !important; line-height: 1.2em !important; }
        .blog-entry .text .heading a { font-family: 'Poppins', sans-serif !important; color: #1B4D89 !important; }
        .post-meta { 
            font-family: 'Poppins', sans-serif; 
            font-size: 16px; 
            color: #666 !important; 
            text-align: center;
            margin-bottom: 30px;
        }
        
        .left-side {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
            display: inline-block;
            padding-left: 30px;
            padding-right: 20px;
        }
        .right-side {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            float: right;
        }
        
        .et_pb_title_container {
            display: block;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 40px;
            text-align: center;
        }
        
        .entry-title {
            font-family: 'Poppins', sans-serif;
            line-height: 1.2em;
            font-size: 34px;
            color: #1B4D89;
            padding-top: 10px;
            margin-bottom: 15px;
            font-weight: 600;
            text-align: center;
        }
        
        .et_pb_text_inner {
            position: relative;
            word-wrap: break-word;
            width: 100%;
            max-width: 1080px;
            margin: auto;
            background-color: #fff;
            color: #212529 !important;
            font-size: 1rem !important;
            line-height: 1.5 !important;
            font-weight: 400 !important;
            margin-top: 25px;
            padding: 0 40px;
        }
        
        .et_pb_text_inner h1 {
            font-family: 'Poppins', sans-serif;
            line-height: 1.3em;
            font-size: 28px;
            color: #1B4D89;
            padding-top: 25px;
            margin-bottom: 15px;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }
        .et_pb_text_inner h2 {
            font-family: 'Poppins', sans-serif;
            line-height: 1.3em;
            font-size: 24px;
            color: #1B4D89;
            padding-top: 20px;
            margin-bottom: 12px;
            font-weight: 600;
        }
        .et_pb_text_inner h3 {
            font-family: 'Poppins', sans-serif;
            line-height: 1.3em;
            font-size: 20px;
            color: #1B4D89;
            padding-top: 15px;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .et_pb_text_inner p { 
            padding-bottom: 1.2em; 
            line-height: 1.7;
            font-size: 16px;
            color: #333;
        }
        .et_pb_text_inner a, .et_pb_text_inner a:hover { 
            color: #1B4D89 !important; 
            text-decoration: underline;
            text-underline-offset: 2px;
        }
        .et_pb_text_inner ul, .et_pb_text_inner ol {
            padding-left: 25px;
            margin-bottom: 1.2em;
        }
        .et_pb_text_inner li {
            margin-bottom: 0.5em;
            line-height: 1.6;
        }
        
        /* Hide or reduce duplicate case titles in content */
        .et_pb_text_inner h1 {
            display: none !important; /* Hide all h1 elements in content to prevent duplicates */
        }
        
        /* Make h2 elements look like h1 for proper hierarchy */
        .et_pb_text_inner h2:first-child {
            font-size: 28px !important;
            border-bottom: 2px solid #e9ecef !important;
            padding-bottom: 10px !important;
            margin-bottom: 20px !important;
        }
        
        /* Alternative: If we want to show it but make it less prominent */
        .et_pb_text_inner .case-reference {
            font-size: 18px;
            color: #666;
            font-weight: 400;
            font-style: italic;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }
        
        /* Hide any headings that contain case references */
        .et_pb_text_inner h1:contains("Thakur v Minister"),
        .et_pb_text_inner h2:contains("Thakur v Minister"),
        .et_pb_text_inner h3:contains("Thakur v Minister") {
            display: none !important;
        }
        
        /* More specific targeting for case reference patterns */
        .et_pb_text_inner *[class*="case"] h1,
        .et_pb_text_inner *[class*="reference"] h1,
        .et_pb_text_inner *[class*="title"] h1 {
            display: none !important;
        }
        
        .widget-post {
            border: 1px solid #ddd;
            box-shadow: 1px 2px 5px #ccc;
            min-height: 400px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .widget-post .widget-header {
            font-size: 1.5rem;
            color: #1B4D89;
            margin-bottom: 20px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
        }
        
        .related-case-item {
            display: flex;
            gap: 12px;
            padding: 12px;
            border: 1px solid #eee;
            border-radius: 12px;
            margin-bottom: 12px;
            background: #fff;
            transition: all .3s ease;
            text-decoration: none;
        }
        .related-case-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(27,77,137,.15);
            text-decoration: none;
        }
        .related-case-item img {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border-radius: 8px;
        }
        .related-case-item .title {
            color: #1B4D89;
            font-weight: 700;
            line-height: 1.2;
        }
        .related-case-item .more {
            font-size: 12px;
            color: #1B4D89;
            text-transform: uppercase;
        }
        
        @media (max-width: 768px) {
            .left-side {
                flex: 0 0 100%;
                max-width: 100%;
                padding-left: 15px;
                padding-right: 15px;
            }
            .right-side {
                flex: 0 0 100%;
                max-width: 100%;
                float: none;
            }
            .et_pb_text_inner {
                padding: 0 20px;
            }
            .et_pb_title_container {
                padding: 0 20px;
            }
        }
    </style>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="blog-entry justify-content-end left-side">
                    <div class="et_pb_title_container">
                        <h1 class="entry-title">{{ @$casedetailists->title }}</h1>
                        <p class="post-meta">
                            <span class="published"><?php echo date('M d,Y', strtotime($casedetailists->created_at));?></span>
                        </p>
                    </div>
                    @if(isset($casedetailists->image) && $casedetailists->image)
                        @php
                            $imagePath = 'images/blog/' . $casedetailists->image;
                            $pathInfo = pathinfo($imagePath);
                            $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
                            $hasWebP = file_exists(public_path($webpPath));
                        @endphp
                        <div class="et_pb_title_featured_container">
                            <span class="et_pb_image_wrap">
                                <picture>
                                    @if($hasWebP)
                                        <source type="image/webp" srcset="{{ asset($webpPath) }}">
                                    @endif
                                    <img fetchpriority="high" decoding="async" src="{{ asset($imagePath) }}" alt="{{@$casedetailists->slug}}" class="wp-image-512">
                                </picture>
                            </span>
                        </div>
                    @endif
                    <div class="et_pb_text_inner">
                        {!! $casedetailists->description !!}
                        
                        <hr style="margin:30px 0; opacity:.2;">
                        <div class="case-related-internal">
                            <h3 style="color:#1B4D89;">Related migration topics</h3>
                            <ul style="padding-left:18px;">
                                <li><a href="<?php echo URL::to('/'); ?>/juridicational-error-federal-circuit-court-application">Jurisdictional Error / Federal Circuit Court Application</a></li>
                                <li><a href="<?php echo URL::to('/'); ?>/art-application">AAT / ART Application</a></li>
                                <li><a href="<?php echo URL::to('/'); ?>/visa-refusals-visa-cancellation">Visa Refusals &amp; Visa Cancellation</a></li>
                                <li><a href="<?php echo URL::to('/'); ?>/federal-court-application">Federal Court Application</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 right-side">
                    <div class="widget-post">
                        <h3 class="widget-header">Related Pages</h3>
                        <a class="related-case-item" href="<?php echo URL::to('/'); ?>/juridicational-error-federal-circuit-court-application">
                            <img src="{{ asset('images/Juridicational_Error_Federal_Circuit_Court_Application.png') }}" alt="Jurisdictional Error" width="64" height="64" loading="lazy">
                            <div>
                                <div class="title">Juridicational Error/ Federal Circuit Court Application</div>
                                <div class="more">Read this more »</div>
                            </div>
                        </a>
                        <a class="related-case-item" href="<?php echo URL::to('/'); ?>/art-application">
                            <img src="{{ asset('images/ART_Application_Administrative_Review_Tribunal _Application.png') }}" alt="ART Application" width="64" height="64" loading="lazy">
                            <div>
                                <div class="title">ART Application</div>
                                <div class="more">Read this more »</div>
                            </div>
                        </a>
                        <a class="related-case-item" href="<?php echo URL::to('/'); ?>/visa-refusals-visa-cancellation">
                            <img src="{{ asset('images/Visa_Refusals.png') }}" alt="Visa Refusals" width="64" height="64" loading="lazy">
                            <div>
                                <div class="title">Visa Refusals/Visa Cancellation</div>
                                <div class="more">Read this more »</div>
                            </div>
                        </a>
                        <a class="related-case-item" href="<?php echo URL::to('/'); ?>/federal-court-application">
                            <img src="{{ asset('images/federal_court_application.png') }}" alt="Federal Court Application" width="64" height="64" loading="lazy">
                            <div>
                                <div class="title">Federal Court Application</div>
                                <div class="more">Read this more »</div>
                            </div>
                        </a>
                    </div>

                    @include('components.unified-contact-form', [
                        'variant' => 'sidebar',
                        'title' => 'Speak with a Lawyer',
                        'subtitle' => "There's No Legal Puzzle, We Can't Solve",
                        'buttonText' => 'GET LEGAL ADVICE',
                        'formId' => 'case-detail-contact-form',
                        'source' => 'case-detail',
                        'showPhoto' => true
                    ])

                </div>
            </div>
        </div>
    </section>

    <script>
    (function(){
        // Simple smooth scrolling for any internal links
        document.addEventListener('click', function(e){
            if(e.target.tagName.toLowerCase() === 'a' && e.target.getAttribute('href').startsWith('#')){
                e.preventDefault();
                var target = document.querySelector(e.target.getAttribute('href'));
                if(target){
                    target.scrollIntoView({behavior:'smooth', block:'start'});
                }
            }
        });
        
        // Handle duplicate headings - hide or modify duplicate case titles
        document.addEventListener('DOMContentLoaded', function(){
            var pageTitle = document.querySelector('.entry-title');
            var contentArea = document.querySelector('.et_pb_text_inner');
            
            if(pageTitle && contentArea) {
                var pageTitleText = pageTitle.textContent.trim().toLowerCase();
                
                // Hide all h1 elements in content
                var h1Elements = contentArea.querySelectorAll('h1');
                h1Elements.forEach(function(h1) {
                    h1.style.display = 'none';
                });
                
                // Also check for any headings that might contain similar case references
                var allHeadings = contentArea.querySelectorAll('h1, h2, h3, h4, h5, h6');
                allHeadings.forEach(function(heading) {
                    var headingText = heading.textContent.trim().toLowerCase();
                    // If heading contains similar case name, hide it
                    if(headingText.includes('thakur') && headingText.includes('minister') && headingText.includes('immigration')) {
                        heading.style.display = 'none';
                    }
                });
            }
        });
    })();
    </script>
@endsection