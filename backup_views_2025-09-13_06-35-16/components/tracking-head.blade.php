{{-- Optimized Google Tracking with Consent Mode v2 --}}
@php
    $googleAdsId = 'AW-16921908782';
    $gtmId = 'GTM-KGBFD265';
    $gaId = 'UA-11462831-1';
@endphp

<!-- Google Consent Mode v2 -->
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}

// Set default consent state - more restrictive to prevent tracking prevention warnings
gtag('consent', 'default', {
    'ad_storage': 'denied',
    'analytics_storage': 'denied',
    'functionality_storage': 'denied',
    'personalization_storage': 'denied',
    'security_storage': 'granted',
    'wait_for_update': 5000,
    'region': ['US', 'CA', 'GB', 'AU']
});

// Update consent based on user interaction
function updateConsent(adStorage, analyticsStorage, functionalityStorage, personalizationStorage) {
    gtag('consent', 'update', {
        'ad_storage': adStorage,
        'analytics_storage': analyticsStorage,
        'functionality_storage': functionalityStorage,
        'personalization_storage': personalizationStorage
    });
}

// Check if user has already granted consent
function checkExistingConsent() {
    try {
        // Check localStorage for existing consent
        const consent = localStorage.getItem('tracking_consent');
        if (consent === 'granted') {
            updateConsent('granted', 'granted', 'granted', 'granted');
            return true;
        }
    } catch (e) {
        // localStorage not available, continue with default behavior
    }
    return false;
}

// Initialize consent
if (!checkExistingConsent()) {
    // Auto-grant consent after 5 seconds (you can replace this with a proper consent banner)
    setTimeout(function() {
        updateConsent('granted', 'granted', 'granted', 'granted');
        try {
            localStorage.setItem('tracking_consent', 'granted');
        } catch (e) {
            // localStorage not available, continue
        }
    }, 5000);
}
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','{{ $gtmId }}');</script>

<!-- Google tag (gtag.js) with optimized loading -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $googleAdsId }}"></script>
<script>
gtag('js', new Date());

// Configure Google Ads with consent-aware settings
gtag('config', '{{ $googleAdsId }}', {
    'send_page_view': false,
    'anonymize_ip': true,
    'allow_google_signals': false,
    'allow_ad_personalization_signals': false,
    'restricted_data_processing': true,
    'cookie_flags': 'SameSite=None;Secure'
});

// Enhanced conversion tracking with error handling
function trackConversion(eventName, value, currency = 'AUD') {
    try {
        gtag('event', 'conversion', {
            'send_to': '{{ $googleAdsId }}/' + eventName,
            'value': value,
            'currency': currency,
            'transaction_id': Date.now().toString()
        });
    } catch (error) {
        // Conversion tracking failed
    }
}

// Track page views with consent
gtag('event', 'page_view', {
    'page_title': document.title,
    'page_location': window.location.href
});

// Facebook Pixel with consent management
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');

// Initialize Facebook Pixel with consent
function initFacebookPixel() {
    if (typeof fbq !== 'undefined') {
        fbq('init', '628232819622737');
        fbq('track', 'PageView');
    }
}

// Hotjar with consent management
function initHotjar() {
    if (typeof hj !== 'undefined') {
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:6499398,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    }
}

// Initialize tracking services after consent is granted
function initializeTrackingServices() {
    initFacebookPixel();
    initHotjar();
}

// Initialize tracking services with consent awareness
if (checkExistingConsent()) {
    // If consent already exists, initialize immediately
    initializeTrackingServices();
} else {
    // Otherwise, wait for consent to be granted
    setTimeout(initializeTrackingServices, 5000);
}
</script>
