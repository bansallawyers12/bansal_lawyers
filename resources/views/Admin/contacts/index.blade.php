@extends('layouts.admin')
@section('title', 'Contact Management')

@section('content')
<style>
/* Modern Contact Management Design System */
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
}

.modern-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-2px);
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

.modern-btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.8rem;
}

.modern-card-body {
    padding: 2rem;
}

.modern-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.modern-stat-card {
    background: var(--white);
    border-radius: var(--border-radius-sm);
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.modern-stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    transition: var(--transition);
}

.modern-stat-card.total::before {
    background: linear-gradient(135deg, var(--contact-color), var(--contact-secondary));
}

.modern-stat-card.today::before {
    background: linear-gradient(135deg, var(--success-color), #059669);
}

.modern-stat-card.week::before {
    background: linear-gradient(135deg, var(--info-color), #0891b2);
}

.modern-stat-card.month::before {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
}

.modern-stat-card:hover {
    box-shadow: var(--shadow);
    transform: translateY(-1px);
}

.modern-stat-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modern-stat-info h5 {
    color: var(--text-light);
    font-size: 0.875rem;
    font-weight: 600;
    margin: 0 0 0.5rem 0;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.modern-stat-info h3 {
    color: var(--text-dark);
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
}

.modern-stat-icon {
    width: 3rem;
    height: 3rem;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: var(--white);
    opacity: 0.9;
}

.modern-stat-icon.total {
    background: linear-gradient(135deg, var(--contact-color), var(--contact-secondary));
}

.modern-stat-icon.today {
    background: linear-gradient(135deg, var(--success-color), #059669);
}

.modern-stat-icon.week {
    background: linear-gradient(135deg, var(--info-color), #0891b2);
}

.modern-stat-icon.month {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
}

.modern-filter-card {
    background: var(--white);
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
    margin-bottom: 2rem;
}

.modern-filter-header {
    background: var(--bg-light);
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    font-weight: 600;
    color: var(--text-dark);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modern-filter-body {
    padding: 1.5rem;
}

.modern-filter-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr 2fr;
    gap: 1rem;
    align-items: end;
}

.modern-form-group {
    margin-bottom: 0;
}

.modern-form-label {
    display: block;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.modern-form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    transition: var(--transition);
    background: var(--white);
    color: var(--text-dark);
}

.modern-form-input:focus {
    outline: none;
    border-color: var(--contact-color);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
}

.modern-select {
    width: 100%;
    padding: 0.75rem 1rem;
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
    border-color: var(--contact-color);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
}

.modern-filter-actions {
    display: flex;
    gap: 0.5rem;
}

.modern-table-container {
    background: var(--white);
    border-radius: var(--border-radius-sm);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.modern-table th {
    background: var(--bg-light);
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: var(--text-dark);
    border-bottom: 2px solid var(--border-color);
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.modern-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--border-color);
    color: var(--text-dark);
    vertical-align: middle;
}

.modern-table tbody tr {
    transition: var(--transition);
}

.modern-table tbody tr:hover {
    background: #f8fafc;
}

.modern-table tbody tr:last-child td {
    border-bottom: none;
}

.modern-table tbody tr.unread {
    background: rgba(139, 92, 246, 0.05);
    font-weight: 600;
}

.modern-checkbox {
    width: 18px;
    height: 18px;
    border: 2px solid var(--border-color);
    border-radius: 4px;
    cursor: pointer;
    transition: var(--transition);
}

.modern-checkbox:checked {
    background: var(--contact-color);
    border-color: var(--contact-color);
}

.modern-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0.75rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
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

.modern-actions {
    display: flex;
    gap: 0.25rem;
    flex-wrap: wrap;
}

.modern-dropdown {
    position: relative;
    display: inline-block;
}

.modern-dropdown-toggle {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
}

.modern-dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background: var(--white);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow-lg);
    z-index: 1000;
    min-width: 150px;
    display: none;
}

.modern-dropdown-menu.show {
    display: block;
}

.modern-dropdown-item {
    display: block;
    padding: 0.5rem 1rem;
    color: var(--text-dark);
    text-decoration: none;
    font-size: 0.875rem;
    transition: var(--transition);
}

.modern-dropdown-item:hover {
    background: var(--bg-light);
    color: var(--text-dark);
    text-decoration: none;
}

.modern-pagination {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

/* Modern Pagination Styling */
.modern-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 2rem;
}

.modern-pagination .pagination {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    list-style: none;
    padding: 0;
}

.modern-pagination .page-item {
    display: inline-block;
}

.modern-pagination .page-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 2.5rem;
    height: 2.5rem;
    padding: 0.5rem 0.75rem;
    border: 2px solid var(--border-color);
    color: var(--text-dark);
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    font-size: 0.875rem;
    transition: var(--transition);
    text-decoration: none;
    background: var(--white);
    box-shadow: var(--shadow-sm);
}

.modern-pagination .page-link:hover {
    background: var(--contact-color);
    border-color: var(--contact-color);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    text-decoration: none;
}

.modern-pagination .page-item.active .page-link {
    background: linear-gradient(135deg, var(--contact-color), var(--contact-secondary));
    border-color: var(--contact-color);
    color: var(--white);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
}

.modern-pagination .page-item.disabled .page-link {
    background: var(--bg-light);
    border-color: var(--border-color);
    color: var(--text-light);
    cursor: not-allowed;
    box-shadow: none;
}

.modern-pagination .page-item.disabled .page-link:hover {
    background: var(--bg-light);
    border-color: var(--border-color);
    color: var(--text-light);
    transform: none;
    box-shadow: none;
}

/* Previous/Next button styling */
.modern-pagination .page-link[rel="prev"],
.modern-pagination .page-link[rel="next"] {
    padding: 0.5rem 1rem;
    font-weight: 700;
}

/* Ellipsis styling */
.modern-pagination .page-item .page-link[aria-disabled="true"] {
    background: transparent;
    border: none;
    color: var(--text-light);
    cursor: default;
    box-shadow: none;
}

.modern-pagination .page-item .page-link[aria-disabled="true"]:hover {
    background: transparent;
    border: none;
    color: var(--text-light);
    transform: none;
    box-shadow: none;
}

.modern-empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--text-light);
}

.modern-empty-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.modern-empty-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--text-dark);
}

.modern-empty-description {
    font-size: 1rem;
    margin-bottom: 2rem;
}

.modern-bulk-actions {
    display: none;
    gap: 0.5rem;
    margin-left: auto;
}

.modern-bulk-actions.show {
    display: flex;
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
    
    .modern-stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .modern-filter-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .modern-table-container {
        overflow-x: auto;
    }
    
    .modern-actions {
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .modern-btn {
        justify-content: center;
    }
    
    .modern-header-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .modern-bulk-actions {
        flex-direction: column;
    }
    
    .modern-pagination .pagination {
        gap: 0.25rem;
    }
    
    .modern-pagination .page-link {
        min-width: 2rem;
        height: 2rem;
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
    }
    
    .modern-pagination .page-link[rel="prev"],
    .modern-pagination .page-link[rel="next"] {
        padding: 0.25rem 0.75rem;
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

.modern-bulk-actions.show {
    animation: fadeIn 0.3s ease-out;
}
</style>

<!-- Main Content -->
<div class="main-content modern-page-container">
	<section class="section">
		<div class="section-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="modern-card">
							<div class="modern-card-header">
								<h4 class="modern-card-title">
									<i class="fas fa-envelope"></i>
									Contact Form Submissions
								</h4>
								<div class="modern-header-actions">
									<button type="button" class="modern-btn modern-btn-secondary" onclick="exportContacts()">
										<i class="fas fa-download"></i>
										Export CSV
									</button>
									<div class="modern-bulk-actions" id="bulkActions">
										<button type="button" class="modern-btn modern-btn-info modern-btn-sm" onclick="bulkSendToBansalEmail()" id="bulkSendToBansalBtn">
											<i class="fas fa-paper-plane"></i>
											Send to Bansal Email
										</button>
										<button type="button" class="modern-btn modern-btn-danger modern-btn-sm" onclick="bulkDelete()" id="bulkDeleteBtn">
											<i class="fas fa-trash"></i>
											Delete Selected
										</button>
									</div>
								</div>
							</div>
							
							<div class="modern-card-body">
								<!-- Statistics Cards -->
								<div class="modern-stats-grid">
									<div class="modern-stat-card total">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>Total Contacts</h5>
												<h3>{{ $stats['total'] }}</h3>
											</div>
											<div class="modern-stat-icon total">
												<i class="fas fa-envelope"></i>
											</div>
										</div>
									</div>
									<div class="modern-stat-card today">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>Today</h5>
												<h3>{{ $stats['today'] }}</h3>
											</div>
											<div class="modern-stat-icon today">
												<i class="fas fa-calendar-day"></i>
											</div>
										</div>
									</div>
									<div class="modern-stat-card week">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>This Week</h5>
												<h3>{{ $stats['this_week'] }}</h3>
											</div>
											<div class="modern-stat-icon week">
												<i class="fas fa-calendar-week"></i>
											</div>
										</div>
									</div>
									<div class="modern-stat-card month">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>This Month</h5>
												<h3>{{ $stats['this_month'] }}</h3>
											</div>
											<div class="modern-stat-icon month">
												<i class="fas fa-calendar-alt"></i>
											</div>
										</div>
									</div>
								</div>

								<!-- Filters -->
								<div class="modern-filter-card">
									<div class="modern-filter-header">
										<i class="fas fa-filter"></i>
										Filter & Search
									</div>
									<div class="modern-filter-body">
										<form method="GET" action="{{ route('admin.contacts.index') }}" id="filterForm">
											<div class="modern-filter-grid">
												<div class="modern-form-group">
													<label for="search" class="modern-form-label">Search</label>
													<input type="text" class="modern-form-input" id="search" name="search" 
														   value="{{ request('search') }}" placeholder="Name, email, phone, subject...">
												</div>
												<div class="modern-form-group">
													<label for="date_from" class="modern-form-label">From Date</label>
													<input type="date" class="modern-form-input" id="date_from" name="date_from" 
														   value="{{ request('date_from') }}">
												</div>
												<div class="modern-form-group">
													<label for="date_to" class="modern-form-label">To Date</label>
													<input type="date" class="modern-form-input" id="date_to" name="date_to" 
														   value="{{ request('date_to') }}">
												</div>
												<div class="modern-form-group">
													<label for="status" class="modern-form-label">Status</label>
													<select class="modern-select" id="status" name="status">
														<option value="">All Status</option>
														<option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
														<option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
														<option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
														<option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
													</select>
												</div>
												<div class="modern-form-group">
													<div class="modern-filter-actions">
														<button type="submit" class="modern-btn modern-btn-primary">
															<i class="fas fa-search"></i>
															Filter
														</button>
														<a href="{{ route('admin.contacts.index') }}" class="modern-btn modern-btn-secondary">
															<i class="fas fa-times"></i>
															Clear
														</a>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>

								<!-- Table -->
								@if(count($contacts) > 0)
								<div class="modern-table-container">
									<table class="modern-table">
										<thead>
											<tr>
												<th width="30">
													<input type="checkbox" id="selectAll" class="modern-checkbox" onchange="toggleSelectAll()">
												</th>
												<th>Name</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Subject</th>
												<th>Status</th>
												<th>Submitted</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											@forelse($contacts as $contact)
											<tr class="{{ $contact->status == 'unread' ? 'unread' : '' }}" id="contact-{{ $contact->id }}">
												<td>
													<input type="checkbox" class="modern-checkbox contact-checkbox" value="{{ $contact->id }}">
												</td>
												<td>
													<div class="font-weight-bold">{{ $contact->name }}</div>
												</td>
												<td>
													<a href="mailto:{{ $contact->contact_email }}" class="text-decoration-none">
														{{ $contact->contact_email }}
													</a>
												</td>
												<td>
													@if($contact->contact_phone)
														<a href="tel:{{ $contact->contact_phone }}" class="text-decoration-none">
															{{ $contact->contact_phone }}
														</a>
													@else
														<span class="text-muted">-</span>
													@endif
												</td>
												<td>
													<div class="font-weight-500">
														{{ \Illuminate\Support\Str::limit($contact->subject, 50) }}
													</div>
												</td>
												<td>
													@if($contact->status === 'forwarded')
														<span class="modern-status-badge forwarded">
															<i class="fas fa-paper-plane"></i>
															Forwarded
														</span>
														@if($contact->forwarded_at)
															<br><small class="text-muted">{{ $contact->forwarded_at->format('d/m/Y H:i') }}</small>
														@endif
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
												</td>
												<td>
													<div class="font-weight-500">{{ $contact->created_at->format('d/m/Y H:i') }}</div>
													<small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
												</td>
												<td>
													<div class="modern-actions">
														<a href="{{ route('admin.contacts.show', $contact->id) }}" 
														   class="modern-btn modern-btn-info modern-btn-sm" title="View Details">
															<i class="fas fa-eye"></i>
														</a>
														@if($contact->status === 'forwarded')
															<button type="button" class="modern-btn modern-btn-secondary modern-btn-sm" disabled title="Already Forwarded">
																<i class="fas fa-check"></i>
															</button>
														@else
															<button type="button" class="modern-btn modern-btn-primary modern-btn-sm" 
																	onclick="sendToBansalEmail({{ $contact->id }})" title="Send to Bansal Email">
																<i class="fas fa-paper-plane"></i>
															</button>
														@endif
														<div class="modern-dropdown">
															<button type="button" class="modern-btn modern-btn-warning modern-btn-sm modern-dropdown-toggle" 
																	onclick="toggleDropdown({{ $contact->id }})" title="Change Status">
																<i class="fas fa-edit"></i>
															</button>
															<div class="modern-dropdown-menu" id="dropdown-{{ $contact->id }}">
																<a class="modern-dropdown-item" href="#" onclick="updateStatus({{ $contact->id }}, 'read')">
																	<i class="fas fa-eye"></i> Mark as Read
																</a>
																<a class="modern-dropdown-item" href="#" onclick="updateStatus({{ $contact->id }}, 'resolved')">
																	<i class="fas fa-check-circle"></i> Mark as Resolved
																</a>
																<a class="modern-dropdown-item" href="#" onclick="updateStatus({{ $contact->id }}, 'archived')">
																	<i class="fas fa-archive"></i> Archive
																</a>
															</div>
														</div>
														<button type="button" class="modern-btn modern-btn-danger modern-btn-sm" 
																onclick="deleteContact({{ $contact->id }})" title="Delete">
															<i class="fas fa-trash"></i>
														</button>
													</div>
												</td>
											</tr>
											@empty
											<tr>
												<td colspan="8" class="text-center py-4">
													<div class="modern-empty-state">
														<div class="modern-empty-icon">
															<i class="fas fa-envelope-open"></i>
														</div>
														<h3 class="modern-empty-title">No contacts found</h3>
														<p class="modern-empty-description">No contact submissions match your current filters</p>
													</div>
												</td>
											</tr>
											@endforelse
										</tbody>
									</table>
								</div>
								
								<!-- Pagination -->
								@if($contacts->hasPages())
								<div class="modern-pagination">
									{{ $contacts->links() }}
								</div>
								@endif
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
// Enhanced contact management functionality
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.contact-checkbox');
    const bulkActions = document.getElementById('bulkActions');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
            if (checkedBoxes.length > 0) {
                bulkActions.classList.add('show');
            } else {
                bulkActions.classList.remove('show');
            }
        });
    });
});

function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.contact-checkbox');
    const bulkActions = document.getElementById('bulkActions');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    if (selectAll.checked) {
        bulkActions.classList.add('show');
    } else {
        bulkActions.classList.remove('show');
    }
}

function toggleDropdown(contactId) {
    const dropdown = document.getElementById(`dropdown-${contactId}`);
    const allDropdowns = document.querySelectorAll('.modern-dropdown-menu');
    
    // Close all other dropdowns
    allDropdowns.forEach(d => {
        if (d !== dropdown) {
            d.classList.remove('show');
        }
    });
    
    dropdown.classList.toggle('show');
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.modern-dropdown')) {
        document.querySelectorAll('.modern-dropdown-menu').forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    }
});

function updateStatus(contactId, status) {
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

function deleteContact(contactId) {
    if (confirm('Are you sure you want to delete this contact?')) {
        fetch(`/admin/contacts/${contactId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
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
            alert('Error deleting contact: ' + error.message);
        });
    }
}

function bulkDelete() {
    const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
    const contactIds = Array.from(checkedBoxes).map(cb => cb.value);
    
    if (contactIds.length === 0) {
        alert('Please select contacts to delete.');
        return;
    }
    
    if (confirm(`Are you sure you want to delete ${contactIds.length} contact(s)?`)) {
        fetch('/admin/contacts/bulk-delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ contact_ids: contactIds })
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
            alert('Error deleting contacts: ' + error.message);
        });
    }
}

function exportContacts() {
    const params = new URLSearchParams(window.location.search);
    window.location.href = '/admin/contacts/export?' + params.toString();
}

function sendToBansalEmail(contactId) {
    // Check if already processing
    const button = document.querySelector(`button[onclick="sendToBansalEmail(${contactId})"]`);
    if (button && button.disabled) {
        return; // Already processing
    }
    
    if (confirm('Send this contact query to info@bansallawyers.com.au for further processing?')) {
        // Disable button and show loading
        if (button) {
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            button.classList.add('loading');
        }
        
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
                    button.innerHTML = '<i class="fas fa-paper-plane"></i>';
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
                button.innerHTML = '<i class="fas fa-paper-plane"></i>';
                button.classList.remove('loading');
            }
        });
    }
}

function bulkSendToBansalEmail() {
    const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
    const contactIds = Array.from(checkedBoxes).map(cb => cb.value);
    const button = document.getElementById('bulkSendToBansalBtn');
    
    if (contactIds.length === 0) {
        alert('Please select contacts to send to Bansal email.');
        return;
    }
    
    // Check if already processing
    if (button && button.disabled) {
        return; // Already processing
    }
    
    if (confirm(`Send ${contactIds.length} contact(s) to info@bansallawyers.com.au for further processing?`)) {
        // Disable button and show loading
        if (button) {
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            button.classList.add('loading');
        }
        
        fetch('/admin/contacts/bulk-send-to-bansal-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ contact_ids: contactIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`${data.count} contact(s) sent to info@bansallawyers.com.au successfully!`);
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
            alert('Error sending contacts to Bansal email: ' + error.message);
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