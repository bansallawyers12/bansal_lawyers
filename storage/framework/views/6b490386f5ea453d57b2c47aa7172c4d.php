
<?php $__env->startSection('title', 'Add New Case'); ?>

<?php $__env->startSection('content'); ?>

<!-- Main Content -->
<div class="main-content">
<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<!-- Flash Message Start -->
					<div class="server-error">
						<?php echo $__env->make('../Elements/flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
					</div>
					<!-- Flash Message End -->
				</div>
				<div class="col-md-12">
					<div class="card card-primary">
					  <div class="card-header">
						<h3 class="card-title">Create Case</h3>
					  </div>
					  <!-- /.card-header -->
					  <!-- form start -->
					  <form action="admin/recent_case/store" autocomplete="off" method="post" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>

						<div class="card-body">
							<div class="form-group" style="text-align:right;">
								<a style="margin-right:5px;" href="<?php echo e(route('admin.recent_case.index')); ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
								<button type="button" class="btn btn-primary" onClick="customValidate('add-case')"><i class="fa fa-save"></i> Save Case</button>
							</div>
							<div class="form-group row">
								<label for="title" class="col-sm-2 col-form-label">Title <span style="color:#ff0000;">*</span></label>
								<div class="col-sm-10">
								<input name="title" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter Title">
								<?php if($errors->has('title')): ?>
									<span class="custom-error" role="alert">
										<strong><?php echo e($errors->first('title')); ?></strong>
									</span>
								<?php endif; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="slug" class="col-sm-2 col-form-label">Slug <span style="color:#ff0000;">*</span></label>
								<div class="col-sm-10">
									<input name="slug" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter Slug">
									<?php if($errors->has('slug')): ?>
										<span class="custom-error" role="alert">
											<strong><?php echo e($errors->first('slug')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row">
								<label for="image" class="col-sm-2 col-form-label">Featured Image/Video </label>
								<div class="col-sm-10">
									<div class="custom-file">
										<input type="file" id="image" name="image" class="custom-file-input" autocomplete="off" data-valid="">
										<label class="custom-file-label" for="image">Choose file</label>
										<!--<span class="file_note" style="line-height: 30px;">Please Image Size should be 600/400 ( Video-max size - 8mb ).</span>-->
									</div>
									<?php if($errors->has('image')): ?>
										<span class="custom-error" role="alert">
											<strong><?php echo e($errors->first('image')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>


                            <div class="form-group row">
                                <label for="image_alt" class="col-sm-2 col-form-label">Image Alt Attr</label>
                                <div class="col-sm-10">
                                <input name="image_alt" type="text" value="<?php echo e(old('image_alt')); ?>" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Image Alt Attr">
                                <?php if($errors->has('image_alt')): ?>
                                    <span class="custom-error" role="alert">
                                        <strong><?php echo e($errors->first('image_alt')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                </div>
                            </div>


							<div class="form-group row">
								<label for="short_description" class="col-sm-2 col-form-label">Short Description </label>
								<div class="col-sm-10">
								<input name="short_description" type="text" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Short Description">
								<?php if($errors->has('short_description')): ?>
									<span class="custom-error" role="alert">
										<strong><?php echo e($errors->first('short_description')); ?></strong>
									</span>
								<?php endif; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="description" class="col-sm-2 col-form-label">Description</label>
								<div class="col-sm-10">
									<textarea class="form-control"  id="description" placeholder="Please Add Description Here" rows="5" name="description"></textarea>
                                </div>
							</div>

							<div class="form-group row">
                                <label for="meta_title" class="col-sm-2 col-form-label">Meta Title </label>
                                <div class="col-sm-10">
                                <input name="meta_title" type="text" value="<?php echo e(old('meta_title')); ?>" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Meta Title">
                                <?php if($errors->has('meta_title')): ?>
                                    <span class="custom-error" role="alert">
                                        <strong><?php echo e($errors->first('meta_title')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="meta_description" class="col-sm-2 col-form-label">Meta Description </label>
                                <div class="col-sm-10">
                                    <textarea name="meta_description" data-valid="" class="form-control" placeholder="Enter Meta Description"><?php echo e(old('meta_description')); ?></textarea>
                                    <?php if($errors->has('meta_description')): ?>
                                        <span class="custom-error" role="alert">
                                            <strong><?php echo e($errors->first('meta_description')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="meta_keyword" class="col-sm-2 col-form-label">Meta Keyword</label>
                                <div class="col-sm-10">
                                    <input name="meta_keyword" type="text" value="<?php echo e(old('meta_keyword')); ?>" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Meta Keyword">
                                    <?php if($errors->has('meta_keyword')): ?>
                                        <span class="custom-error" role="alert">
                                            <strong><?php echo e($errors->first('meta_keyword')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="youtube_url" class="col-sm-2 col-form-label">Youtube Video Url</label>
                                <div class="col-sm-10">
                                    <input name="youtube_url" type="text" value="<?php echo e(old('youtube_url')); ?>" class="form-control" data-valid="" autocomplete="off" placeholder="Enter youtube video url">
                                    <?php if($errors->has('youtube_url')): ?>
                                        <span class="custom-error" role="alert">
                                            <strong><?php echo e($errors->first('youtube_url')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group row">
								<label for="pdf_doc" class="col-sm-2 col-form-label">PDF/Video</label>
								<div class="col-sm-10">
									<div class="custom-file">
										<input type="file" id="pdf_doc" name="pdf_doc" class="custom-file-input" autocomplete="off" data-valid="">
										<label class="custom-file-label" for="pdf_doc">Choose file</label>
										<span class="file_note" style="line-height: 30px;">Please Upload PDF/Video</span>
									</div>
									<?php if($errors->has('pdf_doc')): ?>
										<span class="custom-error" role="alert">
											<strong><?php echo e($errors->first('pdf_doc')); ?></strong>
										</span>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-group row">
								<label for="status" class="col-sm-2 col-form-label">Is Active</label>
								<div class="col-sm-10">
									<input value="1" type="checkbox" name="status" data-bootstrap-switch>
								</div>
							</div>
							<div class="form-group float-right">
								<button type="button" class="btn btn-primary" onClick="customValidate('add-case')"><i class="fa fa-save"></i> Save Case</button>
							</div>
						</div>
					  </form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/ckfinder/ckfinder.js')); ?>" type="text/javascript"></script>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
	  $('.if_image').hide();
    }
  };



    /*var sharedCKEditorToolbarConfig = {
        toolbar: [
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
                { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
                { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                { name: 'insert', items: [  'Table', 'HorizontalRule',   'SpecialChar', 'PageBreak' ] },
                '/',
                { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor', 'BGColor', 'EmojiPanel' ] },
                { name: 'document', items: [ 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] },
                { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' , 'Source' ] },
            ] ,
        extraPlugins: 'textwatcher,textmatch,autocomplete,emoji'
    };
    CKEDITOR.replace('description',sharedCKEditorToolbarConfig);*/
    var description = CKEDITOR.replace('description'); //sharedCKEditorToolbarConfig
    CKFinder.setupCKEditor(description);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/recent_case/create.blade.php ENDPATH**/ ?>