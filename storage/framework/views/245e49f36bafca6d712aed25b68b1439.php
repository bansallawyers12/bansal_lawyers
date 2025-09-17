
<?php $__env->startSection('title', 'Appointment Date Blocks'); ?>

<?php $__env->startSection('content'); ?>
<style>
/* Modern Appointment Date Blocks Design System */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --info-color: #06b6d4;
    --block-color: #ef4444;
    --block-secondary: #dc2626;
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
    background: linear-gradient(135deg, var(--block-color) 0%, var(--block-secondary) 100%);
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
    position: relative;
    overflow: hidden;
}

.modern-stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    transition: var(--transition);
}

.modern-stat-card.total::before {
    background: linear-gradient(135deg, var(--block-color), var(--block-secondary));
}

.modern-stat-card.blocked::before {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
}

.modern-stat-card:hover {
    box-shadow: var(--shadow);
    transform: translateY(-1px);
}

.modern-stat-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modern-stat-info h5 {
    color: var(--text-light);
    font-size: 0.875rem;
    font-weight: 600;
    margin: 0 0 0.5rem 0;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.modern-stat-info h3 {
    color: var(--text-dark);
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
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
    opacity: 0.9;
}

.modern-stat-icon.total {
    background: linear-gradient(135deg, var(--block-color), var(--block-secondary));
}

.modern-stat-icon.blocked {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
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

.modern-person-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    font-weight: 600;
}

.modern-block-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.modern-block-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: var(--bg-light);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    margin-bottom: 0.5rem;
    transition: var(--transition);
}

.modern-block-item:hover {
    background: #f1f5f9;
    border-color: var(--block-color);
}

.modern-block-item:last-child {
    margin-bottom: 0;
}

.modern-block-icon {
    width: 2rem;
    height: 2rem;
    background: linear-gradient(135deg, var(--block-color), var(--block-secondary));
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    flex-shrink: 0;
}

.modern-block-info {
    flex: 1;
}

.modern-block-date {
    font-weight: 600;
    color: var(--text-dark);
    font-size: 0.875rem;
}

.modern-block-time {
    color: var(--text-light);
    font-size: 0.75rem;
    margin-top: 0.25rem;
}

.modern-actions {
    display: flex;
    gap: 0.5rem;
}

.modern-dropdown {
    position: relative;
    display: inline-block;
}

.modern-dropdown-toggle {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
}

.modern-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: var(--white);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow-lg);
    z-index: 1000;
    min-width: 150px;
    display: none;
}

.modern-dropdown-menu.show {
    display: block;
}

.modern-dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    color: var(--text-dark);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: var(--transition);
    border-bottom: 1px solid var(--border-color);
}

.modern-dropdown-item:last-child {
    border-bottom: none;
}

.modern-dropdown-item:hover {
    background: var(--bg-light);
    color: var(--text-dark);
    text-decoration: none;
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
    background: var(--block-color);
    border-color: var(--block-color);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    text-decoration: none;
}

.modern-pagination .page-item.active .page-link {
    background: linear-gradient(135deg, var(--block-color), var(--block-secondary));
    border-color: var(--block-color);
    color: var(--white);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
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
    
    .modern-pagination .pagination {
        gap: 0.25rem;
    }
    
    .modern-pagination .page-link {
        min-width: 2rem;
        height: 2rem;
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
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
									<i class="fas fa-ban"></i>
									Appointment Date Blocks
								</h4>
								<div class="modern-header-actions">
									<a href="<?php echo e(route('admin.feature.appointmentdisabledate.create')); ?>" class="modern-btn modern-btn-primary">
										<i class="fas fa-plus"></i>
										Create Date Block
									</a>
								</div>
							</div>
							
							<div class="modern-card-body">
								<!-- Statistics Cards -->
								<div class="modern-stats-grid">
									<div class="modern-stat-card total">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>Total Configurations</h5>
												<h3><?php echo e($totalData); ?></h3>
											</div>
											<div class="modern-stat-icon total">
												<i class="fas fa-cog"></i>
											</div>
										</div>
									</div>
									<div class="modern-stat-card blocked">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>Active Blocks</h5>
												<h3><?php echo e($lists->sum(function($item) { return count($item->disabledSlots); })); ?></h3>
											</div>
											<div class="modern-stat-icon blocked">
												<i class="fas fa-ban"></i>
											</div>
										</div>
									</div>
								</div>

								<!-- Table -->
								<?php if($totalData !== 0): ?>
								<div class="modern-table-container">
									<table class="modern-table">
										<thead>
											<tr>
												<th>Person</th>
												<th>Blocked Dates & Times</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr id="id_<?php echo e($list->id); ?>">
												<td>
													<span class="modern-person-badge">
														<i class="fas fa-user"></i>
														Ajay
													</span>
												</td>
												<td>
													<?php if(isset($list->disabledSlots) && !empty($list->disabledSlots) && count($list->disabledSlots) > 0): ?>
														<ul class="modern-block-list">
															<?php $__currentLoopData = $list->disabledSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slotVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<li class="modern-block-item">
																<div class="modern-block-icon">
																	<?php if(isset($slotVal->block_all) && $slotVal->block_all == 1): ?>
																		<i class="fas fa-ban"></i>
																	<?php else: ?>
																		<i class="fas fa-clock"></i>
																	<?php endif; ?>
																</div>
																<div class="modern-block-info">
																	<div class="modern-block-date">
																		<?php echo e(date("d/m/Y", strtotime($slotVal->disabledates))); ?>

																	</div>
																	<div class="modern-block-time">
																		<?php if(isset($slotVal->block_all) && $slotVal->block_all == 1): ?>
																			Full Day Blocked
																		<?php else: ?>
																			<?php echo e($slotVal->slots); ?>

																		<?php endif; ?>
																	</div>
																</div>
															</li>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</ul>
													<?php else: ?>
														<div class="text-muted">
															<i class="fas fa-info-circle"></i>
															No blocked dates configured
														</div>
													<?php endif; ?>
												</td>
												<td>
													<div class="modern-actions">
														<a class="modern-btn modern-btn-success modern-btn-sm" href="<?php echo e(route('admin.feature.appointmentdisabledate.edit', base64_encode(convert_uuencode($list->id)))); ?>">
															<i class="fas fa-edit"></i>
															Edit
														</a>
														<button type="button" class="modern-btn modern-btn-danger modern-btn-sm" onClick="deleteSlotAction(<?php echo e($list->id); ?>, 'book_service_disable_slots')">
															<i class="fas fa-trash"></i>
															Delete
														</button>
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
									<?php echo e($lists->links()); ?>

								</div>
								<?php endif; ?>
								<?php else: ?>
								<div class="modern-empty-state">
									<div class="modern-empty-icon">
										<i class="fas fa-ban"></i>
									</div>
									<h3 class="modern-empty-title">No Date Blocks Found</h3>
									<p class="modern-empty-description">Create your first appointment date block to manage availability</p>
									<a href="<?php echo e(route('admin.feature.appointmentdisabledate.create')); ?>" class="modern-btn modern-btn-primary">
										<i class="fas fa-plus"></i>
										Create First Block
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
// Enhanced appointment date blocks functionality
document.addEventListener('DOMContentLoaded', function() {
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

// Original functionality preserved
jQuery(document).ready(function($){
    $('.cb-element').change(function () {
        if ($('.cb-element:checked').length == $('.cb-element').length){
            $('#checkbox-all').prop('checked',true);
        } else {
            $('#checkbox-all').prop('checked',false);
        }
    });
});

function deleteSlotAction( id, table ) {
    var conf = confirm('Are you sure, you want to delete the slot.');
    if(conf){
        if(id == '') {
            alert('Please select ID to delete the record.');
            return false;
        } else {
            $('.popuploader').show();
            $(".server-error").html(''); //remove server error.
            $(".custom-error-msg").html(''); //remove custom error.
            $.ajax({
                type:'post',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:site_url+'/admin/delete_slot_action',
                data:{'id': id, 'table' : table},
                success:function(resp) {
                    $('.popuploader').hide();
                    var obj = $.parseJSON(resp);
                    if(obj.status == 1) {
                        $("#id_"+id).remove();
                        $("#quid_"+id).remove();
                        //show success msg
                        var html = successMessage(obj.message);
                        $(".custom-error-msg").html(html);

                        //show count
                        var old_count = $(".count").text();
                        var new_count = old_count - 1;
                        $(".count").text(new_count);
                    } else {
                        //show error msg
                        var html = errorMessage(obj.message);
                        $(".custom-error-msg").html(html);
                    }
                },
                error:function(resp) {
                    $('.popuploader').hide();
                    //show error msg
                    var html = errorMessage('Something went wrong. Please try again.');
                    $(".custom-error-msg").html(html);
                }
            });
        }
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/feature/appointmentdisabledate/index.blade.php ENDPATH**/ ?>