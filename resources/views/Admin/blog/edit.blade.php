@extends('layouts.admin')
@section('title', 'Edit Blog Post')

@section('content')
<style>
/* Modern Blog Edit Form Design */
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
    border-color: var(--success-color);
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
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

.modern-media-preview iframe {
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
				@include('Elements.flash-message')
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
									Edit Blog Post
								</h3>
								<div class="modern-form-actions">
									<a href="{{route('admin.blog.index')}}" class="modern-btn modern-btn-secondary">
										<i class="fas fa-arrow-left"></i>
										Back to Posts
									</a>
								</div>
							</div>
							
							<form action="admin/blog/edit" autocomplete="off" method="post" enctype="multipart/form-data" id="edit-blog-form">
								@csrf
								<input type="hidden" name="id" value="{{ $fetchedData->id }}">
								
								<div class="modern-form-body">
									<div class="modern-info-badge">
										<i class="fas fa-info-circle"></i>
										Editing Blog Post ID: #{{ $fetchedData->id }}
									</div>

									<!-- Basic Information Section -->
									<div class="modern-section-title">
										<i class="fas fa-edit"></i>
										Basic Information
									</div>
									
									<div class="modern-form-grid">
										<div class="modern-form-group">
											<label for="title" class="modern-form-label">
												Post Title
												<span class="required">*</span>
											</label>
											<input name="title" type="text" class="modern-form-input" data-valid="required" autocomplete="off" placeholder="Enter blog post title" value="{{ old('title', $fetchedData->title) }}">
											@if ($errors->has('title'))
												<span class="modern-error">
													{{ $errors->first('title') }}
												</span>
											@endif
											<div class="modern-help-text">
												Update the title of your blog post
											</div>
										</div>

										<div class="modern-form-group">
											<label for="slug" class="modern-form-label">
												URL Slug
												<span class="required">*</span>
											</label>
											<input name="slug" type="text" class="modern-form-input" data-valid="required" autocomplete="off" placeholder="Enter URL slug" value="{{ old('slug', $fetchedData->slug) }}">
											@if ($errors->has('slug'))
												<span class="modern-error">
													{{ $errors->first('slug') }}
												</span>
											@endif
											<div class="modern-help-text">
												URL-friendly version of the title
											</div>
										</div>

										<div class="modern-form-group">
											<label for="parent_category" class="modern-form-label">
												Category
												<span class="required">*</span>
											</label>
											<select class="modern-select" name="parent_category" data-valid="required">
												<option value="">- Select Category -</option>
												@if($categories)
													@foreach($categories as $category)
														<option value="{{$category->id}}" {{ old('parent_category', $fetchedData->parent_category) == $category->id ? 'selected' : '' }}>
															{{$category->name}}
														</option>
														@if(count($category->subcategory))
															@include('Admin.blogcategory.subCategoryList-option',['subcategories' => $category->subcategory])
														@endif
													@endforeach
												@endif
											</select>
											@if ($errors->has('parent_category'))
												<span class="modern-error">
													{{ $errors->first('parent_category') }}
												</span>
											@endif
											<div class="modern-help-text">
												Select the category for this blog post
											</div>
										</div>

										<div class="modern-form-group">
											<label for="status" class="modern-form-label">Post Status</label>
											<div class="modern-checkbox-container">
												<label class="modern-checkbox">
													<input value="1" type="checkbox" name="status" {{ old('status', $fetchedData->status) == 1 ? 'checked' : '' }} data-bootstrap-switch>
													<span class="modern-checkbox-slider"></span>
												</label>
												<span class="modern-checkbox-label">Published (visible on website)</span>
											</div>
											<div class="modern-help-text">
												Published posts will be visible to website visitors
											</div>
										</div>
									</div>

									<!-- Content Section -->
									<div class="modern-section-title">
										<i class="fas fa-align-left"></i>
										Content
									</div>

									<div class="modern-form-group full-width">
										<label for="short_description" class="modern-form-label">Short Description</label>
										<input name="short_description" type="text" class="modern-form-input" autocomplete="off" placeholder="Enter a brief description or excerpt" value="{{ old('short_description', $fetchedData->short_description) }}">
										@if ($errors->has('short_description'))
											<span class="modern-error">
												{{ $errors->first('short_description') }}
											</span>
										@endif
										<div class="modern-help-text">
											A brief summary that appears in blog listings and previews
										</div>
									</div>

									<div class="modern-form-group full-width">
										<label for="description" class="modern-form-label">
											Content
											<span class="required">*</span>
										</label>
										<div class="modern-editor-container">
											<textarea class="modern-textarea" id="description" placeholder="Write your blog post content here..." rows="10" name="description" data-valid="required">{{ old('description', $fetchedData->description) }}</textarea>
										</div>
										@if ($errors->has('description'))
											<span class="modern-error">
												{{ $errors->first('description') }}
											</span>
										@endif
										<div class="modern-help-text">
											The main content of your blog post (rich text editor)
										</div>
									</div>

									<!-- Media Section -->
									<div class="modern-section-title">
										<i class="fas fa-image"></i>
										Media & Files
									</div>

									<div class="modern-form-grid">
										<div class="modern-form-group">
											<label for="image" class="modern-form-label">Featured Image/Video</label>
											<div class="modern-file-upload">
												<input type="hidden" name="old_image" value="{{ $fetchedData->image }}">
												<input type="file" id="image" name="image" class="modern-file-input" accept="image/*,video/*">
												<label for="image" class="modern-file-label">
													<i class="fas fa-cloud-upload-alt modern-file-icon"></i>
													<span>Choose new featured image or video</span>
												</label>
											</div>
											@if ($errors->has('image'))
												<span class="modern-error">
													{{ $errors->first('image') }}
												</span>
											@endif
											
											@if(isset($fetchedData->image) && $fetchedData->image != "")
												<div class="modern-media-preview">
													<strong>Current Media:</strong><br>
													@php
														$extension = pathinfo($fetchedData->image, PATHINFO_EXTENSION);
													@endphp
													
													@if(strtolower($extension) == 'mp4')
														<iframe width="200" height="100" src="{{ asset('images/blog/' . $fetchedData->image) }}?autoplay=1&mute=1"></iframe>
													@elseif(strtolower($extension) == 'pdf')
														<a href="{{ asset('images/blog/' . $fetchedData->image) }}" target="_blank">
															<i class="fas fa-file-pdf"></i>
															View PDF Document
														</a>
													@else
														<img src="{{ asset('images/blog/' . $fetchedData->image) }}" alt="{{ $fetchedData->title }}">
													@endif
												</div>
											@endif
											
											<div class="modern-help-text">
												Upload a new featured image or video (leave empty to keep current)
											</div>
										</div>

										<div class="modern-form-group">
											<label for="image_alt" class="modern-form-label">Image Alt Text</label>
											<input name="image_alt" type="text" class="modern-form-input" autocomplete="off" placeholder="Describe the image for accessibility" value="{{ old('image_alt', $fetchedData->image_alt) }}">
											@if ($errors->has('image_alt'))
												<span class="modern-error">
													{{ $errors->first('image_alt') }}
												</span>
											@endif
											<div class="modern-help-text">
												Alt text for accessibility and SEO
											</div>
										</div>

										<div class="modern-form-group">
											<label for="youtube_url" class="modern-form-label">YouTube Video URL</label>
											<input name="youtube_url" type="url" class="modern-form-input" autocomplete="off" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('youtube_url', $fetchedData->youtube_url) }}">
											@if ($errors->has('youtube_url'))
												<span class="modern-error">
													{{ $errors->first('youtube_url') }}
												</span>
											@endif
											<div class="modern-help-text">
												Embed a YouTube video in your blog post
											</div>
										</div>

										<div class="modern-form-group">
											<label for="pdf_doc" class="modern-form-label">PDF/Video File</label>
											<div class="modern-file-upload">
												<input type="hidden" name="old_pdf" value="{{ $fetchedData->pdf_doc }}">
												<input type="file" id="pdf_doc" name="pdf_doc" class="modern-file-input" accept=".pdf,video/*">
												<label for="pdf_doc" class="modern-file-label">
													<i class="fas fa-file-upload modern-file-icon"></i>
													<span>Choose new PDF or video file</span>
												</label>
											</div>
											@if ($errors->has('pdf_doc'))
												<span class="modern-error">
													{{ $errors->first('pdf_doc') }}
												</span>
											@endif
											
											@if($fetchedData->pdf_doc != '')
												<div class="modern-media-preview">
													<strong>Current File:</strong><br>
													<a href="{{ asset('images/blog/' . $fetchedData->pdf_doc) }}" target="_blank">
														<i class="fas fa-external-link-alt"></i>
														Open PDF/Video File
													</a>
												</div>
											@endif
											
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
											<input name="meta_title" type="text" class="modern-form-input" autocomplete="off" placeholder="SEO title for search engines" value="{{ old('meta_title', $fetchedData->meta_title) }}">
											@if ($errors->has('meta_title'))
												<span class="modern-error">
													{{ $errors->first('meta_title') }}
												</span>
											@endif
											<div class="modern-help-text">
												Title that appears in search engine results
											</div>
										</div>

										<div class="modern-form-group">
											<label for="meta_keyword" class="modern-form-label">Meta Keywords</label>
											<input name="meta_keyword" type="text" class="modern-form-input" autocomplete="off" placeholder="keyword1, keyword2, keyword3" value="{{ old('meta_keyword', $fetchedData->meta_keyword) }}">
											@if ($errors->has('meta_keyword'))
												<span class="modern-error">
													{{ $errors->first('meta_keyword') }}
												</span>
											@endif
											<div class="modern-help-text">
												Comma-separated keywords for SEO
											</div>
										</div>

										<div class="modern-form-group full-width">
											<label for="meta_description" class="modern-form-label">Meta Description</label>
											<textarea name="meta_description" class="modern-textarea" placeholder="Brief description for search engines (150-160 characters)" rows="3">{{ old('meta_description', $fetchedData->meta_description) }}</textarea>
											@if ($errors->has('meta_description'))
												<span class="modern-error">
													{{ $errors->first('meta_description') }}
												</span>
											@endif
											<div class="modern-help-text">
												Description that appears in search engine results
											</div>
										</div>
									</div>
								</div>

								<div class="modern-form-footer">
									<a href="{{route('admin.blog.index')}}" class="modern-btn modern-btn-secondary">
										<i class="fas fa-times"></i>
										Cancel
									</a>
									<button type="button" class="modern-btn modern-btn-primary" onClick="customValidate('edit-blog')">
										<i class="fas fa-save"></i>
										Update Blog Post
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
    const form = document.getElementById('edit-blog-form');
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
@endsection

@section('scripts')
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/ckfinder/ckfinder.js') }}" type="text/javascript"></script>
<script>
    // Initialize CKEditor
    var description = CKEDITOR.replace('description');
    CKFinder.setupCKEditor(description);
</script>
@endsection