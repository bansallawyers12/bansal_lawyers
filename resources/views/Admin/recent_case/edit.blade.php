@extends('layouts.admin')
@section('title', 'Edit Case')
@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
        <div class="section-body">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Case</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="admin/recent_case/edit" autocomplete="off" method="post">
                    <input type="hidden" name="id" value="@$fetchedData->id">
                    <div class="card-body">
                        <div class="form-group" style="text-align:right;">
                            <a style="margin-right:5px;" href="{{route('admin.recent_case.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                            <button type="button" class="btn btn-primary" onClick="customValidate("edit-case")"><i class="fa fa-save"></i> Update Case</button>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title <span style="color:#ff0000;">*</span></label>
                            <div class="col-sm-10">
                                <input name="title" type="text" value="@$fetchedData->title" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter Title">
                                @if ($errors->has('title'))
                                    <span class="custom-error" role="alert">
                                        <strong>{{ @$errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="slug" class="col-sm-2 col-form-label">Slug <span style="color:#ff0000;">*</span></label>
                            <div class="col-sm-10">
                                <input name="slug" type="text" value="@$fetchedData->slug" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter Slug">
                                @if ($errors->has('slug'))
                                    <span class="custom-error" role="alert">
                                        <strong>{{ @$errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Featured Image/Video </label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="hidden" id="old_image" name="old_image" value="{{@$fetchedData->image}}" />
                                    <input type="file" id="image" name="image" class="custom-file-input" autocomplete="off">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                    <!--<span class="file_note" style="line-height: 30px;">Please Image Size should be 600/400 ( Video-max size - 8mb ).</span>-->
                                </div>
                                <div class="upload_img">
                                    {{--@if(@$fetchedData->image != '')--}}
                                        <!--<img width="70" src="{{URL::to('/public/img/blog')}}/{{@$fetchedData->image}}" class="<?php echo @$fetchedData->title; ?>"/>-->
                                    {{--@endif--}}

                                    <?php
                                    if(isset($fetchedData->image) && $fetchedData->image != ""){
                                        $extension = pathinfo($fetchedData->image, PATHINFO_EXTENSION); //echo $extension;
                                        if( strtolower($extension) == 'mp4' ){
                                            //$src = 'https://bansallawyers.com.au/public/img/blog/'.$fetchedData->image.'?autoplay=1&mute=1';
                                            ?>
                                            <iframe width="200" height="100" src="{{URL::to('/public/img/blog')}}/{{@$fetchedData->image}}?autoplay=1&mute=1"></iframe>
                                        <?php
                                        } else if(strtolower($extension) == 'pdf') {
                                            //$pdfUrl = 'https://bansallawyers.com.au/public/img/blog/'.$fetchedData->image;
                                            ?>
                                            <a href="{{URL::to('/public/img/blog')}}/{{@$fetchedData->image}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Click Here To View"><img src="{{URL::to('/public/img/avatars/pdf_icon.png')}}" alt="" style="width:80px;height:80px;border-radius: 50%;"></a>
                                            <?php
                                        } else { ?>
                                            <img width="70" src="{{URL::to('/public/img/blog')}}/{{@$fetchedData->image}}" class="<?php echo @$fetchedData->title; ?>"/>
                                        <?php
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="image_alt" class="col-sm-2 col-form-label">Image Alt Attr</label>
                            <div class="col-sm-10">
                            <input name="image_alt" type="text" value="@$fetchedData->image_alt" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Image Alt Attr">
                            @if ($errors->has('image_alt'))
                                <span class="custom-error" role="alert">
                                    <strong>{{ @$errors->first('image_alt') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="short_description" class="col-sm-2 col-form-label">Short Description </label>
                            <div class="col-sm-10">
                                <input name="short_description" type="text" value="@$fetchedData->short_description" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Short Description">
                                @if ($errors->has('short_description'))
                                    <span class="custom-error" role="alert">
                                        <strong>{{ @$errors->first('short_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control"  id="description" placeholder="Please Add Description Here" rows="5" name="description">{{@$fetchedData->description}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="meta_title" class="col-sm-2 col-form-label">Meta Title </label>
                            <div class="col-sm-10">
                            <input name="meta_title" type="text" value="@$fetchedData->meta_title" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Meta Title">
                            @if ($errors->has('meta_title'))
                                <span class="custom-error" role="alert">
                                    <strong>{{ @$errors->first('meta_title') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="meta_description" class="col-sm-2 col-form-label">Meta Description </label>
                            <div class="col-sm-10">
                                <textarea name="meta_description" data-valid="" value="" class="form-control" placeholder="Please Add Description Here">{{@$fetchedData->meta_description}}</textarea>
                                @if ($errors->has('meta_description'))
                                    <span class="custom-error" role="alert">
                                        <strong>{{ @$errors->first('meta_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="meta_keyword" class="col-sm-2 col-form-label">Meta Keyword</label>
                            <div class="col-sm-10">
                                <input name="meta_keyword" type="text" value="@$fetchedData->meta_keyword" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Meta Keyword">
                                @if ($errors->has('meta_keyword'))
                                    <span class="custom-error" role="alert">
                                        <strong>{{ @$errors->first('meta_keyword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="youtube_url" class="col-sm-2 col-form-label">Youtube Video Url</label>
                            <div class="col-sm-10">
                                <input name="youtube_url" type="text" value="@$fetchedData->youtube_url" class="form-control" data-valid="" autocomplete="off" placeholder="Enter youtube video url">
                                @if ($errors->has('youtube_url'))
                                    <span class="custom-error" role="alert">
                                        <strong>{{ @$errors->first('youtube_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pdf_doc" class="col-sm-2 col-form-label">PDF/Video </label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="hidden" id="old_pdf" name="old_pdf" value="{{@$fetchedData->pdf_doc}}" />
                                    <input type="file" id="pdf_doc" name="pdf_doc" class="custom-file-input" autocomplete="off">
                                    <label class="custom-file-label" for="pdf_doc">Choose file</label>
                                    <span class="file_note" style="line-height: 30px;">Please Upload PDF/Video</span>
                                </div>
                                <div class="upload_img">
                                    @if(@$fetchedData->pdf_doc != '')
                                        <a target="_blank" href="https://bansallawyers.com.au/public/img/blog/{{@$fetchedData->pdf_doc}}">Click Here To Open PDF/Video</a>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Is Active</label>
                            <div class="col-sm-10">
                                <input value="1" type="checkbox" name="status" {{ (@$fetchedData->status == 1 ? 'checked' : '')}} data-bootstrap-switch>
                            </div>
                        </div>

                        <div class="form-group float-right">
                            <button type="button" class="btn btn-primary" onClick="customValidate("edit-case")"><i class="fa fa-save"></i> Update Case</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
	</section>
</div>

@endsection
@section('scripts')
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script src="{{ asset('public/assets/ckfinder/ckfinder.js') }}" type="text/javascript"></script>
<script>
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
@endsection
