<!-- Floating Contact Button Component -->
<div id="floating-contact-button" class="floating-contact-btn">
    <!-- Main floating button -->
    <div class="floating-btn-main" onclick="toggleFloatingContact()">
        <div class="floating-btn-icon">
            <i class="fa fa-phone" aria-hidden="true"></i>
        </div>
        <div class="floating-btn-pulse"></div>
    </div>
    
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
            <div class="modal-tabs">
                <button class="modal-tab active" data-tab="call">SCHEDULE A CALL</button>
                <button class="modal-tab" data-tab="message">MESSAGE US</button>
            </div>
            <button class="modal-close" onclick="closeContactModal()">
                <i class="fa fa-times"></i>
            </button>
        </div>
        
        <!-- Call Scheduling Tab -->
        <div id="call-tab" class="modal-tab-content active">
            <div class="call-tab-content">
                <div class="lawyer-profile">
                    <img src="<?php echo e(asset('images/bansal_2.jpg')); ?>" alt="Legal Representative" class="lawyer-photo">
                </div>
                <p class="call-description">
                    Want a call back at a convenient time? Please schedule a complimentary call back with a senior legal representative.
                </p>
                <form class="call-form" id="call-form">
                    <div class="phone-input-group">
                        <select class="country-code" id="country-code">
                            <option value="+61" data-flag="🇦🇺">🇦🇺 +61</option>
                            <option value="+1" data-flag="🇺🇸">🇺🇸 +1</option>
                            <option value="+44" data-flag="🇬🇧">🇬🇧 +44</option>
                            <option value="+91" data-flag="🇮🇳">🇮🇳 +91</option>
                        </select>
                        <input type="tel" class="phone-input" id="phone-number" placeholder="412 345 678" required>
                    </div>
                    <div class="modal-buttons">
                        <button type="button" class="btn-secondary" onclick="closeContactModal()">CALL ME LATER</button>
                        <button type="submit" class="btn-primary">SCHEDULE A CALL</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Message Tab -->
        <div id="message-tab" class="modal-tab-content">
            <div class="message-tab-content">
                <h3>Send a message to our experienced legal team.</h3>
                <form class="message-form" id="message-form">
                    <div class="form-group">
                        <input type="text" class="form-input" id="message-name" placeholder="Name" required>
                        <i class="fa fa-user form-icon"></i>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-input" id="message-email" placeholder="Email" required>
                        <i class="fa fa-envelope form-icon"></i>
                    </div>
                    <div class="form-group">
                        <div class="phone-input-group">
                            <select class="country-code" id="message-country-code">
                                <option value="+61" data-flag="🇦🇺">🇦🇺 +61</option>
                                <option value="+1" data-flag="🇺🇸">🇺🇸 +1</option>
                                <option value="+44" data-flag="🇬🇧">🇬🇧 +44</option>
                                <option value="+91" data-flag="🇮🇳">🇮🇳 +91</option>
                            </select>
                            <input type="tel" class="phone-input" id="message-phone" placeholder="412 345 678" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-textarea" id="message-content" placeholder="Your message" rows="4" required></textarea>
                        <i class="fa fa-align-left form-icon textarea-icon"></i>
                    </div>
                    <button type="submit" class="btn-primary full-width">MESSAGE US</button>
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
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}

.floating-btn-main {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(27, 77, 137, 0.3);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
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
}

.modal-tabs {
    display: flex;
    gap: 0;
    margin-bottom: 0;
}

.modal-tab {
    background: transparent;
    color: #ccc;
    border: none;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
}

.modal-tab.active {
    color: white;
    background: rgba(255, 255, 255, 0.1);
}

.modal-tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 3px;
    background: white;
    border-radius: 2px 2px 0 0;
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
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.3s ease;
}

.modal-close:hover {
    background: rgba(255, 255, 255, 0.1);
}

.modal-tab-content {
    display: none;
    padding: 30px;
}

.modal-tab-content.active {
    display: block;
}

/* Call Tab Styles */
.call-tab-content {
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

.call-description {
    color: #333;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 25px;
    text-align: left;
}

.call-form {
    text-align: left;
}

.phone-input-group {
    display: flex;
    gap: 10px;
    margin-bottom: 25px;
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

.btn-primary:hover {
    background: #2c5aa0;
    transform: translateY(-2px);
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

/* Message Tab Styles */
.message-tab-content h3 {
    color: #333;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 25px;
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
    position: relative;
}

.form-input, .form-textarea {
    width: 100%;
    padding: 12px 40px 12px 12px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
}

.form-input:focus, .form-textarea:focus {
    outline: none;
    border-color: #1B4D89;
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

.form-icon {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #ccc;
    font-size: 16px;
}

.textarea-icon {
    top: 15px;
    transform: none;
}

.full-width {
    width: 100%;
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
    
    .modal-tab {
        padding: 10px 15px;
        font-size: 12px;
    }
    
    .modal-tab-content {
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
    }
}

// Handle tab switching
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.modal-tab');
    const tabContents = document.querySelectorAll('.modal-tab-content');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all tabs and contents
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding content
            this.classList.add('active');
            document.getElementById(targetTab + '-tab').classList.add('active');
        });
    });
    
    // Close modal when clicking outside
    document.getElementById('contact-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeContactModal();
        }
    });
    
    // Handle form submissions
    const callForm = document.getElementById('call-form');
    const messageForm = document.getElementById('message-form');
    
    if (callForm) {
        callForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const phoneNumber = document.getElementById('phone-number').value;
            const countryCode = document.getElementById('country-code').value;
            
            // For call scheduling, we'll show a simple alert for now
            // In a real implementation, you might want to create a separate endpoint
            alert('Call scheduled! We will contact you at ' + countryCode + ' ' + phoneNumber + ' within 24 hours.');
            closeContactModal();
            
            // Clear form
            callForm.reset();
        });
    }
    
    if (messageForm) {
        messageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData();
            formData.append('name', document.getElementById('message-name').value);
            formData.append('email', document.getElementById('message-email').value);
            formData.append('phone', document.getElementById('message-country-code').value + ' ' + document.getElementById('message-phone').value);
            formData.append('subject', 'Inquiry from Floating Contact Button');
            formData.append('message', document.getElementById('message-content').value);
            formData.append('form_source', 'floating_contact_button');
            formData.append('form_variant', 'message_tab');
            formData.append('g-recaptcha-response', 'floating-button-bypass'); // Bypass for floating button
            
            // Submit to existing contact endpoint
            fetch('<?php echo e(route("contact.submit")); ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Message sent successfully! We will get back to you soon.');
                    closeContactModal();
                    messageForm.reset();
                } else {
                    alert('There was an error sending your message. Please try again or call us directly.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error sending your message. Please try again or call us directly.');
            });
        });
    }
    
    // Handle escape key to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isModalOpen) {
            closeContactModal();
        }
    });
});
</script>
<?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/components/floating-contact-button.blade.php ENDPATH**/ ?>