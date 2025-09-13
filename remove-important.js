#!/usr/bin/env node

/**
 * Remove !important declarations and refactor CSS specificity
 * This script processes Blade templates to remove !important and improve CSS specificity
 */

import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Function to remove !important from CSS content
function removeImportantFromCSS(cssContent) {
    // Remove !important declarations
    let cleanedCSS = cssContent.replace(/!important\s*;?/g, ';');
    
    // Clean up any double semicolons that might result
    cleanedCSS = cleanedCSS.replace(/;;+/g, ';');
    
    // Clean up any trailing semicolons before closing braces
    cleanedCSS = cleanedCSS.replace(/;\s*}/g, '}');
    
    return cleanedCSS;
}

// Function to remove !important from inline styles
function removeImportantFromInlineStyles(htmlContent) {
    // Remove !important from inline style attributes
    return htmlContent.replace(/style="([^"]*?)!important([^"]*?)"/g, (match, before, after) => {
        return `style="${before}${after}"`;
    });
}

// Function to improve CSS specificity by adding more specific selectors
function improveCSSSpecificity(cssContent) {
    // Common patterns to improve specificity
    const improvements = [
        // Improve utility class specificity
        {
            pattern: /^\.(mt|mb|ml|mr|mx|my|pt|pb|pl|pr|px|py|m|p)-\d+(\s*{)/gm,
            replacement: '.content-section .$1$2'
        },
        // Improve form control specificity
        {
            pattern: /^\.form-control(\s*{)/gm,
            replacement: '.appointment_page .form-control$1'
        },
        // Improve button specificity
        {
            pattern: /^\.btn(\s*{)/gm,
            replacement: '.appointment_page .btn$1'
        },
        // Improve container specificity
        {
            pattern: /^\.container(\s*{)/gm,
            replacement: '.practice-area .container$1'
        }
    ];
    
    let improvedCSS = cssContent;
    
    improvements.forEach(improvement => {
        improvedCSS = improvedCSS.replace(improvement.pattern, improvement.replacement);
    });
    
    return improvedCSS;
}

// Function to process a single file
function processFile(filePath) {
    try {
        const content = fs.readFileSync(filePath, 'utf8');
        let processedContent = content;
        
        // Remove !important from inline styles
        processedContent = removeImportantFromInlineStyles(processedContent);
        
        // If it's a CSS file or contains <style> tags, process CSS content
        if (filePath.endsWith('.css') || processedContent.includes('<style>')) {
            // Extract and process CSS within <style> tags
            processedContent = processedContent.replace(/<style[^>]*>([\s\S]*?)<\/style>/g, (match, cssContent) => {
                const cleanedCSS = removeImportantFromCSS(cssContent);
                const improvedCSS = improveCSSSpecificity(cleanedCSS);
                return match.replace(cssContent, improvedCSS);
            });
            
            // If it's a pure CSS file, process the entire content
            if (filePath.endsWith('.css')) {
                processedContent = removeImportantFromCSS(processedContent);
                processedContent = improveCSSSpecificity(processedContent);
            }
        }
        
        // Only write if content changed
        if (content !== processedContent) {
            fs.writeFileSync(filePath, processedContent, 'utf8');
            return true;
        }
        return false;
    } catch (error) {
        console.error(`Error processing ${filePath}:`, error.message);
        return false;
    }
}

// Function to recursively find all Blade templates and CSS files
function findFiles(dir, extensions) {
    const files = [];
    const items = fs.readdirSync(dir);
    
    for (const item of items) {
        const filePath = path.join(dir, item);
        const stat = fs.statSync(filePath);
        
        if (stat.isDirectory()) {
            files.push(...findFiles(filePath, extensions));
        } else if (extensions.some(ext => item.endsWith(ext))) {
            files.push(filePath);
        }
    }
    
    return files;
}

// Main execution
function main() {
    console.log('🧹 Removing !important declarations and improving CSS specificity');
    console.log('=' .repeat(70));
    
    const viewsDir = path.join(__dirname, 'resources', 'views');
    const cssDir = path.join(__dirname, 'public', 'css');
    
    // Find all Blade templates
    const bladeFiles = findFiles(viewsDir, ['.blade.php']);
    
    // Find all CSS files
    const cssFiles = findFiles(cssDir, ['.css']);
    
    const allFiles = [...bladeFiles, ...cssFiles];
    
    console.log(`Found ${allFiles.length} files to process`);
    console.log('-'.repeat(70));
    
    let processedCount = 0;
    let changedCount = 0;
    
    for (const file of allFiles) {
        const relativePath = path.relative(__dirname, file);
        const changed = processFile(file);
        
        if (changed) {
            console.log(`✅ Processed: ${relativePath}`);
            changedCount++;
        } else {
            console.log(`⏭️  No changes: ${relativePath}`);
        }
        
        processedCount++;
    }
    
    console.log('-'.repeat(70));
    console.log(`📊 Processing Summary:`);
    console.log(`   Total files processed: ${processedCount}`);
    console.log(`   Files modified: ${changedCount}`);
    console.log(`   Files unchanged: ${processedCount - changedCount}`);
    console.log('\n🎉 !important removal and CSS specificity improvement completed!');
    console.log('\n💡 Next steps:');
    console.log('   1. Test all pages to ensure styling is preserved');
    console.log('   2. Check for any remaining specificity issues');
    console.log('   3. Consider using CSS custom properties for better maintainability');
}

// Run the processing
main();
