@extends('layouts.admin')
@section('title', 'Edit Currency')

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Edit Currency</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Currency</li>
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
						<h3 class="card-title">New Currency</h3>
					  </div> 
					  <!-- /.card-header -->
					  <!-- form start -->
					  <form action="admin/settings/currencies/edit" autocomplete="off" method="post">
					  <input type="hidden" name="id" value="@$fetchedData->id">
						<div class="card-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group" style="text-align:right;">
										<a style="margin-right:5px;" href="{{route('admin.currency.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
										<button type="button" class="btn btn-primary" onClick="customValidate("add-city")"><i class="fa fa-edit"></i> Save</button>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group"> 
										<label for="currency_code" class="col-form-label">Currency Code <span style="color:#ff0000;">*</span></label>
										<input name="currency_code" type="text" value="@$fetchedData->currency_code" class="form-control" data-valid="required" autocomplete="off" placeholder="" disabled="disabled">
										@if ($errors->has('currency_code'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('currency_code') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group"> 
										<label for="currency_symbol" class="col-form-label">Currency Symbol <span style="color:#ff0000;">*</span></label>
										<input name="currency_symbol" type="text" value="@$fetchedData->currency_symbol" class="form-control" data-valid="required" autocomplete="off" placeholder="" id="currency_symbol">
										@if ($errors->has('currency_symbol'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('currency_symbol') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group"> 
										<label for="name" class="col-form-label">Currency Name <span style="color:#ff0000;">*</span></label>
										<input name="name" type="text" value="@$fetchedData->name" class="form-control" data-valid="required" autocomplete="off" placeholder="" id="currency_name">
										@if ($errors->has('name'))
											<span class="custom-error" role="alert">
												<strong>{{ @$errors->first('name') }}</strong>
											</span> 
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group"> 
										<label for="decimal" class="col-form-label">Decimal Places</label>
										<select id="decimal" name="decimal" data-valid="" class="form-control select2bs4" style="width: 100%;">
											<option value="">Select</option>
											<option value="0" @if(@$fetchedData->decimal == 0)selected @endif>0</option>
											<option value="2" @if(@$fetchedData->decimal == 2)selected @endif>2</option>
											<option value="3" @if(@$fetchedData->decimal == 3)selected @endif>3</option>
										</select>
									
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group"> 
										<label for="format" class="col-form-label">Format <span style="color:#ff0000;">*</span></label>
										<select id="format" name="format" data-valid="" class="form-control" style="width: 100%;">
											<option value="">Select</option>
											<option value="1" @if(@$fetchedData->format == 1)selected @endif>1,234,567.89</option>
											<option value="2" @if(@$fetchedData->format == 2)selected @endif>1.234.567.89</option>
											<option value="3" @if(@$fetchedData->format == 3)selected @endif>1 234 567.89</option>
										</select>
										
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group float-right">
										<button type="button" class="btn btn-primary" onClick="customValidate("add-city")"><i class="fa fa-save"></i> Save</button>
									</div> 
								</div> 
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