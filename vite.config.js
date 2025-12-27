import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/frontend.css',
                'resources/css/admin.css',
                'resources/js/app.js',
                'resources/js/frontend.js',
                'resources/js/admin.js',
                'resources/js/admin-calendar-v6.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',
        emptyOutDir: true,
        manifest: true,
        // Use esbuild for faster builds (switches to terser only if needed)
        minify: 'terser',
        terserOptions: {
            compress: {
                // Aggressive optimizations for smaller bundle size
                conditionals: true,
                dead_code: true,
                evaluate: true,
                if_return: true,
                join_vars: true,
                loops: true,
                sequences: true,
                side_effects: true,
                collapse_vars: true,
                comparisons: true,
                unused: true,
                // Remove console in production for smaller bundles
                drop_console: true,
                drop_debugger: true,
                pure_funcs: ['console.log', 'console.info', 'console.debug'],
                passes: 2, // Multiple passes for better optimization
            },
            mangle: {
                toplevel: true, // Mangle top-level names for smaller bundles
                reserved: ['element', 'videoSection', 'welcomeText', 'Alpine', 'AOS'],
            },
            format: {
                comments: false,
                beautify: false,
                ecma: 2020, // Modern ES2020 for better compression
                ascii_only: false,
            },
        },
        // Disable sourcemaps in production for smaller builds
        sourcemap: process.env.NODE_ENV === 'development',
        // Enable CSS code splitting
        cssCodeSplit: true,
        // Optimize chunk size
        chunkSizeWarningLimit: 1000,
        rollupOptions: {
            external: [
                // External packages that are loaded dynamically or via CDN
                'datatables.net',
                'datatables.net-bs4',
                'tom-select',
                'summernote',
                '@fullcalendar/core',
                '@fullcalendar/daygrid',
                '@fullcalendar/timegrid',
                '@fullcalendar/interaction',
                'bootstrap-datepicker',
                'owl.carousel',
                'magnific-popup',
                'aos',
            ],
            output: {
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash].[ext]',
                // Manual code splitting for optimal loading
                manualChunks: (id) => {
                    // Vendor chunk for node_modules
                    if (id.includes('node_modules')) {
                        // Separate large libraries
                        if (id.includes('jquery')) {
                            return 'vendor-jquery';
                        }
                        if (id.includes('bootstrap')) {
                            return 'vendor-bootstrap';
                        }
                        if (id.includes('alpinejs')) {
                            return 'vendor-alpine';
                        }
                        if (id.includes('axios')) {
                            return 'vendor-axios';
                        }
                        if (id.includes('lodash')) {
                            return 'vendor-lodash';
                        }
                        // Other vendor libraries
                        return 'vendor';
                    }
                },
            }
        }
    },
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    resolve: {
        alias: {
            '@': '/resources',
        },
    },
});