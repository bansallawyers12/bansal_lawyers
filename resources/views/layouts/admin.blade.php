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
	
	<!-- Vite CSS - Modern optimized CSS bundle -->
	@vite(['resources/css/admin.css', 'resources/css/vendor-admin.css'])
	
	<!-- Legacy CSS files (will be migrated gradually) - app.min.css removed (file not present; Vite admin.css provides styles) -->
	 <!-- FullCalendar v6 CSS - Auto-injected by JavaScript (no CSS files needed in v6) -->
	 <!-- The admin-calendar-v6.js imports inject CSS automatically at runtime -->
	<!-- Template CSS -->

	<link rel="stylesheet" href="{{ asset('css/components.css')}}">
	<!-- Custom style CSS -->
	<link rel="stylesheet" href="{{ asset('css/custom.css')}}">

    <!-- Lucide icons loaded via Vite (vendor-admin.css / admin.js) -->

	<script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>

<style {!! \App\Services\CspService::getNonceAttribute() !!}>
/* Accessibility Improvements - Touch Targets and Contrast */
/* Ensure all interactive elements meet minimum touch target size (44x44px) */
button, a[role="button"], input[type="button"], input[type="submit"], input[type="reset"], 
.btn, .dropbtn, .nav-link, .collapse-btn, .fullscreen-btn, [onclick] {
  min-height: 44px;
  min-width: 44px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

/* Ensure sufficient spacing between touch targets */
button + button, .btn + .btn {
  margin-left: 8px;
}

@media (max-width: 768px) {
  button, .btn, a.button, .nav-link {
    min-height: 44px;
    min-width: 44px;
    padding: 10px 16px;
  }
}

.dropbtn {
  background-color: transparent;
 border:0;
}
.ui.yellow.label, .ui.yellow.labels .label, .ts-wrapper .yellow {background-color: #fbbd08!important;border-color: #fbbd08!important;color: #fff!important;}
.dropbtn:hover, .dropbtn:focus {
  background-color: transparent;
   border:0;
}

.mydropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.mydropdown a:hover {background-color: #ddd;}

.show {display: block;}

/* Modern sidebar layout adjustments */
body {
    margin: 0;
    padding: 0;
}

.main-wrapper {
    margin-left: 280px !important;
    transition: margin-left 0.3s ease;
}

.main-content {
    padding: 2rem;
    min-height: 100vh;
    background: #f8fafc;
}

.modern-sidebar {
    transition: transform 0.3s ease;
}

body.admin-sidebar-collapsed .modern-sidebar {
    transform: translateX(-100%);
}

body.admin-sidebar-collapsed .main-wrapper {
    margin-left: 0 !important;
}

@media (max-width: 768px) {
    .main-wrapper {
        margin-left: 0 !important;
    }
    
    .modern-sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .modern-sidebar.open {
        transform: translateX(0);
    }
}

/* Override existing styles for better integration */
.section {
    margin-bottom: 2rem;
}

.card {
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e2e8f0;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.btn-primary {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
}

.hidden-loader {
    display: none;
}
</style>
 
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
	
	<!-- Core Dependencies (load first; jQuery already loaded in <head>) -->
	<script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
	
	<!-- Feature-specific Scripts (load after core) -->
	<!-- FullCalendar v6 loaded via Vite in admin.js (no jQuery needed) -->
	<!-- TinyMCE v8 self-hosted from public/assets/tinymce (copied via npm run copy-tinymce) -->
	<script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>
	<script type="text/javascript" {!! \App\Services\CspService::getNonceAttribute() !!}>
		if (typeof tinymce !== 'undefined') {
			tinymce.baseURL = '{{ asset('assets/tinymce') }}';
			tinymce.suffix = '.min';
		}
	</script>
	<script src="{{ asset('js/tinymce-config.js') }}"></script>

	<script {!! \App\Services\CspService::getNonceAttribute() !!}>
		// Global Tom Select helper
		window.initTomSelect = function(selector, options) {
			if (typeof TomSelect === 'undefined') {
				console.warn('Tom Select not loaded. Please ensure tom-select is available.');
				return null;
			}

			var element = typeof selector === 'string' ? document.querySelector(selector) : selector;
			if (!element) {
				console.warn('Element not found for selector:', selector);
				return null;
			}

			if (element.tomselect) {
				element.tomselect.destroy();
			}

			var config = {
				plugins: ['clear_button'],
				placeholder: (options && options.placeholder) || 'Select an option',
				allowEmptyOption: true,
				...(options || {})
			};

			if (config.width) {
				element.style.width = config.width;
				delete config.width;
			}

			try {
				var instance = new TomSelect(element, config);
				element.tomselect = instance;
				return instance;
			} catch (error) {
				console.error('Failed to initialize Tom Select:', error);
				return null;
			}
		};

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

		window.initDynamicTomSelects = function(root) {
			var scope = root || document;
			if (typeof window.initTomSelect !== 'function') {
				return;
			}

			scope.querySelectorAll('.js-tom-select').forEach(function(select) {
				if (!select.tomselect) {
					window.initTomSelect(select, {
						placeholder: 'Select an option',
						allowEmptyOption: true
					});
				}
			});

			if (typeof window.refreshLucideIcons === 'function') {
				window.refreshLucideIcons(scope);
			}
		};

		window.setTaskViewHtml = function(html) {
			var container = document.querySelector('.taskview');
			if (!container) return;
			container.innerHTML = html;

			function initModalControls(attempt) {
				if (typeof window.TomSelect !== 'undefined' && typeof window.initDynamicTomSelects === 'function') {
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
	
	<!-- Vite JS - Modern optimized JavaScript bundle with code splitting -->
	@vite(['resources/js/admin.js'])
	
	<!-- Custom Scripts (load last to ensure DOM is ready) -->
	<script src="{{ asset('js/custom-form-validation.js')}}"></script>
	<script src="{{ asset('js/scripts.js')}}"></script>
	<script src="{{ asset('js/custom.js')}}"></script>
	<script src="{{ asset('js/admin-confirm.js')}}"></script>
	<script src="{{ asset('js/admin-csp-actions.js')}}"></script>
	
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
