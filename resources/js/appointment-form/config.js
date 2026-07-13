export const TAB_ORDER = [
    'consultation_duration',
    'consultation_type',
    'appointment_details',
    'info',
    'confirm',
];

export function parseBookingConfig() {
    const el = document.getElementById('booking-config');
    if (!el) {
        return {};
    }
    try {
        return JSON.parse(el.textContent);
    } catch {
        return {};
    }
}

export function formatAud(amount) {
    return `$${(parseFloat(amount) || 0).toFixed(2)} AUD`;
}

export function formatDateForApi(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
}

export function formatLocalIso(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

export function normalizeBookedTimeLabel(value) {
    if (value == null || typeof value !== 'string') {
        return '';
    }
    return value.trim().replace(/\s+/g, ' ').toLowerCase();
}

export function buildDefaultTimeSlotLabels() {
    const slots = [];
    const current = new Date('1970-01-01T10:30:00');
    const end = new Date('1970-01-01T17:00:00');
    while (current <= end) {
        const hours = current.getHours();
        const minutes = current.getMinutes();
        const period = hours >= 12 ? 'PM' : 'AM';
        const displayHour = hours % 12 === 0 ? 12 : hours % 12;
        slots.push(`${displayHour}:${String(minutes).padStart(2, '0')} ${period}`);
        current.setMinutes(current.getMinutes() + 30);
    }
    return slots;
}

export function generateTimeSlots(labels, bookedSlots = []) {
    return labels.map((time) => {
        const isBooked = bookedSlots.some(
            (booked) => normalizeBookedTimeLabel(time) === normalizeBookedTimeLabel(String(booked))
        );
        return { time, available: !isBooked };
    });
}

export function consultationTypeLabel(value) {
    switch (value) {
        case 'In-person':
            return 'In-Person Consultation';
        case 'Phone':
            return 'Phone Consultation';
        case 'Zoom / Google Meeting':
            return 'Video Consultation';
        default:
            return value || 'Not selected';
    }
}
