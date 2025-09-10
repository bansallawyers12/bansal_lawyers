<form action="admin/followup/update" autocomplete="off" method="post">

	<div class="customerror"></div> 
	<div class="form-group row">
		<div class="col-sm-12">
		 <label>Note Type</label>
		<select class="form-control" name="note_type">
		    <option value=""></option>
		    <?php
				$followuptypes = \App\Models\FollowupType::where('show',1)->get();
				foreach($followuptypes as $followuptype){
				?>
				 <option @if($followuptype->type == $fetchedData->followup_type) selected @endif value="{{$followuptype->type}}">{{$followuptype->name}}</option>
				<?php } ?>
		</select>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-sm-12">
		
			<input id="" name="lead_id" type="hidden" value="{{base64_encode(convert_uuencode(@$fetchedData->id))}}">
			<textarea id="description" name="description" class="form-control summernote-simple" placeholder="Add note" style="">{{$fetchedData->note}}</textarea>
		</div>
	</div>


 </form>
 <div class="modal-footer">
	<button type="button" class="btn btn-primary" onClick="customValidate("edit-note")"><i class="fa fa-save"></i> Save</button>
</div>