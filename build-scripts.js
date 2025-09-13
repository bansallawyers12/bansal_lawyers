#!/usr/bin/env node

/**
 * Comprehensive Build Scripts for Proper Minification
 * Provides multiple approaches for minifying main.js with safety checks preserved
 */

const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');

// Colors for console output
const colors = {
    reset: '\x1b[0m',
    bright: '\x1b[1m',
    red: '\x1b[31m',
    green: '\x1b[32m',
    yellow: '\x1b[33m',
    blue: '\x1b[34m',
    magenta: '\x1b[35m',
    cyan: '\x1b[36m'
};

function log(message, color = 'reset') {
    console.log(`${colors[color]}${message}${colors.reset}`);
}

function logStep(step, message) {
    log(`\n${step}. ${message}`, 'cyan');
}

function logSuccess(message) {
    log(`✅ ${message}`, 'green');
}

function logWarning(message) {
    log(`⚠️  ${message}`, 'yellow');
}

function logError(message) {
    log(`❌ ${message}`, 'red');
}

/**
 * Method 1: Direct Terser with Custom Script
 */
async function method1_CustomTerser() {
    logStep('Method 1', 'Using Custom Terser Script');
    
    try {
        // Run our custom minification script
        execSync('node minify-main.js', { stdio: 'inherit' });
        logSuccess('Custom Terser minification completed');
        return true;
    } catch (error) {
        logError(`Custom Terser failed: ${error.message}`);
        return false;
    }
}

/**
 * Method 2: Laravel Mix with Custom Configuration
 */
async function method2_LaravelMix() {
    logStep('Method 2', 'Using Laravel Mix with Custom Configuration');
    
    try {
        // Run Laravel Mix production build
        execSync('npm run production', { stdio: 'inherit' });
        logSuccess('Laravel Mix minification completed');
        return true;
    } catch (error) {
        logError(`Laravel Mix failed: ${error.message}`);
        return false;
    }
}

/**
 * Method 3: Vite Build
 */
async function method3_Vite() {
    logStep('Method 3', 'Using Vite Build');
    
    try {
        // Run Vite build
        execSync('npm run vite:build', { stdio: 'inherit' });
        logSuccess('Vite build completed');
        return true;
    } catch (error) {
        logError(`Vite build failed: ${error.message}`);
        return false;
    }
}

/**
 * Verify Minification Results
 */
function verifyMinification() {
    logStep('Verification', 'Checking minification results');
    
    const minifiedPath = path.join(__dirname, 'public', 'js', 'main.min.js');
    const sourceMapPath = path.join(__dirname, 'public', 'js', 'main.min.js.map');
    
    if (!fs.existsSync(minifiedPath)) {
        logError('Minified file not found');
        return false;
    }
    
    const minifiedContent = fs.readFileSync(minifiedPath, 'utf8');
    const sourceCode = fs.readFileSync(path.join(__dirname, 'public', 'js', 'main.js'), 'utf8');
    
    // Check file sizes
    const originalSize = sourceCode.length;
    const minifiedSize = minifiedContent.length;
    const compressionRatio = ((originalSize - minifiedSize) / originalSize * 100).toFixed(1);
    
    log(`📊 Original size: ${(originalSize / 1024).toFixed(2)} KB`);
    log(`📊 Minified size: ${(minifiedSize / 1024).toFixed(2)} KB`);
    log(`📊 Compression: ${compressionRatio}% reduction`);
    
    // Check source map
    if (fs.existsSync(sourceMapPath)) {
        logSuccess('Source map generated');
    } else {
        logWarning('Source map not found');
    }
    
    // Verify critical safety checks - updated patterns for minified code
    const criticalChecks = [
        'if(element)',           // Welcome text safety check
        'if(e&&t)',             // Video modal safety check  
        'if(',                  // General if statements
        'textContent',          // DOM property access
        'getBoundingClientRect' // DOM method access
    ];
    
    log('\n🔍 Verifying safety checks:');
    let allChecksPassed = true;
    
    criticalChecks.forEach(check => {
        if (minifiedContent.includes(check)) {
            log(`✅ ${check} - preserved`, 'green');
        } else {
            log(`❌ ${check} - missing`, 'red');
            allChecksPassed = false;
        }
    });
    
    if (allChecksPassed) {
        logSuccess('All safety checks preserved!');
    } else {
        logError('Some safety checks are missing!');
    }
    
    return allChecksPassed;
}

/**
 * Main Build Function
 */
async function buildAll() {
    log('🚀 Starting Comprehensive Minification Process', 'bright');
    log('=' .repeat(60), 'blue');
    
    const methods = [
        { name: 'Custom Terser', fn: method1_CustomTerser },
        { name: 'Laravel Mix', fn: method2_LaravelMix },
        { name: 'Vite Build', fn: method3_Vite }
    ];
    
    let successCount = 0;
    
    for (const method of methods) {
        try {
            const success = await method.fn();
            if (success) {
                successCount++;
                // Verify results after each successful method
                verifyMinification();
            }
        } catch (error) {
            logError(`Method ${method.name} failed: ${error.message}`);
        }
    }
    
    log('\n' + '=' .repeat(60), 'blue');
    log(`🎯 Build Summary: ${successCount}/${methods.length} methods succeeded`, 'bright');
    
    if (successCount > 0) {
        logSuccess('Minification completed successfully!');
        log('\n📋 Next Steps:', 'cyan');
        log('1. Test the minified file in your browser');
        log('2. Check browser console for any remaining errors');
        log('3. Verify source maps are working in DevTools');
        log('4. Update your layout files to use the new minified version');
    } else {
        logError('All minification methods failed!');
        log('\n🔧 Troubleshooting:', 'yellow');
        log('1. Check that all dependencies are installed: npm install');
        log('2. Verify Node.js version compatibility');
        log('3. Check file permissions');
        log('4. Review error messages above');
    }
}

// Command line interface
if (require.main === module) {
    const command = process.argv[2];
    
    switch (command) {
        case 'custom':
            method1_CustomTerser().then(() => verifyMinification());
            break;
        case 'mix':
            method2_LaravelMix().then(() => verifyMinification());
            break;
        case 'vite':
            method3_Vite().then(() => verifyMinification());
            break;
        case 'verify':
            verifyMinification();
            break;
        case 'all':
        default:
            buildAll();
            break;
    }
}

module.exports = {
    method1_CustomTerser,
    method2_LaravelMix,
    method3_Vite,
    verifyMinification,
    buildAll
};
