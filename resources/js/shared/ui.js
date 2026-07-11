const TOAST_STYLES = {
    success: 'bg-emerald-600 text-white',
    error: 'bg-red-600 text-white',
    info: 'bg-[#1B4D89] text-white',
    warning: 'bg-amber-600 text-white',
};

function ensureToastContainer() {
    if (!document.body) {
        return null;
    }
    let container = document.getElementById('ui-toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'ui-toast-container';
        container.className =
            'fixed z-[100] flex flex-col gap-2 pointer-events-none max-sm:inset-x-4 max-sm:bottom-4 sm:top-4 sm:right-4 sm:max-w-sm sm:w-full';
        container.setAttribute('aria-live', 'polite');
        document.body.appendChild(container);
    }
    return container;
}

export function toastMsg(message, type = 'info', duration = 4000) {
    const container = ensureToastContainer();
    if (!container) {
        return;
    }

    const toast = document.createElement('div');
    toast.setAttribute('role', 'alert');
    toast.className = `pointer-events-auto p-4 rounded-lg shadow-lg text-sm font-medium transition-opacity duration-300 ${
        TOAST_STYLES[type] || TOAST_STYLES.info
    }`;
    toast.textContent = message;
    container.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

export function showOverlay(type, message) {
    const existing = document.getElementById('booking-message-overlay');
    if (existing) {
        existing.remove();
    }

    const isSuccess = type === 'success';
    const overlay = document.createElement('div');
    overlay.id = 'booking-message-overlay';
    overlay.className =
        'fixed inset-0 z-[200] flex items-center justify-center bg-black/70 p-4';
    overlay.innerHTML = `
        <div class="bg-white rounded-xl p-8 max-w-md w-full text-center shadow-2xl">
            <div class="text-5xl mb-4 ${isSuccess ? 'text-emerald-600' : 'text-red-600'}">
                <i data-lucide="${isSuccess ? 'circle-check' : 'triangle-alert'}"></i>
            </div>
            <h3 class="text-xl font-bold mb-3 ${isSuccess ? 'text-emerald-700' : 'text-red-700'}">${isSuccess ? 'Success' : 'Error'}</h3>
            <p class="text-gray-700 mb-6">${message}</p>
            <button type="button" class="booking-btn booking-btn-primary" data-close-overlay>OK</button>
        </div>
    `;
    document.body.appendChild(overlay);
    overlay.querySelector('[data-close-overlay]')?.addEventListener('click', () => overlay.remove());
    if (typeof window.refreshLucideIcons === 'function') {
        window.refreshLucideIcons(overlay);
    }
}
