<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="#">
				<img alt="Bansal Lawyers" src="<?php echo e(asset('images/logo/Bansal_Lawyers.png')); ?>" class="header-logo" />
				
				<!--<span class="logo-name"></span>-->
			</a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">Main</li>
            <?php if(Route::currentRouteName() == 'admin.dashboard'){
                $dashclasstype = 'active';
            } ?>
			<li class="dropdown <?php echo e(@$dashclasstype); ?>">
				<a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
			</li>
          
          
            <?php
            //echo Route::currentRouteName();
            if( Route::currentRouteName() == 'appointments.index'  || Route::currentRouteName() == 'appointments-others' || Route::currentRouteName() == 'admin.feature.appointmentdisabledate.index'){
				$appointmentsclasstype = 'active';
			}
			?>

			<li class="dropdown <?php echo e(@$appointmentsclasstype); ?>">
				<a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file-text"></i><span>Appointments</span></a>
				<ul class="dropdown-menu">
				    <li class=""><a class="nav-link" href="<?php echo e(route('appointments.index')); ?>">Listings</a></li>

                    <li class="<?php echo e((Route::currentRouteName() == 'appointments-others') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(URL::to('/admin/appointments-others')); ?>">Ajay Calendar</a></li>
                    <?php
                    // admin-only panel; show always for authenticated admins
                    ?>
                    <li class="<?php echo e((Route::currentRouteName() == 'admin.feature.appointmentdisabledate.index' ) ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(route('admin.feature.appointmentdisabledate.index')); ?>">Block Slot</a></li>
                </ul>
            </li>

            <?php // admin-only panel; show always for authenticated admins ?>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                data-feather="briefcase"></i><span>Blogs section</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a class="nav-link" href="<?php echo e(route('admin.blogcategory.index')); ?>">Blogs Category</a></li>
                    <li class=""><a class="nav-link" href="<?php echo e(route('admin.blog.index')); ?>">Blogs</a></li>
                </ul>
            </li>

            <?php // admin-only panel; show always for authenticated admins ?>
                <?php if(Route::currentRouteName() == 'admin.cms_pages.index' || Route::currentRouteName() == 'admin.cms_pages.create' || Route::currentRouteName() == 'admin.cms_pages.edit'): ?>
                 <?php	$cmsclasstype = 'active'; ?>
                <?php endif; ?>

                <li class="dropdown <?php echo e(@$cmsclasstype); ?>">
                    <a href="<?php echo e(route('admin.cms_pages.index')); ?>" class="nav-link"><i data-feather="briefcase"></i><span>CMS Pages</span></a>
                </li>
          
          
                <?php if(Route::currentRouteName() == 'admin.recent_case.index' || Route::currentRouteName() == 'admin.recent_case.create' || Route::currentRouteName() == 'admin.recent_case.edit'): ?>
                 <?php	$recentcaseclasstype = 'active'; ?>
                <?php endif; ?>

                <li class="dropdown <?php echo e(@$recentcaseclasstype); ?>">
                    <a href="<?php echo e(route('admin.recent_case.index')); ?>" class="nav-link"><i data-feather="briefcase"></i><span>Recent Case Studies</span></a>
                </li>

            <li class="dropdown">
                <a href="<?php echo e(route('admin.logout')); ?>" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i><span>Logout</span></a>
                <form action="admin/logout" name="admin_login" id="logout-form" method="post">
                <input type="hidden" name="id" value="<?php echo e(Auth::user()->id); ?>">
                </form>
            </li>
        </ul>
    </aside>
</div>
<?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views////Elements/Admin/left-side-bar.blade.php ENDPATH**/ ?>