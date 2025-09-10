@extends('layouts.admin')
@section('title', 'Edit Manage Contacts')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Manage Contacts</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Manage Contacts</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->	
	<!-- Breadcrumb start-->
	<!--<ol class="breadcrumb">
		<li class="breadcrumb-item active">
			Home / <b>Dashboard</b>
		</li>
		@include('../Elements/Admin/breadcrumb')
	</ol>-->
	<!-- Breadcrumb end-->
	
	<!-- Main content --> 
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
			</div>
			<!-- form start -->
			<form action="admin/contact/edit" autocomplete="off" method="post">
			<input type="hidden" name="id" value="@$fetchedData->id">
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Edit Contacts</h3>
							</div>
						  <!-- /.card-header --> 
							<div class="card-body">
								<div class="form-group" style="text-align:right;">
									<a style="margin-right:5px;" href="{{route('admin.managecontact.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a> 
									<button type="button" class="btn btn-primary" onClick="customValidate("edit-contacts")"><i class="fa fa-edit"></i> Update Contact</button>
								</div> 	 
								<div class="form-group row">  
									<label for="srname" class="col-sm-2 col-form-label">Primary Name <span style="color:#ff0000;">*</span></label>
									<div class="col-sm-1">
										<select style="padding: 0px 5px;" name="srname" id="srname" class="form-control" autocomplete="new-password">
											<option value="Mr" @if(@$fetchedData->srname == 'Mr') selected  @endif>Mr</option>
											<option value="Mrs" @if(@$fetchedData->srname == 'Mrs') selected  @endif>Mrs</option>
											<option value="Ms" @if(@$fetchedData->srname == 'Ms') selected  @endif>Ms</option>
											<option value="Miss" @if(@$fetchedData->srname == 'Miss') selected @endif>Miss</option>
											<option value="Dr" @if(@$fetchedData->srname == 'Dr') selected @endif>Dr</option>
										</select>
									</div>
									<div class="col-sm-3">
									<input name="first_name" type="text" value="@$fetchedData->first_name" class="form-control" data-valid="required" autocomplete="off" placeholder="First Name *">
									@if ($errors->has('first_name'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('first_name') }}</strong>
										</span> 
									@endif
									</div>
									<div class="col-sm-3">
									<input name="middle_name" type="text" value="@$fetchedData->middle_name" class="form-control" data-valid="" autocomplete="off" placeholder="Middle Name">
									@if ($errors->has('middle_name'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('middle_name') }}</strong>
										</span> 
									@endif
									</div>
									<div class="col-sm-3">
									<input name="last_name" type="text" value="@$fetchedData->last_name" class="form-control" data-valid="required" autocomplete="off" placeholder="Last Name *">
									@if ($errors->has('last_name'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('last_name') }}</strong>
										</span> 
									@endif
									</div>  
								</div>	
								<div class="form-group row"> 
									<label for="company_name" class="col-sm-2 col-form-label">Company Name <span style="color:#ff0000;">*</span></label>
									<div class="col-sm-10">
									<input name="company_name" type="text" value="@$fetchedData->company_name" class="form-control" data-valid="required" autocomplete="off" placeholder="Company Name *">
									@if ($errors->has('company_name'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('company_name') }}</strong>
										</span> 
									@endif
									</div>
								</div>
								<div class="form-group row"> 
									<label for="contact_display_name" class="col-sm-2 col-form-label">Contact Display Name <span style="color:#ff0000;">*</span></label>
									<div class="col-sm-10">
									<input name="contact_display_name" type="text" value="@$fetchedData->contact_display_name" class="form-control" data-valid="required" autocomplete="off" placeholder="Contact Display Name *">
									@if ($errors->has('contact_display_name'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('contact_display_name') }}</strong>
										</span> 
									@endif
									</div>
								</div>
								<div class="form-group row"> 
									<label for="contact_email" class="col-sm-2 col-form-label">Contact Email <span style="color:#ff0000;">*</span></label>
									<div class="col-sm-10">
									<input name="contact_email" type="text" value="@$fetchedData->contact_email" class="form-control" data-valid="required" autocomplete="off" placeholder="Contact Email *">
									@if ($errors->has('contact_email'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('contact_email') }}</strong>
										</span> 
									@endif
									</div>
								</div>
								<div class="form-group row"> 
									<label for="birth_date" class="col-sm-2 col-form-label">Date of Birth</label>
									<div class="col-sm-10">
										<input name="birth_date" type="text" value="@$fetchedData->birth_date" class="form-control commodate" data-valid="" autocomplete="off" placeholder="Date of Birth">
										<div class="calendar_icon"><i class="fa fa-calendar"></i></div>
										@if ($errors->has('birth_date'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('birth_date') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="form-group row">  
									<label for="anniversary_date" class="col-sm-2 col-form-label">Anniversary Date</label>
									<div class="col-sm-10">
										<input name="anniversary_date" type="text" value="@$fetchedData->anniversary_date" class="form-control commodate" data-valid="" autocomplete="off" placeholder="Anniversary Date">
										<div class="calendar_icon"><i class="fa fa-calendar"></i></div>
										@if ($errors->has('anniversary_date'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('anniversary_date') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="form-group row"> 
									<label for="contact_phone" class="col-sm-2 col-form-label">Contact Phone <span style="color:#ff0000;">*</span></label>
									<div class="col-sm-4">
									<input name="contact_phone" type="text" value="@$fetchedData->contact_phone" class="form-control" data-valid="required" autocomplete="off" placeholder="Mobile Phone *">
									@if ($errors->has('contact_phone'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('contact_phone') }}</strong>
										</span> 
									@endif
									</div>
									<div class="col-sm-4">
									<input name="work_phone" type="text" value="@$fetchedData->work_phone" class="form-control" data-valid="" autocomplete="off" placeholder="Work Phone">
									@if ($errors->has('work_phone'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('work_phone') }}</strong>
										</span> 
									@endif
									</div>
								</div>
								<div class="form-group row">
									<label for="website" class="col-sm-2 col-form-label">Website</label>
									<div class="col-sm-10">
									<input name="website" type="text" value="@$fetchedData->website" class="form-control" data-valid="" autocomplete="off" placeholder="http://">
									@if ($errors->has('website'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('website') }}</strong>
										</span> 
									@endif
									</div> 
								</div>
								<div class="form-group row">
									<label for="designation" class="col-sm-2 col-form-label">Designation</label>
									<div class="col-sm-10">
									<input name="designation" type="text" value="@$fetchedData->designation" class="form-control" data-valid="" autocomplete="off" placeholder="Designation">
									@if ($errors->has('designation'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('designation') }}</strong>
										</span> 
									@endif
									</div>
								</div>
								<div class="form-group row">
									<label for="department" class="col-sm-2 col-form-label">Department</label>
									<div class="col-sm-10">
									<input name="department" type="text" value="@$fetchedData->department" class="form-control" data-valid="" autocomplete="off" placeholder="Department">
									@if ($errors->has('department'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('department') }}</strong>
										</span> 
									@endif
									</div> 
								</div> 
								<div class="form-group row"> 
									<label for="currency" class="col-sm-2 col-form-label">Currency <span style="color:#ff0000;">*</span></label>
									<div class="col-sm-10">
										<select name="currency" data-valid="required" class="form-control">
											@foreach(\App\Models\Currency::where('is_base','=','1' )->orwhere('user_id',Auth::user()->id)->orderby('currency_code','ASC')->get() as $cclist)
												<option value="{{$cclist->id}}" @if(@$fetchedData->currency != '') @if(@$fetchedData->currency == $cclist->id) selected @endif @elseif($cclist->is_base == 1) selected @endif>{{$cclist->currency_code}}-{{$cclist->name}}</option>
											@endforeach
										</select>
									</div>
								</div> 
							</div> 
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Social Information</h3>
							</div> 
							<!-- /.card-header --> 
							<div class="card-body">
								<div class="form-group row"> 
									<label for="skype_name" class="col-sm-3 col-form-label">Skype ID</label>
									<div class="col-sm-9">
									<input name="skype_name" type="text" value="@$fetchedData->skype_name" class="form-control" data-valid="" autocomplete="off" placeholder="Skype ID">
									@if ($errors->has('skype_name'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('skype_name') }}</strong>
										</span> 
									@endif
									</div>
								</div>
								<div class="form-group row"> 
									<label for="facebook_name" class="col-sm-3 col-form-label">Facebook ID</label>
									<div class="col-sm-9">
									<input name="facebook_name" type="text" value="@$fetchedData->facebook_name" class="form-control" data-valid="" autocomplete="off" placeholder="Facebook ID">
									@if ($errors->has('facebook_name'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('facebook_name') }}</strong>
										</span> 
									@endif
									</div>
								</div>
								<div class="form-group row"> 
									<label for="twitter_name" class="col-sm-3 col-form-label">Twitter ID</label>
									<div class="col-sm-9">
									<input name="twitter_name" type="text" value="@$fetchedData->twitter_name" class="form-control" data-valid="" autocomplete="off" placeholder="Twitter ID">
									@if ($errors->has('twitter_name'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('twitter_name') }}</strong>
										</span> 
									@endif
									</div> 
								</div>	
								<div class="form-group row"> 
									<label for="linkedin_name" class="col-sm-3 col-form-label">Linkedin ID</label>
									<div class="col-sm-9">
									<input name="linkedin_name" type="text" value="@$fetchedData->linkedin_name" class="form-control" data-valid="" autocomplete="off" placeholder="Linkedin ID">
									@if ($errors->has('linkedin_name'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('linkedin_name') }}</strong>
										</span> 
									@endif
									</div>
								</div>
								<div class="form-group row"> 
									<label for="instagram_name" class="col-sm-3 col-form-label">Instagram ID</label>
									<div class="col-sm-9">
									<input name="instagram_name" type="text" value="@$fetchedData->instagram_name" class="form-control" data-valid="" autocomplete="off" placeholder="Instagram ID">
									@if ($errors->has('instagram_name'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('instagram_name') }}</strong>
										</span> 
									@endif
									</div>
								</div>
								<div class="form-group row"> 
									<label for="youtube_name" class="col-sm-3 col-form-label">Youtube ID</label>
									<div class="col-sm-9">
									<input name="youtube_name" type="text" value="@$fetchedData->youtube_name" class="form-control" data-valid="" autocomplete="off" placeholder="Youtube ID">
									@if ($errors->has('youtube_name'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('youtube_name') }}</strong>
										</span> 
									@endif
									</div>
								</div> 
							</div> 
						</div>	
					</div>
					<div class="col-sm-6">
						<div class="card card-primary">
							<div class="card-header">
								<h3 class="card-title">Billing Address</h3>
							</div> 
							<!-- /.card-header --> 
							<div class="card-body">
								<div class="form-group row country_field"> 
									<label for="country" class="col-sm-3 col-form-label">Country <span style="color:#ff0000;">*</span></label>
									<?php
										$country = 'IN';
										if(@$fetchedData->country != ''){
											$country = @$fetchedData->country ;
										}
										?>
									<div class="col-sm-9">
										<div name="country" class="niceCountryInputSelector" id="basic" data-selectedcountry="{{$country}}" data-showspecial="false" data-showflags="true" data-i18nall="All selected" data-i18nnofilter="No selection" data-i18nfilter="Filter" data-onchangecallback="onChangeCallback"></div>									
										@if ($errors->has('country'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('country') }}</strong>
											</span> 
										@endif
									</div>
								</div>								
								<div class="form-group row">
									<label for="address" class="col-sm-3 col-form-label">Address</label>
									<div class="col-sm-9">
										<textarea name="address" class="form-control" placeholder="Address" style="width: 100%; height:80px;padding: 10px;margin-bottom:10px;">{{ @$fetchedData->address }}</textarea>
										@if ($errors->has('address'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('address') }}</strong>
											</span> 
										@endif
									</div>  
								</div> 
								<div class="form-group row"> 
									<label for="city" class="col-sm-3 col-form-label">City</label>
									<div class="col-sm-9">
									<input name="city" type="text" value="@$fetchedData->city" class="form-control" data-valid="" autocomplete="off" placeholder="City Name">
									@if ($errors->has('city'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('city') }}</strong>
										</span> 
									@endif
									</div>
								</div>
								<div class="form-group row"> 
									<label for="zipcode" class="col-sm-3 col-form-label">Zipcode</label>
									<div class="col-sm-9">
									<input name="zipcode" type="text" value="@$fetchedData->zipcode" class="form-control" data-valid="" autocomplete="off" placeholder="Zipcode">
									@if ($errors->has('zipcode'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('zipcode') }}</strong>
										</span> 
									@endif
									</div>
								</div>
								<div class="form-group row"> 
									<label for="phone" class="col-sm-3 col-form-label">Phone</label>
									<div class="col-sm-9">
									<input name="phone" type="text" value="@$fetchedData->phone" class="form-control" data-valid="" autocomplete="off" placeholder="Phone Number">
									@if ($errors->has('phone'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('phone') }}</strong>
										</span> 
									@endif  
									</div>
								</div>
							</div> 
						</div>	
					</div>    
				</div> 
				<div class="row">	
					<div class="col-md-12">
						<div class="card card-primary">
							<div class="card-body">   
								<div style="margin-bottom:0px;" class="float-right form-group">
									<button type="button" class="btn btn-primary" onClick="customValidate("edit-contacts")"><i class="fa fa-edit"></i> Update Contact</button>
								</div>
							</div>  
						</div>	
					</div>	
				</div>	
			</form>
		</div>
	</section>
</div>
<script>
jQuery(document).ready(function($){
	$('#select_country').attr('data-selected-country','<?php echo @$fetchedData->country; ?>');
		$('#select_country').flagStrap();
});
</script>
@endsection