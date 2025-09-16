
<?php $__env->startSection('title', 'Block Slot (New)'); ?>

<?php $__env->startSection('content'); ?>

<!-- Main Content -->
<div class="main-content">
		<section class="section">
				<div class="section-body">
						<div class="server-error">
								<?php echo $__env->make('../Elements/flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
						</div>
						<div class="custom-error-msg"></div>
						<div class="row">
								<div class="col-12 col-md-12 col-lg-12">
										<div class="card">
												<div class="card-header">
														<h4>Block Slot (New)</h4>
														<div class="card-header-action">
																<a href="<?php echo e(route('admin.feature.bookingblocks.create')); ?>" class="btn btn-primary">Create</a>
														</div>
												</div>
												<div class="card-body">
														<div class="table-responsive common_table">
																<table class="table text_wrap table-striped">
																<thead>
																		<tr>
																				<th>Person</th>
																				<th>Block Slot</th>
																				<th></th>
																		</tr>
																</thead>
																<?php if($totalData !== 0): ?>
																<?php $i=0; ?>
																<tbody class="tdata">
																<?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																		<tr id="id_<?php echo e($list->id); ?>">
																				<td>
																						Ajay
																				</td>

																				<td>
																					<?php if(isset($list->disabledSlots) && !empty($list->disabledSlots) && count($list->disabledSlots) > 0): ?>
																							<?php $__currentLoopData = $list->disabledSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slotVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																							<li>
																								<?php echo e(date("d/m/Y",strtotime($slotVal->disabledates))); ?> -
																								<?php if(isset($slotVal->block_all) && $slotVal->block_all == 1): ?>
																									Full Day Blocked
																								<?php else: ?>
																									<?php echo e($slotVal->slots); ?>

																								<?php endif; ?>
																							</li>
																						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																				<?php else: ?>
																					N/A
																				<?php endif; ?>
																			</td>

																			<td>
																				<div class="dropdown d-inline">
																					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
																					<div class="dropdown-menu">
																							<a class="dropdown-item has-icon" href="<?php echo e(route('admin.feature.bookingblocks.edit', $list->id)); ?>"><i class="far fa-edit"></i> Edit</a>
																							<a class="dropdown-item has-icon" href="javascript:;" onClick="deleteSlotAction(<?php echo e($list->id); ?>, 'book_service_disable_slots')"><i class="fas fa-trash"></i> Delete</a>
																					</div>
																				</div>
																			</td>
																</tr>
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																</tbody>
															<?php else: ?>
															<tbody>
																	<tr>
																		<td style="text-align:center;" colspan="7">No Record found</td>
																	</tr>
																</tbody>
															<?php endif; ?>
														</table>
												</div>
									</div>
							</div>
						</div>
				</div>
		</section>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script <?php echo \App\Services\CspService::getNonceAttribute(); ?>>
function deleteSlotAction( id, table ) {
    var conf = confirm('Are you sure, you want to delete the slot.');
    if(conf){
        if(id == '') {
            alert('Please select ID to delete the record.');
            return false;
        } else {
            $('.popuploader').show();
            $(".server-error").html('');
            $(".custom-error-msg").html('');
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
                        var html = successMessage(obj.message);
                        $(".custom-error-msg").html(html);
                    } else {
                        var html = errorMessage(obj.message);
                        $(".custom-error-msg").html(html);
                    }
                },
                error:function(resp) {
                    $('.popuploader').hide();
                    var html = errorMessage('Something went wrong. Please try again.');
                    $(".custom-error-msg").html(html);
                }
            });
        }
    }
}
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/feature/bookingblocks/index.blade.php ENDPATH**/ ?>