@extends('layouts.frontend')

@section('title', 'Contact Form Demo - Bansal Lawyers')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header" style="background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%); padding: 60px 0; color: white; text-align: center;">
                <h1 style="font-size: 2.5rem; font-weight: 700; margin: 0;">Contact Form Demo</h1>
                <p style="font-size: 1.1rem; margin: 10px 0 0 0; opacity: 0.9;">See how the new form looks in different contexts</p>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding: 60px 0;">
    <div class="row">
        <!-- Homepage-style Section -->
        <div class="col-12 mb-5">
            <h2 class="mb-4">Homepage Integration Example</h2>
            <div style="background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%); padding: 60px 30px; border-radius: 12px; color: white;">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 style="color: white; font-size: 2rem; font-weight: 700; margin-bottom: 20px;">Get Expert Legal Advice</h3>
                        <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem; margin-bottom: 30px;">Our experienced lawyers are here to help you with all your legal needs. Contact us today for a consultation.</p>
                        <ul style="color: rgba(255,255,255,0.9); list-style: none; padding: 0;">
                            <li style="margin-bottom: 10px;"><i class="fa fa-check" style="color: #4CAF50; margin-right: 10px;"></i> Free Initial Consultation</li>
                            <li style="margin-bottom: 10px;"><i class="fa fa-check" style="color: #4CAF50; margin-right: 10px;"></i> 24/7 Legal Support</li>
                            <li style="margin-bottom: 10px;"><i class="fa fa-check" style="color: #4CAF50; margin-right: 10px;"></i> Experienced Legal Team</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                            @include('components.unified-contact-form', [
                                'variant' => 'default',
                                'title' => 'Speak with a Lawyer',
                                'formId' => 'homepage-demo-form',
                                'showPhoto' => true,
                                'containerClass' => 'mb-0'
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Integration Example -->
        <div class="col-12 mb-5">
            <h2 class="mb-4">Sidebar Integration Example (No Photo)</h2>
            <div class="row">
                <div class="col-lg-8">
                    <div style="background: #f8f9fa; padding: 40px; border-radius: 12px; margin-bottom: 20px;">
                        <h3>Article Content</h3>
                        <p>This is an example of how the contact form would look when integrated into a sidebar or content area. The form maintains its professional appearance while fitting seamlessly into the page layout.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('components.unified-contact-form', [
                        'variant' => 'compact',
                        'title' => 'Get Legal Help',
                        'formId' => 'sidebar-demo-form',
                        'showPhoto' => false,
                        'containerClass' => 'mb-0'
                    ])
                </div>
            </div>
        </div>

        <!-- Floating Form Demo -->
        <div class="col-12 mb-5">
            <h2 class="mb-4">Floating Form Demo</h2>
            <div style="background: #f8f9fa; padding: 40px; border-radius: 12px; text-align: center;">
                <h3>Scroll down to see the floating form in action</h3>
                <p>This demonstrates how the floating form would appear on a page. It stays fixed in position and can be toggled on/off.</p>
                <button class="btn btn-primary btn-lg" onclick="toggleFloatingForm()">
                    <i class="fa fa-comments"></i> Toggle Floating Form
                </button>
            </div>
        </div>

        <!-- Mobile Responsive Demo -->
        <div class="col-12 mb-5">
            <h2 class="mb-4">Mobile Responsive Demo</h2>
            <div class="row">
                <div class="col-md-6">
                    <h4>Desktop View (With Photo)</h4>
                    @include('components.unified-contact-form', [
                        'variant' => 'default',
                        'title' => 'Speak with a Lawyer',
                        'formId' => 'desktop-demo-form',
                        'showPhoto' => true,
                        'containerClass' => 'mb-0'
                    ])
                </div>
                <div class="col-md-6">
                    <h4>Mobile View (No Photo)</h4>
                    @include('components.unified-contact-form', [
                        'variant' => 'compact',
                        'title' => 'Quick Contact',
                        'formId' => 'mobile-demo-form',
                        'showPhoto' => false,
                        'containerClass' => 'mb-0'
                    ])
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Form (No Photo) -->
@include('components.unified-contact-form', [
    'variant' => 'floating',
    'title' => 'Quick Contact',
    'formId' => 'floating-demo-form',
    'showTitle' => true,
    'showPhoto' => false
])

<script>
function toggleFloatingForm() {
    const floatingForm = document.getElementById('floating-demo-form-container');
    if (floatingForm) {
        floatingForm.style.display = floatingForm.style.display === 'none' ? 'block' : 'none';
    }
}

// Close floating form when clicking outside
document.addEventListener('click', function(e) {
    const floatingForm = document.getElementById('floating-demo-form-container');
    if (floatingForm && floatingForm.style.display === 'block') {
        if (!floatingForm.contains(e.target) && !e.target.closest('button[onclick="toggleFloatingForm()"]')) {
            floatingForm.style.display = 'none';
        }
    }
});
</script>

<style>
.page-header {
    margin-bottom: 0;
}

.container {
    max-width: 1200px;
}

h2 {
    color: #1B4D89;
    font-weight: 700;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 10px;
}

h3 {
    color: #495057;
    font-weight: 600;
}

h4 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 15px;
}
</style>
@endsection
