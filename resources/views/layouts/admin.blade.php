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
	<title>Bansal Lawyers | @yield('title')</title>
	<!--<link rel="icon" type="image/png" href="{{ asset('images/favicon.png')}}">-->
	<link rel="stylesheet" href="{{ asset('css/app.min.css')}}">
	 <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css')}}">
	<link rel="stylesheet" href="{{ asset('css/summernote-bs4.css')}}">
	<link rel="stylesheet" href="{{ asset('css/daterangepicker.css')}}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-timepicker.min.css')}}">
	<link rel="stylesheet" href="{{ asset('css/select2.min.css')}}">
	<!-- Template CSS -->
	<!--<link rel="stylesheet" href="{{--asset('css/niceCountryInput.css')--}}">-->
	<!--<link rel="stylesheet" href="{{--asset('css/flagstrap.css')--}}">-->

	<link rel="stylesheet" href="{{ asset('css/bootstrap-formhelpers.min.css')}}">
	<link rel="stylesheet" href="{{ asset('css/intlTelInput.css')}}">

	<link rel="stylesheet" href="{{ asset('css/style.css')}}">

	<link rel="stylesheet" href="{{ asset('css/components.css')}}">
	<!-- Custom style CSS -->
	<link rel="stylesheet" href="{{ asset('css/custom.css')}}">

    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">-->

    <link rel="stylesheet" href="{{ asset('css/dataTables_min_latest.css')}}">


<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
<!-- Updated to jQuery 3.7.1 -->
<script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
<script src="{{ asset('js/jquery-migrate-3.4.1.min.js')}}"></script>

<style>
.dropbtn {
  background-color: transparent;
 border:0;
}
.ui.yellow.label, .ui.yellow.labels .label, .select2resultrepositorystatistics .yellow {background-color: #fbbd08!important;border-color: #fbbd08!important;color: #fff!important;}
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
</style>
 
</head>
<body >
	<div class="loader"></div>
		<div class="popuploader" style="display: none;"></div>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<div class="navbar-bg"></div>
			<!--Header-->
			@include('../Elements/Admin/header')
			<!--Left Side Bar-->
			@include('../Elements/Admin/left-side-bar')

			@yield('content')

			@include('../Elements/Admin/footer')
		</div>
	</div>



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
				<script>
				    var site_url = '{{URL::to('/')}}';
				     var dataformat = '{{$dataformat}}';
				    </script>
	<!--<script src="{{--asset('js/niceCountryInput.js')--}}"></script> -->
	
	<!-- Core Application Scripts (load first) -->
	<script src="{{ asset('js/app.min.js')}}"></script>
	
	<!-- Feature-specific Scripts (load after core) -->
	<script src="{{ asset('js/fullcalendar.min.js')}}"></script>
	<script src="{{ asset('js/datatables.min.js')}}"></script>
	<script src="{{ asset('js/dataTables.bootstrap4.js')}}"></script>
	<script src="{{ asset('js/summernote-bs4.js')}}"></script>
	<script src="{{ asset('js/daterangepicker.js')}}"></script>
	<script src="{{ asset('js/bootstrap-timepicker.min.js')}}"></script>
	<script src="{{ asset('js/select2.full.min.js')}}"></script>
	<script src="{{ asset('js/bootstrap-formhelpers.min.js')}}"></script>
	<script src="{{ asset('js/intlTelInput.js')}}"></script>
	
	<!-- Custom Scripts (load last to ensure DOM is ready) -->
	<script src="{{ asset('js/custom-form-validation.js')}}"></script>
	<script src="{{ asset('js/scripts.js')}}"></script>
	<script src="{{ asset('js/custom.js')}}"></script>
	
	<!-- Page Specific JS File -->
	<!--<script src="{{ asset('js/index.js')}}"></script> -->
	<!--<script src="{{--asset('js/apexcharts.min.js')--}}"></script>-->
	<!--<script src="{{--asset('js/jquery.flagstrap.js')--}}"></script>-->
	<script>
		// Date handling utilities for consistent ISO format usage
		window.DateUtils = {
			// Convert display date to ISO format for backend
			toISO: function(dateString, currentFormat) {
				if (!dateString) return '';
				if (currentFormat === 'DD/MM/YYYY') {
					var parts = dateString.split('/');
					return parts[2] + '-' + parts[1].padStart(2, '0') + '-' + parts[0].padStart(2, '0');
				}
				return moment(dateString).format('YYYY-MM-DD');
			},
			
			// Convert ISO date to display format
			toDisplay: function(isoDate, format) {
				if (!isoDate) return '';
				format = format || 'DD/MM/YYYY';
				return moment(isoDate).format(format);
			},
			
			// Validate ISO date format
			isValidISO: function(dateString) {
				return moment(dateString, 'YYYY-MM-DD', true).isValid();
			}
		};
		
		$(document).ready(function () {

		    $(".tel_input").on("blur", function() {
                /*if (/^0/.test(this.value)) {
                   //this.value = this.value.replace(/^0/, "")
                } else {
                    //this.value =  "0" + this.value;
                }*/
                this.value =  this.value;
            });







			/* $(".niceCountryInputSelector").each(function(i,e){
				new NiceCountryInput(e).init();
			}); */
			//$('.country_input').flagStrap();
			$(".telephone").intlTelInput();
			$('.drop_table_data button').on('click', function(){
				$('.client_dropdown_list').toggleClass('active');
			});
			$('.client_dropdown_list label.dropdown-option input').on('click', function(){
			var val = $(this).val();
			if(val == 'all'){
				if ($(this).is(":checked")) {
				$('.client_table_data table tr td').show();
				$('.client_table_data table tr th').show();
				$('.client_dropdown_list label.dropdown-option input').prop('checked', true);
				}else{
					$('.client_dropdown_list label.dropdown-option input').prop('checked', false);
					$('.client_table_data table tr td').hide();
					$('.client_table_data table tr th').hide();
					$('.client_table_data table tr td:nth-child(1)').show();
					$('.client_table_data table tr th:nth-child(1)').show();
					$('.client_table_data table tr td:nth-child(2)').show();
					$('.client_table_data table tr th:nth-child(2)').show();
					$('.client_table_data table tr td:nth-child(17)').show();
					$('.client_table_data table tr th:nth-child(17)').show();
				}

			}else{

			 if ($(this).is(":checked")) {
					$('.client_table_data table tr td:nth-child('+val+')').show();
					$('.client_table_data table tr th:nth-child('+val+')').show();
				  }
				  else{
						$('.client_dropdown_list label.dropdown-option.all input').prop('checked', false);
						$('.client_table_data table tr td:nth-child('+val+')').hide();
						$('.client_table_data table tr th:nth-child('+val+')').hide();
				  }
				}
			});

			$('.drop_table_data button').on('click', function(){
				$('.client_report_list').toggleClass('active');
			});
			$('.client_report_list label.dropdown-option input').on('click', function(){
			var val = $(this).val();
			if(val == 'all'){
				if ($(this).is(":checked")) {
				$('.client_report_data table tr td').show();
				$('.client_report_data table tr th').show();
				$('.client_report_list label.dropdown-option input').prop('checked', true);
				}else{
					$('.client_report_list label.dropdown-option input').prop('checked', false);
					$('.client_report_data table tr td').hide();
					$('.client_report_data table tr th').hide();
					$('.client_report_data table tr td:nth-child(1)').show();
					$('.client_report_data table tr th:nth-child(1)').show();
					$('.client_report_data table tr td:nth-child(2)').show();
					$('.client_report_data table tr th:nth-child(2)').show();
					$('.client_report_data table tr td:nth-child(11)').show();
					$('.client_report_data table tr th:nth-child(11)').show();
				}

			}else{

			 if ($(this).is(":checked")) {
					$('.client_report_data table tr td:nth-child('+val+')').show();
					$('.client_report_data table tr th:nth-child('+val+')').show();
				  }
				  else{
						$('.client_report_list label.dropdown-option.all input').prop('checked', false);
						$('.client_report_data table tr td:nth-child('+val+')').hide();
						$('.client_report_data table tr th:nth-child('+val+')').hide();
				  }
				}
			});

			$('.drop_table_data button').on('click', function(){
				$('.application_report_list').toggleClass('active');
			});
			$('.application_report_list label.dropdown-option input').on('click', function(){
			var val = $(this).val();
			if(val == 'all'){
				if ($(this).is(":checked")) {
				$('.application_report_data table tr td').show();
				$('.application_report_data table tr th').show();
				$('.application_report_list label.dropdown-option input').prop('checked', true);
				}else{
					$('.application_report_list label.dropdown-option input').prop('checked', false);
					$('.application_report_data table tr td').hide();
					$('.application_report_data table tr th').hide();
					$('.application_report_data table tr td:nth-child(1)').show();
					$('.application_report_data table tr th:nth-child(1)').show();
					$('.application_report_data table tr td:nth-child(2)').show();
					$('.application_report_data table tr th:nth-child(2)').show();
					$('.application_report_data table tr td:nth-child(3)').show();
					$('.application_report_data table tr th:nth-child(3)').show();
					$('.application_report_data table tr td:nth-child(5)').show();
					$('.application_report_data table tr th:nth-child(5)').show();
					$('.application_report_data table tr td:nth-child(7)').show();
					$('.application_report_data table tr th:nth-child(7)').show();
				}

			}else{

			 if ($(this).is(":checked")) {
					$('.application_report_data table tr td:nth-child('+val+')').show();
					$('.application_report_data table tr th:nth-child('+val+')').show();
				  }
				  else{
						$('.application_report_list label.dropdown-option.all input').prop('checked', false);
						$('.application_report_data table tr td:nth-child('+val+')').hide();
						$('.application_report_data table tr th:nth-child('+val+')').hide();
				  }
				}
			});

			$('.drop_table_data button').on('click', function(){
				$('.officevisit_report_list').toggleClass('active');
			});
			$('.officevisit_report_list label.dropdown-option input').on('click', function(){
			var val = $(this).val();
			if(val == 'all'){
				if ($(this).is(":checked")) {
				$('.officevisit_report_data table tr td').show();
				$('.officevisit_report_data table tr th').show();
				$('.officevisit_report_list label.dropdown-option input').prop('checked', true);
				}else{
					$('.officevisit_report_list label.dropdown-option input').prop('checked', false);
					$('.officevisit_report_data table tr td').hide();
					$('.officevisit_report_data table tr th').hide();
					$('.officevisit_report_data table tr td:nth-child(1)').show();
					$('.officevisit_report_data table tr th:nth-child(1)').show();
					$('.officevisit_report_data table tr td:nth-child(2)').show();
					$('.officevisit_report_data table tr th:nth-child(2)').show();
					$('.officevisit_report_data table tr td:nth-child(4)').show();
					$('.officevisit_report_data table tr th:nth-child(4)').show();
				}

			}else{

			 if ($(this).is(":checked")) {
					$('.officevisit_report_data table tr td:nth-child('+val+')').show();
					$('.officevisit_report_data table tr th:nth-child('+val+')').show();
				  }
				  else{
						$('.officevisit_report_list label.dropdown-option.all input').prop('checked', false);
						$('.officevisit_report_data table tr td:nth-child('+val+')').hide();
						$('.officevisit_report_data table tr th:nth-child('+val+')').hide();
				  }
				}
			});

			$('.drop_table_data button').on('click', function(){
				$('.invoice_report_list').toggleClass('active');
			});
			$('.invoice_report_list label.dropdown-option input').on('click', function(){
			var val = $(this).val();
			if(val == 'all'){
				if ($(this).is(":checked")) {
				$('.invoice_report_data table tr td').show();
				$('.invoice_report_data table tr th').show();
				$('.invoice_report_list label.dropdown-option input').prop('checked', true);
				}else{
					$('.invoice_report_list label.dropdown-option input').prop('checked', false);
					$('.invoice_report_data table tr td').hide();
					$('.invoice_report_data table tr th').hide();
					$('.invoice_report_data table tr td:nth-child(1)').show();
					$('.invoice_report_data table tr th:nth-child(1)').show();
					$('.invoice_report_data table tr td:nth-child(2)').show();
					$('.invoice_report_data table tr th:nth-child(2)').show();
					$('.invoice_report_data table tr td:nth-child(4)').show();
					$('.invoice_report_data table tr th:nth-child(4)').show();
				}

			}else{

			 if ($(this).is(":checked")) {
					$('.invoice_report_data table tr td:nth-child('+val+')').show();
					$('.invoice_report_data table tr th:nth-child('+val+')').show();
				  }
				  else{
						$('.invoice_report_list label.dropdown-option.all input').prop('checked', false);
						$('.invoice_report_data table tr td:nth-child('+val+')').hide();
						$('.invoice_report_data table tr th:nth-child('+val+')').hide();
				  }
				}
			});

			$('.drop_table_data button').on('click', function(){
				$('.saleforecast_applic_report_list').toggleClass('active');
			});
			$('.saleforecast_applic_report_list label.dropdown-option input').on('click', function(){
			var val = $(this).val();
			if(val == 'all'){
				if ($(this).is(":checked")) {
				$('.saleforecast_application_report_data table tr td').show();
				$('.saleforecast_application_report_data table tr th').show();
				$('.saleforecast_applic_report_list label.dropdown-option input').prop('checked', true);
				}else{
					$('.saleforecast_applic_report_list label.dropdown-option input').prop('checked', false);
					$('.saleforecast_application_report_data table tr td').hide();
					$('.saleforecast_application_report_data table tr th').hide();
					$('.saleforecast_application_report_data table tr td:nth-child(1)').show();
					$('.saleforecast_application_report_data table tr th:nth-child(1)').show();
					$('.saleforecast_application_report_data table tr td:nth-child(2)').show();
					$('.saleforecast_application_report_data table tr th:nth-child(2)').show();
					$('.saleforecast_application_report_data table tr td:nth-child(4)').show();
					$('.saleforecast_application_report_data table tr th:nth-child(4)').show();
				}

			}else{

			 if ($(this).is(":checked")) {
					$('.saleforecast_application_report_data table tr td:nth-child('+val+')').show();
					$('.saleforecast_application_report_data table tr th:nth-child('+val+')').show();
				  }
				  else{
						$('.saleforecast_applic_report_list label.dropdown-option.all input').prop('checked', false);
						$('.saleforecast_application_report_data table tr td:nth-child('+val+')').hide();
						$('.saleforecast_application_report_data table tr th:nth-child('+val+')').hide();
				  }
				}
			});

			$('.drop_table_data button').on('click', function(){
				$('.interest_service_report_list').toggleClass('active');
			});
			$('.interest_service_report_list label.dropdown-option input').on('click', function(){
			var val = $(this).val();
			if(val == 'all'){
				if ($(this).is(":checked")) {
				$('.interest_service_report_data table tr td').show();
				$('.interest_service_report_data table tr th').show();
				$('.interest_service_report_list label.dropdown-option input').prop('checked', true);
				}else{
					$('.interest_service_report_list label.dropdown-option input').prop('checked', false);
					$('.interest_service_report_data table tr td').hide();
					$('.interest_service_report_data table tr th').hide();
					$('.interest_service_report_data table tr td:nth-child(1)').show();
					$('.interest_service_report_data table tr th:nth-child(1)').show();
					$('.interest_service_report_data table tr td:nth-child(2)').show();
					$('.interest_service_report_data table tr th:nth-child(2)').show();
					$('.interest_service_report_data table tr td:nth-child(10)').show();
					$('.interest_service_report_data table tr th:nth-child(10)').show();
					$('.interest_service_report_data table tr td:nth-child(14)').show();
					$('.interest_service_report_data table tr th:nth-child(14)').show();
				}

			}else{

			 if ($(this).is(":checked")) {
					$('.interest_service_report_data table tr td:nth-child('+val+')').show();
					$('.interest_service_report_data table tr th:nth-child('+val+')').show();
				  }
				  else{
						$('.interest_service_report_list label.dropdown-option.all input').prop('checked', false);
						$('.interest_service_report_data table tr td:nth-child('+val+')').hide();
						$('.interest_service_report_data table tr th:nth-child('+val+')').hide();
				  }
				}
			});

			$('#personal_details .is_business').hide();
			$('#office_income_share .is_super_agent').hide();
			$('#office_income_share .is_sub_agent').hide();

			$('.modal-body form#addgroupinvoice .is_superagentinv').hide();

			$('#agentstructure input[name="struture"]').on('change', function(){
				var id = $(this).attr('id');
				if(id == 'individual'){
					$('#personal_details .is_business').hide();
					$('#personal_details .is_individual').show();
					$('#personal_details .is_business input').attr('data-valid', '');
					$('#personal_details .is_individual input').attr('data-valid', 'required');
				}
				else{
					$('#personal_details .is_individual').hide();
					$('#personal_details .is_business').show();
					$('#personal_details .is_business input').attr('data-valid', 'required');
					$('#personal_details .is_individual input').attr('data-valid', '');
				}
			});
			$('.modal-body form#addgroupinvoice input[name="partner_type"]').on('change', function(){
				var invid = $(this).attr('id');
				if(invid == 'superagent_inv'){
					$('.modal-body form#addgroupinvoice .is_partnerinv').hide();
					$('.modal-body form#addgroupinvoice .is_superagentinv').show();
					$('.modal-body form#addgroupinvoice .is_partnerinv input').attr('data-valid', '');
					$('.modal-body form#addgroupinvoice .is_superagentinv input').attr('data-valid', 'required');
				}
				else{
					$('.modal-body form#addgroupinvoice .is_superagentinv').hide();
					$('.modal-body form#addgroupinvoice .is_partnerinv').show();
					$('.modal-body form#addgroupinvoice .is_partnerinv input').attr('data-valid', 'required');
					$('.modal-body form#addgroupinvoice .is_superagentinv input').attr('data-valid', '');
				}
			});
			$('.modal .modal-body .is_partner').hide();
			$('.modal .modal-body .is_application').hide();
			$('.modal .modal-body input[name="related_to"]').on('change', function(){
				var relid = $(this).attr('id');
				if(relid == 'contact'){
					$('.modal .modal-body .is_partner').hide();
					$('.modal .modal-body .is_application').hide();
					$('.modal .modal-body .is_contact').show();
					$('.modal .modal-body .is_partner select').attr('data-valid', '');
					$('.modal .modal-body .is_application select').attr('data-valid', '');
					$('.modal .modal-body .is_contact select').attr('data-valid', 'required');
				}
				else if(relid == 'partner'){
					$('.modal .modal-body .is_contact').hide();
					$('.modal .modal-body .is_application').hide();
					$('.modal .modal-body .is_partner').show();
					$('.modal .modal-body .is_contact select').attr('data-valid', '');
					$('.modal .modal-body .is_application select').attr('data-valid', '');
					$('.modal .modal-body .is_partner select').attr('data-valid', 'required');
				}
				else if(relid == 'application'){
					$('.modal .modal-body .is_contact').hide();
					$('.modal .modal-body .is_partner').hide();
					$('.modal .modal-body .is_application').show();
					$('.modal .modal-body .is_contact select').attr('data-valid', '');
					$('.modal .modal-body .is_partner select').attr('data-valid', '');
					$('.modal .modal-body .is_application select').attr('data-valid', 'required');
				}
				else{
					$('.modal .modal-body .is_contact').hide();
					$('.modal .modal-body .is_partner').hide();
					$('.modal .modal-body .is_application').hide();
					$('.modal .modal-body .is_contact input').attr('data-valid', '');
					$('.modal .modal-body .is_partner input').attr('data-valid', '');
					$('.modal .modal-body .is_application input').attr('data-valid', '');
				}
			});
			$('#agenttype input#super_agent').on('click', function(){
				if ($(this).is(":checked")) {
					$('#office_income_share .is_super_agent').show();
				}
				else{
					$('#office_income_share .is_super_agent').hide();
				}
			});
			$('#agenttype input#sub_agent').on('click', function(){
				if ($(this).is(":checked")) {
					$('#office_income_share .is_sub_agent').show();
				}
				else{
					$('#office_income_share .is_sub_agent').hide();
				}
			});

			$('#internal select[name="source"]').on('change', function(){
				var sourceval = $(this).val();
				if(sourceval == 'Sub Agent'){
					$('#internal .is_subagent').show();
					$('#internal .is_subagent select').attr('data-valid', 'required');
				}
				else{
					$('#internal .is_subagent').hide();
					$('#internal .is_subagent select').attr('data-valid', '');
				}
			});

			$('.card .card-body .grid_data').hide();
			$('.card .card-body .document_layout_type a.list').on('click', function(){
				$('.card .card-body .document_layout_type a').removeClass('active');
				$(this).addClass('active');
				$('.card .card-body .grid_data').hide();
				$('.card .card-body .list_data').show();
			});
			$('.card .card-body .document_layout_type a.grid').on('click', function(){
				$('.card .card-body .document_layout_type a').removeClass('active');
				$(this).addClass('active');
				$('.card .card-body .list_data').hide();
				$('.card .card-body .grid_data').show();
			});


		/* $('.timepicker').timepicker({
			minuteStep: 1,
			showSeconds: true,
		}); */
	});

$(document).ready(function(){







});

	</script>


@yield('scripts')
	<!--<script src="{{--asset('js/custom-chart.js')--}}"></script>-->
</body>
</html>
