@extends('layouts.admin')
@section('title', 'Appointment Details')

@section('content')
<style>
/* Modern Appointment Details Design System */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --info-color: #06b6d4;
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

.modern-page-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.modern-card {
    background: var(--white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    border: 1px solid var(--border-color);
    overflow: hidden;
    transition: var(--transition);
    margin-bottom: 1.5rem;
}

.modern-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-2px);
}

.modern-main-card {
    margin-bottom: 0;
}

.modern-card-header {
    background: linear-gradient(135deg, var(--appointment-color) 0%, var(--appointment-secondary) 100%);
    padding: 1.5rem 2rem;
    border-bottom: none;
    position: relative;
    overflow: hidden;
}

.modern-card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.modern-card-title {
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

.modern-card-title i {
    font-size: 1.5rem;
    opacity: 0.9;
}

.modern-header-actions {
    position: relative;
    z-index: 2;
    margin-top: 1.5rem;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
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

.modern-card-body {
    padding: 2rem;
}

.modern-section-header {
    background: var(--bg-light);
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    font-weight: 600;
    color: var(--text-dark);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
}

.modern-info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.modern-info-item {
    margin-bottom: 1.5rem;
}

.modern-info-label {
    font-weight: 600;
    color: var(--text-light);
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.modern-info-value {
    color: var(--text-dark);
    font-size: 1rem;
    font-weight: 500;
    line-height: 1.5;
    background: var(--bg-light);
    padding: 0.875rem 1rem;
    border-radius: var(--border-radius-sm);
    border: 2px solid var(--border-color);
}

.modern-status-display {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.modern-status-display.pending {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
    color: var(--white);
}

.modern-status-display.approved {
    background: linear-gradient(135deg, var(--success-color), #059669);
    color: var(--white);
}

.modern-status-display.completed {
    background: linear-gradient(135deg, var(--info-color), #0891b2);
    color: var(--white);
}

.modern-status-display.rejected {
    background: linear-gradient(135deg, var(--danger-color), #dc2626);
    color: var(--white);
}

.modern-status-display.inprogress {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
}

.modern-status-display.cancelled {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: var(--white);
}

.modern-appointment-id {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--appointment-color), var(--appointment-secondary));
    color: var(--white);
    padding: 0.25rem 0.75rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
}

.modern-datetime-display {
    background: var(--bg-light);
    padding: 1rem;
    border-radius: var(--border-radius-sm);
    border-left: 4px solid var(--appointment-color);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.modern-datetime-icon {
    width: 3rem;
    height: 3rem;
    background: linear-gradient(135deg, var(--appointment-color), var(--appointment-secondary));
    color: var(--white);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.modern-datetime-info h4 {
    margin: 0 0 0.25rem 0;
    color: var(--text-dark);
    font-size: 1.25rem;
    font-weight: 700;
}

.modern-datetime-info p {
    margin: 0;
    color: var(--text-light);
    font-size: 0.875rem;
}

@media (max-width: 768px) {
    .modern-page-container {
        padding: 1rem 0;
    }
    
    .modern-card-header {
        padding: 1rem 1.5rem;
    }
    
    .modern-card-title {
        font-size: 1.5rem;
    }
    
    .modern-card-body {
        padding: 1.5rem;
    }
    
    .modern-info-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .modern-header-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .modern-btn {
        justify-content: center;
    }
    
    .modern-datetime-display {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
}

/* Animation for loading states */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.loading {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>

<!-- Main Content -->
<div class="main-content modern-page-container">
	<section class="section">
		<div class="section-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="modern-card modern-main-card">
							<div class="modern-card-header">
								<h4 class="modern-card-title">
									<i class="fas fa-calendar-check"></i>
									Appointment Details
								</h4>
								<div class="modern-header-actions">
									<a href="{{route('appointments.index')}}" class="modern-btn modern-btn-secondary">
										<i class="fas fa-arrow-left"></i>
										Back to Appointments
									</a>
									<a href="{{route('appointments.edit', $appointment->id)}}" class="modern-btn modern-btn-primary">
										<i class="fas fa-edit"></i>
										Edit Appointment
									</a>
								</div>
							</div>
							
							<div class="modern-card-body">
								<div class="row">
									<div class="col-lg-8">
										<!-- Client Information -->
										<div class="modern-card">
											<div class="modern-section-header">
												<i class="fas fa-user"></i>
												Client Information
											</div>
											<div class="modern-card-body">
												<div class="modern-info-grid">
													<div class="modern-info-item">
														<div class="modern-info-label">Client Name</div>
														<div class="modern-info-value">
															{{ $appointment->clients->first_name }} {{ $appointment->clients->last_name }}
														</div>
													</div>
													<div class="modern-info-item">
														<div class="modern-info-label">Client ID</div>
														<div class="modern-info-value">
															{{ $appointment->clients->client_id }}
														</div>
													</div>
													<div class="modern-info-item">
														<div class="modern-info-label">Added By</div>
														<div class="modern-info-value">
															@if($appointment->user)
																{{ $appointment->user->first_name }} {{ $appointment->user->last_name }}
															@else
																N/A
															@endif
														</div>
													</div>
													<div class="modern-info-item">
														<div class="modern-info-label">Appointment ID</div>
														<div class="modern-info-value">
															<span class="modern-appointment-id">#{{ $appointment->id }}</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<!-- Appointment Details -->
										<div class="modern-card">
											<div class="modern-section-header">
												<i class="fas fa-calendar-alt"></i>
												Appointment Details
											</div>
											<div class="modern-card-body">
												<!-- Date & Time Display -->
												<div class="modern-datetime-display">
													<div class="modern-datetime-icon">
														<i class="fas fa-clock"></i>
													</div>
													<div class="modern-datetime-info">
														<h4>{{ date('l, F j, Y', strtotime($appointment->date)) }}</h4>
														<p>{{ $appointment->time }} - {{ date('g:i A', strtotime($appointment->time)) }}</p>
													</div>
												</div>
												
												<div class="modern-info-grid" style="margin-top: 2rem;">
													<div class="modern-info-item">
														<div class="modern-info-label">Nature of Enquiry</div>
														<div class="modern-info-value">
															@if($appointment->natureOfEnquiry)
																{{ $appointment->natureOfEnquiry->title }}
															@else
																N/A
															@endif
														</div>
													</div>
													<div class="modern-info-item">
														<div class="modern-info-label">Service</div>
														<div class="modern-info-value">
															@if($appointment->service)
																{{ $appointment->service->title }}
															@else
																N/A
															@endif
														</div>
													</div>
													<div class="modern-info-item" style="grid-column: 1 / -1;">
														<div class="modern-info-label">Appointment Type</div>
														<div class="modern-info-value">
															{{ $appointment->appointment_details ?? 'Not specified' }}
														</div>
													</div>
													<div class="modern-info-item" style="grid-column: 1 / -1;">
														<div class="modern-info-label">Description</div>
														<div class="modern-info-value">
															{{ $appointment->description }}
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-lg-4">
										<!-- Status Information -->
										<div class="modern-card">
											<div class="modern-section-header">
												<i class="fas fa-info-circle"></i>
												Status Information
											</div>
											<div class="modern-card-body">
												<div class="modern-info-item">
													<div class="modern-info-label">Current Status</div>
													<div class="modern-info-value">
														@if($appointment->status == 0)
															<span class="modern-status-display pending">
																<i class="fas fa-clock"></i> Pending
															</span>
														@elseif($appointment->status == 1)
															<span class="modern-status-display approved">
																<i class="fas fa-check-circle"></i> Approved
															</span>
														@elseif($appointment->status == 2)
															<span class="modern-status-display completed">
																<i class="fas fa-check-double"></i> Completed
															</span>
														@elseif($appointment->status == 3)
															<span class="modern-status-display rejected">
																<i class="fas fa-times-circle"></i> Rejected
															</span>
														@elseif($appointment->status == 4)
															<span class="modern-status-display inprogress">
																<i class="fas fa-spinner"></i> N/P
															</span>
														@elseif($appointment->status == 5)
															<span class="modern-status-display inprogress">
																<i class="fas fa-play-circle"></i> In Progress
															</span>
														@elseif($appointment->status == 6)
															<span class="modern-status-display cancelled">
																<i class="fas fa-user-times"></i> Did Not Come
															</span>
														@elseif($appointment->status == 7)
															<span class="modern-status-display cancelled">
																<i class="fas fa-ban"></i> Cancelled
															</span>
														@elseif($appointment->status == 8)
															<span class="modern-status-display cancelled">
																<i class="fas fa-exclamation-triangle"></i> Missed
															</span>
														@elseif($appointment->status == 9)
															<span class="modern-status-display pending">
																<i class="fas fa-credit-card"></i> Payment Pending
															</span>
														@elseif($appointment->status == 10)
															<span class="modern-status-display approved">
																<i class="fas fa-check-circle"></i> Payment Success
															</span>
														@elseif($appointment->status == 11)
															<span class="modern-status-display rejected">
																<i class="fas fa-times-circle"></i> Payment Failed
															</span>
														@endif
													</div>
												</div>
												
												<div class="modern-info-item">
													<div class="modern-info-label">Created</div>
													<div class="modern-info-value">
														{{ $appointment->created_at->format('d/m/Y H:i:s') }}<br>
														<small class="text-muted">{{ $appointment->created_at->diffForHumans() }}</small>
													</div>
												</div>
												
												@if($appointment->updated_at != $appointment->created_at)
												<div class="modern-info-item">
													<div class="modern-info-label">Last Updated</div>
													<div class="modern-info-value">
														{{ $appointment->updated_at->format('d/m/Y H:i:s') }}<br>
														<small class="text-muted">{{ $appointment->updated_at->diffForHumans() }}</small>
													</div>
												</div>
												@endif
											</div>
										</div>
										
										<!-- Quick Actions -->
										<div class="modern-card">
											<div class="modern-section-header">
												<i class="fas fa-bolt"></i>
												Quick Actions
											</div>
											<div class="modern-card-body">
												<div class="d-grid gap-3">
													<a href="{{route('appointments.edit', $appointment->id)}}" class="modern-btn modern-btn-primary" style="width: 100%; justify-content: center;">
														<i class="fas fa-edit"></i>
														Edit Appointment
													</a>
													
													@if($appointment->clients && $appointment->clients->email)
													<a href="mailto:{{ $appointment->clients->email }}?subject=Regarding your appointment on {{ date('d/m/Y', strtotime($appointment->date)) }}" 
													   class="modern-btn modern-btn-info" style="width: 100%; justify-content: center;">
														<i class="fas fa-envelope"></i>
														Email Client
													</a>
													@endif
													
													<button type="button" class="modern-btn modern-btn-success" style="width: 100%; justify-content: center;" onclick="copyAppointmentDetails()">
														<i class="fas fa-copy"></i>
														Copy Details
													</button>
													
													<form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="width: 100%;">
														@csrf
														@method('DELETE')
														<button type="submit" class="modern-btn modern-btn-danger" style="width: 100%; justify-content: center;" onclick="return confirm('Are you sure you want to delete this appointment?')">
															<i class="fas fa-trash"></i>
															Delete Appointment
														</button>
													</form>
												</div>
											</div>
										</div>
										
										<!-- Appointment Summary -->
										<div class="modern-card">
											<div class="modern-section-header">
												<i class="fas fa-chart-bar"></i>
												Summary
											</div>
											<div class="modern-card-body">
												<div class="modern-summary-item">
													<span class="modern-summary-label">Appointment ID</span>
													<span class="modern-appointment-id">#{{ $appointment->id }}</span>
												</div>
												<div class="modern-summary-item">
													<span class="modern-summary-label">Description Length</span>
													<span class="modern-summary-value">{{ strlen($appointment->description) }} characters</span>
												</div>
												<div class="modern-summary-item">
													<span class="modern-summary-label">Word Count</span>
													<span class="modern-summary-value">{{ str_word_count($appointment->description) }} words</span>
												</div>
											</div>
										</div>
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

<style>
.modern-summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--border-color);
}

.modern-summary-item:last-child {
    border-bottom: none;
}

.modern-summary-label {
    font-weight: 600;
    color: var(--text-light);
    font-size: 0.875rem;
}

.modern-summary-value {
    font-weight: 700;
    color: var(--text-dark);
    font-size: 1rem;
}

.modern-btn-info {
    background: linear-gradient(135deg, var(--info-color) 0%, #0891b2 100%);
    color: var(--white);
}

.modern-btn-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(6, 182, 212, 0.3);
    color: var(--white);
    text-decoration: none;
}

.modern-btn-success {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    color: var(--white);
}

.modern-btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    color: var(--white);
    text-decoration: none;
}

.modern-btn-danger {
    background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
    color: var(--white);
}

.modern-btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
    color: var(--white);
    text-decoration: none;
}

.d-grid {
    display: grid;
}

.gap-3 {
    gap: 1rem;
}
</style>

<script>
// Enhanced appointment details functionality
function copyAppointmentDetails() {
    let appointmentDetails = 'Appointment Details:\n';
    appointmentDetails += 'Client: {{ $appointment->clients->first_name }} {{ $appointment->clients->last_name }}\n';
    appointmentDetails += 'Client ID: {{ $appointment->clients->client_id }}\n';
    appointmentDetails += 'Date: {{ date('d/m/Y', strtotime($appointment->date)) }}\n';
    appointmentDetails += 'Time: {{ $appointment->time }}\n';
    @if($appointment->natureOfEnquiry)
    appointmentDetails += 'Nature of Enquiry: {{ $appointment->natureOfEnquiry->title }}\n';
    @endif
    @if($appointment->service)
    appointmentDetails += 'Service: {{ $appointment->service->title }}\n';
    @endif
    appointmentDetails += 'Appointment Type: {{ $appointment->appointment_details ?? 'Not specified' }}\n';
    appointmentDetails += 'Status: ';
    @if($appointment->status == 0)
    appointmentDetails += 'Pending';
    @elseif($appointment->status == 1)
    appointmentDetails += 'Approved';
    @elseif($appointment->status == 2)
    appointmentDetails += 'Completed';
    @elseif($appointment->status == 3)
    appointmentDetails += 'Rejected';
    @elseif($appointment->status == 4)
    appointmentDetails += 'N/P';
    @elseif($appointment->status == 5)
    appointmentDetails += 'In Progress';
    @elseif($appointment->status == 6)
    appointmentDetails += 'Did Not Come';
    @elseif($appointment->status == 7)
    appointmentDetails += 'Cancelled';
    @elseif($appointment->status == 8)
    appointmentDetails += 'Missed';
    @elseif($appointment->status == 9)
    appointmentDetails += 'Payment Pending';
    @elseif($appointment->status == 10)
    appointmentDetails += 'Payment Success';
    @elseif($appointment->status == 11)
    appointmentDetails += 'Payment Failed';
    @endif
    appointmentDetails += '\n';
    appointmentDetails += '\nDescription:\n';
    appointmentDetails += '{{ $appointment->description }}';
    
    navigator.clipboard.writeText(appointmentDetails).then(function() {
        // Show temporary success message
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        btn.style.background = 'var(--success-color)';
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.style.background = '';
        }, 2000);
    }).catch(function(err) {
        alert('Failed to copy to clipboard: ' + err);
    });
}

// Add loading states to action buttons
document.addEventListener('DOMContentLoaded', function() {
    const actionButtons = document.querySelectorAll('.modern-btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (this.href && !this.href.includes('javascript:')) {
                this.classList.add('loading');
                const icon = this.querySelector('i');
                if (icon && !icon.classList.contains('fa-spinner')) {
                    icon.className = 'fas fa-spinner fa-spin';
                }
            }
        });
    });
});
</script>
@endsection