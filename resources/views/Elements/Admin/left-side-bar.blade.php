<style>
.modern-sidebar {
    width: 280px;
    background: white;
    box-shadow: 2px 0 10px rgba(0,0,0,0.08);
    border-right: 1px solid #e2e8f0;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 1000;
    overflow-y: auto;
}

.sidebar-brand {
    padding: 1.5rem;
    border-bottom: 1px solid #e2e8f0;
    background: #f8fafc;
}

.sidebar-brand img {
    height: 45px;
    width: auto;
}

.sidebar-menu {
    list-style: none;
    padding: 1rem 0;
    margin: 0;
}

.menu-section {
    padding: 0.5rem 1.5rem;
    margin-top: 1rem;
}

.menu-section:first-child {
    margin-top: 0;
}

.menu-section-title {
    font-size: 0.75rem;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.75rem;
}

.menu-item {
    margin-bottom: 0.25rem;
}

.menu-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.5rem;
    color: #374151;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
    border-radius: 0 25px 25px 0;
    margin-right: 1rem;
}

.menu-link:hover {
    background: #f1f5f9;
    color: #1e293b;
    text-decoration: none;
}

.menu-link.active {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
}

.menu-link.active:hover {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
}

.menu-icon {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}

.submenu {
    list-style: none;
    padding: 0;
    margin: 0;
    margin-left: 1rem;
    border-left: 2px solid #e2e8f0;
}

.submenu-item {
    margin-bottom: 0.125rem;
}

.submenu-link {
    display: block;
    padding: 0.5rem 1.5rem 0.5rem 2rem;
    color: #64748b;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    border-radius: 0 15px 15px 0;
    margin-right: 1rem;
}

.submenu-link:hover {
    background: #f8fafc;
    color: #374151;
    text-decoration: none;
}

.submenu-link.active {
    background: #e0f2fe;
    color: #0369a1;
    font-weight: 500;
}

.logout-section {
    margin-top: auto;
    padding: 1rem 1.5rem;
    border-top: 1px solid #e2e8f0;
}

.logout-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    color: #ef4444;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
    border-radius: 8px;
    border: 1px solid #fecaca;
    background: #fef2f2;
}

.logout-link:hover {
    background: #fee2e2;
    color: #dc2626;
    text-decoration: none;
}

@media (max-width: 768px) {
    .modern-sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .modern-sidebar.open {
        transform: translateX(0);
    }
}
</style>

<div class="modern-sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">
            <img alt="Bansal Lawyers" src="{{ asset('images/logo/Bansal_Lawyers.png') }}" />
        </a>
    </div>
    
    <ul class="sidebar-menu">
        <div class="menu-section">
            <div class="menu-section-title">Main</div>
            
            <li class="menu-item">
                <a href="{{ route('admin.dashboard') }}" 
                   class="menu-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                    <i class="menu-icon fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="#" 
                   class="menu-link {{ in_array(Route::currentRouteName(), ['appointments.index', 'appointments-others', 'admin.feature.appointmentdisabledate.index']) ? 'active' : '' }}"
                   onclick="toggleSubmenu('appointments')">
                    <i class="menu-icon fas fa-calendar-alt"></i>
                    <span>Appointments</span>
                    <i class="fas fa-chevron-down ml-auto" id="appointments-chevron"></i>
                </a>
                <ul class="submenu" id="appointments-submenu" style="display: {{ in_array(Route::currentRouteName(), ['appointments.index', 'appointments-others', 'admin.feature.appointmentdisabledate.index']) ? 'block' : 'none' }}">
                    <li class="submenu-item">
                        <a href="{{ route('appointments.index') }}" 
                           class="submenu-link {{ Route::currentRouteName() == 'appointments.index' ? 'active' : '' }}">
                            Appointment Listings
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ URL::to('/admin/appointments-others') }}" 
                           class="submenu-link {{ Route::currentRouteName() == 'appointments-others' ? 'active' : '' }}">
                            Ajay Calendar
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('admin.feature.appointmentdisabledate.index') }}" 
                           class="submenu-link {{ Route::currentRouteName() == 'admin.feature.appointmentdisabledate.index' ? 'active' : '' }}">
                            Block Time Slots
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="menu-item">
                <a href="#" 
                   class="menu-link"
                   onclick="toggleSubmenu('blogs')">
                    <i class="menu-icon fas fa-blog"></i>
                    <span>Blogs Section</span>
                    <i class="fas fa-chevron-down ml-auto" id="blogs-chevron"></i>
                </a>
                <ul class="submenu" id="blogs-submenu" style="display: none">
                    <li class="submenu-item">
                        <a href="{{ route('admin.blogcategory.index') }}" 
                           class="submenu-link {{ Route::currentRouteName() == 'admin.blogcategory.index' ? 'active' : '' }}">
                            Blog Categories
                        </a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{ route('admin.blog.index') }}" 
                           class="submenu-link {{ Route::currentRouteName() == 'admin.blog.index' ? 'active' : '' }}">
                            Blog Posts
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="menu-item">
                <a href="{{ route('admin.cms_pages.index') }}" 
                   class="menu-link {{ in_array(Route::currentRouteName(), ['admin.cms_pages.index', 'admin.cms_pages.create', 'admin.cms_pages.edit']) ? 'active' : '' }}">
                    <i class="menu-icon fas fa-file-code"></i>
                    <span>CMS Pages</span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="{{ route('admin.recent_case.index') }}" 
                   class="menu-link {{ in_array(Route::currentRouteName(), ['admin.recent_case.index', 'admin.recent_case.create', 'admin.recent_case.edit']) ? 'active' : '' }}">
                    <i class="menu-icon fas fa-gavel"></i>
                    <span>Case Studies</span>
                </a>
            </li>
        </div>
    </ul>
    
    <div class="logout-section">
        <a href="{{ route('admin.logout') }}" 
           class="logout-link"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="menu-icon fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
        <form action="{{ route('admin.logout') }}" name="admin_login" id="logout-form" method="post" style="display: none;">
            @csrf
            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
        </form>
    </div>
</div>

<script>
function toggleSubmenu(menuId) {
    const submenu = document.getElementById(menuId + '-submenu');
    const chevron = document.getElementById(menuId + '-chevron');
    
    if (submenu.style.display === 'none' || submenu.style.display === '') {
        submenu.style.display = 'block';
        chevron.style.transform = 'rotate(180deg)';
    } else {
        submenu.style.display = 'none';
        chevron.style.transform = 'rotate(0deg)';
    }
}

// Auto-expand submenus if current route is active
document.addEventListener('DOMContentLoaded', function() {
    const currentRoute = '{{ Route::currentRouteName() }}';
    
    if (['appointments.index', 'appointments-others', 'admin.feature.appointmentdisabledate.index'].includes(currentRoute)) {
        document.getElementById('appointments-submenu').style.display = 'block';
        document.getElementById('appointments-chevron').style.transform = 'rotate(180deg)';
    }
    
    if (['admin.blogcategory.index', 'admin.blog.index'].includes(currentRoute)) {
        document.getElementById('blogs-submenu').style.display = 'block';
        document.getElementById('blogs-chevron').style.transform = 'rotate(180deg)';
    }
});
</script>
