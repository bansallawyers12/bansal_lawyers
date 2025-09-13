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
<body x-data="adminApp()">
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
	
	<!-- Vite JS - Using simple version for testing -->
	@vite(['resources/js/app-simple.js'])
	
	<!-- Alpine.js Utilities -->
	@vite(['resources/js/alpine-utils.js'])
	
	<!-- Modern Components (replaces legacy jQuery scripts) -->
	<!-- Legacy scripts removed - functionality replaced with Alpine.js components -->
	
	<script@cspnonce>
		// Alpine.js Admin Application
		function adminApp() {
			return {
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
					event.target.value = event.target.value;
				},
				
				// Table dropdown functionality
				activeDropdown: null,
				
				toggleDropdown(dropdownClass) {
					this.activeDropdown = this.activeDropdown === dropdownClass ? null : dropdownClass;
				},
				
				handleColumnToggle(value, tableClass) {
					if (value === 'all') {
						const isChecked = event.target.checked;
						const checkboxes = document.querySelectorAll(`.${tableClass} label.dropdown-option input`);
						
						checkboxes.forEach(checkbox => {
							checkbox.checked = isChecked;
						});
						
						if (isChecked) {
							tableUtils.showAllColumns(`.${tableClass} table`);
						} else {
							// Show only essential columns based on table type
							const essentialColumns = this.getEssentialColumns(tableClass);
							tableUtils.hideColumnsExcept(`.${tableClass} table`, essentialColumns);
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
				},
				
				getEssentialColumns(tableClass) {
					const essentialColumnsMap = {
						'client_report_list': [1, 2, 11],
						'application_report_list': [1, 2, 3, 5, 7],
						'officevisit_report_list': [1, 2, 4],
						'invoice_report_list': [1, 2, 4],
						'saleforecast_applic_report_list': [1, 2, 4],
						'interest_service_report_list': [1, 2, 10, 14]
					};
					return essentialColumnsMap[tableClass] || [1, 2];
				},
				
				// Form field visibility management
				handleStructureChange(event) {
					const id = event.target.id;
					if (id === 'individual') {
						domUtils.hide('#personal_details .is_business');
						domUtils.show('#personal_details .is_individual');
						domUtils.setAttribute('#personal_details .is_business input', 'data-valid', '');
						domUtils.setAttribute('#personal_details .is_individual input', 'data-valid', 'required');
					} else {
						domUtils.hide('#personal_details .is_individual');
						domUtils.show('#personal_details .is_business');
						domUtils.setAttribute('#personal_details .is_business input', 'data-valid', 'required');
						domUtils.setAttribute('#personal_details .is_individual input', 'data-valid', '');
					}
				},
				
				handlePartnerTypeChange(event) {
					const invid = event.target.id;
					if (invid === 'superagent_inv') {
						domUtils.hide('.modal-body form#addgroupinvoice .is_partnerinv');
						domUtils.show('.modal-body form#addgroupinvoice .is_superagentinv');
						domUtils.setAttribute('.modal-body form#addgroupinvoice .is_partnerinv input', 'data-valid', '');
						domUtils.setAttribute('.modal-body form#addgroupinvoice .is_superagentinv input', 'data-valid', 'required');
					} else {
						domUtils.hide('.modal-body form#addgroupinvoice .is_superagentinv');
						domUtils.show('.modal-body form#addgroupinvoice .is_partnerinv');
						domUtils.setAttribute('.modal-body form#addgroupinvoice .is_superagentinv input', 'data-valid', '');
						domUtils.setAttribute('.modal-body form#addgroupinvoice .is_partnerinv input', 'data-valid', 'required');
					}
				},
				
				handleRelatedToChange(event) {
					const relid = event.target.id;
					const modalBody = '.modal .modal-body';
					
					// Hide all sections first
					domUtils.hide(`${modalBody} .is_partner`);
					domUtils.hide(`${modalBody} .is_application`);
					domUtils.hide(`${modalBody} .is_contact`);
					
					// Clear all validation
					domUtils.setAttribute(`${modalBody} .is_partner select`, 'data-valid', '');
					domUtils.setAttribute(`${modalBody} .is_application select`, 'data-valid', '');
					domUtils.setAttribute(`${modalBody} .is_contact select`, 'data-valid', '');
					domUtils.setAttribute(`${modalBody} .is_contact input`, 'data-valid', '');
					domUtils.setAttribute(`${modalBody} .is_partner input`, 'data-valid', '');
					domUtils.setAttribute(`${modalBody} .is_application input`, 'data-valid', '');
					
					if (relid === 'contact') {
						domUtils.show(`${modalBody} .is_contact`);
						domUtils.setAttribute(`${modalBody} .is_contact select`, 'data-valid', 'required');
					} else if (relid === 'partner') {
						domUtils.show(`${modalBody} .is_partner`);
						domUtils.setAttribute(`${modalBody} .is_partner select`, 'data-valid', 'required');
					} else if (relid === 'application') {
						domUtils.show(`${modalBody} .is_application`);
						domUtils.setAttribute(`${modalBody} .is_application select`, 'data-valid', 'required');
					}
				},
				
				handleAgentTypeChange(event) {
					const isChecked = event.target.checked;
					const targetClass = event.target.id === 'super_agent' ? '.is_super_agent' : '.is_sub_agent';
					
					if (isChecked) {
						domUtils.show(`#office_income_share ${targetClass}`);
					} else {
						domUtils.hide(`#office_income_share ${targetClass}`);
					}
				},
				
				handleSourceChange(event) {
					const sourceval = event.target.value;
					if (sourceval === 'Sub Agent') {
						domUtils.show('#internal .is_subagent');
						domUtils.setAttribute('#internal .is_subagent select', 'data-valid', 'required');
					} else {
						domUtils.hide('#internal .is_subagent');
						domUtils.setAttribute('#internal .is_subagent select', 'data-valid', '');
					}
				},
				
				handleLayoutToggle(event) {
					const isList = event.target.classList.contains('list');
					const cardBody = event.target.closest('.card .card-body');
					
					// Remove active class from all buttons
					cardBody.querySelectorAll('.document_layout_type a').forEach(btn => {
						btn.classList.remove('active');
					});
					
					// Add active class to clicked button
					event.target.classList.add('active');
					
					if (isList) {
						domUtils.hide(cardBody.querySelector('.grid_data'));
						domUtils.show(cardBody.querySelector('.list_data'));
					} else {
						domUtils.hide(cardBody.querySelector('.list_data'));
						domUtils.show(cardBody.querySelector('.grid_data'));
					}
				},
				
				// Initialize on mount
				init() {
					// Initialize phone inputs
					if (window.intlTelInput) {
						document.querySelectorAll('.telephone').forEach(el => {
							window.intlTelInput(el);
						});
					}
					
					// Initialize Modern Select components
					if (window.modernSelect) {
						// Initialize assignee select
						modernSelect.init('.assineeselect2', {
							placeholder: 'Select Assignee',
							allowEmptyOption: true,
							closeAfterSelect: true
						});
						
						
						
						// Handle modern select change events
						document.querySelectorAll('.js-data-example-ajaxccsearch').forEach(select => {
							select.addEventListener('change', (e) => {
								const value = e.target.value;
								const parts = value.split('/');
								
								if (parts[1] === 'Client') {
									window.location = '{{URL::to('/admin/clients/detail/')}}/' + parts[0];
								} else {
									window.location = '{{URL::to('/admin/leads/history/')}}/' + parts[0];
								}
							});
						});
						
						document.querySelectorAll('.js-data-example-ajax-check').forEach(select => {
							select.addEventListener('change', (e) => {
								const value = e.target.value;
								// Handle status update for check selection
								if (value) {
									domUtils.setValue('#utype', value);
								}
							});
						});
					}
					
					// Set up event delegation for dynamic content
					this.setupEventDelegation();
				},
				
				setupEventDelegation() {
					// Handle form validation
					eventUtils.delegate('body', '[data-validate-form]', 'click', (e) => {
						const formId = e.target.getAttribute('data-validate-form');
						if (window.formValidation) {
							window.formValidation.validateForm(formId);
						}
					});
					
					// Handle phone input blur
					eventUtils.delegate('body', '.tel_input', 'blur', (e) => {
						e.target.value = e.target.value;
					});
					
					// Handle check-in modal opening
					eventUtils.delegate('body', '.opencheckin', 'click', (e) => {
						this.showModal('checkinmodal');
					});
					
					// Handle visit purpose blur
					eventUtils.delegate('body', '.visitpurpose', 'blur', async (e) => {
						const visitPurpose = e.target.value;
						const appliId = e.target.getAttribute('data-id');
						
						if (!visitPurpose || !appliId) return;
						
						this.showLoading();
						
						try {
							await ajaxUtils.post(site_url + '/admin/update_visit_purpose', {
								id: appliId,
								visit_purpose: visitPurpose
							});
							
							const response = await ajaxUtils.get(site_url + '/admin/get-checkin-detail', { id: appliId });
							domUtils.setHTML('.showchecindetail', response);
							this.hideLoading();
						} catch (error) {
							console.error('Error updating visit purpose:', error);
							this.hideLoading();
						}
					});
					
					// Handle save visit comment
					eventUtils.delegate('body', '.savevisitcomment', 'click', async (e) => {
						const visitComment = domUtils.getValue('.visit_comment');
						const appliId = e.target.getAttribute('data-id');
						
						if (!visitComment || !appliId) return;
						
						this.showLoading();
						
						try {
							await ajaxUtils.post(site_url + '/admin/update_visit_comment', {
								id: appliId,
								visit_comment: visitComment
							});
							
							domUtils.setValue('.visit_comment', '');
							
							const response = await ajaxUtils.get(site_url + '/admin/get-checkin-detail', { id: appliId });
							domUtils.setHTML('.showchecindetail', response);
							this.hideLoading();
						} catch (error) {
							console.error('Error saving visit comment:', error);
							this.hideLoading();
						}
					});
					
					// Handle attend session
					eventUtils.delegate('body', '.attendsession', 'click', async (e) => {
						const appliId = e.target.getAttribute('data-id');
						const waitCountData = domUtils.getValue('#waitcountdata');
						
						if (!appliId) return;
						
						this.showLoading();
						
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
								this.hideLoading();
							} else {
								alert(result.message);
								this.hideLoading();
							}
						} catch (error) {
							console.error('Error attending session:', error);
							this.hideLoading();
						}
					});
					
					// Handle complete session
					eventUtils.delegate('body', '.completesession', 'click', async (e) => {
						const appliId = e.target.getAttribute('data-id');
						const attendCountData = domUtils.getValue('#attendcountdata');
						
						if (!appliId) return;
						
						this.showLoading();
						
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
								this.hideLoading();
							} else {
								alert(result.message);
								this.hideLoading();
							}
						} catch (error) {
							console.error('Error completing session:', error);
							this.hideLoading();
						}
					});
					
					// Handle open check-in detail
					eventUtils.delegate('body', '.opencheckindetail', 'click', async (e) => {
						const appliId = e.target.getAttribute('id');
						
						if (!appliId) return;
						
						this.showModal('checkindetailmodal');
						this.showLoading();
						
						try {
							const response = await ajaxUtils.get(site_url + '/admin/get-checkin-detail', { id: appliId });
							domUtils.setHTML('.showchecindetail', response);
							this.hideLoading();
						} catch (error) {
							console.error('Error loading check-in detail:', error);
							this.hideLoading();
						}
					});
				},
				
				// Select2 template functions
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
				},
				
				formatRepoCheck(repo) {
					if (repo.loading) return repo.text;
					
					const statusClass = repo.status === 'Archived' ? 'select2-result-repository__statistics' : 'ui label yellow select2-result-repository__statistics';
					
					return `
						<div class="select2-result-repository ag-flex ag-space-between ag-align-center">
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
				
				formatRepoSelectionCheck(repo) {
					return repo.name || repo.text;
				}
			}
		}
	</script>

	<div id="checkinmodal" class="modal fade custom_modal hidden" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="clientModalLabel">Create In Person Client</h5>
				<button type="button" class="close" @click="hideModal('checkinmodal')" aria-label="Close">
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
							<button type="button" class="font-semibold py-2 px-4 rounded-lg transition-all duration-200 bg-gray-500 hover:bg-gray-600 text-white" @click="hideModal('checkinmodal')">Close</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="checkindetailmodal" class="modal fade custom_modal hidden" tabindex="-1" role="dialog" aria-labelledby="clientModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="clientModalLabel">In Person Details</h5>
				<a style="margin-left:10px;"@cspnonce href="javascript:;"><i class="fa fa-trash"></i> Archive</a>
				<button type="button" class="close" @click="hideModal('checkindetailmodal')" aria-label="Close">
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

</body>
</html>
