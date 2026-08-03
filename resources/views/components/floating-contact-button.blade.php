<!-- Floating Contact Button Component -->
<div id="floating-contact-button" class="floating-contact-btn">
    <!-- Main floating button -->
    <button class="floating-btn-main" onclick="toggleFloatingContact()" aria-label="Open contact modal" type="button">
        <div class="floating-btn-icon">
            {{-- Inline SVG so icon always shows (Lucide loads later and is optional here) --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="floating-phone-icon">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>
        </div>
        <div class="floating-btn-pulse"></div>
    </button>
    
    <!-- Mobile call button (visible only on mobile) -->
    <a href="tel:+61422905860" class="floating-btn-mobile-call" id="mobile-call-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="floating-phone-icon">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
        </svg>
        <span>Call Now</span>
    </a>
</div>

<!-- Contact Modal for Web Version -->
<div id="contact-modal" class="contact-modal-overlay">
    <div class="contact-modal">
        <div class="contact-modal-header">
            <h3 class="modal-title">Contact Us</h3>
            <button class="modal-close" onclick="closeContactModal()" aria-label="Close contact modal" type="button">
                <i data-lucide="x" aria-hidden="true"></i>
            </button>
        </div>
        
        <!-- Single Contact Form -->
        <div class="modal-content">
            <div class="contact-form-content">
                <div class="lawyer-profile">
                    <img src="{!! asset('images/bansal_2.webp') !!}" 
                         srcset="{!! asset('images/bansal_2.webp') !!} 1x, 
                                 {!! asset('images/bansal_2@2x.webp') !!} 2x" 
                         alt="Legal Representative" 
                         class="lawyer-photo" 
                         width="80" 
                         height="80" 
                         loading="lazy">
                </div>
                <p class="contact-description">
                    Need legal assistance? Share your phone number and message, and our experienced legal team will get back to you within 24 hours.
                </p>
                <form class="contact-form" id="contact-form">
                    <div class="form-group">
                        <label for="country-code" class="form-label">Phone Number</label>
                        <div class="phone-input-group">
                            <select class="country-code" id="country-code" required>
                                <option value="+61" data-flag="🇦🇺">🇦🇺 +61</option>
                                <option value="+1" data-flag="🇺🇸">🇺🇸 +1</option>
                                <option value="+44" data-flag="🇬🇧">🇬🇧 +44</option>
                                <option value="+91" data-flag="🇮🇳">🇮🇳 +91</option>
                            </select>
                            <input type="tel" class="phone-input" id="phone-number" placeholder="412 345 678" required>
                        </div>
                        <div class="error-message" id="phone-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="message-content" class="form-label">Your Message</label>
                        <textarea class="form-textarea" id="message-content" placeholder="Tell us about your legal matter..." rows="4" required></textarea>
                        <div class="error-message" id="message-error"></div>
                    </div>
                    
                    <div class="modal-buttons">
                        <button type="button" class="btn-secondary" onclick="closeContactModal()">CANCEL</button>
                        <button type="submit" class="btn-primary" id="submit-btn">
                            <span class="btn-text">SEND MESSAGE</span>
                            <span class="btn-spinner" style="display: none;">
                                <i data-lucide="loader-2" class="lucide-spin"></i> Sending...
                            </span>
                        </button>
                    </div>
                    <div id="floating-turnstile" class="cf-turnstile" data-sitekey="{{ config('services.turnstile.key') }}" data-execution="execute" data-appearance="interaction-only" data-callback="onFloatingTurnstileSuccess" data-error-callback="onFloatingTurnstileError"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/floating-contact.css') }}?v=1.1" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="{{ asset('css/floating-contact.css') }}?v=1.1"></noscript>

<script>
// Floating Contact Button JavaScript
let isModalOpen = false;

// Toggle floating contact modal (web only)
function toggleFloatingContact() {
    // Only show modal on desktop/tablet (not mobile)
    if (window.innerWidth > 768) {
        const modal = document.getElementById('contact-modal');
        if (modal) {
            modal.classList.add('show');
            isModalOpen = true;
            document.body.style.overflow = 'hidden';

            if (typeof window.loadTurnstile === 'function') {
                window.loadTurnstile().catch(function () {});
            }
        }
    }
}

// Close contact modal
function closeContactModal() {
    const modal = document.getElementById('contact-modal');
    if (modal) {
        modal.classList.remove('show');
        isModalOpen = false;
        document.body.style.overflow = '';
        
        // Clear form and errors
        const form = document.getElementById('contact-form');
        if (form) {
            form.reset();
            clearErrors();
        }
    }
}

// Clear error messages
function clearErrors() {
    document.querySelectorAll('.error-message').forEach(el => {
        el.classList.remove('show');
        el.textContent = '';
    });
}

// Show error message
function showError(fieldId, message) {
    const errorEl = document.getElementById(fieldId + '-error');
    if (errorEl) {
        errorEl.textContent = message;
        errorEl.classList.add('show');
    }
}

// Handle form submission
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contact-form');
    const submitBtn = document.getElementById('submit-btn');
    
    // Close modal when clicking outside
    document.getElementById('contact-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeContactModal();
        }
    });
    
    // Handle escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isModalOpen) {
            closeContactModal();
        }
    });
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            clearErrors();
            
            // Get form values
            const phoneNumber = document.getElementById('phone-number').value.trim();
            const countryCode = document.getElementById('country-code').value;
            const message = document.getElementById('message-content').value.trim();
            
            // Basic validation
            if (!phoneNumber) {
                showError('phone', 'Please enter your phone number');
                return;
            }
            
            if (!message) {
                showError('message', 'Please enter your message');
                return;
            }

            if (typeof window.loadTurnstile !== 'function') {
                alert('Security verification is not loaded. Please refresh the page.');
                return;
            }

            window.loadTurnstile()
                .then(function () {
                    turnstile.execute('#floating-turnstile');
                })
                .catch(function () {
                    alert('Security verification failed to load. Please refresh the page.');
                });
        });
    }

    window.onFloatingTurnstileSuccess = function(turnstileToken) {
        const phoneNumber = document.getElementById('phone-number').value.trim();
        const countryCode = document.getElementById('country-code').value;
        const message = document.getElementById('message-content').value.trim();
        const submitBtn = document.getElementById('submit-btn');
        const contactForm = document.getElementById('contact-form');

        submitBtn.disabled = true;
        submitBtn.classList.add('loading');

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        const formData = new FormData();
        formData.append('phone', countryCode + ' ' + phoneNumber);
        formData.append('message', message);
        formData.append('subject', 'Quick Contact Request - Floating Contact Button');
        formData.append('form_source', 'floating_contact_button');
        formData.append('form_variant', 'quick_contact');
        formData.append('website_url', '');
        formData.append('cf-turnstile-response', turnstileToken);
        formData.append('_token', csrfToken);

        fetch('{{ route("contact.submit") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    try {
                        const json = JSON.parse(text);
                        return Promise.reject({ json: json, status: response.status });
                    } catch (e) {
                        return Promise.reject({
                            message: `Server error (${response.status}): ${response.statusText}`,
                            status: response.status
                        });
                    }
                });
            }

            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            }

            return response.text().then(text => {
                try {
                    return JSON.parse(text);
                } catch (e) {
                    throw new Error('Server returned non-JSON response');
                }
            });
        })
        .then(data => {
            if (data.success) {
                alert('Thank you! Your message has been sent successfully. We\'ll get back to you within 24 hours.');
                closeContactModal();
                contactForm.reset();
            } else if (data.errors) {
                if (data.errors.phone) {
                    showError('phone', data.errors.phone[0]);
                }
                if (data.errors.message) {
                    showError('message', data.errors.message[0]);
                }
                if (data.errors['cf-turnstile-response']) {
                    alert(data.errors['cf-turnstile-response'][0]);
                }
            } else {
                alert(data.message || 'There was an error sending your message. Please try again.');
            }
        })
        .catch(error => {
            console.error('Floating contact form error:', error);
            const errorMsg = error.json?.message || error.message || 'There was an error sending your message. Please try again or call us directly.';
            alert(errorMsg);
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.classList.remove('loading');
            if (typeof turnstile !== 'undefined') {
                turnstile.reset('#floating-turnstile');
            }
        });
    };

    window.onFloatingTurnstileError = function() {
        alert('Security verification failed. Please try again.');
        if (typeof turnstile !== 'undefined') {
            turnstile.reset('#floating-turnstile');
        }
    };
    
    // Track mobile call button clicks
    const mobileCallBtn = document.getElementById('mobile-call-btn');
    if (mobileCallBtn) {
        mobileCallBtn.addEventListener('click', function() {
            // Google Analytics tracking
            if (typeof gtag !== 'undefined') {
                gtag('event', 'mobile_call_button_click', {
                    'event_category': 'Contact',
                    'event_label': 'Mobile Call Button',
                    'value': 1
                });
            }
            
            // Facebook Pixel tracking
            if (typeof fbq !== 'undefined') {
                fbq('track', 'Contact', {
                    content_name: 'Mobile Call Button Click'
                });
            }
            
            console.log('Mobile call button clicked');
        });
    }
});
</script>
