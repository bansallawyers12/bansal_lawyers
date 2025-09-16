
<?php $__env->startSection('title', 'Blogs'); ?>

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
							<h4>Blogs</h4>
						</div>
                    </div>
                </div>
              
				<div class="col-12 col-md-12 col-lg-12">
					<div class="card">
                      
						<div class="card-header">
                            <div class="col-md-6">
                                <div class="card-title">
                                    <a href="<?php echo e(route('admin.blog.create')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> New Blog</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-tools card_tools">
                                    <form action="<?php echo e(route('admin.blog.index')); ?>" method="get">
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

						<div class="card-body">
							<div class="tab-content" id="quotationContent">
								<div class="card-tools card_tools">
									<!-- <div class="input-group input-group-sm" style="width: 150px;">
										<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
										<div class="input-group-append">
											<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
										</div>
									</div>
								</div> -->
								<div class="tab-pane fade show active" id="active_quotation" role="tabpanel" aria-labelledby="active_quotation-tab">
									<div class="table-responsive common_table">
									<table id="hoteltable" class="table table-bordered table-hover text-nowrap">
							  <thead>
								<tr>
								  <th>Image</th>
								  <th>Title</th>
								  <th>Slug</th>
								  <th>Category</th>
								  <th>Status</th>
								  <th class="no-sort">Action</th>
								</tr>
							  </thead>
							  <tbody class="tdata">
								<?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<!-- <tr id="id_<?php echo e($list->id); ?>">  -->
								  <!-- <td><?php echo e($list->id); ?></td>  -->
								 
								  <!--<td><img src="<?php echo e(asset('images/blog/' . $list->image)); ?>" alt="" style="width:80px;height:80px;border-radius: 50%;"></td>-->
								  
								  <!--<td><img src="<?php echo e(asset('images/avatars/no_image.jpeg')); ?>" alt="" style="width:80px;height:80px;border-radius: 50%;"></td>-->
								 

								    <?php
                                    if(isset($list->image) && $list->image != ""){
                                        $extension = pathinfo($list->image, PATHINFO_EXTENSION); //echo $extension;
                                        if( strtolower($extension) == 'mp4' ){ ?>
                                            <td><img src="<?php echo e(asset('images/avatars/mp4-outline.png')); ?>" alt="" style="width:80px;height:80px;border-radius: 50%;"></td>
                                        <?php } else if(strtolower($extension) == 'pdf') { ?>
                                            <td><img src="<?php echo e(asset('images/avatars/pdf_icon.png')); ?>" alt="" style="width:80px;height:80px;border-radius: 50%;"></td>
                                        <?php } else { ?>
                                            <td><img src="<?php echo e(asset('images/blog/' . $list->image)); ?>" alt="" style="width:80px;height:80px;border-radius: 50%;"></td>
                                        <?php
                                        }
                                    } else {?>
                                        <td><img src="<?php echo e(asset('images/avatars/no_image.jpeg')); ?>" alt="" style="width:80px;height:80px;border-radius: 50%;"></td>
                                    <?php } ?>

								  <td style="white-space: initial;"><?php echo e($list->title == "" ? config('constants.empty') : \Illuminate\Support\Str::limit($list->title, '50', '...')); ?></td>
								  <td style="white-space: initial;"><?php echo e($list->slug); ?></td>
								  <td style="white-space: initial;"><?php echo e($list->categorydetail->name); ?></td>
								  <td style="white-space: initial;"><input data-id="<?php echo e($list->id); ?>"  data-status="<?php echo e($list->status); ?>" data-col="status" data-table="blogs" class="change-status" value="1" type="checkbox" name="status" <?php echo e(($list->status == 1 ? 'checked' : '')); ?> data-bootstrap-switch></td>
								  <td>
									<!-- <div class="nav-item dropdown action_dropdown"> -->
										<!-- <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a> -->
										<!-- <div class="dropdown-menu"> -->
											<a class="btn btn-info" href="<?php echo e(URL::to('/admin/blog/edit/'.base64_encode(convert_uuencode($list->id)))); ?>"> Edit</a>
											<a class="btn btn-danger" href="javascript:;" onClick="deleteAction(<?php echo e($list->id); ?>, 'blogs')"> Delete</a>
										<!-- </div>
									</div>  -->
								  </td>
								</tr>
							  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							  </tbody>

							</table>

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/blog/index.blade.php ENDPATH**/ ?>