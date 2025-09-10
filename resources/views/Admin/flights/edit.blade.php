@extends('layouts.admin')
@section('title', 'Edit Flight')

@section('content')
 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Edit Flight</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Flight</li>
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
				<div class="col-md-12">
					<div class="card card-primary">
					  <div class="card-header">
						<h3 class="card-title">Edit Flight</h3>
					  </div> 
					  <!-- /.card-header -->
					  <!-- form start -->
					  <form action="admin/flights/edit" autocomplete="off" method="post">
					   <input type="hidden" name="id" value="@$fetchedData->id">
						<div class="card-body">
							<div class="form-group" style="text-align:right;">
								<a style="margin-right:5px;" href="{{route('admin.flights.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>  
								<button type="button" class="btn btn-primary" onClick="customValidate("edit-flights")"><i class="fa fa-save"></i> Edit Flight</button>
							</div>
							<div class="form-group row"> 
								<label for="code" class="col-sm-2 col-form-label">Code</label>
								<div class="col-sm-10">
								<select data-valid="required" id="fcode" class="form-control select2bs5" name="code">
									<option value="">Select</option>
									@foreach(\App\Models\Markup::all() as $mist)
										<option value="{{@$mist->flight_code}}" @if($mist->flight_code == @$fetchedData->code) selected @endif>{{@$mist->flight_code}}</option>
									@endforeach
								</select>
								
								@if ($errors->has('code'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('code') }}</strong>
									</span> 
								@endif
								</div>    
							</div>
							<div class="form-group row">
							<div class="col-md-12 flightlogo"><img width="70" src="{{URL::to('/public/img/airline')}}/{{$fetchedData->code}}.gif" class="img-avatar"></div>
							</div> 
							<div class="form-group row"> 
								<label for="name" class="col-sm-2 col-form-label">Name <span style="color:#ff0000;">*</span></label>
								<div class="col-sm-10">
								<input name="name" type="text" value="@$fetchedData->name" class="form-control" data-valid="required" autocomplete="off" placeholder="Enter Name">
								@if ($errors->has('name'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('name') }}</strong>
									</span> 
								@endif
								</div> 
							</div>
						  
							
							<div class="form-group float-right">
								<button type="button" class="btn btn-primary" onClick="customValidate("edit-flights")"><i class="fa fa-save"></i> Edit Flight</button>
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