@extends('layouts.admin')
@section('title', 'Website Setting')
@section('content')
<main class="main">
	<!-- Breadcrumb start-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item active">
			Home / <a href="{{URL::to('/admin/dashboard')}}">Dashboard</a> / <b>Website Setting</b>
		</li>
		@include('../Elements/Admin/breadcrumb')
	</ol>
	<!-- Breadcrumb end-->
	
	<div class="container-fluid">
		<div class="animated fadeIn">
			<!-- Flash Message Start -->
				<div class="server-error">
					@include('../Elements/flash-message')
				</div>
			<!-- Flash Message End -->
			
			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							<strong>Website Setting</strong>
						</div>
						<form action="admin/website_setting" enctype="multipart/form-data" autocomplete="off" method="post">
							<input type="hidden" name="id" value="@$fetchedData->id">
						
							<div class="card-body">
								<div class="form-group">
									<label for="phone">Website Phone<em>*</em></label>
										<input name="phone" type="text" value="@$fetchedData->phone" class="form-control mask" data-valid="required">
								
									@if ($errors->has('phone'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('phone') }}</strong>
										</span>
									@endif
								</div>
								<div class="form-group">
									<label for="ofc_timing">Office Timing</label>
										<input name="ofc_timing" type="text" value="@$fetchedData->ofc_timing" class="form-control">
								
									@if ($errors->has('ofc_timing'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('ofc_timing') }}</strong>
										</span>
									@endif
								</div>
								<div class="form-group">
									<label for="email">Website Email<em>*</em></label>
										<input name="email" type="text" value="@$fetchedData->email" class="form-control" data-valid="required email">
								
									@if ($errors->has('email'))
										<span class="custom-error" role="alert">
											<strong>{{ @$errors->first('email') }}</strong>
										</span>
									@endif
								</div>	
								<div class="form-group">
									<label for="logo">Logo Upload</label>
										<input type="hidden" id="old_logo" name="old_logo" value="{{@$fetchedData->logo}}" />
										
										<div class="show-uploded-img float-right">	
											@if(@$fetchedData->logo == '')
												<img src="{{ asset('/public/img/logo.png') }}" class="img-avatar" />
											@else
												<img src="{{URL::to('/public/img/logo')}}/{{@$fetchedData->logo}}" class="img-avatar"/>
											@endif
										</div>
										<input type="file" name="logo" class="form-control uploadImageFile" />		
								</div>
								
								<div class="form-group">
									<button type="button" class="btn btn-primary px-4" onClick="customValidate("website-setting")">Save</button>
								</div>
							</div>
						</form>	
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							<strong>Instructions</strong>	
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="name"><em>*</em> Fields are mandatory.</label>
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</main>
@endsection