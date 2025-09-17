@extends('layouts.admin')
@section('title', 'Admin Users')

@section('content')

<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="server-error">
				@include('Elements.flash-message')
			</div>
			<div class="custom-error-msg"></div>
			<div class="row">
                <div class="col-12 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-header">
							<h4>Admin Users</h4>
							<div class="card-header-action">
								<a href="{{ route('admin.admin_users.create') }}" class="btn btn-primary">
									<i class="fa fa-plus"></i> Add New Admin
								</a>
							</div>
						</div>
                    </div> 
                </div>
				<div class="col-12 col-md-12 col-lg-12">
					<div class="card"> 
						<div class="card-header">
                            <div class="col-md-6">   
                                <div class="card-title">
                                    <h4>Admin Users List</h4>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <!-- Search and Filter Form -->
                                <form method="GET" action="{{ route('admin.admin_users.index') }}" class="form-inline float-right">
                                    <div class="form-group mr-2">
                                        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                                    </div>
                                    <div class="form-group mr-2">
                                        <select name="status" class="form-control">
                                            <option value="">All Status</option>
                                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <select name="archived" class="form-control">
                                            <option value="">All</option>
                                            <option value="0" {{ request('archived') == '0' ? 'selected' : '' }}>Active</option>
                                            <option value="1" {{ request('archived') == '1' ? 'selected' : '' }}>Archived</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i> Filter
                                    </button>
                                    <a href="{{ route('admin.admin_users.index') }}" class="btn btn-secondary ml-1">
                                        <i class="fa fa-refresh"></i> Clear
                                    </a>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive common_table">
                                <table class="table text_wrap table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Company</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    @if($totalData !== 0)
                                    <tbody class="tdata">
                                        @foreach ($lists as $list)
                                            <tr id="id_{{$list->id}}">
                                                <td>{{ $list->id }}</td>
                                                <td>
                                                    <strong>{{ $list->first_name }} {{ $list->last_name }}</strong>
                                                </td>
                                                <td>{{ $list->email }}</td>
                                                <td>{{ $list->company_name ?? 'N/A' }}</td>
                                                <td>{{ $list->phone ?? 'N/A' }}</td>
                                                <td>
                                                    @if($list->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                    @if($list->is_archived == 1)
                                                        <span class="badge badge-warning">Archived</span>
                                                    @endif
                                                </td>
                                                <td>{{ $list->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.admin_users.edit', $list->id) }}" 
                                                           class="btn btn-sm btn-primary" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        
                                                        @if($list->status == 1)
                                                            <button type="button" class="btn btn-sm btn-warning" 
                                                                    onclick="updateAction({{ $list->id }}, 1, 'admins', 'status')" 
                                                                    title="Disable">
                                                                <i class="fa fa-ban"></i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-sm btn-success" 
                                                                    onclick="updateAction({{ $list->id }}, 0, 'admins', 'status')" 
                                                                    title="Enable">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        @endif
                                                        
                                                        @if($list->is_archived == 0)
                                                            <button type="button" class="btn btn-sm btn-secondary" 
                                                                    onclick="archiveAction({{ $list->id }}, 'admins')" 
                                                                    title="Archive">
                                                                <i class="fa fa-archive"></i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-sm btn-info" 
                                                                    onclick="archiveAction({{ $list->id }}, 'admins')" 
                                                                    title="Restore">
                                                                <i class="fa fa-undo"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                    <tbody>
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <div class="alert alert-info">
                                                    <i class="fa fa-info-circle"></i> No admin users found.
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            @if($totalData > 0)
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <p class="text-muted">
                                            Showing {{ $lists->firstItem() }} to {{ $lists->lastItem() }} of {{ $totalData }} results
                                        </p>
                                    </div>
                                    <div>
                                        {{ $lists->appends(request()->query())->links() }}
                                    </div>
                                </div>
                            @endif
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
