@extends('layouts.admin')
@section('title', 'Edit Admin User')

@section('content')
<style {!! \App\Services\CspService::getNonceAttribute() !!}>
/* Modern Edit Admin User Design System */
:root {
    --primary-color: #1B4D89;
    --secondary-color: #2c5aa0;
    --accent-color: #FF6B35;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --info-color: #3b82f6;
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
    margin-top: 1rem;
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
    text-decoration: none;
}

.modern-form-container {
    background: var(--white);
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--shadow-sm);
}

.modern-form-group {
    margin-bottom: 1.5rem;
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

.modern-form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    transition: var(--transition);
    background: var(--white);
}

.modern-form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(27, 77, 137, 0.1);
}

.modern-form-control.is-invalid {
    border-color: var(--danger-color);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.modern-invalid-feedback {
    color: var(--danger-color);
    font-size: 0.75rem;
    margin-top: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.modern-form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border-color);
}

.modern-breadcrumb {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: var(--border-radius-sm);
    padding: 0.75rem 1.5rem;
    margin-bottom: 1rem;
    position: relative;
    z-index: 2;
}

.modern-breadcrumb-item {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-size: 0.875rem;
}

.modern-breadcrumb-item:hover {
    color: var(--white);
    text-decoration: none;
}

.modern-breadcrumb-item.active {
    color: var(--white);
    font-weight: 600;
}

.modern-info-card {
    background: linear-gradient(135deg, var(--info-color) 0%, #1e40af 100%);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    color: var(--white);
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
}

.modern-info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="info-grain" width="50" height="50" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23info-grain)"/></svg>');
    opacity: 0.3;
}

.modern-info-card-content {
    position: relative;
    z-index: 2;
}

.modern-info-card h6 {
    color: var(--white);
    font-weight: 700;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modern-info-card p {
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 0.5rem;
}

.modern-info-card .badge {
    background: rgba(255, 255, 255, 0.2);
    color: var(--white);
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
}

.modern-form-help {
    font-size: 0.75rem;
    color: var(--text-light);
    margin-top: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.modern-user-avatar {
    position: relative;
    z-index: 2;
    margin-top: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.modern-avatar-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--white);
    border: 3px solid rgba(255, 255, 255, 0.3);
}

.modern-user-info h5 {
    color: var(--white);
    margin: 0;
    font-weight: 700;
}

.modern-user-info p {
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
    font-size: 0.875rem;
}

@media (max-width: 768px) {
    .modern-header-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .modern-form-actions {
        flex-direction: column;
    }
    
    .modern-form-container {
        padding: 1.5rem;
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
                            <i data-lucide="user-pen"></i>
                            Edit Admin User
                        </h1>
                        
                        <!-- User Avatar and Info -->
                        <div class="modern-user-avatar">
                            <div class="modern-avatar-circle">
                                {{ strtoupper(substr($admin->first_name, 0, 1) . substr($admin->last_name, 0, 1)) }}
                            </div>
                            <div class="modern-user-info">
                                <h5>{{ $admin->first_name }} {{ $admin->last_name }}</h5>
                                <p>{{ $admin->email }}</p>
                            </div>
                        </div>
                        
                        <!-- Breadcrumb -->
                        <div class="modern-breadcrumb">
                            <a href="{{ route('admin.admin_users.index') }}" class="modern-breadcrumb-item">
                                <i data-lucide="users" class="me-1"></i> Admin Users
                            </a>
                            <span class="mx-2">/</span>
                            <span class="modern-breadcrumb-item active">Edit User #{{ $admin->id }}</span>
                        </div>
                        
                        <div class="modern-header-actions">
                            <div></div>
                            <a href="{{ route('admin.admin_users.index') }}" class="modern-btn modern-btn-secondary">
                                <i data-lucide="arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Admin Information Card -->
                <div class="modern-info-card">
                    <div class="modern-info-card-content">
                        <h6><i data-lucide="info"></i> Admin Information</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>User ID:</strong> #{{ $admin->id }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Created:</strong> {{ $admin->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Last Updated:</strong> {{ $admin->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        @if($admin->is_archived == 1)
                            <p><strong>Archive Status:</strong> <span class="badge">Archived</span></p>
                        @endif
                    </div>
                </div>

                <!-- Form Card -->
                <div class="modern-card">
                    <div class="modern-form-container">
                        <form action="{{ route('admin.admin_users.update', $admin->id) }}" method="post" name="edit_admin_user">
                            @csrf
                            
                            <!-- Personal Information Section -->
                            <div class="mb-4">
                                <h3 class="text-primary mb-3">
                                    <i data-lucide="user" class="me-2"></i>Personal Information
                                </h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label class="modern-form-label">
                                                <i data-lucide="user" class="me-1"></i>First Name
                                                <span class="required">*</span>
                                            </label>
                                            <input name="first_name" type="text" 
                                                   class="modern-form-control @error('first_name') is-invalid @enderror" 
                                                   value="{{ old('first_name', $admin->first_name) }}" 
                                                   data-valid="required" 
                                                   placeholder="Enter first name">
                                            @error('first_name')
                                                <div class="modern-invalid-feedback">
                                                    <i data-lucide="circle-alert"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label class="modern-form-label">
                                                <i data-lucide="user" class="me-1"></i>Last Name
                                            </label>
                                            <input name="last_name" type="text" 
                                                   class="modern-form-control @error('last_name') is-invalid @enderror" 
                                                   value="{{ old('last_name', $admin->last_name) }}" 
                                                   placeholder="Enter last name">
                                            @error('last_name')
                                                <div class="modern-invalid-feedback">
                                                    <i data-lucide="circle-alert"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Contact Information Section -->
                            <div class="mb-4">
                                <h3 class="text-primary mb-3">
                                    <i data-lucide="book-user" class="me-2"></i>Contact Information
                                </h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label class="modern-form-label">
                                                <i data-lucide="mail" class="me-1"></i>Email Address
                                                <span class="required">*</span>
                                            </label>
                                            <input name="email" type="email" 
                                                   class="modern-form-control @error('email') is-invalid @enderror" 
                                                   value="{{ old('email', $admin->email) }}" 
                                                   data-valid="required email" 
                                                   placeholder="Enter email address">
                                            @error('email')
                                                <div class="modern-invalid-feedback">
                                                    <i data-lucide="circle-alert"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label class="modern-form-label">
                                                <i data-lucide="phone" class="me-1"></i>Phone Number
                                            </label>
                                            <input name="phone" type="text" 
                                                   class="modern-form-control @error('phone') is-invalid @enderror" 
                                                   value="{{ old('phone', $admin->phone) }}" 
                                                   placeholder="Enter phone number">
                                            @error('phone')
                                                <div class="modern-invalid-feedback">
                                                    <i data-lucide="circle-alert"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Company & Status Section -->
                            <div class="mb-4">
                                <h3 class="text-primary mb-3">
                                    <i data-lucide="building-2" class="me-2"></i>Company & Status
                                </h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label class="modern-form-label">
                                                <i data-lucide="building-2" class="me-1"></i>Company Name
                                            </label>
                                            <input name="company_name" type="text" 
                                                   class="modern-form-control @error('company_name') is-invalid @enderror" 
                                                   value="{{ old('company_name', $admin->company_name) }}" 
                                                   placeholder="Enter company name">
                                            @error('company_name')
                                                <div class="modern-invalid-feedback">
                                                    <i data-lucide="circle-alert"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label class="modern-form-label">
                                                <i data-lucide="toggle-right" class="me-1"></i>Status
                                                <span class="required">*</span>
                                            </label>
                                            <select name="status" 
                                                    class="modern-form-control @error('status') is-invalid @enderror" 
                                                    data-valid="required">
                                                <option value="">Select Status</option>
                                                <option value="1" {{ old('status', $admin->status) == '1' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0" {{ old('status', $admin->status) == '0' ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="modern-invalid-feedback">
                                                    <i data-lucide="circle-alert"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Security Section -->
                            <div class="mb-4">
                                <h3 class="text-primary mb-3">
                                    <i data-lucide="shield" class="me-2"></i>Security Settings
                                </h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label class="modern-form-label">
                                                <i data-lucide="lock" class="me-1"></i>New Password
                                            </label>
                                            <input name="password" type="password" 
                                                   class="modern-form-control @error('password') is-invalid @enderror" 
                                                   placeholder="Enter new password">
                                            <div class="modern-form-help">
                                                <i data-lucide="info"></i>
                                                Leave blank to keep current password
                                            </div>
                                            @error('password')
                                                <div class="modern-invalid-feedback">
                                                    <i data-lucide="circle-alert"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="modern-form-group">
                                            <label class="modern-form-label">
                                                <i data-lucide="lock" class="me-1"></i>Confirm New Password
                                            </label>
                                            <input name="password_confirmation" type="password" 
                                                   class="modern-form-control @error('password_confirmation') is-invalid @enderror" 
                                                   placeholder="Confirm new password">
                                            @error('password_confirmation')
                                                <div class="modern-invalid-feedback">
                                                    <i data-lucide="circle-alert"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Form Actions -->
                            <div class="modern-form-actions">
                                <a href="{{ route('admin.admin_users.index') }}" class="modern-btn modern-btn-secondary">
                                    <i data-lucide="x"></i> Cancel
                                </a>
                                <button type="button" class="modern-btn modern-btn-primary" data-custom-validate="edit_admin_user">
                                    <i data-lucide="save"></i> Update Admin User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts')
<script {!! \App\Services\CspService::getNonceAttribute() !!}>
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
