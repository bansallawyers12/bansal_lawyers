
<?php $__env->startSection('title', 'Edit CMS Page'); ?>

<?php $__env->startSection('content'); ?>
<style>
/* Modern CMS Page Edit Form Design */
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
    max-width: 1000px;
    margin: 0 auto;
}

.modern-form-header {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
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

.modern-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.modern-form-group {
    margin-bottom: 2rem;
}

.modern-form-group.full-width {
    grid-column: 1 / -1;
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
    border-color: var(--success-color);
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.modern-form-input::placeholder {
    color: var(--text-light);
}

.modern-textarea {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    transition: var(--transition);
    background: var(--white);
    color: var(--text-dark);
    resize: vertical;
    min-height: 120px;
}

.modern-textarea:focus {
    outline: none;
    border-color: var(--success-color);
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.modern-file-upload {
    position: relative;
    display: inline-block;
    width: 100%;
}

.modern-file-input {
    position: absolute;
    opacity: 0;
    width: 0.1px;
    height: 0.1px;
    z-index: -1;
}

.modern-file-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 1rem;
    border: 2px dashed var(--border-color);
    border-radius: var(--border-radius-sm);
    cursor: pointer;
    transition: var(--transition);
    background: var(--bg-light);
    color: var(--text-light);
    font-size: 0.875rem;
}

.modern-file-label:hover {
    border-color: var(--success-color);
    background: rgba(16, 185, 129, 0.05);
    color: var(--success-color);
}

.modern-file-icon {
    font-size: 1.25rem;
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

.modern-section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--border-color);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modern-editor-container {
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    overflow: hidden;
    transition: var(--transition);
}

.modern-editor-container:focus-within {
    border-color: var(--success-color);
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.modern-info-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.modern-media-preview {
    margin-top: 1rem;
    padding: 1rem;
    background: var(--bg-light);
    border-radius: var(--border-radius-sm);
    border: 1px solid var(--border-color);
}

.modern-media-preview img {
    max-width: 150px;
    max-height: 150px;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow-sm);
}

.modern-media-preview a {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
}

.modern-media-preview a:hover {
    color: var(--secondary-color);
    text-decoration: underline;
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
    
    .modern-form-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
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
					<div class="col-12">
						<div class="modern-form-card">
							<div class="modern-form-header">
								<h3 class="modern-form-title">
									<i class="fas fa-edit"></i>
									Edit CMS Page
								</h3>
								<div class="modern-form-actions">
									<a href="<?php echo e(route('admin.cms_pages.index')); ?>" class="modern-btn modern-btn-secondary">
										<i class="fas fa-arrow-left"></i>
										Back to Pages
									</a>
								</div>
							</div>
							
							<form action="<?php echo e(route('admin.edit_cms_page')); ?>" autocomplete="off" method="post" enctype="multipart/form-data" name="edit-template" id="edit-template">
								<?php echo csrf_field(); ?>
								<input type="hidden" name="id" value="<?php echo e($fetchedData->id ?? ''); ?>">
								
								<div class="modern-form-body">
									<div class="modern-info-badge">
										<i class="fas fa-info-circle"></i>
										Editing Page ID: #<?php echo e($fetchedData->id ?? ''); ?>

									</div>

									<!-- Basic Information Section -->
									<div class="modern-section-title">
										<i class="fas fa-edit"></i>
										Basic Information
									</div>
									
									<div class="modern-form-grid">
										<div class="modern-form-group">
											<label for="title" class="modern-form-label">
												Page Title
												<span class="required">*</span>
											</label>
											<input name="title" type="text" class="modern-form-input" data-valid="required" autocomplete="off" placeholder="Enter page title" value="<?php echo e(old('title', $fetchedData->title ?? '')); ?>">
											<?php if($errors->has('title')): ?>
												<span class="modern-error">
													<?php echo e($errors->first('title')); ?>

												</span>
											<?php endif; ?>
											<div class="modern-help-text">
												Update the title of your CMS page
											</div>
										</div>

										<div class="modern-form-group">
											<label for="slug" class="modern-form-label">
												URL Slug
												<span class="required">*</span>
											</label>
											<input name="slug" type="text" class="modern-form-input" data-valid="required" autocomplete="off" placeholder="Enter URL slug" value="<?php echo e(old('slug', $fetchedData->slug ?? '')); ?>">
											<?php if($errors->has('slug')): ?>
												<span class="modern-error">
													<?php echo e($errors->first('slug')); ?>

												</span>
											<?php endif; ?>
											<div class="modern-help-text">
												URL-friendly version of the title
											</div>
										</div>

										<div class="modern-form-group">
											<label for="image" class="modern-form-label">Featured Image</label>
											<div class="modern-file-upload">
												<input type="hidden" name="old_image" value="<?php echo e($fetchedData->image ?? ''); ?>">
												<input type="file" name="image" class="modern-file-input" id="image" accept="image/*">
												<label for="image" class="modern-file-label">
													<i class="fas fa-cloud-upload-alt modern-file-icon"></i>
													<span>Choose new featured image</span>
												</label>
											</div>
											<?php if($errors->has('image')): ?>
												<span class="modern-error">
													<?php echo e($errors->first('image')); ?>

												</span>
											<?php endif; ?>
											
											<?php if(!empty($fetchedData->image) && file_exists(public_path('img/cmspage/' . $fetchedData->image))): ?>
												<div class="modern-media-preview">
													<strong>Current Image:</strong><br>
													<img src="<?php echo e(asset('images/cmspage/' . $fetchedData->image)); ?>" alt="<?php echo e($fetchedData->title ?? ''); ?>" class="img-avatar">
												</div>
											<?php endif; ?>
											
											<div class="modern-help-text">
												Upload a new featured image (leave empty to keep current)
											</div>
										</div>

										<div class="modern-form-group">
											<label for="image_alt" class="modern-form-label">Image Alt Text</label>
											<input name="image_alt" type="text" class="modern-form-input" autocomplete="off" placeholder="Describe the image for accessibility" value="<?php echo e(old('image_alt', $fetchedData->image_alt ?? '')); ?>">
											<?php if($errors->has('image_alt')): ?>
												<span class="modern-error">
													<?php echo e($errors->first('image_alt')); ?>

												</span>
											<?php endif; ?>
											<div class="modern-help-text">
												Alt text for accessibility and SEO
											</div>
										</div>
									</div>

									<!-- Content Section -->
									<div class="modern-section-title">
										<i class="fas fa-align-left"></i>
										Page Content
									</div>

									<div class="modern-form-group full-width">
										<label for="description" class="modern-form-label">
											Content
											<span class="required">*</span>
										</label>
										<div class="modern-editor-container">
											<textarea class="modern-textarea" id="description" placeholder="Write your page content here..." rows="10" name="description" data-valid="required"><?php echo old('description', $fetchedData->content ?? ''); ?></textarea>
										</div>
										<?php if($errors->has('description')): ?>
											<span class="modern-error">
												<?php echo e($errors->first('description')); ?>

											</span>
										<?php endif; ?>
										<div class="modern-help-text">
											The main content of your CMS page (rich text editor)
										</div>
									</div>

									<!-- Media Section -->
									<div class="modern-section-title">
										<i class="fas fa-video"></i>
										Media & Files
									</div>

									<div class="modern-form-grid">
										<div class="modern-form-group">
											<label for="youtube_url" class="modern-form-label">YouTube Video URL</label>
											<input name="youtube_url" type="url" class="modern-form-input" autocomplete="off" placeholder="https://www.youtube.com/watch?v=..." value="<?php echo e(old('youtube_url', $fetchedData->youtube_url ?? '')); ?>">
											<?php if($errors->has('youtube_url')): ?>
												<span class="modern-error">
													<?php echo e($errors->first('youtube_url')); ?>

												</span>
											<?php endif; ?>
											<div class="modern-help-text">
												Embed a YouTube video in your page
											</div>
										</div>

										<div class="modern-form-group">
											<label for="pdf_doc" class="modern-form-label">PDF/Video File</label>
											<div class="modern-file-upload">
												<input type="hidden" name="old_pdf" value="<?php echo e($fetchedData->pdf_doc ?? ''); ?>">
												<input type="file" id="pdf_doc" name="pdf_doc" class="modern-file-input" accept=".pdf,video/*">
												<label for="pdf_doc" class="modern-file-label">
													<i class="fas fa-file-upload modern-file-icon"></i>
													<span>Choose new PDF or video file</span>
												</label>
											</div>
											<?php if($errors->has('pdf_doc')): ?>
												<span class="modern-error">
													<?php echo e($errors->first('pdf_doc')); ?>

												</span>
											<?php endif; ?>
											
											<?php if(!empty($fetchedData->pdf_doc)): ?>
												<div class="modern-media-preview">
													<strong>Current File:</strong><br>
													<a href="<?php echo e(asset('images/cmspage/' . $fetchedData->pdf_doc)); ?>" target="_blank">
														<i class="fas fa-external-link-alt"></i>
														Open PDF/Video File
													</a>
												</div>
											<?php endif; ?>
											
											<div class="modern-help-text">
												Upload additional PDF or video files (leave empty to keep current)
											</div>
										</div>
									</div>

									<!-- SEO Section -->
									<div class="modern-section-title">
										<i class="fas fa-search"></i>
										SEO Settings
									</div>

									<div class="modern-form-grid">
										<div class="modern-form-group">
											<label for="meta_title" class="modern-form-label">Meta Title</label>
											<input name="meta_title" type="text" class="modern-form-input" autocomplete="off" placeholder="SEO title for search engines" value="<?php echo e(old('meta_title', $fetchedData->meta_title ?? '')); ?>">
											<?php if($errors->has('meta_title')): ?>
												<span class="modern-error">
													<?php echo e($errors->first('meta_title')); ?>

												</span>
											<?php endif; ?>
											<div class="modern-help-text">
												Title that appears in search engine results
											</div>
										</div>

										<div class="modern-form-group">
											<label for="meta_keyward" class="modern-form-label">Meta Keywords</label>
											<input name="meta_keyward" type="text" class="modern-form-input" autocomplete="off" placeholder="keyword1, keyword2, keyword3" value="<?php echo e(old('meta_keyward', $fetchedData->meta_keyward ?? '')); ?>">
											<?php if($errors->has('meta_keyward')): ?>
												<span class="modern-error">
													<?php echo e($errors->first('meta_keyward')); ?>

												</span>
											<?php endif; ?>
											<div class="modern-help-text">
												Comma-separated keywords for SEO
											</div>
										</div>

										<div class="modern-form-group full-width">
											<label for="meta_description" class="modern-form-label">Meta Description</label>
											<textarea name="meta_description" class="modern-textarea" placeholder="Brief description for search engines (150-160 characters)" rows="3"><?php echo e(old('meta_description', $fetchedData->meta_description ?? '')); ?></textarea>
											<?php if($errors->has('meta_description')): ?>
												<span class="modern-error">
													<?php echo e($errors->first('meta_description')); ?>

												</span>
											<?php endif; ?>
											<div class="modern-help-text">
												Description that appears in search engine results
											</div>
										</div>
									</div>

									<!-- Status Section -->
									<div class="modern-section-title">
										<i class="fas fa-toggle-on"></i>
										Page Status
									</div>

									<div class="modern-form-group">
										<label for="status" class="modern-form-label">Publication Status</label>
										<div class="modern-checkbox-container">
											<label class="modern-checkbox">
												<input value="1" type="checkbox" name="status" <?php echo e((old('status', $fetchedData->status ?? 0) == 1 ? 'checked' : '')); ?> data-bootstrap-switch>
												<span class="modern-checkbox-slider"></span>
											</label>
											<span class="modern-checkbox-label">Published (visible on website)</span>
										</div>
										<div class="modern-help-text">
											Published pages will be visible to website visitors
										</div>
									</div>
								</div>

								<div class="modern-form-footer">
									<a href="<?php echo e(route('admin.cms_pages.index')); ?>" class="modern-btn modern-btn-secondary">
										<i class="fas fa-times"></i>
										Cancel
									</a>
									<button type="button" class="modern-btn modern-btn-primary" onClick="customValidate('edit-template')">
										<i class="fas fa-save"></i>
										Update Page
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
    // Auto-generate slug from title (but allow user to override)
    const titleInput = document.querySelector('input[name="title"]');
    const slugInput = document.querySelector('input[name="slug"]');
    
    if (titleInput && slugInput) {
        titleInput.addEventListener('input', function() {
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

    // Enhanced file upload labels
    const fileInputs = document.querySelectorAll('.modern-file-input');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const label = this.nextElementSibling;
            const fileName = this.files[0]?.name;
            if (fileName) {
                label.querySelector('span').textContent = fileName;
                label.style.borderColor = 'var(--success-color)';
                label.style.color = 'var(--success-color)';
            }
        });
    });

    // Enhanced form validation
    const form = document.getElementById('edit-template');
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

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/ckfinder/ckfinder.js')); ?>" type="text/javascript"></script>
<script>
var sharedCKEditorToolbarConfig = {
    toolbar: [
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'insert', items: [  'Table', 'HorizontalRule',   'SpecialChar', 'PageBreak' ] },
        '/',
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor', 'EmojiPanel' ] },
        { name: 'document', items: [ 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] },
        { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' , 'Source' ] },
    ],
    extraPlugins: 'textwatcher,textmatch,autocomplete,emoji'
};

// Wait for DOM to be ready before initializing CKEditor
$(document).ready(function() {
    // Check if CKEditor is loaded and description element exists
    if (typeof CKEDITOR !== 'undefined') {
        var descriptionElement = document.getElementById('description');
        if (descriptionElement) {
            var editor = CKEDITOR.replace('description', sharedCKEditorToolbarConfig);
            CKFinder.setupCKEditor(editor);
        } else {
            console.warn('Description element not found for CKEditor initialization');
        }
    } else {
        console.warn('CKEditor library not loaded');
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/cms_page/edit.blade.php ENDPATH**/ ?>