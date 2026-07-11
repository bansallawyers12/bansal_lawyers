/**
 * Admin HTTP helper — Axios with form-urlencoded (Laravel admin actions expect this).
 * Phase 5: replaces $.ajax in admin CRUD / Blade scripts.
 */
import axios from 'axios';

function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
}

export function siteUrl() {
    return typeof window.site_url !== 'undefined' ? String(window.site_url).replace(/\/$/, '') : '';
}

export function showLoader() {
    document.querySelectorAll('.popuploader, #loader').forEach((el) => {
        el.style.display = 'block';
        el.classList.remove('hidden-loader');
    });
}

export function hideLoader() {
    document.querySelectorAll('.popuploader').forEach((el) => {
        el.style.display = 'none';
        el.classList.add('hidden-loader');
    });
    const loader = document.getElementById('loader');
    if (loader) {
        loader.style.display = 'none';
    }
}

export function setHtml(selector, html) {
    document.querySelectorAll(selector).forEach((el) => {
        el.innerHTML = html;
    });
}

export function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

/**
 * POST as application/x-www-form-urlencoded (jQuery $.ajax default).
 * Returns parsed JSON body (object) or throws.
 */
export async function adminPost(url, data = {}) {
    const body = new URLSearchParams();
    Object.entries(data).forEach(([key, value]) => {
        if (value === undefined || value === null) return;
        body.append(key, String(value));
    });
    if (!body.has('_token') && csrfToken()) {
        body.append('_token', csrfToken());
    }

    const response = await axios.post(url, body, {
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': csrfToken(),
            'X-Requested-With': 'XMLHttpRequest',
            Accept: 'application/json, text/javascript, */*; q=0.01',
        },
        // Laravel may return JSON string or object
        transformResponse: [
            (data) => {
                if (typeof data !== 'string') return data;
                try {
                    return JSON.parse(data);
                } catch {
                    return data;
                }
            },
        ],
    });

    return response.data;
}

window.adminHttp = {
    post: adminPost,
    siteUrl,
    showLoader,
    hideLoader,
    setHtml,
    scrollToTop,
    csrfToken,
};
