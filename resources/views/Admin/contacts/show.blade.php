@extends('layouts.admin')
@section('title', 'Contact Details')

@section('content')
<style>
/* Modern Contact Details Design System */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --info-color: #06b6d4;
    --contact-color: #8b5cf6;
    --contact-secondary: #7c3aed;
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
    background: linear-gradient(135deg, var(--contact-color) 0%, var(--contact-secondary) 100%);
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

.modern-btn-warning {
    background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
    color: var(--white);
}

.modern-btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
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
    gap: 1.5rem;
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
}

.modern-email-link {
    color: var(--contact-color);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
}

.modern-email-link:hover {
    color: var(--contact-secondary);
    text-decoration: underline;
}

.modern-message-content {
    background: var(--bg-light);
    padding: 1.5rem;
    border-radius: var(--border-radius-sm);
    border-left: 4px solid var(--contact-color);
    line-height: 1.6;
    color: var(--text-dark);
    font-size: 1rem;
    white-space: pre-wrap;
}

.modern-status-badge {
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

.modern-status-badge.unread {
    background: linear-gradient(135deg, var(--danger-color), #dc2626);
    color: var(--white);
}

.modern-status-badge.read {
    background: linear-gradient(135deg, var(--info-color), #0891b2);
    color: var(--white);
}

.modern-status-badge.resolved {
    background: linear-gradient(135deg, var(--success-color), #059669);
    color: var(--white);
}

.modern-status-badge.archived {
    background: linear-gradient(135deg, var(--text-light), #475569);
    color: var(--white);
}

.modern-status-badge.forwarded {
    background: linear-gradient(135deg, var(--contact-color), var(--contact-secondary));
    color: var(--white);
}

.modern-quick-actions {
    display: grid;
    gap: 0.75rem;
}

.modern-btn-block {
    width: 100%;
    justify-content: center;
}

.modern-dropdown {
    position: relative;
    display: inline-block;
    width: 100%;
}

.modern-dropdown-toggle {
    width: 100%;
    justify-content: center;
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
}

.modern-dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: var(--white);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow-lg);
    z-index: 1000;
    display: none;
    margin-top: 0.25rem;
}

.modern-dropdown-menu.show {
    display: block;
}

.modern-dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    color: var(--text-dark);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: var(--transition);
    border-bottom: 1px solid var(--border-color);
}

.modern-dropdown-item:last-child {
    border-bottom: none;
}

.modern-dropdown-item:hover {
    background: var(--bg-light);
    color: var(--text-dark);
    text-decoration: none;
}

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

.modern-contact-id {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--contact-color), var(--contact-secondary));
    color: var(--white);
    padding: 0.25rem 0.75rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
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
}

/* Animation for loading states */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.loading {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.modern-dropdown-menu.show {
    animation: fadeIn 0.3s ease-out;
}

.modern-success-feedback {
    background: var(--success-color);
    color: var(--white);
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
									<i class="fas fa-envelope-open"></i>
									Contact Details
								</h4>
								<div class="modern-header-actions">
									<a href="{{ route('admin.contacts.index') }}" class="modern-btn modern-btn-secondary">
										<i class="fas fa-arrow-left"></i>
										Back to List
									</a>
									@if($contact->status !== 'forwarded')
									<button type="button" class="modern-btn modern-btn-primary" onclick="sendToBansalEmail()">
										<i class="fas fa-paper-plane"></i>
										Send to Bansal Email
									</button>
									@endif
									<div class="modern-dropdown">
										<button type="button" class="modern-btn modern-btn-warning modern-dropdown-toggle" 
												onclick="toggleStatusDropdown()">
											<i class="fas fa-edit"></i>
											Change Status
										</button>
										<div class="modern-dropdown-menu" id="statusDropdown">
											<a class="modern-dropdown-item" href="#" onclick="updateStatus('read')">
												<i class="fas fa-eye"></i> Mark as Read
											</a>
											<a class="modern-dropdown-item" href="#" onclick="updateStatus('resolved')">
												<i class="fas fa-check-circle"></i> Mark as Resolved
											</a>
											<a class="modern-dropdown-item" href="#" onclick="updateStatus('archived')">
												<i class="fas fa-archive"></i> Archive
											</a>
										</div>
									</div>
									<button type="button" class="modern-btn modern-btn-danger" onclick="deleteContact()">
										<i class="fas fa-trash"></i>
										Delete
									</button>
								</div>
							</div>
							
							<div class="modern-card-body">
								<div class="row">
									<div class="col-lg-8">
										<!-- Contact Information -->
										<div class="modern-card">
											<div class="modern-section-header">
												<i class="fas fa-user"></i>
												Contact Information
											</div>
											<div class="modern-card-body">
												<div class="modern-info-grid">
													<div class="modern-info-item">
														<div class="modern-info-label">Full Name</div>
														<div class="modern-info-value">{{ $contact->name }}</div>
													</div>
													<div class="modern-info-item">
														<div class="modern-info-label">Email Address</div>
														<div class="modern-info-value">
															<a href="mailto:{{ $contact->contact_email }}" class="modern-email-link">
																{{ $contact->contact_email }}
															</a>
														</div>
													</div>
													@if($contact->contact_phone)
													<div class="modern-info-item">
														<div class="modern-info-label">Phone Number</div>
														<div class="modern-info-value">
															<a href="tel:{{ $contact->contact_phone }}" class="modern-email-link">
																{{ $contact->contact_phone }}
															</a>
														</div>
													</div>
													@endif
													<div class="modern-info-item" style="grid-column: 1 / -1;">
														<div class="modern-info-label">Subject</div>
														<div class="modern-info-value">{{ $contact->subject }}</div>
													</div>
												</div>
											</div>
										</div>
										
										<!-- Message -->
										<div class="modern-card">
											<div class="modern-section-header">
												<i class="fas fa-comment-alt"></i>
												Message Content
											</div>
											<div class="modern-card-body">
												<div class="modern-message-content">
													{{ $contact->message }}
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
														@if($contact->status === 'forwarded')
															<span class="modern-status-badge forwarded">
																<i class="fas fa-paper-plane"></i>
																Forwarded
															</span>
														@else
															<span class="modern-status-badge {{ $contact->status ?? 'unread' }}">
																@if(($contact->status ?? 'unread') == 'unread')
																	<i class="fas fa-exclamation-circle"></i>
																@elseif($contact->status == 'read')
																	<i class="fas fa-eye"></i>
																@elseif($contact->status == 'resolved')
																	<i class="fas fa-check-circle"></i>
																@elseif($contact->status == 'archived')
																	<i class="fas fa-archive"></i>
																@endif
																{{ ucfirst($contact->status ?? 'unread') }}
															</span>
														@endif
													</div>
												</div>
												
												<div class="modern-info-item">
													<div class="modern-info-label">Submitted</div>
													<div class="modern-info-value">
														{{ $contact->created_at->format('d/m/Y H:i:s') }}<br>
														<small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
													</div>
												</div>
												
												@if($contact->forwarded_to)
												<div class="modern-info-item">
													<div class="modern-info-label">Forwarded To</div>
													<div class="modern-info-value">
														{{ $contact->forwarded_to }}<br>
														<small class="text-muted">{{ $contact->forwarded_at->format('d/m/Y H:i:s') }}</small>
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
												<div class="modern-quick-actions">
													<a href="mailto:{{ $contact->contact_email }}?subject=Re: {{ $contact->subject }}" 
													   class="modern-btn modern-btn-primary modern-btn-block">
														<i class="fas fa-reply"></i>
														Reply via Email Client
													</a>
													
													@if($contact->status !== 'forwarded')
													<button type="button" class="modern-btn modern-btn-info modern-btn-block" onclick="sendToBansalEmail()">
														<i class="fas fa-paper-plane"></i>
														Send to Bansal Email
													</button>
													@endif
													
													<button type="button" class="modern-btn modern-btn-success modern-btn-block" onclick="copyToClipboard('{{ $contact->contact_email }}')">
														<i class="fas fa-copy"></i>
														Copy Email Address
													</button>
													
													<button type="button" class="modern-btn modern-btn-secondary modern-btn-block" onclick="copyContactDetails()">
														<i class="fas fa-clipboard"></i>
														Copy All Details
													</button>
												</div>
											</div>
										</div>
										
										<!-- Contact Summary -->
										<div class="modern-card">
											<div class="modern-section-header">
												<i class="fas fa-chart-bar"></i>
												Summary
											</div>
											<div class="modern-card-body">
												<div class="modern-summary-item">
													<span class="modern-summary-label">Contact ID</span>
													<span class="modern-contact-id">#{{ $contact->id }}</span>
												</div>
												<div class="modern-summary-item">
													<span class="modern-summary-label">Message Length</span>
													<span class="modern-summary-value">{{ strlen($contact->message) }} characters</span>
												</div>
												<div class="modern-summary-item">
													<span class="modern-summary-label">Word Count</span>
													<span class="modern-summary-value">{{ str_word_count($contact->message) }} words</span>
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

<script>
// Enhanced contact details functionality
function toggleStatusDropdown() {
    const dropdown = document.getElementById('statusDropdown');
    dropdown.classList.toggle('show');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.modern-dropdown')) {
        document.querySelectorAll('.modern-dropdown-menu').forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    }
});

function updateStatus(status) {
    const contactId = {{ $contact->id }};
    
    fetch(`/admin/contacts/${contactId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        alert('Error updating status: ' + error.message);
    });
}

function deleteContact() {
    if (confirm('Are you sure you want to delete this contact? This action cannot be undone.')) {
        const contactId = {{ $contact->id }};
        
        fetch(`/admin/contacts/${contactId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Contact deleted successfully!');
                window.location.href = '{{ route("admin.contacts.index") }}';
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            alert('Error deleting contact: ' + error.message);
        });
    }
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show temporary success message
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        btn.classList.add('modern-success-feedback');
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('modern-success-feedback');
        }, 2000);
    }).catch(function(err) {
        alert('Failed to copy to clipboard: ' + err);
    });
}

function copyContactDetails() {
    const contactDetails = `
Contact Details:
Name: {{ $contact->name }}
Email: {{ $contact->contact_email }}
@if($contact->contact_phone)
Phone: {{ $contact->contact_phone }}
@endif
Subject: {{ $contact->subject }}
Submitted: {{ $contact->created_at->format('d/m/Y H:i:s') }}

Message:
{{ $contact->message }}
    `.trim();
    
    copyToClipboard(contactDetails);
}

function sendToBansalEmail() {
    const button = event.target.closest('button');
    
    if (confirm('Send this contact query to info@bansallawyers.com.au for further processing?')) {
        // Disable button and show loading
        if (button) {
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            button.classList.add('loading');
        }
        
        const contactId = {{ $contact->id }};
        
        fetch(`/admin/contacts/${contactId}/send-to-bansal-email`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Contact query sent to info@bansallawyers.com.au successfully!');
                location.reload();
            } else {
                alert('Error: ' + data.message);
                // Re-enable button on error
                if (button) {
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-paper-plane"></i> Send to Bansal Email';
                    button.classList.remove('loading');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error sending to Bansal email. Please try again.');
            // Re-enable button on error
            if (button) {
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-paper-plane"></i> Send to Bansal Email';
                button.classList.remove('loading');
            }
        });
    }
}
</script>
@endsection