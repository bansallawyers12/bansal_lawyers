// Modern Select Component - Alpine.js + Tom Select
// Replaces Select2 functionality

// Dynamic import for Tom Select to avoid blocking page load
let TomSelect = null;

export const modernSelect = {
    // Default configuration
    defaultConfig: {
        create: false,
        sortField: 'text',
        searchField: 'text',
        valueField: 'value',
        labelField: 'text',
        placeholder: 'Select an option',
        allowEmptyOption: true,
        closeAfterSelect: true,
        hideSelected: true,
        highlight: true,
        loadingClass: 'loading',
        noResultsText: 'No results found',
        noResultsLoadingText: 'Searching...',
        dropdownParent: 'body',
        controlInput: null,
        render: {
            no_results: function(data, escape) {
                return '<div class="no-results">No results found for "' + escape(data.input) + '"</div>';
            },
            loading: function() {
                return '<div class="loading">Searching...</div>';
            }
        }
    },

    // AJAX configuration for remote data
    ajaxConfig: {
        url: '',
        method: 'GET',
        params: {},
        headers: {},
        processResults: function(response) {
            return {
                results: response.data || response,
                pagination: response.pagination || {}
            };
        },
        cache: false
    },

    // Initialize a select element
    async init(selector, options = {}) {
        // Load Tom Select if not already loaded
        if (!TomSelect) {
            try {
                const TomSelectModule = await import('tom-select');
                TomSelect = TomSelectModule.default;
            } catch (error) {
                console.warn('Tom Select not available, falling back to native select:', error);
                return this.initNativeSelect(selector, options);
            }
        }

        const elements = document.querySelectorAll(selector);
        const instances = [];

        elements.forEach(element => {
            if (element.tomselect) {
                element.tomselect.destroy();
            }

            const config = { ...this.defaultConfig, ...options };
            
            // Handle AJAX if URL is provided
            if (config.url) {
                config.load = (query, callback) => {
                    this.loadAjaxData(query, config, callback);
                };
            }

            try {
                const instance = new TomSelect(element, config);
                element.tomselect = instance;
                instances.push(instance);
            } catch (error) {
                console.error('Failed to initialize TomSelect:', error);
                // Fallback to native select
                this.initNativeSelect(selector, options);
            }
        });

        return instances;
    },

    // Fallback to native select functionality
    initNativeSelect(selector, options = {}) {
        const elements = document.querySelectorAll(selector);
        elements.forEach(element => {
            // Add basic styling and functionality
            element.classList.add('modern-select-native');
            element.style.width = '100%';
            element.style.padding = '8px 12px';
            element.style.border = '1px solid #d1d5db';
            element.style.borderRadius = '6px';
            element.style.backgroundColor = '#fff';
        });
        return [];
    },

    // Load data via AJAX
    async loadAjaxData(query, config, callback) {
        try {
            const params = {
                ...config.ajaxConfig.params,
                q: query,
                page: 1
            };

            const url = new URL(config.ajaxConfig.url);
            Object.keys(params).forEach(key => 
                url.searchParams.append(key, params[key])
            );

            const response = await fetch(url, {
                method: config.ajaxConfig.method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    ...config.ajaxConfig.headers
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            const processedData = config.ajaxConfig.processResults(data);
            
            callback(processedData.results);
        } catch (error) {
            console.error('AJAX load error:', error);
            callback([]);
        }
    },

    // Initialize with custom template
    initWithTemplate(selector, template, options = {}) {
        const config = {
            ...this.defaultConfig,
            ...options,
            render: {
                ...this.defaultConfig.render,
                ...template
            }
        };

        return this.init(selector, config);
    },

    // Destroy all instances
    destroy(selector) {
        const elements = document.querySelectorAll(selector);
        elements.forEach(element => {
            if (element.tomselect) {
                element.tomselect.destroy();
                element.tomselect = null;
            }
        });
    },

    // Get instance
    getInstance(selector) {
        const element = document.querySelector(selector);
        return element?.tomselect || null;
    }
};

// Alpine.js component for modern select
export const modernSelectComponent = () => ({
    selector: '',
    config: {},
    instance: null,
    isLoading: false,
    searchQuery: '',

    init() {
        this.selector = this.$el.getAttribute('data-selector') || '.modern-select';
        this.config = this.getConfig();
        
        this.$nextTick(() => {
            this.initializeSelect();
        });
    },

    getConfig() {
        const config = {
            placeholder: this.$el.getAttribute('data-placeholder') || 'Select an option',
            url: this.$el.getAttribute('data-url') || null,
            multiple: this.$el.hasAttribute('data-multiple'),
            searchable: !this.$el.hasAttribute('data-no-search'),
            clearable: this.$el.hasAttribute('data-clearable')
        };

        if (config.url) {
            config.ajaxConfig = {
                url: config.url,
                method: 'GET',
                processResults: (response) => ({
                    results: response.data || response,
                    pagination: response.pagination || {}
                })
            };
        }

        return config;
    },

    initializeSelect() {
        try {
            const instances = modernSelect.init(this.selector, this.config);
            this.instance = instances[0];
            
            if (this.instance) {
                this.setupEventListeners();
            }
        } catch (error) {
            console.error('Failed to initialize modern select:', error);
        }
    },

    setupEventListeners() {
        if (!this.instance) return;

        this.instance.on('loading', () => {
            this.isLoading = true;
        });

        this.instance.on('loaded', () => {
            this.isLoading = false;
        });

        this.instance.on('change', (value) => {
            this.$dispatch('select-changed', { value, instance: this.instance });
        });

        this.instance.on('search', (query) => {
            this.searchQuery = query;
            this.$dispatch('select-search', { query, instance: this.instance });
        });
    },

    // Public methods
    addOption(option) {
        if (this.instance) {
            this.instance.addOption(option);
        }
    },

    addOptions(options) {
        if (this.instance) {
            this.instance.addOptions(options);
        }
    },

    setValue(value) {
        if (this.instance) {
            this.instance.setValue(value);
        }
    },

    getValue() {
        return this.instance?.getValue() || null;
    },

    clear() {
        if (this.instance) {
            this.instance.clear();
        }
    },

    enable() {
        if (this.instance) {
            this.instance.enable();
        }
    },

    disable() {
        if (this.instance) {
            this.instance.disable();
        }
    },

    destroy() {
        if (this.instance) {
            this.instance.destroy();
            this.instance = null;
        }
    }
});

// Global modern select utilities
window.modernSelect = modernSelect;
window.modernSelectComponent = modernSelectComponent;
