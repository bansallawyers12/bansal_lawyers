@extends('layouts.admin')
@section('title', 'Blog Posts')

@section('content')
<style>
/* Modern Blog Posts Design System */
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

.modern-stat-icon.posts {
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

.modern-blog-image {
    width: 60px;
    height: 60px;
    border-radius: var(--border-radius-sm);
    object-fit: cover;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
}

.modern-blog-image:hover {
    transform: scale(1.05);
    box-shadow: var(--shadow);
}

.modern-blog-title {
    font-weight: 600;
    color: var(--text-dark);
    line-height: 1.4;
}

.modern-blog-slug {
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
    background: var(--bg-light);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    color: var(--text-light);
}

.modern-blog-category {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    padding: 0.25rem 0.75rem;
    border-radius: var(--border-radius-sm);
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

.modern-media-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border-radius: var(--border-radius-sm);
    font-size: 1.5rem;
    color: var(--white);
    box-shadow: var(--shadow-sm);
}

.modern-media-icon.video {
    background: linear-gradient(135deg, var(--danger-color), #dc2626);
}

.modern-media-icon.pdf {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
}

.modern-media-icon.image {
    background: linear-gradient(135deg, var(--success-color), #059669);
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
				@include('Elements.flash-message')
			<div class="custom-error-msg">
			</div>
			
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="modern-card">
							<div class="modern-card-header">
								<h4 class="modern-card-title">
									<i class="fas fa-blog"></i>
									Blog Posts Management
								</h4>
								<div class="modern-header-actions">
									<a href="{{route('admin.blog.create')}}" class="modern-btn modern-btn-primary">
										<i class="fas fa-plus"></i>
										Create New Post
									</a>
									<form action="{{route('admin.blog.index')}}" method="get" class="modern-search-form">
										<input type="text" name="search_term" class="modern-search-input" value="{{ request('search_term') }}" placeholder="Search posts...">
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
										<div class="modern-stat-icon posts">
											<i class="fas fa-blog"></i>
										</div>
										<div class="modern-stat-value">{{ count($lists) }}</div>
										<div class="modern-stat-label">Total Posts</div>
									</div>
									<div class="modern-stat-card">
										<div class="modern-stat-icon published">
											<i class="fas fa-check-circle"></i>
										</div>
										<div class="modern-stat-value">{{ $lists->where('status', 1)->count() }}</div>
										<div class="modern-stat-label">Published Posts</div>
									</div>
									<div class="modern-stat-card">
										<div class="modern-stat-icon draft">
											<i class="fas fa-pause-circle"></i>
										</div>
										<div class="modern-stat-value">{{ $lists->where('status', 0)->count() }}</div>
										<div class="modern-stat-label">Draft Posts</div>
									</div>
								</div>

								<!-- Table -->
								@if(count($lists) > 0)
								<div class="modern-table-container">
									<table class="modern-table">
										<thead>
											<tr>
												<th>Featured Image</th>
												<th>Title</th>
												<th>Slug</th>
												<th>Category</th>
												<th>Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($lists as $list)
											<tr id="id_{{$list->id}}">
												<td>
													@php
														$hasImage = isset($list->image) && $list->image != "";
														if($hasImage) {
															$extension = pathinfo($list->image, PATHINFO_EXTENSION);
														}
													@endphp
													
													@if($hasImage)
														@if(strtolower($extension) == 'mp4')
															<div class="modern-media-icon video">
																<i class="fas fa-video"></i>
															</div>
														@elseif(strtolower($extension) == 'pdf')
															<div class="modern-media-icon pdf">
																<i class="fas fa-file-pdf"></i>
															</div>
														@else
															<img src="{{ asset('images/blog/' . $list->image) }}" alt="{{ $list->title }}" class="modern-blog-image">
														@endif
													@else
														<div class="modern-media-icon image">
															<i class="fas fa-image"></i>
														</div>
													@endif
												</td>
												<td>
													<div class="modern-blog-title">
														{{ $list->title == "" ? config('constants.empty') : \Illuminate\Support\Str::limit($list->title, '50', '...') }}
													</div>
												</td>
												<td>
													<code class="modern-blog-slug">{{ $list->slug }}</code>
												</td>
												<td>
													@if($list->categorydetail)
														<span class="modern-blog-category">
															<i class="fas fa-folder"></i>
															{{ $list->categorydetail->name }}
														</span>
													@else
														<span class="text-muted">No Category</span>
													@endif
												</td>
												<td>
													<label class="modern-status-toggle">
														<input data-id="{{$list->id}}" data-status="{{$list->status}}" data-col="status" data-table="blogs" class="change-status" value="1" type="checkbox" name="status" {{ ($list->status == 1 ? 'checked' : '')}} data-bootstrap-switch>
														<span class="modern-status-slider"></span>
													</label>
												</td>
												<td>
													<div class="modern-actions">
														<a class="modern-btn modern-btn-success modern-btn-sm" href="{{URL::to('/admin/blog/edit/'.base64_encode(convert_uuencode($list->id)))}}">
															<i class="fas fa-edit"></i>
															Edit
														</a>
														<a class="modern-btn modern-btn-danger modern-btn-sm" href="javascript:;" onClick="deleteAction({{$list->id}}, 'blogs')">
															<i class="fas fa-trash"></i>
															Delete
														</a>
													</div>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								@else
								<div class="modern-empty-state">
									<div class="modern-empty-icon">
										<i class="fas fa-blog"></i>
									</div>
									<h3 class="modern-empty-title">No Blog Posts Found</h3>
									<p class="modern-empty-description">Get started by creating your first blog post</p>
									<a href="{{route('admin.blog.create')}}" class="modern-btn modern-btn-primary">
										<i class="fas fa-plus"></i>
										Create First Post
									</a>
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
// Enhanced status toggle functionality with flash messages
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
    
    // Override the legacy updateStatus function to prevent JSON parsing errors
    window.updateStatus = function(id, current_status, table, col) {
        // Find the toggle element
        var toggleElement = $(".change-status[data-id='" + id + "']")[0];
        // Call our modern function instead
        updateBlogStatus(id, current_status, table, col, toggleElement);
    };
    
    // Override the legacy deleteAction function for modern flash messages
    window.deleteAction = function(id, table) {
        modernDeleteBlog(id, table);
    };
    
    // Enhanced status update with modern flash messages
    $('.change-status').off('change').on('change', function (event, state) {
        var id = $.trim($(this).attr('data-id'));
        var current_status = $.trim($(this).attr('data-status'));
        var table = $.trim($(this).attr('data-table'));
        var col = $.trim($(this).attr('data-col'));
        
        if(id != "" && current_status != "" && table != ""){
            updateBlogStatus(id, current_status, table, col, this);
        }
    });
    
    // Ensure flash message container exists
    if ($('.modern-flash-container').length === 0) {
        $('body').append('<div class="modern-flash-container"></div>');
    }
});

// Modern delete function with flash messages and confirmation
function modernDeleteBlog(id, table) {
    // Show modern confirmation dialog
    if (confirm('⚠️ Are you sure you want to delete this blog post?\n\nThis action cannot be undone and will permanently remove:\n• The blog post content\n• Associated images and files\n• All related data\n\nClick OK to confirm deletion.')) {
        
        // Show loading state on the delete button
        const deleteBtn = $(`.modern-btn-danger[onclick*="deleteAction(${id}"]`);
        deleteBtn.addClass('loading');
        const icon = deleteBtn.find('i');
        if (icon.length) {
            icon.removeClass('fa-trash').addClass('fa-spinner fa-spin');
        }
        
        $.ajax({
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: '{{ route("admin.delete_action") }}',
            dataType: 'json',
            data: {
                'id': id,
                'table': table
            },
            success: function(resp) {
                if(resp && resp.status == 1) {
                    // Show success flash message
                    showModernFlashMessage('success', resp.message || 'Blog post has been deleted successfully');
                    
                    // Remove the row with smooth animation
                    const row = $('#id_' + id);
                    row.fadeOut(500, function() {
                        $(this).remove();
                        
                        // Update statistics
                        updateStatsCounters();
                        
                        // Check if table is empty and show empty state
                        const remainingRows = $('.modern-table tbody tr:visible').length;
                        if (remainingRows === 0) {
                            $('.modern-table-container').fadeOut(300, function() {
                                $(this).replaceWith(`
                                    <div class="modern-empty-state">
                                        <div class="modern-empty-icon">
                                            <i class="fas fa-blog"></i>
                                        </div>
                                        <h3 class="modern-empty-title">No Blog Posts Found</h3>
                                        <p class="modern-empty-description">All blog posts have been deleted. Create a new one to get started.</p>
                                        <a href="{{route('admin.blog.create')}}" class="modern-btn modern-btn-primary">
                                            <i class="fas fa-plus"></i>
                                            Create First Post
                                        </a>
                                    </div>
                                `);
                            });
                        }
                    });
                    
                } else {
                    // Show error flash message
                    showModernFlashMessage('error', resp && resp.message ? resp.message : 'Failed to delete blog post');
                    
                    // Restore button state
                    deleteBtn.removeClass('loading');
                    if (icon.length) {
                        icon.removeClass('fa-spinner fa-spin').addClass('fa-trash');
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Delete AJAX Error:', {xhr: xhr, status: status, error: error});
                
                // Show error message
                let errorMessage = 'An error occurred while deleting the blog post. Please try again.';
                if (xhr.responseText) {
                    try {
                        const errorResp = JSON.parse(xhr.responseText);
                        if (errorResp.message) {
                            errorMessage = errorResp.message;
                        }
                    } catch (e) {
                        console.log('Non-JSON error response:', xhr.responseText);
                    }
                }
                
                showModernFlashMessage('error', errorMessage);
                
                // Restore button state
                deleteBtn.removeClass('loading');
                if (icon.length) {
                    icon.removeClass('fa-spinner fa-spin').addClass('fa-trash');
                }
            }
        });
    }
}

// Modern status update function with flash messages
function updateBlogStatus(id, current_status, table, col, toggleElement) {
    // Show loading state
    const slider = $(toggleElement).next('.modern-status-slider');
    slider.css('opacity', '0.6');
    
    // AJAX request for blog status update
    
    $.ajax({
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '{{ route("admin.update_action") }}',
        dataType: 'json',
        data: {
            'id': id, 
            'current_status': current_status, 
            'table': table, 
            'colname': col
        },
        success: function(resp) {
            // With dataType: 'json', jQuery automatically parses the response
            if(resp && resp.status == 1) {
                // Show modern success flash message
                showModernFlashMessage('success', resp.message || 'Status updated successfully');
                
                // Update status
                if(current_status == 1){
                    var updated_status = 0;
                } else {
                    var updated_status = 1;
                }
                
                $(".change-status[data-id="+id+"]").attr('data-status', updated_status);
                
                // Update statistics
                updateStatsCounters();
                
            } else {
                // Show modern error flash message
                showModernFlashMessage('error', resp && resp.message ? resp.message : 'An error occurred while updating status');
                
                // Revert toggle state
                if(current_status == 1){
                    $(".change-status[data-id="+id+"]").prop('checked', true);
                } else {
                    $(".change-status[data-id="+id+"]").prop('checked', false);
                }
            }
            
            // Remove loading state
            slider.css('opacity', '1');
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', {xhr: xhr, status: status, error: error});
            
            // Show error message with more details if available
            let errorMessage = 'An error occurred while updating status. Please try again.';
            if (xhr.responseText) {
                try {
                    const errorResp = JSON.parse(xhr.responseText);
                    if (errorResp.message) {
                        errorMessage = errorResp.message;
                    }
                } catch (e) {
                    // If response is not JSON, use default message
                    console.log('Non-JSON error response:', xhr.responseText);
                }
            }
            
            showModernFlashMessage('error', errorMessage);
            
            // Revert toggle state
            if(current_status == 1){
                $(".change-status[data-id="+id+"]").prop('checked', true);
            } else {
                $(".change-status[data-id="+id+"]").prop('checked', false);
            }
            
            // Remove loading state
            slider.css('opacity', '1');
        }
    });
}

// Function to show modern flash messages using the existing flash message system
function showModernFlashMessage(type, message) {
    // Remove existing flash messages
    $('.modern-flash-container .modern-flash-alert').remove();
    
    // Create the flash message HTML using the same structure as flash-message.blade.php
    const iconMap = {
        'success': 'fas fa-check',
        'error': 'fas fa-exclamation',
        'warning': 'fas fa-exclamation-triangle',
        'info': 'fas fa-info'
    };
    
    const titleMap = {
        'success': 'Success!',
        'error': 'Error!',
        'warning': 'Warning!',
        'info': 'Information'
    };
    
    const autoDismissTime = type === 'error' ? '7000' : '5000';
    
    const flashHtml = `
        <div class="modern-flash-alert ${type}" role="alert" data-auto-dismiss="${autoDismissTime}">
            <div class="modern-flash-icon">
                <i class="${iconMap[type]}"></i>
            </div>
            <div class="modern-flash-content">
                <div class="modern-flash-title">${titleMap[type]}</div>
                <div class="modern-flash-message">${message}</div>
            </div>
            <button type="button" class="modern-flash-close" onclick="dismissAlert(this)">
                <i class="fas fa-times"></i>
            </button>
            <div class="modern-flash-progress"></div>
        </div>
    `;
    
    // Find or create flash container (same structure as flash-message.blade.php)
    let container = $('.modern-flash-container');
    if (container.length === 0) {
        // Create container with same structure as flash-message.blade.php
        container = $('<div class="modern-flash-container"></div>');
        $('body').append(container);
    }
    
    // Add the new message
    container.append(flashHtml);
    
    // Auto-dismiss functionality (same as flash-message.blade.php)
    setTimeout(() => {
        const alert = container.find('.modern-flash-alert[data-auto-dismiss="' + autoDismissTime + '"]').last();
        if (alert.length) {
            dismissAlert(alert.find('.modern-flash-close')[0]);
        }
    }, parseInt(autoDismissTime));
    
    // Add success sound for success messages (same as flash-message.blade.php)
    if (type === 'success') {
        try {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
            oscillator.frequency.setValueAtTime(1000, audioContext.currentTime + 0.1);
            
            gainNode.gain.setValueAtTime(0, audioContext.currentTime);
            gainNode.gain.linearRampToValueAtTime(0.1, audioContext.currentTime + 0.01);
            gainNode.gain.linearRampToValueAtTime(0, audioContext.currentTime + 0.2);
            
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.2);
        } catch (e) {
            // Silently fail if audio context is not available
        }
    }
}

// Function to update statistics counters
function updateStatsCounters() {
    // Count published and draft posts
    let publishedCount = 0;
    let draftCount = 0;
    
    $('.change-status').each(function() {
        if ($(this).attr('data-status') == '1') {
            publishedCount++;
        } else {
            draftCount++;
        }
    });
    
    // Update counters with animation
    $('.modern-stat-card .modern-stat-value').each(function() {
        const $this = $(this);
        const label = $this.next('.modern-stat-label').text();
        
        if (label.includes('Published')) {
            $this.text(publishedCount);
        } else if (label.includes('Draft')) {
            $this.text(draftCount);
        }
        
        // Add pulse animation
        $this.addClass('loading');
        setTimeout(() => {
            $this.removeClass('loading');
        }, 500);
    });
}

// Global function to dismiss alerts (used by flash message close button)
// This function is also defined in flash-message.blade.php, but we ensure it's available here too
function dismissAlert(closeBtn) {
    const alert = closeBtn.closest('.modern-flash-alert');
    if (alert) {
        alert.classList.add('fade-out');
        setTimeout(() => {
            alert.remove();
        }, 300);
    }
}
</script>
@endsection
