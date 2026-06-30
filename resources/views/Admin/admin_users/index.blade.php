@extends('layouts.admin')
@section('title', 'Admin Users')

@section('content')
<style {!! \App\Services\CspService::getNonceAttribute() !!}>
/* Modern Admin Users Design System */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
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
    margin-bottom: 2rem;
}

.modern-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-2px);
}

.modern-card-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
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
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.modern-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    border: none;
    cursor: pointer;
    font-size: 0.875rem;
}

.modern-btn-primary {
    background: var(--accent-color);
    color: var(--white);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
}

.modern-btn-primary:hover {
    background: #e55a2b;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
    color: var(--white);
}

.modern-btn-secondary {
    background: var(--white);
    color: var(--text-dark);
    border: 2px solid var(--border-color);
}

.modern-btn-secondary:hover {
    background: var(--bg-light);
    border-color: var(--primary-color);
    color: var(--primary-color);
    transform: translateY(-1px);
}

.modern-search-form {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: var(--border-radius-sm);
    padding: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.modern-search-form .form-control {
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: var(--border-radius-sm);
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    transition: var(--transition);
}

.modern-search-form .form-control:focus {
    background: var(--white);
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

.modern-search-form .modern-btn {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.modern-table-container {
    background: var(--white);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.modern-table th {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1rem;
    font-weight: 600;
    color: var(--text-dark);
    border-bottom: 2px solid var(--border-color);
    text-align: left;
    position: relative;
}

.modern-table th::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
}

.modern-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--border-color);
    vertical-align: middle;
    transition: var(--transition);
}

.modern-table tbody tr:hover {
    background: var(--bg-light);
    transform: scale(1.001);
}

.modern-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.modern-badge-success {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success-color);
    border: 1px solid rgba(16, 185, 129, 0.2);
}

.modern-badge-danger {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger-color);
    border: 1px solid rgba(239, 68, 68, 0.2);
}

.modern-badge-warning {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning-color);
    border: 1px solid rgba(245, 158, 11, 0.2);
}

.modern-action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.modern-action-btn {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    font-size: 0.875rem;
}

.modern-action-btn:hover {
    transform: scale(1.1);
}

.modern-action-btn-edit {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.modern-action-btn-edit:hover {
    background: #3b82f6;
    color: var(--white);
}

.modern-action-btn-disable {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning-color);
}

.modern-action-btn-disable:hover {
    background: var(--warning-color);
    color: var(--white);
}

.modern-action-btn-enable {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success-color);
}

.modern-action-btn-enable:hover {
    background: var(--success-color);
    color: var(--white);
}

.modern-action-btn-archive {
    background: rgba(107, 114, 128, 0.1);
    color: #6b7280;
}

.modern-action-btn-archive:hover {
    background: #6b7280;
    color: var(--white);
}

.modern-action-btn-restore {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.modern-action-btn-restore:hover {
    background: #3b82f6;
    color: var(--white);
}

.modern-stats-card {
    background: var(--white);
    border-radius: var(--border-radius-sm);
    padding: 1.5rem;
    text-align: center;
    border: 1px solid var(--border-color);
    transition: var(--transition);
    min-width: 140px;
    flex: 0 0 auto;
    display: inline-block;
}

.modern-stats-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.stats-button-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stats-container {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    align-items: center;
}

.button-container {
    display: flex;
    align-items: center;
    margin-left: auto;
}

.filter-row {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.filter-item {
    flex: 0 0 auto;
}

.filter-item input.form-control {
    min-width: 250px;
}

.filter-item select.form-control {
    min-width: 150px;
}

.filter-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.modern-stats-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
    display: block;
}

.modern-stats-label {
    color: var(--text-light);
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.modern-pagination {
    background: var(--white);
    border-radius: var(--border-radius-sm);
    padding: 1rem 2rem;
    margin-top: 2rem;
    box-shadow: var(--shadow-sm);
}

.modern-no-data {
    text-align: center;
    padding: 3rem 2rem;
    color: var(--text-light);
}

.modern-no-data i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

@media (max-width: 768px) {
    .modern-header-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .modern-search-form {
        flex-direction: column;
        gap: 1rem;
    }
    
    .modern-search-form .form-group {
        margin-right: 0 !important;
        margin-bottom: 0.5rem;
    }
    
    .modern-action-buttons {
        flex-wrap: wrap;
    }
    
    .modern-table {
        font-size: 0.8rem;
    }
    
    .modern-table th,
    .modern-table td {
        padding: 0.75rem 0.5rem;
    }
}
</style>

<!-- Main Content -->
<div class="main-content modern-page-container">
    <section class="section">
        <div class="section-body">
            <div class="server-error">
                @include('Elements.flash-message')
            </div>
            <div class="custom-error-msg"></div>
            
            <div class="container-fluid">
                <!-- Header Card -->
                <div class="modern-card">
                    <div class="modern-card-header">
                        <h1 class="modern-card-title">
                            <i data-lucide="users"></i>
                            Admin Users Management
                        </h1>
                        <div class="modern-header-actions">
                            <!-- Quick Stats Row with Button -->
                            <div class="stats-button-row">
                                <div class="stats-container">
                                    <div class="modern-stats-card">
                                        <span class="modern-stats-number">{{ $totalData }}</span>
                                        <div class="modern-stats-label">Total Users</div>
                                    </div>
                                    <div class="modern-stats-card">
                                        <span class="modern-stats-number">{{ $lists->where('status', 1)->count() }}</span>
                                        <div class="modern-stats-label">Active</div>
                                    </div>
                                    <div class="modern-stats-card">
                                        <span class="modern-stats-number">{{ $lists->where('is_archived', 1)->count() }}</span>
                                        <div class="modern-stats-label">Archived</div>
                                    </div>
                                </div>
                                <div class="button-container">
                                    <a href="{{ route('admin.admin_users.create') }}" class="modern-btn modern-btn-primary">
                                        <i data-lucide="plus"></i> Add New Admin
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Search and Filter Form -->
                        <form method="GET" action="{{ route('admin.admin_users.index') }}" class="modern-search-form">
                            <div class="filter-row">
                                <div class="filter-item">
                                    <input type="text" name="search" class="form-control" placeholder="Search by name, email, company..." value="{{ request('search') }}">
                                </div>
                                <div class="filter-item">
                                    <select name="status" class="form-control">
                                        <option value="">All Status</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <div class="filter-item">
                                    <select name="archived" class="form-control">
                                        <option value="">All</option>
                                        <option value="0" {{ request('archived') == '0' ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ request('archived') == '1' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                </div>
                                <div class="filter-buttons">
                                    <button type="submit" class="modern-btn modern-btn-primary">
                                        <i data-lucide="search"></i> Filter
                                    </button>
                                    <a href="{{ route('admin.admin_users.index') }}" class="modern-btn modern-btn-secondary">
                                        <i data-lucide="refresh-cw"></i> Clear
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Table Card -->
                <div class="modern-card">
                    <div class="modern-table-container">
                        @if($totalData !== 0)
                            <table class="modern-table">
                                <thead>
                                    <tr>
                                        <th><i data-lucide="hash" class="me-2"></i>ID</th>
                                        <th><i data-lucide="user" class="me-2"></i>Name</th>
                                        <th><i data-lucide="mail" class="me-2"></i>Email</th>
                                        <th><i data-lucide="building-2" class="me-2"></i>Company</th>
                                        <th><i data-lucide="phone" class="me-2"></i>Phone</th>
                                        <th><i data-lucide="toggle-right" class="me-2"></i>Status</th>
                                        <th><i data-lucide="calendar" class="me-2"></i>Created</th>
                                        <th><i data-lucide="settings" class="me-2"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lists as $list)
                                        <tr id="id_{{$list->id}}">
                                            <td>
                                                <span class="fw-bold text-primary">#{{ $list->id }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-avatar me-3">
                                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: 600;">
                                                            {{ strtoupper(substr($list->first_name, 0, 1) . substr($list->last_name, 0, 1)) }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $list->first_name }} {{ $list->last_name }}</div>
                                                        <small class="text-muted">Admin User</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i data-lucide="mail" class="text-muted me-2"></i>
                                                    <span>{{ $list->email }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i data-lucide="building-2" class="text-muted me-2"></i>
                                                    <span>{{ $list->company_name ?? 'N/A' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i data-lucide="phone" class="text-muted me-2"></i>
                                                    <span>{{ $list->phone ?? 'N/A' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-1">
                                                    @if($list->status == 1)
                                                        <span class="modern-badge modern-badge-success">
                                                            <i data-lucide="circle-check"></i> Active
                                                        </span>
                                                    @else
                                                        <span class="modern-badge modern-badge-danger">
                                                            <i data-lucide="circle-x"></i> Inactive
                                                        </span>
                                                    @endif
                                                    @if($list->is_archived == 1)
                                                        <span class="modern-badge modern-badge-warning">
                                                            <i data-lucide="archive"></i> Archived
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i data-lucide="calendar" class="text-muted me-2"></i>
                                                    <div>
                                                        <div>{{ $list->created_at->format('M d, Y') }}</div>
                                                        <small class="text-muted">{{ $list->created_at->diffForHumans() }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="modern-action-buttons">
                                                    <a href="{{ route('admin.admin_users.edit', $list->id) }}" 
                                                       class="modern-action-btn modern-action-btn-edit" 
                                                       title="Edit User">
                                                        <i data-lucide="pencil"></i>
                                                    </a>
                                                    
                                                    @if($list->status == 1)
                                                        <button type="button" 
                                                                class="modern-action-btn modern-action-btn-disable" 
                                                                data-update-action
                                                                data-id="{{ $list->id }}"
                                                                data-status="1"
                                                                data-table="admins"
                                                                data-col="status"
                                                                title="Disable User">
                                                            <i data-lucide="ban"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" 
                                                                class="modern-action-btn modern-action-btn-enable" 
                                                                data-update-action
                                                                data-id="{{ $list->id }}"
                                                                data-status="0"
                                                                data-table="admins"
                                                                data-col="status"
                                                                title="Enable User">
                                                            <i data-lucide="check"></i>
                                                        </button>
                                                    @endif
                                                    
                                                    @if($list->is_archived == 0)
                                                        <button type="button" 
                                                                class="modern-action-btn modern-action-btn-archive" 
                                                                data-archive-action
                                                                data-id="{{ $list->id }}"
                                                                data-table="admins"
                                                                title="Archive User">
                                                            <i data-lucide="archive"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" 
                                                                class="modern-action-btn modern-action-btn-restore" 
                                                                data-archive-action
                                                                data-id="{{ $list->id }}"
                                                                data-table="admins"
                                                                title="Restore User">
                                                            <i data-lucide="undo-2"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="modern-no-data">
                                <i data-lucide="users"></i>
                                <h4>No Admin Users Found</h4>
                                <p>No admin users match your current search criteria.</p>
                                <a href="{{ route('admin.admin_users.create') }}" class="modern-btn modern-btn-primary mt-3">
                                    <i data-lucide="plus"></i> Add First Admin User
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Pagination -->
                @if($totalData > 0)
                    <div class="modern-pagination">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="modern-pagination-meta">
                                    <i data-lucide="info" class="me-2"></i>
                                    Showing {{ $lists->firstItem() }} to {{ $lists->lastItem() }} of {{ $totalData }} results
                                </p>
                            </div>
                            <div>
                                {{ $lists->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts')
<script {!! \App\Services\CspService::getNonceAttribute() !!}>
// Reuse existing updateAction and archiveAction functions from your system
function updateAction(id, currentStatus, table, column) {
    if (confirm('Are you sure you want to change the status?')) {
        $.ajax({
            url: '{{ route("admin.update_action") }}',
            type: 'POST',
            data: {
                id: id,
                current_status: currentStatus,
                table: table,
                colname: column,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status == 1) {
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    }
}

function archiveAction(id, table) {
    if (confirm('Are you sure you want to change the archive status?')) {
        $.ajax({
            url: '{{ route("admin.archive_action") }}',
            type: 'POST',
            data: {
                id: id,
                table: table,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status == 1) {
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    }
}
</script>
@endsection
