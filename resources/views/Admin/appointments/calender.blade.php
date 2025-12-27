@extends('layouts.admin')
@section('title', 'Appointments')

@section('content')
<style>
/* Appointments calendar modern, light styling */
.fc-event-container .fc-h-event{cursor:pointer;}

/* Card tweaks for lighter, modern look */
.card{
	border-radius:12px;
	border:1px solid #e5e7eb;
	box-shadow:0 8px 24px rgba(0,0,0,0.06);
}
.card-header{
	background:#ffffff;
	border-bottom:1px solid #eef2f7;
}
.card-header h4{
	margin:0;
	font-weight:600;
}

/* FullCalendar refinements */
.fc .fc-toolbar{
	gap:8px;
}
.fc .fc-button{
	border-radius:8px;
	border:1px solid #d1d5db;
	background:#ffffff;
	color:#111827;
	padding:6px 10px;
}
.fc .fc-button:hover{
	background:#f3f4f6;
}
.fc .fc-button.fc-state-active{
	background:#2563eb;
	border-color:#2563eb;
	color:#fff;
}
.fc .fc-today{
	background:#f8fbff !important;
}
.fc-event{
	border:none;
	border-radius:8px;
	padding:2px 4px;
	font-weight:600;
	box-shadow:0 2px 8px rgba(0,0,0,0.06);
}
.fc-unthemed .fc-content, .fc-unthemed .fc-title{color:#fff;}
.fc-unthemed .fc-time{opacity:.9;color:#eef2ff;}

.fc-view, .fc-view > table{
	border-radius:10px;
	border:1px solid #eef2f7;
	background:#fff;
}

/* Week view readability improvements */
.fc-agendaWeek .fc-axis{
	width:72px !important;
	text-align:right;
	color:#111827; /* darker for readability */
	font-weight:700;
	background:#ffffff;
}
.fc-ltr .fc-time-grid .fc-axis{padding-right:10px;}
.fc-time-grid .fc-slats td{height:44px;}
.fc-time-grid .fc-slats .fc-minor td{border-top-color:#e5e7eb;}
.fc-time-grid .fc-slats .fc-major td{border-top-color:#cbd5e1;}
.fc .fc-axis, .fc-day-header{background:#fff;border-bottom:1px solid #eef2f7;}
.fc-day-header{font-weight:700;color:#1f2937;}

/* Enhanced Modal Styling - Fixed positioning */
#event-details-modal {
    z-index: 1050 !important;
    position: fixed !important;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow-y: auto;
    padding-top: 1rem;
    padding-bottom: 1rem;
}
#event-details-modal .modal-dialog {
    position: relative;
    margin: 1rem auto;
    max-width: 700px;
    width: 90%;
    max-height: calc(100vh - 2rem);
    display: flex;
    flex-direction: column;
}
#event-details-modal .modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    position: relative;
    background: #fff;
    flex: 1;
    display: flex;
    flex-direction: column;
    max-height: 100%;
}
#event-details-modal .modal-header {
    background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
    color: white;
    border-radius: 12px 12px 0 0;
    border-bottom: none;
    padding: 1.5rem;
}
#event-details-modal .modal-title {
    font-weight: 600;
    font-size: 1.25rem;
    margin: 0;
}
#event-details-modal .close {
    color: white;
    opacity: 0.8;
    text-shadow: none;
    font-size: 1.5rem;
    background: none;
    border: none;
}
#event-details-modal .close:hover {
    opacity: 1;
    color: white;
}
#event-details-modal .modal-body {
    padding: 2rem;
    background: #ffffff;
    color: #333;
    font-size: 14px;
    flex: 1;
    overflow-y: auto;
    max-height: calc(100vh - 200px);
}
#event-details-modal .modal-body .clienturl {
    margin-bottom: 1.5rem;
    padding: 1.5rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 12px;
    border-left: 4px solid #1B4D89;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
#event-details-modal .modal-body .clienturl .row {
    align-items: center;
}
#event-details-modal .modal-body .clienturl strong {
    font-size: 18px;
    color: #1B4D89;
    font-weight: 700;
}
#event-details-modal .modal-body dl {
    margin-bottom: 1rem;
}
#event-details-modal .modal-body dt {
    font-weight: 700;
    color: #6c757d;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
    position: relative;
}
#event-details-modal .modal-body dt:first-child {
    margin-top: 0;
}
#event-details-modal .modal-body dt::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 30px;
    height: 2px;
    background: #1B4D89;
}
#event-details-modal .modal-body dd {
    font-weight: 600;
    color: #333;
    font-size: 18px;
    margin-bottom: 0;
    padding: 0.75rem 1rem;
    background: #ffffff;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
#event-details-modal .form-control-sm {
    font-size: 13px;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    border: 2px solid #e9ecef;
    transition: all 0.2s ease;
}
#event-details-modal .form-control-sm:focus {
    border-color: #1B4D89;
    box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.1);
}
/* Enhanced Edit Form Styling */
#event-details-modal .if_edit_followup {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 12px;
    margin-top: 2rem;
    border: 1px solid #e9ecef;
}
#event-details-modal .if_edit_followup .form-group {
    margin-bottom: 1.5rem;
}
#event-details-modal .if_edit_followup label {
    font-weight: 600;
    color: #495057;
    font-size: 14px;
    margin-bottom: 0.5rem;
    display: block;
}
#event-details-modal .if_edit_followup .form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 14px;
    transition: all 0.2s ease;
}
#event-details-modal .if_edit_followup .form-control:focus {
    border-color: #1B4D89;
    box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.1);
}
#event-details-modal .if_edit_followup textarea.form-control {
    min-height: 100px;
    resize: vertical;
}
/* Modern Button Styling */
#event-details-modal .btn {
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    font-size: 14px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
#event-details-modal .btn-primary {
    background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(27, 77, 137, 0.3);
}
#event-details-modal .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(27, 77, 137, 0.4);
    color: white;
    text-decoration: none;
}
#event-details-modal .btn-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
}
#event-details-modal .btn-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
    color: white;
    text-decoration: none;
}
#event-details-modal .editfollowupdate {
    color: #1B4D89;
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    margin-left: 1rem;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    transition: all 0.2s ease;
}
#event-details-modal .editfollowupdate:hover {
    background: #1B4D89;
    color: white;
    text-decoration: none;
}
#event-details-modal .editfollowupdate i {
    margin-right: 0.25rem;
}
/* Ensure modal is hidden by default */
#event-details-modal {
    display: none !important;
}
/* Force modal display when show class is added */
#event-details-modal.show {
    display: block !important;
}
/* Modal backdrop styling */
.modal-backdrop {
    position: fixed !important;
    top: 0;
    left: 0;
    z-index: 1040 !important;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
}
.modal-backdrop.show {
    opacity: 0.5;
}
/* Ensure body doesn't scroll when modal is open */
body.modal-open {
    overflow: hidden;
}
/* Status Dropdown Styling */
#event-details-modal #updateappointmentstatus {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-size: 13px;
    font-weight: 600;
    color: #495057;
    cursor: pointer;
    transition: all 0.2s ease;
    appearance: none;
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="%236B7280" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 8l4 4 4-4"/></svg>');
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1rem;
    padding-right: 2.5rem;
}
#event-details-modal #updateappointmentstatus:focus {
    border-color: #1B4D89;
    box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.1);
}
#event-details-modal #updateappointmentstatus:hover {
    border-color: #1B4D89;
}
/* Responsive improvements */
@media (max-width: 768px) {
    #event-details-modal {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }
    #event-details-modal .modal-dialog {
        margin: 0.5rem;
        width: calc(100% - 1rem);
        max-width: none;
        max-height: calc(100vh - 1rem);
    }
    #event-details-modal .modal-body {
        padding: 1.5rem;
        max-height: calc(100vh - 150px);
    }
    #event-details-modal .modal-body .clienturl {
        padding: 1rem;
    }
    #event-details-modal .modal-body .clienturl .row {
        flex-direction: column;
        text-align: center;
    }
    #event-details-modal .modal-body .clienturl .col-md-6:last-child {
        margin-top: 1rem;
    }
    #event-details-modal .modal-body dd {
        font-size: 16px;
        padding: 0.5rem 0.75rem;
    }
    #event-details-modal .if_edit_followup {
        padding: 1.5rem;
    }
    #event-details-modal .btn {
        width: 100%;
        margin-bottom: 0.5rem;
        justify-content: center;
    }
}
</style>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="server-error">
				@include('Elements.flash-message')
			</div>
			<div class="custom-error-msg">
			</div>
			<div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-header">
						    <h4>{{ $type }} Calendar</h4>
						    <div class="alert alert-info" style="padding: 8px 12px; margin-top: 10px; font-size: 12px; border-radius: 4px;">
						        <i class="fa fa-clock-o"></i> <strong>Timezone:</strong> All times are displayed in Melbourne, Australia time (AEST/AEDT)
						    </div>
						</div>
						<div class="card-body">
							 <div class="fc-overflow">
								<div id="myEvent"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php
$sched_res = [];

// Only paid appointments (service_id = 1) for Ajay with active nature of enquiry
$appointments = \App\Models\Appointment::where('service_id', 1)
    ->whereHas('natureOfEnquiry', function($query) {
        $query->where('status', 1);
    })
    ->get();
//dd($appointments);

//$appointments = \App\Models\Appointment::where('invites','=', Auth::user()->id)->get();
foreach($appointments as $appointment){
    $addd = \App\Models\Admin::where('id',$appointment->client_id)->first();
    $datetimes = $appointment->date;
    $datetime = $appointment->date.' '.$appointment->time;
    $curtime = date('Y-m-d');
    if(strtotime($datetimes) >= strtotime($curtime)){
		$row['id'] = $appointment->id;
		$row['stitle'] = addslashes($addd->client_id);
		$row['name'] = base64_encode($addd->first_name.' '.$addd->last_name);

		//$row['title'] = $appointment->title;
		//$row['description'] = $appointment->description;
        //$row['description'] = htmlspecialchars($appointment->description, ENT_QUOTES, 'UTF-8');

	$row['startdate'] = date("Y-m-d H:i:s",strtotime($appointment->date));

	//$row['start'] = date("F d, Y h:i A",strtotime($datetime));
     	// Fix timezone issue: Use datetime string directly without timezone conversion
     	// Check if time already has seconds, if not add them
     	$time_with_seconds = (strlen($appointment->time) == 5) ? $appointment->time . ':00' : $appointment->time;
     	$datetime_string = $appointment->date . ' ' . $time_with_seconds;
     	$row['start'] = $datetime_string;

		//$row['end'] = date("F d, Y h:i A",strtotime($appointment->date));
        if( isset($appointment->timeslot_full) && $appointment->timeslot_full != "" ) {
            $timeslot_full_arr = explode("-", $appointment->timeslot_full);
            if(!empty($timeslot_full_arr) && count($timeslot_full_arr) >= 2 && isset($timeslot_full_arr[1])){
                // Fix timezone issue: Parse end time without timezone conversion
                $end_time_24h = date("H:i", strtotime($timeslot_full_arr[1]));
                // Check if time already has seconds, if not add them
                $end_time_with_seconds = (strlen($end_time_24h) == 5) ? $end_time_24h . ':00' : $end_time_24h;
                $appointment_end_date_time = $appointment->date . ' ' . $end_time_with_seconds;
                $row['end'] = $appointment_end_date_time;
            } else {
                // Default to 1 hour duration if timeslot_full is invalid
                $start_time = strtotime($appointment->date . ' ' . $appointment->time);
                $end_time = $start_time + (60 * 60); // Add 1 hour
                $row['end'] = date('Y-m-d H:i:s', $end_time);
            }
        } else {
            // Default to 1 hour duration if timeslot_full is missing
            $start_time = strtotime($appointment->date . ' ' . $appointment->time);
            $end_time = $start_time + (60 * 60); // Add 1 hour
            $row['end'] = date('Y-m-d H:i:s', $end_time);
        }

		// $row['appointdate'] = $appointment->date;
        $row['appointdate'] = date("d/m/Y",strtotime($appointment->date));


		$row['appointtime'] = $appointment->time;
		$row['status'] = $appointment->status;
		$row['url'] = URL::to('/admin/clients/detail/'.base64_encode(convert_uuencode($appointment->client_id)));

        /*if($appointment->status == 1 || $appointment->status == 2 ){ //1=>Approved,2=>Completed
			$row['backgroundColor'] = "#54ca68"; //Green
		} else if( $appointment->status == 4 ){ //4=>N/P
			$row['backgroundColor'] = "#ff33da"; //pink
		} else {
            if( $appointment->service_id == 1){ //Paid service
                $row['backgroundColor'] = "#6777ef"; //Blue
            } else { //Free service
                $row['backgroundColor'] = "#ff5722"; //Saffron
            }
		}*/

        /*
        0=>Pending Appointment With Free Type,
        1=>Approved,
        2=>Completed,
        3=>Rejected,
        4=>N/P,
        5=>Inrogress,
        6=>Did Not Come,
        7=>Cancelled,
        8=>Missed,
        9=>Pending Appointment With Payment Pending,
        10=>Pending Appointment With Payment Success,
        11=>Pending Appointment With Payment Fail
        */

        if( $appointment->status == 0){ //0=>Pending Appointment With Free Type
			$row['backgroundColor'] = "#ff5722"; //Saffron
		} else if( $appointment->status == 1 ){ //1=>Approved
			$row['backgroundColor'] = "#32CD32"; //LimeGreen
		} else if( $appointment->status == 2 ){ //2=>Completed
			$row['backgroundColor'] = "#4682B4"; //SteelBlue
		} else if( $appointment->status == 3 ){ //3=>Rejected
			$row['backgroundColor'] = "#FF6347"; //Tomato
		} else if( $appointment->status == 4 ){ //4=>N/P
			$row['backgroundColor'] = "#FFD700"; //Gold
		} else if( $appointment->status == 5 ){ //5=>Inrogress
			$row['backgroundColor'] = "#1E90FF"; //DodgerBlue
		} else if( $appointment->status == 6 ){ //6=>Did Not Come
			$row['backgroundColor'] = "#8B0000"; //DarkRed
		} else if( $appointment->status == 7 ){ //7=>Cancelled
			$row['backgroundColor'] = "#B2BEB5"; //grey
		} else if( $appointment->status == 8 ){ //8=>Missed
			$row['backgroundColor'] = "#DC143C"; //Crimson
		} else if( $appointment->status == 9 ){ //9=>Pending Appointment With Payment Pending
			$row['backgroundColor'] = "#FF8C00"; //DarkOrange
		} else if( $appointment->status == 10 ){ //10=>Pending Appointment With Payment Success
			$row['backgroundColor'] = "#228B22"; //ForestGreen
		} else if( $appointment->status == 11 ){ //11=>Pending Appointment With Payment Fail
			$row['backgroundColor'] = "#B22222"; //FireBrick
		}

        $row['full_name'] = $addd->first_name.' '.$addd->last_name;
        $row['timeslot_full'] = $appointment->timeslot_full;

        if( isset($appointment->noe_id) && $appointment->noe_id != "" ) {
            $NatureOfEnquiry = \App\Models\NatureOfEnquiry::select('title')->where('id', $appointment->noe_id)->first();
            $row['noe_id'] = $appointment->noe_id;
            if( !empty($NatureOfEnquiry) ){
                $row['nature_of_enquiry'] = $NatureOfEnquiry->title;
            } else {
                $row['nature_of_enquiry'] = "";
            }
        }

        if( isset($appointment->service_id) && $appointment->service_id != "" ) {
            $BookService = \App\Models\BookService::select('title','price','duration')->where('id', $appointment->service_id)->first();
            $row['service_id'] = $appointment->service_id;
            if( !empty($BookService) ){
                $row['service'] = $BookService->title.' - '."Paid";
            } else {
                $row['service'] = "";
            }
        }

        // Get status label based on appointment status (matching appointment listing page)
        $status_label = "";
        switch($appointment->status) {
            case 0:
                $status_label = "Pending";
                break;
            case 1:
                $status_label = "Approved";
                break;
            case 2:
                $status_label = "Completed";
                break;
            case 3:
                $status_label = "Rejected";
                break;
            case 4:
                $status_label = "N/P";
                break;
            case 5:
                $status_label = "In Progress";
                break;
            case 6:
                $status_label = "Did Not Come";
                break;
            case 7:
                $status_label = "Cancelled";
                break;
            case 8:
                $status_label = "Missed";
                break;
            case 9:
                $status_label = "Payment Pending";
                break;
            case 10:
                $status_label = "Payment Success";
                break;
            case 11:
                $status_label = "Payment Failed";
                break;
            default:
                $status_label = "Unknown";
                break;
        }

        // Build appointment_other with status information
        if( isset($appointment->service_id) && $appointment->service_id == 1 ) { //Paid
            $service_type = "Paid";
            // Show status instead of just service type
            if(isset($appointment->appointment_details) && $appointment->appointment_details != "") {
                $row['appointment_other'] = $appointment->appointment_details.' - '.$status_label;
            } else {
                $row['appointment_other'] = $status_label.' ('.$service_type.')';
            }
        } else {
            // For non-paid appointments, still show status
            if(isset($appointment->appointment_details) && $appointment->appointment_details != "") {
                $row['appointment_other'] = $appointment->appointment_details.' - '.$status_label;
            } else {
                $row['appointment_other'] = $status_label;
            }
        }
        $sched_res[$appointment->id] = $row;
    }
}
//dd($sched_res);
?>
@endsection
@section('scripts')
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<!-- FullCalendar v6 loaded via Vite -->
@vite(['resources/js/admin-calendar-v6.js'])
<script>
jQuery(document).ready(function($){
    // Ensure modal is hidden on page load
    $('#event-details-modal').removeClass('show').css('display', 'none');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    
    $('.followup_date').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });

    $(document).delegate('.editfollowupdate', 'click', function(){
        $('.if_edit_followup').show();
        $('.editfollowupdate').hide();
        
        // Scroll to the edit form
        setTimeout(function() {
            var editForm = $('.if_edit_followup');
            if (editForm.length) {
                editForm[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }, 100);
    });
    $(document).delegate('.cancelfollowupdate', 'click', function(){
        $('.if_edit_followup').hide();
        $('.editfollowupdate').show();
    });

	$(document).delegate('#updateappointmentstatus', 'change', function(){
        var v = $('#updateappointmentstatus option:selected').val();
		var aid = $('#appid').val();
		window.location.href = '{{URL::to('/admin/updateappointmentstatus')}}/'+v+'/'+aid;
    });

    // Enhanced modal close functionality
    $(document).on('click', '[data-dismiss="modal"], .close', function() {
        closeModal();
    });
    
    $(document).on('click', '.modal-backdrop', function() {
        closeModal();
    });
    
    $(document).on('keyup', function(e) {
        if (e.keyCode === 27) { // ESC key
            closeModal();
        }
    });
    
    // Make closeModal globally accessible
    window.closeModal = function() {
        var modal = $('#event-details-modal');
        try {
            if (typeof $.fn.modal !== 'undefined') {
                modal.modal('hide');
            } else {
                // Manual close
                modal.removeClass('show').css('display', 'none');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            }
        } catch (error) {
            console.error('Error closing modal:', error);
            // Force close
            modal.removeClass('show').css('display', 'none');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        }
    };

});

function decodeHTMLEntities(str) {
    // Create a temporary textarea element to decode entities
    var textarea = document.createElement('textarea');

    // Decode once
    textarea.innerHTML = str;
    var decodedStr = textarea.value;

    // Decode again if the decoded string still contains entities (for double encoding)
    textarea.innerHTML = decodedStr;
    return textarea.value;
}

// FullCalendar v6 - Prepare events data (no jQuery needed)
var events = [];
var scheds = <?= json_encode($sched_res) ?>;
if (scheds && typeof scheds === 'object') {
    Object.keys(scheds).forEach(function(k) {
        var row = scheds[k];
        events.push({ 
            id: row.id, 
            title: row.full_name + '\n' + row.appointment_other, 
            start: row.start, 
            end: row.end, 
            backgroundColor: row.backgroundColor 
        });
    });
}

// Make data available globally for calendar initialization
window.calendarEvents = events;
window.calendarScheds = scheds;

// OLD v3 CODE REMOVED - Now using FullCalendar v6 via admin-calendar-v6.js
// The calendar is initialized in admin-calendar-v6.js which loads via Vite

// Listen for FullCalendar v6 event clicks (from admin-calendar-v6.js)
document.addEventListener('fullcalendar-event-click', function(e) {
    var details = document.getElementById('event-details-modal');
    var id = e.detail.id;
    
    if (!details || !scheds || !scheds[id]) {
        return;
    }
    
    if (scheds[id].name && scheds[id].service) {
        // Clear any previous selections
        var csel1='', csel2='', csel3='', csel4='', csel5='', csel6='', csel7='', csel8='', csel9='', csel10='', csel11='';
        
        // Update modal content (using jQuery for now, will migrate later)
        var $details = $(details);
        $details.find('#service').text(scheds[id].service || 'N/A');
        $details.find('#nature_of_enquiry').text(scheds[id].nature_of_enquiry || 'N/A');
        $details.find('#timeslot_full').text(scheds[id].timeslot_full || 'N/A');
        $details.find('#appointment_id').val(id);
        
        $details.find('#followup_date').val(scheds[id].appointdate || '');
        $details.find('#followup_time').val(scheds[id].appointtime || '');
        
        $details.find('#start').html(scheds[id].start+' <a href="javascript:;" class="editfollowupdate"><i class="fa fa-edit"></i> Edit</a>');
        
        // Ensure edit form is hidden initially
        $details.find('.if_edit_followup').hide();
        $details.find('.editfollowupdate').show();
        
        // Set selected status
        if(scheds[id].status == '1'){ csel1 = 'selected'; }
        else if(scheds[id].status == '2'){ csel2 = 'selected'; }
        else if(scheds[id].status == '3'){ csel3 = 'selected'; }
        else if(scheds[id].status == '4'){ csel4 = 'selected'; }
        else if(scheds[id].status == '5'){ csel5 = 'selected'; }
        else if(scheds[id].status == '6'){ csel6 = 'selected'; }
        else if(scheds[id].status == '7'){ csel7 = 'selected'; }
        else if(scheds[id].status == '8'){ csel8 = 'selected'; }
        else if(scheds[id].status == '9'){ csel9 = 'selected'; }
        else if(scheds[id].status == '10'){ csel10 = 'selected'; }
        else if(scheds[id].status == '11'){ csel11 = 'selected'; }
        
        // Build client info and status dropdown
        var clientName = atob(scheds[id].name);
        
        $details.find('.clienturl').html('<div class="row"><div class="col-md-6"><strong>'+clientName+' '+scheds[id].stitle+'</strong></div><div class="col-md-6" style="text-align: right;"><select class="form-control form-control-sm" id="updateappointmentstatus"><option value="0">Pending</option><option value="1" '+csel1+'>Approve</option><option value="2" '+csel2+'>Completed</option><option value="3" '+csel3+'>Rejected</option><option value="4" '+csel4+'>N/P</option><option value="5" '+csel5+'>Inrogress</option><option value="6" '+csel6+'>Did Not Come</option><option value="7" '+csel7+'>Cancelled</option><option value="8" '+csel8+'>Missed</option><option value="9" '+csel9+'>Pending With payment Pending</option><option value="10" '+csel10+'>Pending With payment Success</option><option value="11" '+csel11+'>Pending With payment Failed</option></select><input type="hidden" id="appid" value="'+id+'"></div></div>');
        
        // Enhanced modal display with multiple fallbacks
        try {
            // First ensure modal is properly positioned
            $details.css({
                'position': 'fixed',
                'z-index': '1050',
                'top': '0',
                'left': '0',
                'width': '100%',
                'height': '100%'
            });
            
            // Try Bootstrap modal
            if (typeof $.fn.modal !== 'undefined') {
                $details.modal({
                    backdrop: 'static',
                    keyboard: true,
                    show: true
                });
            } else {
                // Manual modal display
                $details.addClass('show').css('display', 'block');
                $('body').addClass('modal-open');
                
                // Add backdrop if it doesn't exist
                if ($('.modal-backdrop').length === 0) {
                    $('body').append('<div class="modal-backdrop fade show"></div>');
                }
            }
        } catch (error) {
            console.error('Error showing modal:', error);
            // Force manual display
            $details.css({
                'display': 'block',
                'position': 'fixed',
                'z-index': '1050',
                'top': '0',
                'left': '0',
                'width': '100%',
                'height': '100%'
            });
            $('body').addClass('modal-open');
            if ($('.modal-backdrop').length === 0) {
                $('body').append('<div class="modal-backdrop fade show"></div>');
            }
        }
    }
});
</script>
<style>
/* Align event text to the left in day and week views */
.fc-time-grid-event .fc-content {
    text-align: left;
    padding-left: 5px; /* Optional padding */
}
</style>
<div class="modal fade" tabindex="-1" id="event-details-modal" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Appointment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal(); return false;">
                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="container-fluid">
                        <div class="clienturl"></div>
                        <dl>
                             <dt class="text-muted">Nature of Enquiry</dt>
                             <dd id="nature_of_enquiry" class="fw-bold fs-4"></dd>

                             <dt class="text-muted">Services</dt>
                             <dd id="service" class="fw-bold fs-4"></dd>

                            <!--<dt class="text-muted">Reference if any</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>-->

                            <!--<dt class="text-muted">Details Of Enquiry</dt>
                            <dd id="description" class="fw-bold fs-4"></dd>-->

                            <dt class="text-muted">Date</dt>
                            <dd id="start" class=""></dd>

                            <dt class="text-muted"> Booked Slot</dt>
                            <dd id="timeslot_full" class=""></dd>

                        </dl>
                         <div class="if_edit_followup" style="display:none">
							<form method="post" action="{{URL::to('/admin/updatefollowupschedule')}}" name="updatefollowupschedule" id="updatefollowupschedule" autocomplete="off" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name="appointment_id" id="appointment_id">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Date</label>
											<input type="text" name="followup_date" id="followup_date" class="form-control  followup_date">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Time</label>
											<input type="time" name="followup_time" id="followup_time" class="form-control">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="edit_description" id="edit_description"></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<button type="button" class="btn btn-primary" onclick="customValidate('updatefollowupschedule')">Save</button>
										<a href="javascript:;" class="btn btn-info cancelfollowupdate" >Cancel</a>
									</div>
								</div>
						</form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

	<script>
    document.getElementById('followup_time').addEventListener('input', function () {
        let time = this.value.split(':');
        let hours = parseInt(time[0]);
        let minutes = parseInt(time[1]);

        // Round the minutes to the nearest 15-minute increment
        let roundedMinutes = Math.round(minutes / 15) * 15;

        // Handle the edge case where rounding exceeds 60 minutes
        if (roundedMinutes === 60) {
            roundedMinutes = 0;
            hours = (hours + 1) % 24;  // Wrap around the hours if necessary
        }

        // Format the hours and minutes with leading zeros if needed
        this.value = String(hours).padStart(2, '0') + ':' + String(roundedMinutes).padStart(2, '0');
    });
    </script>
@endsection
