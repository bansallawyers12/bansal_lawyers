@extends('layouts.admin')
@section('title', 'Change Password')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Change Password</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Change Password</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	
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

			<div class="row">
				<div class="col-sm-6">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title" style="display:block;">Change Password</h3>
						</div>
						<form action="admin/change_password" method="post">
							{{ Form::hidden('admin_id', @Auth::user()->id) }}
							<div class="card-body">
								<div class="form-group">
									<label for="old_password">Old Password <span style="color:#ff0000;">*</span></label>
									<input name="old_password" type="password" class="form-control" data-valid="required">
								
									@if ($errors->has('old_password'))
										<span class="custom-error" role="alert">
											<strong>{{ $errors->first('old_password') }}</strong>
										</span>
									@endif
								</div>
								<div class="form-group">
									<label for="password">New Password <span style="color:#ff0000;">*</span></label>
									<input name="password" type="password" class="form-control" data-valid="required">
								
									@if ($errors->has('password'))
										<span class="custom-error" role="alert">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif 
								</div>
								<div class="form-group">
									<label for="password_confirmation">Confirm Password <span style="color:#ff0000;">*</span></label>
									<input name="password_confirmation" type="password" class="form-control" data-valid="required">
								
									@if ($errors->has('password_confirmation'))
										<span class="custom-error" role="alert">
											<strong>{{ $errors->first('password_confirmation') }}</strong>
										</span>
									@endif
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-primary px-4" onClick="customValidate("change-password")"><i class="fa fa-refresh"></i> Change</button>
								</div>
							</div>    
						</form>	
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection