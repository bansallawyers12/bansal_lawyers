const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// Main application files
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

// Frontend main.js with proper minification settings
mix.js('public/js/main.js', 'public/js/main-vite.js')
   .minify('public/js/main-vite.js', 'public/js/main.min.js', {
       // Preserve DOM safety checks
       compress: {
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
   })
   .sourceMaps(); // Enable source maps for debugging

// Copy source maps to public directory
mix.copy('public/js/main.min.js.map', 'public/js/main.min.js.map');