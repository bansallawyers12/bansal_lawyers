@extends('layouts.admin')
@section('title', 'Add Branch')

@section('content')

<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<form action="admin/branch/store" autocomplete="off" method="post">
				<div class="row">
					<div class="col-12 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4>Add Branch</h4>
								<div class="card-header-action">
									<a href="{{route('admin.branch.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-body">
								<div id="accordion"> 
									<div class="accordion">
										<div class="accordion-header" role="button" data-toggle="collapse" data-target="#primary_info" aria-expanded="true">
											<h4>Primary Information</h4>
										</div>
										<div class="accordion-body collapse show" id="primary_info" data-parent="#accordion">
											<div class="row"> 						
												<div class="col-12 col-md-4 col-lg-4">
													<div class="form-group"> 
														<label for="office_name">Office Name <span class="span_req">*</span></label>
														<input name="office_name" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter Office Name">
														@if ($errors->has('office_name'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('office_name') }}</strong>
															</span> 
														@endif
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="accordion">
										<div class="accordion-header" role="button" data-toggle="collapse" data-target="#address">
											<h4>Address</h4>
										</div>
										<div class="accordion-body collapse" id="address" data-parent="#accordion">
											<div class="row">
												<div class="col-12 col-md-4 col-lg-4">
													<div class="form-group"> 
														<label for="address">Address</label>
														<input name="address" type="text" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Address">
														@if ($errors->has('address'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('address') }}</strong>
															</span> 
														@endif
													</div>
												</div>
												<div class="col-12 col-md-4 col-lg-4">
													<div class="form-group"> 
														<label for="city">City</label>
														<input name="city" type="text" class="form-control" data-valid="" autocomplete="off" placeholder="Enter City">
														@if ($errors->has('city'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('city') }}</strong>
															</span> 
														@endif
													</div>
												</div>
												<div class="col-12 col-md-4 col-lg-4">
													<div class="form-group"> 
														<label for="state">State</label>
														<input name="state" type="text" class="form-control" data-valid="" autocomplete="off" placeholder="Enter State">
														@if ($errors->has('state'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('state') }}</strong>
															</span> 
														@endif
													</div>
												</div>
												<div class="col-12 col-md-4 col-lg-4">
													<div class="form-group"> 
														<label for="zip">Zip / Post Code</label>
														<input name="zip" type="text" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Zip / Post Code">
														@if ($errors->has('zip'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('zip') }}</strong>
															</span> 
														@endif
													</div>
												</div>
												<div class="col-12 col-md-4 col-lg-4">
													<div class="form-group"> 
														<label for="country">Country</label>
														
														<select class="form-control  select2" name="country" >
														<?php
															foreach(\App\Models\Country::all() as $list){
																?>
																<option value="{{@$list->sortname}}" >{{@$list->name}}</option>
																<?php
															}
															?>
														</select>
														@if ($errors->has('country'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('country') }}</strong>
															</span> 
														@endif
													</div>
												</div>
											</div>  
										</div>
									</div>
									<div class="accordion">
										<div class="accordion-header" role="button" data-toggle="collapse" data-target="#contact_details">
											<h4>Contact Details</h4>
										</div>
										<div class="accordion-body collapse" id="contact_details" data-parent="#accordion">
											<div class="row">
												<div class="col-12 col-md-4 col-lg-4">
													<div class="form-group"> 
														<label for="email">Email <span class="span_req">*</span></label>
														<input name="email" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter Email">
														@if ($errors->has('email'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('email') }}</strong>
															</span> 
														@endif
													</div>
												</div>
												<div class="col-12 col-md-4 col-lg-4">
													<div class="form-group"> 
														<label for="phone">Phone Number</label>	
														<input name="phone" type="text" class="form-control tel_input" data-valid="" autocomplete="off" placeholder="Enter Phone">
														@if ($errors->has('phone'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('phone') }}</strong>
															</span> 
														@endif
													</div>
												</div>
												<div class="col-12 col-md-4 col-lg-4">
													<div class="form-group"> 
														<label for="mobile">Mobile</label>
														<input name="mobile" type="text" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Mobile">
														@if ($errors->has('mobile'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('mobile') }}</strong>
															</span> 
														@endif
													</div>
												</div>
												<div class="col-12 col-md-4 col-lg-4">
													<div class="form-group"> 
														<label for="contact_person">Contact Person</label>
														<input name="contact_person" type="text" class="form-control" data-valid="" autocomplete="off" placeholder="Enter Contact Person">
														@if ($errors->has('contact_person'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('contact_person') }}</strong>
															</span> 
														@endif
													</div>
												</div>	
											</div>
										</div>
									</div>
									<div class="accordion">
										<div class="accordion-header" role="button" data-toggle="collapse" data-target="#other_info">
											<h4>Other Information</h4>
										</div>
										<div class="accordion-body collapse" id="other_info" data-parent="#accordion">
											<div class="row">
												<div class="col-12 col-md-4 col-lg-4">
													<div class="form-group"> 
														<label for="choose_admin">Choose Admin</label>
														<select class="form-control select2" name="choose_admin">
															<option>-- Choose Admin --</option>
														</select>
														@if ($errors->has('choose_admin'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('choose_admin') }}</strong>
															</span> 
														@endif
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group float-right">
									<button type="button" class="btn btn-primary" onClick="customValidate("add-branch")">Save Branch</button>
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