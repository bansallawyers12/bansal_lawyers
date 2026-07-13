<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
     <meta name="google-site-verification" content="v3RcCNNqLVXDQoEWlV1SzP3SHNvhWws-YuzpLxWuk8A" />
  
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keyword" content="Bansal Lawyers">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@if($nonce = \App\Services\CspService::getNonce())
	<meta name="csp-nonce" content="{{ $nonce }}">
	@endif
	<title>Bansal Lawyers | @yield('title')</title>
	<!--<link rel="icon" type="image/png" href="{{ asset('images/favicon.png')}}">-->
	
	{{-- Vite owns admin CSS (tokens, btn/card/form, shell). Stisla components.css + fat custom.css unlinked (Phase 3). --}}
	@vite(['resources/css/admin.css', 'resources/css/vendor-admin.css'])
	{{-- Phase 5–6: no sync jQuery / no Bootstrap — admin.js is vanilla + Axios --}}
</head>
<body >
	<div class="loader"></div>
		<div class="popuploader hidden-loader"></div>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<div class="navbar-bg"></div>
			<!--Header-->
			@include('Elements.Admin.header')
			<!--Left Side Bar-->
			@include('Elements.Admin.left-side-bar')

			<main role="main">
				@yield('content')
			</main>

			@include('Elements.Admin.footer')
		</div>
	</div>

	@include('Elements.Admin.confirm-dialog')



		<?php if(@Settings::sitedata('date_format') != 'none'){
			   $date_format = @Settings::sitedata('date_format');
			 //  $time_format = @Settings::sitedata('time_format');
			 if($date_format == 'd/m/Y'){
			     $dataformat =  'DD/MM/YYYY';
			 }else if($date_format == 'm/d/Y'){
			     $dataformat =  'MM/DD/YYYY';
			 }else if($date_format == 'Y-m-d'){
		    	 $dataformat = 'YYYY-MM-DD';
			 }else{
			    $dataformat = 'YYYY-MM-DD';
			 }
			}else{
			  $dataformat = 'YYYY-MM-DD';
			}
			?>
				<script {!! \App\Services\CspService::getNonceAttribute() !!}>
				    var site_url = '{{URL::to('/')}}';
				     var dataformat = '{{$dataformat}}';
				    </script>
	
	<!-- Core: Axios + vanilla admin UI via Vite admin.js (Phase 5–6) -->
	
	<!-- TinyMCE v8 self-hosted (not bundled into admin entry) -->
	<script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>
	<script type="text/javascript" {!! \App\Services\CspService::getNonceAttribute() !!}>
		if (typeof tinymce !== 'undefined') {
			tinymce.baseURL = '{{ asset('assets/tinymce') }}';
			tinymce.suffix = '.min';
		}
	</script>
	<script src="{{ asset('js/tinymce-config.js') }}"></script>

	<script {!! \App\Services\CspService::getNonceAttribute() !!}>
		window.DateUtils = {
			toISO: function(dateString, currentFormat) {
				if (!dateString) return '';
				if (currentFormat === 'DD/MM/YYYY') {
					var parts = dateString.split('/');
					if (parts.length !== 3) return dateString;
					return parts[2] + '-' + parts[1].padStart(2, '0') + '-' + parts[0].padStart(2, '0');
				}
				if (/^\d{4}-\d{2}-\d{2}$/.test(dateString)) {
					return dateString;
				}
				var parsed = new Date(dateString);
				if (isNaN(parsed.getTime())) return dateString;
				return parsed.toISOString().slice(0, 10);
			},
			toDisplay: function(isoDate, format) {
				if (!isoDate) return '';
				format = format || 'DD/MM/YYYY';
				var parts = isoDate.split('-');
				if (parts.length !== 3) return isoDate;
				if (format === 'DD/MM/YYYY') {
					return parts[2] + '/' + parts[1] + '/' + parts[0];
				}
				if (format === 'MM/DD/YYYY') {
					return parts[1] + '/' + parts[2] + '/' + parts[0];
				}
				return isoDate;
			},
			isValidISO: function(dateString) {
				if (!/^\d{4}-\d{2}-\d{2}$/.test(dateString)) return false;
				var parsed = new Date(dateString + 'T00:00:00');
				return !isNaN(parsed.getTime());
			}
		};

		window.setTaskViewHtml = function(html) {
			var container = document.querySelector('.taskview');
			if (!container) return;
			container.innerHTML = html;

			function initModalControls(attempt) {
				if (typeof window.initDynamicTomSelects === 'function') {
					window.initDynamicTomSelects(container);
					return;
				}
				if ((attempt || 0) < 40) {
					setTimeout(function() { initModalControls((attempt || 0) + 1); }, 50);
				}
			}

			initModalControls(0);
		};
	</script>
	
	{{-- Single admin JS path: Axios, Tom Select, Flatpickr, CRUD, validate, confirm, CSP (Phase 5–6) --}}
	@vite(['resources/js/admin.js'])
	
	<script {!! \App\Services\CspService::getNonceAttribute() !!}>
		document.addEventListener('DOMContentLoaded', function () {
		    document.querySelectorAll(".tel_input").forEach(function(input) {
		        input.addEventListener("blur", function() {
                    input.value = input.value;
                });
            });
        });
	</script>

@yield('scripts')
</body>
</html>
