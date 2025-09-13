import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'public/js/main.js' // Include main.js for proper minification
            ],
            refresh: true,
        }),
    ],
    build: {
        minify: 'terser',
        terserOptions: {
            compress: {
                // Preserve DOM safety checks
                conditionals: false,    // Don't optimize away if statements
                dead_code: false,      // Don't remove unreachable code
                evaluate: false,       // Don't evaluate expressions that might affect DOM checks
                if_return: false,      // Don't optimize if-return patterns
                join_vars: false,      // Don't join variable declarations
                loops: false,          // Don't optimize loops
                sequences: false,      // Don't optimize sequences
                side_effects: false,   // Don't remove code with side effects
                
                // Safe optimizations
                collapse_vars: true,   // Safe to collapse variables
                comparisons: true,     // Safe to optimize comparisons
                unused: true,          // Remove unused variables (safe)
                drop_console: false,   // Keep console statements for debugging
                drop_debugger: false,  // Keep debugger statements
                pure_funcs: [],        // Don't assume any functions are pure
            },
            mangle: {
                // Variable name mangling (safe for this file)
                toplevel: false,       // Don't mangle top-level names
                reserved: ['element', 'videoSection', 'welcomeText'], // Preserve important variable names
            },
            format: {
                // Output formatting
                comments: false,       // Remove comments
                beautify: false,       // Don't beautify (keep minified)
                ecma: 2015,           // Target ES2015
                ascii_only: false,     // Allow non-ASCII characters
            },
            sourceMap: {
                // Generate source map for debugging
                filename: 'main.min.js',
                url: 'main.min.js.map',
                includeSources: true,
            },
            ecma: 2015,               // Target ES2015
            toplevel: false,          // Don't assume top-level scope
        },
        sourcemap: true, // Generate source maps
        rollupOptions: {
            output: {
                // Preserve file structure
                entryFileNames: '[name].js',
                chunkFileNames: '[name].js',
                assetFileNames: '[name].[ext]',
                // Generate source maps for each file
                sourcemap: true,
            }
        }
    },
    // Development server configuration
    server: {
        hmr: {
            host: 'localhost',
        },
    },
});