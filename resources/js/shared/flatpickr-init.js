import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

const PRESETS = {
    date: {
        dateFormat: 'Y-m-d',
        altInput: true,
        altFormat: 'd/m/Y',
    },
    'inline-date': {
        inline: true,
        dateFormat: 'Y-m-d',
    },
};

function syncInputEvent(instance) {
    instance.input.dispatchEvent(new Event('input', { bubbles: true }));
    instance.input.dispatchEvent(new Event('change', { bubbles: true }));
}

function buildOptions(element, extraOptions = {}) {
    const mode = element.dataset.flatpickrMode ?? 'date';
    const preset = PRESETS[mode] ?? PRESETS.date;
    const options = { ...preset, ...extraOptions };

    if (element.dataset.flatpickrMinDate) {
        options.minDate = element.dataset.flatpickrMinDate;
    }

    if (element.dataset.flatpickrMaxDate) {
        options.maxDate = element.dataset.flatpickrMaxDate;
    }

    const userOnChange = options.onChange;
    options.onChange = function onChange(selectedDates, dateStr, instance) {
        syncInputEvent(instance);
        if (typeof userOnChange === 'function') {
            userOnChange(selectedDates, dateStr, instance);
        }
    };

    return options;
}

export function enhanceDateInput(element, extraOptions = {}) {
    if (!element || element._flatpickr) {
        return element?._flatpickr ?? null;
    }

    return flatpickr(element, buildOptions(element, extraOptions));
}
