// Admin Calendar Scripts - Loaded on demand
// FullCalendar and date/time pickers

// Import FullCalendar v6
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

// Import Bootstrap Datepicker
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.css';
import 'bootstrap-datepicker/dist/js/bootstrap-datepicker';

// Import Bootstrap Timepicker
// Note: Bootstrap Timepicker needs to be loaded from local file as it's not available as npm package
const loadTimepicker = () => {
    return new Promise((resolve, reject) => {
        if (window.$ && window.$.fn && window.$.fn.timepicker) {
            resolve();
            return;
        }
        
        const script = document.createElement('script');
        script.src = '/js/bootstrap-timepicker.min.js';
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
};

// Import Date Range Picker
// Note: Date Range Picker needs to be loaded from local file as it's not available as npm package
const loadDateRangePicker = () => {
    return new Promise((resolve, reject) => {
        if (window.$ && window.$.fn && window.$.fn.daterangepicker) {
            resolve();
            return;
        }
        
        const script = document.createElement('script');
        script.src = '/js/daterangepicker.js';
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
};

// Initialize calendar components when loaded
document.addEventListener('DOMContentLoaded', async function() {
    try {
        // Load external dependencies
        await Promise.all([
            loadTimepicker(),
            loadDateRangePicker()
        ]);
        
        // Initialize FullCalendar v6
        const calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            const calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
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
        
        // Initialize Bootstrap Datepicker
        if (window.$ && window.$.fn && window.$.fn.datepicker) {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });
        }
        
        // Initialize Bootstrap Timepicker
        if (window.$ && window.$.fn && window.$.fn.timepicker) {
            $('.timepicker').timepicker({
                minuteStep: 1,
                showSeconds: true
            });
        }
        
        // Initialize Date Range Picker
        if (window.$ && window.$.fn && window.$.fn.daterangepicker) {
            $('.daterangepicker').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });
        }
        
    } catch (error) {
        console.warn('Some calendar libraries failed to load:', error);
    }
});

// Export for global access
window.AdminCalendar = {
    initialized: true,
    version: '2.0.0'
};
