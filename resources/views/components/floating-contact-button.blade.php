<!-- Floating Contact Button Component -->
<div id="floating-contact-button" class="floating-contact-btn">
    <!-- Main floating button -->
    <button class="floating-btn-main" onclick="toggleFloatingContact()" aria-label="Open contact modal" type="button">
        <div class="floating-btn-icon">
            <i class="fa fa-phone" aria-hidden="true"></i>
        </div>
        <div class="floating-btn-pulse"></div>
    </button>
    
    <!-- Mobile call button (visible only on mobile) -->
    <a href="tel:+61422905860" class="floating-btn-mobile-call" id="mobile-call-btn">
        <i class="fa fa-phone" aria-hidden="true"></i>
        <span>Call Now</span>
    </a>
</div>

<!-- Contact Modal for Web Version -->
<div id="contact-modal" class="contact-modal-overlay">
    <div class="contact-modal">
        <div class="contact-modal-header">
            <h3 class="modal-title">Contact Us</h3>
            <button class="modal-close" onclick="closeContactModal()" aria-label="Close contact modal" type="button">
                <i class="fa fa-times" aria-hidden="true"></i>
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
                                <i class="fa fa-spinner fa-spin"></i> Sending...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Floating Button Styles */
.floating-contact-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}

.floating-btn-main {
    width: 60px;
    height: 60px;
    min-width: 44px;
    min-height: 44px;
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(27, 77, 137, 0.3);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    padding: 0;
}

.floating-btn-main:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 25px rgba(27, 77, 137, 0.4);
}

.floating-btn-icon {
    color: white;
    font-size: 24px;
    z-index: 2;
    position: relative;
}

.floating-btn-pulse {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        transform: scale(1.4);
        opacity: 0;
    }
}

/* Mobile Call Button (Hidden by default, shown only on mobile) */
.floating-btn-mobile-call {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: white;
    padding: 12px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    box-shadow: 0 4px 20px rgba(27, 77, 137, 0.3);
    transition: all 0.3s ease;
    align-items: center;
    gap: 8px;
    z-index: 9999;
}

.floating-btn-mobile-call:hover {
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(27, 77, 137, 0.4);
}

.floating-btn-mobile-call i {
    font-size: 16px;
}

/* Show mobile call button only on mobile devices */
@media (max-width: 768px) {
    .floating-btn-main {
        display: none;
    }
    
    .floating-btn-mobile-call {
        display: flex;
    }
}

/* Modal Styles */
.contact-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    backdrop-filter: blur(5px);
}

.contact-modal-overlay.show {
    display: flex;
}

.contact-modal {
    background: white;
    border-radius: 20px;
    width: 90%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.contact-modal-header {
    background: #1B4D89;
    padding: 20px;
    border-radius: 20px 20px 0 0;
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-title {
    color: white;
    font-size: 20px;
    font-weight: 700;
    margin: 0;
}

.modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
    width: 44px;
    height: 44px;
    min-width: 44px;
    min-height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.3s ease;
    padding: 0;
}

.modal-close:hover {
    background: rgba(255, 255, 255, 0.1);
}

.modal-content {
    padding: 30px;
}

.contact-form-content {
    text-align: center;
}

.lawyer-profile {
    margin-bottom: 20px;
}

.lawyer-photo {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    object-fit: cover;
    border: 3px solid #1B4D89;
}

.contact-description {
    color: #333;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 25px;
    text-align: left;
}

.contact-form {
    text-align: left;
}

.form-group {
    margin-bottom: 20px;
    text-align: left;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    font-size: 14px;
}

.phone-input-group {
    display: flex;
    gap: 10px;
}

.error-message {
    color: #dc3545;
    font-size: 12px;
    margin-top: 5px;
    display: none;
}

.error-message.show {
    display: block;
}

.country-code {
    flex: 0 0 120px;
    padding: 12px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 14px;
    background: white;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

.country-code:focus {
    outline: none;
    border-color: #1B4D89;
}

.phone-input {
    flex: 1;
    padding: 12px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.phone-input:focus {
    outline: none;
    border-color: #1B4D89;
}

.modal-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.btn-primary, .btn-secondary {
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-primary {
    background: #1B4D89;
    color: white;
}

.btn-primary:hover:not(:disabled) {
    background: #2c5aa0;
    transform: translateY(-2px);
}

.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn-primary.loading .btn-text {
    display: none;
}

.btn-primary.loading .btn-spinner {
    display: inline-block !important;
}

.btn-secondary {
    background: white;
    color: #666;
    border: 2px solid #e1e5e9;
}

.btn-secondary:hover {
    background: #f8f9fa;
    border-color: #ccc;
}

.form-textarea {
    width: 100%;
    padding: 12px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

.form-textarea:focus {
    outline: none;
    border-color: #1B4D89;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .contact-modal {
        width: 95%;
        margin: 10px;
        border-radius: 15px;
    }
    
    .contact-modal-header {
        padding: 15px;
        border-radius: 15px 15px 0 0;
    }
    
    .modal-content {
        padding: 20px;
    }
    
    .modal-buttons {
        flex-direction: column;
        gap: 10px;
    }
    
    .btn-primary, .btn-secondary {
        width: 100%;
    }
    
    .phone-input-group {
        flex-direction: column;
        gap: 10px;
    }
    
    .country-code {
        flex: none;
    }
}

/* Hide modal on mobile since we show direct call button */
@media (max-width: 768px) {
    .contact-modal-overlay {
        display: none !important;
    }
}
</style>

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
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.classList.add('loading');
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            
            // Prepare form data
            const formData = new FormData();
            formData.append('phone', countryCode + ' ' + phoneNumber);
            formData.append('message', message);
            formData.append('subject', 'Quick Contact Request - Floating Contact Button');
            formData.append('form_source', 'floating_contact_button');
            formData.append('form_variant', 'quick_contact');
            formData.append('g-recaptcha-response', 'floating-button-bypass');
            formData.append('_token', csrfToken);
            
            // Submit to backend
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
                } else {
                    return response.text().then(text => {
                        try {
                            return JSON.parse(text);
                        } catch (e) {
                            throw new Error('Server returned non-JSON response');
                        }
                    });
                }
            })
            .then(data => {
                if (data.success) {
                    alert('Thank you! Your message has been sent successfully. We\'ll get back to you within 24 hours.');
                    closeContactModal();
                    contactForm.reset();
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        if (data.errors.phone) {
                            showError('phone', data.errors.phone[0]);
                        }
                        if (data.errors.message) {
                            showError('message', data.errors.message[0]);
                        }
                    } else {
                        alert(data.message || 'There was an error sending your message. Please try again.');
                    }
                }
            })
            .catch(error => {
                console.error('Floating contact form error:', error);
                const errorMsg = error.json?.message || error.message || 'There was an error sending your message. Please try again or call us directly.';
                alert(errorMsg);
            })
            .finally(() => {
                // Remove loading state
                submitBtn.disabled = false;
                submitBtn.classList.remove('loading');
            });
        });
    }
    
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
