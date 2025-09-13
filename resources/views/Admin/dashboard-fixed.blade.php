@extends('layouts.admin-fixed')
@section('title', 'Admin Dashboard - Fixed')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">✅ Admin Dashboard - Fixed Version</h2>
                <p class="card-text">This is the fixed version of the admin dashboard using the cleaned-up layout.</p>
                
                <div class="alert alert-success">
                    <h4>✅ Success Indicators:</h4>
                    <ul class="mb-0">
                        <li>Page loads without errors</li>
                        <li>Alpine.js is working</li>
                        <li>Modern CSS is applied</li>
                        <li>No jQuery dependencies</li>
                        <li>Clean JavaScript code</li>
                    </ul>
                </div>

                <div class="alert alert-info">
                    <h4>🔧 Technical Details:</h4>
                    <ul class="mb-0">
                        <li><strong>Layout:</strong> admin-fixed.blade.php</li>
                        <li><strong>JavaScript:</strong> app-simple.js + alpine-utils.js</li>
                        <li><strong>CSS:</strong> Vite-compiled SCSS + admin.css</li>
                        <li><strong>Framework:</strong> Alpine.js (no jQuery)</li>
                        <li><strong>Status:</strong> Clean, working code</li>
                    </ul>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Test Alpine.js</h5>
                                <div x-data="{ count: 0 }">
                                    <p>Count: <span x-text="count"></span></p>
                                    <button @click="count++" class="btn btn-primary">Increment</button>
                                    <button @click="count = 0" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Test Form</h5>
                                <form>
                                    <div class="form-group">
                                        <label for="testInput">Test Input:</label>
                                        <input type="text" id="testInput" class="form-control" placeholder="Type something...">
                                    </div>
                                    <button type="button" class="btn btn-success">Test Button</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h4>Next Steps:</h4>
                    <p>This fixed layout can now be used as the base for the original admin dashboard. We can gradually add back the full functionality using modern components.</p>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Test Original Dashboard</a>
                    <a href="{{ route('admin.dashboard-clean') }}" class="btn btn-secondary">Test Clean Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    console.log('Fixed dashboard loaded successfully');
    console.log('Alpine.js available:', typeof Alpine !== 'undefined');
    console.log('Site URL:', window.site_url);
</script>
@endsection
