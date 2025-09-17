
<?php $__env->startSection('title', 'Appointments'); ?>

<?php $__env->startSection('content'); ?>
<style>
/* Modern Appointments Design System */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --info-color: #06b6d4;
    --appointment-color: #10b981;
    --appointment-secondary: #059669;
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

.modern-search-form {
    display: flex;
    gap: 0.5rem;
    align-items: stretch;
    max-width: 400px;
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
    font-weight: 600;
}

.modern-search-btn:hover {
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.5);
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

.modern-btn-info {
    background: linear-gradient(135deg, var(--info-color) 0%, #0891b2 100%);
    color: var(--white);
}

.modern-btn-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(6, 182, 212, 0.3);
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
    background: linear-gradient(135deg, var(--appointment-color), var(--appointment-secondary));
}

.modern-stat-card.pending::before {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
}

.modern-stat-card.approved::before {
    background: linear-gradient(135deg, var(--success-color), #059669);
}

.modern-stat-card.completed::before {
    background: linear-gradient(135deg, var(--info-color), #0891b2);
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
    background: linear-gradient(135deg, var(--appointment-color), var(--appointment-secondary));
}

.modern-stat-icon.pending {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
}

.modern-stat-icon.approved {
    background: linear-gradient(135deg, var(--success-color), #059669);
}

.modern-stat-icon.completed {
    background: linear-gradient(135deg, var(--info-color), #0891b2);
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

.modern-appointment-id {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    background: linear-gradient(135deg, var(--appointment-color), var(--appointment-secondary));
    color: var(--white);
    border-radius: 50%;
    font-size: 0.75rem;
    font-weight: 600;
}

.modern-client-info {
    font-weight: 600;
    color: var(--text-dark);
    line-height: 1.4;
}

.modern-client-id {
    font-size: 0.75rem;
    color: var(--text-light);
    font-weight: 500;
    margin-top: 0.25rem;
}

.modern-datetime {
    font-weight: 600;
    color: var(--text-dark);
}

.modern-description {
    max-width: 200px;
    line-height: 1.4;
}

.modern-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0.75rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.modern-status-badge.pending {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
    color: var(--white);
}

.modern-status-badge.approved {
    background: linear-gradient(135deg, var(--success-color), #059669);
    color: var(--white);
}

.modern-status-badge.completed {
    background: linear-gradient(135deg, var(--info-color), #0891b2);
    color: var(--white);
}

.modern-status-badge.rejected {
    background: linear-gradient(135deg, var(--danger-color), #dc2626);
    color: var(--white);
}

.modern-status-badge.inprogress {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
}

.modern-status-badge.cancelled {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: var(--white);
}

.modern-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.modern-actions form {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
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
    background: var(--appointment-color);
    border-color: var(--appointment-color);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    text-decoration: none;
}

.modern-pagination .page-item.active .page-link {
    background: linear-gradient(135deg, var(--appointment-color), var(--appointment-secondary));
    border-color: var(--appointment-color);
    color: var(--white);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
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
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    
    .modern-table-container {
        overflow-x: auto;
    }
    
    .modern-actions {
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .modern-actions form {
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

/* Modal styling compatibility */
.fc-event-container .fc-h-event{cursor:pointer;}
#openassigneview .modal-body ul.navbar-nav li .dropdown-menu{transform: none!important; top:40px!important;}
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
									<i class="fas fa-calendar-check"></i>
									Appointments Management
								</h4>
								<div class="modern-header-actions">
									<form action="<?php echo e(route('appointments.index')); ?>" method="get" class="modern-search-form">
										<input type="text" class="modern-search-input" placeholder="Search by client reference or description" name="q" value="<?php echo e(request('q')); ?>">
										<button type="submit" class="modern-search-btn">
											<i class="fas fa-search"></i>
										</button>
									</form>
								</div>
							</div>
							
							<div class="modern-card-body">
								<!-- Statistics Cards -->
								<div class="modern-stats-grid">
									<div class="modern-stat-card total">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>Total Appointments</h5>
												<h3><?php echo e(count($appointments)); ?></h3>
											</div>
											<div class="modern-stat-icon total">
												<i class="fas fa-calendar-check"></i>
											</div>
										</div>
									</div>
									<div class="modern-stat-card pending">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>Pending</h5>
												<h3><?php echo e($appointments->where('status', 0)->count()); ?></h3>
											</div>
											<div class="modern-stat-icon pending">
												<i class="fas fa-clock"></i>
											</div>
										</div>
									</div>
									<div class="modern-stat-card approved">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>Approved</h5>
												<h3><?php echo e($appointments->where('status', 1)->count()); ?></h3>
											</div>
											<div class="modern-stat-icon approved">
												<i class="fas fa-check-circle"></i>
											</div>
										</div>
									</div>
									<div class="modern-stat-card completed">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>Completed</h5>
												<h3><?php echo e($appointments->where('status', 2)->count()); ?></h3>
											</div>
											<div class="modern-stat-icon completed">
												<i class="fas fa-check-double"></i>
											</div>
										</div>
									</div>
								</div>

								<!-- Table -->
								<?php if(count($appointments) > 0): ?>
								<div class="modern-table-container">
									<table class="modern-table">
										<thead>
											<tr>
												<th>#</th>
												<th>Client</th>
												<th>Date & Time</th>
												<th>Nature of Enquiry</th>
												<th>Description</th>
												<th>Added By</th>
												<th>Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td>
													<span class="modern-appointment-id"><?php echo e(++$i); ?></span>
												</td>
												<td>
													<div class="modern-client-info">
														<?php echo e($appointment->clients->first_name); ?> <?php echo e($appointment->clients->last_name); ?>

													</div>
													<div class="modern-client-id">
														<?php echo e($appointment->clients->client_id); ?>

													</div>
												</td>
												<td>
													<div class="modern-datetime">
														<?php echo e(date('d/m/Y', strtotime($appointment->date))); ?><br>
														<small class="text-muted"><?php echo e($appointment->time); ?></small>
													</div>
												</td>
												<td>
													<?php if($appointment->natureOfEnquiry): ?>
														<span class="font-weight-500"><?php echo e($appointment->natureOfEnquiry->title); ?></span>
													<?php else: ?>
														<span class="text-muted">N/A</span>
													<?php endif; ?>
												</td>
												<td>
													<div class="modern-description">
														<?php echo e(\Illuminate\Support\Str::limit($appointment->description, 50, '...')); ?>

													</div>
												</td>
												<td>
													<?php if($appointment->user): ?>
														<div class="font-weight-500">
															<?php echo e($appointment->user->first_name); ?> <?php echo e($appointment->user->last_name); ?>

														</div>
													<?php else: ?>
														<span class="text-muted">N/A</span>
													<?php endif; ?>
												</td>
												<td>
													<?php if($appointment->status == 0): ?>
														<span class="modern-status-badge pending">
															<i class="fas fa-clock"></i> Pending
														</span>
													<?php elseif($appointment->status == 1): ?>
														<span class="modern-status-badge approved">
															<i class="fas fa-check-circle"></i> Approved
														</span>
													<?php elseif($appointment->status == 2): ?>
														<span class="modern-status-badge completed">
															<i class="fas fa-check-double"></i> Completed
														</span>
													<?php elseif($appointment->status == 3): ?>
														<span class="modern-status-badge rejected">
															<i class="fas fa-times-circle"></i> Rejected
														</span>
													<?php elseif($appointment->status == 4): ?>
														<span class="modern-status-badge inprogress">
															<i class="fas fa-spinner"></i> N/P
														</span>
													<?php elseif($appointment->status == 5): ?>
														<span class="modern-status-badge inprogress">
															<i class="fas fa-play-circle"></i> In Progress
														</span>
													<?php elseif($appointment->status == 6): ?>
														<span class="modern-status-badge cancelled">
															<i class="fas fa-user-times"></i> Did Not Come
														</span>
													<?php elseif($appointment->status == 7): ?>
														<span class="modern-status-badge cancelled">
															<i class="fas fa-ban"></i> Cancelled
														</span>
													<?php elseif($appointment->status == 8): ?>
														<span class="modern-status-badge cancelled">
															<i class="fas fa-exclamation-triangle"></i> Missed
														</span>
													<?php elseif($appointment->status == 9): ?>
														<span class="modern-status-badge pending">
															<i class="fas fa-credit-card"></i> Payment Pending
														</span>
													<?php elseif($appointment->status == 10): ?>
														<span class="modern-status-badge approved">
															<i class="fas fa-check-circle"></i> Payment Success
														</span>
													<?php elseif($appointment->status == 11): ?>
														<span class="modern-status-badge rejected">
															<i class="fas fa-times-circle"></i> Payment Failed
														</span>
													<?php endif; ?>
												</td>
												<td>
													<div class="modern-actions">
														<form action="<?php echo e(route('appointments.destroy',$appointment->id)); ?>" method="POST">
															<a class="modern-btn modern-btn-info modern-btn-sm" href="<?php echo e(route('appointments.show',$appointment->id)); ?>">
																<i class="fas fa-eye"></i> Show
															</a>
															<a class="modern-btn modern-btn-primary modern-btn-sm" href="<?php echo e(route('appointments.edit',$appointment->id)); ?>">
																<i class="fas fa-edit"></i> Edit
															</a>
															
															<?php echo csrf_field(); ?>
															<?php echo method_field('DELETE'); ?>
															<button type="submit" class="modern-btn modern-btn-danger modern-btn-sm" onclick="return confirm('Are you sure you want to delete this appointment?')">
																<i class="fas fa-trash"></i> Delete
															</button>
														</form>
													</div>
												</td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
								</div>
								
								<!-- Pagination -->
								<?php if($appointments->hasPages()): ?>
								<div class="modern-pagination">
									<?php echo $appointments->appends($_GET)->links(); ?>

								</div>
								<?php endif; ?>
								<?php else: ?>
								<div class="modern-empty-state">
									<div class="modern-empty-icon">
										<i class="fas fa-calendar-check"></i>
									</div>
									<h3 class="modern-empty-title">No Appointments Found</h3>
									<p class="modern-empty-description">No appointments match your current search criteria</p>
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

<!-- Assign Modal -->
<div class="modal fade custom_modal" id="openassigneview" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content taskview">
		</div>
	</div>
</div>

<script>
// Enhanced appointments management functionality
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

// Original appointment functionality preserved
jQuery(document).ready(function($){
    $(document).delegate('.openassignee', 'click', function(){
        $('.assignee').show();
    });
    $(document).delegate('.closeassignee', 'click', function(){
        $('.assignee').hide();
    });
    $(document).delegate('.saveassignee', 'click', function(){
        var appliid = $(this).attr('data-id');
        var assinee= $('#changeassignee').val();
        $('.popuploader').show();
        
        $.ajax({
            url: site_url+'/admin/change_assignee',
            type:'GET',
            data:{id: appliid,assinee: assinee},
            success: function(response){
                var obj = $.parseJSON(response);
                if(obj.status){
                    alert(obj.message);
                    location.reload();
                }else{
                    alert(obj.message);
                }
            }
        });
    });

    // Appointment pending todo
    $(document).delegate('.savecomment', 'click', function(){
        var visitcomment = $('.taskcomment').val();
        var appliid = $(this).attr('data-id');
        $('.popuploader').show();
        $.ajax({
            url: site_url+'/admin/update_apppointment_comment',
            type:'POST',
            data:{"_token":$('meta[name="csrf-token"]').attr('content'),id: appliid,visit_comment:visitcomment},
            success: function(responses){
                $('.taskcomment').val('');
                $.ajax({
                    url: site_url+'/admin/get-assigne-detail',
                    type:'GET',
                    data:{id:appliid},
                    success: function(responses){
                        $('.popuploader').hide();
                        $('.taskview').html(responses);
                    }
                });
            }
        });
    });

    $(document).delegate('.openassigneview', 'click', function(){
        $('#openassigneview').modal('show');
        var v = $(this).attr('id');
        $.ajax({
            url: site_url+'/admin/get-assigne-detail',
            type:'GET',
            data:{id:v},
            success: function(responses){
                $('.popuploader').hide();
                $('.taskview').html(responses);
            }
        });
    });

    $(document).delegate('.changestatus', 'click', function(){
        var appliid = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        var statusame = $(this).attr('data-status-name');
        $('.popuploader').show();

        $.ajax({
            url: site_url+'/admin/update_appointment_status',
            type:'POST',
            data:{"_token":$('meta[name="csrf-token"]').attr('content'),id: appliid,statusname:statusame,status:status},
            success: function(responses){
                $('.popuploader').hide();
                var obj = JSON.parse(responses);
                if(obj.status){
                    $('.updatestatusview'+appliid).html(obj.viewstatus);
                }
                $.ajax({
                    url: site_url+'/admin/get-assigne-detail',
                    type:'GET',
                    data:{id:appliid},
                    success: function(responses){
                        $('.popuploader').hide();
                        $('.taskview').html(responses);
                    }
                });
            }
        });
    });

    $(document).delegate('.changepriority', 'click', function(){
        var appliid = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        $('.popuploader').show();

        $.ajax({
            url: site_url+'/admin/update_appointment_priority',
            type:'POST',
            data:{"_token":$('meta[name="csrf-token"]').attr('content'),id: appliid,status:status},
            success: function(responses){
                $('.popuploader').hide();
                $.ajax({
                    url: site_url+'/admin/get-assigne-detail',
                    type:'GET',
                    data:{id:appliid},
                    success: function(responses){
                        $('.popuploader').hide();
                        $('.taskview').html(responses);
                    }
                });
            }
        });
    });

    $(document).delegate('.desc_click', 'click', function(){
        $(this).hide();
        $('.taskdesc').show();
        $('.taskdesc').focus();
    });
    $(document).delegate('.taskdesc', 'blur', function(){
        $(this).hide();
        $('.desc_click').show();
    });

    $(document).delegate('.tasknewdesc', 'blur', function(){
        var visitpurpose = $(this).val();
        var appliid = $(this).attr('data-id');
        $('.popuploader').show();
        $.ajax({
            url: site_url+'/admin/update_apppointment_description',
            type:'POST',
            data:{"_token":$('meta[name="csrf-token"]').attr('content'),id: appliid,visit_purpose:visitpurpose},
            success: function(responses){
                $.ajax({
                    url: site_url+'/admin/get-assigne-detail',
                    type:'GET',
                    data:{id:appliid},
                    success: function(responses){
                        $('.popuploader').hide();
                        $('.taskview').html(responses);
                    }
                });
            }
        });
    });

    $(document).delegate('.taskdesc', 'blur', function(){
        var visitpurpose = $(this).val();
        var appliid = $(this).attr('data-id');
        $('.popuploader').show();
        $.ajax({
            url: site_url+'/admin/update_apppointment_description',
            type:'POST',
            data:{id: appliid,visit_purpose:visitpurpose},
            success: function(responses){
                $.ajax({
                    url: site_url+'/admin/get-assigne-detail',
                    type:'GET',
                    data:{id:appliid},
                    success: function(responses){
                        $('.popuploader').hide();
                        $('.taskview').html(responses);
                    }
                });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/appointments/index.blade.php ENDPATH**/ ?>