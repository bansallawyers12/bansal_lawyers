/**
 * Enhanced Performance Monitor for Bansal Lawyers Website
 * Tracks build system optimizations, asset loading performance, and Core Web Vitals
 */

class PerformanceMonitor {
    constructor() {
        this.metrics = {
            buildOptimizations: {},
            assetLoading: {},
            coreWebVitals: {},
            userExperience: {},
            systemResources: {}
        };
        
        this.startTime = performance.now();
        this.assetLoadTimes = new Map();
        this.init();
    }

    init() {
        this.trackBuildSystemPerformance();
        this.trackAssetLoadingStrategy();
        this.trackCoreWebVitals();
        this.trackUserInteractions();
        this.trackSystemResources();
        this.trackCachePerformance();
    }

    trackBuildSystemPerformance() {
        // Track Vite build optimizations
        const buildMetrics = {
            criticalCSSLoaded: false,
            lazyAssetsLoaded: 0,
            totalAssetsLoaded: 0,
            chunkingStrategy: 'optimized'
        };

        // Monitor critical CSS loading
        const criticalCSSLink = document.querySelector('link[href*="critical.css"]');
        if (criticalCSSLink) {
            buildMetrics.criticalCSSLoaded = true;
        }

        // Track asset loading from manifest
        if (window.__VITE_MANIFEST__) {
            const manifest = window.__VITE_MANIFEST__;
            buildMetrics.totalAssetsInManifest = Object.keys(manifest).length;
            
            // Track chunk loading
            Object.entries(manifest).forEach(([key, value]) => {
                if (value.isEntry) {
                    buildMetrics.entryPoints = buildMetrics.entryPoints || 0;
                    buildMetrics.entryPoints++;
                }
            });
        }

        this.metrics.buildOptimizations = buildMetrics;
    }

    trackAssetLoadingStrategy() {
        const assetMetrics = {
            strategy: window.AssetLoader?.strategy || 'default',
            preloadedAssets: 0,
            lazyLoadedAssets: 0,
            failedAssets: 0,
            cacheHits: 0,
            networkRequests: 0
        };

        // Track resource loading
        const observer = new PerformanceObserver((list) => {
            list.getEntries().forEach(entry => {
                if (entry.initiatorType === 'link' || entry.initiatorType === 'script') {
                    assetMetrics.networkRequests++;
                    
                    if (entry.transferSize === 0) {
                        assetMetrics.cacheHits++;
                    }
                    
                    // Track lazy vs immediate loading
                    if (entry.name.includes('lazy') || entry.name.includes('defer')) {
                        assetMetrics.lazyLoadedAssets++;
                    } else {
                        assetMetrics.preloadedAssets++;
                    }
                    
                    this.assetLoadTimes.set(entry.name, {
                        loadTime: entry.responseEnd - entry.requestStart,
                        size: entry.transferSize,
                        cached: entry.transferSize === 0
                    });
                }
            });
        });

        observer.observe({ entryTypes: ['resource'] });
        
        this.metrics.assetLoading = assetMetrics;
    }

    trackCoreWebVitals() {
        const vitals = {};

        if ('PerformanceObserver' in window) {
            // Largest Contentful Paint (LCP)
            try {
                const lcpObserver = new PerformanceObserver((entryList) => {
                    const entries = entryList.getEntries();
                    const lastEntry = entries[entries.length - 1];
                    vitals.lcp = Math.round(lastEntry.startTime);
                    vitals.lcpElement = lastEntry.element?.tagName || 'unknown';
                });
                lcpObserver.observe({ entryTypes: ['largest-contentful-paint'] });
            } catch (e) {
                console.warn('LCP tracking not supported');
            }

            // First Input Delay (FID)
            try {
                const fidObserver = new PerformanceObserver((entryList) => {
                    const entries = entryList.getEntries();
                    entries.forEach(entry => {
                        vitals.fid = Math.round(entry.processingStart - entry.startTime);
                        vitals.fidEventType = entry.name;
                    });
                });
                fidObserver.observe({ entryTypes: ['first-input'] });
            } catch (e) {
                console.warn('FID tracking not supported');
            }

            // Cumulative Layout Shift (CLS)
            try {
                let clsValue = 0;
                const clsObserver = new PerformanceObserver((entryList) => {
                    const entries = entryList.getEntries();
                    entries.forEach(entry => {
                        if (!entry.hadRecentInput) {
                            clsValue += entry.value;
                        }
                    });
                    vitals.cls = Math.round(clsValue * 1000) / 1000;
                });
                clsObserver.observe({ entryTypes: ['layout-shift'] });
            } catch (e) {
                console.warn('CLS tracking not supported');
            }

            // First Contentful Paint (FCP)
            try {
                const fcpObserver = new PerformanceObserver((entryList) => {
                    const entries = entryList.getEntries();
                    entries.forEach(entry => {
                        vitals.fcp = Math.round(entry.startTime);
                    });
                });
                fcpObserver.observe({ entryTypes: ['paint'] });
            } catch (e) {
                console.warn('FCP tracking not supported');
            }
        }

        this.metrics.coreWebVitals = vitals;
    }

    trackUserInteractions() {
        const interactionMetrics = {
            firstInteraction: null,
            interactionCount: 0,
            scrollDepth: 0,
            timeToInteractive: null
        };

        let interactionCount = 0;
        let firstInteraction = null;
        let maxScrollDepth = 0;
        
        const interactionEvents = ['click', 'scroll', 'keydown', 'touchstart'];
        
        interactionEvents.forEach(eventType => {
            document.addEventListener(eventType, (event) => {
                interactionCount++;
                
                if (!firstInteraction) {
                    firstInteraction = performance.now() - this.startTime;
                    interactionMetrics.firstInteraction = Math.round(firstInteraction);
                }
                
                // Track scroll depth
                if (eventType === 'scroll') {
                    const scrollDepth = Math.round((window.scrollY + window.innerHeight) / document.body.scrollHeight * 100);
                    maxScrollDepth = Math.max(maxScrollDepth, scrollDepth);
                    interactionMetrics.scrollDepth = maxScrollDepth;
                }
                
                interactionMetrics.interactionCount = interactionCount;
            }, { once: false, passive: true });
        });

        // Track Time to Interactive (TTI) approximation
        window.addEventListener('load', () => {
            setTimeout(() => {
                if (interactionMetrics.firstInteraction) {
                    interactionMetrics.timeToInteractive = interactionMetrics.firstInteraction;
                }
            }, 1000);
        });
        
        this.metrics.userExperience = interactionMetrics;
    }

    trackSystemResources() {
        const systemMetrics = {};

        // Memory usage
        if (performance.memory) {
            systemMetrics.memory = {
                used: Math.round(performance.memory.usedJSHeapSize / 1024 / 1024), // MB
                total: Math.round(performance.memory.totalJSHeapSize / 1024 / 1024), // MB
                limit: Math.round(performance.memory.jsHeapSizeLimit / 1024 / 1024) // MB
            };
        }

        // Network conditions
        if (navigator.connection) {
            systemMetrics.network = {
                effectiveType: navigator.connection.effectiveType,
                downlink: navigator.connection.downlink,
                rtt: navigator.connection.rtt,
                saveData: navigator.connection.saveData
            };
        }

        // Device capabilities
        systemMetrics.device = {
            cores: navigator.hardwareConcurrency || 'unknown',
            memory: navigator.deviceMemory || 'unknown',
            connection: navigator.connection?.effectiveType || 'unknown'
        };

        this.metrics.systemResources = systemMetrics;
    }

    trackCachePerformance() {
        const cacheMetrics = {
            serviceWorkerActive: false,
            cacheStorageAvailable: false,
            localStorageSize: 0,
            sessionStorageSize: 0
        };

        // Check Service Worker
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.ready.then(() => {
                cacheMetrics.serviceWorkerActive = true;
            });
        }

        // Check Cache Storage API
        if ('caches' in window) {
            cacheMetrics.cacheStorageAvailable = true;
        }

        // Calculate storage usage
        try {
            let localStorageSize = 0;
            for (let key in localStorage) {
                if (localStorage.hasOwnProperty(key)) {
                    localStorageSize += localStorage[key].length;
                }
            }
            cacheMetrics.localStorageSize = localStorageSize;
        } catch (e) {
            console.warn('Could not calculate localStorage size');
        }

        this.metrics.cachePerformance = cacheMetrics;
    }

    getBuildSystemReport() {
        return {
            timestamp: new Date().toISOString(),
            url: window.location.href,
            userAgent: navigator.userAgent,
            buildOptimizations: this.metrics.buildOptimizations,
            assetLoading: this.metrics.assetLoading,
            coreWebVitals: this.metrics.coreWebVitals,
            performance: {
                pageLoadTime: Math.round(performance.now() - this.startTime),
                domContentLoaded: performance.timing.domContentLoadedEventEnd - performance.timing.navigationStart,
                firstPaint: this.getFirstPaint(),
                assetLoadTimes: Array.from(this.assetLoadTimes.entries())
            },
            recommendations: this.generateRecommendations()
        };
    }

    getFirstPaint() {
        const paintEntries = performance.getEntriesByType('paint');
        const firstPaint = paintEntries.find(entry => entry.name === 'first-paint');
        return firstPaint ? Math.round(firstPaint.startTime) : null;
    }

    generateRecommendations() {
        const recommendations = [];
        const vitals = this.metrics.coreWebVitals;
        const assets = this.metrics.assetLoading;

        // LCP recommendations
        if (vitals.lcp > 2500) {
            recommendations.push('LCP is slow - consider optimizing images or reducing critical CSS');
        }

        // FID recommendations
        if (vitals.fid > 100) {
            recommendations.push('FID is high - consider code splitting and reducing JavaScript execution time');
        }

        // CLS recommendations
        if (vitals.cls > 0.1) {
            recommendations.push('CLS is high - ensure images have dimensions and avoid dynamic content insertion');
        }

        // Asset loading recommendations
        if (assets.strategy === 'conservative' && assets.lazyLoadedAssets < 3) {
            recommendations.push('Consider lazy loading more assets for better performance');
        }

        return recommendations;
    }

    sendReport() {
        const report = this.getBuildSystemReport();
        
        // Send to analytics service
        if (window.gtag) {
            window.gtag('event', 'build_system_performance', {
                page_load_time: report.performance.pageLoadTime,
                lcp: report.coreWebVitals.lcp,
                fid: report.coreWebVitals.fid,
                cls: report.coreWebVitals.cls,
                asset_strategy: report.assetLoading.strategy,
                cache_hit_rate: report.assetLoading.cacheHits / report.assetLoading.networkRequests * 100,
                recommendations_count: report.recommendations.length
            });
        }
        
        // Send to custom analytics endpoint
        if (window.fetch) {
            fetch('/api/performance-metrics', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(report)
            }).catch(error => {
                console.warn('Failed to send performance metrics:', error);
            });
        }
        
        console.log('Build System Performance Report:', report);
        return report;
    }
}

// Initialize enhanced performance monitor
const perfMonitor = new PerformanceMonitor();

// Send report after page load with delay for complete metrics
window.addEventListener('load', () => {
    setTimeout(() => {
        perfMonitor.sendReport();
    }, 3000); // Wait 3 seconds to capture all metrics including lazy-loaded assets
});

// Export for manual access
window.PerformanceMonitor = PerformanceMonitor;
window.perfMonitor = perfMonitor;

// Performance monitoring for development
if (process.env.NODE_ENV === 'development') {
    console.log('🔧 Performance monitoring active - check console for detailed metrics');
}