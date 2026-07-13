// Modern AJAX Utilities - Alpine.js + Axios
// Replaces jQuery AJAX functionality

import axios from 'axios';

export const ajaxUtils = {
    // Default configuration
    defaults: {
        timeout: 30000,
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    },

    // Get CSRF token
    getCSRFToken() {
        const token = document.querySelector('meta[name="csrf-token"]');
        return token ? token.getAttribute('content') : null;
    },

    // Set up default headers
    setupDefaults() {
        const csrfToken = this.getCSRFToken();
        if (csrfToken) {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
        }
        
        // Set default timeout
        axios.defaults.timeout = this.defaults.timeout;
        
        // Set default headers
        Object.assign(axios.defaults.headers.common, this.defaults.headers);
    },

    // GET request
    async get(url, config = {}) {
        try {
            this.setupDefaults();
            const response = await axios.get(url, config);
            return {
                success: true,
                data: response.data,
                status: response.status,
                headers: response.headers
            };
        } catch (error) {
            return this.handleError(error);
        }
    },

    // POST request
    async post(url, data = {}, config = {}) {
        try {
            this.setupDefaults();
            const response = await axios.post(url, data, config);
            return {
                success: true,
                data: response.data,
                status: response.status,
                headers: response.headers
            };
        } catch (error) {
            return this.handleError(error);
        }
    },

    // PUT request
    async put(url, data = {}, config = {}) {
        try {
            this.setupDefaults();
            const response = await axios.put(url, data, config);
            return {
                success: true,
                data: response.data,
                status: response.status,
                headers: response.headers
            };
        } catch (error) {
            return this.handleError(error);
        }
    },

    // DELETE request
    async delete(url, config = {}) {
        try {
            this.setupDefaults();
            const response = await axios.delete(url, config);
            return {
                success: true,
                data: response.data,
                status: response.status,
                headers: response.headers
            };
        } catch (error) {
            return this.handleError(error);
        }
    },

    // PATCH request
    async patch(url, data = {}, config = {}) {
        try {
            this.setupDefaults();
            const response = await axios.patch(url, data, config);
            return {
                success: true,
                data: response.data,
                status: response.status,
                headers: response.headers
            };
        } catch (error) {
            return this.handleError(error);
        }
    },

    // Handle errors
    handleError(error) {
        console.error('AJAX Error:', error);
        
        if (error.response) {
            // Server responded with error status
            return {
                success: false,
                error: error.response.data?.message || 'Server error',
                status: error.response.status,
                data: error.response.data
            };
        } else if (error.request) {
            // Request was made but no response received
            return {
                success: false,
                error: 'Network error - no response received',
                status: 0,
                data: null
            };
        } else {
            // Something else happened
            return {
                success: false,
                error: error.message || 'Unknown error',
                status: 0,
                data: null
            };
        }
    },

    // Upload file with progress
    async uploadFile(url, file, onProgress = null, config = {}) {
        try {
            this.setupDefaults();
            
            const formData = new FormData();
            formData.append('file', file);
            
            const uploadConfig = {
                ...config,
                headers: {
                    'Content-Type': 'multipart/form-data',
                    ...config.headers
                },
                onUploadProgress: (progressEvent) => {
                    if (onProgress) {
                        const percentCompleted = Math.round(
                            (progressEvent.loaded * 100) / progressEvent.total
                        );
                        onProgress(percentCompleted);
                    }
                }
            };

            const response = await axios.post(url, formData, uploadConfig);
            return {
                success: true,
                data: response.data,
                status: response.status
            };
        } catch (error) {
            return this.handleError(error);
        }
    },

    // Batch requests
    async batch(requests) {
        try {
            this.setupDefaults();
            const responses = await Promise.allSettled(requests);
            
            return responses.map((response, index) => {
                if (response.status === 'fulfilled') {
                    return {
                        success: true,
                        data: response.value.data,
                        status: response.value.status
                    };
                } else {
                    return this.handleError(response.reason);
                }
            });
        } catch (error) {
            return this.handleError(error);
        }
    }
};

// Alpine.js component for AJAX operations
export const ajaxComponent = () => ({
    isLoading: false,
    error: null,
    data: null,

    async request(method, url, data = null, config = {}) {
        this.isLoading = true;
        this.error = null;
        this.data = null;

        try {
            let response;
            
            switch (method.toLowerCase()) {
                case 'get':
                    response = await ajaxUtils.get(url, config);
                    break;
                case 'post':
                    response = await ajaxUtils.post(url, data, config);
                    break;
                case 'put':
                    response = await ajaxUtils.put(url, data, config);
                    break;
                case 'delete':
                    response = await ajaxUtils.delete(url, config);
                    break;
                case 'patch':
                    response = await ajaxUtils.patch(url, data, config);
                    break;
                default:
                    throw new Error(`Unsupported HTTP method: ${method}`);
            }

            if (response.success) {
                this.data = response.data;
                this.$dispatch('ajax-success', response);
            } else {
                this.error = response.error;
                this.$dispatch('ajax-error', response);
            }

            return response;
        } catch (error) {
            this.error = error.message;
            this.$dispatch('ajax-error', { error: error.message });
            return { success: false, error: error.message };
        } finally {
            this.isLoading = false;
        }
    },

    // Convenience methods
    async get(url, config = {}) {
        return this.request('GET', url, null, config);
    },

    async post(url, data = {}, config = {}) {
        return this.request('POST', url, data, config);
    },

    async put(url, data = {}, config = {}) {
        return this.request('PUT', url, data, config);
    },

    async delete(url, config = {}) {
        return this.request('DELETE', url, null, config);
    },

    async patch(url, data = {}, config = {}) {
        return this.request('PATCH', url, data, config);
    }
});

// Global AJAX utilities
window.ajaxUtils = ajaxUtils;
window.ajaxComponent = ajaxComponent;
