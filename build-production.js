#!/usr/bin/env node

/**
 * Production Build Script for Vite
 * This script handles Vite production builds with asset optimization and performance monitoring
 * Note: Vite handles CSS purging and minification natively via PostCSS and Tailwind
 */

import { execSync } from 'child_process';
import { readFileSync, writeFileSync, existsSync } from 'fs';
import { join } from 'path';

const BUILD_DIR = 'public/build';
const MANIFEST_FILE = join(BUILD_DIR, 'manifest.json');

// Performance optimization settings
// Note: Vite handles most of these optimizations natively
const OPTIMIZATION_SETTINGS = {
    vite: {
        minify: 'terser',
        cssCodeSplit: true,
        sourcemap: true,
        rollupOptions: {
            output: {
                manualChunks: {
                    'vendor': ['jquery', 'bootstrap', 'alpinejs'],
                    'axios': ['axios']
                }
            }
        }
    },
    assets: {
        optimizeImages: true,
        generateWebp: true,
        compressAssets: true
    }
};

class ProductionBuilder {
    constructor() {
        this.startTime = Date.now();
        this.stats = {
            cssFiles: 0,
            jsFiles: 0,
            totalSize: 0,
            purgedSize: 0
        };
    }

    log(message, type = 'info') {
        const timestamp = new Date().toLocaleTimeString();
        const prefix = {
            info: '🔧',
            success: '✅',
            warning: '⚠️',
            error: '❌'
        }[type] || 'ℹ️';
        
        console.log(`${prefix} [${timestamp}] ${message}`);
    }

    async run() {
        try {
            this.log('Starting production build with CSS purging...');
            
            // Set production environment
            process.env.NODE_ENV = 'production';
            process.env.CRITICAL_CSS = 'true';
            
            // Step 1: Run Vite build (handles CSS purging via Tailwind and minification)
            await this.runViteBuild();
            
            // Step 2: Optimize assets and analyze build output
            await this.optimizeAssets();
            
            // Step 3: Generate build report
            await this.generateReport();
            
            const duration = Date.now() - this.startTime;
            this.log(`Production build completed in ${duration}ms`, 'success');
            
        } catch (error) {
            this.log(`Build failed: ${error.message}`, 'error');
            process.exit(1);
        }
    }

    async runViteBuild() {
        this.log('Running Vite build...');
        
        try {
            execSync('npm run build', { 
                stdio: 'inherit',
                env: { ...process.env, NODE_ENV: 'production' }
            });
            this.log('Vite build completed', 'success');
        } catch (error) {
            throw new Error(`Vite build failed: ${error.message}`);
        }
    }


    async optimizeAssets() {
        this.log('Analyzing optimized assets...');
        
        if (!existsSync(MANIFEST_FILE)) {
            this.log('Manifest file not found, skipping asset analysis', 'warning');
            return;
        }

        const manifest = JSON.parse(readFileSync(MANIFEST_FILE, 'utf8'));
        
        // Count and measure assets from Vite build
        for (const [key, value] of Object.entries(manifest)) {
            if (value.file) {
                const fullPath = join(BUILD_DIR, value.file);
                if (existsSync(fullPath)) {
                    const size = readFileSync(fullPath).length;
                    this.stats.totalSize += size;
                    
                    if (value.file.endsWith('.js')) {
                        this.stats.jsFiles++;
                    } else if (value.file.endsWith('.css')) {
                        this.stats.cssFiles++;
                    }
                }
            }
        }
        
        this.log('Asset analysis completed', 'success');
        this.log(`  Total assets: ${this.stats.jsFiles + this.stats.cssFiles} files`);
        this.log(`  Total size: ${Math.round(this.stats.totalSize / 1024)}KB`);
    }

    async generateReport() {
        this.log('Generating build report...');
        
        const report = {
            timestamp: new Date().toISOString(),
            duration: Date.now() - this.startTime,
            stats: this.stats,
            optimization: OPTIMIZATION_SETTINGS,
            performance: {
                totalSizeKB: Math.round(this.stats.totalSize / 1024),
                cssFiles: this.stats.cssFiles,
                jsFiles: this.stats.jsFiles,
                averageFileSizeKB: this.stats.jsFiles + this.stats.cssFiles > 0 ? 
                    Math.round(this.stats.totalSize / (this.stats.jsFiles + this.stats.cssFiles) / 1024) : 0
            }
        };
        
        writeFileSync('build-report.json', JSON.stringify(report, null, 2));
        
        this.log(`Build report generated:`, 'success');
        this.log(`  Total size: ${report.performance.totalSizeKB}KB`);
        this.log(`  CSS files: ${report.performance.cssFiles}`);
        this.log(`  JS files: ${report.performance.jsFiles}`);
        this.log(`  Compression ratio: ${report.performance.compressionRatio}%`);
    }
}

// Run the builder
const builder = new ProductionBuilder();
builder.run().catch(console.error);
