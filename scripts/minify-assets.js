#!/usr/bin/env node

/**
 * Minification Script for Unminified Assets
 * 
 * This script minifies CSS and JavaScript files that are flagged as unminified
 * by Google Search Console, even though they have .min extensions.
 * 
 * Files to minify:
 * - public/css/style_lawyer.min.css
 * - public/js/Frontend/sticky.min.js
 * - public/js/Frontend/hoverIntent.min.js
 */

const fs = require('fs');
const path = require('path');
const { minify: minifyJS } = require('terser');

// Simple CSS minifier (removes comments, whitespace, etc.)
function minifyCSS(css) {
    return css
        // Remove comments (but preserve /*! ... */ comments for licenses)
        .replace(/\/\*![\s\S]*?\*\//g, '') // Remove license comments
        .replace(/\/\*[\s\S]*?\*\//g, '') // Remove regular comments
        // Remove whitespace around certain characters
        .replace(/\s*{\s*/g, '{')
        .replace(/\s*}\s*/g, '}')
        .replace(/\s*:\s*/g, ':')
        .replace(/\s*;\s*/g, ';')
        .replace(/\s*,\s*/g, ',')
        .replace(/\s*>\s*/g, '>')
        .replace(/\s*\+\s*/g, '+')
        .replace(/\s*~\s*/g, '~')
        // Remove unnecessary whitespace
        .replace(/\s+/g, ' ')
        // Remove whitespace at start/end of lines and empty lines
        .split('\n')
        .map(line => line.trim())
        .filter(line => line.length > 0)
        .join('')
        // Final cleanup
        .replace(/\s*{\s*/g, '{')
        .replace(/\s*}\s*/g, '}')
        .replace(/\s*;\s*/g, ';')
        .trim();
}

// Minify JavaScript file
async function minifyJavaScriptFile(filePath) {
    try {
        const code = fs.readFileSync(filePath, 'utf8');
        const result = await minifyJS(code, {
            compress: {
                drop_console: false,
                drop_debugger: false,
                pure_funcs: [],
            },
            mangle: false, // Don't mangle variable names to preserve functionality
            format: {
                comments: false,
            },
        });

        if (result.error) {
            throw result.error;
        }

        const originalSize = Buffer.byteLength(code, 'utf8');
        const minifiedSize = Buffer.byteLength(result.code, 'utf8');
        const reduction = ((originalSize - minifiedSize) / originalSize * 100).toFixed(2);

        fs.writeFileSync(filePath, result.code, 'utf8');
        
        return {
            success: true,
            originalSize,
            minifiedSize,
            reduction: `${reduction}%`,
        };
    } catch (error) {
        return {
            success: false,
            error: error.message,
        };
    }
}

// Minify CSS file
function minifyCSSFile(filePath) {
    try {
        const css = fs.readFileSync(filePath, 'utf8');
        const minified = minifyCSS(css);
        
        const originalSize = Buffer.byteLength(css, 'utf8');
        const minifiedSize = Buffer.byteLength(minified, 'utf8');
        const reduction = ((originalSize - minifiedSize) / originalSize * 100).toFixed(2);

        fs.writeFileSync(filePath, minified, 'utf8');
        
        return {
            success: true,
            originalSize,
            minifiedSize,
            reduction: `${reduction}%`,
        };
    } catch (error) {
        return {
            success: false,
            error: error.message,
        };
    }
}

// Main function
async function main() {
    console.log('🚀 Starting asset minification...\n');

    const filesToMinify = [
        {
            path: path.join(__dirname, '..', 'public', 'css', 'style_lawyer.min.css'),
            type: 'css',
            name: 'style_lawyer.min.css',
        },
        {
            path: path.join(__dirname, '..', 'public', 'js', 'Frontend', 'sticky.min.js'),
            type: 'js',
            name: 'sticky.min.js',
        },
        {
            path: path.join(__dirname, '..', 'public', 'js', 'Frontend', 'hoverIntent.min.js'),
            type: 'js',
            name: 'hoverIntent.min.js',
        },
    ];

    const results = [];

    for (const file of filesToMinify) {
        console.log(`📦 Minifying ${file.name}...`);
        
        if (!fs.existsSync(file.path)) {
            console.log(`   ❌ File not found: ${file.path}`);
            results.push({ file: file.name, success: false, error: 'File not found' });
            continue;
        }

        let result;
        if (file.type === 'css') {
            result = minifyCSSFile(file.path);
        } else {
            result = await minifyJavaScriptFile(file.path);
        }

        if (result.success) {
            console.log(`   ✅ Success! Reduced by ${result.reduction} (${result.originalSize} → ${result.minifiedSize} bytes)`);
            results.push({
                file: file.name,
                success: true,
                originalSize: result.originalSize,
                minifiedSize: result.minifiedSize,
                reduction: result.reduction,
            });
        } else {
            console.log(`   ❌ Error: ${result.error}`);
            results.push({ file: file.name, success: false, error: result.error });
        }
    }

    console.log('\n📊 Summary:');
    console.log('─'.repeat(60));
    
    const successful = results.filter(r => r.success);
    const failed = results.filter(r => !r.success);

    if (successful.length > 0) {
        console.log('\n✅ Successfully minified:');
        successful.forEach(r => {
            console.log(`   ${r.file}: ${r.originalSize} → ${r.minifiedSize} bytes (${r.reduction} reduction)`);
        });
    }

    if (failed.length > 0) {
        console.log('\n❌ Failed:');
        failed.forEach(r => {
            console.log(`   ${r.file}: ${r.error}`);
        });
    }

    const totalOriginal = successful.reduce((sum, r) => sum + r.originalSize, 0);
    const totalMinified = successful.reduce((sum, r) => sum + r.minifiedSize, 0);
    const totalReduction = ((totalOriginal - totalMinified) / totalOriginal * 100).toFixed(2);

    if (successful.length > 0) {
        console.log('\n📈 Total:');
        console.log(`   ${totalOriginal} → ${totalMinified} bytes (${totalReduction}% reduction)`);
    }

    console.log('\n✨ Minification complete!');
    
    process.exit(failed.length > 0 ? 1 : 0);
}

// Run the script
main().catch(error => {
    console.error('❌ Fatal error:', error);
    process.exit(1);
});

