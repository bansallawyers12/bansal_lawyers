<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bansal Lawyers | @yield('title')</title>
    
    <!-- Basic CSS -->
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        .header { background: #333; color: white; padding: 15px; margin: -20px -20px 20px -20px; border-radius: 8px 8px 0 0; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Admin Dashboard - Minimal Test</h1>
        </div>
        
        <div id="content">
            @yield('content')
        </div>
        
        <div id="js-test">
            <p>JavaScript Status: <span id="js-status">Testing...</span></p>
        </div>
    </div>

    <!-- Basic JavaScript Test -->
    <script>
        console.log('Minimal admin layout JavaScript loaded');
        document.getElementById('js-status').textContent = 'JavaScript Working!';
        document.getElementById('js-status').className = 'success';
        
        // Test if our utilities are available
        if (typeof window.formValidation !== 'undefined') {
            console.log('Form validation utility available');
        } else {
            console.log('Form validation utility NOT available');
        }
    </script>
</body>
</html>
