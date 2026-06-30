@extends('layouts.admin-login')

@section('title', 'Admin Login')

@section('content')
<div class="login-container">
	<div class="modern-login-card">
		<!-- Header Section -->
		<div class="modern-card-header">
			<div class="logo-section">
				<img src="{{ asset('images/logo/Bansal_Lawyers.png') }}" alt="Bansal Lawyers" />
			</div>
			<h1 class="modern-card-title">Admin Portal</h1>
			<p class="modern-card-subtitle">Secure access to your dashboard</p>
		</div>
		
		<!-- Form Section -->
		<div class="modern-card-body">
			<!-- Flash Messages -->
			<div class="modern-flash-messages">
				@if(session('success'))
					<div class="modern-alert success">
						<i data-lucide="circle-check"></i>
						{{ session('success') }}
					</div>
				@endif
				
				@if(session('error'))
					<div class="modern-alert error">
						<i data-lucide="circle-alert"></i>
						{{ session('error') }}
					</div>
				@endif
				
				@if(session('warning'))
					<div class="modern-alert warning">
						<i data-lucide="triangle-alert"></i>
						{{ session('warning') }}
					</div>
				@endif
			</div>
			
			<!-- Login Form -->
			<form action="{{ route('admin.login') }}" method="post" name="admin_login">
				@csrf
				
				<!-- Email Field -->
				<div class="modern-form-group">
					<label for="email" class="modern-form-label">
						<i data-lucide="mail"></i> Email Address
					</label>
					<input 
						id="email" 
						type="email" 
						class="modern-form-input @error('email') error @enderror" 
						name="email" 
						placeholder="Enter your email address"
						value="{{ (Cookie::get('email') != '' && !old('email')) ? Cookie::get('email') : old('email') }}" 
						required 
						autofocus
						tabindex="1"
					>
					@error('email')
						<div class="modern-error-message">
							<i data-lucide="circle-alert"></i>
							{{ $message }}
						</div>
					@enderror
				</div>
				
				<!-- Password Field -->
				<div class="modern-form-group">
					<label for="password" class="modern-form-label">
						<i data-lucide="lock"></i> Password
					</label>
					<input 
						id="password" 
						type="password" 
						class="modern-form-input @error('password') error @enderror" 
						name="password" 
						placeholder="Enter your password"
						value="{{ (Cookie::get('password') != '' && !old('password')) ? Cookie::get('password') : old('password') }}" 
						required
						tabindex="2"
					>
					@error('password')
						<div class="modern-error-message">
							<i data-lucide="circle-alert"></i>
							{{ $message }}
						</div>
					@enderror
				</div>
				
				<!-- Cloudflare Turnstile -->
				<input type="hidden" name="cf-turnstile-response" id="admin-turnstile-response" value="">
				<div class="modern-turnstile">
					<div
						class="cf-turnstile"
						data-sitekey="{{ config('services.turnstile.key') }}"
						data-callback="onAdminTurnstileSuccess"
						data-expired-callback="onAdminTurnstileExpired"
						data-error-callback="onAdminTurnstileExpired"
						data-response-field="false"
					></div>
				</div>
				<div class="modern-error-message" id="admin-turnstile-error" style="display: none; justify-content: center; margin-top: 12px;">
					<i data-lucide="circle-alert"></i>
					Please complete the security verification.
				</div>
				
				@error('cf-turnstile-response')
					<div class="modern-error-message" style="justify-content: center; margin-top: 12px;">
						<i data-lucide="circle-alert"></i>
						{{ $message }}
					</div>
				@enderror
				
				<!-- Remember Me Checkbox -->
				<div class="modern-checkbox-group">
					<div class="modern-checkbox">
						<input 
							type="checkbox" 
							name="remember" 
							id="remember-me" 
							tabindex="3"
							@if(Cookie::get('email') != '' && Cookie::get('password') != '') checked @endif
						>
						<label for="remember-me" class="modern-checkbox-label">
							<span class="modern-checkbox-custom"></span>
							Remember me for 30 days
						</label>
					</div>
				</div>
				
				<!-- Submit Button -->
				<button type="submit" class="modern-submit-btn" tabindex="4">
					<i data-lucide="log-in"></i>
					Sign In to Dashboard
				</button>
			</form>
		</div>
	</div>
	
	<!-- Footer Link -->
	<div class="modern-footer-link">
		<p class="modern-footer-text">
			<i data-lucide="shield"></i>
			Secure Admin Access Only
		</p>
	</div>
</div>
@endsection