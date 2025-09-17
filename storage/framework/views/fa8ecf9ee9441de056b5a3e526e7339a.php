
<?php $__env->startSection('title', 'Create Booking Block'); ?>

<?php $__env->startSection('content'); ?>
<style>
/* Modern Booking Block Create Design System */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --info-color: #06b6d4;
    --booking-color: #f59e0b;
    --booking-secondary: #d97706;
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
    background: linear-gradient(135deg, var(--booking-color) 0%, var(--booking-secondary) 100%);
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

.modern-btn-secondary {
    background: linear-gradient(135deg, var(--text-light) 0%, #475569 100%);
    color: var(--white);
}

.modern-btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(100, 116, 139, 0.3);
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
    color: var(--booking-color);
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
    border-color: var(--booking-color);
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    transform: translateY(-1px);
}

.modern-form-input:disabled {
    background: var(--bg-light);
    color: var(--text-light);
    cursor: not-allowed;
}

.modern-form-input[readonly] {
    background: var(--bg-light);
    border-color: var(--border-color);
    color: var(--text-dark);
    font-weight: 600;
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
    border-color: var(--booking-color);
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    transform: translateY(-1px);
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

.modern-person-display {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    padding: 1rem;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 2rem;
}

.modern-person-icon {
    width: 3rem;
    height: 3rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.modern-person-info h4 {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 600;
}

.modern-person-info p {
    margin: 0;
    font-size: 0.875rem;
    opacity: 0.9;
}

.modern-block-container {
    background: var(--bg-light);
    border: 2px dashed var(--border-color);
    border-radius: var(--border-radius-sm);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    transition: var(--transition);
}

.modern-block-container:hover {
    border-color: var(--booking-color);
    background: #fefce8;
}

.modern-block-item {
    background: var(--white);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    padding: 1.5rem;
    margin-bottom: 1rem;
    box-shadow: var(--shadow-sm);
    position: relative;
    transition: var(--transition);
}

.modern-block-item:hover {
    box-shadow: var(--shadow);
    transform: translateY(-1px);
}

.modern-block-item:last-child {
    margin-bottom: 0;
}

.modern-block-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--border-color);
}

.modern-block-title {
    color: var(--text-dark);
    font-size: 1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modern-block-number {
    background: var(--booking-color);
    color: var(--white);
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 700;
}

.modern-form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    align-items: start;
}

.modern-form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid var(--border-color);
}

.modern-form-actions-left {
    display: flex;
    gap: 1rem;
}

.modern-form-actions-right {
    display: flex;
    gap: 1rem;
}

.modern-add-block-btn {
    background: linear-gradient(135deg, var(--text-light), #475569);
    color: var(--white);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modern-add-block-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(100, 116, 139, 0.3);
}

.modern-time-toggle {
    position: absolute;
    top: 1rem;
    right: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--white);
    padding: 0.5rem;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
}

.modern-toggle-label {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-dark);
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
    
    .modern-form-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .modern-form-actions-left,
    .modern-form-actions-right {
        justify-content: center;
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

<div class="main-content modern-page-container">
    <section class="section">
        <div class="section-body">
            <div class="server-error">
                <?php echo $__env->make('Elements.flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="modern-card">
                            <div class="modern-card-header">
                                <h4 class="modern-card-title">
                                    <i class="fas fa-calendar-plus"></i>
                                    Create Booking Block
                                </h4>
                                <div class="modern-header-actions">
                                    <a href="<?php echo e(route('admin.feature.bookingblocks.index')); ?>" class="modern-btn modern-btn-back">
                                        <i class="fas fa-arrow-left"></i>
                                        Back to Blocks
                                    </a>
                                </div>
                            </div>
                            
                            <div class="modern-card-body">
                                <!-- Person Information -->
                                <div class="modern-person-display">
                                    <div class="modern-person-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="modern-person-info">
                                        <h4>Ajay</h4>
                                        <p>Creating booking blocks for this person</p>
                                    </div>
                                </div>

                                <form method="post" action="<?php echo e(route('admin.feature.bookingblocks.store')); ?>" id="booking-form">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="person_id" value="1">

                                    <!-- Blocks Container -->
                                    <div class="modern-form-section">
                                        <h3 class="modern-section-title">
                                            <i class="fas fa-calendar-times"></i>
                                            Booking Blocks
                                        </h3>
                                        
                                        <div class="modern-block-container" id="blocks_wrapper">
                                            <div class="modern-block-item block_item">
                                                <div class="modern-block-header">
                                                    <div class="modern-block-title">
                                                        <span class="modern-block-number">1</span>
                                                        Block Configuration
                                                    </div>
                                                    <div class="modern-time-toggle">
                                                        <span class="modern-toggle-label">Full Day:</span>
                                                        <select name="full_day[0]" class="modern-form-select full-day" style="width: auto; padding: 0.25rem 0.5rem; font-size: 0.75rem;">
                                                            <option value="0" selected>No</option>
                                                            <option value="1">Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="modern-form-row">
                                                    <div class="modern-form-group">
                                                        <label class="modern-form-label">
                                                            Date <span class="required">*</span>
                                                        </label>
                                                        <input type="text" class="modern-form-input" name="date[0]" placeholder="DD/MM/YYYY" required>
                                                        <div class="modern-help-text">
                                                            <i class="fas fa-info-circle"></i>
                                                            Enter date in DD/MM/YYYY format
                                                        </div>
                                                    </div>
                                                    <div class="modern-form-group time-range">
                                                        <label class="modern-form-label">Start Time</label>
                                                        <input type="time" class="modern-form-input" name="start_time[0]">
                                                        <div class="modern-help-text">
                                                            <i class="fas fa-clock"></i>
                                                            Block start time
                                                        </div>
                                                    </div>
                                                    <div class="modern-form-group time-range">
                                                        <label class="modern-form-label">End Time</label>
                                                        <input type="time" class="modern-form-input" name="end_time[0]">
                                                        <div class="modern-help-text">
                                                            <i class="fas fa-clock"></i>
                                                            Block end time
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="modern-form-actions">
                                        <div class="modern-form-actions-left">
                                            <button type="button" id="add_more_create" class="modern-add-block-btn">
                                                <i class="fas fa-plus"></i>
                                                Add Another Block
                                            </button>
                                        </div>
                                        <div class="modern-form-actions-right">
                                            <button class="modern-btn modern-btn-primary" type="submit">
                                                <i class="fas fa-save"></i>
                                                Save Booking Blocks
                                            </button>
                                        </div>
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
    let idx = 1;
    
    // Handle full day toggle
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('full-day')) {
            const isFull = e.target.value === '1';
            const row = e.target.closest('.block_item');
            const timeInputs = row.querySelectorAll('.time-range input');
            
            timeInputs.forEach(input => {
                input.disabled = isFull;
                if (isFull) {
                    input.value = '';
                }
            });
        }
    });
    
    // Add more blocks
    document.getElementById('add_more_create').addEventListener('click', function() {
        const firstBlock = document.querySelector('.block_item');
        const newBlock = firstBlock.cloneNode(true);
        
        // Update block number
        const blockNumber = newBlock.querySelector('.modern-block-number');
        blockNumber.textContent = idx + 1;
        
        // Update input names and reset values
        const inputs = newBlock.querySelectorAll('input, select');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                const newName = name.replace('[0]', '[' + idx + ']');
                input.setAttribute('name', newName);
                if (input.type !== 'hidden') {
                    input.value = '';
                }
            }
        });
        
        // Reset full day to "No"
        const fullDaySelect = newBlock.querySelector('.full-day');
        fullDaySelect.value = '0';
        
        // Enable time inputs
        const timeInputs = newBlock.querySelectorAll('.time-range input');
        timeInputs.forEach(input => {
            input.disabled = false;
        });
        
        document.getElementById('blocks_wrapper').appendChild(newBlock);
        idx++;
    });
    
    // Form submission loading state
    document.getElementById('booking-form').addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.classList.add('loading');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
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
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/feature/bookingblocks/create.blade.php ENDPATH**/ ?>