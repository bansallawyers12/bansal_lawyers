// Alpine.js Data Component for Tom Select
// Use in Blade templates: x-data="tomSelect({ placeholder: 'Select...' })"

// Dynamic import for Tom Select
let TomSelect = null;

export function tomSelect(options = {}) {
    return {
        selected: null,
        instance: null,
        isLoading: false,
        
        async init() {
            // Import Tom Select dynamically
            if (!TomSelect) {
                try {
                    const TomSelectModule = await import('tom-select');
                    TomSelect = TomSelectModule.default;
                } catch (error) {
                    console.error('Tom Select not available:', error);
                    return;
                }
            }
            
            // Wait for Alpine to finish rendering
            this.$nextTick(() => {
                if (!this.$el) return;
                
                const config = {
                    plugins: ['clear_button'],
                    placeholder: options.placeholder || 'Select an option',
                    allowEmptyOption: true,
                    closeAfterSelect: options.closeAfterSelect !== false,
                    ...options
                };
                
                try {
                    this.instance = new TomSelect(this.$el, config);
                    
                    // Sync with Alpine.js data
                    if (this.$el.value) {
                        this.selected = this.$el.value;
                    }
                    
                    // Listen for changes
                    this.instance.on('change', (value) => {
                        this.selected = value;
                        this.$dispatch('tom-select:change', { value });
                    });
                } catch (error) {
                    console.error('Failed to initialize Tom Select:', error);
                }
            });
        },
        
        destroy() {
            if (this.instance) {
                this.instance.destroy();
                this.instance = null;
            }
        }
    };
}

// Export for use in admin.js
export { tomSelect };

