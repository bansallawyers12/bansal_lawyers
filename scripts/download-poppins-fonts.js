/**
 * Script to download missing Poppins font files from Google Fonts
 * 
 * Usage: node scripts/download-poppins-fonts.js
 * 
 * This script downloads the missing Poppins font weights (300, 500, 700, 800)
 * from Google Fonts and saves them to public/fonts/poppins/
 */

const https = require('https');
const fs = require('fs');
const path = require('path');

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
 * Extract WOFF2 URL from Google Fonts CSS
 */
async function getWoff2Url(weight) {
  return new Promise((resolve, reject) => {
    const url = `${GOOGLE_FONTS_API}${weight}&display=swap`;
    
    https.get(url, (response) => {
      let data = '';
      
      response.on('data', (chunk) => {
        data += chunk;
      });
      
      response.on('end', () => {
        // Extract WOFF2 URL from CSS
        const woff2Match = data.match(/url\(([^)]+\.woff2[^)]*)\)/);
        if (woff2Match && woff2Match[1]) {
          let fontUrl = woff2Match[1];
          // Remove quotes if present
          fontUrl = fontUrl.replace(/['"]/g, '');
          resolve(fontUrl);
        } else {
          reject(new Error(`Could not find WOFF2 URL for weight ${weight}`));
        }
      });
    }).on('error', reject);
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

