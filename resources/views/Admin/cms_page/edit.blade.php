@extends('layouts.admin')
@section('title', 'Edit Page')

@section('content')

<!-- Main Content -->
<div class="main-content">
<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<!-- Flash Message Start -->
					<div class="server-error">
						@include('../Elements/flash-message')
					</div>
					<!-- Flash Message End -->
				</div>
				<div class="col-md-12">
					<div class="card card-primary">
					  <div class="card-header">
						<h3 class="card-title">Edit Page</h3>
					  </div>
					  <!-- /.card-header -->
					  <!-- form start -->
					  <!-- form start -->
                	  <form action="{{ route('admin.edit_cms_page') }}" autocomplete="off" method="post" enctype="multipart/form-data" name="edit-template" id="edit-template">
				   @csrf
				   <input type="hidden" name="id" value="{{ $fetchedData->id ?? '' }}">
						<div class="card-body">
							<div class="form-group" style="text-align:right;">
								<a style="margin-right:5px;" href="{{route('admin.cms_pages.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
								<button type="button" class="btn btn-primary" onClick="customValidate('edit-template')"><i class="fa fa-save"></i> Update Page</button>
							</div>
							<div class="form-group row">
								<label for="title" class="col-sm-2 col-form-label">Name <span style="color:#ff0000;">*</span></label>
								<div class="col-sm-10">
								<input name="title" type="text" value="{{ old('title', $fetchedData->title ?? '') }}" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter Name">
								@if ($errors->has('title'))
									<span class="custom-error" role="alert">
										<strong>{{ $errors->first('title') }}</strong>
									</span>
								@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="slug" class="col-sm-2 col-form-label">Slug <span style="color:#ff0000;">*</span></label>
								<div class="col-sm-10">
									<input name="slug" type="text" value="{{ old('slug', $fetchedData->slug ?? '') }}" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter Slug">
									@if ($errors->has('slug'))
										<span class="custom-error" role="alert">
											<strong>{{ $errors->first('slug') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="image" class="col-sm-2 col-form-label">Image</label>
								<div class="col-sm-10">
									<input type="hidden" id="old_image" name="old_image" value="{{ $fetchedData->image ?? '' }}" />
									<input type="file" name="image" class="form-control" autocomplete="off"  />
									<div class="show-uploded-img">
										@if(!empty($fetchedData->image))
											<img width="70" src="{{URL::to('public/img/cmspage')}}/{{ $fetchedData->image }}" class="img-avatar"/>
										@endif
										@if ($errors->has('image'))
											<span class="custom-error" role="alert">
												<strong>{{ $errors->first('image') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>
                          
                            <div class="form-group row">
								<label for="image_alt" class="col-sm-2 col-form-label">Image Alt Attr</label>
								<div class="col-sm-10">
								<input name="image_alt" type="text" value="{{ old('image_alt', $fetchedData->image_alt ?? '') }}" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Image Alt Attr">
								@if ($errors->has('image_alt'))
									<span class="custom-error" role="alert">
										<strong>{{ $errors->first('image_alt') }}</strong>
									</span>
								@endif
								</div>
							</div>
                          
							<div class="form-group row">
								<label for="description" class="col-sm-2 col-form-label">Description <span style="color:#ff0000;">*</span></label>
								<div class="col-sm-10">
									<!--<textarea name="description" data-valid="required" value="" class="textarea" placeholder="Please Add Description Here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$fetchedData->content}}</textarea>-->

									<textarea class="form-control"  id="description" placeholder="Please Add Description Here" rows="5" name="description">{!! old('description', $fetchedData->content ?? '') !!}</textarea>

									@if ($errors->has('description'))
										<span class="custom-error" role="alert">
											<strong>{{ $errors->first('description') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label for="meta_title" class="col-sm-2 col-form-label">Meta Title </label>
								<div class="col-sm-10">
								<input name="meta_title" type="text" value="{{ old('meta_title', $fetchedData->meta_title ?? '') }}" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Meta Title">
								@if ($errors->has('meta_title'))
									<span class="custom-error" role="alert">
										<strong>{{ $errors->first('meta_title') }}</strong>
									</span>
								@endif
								</div>
							</div>
							<div class="form-group row">
								<label for="meta_description" class="col-sm-2 col-form-label">Meta Description </label>
								<div class="col-sm-10">
									<textarea name="meta_description" data-valid="" value="" class="form-control" placeholder="Please Add Description Here">{{ old('meta_description', $fetchedData->meta_description ?? '') }}</textarea>
									@if ($errors->has('meta_description'))
										<span class="custom-error" role="alert">
											<strong>{{ $errors->first('meta_description') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label for="meta_keyward" class="col-sm-2 col-form-label">Meta Keyward</label>
								<div class="col-sm-10">
								<input name="meta_keyward" type="text" value="{{ old('meta_keyward', $fetchedData->meta_keyward ?? '') }}" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Meta Keyward">
								@if ($errors->has('meta_keyward'))
									<span class="custom-error" role="alert">
										<strong>{{ $errors->first('meta_keyward') }}</strong>
									</span>
								@endif
								</div>
							</div>

                            <div class="form-group row">
                                <label for="youtube_url" class="col-sm-2 col-form-label">Youtube Video Url</label>
                                <div class="col-sm-10">
                                <input name="youtube_url" type="text" value="{{ old('youtube_url', $fetchedData->youtube_url ?? '') }}" class="form-control" data-valid="" autocomplete="off" placeholder="Enter youtube video url">
                                @if ($errors->has('youtube_url'))
                                    <span class="custom-error" role="alert">
                                        <strong>{{ $errors->first('youtube_url') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>


                            <div class="form-group row">
								<label for="pdf_doc" class="col-sm-2 col-form-label">PDF/Video </label>
								<div class="col-sm-10">
									<div class="custom-file">
										<input type="hidden" id="old_pdf" name="old_pdf" value="{{ $fetchedData->pdf_doc ?? '' }}" />
										<input type="file" id="pdf_doc" name="pdf_doc" class="custom-file-input" autocomplete="off">
										<label class="custom-file-label" for="pdf_doc">Choose file</label>
										<span class="file_note" style="line-height: 30px;">Please Upload PDF/Video</span>
									</div>
									<div class="upload_img">
										@if(!empty($fetchedData->pdf_doc))
											<a target="_blank" href="https://{{ $_SERVER['HTTP_HOST'] }}/public/img/blog/{{ $fetchedData->pdf_doc }}">Click Here To Open PDF/Video</a>
										@endif
									</div>
								</div>
							</div>
                          
                          
                           <div class="form-group row">
								<label for="status" class="col-sm-2 col-form-label">Is Active</label>
								<div class="col-sm-10">
									<input value="1" type="checkbox" name="status" {{ (old('status', $fetchedData->status ?? 0) == 1 ? 'checked' : '')}} data-bootstrap-switch>
								</div>
							</div>

							<div class="form-group float-right">
								<button type="button" class="btn btn-primary" onClick="customValidate('edit-template')"><i class="fa fa-save"></i> Update Page</button>
							</div>
						</div>
					  </form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script>
var sharedCKEditorToolbarConfig = {
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

// Wait for DOM to be ready before initializing CKEditor
$(document).ready(function() {
    // Check if CKEditor is loaded and description element exists
    if (typeof CKEDITOR !== 'undefined') {
        var descriptionElement = document.getElementById('description');
        if (descriptionElement) {
            CKEDITOR.replace('description', sharedCKEditorToolbarConfig);
        } else {
            console.warn('Description element not found for CKEditor initialization');
        }
    } else {
        console.warn('CKEditor library not loaded');
    }
});
</script>
@endsection
