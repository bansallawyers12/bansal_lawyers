@extends('layouts.admin')
@section('title', 'New Manage Contacts')

@section('content')

<!-- Main Content --> 
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<form action="admin/managecontact/store" autocomplete="off" method="post">
				<div class="row">
					<div class="col-12 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4>Add New Contacts</h4>
								<div class="card-header-action">
									<a href="{{route('admin.managecontact.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
								</div>
							</div>
						</div>
					</div>	
					<div class="col-12 col-md-6 col-lg-6">
						<div class="card">
							<div class="card-body">
								<div class="form-group"> 
									<label for="srname" class="col-form-label">Primary Name <span style="color:#ff0000;">*</span></label>
									<div class="row">		
										<div class="col-sm-2">
											<select style="padding: 0px 5px;" name="srname" id="srname" class="form-control" autocomplete="new-password">
												<option value="Mr">Mr</option>
												<option value="Mrs">Mrs</option>
												<option value="Ms">Ms</option>
												<option value="Miss">Miss</option>
												<option value="Dr">Dr</option>
											</select>
										</div>
										<div class="col-sm-4">
										<input name="first_name" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="First Name *">
										@if ($errors->has('first_name'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('first_name') }}</strong>
											</span> 
										@endif
										</div>									
										<div class="col-sm-3">
										<input name="middle_name" type="text" class="form-control" data-valid="" autocomplete="off" placeholder="Middle Name">
										@if ($errors->has('middle_name'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('middle_name') }}</strong>
											</span> 
										@endif
										</div>
										<div class="col-sm-3">
										<input name="last_name" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Last Name *">
										@if ($errors->has('last_name'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('last_name') }}</strong>
											</span> 
										@endif
										</div>
									</div>
								</div>	
								<div class="form-group float-right">
									{{ Form::submit('Save', ['class'=>'btn btn-primary' ]) }}
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