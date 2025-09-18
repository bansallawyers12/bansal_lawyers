<?php
    // Configuration options
    $variant = $variant ?? 'default'; // default, compact, floating, inline
    $showTitle = $showTitle ?? true;
    $title = $title ?? 'Speak with a Lawyer';
    $subtitle = $subtitle ?? null; // Removed default tagline
    $buttonText = $buttonText ?? 'GET LEGAL ADVICE';
    $buttonClass = $buttonClass ?? 'btn-primary';
    $formId = $formId ?? 'unified-contact-form';
    $containerClass = $containerClass ?? '';
    $source = $source ?? request()->path();
    $showPhoto = $showPhoto ?? true;
    $photoUrl = $photoUrl ?? asset('images/bansal_2.jpg');
    $photoAlt = $photoAlt ?? 'Ajay Bansal - CEO of Bansal Lawyers';
?>

<div class="unified-contact-form <?php echo e($variant); ?> <?php echo e($containerClass); ?>" id="<?php echo e($formId); ?>-container">
    <?php if($showTitle): ?>
        <div class="contact-form-header">
            <?php if($showPhoto): ?>
                <div class="contact-form-photo">
                    <img src="<?php echo e($photoUrl); ?>" alt="<?php echo e($photoAlt); ?>" class="lawyer-photo">
                </div>
            <?php endif; ?>
            <div class="contact-form-title-section">
                <h3 class="contact-form-title"><?php echo e($title); ?></h3>
                <?php if($subtitle): ?>
                    <p class="contact-form-subtitle"><?php echo e($subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Success/Error Messages -->
    <div class="contact-form-messages" id="<?php echo e($formId); ?>-messages" style="display: none;">
        <div class="alert alert-success" id="<?php echo e($formId); ?>-success" style="display: none;">
            <i class="fa fa-check-circle"></i>
            <span id="<?php echo e($formId); ?>-success-text"></span>
        </div>
        <div class="alert alert-danger" id="<?php echo e($formId); ?>-error" style="display: none;">
            <i class="fa fa-exclamation-circle"></i>
            <span id="<?php echo e($formId); ?>-error-text"></span>
        </div>
    </div>

    <form id="<?php echo e($formId); ?>" class="contact-form" action="<?php echo e(route('contact.submit')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="form_source" value="<?php echo e($source); ?>">
        <input type="hidden" name="form_variant" value="<?php echo e($variant); ?>">
        
        <div class="form-group">
            <label for="<?php echo e($formId); ?>-name" class="form-label">Full Name *</label>
            <input type="text" 
                   class="form-control" 
                   id="<?php echo e($formId); ?>-name" 
                   name="name" 
                   placeholder="Enter your full name" 
                   required
                   value="<?php echo e(old('name')); ?>">
            <div class="invalid-feedback" id="<?php echo e($formId); ?>-name-error"></div>
        </div>

        <div class="form-group">
            <label for="<?php echo e($formId); ?>-email" class="form-label">Email Address *</label>
            <input type="email" 
                   class="form-control" 
                   id="<?php echo e($formId); ?>-email" 
                   name="email" 
                   placeholder="Enter your email address" 
                   required
                   value="<?php echo e(old('email')); ?>">
            <div class="invalid-feedback" id="<?php echo e($formId); ?>-email-error"></div>
        </div>

        <div class="form-group">
            <label for="<?php echo e($formId); ?>-phone" class="form-label">Phone Number *</label>
            <input type="tel" 
                   class="form-control" 
                   id="<?php echo e($formId); ?>-phone" 
                   name="phone" 
                   placeholder="Enter your phone number" 
                   required
                   value="<?php echo e(old('phone')); ?>">
            <div class="invalid-feedback" id="<?php echo e($formId); ?>-phone-error"></div>
        </div>

        <div class="form-group">
            <label for="<?php echo e($formId); ?>-subject" class="form-label">Subject *</label>
            <input type="text" 
                   class="form-control" 
                   id="<?php echo e($formId); ?>-subject" 
                   name="subject" 
                   placeholder="What is this about?" 
                   required
                   value="<?php echo e(old('subject')); ?>">
            <div class="invalid-feedback" id="<?php echo e($formId); ?>-subject-error"></div>
        </div>

        <div class="form-group">
            <label for="<?php echo e($formId); ?>-message" class="form-label">Message *</label>
            <textarea class="form-control" 
                      id="<?php echo e($formId); ?>-message" 
                      name="message" 
                      rows="4" 
                      placeholder="Tell us about your legal needs and how we can help you..." 
                      required><?php echo e(old('message')); ?></textarea>
            <div class="invalid-feedback" id="<?php echo e($formId); ?>-message-error"></div>
        </div>

        <!-- Google reCAPTCHA -->
        <div class="form-group">
            <div class="g-recaptcha recaptcha-container" data-sitekey="<?php echo e(config('services.recaptcha.key', env('RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI'))); ?>"></div>
            <div class="invalid-feedback" id="<?php echo e($formId); ?>-recaptcha-error"></div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn <?php echo e($buttonClass); ?> contact-form-submit" id="<?php echo e($formId); ?>-submit">
                <i class="fa fa-paper-plane"></i>
                <span class="btn-text"><?php echo e($buttonText); ?></span>
                <span class="btn-loading" style="display: none;">
                    <i class="fa fa-spinner fa-spin"></i> Sending...
                </span>
            </button>
        </div>
    </form>
</div>

<style>
/* Unified Contact Form Styles */
.unified-contact-form {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    padding: 30px;
    margin: 20px 0;
}

.unified-contact-form.compact {
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.unified-contact-form.floating {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 350px;
    max-height: 80vh;
    overflow-y: auto;
    z-index: 1000;
    display: none;
}

.unified-contact-form.inline {
    background: transparent;
    box-shadow: none;
    padding: 0;
    margin: 0;
}

.contact-form-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
    text-align: left;
}

.contact-form-photo {
    flex-shrink: 0;
}

.lawyer-photo {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
    object-position: center 5px;
    border: 3px solid #1B4D89;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.contact-form-title-section {
    flex: 1;
}

.contact-form-title {
    color: #1B4D89;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 0 5px 0;
    line-height: 1.2;
}

.contact-form-subtitle {
    color: #666;
    font-size: 0.9rem;
    margin: 0;
    font-style: italic;
}

.contact-form .form-group {
    margin-bottom: 20px;
}

.contact-form .form-label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: #333;
    font-size: 0.9rem;
}

.contact-form .form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: #fff;
    color: #333;
}

.contact-form .form-control:focus {
    outline: none;
    border-color: #1B4D89;
    box-shadow: 0 0 0 2px rgba(27, 77, 137, 0.1);
}

.contact-form .form-control::placeholder {
    color: #999;
    font-style: italic;
}

.contact-form .form-control.is-invalid {
    border-color: #dc3545;
}

.contact-form .invalid-feedback {
    display: none;
    color: #dc3545;
    font-size: 0.8rem;
    margin-top: 5px;
}

.contact-form .invalid-feedback.show {
    display: block;
}

.contact-form-submit {
    width: 100%;
    padding: 15px 20px;
    font-size: 1rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-radius: 6px;
    transition: all 0.3s ease;
    position: relative;
    background: #1B4D89;
    border: none;
    color: white;
}

.contact-form-submit:hover {
    background: #153d6b;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(27, 77, 137, 0.3);
}

.contact-form-submit:active {
    transform: translateY(0);
}

.contact-form-submit:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
    background: #6c757d;
}

.contact-form-messages {
    margin-bottom: 20px;
}

.contact-form-messages .alert {
    padding: 12px 15px;
    border-radius: 8px;
    margin: 0;
    font-size: 0.9rem;
}

.contact-form-messages .alert i {
    margin-right: 8px;
}

/* Floating form specific styles */
.unified-contact-form.floating .contact-form-header {
    text-align: left;
    margin-bottom: 15px;
    gap: 12px;
}

.unified-contact-form.floating .contact-form-title {
    font-size: 1.2rem;
}

.unified-contact-form.floating .lawyer-photo {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    object-position: center 4px;
}

/* Enhanced reCAPTCHA styling */
.recaptcha-container {
    display: flex;
    justify-content: center;
    margin: 15px 0;
    position: relative;
}

.recaptcha-container > div {
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 8px;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    overflow: hidden;
}

.recaptcha-container > div:hover {
    border-color: rgba(255,255,255,0.5);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    transform: translateY(-2px);
}

.recaptcha-container iframe {
    border-radius: 6px;
    background: transparent;
}

/* Home page specific reCAPTCHA styling */
.home-contact-form-container .recaptcha-container > div {
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.3);
    backdrop-filter: blur(15px);
}

.home-contact-form-container .recaptcha-container > div:hover {
    border-color: rgba(255,255,255,0.5);
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
}

/* Responsive design */
@media (max-width: 768px) {
    .unified-contact-form {
        padding: 20px;
        margin: 10px 0;
    }
    
    .unified-contact-form.floating {
        width: 90%;
        right: 5%;
        left: 5%;
    }
    
    .recaptcha-container {
        transform: scale(0.9);
    }
}

@media (max-width: 480px) {
    .unified-contact-form {
        padding: 15px;
    }
    
    .contact-form .form-control {
        padding: 10px 12px;
    }
    
    .recaptcha-container {
        transform: scale(0.8);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('<?php echo e($formId); ?>');
    if (!form) return;

    const formId = '<?php echo e($formId); ?>';
    const submitBtn = document.getElementById(formId + '-submit');
    
    // Track form view
    if (typeof gtag !== 'undefined') {
        gtag('event', 'contact_form_view', {
            'event_category': 'Lead Generation',
            'event_label': 'Form Displayed - <?php echo e($formId); ?>'
        });
    }
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    const messagesContainer = document.getElementById(formId + '-messages');
    const successAlert = document.getElementById(formId + '-success');
    const errorAlert = document.getElementById(formId + '-error');
    const successText = document.getElementById(formId + '-success-text');
    const errorText = document.getElementById(formId + '-error-text');

    // Clear previous validation errors
    function clearValidationErrors() {
        const invalidFields = form.querySelectorAll('.is-invalid');
        invalidFields.forEach(field => field.classList.remove('is-invalid'));
        
        const errorMessages = form.querySelectorAll('.invalid-feedback');
        errorMessages.forEach(msg => msg.classList.remove('show'));
    }

    // Show validation error
    function showFieldError(fieldName, message) {
        const field = document.getElementById(formId + '-' + fieldName);
        const errorDiv = document.getElementById(formId + '-' + fieldName + '-error');
        
        if (field && errorDiv) {
            field.classList.add('is-invalid');
            errorDiv.textContent = message;
            errorDiv.classList.add('show');
        }
    }

    // Show success message
    function showSuccess(message) {
        clearValidationErrors();
        successText.textContent = message;
        successAlert.style.display = 'block';
        errorAlert.style.display = 'none';
        messagesContainer.style.display = 'block';
        form.reset();
    }

    // Show error message
    function showError(message) {
        clearValidationErrors();
        errorText.textContent = message;
        errorAlert.style.display = 'block';
        successAlert.style.display = 'none';
        messagesContainer.style.display = 'block';
    }

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous messages
        messagesContainer.style.display = 'none';
        clearValidationErrors();
        
        // Show loading state
        submitBtn.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-block';
        
        // Validate reCAPTCHA
        const recaptchaResponse = grecaptcha.getResponse();
        if (!recaptchaResponse) {
            showFieldError('recaptcha', 'Please complete the reCAPTCHA verification.');
            submitBtn.disabled = false;
            btnText.style.display = 'inline-block';
            btnLoading.style.display = 'none';
            return;
        }
        
        // Get form data
        const formData = new FormData(form);
        
        // Submit via AJAX
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
                // Track successful form submission
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'contact_form_submit', {
                        'event_category': 'Lead Generation',
                        'event_label': 'Contact Form Success',
                        'value': 1
                    });
                }
                showSuccess(data.message || 'Thank you! Your message has been sent successfully.');
            } else {
                // Track form submission error
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'contact_form_error', {
                        'event_category': 'Lead Generation',
                        'event_label': 'Contact Form Error',
                        'value': 0
                    });
                }
                if (data.errors) {
                    // Handle validation errors
                    Object.keys(data.errors).forEach(field => {
                        const fieldName = field.replace('g-recaptcha-response', 'recaptcha');
                        showFieldError(fieldName, data.errors[field][0]);
                    });
                } else {
                    showError(data.message || 'Sorry, there was an error sending your message. Please try again.');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Track form submission error
            if (typeof gtag !== 'undefined') {
                gtag('event', 'contact_form_error', {
                    'event_category': 'Lead Generation',
                    'event_label': 'Contact Form Network Error',
                    'value': 0
                });
            }
            showError('Sorry, there was an error sending your message. Please try again.');
        })
        .finally(() => {
            // Reset button state
            submitBtn.disabled = false;
            btnText.style.display = 'inline-block';
            btnLoading.style.display = 'none';
        });
    });
});
</script>
<?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/components/unified-contact-form.blade.php ENDPATH**/ ?>