# Asset Minification Script

## Overview

This script minifies CSS and JavaScript files that are flagged as unminified by Google Search Console, even though they have `.min` extensions.

## Files Minified

- `public/css/style_lawyer.min.css`
- `public/js/Frontend/sticky.min.js`
- `public/js/Frontend/hoverIntent.min.js`

## Usage

Run the minification script using npm:

```bash
npm run minify-assets
```

Or directly with Node.js:

```bash
node scripts/minify-assets.js
```

## What It Does

1. **CSS Minification**: Removes comments, unnecessary whitespace, and optimizes formatting
2. **JavaScript Minification**: Uses Terser to compress and optimize JavaScript code

## Results

The script provides detailed output showing:
- Original file size
- Minified file size
- Percentage reduction
- Summary of all files processed

## When to Run

- After making changes to the source files (`style_lawyer.css`, `sticky.js`, `hoverIntent.js`)
- Before deploying to production
- As part of your build/deployment process

## Note

The script overwrites the `.min` files. Make sure you have backups or version control if needed.

## Integration with CI/CD

You can add this to your deployment pipeline:

```bash
npm run minify-assets
```

