import { readFileSync, writeFileSync, mkdirSync } from 'fs';
import { join, dirname } from 'path';

/**
 * Vite Plugin for Critical CSS Extraction
 * Automatically extracts and optimizes critical CSS for above-the-fold content
 */
export function criticalCssPlugin(options = {}) {
    const {
        outputPath = 'public/build/critical.css',
        minify = true,
        extractSelectors = [
            // Above-the-fold selectors
            'html', 'body', 'head',
            '.navbar', '.hero-section', '.hero-content', '.hero-title', '.hero-subtitle', '.hero-cta',
            '.container', '.btn', '.btn-primary',
            '.ftco-loader', '.loader-spinner',
            // Critical animations
            '@keyframes', 'fadeInUp', 'spin',
            // Responsive breakpoints
            '@media (max-width: 768px)',
            '@media (prefers-reduced-motion: reduce)'
        ]
    } = options;

    return {
        name: 'critical-css-extractor',
        generateBundle(options, bundle) {
            if (options.format !== 'es') return;

            // Find CSS files in the bundle
            const cssFiles = Object.keys(bundle).filter(fileName => fileName.endsWith('.css'));
            
            if (cssFiles.length === 0) return;

            let criticalCss = '';
            
            cssFiles.forEach(fileName => {
                const cssFile = bundle[fileName];
                if (cssFile.type === 'asset' && cssFile.source) {
                    const cssContent = cssFile.source;
                    
                    // Extract critical CSS based on selectors
                    const lines = cssContent.split('\n');
                    let inCriticalBlock = false;
                    let braceCount = 0;
                    
                    for (let i = 0; i < lines.length; i++) {
                        const line = lines[i].trim();
                        
                        // Check if this line contains critical selectors
                        const isCritical = extractSelectors.some(selector => {
                            if (selector.startsWith('@')) {
                                return line.includes(selector);
                            }
                            return line.includes(selector) || line.includes(selector.replace('.', ''));
                        });
                        
                        if (isCritical) {
                            inCriticalBlock = true;
                            criticalCss += lines[i] + '\n';
                            braceCount += (line.match(/\{/g) || []).length;
                            braceCount -= (line.match(/\}/g) || []).length;
                        } else if (inCriticalBlock) {
                            criticalCss += lines[i] + '\n';
                            braceCount += (line.match(/\{/g) || []).length;
                            braceCount -= (line.match(/\}/g) || []).length;
                            
                            if (braceCount === 0) {
                                inCriticalBlock = false;
                            }
                        }
                    }
                }
            });

            // Minify critical CSS if requested
            if (minify) {
                criticalCss = criticalCss
                    .replace(/\s+/g, ' ')
                    .replace(/;\s*}/g, '}')
                    .replace(/{\s*/g, '{')
                    .replace(/;\s*/g, ';')
                    .replace(/,\s*/g, ',')
                    .trim();
            }

            // Ensure output directory exists
            const outputDir = dirname(outputPath);
            mkdirSync(outputDir, { recursive: true });

            // Write critical CSS file
            writeFileSync(outputPath, criticalCss);
            
            console.log(`✅ Critical CSS extracted to: ${outputPath} (${Math.round(criticalCss.length / 1024)}KB)`);
        }
    };
}
