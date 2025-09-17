@extends('layouts.admin')
@section('title', 'My Profile')
@section('content')

<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="server-error">
				@include('Elements.flash-message')
			</div>
			<div class="custom-error-msg"></div>
			
			<form action="{{ route('admin.my_profile') }}" enctype="multipart/form-data" method="post">
				@csrf
				<input type="hidden" name="id" value="{{ $fetchedData->id }}">
				
				<div class="row">
					<div class="col-12 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4>My Profile</h4>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group"> 
											<label for="profile_img">Profile Image</label>
											<input type="hidden" id="old_profile_img" name="old_profile_img" value="{{ $fetchedData->profile_img }}" />
											<div class="profile_upload">
												<div class="upload_content">
													@if($fetchedData->profile_img != '')
														<img src="{{ @smartasset('images/profile_imgs/' . $fetchedData->profile_img) }}" style="width:100px;height:100px;" id="output"/>
													@else
														<img id="output" src="{{ @smartasset('images/avatars/no_image.jpeg')}}"/> 
													@endif
													<i class="fa fa-camera if_image" @if($fetchedData->profile_img != '') style="display:none;" @endif></i>
													<span class="if_image" @if($fetchedData->profile_img != '') style="display:none;" @endif>Upload Profile Image</span>
												</div>
												<input onchange="loadFile(event)" type="file" id="profile_img" name="profile_img" class="form-control" autocomplete="off" accept="image/*" />
											</div>	
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="first_name">First Name <span style="color:#ff0000;">*</span></label>
											<input name="first_name" type="text" value="{{ $fetchedData->first_name }}" class="form-control @error('first_name') is-invalid @enderror" data-valid="required" placeholder="Enter first name">
											@error('first_name')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="last_name">Last Name</label>
											<input name="last_name" type="text" value="{{ $fetchedData->last_name }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="Enter last name">
											@error('last_name')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="email">Email Address <span style="color:#ff0000;">*</span></label>
											<input name="email" type="email" value="{{ $fetchedData->email }}" class="form-control" disabled>
											<small class="form-text text-muted">Email cannot be changed</small>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="phone">Phone Number</label>
											<input name="phone" type="text" value="{{ $fetchedData->phone }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone number">
											@error('phone')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="company_name">Company Name</label>
											<input name="company_name" type="text" value="{{ $fetchedData->company_name }}" class="form-control @error('company_name') is-invalid @enderror" placeholder="Enter company name">
											@error('company_name')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
									</div>
								</div>
								
								<div class="form-group text-right">
									<button type="button" class="btn btn-primary px-4" onclick="customValidate('my-profile')">
										<i class="fa fa-save"></i> Update Profile
									</button>
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
@section('scripts')
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src); // free memory
	  $('.if_image').hide();
	  $('#output').css({'width':"100px",'height':"100px"});
    }
  };
</script>
@endsection