@extends('layouts.admin')
@section('title', 'Users')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Users</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Users</li>
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
						<h3 class="card-title">Add User</h3>
					  </div>
					  <!-- /.card-header -->
					  <!-- form start -->
					  <form action="admin/customer/store" autocomplete="off" method="post">
						<div class="card-body">	
						  <div class="form-group"> 
							<label for="name">Name</label>
							<input name="name" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter First Name">
							@if ($errors->has('name'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('name') }}</strong>
								</span> 
							@endif
						  </div>  
						   
						  <div class="form-group">
							<label for="name">Email</label>
							<input name="email" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter User Email">
							@if ($errors->has('email'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('email') }}</strong>
								</span> 
							@endif
						  </div>
						  <div class="form-group">
							<label for="name">Password</label>
							<input type="password" name="password" class="form-control" autocomplete="off" placeholder="Enter User Password" data-valid="required" />							
							@if ($errors->has('password'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('password') }}</strong>
								</span> 
							@endif
						  </div>
						  <div class="form-group">
							<label for="name">Phone</label>
							<input name="phone" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter User Phone">
							@if ($errors->has('phone'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('phone') }}</strong>
								</span> 
							@endif
						  </div>
						   <div class="form-group">
							<label for="city">City</label>
							<input name="city" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter City">
							@if ($errors->has('city'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('city') }}</strong>
								</span> 
							@endif
						  </div>
						  <div class="form-group">
							<label for="location">Location</label>
							<input name="location" type="text" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter Location">
							@if ($errors->has('location'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('location') }}</strong>
								</span> 
							@endif
						  </div>
						  <div class="form-group">
							<label for="dob">Date of Birth</label>
							<input name="dob" type="text" class="form-control commondate" data-valid="required" autocomplete="off" placeholder="Enter Date of Birth">
							@if ($errors->has('dob'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('dob') }}</strong>
								</span> 
							@endif
						  </div>
						   <div class="form-group">
							<label for="wedding_anniversary">Wedding Anniversary</label>
							<input name="wedding_anniversary" type="text" class="form-control commondate" data-valid="" autocomplete="off" placeholder="Enter Wedding Anniversary">
							@if ($errors->has('wedding_anniversary'))
								<span class="custom-error" role="alert">
									<strong>{{ @$errors->first('wedding_anniversary') }}</strong>
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