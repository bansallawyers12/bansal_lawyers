@extends('layouts.frontend')

@section('title', 'Contact Form Test - Bansal Lawyers')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header" style="background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%); padding: 60px 0; color: white; text-align: center;">
                <h1 style="font-size: 2.5rem; font-weight: 700; margin: 0;">Contact Form Test Page</h1>
                <p style="font-size: 1.1rem; margin: 10px 0 0 0; opacity: 0.9;">Testing the new unified contact form system</p>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding: 60px 0;">
    <div class="row">
        <!-- Default Form -->
        <div class="col-lg-6 mb-5">
            <h2 class="mb-4">1. Default Form (New Design)</h2>
            @include('components.unified-contact-form', [
                'variant' => 'default',
                'title' => 'Speak with a Lawyer',
                'formId' => 'test-form-1',
                'showPhoto' => true
            ])
        </div>

        <!-- Compact Form (No Photo) -->
        <div class="col-lg-6 mb-5">
            <h2 class="mb-4">2. Compact Form (No Photo)</h2>
            @include('components.unified-contact-form', [
                'variant' => 'compact',
                'title' => 'Quick Contact',
                'formId' => 'test-form-2',
                'buttonText' => 'GET LEGAL ADVICE',
                'showPhoto' => false
            ])
        </div>

        <!-- Inline Form -->
        <div class="col-12 mb-5">
            <h2 class="mb-4">3. Inline Form (for embedding in content)</h2>
            <div style="background: #f8f9fa; padding: 30px; border-radius: 12px;">
                <p>This is some content above the form. The inline variant removes the background and padding to blend seamlessly with your content.</p>
                @include('components.unified-contact-form', [
                    'variant' => 'inline',
                    'title' => 'Contact Us',
                    'formId' => 'test-form-3',
                    'showTitle' => true,
                    'showPhoto' => false
                ])
                <p>This is some content below the form.</p>
            </div>
        </div>

        <!-- Floating Form Toggle -->
        <div class="col-12 mb-5">
            <h2 class="mb-4">4. Floating Form (Toggle Button)</h2>
            <p>Click the button below to test the floating form:</p>
            <button class="btn btn-primary" onclick="toggleFloatingForm()">
                <i class="fa fa-comments"></i> Open Floating Form
            </button>
        </div>

        <!-- Floating Form (No Photo) -->
        @include('components.unified-contact-form', [
            'variant' => 'floating',
            'title' => 'Quick Contact',
            'formId' => 'test-form-4',
            'showTitle' => true,
            'showPhoto' => false
        ])

        <!-- Form Variants Comparison -->
        <div class="col-12">
            <h2 class="mb-4">5. Form Variants Comparison</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4>Default</h4>
                    @include('components.unified-contact-form', [
                        'variant' => 'default',
                        'title' => 'Default',
                        'formId' => 'test-form-5',
                        'containerClass' => 'mb-0',
                        'showPhoto' => true
                    ])
                </div>
                <div class="col-md-4 mb-4">
                    <h4>Compact (No Photo)</h4>
                    @include('components.unified-contact-form', [
                        'variant' => 'compact',
                        'title' => 'Compact',
                        'formId' => 'test-form-6',
                        'containerClass' => 'mb-0',
                        'showPhoto' => false
                    ])
                </div>
                <div class="col-md-4 mb-4">
                    <h4>Inline (No Photo)</h4>
                    @include('components.unified-contact-form', [
                        'variant' => 'inline',
                        'title' => 'Inline',
                        'formId' => 'test-form-7',
                        'containerClass' => 'mb-0',
                        'showPhoto' => false
                    ])
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFloatingForm() {
    const floatingForm = document.getElementById('test-form-4-container');
    if (floatingForm) {
        floatingForm.style.display = floatingForm.style.display === 'none' ? 'block' : 'none';
    }
}

// Close floating form when clicking outside
document.addEventListener('click', function(e) {
    const floatingForm = document.getElementById('test-form-4-container');
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

h4 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 15px;
}
</style>
@endsection
