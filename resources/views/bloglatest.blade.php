@extends('layouts.frontend')
@section('seoinfo')
<title>Legal Insights & Updates | Bansal Lawyers Blog Melbourne</title>
<meta name="description" content="Stay informed with Bansal Lawyers' blog. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more. Benefit from the knowledge of our experienced Melbourne team." />

<link rel="canonical" href="<?php echo URL::to('/'); ?>/blog" />
<!-- Facebook Meta Tags -->
<meta property="og:url" content="<?php echo URL::to('/'); ?>/blog">
<meta property="og:type" content="website">
<meta property="og:title" content="Legal Insights & Updates | Bansal Lawyers Blog Melbourne">
<meta property="og:description" content="Stay informed with Bansal Lawyers' blog. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more. Benefit from the knowledge of our experienced Melbourne team.">
<meta property="og:image" content="<?php echo URL::to('/'); ?>/public/images/logo/Bansal_Lawyers.png">
<meta property="og:image:alt" content="Bansal Lawyers Logo">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="bansallawyers.com.au">
<meta property="twitter:url" content="<?php echo URL::to('/'); ?>/blog">
<meta name="twitter:title" content="Legal Insights & Updates | Bansal Lawyers Blog Melbourne">
<meta name="twitter:description" content="Stay informed with Bansal Lawyers' blog. Access expert advice, legal trends, and guidance on family law, immigration, property disputes, and more. Benefit from the knowledge of our experienced Melbourne team.">
<meta property="twitter:image" content="<?php echo URL::to('/'); ?>/public/images/logo/Bansal_Lawyers.png">
<meta property="twitter:image:alt" content="Bansal Lawyers Logo">
@endsection
@section('content')
<style>
.blog-entry .text .heading {font-size: 24px !important;line-height: 1.2em !important; }
.blog-entry .text .heading a { font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif !important;color: #1B4D89 !important; }
.post-meta {font-family: Manrope, Helvetica, Arial, Lucida, sans-serif;font-size: 16px;color: #1B4D89 !important;}
  
  @media (max-width: 768px) {
    .block-20 {
        height: 240px !important;
    }
}

@media (min-width: 769px) {
    .block-20 {
        height: 260px !important;
    }
}
</style>

<section class="hero-wrap hero-wrap-2" style="background-image: url('public/images/Blog.jpg');max-height:422px !important;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread" id="blog-title">Blog</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Blog <i class="ion-ios-arrow-forward"></i></span>
                </p>
            </div>
        </div>
    </div>
</section>


<section class="ftco-section bg-light">
    <div class="container">
        <div class="row d-flex" id="blog-list">
            @foreach (@$bloglists as $list)
                <div class="col-md-4 d-flex ftco-animate">
                    <div class="blog-entry justify-content-end">
                    <a href="<?php echo URL::to('/'); ?>/{{ @$list->slug }}" 
   class="block-20" 
   style="background-image: url('public/img/blog/{{ @$list->image }}');" 
   onclick="showFullBlog(1)">
   <span style="position:absolute;width:1px;height:1px;padding:0;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0;">
       Read more about {{ @$list->title }}
   </span>
</a>
                        <div class="text px-4 py-4" style="margin-bottom: -40px;">
                            <h3 class="heading mb-0"><a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" onclick="showFullBlog(1)">{{@$list->title}}</a></h3>
                            <p class="post-meta"><span class="published"><?php echo date('M d,Y', strtotime($list->created_at));?></span></p>
                        </div>
                        <div class="text p-4 float-right d-block">
                            <!--<div class="topper d-flex align-items-center">
                                <div class="one py-2 pl-3 pr-1 align-self-stretch">
                                    <span class="day"><?php //echo date('d', strtotime($list->created_at));?></span>
                                </div>
                                <div class="two pl-0 pr-3 py-2 align-self-stretch">
                                    <span class="yr"><?php // echo date('Y', strtotime($list->created_at));?></span>
                                    <span class="mos"><?php //echo date('M', strtotime($list->created_at));?></span>
                                </div>
                            </div>-->
                            <p style="text-align: justify;">{{ @$list->description == "" ? config('constants.empty') : \Illuminate\Support\Str::limit(strip_tags(@$list->description), 500, '...') }} </p>
                            <p><a href="<?php echo URL::to('/'); ?>/{{@$list->slug}}" class="btn btn-primary" >Read This More</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Full Blog Content -->
        <div class="row mt-5" id="blog-content" style="display: none;">
            <div class="col-md-12">
                <div class="bg-dark text-white p-4" style="border-radius: 5px;">
                    <h2 id="full-blog-title" style="color: yellow;"></h2>
                    <p id="full-blog-content" style="color: white; text-align: justify;"></p>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function openPdfInNewTab(event, pdfUrl)
    {
        event.preventDefault(); // Prevent default anchor behavior

        // Create a new tab
        const newTab = window.open('', '_blank');

        // Write HTML content with an iframe into the new tab
        newTab.document.write(`
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>PDF Viewer</title>
                <style>
                    html, body {
                        margin: 0;
                        padding: 0;
                        height: 100%; /* Ensure the body and html are 100% height */
                        overflow: hidden; /* Prevent scrollbars */
                    }
                    iframe {
                        width: 100%;
                        height: 100%; /* Fill the entire viewport */
                        border: none; /* No border for the iframe */
                    }
                </style>
            </head>
            <body>
                <iframe src="${pdfUrl}" allowfullscreen></iframe>
            </body>
            </html>
        `);

        // Close the document stream to finish loading
        newTab.document.close();
    }


    function openPdfInNewTab1(event, pdfUrl) {
        event.preventDefault(); // Prevent default anchor behavior

        // Create a new tab
        const newTab = window.open('', '_blank');

        // Write HTML content with an iframe into the new tab
        newTab.document.write(`
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>PDF Viewer</title>
                <style>
                    html, body {
                        margin: 0;
                        padding: 0;
                        height: 100%; /* Ensure the body and html are 100% height */
                        overflow: hidden; /* Prevent scrollbars */
                    }
                    iframe {
                        width: 100%;
                        height: 100%; /* Fill the entire viewport */
                        border: none; /* No border for the iframe */
                    }
                </style>
            </head>
            <body>
                <iframe src="${pdfUrl}" allowfullscreen></iframe>
            </body>
            </html>
        `);

        // Close the document stream to finish loading
        newTab.document.close();
    }

</script>


<script>
    const blogs = {
        1: {
            title: "Key Insights into Industrial Laws",
            content: `Industrial laws serve as the foundation for regulating workplace practices and ensuring fair treatment
            of employees. These laws set the standards for safety, health, and welfare in industries, which are critical
            for fostering an ethical and productive work environment. They encompass rules regarding working hours,
            wages, grievance redressal mechanisms, and labor rights. Proper compliance helps organizations minimize
            workplace disputes and penalties while boosting employee satisfaction and productivity. With globalization
            and evolving business practices, understanding industrial laws is crucial for companies aiming to maintain
            a competitive edge.`
        },
        2: {
            title: "Navigating Corporate Litigation",
            content: `Corporate litigation involves resolving disputes related to business operations, ranging from
            contract breaches to shareholder issues. This complex field of law requires companies to adopt robust
            strategies to minimize risks and legal exposure. Legal experts play a pivotal role in guiding businesses
            through the intricacies of litigation, offering tailored solutions to protect their interests. Key focus
            areas include alternative dispute resolution mechanisms, compliance audits, and risk management plans.
            Investing in a proactive legal strategy is essential for maintaining corporate stability and reputation.`
        },
        3: {
            title: "Understanding Intellectual Property Rights",
            content: `In today's innovation-driven world, intellectual property (IP) is a valuable asset for businesses
            and individuals alike. IP rights protect creations such as inventions, trademarks, and artistic works,
            enabling their creators to maintain exclusive rights and monetize their innovations. Failing to secure IP
            can lead to unauthorized use and financial losses. Organizations must stay updated with IP laws, especially
            in global markets where infringement risks are higher. Our experts provide comprehensive IP management
            solutions to safeguard your creations and enhance business value.`
        },
        4: {
            title: "Best Practices in Employment Law",
            content: `Employment law is a vital area of legal practice that governs the relationship between employers
        and employees. It covers issues such as hiring practices, workplace policies, employee benefits, and
        termination procedures. Adopting best practices in employment law ensures compliance with regulations,
        reduces the likelihood of disputes, and fosters a positive work environment.

        For employers, understanding these laws means creating fair contracts, promoting diversity, and avoiding
        discriminatory practices. Regular training on workplace ethics and legal obligations can prevent harassment
        or bias, contributing to employee satisfaction and retention. For employees, knowing your rights ensures
        protection against unfair treatment and allows you to seek remedies in case of grievances.

        In today's dynamic workplace, evolving trends such as remote work, gig economy roles, and technological
        advancements have introduced new legal challenges. Employers must update policies to address these
        developments while maintaining compliance with local and international laws.

        Legal experts recommend conducting periodic audits of employment practices, offering transparent
        communication channels for employees, and fostering a culture of mutual respect. Proactively managing
        employment law matters can save businesses from costly litigation and reputational damage while ensuring
        a harmonious workplace. Whether you are an employer or an employee, staying informed about employment law
        is essential for navigating the complexities of the modern work environment.`
        }
    };

    function showFullBlog(id) {
        const blogTitle = document.getElementById("full-blog-title");
        const blogContent = document.getElementById("full-blog-content");
        const blogContentSection = document.getElementById("blog-content");

        // Set the hero section title
        document.getElementById("blog-title").textContent = blogs[id].title;

        // Set the full blog content
        blogTitle.textContent = blogs[id].title;
        blogContent.textContent = blogs[id].content;

        // Show the blog content section
        blogContentSection.style.display = "block";

        // Scroll to the content
        blogContentSection.scrollIntoView({ behavior: "smooth" });
    }
</script>

@endsection
