export function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

export function validateInfoFields(state) {
    const errors = [];

    if (!state.fullname?.trim()) {
        errors.push({ field: 'fullname', message: 'Full name is required' });
    }
    if (!state.email?.trim() || !isValidEmail(state.email)) {
        errors.push({ field: 'email', message: 'Valid email is required' });
    }
    if (!state.phone?.trim()) {
        errors.push({ field: 'phone', message: 'Phone number is required' });
    }
    if (!state.description?.trim()) {
        errors.push({ field: 'description', message: 'Details of enquiry are required' });
    }
    if (!state.noeId) {
        errors.push({ field: 'noe_id', message: 'Please select a type of legal matter' });
    }

    return errors;
}

export function validateStep(state, stepId) {
    switch (stepId) {
        case 'consultation_duration':
            return state.serviceId ? [] : [{ field: 'duration', message: 'Please select a consultation duration' }];
        case 'consultation_type':
            return state.consultationType
                ? []
                : [{ field: 'consultation_type', message: 'Please select a consultation type' }];
        case 'appointment_details':
            if (!state.selectedDate || !state.selectedTime) {
                return [{ field: 'datetime', message: 'Please select a date and time' }];
            }
            return [];
        case 'info': {
            const infoErrors = validateInfoFields(state);
            if (!state.serviceId) {
                infoErrors.push({ field: 'duration', message: 'Consultation duration is required' });
            }
            if (!state.consultationType) {
                infoErrors.push({ field: 'consultation_type', message: 'Consultation type is required' });
            }
            if (!state.selectedDate || !state.selectedTime) {
                infoErrors.push({ field: 'datetime', message: 'Date and time are required' });
            }
            return infoErrors;
        }
        case 'confirm':
            return [];
        default:
            return [];
    }
}

export function validateAll(state) {
    const errors = [];
    for (const step of [
        'consultation_duration',
        'consultation_type',
        'appointment_details',
        'info',
    ]) {
        errors.push(...validateStep(state, step));
    }
    return errors;
}
