import { createIcons, icons } from 'lucide';

const FONT_AWESOME_PREFIXES = new Set(['fa', 'fas', 'far', 'fab', 'fal', 'fa-solid', 'fa-regular', 'fa-brands']);

const FA_TO_LUCIDE = {
    'fa-address-book': 'book-user',
    'fa-align-justify': 'align-justify',
    'fa-align-left': 'align-left',
    'fa-angle-down': 'chevron-down',
    'fa-arrow-left': 'arrow-left',
    'fa-arrow-right': 'arrow-right',
    'fa-arrow-up': 'arrow-up',
    'fa-bag': 'shopping-bag',
    'fa-ban': 'ban',
    'fa-blog': 'newspaper',
    'fa-bolt': 'zap',
    'fa-briefcase': 'briefcase',
    'fa-building': 'building-2',
    'fa-calendar': 'calendar',
    'fa-calendar-alt': 'calendar',
    'fa-calendar-check': 'calendar-check',
    'fa-calendar-plus': 'calendar-plus',
    'fa-calendar-times': 'calendar-x',
    'fa-camera': 'camera',
    'fa-chart-bar': 'chart-column',
    'fa-check': 'check',
    'fa-check-circle': 'circle-check',
    'fa-check-double': 'check-check',
    'fa-chevron-down': 'chevron-down',
    'fa-chevron-up': 'chevron-up',
    'fa-clock': 'clock',
    'fa-cloud-upload-alt': 'cloud-upload',
    'fa-copy': 'copy',
    'fa-credit-card': 'credit-card',
    'fa-edit': 'pencil',
    'fa-envelope': 'mail',
    'fa-exclamation': 'circle-alert',
    'fa-exclamation-circle': 'circle-alert',
    'fa-exclamation-triangle': 'triangle-alert',
    'fa-external-link-alt': 'external-link',
    'fa-eye': 'eye',
    'fa-file-alt': 'file-text',
    'fa-file-code': 'file-code',
    'fa-file-pdf': 'file-text',
    'fa-file-upload': 'upload',
    'fa-folder': 'folder',
    'fa-folder-open': 'folder-open',
    'fa-gavel': 'gavel',
    'fa-home': 'house',
    'fa-image': 'image',
    'fa-info': 'info',
    'fa-info-circle': 'info',
    'fa-lock': 'lock',
    'fa-map-marker': 'map-pin',
    'fa-maximize': 'maximize',
    'fa-minus': 'minus',
    'fa-paper-plane': 'send',
    'fa-pause-circle': 'circle-pause',
    'fa-pencil': 'pencil',
    'fa-play-circle': 'circle-play',
    'fa-plus': 'plus',
    'fa-plus-circle': 'circle-plus',
    'fa-question-circle': 'circle-help',
    'fa-save': 'save',
    'fa-search': 'search',
    'fa-shield-alt': 'shield',
    'fa-sign-in-alt': 'log-in',
    'fa-sign-out-alt': 'log-out',
    'fa-sort': 'arrow-up-down',
    'fa-sort-alpha': 'arrow-down-a-z',
    'fa-sort-amount': 'arrow-down-wide-narrow',
    'fa-sort-numeric': 'arrow-down-01',
    'fa-spinner': 'loader-2',
    'fa-sync': 'refresh-cw',
    'fa-times': 'x',
    'fa-times-circle': 'circle-x',
    'fa-toggle-on': 'toggle-right',
    'fa-trash': 'trash-2',
    'fa-user': 'user',
    'fa-user-edit': 'user-pen',
    'fa-user-plus': 'user-plus',
    'fa-user-times': 'user-x',
    'fa-users-cog': 'users',
    'fa-phone': 'phone',
    'fa-video': 'video',
    'fa-users': 'users',
    'fa-shield': 'shield',
    'fa-map-signs': 'map',
    'fa-refresh': 'refresh-cw',
    'fa-star': 'star',
    'fa-clock-o': 'clock',
    'fa-calendar-check-o': 'calendar-check',
    'fa-calendar-plus-o': 'calendar-plus',
    'fa-gift': 'gift',
    'fa-hourglass-half': 'hourglass',
    'fa-video-camera': 'video',
    'fa-chevron-left': 'chevron-left',
    'fa-chevron-right': 'chevron-right',
    'fa-ticket': 'ticket',
    'fa-undo': 'undo-2',
    'fa-tag': 'tag',
    'fa-hashtag': 'hash',
    'fa-cog': 'settings',
    'fa-archive': 'archive',
    'fa-users-slash': 'users',
    'fa-certificate': 'badge-check',
    'fa-globe': 'globe',
    'fa-suitcase': 'briefcase',
    'fa-balance-scale': 'scale',
    'fa-list': 'list',
    'fa-tags': 'tags',
    'fa-envelope-open': 'mail-open',
    'fa-comment-alt': 'message-square',
    'fa-reply': 'reply',
    'fa-clipboard': 'clipboard',
    'fa-download': 'download',
    'fa-calendar-day': 'calendar-days',
    'fa-calendar-week': 'calendar-range',
    'fa-filter': 'funnel',
    'fa-print': 'printer',
    'fa-pencil-alt': 'pencil',
};

function extractFontAwesomeIcon(className = '') {
    const classes = className.split(/\s+/).filter(Boolean);
    let lucideName = null;
    let spin = false;

    for (const cls of classes) {
        if (cls === 'fa-spin') {
            spin = true;
            continue;
        }

        if (FA_TO_LUCIDE[cls]) {
            lucideName = FA_TO_LUCIDE[cls];
        }
    }

    return { lucideName, spin };
}

function preserveNonFaClasses(className = '') {
    return className
        .split(/\s+/)
        .filter((cls) => cls && !FONT_AWESOME_PREFIXES.has(cls) && !cls.startsWith('fa-') && cls !== 'fa-spin')
        .join(' ');
}

function upgradeFontAwesomeNode(node) {
    if (!(node instanceof HTMLElement)) {
        return false;
    }

    const tag = node.tagName.toLowerCase();
    if (tag !== 'i' && tag !== 'span') {
        return false;
    }

    const className = node.getAttribute('class') || '';
    const hasFa = [...FONT_AWESOME_PREFIXES].some((prefix) => className.split(/\s+/).includes(prefix))
        || /\bfa-[a-z0-9-]+\b/.test(className);

    if (!hasFa || node.hasAttribute('data-lucide')) {
        return false;
    }

    const { lucideName, spin } = extractFontAwesomeIcon(className);
    if (!lucideName) {
        return false;
    }

    const preserved = preserveNonFaClasses(className);
    node.setAttribute('data-lucide', lucideName);
    node.className = [preserved, spin ? 'lucide-spin' : ''].filter(Boolean).join(' ');

    return true;
}

export function refreshLucideIcons(root = document) {
    const scope = root instanceof Document ? root : root || document;

    scope.querySelectorAll('.lucide-sort, i.lucide-sort').forEach((node) => {
        node.setAttribute('data-lucide', 'arrow-up-down');
    });

    scope.querySelectorAll('i[class*="fa"], span[class*="fa"]').forEach((node) => {
        upgradeFontAwesomeNode(node);
    });

    createIcons({
        icons,
        attrs: {
            class: ['lucide'],
            'aria-hidden': 'true',
        },
        nameAttr: 'data-lucide',
    });

    scope.querySelectorAll('svg.lucide.lucide-spin, i.lucide-spin + svg, [data-lucide].lucide-spin').forEach((node) => {
        node.classList.add('lucide-spin');
    });
}

export function setLucideIcon(element, iconName, options = {}) {
    const target = typeof element === 'string' ? document.querySelector(element) : element;
    if (!target) {
        return null;
    }

    const spin = options.spin ?? false;
    const preserved = options.className ?? preserveNonFaClasses(target.getAttribute('class') || '');

    const placeholder = document.createElement('i');
    placeholder.setAttribute('data-lucide', iconName);
    placeholder.className = [preserved, spin ? 'lucide-spin' : ''].filter(Boolean).join(' ');
    if (target.parentElement) {
        target.replaceWith(placeholder);
    }

    refreshLucideIcons(placeholder.parentElement || document);
    return placeholder;
}

let refreshScheduled = false;
function scheduleRefresh() {
    if (refreshScheduled) {
        return;
    }

    refreshScheduled = true;
    requestAnimationFrame(() => {
        refreshScheduled = false;
        refreshLucideIcons();
    });
}

function observeDynamicIcons() {
    if (!('MutationObserver' in window)) {
        return;
    }

    const observer = new MutationObserver((mutations) => {
        for (const mutation of mutations) {
            if (mutation.addedNodes.length > 0) {
                scheduleRefresh();
                break;
            }
        }
    });

    observer.observe(document.documentElement, { childList: true, subtree: true });
}

window.refreshLucideIcons = refreshLucideIcons;
window.setLucideIcon = setLucideIcon;
window.lucide = { createIcons, icons, refreshLucideIcons, setLucideIcon };

document.addEventListener('DOMContentLoaded', () => {
    refreshLucideIcons();
    observeDynamicIcons();
});

export { createIcons, icons, FA_TO_LUCIDE };
