
<?php $__env->startSection('title', 'Update Block Slot (New)'); ?>

<?php $__env->startSection('content'); ?>
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="server-error"><?php echo $__env->make('../Elements/flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
			<div class="card">
				<div class="card-header">
					<h4>Update Block Slot (New)</h4>
					<div class="card-header-action">
						<a href="<?php echo e(route('admin.feature.bookingblocks.index')); ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="<?php echo e(route('admin.feature.bookingblocks.edit')); ?>">
						<?php echo csrf_field(); ?>
						<input type="hidden" name="id" value="<?php echo e($fetchedData->id); ?>">
						<div class="form-group">
							<label>Disabled Dates and Slots</label>
							<div id="disable_dates_wrapper">
								<?php $existingCount = isset($disableSlotArr) ? count($disableSlotArr) : 0; ?>
								<?php if(isset($disableSlotArr) && $existingCount > 0): ?>
									<?php $__currentLoopData = $disableSlotArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php
											$displayDate = $slot->disabledates ? date('d/m/Y', strtotime($slot->disabledates)) : '';
											$start=''; $end='';
											if(!empty($slot->slots)){
												$parts = explode('-', $slot->slots);
												$start = $parts[0] ?? '';
												$end = $parts[1] ?? '';
											}
										?>
										<div class="disable_item row">
											<div class="col-md-3 mb-2">
												<label>Date</label>
												<input type="text" class="form-control" name="date[<?php echo e($i); ?>]" value="<?php echo e($displayDate); ?>" placeholder="DD/MM/YYYY">
											</div>
											<div class="col-md-3 mb-2 time-range">
												<label>Start Time</label>
												<input type="time" class="form-control" name="start_time[<?php echo e($i); ?>]" value="<?php echo e($start); ?>" <?php if($slot->block_all==1): ?> disabled <?php endif; ?>>
											</div>
											<div class="col-md-3 mb-2 time-range">
												<label>End Time</label>
												<input type="time" class="form-control" name="end_time[<?php echo e($i); ?>]" value="<?php echo e($end); ?>" <?php if($slot->block_all==1): ?> disabled <?php endif; ?>>
											</div>
											<div class="col-md-3 mb-2">
												<label>Full Day</label>
												<select name="full_day[<?php echo e($i); ?>]" class="form-control full-day">
													<option value="0" <?php if($slot->block_all!=1): ?> selected <?php endif; ?>>No</option>
													<option value="1" <?php if($slot->block_all==1): ?> selected <?php endif; ?>>Yes</option>
												</select>
											</div>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php else: ?>
									<div class="disable_item row">
										<div class="col-md-3 mb-2">
											<label>Date</label>
											<input type="text" class="form-control" name="date[0]" placeholder="DD/MM/YYYY">
										</div>
										<div class="col-md-3 mb-2 time-range">
											<label>Start Time</label>
											<input type="time" class="form-control" name="start_time[0]">
										</div>
										<div class="col-md-3 mb-2 time-range">
											<label>End Time</label>
											<input type="time" class="form-control" name="end_time[0]">
										</div>
										<div class="col-md-3 mb-2">
											<label>Full Day</label>
											<select name="full_day[0]" class="form-control full-day"><option value="0" selected>No</option><option value="1">Yes</option></select>
										</div>
									</div>
								<?php endif; ?>
							</div>
							<button type="button" id="add_more" class="btn btn-secondary">Add More</button>
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
    var idx = <?php echo e(isset($disableSlotArr) ? count($disableSlotArr) : 1); ?>;
    $('#add_more').on('click', function(){
        var row = $('.disable_item:first').clone();
        row.find('input, select').each(function(){
            var name = $(this).attr('name');
            name = name.replace('[0]', '['+idx+']');
            $(this).attr('name', name).val('');
        });
        $('#disable_dates_wrapper').append(row);
        idx++;
    });

    $(document).on('change', '.full-day', function(){
        var isFull = $(this).val() === '1';
        var row = $(this).closest('.disable_item');
        row.find('.time-range input').prop('disabled', isFull);
        if(isFull){ row.find('.time-range input').val(''); }
    });
});
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/feature/bookingblocks/edit.blade.php ENDPATH**/ ?>