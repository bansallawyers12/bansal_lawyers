<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'sidebar', 'category' => 'general']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['type' => 'sidebar', 'category' => 'general']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $ctaData = [
        'family-law' => [
            'title' => 'Need Help with Family Law Issues?',
            'subtitle' => 'Our family law experts have helped 500+ families resolve their legal matters.',
            'button_text' => 'Get Free Family Law Consultation',
            'button_link' => '/book-an-appointment',
            'icon' => 'ion-ios-people'
        ],
        'immigration' => [
            'title' => 'Need Immigration Legal Help?',
            'subtitle' => 'Our immigration lawyers have a 95% success rate with visa applications.',
            'button_text' => 'Book Free Case Assessment',
            'button_link' => '/book-an-appointment',
            'icon' => 'ion-ios-globe'
        ],
        'criminal' => [
            'title' => 'Facing Criminal Charges?',
            'subtitle' => 'Don\'t face them alone. Our experienced criminal defense lawyers are available 24/7.',
            'button_text' => 'Call Now for Immediate Help',
            'button_link' => 'tel:+61312345678',
            'icon' => 'ion-ios-call'
        ],
        'general' => [
            'title' => 'Need Legal Advice?',
            'subtitle' => 'Get expert legal guidance from our experienced Melbourne lawyers.',
            'button_text' => 'Schedule Free Consultation',
            'button_link' => '/book-an-appointment',
            'icon' => 'ion-ios-time'
        ]
    ];
    
    $cta = $ctaData[$category] ?? $ctaData['general'];
?>

<?php if($type === 'sidebar'): ?>
    <!-- Sidebar CTA -->
    <div class="blog-cta-sidebar">
        <div class="cta-header">
            <i class="<?php echo e($cta['icon']); ?>"></i>
            <h4><?php echo e($cta['title']); ?></h4>
        </div>
        <p class="cta-subtitle"><?php echo e($cta['subtitle']); ?></p>
        
        <form class="cta-form" action="/contact_lawyer" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="source" value="blog-<?php echo e($category); ?>">
            <input type="hidden" name="subject" value="Blog Inquiry - <?php echo e($cta['title']); ?>">
            
            <div class="form-group">
                <input type="text" name="name" placeholder="Your Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Your Email" required>
            </div>
            <div class="form-group">
                <input type="tel" name="phone" placeholder="Your Phone">
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Brief description of your legal issue" rows="3"></textarea>
            </div>
            <button type="submit" class="cta-button">
                <?php echo e($cta['button_text']); ?>

            </button>
        </form>
        
        <div class="cta-contact-info">
            <p><i class="ion-ios-call"></i> Call: (03) 1234-5678</p>
            <p><i class="ion-ios-mail"></i> Email: info@bansallawyers.com.au</p>
        </div>
    </div>

<?php elseif($type === 'in-content'): ?>
    <!-- In-Content CTA -->
    <div class="blog-cta-inline">
        <div class="cta-content">
            <div class="cta-text">
                <h3><?php echo e($cta['title']); ?></h3>
                <p><?php echo e($cta['subtitle']); ?></p>
            </div>
            <div class="cta-action">
                <a href="<?php echo e($cta['button_link']); ?>" class="cta-button-inline">
                    <?php echo e($cta['button_text']); ?>

                </a>
            </div>
        </div>
    </div>

<?php elseif($type === 'end-article'): ?>
    <!-- End of Article CTA -->
    <div class="blog-cta-end">
        <div class="cta-container">
            <div class="cta-main">
                <h2><?php echo e($cta['title']); ?></h2>
                <p><?php echo e($cta['subtitle']); ?></p>
                
                <div class="cta-options">
                    <a href="<?php echo e($cta['button_link']); ?>" class="cta-button-primary">
                        <i class="<?php echo e($cta['icon']); ?>"></i>
                        <?php echo e($cta['button_text']); ?>

                    </a>
                    <a href="tel:+61312345678" class="cta-button-secondary">
                        <i class="ion-ios-call"></i>
                        Call Now: (03) 1234-5678
                    </a>
                </div>
            </div>
            
            <div class="cta-benefits">
                <h4>Why Choose Bansal Lawyers?</h4>
                <ul>
                    <li><i class="ion-ios-checkmark"></i> Free 30-minute consultation</li>
                    <li><i class="ion-ios-checkmark"></i> Experienced Melbourne lawyers</li>
                    <li><i class="ion-ios-checkmark"></i> 95% client satisfaction rate</li>
                    <li><i class="ion-ios-checkmark"></i> No win, no fee options available</li>
                </ul>
            </div>
        </div>
    </div>

<?php elseif($type === 'mobile-sticky'): ?>
    <!-- Mobile Sticky CTA -->
    <div class="blog-cta-mobile">
        <div class="cta-mobile-content">
            <div class="cta-mobile-text">
                <h4>Need Legal Help?</h4>
                <p>Get free consultation</p>
            </div>
            <div class="cta-mobile-actions">
                <a href="tel:+61312345678" class="cta-mobile-call">
                    <i class="ion-ios-call"></i>
                </a>
                <a href="<?php echo e($cta['button_link']); ?>" class="cta-mobile-button">
                    <?php echo e($cta['button_text']); ?>

                </a>
            </div>
        </div>
    </div>
<?php endif; ?>

<style>
/* Sidebar CTA Styles */
.blog-cta-sidebar {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    border: 1px solid #f0f0f0;
}

.cta-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.cta-header i {
    font-size: 1.5rem;
    color: #1B4D89;
}

.cta-header h4 {
    color: #1B4D89;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
}

.cta-subtitle {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 20px;
    line-height: 1.5;
}

.cta-form .form-group {
    margin-bottom: 15px;
}

.cta-form input,
.cta-form textarea {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 0.9rem;
    transition: border-color 0.3s ease;
}

.cta-form input:focus,
.cta-form textarea:focus {
    outline: none;
    border-color: #1B4D89;
}

.cta-button {
    width: 100%;
    background: #1B4D89;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.cta-button:hover {
    background: #0d3a6b;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(27, 77, 137, 0.3);
}

.cta-contact-info {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
}

.cta-contact-info p {
    margin: 8px 0;
    font-size: 0.85rem;
    color: #666;
    display: flex;
    align-items: center;
    gap: 8px;
}

.cta-contact-info i {
    color: #1B4D89;
}

/* In-Content CTA Styles */
.blog-cta-inline {
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: white;
    padding: 30px;
    border-radius: 15px;
    margin: 40px 0;
    text-align: center;
}

.cta-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 30px;
}

.cta-text h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    font-weight: 600;
}

.cta-text p {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
}

.cta-button-inline {
    background: white;
    color: #1B4D89;
    padding: 15px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.cta-button-inline:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    color: #1B4D89;
    text-decoration: none;
}

/* End of Article CTA Styles */
.blog-cta-end {
    background: #f8f9fa;
    padding: 50px 0;
    margin: 50px 0;
}

.cta-container {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.cta-main h2 {
    color: #1B4D89;
    font-size: 2rem;
    margin-bottom: 15px;
    font-weight: 700;
}

.cta-main p {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 30px;
}

.cta-options {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.cta-button-primary,
.cta-button-secondary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.cta-button-primary {
    background: #1B4D89;
    color: white;
}

.cta-button-primary:hover {
    background: #0d3a6b;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(27, 77, 137, 0.3);
    color: white;
    text-decoration: none;
}

.cta-button-secondary {
    background: white;
    color: #1B4D89;
    border: 2px solid #1B4D89;
}

.cta-button-secondary:hover {
    background: #1B4D89;
    color: white;
    text-decoration: none;
}

.cta-benefits {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.cta-benefits h4 {
    color: #1B4D89;
    margin-bottom: 20px;
    font-size: 1.3rem;
}

.cta-benefits ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}

.cta-benefits li {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #666;
    font-size: 0.95rem;
}

.cta-benefits li i {
    color: #28a745;
    font-size: 1.1rem;
}

/* Mobile Sticky CTA Styles */
.blog-cta-mobile {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: #1B4D89;
    color: white;
    padding: 15px 20px;
    z-index: 1000;
    display: none;
    box-shadow: 0 -5px 15px rgba(0,0,0,0.2);
}

.cta-mobile-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
}

.cta-mobile-text h4 {
    margin: 0 0 5px 0;
    font-size: 1rem;
    font-weight: 600;
}

.cta-mobile-text p {
    margin: 0;
    font-size: 0.85rem;
    opacity: 0.9;
}

.cta-mobile-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.cta-mobile-call {
    background: rgba(255,255,255,0.2);
    color: white;
    padding: 10px;
    border-radius: 50%;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    transition: all 0.3s ease;
}

.cta-mobile-call:hover {
    background: rgba(255,255,255,0.3);
    color: white;
    text-decoration: none;
}

.cta-mobile-button {
    background: white;
    color: #1B4D89;
    padding: 10px 20px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.cta-mobile-button:hover {
    background: #f8f9fa;
    color: #1B4D89;
    text-decoration: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cta-content {
        flex-direction: column;
        text-align: center;
    }
    
    .cta-options {
        flex-direction: column;
        align-items: center;
    }
    
    .cta-button-primary,
    .cta-button-secondary {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
    
    .blog-cta-mobile {
        display: block;
    }
    
    .blog-cta-end {
        padding: 30px 0;
        margin: 30px 0;
    }
    
    .cta-main h2 {
        font-size: 1.5rem;
    }
}

@media (min-width: 769px) {
    .blog-cta-mobile {
        display: none;
    }
}
</style>
<?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/components/blog-cta.blade.php ENDPATH**/ ?>