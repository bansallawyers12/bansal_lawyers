<!-- Step 4: Responsive Navigation with Mobile Menu -->
<style>
@media (max-width: 768px) {
    .desktop-menu {
        display: none !important;
    }
    .mobile-toggle {
        display: block !important;
    }
    .mobile-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: #1B4D89;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 1000;
    }
    .mobile-menu.show {
        display: block;
    }
    .mobile-menu a {
        display: block;
        padding: 15px 20px;
        color: white;
        text-decoration: none;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        font-weight: 500;
    }
    .mobile-menu a:hover {
        background-color: rgba(255,255,255,0.1);
        color: #ffd700;
    }
    .mobile-menu .cta-mobile {
        background-color: #007bff;
        text-align: center;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    /* Mobile logo adjustments */
    .logo-container {
        padding: 6px 10px !important;
    }
    .logo-container img {
        height: 45px !important;
    }
}

@media (min-width: 769px) {
    .mobile-toggle {
        display: none !important;
    }
    .mobile-menu {
        display: none !important;
    }
}
</style>

<nav style="background-color: #1B4D89; padding: 15px 0; box-shadow: 0 2px 5px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000;">
    <div style="max-width: 1200px; margin: 0 auto; width: 100%; display: flex; justify-content: space-between; align-items: center; padding: 0 20px;">
        <!-- Logo -->
        <a href="{{ url('/') }}" style="text-decoration: none;">
            <div class="logo-container" style="background-color: white; padding: 8px 12px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: inline-block;">
                <img src="{{ asset('images/logo/Bansal_Lawyers_origional.png') }}" alt="Bansal Lawyers" style="height: 55px; display: block; max-width: 100%;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" onload="console.log('Logo loaded successfully');">
                <div style="display: none; color: #1B4D89; font-weight: bold; font-size: 18px; text-align: center; line-height: 55px;">
                    BANSAL<br><span style="font-size: 14px;">LAWYERS</span>
                </div>
            </div>
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="mobile-toggle" onclick="toggleMobileMenu()" style="display: none; background: none; border: none; color: white; font-size: 24px; cursor: pointer;">
            ☰
        </button>
        
        <!-- Desktop Menu Items -->
        <div class="desktop-menu" style="display: flex; gap: 25px; align-items: center;">
            <a href="{{ url('/about') }}" style="color: white; text-decoration: none; font-weight: 500; padding: 8px 12px; border-radius: 4px; transition: all 0.3s ease;" onmouseover="this.style.color='#ffd700'; this.style.backgroundColor='rgba(255,255,255,0.1)'" onmouseout="this.style.color='white'; this.style.backgroundColor='transparent'">About</a>
            <a href="{{ url('/practice-areas') }}" style="color: white; text-decoration: none; font-weight: 500; padding: 8px 12px; border-radius: 4px; transition: all 0.3s ease;" onmouseover="this.style.color='#ffd700'; this.style.backgroundColor='rgba(255,255,255,0.1)'" onmouseout="this.style.color='white'; this.style.backgroundColor='transparent'">Practice Areas</a>
            <a href="{{ url('/case') }}" style="color: white; text-decoration: none; font-weight: 500; padding: 8px 12px; border-radius: 4px; transition: all 0.3s ease;" onmouseover="this.style.color='#ffd700'; this.style.backgroundColor='rgba(255,255,255,0.1)'" onmouseout="this.style.color='white'; this.style.backgroundColor='transparent'">Recent Cases</a>
            <a href="{{ url('/blog') }}" style="color: white; text-decoration: none; font-weight: 500; padding: 8px 12px; border-radius: 4px; transition: all 0.3s ease;" onmouseover="this.style.color='#ffd700'; this.style.backgroundColor='rgba(255,255,255,0.1)'" onmouseout="this.style.color='white'; this.style.backgroundColor='transparent'">Blog</a>
            <a href="{{ url('/contact') }}" style="color: white; text-decoration: none; font-weight: 500; padding: 8px 12px; border-radius: 4px; transition: all 0.3s ease;" onmouseover="this.style.color='#ffd700'; this.style.backgroundColor='rgba(255,255,255,0.1)'" onmouseout="this.style.color='white'; this.style.backgroundColor='transparent'">Contact</a>
            <a href="{{ url('/book-an-appointment') }}" style="background-color: #007bff; color: white; text-decoration: none; padding: 12px 20px; border-radius: 25px; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#0056b3'; this.style.transform='translateY(-2px)'" onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='translateY(0)'">Schedule Consultation</a>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ url('/about') }}">About</a>
        <a href="{{ url('/practice-areas') }}">Practice Areas</a>
        <a href="{{ url('/case') }}">Recent Cases</a>
        <a href="{{ url('/blog') }}">Blog</a>
        <a href="{{ url('/contact') }}">Contact</a>
        <a href="{{ url('/book-an-appointment') }}" class="cta-mobile">Schedule Consultation</a>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    if (mobileMenu.classList.contains('show')) {
        mobileMenu.classList.remove('show');
    } else {
        mobileMenu.classList.add('show');
    }
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileToggle = document.querySelector('.mobile-toggle');
    
    if (!mobileMenu.contains(event.target) && !mobileToggle.contains(event.target)) {
        mobileMenu.classList.remove('show');
    }
});
</script>
