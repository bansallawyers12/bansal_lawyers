@extends('layouts.admin')
@section('title', 'Show Appointment')

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="col-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
							<div class="card-header">
								<h4>Show Appointment</h4>
								<div class="card-header-action">
									<a href="{{route('appointments.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
								</div>
							</div>
					</div>
						<div id="accordion">
							<div class="accordion">

								<div class="accordion-body collapse show" id="contact_details" data-parent="#accordion">
									<div class="row">

                                        <div class="col-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="client">Client name</label>
												<div class="cus_field_input">
													<input name="client_id" type="text" value="@$appointment->clients->first_name.' '.@$appointment->clients->last_name" class="form-control" autocomplete="off">
												</div>
											</div>
										</div>

										<div class="col-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="user">Added By</label>
												{{--@if($appointment->user)--}}
												{{--Form::text('user_id', @$appointment->user->first_name.' '.@$appointment->user->last_name, array('class' => 'form-control', 'autocomplete'=>'off','placeholder'=>'Enter User Name','readonly' ))--}}
												{{--@else--}}
												{{--Form::text('user_id', 'N/A', array('class' => 'form-control', 'autocomplete'=>'off','placeholder'=>'Enter User Name','readonly' ))--}}
												{{--@endif--}}

                                                @if($appointment->user)
                                                <input name="user_id" type="text" value="@$appointment->user->first_name.' '.$appointment->user->last_name" class="form-control" autocomplete="off" placeholder="Enter User Name">
												@else
                                                <input name="user_id" type="text" value="N/A" class="form-control" autocomplete="off" placeholder="Enter User Name">
												@endif
											</div>
										</div>

									</div>

                                    <div class="row">
										<!--<div class="col-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="timezone">Timezone </label>
												{{--Form::text('timezone', @$appointment->timezone, array('class' => 'form-control', 'autocomplete'=>'off','readonly'))--}}
											</div>
										</div>-->
										<div class="col-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="date">Date</label>
												<div class="cus_field_input">
													{{ Form::text('date', date('d/m/Y', strtotime(@$appointment->date)) , array('class' => 'form-control', 'data-valid'=>'', 'autocomplete'=>'off','readonly' )) }}
												</div>
											</div>
										</div>

                                        <div class="col-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="time">Time </label>
												<input name="time" type="text" value="@$appointment->timeslot_full" class="form-control" autocomplete="off">
											</div>
										</div>
									</div>

                                    <!--<div class="row">
										<div class="col-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="time">Time </label>
												{{--Form::text('time', @$appointment->time, array('class' => 'form-control', 'autocomplete'=>'off','readonly' ))--}}
											</div>
										</div>
										<div class="col-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="title">Title</label>
												<div class="cus_field_input">
													{{--Form::text('title', @$appointment->title, array('class' => 'form-control', 'autocomplete'=>'off','readonly' ))--}}
												</div>
											</div>
										</div>
									</div>-->

									<!--<div class="row">
										<div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="invites">Full name</label>
                                                <div class="cus_field_input">
                                                    {{--Form::text('full_name', @$appointment->full_name, array('class' => 'form-control', 'autocomplete'=>'off','readonly'))--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="status">Email </label>
                                                {{--Form::text('email', @$appointment->email, array('class' => 'form-control', 'autocomplete'=>'off','readonly'))--}}
                                            </div>
                                        </div>
									</div>-->

									<div class="row">
										<div class="col-12 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="invites">Nature of Enquiry</label>
													<div class="cus_field_input">
														<input name="nature_of_enquiry" type="text" value="@$appointment->natureOfEnquiry->title" class="form-control" autocomplete="off">
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="status">Service </label>
													<input name="service" type="text" value="@$appointment->service->title" class="form-control" autocomplete="off">
												</div>
											</div>
										</div>
									</div>

                                    <div class="row">
										<div class="col-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="description">Description </label>
												<textarea name="description" class="form-control" autocomplete="off">off</textarea>
											</div>
										</div>

                                        <div class="col-12 col-md-6 col-lg-6">
											<div class="form-group">
												<label for="status">Status <span class="span_req">*</span></label>
                                                <select class="form-control" name="status" data-valid="required" disabled>
                                                    <option value="0" <?php echo ($appointment->status == '0') ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="1" <?php echo ($appointment->status == '1') ? 'selected' : ''; ?>>Approved</option>
                                                    <option value="2" <?php echo ($appointment->status == '2') ? 'selected' : ''; ?>>Completed</option>
                                                    <option value="3" <?php echo ($appointment->status == '3') ? 'selected' : ''; ?>>Rejected</option>
                                                    <option value="4" <?php echo ($appointment->status == '4') ? 'selected' : ''; ?>>N/P</option>
                                                    <option value="5" <?php echo ($appointment->status == '5') ? 'selected' : ''; ?>>Inrogress</option>
                                                    <option value="6" <?php echo ($appointment->status == '6') ? 'selected' : ''; ?>>Did Not Come</option>
                                                    <option value="7" <?php echo ($appointment->status == '7') ? 'selected' : ''; ?>>Cancelled</option>
                                                    <option value="8" <?php echo ($appointment->status == '8') ? 'selected' : ''; ?>>Missed</option>
                                                    <option value="9" <?php echo ($appointment->status == '9') ? 'selected' : ''; ?>>Pending With Payment Pending</option>
                                                    <option value="10" <?php echo ($appointment->status == '10') ? 'selected' : ''; ?>>Pending With Payment Success</option>
                                                    <option value="11" <?php echo ($appointment->status == '11') ? 'selected' : ''; ?>>Pending With Payment Failed</option>
                                                </select>
                                            </div>
										</div>
									</div>

                                    <div class="row">
                                      	<div class="col-12 col-md-6 col-lg-6">
											<div class="form-group">
                                                <label for="appointment_details">Appointment details <span class="span_req">*</span></label>
                                                <select data-valid="required" class="form-control" name="appointment_details" disabled>
                                                    <option value="">Select</option>
                                                    <option value="In-person" <?php echo ($appointment->appointment_details == 'In-person') ? 'selected' : ''; ?>>In-person</option>
                                                    <option value="Phone" <?php echo ($appointment->appointment_details == 'Phone') ? 'selected' : ''; ?>> Phone</option>
                                                    <option value="Zoom / Google Meeting" <?php echo ($appointment->appointment_details == 'Zoom / Google Meeting') ? 'selected' : ''; ?>>Zoom / Google Meeting</option>
                                                </select>

                                                @if ($errors->has('appointment_details'))
                                                    <span class="custom-error" role="alert">
                                                        <strong>{{ @$errors->first('appointment_details') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
										<!--<div class="col-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="invites">Invites</label>
                                                <div class="cus_field_input">
                                                    {{--Form::text('invites', @$appointment->invites, array('class' => 'form-control', 'autocomplete'=>'off','readonly'))--}}
                                                </div>
                                            </div>
                                        </div>-->


									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>
</div>
@endsection
