// Admin DataTables Scripts - Loaded on demand
// DataTables and related functionality

// Import DataTables CSS and JS
import 'datatables.net-bs4/css/dataTables.bootstrap4.css';
import 'datatables.net';
import 'datatables.net-bs4';

// Import Select2 for enhanced selects
import 'select2/dist/css/select2.css';
import 'select2';

// Import Summernote for rich text editing
import 'summernote/dist/summernote-bs4.css';
import 'summernote/dist/summernote-bs4.js';

// Initialize DataTables when loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize DataTables with performance optimizations
    if (window.$ && window.$.fn && window.$.fn.DataTable) {
        window.$.extend(window.$.fn.dataTable.defaults, {
            responsive: true,
            processing: true,
            serverSide: false,
            deferRender: true,
            scroller: {
                loadingIndicator: true
            },
            dom: 'lfrtip',
            language: {
                processing: "Loading...",
                emptyTable: "No data available"
            }
        });
        
        // Auto-initialize all tables with .datatable class
        $('.datatable').DataTable();
    }
    
    // Initialize Select2
    if (window.$ && window.$.fn && window.$.fn.select2) {
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select an option',
            allowClear: true
        });
    }
    
    // Initialize Summernote
    if (window.$ && window.$.fn && window.$.fn.summernote) {
        $('.summernote').summernote({
            height: 300,
            minHeight: 200,
            maxHeight: 500,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    }
});

// Export for global access
window.AdminDataTables = {
    initialized: true,
    version: '2.0.0'
};
