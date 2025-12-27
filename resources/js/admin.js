// Admin JS Bundle - Optimized for Performance
// Admin functionality with modern ES6+ features

// Import Alpine.js utilities
import './alpine-utils.js';

// Import modern components
import { modernSelect } from './components/modern-select.js';
import { ajaxUtils } from './components/ajax-utils.js';
import { formValidation } from './components/form-validation.js';
import { tomSelect } from './components/alpine-select.js';
import { tinyMCE } from './components/alpine-tinymce.js';

// Register Alpine.js data components globally
if (window.Alpine) {
    window.Alpine.data('tomSelect', tomSelect);
    window.Alpine.data('tinyMCE', tinyMCE);
}

// Note: CSS files should be imported in CSS entry points (resources/css/admin.css)
// or loaded via Vite's CSS handling. The app.min.css is loaded via asset() helper
// in Blade templates, so we don't import it here.

// Lazy load admin libraries based on page needs
// Note: These libraries are loaded via CDN/asset() in Blade templates and marked as external in vite.config.js
// This function detects what's needed and initializes them if they're already loaded
const loadAdminLibraries = async (libraries = []) => {
    const loadedLibraries = {};
    
    for (const lib of libraries) {
        try {
            switch (lib) {
                case 'datatables':
                    // DataTables is loaded via asset() in admin.blade.php
                    if (window.$ && window.$.fn && window.$.fn.DataTable) {
                        loadedLibraries.datatables = { DataTables: window.$.fn.DataTable };
                    }
                    break;
                    
                case 'tom-select':
                    // Tom Select is loaded via npm and initialized via Alpine.js components
                    // No jQuery dependency - check if Tom Select module is available
                    // Will be dynamically imported by Alpine.js component if needed
                    loadedLibraries.tomSelect = true;
                    break;
                    
                case 'tinymce':
                    // TinyMCE is loaded via npm and initialized via Alpine.js components
                    // Check if TinyMCE is globally available
                    if (typeof tinymce !== 'undefined') {
                        loadedLibraries.tinymce = tinymce;
                    }
                    break;
                    
                case 'fullcalendar':
                    // FullCalendar is loaded via asset() in admin.blade.php
                    if (window.FullCalendar) {
                        loadedLibraries.fullcalendar = window.FullCalendar;
                    }
                    break;
                    
                case 'datepicker':
                    // Datepicker is loaded via asset() in admin.blade.php (daterangepicker.js)
                    if (window.$ && window.$.fn && window.$.fn.daterangepicker) {
                        loadedLibraries.datepicker = window.$.fn.daterangepicker;
                    }
                    break;
            }
        } catch (error) {
            console.warn(`Failed to initialize ${lib}:`, error);
        }
    }
    
    return loadedLibraries;
};

// Load external scripts that aren't available as npm packages
const loadExternalAdminScripts = (scripts = []) => {
    const externalScripts = [
        '/js/app.min.js',
        '/js/daterangepicker.js',
        '/js/bootstrap-timepicker.min.js',
        '/js/bootstrap-formhelpers.min.js',
        '/js/intlTelInput.js'
    ];
    
    const scriptsToLoad = externalScripts.filter(script => 
        scripts.length === 0 || scripts.some(s => script.includes(s))
    );
    
    return Promise.all(scriptsToLoad.map(src => {
        return new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = src;
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
        });
    }));
};

// Performance optimizations
document.addEventListener('DOMContentLoaded', async function() {
    // Detect what libraries are needed based on page content
    const neededLibraries = [];
    
    if (document.querySelector('.datatable, table[data-datatable]')) {
        neededLibraries.push('datatables');
    }
    
    if (document.querySelector('.modern-select, select[data-modern-select], select[x-data*="tomSelect"]')) {
        neededLibraries.push('tom-select');
    }
    
    if (document.querySelector('textarea[data-tinymce], textarea[x-data*="tinyMCE"]')) {
        neededLibraries.push('tinymce');
    }
    
    if (document.querySelector('#calendar, .calendar')) {
        neededLibraries.push('fullcalendar');
    }
    
    if (document.querySelector('.datepicker, input[data-datepicker]')) {
        neededLibraries.push('datepicker');
    }
    
    try {
        // Load needed libraries
        const loadedLibraries = await loadAdminLibraries(neededLibraries);
        
        // Load external scripts
        await loadExternalAdminScripts(neededLibraries);
        
        // Initialize DataTables
        if (loadedLibraries.datatables && window.$ && window.$.fn && window.$.fn.DataTable) {
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
            
            // Auto-initialize tables
            $('.datatable, table[data-datatable]').DataTable();
        }
        
        // Initialize Modern Select (Tom Select) via Alpine.js components
        // For non-Alpine selects, use modernSelect.init() as fallback
        // Primary method: Use x-data="tomSelect()" in blade templates
        if (loadedLibraries.tomSelect) {
            // Fallback for selects without Alpine.js
            modernSelect.init('.modern-select:not([x-data]), select[data-modern-select]:not([x-data])', {
                placeholder: 'Select an option',
                allowEmptyOption: true,
                closeAfterSelect: true,
                hideSelected: true
            }).catch(error => {
                console.warn('Modern select initialization failed:', error);
            });
        }
        
        // Initialize TinyMCE via Alpine.js components
        // Use x-data="tinyMCE({ height: 500 })" in blade templates instead of Summernote
        // TinyMCE will be initialized automatically by Alpine.js components
        // No manual initialization needed here - Alpine.js handles it reactively
        
        // Initialize FullCalendar v6
        if (loadedLibraries.fullcalendar) {
            const { Calendar, dayGridPlugin, timeGridPlugin, interactionPlugin } = loadedLibraries.fullcalendar;
            const calendarEl = document.getElementById('calendar');
            if (calendarEl) {
                const calendar = new Calendar(calendarEl, {
                    plugins: [dayGridPlugin.default, timeGridPlugin.default, interactionPlugin.default],
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    initialDate: new Date(),
                    navLinks: true,
                    editable: true,
                    eventLimit: true
                });
                calendar.render();
            }
        }
        
        // Initialize Datepicker
        if (loadedLibraries.datepicker && window.$ && window.$.fn && window.$.fn.datepicker) {
            $('.datepicker, input[data-datepicker]').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });
        }
        
        // Performance monitoring
        if (window.performance && window.performance.mark) {
            window.performance.mark('admin-bundle-loaded');
        }
        
    } catch (error) {
        console.warn('Some admin libraries failed to load:', error);
    }
});

// Export for global access if needed
window.AdminBundle = {
    initialized: true,
    version: '2.0.0'
};
