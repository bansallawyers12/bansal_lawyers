<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Test Page</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f0f0f0; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .btn { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Basic Test Page</h1>
        <p class="success">✅ If you can see this, the basic Laravel setup is working!</p>
        
        <h2>Test JavaScript</h2>
        <p>Click the button to test JavaScript:</p>
        <button class="btn" onclick="testJS()">Test JavaScript</button>
        <p id="js-result">JavaScript not tested yet</p>
        
        <h2>Test Alpine.js</h2>
        <div x-data="{ count: 0 }">
            <p>Count: <span x-text="count"></span></p>
            <button class="btn" @click="count++">Increment</button>
            <button class="btn" @click="count = 0">Reset</button>
        </div>
        
        <h2>Test Links</h2>
        <p><a href="/test-simple">Go to Simple Test Page</a></p>
        <p><a href="/admin/dashboard-clean">Go to Clean Admin Dashboard</a></p>
    </div>

    <!-- Basic JavaScript -->
    <script>
        function testJS() {
            document.getElementById('js-result').innerHTML = '<span class="success">✅ JavaScript is working!</span>';
        }
        
        console.log('Basic test page loaded successfully');
    </script>

    <!-- Alpine.js from CDN for testing -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
