<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="description" content="">
	<meta name="author" content="Bansal Lawyers">
	<!--<link rel="shortcut icon" type="image/png" href="{{--asset('images/favicon.png')--}}"/>-->
	<title>Bansal Lawyers | @yield('title')</title>
	<!-- Favicons-->
	<!--<link rel="shortcut icon" href="{{--asset('images/Frontend/img/bansal-favicon.png')--}}" type="image/x-icon">-->

	 <!-- BASE CSS -->
	<link href="{{ asset('css/app.min.css')}}" rel="stylesheet">
	<link href="{{ asset('css/bootstrap-social.css')}}" rel="stylesheet">
	<link href="{{ asset('css/components.css')}}" rel="stylesheet">
	<link href="{{ asset('css/custom.css')}}" rel="stylesheet">

	<script async src="https://www.google.com/recaptcha/api.js"></script> <!-- Add recaptcha script -->
</head>
<style>
.bg{
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    height: 100vh;
    margin: 0;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.card {
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    border: none;
    border-radius: 10px;
}
.card-header {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
    border-radius: 10px 10px 0 0 !important;
    border: none;
}
.btn-primary {
    background: linear-gradient(45deg, #667eea, #764ba2);
    border: none;
    border-radius: 5px;
}
.btn-primary:hover {
    background: linear-gradient(45deg, #5a6fd8, #6a4190);
    transform: translateY(-1px);
}
</style>
<body class="bg">
	<div class="loader"></div>
	<div id="app">
		@yield('content')
	</div>
	<!-- COMMON SCRIPTS -->
	<script type="text/javascript">
		var site_url = "<?php echo URL::to('/'); ?>";
	</script>
	<script src="{{ asset('js/app.min.js')}}"></script>
	<script src="{{ asset('js/scripts.js')}}"></script>
	<script src="{{ asset('js/custom.js')}}"></script>
</body>
</html>
