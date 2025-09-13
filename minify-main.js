#!/usr/bin/env node

/**
 * Proper Minification Script for main.js
 * Uses Terser with proper configuration to preserve DOM safety checks
 * Includes source map generation for debugging
 */

const fs = require('fs');
const path = require('path');
const { minify } = require('terser');

// Configuration for proper minification
const terserOptions = {
    compress: {
        // Preserve important safety checks - MORE RESTRICTIVE
        conditionals: false,    // Don't optimize away if statements
        dead_code: false,      // Don't remove unreachable code
        evaluate: false,       // Don't evaluate expressions that might affect DOM checks
        if_return: false,      // Don't optimize if-return patterns
        join_vars: false,      // Don't join variable declarations
        loops: false,          // Don't optimize loops
        sequences: false,      // Don't optimize sequences
        side_effects: false,   // Don't remove code with side effects
        collapse_vars: false,  // Don't collapse variables (might affect DOM checks)
        comparisons: false,    // Don't optimize comparisons
        unused: false,         // Don't remove unused variables (might be DOM elements)
        drop_console: false,   // Keep console statements for debugging
        drop_debugger: false,  // Keep debugger statements
        pure_funcs: [],        // Don't assume any functions are pure
        reduce_vars: false,    // Don't reduce variables
        passes: 1,             // Only one pass to avoid aggressive optimization
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
};

async function minifyMainJS() {
    try {
        console.log('🔧 Starting proper minification of main.js...');
        
        // Read the source file
        const sourcePath = path.join(__dirname, 'public', 'js', 'main.js');
        const sourceCode = fs.readFileSync(sourcePath, 'utf8');
        
        console.log(`📖 Read source file: ${sourceCode.length} characters`);
        
        // Minify with proper options
        const result = await minify(sourceCode, terserOptions);
        
        if (result.error) {
            throw new Error(`Minification error: ${result.error.message}`);
        }
        
        // Write minified file
        const minifiedPath = path.join(__dirname, 'public', 'js', 'main.min.js');
        fs.writeFileSync(minifiedPath, result.code, 'utf8');
        
        // Write source map
        if (result.map) {
            const sourceMapPath = path.join(__dirname, 'public', 'js', 'main.min.js.map');
            fs.writeFileSync(sourceMapPath, result.map, 'utf8');
            console.log('📋 Source map generated: main.min.js.map');
        }
        
        // Show compression stats
        const originalSize = sourceCode.length;
        const minifiedSize = result.code.length;
        const compressionRatio = ((originalSize - minifiedSize) / originalSize * 100).toFixed(1);
        
        console.log('✅ Minification completed successfully!');
        console.log(`📊 Original size: ${(originalSize / 1024).toFixed(2)} KB`);
        console.log(`📊 Minified size: ${(minifiedSize / 1024).toFixed(2)} KB`);
        console.log(`📊 Compression: ${compressionRatio}% reduction`);
        
        // Verify critical safety checks are preserved
        const criticalChecks = [
            'if(element)',           // Welcome text safety check
            'if(e&&t)',             // Video modal safety check  
            'if(',                  // General if statements
            'textContent',          // DOM property access
            'getBoundingClientRect' // DOM method access
        ];
        
        console.log('\n🔍 Verifying safety checks are preserved:');
        criticalChecks.forEach(check => {
            if (result.code.includes(check)) {
                console.log(`✅ ${check} - preserved`);
            } else {
                console.log(`⚠️  ${check} - may be missing`);
            }
        });
        
        console.log('\n🎯 Minification complete! The file should now work without DOM errors.');
        
    } catch (error) {
        console.error('❌ Minification failed:', error.message);
        process.exit(1);
    }
}

// Run the minification
if (require.main === module) {
    minifyMainJS();
}

module.exports = { minifyMainJS, terserOptions };
