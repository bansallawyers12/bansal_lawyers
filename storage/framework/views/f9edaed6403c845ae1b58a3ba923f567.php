

<?php $__env->startSection('seoinfo'); ?>
    <?php if(isset($blogdetailists->meta_title) && $blogdetailists->meta_title != ""): ?>
        <title><?php echo e($blogdetailists->meta_title); ?> - Experimental</title>
    <?php else: ?>
        <title><?php echo e($blogdetailists->title); ?> - Bansal Lawyers Blog</title>
    <?php endif; ?>

    <?php if(isset($blogdetailists->meta_description) && $blogdetailists->meta_description != ""): ?>
        <meta name="description" content="<?php echo e($blogdetailists->meta_description); ?>" />
    <?php else: ?>
        <meta name="description" content="<?php echo e(\Illuminate\Support\Str::limit(strip_tags($blogdetailists->description), 160)); ?>" />
    <?php endif; ?>

    <?php if(isset($blogdetailists->meta_keyword) && $blogdetailists->meta_keyword != ""): ?>
        <meta name="keyword" content="<?php echo e($blogdetailists->meta_keyword); ?>" />
    <?php else: ?>
        <meta name="keyword" content="Bansal Lawyers, Legal Blog, <?php echo e($blogdetailists->title); ?>" />
    <?php endif; ?>

    <link rel="canonical" href="<?php echo e(URL::to('/')); ?>/<?php echo e($blogdetailists->slug); ?>" />
    
    <!-- Robots Meta Tags -->
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="bingbot" content="index, follow">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo e(URL::to('/')); ?>/<?php echo e($blogdetailists->slug); ?>">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php echo e($blogdetailists->meta_title ?: $blogdetailists->title); ?>">
    <meta property="og:description" content="<?php echo e($blogdetailists->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($blogdetailists->description), 160)); ?>">
    <meta property="og:image" content="<?php echo e(isset($blogdetailists->image) && $blogdetailists->image != '' ? asset('images/blog/' . $blogdetailists->image) : asset('images/logo/Bansal_Lawyers.png')); ?>">
    <meta property="og:image:alt" content="<?php echo e($blogdetailists->title); ?>">
    <meta property="article:published_time" content="<?php echo e($blogdetailists->created_at); ?>">
    <meta property="article:modified_time" content="<?php echo e($blogdetailists->updated_at); ?>">
    <?php if(isset($blogdetailists->categorydetail) && $blogdetailists->categorydetail): ?>
    <meta property="article:section" content="<?php echo e($blogdetailists->categorydetail->name); ?>">
    <?php endif; ?>

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo e(URL::to('/')); ?>/<?php echo e($blogdetailists->slug); ?>">
    <meta name="twitter:title" content="<?php echo e($blogdetailists->meta_title ?: $blogdetailists->title); ?>">
    <meta name="twitter:description" content="<?php echo e($blogdetailists->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($blogdetailists->description), 160)); ?>">
    <meta property="twitter:image" content="<?php echo e(isset($blogdetailists->image) && $blogdetailists->image != '' ? asset('images/blog/' . $blogdetailists->image) : asset('images/logo/Bansal_Lawyers.png')); ?>">
    <meta property="twitter:image:alt" content="<?php echo e($blogdetailists->title); ?>">

    <!-- Article Schema Markup -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": "<?php echo e($blogdetailists->title); ?>",
      "description": "<?php echo e($blogdetailists->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($blogdetailists->description), 160)); ?>",
      "image": "<?php echo e(isset($blogdetailists->image) && $blogdetailists->image != '' ? asset('images/blog/' . $blogdetailists->image) : asset('images/logo/Bansal_Lawyers.png')); ?>",
      "author": {
        "@type": "Organization",
        "name": "Bansal Lawyers",
        "url": "<?php echo e(URL::to('/')); ?>"
      },
      "publisher": {
        "@type": "Organization",
        "name": "Bansal Lawyers",
        "logo": {
          "@type": "ImageObject",
          "url": "<?php echo e(asset('images/logo/Bansal_Lawyers.png')); ?>"
        }
      },
      "datePublished": "<?php echo e($blogdetailists->created_at); ?>",
      "dateModified": "<?php echo e($blogdetailists->updated_at); ?>",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?php echo e(URL::to('/')); ?>/<?php echo e($blogdetailists->slug); ?>"
      },
      "url": "<?php echo e(URL::to('/')); ?>/<?php echo e($blogdetailists->slug); ?>",
      <?php if(isset($blogdetailists->categorydetail) && $blogdetailists->categorydetail): ?>
      "articleSection": <?php echo json_encode($blogdetailists->categorydetail->name); ?>,
      <?php endif; ?>
      "keywords": <?php echo json_encode($blogdetailists->meta_keyword ?: 'Bansal Lawyers, Legal Blog, ' . $blogdetailists->title); ?>

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
          "item": "<?php echo e(URL::to('/')); ?>"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Blog",
          "item": "<?php echo e(URL::to('/blog')); ?>"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "<?php echo e($blogdetailists->title); ?>",
          "item": "<?php echo e(URL::to('/')); ?>/<?php echo e($blogdetailists->slug); ?>"
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
      "image": "<?php echo e(asset('images/logo/Bansal_Lawyers.png')); ?>",
      "description": "Expert legal services in Melbourne for Immigration Law, Family Law, Property disputes, and more. Trusted legal advice in Australia.",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Level 8/278 Collins St",
        "addressLocality": "Melbourne",
        "addressRegion": "VIC",
        "postalCode": "3000",
        "addressCountry": "AU"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "-37.8136",
        "longitude": "144.9631"
      },
      "telephone": "+61 0422905860",
      "email": "Info@bansallawyers.com.au",
      "url": "<?php echo e(URL::to('/')); ?>",
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<style>
/* Experimental Blog Detail Styles */

.experimental-blog-detail-hero {
    background: linear-gradient(135deg, #0a1a2e 0%, #16213e 50%, #1B4D89 100%);
    color: white;
    padding: 60px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.experimental-blog-detail-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('<?php echo e(asset('images/bg_1.jpg')); ?>') center/cover;
    opacity: 0.15;
    z-index: 1;
}

.experimental-blog-detail-hero .container {
    position: relative;
    z-index: 2;
}

.experimental-blog-detail-hero h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
    color: #ffffff;
    font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
}

.experimental-blog-detail-meta {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-top: 20px;
    flex-wrap: wrap;
}

.experimental-blog-detail-meta span {
    background: rgba(255,255,255,0.2);
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.9rem;
    backdrop-filter: blur(10px);
}

.experimental-blog-detail-content {
    background: white;
    border-radius: 20px;
    padding: 50px;
    margin: 20px auto 40px;
    position: relative;
    z-index: 3;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    max-width: 900px;
}

.experimental-blog-detail-image {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: contain;
    border-radius: 15px;
    margin: 0 0 30px 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    display: block;
    clear: both;
}

.experimental-blog-detail-text {
    color: #333;
    line-height: 1.8;
    font-size: 1.1rem;
    font-family: 'Manrope', Helvetica, Arial, sans-serif;
}

.experimental-blog-detail-text h1,
.experimental-blog-detail-text h2,
.experimental-blog-detail-text h3,
.experimental-blog-detail-text h4,
.experimental-blog-detail-text h5,
.experimental-blog-detail-text h6 {
    color: #1B4D89;
    font-family: 'IM Fell French Canon', Georgia, "Times New Roman", serif;
    margin-top: 30px;
    margin-bottom: 15px;
    font-weight: 600;
}

.experimental-blog-detail-text h1 { font-size: 2.2rem; }
.experimental-blog-detail-text h2 { font-size: 1.8rem; }
.experimental-blog-detail-text h3 { font-size: 1.5rem; }
.experimental-blog-detail-text h4 { font-size: 1.3rem; }

.experimental-blog-detail-text p {
    margin-bottom: 20px;
    text-align: justify;
}

.experimental-blog-detail-text a {
    color: #1B4D89;
    text-decoration: none;
    font-weight: 600;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
}

.experimental-blog-detail-text a:hover {
    border-bottom-color: #1B4D89;
    text-decoration: none;
}

.experimental-blog-detail-text ul,
.experimental-blog-detail-text ol {
    margin: 20px 0;
    padding-left: 30px;
}

.experimental-blog-detail-text li {
    margin-bottom: 10px;
    line-height: 1.6;
}

.experimental-blog-detail-text blockquote {
    border-left: 4px solid #1B4D89;
    padding: 20px 30px;
    margin: 30px 0;
    background: #f8f9fa;
    border-radius: 0 10px 10px 0;
    font-style: italic;
    color: #555;
}

.experimental-sidebar {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    border: 1px solid #f0f0f0;
}

.experimental-sidebar h4 {
    color: #1B4D89;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
}

.experimental-latest-post {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
    transition: all 0.3s ease;
}

.experimental-latest-post:hover {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 15px;
    margin: 0 -15px;
}

.experimental-latest-post:last-child {
    border-bottom: none;
}

.experimental-latest-post img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    flex-shrink: 0;
}

.experimental-latest-post-content h5 {
    margin: 0 0 8px 0;
    font-size: 0.95rem;
    line-height: 1.3;
    color: #1B4D89;
    font-weight: 600;
}

.experimental-latest-post-content h5 a {
    color: #1B4D89;
    text-decoration: none;
    transition: color 0.3s ease;
}

.experimental-latest-post-content h5 a:hover {
    color: #0d3a6b;
    text-decoration: none;
}

.experimental-latest-post-content p {
    margin: 0;
    font-size: 0.85rem;
    color: #666;
}

.experimental-breadcrumb {
    background: #f8f9fa;
    padding: 15px 0;
    margin-bottom: 0;
}

.experimental-breadcrumb a {
    color: #1B4D89;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.experimental-breadcrumb a:hover {
    color: #0d3a6b;
    text-decoration: none;
}

.experimental-breadcrumb .separator {
    color: #666;
    margin: 0 10px;
}

.experimental-share-buttons {
    display: flex;
    gap: 10px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
}

.experimental-share-btn {
    background: #1B4D89;
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.experimental-share-btn:hover {
    background: #0d3a6b;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.experimental-share-btn.facebook { background: #3b5998; }
.experimental-share-btn.twitter { background: #1da1f2; }
.experimental-share-btn.linkedin { background: #0077b5; }

@media (max-width: 768px) {
    .experimental-blog-detail-hero h1 {
        font-size: 2rem;
    }
    
    .experimental-blog-detail-content {
        padding: 30px 20px;
        margin: 10px 15px 30px;
    }
    
    .experimental-blog-detail-image {
        height: auto;
        max-height: 250px;
        object-fit: contain;
    }
    
    .experimental-blog-detail-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .experimental-latest-post {
        flex-direction: column;
        text-align: center;
    }
    
    .experimental-latest-post img {
        width: 100%;
        height: 150px;
    }
}
</style>

<!-- Breadcrumb -->
<div class="experimental-breadcrumb">
    <div class="container">
        <a href="/">Home</a>
        <span class="separator">></span>
        <a href="<?php echo e(route('blog.index')); ?>">Blog</a>
        <span class="separator">></span>
        <span><?php echo e($blogdetailists->title); ?></span>
    </div>
</div>

<!-- Blog Detail Hero -->
<div class="experimental-blog-detail-hero">
    <div class="container">
        <h1><?php echo e($blogdetailists->title); ?></h1>
        <div class="experimental-blog-detail-meta">
            <span>
                <i class="ion-ios-calendar mr-2"></i>
                <?php echo e(date('M d, Y', strtotime($blogdetailists->created_at))); ?>

            </span>
            <?php if(isset($blogdetailists->categorydetail) && $blogdetailists->categorydetail): ?>
                <span>
                    <i class="ion-ios-folder mr-2"></i>
                    <a href="<?php echo e(route('blog.category', $blogdetailists->categorydetail->slug)); ?>" 
                       style="color: white; text-decoration: none;">
                        <?php echo e($blogdetailists->categorydetail->name); ?>

                    </a>
                </span>
            <?php endif; ?>
            <span>
                <i class="ion-ios-time mr-2"></i>
                <?php echo e(ceil(str_word_count(strip_tags($blogdetailists->description)) / 200)); ?> min read
            </span>
            <span>
                <i class="ion-ios-document mr-2"></i>
                <?php echo e(str_word_count(strip_tags($blogdetailists->description))); ?> words
            </span>
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="experimental-blog-detail-content">
                    <?php if(isset($blogdetailists->image) && $blogdetailists->image != ""): ?>
                        <picture>
                            <source media="(min-width: 768px)" srcset="<?php echo e(asset('images/blog/' . $blogdetailists->image)); ?>">
                            <source media="(max-width: 767px)" srcset="<?php echo e(asset('images/blog/' . $blogdetailists->image)); ?>">
                            <img src="<?php echo e(asset('images/blog/' . $blogdetailists->image)); ?>" 
                                 alt="<?php echo e($blogdetailists->title); ?> - Legal Blog Post by Bansal Lawyers" 
                                 class="experimental-blog-detail-image"
                                 width="800" 
                                 height="400"
                                 loading="eager"
                                 fetchpriority="high">
                        </picture>
                    <?php else: ?>
                        <picture>
                            <source media="(min-width: 768px)" srcset="<?php echo e(asset('images/Blog.jpg')); ?>">
                            <source media="(max-width: 767px)" srcset="<?php echo e(asset('images/Blog.jpg')); ?>">
                            <img src="<?php echo e(asset('images/Blog.jpg')); ?>" 
                                 alt="<?php echo e($blogdetailists->title); ?> - Legal Blog Post by Bansal Lawyers" 
                                 class="experimental-blog-detail-image"
                                 width="800" 
                                 height="400"
                                 loading="eager"
                                 fetchpriority="high">
                        </picture>
                    <?php endif; ?>
                    
                    <div class="experimental-blog-detail-text">
                        <?php echo $blogdetailists->description; ?>

                        
                        <!-- Author Information -->
                        <div class="experimental-author-info" style="margin-top: 40px; padding: 20px; background: #f8f9fa; border-radius: 10px; border-left: 4px solid #1B4D89;">
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
                        <?php if($blogdetailists->updated_at != $blogdetailists->created_at): ?>
                        <div class="experimental-updated-info" style="margin-top: 20px; padding: 15px; background: #e8f4fd; border-radius: 8px; border-left: 4px solid #17a2b8;">
                            <p style="margin: 0; color: #0c5460; font-size: 0.9rem;">
                                <i class="ion-ios-refresh mr-2"></i>
                                Last updated: <?php echo e(date('M d, Y', strtotime($blogdetailists->updated_at))); ?>

                            </p>
                        </div>
                        <?php endif; ?>
                        
                        <!-- FAQ Section -->
                        <div class="experimental-faq-section" style="margin-top: 40px; padding: 30px; background: #f8f9fa; border-radius: 15px; border-left: 4px solid #1B4D89;">
                            <h3 style="color: #1B4D89; margin-bottom: 25px; font-size: 1.5rem; font-weight: 600;">
                                <i class="ion-ios-help-circle mr-2"></i>Frequently Asked Questions
                            </h3>
                            
                            <?php
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
                            ?>
                            
                            <div class="faq-container">
                                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="faq-item" style="margin-bottom: 20px; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                    <div class="faq-question" style="padding: 20px; cursor: pointer; background: #1B4D89; color: white; font-weight: 600; font-size: 1rem; transition: background-color 0.3s ease;" onclick="toggleFAQ(<?php echo e($index); ?>)">
                                        <span style="float: right; transition: transform 0.3s ease;" id="faq-icon-<?php echo e($index); ?>">+</span>
                                        <?php echo e($faq['question']); ?>

                                    </div>
                                    <div class="faq-answer" id="faq-answer-<?php echo e($index); ?>" style="padding: 0 20px; max-height: 0; overflow: hidden; transition: all 0.3s ease; background: white;">
                                        <div style="padding: 20px 0; color: #666; line-height: 1.6;">
                                            <?php echo e($faq['answer']); ?>

                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        
                        <!-- CTAs temporarily disabled for testing -->
                    </div>
                    
                    <!-- Share Buttons -->
                    <div class="experimental-share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->url())); ?>" 
                           target="_blank" class="experimental-share-btn facebook">
                            <i class="ion-social-facebook"></i> Share on Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(request()->url())); ?>&text=<?php echo e(urlencode($blogdetailists->title)); ?>" 
                           target="_blank" class="experimental-share-btn twitter">
                            <i class="ion-social-twitter"></i> Tweet
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(urlencode(request()->url())); ?>" 
                           target="_blank" class="experimental-share-btn linkedin">
                            <i class="ion-social-linkedin"></i> Share on LinkedIn
                        </a>
                    </div>
                </div>
                
                <!-- Related Articles Section -->
                <div class="experimental-related-articles" style="margin-top: 50px; padding: 30px; background: #f8f9fa; border-radius: 15px; border-left: 4px solid #1B4D89;">
                    <h3 style="color: #1B4D89; margin-bottom: 25px; font-size: 1.5rem; font-weight: 600;">
                        <i class="ion-ios-paper mr-2"></i>You Might Also Like
                    </h3>
                    <div class="row">
                        <?php $__currentLoopData = $latestbloglists->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($related->id != $blogdetailists->id): ?>
                            <div class="col-md-4 mb-3">
                                <div class="experimental-related-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: transform 0.3s ease; height: 100%;">
                                    <div class="experimental-related-image" style="height: 150px; overflow: hidden;">
                                        <?php if(isset($related->image) && $related->image != ""): ?>
                                            <img src="<?php echo e(asset('images/blog/' . $related->image)); ?>" 
                                                 alt="<?php echo e($related->title); ?> - Legal Blog Post by Bansal Lawyers"
                                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                                 loading="lazy">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('images/Blog.jpg')); ?>" 
                                                 alt="<?php echo e($related->title); ?> - Legal Blog Post by Bansal Lawyers"
                                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                                 loading="lazy">
                                        <?php endif; ?>
                                    </div>
                                    <div class="experimental-related-content" style="padding: 20px;">
                                        <h5 style="margin: 0 0 10px 0; font-size: 1rem; line-height: 1.3; color: #1B4D89; font-weight: 600;">
                                            <a href="<?php echo e(route('blog.detail', $related->slug)); ?>" 
                                               style="color: #1B4D89; text-decoration: none; transition: color 0.3s ease;">
                                                <?php echo e($related->title); ?>

                                            </a>
                                        </h5>
                                        <p style="margin: 0; font-size: 0.85rem; color: #666; line-height: 1.4;">
                                            <?php echo e(\Illuminate\Support\Str::limit(strip_tags($related->description), 80)); ?>

                                        </p>
                                        <div style="margin-top: 10px; font-size: 0.8rem; color: #888;">
                                            <i class="ion-ios-calendar mr-1"></i>
                                            <?php echo e(date('M d, Y', strtotime($related->created_at))); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Contact CTA Sidebar -->
                <?php
                    $category = 'general';
                    if(isset($blogdetailists->categorydetail) && $blogdetailists->categorydetail) {
                        $categoryName = strtolower($blogdetailists->categorydetail->name);
                        if(strpos($categoryName, 'family') !== false || strpos($categoryName, 'divorce') !== false || strpos($categoryName, 'custody') !== false) {
                            $category = 'family-law';
                        } elseif(strpos($categoryName, 'immigration') !== false || strpos($categoryName, 'visa') !== false) {
                            $category = 'immigration';
                        } elseif(strpos($categoryName, 'criminal') !== false || strpos($categoryName, 'assault') !== false) {
                            $category = 'criminal';
                        }
                    }
                ?>
                
                <?php echo $__env->make('components.unified-contact-form', [
                    'variant' => 'sidebar',
                    'title' => 'Need Legal Advice?',
                    'subtitle' => 'Get expert legal guidance from our experienced Melbourne lawyers.',
                    'buttonText' => 'Schedule Free Consultation',
                    'formId' => 'blog-contact-form',
                    'source' => 'blog-detail',
                    'showPhoto' => true
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                
                <div class="experimental-sidebar">
                    <h4>Latest Articles</h4>
                    <?php $__currentLoopData = $latestbloglists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="experimental-latest-post">
                            <?php if(isset($list->image) && $list->image != ""): ?>
                                <img src="<?php echo e(asset('images/blog/' . $list->image)); ?>" 
                                     alt="<?php echo e($list->title); ?> - Legal Blog Post by Bansal Lawyers"
                                     width="80" 
                                     height="60"
                                     loading="lazy">
                            <?php else: ?>
                                <img src="<?php echo e(asset('images/Blog.jpg')); ?>" 
                                     alt="<?php echo e($list->title); ?> - Legal Blog Post by Bansal Lawyers"
                                     width="80" 
                                     height="60"
                                     loading="lazy">
                            <?php endif; ?>
                            <div class="experimental-latest-post-content">
                                <h5>
                                    <a href="<?php echo e(route('blog.detail', $list->slug)); ?>">
                                        <?php echo e($list->title); ?>

                                    </a>
                                </h5>
                                <p><?php echo e(date('M d, Y', strtotime($list->created_at))); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <!-- Category Sidebar -->
                <?php if(isset($blogCategories) && $blogCategories->count() > 0): ?>
                    <div class="experimental-sidebar">
                        <h4>Categories</h4>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <?php $__currentLoopData = $blogCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('blog.category', $cat->slug)); ?>" 
                                   style="color: #1B4D89; text-decoration: none; padding: 8px 12px; border-radius: 8px; background: #f8f9fa; transition: all 0.3s ease;"
                                   onmouseover="this.style.background='#1B4D89'; this.style.color='white'"
                                   onmouseout="this.style.background='#f8f9fa'; this.style.color='#1B4D89'">
                                    <?php echo e($cat->name); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<script>
function toggleFAQ(index) {
    const answer = document.getElementById('faq-answer-' + index);
    const icon = document.getElementById('faq-icon-' + index);
    
    if (answer.style.maxHeight === '0px' || answer.style.maxHeight === '') {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        answer.style.padding = '0 20px';
        icon.textContent = '−';
        icon.style.transform = 'rotate(0deg)';
    } else {
        answer.style.maxHeight = '0px';
        answer.style.padding = '0 20px';
        icon.textContent = '+';
        icon.style.transform = 'rotate(0deg)';
    }
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/blogdetail.blade.php ENDPATH**/ ?>