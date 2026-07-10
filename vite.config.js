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
                // fonts.css removed - now loaded as static asset to avoid Vite path resolution issues

                // JS files
                'resources/js/app.js',
                'resources/js/frontend.js',
                'resources/js/vendor-frontend.js',
                'resources/js/admin.js',
                'resources/js/vendor-admin.js',
                'resources/js/admin-calendar-v6.js',
                'public/js/main.js', // Add main.js to build pipeline
            ],
            refresh: true,
            // Ensure manifest is created in the correct location for Laravel
            buildDirectory: 'build',
        }),
    ],
    build: {
        outDir: 'public/build',
        emptyOutDir: true,
        manifest: true,
        sourcemap: process.env.NODE_ENV === 'development',
        cssCodeSplit: true,
        // Lightning CSS fails on vendor CSS (Font Awesome); esbuild is more lenient
        cssMinify: 'esbuild',
        chunkSizeWarningLimit: 1000,
        rolldownOptions: {
            external: [
                // tom-select is dynamically imported in admin.js
                'tom-select',
            ],
            onwarn(warning, warn) {
                if (
                    warning.code === 'css-syntax-error' ||
                    (warning.message && warning.message.includes('css-syntax-error'))
                ) {
                    return;
                }
                warn(warning);
            },
            output: {
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash].[ext]',
                codeSplitting: {
                    groups: [
                        { name: 'vendor-jquery', test: /node_modules[\\/]jquery/, priority: 20 },
                        { name: 'vendor-bootstrap', test: /node_modules[\\/]bootstrap/, priority: 20 },
                        { name: 'vendor-alpine', test: /node_modules[\\/]alpinejs/, priority: 20 },
                        { name: 'vendor-axios', test: /node_modules[\\/]axios/, priority: 20 },
                        { name: 'vendor-lodash', test: /node_modules[\\/]lodash/, priority: 20 },
                        { name: 'vendor', test: /node_modules/, priority: 1 },
                    ],
                },
                minify: {
                    compress: {
                        dropConsole: true,
                        dropDebugger: true,
                    },
                },
            },
        },
    },
    server: {
        host: '127.0.0.1', // Use same IP as Laravel server to avoid CORS
        hmr: {
            host: '127.0.0.1',
        },
    },
    resolve: {
        alias: {
            '@': '/resources',
        },
    },
});
