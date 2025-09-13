<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bansal Lawyers | @yield('title')</title>
    
    <!-- Modern Vite CSS Bundle -->
    @vite(['resources/css/admin.css'])
    
    <style>
        /* Basic admin styles */
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .admin-header { background: #1B4D89; color: white; padding: 1rem; }
        .admin-content { padding: 2rem; }
        .card { background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 1.5rem; margin-bottom: 1rem; }
        .btn { padding: 0.5rem 1rem; border: none; border-radius: 4px; cursor: pointer; }
        .btn-primary { background: #1B4D89; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .form-control { width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 0.75rem; border-bottom: 1px solid #ddd; text-align: left; }
        .table th { background: #f8f9fa; font-weight: 600; }
        .alert { padding: 1rem; border-radius: 4px; margin-bottom: 1rem; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-info { background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="h3 mb-0">Bansal Lawyers Admin</h1>
                </div>
                <div class="col-md-6 text-right">
                    <span class="text-light">Welcome, {{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                    <a href="{{ route('admin.logout') }}" class="btn btn-outline-light btn-sm ml-2">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <!-- Global JavaScript Variables -->
    <script>
        window.site_url = '{{ URL::to('/') }}';
        window.dataformat = '{{ $dataformat ?? 'DD/MM/YYYY' }}';
        window.csrf_token = '{{ csrf_token() }}';
    </script>

    <!-- Modern Vite JavaScript Bundle -->
    @vite(['resources/js/app-simple.js'])

    <!-- Page Specific Scripts -->
    @yield('scripts')
</body>
</html>
