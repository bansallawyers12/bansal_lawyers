
<?php $__env->startSection('seoinfo'); ?>
    <?php if( isset($pagedata->meta_title) && $pagedata->meta_title != "") { ?>
        <title><?php echo e(@$pagedata->meta_title); ?></title>
    <?php }  else { ?>
        <title><?php echo e(@$pagedata->title ?? 'Practice Area'); ?></title>
    <?php } ?>

    <?php if( isset($pagedata->meta_description) && $pagedata->meta_description != "") { ?>
        <meta name="description" content="<?php echo e(@$pagedata->meta_description); ?>" />
    <?php }  else { ?>
        <meta name="description" content="<?php echo e(Str::limit(strip_tags(@$pagedata->content ?? ''), 150)); ?>" />
    <?php } ?>

    <?php if( isset($pagedata->meta_keyward) && $pagedata->meta_keyward != "") { ?>
        <meta name="keyword" content="<?php echo e(@$pagedata->meta_keyward); ?>" />
    <?php } ?>

    <link rel="canonical" href="<?php echo URL::to('/'); ?>/<?php echo e(@$pagedata->slug); ?>" />
    <?php if (request()->is('*-experiment')) { ?>
        <!-- Prevent indexing of experimental route only -->
        <meta name="robots" content="noindex, nofollow">
    <?php } ?>

    <!-- Open Graph / Twitter for better sharing while testing -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/<?php echo e(@$pagedata->slug); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e(@$pagedata->meta_title ?? @$pagedata->title); ?>">
    <meta property="og:description" content="<?php echo e(@$pagedata->meta_description ?? Str::limit(strip_tags(@$pagedata->content ?? ''), 150)); ?>">
    <meta property="og:image" content="<?php echo e(asset('images/logo/Bansal_Lawyers.png')); ?>">
    <meta property="og:image:alt" content="Bansal Lawyers Logo">

    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/<?php echo e(@$pagedata->slug); ?>">
    <meta name="twitter:title" content="<?php echo e(@$pagedata->meta_title ?? @$pagedata->title); ?>">
    <meta name="twitter:description" content="<?php echo e(@$pagedata->meta_description ?? Str::limit(strip_tags(@$pagedata->content ?? ''), 150)); ?>">
    <meta property="twitter:image" content="<?php echo e(asset('images/logo/Bansal_Lawyers.png')); ?>">
    <meta property="twitter:image:alt" content="Bansal Lawyers Logo">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>
        /* Font and scrolling fixes */
        html, body { height: auto; overflow-y: auto; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Helvetica Neue", Arial, sans-serif; font-size: 17px; line-height: 1.7; }
        /* Hero styling adapted from experimental blog */
        .pae-hero { background: linear-gradient(135deg, #0a1a2e 0%, #16213e 50%, #1B4D89 100%); color: #fff; padding: 70px 0; text-align: center; position: relative; overflow: hidden; }
        .pae-hero::before { content:''; position:absolute; inset:0; background:url('<?php echo e(asset('images/Blog.jpg')); ?>') center/cover no-repeat; opacity:.18; z-index:1; }
        .pae-hero .container { position:relative; z-index:2; }
        .pae-hero h1 { font-size: 2.8rem; font-weight:700; margin:0 0 10px; color:#fff; text-shadow:2px 2px 8px rgba(0,0,0,.5); }
        .pae-hero p { font-size:1.15rem; color:#f1f3f4; max-width:820px; margin:0 auto; line-height:1.6; text-shadow:1px 1px 3px rgba(0,0,0,.35); }

        /* Layout and cards */
        .pae-section { background:#f8f9fa; padding: 40px 0; }
        .pae-container { max-width:1200px; margin:0 auto; padding:0 15px; }
        .pae-grid { display:flex; flex-wrap:wrap; gap:24px; }
        .pae-left { flex:1 1 680px; min-width:0; }
        .pae-right { flex:0 0 340px; }
        .pae-card { background:#fff; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,.1); border:1px solid #f0f0f0; overflow:hidden; }
        .pae-card-body { padding:30px; }
        .pae-left h1 { font-size: 34px; line-height: 1.2; margin: 10px 0 16px; }
        .pae-left h2 { font-size: 28px; line-height: 1.3; margin: 28px 0 12px; color:#1B4D89; }
        .pae-left h3 { font-size: 22px; line-height: 1.4; margin: 22px 0 10px; color:#1B4D89; }
        .pae-left p { color:#333; line-height:1.8; margin: 14px 0; max-width: 70ch; }
        .pae-left li { color:#333; line-height:1.8; margin: 10px 0; }
        .pae-left ul { padding-left: 24px; list-style: disc; }
        .pae-left a { color:#1B4D89; text-decoration: underline; text-underline-offset: 2px; }
        .pae-card, .pae-card-body, .pae-left, .pae-right { max-height: none; overflow: visible; }
        /* TOC styles */
        .pae-toc { background:#fff; border-radius:14px; border:1px solid #f0f0f0; box-shadow:0 6px 18px rgba(0,0,0,.06); padding:18px; margin-bottom:24px; }
        .pae-toc h4 { margin:0 0 10px; color:#1B4D89; font-weight:700; }
        .pae-toc ul { list-style: none; padding-left: 0; margin:0; }
        .pae-toc li { margin:6px 0; }
        .pae-toc a { color:#1B4D89; text-decoration:none; }
        .pae-toc a:hover { text-decoration:underline; }

        /* Related list */
        .pae-related h3 { color:#1B4D89; font-weight:700; margin-bottom:12px; }
        .pae-related-item { display:flex; gap:12px; padding:12px; border:1px solid #eee; border-radius:12px; margin-bottom:12px; background:#fff; transition:all .3s ease; text-decoration:none; }
        .pae-related-item:hover { transform: translateY(-2px); box-shadow:0 5px 15px rgba(27,77,137,.15); text-decoration:none; }
        .pae-related-item img { width:64px; height:64px; object-fit:cover; border-radius:8px; }
        .pae-related-item .title { color:#1B4D89; font-weight:700; line-height:1.2; }
        .pae-related-item .more { font-size:12px; color:#1B4D89; text-transform:uppercase; }

        /* Contact card */
        .pae-contact-header { display:flex; gap:12px; align-items:center; margin-bottom:12px; }
        .pae-contact-header img { width:60px; height:68px; border-radius:4px; object-fit:cover; }
        .pae-btn { background: linear-gradient(135deg, #1B4D89, #2c5aa0); color:#fff; border:0; border-radius:25px; padding:10px 18px; text-transform:uppercase; font-weight:700; }

        @media (max-width: 900px){ .pae-grid{flex-direction:column;} .pae-right{flex:1 1 auto;} .pae-hero h1{font-size:2.2rem;} .pae-hero p{font-size:1rem;} .pae-container{padding:0 12px;} .pae-left p{max-width: 100%;} }
    </style>

    <div class="pae-hero">
        <div class="container">
            <h1>
                <?php if( isset($type) && $type == "migration-law" ) { ?>
                    Migration Law
                <?php } else { ?>
                    <?php echo e(@$pagedata->title); ?>

                <?php } ?>
            </h1>
            <p>Expert legal guidance with the refined look and feel of our latest blog design.</p>
        </div>
    </div>

    <section class="pae-section">
        <div class="pae-container">
            <div class="pae-grid">
                <div class="pae-left">
                    <div class="pae-toc" id="pae-toc" aria-label="Table of contents">
                        <h4>On this page</h4>
                        <ul></ul>
                    </div>
                    <div class="pae-card">
                    <div class="pae-card-body">
                        <?php if( isset($type) && $type == "migration-law" ) { ?>
                            <p style="margin-top:0; color:#666;">Let’s start with you to understand Australian Immigration System</p>
                            <?php echo @$pagedata->content; ?>

                        <?php } else { ?>
                            <?php echo @$pagedata->content; ?>

                        <?php } ?>

                        <hr style="margin:30px 0; opacity:.2;">
                        <div class="pae-related-internal">
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
                </div>

                <aside class="pae-right">
                    <div class="pae-card pae-related">
                        <div class="pae-card-body">
                            <h3>Related pages</h3>
                            <?php $__currentLoopData = @$relatedpagedata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="pae-related-item" href="<?php echo URL::to('/'); ?>/<?php echo e(@$list->slug); ?>">
                                    <img src="<?php echo e(asset('images/' . @$list->image)); ?>" alt="<?php echo e(@$list->image_alt); ?>" width="64" height="64" loading="lazy">
                                    <div>
                                        <div class="title"><?php echo e(@$list->title); ?></div>
                                        <div class="more">Read this more »</div>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <?php echo $__env->make('components.unified-contact-form', [
                        'title' => 'Speak with a Lawyer',
                        'subtitle' => 'There\'s No Legal Puzzle, We Can\'t Solve.',
                        'buttonText' => 'GET LEGAL ADVICE',
                        'variant' => 'sidebar',
                        'source' => 'property-law',
                        'showPhoto' => true,
                        'photoUrl' => asset('images/bansal_2.jpg'),
                        'photoAlt' => 'Ajay Bansal - CEO of Bansal Lawyers'
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                </aside>
            </div>
        </div>
    </section>

    <script>
    // Auto-generate TOC from h2/h3 inside left card
    (function(){
        var container = document.querySelector('.pae-left .pae-card-body');
        var toc = document.querySelector('#pae-toc ul');
        if(!container || !toc) return;
        var headings = container.querySelectorAll('h2, h3');
        headings.forEach(function(h, idx){
            var text = h.textContent.trim();
            var id = h.id || ('sec-' + idx + '-' + text.toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/(^-|-$)/g,''));
            h.id = id;
            var li = document.createElement('li');
            if(h.tagName.toLowerCase()==='h3'){ li.style.marginLeft = '14px'; }
            var a = document.createElement('a');
            a.href = '#' + id;
            a.textContent = text;
            li.appendChild(a);
            toc.appendChild(li);
        });
        // Smooth scroll behavior
        document.querySelector('#pae-toc').addEventListener('click', function(e){
            if(e.target.tagName.toLowerCase()==='a'){
                e.preventDefault();
                var target = document.querySelector(e.target.getAttribute('href'));
                if(target){ target.scrollIntoView({behavior:'smooth', block:'start'}); }
            }
        });
    })();
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/practice_area_experimental.blade.php ENDPATH**/ ?>