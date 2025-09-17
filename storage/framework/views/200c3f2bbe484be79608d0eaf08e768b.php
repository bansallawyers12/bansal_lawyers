<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<meta name="description" content="Bansal Lawyers Admin Portal - Secure Login">
	<meta name="author" content="Bansal Lawyers">
	<title>Bansal Lawyers | <?php echo $__env->yieldContent('title'); ?></title>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo e(asset('images/logo_img/bansal_lawyers_fevicon.png')); ?>" type="image/png">
	
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	
	<!-- BASE CSS -->
	<link href="<?php echo e(asset('css/app.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/bootstrap-social.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/components.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">

	<script async src="https://www.google.com/recaptcha/api.js"></script>
</head>

<style>
/* Modern Admin Login Design System */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --text-dark: #2c3e50;
    --text-light: #7f8c8d;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --shadow: 0 20px 40px rgba(0,0,0,0.08);
    --shadow-hover: 0 30px 60px rgba(0,0,0,0.12);
    --gradient-primary: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
    --gradient-accent: linear-gradient(135deg, #FF6B35 0%, #FF8E53 100%);
    --gradient-light: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    --border-radius: 16px;
    --border-radius-sm: 8px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: var(--gradient-light);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow-x: hidden;
}

/* Animated Background */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(27, 77, 137, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 107, 53, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.8) 0%, transparent 50%);
    z-index: 1;
    animation: backgroundShift 20s ease-in-out infinite;
}

@keyframes backgroundShift {
    0%, 100% { transform: translateX(0) translateY(0); }
    25% { transform: translateX(-20px) translateY(-10px); }
    50% { transform: translateX(20px) translateY(10px); }
    75% { transform: translateX(-10px) translateY(20px); }
}

/* Main Container */
.login-container {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 420px;
    padding: 20px;
}

/* Modern Card Design */
.modern-login-card {
    background: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(20px);
    overflow: hidden;
    position: relative;
    transition: var(--transition);
}

.modern-login-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-2px);
}

/* Card Header */
.modern-card-header {
    background: var(--gradient-primary);
    padding: 40px 40px 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.modern-card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.logo-section {
    position: relative;
    z-index: 2;
    margin-bottom: 20px;
}

.logo-section img {
    height: 50px;
    filter: brightness(0) invert(1);
    transition: var(--transition);
}

.logo-section img:hover {
    transform: scale(1.05);
}

.modern-card-title {
    color: var(--white);
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    position: relative;
    z-index: 2;
    letter-spacing: -0.5px;
}

.modern-card-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    font-weight: 400;
    margin-top: 8px;
    position: relative;
    z-index: 2;
}

/* Card Body */
.modern-card-body {
    padding: 40px;
}

/* Form Styles */
.modern-form-group {
    margin-bottom: 24px;
    position: relative;
}

.modern-form-label {
    display: block;
    color: var(--text-dark);
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 8px;
    letter-spacing: 0.3px;
}

.modern-form-input {
    width: 100%;
    padding: 16px 20px;
    border: 2px solid #e9ecef;
    border-radius: var(--border-radius-sm);
    font-size: 1rem;
    font-weight: 400;
    color: var(--text-dark);
    background: var(--white);
    transition: var(--transition);
    outline: none;
}

.modern-form-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.1);
    transform: translateY(-1px);
}

.modern-form-input::placeholder {
    color: var(--text-light);
    font-weight: 400;
}

/* Error States */
.modern-form-input.error {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
}

.modern-error-message {
    color: #dc3545;
    font-size: 0.85rem;
    font-weight: 500;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.modern-error-message i {
    font-size: 0.8rem;
}

/* Remember Me Checkbox */
.modern-checkbox-group {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
}

.modern-checkbox {
    position: relative;
    display: inline-block;
}

.modern-checkbox input[type="checkbox"] {
    opacity: 0;
    position: absolute;
    width: 0;
    height: 0;
}

.modern-checkbox-label {
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text-dark);
    user-select: none;
}

.modern-checkbox-custom {
    width: 20px;
    height: 20px;
    border: 2px solid #e9ecef;
    border-radius: 4px;
    background: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    position: relative;
}

.modern-checkbox input[type="checkbox"]:checked + .modern-checkbox-label .modern-checkbox-custom {
    background: var(--primary-color);
    border-color: var(--primary-color);
}

.modern-checkbox input[type="checkbox"]:checked + .modern-checkbox-label .modern-checkbox-custom::after {
    content: '✓';
    color: var(--white);
    font-size: 12px;
    font-weight: 700;
}

/* reCAPTCHA Styling */
.modern-recaptcha {
    margin: 24px 0;
    display: flex;
    justify-content: center;
}

/* Submit Button */
.modern-submit-btn {
    width: 100%;
    padding: 16px 24px;
    background: var(--gradient-primary);
    color: var(--white);
    border: none;
    border-radius: var(--border-radius-sm);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    text-transform: none;
    letter-spacing: 0.3px;
}

.modern-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(27, 77, 137, 0.3);
}

.modern-submit-btn:active {
    transform: translateY(0);
}

.modern-submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* Loading State */
.modern-submit-btn.loading {
    color: transparent;
}

.modern-submit-btn.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid transparent;
    border-top: 2px solid var(--white);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Footer Link */
.modern-footer-link {
    text-align: center;
    margin-top: 32px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: var(--border-radius-sm);
    backdrop-filter: blur(10px);
}

.modern-footer-text {
    color: var(--text-light);
    font-size: 0.9rem;
    margin: 0;
}

.modern-footer-link a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
}

.modern-footer-link a:hover {
    color: var(--secondary-color);
    text-decoration: underline;
}

/* Flash Messages */
.modern-flash-messages {
    margin-bottom: 24px;
}

.modern-alert {
    padding: 16px 20px;
    border-radius: var(--border-radius-sm);
    margin-bottom: 12px;
    font-size: 0.9rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: slideIn 0.3s ease-out;
}

.modern-alert.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.modern-alert.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.modern-alert.warning {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 480px) {
    .login-container {
        padding: 15px;
    }
    
    .modern-card-header {
        padding: 30px 30px 20px;
    }
    
    .modern-card-body {
        padding: 30px;
    }
    
    .modern-card-title {
        font-size: 1.75rem;
    }
}

/* Accessibility */
.modern-form-input:focus,
.modern-submit-btn:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

/* Hide loader */
.loader {
    display: none !important;
}
</style>

<body>
	<div class="loader"></div>
	<div id="app">
		<?php echo $__env->yieldContent('content'); ?>
	</div>
	
	<!-- COMMON SCRIPTS -->
	<script type="text/javascript">
		var site_url = "<?php echo URL::to('/'); ?>";
	</script>
	<script src="<?php echo e(asset('js/app.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/scripts.js')); ?>"></script>
	<script src="<?php echo e(asset('js/custom.js')); ?>"></script>
	
	<!-- Modern Login Scripts -->
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Form validation and modern interactions
		const form = document.querySelector('form[name="admin_login"]');
		const submitBtn = document.querySelector('.modern-submit-btn');
		const inputs = document.querySelectorAll('.modern-form-input');
		
		// Add modern input focus effects
		inputs.forEach(input => {
			input.addEventListener('focus', function() {
				this.parentElement.classList.add('focused');
			});
			
			input.addEventListener('blur', function() {
				this.parentElement.classList.remove('focused');
			});
		});
		
		// Form submission with loading state
		if (form && submitBtn) {
			form.addEventListener('submit', function(e) {
				submitBtn.classList.add('loading');
				submitBtn.disabled = true;
			});
		}
		
		// Auto-hide flash messages
		const alerts = document.querySelectorAll('.modern-alert');
		alerts.forEach(alert => {
			setTimeout(() => {
				alert.style.opacity = '0';
				alert.style.transform = 'translateY(-10px)';
				setTimeout(() => alert.remove(), 300);
			}, 5000);
		});
	});
	</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/layouts/admin-login.blade.php ENDPATH**/ ?>