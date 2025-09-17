

<?php $__env->startSection('title', 'Admin Login'); ?>

<?php $__env->startSection('content'); ?>
<div class="login-container">
	<div class="modern-login-card">
		<!-- Header Section -->
		<div class="modern-card-header">
			<div class="logo-section">
				<img src="<?php echo e(asset('images/logo/Bansal_Lawyers.png')); ?>" alt="Bansal Lawyers" />
			</div>
			<h1 class="modern-card-title">Admin Portal</h1>
			<p class="modern-card-subtitle">Secure access to your dashboard</p>
		</div>
		
		<!-- Form Section -->
		<div class="modern-card-body">
			<!-- Flash Messages -->
			<div class="modern-flash-messages">
				<?php if(session('success')): ?>
					<div class="modern-alert success">
						<i class="fas fa-check-circle"></i>
						<?php echo e(session('success')); ?>

					</div>
				<?php endif; ?>
				
				<?php if(session('error')): ?>
					<div class="modern-alert error">
						<i class="fas fa-exclamation-circle"></i>
						<?php echo e(session('error')); ?>

					</div>
				<?php endif; ?>
				
				<?php if(session('warning')): ?>
					<div class="modern-alert warning">
						<i class="fas fa-exclamation-triangle"></i>
						<?php echo e(session('warning')); ?>

					</div>
				<?php endif; ?>
			</div>
			
			<!-- Login Form -->
			<form action="<?php echo e(route('admin.login')); ?>" method="post" name="admin_login">
				<?php echo csrf_field(); ?>
				
				<!-- Email Field -->
				<div class="modern-form-group">
					<label for="email" class="modern-form-label">
						<i class="fas fa-envelope"></i> Email Address
					</label>
					<input 
						id="email" 
						type="email" 
						class="modern-form-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
						name="email" 
						placeholder="Enter your email address"
						value="<?php echo e((Cookie::get('email') != '' && !old('email')) ? Cookie::get('email') : old('email')); ?>" 
						required 
						autofocus
						tabindex="1"
					>
					<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
						<div class="modern-error-message">
							<i class="fas fa-exclamation-circle"></i>
							<?php echo e($message); ?>

						</div>
					<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
				</div>
				
				<!-- Password Field -->
				<div class="modern-form-group">
					<label for="password" class="modern-form-label">
						<i class="fas fa-lock"></i> Password
					</label>
					<input 
						id="password" 
						type="password" 
						class="modern-form-input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
						name="password" 
						placeholder="Enter your password"
						value="<?php echo e((Cookie::get('password') != '' && !old('password')) ? Cookie::get('password') : old('password')); ?>" 
						required
						tabindex="2"
					>
					<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
						<div class="modern-error-message">
							<i class="fas fa-exclamation-circle"></i>
							<?php echo e($message); ?>

						</div>
					<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
				</div>
				
				<!-- reCAPTCHA -->
				<div class="modern-recaptcha">
					<div class="g-recaptcha" data-sitekey="<?php echo e(config('services.recaptcha.key')); ?>"></div>
				</div>
				
				<?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
					<div class="modern-error-message" style="justify-content: center; margin-top: 12px;">
						<i class="fas fa-exclamation-circle"></i>
						Captcha verification is required.
					</div>
				<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
				
				<!-- Remember Me Checkbox -->
				<div class="modern-checkbox-group">
					<div class="modern-checkbox">
						<input 
							type="checkbox" 
							name="remember" 
							id="remember-me" 
							tabindex="3"
							<?php if(Cookie::get('email') != '' && Cookie::get('password') != ''): ?> checked <?php endif; ?>
						>
						<label for="remember-me" class="modern-checkbox-label">
							<span class="modern-checkbox-custom"></span>
							Remember me for 30 days
						</label>
					</div>
				</div>
				
				<!-- Submit Button -->
				<button type="submit" class="modern-submit-btn" tabindex="4">
					<i class="fas fa-sign-in-alt"></i>
					Sign In to Dashboard
				</button>
			</form>
		</div>
	</div>
	
	<!-- Footer Link -->
	<div class="modern-footer-link">
		<p class="modern-footer-text">
			<i class="fas fa-shield-alt"></i>
			Secure Admin Access Only
		</p>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/auth/admin-login.blade.php ENDPATH**/ ?>