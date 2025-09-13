<!DOCTYPE html>
<html>
<head>
    <title>CSP Nonce Debug</title>
</head>
<body>
    <h1>CSP Nonce Debug</h1>
    <p><strong>Status:</strong> CSP is currently disabled</p>
    
    <h2>Nonce Sources:</h2>
    <ul>
        <li><strong>Session:</strong> {{ session('csp_nonce') ?? 'Not found (CSP disabled)' }}</li>
        <li><strong>View Shared:</strong> {{ view()->shared('csp_nonce') ?? 'Not found (CSP disabled)' }}</li>
        <li><strong>Request Attributes:</strong> {{ request()->attributes->get('csp_nonce') ?? 'Not found (CSP disabled)' }}</li>
        <li><strong>Helper Function:</strong> {{ Helper::getCspNonce() ?? 'Not found (CSP disabled)' }}</li>
    </ul>
    
    <h2>Nonce Attribute:</h2>
    <p><code>{{ Helper::cspNonceAttribute() }}</code></p>
    
    <h2>Test Elements:</h2>
    <p><strong>Helper Function Test:</strong> {{ Helper::cspNonceAttribute() }}</p>
    <p><strong>Direct Nonce:</strong> {{ Helper::getCspNonce() }}</p>
    
    <style{!! Helper::cspNonceAttribute() !!}>
        .test-style { color: red; }
    </style>
    
    <script{!! Helper::cspNonceAttribute() !!}>
        // Test script with nonce
    </script>
    
    <div style="color: blue;"{!! Helper::cspNonceAttribute() !!}>Test inline style</div>
</body>
</html>
