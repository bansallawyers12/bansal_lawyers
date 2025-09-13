/**
 * Enhanced Lazy Loading System for Bansal Lawyers
 * Handles images, CSS, and JavaScript lazy loading with performance optimizations
 */

class LazyLoader {
    constructor(options = {}) {
        this.options = {
            rootMargin: '50px 0px',
            threshold: 0.1,
            enableImages: true,
            enableCSS: true,
            enableJS: true,
            enableBackgroundImages: true,
            retryAttempts: 3,
            retryDelay: 1000,
            ...options
        };
        
        this.observers = new Map();
        this.loadedResources = new Set();
        this.failedResources = new Set();
        this.retryCount = new Map();
        
        this.init();
    }
    
    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupObservers());
        } else {
            this.setupObservers();
        }
    }
    
    setupObservers() {
        if (this.options.enableImages) {
            this.setupImageObserver();
        }
        
        if (this.options.enableCSS) {
            this.setupCSSObserver();
        }
        
        if (this.options.enableJS) {
            this.setupJSObserver();
        }
        
        if (this.options.enableBackgroundImages) {
            this.setupBackgroundImageObserver();
        }
    }
    
    setupImageObserver() {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.loadImage(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: this.options.rootMargin,
            threshold: this.options.threshold
        });
        
        this.observers.set('images', imageObserver);
        
        // Observe all lazy images
        document.querySelectorAll('img[data-src], img.lazy-image').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    setupCSSObserver() {
        const cssObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.loadCSS(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: this.options.rootMargin,
            threshold: this.options.threshold
        });
        
        this.observers.set('css', cssObserver);
        
        // Observe elements that need CSS loading
        document.querySelectorAll('[data-lazy-css]').forEach(element => {
            cssObserver.observe(element);
        });
    }
    
    setupJSObserver() {
        const jsObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.loadJS(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: this.options.rootMargin,
            threshold: this.options.threshold
        });
        
        this.observers.set('js', jsObserver);
        
        // Observe elements that need JS loading
        document.querySelectorAll('[data-lazy-js]').forEach(element => {
            jsObserver.observe(element);
        });
    }
    
    setupBackgroundImageObserver() {
        const bgObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.loadBackgroundImage(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: this.options.rootMargin,
            threshold: this.options.threshold
        });
        
        this.observers.set('background', bgObserver);
        
        // Observe elements with lazy background images
        document.querySelectorAll('[data-bg-src]').forEach(element => {
            bgObserver.observe(element);
        });
    }
    
    async loadImage(img) {
        const src = img.dataset.src || img.src;
        const fallback = img.dataset.fallback;
        
        if (this.loadedResources.has(src) || this.failedResources.has(src)) {
            return;
        }
        
        try {
            // Add loading class
            img.classList.add('loading');
            
            // Create a new image to test loading
            const testImg = new Image();
            
            await new Promise((resolve, reject) => {
                testImg.onload = () => {
                    // Image loaded successfully
                    img.src = src;
                    img.classList.remove('loading');
                    img.classList.add('loaded');
                    this.loadedResources.add(src);
                    resolve();
                };
                
                testImg.onerror = () => {
                    // Image failed to load
                    if (fallback) {
                        img.src = fallback;
                        img.classList.add('fallback');
                    } else {
                        img.classList.add('error');
                    }
                    img.classList.remove('loading');
                    this.failedResources.add(src);
                    reject(new Error(`Failed to load image: ${src}`));
                };
                
                testImg.src = src;
            });
            
        } catch (error) {
            console.warn('Image loading failed:', error);
            this.handleRetry('image', src, () => this.loadImage(img));
        }
    }
    
    async loadCSS(element) {
        const cssFiles = element.dataset.lazyCss;
        if (!cssFiles) return;
        
        const files = cssFiles.split(',').map(file => file.trim());
        
        for (const file of files) {
            if (this.loadedResources.has(file)) continue;
            
            try {
                await this.loadCSSFile(file);
                this.loadedResources.add(file);
            } catch (error) {
                console.warn('CSS loading failed:', error);
                this.handleRetry('css', file, () => this.loadCSSFile(file));
            }
        }
    }
    
    async loadCSSFile(href) {
        return new Promise((resolve, reject) => {
            // Check if already loaded
            if (document.querySelector(`link[href="${href}"]`)) {
                resolve();
                return;
            }
            
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = href;
            link.onload = resolve;
            link.onerror = reject;
            document.head.appendChild(link);
        });
    }
    
    async loadJS(element) {
        const jsFiles = element.dataset.lazyJs;
        if (!jsFiles) return;
        
        const files = jsFiles.split(',').map(file => file.trim());
        
        for (const file of files) {
            if (this.loadedResources.has(file)) continue;
            
            try {
                await this.loadJSFile(file);
                this.loadedResources.add(file);
            } catch (error) {
                console.warn('JS loading failed:', error);
                this.handleRetry('js', file, () => this.loadJSFile(file));
            }
        }
    }
    
    async loadJSFile(src) {
        return new Promise((resolve, reject) => {
            // Check if already loaded
            if (document.querySelector(`script[src="${src}"]`)) {
                resolve();
                return;
            }
            
            const script = document.createElement('script');
            script.src = src;
            script.async = true;
            script.onload = resolve;
            script.onerror = reject;
            document.head.appendChild(script);
        });
    }
    
    async loadBackgroundImage(element) {
        const bgSrc = element.dataset.bgSrc;
        if (!bgSrc || this.loadedResources.has(bgSrc)) return;
        
        try {
            // Test if image exists
            const testImg = new Image();
            await new Promise((resolve, reject) => {
                testImg.onload = () => {
                    element.style.backgroundImage = `url(${bgSrc})`;
                    element.classList.add('bg-loaded');
                    this.loadedResources.add(bgSrc);
                    resolve();
                };
                testImg.onerror = reject;
                testImg.src = bgSrc;
            });
        } catch (error) {
            console.warn('Background image loading failed:', error);
            this.handleRetry('background', bgSrc, () => this.loadBackgroundImage(element));
        }
    }
    
    handleRetry(type, resource, retryFunction) {
        const key = `${type}:${resource}`;
        const currentRetries = this.retryCount.get(key) || 0;
        
        if (currentRetries < this.options.retryAttempts) {
            this.retryCount.set(key, currentRetries + 1);
            setTimeout(retryFunction, this.options.retryDelay * (currentRetries + 1));
        }
    }
    
    // Public methods for manual control
    loadResourceImmediately(resource, type = 'image') {
        switch (type) {
            case 'image':
                const img = document.querySelector(`img[data-src="${resource}"]`);
                if (img) this.loadImage(img);
                break;
            case 'css':
                this.loadCSSFile(resource);
                break;
            case 'js':
                this.loadJSFile(resource);
                break;
        }
    }
    
    preloadResource(resource, type = 'image') {
        if (this.loadedResources.has(resource)) return;
        
        switch (type) {
            case 'image':
                const link = document.createElement('link');
                link.rel = 'preload';
                link.as = 'image';
                link.href = resource;
                document.head.appendChild(link);
                break;
            case 'css':
                this.loadCSSFile(resource);
                break;
            case 'js':
                this.loadJSFile(resource);
                break;
        }
    }
    
    // Cleanup method
    destroy() {
        this.observers.forEach(observer => observer.disconnect());
        this.observers.clear();
    }
}

// Auto-initialize lazy loader
const lazyLoader = new LazyLoader({
    rootMargin: '100px 0px',
    threshold: 0.1,
    enableImages: true,
    enableCSS: true,
    enableJS: true,
    enableBackgroundImages: true,
    retryAttempts: 2,
    retryDelay: 1000
});

// Export for global access
window.LazyLoader = LazyLoader;
window.lazyLoader = lazyLoader;

// Performance monitoring
if (window.performance && window.performance.mark) {
    window.performance.mark('lazy-loader-init');
}

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = LazyLoader;
}
