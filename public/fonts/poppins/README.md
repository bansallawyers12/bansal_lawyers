# Poppins Font Files

This directory should contain the following WOFF2 font files:

## Required Font Files

1. `poppins-light.woff2` (weight: 300)
2. `poppins-regular.woff2` (weight: 400)
3. `poppins-medium.woff2` (weight: 500)
4. `poppins-semibold.woff2` (weight: 600)
5. `poppins-bold.woff2` (weight: 700)
6. `poppins-extrabold.woff2` (weight: 800)

## How to Download

### Option 1: Google Fonts Helper (Recommended)
1. Visit: https://google-webfonts-helper.herokuapp.com/fonts/poppins
2. Select weights: 300, 400, 500, 600, 700, 800
3. Select "latin" subset
4. Choose "woff2" format
5. Download and extract files
6. Rename files to match the naming convention above

### Option 2: Direct from Google Fonts
1. Visit: https://fonts.google.com/specimen/Poppins
2. Click "Download family"
3. Extract the ZIP file
4. Convert TTF files to WOFF2 using an online converter or tool like `woff2_compress`
5. Rename files to match the naming convention above

### Option 3: Using woff2_compress (if you have TTF files)
```bash
# Install woff2 tools (if not already installed)
# On Windows: Download from https://github.com/google/woff2/releases
# On Mac: brew install woff2
# On Linux: apt-get install woff2

# Convert TTF to WOFF2
woff2_compress Poppins-Light.ttf
woff2_compress Poppins-Regular.ttf
woff2_compress Poppins-Medium.ttf
woff2_compress Poppins-SemiBold.ttf
woff2_compress Poppins-Bold.ttf
woff2_compress Poppins-ExtraBold.ttf

# Rename files
mv Poppins-Light.woff2 poppins-light.woff2
mv Poppins-Regular.woff2 poppins-regular.woff2
mv Poppins-Medium.woff2 poppins-medium.woff2
mv Poppins-SemiBold.woff2 poppins-semibold.woff2
mv Poppins-Bold.woff2 poppins-bold.woff2
mv Poppins-ExtraBold.woff2 poppins-extrabold.woff2
```

## File Size Estimate
- Total size: ~150-200KB for all 6 weights in WOFF2 format

## Notes
- Only WOFF2 format is required (modern browsers support it)
- Font files are loaded via `public/css/fonts.css`
- Fonts are preloaded in layout files for optimal performance
