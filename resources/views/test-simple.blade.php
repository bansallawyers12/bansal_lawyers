<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Test Page</h1>
    <p class="success">If you can see this, the basic page is loading correctly.</p>
    
    <div id="js-test">
        <p>JavaScript test: <span id="js-result">Loading...</span></p>
    </div>

    <script>
        console.log('Test page JavaScript is running');
        document.getElementById('js-result').textContent = 'JavaScript is working!';
        document.getElementById('js-result').style.color = 'green';
    </script>
</body>
</html>
