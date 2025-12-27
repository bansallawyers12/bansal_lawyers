// Admin vendor bundle

// Feather Icons
import feather from 'feather-icons';

// Bootstrap Datepicker (bundled via npm)
import 'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js';

// Bootstrap Datepicker CSS
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';

// Note: jquery.nicescroll and sticky-kit are loaded from public/js/vendor/
// They don't support ES modules, so loaded via <script> tags

// Initialize Feather Icons globally
// This replaces the feather.replace() call that was done via CDN
window.feather = feather;

// Auto-replace feather icons on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    if (typeof jQuery !== 'undefined') {
        // Wait for jQuery if it's loaded asynchronously
        jQuery(document).ready(function() {
            feather.replace();
        });
    } else {
        // Fallback if jQuery is not available
        feather.replace();
    }
});

// Export for ES modules if needed
export { feather };

