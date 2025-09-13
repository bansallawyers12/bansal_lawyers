#!/usr/bin/env node

/**
 * Batch Bootstrap to Tailwind Template Converter
 * This script processes multiple Blade templates to convert Bootstrap classes to Tailwind
 */

import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Common Bootstrap to Tailwind class mappings
const classMappings = {
    // Layout
    'container': 'container mx-auto px-4',
    'container-fluid': 'w-full px-4',
    'row': 'flex flex-wrap',
    'col': 'flex-1',
    'col-1': 'w-1/12',
    'col-2': 'w-2/12',
    'col-3': 'w-3/12',
    'col-4': 'w-4/12',
    'col-6': 'w-6/12',
    'col-8': 'w-8/12',
    'col-9': 'w-9/12',
    'col-12': 'w-full',
    'col-md-1': 'md:w-1/12',
    'col-md-2': 'md:w-2/12',
    'col-md-3': 'md:w-1/4',
    'col-md-4': 'md:w-1/3',
    'col-md-6': 'md:w-1/2',
    'col-md-8': 'md:w-2/3',
    'col-md-9': 'md:w-3/4',
    'col-md-12': 'md:w-full',
    'col-lg-1': 'lg:w-1/12',
    'col-lg-2': 'lg:w-2/12',
    'col-lg-3': 'lg:w-1/4',
    'col-lg-4': 'lg:w-1/3',
    'col-lg-6': 'lg:w-1/2',
    'col-lg-8': 'lg:w-2/3',
    'col-lg-9': 'lg:w-3/4',
    'col-lg-12': 'lg:w-full',
    
    // Flexbox
    'd-flex': 'flex',
    'd-inline-flex': 'inline-flex',
    'd-block': 'block',
    'd-inline-block': 'inline-block',
    'd-inline': 'inline',
    'd-none': 'hidden',
    'justify-content-start': 'justify-start',
    'justify-content-center': 'justify-center',
    'justify-content-end': 'justify-end',
    'justify-content-between': 'justify-between',
    'justify-content-around': 'justify-around',
    'align-items-start': 'items-start',
    'align-items-center': 'items-center',
    'align-items-end': 'items-end',
    'align-items-stretch': 'items-stretch',
    'flex-column': 'flex-col',
    'flex-row': 'flex-row',
    'flex-wrap': 'flex-wrap',
    'flex-nowrap': 'flex-nowrap',
    
    // Spacing
    'm-0': 'm-0', 'm-1': 'm-1', 'm-2': 'm-2', 'm-3': 'm-3', 'm-4': 'm-4', 'm-5': 'm-5',
    'mt-0': 'mt-0', 'mt-1': 'mt-1', 'mt-2': 'mt-2', 'mt-3': 'mt-3', 'mt-4': 'mt-4', 'mt-5': 'mt-5',
    'mb-0': 'mb-0', 'mb-1': 'mb-1', 'mb-2': 'mb-2', 'mb-3': 'mb-3', 'mb-4': 'mb-4', 'mb-5': 'mb-5',
    'ml-0': 'ml-0', 'ml-1': 'ml-1', 'ml-2': 'ml-2', 'ml-3': 'ml-3', 'ml-4': 'ml-4', 'ml-5': 'ml-5',
    'mr-0': 'mr-0', 'mr-1': 'mr-1', 'mr-2': 'mr-2', 'mr-3': 'mr-3', 'mr-4': 'mr-4', 'mr-5': 'mr-5',
    'mx-0': 'mx-0', 'mx-1': 'mx-1', 'mx-2': 'mx-2', 'mx-3': 'mx-3', 'mx-4': 'mx-4', 'mx-5': 'mx-5',
    'my-0': 'my-0', 'my-1': 'my-1', 'my-2': 'my-2', 'my-3': 'my-3', 'my-4': 'my-4', 'my-5': 'my-5',
    'p-0': 'p-0', 'p-1': 'p-1', 'p-2': 'p-2', 'p-3': 'p-3', 'p-4': 'p-4', 'p-5': 'p-5',
    'pt-0': 'pt-0', 'pt-1': 'pt-1', 'pt-2': 'pt-2', 'pt-3': 'pt-3', 'pt-4': 'pt-4', 'pt-5': 'pt-5',
    'pb-0': 'pb-0', 'pb-1': 'pb-1', 'pb-2': 'pb-2', 'pb-3': 'pb-3', 'pb-4': 'pb-4', 'pb-5': 'pb-5',
    'pl-0': 'pl-0', 'pl-1': 'pl-1', 'pl-2': 'pl-2', 'pl-3': 'pl-3', 'pl-4': 'pl-4', 'pl-5': 'pl-5',
    'pr-0': 'pr-0', 'pr-1': 'pr-1', 'pr-2': 'pr-2', 'pr-3': 'pr-3', 'pr-4': 'pr-4', 'pr-5': 'pr-5',
    'px-0': 'px-0', 'px-1': 'px-1', 'px-2': 'px-2', 'px-3': 'px-3', 'px-4': 'px-4', 'px-5': 'px-5',
    'py-0': 'py-0', 'py-1': 'py-1', 'py-2': 'py-2', 'py-3': 'py-3', 'py-4': 'py-4', 'py-5': 'py-5',
    
    // Text
    'text-left': 'text-left', 'text-center': 'text-center', 'text-right': 'text-right', 'text-justify': 'text-justify',
    'text-uppercase': 'uppercase', 'text-lowercase': 'lowercase', 'text-capitalize': 'capitalize',
    'font-weight-bold': 'font-bold', 'font-weight-normal': 'font-normal', 'font-weight-light': 'font-light',
    'font-italic': 'italic', 'text-muted': 'text-gray-500', 'text-primary': 'text-bansal-blue-500',
    'text-success': 'text-green-500', 'text-danger': 'text-red-500', 'text-warning': 'text-yellow-500',
    'text-info': 'text-blue-500',
    
    // Background
    'bg-primary': 'bg-bansal-blue-500', 'bg-secondary': 'bg-gray-500', 'bg-success': 'bg-green-500',
    'bg-danger': 'bg-red-500', 'bg-warning': 'bg-yellow-500', 'bg-info': 'bg-blue-500',
    'bg-light': 'bg-gray-100', 'bg-dark': 'bg-gray-900', 'bg-white': 'bg-white', 'bg-transparent': 'bg-transparent',
    
    // Buttons
    'btn': 'font-semibold py-2 px-4 rounded-lg transition-all duration-200',
    'btn-primary': 'bg-bansal-blue-500 hover:bg-bansal-blue-600 text-white',
    'btn-secondary': 'bg-gray-500 hover:bg-gray-600 text-white',
    'btn-success': 'bg-green-500 hover:bg-green-600 text-white',
    'btn-danger': 'bg-red-500 hover:bg-red-600 text-white',
    'btn-warning': 'bg-yellow-500 hover:bg-yellow-600 text-white',
    'btn-info': 'bg-blue-500 hover:bg-blue-600 text-white',
    'btn-light': 'bg-gray-100 hover:bg-gray-200 text-gray-900',
    'btn-dark': 'bg-gray-900 hover:bg-gray-800 text-white',
    'btn-sm': 'text-sm py-1 px-2', 'btn-lg': 'text-lg py-3 px-6', 'btn-block': 'w-full',
    
    // Cards
    'card': 'bg-white rounded-lg shadow-sm border border-gray-200',
    'card-header': 'px-6 py-4 border-b border-gray-200',
    'card-body': 'p-6',
    'card-footer': 'px-6 py-4 border-t border-gray-200',
    'card-title': 'text-lg font-semibold text-gray-900',
    'card-text': 'text-gray-600',
    
    // Forms
    'form-control': 'w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-bansal-blue-500 focus:border-transparent transition-colors duration-200',
    'form-group': 'mb-4',
    'form-label': 'block text-sm font-medium text-gray-700 mb-1',
    'form-check': 'flex items-center',
    'form-check-input': 'h-4 w-4 text-bansal-blue-600 focus:ring-bansal-blue-500 border-gray-300 rounded',
    'form-check-label': 'ml-2 block text-sm text-gray-900',
    
    // Tables
    'table': 'min-w-full divide-y divide-gray-200',
    'table-striped': 'table-striped',
    'table-bordered': 'border border-gray-200',
    'table-hover': 'table-hover',
    'table-sm': 'text-sm',
    'table-responsive': 'overflow-x-auto',
    
    // Alerts
    'alert': 'px-4 py-3 rounded-md mb-4',
    'alert-primary': 'bg-bansal-blue-50 text-bansal-blue-800 border border-bansal-blue-200',
    'alert-secondary': 'bg-gray-50 text-gray-800 border border-gray-200',
    'alert-success': 'bg-green-50 text-green-800 border border-green-200',
    'alert-danger': 'bg-red-50 text-red-800 border border-red-200',
    'alert-warning': 'bg-yellow-50 text-yellow-800 border border-yellow-200',
    'alert-info': 'bg-blue-50 text-blue-800 border border-blue-200',
    
    // Badges
    'badge': 'inline-block px-2 py-1 text-xs font-semibold rounded-full',
    'badge-primary': 'bg-bansal-blue-500 text-white',
    'badge-secondary': 'bg-gray-500 text-white',
    'badge-success': 'bg-green-500 text-white',
    'badge-danger': 'bg-red-500 text-white',
    'badge-warning': 'bg-yellow-500 text-white',
    'badge-info': 'bg-blue-500 text-white',
    'badge-light': 'bg-gray-100 text-gray-900',
    'badge-dark': 'bg-gray-900 text-white',
    
    // Utilities
    'no-gutters': 'no-gutters',
    'w-100': 'w-full', 'h-100': 'h-full',
    'd-none': 'hidden', 'd-block': 'block', 'd-inline': 'inline', 'd-inline-block': 'inline-block',
    'd-flex': 'flex', 'd-inline-flex': 'inline-flex',
    'sr-only': 'sr-only', 'text-hide': 'text-hide',
    'invisible': 'invisible', 'visible': 'visible',
};

// Function to convert Bootstrap classes to Tailwind
function convertBootstrapToTailwind(htmlContent) {
    let convertedContent = htmlContent;
    
    // Convert class attributes
    convertedContent = convertedContent.replace(/class="([^"]*)"/g, (match, classList) => {
        const classes = classList.split(' ').map(cls => cls.trim()).filter(cls => cls);
        const convertedClasses = classes.map(cls => {
            // Check for exact match first
            if (classMappings[cls]) {
                return classMappings[cls];
            }
            
            // Check for responsive variants
            const responsiveMatch = cls.match(/^(\w+)-(\w+)-(\d+)$/);
            if (responsiveMatch) {
                const [, prefix, breakpoint, size] = responsiveMatch;
                const baseClass = `${prefix}-${size}`;
                if (classMappings[baseClass]) {
                    return `${breakpoint}:${classMappings[baseClass]}`;
                }
            }
            
            // Return original class if no mapping found
            return cls;
        });
        
        return `class="${convertedClasses.join(' ')}"`;
    });
    
    return convertedContent;
}

// Function to process a single file
function processFile(filePath) {
    try {
        const content = fs.readFileSync(filePath, 'utf8');
        const convertedContent = convertBootstrapToTailwind(content);
        
        // Only write if content changed
        if (content !== convertedContent) {
            fs.writeFileSync(filePath, convertedContent, 'utf8');
            return true;
        }
        return false;
    } catch (error) {
        console.error(`Error processing ${filePath}:`, error.message);
        return false;
    }
}

// Function to recursively find all Blade templates
function findBladeTemplates(dir) {
    const templates = [];
    const files = fs.readdirSync(dir);
    
    for (const file of files) {
        const filePath = path.join(dir, file);
        const stat = fs.statSync(filePath);
        
        if (stat.isDirectory()) {
            templates.push(...findBladeTemplates(filePath));
        } else if (file.endsWith('.blade.php')) {
            templates.push(filePath);
        }
    }
    
    return templates;
}

// Main execution
function main() {
    console.log('🔄 Starting Bootstrap to Tailwind Template Conversion');
    console.log('=' .repeat(60));
    
    const viewsDir = path.join(__dirname, 'resources', 'views');
    const templates = findBladeTemplates(viewsDir);
    
    console.log(`Found ${templates.length} Blade templates to process`);
    console.log('-'.repeat(60));
    
    let processedCount = 0;
    let changedCount = 0;
    
    for (const template of templates) {
        const relativePath = path.relative(__dirname, template);
        const changed = processFile(template);
        
        if (changed) {
            console.log(`✅ Converted: ${relativePath}`);
            changedCount++;
        } else {
            console.log(`⏭️  No changes: ${relativePath}`);
        }
        
        processedCount++;
    }
    
    console.log('-'.repeat(60));
    console.log(`📊 Conversion Summary:`);
    console.log(`   Total templates processed: ${processedCount}`);
    console.log(`   Templates modified: ${changedCount}`);
    console.log(`   Templates unchanged: ${processedCount - changedCount}`);
    console.log('\n🎉 Bootstrap to Tailwind conversion completed!');
}

// Run the conversion
main();
