@extends('layouts.admin')
@section('title', 'Edit Email')

@section('content')

<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<form action="admin/emails/edit" autocomplete="off" method="post"> 
			<input type="hidden" name="id" value="@$fetchedData->id">
				<div class="row">   
					<div class="col-12 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4>Edit Email</h4>
								<div class="card-header-action">
									<a href="{{route('admin.emails.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
								</div>
							</div>
						</div>
					</div>
					 <div class="col-3 col-md-3 col-lg-3">
			        	@include('../Elements/Admin/setting')
    		        </div>       
    				<div class="col-9 col-md-9 col-lg-9">
						<div class="card">
							<div class="card-body">
								<div id="accordion"> 
									<div class="accordion">
										<div class="accordion-header" role="button" data-toggle="collapse" data-target="#primary_info" aria-expanded="true">
											<h4>Primary Information</h4>
										</div>
										<div class="accordion-body collapse show" id="primary_info" data-parent="#accordion">
											<div class="row"> 						
												<div class="col-12 col-md-12 col-lg-12">
													<div class="form-group"> 
														<label for="email">Email Id <span class="span_req">*</span></label>
														<input name="email" type="text" value="@$fetchedData->email" class="form-control" data-valid="required" autocomplete="off" placeholder="">
														@if ($errors->has('email'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('email') }}</strong>
															</span> 
														@endif
													</div>
												</div>
												<div class="col-12 col-md-12 col-lg-12">
													<div class="form-group"> 
														<label for="status">Status</label><br>
														<label ><input <?php if(@$fetchedData->status == 1){ echo 'checked'; } ?> type="checkbox" name="status" value="1"> Enable This Feature</label>
													</div>
												</div>
												<div class="col-12 col-md-12 col-lg-12">
													<div class="form-group"> 
														<label for="display_name">Display Name</label>
														<input name="display_name" type="text" value="@$fetchedData->display_name" class="form-control" data-valid="" autocomplete="off" placeholder="">
														@if ($errors->has('display_name'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('display_name') }}</strong>
															</span> 
														@endif
													</div>
												</div>
												<div class="col-12 col-md-12 col-lg-12">
													<h4>User Sharing</h4>
													<div class="form-group"> 
														<label for="display_name">Select Users</label>
														<select data-valid="required" multiple class="form-control select2" name="users[]">
															<option value="">Select User</option>
															<?php
															$userids = json_decode($fetchedData->user_id);
																$users = \App\Models\Admin::Where('role', '!=', '7')->Where('status', '=', 1)->get();
																foreach($users as $user){
																	?>
																	<option <?php if(in_array($user->id, $userids)){ echo 'selected'; } ?> value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
																	<?php
																}
															?>
														</select>
														
													</div>
												</div>
												<div class="col-12 col-md-12 col-lg-12">
													<div class="form-group"> 
														<label for="status">Company Email Signature</label><br>
														<textarea class="form-control summernote-simple" name="email_signature">{{@$fetchedData->email_signature}}</textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group float-right">
									<button type="button" class="btn btn-primary" onClick="customValidate("add-emails")">Update</button>
								</div> 
							</div>
						</div>	
					</div>
				</div>
			 </form>	
		</div>
	</section>
</div>

@endsection