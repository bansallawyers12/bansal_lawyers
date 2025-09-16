
<?php $__env->startSection('title', 'Appointments'); ?>

<?php $__env->startSection('content'); ?>
<style>
.fc-event-container .fc-h-event{cursor:pointer;}
</style>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="server-error">
				<?php echo $__env->make('../Elements/flash-message', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
			</div>
			<div class="custom-error-msg">
			</div>
			<div class="row">
				<div class="col-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-header">
						    <h4><?php echo e($type); ?> Calendar</h4>
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

// Only paid appointments (service_id = 1) for Ajay
$appointments = \App\Models\Appointment::where(function ($query) {
    $query->where(function ($q) {
        $q->whereIn('noe_id', [1, 2, 3, 4, 5, 6, 7])
          ->where('service_id', 1);
    });
})->get();
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

        if( isset($appointment->service_id) && $appointment->service_id == 1 ) { //Paid
            $service_type = "Paid";
            $row['appointment_other'] = $appointment->appointment_details.' - '.$service_type;
        }
        $sched_res[$appointment->id] = $row;
    }
}
//dd($sched_res);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/bootstrap-datepicker.js')); ?>"></script>
<script>
jQuery(document).ready(function($){
    $('.followup_date').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });

    $(document).delegate('.editfollowupdate', 'click', function(){
        $('.if_edit_followup').show();
        $('.editfollowupdate').hide();
    });
    $(document).delegate('.cancelfollowupdate', 'click', function(){
        $('.if_edit_followup').hide();
        $('.editfollowupdate').show();
    });

	$(document).delegate('#updateappointmentstatus', 'change', function(){
        var v = $('#updateappointmentstatus option:selected').val();
		var aid = $('#appid').val();
		window.location.href = '<?php echo e(URL::to('/admin/updateappointmentstatus')); ?>/'+v+'/'+aid;
    });

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

var events = [];
 var scheds = $.parseJSON('<?= json_encode($sched_res) ?>');
 if (!!scheds) {
        Object.keys(scheds).map(k => {
            var row = scheds[k]
            //events.push({ id: row.id, title: row.full_name, start: row.start, end: row.end, backgroundColor: row.backgroundColor });
            events.push({ id: row.id, title: row.full_name+ '\n' + row.appointment_other, start: row.start, end: row.end, backgroundColor: row.backgroundColor });
    	});
    }
var today = new Date();
year = today.getFullYear();
month = today.getMonth();
day = today.getDate();
var calendar = $("#myEvent").fullCalendar({
  height: "auto",
  defaultView: "month",
  editable: false,
  selectable: true,
  displayEventTime: true,
  header: {
    left: "prev,next today",
    center: "title",
    right: "month,agendaWeek,agendaDay,listMonth",
  },
  events: events,
  timeFormat: 'h:mm A',
  timezone: 'Australia/Melbourne',
  // Remove timezone conversion to prevent date/time shifting
  eventClick: function(info) {
		console.log(info);
            var details = $('#event-details-modal');
            var id = info.id;

            if (!!scheds[id]) {
                //details.find('#title').text(scheds[id].title);
              	details.find('#service').text(scheds[id].service);
            	details.find('#nature_of_enquiry').text(scheds[id].nature_of_enquiry);
               	details.find('#timeslot_full').text(scheds[id].timeslot_full);
				details.find('#appointment_id').val(id);

                details.find('#followup_date').val(scheds[id].appointdate);
                details.find('#followup_time').val(scheds[id].appointtime);

                //details.find('#description').text(scheds[id].description);
                //details.find('#edit_description').val(scheds[id].description);

                //details.find('#description').text(decodeHTMLEntities(scheds[id].description));
            	//details.find('#edit_description').val(decodeHTMLEntities(scheds[id].description));

                details.find('#start').html(scheds[id].start+' <a href="javascript:;" class="editfollowupdate"><i class="fa fa-edit"></i> Edit</a>');
                if (scheds[id].url) {
					//window.open(scheds[id].url, "_blank");
					//return false;
				}
				var csel = '';
                if(scheds[id].status == '1'){
                    var csel1 = 'selected';
                } else if(scheds[id].status == '2'){
                    var csel2 = 'selected';
                } else if(scheds[id].status == '3'){
                    var csel3 = 'selected';
                } else if(scheds[id].status == '4'){
                    var csel4 = 'selected';
                } else if(scheds[id].status == '5'){
                    var csel5 = 'selected';
                } else if(scheds[id].status == '6'){
                    var csel6 = 'selected';
                } else if(scheds[id].status == '7'){
                    var csel7 = 'selected';
                } else if(scheds[id].status == '8'){
                    var csel8 = 'selected';
                } else if(scheds[id].status == '9'){
                    var csel9 = 'selected';
                } else if(scheds[id].status == '10'){
                    var csel10 = 'selected';
                } else if(scheds[id].status == '11'){
                    var csel11 = 'selected';
                }
            	//details.find('.clienturl').html('<div class="row"><div class="col-md-6"><a class="btn btn-outline-primary btn-sm" href="'+scheds[id].url+'">'+atob(scheds[id].name)+' '+scheds[id].stitle+'</a> </div><div class="col-md-6" style="text-align: right;"><select class="" id="updateappointmentstatus"><option value="0">In Progress</option><option value="1" '+csel+'>Completed</option></select><input type="hidden" id="appid" value="'+id+'"></div>');
           		 details.find('.clienturl').html('<div class="row"><div class="col-md-6">'+atob(scheds[id].name)+' '+scheds[id].stitle+'</div><div class="col-md-6" style="text-align: right;"><select class="" id="updateappointmentstatus"><option value="0">Pending</option><option value="1" '+csel1+'>Approve</option><option value="2" '+csel2+'>Completed</option><option value="3" '+csel3+'>Rejected</option><option value="4" '+csel4+'>N/P</option><option value="5" '+csel5+'>Inrogress</option><option value="6" '+csel6+'>Did Not Come</option><option value="7" '+csel7+'>Cancelled</option><option value="8" '+csel8+'>Missed</option><option value="9" '+csel9+'>Pending With payment Pending</option><option value="10" '+csel10+'>Pending With payment Success</option><option value="11" '+csel11+'>Pending With payment Failed</option></select><input type="hidden" id="appid" value="'+id+'"></div>');
            	details.modal('show');
            	//window.location.href = scheds[id].url;
            } else {
                alert("Event is undefined");
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
<div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                </div>
                <div class="modal-body rounded-0">

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
							<form method="post" action="<?php echo e(URL::to('/admin/updatefollowupschedule')); ?>" name="updatefollowupschedule" id="updatefollowupschedule" autocomplete="off" enctype="multipart/form-data">
								<?php echo csrf_field(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/appointments/calender.blade.php ENDPATH**/ ?>