<?php $__env->startSection('head'); ?>
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('seoinfo'); ?>
	<title>Legal Help in Melbourne | Best Law Firm – Bansal Lawyers - Modern</title>
    <meta name="description" content="Contact Bansal Lawyers, one of the best law firms in Melbourne, Australia, for expert legal assistance. Our skilled team specializes in divorce, visa applications, real estate matters, and more. .Reach out today!" />

    <link rel="canonical" href="<?php echo URL::to('/'); ?>/contact" />
        <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/contact">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Get Expert Legal Assistance from Best law firms in Melbourne Australia | Bansal Lawyers">
    <meta property="og:description" content="Contact Bansal Lawyers, one of the best law firms in Melbourne, Australia, for expert legal assistance. Our skilled team specializes in divorce, visa applications, real estate matters, and more. .Reach out today!">
    <meta property="og:image" content="<?php echo e(asset('images/logo/Bansal_Lawyers.png')); ?>">
	<meta property="og:image:alt" content="Bansal Lawyers Logo">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/contact">
    <meta name="twitter:title" content="Get Expert Legal Assistance from Best law firms in Melbourne Australia | Bansal Lawyers">
    <meta name="twitter:description" content="Contact Bansal Lawyers, one of the best law firms in Melbourne, Australia, for expert legal assistance. Our skilled team specializes in divorce, visa applications, real estate matters, and more. .Reach out today!">
    <meta property="twitter:image" content="<?php echo e(asset('images/logo/Bansal_Lawyers.png')); ?>">
	<meta property="twitter:image:alt" content="Bansal Lawyers Logo">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<style>
/* Modern Contact Page Styles - Out of the Box Design */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --text-dark: #2c3e50;
    --text-light: #7f8c8d;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --shadow: 0 20px 40px rgba(0,0,0,0.1);
    --shadow-hover: 0 30px 60px rgba(0,0,0,0.15);
    --gradient-primary: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
    --gradient-accent: linear-gradient(135deg, #FF6B35 0%, #FF8E53 100%);
}

/* Modern Hero Section with Geometric Patterns */
.modern-hero {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.modern-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('<?php echo e(asset("images/Contactus.jpg")); ?>') center/cover;
    opacity: 0.2;
    z-index: 1;
}

.modern-hero::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(255, 107, 53, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 142, 83, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    z-index: 2;
}

.modern-hero .container {
    position: relative;
    z-index: 3;
}

.modern-hero-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.modern-hero h1 {
    font-size: 4rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    background: linear-gradient(45deg, #ffffff, #f0f0f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
}

.modern-hero .subtitle {
    font-size: 1.4rem;
    margin-bottom: 2rem;
    opacity: 0.9;
    font-weight: 300;
    line-height: 1.6;
}

.modern-cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 3rem;
}

.modern-cta-primary {
    background: var(--gradient-accent);
    color: var(--white);
    padding: 18px 40px;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
}

.modern-cta-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(255, 107, 53, 0.4);
    color: var(--white);
    text-decoration: none;
}

.modern-cta-secondary {
    background: rgba(255, 255, 255, 0.1);
    color: var(--white);
    padding: 18px 40px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.modern-cta-secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-3px);
    color: var(--white);
    text-decoration: none;
}

/* Floating Elements */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    z-index: 2;
}

.floating-element {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.floating-element:nth-child(1) {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.floating-element:nth-child(2) {
    width: 120px;
    height: 120px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.floating-element:nth-child(3) {
    width: 60px;
    height: 60px;
    top: 40%;
    right: 30%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* Modern Contact Section */
.modern-contact-section {
    padding: 100px 0;
    background: var(--bg-light);
    position: relative;
}

.modern-contact-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: linear-gradient(180deg, var(--primary-color), transparent);
    opacity: 0.1;
}

.modern-contact-info {
    background: var(--white);
    border-radius: 30px;
    padding: 60px;
    box-shadow: var(--shadow);
    margin-bottom: 60px;
    position: relative;
    overflow: hidden;
}

.modern-contact-info::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: var(--gradient-accent);
}

.modern-contact-info h2 {
    color: var(--text-dark);
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 3rem;
    text-align: center;
    position: relative;
}

.modern-contact-info h2::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: var(--gradient-accent);
    border-radius: 2px;
}

.modern-contact-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-bottom: 40px;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
}

.modern-contact-item {
    text-align: center;
    padding: 40px 30px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 20px;
    transition: all 0.4s ease;
    position: relative;
    border: 1px solid rgba(27, 77, 137, 0.1);
}

.modern-contact-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 20px;
}

.modern-contact-item:hover::before {
    opacity: 0.05;
}

.modern-contact-item:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-hover);
    border-color: var(--accent-color);
}

.modern-contact-item .icon {
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 2rem;
    color: var(--white);
    position: relative;
    z-index: 2;
    transition: all 0.3s ease;
}

.modern-contact-item:hover .icon {
    background: var(--gradient-accent);
    transform: scale(1.1);
}

.modern-contact-item h4 {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 15px;
    font-size: 1.3rem;
    position: relative;
    z-index: 2;
}

.modern-contact-item p {
    color: var(--text-light);
    margin: 0;
    line-height: 1.6;
    position: relative;
    z-index: 2;
}

.modern-contact-item a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.modern-contact-item a:hover {
    color: var(--accent-color);
    text-decoration: none;
}

/* Modern Form Section */
.modern-form-section {
    background: var(--white);
    border-radius: 30px;
    padding: 60px;
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
}

.modern-form-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: var(--gradient-accent);
}

.modern-form-section h3 {
    color: var(--text-dark);
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 3rem;
    text-align: center;
    position: relative;
}

.modern-form-section h3::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: var(--gradient-accent);
    border-radius: 2px;
}

.modern-form-group {
    margin-bottom: 20px;
    position: relative;
}

.modern-form-group label {
    color: var(--text-dark);
    font-weight: 700;
    margin-bottom: 10px;
    display: block;
    font-size: 1.1rem;
}

.modern-form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
    position: relative;
}

.modern-form-control:focus {
    outline: none;
    border-color: var(--accent-color);
    box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
    background: var(--white);
    transform: translateY(-2px);
}

.modern-form-control::placeholder {
    color: #adb5bd;
    font-weight: 400;
}

.modern-textarea {
    min-height: 120px;
    resize: vertical;
}

.modern-submit-btn {
    background: var(--gradient-accent);
    color: var(--white);
    padding: 15px 40px;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: block;
    margin: 25px auto 0;
    box-shadow: 0 6px 20px rgba(255, 107, 53, 0.3);
    position: relative;
    overflow: hidden;
}

.modern-submit-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.modern-submit-btn:hover::before {
    left: 100%;
}

.modern-submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(255, 107, 53, 0.4);
}

/* Modern Map Section */
.modern-map-section {
    background: var(--white);
    border-radius: 30px;
    padding: 0;
    box-shadow: var(--shadow);
    overflow: hidden;
    position: relative;
}

.modern-map-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: var(--gradient-accent);
    z-index: 1;
}

.modern-map-section iframe {
    width: 100%;
    height: 500px;
    border: none;
    display: block;
}

.modern-alert {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    padding: 20px 25px;
    border-radius: 15px;
    margin-bottom: 30px;
    border: 1px solid #c3e6cb;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(21, 87, 36, 0.1);
}


/* Floating Contact Form */
.floating-form-container {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 1000;
    transition: all 0.3s ease;
}

.floating-form-toggle {
    width: 60px;
    height: 60px;
    background: var(--gradient-accent);
    border: none;
    border-radius: 50%;
    color: var(--white);
    font-size: 1.5rem;
    cursor: pointer;
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.floating-form-toggle::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.floating-form-toggle:hover::before {
    left: 100%;
}

.floating-form-toggle:hover {
    transform: scale(1.1);
    box-shadow: 0 12px 35px rgba(255, 107, 53, 0.6);
}

.floating-form-toggle.active {
    background: var(--gradient-primary);
    transform: rotate(45deg);
}

.floating-form-panel {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 400px;
    background: var(--white);
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    padding: 0;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px) scale(0.9);
    transition: all 0.3s ease;
    border: 1px solid rgba(27, 77, 137, 0.1);
    overflow: hidden;
}

.floating-form-panel.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.floating-form-header {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 20px 25px;
    position: relative;
}

.floating-form-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--gradient-accent);
}

.floating-form-header h4 {
    margin: 0;
    font-size: 1.3rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
}

.floating-form-header .close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    border: none;
    color: var(--white);
    font-size: 1.2rem;
    cursor: pointer;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease;
}

.floating-form-header .close-btn:hover {
    background: rgba(255, 255, 255, 0.2);
}

.floating-form-body {
    padding: 25px;
    max-height: 500px;
    overflow-y: auto;
}

.floating-form-group {
    margin-bottom: 20px;
}

.floating-form-group label {
    color: var(--text-dark);
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
    font-size: 0.9rem;
}

.floating-form-control {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.floating-form-control:focus {
    outline: none;
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
    background: var(--white);
}

.floating-form-control::placeholder {
    color: #adb5bd;
    font-size: 0.85rem;
}

.floating-textarea {
    min-height: 80px;
    resize: vertical;
}

.floating-submit-btn {
    background: var(--gradient-accent);
    color: var(--white);
    padding: 12px 25px;
    border: none;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    position: relative;
    overflow: hidden;
}

.floating-submit-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.floating-submit-btn:hover::before {
    left: 100%;
}

.floating-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
}

.floating-form-alert {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    padding: 12px 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    border: 1px solid #c3e6cb;
    font-size: 0.85rem;
    font-weight: 500;
    display: none;
}

.floating-form-alert.show {
    display: block;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Pulse animation for toggle button */
@keyframes pulse {
    0% {
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    }
    50% {
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.8), 0 0 0 10px rgba(255, 107, 53, 0.1);
    }
    100% {
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    }
}

.floating-form-toggle.pulse {
    animation: pulse 2s infinite;
}

/* Photo Background Contact Section */
.photo-contact-section {
    position: relative;
    min-height: 80vh;
    overflow: hidden;
    margin: 0;
    padding: 0;
}

.photo-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('<?php echo e(asset("images/Contactus.jpg")); ?>') center/cover;
    background-attachment: fixed;
    z-index: 1;
}

.photo-background::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, 
        rgba(27, 77, 137, 0.85) 0%, 
        rgba(44, 90, 160, 0.75) 50%, 
        rgba(255, 107, 53, 0.7) 100%);
    z-index: 2;
}

.photo-overlay {
    position: relative;
    z-index: 3;
    min-height: 80vh;
    display: flex;
    align-items: center;
    padding: 40px 0;
}

.form-overlay-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
}

.form-overlay-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: var(--gradient-accent);
    border-radius: 25px 25px 0 0;
}

.form-overlay-card h3 {
    color: var(--text-dark);
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    text-align: center;
    position: relative;
}

.form-overlay-card h3::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: var(--gradient-accent);
    border-radius: 2px;
}

.map-overlay-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 0;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
    height: 600px;
}

.map-overlay-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: var(--gradient-accent);
    border-radius: 25px 25px 0 0;
    z-index: 1;
}

.map-container {
    height: 100%;
    border-radius: 25px;
    overflow: hidden;
}

.map-container iframe {
    width: 100%;
    height: 100%;
    border: none;
    display: block;
}

/* Enhanced form controls for overlay */
.form-overlay-card .modern-form-control {
    background: rgba(255, 255, 255, 0.9);
    border: 2px solid rgba(27, 77, 137, 0.1);
    backdrop-filter: blur(10px);
}

.form-overlay-card .modern-form-control:focus {
    background: rgba(255, 255, 255, 1);
    border-color: var(--accent-color);
    box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.2);
}

.form-overlay-card .modern-submit-btn {
    background: var(--gradient-accent);
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.4);
}

.form-overlay-card .modern-submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(255, 107, 53, 0.5);
}

/* Responsive Design */
@media (max-width: 992px) {
    .modern-contact-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        max-width: 600px;
    }
    
    .photo-overlay {
        padding: 30px 0;
    }
    
    .form-overlay-card,
    .map-overlay-card {
        margin-bottom: 20px;
    }
    
    .form-overlay-card {
        padding: 25px;
    }
    
    .map-overlay-card {
        height: 450px;
    }
}

@media (max-width: 768px) {
    .modern-hero h1 {
        font-size: 2.5rem;
    }
    
    .modern-hero .subtitle {
        font-size: 1.1rem;
    }
    
    .modern-cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .modern-contact-info,
    .modern-form-section {
        padding: 40px 25px;
    }
    
    .modern-contact-grid {
        grid-template-columns: 1fr;
        gap: 25px;
        max-width: 400px;
    }
    
    .modern-contact-info h2,
    .modern-form-section h3 {
        font-size: 2rem;
    }
    
    
    .floating-form-container {
        bottom: 20px;
        right: 20px;
    }
    
    .floating-form-panel {
        width: 350px;
        bottom: 70px;
    }
    
    .floating-form-toggle {
        width: 55px;
        height: 55px;
        font-size: 1.3rem;
    }
    
    /* Photo contact section mobile */
    .photo-contact-section {
        min-height: auto;
    }
    
    .photo-background {
        background-attachment: scroll;
    }
    
    .photo-overlay {
        min-height: auto;
        padding: 20px 0;
    }
    
    .form-overlay-card {
        padding: 20px 15px;
        margin-bottom: 15px;
    }
    
    .form-overlay-card h3 {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
    }
    
    .map-overlay-card {
        height: 350px;
    }
}

@media (max-width: 480px) {
    .modern-hero {
        padding: 80px 0 60px;
    }
    
    .modern-hero h1 {
        font-size: 2rem;
    }
    
    
    .floating-form-panel {
        width: 320px;
        right: -10px;
    }
    
    .floating-form-body {
        padding: 20px;
    }
    
    /* Photo contact section small mobile */
    .form-overlay-card {
        padding: 15px 10px;
        border-radius: 15px;
    }
    
    .form-overlay-card h3 {
        font-size: 1.6rem;
        margin-bottom: 1rem;
    }
    
    .map-overlay-card {
        height: 300px;
        border-radius: 15px;
    }
    
    .photo-overlay {
        padding: 15px 0;
    }
}
</style>

<!-- Modern Hero Section -->
<section class="modern-hero">
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>
    <div class="container">
        <div class="modern-hero-content" data-aos="fade-up" data-aos-duration="1000">
            <h1>Let's Start Your Legal Journey</h1>
            <p class="subtitle">Get expert legal assistance from Melbourne's most trusted law firm. We're here to help you navigate complex legal matters with confidence and clarity.</p>
            <div class="modern-cta-buttons">
                <a href="#contact-form" class="modern-cta-primary">
                    <i class="fa fa-paper-plane"></i>
                    Send Message Now
                </a>
                <a href="tel:+61422905860" class="modern-cta-secondary">
                    <i class="fa fa-phone"></i>
                    Call Us Directly
                </a>
            </div>
        </div>
    </div>
</section>


<!-- Modern Contact Section -->
<section class="modern-contact-section">
    <div class="container">
        <!-- Contact Information -->
        <div class="modern-contact-info" data-aos="fade-up" data-aos-duration="1000">
            <h2>Get In Touch</h2>
            <div class="modern-contact-grid">
                <div class="modern-contact-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <h4>Visit Our Office</h4>
                    <p>Level 8/278 Collins St,<br>Melbourne VIC 3000,<br>Australia</p>
                </div>
                <div class="modern-contact-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <h4>Call Us Now</h4>
                    <p><a href="tel://(+61) 0422905860">(+61) 0422905860</a><br>
                    <a href="tel://1300226725">1300 BANSAL<br>(1300 226 725)</a></p>
                </div>
                <div class="modern-contact-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <h4>Email Us</h4>
                    <p><a href="mailto:Info@bansallawyers.com.au">Info@bansallawyers.com.au</a></p>
                </div>
            </div>
        </div>

        <!-- Full Photo Background Contact Section -->
        <div class="photo-contact-section" id="contact-form" data-aos="fade-up" data-aos-duration="1000">
            <div class="photo-background">
                <!-- Photo will be set via CSS background -->
            </div>
            <div class="photo-overlay">
                <div class="container">
                    <div class="row align-items-center min-vh-100">
                        <!-- Contact Form Overlay -->
                        <div class="col-lg-6">
                            <div class="form-overlay-card" data-aos="fade-right" data-aos-duration="1000">
                                <?php if($message = Session::get('success')): ?>
                                    <div class="modern-alert">
                                        <i class="fa fa-check-circle"></i> <?php echo e($message); ?>

                                    </div>
                                <?php endif; ?>
                                
                                <h3>Send us a Message</h3>
                                <form action="<?php echo URL::to('/'); ?>/contact_lawyer" method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="modern-form-group">
                                        <label for="name">Your Full Name</label>
                                        <input type="text" class="modern-form-control" name="name" placeholder="Enter your full name" required>
                                    </div>
                                    <div class="modern-form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="modern-form-control" name="email" placeholder="Enter your email address" required>
                                    </div>
                                    <div class="modern-form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="modern-form-control" name="subject" placeholder="What is this about?" required>
                                    </div>
                                    <div class="modern-form-group">
                                        <label for="message">Your Message</label>
                                        <textarea name="message" id="message" class="modern-form-control modern-textarea" placeholder="Tell us about your legal needs and how we can help you..." required></textarea>
                                    </div>
                                    
                                    <!-- Google reCAPTCHA -->
                                    <div class="modern-form-group">
                                        <div class="g-recaptcha" data-sitekey="<?php echo e(config('services.recaptcha.key')); ?>"></div>
                                        <?php if($errors->has('g-recaptcha-response')): ?>
                                            <div class="text-danger mt-2">
                                                <small><?php echo e($errors->first('g-recaptcha-response')); ?></small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <button type="submit" class="modern-submit-btn">
                                        <i class="fa fa-paper-plane"></i>
                                        Send Message
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Google Map Overlay -->
                        <div class="col-lg-6">
                            <div class="map-overlay-card" data-aos="fade-left" data-aos-duration="1000">
                                <div class="map-container">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.645409146537!2d144.9631536153164!3d-37.81664617975151!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d43c60387b1%3A0xd9be68c8b39a6074!2sLevel%208%2F278%20Collins%20St%2C%20Melbourne%20VIC%203000%2C%20Australia!5e0!3m2!1sen!2sus!4v1696731567597!5m2!1sen!2sus"
                                        allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Floating Contact Form -->
<div class="floating-form-container">
    <button class="floating-form-toggle" id="floatingFormToggle">
        <i class="fa fa-comments"></i>
    </button>
    
    <div class="floating-form-panel" id="floatingFormPanel">
        <div class="floating-form-header">
            <h4>
                <i class="fa fa-paper-plane"></i>
                Quick Contact
            </h4>
            <button class="close-btn" id="closeFloatingForm">
                <i class="fa fa-times"></i>
            </button>
        </div>
        
        <div class="floating-form-body">
            <div class="floating-form-alert" id="floatingFormAlert">
                <i class="fa fa-check-circle"></i>
                <span id="floatingFormMessage"></span>
            </div>
            
            <form id="floatingContactForm" action="<?php echo URL::to('/'); ?>/contact_lawyer" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="floating-form-group">
                    <label for="floating_name">Your Name</label>
                    <input type="text" class="floating-form-control" name="name" id="floating_name" placeholder="Enter your name" required>
                </div>
                
                <div class="floating-form-group">
                    <label for="floating_email">Email</label>
                    <input type="email" class="floating-form-control" name="email" id="floating_email" placeholder="Enter your email" required>
                </div>
                
                <div class="floating-form-group">
                    <label for="floating_subject">Subject</label>
                    <input type="text" class="floating-form-control" name="subject" id="floating_subject" placeholder="What's this about?" required>
                </div>
                
                <div class="floating-form-group">
                    <label for="floating_message">Message</label>
                    <textarea name="message" id="floating_message" class="floating-form-control floating-textarea" placeholder="Tell us how we can help..." required></textarea>
                </div>
                
                <!-- Google reCAPTCHA -->
                <div class="floating-form-group">
                    <div class="g-recaptcha" data-sitekey="<?php echo e(config('services.recaptcha.key')); ?>"></div>
                    <div class="text-danger mt-2" id="floatingRecaptchaError" style="display: none;">
                        <small>Please complete the reCAPTCHA verification.</small>
                    </div>
                </div>
                
                <button type="submit" class="floating-submit-btn">
                    <i class="fa fa-paper-plane"></i>
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Initialize AOS (Animate On Scroll)
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });
    
    // Initialize floating form
    initFloatingForm();
});

// Smooth scrolling for CTA buttons
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Form enhancement
document.querySelectorAll('.modern-form-control').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
        if (!this.value) {
            this.parentElement.classList.remove('focused');
        }
    });
});

// Floating Form Functionality
function initFloatingForm() {
    const toggleBtn = document.getElementById('floatingFormToggle');
    const formPanel = document.getElementById('floatingFormPanel');
    const closeBtn = document.getElementById('closeFloatingForm');
    const form = document.getElementById('floatingContactForm');
    const alert = document.getElementById('floatingFormAlert');
    const alertMessage = document.getElementById('floatingFormMessage');
    const recaptchaError = document.getElementById('floatingRecaptchaError');
    
    let isFormOpen = false;
    let pulseInterval;
    
    // Add pulse animation after 3 seconds
    setTimeout(() => {
        if (!isFormOpen) {
            toggleBtn.classList.add('pulse');
        }
    }, 3000);
    
    // Toggle form
    toggleBtn.addEventListener('click', function() {
        isFormOpen = !isFormOpen;
        
        if (isFormOpen) {
            formPanel.classList.add('active');
            toggleBtn.classList.add('active');
            toggleBtn.classList.remove('pulse');
            clearInterval(pulseInterval);
        } else {
            formPanel.classList.remove('active');
            toggleBtn.classList.remove('active');
        }
    });
    
    // Close form
    closeBtn.addEventListener('click', function() {
        isFormOpen = false;
        formPanel.classList.remove('active');
        toggleBtn.classList.remove('active');
    });
    
    // Close form when clicking outside
    document.addEventListener('click', function(e) {
        if (isFormOpen && !formPanel.contains(e.target) && !toggleBtn.contains(e.target)) {
            isFormOpen = false;
            formPanel.classList.remove('active');
            toggleBtn.classList.remove('active');
        }
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Hide previous alerts
        alert.classList.remove('show');
        recaptchaError.style.display = 'none';
        
        // Get form data
        const formData = new FormData(form);
        
        // Validate reCAPTCHA
        const recaptchaResponse = grecaptcha.getResponse();
        if (!recaptchaResponse) {
            recaptchaError.style.display = 'block';
            return;
        }
        
        // Show loading state
        const submitBtn = form.querySelector('.floating-submit-btn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Sending...';
        submitBtn.disabled = true;
        
        // Submit form via AJAX
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                alertMessage.textContent = data.message || 'Thank you! Your message has been sent successfully.';
                alert.classList.add('show');
                
                // Reset form
                form.reset();
                grecaptcha.reset();
                
                // Close form after 3 seconds
                setTimeout(() => {
                    isFormOpen = false;
                    formPanel.classList.remove('active');
                    toggleBtn.classList.remove('active');
                    alert.classList.remove('show');
                }, 3000);
            } else {
                // Show error message
                alertMessage.textContent = data.message || 'Sorry, there was an error sending your message. Please try again.';
                alert.classList.add('show');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alertMessage.textContent = 'Sorry, there was an error sending your message. Please try again.';
            alert.classList.add('show');
        })
        .finally(() => {
            // Reset button
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });
    
    // Auto-close form after successful submission
    form.addEventListener('submit', function() {
        setTimeout(() => {
            if (alert.classList.contains('show')) {
                isFormOpen = false;
                formPanel.classList.remove('active');
                toggleBtn.classList.remove('active');
            }
        }, 3000);
    });
    
    // Add focus effects to floating form inputs
    document.querySelectorAll('.floating-form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });
    
    // Scroll to main form when "Send Message Now" is clicked
    document.querySelectorAll('a[href="#contact-form"]').forEach(link => {
        link.addEventListener('click', function() {
            // Close floating form if open
            if (isFormOpen) {
                isFormOpen = false;
                formPanel.classList.remove('active');
                toggleBtn.classList.remove('active');
            }
        });
    });
}

// Add CSRF token to meta tag if not present
if (!document.querySelector('meta[name="csrf-token"]')) {
    const meta = document.createElement('meta');
    meta.name = 'csrf-token';
    meta.content = document.querySelector('input[name="_token"]').value;
    document.head.appendChild(meta);
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/contact.blade.php ENDPATH**/ ?>