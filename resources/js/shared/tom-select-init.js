import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.css';

const DEFAULT_OPTIONS = {
    create: false,
    allowEmptyOption: true,
    dropdownParent: 'body',
};

const ENHANCEABLE_SELECT = 'select[data-enhanced-select]:not(.tomselected)';

function buildOptions(select, extraOptions = {}) {
    const options = { ...DEFAULT_OPTIONS, ...extraOptions };
    const placeholder = select.dataset.enhancedSelectPlaceholder;
    if (placeholder) {
        options.placeholder = placeholder;
    }
    return options;
}

export function enhanceSelect(select, extraOptions = {}) {
    if (!(select instanceof HTMLSelectElement)) {
        return null;
    }
    if (select.tomselect) {
        return select.tomselect;
    }
    return new TomSelect(select, buildOptions(select, extraOptions));
}

export function initEnhancedSelects(root = document) {
    root.querySelectorAll?.(ENHANCEABLE_SELECT).forEach((select) => {
        enhanceSelect(select);
    });
}
