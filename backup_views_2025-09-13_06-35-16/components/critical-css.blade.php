{{-- Critical CSS for Above-the-Fold Content --}}
{{-- This CSS is inlined to prevent render-blocking and optimized for performance --}}
<style>{{-- Critical CSS Bundle - Optimized for Performance --}}
/* Reset and base styles */
*,*::before,*::after{box-sizing:border-box}body{margin:0;padding:0;font-family:'Poppins',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;line-height:1.6;color:#333;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}img{max-width:100%;height:auto}

/* Loading optimization */
.ftco-loader{position:fixed;left:0;top:0;width:100%;height:100%;z-index:9999;background:rgba(255,255,255,0.95);display:flex;align-items:center;justify-content:center;backdrop-filter:blur(2px)}.loader-spinner{width:40px;height:40px;border:3px solid #f3f3f3;border-top:3px solid #2a5298;border-radius:50%;animation:spin 1s linear infinite}@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}

/* Navigation critical styles */
.navbar{background:rgba(255,255,255,0.95);backdrop-filter:blur(10px);transition:all 0.3s ease;position:sticky;top:0;z-index:1000}.navbar.scrolled{background:rgba(255,255,255,0.98);box-shadow:0 2px 20px rgba(0,0,0,0.1)}

/* Hero section critical styles */
.hero-section{min-height:100vh;display:flex;align-items:center;background:linear-gradient(135deg,#1e3c72 0%,#2a5298 100%);color:white;position:relative;overflow:hidden}.hero-content{z-index:2;position:relative}.hero-title{font-size:3.5rem;font-weight:700;line-height:1.2;margin-bottom:1.5rem;opacity:0;animation:fadeInUp 1s ease-out 0.5s forwards}.hero-subtitle{font-size:1.25rem;margin-bottom:2rem;opacity:0;animation:fadeInUp 1s ease-out 0.7s forwards}.hero-cta{opacity:0;animation:fadeInUp 1s ease-out 0.9s forwards}

/* Critical animations */
@keyframes fadeInUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}

/* Button critical styles */
.btn{display:inline-block;padding:12px 24px;border:none;border-radius:6px;font-weight:500;text-decoration:none;cursor:pointer;transition:all 0.3s ease}.btn-primary{background:#2a5298;color:white}.btn-primary:hover{background:#1e3c72;transform:translateY(-2px)}

/* Accessibility and performance */
@media (prefers-reduced-motion: reduce){*,*::before,*::after{animation-duration:0.01ms!important;animation-iteration-count:1!important;transition-duration:0.01ms!important}}

/* Critical responsive styles */
@media (max-width:768px){.hero-title{font-size:2.5rem}.hero-subtitle{font-size:1.1rem}.navbar{padding:0.5rem 0}}

/* Font loading optimization */
@font-face{font-family:'Poppins';font-display:swap}

/* Critical layout utilities */
.container{max-width:1200px;margin:0 auto;padding:0 1rem}.d-flex{display:flex}.align-items-center{align-items:center}.justify-content-center{justify-content:center}.text-center{text-align:center}.w-100{width:100%}.h-100{height:100%}
</style>

{{-- Preload critical fonts --}}
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"></noscript>

{{-- Preload critical images --}}
@if(isset($heroImage))
<link rel="preload" as="image" href="{{ $heroImage }}">
@endif
