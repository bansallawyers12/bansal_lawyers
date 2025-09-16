
<?php $__env->startSection('title', 'Create Block Slot (New)'); ?>

<?php $__env->startSection('content'); ?>
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="server-error"><?php echo $__env->make('../Elements/flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
			<div class="card">
				<div class="card-header">
					<h4>Create Block Slot (New)</h4>
					<div class="card-header-action">
						<a href="<?php echo e(route('admin.feature.bookingblocks.index')); ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="<?php echo e(route('admin.feature.bookingblocks.store')); ?>">
						<?php echo csrf_field(); ?>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Person</label>
								<input type="text" class="form-control" value="Ajay" readonly>
								<input type="hidden" name="person_id" value="1">
							</div>
							<div class="form-group col-md-3">
								<label>Date</label>
								<input type="text" class="form-control" name="date" placeholder="DD/MM/YYYY" required>
							</div>
							<div class="form-group col-md-3">
								<label>Start Time</label>
								<input type="time" class="form-control" name="start_time">
							</div>
							<div class="form-group col-md-3">
								<label>End Time</label>
								<input type="time" class="form-control" name="end_time">
							</div>
							<div class="form-group col-md-3">
								<label>Full Day</label>
								<select name="full_day" id="full_day" class="form-control">
									<option value="0" selected>No</option>
									<option value="1">Yes</option>
								</select>
							</div>
						</div>
						<button class="btn btn-primary" type="submit">Save</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script <?php echo \App\Services\CspService::getNonceAttribute(); ?>>
$(function(){
    $('#full_day').on('change', function(){
        var isFull = $(this).val() === '1';
        $('input[name="start_time"], input[name="end_time"]').prop('disabled', isFull);
        if(isFull){ $('input[name="start_time"], input[name="end_time"]').val(''); }
    });
});
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/feature/bookingblocks/create.blade.php ENDPATH**/ ?>