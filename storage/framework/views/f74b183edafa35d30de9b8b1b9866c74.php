
<?php $__env->startSection('title', 'CMS Pages'); ?>

<?php $__env->startSection('content'); ?>
<style>
/* Modern CMS Pages Design System */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --warning-color: #f59e0b;
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
}

.modern-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-2px);
}

.modern-card-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
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
    justify-content: space-between;
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

.modern-btn-success {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    color: var(--white);
}

.modern-btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    color: var(--white);
    text-decoration: none;
}

.modern-btn-danger {
    background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
    color: var(--white);
}

.modern-btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
    color: var(--white);
    text-decoration: none;
}

.modern-btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.8rem;
}

.modern-search-form {
    display: flex;
    gap: 0.5rem;
    align-items: stretch;
    max-width: 300px;
}

.modern-search-input {
    flex: 1;
    padding: 0.75rem 1rem;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: var(--border-radius-sm);
    background: rgba(255, 255, 255, 0.15);
    color: var(--white);
    font-size: 0.875rem;
    backdrop-filter: blur(10px);
}

.modern-search-input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.modern-search-input:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.5);
}

.modern-search-btn {
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: var(--white);
    padding: 0.75rem 1rem;
    border-radius: var(--border-radius-sm);
    cursor: pointer;
    transition: var(--transition);
}

.modern-search-btn:hover {
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.5);
}

.modern-card-body {
    padding: 2rem;
}

.modern-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.modern-stat-card {
    background: var(--white);
    border-radius: var(--border-radius-sm);
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
    transition: var(--transition);
}

.modern-stat-card:hover {
    box-shadow: var(--shadow);
    transform: translateY(-1px);
}

.modern-stat-icon {
    width: 3rem;
    height: 3rem;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: var(--white);
    margin-bottom: 1rem;
}

.modern-stat-icon.pages {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
}

.modern-stat-icon.published {
    background: linear-gradient(135deg, var(--success-color), #059669);
}

.modern-stat-icon.draft {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
}

.modern-stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.25rem;
}

.modern-stat-label {
    color: var(--text-light);
    font-size: 0.875rem;
    font-weight: 500;
}

.modern-table-container {
    background: var(--white);
    border-radius: var(--border-radius-sm);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.modern-table th {
    background: var(--bg-light);
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: var(--text-dark);
    border-bottom: 2px solid var(--border-color);
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.modern-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--border-color);
    color: var(--text-dark);
    vertical-align: middle;
}

.modern-table tbody tr {
    transition: var(--transition);
}

.modern-table tbody tr:hover {
    background: #f8fafc;
}

.modern-table tbody tr:last-child td {
    border-bottom: none;
}

.modern-page-image {
    width: 60px;
    height: 60px;
    border-radius: var(--border-radius-sm);
    object-fit: cover;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
}

.modern-page-image:hover {
    transform: scale(1.05);
    box-shadow: var(--shadow);
}

.modern-page-title {
    font-weight: 600;
    color: var(--text-dark);
    line-height: 1.4;
}

.modern-page-slug {
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
    background: var(--bg-light);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    color: var(--text-light);
}

.modern-page-id {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    border-radius: 50%;
    font-size: 0.75rem;
    font-weight: 600;
}

.modern-status-toggle {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.modern-status-toggle input {
    opacity: 0;
    width: 0;
    height: 0;
}

.modern-status-slider {
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

.modern-status-slider:before {
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

input:checked + .modern-status-slider {
    background: linear-gradient(135deg, var(--success-color), #059669);
}

input:checked + .modern-status-slider:before {
    transform: translateX(26px);
}

.modern-actions {
    display: flex;
    gap: 0.5rem;
}

.modern-empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--text-light);
}

.modern-empty-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.modern-empty-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--text-dark);
}

.modern-empty-description {
    font-size: 1rem;
    margin-bottom: 2rem;
}

.modern-pagination {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

/* Modern Pagination Styling */
.modern-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 2rem;
}

.modern-pagination .pagination {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    list-style: none;
    padding: 0;
}

.modern-pagination .page-item {
    display: inline-block;
}

.modern-pagination .page-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 2.5rem;
    height: 2.5rem;
    padding: 0.5rem 0.75rem;
    border: 2px solid var(--border-color);
    color: var(--text-dark);
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    font-size: 0.875rem;
    transition: var(--transition);
    text-decoration: none;
    background: var(--white);
    box-shadow: var(--shadow-sm);
}

.modern-pagination .page-link:hover {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(27, 77, 137, 0.3);
    text-decoration: none;
}

.modern-pagination .page-item.active .page-link {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-color: var(--primary-color);
    color: var(--white);
    box-shadow: 0 4px 12px rgba(27, 77, 137, 0.3);
}

.modern-pagination .page-item.disabled .page-link {
    background: var(--bg-light);
    border-color: var(--border-color);
    color: var(--text-light);
    cursor: not-allowed;
    box-shadow: none;
}

.modern-pagination .page-item.disabled .page-link:hover {
    background: var(--bg-light);
    border-color: var(--border-color);
    color: var(--text-light);
    transform: none;
    box-shadow: none;
}

/* Previous/Next button styling */
.modern-pagination .page-link[rel="prev"],
.modern-pagination .page-link[rel="next"] {
    padding: 0.5rem 1rem;
    font-weight: 700;
}

/* Ellipsis styling */
.modern-pagination .page-item .page-link[aria-disabled="true"] {
    background: transparent;
    border: none;
    color: var(--text-light);
    cursor: default;
    box-shadow: none;
}

.modern-pagination .page-item .page-link[aria-disabled="true"]:hover {
    background: transparent;
    border: none;
    color: var(--text-light);
    transform: none;
    box-shadow: none;
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
    
    .modern-stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .modern-table-container {
        overflow-x: auto;
    }
    
    .modern-actions {
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .modern-btn {
        justify-content: center;
    }
    
    .modern-header-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .modern-search-form {
        max-width: none;
    }
    
    .modern-pagination .pagination {
        gap: 0.25rem;
    }
    
    .modern-pagination .page-link {
        min-width: 2rem;
        height: 2rem;
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
    }
    
    .modern-pagination .page-link[rel="prev"],
    .modern-pagination .page-link[rel="next"] {
        padding: 0.25rem 0.75rem;
    }
}

/* Animation for loading states */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.loading {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
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
			<div class="row">
					<div class="col-12">
						<div class="modern-card">
							<div class="modern-card-header">
								<h4 class="modern-card-title">
									<i class="fas fa-file-code"></i>
									CMS Pages Management
								</h4>
								<div class="modern-header-actions">
									<a href="<?php echo e(route('admin.cms_pages.create')); ?>" class="modern-btn modern-btn-primary">
										<i class="fas fa-plus"></i>
										Create New Page
									</a>
									<form action="<?php echo e(route('admin.cms_pages.index')); ?>" method="get" class="modern-search-form">
										<input type="text" name="search_term" class="modern-search-input" value="<?php echo e(request('search_term')); ?>" placeholder="Search pages...">
										<button type="submit" class="modern-search-btn">
											<i class="fas fa-search"></i>
										</button>
									</form>
						</div>
                    </div> 
							
							<div class="modern-card-body">
								<!-- Statistics Cards -->
								<div class="modern-stats-grid">
									<div class="modern-stat-card">
										<div class="modern-stat-icon pages">
											<i class="fas fa-file-code"></i>
                </div>
										<div class="modern-stat-value"><?php echo e(count($lists)); ?></div>
										<div class="modern-stat-label">Total Pages</div>
                                </div> 
									<div class="modern-stat-card">
										<div class="modern-stat-icon published">
											<i class="fas fa-check-circle"></i>
                            </div>
										<div class="modern-stat-value"><?php echo e($lists->where('status', 1)->count()); ?></div>
										<div class="modern-stat-label">Published Pages</div>
                                            </div>
									<div class="modern-stat-card">
										<div class="modern-stat-icon draft">
											<i class="fas fa-pause-circle"></i>
                                        </div>
										<div class="modern-stat-value"><?php echo e($lists->where('status', 0)->count()); ?></div>
										<div class="modern-stat-label">Draft Pages</div>
                                </div>
                            </div>

								<!-- Table -->
								<?php if(count($lists) > 0): ?>
								<div class="modern-table-container">
									<table class="modern-table">
							  <thead>
								<tr>
												<th>ID</th>
												<th>Featured Image</th>
												<th>Page Title</th>
								  <th>Slug</th>
                                  <th>Status</th>
												<th>Actions</th>
								</tr> 
							  </thead>
										<tbody>
								<?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
								<tr id="id_<?php echo e($list->id); ?>"> 
												<td>
													<span class="modern-page-id"><?php echo e(++$i); ?></span>
												</td>
												<td>
									<?php if(isset($list->image) && $list->image != "" && file_exists(public_path('img/cmspage/' . $list->image))): ?>
														<img src="<?php echo e(asset('images/cmspage/' . $list->image)); ?>" alt="<?php echo e($list->title); ?>" class="modern-page-image">
									<?php else: ?>
														<img src="<?php echo e(asset('images/avatars/no_image.jpeg')); ?>" alt="No Image" class="modern-page-image">
									<?php endif; ?>
								  </td>
												<td>
													<div class="modern-page-title">
														<?php echo e($list->title == "" ? config('constants.empty') : \Illuminate\Support\Str::limit($list->title, '50', '...')); ?>

													</div>
												</td>
												<td>
													<code class="modern-page-slug"><?php echo e($list->slug); ?></code>
												</td>
												<td>
													<label class="modern-status-toggle">
														<input data-id="<?php echo e($list->id); ?>" data-status="<?php echo e($list->status); ?>" data-col="status" data-table="cms_pages" class="change-status" value="1" type="checkbox" name="status" <?php echo e(($list->status == 1 ? 'checked' : '')); ?> data-bootstrap-switch>
														<span class="modern-status-slider"></span>
													</label>
												</td>
												<td>
													<div class="modern-actions">
														<a class="modern-btn modern-btn-success modern-btn-sm" href="<?php echo e(URL::to('/admin/cms_pages/edit/'.base64_encode(convert_uuencode($list->id)))); ?>">
															<i class="fas fa-edit"></i>
															Edit
														</a>
														<a class="modern-btn modern-btn-danger modern-btn-sm" href="javascript:;" onClick="deleteAction(<?php echo e($list->id); ?>, 'cms_pages')">
															<i class="fas fa-trash"></i>
															Delete
														</a>
													</div>
								  </td>
								</tr>	
							  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
										</tbody>
									</table>
								</div>
								
								<!-- Pagination -->
								<?php if($lists->hasPages()): ?>
								<div class="modern-pagination">
							<?php echo $lists->appends(\Request::except('page'))->render(); ?>

								</div>
								<?php endif; ?>
								<?php else: ?>
								<div class="modern-empty-state">
									<div class="modern-empty-icon">
										<i class="fas fa-file-code"></i>
									</div>
									<h3 class="modern-empty-title">No CMS Pages Found</h3>
									<p class="modern-empty-description">Get started by creating your first CMS page</p>
									<a href="<?php echo e(route('admin.cms_pages.create')); ?>" class="modern-btn modern-btn-primary">
										<i class="fas fa-plus"></i>
										Create First Page
									</a>
								</div>
								<?php endif; ?>
							 </div>
						  </div>
					</div>	
				</div>
			</div>
		</div>
	</section>
</div>

<script>
// Enhanced status toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth transitions to status toggles
    const statusToggles = document.querySelectorAll('.modern-status-toggle input');
    statusToggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const slider = this.nextElementSibling;
            slider.style.transform = 'scale(0.95)';
            setTimeout(() => {
                slider.style.transform = 'scale(1)';
            }, 100);
        });
    });

    // Add loading states to action buttons
    const actionButtons = document.querySelectorAll('.modern-btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (this.href && !this.href.includes('javascript:')) {
                this.classList.add('loading');
                const icon = this.querySelector('i');
                if (icon) {
                    icon.className = 'fas fa-spinner fa-spin';
                }
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/cms_page/index.blade.php ENDPATH**/ ?>