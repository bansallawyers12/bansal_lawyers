/**
 * Migrate Font Awesome markup to Lucide data attributes in blade/js/php files.
 * Run: node scripts/migrate-fa-to-lucide.js
 */
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.join(__dirname, '..');

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
    'fa-phone': 'phone',
    'fa-play-circle': 'circle-play',
    'fa-plus': 'plus',
    'fa-plus-circle': 'circle-plus',
    'fa-question-circle': 'circle-help',
    'fa-refresh': 'refresh-cw',
    'fa-save': 'save',
    'fa-search': 'search',
    'fa-shield': 'shield',
    'fa-shield-alt': 'shield',
    'fa-sign-in-alt': 'log-in',
    'fa-sign-out-alt': 'log-out',
    'fa-sort': 'arrow-up-down',
    'fa-sort-alpha': 'arrow-down-a-z',
    'fa-sort-amount': 'arrow-down-wide-narrow',
    'fa-sort-numeric': 'arrow-down-01',
    'fa-spinner': 'loader-2',
    'fa-star': 'star',
    'fa-sync': 'refresh-cw',
    'fa-tag': 'tag',
    'fa-ticket': 'ticket',
    'fa-times': 'x',
    'fa-times-circle': 'circle-x',
    'fa-toggle-on': 'toggle-right',
    'fa-trash': 'trash-2',
    'fa-undo': 'undo-2',
    'fa-user': 'user',
    'fa-user-edit': 'user-pen',
    'fa-user-plus': 'user-plus',
    'fa-user-times': 'user-x',
    'fa-users': 'users',
    'fa-users-cog': 'users',
    'fa-video': 'video',
    'fa-video-camera': 'video',
    'fa-clock-o': 'clock',
    'fa-calendar-check-o': 'calendar-check',
    'fa-calendar-plus-o': 'calendar-plus',
    'fa-gift': 'gift',
    'fa-hourglass-half': 'hourglass',
    'fa-map-signs': 'map',
    'fa-chevron-left': 'chevron-left',
    'fa-chevron-right': 'chevron-right',
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
};

const BRAND_MAP = {
    'fa-facebook': 'facebook',
    'fa-instagram': 'instagram',
    'fa-linkedin': 'linkedin',
    'fa-twitter': 'twitter',
    'fa-youtube': 'youtube',
};

const FA_PREFIXES = new Set(['fa', 'fas', 'far', 'fab', 'fal', 'fa-solid', 'fa-regular', 'fa-brands']);
const FA_ICON = /\bfa-[a-z0-9-]+\b/g;

function walk(dir, files = []) {
    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        if (['node_modules', 'vendor', 'public/build', 'storage', '.git'].includes(entry.name)) {
            continue;
        }
        const full = path.join(dir, entry.name);
        if (entry.isDirectory()) {
            walk(full, files);
        } else if (/\.(blade\.php|js|php)$/.test(entry.name)) {
            files.push(full);
        }
    }
    return files;
}

function convertClassString(classValue) {
    const classes = classValue.split(/\s+/).filter(Boolean);
    let lucide = null;
    let spin = false;
    let brand = null;
    const preserved = [];

    for (const cls of classes) {
        if (cls === 'fa-spin') {
            spin = true;
            continue;
        }
        if (FA_PREFIXES.has(cls)) {
            continue;
        }
        if (BRAND_MAP[cls]) {
            brand = BRAND_MAP[cls];
            continue;
        }
        if (FA_TO_LUCIDE[cls]) {
            lucide = FA_TO_LUCIDE[cls];
            continue;
        }
        if (cls.startsWith('fa-')) {
            continue;
        }
        preserved.push(cls);
    }

    if (brand) {
        return { brand, preserved, spin };
    }

    return { lucide, preserved, spin };
}

function migrateContent(content) {
    let updated = content;

    updated = updated.replace(/<i\b([^>]*?)>/gi, (match, attrs) => {
        const classMatch = attrs.match(/\bclass=(["'])(.*?)\1/i);
        if (!classMatch) {
            return match;
        }

        const { lucide, brand, preserved, spin } = convertClassString(classMatch[2]);
        if (!lucide && !brand) {
            return match;
        }

        if (brand) {
            const classAttr = preserved.length ? ` class="${preserved.join(' ')}"` : '';
            const extra = attrs.replace(classMatch[0], '').trim();
            const extraAttrs = extra ? ` ${extra}` : '';
            return `<x-brand-icon name="${brand}"${classAttr}${extraAttrs} />`;
        }

        const classNames = [...preserved, spin ? 'lucide-spin' : ''].filter(Boolean).join(' ');
        let nextAttrs = attrs.replace(classMatch[0], '').trim();
        if (classNames) {
            nextAttrs = ` class="${classNames}" ${nextAttrs}`.trim();
        }
        return `<i data-lucide="${lucide}"${nextAttrs ? ' ' + nextAttrs : ''}>`;
    });

    updated = updated.replace(/data-feather=\"([a-z0-9-]+)\"/gi, (_, icon) => `data-lucide="${icon}"`);

    updated = updated.replace(/\$btn\.find\('i'\)\.attr\('class', 'fa fa-check'\)/g, "$btn.find('i').attr('data-lucide', 'check').removeAttr('class'); window.refreshLucideIcons && window.refreshLucideIcons($btn[0])");
    updated = updated.replace(/\$btn\.find\('i'\)\.attr\('class', 'fa fa-credit-card'\)/g, "$btn.find('i').attr('data-lucide', 'credit-card').removeAttr('class'); window.refreshLucideIcons && window.refreshLucideIcons($btn[0])");
    updated = updated.replace(/\.html\('<i class=\\"fa fa-tag me-1\\"><\/i>Apply'\)/g, ".html('<i data-lucide=\\\"tag\\\" class=\\\"me-1\\\" aria-hidden=\\\"true\\\"></i>Apply')");
    updated = updated.replace(/\.html\('<i class=\\"fa fa-refresh me-2\\"><\/i>Reset'\)/g, ".html('<i data-lucide=\\\"refresh-cw\\\" class=\\\"me-2\\\" aria-hidden=\\\"true\\\"></i>Reset')");
    updated = updated.replace(/icon\.className\s*=\s*['"]fas fa-spinner fa-spin['"]/g, "window.setLucideIcon(icon, 'loader-2', { spin: true })");
    updated = updated.replace(/className\s*=\s*['"]fas fa-spinner fa-spin['"]/g, "setAttribute('data-lucide', 'loader-2'); className='lucide-spin'");
    updated = updated.replace(/innerHTML\s*=\s*['"]<i class=\"fas fa-spinner fa-spin\"><\/i>/g, "innerHTML='<i data-lucide=\"loader-2\" class=\"lucide-spin\" aria-hidden=\"true\"></i>");
    updated = updated.replace(/innerHTML\s*=\s*['"]<i class=\"fas fa-check\"><\/i>/g, "innerHTML='<i data-lucide=\"check\" aria-hidden=\"true\"></i>");
    updated = updated.replace(/me\.html\('<i class=\"fas fa-minus\"><\/i>'\)/g, "me.html('<i data-lucide=\"minus\" aria-hidden=\"true\"></i>')");
    updated = updated.replace(/me\.html\('<i class=\"fas fa-plus\"><\/i>'\)/g, "me.html('<i data-lucide=\"plus\" aria-hidden=\"true\"></i>')");
    updated = updated.replace(/up:\s*\"fas fa-chevron-up\"/g, 'up: "chevron-up"');
    updated = updated.replace(/down:\s*\"fas fa-chevron-down\"/g, 'down: "chevron-down"');

    return updated;
}

let changedFiles = 0;
for (const file of walk(root)) {
    const original = fs.readFileSync(file, 'utf8');
    const migrated = migrateContent(original);
    if (migrated !== original) {
        fs.writeFileSync(file, migrated, 'utf8');
        changedFiles++;
        console.log('Updated:', path.relative(root, file));
    }
}

console.log(`Migration complete. ${changedFiles} file(s) updated.`);
