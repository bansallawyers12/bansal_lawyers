<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex,nofollow">
    <title>Email</title>
</head>
<body>
<p style="font-family: system-ui, sans-serif; margin: 2rem;">
    Redirecting… If nothing happens, <a href="{{ url('/contact') }}">contact us here</a>.
</p>
<script>
(function () {
    var hash = (window.location.hash || '').replace(/^#/, '');
    var contactUrl = @json(url('/contact'));
    if (/^[a-f0-9]+$/i.test(hash) && hash.length >= 4) {
        var key = parseInt(hash.substr(0, 2), 16);
        if (!isNaN(key)) {
            var email = '';
            for (var n = 2; n < hash.length; n += 2) {
                email += String.fromCharCode(parseInt(hash.substr(n, 2), 16) ^ key);
            }
            if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                window.location.replace('mailto:' + email);
                return;
            }
        }
    }
    window.location.replace(contactUrl);
})();
</script>
<noscript><a href="{{ url('/contact') }}">Continue to contact</a></noscript>
</body>
</html>
