
<?php $__env->startSection('title', 'Admin Users'); ?>

<?php $__env->startSection('content'); ?>

<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="server-error">
				<?php echo $__env->make('Elements.flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
			</div>
			<div class="custom-error-msg"></div>
			<div class="row">
                <div class="col-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-header">
							<h4>Admin Users</h4>
							<div class="card-header-action">
								<a href="<?php echo e(route('admin.admin_users.create')); ?>" class="btn btn-primary">
									<i class="fa fa-plus"></i> Add New Admin
								</a>
							</div>
						</div>
                    </div> 
                </div>
				<div class="col-12 col-md-12 col-lg-12">
					<div class="card"> 
						<div class="card-header">
                            <div class="col-md-6">   
                                <div class="card-title">
                                    <h4>Admin Users List</h4>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <!-- Search and Filter Form -->
                                <form method="GET" action="<?php echo e(route('admin.admin_users.index')); ?>" class="form-inline float-right">
                                    <div class="form-group mr-2">
                                        <input type="text" name="search" class="form-control" placeholder="Search..." value="<?php echo e(request('search')); ?>">
                                    </div>
                                    <div class="form-group mr-2">
                                        <select name="status" class="form-control">
                                            <option value="">All Status</option>
                                            <option value="1" <?php echo e(request('status') == '1' ? 'selected' : ''); ?>>Active</option>
                                            <option value="0" <?php echo e(request('status') == '0' ? 'selected' : ''); ?>>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <select name="archived" class="form-control">
                                            <option value="">All</option>
                                            <option value="0" <?php echo e(request('archived') == '0' ? 'selected' : ''); ?>>Active</option>
                                            <option value="1" <?php echo e(request('archived') == '1' ? 'selected' : ''); ?>>Archived</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i> Filter
                                    </button>
                                    <a href="<?php echo e(route('admin.admin_users.index')); ?>" class="btn btn-secondary ml-1">
                                        <i class="fa fa-refresh"></i> Clear
                                    </a>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive common_table">
                                <table class="table text_wrap table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Company</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <?php if($totalData !== 0): ?>
                                    <tbody class="tdata">
                                        <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr id="id_<?php echo e($list->id); ?>">
                                                <td><?php echo e($list->id); ?></td>
                                                <td>
                                                    <strong><?php echo e($list->first_name); ?> <?php echo e($list->last_name); ?></strong>
                                                </td>
                                                <td><?php echo e($list->email); ?></td>
                                                <td><?php echo e($list->company_name ?? 'N/A'); ?></td>
                                                <td><?php echo e($list->phone ?? 'N/A'); ?></td>
                                                <td>
                                                    <?php if($list->status == 1): ?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger">Inactive</span>
                                                    <?php endif; ?>
                                                    <?php if($list->is_archived == 1): ?>
                                                        <span class="badge badge-warning">Archived</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($list->created_at->format('M d, Y')); ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="<?php echo e(route('admin.admin_users.edit', $list->id)); ?>" 
                                                           class="btn btn-sm btn-primary" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        
                                                        <?php if($list->status == 1): ?>
                                                            <button type="button" class="btn btn-sm btn-warning" 
                                                                    onclick="updateAction(<?php echo e($list->id); ?>, 1, 'admins', 'status')" 
                                                                    title="Disable">
                                                                <i class="fa fa-ban"></i>
                                                            </button>
                                                        <?php else: ?>
                                                            <button type="button" class="btn btn-sm btn-success" 
                                                                    onclick="updateAction(<?php echo e($list->id); ?>, 0, 'admins', 'status')" 
                                                                    title="Enable">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                        
                                                        <?php if($list->is_archived == 0): ?>
                                                            <button type="button" class="btn btn-sm btn-secondary" 
                                                                    onclick="archiveAction(<?php echo e($list->id); ?>, 'admins')" 
                                                                    title="Archive">
                                                                <i class="fa fa-archive"></i>
                                                            </button>
                                                        <?php else: ?>
                                                            <button type="button" class="btn btn-sm btn-info" 
                                                                    onclick="archiveAction(<?php echo e($list->id); ?>, 'admins')" 
                                                                    title="Restore">
                                                                <i class="fa fa-undo"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <?php else: ?>
                                    <tbody>
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <div class="alert alert-info">
                                                    <i class="fa fa-info-circle"></i> No admin users found.
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php endif; ?>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <?php if($totalData > 0): ?>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <p class="text-muted">
                                            Showing <?php echo e($lists->firstItem()); ?> to <?php echo e($lists->lastItem()); ?> of <?php echo e($totalData); ?> results
                                        </p>
                                    </div>
                                    <div>
                                        <?php echo e($lists->appends(request()->query())->links()); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
// Reuse existing updateAction and archiveAction functions from your system
function updateAction(id, currentStatus, table, column) {
    if (confirm('Are you sure you want to change the status?')) {
        $.ajax({
            url: '<?php echo e(route("admin.update_action")); ?>',
            type: 'POST',
            data: {
                id: id,
                current_status: currentStatus,
                table: table,
                colname: column,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (response.status == 1) {
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    }
}

function archiveAction(id, table) {
    if (confirm('Are you sure you want to change the archive status?')) {
        $.ajax({
            url: '<?php echo e(route("admin.archive_action")); ?>',
            type: 'POST',
            data: {
                id: id,
                table: table,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (response.status == 1) {
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/admin_users/index.blade.php ENDPATH**/ ?>