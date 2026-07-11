import axios from 'axios';
import { enhanceDateInput } from '../shared/flatpickr-init.js';
import {
    buildDefaultTimeSlotLabels,
    formatDateForApi,
    generateTimeSlots,
    parseBookingConfig,
} from './config.js';

export function createCalendarController(callbacks) {
    const config = parseBookingConfig();
    let calendar = null;
    let activeServiceId = null;
    let onDateChangeCb = null;
    let disabledWeekdays = [0, 6];
    let disabledDates = [];

    function getAllowedDays() {
        const allDays = [0, 1, 2, 3, 4, 5, 6];
        return allDays.filter((day) => !disabledWeekdays.includes(day));
    }

    function buildDisableFn() {
        return function disableDate(date) {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            if (date.getTime() <= today.getTime()) {
                return true;
            }
            const allowed = getAllowedDays();
            if (!allowed.includes(date.getDay())) {
                return true;
            }
            const ddmmyyyy = formatDateForApi(date);
            return disabledDates.includes(ddmmyyyy);
        };
    }

    function refreshRules() {
        if (!calendar) {
            return;
        }
        calendar.set('disable', [buildDisableFn()]);
        calendar.redraw();
    }

    async function fetchWeekendConfiguration(serviceId) {
        disabledWeekdays = [0, 6];
        disabledDates = [];

        try {
            const { data } = await axios.get(config.endpoints.getdatetime, {
                params: { id: serviceId || 1, enquiry_item: 1 },
            });
            if (data.success && Array.isArray(data.weeks)) {
                disabledWeekdays = data.weeks;
            }
            if (data.success && Array.isArray(data.disabledatesarray)) {
                disabledDates = data.disabledatesarray;
            }
        } catch {
            // defaults already set
        }
        refreshRules();
    }

    async function loadTimeSlots(date, serviceId) {
        if (!date || !serviceId) {
            callbacks.onSlotsLoaded([]);
            return;
        }

        callbacks.onSlotsLoading();
        const apiDate = formatDateForApi(date);
        const labels =
            Array.isArray(config.timeSlotLabels) && config.timeSlotLabels.length
                ? config.timeSlotLabels
                : buildDefaultTimeSlotLabels();

        try {
            const formData = new URLSearchParams();
            formData.append('sel_date', apiDate);
            formData.append('service_id', String(serviceId));
            formData.append('include_crm', '0');

            const { data } = await axios.post(config.endpoints.getdisableddatetime, formData, {
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            });

            const localSlots =
                data.success && Array.isArray(data.disabledtimeslotes) ? data.disabledtimeslotes : [];
            callbacks.onSlotsLoaded(generateTimeSlots(labels, localSlots));

            const crmForm = new URLSearchParams();
            crmForm.append('sel_date', apiDate);
            crmForm.append('service_id', String(serviceId));
            crmForm.append('include_crm', '1');

            axios
                .post(config.endpoints.getdisableddatetime, crmForm, {
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    timeout: 7000,
                })
                .then(({ data: crmData }) => {
                    if (!crmData.success || !Array.isArray(crmData.disabledtimeslotes)) {
                        return;
                    }
                    const extra = crmData.disabledtimeslotes.filter(
                        (slot) =>
                            !localSlots.some(
                                (local) =>
                                    String(local).trim().toLowerCase() ===
                                    String(slot).trim().toLowerCase()
                            )
                    );
                    if (extra.length) {
                        callbacks.onSlotsLoaded(
                            generateTimeSlots(labels, [...localSlots, ...extra])
                        );
                    }
                })
                .catch(() => {});
        } catch {
            callbacks.onSlotsLoaded(generateTimeSlots(labels, []));
        }
    }

    function init(container, serviceId, onDateChange) {
        if (!container) {
            return;
        }

        activeServiceId = serviceId;
        onDateChangeCb = onDateChange;

        if (calendar) {
            calendar.destroy();
            calendar = null;
            if (container._flatpickr) {
                delete container._flatpickr;
            }
        }

        calendar = enhanceDateInput(container, {
            inline: true,
            altInput: false,
            dateFormat: 'Y-m-d',
            disable: [buildDisableFn()],
            onChange(selectedDates) {
                if (!selectedDates.length) {
                    return;
                }
                const date = selectedDates[0];
                if (typeof onDateChangeCb === 'function') {
                    onDateChangeCb(date);
                }
                loadTimeSlots(date, activeServiceId);
            },
        });

        fetchWeekendConfiguration(serviceId);
    }

    function destroy() {
        if (calendar) {
            const input = calendar.input;
            calendar.destroy();
            calendar = null;
            if (input && input._flatpickr) {
                delete input._flatpickr;
            }
        }
    }

    function clear() {
        if (calendar) {
            calendar.clear();
        }
    }

    function setSelectedDate(date) {
        if (!calendar || !date) {
            return;
        }
        calendar.setDate(date, false);
    }

    return {
        init,
        destroy,
        clear,
        setSelectedDate,
        refreshForService(serviceId) {
            activeServiceId = serviceId;
            fetchWeekendConfiguration(serviceId);
        },
        loadTimeSlots,
    };
}
