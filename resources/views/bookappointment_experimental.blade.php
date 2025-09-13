@extends('layouts.frontend_appointment')

@section('seoinfo')
    <title>Book Appointment with Top Law Firm in Melbourne - Experimental</title>
    <meta name="description" content="Book an appointment with Bansal Lawyers, one of the top law firms in Melbourne, Australia. Schedule a consultation for expert legal guidance in divorce, visa matters, property disputes, and more." />

	<link rel="canonical" href="<?php echo URL::to('/'); ?>/book-an-appointment" />

	<!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo URL::to('/'); ?>/book-an-appointment">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Book an Appointment | Schedule a Consultation with Top Law Firm Bansal Lawyers Melbourne">
    <meta property="og:description" content="Book an appointment with Bansal Lawyers, one of the top law firms in Melbourne, Australia. Schedule a consultation for expert legal guidance in divorce, visa matters, property disputes, and more.">
    <meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="og:image:alt" content="Bansal Lawyers Logo">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="bansallawyers.com.au">
    <meta property="twitter:url" content="<?php echo URL::to('/'); ?>/book-an-appointment">
    <meta name="twitter:title" content="Book an Appointment | Schedule a Consultation with Top Law Firm Bansal Lawyers Melbourne">
    <meta name="twitter:description" content="Book an appointment with Bansal Lawyers, one of the top law firms in Melbourne, Australia. Schedule a consultation for expert legal guidance in divorce, visa matters, property disputes, and more.">
    <meta property="twitter:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
	<meta property="twitter:image:alt" content="Bansal Lawyers Logo">

<!-- Hotjar Tracking Code for https://www.bansallawyers.com.au/migration-law -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:6499398,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
@endsection

@section('content')

<style>
/* Experimental Appointment Page Styles */
.experimental-appointment-hero {
    background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.experimental-appointment-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset('images/bg_2.jpg') }}') center/cover;
    opacity: 0.3;
    z-index: 1;
}

.experimental-appointment-hero .container {
    position: relative;
    z-index: 2;
}

.experimental-appointment-hero h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.experimental-appointment-hero p {
    font-size: 1.2rem;
    opacity: 0.9;
}

.experimental-appointment-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.experimental-info-card {
    background: white;
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    margin-bottom: 40px;
}

.experimental-info-card h2 {
    color: #1B4D89;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
    text-align: center;
}

.experimental-info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.experimental-info-list li {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    border-left: 5px solid #1B4D89;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.experimental-info-list li:hover {
    transform: translateX(10px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.experimental-info-list li strong {
    color: #1B4D89;
    font-size: 1.1rem;
    display: block;
    margin-bottom: 10px;
}

.experimental-info-list li span {
    color: #666;
    line-height: 1.6;
    display: block;
}

.experimental-contact-info {
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: white;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    margin-top: 30px;
}

.experimental-contact-info h4 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.experimental-contact-info p {
    margin: 0;
    font-size: 1.1rem;
}

.experimental-form-section {
    background: white;
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.experimental-form-tabs {
    border-bottom: 2px solid #e9ecef;
    margin-bottom: 40px;
}

.experimental-tab-nav {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 20px;
    flex-wrap: wrap;
}

.experimental-tab-nav li {
    margin: 0;
}

.experimental-tab-nav a {
    display: block;
    padding: 15px 25px;
    background: #f8f9fa;
    color: #666;
    text-decoration: none;
    border-radius: 10px 10px 0 0;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.experimental-tab-nav a.active {
    background: #1B4D89;
    color: white;
    border-color: #1B4D89;
}

.experimental-tab-nav a.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}

.experimental-tab-content {
    display: none;
}

.experimental-tab-content.active {
    display: block;
}

.experimental-form-group {
    margin-bottom: 25px;
}

.experimental-form-group label {
    color: #1B4D89;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
    font-size: 1.1rem;
}

.experimental-form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 1rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    background: #f8f9fa;
}

.experimental-form-control:focus {
    outline: none;
    border-color: #1B4D89;
    box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.1);
    background: white;
}

.experimental-form-control::placeholder {
    color: #999;
}

.experimental-textarea {
    min-height: 120px;
    resize: vertical;
}

.experimental-btn {
    background: linear-gradient(135deg, #1B4D89, #2c5aa0);
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(27, 77, 137, 0.3);
}

.experimental-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(27, 77, 137, 0.4);
}

.experimental-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.experimental-service-item {
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.experimental-service-item:hover {
    border-color: #1B4D89;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.experimental-service-item.selected {
    border-color: #1B4D89;
    background: rgba(27, 77, 137, 0.05);
}

.experimental-service-item input[type="radio"] {
    margin-right: 15px;
    transform: scale(1.2);
}

.experimental-service-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1B4D89;
    margin-bottom: 10px;
}

.experimental-service-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1B4D89;
    float: right;
}

.experimental-service-description {
    color: #666;
    margin-top: 10px;
    clear: both;
}

.experimental-calendar-section {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 30px;
    margin: 20px 0;
}

.experimental-timezone-info {
    background: #e3f2fd;
    color: #1565c0;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 0.9rem;
}

.experimental-calendar-container {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
}

.experimental-calendar {
    flex: 1;
    min-width: 300px;
}

.experimental-timeslots {
    flex: 1;
    min-width: 300px;
}

.experimental-timeslot {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 15px 20px;
    margin: 10px 10px 10px 0;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-block;
    text-align: center;
    min-width: 120px;
}

.experimental-timeslot:hover {
    border-color: #1B4D89;
    background: rgba(27, 77, 137, 0.05);
}

.experimental-timeslot.active {
    background: #1B4D89;
    color: white;
    border-color: #1B4D89;
}

.experimental-confirmation-table {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.experimental-confirmation-table table {
    width: 100%;
    margin: 0;
}

.experimental-confirmation-table th {
    background: #1B4D89;
    color: white;
    padding: 15px;
    font-weight: 600;
    text-align: left;
}

.experimental-confirmation-table td {
    padding: 15px;
    border-bottom: 1px solid #e9ecef;
}

.experimental-alert {
    background: #d4edda;
    color: #155724;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 30px;
    border: 1px solid #c3e6cb;
}

.experimental-loading {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.experimental-loading.show {
    display: flex;
}

.experimental-loading-content {
    background: white;
    padding: 40px;
    border-radius: 15px;
    text-align: center;
}

.experimental-loading-spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #1B4D89;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto 20px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@media (max-width: 768px) {
    .experimental-appointment-hero h1 {
        font-size: 2.5rem;
    }
    
    .experimental-info-card,
    .experimental-form-section {
        padding: 30px 20px;
    }
    
    .experimental-tab-nav {
        flex-direction: column;
        gap: 10px;
    }
    
    .experimental-calendar-container {
        flex-direction: column;
    }
    
    .experimental-timeslot {
        min-width: 100px;
        padding: 10px 15px;
    }
}
</style>

<!-- Experimental Hero Section -->
<section class="experimental-appointment-hero">
    <div class="container">
        <h1>Book An Appointment</h1>
        <p>Schedule your consultation with our expert legal team</p>
    </div>
</section>

<!-- Experimental Appointment Section -->
<section class="experimental-appointment-section">
    <div class="container">
        <!-- Important Information -->
        <div class="experimental-info-card">
            <h2>Important Information Regarding Booking an Appointment</h2>
            <ol class="experimental-info-list">
                <li>
                    <strong>Types of Consultations:</strong>
                    <span>We offer In-person, Phone, Zoom / Google Meeting consultations, so you can book according to your preference.</span>
                </li>
                <li>
                    <strong>Consultation Charges:</strong>
                    <span>The consultation fee is 150 AUD incl GST. Payment is required at the time of booking.</span>
                </li>
                <li>
                    <strong>Cancellation and Rescheduling:</strong>
                    <span>You can cancel or reschedule your appointment up to 24 hours in advance without any charges.</span>
                </li>
                <li>
                    <strong>Provide Comprehensive Case Details:</strong>
                    <span>For a more effective consultation, please provide a brief overview of your case or legal concern when booking.</span>
                </li>
                <li>
                    <strong>Privacy and Confidentiality:</strong>
                    <span>All consultations are strictly confidential. Your privacy is our priority.</span>
                </li>
                <li>
                    <strong>Emergency Appointments:</strong>
                    <span>In case of urgent matters, please contact our office directly to request a priority consultation.</span>
                </li>
            </ol>
            
            <div class="experimental-contact-info">
                <h4>Contact Us</h4>
                <p>For any issues with the booking process or questions regarding your appointment, please feel free to call us at <strong>1300 BANSAL (1300 226 725)</strong> or email us</p>
            </div>
        </div>

        <!-- Appointment Form -->
        <div class="experimental-form-section">
            <form class="experimental-appointment-form" id="appintment_form" action="<?php echo URL::to('/'); ?>/book-an-appointment/store" method="post" enctype="multipart/form-data">
                <!-- Tab Navigation -->
                <div class="experimental-form-tabs">
                    <ul class="experimental-tab-nav">
                        <li>
                            <a href="#nature_of_enquiry" class="experimental-tab-link active" data-tab="nature_of_enquiry">
                                <i class="fa fa-question-circle mr-2"></i>Nature of Enquiry
                            </a>
                        </li>
                        <li>
                            <a href="#services" class="experimental-tab-link disabled" data-tab="services">
                                <i class="fa fa-cogs mr-2"></i>Services
                            </a>
                        </li>
                        <li>
                            <a href="#appointment_details" class="experimental-tab-link disabled" data-tab="appointment_details">
                                <i class="fa fa-calendar mr-2"></i>Appointment Details
                            </a>
                        </li>
                        <li>
                            <a href="#info" class="experimental-tab-link disabled" data-tab="info">
                                <i class="fa fa-user mr-2"></i>Information
                            </a>
                        </li>
                        <li>
                            <a href="#confirm" class="experimental-tab-link disabled" data-tab="confirm">
                                <i class="fa fa-check-circle mr-2"></i>Confirmation
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="experimental-tab-content active" id="nature_of_enquiry">
                    <div class="experimental-form-group">
                        <label for="noe_id">Nature of Enquiry</label>
                        <select class="experimental-form-control enquiry_item" name="noe_id" required>
                            <option value="">Select Nature of Enquiry</option>
                            @foreach(\App\Models\NatureOfEnquiry::where('status',1)->get() as $enquiry)
                                <option value="{{$enquiry->id}}">{{$enquiry->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="button" class="experimental-btn next-tab" data-next="services">Next Step</button>
                    </div>
                </div>

                <div class="experimental-tab-content" id="services">
                    <div class="experimental-form-group">
                        <label>Services</label>
                        @php
                            $paidService = \App\Models\BookService::where('status',1)->where('id',1)->first();
                        @endphp
                        @if($paidService)
                            <div class="experimental-service-item" id="serviceval_1">
                                <input type="radio" class="services_item" name="radioGroup" value="1" checked>
                                <div class="experimental-service-title">{{$paidService->title}} ({{$paidService->duration_for_display}} minutes)</div>
                                <div class="experimental-service-price">{{$paidService->price}}</div>
                                <div class="experimental-service-description">Professional legal consultation with our expert team</div>
                            </div>
                        @endif
                        <input type="hidden" id="service_id" name="service_id" value="1">
                    </div>
                    <div class="text-center">
                        <button type="button" class="experimental-btn next-tab" data-next="appointment_details">Next Step</button>
                    </div>
                </div>

                <div class="experimental-tab-content" id="appointment_details">
                    <div class="experimental-form-group">
                        <label for="appointment_details">Appointment Type</label>
                        <select class="experimental-form-control appointment_item" name="appointment_details" required>
                            <option value="">Select Appointment Type</option>
                            <option value="In-person">In-person</option>
                            <option value="Phone">Phone</option>
                            <option value="Zoom / Google Meeting">Zoom / Google Meeting</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="button" class="experimental-btn next-tab" data-next="info">Next Step</button>
                    </div>
                </div>

                <div class="experimental-tab-content" id="info">
                    <div class="experimental-form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="experimental-form-control fullname infoFormFields" placeholder="Enter your full name" name="fullname" required />
                    </div>
                    <div class="experimental-form-group">
                        <label for="email">Email</label>
                        <input type="email" class="experimental-form-control email infoFormFields" placeholder="Enter your email address" name="email" required />
                    </div>
                    <div class="experimental-form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="experimental-form-control phone infoFormFields" placeholder="Enter your phone number" name="phone" required />
                    </div>
                    <div class="experimental-form-group">
                        <label for="description">Details Of Enquiry</label>
                        <textarea class="experimental-form-control experimental-textarea description infoFormFields" placeholder="Please provide details about your legal matter" name="description" required></textarea>
                    </div>
                    
                    <div class="experimental-calendar-section">
                        <div class="experimental-timezone-info">
                            <i class="fa fa-clock-o"></i> <strong>Timezone:</strong> All times are displayed in Melbourne, Australia time (AEST/AEDT)
                        </div>
                        
                        <div class="experimental-calendar-container">
                            <div class="experimental-calendar">
                                <label>Select Date</label>
                                <div id='datetimepicker' class="datePickerCls infoFormFields"></div>
                            </div>
                            <div class="experimental-timeslots">
                                <div class="showselecteddate infoFormFields" style="font-size: 14px;text-align: center; padding: 5px 0 3px;border-bottom: 1px solid #E3EAF3;color: #0d0d0f !important;font-weight: bold;"></div>
                                <div class="timeslots infoFormFields" style="overflow:scroll !important;height:185px;"></div>
                            </div>
                        </div>
                        <input type="hidden" id="timeslot_col_date" value="">
                        <input type="hidden" id="timeslot_col_time" value="">
                        <span class="timeslot_col_date_time" role="alert" style="display: none;color:#f00;">Date and Time is required.</span>
                    </div>
                    
                    <div class="text-center">
                        <button type="button" class="experimental-btn next-tab" data-next="confirm">Review & Confirm</button>
                    </div>
                </div>

                <div class="experimental-tab-content" id="confirm">
                    <h3 style="color: #1B4D89; margin-bottom: 30px; text-align: center;">Confirm Your Appointment Details</h3>
                    
                    <div class="experimental-confirmation-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="full_name"></td>
                                    <td class="email"></td>
                                    <td class="phone"></td>
                                    <td class="description"></td>
                                    <td class="date"></td>
                                    <td class="time"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button type="button" class="experimental-btn submitappointment_paid" style="background: linear-gradient(135deg, #28a745, #20c997);">
                            <i class="fa fa-credit-card mr-2"></i>Pay & Submit (AUD 150)
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Loading Overlay -->
<div class="experimental-loading" id="loading">
    <div class="experimental-loading-content">
        <div class="experimental-loading-spinner"></div>
        <p>Processing your appointment...</p>
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(function() {
    // Tab navigation
    $('.next-tab').click(function() {
        var nextTab = $(this).data('next');
        var currentTab = $('.experimental-tab-content.active').attr('id');
        
        // Validate current tab before proceeding
        if (validateCurrentTab(currentTab)) {
            // Hide current tab
            $('.experimental-tab-content').removeClass('active');
            $('.experimental-tab-link').removeClass('active').addClass('disabled');
            
            // Show next tab
            $('#' + nextTab).addClass('active');
            $('[data-tab="' + nextTab + '"]').removeClass('disabled').addClass('active');
            
            // Scroll to top of form
            $('html, body').animate({
                scrollTop: $('.experimental-form-section').offset().top - 100
            }, 'slow');
        }
    });
    
    // Tab link clicks
    $('.experimental-tab-link').click(function(e) {
        e.preventDefault();
        var tab = $(this).data('tab');
        
        if (!$(this).hasClass('disabled')) {
            $('.experimental-tab-content').removeClass('active');
            $('.experimental-tab-link').removeClass('active');
            
            $('#' + tab).addClass('active');
            $(this).addClass('active');
        }
    });
    
    // Service selection
    $('.services_item').change(function() {
        var serviceId = $(this).val();
        $('#service_id').val(serviceId);
        
        // Enable next tab
        $('[data-tab="appointment_details"]').removeClass('disabled');
    });
    
    // Appointment type selection
    $('.appointment_item').change(function() {
        var appointmentType = $(this).val();
        $('input[name="appointment_details"]').val(appointmentType);
        
        // Enable next tab
        $('[data-tab="info"]').removeClass('disabled');
    });
    
    // Form field changes
    $('.infoFormFields').change(function() {
        $('#timeslot_col_date').val("");
        $('#timeslot_col_time').val("");
        $('.confirm_row').hide();
    });
    
    // Enquiry selection
    $('.enquiry_item').change(function() {
        var id = $(this).val();
        if (id != "") {
            $('input[name="noe_id"]').val(id);
            
            // Enable services tab
            $('[data-tab="services"]').removeClass('disabled');
            $('.services_item').prop('checked', true);
            $('#service_id').val(1);
        }
    });
    
    // Time slot selection
    $(document).delegate('.timeslot_col', 'click', function() {
        $('.timeslot_col').removeClass('active');
        $(this).addClass('active');
        
        var fromtime = $(this).attr('data-fromtime');
        var totime = $(this).attr('data-totime');
        
        $('input[name="time"]').val(fromtime + '-' + totime);
        $('#timeslot_col_time').val(fromtime + '-' + totime);
    });
    
    // Form submission
    $('.submitappointment_paid').click(function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            $('#loading').addClass('show');
            
            // Simulate form submission (replace with actual AJAX call)
            setTimeout(function() {
                $('#loading').removeClass('show');
                alert('Appointment submitted successfully! You will receive a confirmation email shortly.');
                // Reset form or redirect
                window.location.reload();
            }, 2000);
        }
    });
    
    function validateCurrentTab(tabId) {
        switch(tabId) {
            case 'nature_of_enquiry':
                return $('.enquiry_item').val() !== '';
            case 'services':
                return $('.services_item:checked').length > 0;
            case 'appointment_details':
                return $('.appointment_item').val() !== '';
            case 'info':
                return validateInfoTab();
            default:
                return true;
        }
    }
    
    function validateInfoTab() {
        var valid = true;
        
        if (!$('.fullname').val()) {
            showError($('.fullname'), 'Full name is required');
            valid = false;
        }
        
        if (!$('.email').val() || !isValidEmail($('.email').val())) {
            showError($('.email'), 'Valid email is required');
            valid = false;
        }
        
        if (!$('.phone').val()) {
            showError($('.phone'), 'Phone number is required');
            valid = false;
        }
        
        if (!$('.description').val()) {
            showError($('.description'), 'Description is required');
            valid = false;
        }
        
        if (!$('#timeslot_col_date').val() || !$('#timeslot_col_time').val()) {
            showError($('.timeslot_col_date_time'), 'Date and time selection is required');
            valid = false;
        }
        
        return valid;
    }
    
    function validateForm() {
        return validateInfoTab();
    }
    
    function showError(field, message) {
        field.addClass('is-invalid');
        field.after('<div class="invalid-feedback">' + message + '</div>');
    }
    
    function isValidEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    // Calendar initialization (simplified for experimental purposes)
    if (typeof $.fn.datepicker !== 'undefined') {
        $('#datetimepicker').datepicker({
            startDate: new Date(),
            format: 'dd/mm/yyyy',
            autoclose: true
        }).on('changeDate', function(e) {
            var date = e.date;
            var formattedDate = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
            $('.showselecteddate').html(formattedDate);
            $('input[name="date"]').val(formattedDate);
            $('#timeslot_col_date').val(formattedDate);
            
            // Generate sample time slots
            generateTimeSlots();
        });
    }
    
    function generateTimeSlots() {
        var timeslots = ['9:00 AM', '10:00 AM', '11:00 AM', '2:00 PM', '3:00 PM', '4:00 PM'];
        var html = '';
        
        timeslots.forEach(function(time) {
            html += '<div class="experimental-timeslot timeslot_col" data-fromtime="' + time + '" data-totime="' + time + '">' + time + '</div>';
        });
        
        $('.timeslots').html(html);
    }
    
    // Update confirmation details
    $('.infoFormFields').on('change input', function() {
        updateConfirmationDetails();
    });
    
    function updateConfirmationDetails() {
        $('.full_name').text($('.fullname').val());
        $('.email').text($('.email').val());
        $('.phone').text($('.phone').val());
        $('.description').text($('.description').val());
        $('.date').text($('input[name="date"]').val());
        $('.time').text($('input[name="time"]').val());
    }
});
</script>

@endsection
