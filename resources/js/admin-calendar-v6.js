// FullCalendar v6 Initialization for Appointments Calendar
// No jQuery required!

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';

// FullCalendar CSS will be loaded via link tag in admin layout
// CSS imports don't work well with Vite for FullCalendar v6

// Initialize calendar when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('myEvent');
    
    if (!calendarEl) {
        // Calendar not on this page
        return;
    }
    
    // Get events data from global variable (set by Blade template)
    let events = [];
    if (window.calendarEvents && Array.isArray(window.calendarEvents)) {
        events = window.calendarEvents;
    }
    
    // Initialize FullCalendar v6
    const calendar = new Calendar(calendarEl, {
        plugins: [
            dayGridPlugin,
            timeGridPlugin,
            listPlugin,
            interactionPlugin
        ],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        height: 'auto',
        editable: false,
        selectable: true,
        allDaySlot: false,
        slotMinTime: '10:00:00',
        slotMaxTime: '18:00:00',
        scrollTime: '10:00:00',
        slotDuration: '00:30:00',
        slotEventOverlap: false,
        eventOverlap: false,
        events: events,
        eventTimeFormat: {
            hour: 'numeric',
            minute: '2-digit',
            meridiem: 'short'
        },
        timeZone: 'Australia/Melbourne',
        eventClick: function(info) {
            // Handle event click - trigger existing modal code
            if (info.event && info.event.id) {
                // Dispatch custom event that existing jQuery code can listen to
                const event = new CustomEvent('fullcalendar-event-click', {
                    detail: {
                        id: info.event.id,
                        title: info.event.title,
                        start: info.event.start,
                        end: info.event.end,
                        backgroundColor: info.event.backgroundColor
                    }
                });
                document.dispatchEvent(event);
            }
        },
        dateClick: function(info) {
            // Handle date click if needed
            const event = new CustomEvent('fullcalendar-date-click', {
                detail: {
                    date: info.dateStr,
                    allDay: info.allDay
                }
            });
            document.dispatchEvent(event);
        }
    });
    
    // Render calendar
    calendar.render();
    
    // Make calendar available globally for updates
    window.appointmentsCalendar = calendar;
    
    console.log('✓ FullCalendar v6 initialized (no jQuery needed)');
});

