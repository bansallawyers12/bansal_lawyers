<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="Bansal Lawyers">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Bansal Lawyers | Navigation Dashboard</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f8fafc;
    }
    
    .header-bar {
        background: white;
        padding: 1rem 2rem;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 100;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        text-decoration: none;
        color: #374151;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .back-btn:hover {
        background: #f1f5f9;
        color: #1f2937;
        text-decoration: none;
        border-color: #cbd5e0;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #374151;
        font-weight: 500;
    }
    
    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
    }
<style>
    .navigation-container {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 3rem 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .dashboard-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .dashboard-title {
        color: #1e293b;
        font-size: 3rem;
        font-weight: 700;
        margin: 0 0 1rem 0;
        text-shadow: none;
    }

    .dashboard-subtitle {
        color: #475569;
        font-size: 1.2rem;
        font-weight: 400;
        max-width: 600px;
        line-height: 1.6;
    }

.navigation-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    width: 100%;
}

    .nav-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        position: relative;
        overflow: hidden;
    }

    .nav-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    }

    .nav-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        border-color: #cbd5e0;
    }

.nav-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    color: white;
}

    .nav-icon.appointments { background: linear-gradient(135deg, #10b981, #059669); }
    .nav-icon.blogs { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
    .nav-icon.cms { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .nav-icon.cases { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .nav-icon.logout { background: linear-gradient(135deg, #ef4444, #dc2626); }

    .nav-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .nav-description {
        color: #475569;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
    }

.nav-links {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        text-decoration: none;
        color: #374151;
        font-weight: 500;
        transition: all 0.2s ease;
        font-size: 0.9rem;
    }

    .nav-link:hover {
        background: #f1f5f9;
        border-color: #cbd5e0;
        color: #1f2937;
        text-decoration: none;
        transform: translateX(4px);
    }

.nav-link-icon {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    flex-shrink: 0;
}

    .primary-action {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        margin-top: 1rem;
    }

    .primary-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        color: white;
        text-decoration: none;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
    }

    .logout-card {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }

    .logout-card .nav-title,
    .logout-card .nav-description {
        color: white;
    }

    .logout-card .primary-action {
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.2);
    }

    .logout-card .primary-action:hover {
        background: rgba(255,255,255,0.25);
        box-shadow: 0 8px 20px rgba(239,68,68, 0.3);
        color: white;
    }

@media (max-width: 768px) {
    .navigation-container { 
        padding: 2rem 1rem; 
    }
    
    .dashboard-title { 
        font-size: 2.2rem; 
    }
    
    .navigation-grid { 
        grid-template-columns: 1fr; 
        gap: 1.5rem;
    }
    
    .nav-card {
        padding: 1.5rem;
    }
}
</style>

<!-- Header Bar -->
<div class="header-bar">
    <div class="header-left">
        <div class="logo-section">
            <img src="<?php echo e(asset('images/logo/Bansal_Lawyers.png')); ?>" alt="Bansal Lawyers" style="height: 40px;">
        </div>
    </div>
    <div class="user-info">
        <div class="user-avatar">
            <?php echo e(strtoupper(substr(Auth::user()->first_name ?? 'A', 0, 1))); ?>

        </div>
        <span>Welcome, <?php echo e(Auth::user()->first_name ?? 'Admin'); ?></span>
    </div>
</div>

<div class="navigation-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title">Admin Portal</h1>
        <p class="dashboard-subtitle">Quick access to all administrative functions and management tools</p>
    </div>

    <div class="navigation-grid">
        <!-- Appointments Card -->
        <div class="nav-card">
            <div class="nav-icon appointments">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <h3 class="nav-title">Appointments</h3>
            <p class="nav-description">Manage client appointments, calendar bookings, and scheduling</p>
            
            <div class="nav-links">
                <a href="<?php echo e(route('appointments.index')); ?>" class="nav-link">
                    <i class="nav-link-icon fas fa-list"></i>
                    <span>Appointment Listings</span>
                </a>
                <a href="<?php echo e(URL::to('/admin/appointments-others')); ?>" class="nav-link">
                    <i class="nav-link-icon fas fa-calendar"></i>
                    <span>Ajay Calendar</span>
                </a>
                <a href="<?php echo e(route('admin.feature.appointmentdisabledate.index')); ?>" class="nav-link">
                    <i class="nav-link-icon fas fa-ban"></i>
                    <span>Block Time Slots</span>
                </a>
            </div>
            
            <a href="<?php echo e(route('appointments.index')); ?>" class="primary-action">
                <i class="fas fa-arrow-right"></i>
                Manage Appointments
            </a>
        </div>

        <!-- Blogs Card -->
        <div class="nav-card">
            <div class="nav-icon blogs">
                <i class="fas fa-blog"></i>
            </div>
            <h3 class="nav-title">Blogs Section</h3>
            <p class="nav-description">Create and manage blog content, categories, and publications</p>
            
            <div class="nav-links">
                <a href="<?php echo e(route('admin.blogcategory.index')); ?>" class="nav-link">
                    <i class="nav-link-icon fas fa-tags"></i>
                    <span>Blog Categories</span>
                </a>
                <a href="<?php echo e(route('admin.blog.index')); ?>" class="nav-link">
                    <i class="nav-link-icon fas fa-file-alt"></i>
                    <span>Blog Posts</span>
                </a>
            </div>
            
            <a href="<?php echo e(route('admin.blog.index')); ?>" class="primary-action">
                <i class="fas fa-arrow-right"></i>
                Manage Blogs
            </a>
        </div>

        <!-- CMS Pages Card -->
        <div class="nav-card">
            <div class="nav-icon cms">
                <i class="fas fa-file-code"></i>
								</div>
            <h3 class="nav-title">CMS Pages</h3>
            <p class="nav-description">Manage website content, pages, and static information</p>
            
            <div class="nav-links">
                <a href="<?php echo e(route('admin.cms_pages.index')); ?>" class="nav-link">
                    <i class="nav-link-icon fas fa-globe"></i>
                    <span>All CMS Pages</span>
                </a>
							</div>
            
            <a href="<?php echo e(route('admin.cms_pages.index')); ?>" class="primary-action">
                <i class="fas fa-arrow-right"></i>
                Manage CMS Pages
            </a>
						</div>

        <!-- Recent Case Studies Card -->
        <div class="nav-card">
            <div class="nav-icon cases">
                <i class="fas fa-gavel"></i>
            </div>
            <h3 class="nav-title">Case Studies</h3>
            <p class="nav-description">Manage recent case studies and legal precedents</p>
            
            <div class="nav-links">
                <a href="<?php echo e(route('admin.recent_case.index')); ?>" class="nav-link">
                    <i class="nav-link-icon fas fa-briefcase"></i>
                    <span>Recent Case Studies</span>
                </a>
						</div>
            
            <a href="<?php echo e(route('admin.recent_case.index')); ?>" class="primary-action">
                <i class="fas fa-arrow-right"></i>
                Manage Cases
            </a>
					</div>

        <!-- Logout Card -->
        <div class="nav-card logout-card">
            <div class="nav-icon logout">
                <i class="fas fa-sign-out-alt"></i>
				</div>
            <h3 class="nav-title">Logout</h3>
            <p class="nav-description">Safely exit the admin portal and end your session</p>
            
            <a href="<?php echo e(route('admin.logout')); ?>" 
               class="primary-action"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                Logout Now
            </a>
            
            <form action="<?php echo e(route('admin.logout')); ?>" name="admin_login" id="logout-form" method="post" style="display: none;">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e(Auth::user()->id); ?>">
            </form>
			</div>
		</div>
</div>

<script>
// Add some interactive functionality
document.addEventListener('DOMContentLoaded', function() {
    // Add click tracking for analytics (optional)
    const navLinks = document.querySelectorAll('.nav-link, .primary-action');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            console.log('Navigation clicked:', this.textContent.trim());
        });
    });
    
    // Add smooth scrolling for better UX
    document.documentElement.style.scrollBehavior = 'smooth';
});
</script>

</body>
</html>



<?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Admin/dashboard_experimental.blade.php ENDPATH**/ ?>