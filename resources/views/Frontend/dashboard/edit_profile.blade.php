@extends('layouts.dashboard_frontend')
@section('title', 'Edit My Profile')
@section('content')      
<div class="row dashboard">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading dashboard-main-heading">
				<h3 class="panel-title text-center">
					YOUR DASHBOARD
				</h3>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 no-padding">
				<!-- Emergency Note Start-->
					@include('../Elements/emergency')
				<!-- Emergency Note End-->
				
				<!-- Flash Message Start -->
				<div class="server-error">
					@include('../Elements/flash-message')	
				</div>
				<!-- Flash Message End -->
			
				<div class="panel-body">
					<div class="col-lg-12 col-sm-12 col-md-12 no-padding">
						<div class="tab" role="tabpanel">				
							<!-- Content Start for the Menu Bar Dashboard -->
								@include('../Elements/Frontend/navigation')
							<!-- Content End for the Menu Bar Dashboard -->	
						</div>
					</div>
				</div>
				
				<h3 class="order-summary"><strong>EDIT MY PROFILE</strong></h3>
				<div class="clearfix"></div>	
				<div class="panel-body">
					<div class="col-lg-6 col-sm-12 col-md-6 no-padding">
						<div class="tab" role="tabpanel">
							<div class="tab-content tabs">
								<div role="tabpanel" class="fade in active" id="Section0">		
									<div class="table-responsive">
										<div id="orderSummary_wrapper" class="dataTables_wrapper no-footer">
											<form action="/edit_profile" autocomplete="off" class="edit-profile" method="post">
												<input type="hidden" name="id" value="@$fetchedData->id">
												<div>
													<div class="form-group">
														<label for="first_name">First Name<em>*</em></label>
														<input name="first_name" type="text" value="@$fetchedData->first_name" class="form-control" data-valid="required" autocomplete="new-password">
													
														@if ($errors->has('first_name'))
															<span class="custom-error" role="alert">
																<strong>{{ $errors->first('first_name') }}</strong>
															</span>
														@endif
													</div>
													<div class="form-group">
														<label for="last_name">Last Name<em>*</em></label>
														<input name="last_name" type="text" value="@$fetchedData->last_name" class="form-control" data-valid="required" autocomplete="new-password">
													
														@if ($errors->has('last_name'))
															<span class="custom-error" role="alert">
																<strong>{{ $errors->first('last_name') }}</strong>
															</span>
														@endif
													</div>
													<div class="form-group">
														<label for="email">Email<em>*</em></label>
														<input name="email" type="text" value="@$fetchedData->email" class="form-control" data-valid="required" autocomplete="new-password" disabled="disabled">
													</div>
													<div class="form-group">
														<label for="phone">Phone<em>*</em></label>
														<input name="phone" type="text" value="@$fetchedData->phone" class="form-control" data-valid="required" autocomplete="new-password" disabled="disabled">
													</div>
													<div class="form-group">
														<label for="country">Country<em>*</em></label>
														<select name="country" id="getCountryStates" class="form-control" data-valid="required">
															<option value="">Choose Country</option>
															@if(count(@$countries) !== 0)
																@foreach (@$countries as $country)
																	<option value="{{ @$country->id }}" @if(@$fetchedData->country == @$country->id) selected  @endif>{{ @$country->name }}</option>
																@endforeach
															@endif		
														</select>
														
														@if ($errors->has('country'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('country') }}</strong>
															</span>
														@endif
													</div>
													<div class="form-group">
														<label for="state">State<em>*</em></label>
														<input type="hidden" id="storeStateId" value="{{@$fetchedData->state}}" />	
														<select name="state" id="getStateCities" class="form-control" data-valid="required">
															<option value="">Choose State</option>		
														</select>
													
														@if ($errors->has('state'))
															<span class="custom-error" role="alert">
																<strong>{{ @$errors->first('state') }}</strong>
															</span>
														@endif
													</div>
													<div class="form-group">
														<label for="city">City<em>*</em></label>
														<input name="city" type="text" value="@$fetchedData->city" class="form-control" data-valid="required" autocomplete="new-password">
													
														@if ($errors->has('city'))
															<span class="custom-error" role="alert">
																<strong>{{ $errors->first('city') }}</strong>
															</span>
														@endif
													</div>
													<div class="form-group">
														<label for="address">Address<em>*</em></label>
														<textarea name="address" class="form-control textarea" placeholder="Please write Your Address..." autocomplete="new-password" data-valid="required">required</textarea>
													
														@if ($errors->has('address'))
															<span class="custom-error" role="alert">
																<strong>{{ $errors->first('address') }}</strong>
															</span>
														@endif
													</div>
													<div class="form-group">
														<label for="zip">Zip Code<em>*</em></label>
														<input name="zip" type="text" value="@$fetchedData->zip" class="form-control" data-valid="required" autocomplete="new-password">
													
														@if ($errors->has('zip'))
															<span class="custom-error" role="alert">
																<strong>{{ $errors->first('zip') }}</strong>
															</span>
														@endif
													</div>
													<div class="form-group">
														<button type="button" class="btn btn-primary px-4" onClick="customValidate("edit-profile")">Update</button>
													</div>	
												</div>
											</form>	
											
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection