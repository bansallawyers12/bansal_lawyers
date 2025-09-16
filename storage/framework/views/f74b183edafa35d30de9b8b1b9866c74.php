
<?php $__env->startSection('title', 'Pages'); ?>

<?php $__env->startSection('content'); ?>
<style>
.fc-event-container .fc-h-event{cursor:pointer;}
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
							<h4>Pages</h4>
						</div>
                    </div> 
                </div>
				<div class="col-12 col-md-12 col-lg-12">
					<div class="card"> 
						<div class="card-header">
                            <div class="col-md-6">   
                                <div class="card-title">
                                    <a href="<?php echo e(route('admin.cms_pages.create')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> New Page</a> 
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="card-tools card_tools">
                                    <form action="<?php echo e(route('admin.cms_pages.index')); ?>" method="get">
                                    
                                        <div class="input-group input-group-sm" >
                                            <input type="text" name="search_term" class="form-control float-right" value="<?php if(isset($_REQUEST['search_term']) && $_REQUEST['search_term'] !=""){echo $_REQUEST['search_term'];}?>" placeholder="Search">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
						</div>  
						<div class="card-body table-responsive">
							<table id="hoteltable" class="table table-bordered table-hover text-nowrap">
							  <thead>
								<tr>
								  <th>Id</th>
                                  <th>Image</th>
								  <th>Title</th>
								  <th>Slug</th>
                                  <th>Status</th>
								  <th class="no-sort">Action</th>
								</tr> 
							  </thead>
							  <tbody class="tdata">	
							  
								<?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
								<tr id="id_<?php echo e($list->id); ?>"> 
								 <td><?php echo e(++$i); ?></td>
                                  <td style="white-space: initial;">
									<?php if(isset($list->image) && $list->image != "" && file_exists(public_path('img/cmspage/' . $list->image))): ?>
										<img src="<?php echo e(asset('images/cmspage/' . $list->image)); ?>" style="width: 50px;height: 50px;"/>
									<?php else: ?>
										<img src="<?php echo e(asset('images/avatars/no_image.jpeg')); ?>" style="width: 50px;height: 50px;"/>
									<?php endif; ?>
								  </td>
								  <td style="white-space: initial;"><?php echo e($list->title == "" ? config('constants.empty') : \Illuminate\Support\Str::limit($list->title, '50', '...')); ?></td> 
								  <td style="white-space: initial;"><?php echo e($list->slug); ?></td> 
                                  
                                  <td style="white-space: initial;"><input data-id="<?php echo e($list->id); ?>"  data-status="<?php echo e($list->status); ?>" data-col="status" data-table="cms_pages" class="change-status" value="1" type="checkbox" name="status" <?php echo e(($list->status == 1 ? 'checked' : '')); ?> data-bootstrap-switch></td>

				
								  <td>
									<a href="<?php echo e(URL::to('/admin/cms_pages/edit/'.base64_encode(convert_uuencode($list->id)))); ?>"><i class="fa fa-edit"></i></a>
									<a href="javascript:;" onClick="deleteAction(<?php echo e($list->id); ?>, 'cms_pages')"> <i class="fa fa-trash"></i></a>

								  </td>
								</tr>	
							  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
								
							  </tbody> 
							 
							</table>
							<div class="card-footer hide">
							<?php echo $lists->appends(\Request::except('page'))->render(); ?>

							 </div>
						  </div>
					</div>	
				</div>
			</div>
		</div>
	</section>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/cms_page/index.blade.php ENDPATH**/ ?>