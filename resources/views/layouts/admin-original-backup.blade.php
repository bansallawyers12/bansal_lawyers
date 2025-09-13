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
	<!-- Modern Vite CSS Bundle - Optimized Performance -->
	@vite(['resources/sass/app.scss', 'resources/css/admin.css'])


<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
<!-- Updated to jQuery 3.7.1 -->

<style@cspnonce>
.dropbtn {
  background-color: transparent;
 border:0;
}
.ui.yellow.label, .ui.yellow.labels .label, .select2resultrepositorystatistics .yellow {background-color: #fbbd08;border-color: #fbbd08;color: #fff;}
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
		<div class="popuploader" style="display: none;"@cspnonce></div>
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
				<script@cspnonce>
				    var site_url = '{{URL::to('/')}}';
				     var dataformat = '{{$dataformat}}';
				    </script>
	<!--<script src="{{--asset('js/niceCountryInput.js')--}}"></script> -->
	
	<!-- Vite JS - Using simple version for testing -->
	@vite(['resources/js/app-simple.js'])
	
	<!-- Alpine.js Utilities -->
	@vite(['resources/js/alpine-utils.js'])
	
	<!-- Modern Components (replaces legacy jQuery scripts) -->
	<!-- Legacy scripts removed - functionality replaced with Alpine.js components -->
	
	<!-- Page Specific JS File -->
	<!--<script src="{{ asset('js/index.js')}}"></script> -->
	<!--<script src="{{--asset('js/apexcharts.min.js')--}}"></script>-->
	<!--<script src="{{--asset('js/jquery.flagstrap.js')--}}"></script>-->
	<script@cspnonce>
		// Alpine.js initialization
		document.addEventListener('alpine:init', () => {
			// Global Alpine.js data
			Alpine.data('adminApp', () => ({
				// Form validation
				validateForm(formId) {
					return formUtils.validateForm(formId);
				},
				
				// Modal management
				showModal(modalId) {
					modalUtils.show(modalId);
				},
				
				hideModal(modalId) {
					modalUtils.hide(modalId);
				},
				
				// Loading states
				showLoading() {
					loadingUtils.show();
				},
				
				hideLoading() {
					loadingUtils.hide();
				},
				
				// Phone input handling
				handlePhoneInput(event) {
					// Phone input validation logic
					event.target.value = event.target.value;
				}
			}));
		});

		// Initialize when DOM is ready
		document.addEventListener('DOMContentLoaded', function () {
			// Handle form validation button with event delegation
			eventUtils.delegate('body', '[data-validate-form]', 'click', function(e) {
				const formId = e.target.getAttribute('data-validate-form');
				formUtils.validateForm(formId);
			});

			// Handle phone input blur
			eventUtils.delegate('body', '.tel_input', 'blur', function(e) {
				// Phone input validation logic
				e.target.value = e.target.value;
			});

			// Initialize Select2 with Alpine.js data
			Alpine.data('select2Config', () => ({
				init() {
					// Initialize assignee select2
					if (this.$refs.assigneeSelect) {
						$(this.$refs.assigneeSelect).select2({
							dropdownParent: $('#checkinmodal')
						});
					}
					
					// Initialize client search select2
					if (this.$refs.clientSearch) {
						$(this.$refs.clientSearch).select2({
							closeOnSelect: true,
							ajax: {
								url: '{{URL::to('/admin/clients/get-allclients')}}',
								dataType: 'json',
								processResults: (data) => ({
									results: data.items
								}),
								cache: true
							},
							templateResult: this.formatRepoMain,
							templateSelection: this.formatRepoSelectionMain
						});
					}
				},
				
				formatRepoMain(repo) {
					if (repo.loading) return repo.text;
					
					const statusClass = repo.status === 'Archived' ? 'select2-result-repository__statistics' : 'ui label yellow select2-result-repository__statistics';
					
					return `
						<div dataid="${repo.cid}" class="selectclient select2-result-repository ag-flex ag-space-between ag-align-center">
							<div class="ag-flex ag-align-start">
								<div class="ag-flex ag-flex-column col-hr-1">
									<div class="ag-flex">
										<span class="select2-result-repository__title text-semi-bold">${repo.name}</span>&nbsp;
									</div>
									<div class="ag-flex ag-align-center">
										<small class="select2-result-repository__description">${repo.email}</small>
									</div>
								</div>
							</div>
							<div class="ag-flex ag-flex-column ag-align-end">
								<span class="select2resultrepositorystatistics">
									<span class="ui label ${statusClass}">${repo.status}</span>
								</span>
							</div>
						</div>
					`;
				},
				
				formatRepoSelectionMain(repo) {
					return repo.name || repo.text;
				}
			}));
			// Old jQuery functions removed - now handled by Alpine.js

			// Handle client search selection change
			eventUtils.delegate('body', '.js-data-example-ajaxccsearch', 'change', function(e) {
				const value = e.target.value;
				const parts = value.split('/');
				
				if (parts[1] === 'Client') {
					window.location = '{{URL::to('/admin/clients/detail/')}}/' + parts[0];
				} else {
					window.location = '{{URL::to('/admin/leads/history/')}}/' + parts[0];
				}
				
				return false;
			});


			// Handle check-in modal opening
			eventUtils.delegate('body', '.opencheckin', 'click', function(e) {
				modalUtils.show('checkinmodal');
			});
			
			// Handle visit purpose blur
			eventUtils.delegate('body', '.visitpurpose', 'blur', async function(e) {
				const visitPurpose = e.target.value;
				const appliId = e.target.getAttribute('data-id');
				
				if (!visitPurpose || !appliId) return;
				
				loadingUtils.show();
				
				try {
					await ajaxUtils.post(site_url + '/admin/update_visit_purpose', {
						id: appliId,
						visit_purpose: visitPurpose
					});
					
					const response = await ajaxUtils.get(site_url + '/admin/get-checkin-detail', { id: appliId });
					domUtils.setHTML('.showchecindetail', response);
					loadingUtils.hide();
				} catch (error) {
					console.error('Error updating visit purpose:', error);
					loadingUtils.hide();
				}
			});

			// Handle save visit comment
			eventUtils.delegate('body', '.savevisitcomment', 'click', async function(e) {
				const visitComment = domUtils.getValue('.visit_comment');
				const appliId = e.target.getAttribute('data-id');
				
				if (!visitComment || !appliId) return;
				
				loadingUtils.show();
				
				try {
					await ajaxUtils.post(site_url + '/admin/update_visit_comment', {
						id: appliId,
						visit_comment: visitComment
					});
					
					domUtils.setValue('.visit_comment', '');
					
					const response = await ajaxUtils.get(site_url + '/admin/get-checkin-detail', { id: appliId });
					domUtils.setHTML('.showchecindetail', response);
					loadingUtils.hide();
				} catch (error) {
					console.error('Error saving visit comment:', error);
					loadingUtils.hide();
				}
			});

			// Handle attend session
			eventUtils.delegate('body', '.attendsession', 'click', async function(e) {
				const appliId = e.target.getAttribute('data-id');
				const waitCountData = domUtils.getValue('#waitcountdata');
				
				if (!appliId) return;
				
				loadingUtils.show();
				
				try {
					const response = await ajaxUtils.post(site_url + '/admin/attend_session', {
						id: appliId,
						waitcountdata: waitCountData
					});
					
					const result = JSON.parse(response);
					
					if (result.status) {
						const detailResponse = await ajaxUtils.get(site_url + '/admin/get-checkin-detail', { id: appliId });
						domUtils.setHTML('.showchecindetail', detailResponse);
						domUtils.hide(`.checindata #id_${appliId}`);
						loadingUtils.hide();
					} else {
						alert(result.message);
						loadingUtils.hide();
					}
				} catch (error) {
					console.error('Error attending session:', error);
					loadingUtils.hide();
				}
			});

			// Handle complete session
			eventUtils.delegate('body', '.completesession', 'click', async function(e) {
				const appliId = e.target.getAttribute('data-id');
				const attendCountData = domUtils.getValue('#attendcountdata');
				
				if (!appliId) return;
				
				loadingUtils.show();
				
				try {
					const response = await ajaxUtils.post(site_url + '/admin/complete_session', {
						id: appliId,
						attendcountdata: attendCountData
					});
					
					const result = JSON.parse(response);
					
					if (result.status) {
						const detailResponse = await ajaxUtils.get(site_url + '/admin/get-checkin-detail', { id: appliId });
						domUtils.setHTML('.showchecindetail', detailResponse);
						domUtils.hide(`.checindata #id_${appliId}`);
						loadingUtils.hide();
					} else {
						alert(result.message);
						loadingUtils.hide();
					}
				} catch (error) {
					console.error('Error completing session:', error);
					loadingUtils.hide();
				}
			});
			// Handle open check-in detail
			eventUtils.delegate('body', '.opencheckindetail', 'click', async function(e) {
				const appliId = e.target.getAttribute('id');
				
				if (!appliId) return;
				
				modalUtils.show('checkindetailmodal');
				loadingUtils.show();
				
				try {
					const response = await ajaxUtils.get(site_url + '/admin/get-checkin-detail', { id: appliId });
					domUtils.setHTML('.showchecindetail', response);
					loadingUtils.hide();
				} catch (error) {
					console.error('Error loading check-in detail:', error);
					loadingUtils.hide();
				}
			});
			/* $(".niceCountryInputSelector").each(function(i,e){
				new NiceCountryInput(e).init();
			}); */
			//$('.country_input').flagStrap();
			// Telephone input initialization moved to Alpine.js component
			// Table dropdown functionality with Alpine.js
			Alpine.data('tableDropdown', () => ({
				activeDropdown: null,
				
				toggleDropdown(dropdownClass) {
					this.activeDropdown = this.activeDropdown === dropdownClass ? null : dropdownClass;
				},
				
				handleColumnToggle(value, tableClass) {
					if (value === 'all') {
						const isChecked = event.target.checked;
						const checkboxes = document.querySelectorAll(`.${tableClass} label.dropdown-option input`);
						const table = document.querySelector(`.${tableClass} table`);
						
						checkboxes.forEach(checkbox => {
							checkbox.checked = isChecked;
						});
						
						if (isChecked) {
							tableUtils.showAllColumns(`.${tableClass} table`);
						} else {
							// Show only essential columns (1, 2, 17)
							tableUtils.hideColumnsExcept(`.${tableClass} table`, [1, 2, 17]);
						}
					} else {
						const isChecked = event.target.checked;
						const columnIndex = parseInt(value);
						
						if (isChecked) {
							tableUtils.toggleColumns(`.${tableClass} table`, columnIndex, true);
						} else {
							tableUtils.toggleColumns(`.${tableClass} table`, columnIndex, false);
							// Uncheck "all" if any individual column is unchecked
							const allCheckbox = document.querySelector(`.${tableClass} label.dropdown-option.all input`);
							if (allCheckbox) allCheckbox.checked = false;
						}
					}
				}
			}));

		});

		// Legacy jQuery code removed - functionality moved to Alpine.js components
		// Report table dropdowns and filtering now handled by modern JavaScript
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

		$('.js-data-example-ajax-check').on("select2:select", function(e) {
  var data = e.params.data;
  // Data logged
   $('#utype').val(data.status);
});

			$('.js-data-example-ajax-check').select2({
		 multiple: true,
		 closeOnSelect: false,
		dropdownParent: $('#checkinmodal'),
		  ajax: {
			url: '{{URL::to('/admin/clients/get-recipients')}}',
			dataType: 'json',
			processResults: function (data) {
			  // Transforms the top-level key of the response object from 'items' to 'results'
			  return {
				results: data.items
			  };

			},
			 cache: true

		  },
	templateResult: formatRepocheck,
	templateSelection: formatRepoSelectioncheck
});
function formatRepocheck (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var $container = $(
    "<div  class='select2-result-repository ag-flex ag-space-between ag-align-center'>" +

      "<div  class='ag-flex ag-align-start'>" +
        "<div  class='ag-flex ag-flex-column col-hr-1'><div class='ag-flex'><span  class='select2-result-repository__title text-semi-bold'></span>&nbsp;</div>" +
        "<div class='ag-flex ag-align-center'><small class='select2-result-repository__description'></small ></div>" +

      "</div>" +
      "</div>" +
	   "<div class='ag-flex ag-flex-column ag-align-end'>" +

        "<span class='select2resultrepositorystatistics'>" +

        "</span>" +
      "</div>" +
    "</div>"
  );

  $container.find(".select2-result-repository__title").text(repo.name);
  $container.find(".select2-result-repository__description").text(repo.email);
  if(repo.status == 'Archived'){
	  $container.find(".select2resultrepositorystatistics").append('<span class="ui label select2-result-repository__statistics">'+repo.status+'</span>');
  }else{
	    $container.find(".select2resultrepositorystatistics").append('<span class="ui label yellow select2-result-repository__statistics">'+repo.status+'</span>');
  }


  return $container;
}

function formatRepoSelectioncheck (repo) {
  return repo.name || repo.text;
}

		/* $('.timepicker').timepicker({
			minuteStep: 1,
			showSeconds: true,
		}); */
	});

$(document).ready(function(){
    // Notification system removed - no longer needed
});

	</script>

	<div id="checkinmodal"  data-backdrop="static" data-keyboard="false" class="modal fade custom_modal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="clientModalLabel">Create In Person Client</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" name="checkinmodalsave" id="checkinmodalsave" action="{{URL::to('/admin/checkin')}}" autocomplete="off" enctype="multipart/form-data">
				@csrf

					<div class="flex flex-wrap">
						<div class="w-full md:w-1/2 lg:w-1/2">
							<div class="mb-4">
								<label for="email_from">Search Contact <span class="span_req">*</span></label>
								<select data-valid="required" class="js-data-example-ajax-check" name="contact"></select>
								@if ($errors->has('email_from'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('email_from') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<input type="hidden" id="utype" name="utype" value="">
						<div class="w-full md:w-1/2 lg:w-1/2">
							<div class="mb-4">
								<label for="email_from">Office <span class="span_req">*</span></label>
								<select data-valid="required" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-bansal-blue-500 focus:border-transparent transition-colors duration-200" name="office">
									<option value="">Select</option>
									<option value="1">Main Office</option>
								</select>

							</div>
						</div>

						<div class="w-full md:w-full lg:w-full">
							<div class="mb-4">
								<label for="message">Visit Purpose <span class="span_req">*</span></label>
								<textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-bansal-blue-500 focus:border-transparent transition-colors duration-200" name="message"></textarea>
								@if ($errors->has('message'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('message') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="w-full md:w-full lg:w-full">
							<div class="mb-4">
								<label for="message">Select In Person Assignee <span class="span_req">*</span></label>
								<?php
								$assignee = \App\Models\Admin::all();
								?>
								<select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-bansal-blue-500 focus:border-transparent transition-colors duration-200 assineeselect2" name="assignee">
								@foreach($assignee as $assigne)
									<option value="{{$assigne->id}}">{{$assigne->first_name}} ({{$assigne->email}})</option>
								@endforeach
								</select>
								@if ($errors->has('message'))
									<span class="custom-error" role="alert">
										<strong>{{ @$errors->first('message') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="w-full md:w-full lg:w-full">
							<button type="button" class="font-semibold py-2 px-4 rounded-lg transition-all duration-200 bg-bansal-blue-500 hover:bg-bansal-blue-600 text-white" data-validate-form="checkinmodalsave">Send</button>
							<button type="button" class="font-semibold py-2 px-4 rounded-lg transition-all duration-200 bg-gray-500 hover:bg-gray-600 text-white" data-dismiss="modal">Close</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="checkindetailmodal"  data-backdrop="static" data-keyboard="false" class="modal fade custom_modal" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="clientModalLabel">In Person Details</h5>
				<a style="margin-left:10px;"@cspnonce href="javascript:;"><i class="fa fa-trash"></i> Archive</a>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body showchecindetail">

			</div>
		</div>
	</div>
</div>
@yield('scripts')

<!-- CMS Page Image Lazy Loading Script -->
<script@cspnonce>
document.addEventListener('DOMContentLoaded', function() {
    // Lazy loading for CMS page images
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                const fallbackSrc = img.dataset.fallback;
                
                // Try original image first
                const testImg = new Image();
                testImg.onload = () => {
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                };
                testImg.onerror = () => {
                    img.src = fallbackSrc;
                    img.classList.add('fallback');
                };
                testImg.src = img.dataset.src;
                
                observer.unobserve(img);
            }
        });
    }, {
        rootMargin: '50px 0px', // Start loading 50px before image comes into view
        threshold: 0.1
    });

    // Apply lazy loading to all CMS page images and blog images
    document.querySelectorAll('.cms-image-lazy, .blog-image-lazy, .profile-image-lazy').forEach(img => {
        imageObserver.observe(img);
    });

    // Preload first 5 images immediately for better UX
    const firstImages = document.querySelectorAll('.cms-image-lazy, .blog-image-lazy, .profile-image-lazy');
    for (let i = 0; i < Math.min(5, firstImages.length); i++) {
        const img = firstImages[i];
        const testImg = new Image();
        testImg.onload = () => {
            img.src = img.dataset.src;
            img.classList.add('loaded');
        };
        testImg.onerror = () => {
            img.src = img.dataset.fallback;
            img.classList.add('fallback');
        };
        testImg.src = img.dataset.src;
    }
});
</script>

	<!--<script src="{{--asset('js/custom-chart.js')--}}"></script>-->
</body>
</html>
