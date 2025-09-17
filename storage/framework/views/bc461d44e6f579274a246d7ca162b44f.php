
<?php $__env->startSection('title', 'Create Appointment Configuration'); ?>

<?php $__env->startSection('content'); ?>
<style>
/* Modern Appointment Configuration Create Design System */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --info-color: #06b6d4;
    --appointment-color: #ef4444;
    --appointment-secondary: #dc2626;
    --text-dark: #1e293b;
    --text-light: #64748b;
    --bg-light: #f8fafc;
    --white: #ffffff;
    --border-color: #e2e8f0;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --border-radius: 12px;
    --border-radius-sm: 8px;
    --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.modern-page-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.modern-card {
    background: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    border: 1px solid var(--border-color);
    overflow: hidden;
    transition: var(--transition);
    max-width: 1000px;
    margin: 0 auto;
}

.modern-card-header {
    background: linear-gradient(135deg, var(--appointment-color) 0%, var(--appointment-secondary) 100%);
    padding: 1.5rem 2rem;
    border-bottom: none;
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
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.modern-card-title {
    color: var(--white);
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modern-card-title i {
    font-size: 1.5rem;
    opacity: 0.9;
}

.modern-header-actions {
    position: relative;
    z-index: 2;
    margin-top: 1.5rem;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.modern-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.modern-btn-back {
    background: rgba(255, 255, 255, 0.2);
    color: var(--white);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.modern-btn-back:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    color: var(--white);
    text-decoration: none;
}

.modern-btn-primary {
    background: linear-gradient(135deg, var(--accent-color) 0%, #FF8E53 100%);
    color: var(--white);
}

.modern-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
    color: var(--white);
    text-decoration: none;
}

.modern-card-body {
    padding: 2rem;
}

.modern-form-section {
    margin-bottom: 2rem;
}

.modern-form-section:last-child {
    margin-bottom: 0;
}

.modern-section-title {
    color: var(--text-dark);
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--border-color);
}

.modern-section-title i {
    color: var(--appointment-color);
}

.modern-form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    align-items: start;
}

.modern-form-group {
    margin-bottom: 1.5rem;
}

.modern-form-label {
    display: block;
    color: var(--text-dark);
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.modern-form-label .required {
    color: var(--danger-color);
    margin-left: 0.25rem;
}

.modern-form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    color: var(--text-dark);
    background: var(--white);
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.modern-form-input:focus {
    outline: none;
    border-color: var(--appointment-color);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    transform: translateY(-1px);
}

.modern-form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    color: var(--text-dark);
    background: var(--white);
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
    appearance: none;
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="%236B7280" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8l4 4 4-4"/></svg>');
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1rem;
    padding-right: 2.5rem;
}

.modern-form-select:focus {
    outline: none;
    border-color: var(--appointment-color);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    transform: translateY(-1px);
}

.modern-form-select[multiple] {
    min-height: 120px;
    padding-right: 1rem;
    background-image: none;
}

.modern-help-text {
    color: var(--text-light);
    font-size: 0.75rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.modern-help-text i {
    color: var(--info-color);
}

.modern-info-card {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    border: 1px solid #93c5fd;
    border-radius: var(--border-radius-sm);
    padding: 1rem;
    margin-bottom: 2rem;
}

.modern-info-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
}

.modern-info-icon {
    color: var(--info-color);
    font-size: 1.125rem;
}

.modern-info-title {
    color: var(--text-dark);
    font-size: 0.875rem;
    font-weight: 600;
    margin: 0;
}

.modern-info-description {
    color: var(--text-dark);
    font-size: 0.8rem;
    margin: 0;
    opacity: 0.8;
}

.modern-person-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.modern-person-card {
    background: var(--white);
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    padding: 1rem;
    transition: var(--transition);
    cursor: pointer;
    position: relative;
}

.modern-person-card:hover {
    border-color: var(--appointment-color);
    box-shadow: var(--shadow);
    transform: translateY(-1px);
}

.modern-person-card.selected {
    border-color: var(--appointment-color);
    background: #fef2f2;
}

.modern-person-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.modern-person-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modern-person-avatar {
    width: 2.5rem;
    height: 2.5rem;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    font-weight: 600;
}

.modern-person-details h4 {
    margin: 0;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-dark);
}

.modern-person-details p {
    margin: 0;
    font-size: 0.75rem;
    color: var(--text-light);
}

.modern-weekend-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 0.75rem;
}

.modern-weekend-option {
    position: relative;
}

.modern-weekend-option input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.modern-weekend-label {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    background: var(--white);
    color: var(--text-dark);
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    text-align: center;
}

.modern-weekend-option input:checked + .modern-weekend-label {
    border-color: var(--appointment-color);
    background: var(--appointment-color);
    color: var(--white);
}

.modern-weekend-label:hover {
    border-color: var(--appointment-color);
    transform: translateY(-1px);
}

.modern-form-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid var(--border-color);
}

/* Loading states */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.loading {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@media (max-width: 768px) {
    .modern-page-container {
        padding: 1rem 0;
    }
    
    .modern-card-header {
        padding: 1rem 1.5rem;
    }
    
    .modern-card-title {
        font-size: 1.5rem;
    }
    
    .modern-card-body {
        padding: 1.5rem;
    }
    
    .modern-form-row {
        grid-template-columns: 1fr;
    }
    
    .modern-person-options {
        grid-template-columns: 1fr;
    }
    
    .modern-weekend-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .modern-form-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .modern-btn {
        justify-content: center;
    }
    
    .modern-header-actions {
        flex-direction: column;
        align-items: stretch;
    }
}
</style>

<!-- Main Content -->
<div class="main-content modern-page-container">
    <section class="section">
        <div class="section-body">
            <div class="server-error">
                <?php echo $__env->make('Elements.flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="custom-error-msg">
            </div>
            
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="modern-card">
                            <div class="modern-card-header">
                                <h4 class="modern-card-title">
                                    <i class="fas fa-cog"></i>
                                    Create Appointment Configuration
                                </h4>
                                <div class="modern-header-actions">
                                    <a href="<?php echo e(route('admin.feature.appointmentdisabledate.index')); ?>" class="modern-btn modern-btn-back">
                                        <i class="fas fa-arrow-left"></i>
                                        Back to Configurations
                                    </a>
                                </div>
                            </div>
                            
                            <div class="modern-card-body">
                                <!-- Information Card -->
                                <div class="modern-info-card">
                                    <div class="modern-info-header">
                                        <i class="fas fa-info-circle modern-info-icon"></i>
                                        <h5 class="modern-info-title">Appointment Slot Configuration</h5>
                                    </div>
                                    <p class="modern-info-description">
                                        Configure appointment availability settings including working hours, service types, and weekend schedules for selected personnel.
                                    </p>
                                </div>

                                <form action="<?php echo e(route('admin.feature.appointmentdisabledate.store')); ?>" method="post" id="config-form">
                                    <?php echo csrf_field(); ?>
                                    
                                    <!-- Person Selection -->
                                    <div class="modern-form-section">
                                        <h3 class="modern-section-title">
                                            <i class="fas fa-users"></i>
                                            Select Person
                                        </h3>
                                        
                                        <div class="modern-person-options">
                                            <label class="modern-person-card">
                                                <input type="radio" name="person_id" value="1" required>
                                                <div class="modern-person-info">
                                                    <div class="modern-person-avatar">A</div>
                                                    <div class="modern-person-details">
                                                        <h4>Ajay</h4>
                                                        <p>Senior Consultant</p>
                                                    </div>
                                                </div>
                                            </label>
                                            
                                            <label class="modern-person-card">
                                                <input type="radio" name="person_id" value="2" required>
                                                <div class="modern-person-info">
                                                    <div class="modern-person-avatar">S</div>
                                                    <div class="modern-person-details">
                                                        <h4>Shubham</h4>
                                                        <p>Legal Advisor</p>
                                                    </div>
                                                </div>
                                            </label>
                                            
                                            <label class="modern-person-card">
                                                <input type="radio" name="person_id" value="3" required>
                                                <div class="modern-person-info">
                                                    <div class="modern-person-avatar">T</div>
                                                    <div class="modern-person-details">
                                                        <h4>Tourist</h4>
                                                        <p>Specialist</p>
                                                    </div>
                                                </div>
                                            </label>
                                            
                                            <label class="modern-person-card">
                                                <input type="radio" name="person_id" value="4" required>
                                                <div class="modern-person-info">
                                                    <div class="modern-person-avatar">E</div>
                                                    <div class="modern-person-details">
                                                        <h4>Education</h4>
                                                        <p>Consultant</p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Service Configuration -->
                                    <div class="modern-form-section">
                                        <h3 class="modern-section-title">
                                            <i class="fas fa-briefcase"></i>
                                            Service Configuration
                                        </h3>
                                        
                                        <div class="modern-form-row">
                                            <div class="modern-form-group">
                                                <label class="modern-form-label">Service Type</label>
                                                <select class="modern-form-select" name="service_type">
                                                    <option value="1">Paid Service</option>
                                                    <option value="2">Free Service</option>
                                                </select>
                                                <div class="modern-help-text">
                                                    <i class="fas fa-info-circle"></i>
                                                    Select the type of service offered
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Time Configuration -->
                                    <div class="modern-form-section">
                                        <h3 class="modern-section-title">
                                            <i class="fas fa-clock"></i>
                                            Working Hours
                                        </h3>
                                        
                                        <div class="modern-form-row">
                                            <div class="modern-form-group">
                                                <label class="modern-form-label">
                                                    Start Time <span class="required">*</span>
                                                </label>
                                                <input type="time" class="modern-form-input" name="start_time" required>
                                                <div class="modern-help-text">
                                                    <i class="fas fa-clock"></i>
                                                    Daily working hours start time
                                                </div>
                                            </div>
                                            <div class="modern-form-group">
                                                <label class="modern-form-label">
                                                    End Time <span class="required">*</span>
                                                </label>
                                                <input type="time" class="modern-form-input" name="end_time" required>
                                                <div class="modern-help-text">
                                                    <i class="fas fa-clock"></i>
                                                    Daily working hours end time
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Weekend Configuration -->
                                    <div class="modern-form-section">
                                        <h3 class="modern-section-title">
                                            <i class="fas fa-calendar-week"></i>
                                            Weekend Schedule
                                        </h3>
                                        
                                        <div class="modern-form-group">
                                            <label class="modern-form-label">Select Weekend Days</label>
                                            <div class="modern-weekend-grid">
                                                <div class="modern-weekend-option">
                                                    <input type="checkbox" name="weekend[]" value="Sun" id="sun">
                                                    <label for="sun" class="modern-weekend-label">Sunday</label>
                                                </div>
                                                <div class="modern-weekend-option">
                                                    <input type="checkbox" name="weekend[]" value="Mon" id="mon">
                                                    <label for="mon" class="modern-weekend-label">Monday</label>
                                                </div>
                                                <div class="modern-weekend-option">
                                                    <input type="checkbox" name="weekend[]" value="Tue" id="tue">
                                                    <label for="tue" class="modern-weekend-label">Tuesday</label>
                                                </div>
                                                <div class="modern-weekend-option">
                                                    <input type="checkbox" name="weekend[]" value="Wed" id="wed">
                                                    <label for="wed" class="modern-weekend-label">Wednesday</label>
                                                </div>
                                                <div class="modern-weekend-option">
                                                    <input type="checkbox" name="weekend[]" value="Thu" id="thu">
                                                    <label for="thu" class="modern-weekend-label">Thursday</label>
                                                </div>
                                                <div class="modern-weekend-option">
                                                    <input type="checkbox" name="weekend[]" value="Fri" id="fri">
                                                    <label for="fri" class="modern-weekend-label">Friday</label>
                                                </div>
                                                <div class="modern-weekend-option">
                                                    <input type="checkbox" name="weekend[]" value="Sat" id="sat">
                                                    <label for="sat" class="modern-weekend-label">Saturday</label>
                                                </div>
                                            </div>
                                            <div class="modern-help-text">
                                                <i class="fas fa-info-circle"></i>
                                                Select days that should be considered as weekends (non-working days)
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="modern-form-actions">
                                        <button type="submit" class="modern-btn modern-btn-primary">
                                            <i class="fas fa-save"></i>
                                            Create Configuration
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle person card selection
    const personCards = document.querySelectorAll('.modern-person-card');
    const personRadios = document.querySelectorAll('input[name="person_id"]');
    
    personCards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove selected class from all cards
            personCards.forEach(c => c.classList.remove('selected'));
            // Add selected class to clicked card
            this.classList.add('selected');
        });
    });
    
    // Update card selection when radio changes
    personRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            personCards.forEach(c => c.classList.remove('selected'));
            this.closest('.modern-person-card').classList.add('selected');
        });
    });
    
    // Form submission loading state
    document.getElementById('config-form').addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.classList.add('loading');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Configuration...';
        submitBtn.disabled = true;
    });
    
    // Add loading states to navigation buttons
    const navButtons = document.querySelectorAll('.modern-btn[href]');
    navButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.add('loading');
            const icon = this.querySelector('i');
            if (icon) {
                icon.className = 'fas fa-spinner fa-spin';
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/feature/appointmentdisabledate/create.blade.php ENDPATH**/ ?>