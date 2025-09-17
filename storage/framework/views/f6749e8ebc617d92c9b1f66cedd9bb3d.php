
<?php $__env->startSection('title', 'Create Blog Category'); ?>

<?php $__env->startSection('content'); ?>
<style>
/* Modern Blog Category Form Design */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --danger-color: #ef4444;
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

.modern-form-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.modern-form-card {
    background: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    border: 1px solid var(--border-color);
    overflow: hidden;
    max-width: 800px;
    margin: 0 auto;
}

.modern-form-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.modern-form-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.modern-form-title {
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

.modern-form-title i {
    font-size: 1.5rem;
    opacity: 0.9;
}

.modern-form-actions {
    position: relative;
    z-index: 2;
    margin-top: 1.5rem;
    display: flex;
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

.modern-btn-secondary {
    background: rgba(255, 255, 255, 0.15);
    color: var(--white);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.modern-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.25);
    color: var(--white);
    text-decoration: none;
    transform: translateY(-2px);
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

.modern-form-body {
    padding: 2.5rem;
}

.modern-form-group {
    margin-bottom: 2rem;
}

.modern-form-label {
    display: block;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.modern-form-label .required {
    color: var(--danger-color);
    margin-left: 0.25rem;
}

.modern-form-input {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    transition: var(--transition);
    background: var(--white);
    color: var(--text-dark);
}

.modern-form-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.1);
}

.modern-form-input::placeholder {
    color: var(--text-light);
}

.modern-select {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    transition: var(--transition);
    background: var(--white);
    color: var(--text-dark);
    cursor: pointer;
}

.modern-select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.1);
}

.modern-checkbox-container {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modern-checkbox {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.modern-checkbox input {
    opacity: 0;
    width: 0;
    height: 0;
}

.modern-checkbox-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #cbd5e0;
    transition: var(--transition);
    border-radius: 24px;
}

.modern-checkbox-slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: var(--transition);
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

input:checked + .modern-checkbox-slider {
    background: linear-gradient(135deg, var(--success-color), #059669);
}

input:checked + .modern-checkbox-slider:before {
    transform: translateX(26px);
}

.modern-checkbox-label {
    font-weight: 500;
    color: var(--text-dark);
    cursor: pointer;
}

.modern-error {
    color: var(--danger-color);
    font-size: 0.75rem;
    margin-top: 0.5rem;
    display: block;
}

.modern-form-footer {
    background: var(--bg-light);
    padding: 2rem;
    border-top: 1px solid var(--border-color);
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

.modern-help-text {
    font-size: 0.75rem;
    color: var(--text-light);
    margin-top: 0.5rem;
}

@media (max-width: 768px) {
    .modern-form-container {
        padding: 1rem;
    }
    
    .modern-form-header {
        padding: 1.5rem;
    }
    
    .modern-form-body {
        padding: 1.5rem;
    }
    
    .modern-form-footer {
        padding: 1.5rem;
        flex-direction: column;
    }
    
    .modern-form-actions {
        flex-direction: column;
    }
}
</style>

<!-- Main Content -->
<div class="main-content modern-form-container">
	<section class="section">
		<div class="section-body">
			<div class="server-error">
				<?php echo $__env->make('Elements.flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
			</div>
			<div class="custom-error-msg">
			</div>
			
			<div class="container-fluid">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10 col-xl-8">
						<div class="modern-form-card">
							<div class="modern-form-header">
								<h3 class="modern-form-title">
									<i class="fas fa-plus-circle"></i>
									Create Blog Category
								</h3>
								<div class="modern-form-actions">
									<a href="<?php echo e(route('admin.blogcategory.index')); ?>" class="modern-btn modern-btn-secondary">
										<i class="fas fa-arrow-left"></i>
										Back to Categories
									</a>
								</div>
							</div>
							
							<form action="admin/blogcategories/store" autocomplete="off" method="post" id="create-category-form">
								<?php echo csrf_field(); ?>
								<div class="modern-form-body">
									<div class="modern-form-group">
										<label for="name" class="modern-form-label">
											Category Name
											<span class="required">*</span>
										</label>
										<input name="name" type="text" class="modern-form-input" data-valid="required" autocomplete="off" placeholder="Enter category name (e.g., Technology, Business)" value="<?php echo e(old('name')); ?>">
										<?php if($errors->has('name')): ?>
											<span class="modern-error">
												<?php echo e($errors->first('name')); ?>

											</span> 
										<?php endif; ?>
										<div class="modern-help-text">
											Choose a descriptive name for your blog category
										</div>
									</div>

									<div class="modern-form-group">
										<label for="slug" class="modern-form-label">
											URL Slug
											<span class="required">*</span>
										</label>
										<input name="slug" type="text" class="modern-form-input" data-valid="required" autocomplete="off" placeholder="Enter URL slug (e.g., technology, business)" value="<?php echo e(old('slug')); ?>">
										<?php if($errors->has('slug')): ?>
											<span class="modern-error">
												<?php echo e($errors->first('slug')); ?>

											</span> 
										<?php endif; ?>
										<div class="modern-help-text">
											URL-friendly version of the name (lowercase, no spaces, use hyphens)
										</div>
									</div>

									<div class="modern-form-group">
										<label for="parent_id" class="modern-form-label">Parent Category</label>
										<select class="modern-select" name="parent_id">
											<option value="">- Select Parent Category (Optional) -</option>
											<?php if($categories): ?>
												<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($category->id); ?>" <?php echo e(old('parent_id') == $category->id ? 'selected' : ''); ?>>
														<?php echo e($category->name); ?>

													</option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>
										</select>
										<div class="modern-help-text">
											Leave empty for a root category, or select a parent to create a subcategory
										</div>
									</div>

									<div class="modern-form-group">
										<label for="status" class="modern-form-label">Category Status</label>
										<div class="modern-checkbox-container">
											<label class="modern-checkbox">
												<input value="1" type="checkbox" name="status" <?php echo e(old('status', '1') ? 'checked' : ''); ?> data-bootstrap-switch>
												<span class="modern-checkbox-slider"></span>
											</label>
											<span class="modern-checkbox-label">Active (visible on website)</span>
										</div>
										<div class="modern-help-text">
											Active categories will be visible to website visitors
										</div>
									</div>
								</div>

								<div class="modern-form-footer">
									<a href="<?php echo e(route('admin.blogcategory.index')); ?>" class="modern-btn modern-btn-secondary">
										<i class="fas fa-times"></i>
										Cancel
									</a>
									<button type="button" class="modern-btn modern-btn-primary" onClick="customValidate('add-blogcategory')">
										<i class="fas fa-save"></i>
										Create Category
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from name
    const nameInput = document.querySelector('input[name="name"]');
    const slugInput = document.querySelector('input[name="slug"]');
    
    if (nameInput && slugInput) {
        nameInput.addEventListener('input', function() {
            if (!slugInput.dataset.userModified) {
                const slug = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
                slugInput.value = slug;
            }
        });
        
        slugInput.addEventListener('input', function() {
            this.dataset.userModified = 'true';
        });
    }

    // Enhanced form validation
    const form = document.getElementById('create-category-form');
    const submitBtn = document.querySelector('.modern-btn-primary');
    
    if (form && submitBtn) {
        submitBtn.addEventListener('click', function(e) {
            this.classList.add('loading');
            const icon = this.querySelector('i');
            if (icon) {
                icon.className = 'fas fa-spinner fa-spin';
            }
        });
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/blogcategory/create.blade.php ENDPATH**/ ?>