@extends('layouts.admin-minimal')
@section('title', 'Admin Dashboard Test')

@section('content')
<div class="success">
    <h2>✅ Admin Dashboard Test Page</h2>
    <p>If you can see this page, the basic Laravel routing and view system is working correctly.</p>
    
    <h3>Test Results:</h3>
    <ul>
        <li>✅ Blade templating: Working</li>
        <li>✅ CSS styling: Working</li>
        <li>✅ Basic HTML: Working</li>
        <li id="js-test-item">⏳ JavaScript: Testing...</li>
    </ul>
    
    <h3>Next Steps:</h3>
    <p>If this page loads correctly, the issue is likely with the Vite assets or the complex admin layout. We can then gradually add back the full functionality.</p>
</div>

<script>
    // Test JavaScript functionality
    document.addEventListener('DOMContentLoaded', function() {
        const jsTestItem = document.getElementById('js-test-item');
        if (jsTestItem) {
            jsTestItem.innerHTML = '✅ JavaScript: Working';
            jsTestItem.style.color = 'green';
        }
        
        console.log('Dashboard test page loaded successfully');
    });
</script>
@endsection
