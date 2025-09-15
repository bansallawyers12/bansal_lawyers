<?php
    $title = $title ?? 'Get Legal Advice';
    $subtitle = $subtitle ?? null;
    $cta = $cta ?? 'Get Legal Advice';
    $variant = $variant ?? 'compact'; // compact | full
    $accent = $accent ?? '#1B4D89';
    $source = $source ?? (request()->path() ?? 'unknown');
    $floating = $floating ?? false; // when true, render as floating widget
    $floatButtonLabel = $floatButtonLabel ?? 'Contact us';
    $uid = $uid ?? ('cc_' . uniqid());
    $showDefaultTagline = $showDefaultTagline ?? true; // if subtitle missing, show default line
    $recaptcha = $recaptcha ?? false; // render google recaptcha v2 widget
    $recaptchaSiteKey = env('RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI');
?>

<style>
    .cc-card { background:#fff; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,.1); border:1px solid #f0f0f0; overflow:hidden; }
    .cc-body { padding: 24px; }
    .cc-header { display:flex; gap:12px; align-items:center; margin-bottom:12px; margin-top:8px; }
    .cc-header img { width:60px; height:68px; border-radius:4px; object-fit:cover; object-position:center top; }
    .cc-title { margin:0; font-weight:700; color:#1B4D89; }
    .cc-sub { color:#666; font-size:.95rem; margin-top:4px; }
    .cc-btn { background: linear-gradient(135deg, <?php echo e($accent); ?>, #2c5aa0); color:#fff; border:0; border-radius:25px; padding:10px 18px; text-transform:uppercase; font-weight:700; }
    .cc-full .cc-body { padding: 32px; }
    @media (max-width: 480px){ .cc-body { padding: 18px; } }

    /* Floating variant */
    .cc-float-btn { position: fixed; right: 20px; bottom: 20px; z-index: 9999; width: 56px; height: 56px; border-radius: 50%; border: 0; background: linear-gradient(135deg, <?php echo e($accent); ?>, #2c5aa0); color: #fff; box-shadow: 0 10px 25px rgba(0,0,0,.25); display: inline-flex; align-items: center; justify-content: center; font-size: 20px; cursor: pointer; }
    .cc-float-btn:hover { transform: translateY(-2px); box-shadow: 0 14px 30px rgba(0,0,0,.3); }
    .cc-float-panel { position: fixed; right: 20px; bottom: 90px; z-index: 9999; width: 360px; max-width: calc(100vw - 32px); transform: translateY(10px); opacity: 0; pointer-events: none; transition: opacity .25s ease, transform .25s ease; }
    .cc-float-panel.active { opacity: 1; transform: translateY(0); pointer-events: auto; }
    .cc-float-header { display: flex; align-items: center; justify-content: space-between; padding: 8px 12px 0 12px; }
    .cc-float-close { background: transparent; border: 0; font-size: 20px; line-height: 1; color: #666; cursor: pointer; }
</style>

<?php if($floating): ?>
    <button class="cc-float-btn" id="<?php echo e($uid); ?>_toggle" aria-controls="<?php echo e($uid); ?>_panel" aria-expanded="false" title="<?php echo e($floatButtonLabel); ?>">
        <i class="fa fa-comments"></i>
    </button>
    <div class="cc-float-panel" id="<?php echo e($uid); ?>_panel" role="dialog" aria-label="Contact form">
<?php endif; ?>

<div class="cc-card <?php echo e($variant === 'full' ? 'cc-full' : ''); ?>">
    <div class="cc-body">
        <?php if($floating): ?>
            <div class="cc-float-header">
                <div style="font-weight:700;color:#1B4D89;"><?php echo e($title); ?></div>
                <button class="cc-float-close" id="<?php echo e($uid); ?>_close" aria-label="Close contact form">×</button>
            </div>
        <?php endif; ?>
        <div class="cc-header">
            <img src="<?php echo e(asset('images/bansal_2.jpg')); ?>" alt="Ajay Bansal - CEO of Bansal Lawyers" width="60" height="68" loading="lazy">
            <div>
                <h4 class="cc-title"><?php echo e($title); ?></h4>
                <?php if($subtitle): ?>
                    <div class="cc-sub"><?php echo e($subtitle); ?></div>
                <?php elseif($showDefaultTagline): ?>
                    <div class="cc-sub">There's No Legal Puzzle, We Can't Solve.</div>
                <?php endif; ?>
            </div>
        </div>

        <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success" style="margin-bottom:14px;"><?php echo e($message); ?></div>
        <?php endif; ?>

        <form action="<?php echo URL::to('/'); ?>/contact_lawyer" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <input type="hidden" name="page_source" value="<?php echo e($source); ?>">
            <div class="form-group"><input type="text" class="form-control" name="name" placeholder="Your Name" required></div>
            <div class="form-group"><input type="email" class="form-control" name="email" placeholder="Your Email" required></div>
            <div class="form-group"><input type="text" class="form-control" name="subject" placeholder="Subject" required></div>
            <div class="form-group"><textarea name="message" rows="5" class="form-control" placeholder="Message" required></textarea></div>
            <?php if($recaptcha): ?>
                <div class="form-group" style="margin-bottom:12px; display:flex; justify-content:center;">
                    <div class="g-recaptcha" data-sitekey="<?php echo e($recaptchaSiteKey); ?>"></div>
                </div>
            <?php endif; ?>
            <div class="form-group" style="text-align:right"><input type="submit" value="<?php echo e($cta); ?>" class="cc-btn"></div>
        </form>
    </div>
    
</div>
    
<?php if($floating): ?>
    </div>
    <script>
    (function(){
        var panel = document.getElementById('<?php echo e($uid); ?>_panel');
        var toggle = document.getElementById('<?php echo e($uid); ?>_toggle');
        var closeBtn = document.getElementById('<?php echo e($uid); ?>_close');
        if(!panel || !toggle){ return; }
        function openPanel(){ panel.classList.add('active'); toggle.setAttribute('aria-expanded','true'); }
        function closePanel(){ panel.classList.remove('active'); toggle.setAttribute('aria-expanded','false'); }
        toggle.addEventListener('click', function(e){ e.preventDefault(); if(panel.classList.contains('active')){ closePanel(); } else { openPanel(); } });
        if(closeBtn){ closeBtn.addEventListener('click', function(e){ e.preventDefault(); closePanel(); }); }
        document.addEventListener('click', function(e){
            if(!panel.classList.contains('active')) return;
            var clickInsidePanel = panel.contains(e.target);
            var clickOnToggle = toggle.contains(e.target);
            if(!clickInsidePanel && !clickOnToggle){ closePanel(); }
        });
    })();
    </script>
    <?php if($recaptcha): ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php endif; ?>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/components/contact-card.blade.php ENDPATH**/ ?>