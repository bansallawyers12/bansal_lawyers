let turnstilePromise = null;

/**
 * Load Cloudflare Turnstile only when a form needs it (not on every page).
 */
export function loadTurnstile() {
    if (window.turnstile) {
        return Promise.resolve(window.turnstile);
    }

    if (turnstilePromise) {
        return turnstilePromise;
    }

    turnstilePromise = new Promise((resolve, reject) => {
        const existing = document.querySelector(
            'script[src*="challenges.cloudflare.com/turnstile"]'
        );

        if (existing) {
            if (window.turnstile) {
                resolve(window.turnstile);
                return;
            }
            existing.addEventListener('load', () => resolve(window.turnstile));
            existing.addEventListener('error', reject);
            return;
        }

        const script = document.createElement('script');
        script.src = 'https://challenges.cloudflare.com/turnstile/v0/api.js';
        script.async = true;
        script.defer = true;
        script.onload = () => resolve(window.turnstile);
        script.onerror = () => reject(new Error('Turnstile failed to load'));
        document.head.appendChild(script);
    });

    return turnstilePromise;
}
