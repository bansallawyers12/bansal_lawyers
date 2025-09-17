@extends('layouts.admin')
@section('title', 'Edit Admin User')

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
							<h4>Edit Admin User</h4>
							<div class="card-header-action">
								<a href="{{ route('admin.admin_users.index') }}" class="btn btn-secondary">
									<i class="fa fa-arrow-left"></i> Back to List
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
                                    <h4>Admin User Information</h4>
                                </div> 
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.admin_users.update', $admin->id) }}" method="post" name="edit_admin_user">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name <span style="color:#ff0000;">*</span></label>
                                            <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                                   value="{{ old('first_name', $admin->first_name) }}" data-valid="required" placeholder="Enter first name">
                                            @error('first_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                                   value="{{ old('last_name', $admin->last_name) }}" placeholder="Enter last name">
                                            @error('last_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email Address <span style="color:#ff0000;">*</span></label>
                                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   value="{{ old('email', $admin->email) }}" data-valid="required email" placeholder="Enter email address">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" 
                                                   value="{{ old('phone', $admin->phone) }}" placeholder="Enter phone number">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_name">Company Name</label>
                                            <input name="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" 
                                                   value="{{ old('company_name', $admin->company_name) }}" placeholder="Enter company name">
                                            @error('company_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status <span style="color:#ff0000;">*</span></label>
                                            <select name="status" class="form-control @error('status') is-invalid @enderror" data-valid="required">
                                                <option value="">Select Status</option>
                                                <option value="1" {{ old('status', $admin->status) == '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $admin->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">New Password</label>
                                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                                   placeholder="Enter new password (leave blank to keep current)">
                                            <small class="form-text text-muted">Leave blank to keep current password</small>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm New Password</label>
                                            <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                                   placeholder="Confirm new password">
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Admin Info Display -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <h6><i class="fa fa-info-circle"></i> Admin Information</h6>
                                            <p><strong>Created:</strong> {{ $admin->created_at->format('M d, Y H:i') }}</p>
                                            <p><strong>Last Updated:</strong> {{ $admin->updated_at->format('M d, Y H:i') }}</p>
                                            @if($admin->is_archived == 1)
                                                <p><strong>Status:</strong> <span class="badge badge-warning">Archived</span></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group text-right">
                                    <a href="{{ route('admin.admin_users.index') }}" class="btn btn-secondary mr-2">
                                        <i class="fa fa-times"></i> Cancel
                                    </a>
                                    <button type="button" class="btn btn-primary" onClick="customValidate('edit_admin_user')">
                                        <i class="fa fa-save"></i> Update Admin User
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

@endsection

@section('scripts')
<script>
// Form validation using your existing customValidate function
function customValidate(formName) {
    var form = document.forms[formName];
    var isValid = true;
    
    // Basic validation
    var requiredFields = form.querySelectorAll('[data-valid*="required"]');
    requiredFields.forEach(function(field) {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    // Email validation
    var emailField = form.querySelector('input[name="email"]');
    if (emailField && emailField.value) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailField.value)) {
            emailField.classList.add('is-invalid');
            isValid = false;
        }
    }
    
    // Password confirmation validation (only if password is provided)
    var password = form.querySelector('input[name="password"]').value;
    var passwordConfirmation = form.querySelector('input[name="password_confirmation"]').value;
    
    if (password && password !== passwordConfirmation) {
        form.querySelector('input[name="password_confirmation"]').classList.add('is-invalid');
        isValid = false;
    }
    
    if (isValid) {
        form.submit();
    } else {
        alert('Please fill in all required fields correctly.');
    }
}
</script>
@endsection
