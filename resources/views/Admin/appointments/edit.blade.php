@extends('layouts.admin')
@section('title', 'Edit Appointment')

@section('content')
<style>
/* Modern Appointment Edit Form Design */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --danger-color: #ef4444;
    --appointment-color: #10b981;
    --appointment-secondary: #059669;
    --text-dark: #1e293b;
    --text-light: #64748b;
    --bg-light: #f8fafc;
    --white: #ffffff;
    --border-color: #e2e8f0;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --border-radius: 12px;
    --border-radius-sm: 8px;
    --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.modern-form-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.modern-form-card {
    background: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    border: 1px solid var(--border-color);
    overflow: hidden;
    max-width: 1000px;
    margin: 0 auto;
}

.modern-form-header {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.modern-form-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.modern-form-title {
    color: var(--white);
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.modern-form-title i {
    font-size: 1.5rem;
    opacity: 0.9;
}

.modern-form-actions {
    position: relative;
    z-index: 2;
    margin-top: 1.5rem;
    display: flex;
    gap: 1rem;
}

.modern-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.modern-btn-secondary {
    background: rgba(255, 255, 255, 0.15);
    color: var(--white);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.modern-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.25);
    color: var(--white);
    text-decoration: none;
    transform: translateY(-2px);
}

.modern-btn-primary {
    background: linear-gradient(135deg, var(--accent-color) 0%, #FF8E53 100%);
    color: var(--white);
}

.modern-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
    color: var(--white);
    text-decoration: none;
}

.modern-form-body {
    padding: 2.5rem;
}

.modern-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.modern-form-group {
    margin-bottom: 2rem;
}

.modern-form-group.full-width {
    grid-column: 1 / -1;
}

.modern-form-label {
    display: block;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.modern-form-label .required {
    color: var(--danger-color);
    margin-left: 0.25rem;
}

.modern-form-input {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    transition: var(--transition);
    background: var(--white);
    color: var(--text-dark);
}

.modern-form-input:focus {
    outline: none;
    border-color: var(--success-color);
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.modern-form-input::placeholder {
    color: var(--text-light);
}

.modern-form-input:read-only {
    background: var(--bg-light);
    color: var(--text-light);
    cursor: not-allowed;
}

.modern-select {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    transition: var(--transition);
    background: var(--white);
    color: var(--text-dark);
    cursor: pointer;
}

.modern-select:focus {
    outline: none;
    border-color: var(--success-color);
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.modern-error {
    color: var(--danger-color);
    font-size: 0.75rem;
    margin-top: 0.5rem;
    display: block;
}

.modern-form-footer {
    background: var(--bg-light);
    padding: 2rem;
    border-top: 1px solid var(--border-color);
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

.modern-help-text {
    font-size: 0.75rem;
    color: var(--text-light);
    margin-top: 0.5rem;
}

.modern-section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--border-color);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modern-info-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, var(--appointment-color), var(--appointment-secondary));
    color: var(--white);
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
    .modern-form-container {
        padding: 1rem;
    }
    
    .modern-form-header {
        padding: 1.5rem;
    }
    
    .modern-form-body {
        padding: 1.5rem;
    }
    
    .modern-form-footer {
        padding: 1.5rem;
        flex-direction: column;
    }
    
    .modern-form-actions {
        flex-direction: column;
    }
    
    .modern-form-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}
</style>

<!-- Main Content -->
<div class="main-content modern-form-container">
	<section class="section">
		<div class="section-body">
			<div class="server-error">
				@include('Elements.flash-message')
			</div>
			<div class="custom-error-msg">
			</div>
			
			<div class="container-fluid">
				<div class="row justify-content-center">
					<div class="col-12">
						<div class="modern-form-card">
							<div class="modern-form-header">
								<h3 class="modern-form-title">
									<i class="fas fa-edit"></i>
									Edit Appointment
								</h3>
								<div class="modern-form-actions">
									<a href="{{route('appointments.index')}}" class="modern-btn modern-btn-secondary">
										<i class="fas fa-arrow-left"></i>
										Back to Appointments
									</a>
								</div>
							</div>
							
							<form action="{{ route('appointments.update',$appointment->id) }}" method="POST" id="edit-appointment-form">
								@csrf
								@method('PUT')
								<input type="hidden" name="id" value="{{ $appointment->id }}">
								<input type="hidden" name="route" value="{{ url()->previous() }}">
								<input type="hidden" name="client_id" value="{{ $appointment->client_id }}">
								<input type="hidden" name="user_id" value="{{ $appointment->user_id }}">
								<input type="hidden" name="noe_id_hidden" value="{{ $appointment->noe_id }}">
								
								<div class="modern-form-body">
									<div class="modern-info-badge">
										<i class="fas fa-info-circle"></i>
										Editing Appointment ID: #{{ $appointment->id }}
									</div>

									<!-- Client Information Section -->
									<div class="modern-section-title">
										<i class="fas fa-user"></i>
										Client Information
									</div>
									
									<div class="modern-form-grid">
										<div class="modern-form-group">
											<label for="client_name" class="modern-form-label">Client Name</label>
											<input name="client_name" type="text" class="modern-form-input" value="{{ $appointment->clients->first_name }} {{ $appointment->clients->last_name }}" readonly>
											<div class="modern-help-text">
												Client information (read-only)
											</div>
										</div>

										<div class="modern-form-group">
											<label for="added_by" class="modern-form-label">Added By</label>
											<input name="added_by" type="text" class="modern-form-input" value="@if($appointment->user){{ $appointment->user->first_name }} {{ $appointment->user->last_name }}@else N/A @endif" readonly>
											<div class="modern-help-text">
												User who created this appointment (read-only)
											</div>
										</div>
									</div>

									<!-- Appointment Details Section -->
									<div class="modern-section-title">
										<i class="fas fa-calendar-alt"></i>
										Appointment Schedule
									</div>

									<div class="modern-form-grid">
										<div class="modern-form-group">
											<label for="date" class="modern-form-label">
												Date
												<span class="required">*</span>
											</label>
											@php
												$dateValue = '';
												if(isset($appointment->date) && $appointment->date != "") {
													if (strpos($appointment->date, '-') !== false && strlen($appointment->date) == 10) {
														$dateArr = explode('-', $appointment->date);
														$dateValue = $dateArr[2].'/'.$dateArr[1].'/'.$dateArr[0];
													} else {
														$dateValue = date('d/m/Y', strtotime($appointment->date));
													}
												}
											@endphp
											<input name="date" type="text" class="modern-form-input date" data-valid="required" autocomplete="off" placeholder="Select date" value="{{ old('date', $dateValue) }}">
											@if ($errors->has('date'))
												<span class="modern-error">
													{{ $errors->first('date') }}
												</span>
											@endif
											<div class="modern-help-text">
												Select the appointment date
											</div>
										</div>

										<div class="modern-form-group">
											<label for="time" class="modern-form-label">
												Time
												<span class="required">*</span>
											</label>
											<input name="time" type="time" class="modern-form-input" id="followup_time" data-valid="required" autocomplete="off" placeholder="Select time" value="{{ old('time', $appointment->time) }}">
											@if ($errors->has('time'))
												<span class="modern-error">
													{{ $errors->first('time') }}
												</span>
											@endif
											<div class="modern-help-text">
												Select the appointment time (15-minute intervals)
											</div>
										</div>

										<div class="modern-form-group">
											<label for="noe_id" class="modern-form-label">
												Nature of Enquiry
												<span class="required">*</span>
											</label>
											<select class="modern-select" name="noe_id" data-valid="required">
												<option value="">Select Nature of Enquiry</option>
												@foreach(\App\Models\NatureOfEnquiry::all() as $noe)
													<option value="{{ $noe->id }}" {{ old('noe_id', $appointment->noe_id) == $noe->id ? 'selected' : '' }}>
														{{ $noe->title }}
													</option>
												@endforeach
											</select>
											@if ($errors->has('noe_id'))
												<span class="modern-error">
													{{ $errors->first('noe_id') }}
												</span>
											@endif
											<div class="modern-help-text">
												Select the nature of enquiry for this appointment
											</div>
										</div>

										<div class="modern-form-group">
											<label for="service_display" class="modern-form-label">Service</label>
											<input name="service_display" type="text" class="modern-form-input" value="@if($appointment->service){{ $appointment->service->title }}@else N/A @endif" readonly>
											<div class="modern-help-text">
												Service information (read-only)
											</div>
										</div>

										<div class="modern-form-group">
											<label for="status" class="modern-form-label">
												Status
												<span class="required">*</span>
											</label>
											<select class="modern-select" name="status" data-valid="required">
												<option value="0" {{ old('status', $appointment->status) == '0' ? 'selected' : '' }}>Pending</option>
												<option value="1" {{ old('status', $appointment->status) == '1' ? 'selected' : '' }}>Approved</option>
												<option value="2" {{ old('status', $appointment->status) == '2' ? 'selected' : '' }}>Completed</option>
												<option value="3" {{ old('status', $appointment->status) == '3' ? 'selected' : '' }}>Rejected</option>
												<option value="4" {{ old('status', $appointment->status) == '4' ? 'selected' : '' }}>N/P</option>
												<option value="5" {{ old('status', $appointment->status) == '5' ? 'selected' : '' }}>In Progress</option>
												<option value="6" {{ old('status', $appointment->status) == '6' ? 'selected' : '' }}>Did Not Come</option>
												<option value="7" {{ old('status', $appointment->status) == '7' ? 'selected' : '' }}>Cancelled</option>
												<option value="8" {{ old('status', $appointment->status) == '8' ? 'selected' : '' }}>Missed</option>
												<option value="9" {{ old('status', $appointment->status) == '9' ? 'selected' : '' }}>Pending With Payment Pending</option>
												<option value="10" {{ old('status', $appointment->status) == '10' ? 'selected' : '' }}>Pending With Payment Success</option>
												<option value="11" {{ old('status', $appointment->status) == '11' ? 'selected' : '' }}>Pending With Payment Failed</option>
											</select>
											@if ($errors->has('status'))
												<span class="modern-error">
													{{ $errors->first('status') }}
												</span>
											@endif
											<div class="modern-help-text">
												Update the appointment status
											</div>
										</div>

										<div class="modern-form-group">
											<label for="appointment_details" class="modern-form-label">
												Appointment Type
												<span class="required">*</span>
											</label>
											<select class="modern-select" name="appointment_details" data-valid="required">
												<option value="">Select Appointment Type</option>
												<option value="In-person" {{ old('appointment_details', $appointment->appointment_details) == 'In-person' ? 'selected' : '' }}>In-person</option>
												<option value="Phone" {{ old('appointment_details', $appointment->appointment_details) == 'Phone' ? 'selected' : '' }}>Phone</option>
												<option value="Zoom / Google Meeting" {{ old('appointment_details', $appointment->appointment_details) == 'Zoom / Google Meeting' ? 'selected' : '' }}>Zoom / Google Meeting</option>
											</select>
											@if ($errors->has('appointment_details'))
												<span class="modern-error">
													{{ $errors->first('appointment_details') }}
												</span>
											@endif
											<div class="modern-help-text">
												Select how the appointment will be conducted
											</div>
										</div>

										<div class="modern-form-group full-width">
											<label for="description" class="modern-form-label">
												Description
												<span class="required">*</span>
											</label>
											<input name="description" type="text" class="modern-form-input" data-valid="required" autocomplete="off" placeholder="Enter appointment description" value="{{ old('description', $appointment->description) }}">
											@if ($errors->has('description'))
												<span class="modern-error">
													{{ $errors->first('description') }}
												</span>
											@endif
											<div class="modern-help-text">
												Brief description of the appointment purpose
											</div>
										</div>
									</div>
								</div>

								<div class="modern-form-footer">
									<a href="{{route('appointments.index')}}" class="modern-btn modern-btn-secondary">
										<i class="fas fa-times"></i>
										Cancel
									</a>
									<button type="submit" class="modern-btn modern-btn-primary">
										<i class="fas fa-save"></i>
										Update Appointment
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced form validation
    const form = document.getElementById('edit-appointment-form');
    const submitBtn = document.querySelector('.modern-btn-primary');
    
    if (form && submitBtn) {
        submitBtn.addEventListener('click', function(e) {
            this.classList.add('loading');
            const icon = this.querySelector('i');
            if (icon) {
                icon.className = 'fas fa-spinner fa-spin';
            }
        });
    }
});
</script>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize datepicker if jQuery is available
        if (typeof $ !== 'undefined' && $.fn.datepicker) {
            $('.date').datepicker({
                format: 'dd/mm/yyyy',
                daysOfWeekDisabled: [0, 6] // 0 = Sunday, 6 = Saturday
            });
        }
    });

    // Time input validation for 15-minute intervals
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