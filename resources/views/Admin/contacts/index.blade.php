@extends('layouts.admin')
@section('title', 'Contact Management')

@section('content')
@include('Elements.flash-message')

<style {!! \App\Services\CspService::getNonceAttribute() !!}>
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
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    min-width: 38px;
    min-height: 38px;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    position: relative;
}

.modern-btn-sm i {
    font-size: 0.95rem !important;
    display: inline-block !important;
    line-height: 1 !important;
    opacity: 1 !important;
    visibility: visible !important;
    color: inherit !important;
    margin: 0 !important;
}

/* Ensure buttons with only icons are square */
/* Icon-only buttons */
.modern-btn-sm:only-child,
.modern-btn-sm:has(i:only-child) {
    padding: 0.5rem !important;
    width: 38px !important;
    height: 38px !important;
}

/* Fallback for browsers that don't support :has() */
.modern-btn-sm.icon-only {
    padding: 0.5rem !important;
    width: 38px !important;
    height: 38px !important;
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
    display: flex !important;
    gap: 0.5rem;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-start;
}

.modern-actions .modern-btn {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center;
    white-space: nowrap;
    position: relative;
}

.modern-actions .modern-btn i {
    display: inline-block !important;
    font-size: 0.95rem !important;
    line-height: 1 !important;
    margin: 0 !important;
    opacity: 1 !important;
    visibility: visible !important;
    color: inherit !important;
    font-style: normal !important;
    font-weight: 900 !important;
}

/* Ensure Lucide icons in action buttons render correctly */
.modern-actions .modern-btn i,
.modern-actions .modern-btn svg {
    display: inline-block !important;
    width: 1rem;
    height: 1rem;
    flex-shrink: 0;
}

.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
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
    align-items: center;
}

.modern-bulk-bar {
    display: none;
    margin-bottom: 1.5rem;
    padding: 0.875rem 1.25rem;
    background: linear-gradient(135deg, #ede9fe 0%, #f5f3ff 100%);
    border: 1px solid #c4b5fd;
    border-radius: var(--border-radius-sm);
    box-shadow: var(--shadow-sm);
}

.modern-bulk-bar.is-visible {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.modern-bulk-bar-summary {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--contact-secondary);
}

.modern-bulk-bar-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.modern-results-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-bottom: 1rem;
    color: var(--text-light);
    font-size: 0.875rem;
}

.modern-table tbody tr.contact-row {
    cursor: pointer;
}

.modern-table tbody tr.contact-row td:first-child,
.modern-table tbody tr.contact-row td:last-child {
    cursor: default;
}

.modern-contact-name {
    font-weight: 600;
    color: var(--text-dark);
}

.modern-contact-subject {
    color: var(--text-light);
    font-size: 0.8125rem;
    margin-top: 0.15rem;
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
									<i data-lucide="mail"></i>
									Contact Form Submissions
								</h4>
								<div class="modern-header-actions">
									<button type="button" class="modern-btn modern-btn-secondary" data-export-contacts>
										<i data-lucide="download"></i>
										Export CSV
									</button>
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
												<i data-lucide="mail"></i>
											</div>
										</div>
									</div>
									<div class="modern-stat-card today">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>Unread</h5>
												<h3>{{ $stats['unread'] }}</h3>
											</div>
											<div class="modern-stat-icon today">
												<i data-lucide="circle-alert"></i>
											</div>
										</div>
									</div>
									<div class="modern-stat-card week">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>Forwarded</h5>
												<h3>{{ $stats['forwarded'] }}</h3>
											</div>
											<div class="modern-stat-icon week">
												<i data-lucide="send"></i>
											</div>
										</div>
									</div>
									<div class="modern-stat-card month">
										<div class="modern-stat-content">
											<div class="modern-stat-info">
												<h5>Today</h5>
												<h3>{{ $stats['today'] }}</h3>
											</div>
											<div class="modern-stat-icon month">
												<i data-lucide="calendar-days"></i>
											</div>
										</div>
									</div>
								</div>

								<!-- Filters -->
								<div class="modern-filter-card">
									<div class="modern-filter-header">
										<i data-lucide="funnel"></i>
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
														<option value="forwarded" {{ request('status') == 'forwarded' ? 'selected' : '' }}>Forwarded</option>
													</select>
												</div>
												<div class="modern-form-group">
													<div class="modern-filter-actions">
														<button type="submit" class="modern-btn modern-btn-primary">
															<i data-lucide="search"></i>
															Filter
														</button>
														<a href="{{ route('admin.contacts.index') }}" class="modern-btn modern-btn-secondary">
															<i data-lucide="x"></i>
															Clear
														</a>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>

								<div class="modern-bulk-bar" id="bulkBar" aria-hidden="true">
									<div class="modern-bulk-bar-summary">
										<i data-lucide="check-square"></i>
										<span><strong id="selectedCount">0</strong> contact(s) selected</span>
									</div>
									<div class="modern-bulk-bar-actions">
										<button type="button" class="modern-btn modern-btn-info modern-btn-sm" data-bulk-send-bansal id="bulkSendToBansalBtn">
											<i data-lucide="send"></i>
											Send to Bansal Email
										</button>
										<button type="button" class="modern-btn modern-btn-danger modern-btn-sm" data-bulk-delete-contacts id="bulkDeleteBtn">
											<i data-lucide="trash-2"></i>
											Delete Selected
										</button>
										<button type="button" class="modern-btn modern-btn-secondary modern-btn-sm" id="clearSelectionBtn">
											<i data-lucide="x"></i>
											Clear
										</button>
									</div>
								</div>

								<div class="modern-results-meta">
									<span>
										Showing {{ $contacts->firstItem() ?? 0 }}–{{ $contacts->lastItem() ?? 0 }} of {{ $contacts->total() }} contact(s)
										@if(request()->hasAny(['search', 'date_from', 'date_to', 'status']))
											(filtered)
										@endif
									</span>
								</div>

								<div class="modern-table-container">
									<table class="modern-table">
										<thead>
											<tr>
												<th width="30">
													<input type="checkbox" id="selectAll" class="modern-checkbox" aria-label="Select all contacts">
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
											<tr class="contact-row {{ ($contact->status ?? 'unread') === 'unread' ? 'unread' : '' }}"
												id="contact-{{ $contact->id }}"
												data-view-url="{{ route('admin.contacts.show', $contact->id) }}">
												<td>
													<input type="checkbox" class="modern-checkbox contact-checkbox" value="{{ $contact->id }}" aria-label="Select {{ $contact->name }}">
												</td>
												<td>
													<div class="modern-contact-name">{{ $contact->name }}</div>
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
													<div class="font-weight-500">{{ \Illuminate\Support\Str::limit($contact->subject, 50) }}</div>
													<div class="modern-contact-subject">{{ \Illuminate\Support\Str::limit(strip_tags($contact->message), 60) }}</div>
												</td>
												<td>
													@if($contact->status === 'forwarded')
														<span class="modern-status-badge forwarded">
															<i data-lucide="send"></i>
															Forwarded
														</span>
														@if($contact->forwarded_at)
															<br><small class="text-muted">{{ $contact->forwarded_at->format('d/m/Y H:i') }}</small>
														@endif
													@else
														<span class="modern-status-badge {{ $contact->status ?? 'unread' }}">
															@if(($contact->status ?? 'unread') == 'unread')
																<i data-lucide="circle-alert"></i>
															@elseif($contact->status == 'read')
																<i data-lucide="eye"></i>
															@elseif($contact->status == 'resolved')
																<i data-lucide="circle-check"></i>
															@elseif($contact->status == 'archived')
																<i data-lucide="archive"></i>
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
														   class="modern-btn modern-btn-info modern-btn-sm icon-only" title="View Details">
															<i data-lucide="eye" aria-hidden="true"></i>
															<span class="sr-only">View</span>
														</a>
														@if($contact->status === 'forwarded')
															<button type="button" class="modern-btn modern-btn-secondary modern-btn-sm icon-only" disabled title="Already Forwarded">
																<i data-lucide="check" aria-hidden="true"></i>
																<span class="sr-only">Forwarded</span>
															</button>
														@else
															<button type="button" class="modern-btn modern-btn-primary modern-btn-sm icon-only" 
																	data-send-bansal-email data-contact-id="{{ $contact->id }}" title="Send to Bansal Email">
																<i data-lucide="send" aria-hidden="true"></i>
																<span class="sr-only">Send Email</span>
															</button>
														@endif
														<div class="modern-dropdown">
															<button type="button" class="modern-btn modern-btn-warning modern-btn-sm modern-dropdown-toggle icon-only" 
																	data-toggle-dropdown data-contact-id="{{ $contact->id }}" title="Change Status">
																<i data-lucide="pencil" aria-hidden="true"></i>
																<span class="sr-only">Change Status</span>
															</button>
															<div class="modern-dropdown-menu" id="dropdown-{{ $contact->id }}">
																<a class="modern-dropdown-item" href="#" data-contact-status-action data-contact-id="{{ $contact->id }}" data-status="read">
																	<i data-lucide="eye"></i> Mark as Read
																</a>
																<a class="modern-dropdown-item" href="#" data-contact-status-action data-contact-id="{{ $contact->id }}" data-status="resolved">
																	<i data-lucide="circle-check"></i> Mark as Resolved
																</a>
																<a class="modern-dropdown-item" href="#" data-contact-status-action data-contact-id="{{ $contact->id }}" data-status="archived">
																	<i data-lucide="archive"></i> Archive
																</a>
															</div>
														</div>
														<button type="button" class="modern-btn modern-btn-danger modern-btn-sm icon-only" 
																data-delete-contact data-contact-id="{{ $contact->id }}" title="Delete">
															<i data-lucide="trash-2" aria-hidden="true"></i>
															<span class="sr-only">Delete</span>
														</button>
													</div>
												</td>
											</tr>
											@empty
											<tr>
												<td colspan="8">
													<div class="modern-empty-state">
														<div class="modern-empty-icon">
															<i data-lucide="mail-open"></i>
														</div>
														<h3 class="modern-empty-title">No contacts found</h3>
														<p class="modern-empty-description">
															@if(request()->hasAny(['search', 'date_from', 'date_to', 'status']))
																No submissions match your current filters. Try adjusting your search.
															@else
																Contact form submissions will appear here when visitors reach out.
															@endif
														</p>
														@if(request()->hasAny(['search', 'date_from', 'date_to', 'status']))
															<a href="{{ route('admin.contacts.index') }}" class="modern-btn modern-btn-primary">
																<i data-lucide="x"></i>
																Clear Filters
															</a>
														@endif
													</div>
												</td>
											</tr>
											@endforelse
										</tbody>
									</table>
								</div>

								@if($contacts->hasPages())
								<div class="modern-pagination">
									{!! $contacts->appends(request()->except('page'))->links() !!}
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script {!! \App\Services\CspService::getNonceAttribute() !!}>
function showContactFlash(type, message) {
    if (typeof window.dismissAlert === 'function') {
        document.querySelectorAll('.modern-flash-alert').forEach(function (alert) {
            window.dismissAlert(alert.querySelector('.modern-flash-close') || alert);
        });
    }

    var container = document.querySelector('.modern-flash-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'modern-flash-container';
        document.body.appendChild(container);
    }

    var icons = { success: 'check', error: 'circle-alert', warning: 'triangle-alert', info: 'info' };
    var titles = { success: 'Success!', error: 'Error!', warning: 'Warning!', info: 'Information' };
    var alert = document.createElement('div');
    alert.className = 'modern-flash-alert ' + type;
    alert.setAttribute('role', 'alert');
    alert.setAttribute('data-auto-dismiss', type === 'error' ? '8000' : '5000');
    alert.innerHTML = '<div class="modern-flash-icon"><i data-lucide="' + (icons[type] || 'info') + '"></i></div>' +
        '<div class="modern-flash-content"><div class="modern-flash-title">' + (titles[type] || 'Notice') + '</div>' +
        '<div class="modern-flash-message">' + message + '</div></div>' +
        '<button type="button" class="modern-flash-close" aria-label="Close notification"><i data-lucide="x" aria-hidden="true"></i></button>' +
        '<div class="modern-flash-progress"></div>';
    container.appendChild(alert);

    if (typeof window.refreshLucideIcons === 'function') {
        window.refreshLucideIcons(alert);
    }

    alert.querySelector('.modern-flash-close').addEventListener('click', function () {
        window.dismissAlert(this);
    });

    setTimeout(function () {
        var closeBtn = alert.querySelector('.modern-flash-close');
        if (closeBtn) {
            window.dismissAlert(closeBtn);
        }
    }, type === 'error' ? 8000 : 5000);
}

function updateBulkSelectionUi() {
    var checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
    var bulkBar = document.getElementById('bulkBar');
    var selectedCount = document.getElementById('selectedCount');
    var selectAll = document.getElementById('selectAll');
    var allBoxes = document.querySelectorAll('.contact-checkbox');

    if (selectedCount) {
        selectedCount.textContent = String(checkedBoxes.length);
    }

    if (bulkBar) {
        bulkBar.classList.toggle('is-visible', checkedBoxes.length > 0);
        bulkBar.setAttribute('aria-hidden', checkedBoxes.length > 0 ? 'false' : 'true');
    }

    if (selectAll && allBoxes.length) {
        selectAll.checked = checkedBoxes.length === allBoxes.length;
        selectAll.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < allBoxes.length;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    var selectAll = document.getElementById('selectAll');
    var clearSelectionBtn = document.getElementById('clearSelectionBtn');

    document.querySelectorAll('.contact-checkbox').forEach(function (checkbox) {
        checkbox.addEventListener('change', updateBulkSelectionUi);
    });

    if (selectAll) {
        selectAll.addEventListener('change', function () {
            document.querySelectorAll('.contact-checkbox').forEach(function (checkbox) {
                checkbox.checked = selectAll.checked;
            });
            updateBulkSelectionUi();
        });
    }

    if (clearSelectionBtn) {
        clearSelectionBtn.addEventListener('click', function () {
            document.querySelectorAll('.contact-checkbox').forEach(function (checkbox) {
                checkbox.checked = false;
            });
            if (selectAll) {
                selectAll.checked = false;
                selectAll.indeterminate = false;
            }
            updateBulkSelectionUi();
        });
    }

    document.querySelectorAll('.contact-row').forEach(function (row) {
        row.addEventListener('click', function (event) {
            if (event.target.closest('a, button, input, .modern-dropdown, .modern-dropdown-menu')) {
                return;
            }
            var url = row.getAttribute('data-view-url');
            if (url) {
                window.location.href = url;
            }
        });
    });
});

function toggleDropdown(contactId) {
    var dropdown = document.getElementById('dropdown-' + contactId);
    document.querySelectorAll('.modern-dropdown-menu').forEach(function (menu) {
        if (menu !== dropdown) {
            menu.classList.remove('show');
        }
    });
    if (dropdown) {
        dropdown.classList.toggle('show');
    }
}

document.addEventListener('click', function (event) {
    if (!event.target.closest('.modern-dropdown')) {
        document.querySelectorAll('.modern-dropdown-menu').forEach(function (dropdown) {
            dropdown.classList.remove('show');
        });
    }
});

function updateContactStatus(contactId, status) {
    fetch('/admin/contacts/' + contactId + '/status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: status })
    })
    .then(function (response) { return response.json(); })
    .then(function (data) {
        if (data.success) {
            showContactFlash('success', data.message || 'Contact status updated successfully');
            setTimeout(function () { location.reload(); }, 700);
        } else {
            showContactFlash('error', data.message || 'Failed to update status');
        }
    })
    .catch(function (error) {
        showContactFlash('error', 'Error updating status: ' + error.message);
    });
}

function deleteContact(contactId) {
    window.adminConfirm({
        title: 'Delete Contact?',
        message: 'This contact submission will be permanently removed. This action cannot be undone.',
        confirmText: 'Delete Contact',
        variant: 'danger',
        icon: 'trash-2'
    }).then(function (confirmed) {
        if (!confirmed) {
            return;
        }
        fetch('/admin/contacts/' + contactId, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(function (response) { return response.json(); })
        .then(function (data) {
            if (data.success) {
                showContactFlash('success', data.message || 'Contact deleted successfully');
                setTimeout(function () { location.reload(); }, 700);
            } else {
                showContactFlash('error', data.message || 'Failed to delete contact');
            }
        })
        .catch(function (error) {
            showContactFlash('error', 'Error deleting contact: ' + error.message);
        });
    });
}

function bulkDelete() {
    var checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
    var contactIds = Array.from(checkedBoxes).map(function (cb) { return cb.value; });

    if (contactIds.length === 0) {
        showContactFlash('warning', 'Please select contacts to delete.');
        return;
    }

    window.adminConfirm({
        title: 'Delete Selected Contacts?',
        message: 'You are about to permanently delete ' + contactIds.length + ' contact submission(s). This action cannot be undone.',
        confirmText: 'Delete ' + contactIds.length + ' Contact(s)',
        variant: 'danger',
        icon: 'trash-2'
    }).then(function (confirmed) {
        if (!confirmed) {
            return;
        }
        fetch('/admin/contacts/bulk-delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ contact_ids: contactIds })
        })
        .then(function (response) { return response.json(); })
        .then(function (data) {
            if (data.success) {
                showContactFlash('success', data.message || 'Contacts deleted successfully');
                setTimeout(function () { location.reload(); }, 700);
            } else {
                showContactFlash('error', data.message || 'Failed to delete contacts');
            }
        })
        .catch(function (error) {
            showContactFlash('error', 'Error deleting contacts: ' + error.message);
        });
    });
}

function exportContacts() {
    var params = new URLSearchParams(window.location.search);
    window.location.href = '/admin/contacts/export?' + params.toString();
}

function sendToBansalEmail(contactId) {
    var button = document.querySelector('[data-send-bansal-email][data-contact-id="' + contactId + '"]');
    if (button && button.disabled) {
        return;
    }

    window.adminConfirm({
        title: 'Forward to Bansal Email?',
        message: 'Send this contact query to info@bansallawyers.com.au for further processing?',
        confirmText: 'Send Email',
        variant: 'info',
        icon: 'send'
    }).then(function (confirmed) {
        if (!confirmed) {
            return;
        }

        if (button) {
            button.disabled = true;
            button.innerHTML = '<i data-lucide="loader-2" class="lucide-spin" aria-hidden="true"></i><span class="sr-only">Sending</span>';
            if (typeof window.refreshLucideIcons === 'function') {
                window.refreshLucideIcons(button);
            }
            button.classList.add('loading');
        }

        fetch('/admin/contacts/' + contactId + '/send-to-bansal-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(function (response) {
            if (!response.ok) {
                return response.json().then(function (data) {
                    throw new Error(data.message || 'Network response was not ok');
                });
            }
            return response.json();
        })
        .then(function (data) {
            if (data.success) {
                showContactFlash('success', data.message || 'Contact forwarded successfully');
                setTimeout(function () { location.reload(); }, 700);
            } else {
                showContactFlash('error', data.message || 'Failed to send email');
                restoreSendButton(button);
            }
        })
        .catch(function (error) {
            showContactFlash('error', error.message || 'Error sending to Bansal email. Please try again.');
            restoreSendButton(button);
        });
    });
}

function restoreSendButton(button) {
    if (!button) {
        return;
    }
    button.disabled = false;
    button.innerHTML = '<i data-lucide="send" aria-hidden="true"></i><span class="sr-only">Send Email</span>';
    button.classList.remove('loading');
    if (typeof window.refreshLucideIcons === 'function') {
        window.refreshLucideIcons(button);
    }
}

function bulkSendToBansalEmail() {
    var checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
    var contactIds = Array.from(checkedBoxes).map(function (cb) { return cb.value; });
    var button = document.getElementById('bulkSendToBansalBtn');

    if (contactIds.length === 0) {
        showContactFlash('warning', 'Please select contacts to send to Bansal email.');
        return;
    }

    if (button && button.disabled) {
        return;
    }

    window.adminConfirm({
        title: 'Forward Selected Contacts?',
        message: 'Send ' + contactIds.length + ' contact submission(s) to info@bansallawyers.com.au for further processing?',
        confirmText: 'Send ' + contactIds.length + ' Email(s)',
        variant: 'info',
        icon: 'send'
    }).then(function (confirmed) {
        if (!confirmed) {
            return;
        }

        if (button) {
            button.disabled = true;
            button.innerHTML = '<i data-lucide="loader-2" class="lucide-spin"></i> Sending...';
            button.classList.add('loading');
            if (typeof window.refreshLucideIcons === 'function') {
                window.refreshLucideIcons(button);
            }
        }

        fetch('/admin/contacts/bulk-send-to-bansal-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ contact_ids: contactIds })
        })
        .then(function (response) { return response.json(); })
        .then(function (data) {
            if (data.success) {
                showContactFlash('success', data.message || (data.count + ' contact(s) forwarded successfully'));
                setTimeout(function () { location.reload(); }, 700);
            } else {
                showContactFlash('error', data.message || 'Failed to send contacts');
                restoreBulkSendButton(button);
            }
        })
        .catch(function (error) {
            showContactFlash('error', 'Error sending contacts: ' + error.message);
            restoreBulkSendButton(button);
        });
    });
}

function restoreBulkSendButton(button) {
    if (!button) {
        return;
    }
    button.disabled = false;
    button.innerHTML = '<i data-lucide="send"></i> Send to Bansal Email';
    button.classList.remove('loading');
    if (typeof window.refreshLucideIcons === 'function') {
        window.refreshLucideIcons(button);
    }
}

window.updateContactStatus = updateContactStatus;
window.deleteContact = deleteContact;
window.bulkDelete = bulkDelete;
window.exportContacts = exportContacts;
window.sendToBansalEmail = sendToBansalEmail;
window.bulkSendToBansalEmail = bulkSendToBansalEmail;
window.toggleDropdown = toggleDropdown;
</script>
@endsection