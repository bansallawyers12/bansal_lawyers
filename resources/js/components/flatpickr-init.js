/**
 * Shared Flatpickr initializers (replaces Moment + daterangepicker + bootstrap-timepicker).
 */

const ISO_FORMAT = 'Y-m-d';
const DISPLAY_DMY = 'd/m/Y';
const DISPLAY_MDY = 'm/d/Y';

function parseDateFormat() {
    if (typeof window.dataformat === 'string' && window.dataformat.includes('DD/MM')) {
        return DISPLAY_DMY;
    }
    return ISO_FORMAT;
}

function bindFlatpickr(selector, options) {
    if (typeof window.flatpickr !== 'function') {
        return;
    }

    document.querySelectorAll(selector).forEach((element) => {
        if (element._flatpickr) {
            return;
        }
        window.flatpickr(element, options);
    });
}

export function initAdminFlatpickr() {
    const defaultDateFormat = parseDateFormat();

    bindFlatpickr('.datepicker, input[data-datepicker]', {
        dateFormat: ISO_FORMAT,
        allowInput: true,
        clickOpens: true,
    });

    bindFlatpickr('.dobdatepicker', {
        dateFormat: defaultDateFormat === DISPLAY_DMY ? DISPLAY_DMY : DISPLAY_MDY,
        allowInput: true,
        clickOpens: true,
        onChange(selectedDates, dateStr, instance) {
            if (selectedDates[0]) {
                const iso = instance.formatDate(selectedDates[0], ISO_FORMAT);
                instance.element.dataset.isoDate = iso;
            }
        },
    });

    bindFlatpickr('.dobdatepickers', {
        dateFormat: defaultDateFormat === DISPLAY_DMY ? DISPLAY_DMY : DISPLAY_MDY,
        allowInput: true,
        clickOpens: true,
        onChange(selectedDates, dateStr, instance) {
            if (!selectedDates[0]) {
                return;
            }
            const iso = instance.formatDate(selectedDates[0], ISO_FORMAT);
            instance.element.dataset.isoDate = iso;

            const mdy = instance.formatDate(selectedDates[0], DISPLAY_MDY);
            const ageInput = document.querySelector('input[name="age"]');
            if (ageInput && typeof window.getAgeFromDateString === 'function') {
                ageInput.value = window.getAgeFromDateString(mdy);
            }
        },
    });

    bindFlatpickr('.filterdatepicker, .contract_expiry', {
        dateFormat: ISO_FORMAT,
        allowInput: true,
        clickOpens: true,
    });

    bindFlatpickr('.datetimepicker', {
        enableTime: true,
        dateFormat: `${ISO_FORMAT} H:i`,
        allowInput: true,
        clickOpens: true,
    });

    bindFlatpickr('.daterange', {
        mode: 'range',
        dateFormat: ISO_FORMAT,
        allowInput: true,
        clickOpens: true,
    });

    bindFlatpickr('.timepicker, input[data-timepicker]', {
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        allowInput: true,
        clickOpens: true,
    });

    bindFlatpickr('.followup_date', {
        dateFormat: DISPLAY_DMY,
        allowInput: true,
        clickOpens: true,
    });
}

window.getAgeFromDateString = function getAgeFromDateString(dateString) {
    const now = new Date();
    const yearNow = now.getFullYear();
    const monthNow = now.getMonth();
    const dateNow = now.getDate();

    const dob = new Date(
        dateString.substring(6, 10),
        dateString.substring(0, 2) - 1,
        dateString.substring(3, 5)
    );

    const yearDob = dob.getFullYear();
    const monthDob = dob.getMonth();
    const dateDob = dob.getDate();

    let yearAge = yearNow - yearDob;
    let monthAge;
    let dateAge;

    if (monthNow >= monthDob) {
        monthAge = monthNow - monthDob;
    } else {
        yearAge--;
        monthAge = 12 + monthNow - monthDob;
    }

    if (dateNow >= dateDob) {
        dateAge = dateNow - dateDob;
    } else {
        monthAge--;
        dateAge = 31 + dateNow - dateDob;
        if (monthAge < 0) {
            monthAge = 11;
            yearAge--;
        }
    }

    const yearString = yearAge > 1 ? ' years' : ' year';
    const monthString = monthAge > 1 ? ' months' : ' month';

    if (yearAge > 0 && monthAge > 0 && dateAge > 0) {
        return yearAge + yearString + ' ' + monthAge + monthString;
    }
    if (yearAge === 0 && monthAge === 0 && dateAge > 0) {
        return String(dateAge);
    }
    if (yearAge > 0 && monthAge === 0 && dateAge === 0) {
        return yearAge + yearString;
    }
    if (yearAge > 0 && monthAge > 0 && dateAge === 0) {
        return yearAge + yearString + ' ' + monthAge + monthString;
    }
    if (yearAge === 0 && monthAge > 0 && dateAge > 0) {
        return monthAge + monthString;
    }
    if (yearAge > 0 && monthAge === 0 && dateAge > 0) {
        return yearAge + yearString;
    }
    if (yearAge === 0 && monthAge > 0 && dateAge === 0) {
        return monthAge + monthString;
    }

    return 'Oops! Could not calculate age!';
};

window.initAdminFlatpickr = initAdminFlatpickr;
