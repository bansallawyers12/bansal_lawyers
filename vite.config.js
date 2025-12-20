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
                reserved: ['element', 'videoSection', 'welcomeText'],
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
                entryFileNames: 'assets/[name].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash].[ext]',
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