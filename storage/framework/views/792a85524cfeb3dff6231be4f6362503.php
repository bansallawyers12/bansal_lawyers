
<?php $__env->startSection('title', 'Appointments'); ?>

<?php $__env->startSection('content'); ?>
<style>
.fc-event-container .fc-h-event{cursor:pointer;}
#openassigneview .modal-body ul.navbar-nav li .dropdown-menu{transform: none!important; top:40px!important;}
</style>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="server-error">
				<?php echo $__env->make('../Elements/flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
			</div>
			<div class="custom-error-msg">
			</div>
			<div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-header">
							<h4>Appointments</h4>
							<div class="card-header-action">
								<!-- <a href=""  class="btn btn-primary is_checked_clientn">Create Template</a> -->
							</div>
						</div>
						<div class="card-body">
							<div class="tab-content" id="quotationContent">
                                <form action="<?php echo e(route('appointments.index')); ?>" method="get">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- <select  class="form-control mb-3" name="filter">
                                                <option>All Appointments</option>
                                                <option value="today">Today</option>
                                                <option value="last week">Last Week</option>
                                                <option value="previous month">Previous Month</option>
                                                <option value="last 6 month">Last 6 Months</option>
                                                <option value="last year">Last Year</option>
                                            </select> -->
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control mb-3" placeholder="Search with client refernce and description" name="q" value="<?php if( isset($_REQUEST['q']) && $_REQUEST['q'] != ""){ echo $_REQUEST['q'];}?>">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="submit" class="form-control mb-3 btn btn-primary" value="Search">
                                        </div>
                                    </div>
                                </form>
								<div class="tab-pane fade show active" id="active_quotation" role="tabpanel" aria-labelledby="active_quotation-tab">
									<div class="table-responsive common_table">
									<!-- <?php if($message = Session::get('success')): ?>
										<div class="alert alert-success">
											<p><?php echo e($message); ?></p>
										</div>
									<?php endif; ?>   -->
									<table class="table table-bordered">
										<tr>
											<th>#</th>
                                            <th>Client</th>
											<th>DateTime</th>
                                            <th>Nature of enquiry</th>
											<th>Desciption</th>
                                            <th>Added By</th>
											<!-- <th>Invites</th> -->
											<th>status</th>
											<th width="280px">Action</th>
										</tr>
										<?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

										<tr>
											<td><?php echo e(++$i); ?></td>
                                            <td>
                                                <?php echo e($appointment->clients->first_name); ?>  <?php echo e($appointment->clients->last_name); ?> <br>
                                                <?php echo e($appointment->clients->client_id); ?>

                                                <!--<a href="" target="_blank" ></a>-->
                                            
                                            </td>
											<td><?php echo e(date('d/m/Y', strtotime($appointment->date ))); ?> <?php echo e($appointment->time); ?></td>
                                            <?php if($appointment->natureOfEnquiry): ?>
											<td><?php echo e($appointment->natureOfEnquiry->title); ?></td>
											<?php else: ?>
											<td>N/A</td>
											<?php endif; ?>
                                            <td><?php echo e($appointment->description); ?></td>
                                            <?php if($appointment->user): ?>
											   <td><?php echo e($appointment->user->first_name); ?>  <?php echo e($appointment->user->last_name); ?></td>
											<?php else: ?>
											   <td><?php echo e('N/A'); ?></td>
											<?php endif; ?>
											<!-- <td></td> -->

											<?php if($appointment->status == 0): ?>
											<td><span title="draft" class="ui label uppercase badge bg-warning">Pending</span></td>
											<?php elseif($appointment->status == 1): ?>
											<td><span title="draft" class="ui label uppercase badge bg-success">Approved</span></td>
											<?php elseif($appointment->status == 2): ?>
											<td><span title="draft" class="ui label uppercase badge bg-success">Completed</span></td>
											<?php elseif($appointment->status == 3): ?>
											<td><span title="draft" class="ui label uppercase badge bg-danger">Rejected</span></td>
											<?php elseif($appointment->status == 4): ?>
											<td><span title="draft" class="ui label uppercase badge bg-primary">N/P</span></td>
											<?php elseif($appointment->status == 5): ?>
											<td><span title="draft" class="ui label uppercase badge bg-primary">Inrogress</span></td>
											<?php elseif($appointment->status == 6): ?>
											<td><span title="draft" class="ui label uppercase badge bg-primary">Did Not Come</span></td>
											<?php elseif($appointment->status == 7): ?>
											<td><span title="draft" class="ui label uppercase badge bg-primary">Cancelled</span></td>
											<?php elseif($appointment->status == 8): ?>
											<td><span title="draft" class="ui label uppercase badge bg-primary">Missed</span></td>
											<?php elseif($appointment->status == 9): ?>
											<td><span title="draft" class="ui label uppercase badge bg-warning">Pending With Payment Pending</span></td>
											<?php elseif($appointment->status == 10): ?>
											<td><span title="draft" class="ui label uppercase badge bg-success">Pending With Payment Success</span></td>
											<?php elseif($appointment->status == 11): ?>
											<td><span title="draft" class="ui label uppercase badge bg-warning">Pending With Payment Failed</span></td>
											<?php endif; ?>

                                            <td>
												<form action="<?php echo e(route('appointments.destroy',$appointment->id)); ?>" method="POST">
                                                    <a class="btn btn-info" href="<?php echo e(route('appointments.show',$appointment->id)); ?>">Show</a>
                                                    <a class="btn btn-primary" href="<?php echo e(route('appointments.edit',$appointment->id)); ?>">Edit</a>
                                                    
                                                    <?php echo csrf_field(); ?>
													<?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
													
												</form>
											</td>
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</table>
   										 <?php echo $appointments->appends($_GET)->links(); ?>

								</div>
								<div class="card-footer">

								</div>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
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
		// console.log($('#changeassignee').val());
		$.ajax({
			url: site_url+'/admin/change_assignee',
			type:'GET',
			data:{id: appliid,assinee: assinee},
			success: function(response){
				// console.log(response);
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
//////appointment pending todo
	$(document).delegate('.savecomment', 'click', function(){
		var visitcomment = $('.taskcomment').val();
		var appliid = $(this).attr('data-id');
		$('.popuploader').show();
		$.ajax({
			url: site_url+'/admin/update_apppointment_comment',
			type:'POST',
			data:{"_token":$('meta[name="csrf-token"]').attr('content'),id: appliid,visit_comment:visitcomment},
			success: function(responses){
				// $('.popuploader').hide();
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
	// $('.popuploader').hide();
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
				    console.log(obj.status);
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
						console.log(responses);
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