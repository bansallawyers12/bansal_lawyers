// Admin JS Bundle - Optimized for Performance
// Admin functionality with modern ES6+ features

// Import Alpine.js utilities
import './alpine-utils.js';

// Import modern components
import { modernSelect } from './components/modern-select.js';
import { ajaxUtils } from './components/ajax-utils.js';
import { formValidation } from './components/form-validation.js';

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
                    // Tom Select would need to be installed via npm if used
                    // For now, using Select2 which is loaded via asset()
                    if (window.$ && window.$.fn && window.$.fn.select2) {
                        loadedLibraries.select2 = window.$.fn.select2;
                    }
                    break;
                    
                case 'summernote':
                    // Summernote is loaded via asset() in admin.blade.php
                    if (window.$ && window.$.fn && window.$.fn.summernote) {
                        loadedLibraries.summernote = window.$.fn.summernote;
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
    
    if (document.querySelector('.modern-select, select[data-modern-select]')) {
        neededLibraries.push('tom-select');
    }
    
    if (document.querySelector('.summernote, textarea[data-summernote]')) {
        neededLibraries.push('summernote');
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
        
        // Initialize Modern Select (Tom Select)
        if (loadedLibraries.tomSelect) {
            modernSelect.init('.modern-select, select[data-modern-select]', {
                placeholder: 'Select an option',
                allowEmptyOption: true,
                closeAfterSelect: true,
                hideSelected: true
            }).catch(error => {
                console.warn('Modern select initialization failed:', error);
            });
        }
        
        // Initialize Summernote
        if (loadedLibraries.summernote && window.$ && window.$.fn && window.$.fn.summernote) {
            $('.summernote, textarea[data-summernote]').summernote({
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
