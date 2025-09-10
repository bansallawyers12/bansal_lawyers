@extends('layouts.admin')
@section('title', 'Staff')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Staffs</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Staffs</li>
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
				<div class="col-md-6">
					<div class="card card-primary">
					  <div class="card-header">
						<h3 class="card-title">Add Staff</h3>
					  </div>
					  <!-- /.card-header -->
					  <!-- form start -->
					  <form action="admin/staff/store" autocomplete="off" method="post">
						<div class="card-body">	
						  <div class="form-group"> 
							<label for="first_name">User First Name</label>
							<input name="first_name" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter User First Name">
							@if ($errors->has('first_name'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('first_name') }}</strong>
								</span> 
							@endif
						  </div>
						  <div class="form-group">
							<label for="last_name">User Last Name</label>
							<input name="last_name" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter User Last Name">
							@if ($errors->has('last_name'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('last_name') }}</strong>
								</span> 
							@endif
						  </div>
						   <div class="form-group"> 
							<label for="staff_id">Staff Code</label>
							<input name="staff_id" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter User Last Name">
							@if ($errors->has('staff_id'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('staff_id') }}</strong>
								</span> 
							@endif
						  </div>
						  <div class="form-group">
							<label for="name">User Email</label>
							<input name="email" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter User Email">
							@if ($errors->has('email'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('email') }}</strong>
								</span> 
							@endif
						  </div>
						  <div class="form-group">
							<label for="name">User Password</label>
							<input type="password" name="password" class="form-control" autocomplete="off" placeholder="Enter User Password" data-valid="required" />							
							@if ($errors->has('password'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('password') }}</strong>
								</span> 
							@endif
						  </div>
						  <div class="form-group">
							<label for="name">User Phone</label>
							<input name="phone" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter User Phone">
							@if ($errors->has('phone'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('phone') }}</strong>
								</span> 
							@endif
						  </div>
						  
						  <div class="form-group">
							<label for="profile_img">User Profile Image</label>
							<input type="file" name="profile_img" class="form-control" autocomplete="off" data-valid="required" />							
							@if ($errors->has('profile_img'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('profile_img') }}</strong>
								</span> 
							@endif
						  </div>
						  <div class="form-group">
							{{ Form::submit('Save', ['class'=>'btn btn-primary' ]) }}
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