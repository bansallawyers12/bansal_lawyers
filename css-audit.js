#!/usr/bin/env node

/**
 * CSS Audit and Optimization Script for Bansal Lawyers
 * This script helps identify unused CSS files and provides optimization recommendations
 */

import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// CSS files to analyze (from public/css directory)
const cssFiles = [
    'admin-bundle.min.css',      // 1010.97 KB
    'admintheme.min.css',        // 641.13 KB  
    'frontend-bundle.min.css',   // 553.10 KB
    'style.css',                 // 451.92 KB
    'app.min.css',               // 225.71 KB
    'bootstrap.min.css',         // 188.67 KB
    'components.css',            // 155.34 KB
    'bootstrap_lawyers.min.css', // 152.08 KB
    'app.css',                   // 123.92 KB
    'AdminLTE.pricing.min.css',  // 85.99 KB
    'icomoon.css',               // 82.81 KB
    'animate.css',               // 75.21 KB
    'icomoon.min.css',           // 65.04 KB
    'custom.css',                // 58.42 KB
    'animate.min.css',           // 55.29 KB
    'ionicons.min.css',          // 45.73 KB
    'datepicker3.css',           // 33.76 KB
    'font-awesome.min.css',      // 30.28 KB
    'aos.css',                   // 29.09 KB
    'bootstrap-formhelpers.min.css' // 28.02 KB
];

// Files that can be safely removed after Tailwind migration
const removableFiles = [
    'bootstrap.min.css',
    'bootstrap_lawyers.min.css', 
    'bootstrap-formhelpers.min.css',
    'AdminLTE.pricing.min.css',
    'admintheme.min.css',        // Will be replaced by Vite build
    'frontend-bundle.min.css',   // Will be replaced by Vite build
    'admin-bundle.min.css',      // Will be replaced by Vite build
    'style.css',                 // Legacy styles
    'components.css',            // Will be replaced by Tailwind components
    'custom.css'                 // Will be replaced by Tailwind utilities
];

// Files to keep (essential dependencies)
const keepFiles = [
    'app.css',                   // Main app styles
    'app.min.css',               // Minified app styles
    'animate.css',               // Animation library
    'animate.min.css',           // Minified animations
    'aos.css',                   // AOS animation library
    'font-awesome.min.css',      // Icon font
    'ionicons.min.css',          // Icon font
    'icomoon.css',               // Custom icon font
    'icomoon.min.css',           // Minified custom icons
    'datepicker3.css',           // Date picker dependency
    'select2.min.css',           // Select2 dependency
    'summernote-bs4.css'         // Rich text editor
];

function getFileSize(filePath) {
    try {
        const stats = fs.statSync(filePath);
        return (stats.size / 1024).toFixed(2); // Size in KB
    } catch (error) {
        return 0;
    }
}

function analyzeCSSFiles() {
    console.log('🔍 CSS Audit Report for Bansal Lawyers\n');
    console.log('=' .repeat(60));
    
    const cssDir = path.join(__dirname, 'public', 'css');
    let totalSize = 0;
    let removableSize = 0;
    
    console.log('\n📊 Current CSS Files Analysis:');
    console.log('-'.repeat(60));
    
    cssFiles.forEach(file => {
        const filePath = path.join(cssDir, file);
        const size = getFileSize(filePath);
        totalSize += parseFloat(size);
        
        const status = removableFiles.includes(file) ? '❌ REMOVE' : 
                      keepFiles.includes(file) ? '✅ KEEP' : '⚠️  REVIEW';
        
        console.log(`${status} ${file.padEnd(35)} ${size} KB`);
    });
    
    console.log('\n📈 Size Analysis:');
    console.log('-'.repeat(60));
    console.log(`Total CSS Size: ${totalSize.toFixed(2)} KB (${(totalSize/1024).toFixed(2)} MB)`);
    
    removableFiles.forEach(file => {
        const filePath = path.join(cssDir, file);
        const size = getFileSize(filePath);
        removableSize += parseFloat(size);
    });
    
    console.log(`Removable Size: ${removableSize.toFixed(2)} KB (${(removableSize/1024).toFixed(2)} MB)`);
    console.log(`Potential Savings: ${((removableSize/totalSize)*100).toFixed(1)}%`);
    
    console.log('\n🎯 Optimization Recommendations:');
    console.log('-'.repeat(60));
    console.log('1. Complete Bootstrap to Tailwind migration');
    console.log('2. Remove legacy CSS bundles after Vite build');
    console.log('3. Implement PurgeCSS for unused style removal');
    console.log('4. Use CSS custom properties for consistent theming');
    console.log('5. Optimize remaining icon fonts and animations');
    
    console.log('\n🚀 Next Steps:');
    console.log('-'.repeat(60));
    console.log('1. Continue Bootstrap to Tailwind class conversion');
    console.log('2. Update Vite configuration for CSS optimization');
    console.log('3. Test all pages after migration');
    console.log('4. Remove identified unused CSS files');
    console.log('5. Implement critical CSS inlining');
}

// Run the analysis
analyzeCSSFiles();
