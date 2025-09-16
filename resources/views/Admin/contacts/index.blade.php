@extends('layouts.admin')
@section('title', 'Contact Management')

@section('content')
<!-- Main Content -->
<div class="main-content">
	<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Contact Form Submissions</h4>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="exportContacts()">
                            <i class="fas fa-download"></i> Export CSV
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="bulkSendToBansalEmail()" id="bulkSendToBansalBtn" style="display: none;">
                            <i class="fas fa-envelope"></i> Send to Bansal Email
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="bulkDelete()" id="bulkDeleteBtn" style="display: none;">
                            <i class="fas fa-trash"></i> Delete Selected
                        </button>
                    </div>
                </div>
                
                <!-- Statistics Cards -->
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">Total Contacts</h5>
                                            <h3>{{ $stats['total'] }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-envelope fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">Today</h5>
                                            <h3>{{ $stats['today'] }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-calendar-day fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">This Week</h5>
                                            <h3>{{ $stats['this_week'] }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-calendar-week fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">This Month</h5>
                                            <h3>{{ $stats['this_month'] }}</h3>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-calendar-alt fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filters -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.contacts.index') }}" id="filterForm">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="search">Search</label>
                                        <input type="text" class="form-control" id="search" name="search" 
                                               value="{{ request('search') }}" placeholder="Name, email, subject...">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="date_from">From Date</label>
                                        <input type="date" class="form-control" id="date_from" name="date_from" 
                                               value="{{ request('date_from') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="date_to">To Date</label>
                                        <input type="date" class="form-control" id="date_to" name="date_to" 
                                               value="{{ request('date_to') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="">All Status</option>
                                            <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
                                            <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>&nbsp;</label>
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary mr-2">
                                                <i class="fas fa-search"></i> Filter
                                            </button>
                                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-times"></i> Clear
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Contacts Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="30">
                                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Submitted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                <tr class="{{ $contact->status == 'unread' ? 'font-weight-bold' : '' }}">
                                    <td>
                                        <input type="checkbox" class="contact-checkbox" value="{{ $contact->id }}">
                                    </td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->contact_email }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($contact->subject, 50) }}</td>
                                    <td>
                                        @if($contact->status === 'forwarded')
                                            <span class="badge badge-info">
                                                <i class="fas fa-paper-plane"></i> Forwarded
                                            </span>
                                            @if($contact->forwarded_at)
                                                <br><small class="text-muted">{{ $contact->forwarded_at->format('d/m/Y H:i') }}</small>
                                            @endif
                                        @else
                                            <span class="badge badge-{{ $contact->status == 'unread' ? 'danger' : ($contact->status == 'resolved' ? 'success' : ($contact->status == 'archived' ? 'secondary' : 'info')) }}">
                                                {{ ucfirst($contact->status ?? 'unread') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.contacts.show', $contact->id) }}" 
                                               class="btn btn-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($contact->status === 'forwarded')
                                                <button type="button" class="btn btn-secondary btn-sm" disabled title="Already Forwarded">
                                                    <i class="fas fa-check"></i> Forwarded
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-primary btn-sm" 
                                                        onclick="sendToBansalEmail({{ $contact->id }})" title="Send to Bansal Email">
                                                    <i class="fas fa-paper-plane"></i>
                                                </button>
                                            @endif
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm dropdown-toggle" 
                                                        data-toggle="dropdown" title="Change Status">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#" onclick="updateStatus({{ $contact->id }}, 'read')">Mark as Read</a>
                                                    <a class="dropdown-item" href="#" onclick="updateStatus({{ $contact->id }}, 'resolved')">Mark as Resolved</a>
                                                    <a class="dropdown-item" href="#" onclick="updateStatus({{ $contact->id }}, 'archived')">Archive</a>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm" 
                                                    onclick="deleteContact({{ $contact->id }})" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No contacts found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
	</section>
</div>


@endsection

@section('scripts')
<script>
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.contact-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const bulkSendToBansalBtn = document.getElementById('bulkSendToBansalBtn');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    bulkSendToBansalBtn.style.display = selectAll.checked ? 'block' : 'none';
    bulkDeleteBtn.style.display = selectAll.checked ? 'block' : 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.contact-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
            const bulkSendToBansalBtn = document.getElementById('bulkSendToBansalBtn');
            bulkSendToBansalBtn.style.display = checkedBoxes.length > 0 ? 'block' : 'none';
            bulkDeleteBtn.style.display = checkedBoxes.length > 0 ? 'block' : 'none';
        });
    });
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
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
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
                    button.innerHTML = '<i class="fas fa-paper-plane"></i> Send to Bansal Email';
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
                }
            }
        })
        .catch(error => {
            alert('Error sending contacts to Bansal email: ' + error.message);
            // Re-enable button on error
            if (button) {
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-paper-plane"></i> Send to Bansal Email';
            }
        });
    }
}
</script>
@endsection
