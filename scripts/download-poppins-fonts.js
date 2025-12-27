/**
 * Script to download missing Poppins font files from Google Fonts
 * 
 * Usage: node scripts/download-poppins-fonts.js
 * 
 * This script downloads the missing Poppins font weights (300, 500, 700, 800)
 * from Google Fonts and saves them to public/fonts/poppins/
 */

import https from 'https';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Font weights to download
const fontWeights = [
  { weight: 300, name: 'poppins-light' },
  { weight: 500, name: 'poppins-medium' },
  { weight: 700, name: 'poppins-bold' },
  { weight: 800, name: 'poppins-extrabold' }
];

// Google Fonts API endpoint
const GOOGLE_FONTS_API = 'https://fonts.googleapis.com/css2?family=Poppins:wght@';

// Output directory
const outputDir = path.join(__dirname, '..', 'public', 'fonts', 'poppins');

// Ensure output directory exists
if (!fs.existsSync(outputDir)) {
  fs.mkdirSync(outputDir, { recursive: true });
}

/**
 * Download a file from a URL
 */
function downloadFile(url, filepath) {
  return new Promise((resolve, reject) => {
    const file = fs.createWriteStream(filepath);
    
    https.get(url, (response) => {
      if (response.statusCode === 301 || response.statusCode === 302) {
        // Handle redirects
        return downloadFile(response.headers.location, filepath)
          .then(resolve)
          .catch(reject);
      }
      
      if (response.statusCode !== 200) {
        file.close();
        fs.unlinkSync(filepath);
        reject(new Error(`Failed to download: ${response.statusCode}`));
        return;
      }
      
      response.pipe(file);
      
      file.on('finish', () => {
        file.close();
        resolve();
      });
    }).on('error', (err) => {
      file.close();
      if (fs.existsSync(filepath)) {
        fs.unlinkSync(filepath);
      }
      reject(err);
    });
  });
}

/**
 * Get WOFF2 URL from Google Fonts Helper API
 * This is more reliable than parsing CSS
 */
async function getWoff2Url(weight) {
  // Use google-webfonts-helper API which provides direct download links
  const helperApiUrl = `https://gwfh.mranftl.com/api/fonts/poppins?download=zip&subsets=latin&formats=woff2&variants=${weight}`;
  
  return new Promise((resolve, reject) => {
    // First, try to get the direct URL from the helper API
    https.get(helperApiUrl, { 
      headers: {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
      }
    }, (response) => {
      let data = '';
      
      response.on('data', (chunk) => {
        data += chunk;
      });
      
      response.on('end', () => {
        try {
          const json = JSON.parse(data);
          if (json.files && json.files[`${weight}`] && json.files[`${weight}`]['woff2']) {
            resolve(json.files[`${weight}`]['woff2']);
            return;
          }
        } catch (e) {
          // Not JSON, continue to fallback
        }
        
        // Fallback: Try Google Fonts CSS with better parsing
        const cssUrl = `${GOOGLE_FONTS_API}${weight}&display=swap`;
        https.get(cssUrl, {
          headers: {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
          }
        }, (cssResponse) => {
          let cssData = '';
          cssResponse.on('data', (chunk) => cssData += chunk);
          cssResponse.on('end', () => {
            // Look for woff2 URLs in the CSS
            const urlMatches = cssData.matchAll(/url\(['"]?([^'")]+\.woff2[^'")]*)['"]?\)/g);
            for (const match of urlMatches) {
              let url = match[1].trim();
              if (url.includes('woff2')) {
                // Clean up the URL
                url = url.replace(/^['"]|['"]$/g, '');
                if (url.startsWith('//')) {
                  url = 'https:' + url;
                } else if (!url.startsWith('http')) {
                  url = 'https://fonts.gstatic.com' + (url.startsWith('/') ? '' : '/') + url;
                }
                resolve(url);
                return;
              }
            }
            reject(new Error(`Could not find WOFF2 URL for weight ${weight}`));
          });
        }).on('error', reject);
      });
    }).on('error', (err) => {
      // Final fallback: use known Google Fonts CDN pattern
      // These are approximate - may need adjustment
      const fallbackUrls = {
        300: 'https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDz8Z1xlFQ.woff2',
        500: 'https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLGT9Z1xlFQ.woff2',
        700: 'https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z1xlFQ.woff2',
        800: 'https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDD4Z1xlFQ.woff2'
      };
      
      if (fallbackUrls[weight]) {
        console.log(`   ⚠️  Using fallback URL for weight ${weight}`);
        resolve(fallbackUrls[weight]);
      } else {
        reject(err);
      }
    });
  });
}

/**
 * Download all missing fonts
 */
async function downloadFonts() {
  console.log('🚀 Starting Poppins font download...\n');
  
  for (const font of fontWeights) {
    const filepath = path.join(outputDir, `${font.name}.woff2`);
    
    // Skip if file already exists
    if (fs.existsSync(filepath)) {
      console.log(`⏭️  Skipping ${font.name}.woff2 (already exists)`);
      continue;
    }
    
    try {
      console.log(`📥 Downloading ${font.name}.woff2 (weight: ${font.weight})...`);
      
      // Get the WOFF2 URL from Google Fonts CSS
      const fontUrl = await getWoff2Url(font.weight);
      console.log(`   URL: ${fontUrl.substring(0, 80)}...`);
      
      // Download the font file
      await downloadFile(fontUrl, filepath);
      
      // Check file size
      const stats = fs.statSync(filepath);
      const fileSizeKB = (stats.size / 1024).toFixed(2);
      console.log(`✅ Downloaded ${font.name}.woff2 (${fileSizeKB} KB)\n`);
      
    } catch (error) {
      console.error(`❌ Error downloading ${font.name}.woff2:`, error.message);
      console.log('');
    }
  }
  
  console.log('✨ Font download complete!');
  console.log(`\n📁 Fonts saved to: ${outputDir}`);
  
  // List all Poppins fonts
  console.log('\n📋 Current Poppins font files:');
  const files = fs.readdirSync(outputDir).filter(f => f.endsWith('.woff2'));
  files.forEach(file => {
    const stats = fs.statSync(path.join(outputDir, file));
    const sizeKB = (stats.size / 1024).toFixed(2);
    console.log(`   - ${file} (${sizeKB} KB)`);
  });
}

// Run the script
downloadFonts().catch(console.error);

