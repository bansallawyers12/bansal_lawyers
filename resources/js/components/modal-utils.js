// Modern Modal Utilities - Alpine.js
// Replaces jQuery modal functionality

export const modalUtils = {
    // Show modal
    show(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) {
            console.error(`Modal with ID "${modalId}" not found`);
            return false;
        }

        // Remove hidden class and add show class
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Add backdrop
        this.addBackdrop(modal);
        
        // Focus first input
        const firstInput = modal.querySelector('input, select, textarea');
        if (firstInput) {
            setTimeout(() => firstInput.focus(), 100);
        }

        // Dispatch event
        modal.dispatchEvent(new CustomEvent('modal:show', { detail: { modalId } }));
        
        return true;
    },

    // Hide modal
    hide(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) {
            console.error(`Modal with ID "${modalId}" not found`);
            return false;
        }

        // Add hidden class and remove show class
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        
        // Remove backdrop
        this.removeBackdrop(modal);

        // Dispatch event
        modal.dispatchEvent(new CustomEvent('modal:hide', { detail: { modalId } }));
        
        return true;
    },

    // Toggle modal
    toggle(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return false;

        if (modal.classList.contains('hidden')) {
            return this.show(modalId);
        } else {
            return this.hide(modalId);
        }
    },

    // Add backdrop
    addBackdrop(modal) {
        if (modal.querySelector('.modal-backdrop')) return;

        const backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fixed inset-0 bg-black bg-opacity-50 z-40';
        backdrop.addEventListener('click', () => {
            this.hide(modal.id);
        });

        modal.parentNode.insertBefore(backdrop, modal);
    },

    // Remove backdrop
    removeBackdrop(modal) {
        const backdrop = modal.parentNode.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
    },

    // Check if modal is open
    isOpen(modalId) {
        const modal = document.getElementById(modalId);
        return modal && !modal.classList.contains('hidden');
    },

    // Close all modals
    closeAll() {
        const modals = document.querySelectorAll('.modal:not(.hidden)');
        modals.forEach(modal => {
            this.hide(modal.id);
        });
    },

    // Initialize modal triggers
    init() {
        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeAll();
            }
        });

        // Handle data attributes
        document.addEventListener('click', (e) => {
            const target = e.target.closest('[data-modal-target]');
            if (target) {
                e.preventDefault();
                const modalId = target.getAttribute('data-modal-target');
                this.show(modalId);
            }

            const closeBtn = e.target.closest('[data-modal-close]');
            if (closeBtn) {
                e.preventDefault();
                const modalId = closeBtn.getAttribute('data-modal-close');
                this.hide(modalId);
            }
        });
    }
};

// Alpine.js component for modal functionality
export const modalComponent = () => ({
    modalId: '',
    isOpen: false,
    backdrop: true,
    closeOnEscape: true,
    closeOnBackdrop: true,

    init() {
        this.modalId = this.$el.id;
        
        // Listen for escape key
        if (this.closeOnEscape) {
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && this.isOpen) {
                    this.hide();
                }
            });
        }

        // Listen for backdrop clicks
        if (this.closeOnBackdrop) {
            this.$el.addEventListener('click', (e) => {
                if (e.target === this.$el) {
                    this.hide();
                }
            });
        }
    },

    show() {
        this.isOpen = true;
        this.$el.classList.remove('hidden');
        this.$el.classList.add('flex');
        
        if (this.backdrop) {
            modalUtils.addBackdrop(this.$el);
        }

        this.$dispatch('modal:show', { modalId: this.modalId });
    },

    hide() {
        this.isOpen = false;
        this.$el.classList.add('hidden');
        this.$el.classList.remove('flex');
        
        if (this.backdrop) {
            modalUtils.removeBackdrop(this.$el);
        }

        this.$dispatch('modal:hide', { modalId: this.modalId });
    },

    toggle() {
        if (this.isOpen) {
            this.hide();
        } else {
            this.show();
        }
    }
});

// Loading utilities
export const loadingUtils = {
    show(element = null) {
        const target = element || document.querySelector('.popuploader');
        if (target) {
            target.style.display = 'block';
            target.classList.remove('hidden');
        }
    },

    hide(element = null) {
        const target = element || document.querySelector('.popuploader');
        if (target) {
            target.style.display = 'none';
            target.classList.add('hidden');
        }
    },

    toggle(element = null) {
        const target = element || document.querySelector('.popuploader');
        if (target) {
            if (target.style.display === 'none' || target.classList.contains('hidden')) {
                this.show(target);
            } else {
                this.hide(target);
            }
        }
    }
};

// Alpine.js component for loading states
export const loadingComponent = () => ({
    isLoading: false,
    loadingText: 'Loading...',

    show(text = null) {
        this.isLoading = true;
        if (text) this.loadingText = text;
        loadingUtils.show();
    },

    hide() {
        this.isLoading = false;
        loadingUtils.hide();
    },

    toggle() {
        if (this.isLoading) {
            this.hide();
        } else {
            this.show();
        }
    }
});

// Global modal utilities
window.modalUtils = modalUtils;
window.modalComponent = modalComponent;
window.loadingUtils = loadingUtils;
window.loadingComponent = loadingComponent;
