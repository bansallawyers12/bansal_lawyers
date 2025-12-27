import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS files
                'resources/css/app.css',
                'resources/css/frontend.css',
                'resources/css/admin.css',
                'resources/css/vendor-frontend.css',
                'resources/css/vendor-admin.css',
                
                // JS files
                'resources/js/app.js',
                'resources/js/vendor-frontend.js',
                'resources/js/vendor-admin.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',
        emptyOutDir: true,
        manifest: true,
        minify: 'terser',
        terserOptions: {
            compress: {
                // Preserve DOM safety checks
                conditionals: false,
                dead_code: false,
                evaluate: false,
                if_return: false,
                join_vars: false,
                loops: false,
                sequences: false,
                side_effects: false,
                
                // Safe optimizations
                collapse_vars: true,
                comparisons: true,
                unused: true,
                drop_console: false,
                drop_debugger: false,
                pure_funcs: [],
            },
            mangle: {
                toplevel: false,
                reserved: ['element', 'videoSection', 'welcomeText', 'Swiper', 'feather'],
            },
            format: {
                comments: false,
                beautify: false,
                ecma: 2015,
                ascii_only: false,
            },
        },
        sourcemap: true,
        rollupOptions: {
            external: [
                // External packages that are loaded dynamically or via CDN
                // Note: bootstrap-datepicker removed - now bundled via npm
                'datatables.net',
                'datatables.net-bs4',
                'tom-select',
                'summernote',
                '@fullcalendar/core',
                '@fullcalendar/daygrid',
                '@fullcalendar/timegrid',
                '@fullcalendar/interaction',
                'owl.carousel',
                'magnific-popup',
                'aos',
            ],
            output: {
                entryFileNames: 'assets/[name].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash].[ext]',
                manualChunks: {
                    // Separate vendor chunks for better caching
                    'vendor-frontend': ['swiper'],
                    'vendor-admin': ['feather-icons', 'bootstrap-datepicker'],
                    // Note: jquery.nicescroll and sticky-kit loaded from public/js/vendor/ (no ES module support)
                }
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