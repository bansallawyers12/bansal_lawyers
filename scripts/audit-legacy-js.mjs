#!/usr/bin/env node
/**
 * Phase 9 — Fail if jQuery / Bootstrap (or related legacy assets) creep back.
 * Pattern adapted from bansal-immigration scripts/audit-legacy-js.mjs.
 */
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, '..');
const violations = [];

function walk(dir, { ext = null, skipDirs = ['node_modules', 'vendor', 'archive'] } = {}, files = []) {
    if (!fs.existsSync(dir)) return files;
    for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
        const full = path.join(dir, entry.name);
        if (entry.isDirectory()) {
            if (skipDirs.includes(entry.name)) continue;
            walk(full, { ext, skipDirs }, files);
        } else if (!ext || entry.name.endsWith(ext)) {
            files.push(full);
        }
    }
    return files;
}

function rel(file) {
    return path.relative(root, file).replace(/\\/g, '/');
}

// --- 1. package.json must not list jquery / bootstrap ---
const pkgPath = path.join(root, 'package.json');
const pkg = JSON.parse(fs.readFileSync(pkgPath, 'utf8'));
const allDeps = {
    ...(pkg.dependencies || {}),
    ...(pkg.devDependencies || {}),
    ...(pkg.optionalDependencies || {}),
    ...(pkg.peerDependencies || {}),
};
const forbiddenPackages = ['jquery', 'bootstrap', 'bootstrap-sass', 'popper.js'];
for (const name of forbiddenPackages) {
    if (Object.prototype.hasOwnProperty.call(allDeps, name)) {
        violations.push(`package.json — forbidden dependency "${name}"`);
    }
}

// --- 2. Live public/js must not contain jquery / bootstrap / dead plugins ---
const publicJsDir = path.join(root, 'public', 'js');
const forbiddenNameRe =
    /^(jquery|bootstrap|scrollax|popper)/i;
const forbiddenSubstringRe =
    /jquery\.|bootstrap\.|animateNumber|stellar|waypoints|easing\.1/i;

if (fs.existsSync(publicJsDir)) {
    for (const file of walk(publicJsDir, { ext: '.js', skipDirs: ['node_modules', 'vendor', 'archive'] })) {
        const base = path.basename(file);
        if (forbiddenNameRe.test(base) || forbiddenSubstringRe.test(base)) {
            violations.push(`${rel(file)} — forbidden legacy file in public/js/ (move to archive/ or delete)`);
        }
    }
}

// --- 3. Live public/css must not link stock Bootstrap stylesheets ---
const publicCssDir = path.join(root, 'public', 'css');
if (fs.existsSync(publicCssDir)) {
    const bootstrapDir = path.join(publicCssDir, 'bootstrap');
    if (fs.existsSync(bootstrapDir) && fs.statSync(bootstrapDir).isDirectory()) {
        violations.push('public/css/bootstrap/ — forbidden Bootstrap CSS directory');
    }
    for (const file of walk(publicCssDir, { ext: '.css', skipDirs: ['node_modules', 'vendor', 'archive'] })) {
        const base = path.basename(file);
        if (/\.(archive|stisla-archive)\.css$/i.test(base)) continue;
        if (/^bootstrap(_lawyers)?(\.min)?\.css$/i.test(base) || /^bootstrap\.bundle/i.test(base)) {
            violations.push(`${rel(file)} — forbidden Bootstrap CSS in public/css/`);
        }
    }
}

// --- 4. Blade / PHP views must not load jquery or bootstrap assets / CDN ---
const bladeRoots = [path.join(root, 'resources', 'views')];
const bladePatterns = [
    { re: /jquery[-.]?\d|jquery\.min|jquery\.js|jquery\.easing|jquery\.stellar|jquery\.waypoints|animateNumber/i, label: 'jQuery asset' },
    { re: /bootstrap\.bundle|bootstrap_lawyers|bootstrap\.min\.css|bootstrap@\d|bootstrap-social/i, label: 'Bootstrap asset' },
    { re: /cdn\.jsdelivr\.net\/npm\/(jquery|bootstrap)/i, label: 'jQuery/Bootstrap CDN' },
    { re: /code\.jquery\.com/i, label: 'jQuery CDN' },
    { re: /stackpath\.bootstrapcdn\.com|cdn\.jsdelivr\.net\/npm\/bootstrap/i, label: 'Bootstrap CDN' },
];

for (const viewsRoot of bladeRoots) {
    for (const file of walk(viewsRoot, { ext: '.php', skipDirs: ['node_modules', 'vendor'] })) {
        const content = fs.readFileSync(file, 'utf8');
        const lines = content.split('\n');
        lines.forEach((line, index) => {
            // Skip HTML/Blade comments
            const trimmed = line.trim();
            if (trimmed.startsWith('{{--') || trimmed.startsWith('<!--') || trimmed.startsWith('*') || trimmed.startsWith('//')) {
                return;
            }
            for (const { re, label } of bladePatterns) {
                if (re.test(line)) {
                    violations.push(`${rel(file)}:${index + 1} — ${label}: ${trimmed.slice(0, 120)}`);
                }
            }
        });
    }
}

// --- 5. resources/js must not import npm jquery / bootstrap ---
const resourcesJs = path.join(root, 'resources', 'js');
const importPatterns = [
    /from\s+['"]jquery['"]/,
    /import\s+['"]jquery['"]/,
    /require\s*\(\s*['"]jquery['"]\s*\)/,
    /from\s+['"]bootstrap(?:\/[^'"]*)?['"]/,
    /import\s+['"]bootstrap(?:\/[^'"]*)?['"]/,
    /require\s*\(\s*['"]bootstrap(?:\/[^'"]*)?['"]\s*\)/,
];

for (const file of walk(resourcesJs, { ext: '.js', skipDirs: ['node_modules', 'vendor'] })) {
    const content = fs.readFileSync(file, 'utf8');
    const lines = content.split('\n');
    lines.forEach((line, index) => {
        const trimmed = line.trim();
        if (trimmed.startsWith('//') || trimmed.startsWith('*')) return;
        for (const re of importPatterns) {
            if (re.test(line)) {
                violations.push(`${rel(file)}:${index + 1} — forbidden import: ${trimmed.slice(0, 120)}`);
            }
        }
    });
}

// --- 6. Vite build must not emit vendor-jquery / vendor-bootstrap chunks ---
const manifestCandidates = [
    path.join(root, 'public', 'build', 'manifest.json'),
    path.join(root, 'public', 'build', '.vite', 'manifest.json'),
];
for (const manifestPath of manifestCandidates) {
    if (!fs.existsSync(manifestPath)) continue;
    const raw = fs.readFileSync(manifestPath, 'utf8');
    if (/vendor-jquery/i.test(raw) || /vendor-bootstrap/i.test(raw)) {
        violations.push(`${rel(manifestPath)} — contains vendor-jquery or vendor-bootstrap chunk`);
    }
    // Also flag hashed assets named like jquery / bootstrap vendor
    if (/["'][^"']*jquery[^"']*\.js["']/i.test(raw) && /node_modules|vendor-jquery/i.test(raw)) {
        violations.push(`${rel(manifestPath)} — jquery appears in Vite manifest`);
    }
}

// --- 7. vite.config must not define vendor-jquery / vendor-bootstrap groups ---
const viteConfigPath = path.join(root, 'vite.config.js');
if (fs.existsSync(viteConfigPath)) {
    const vite = fs.readFileSync(viteConfigPath, 'utf8');
    if (/vendor-jquery|vendor-bootstrap|node_modules[\\/]+jquery|node_modules[\\/]+bootstrap/i.test(vite)) {
        violations.push('vite.config.js — references jquery/bootstrap vendor chunks or packages');
    }
}

if (violations.length === 0) {
    console.log('audit:legacy-js — OK (no jQuery/Bootstrap creep)');
    process.exit(0);
}

console.error('audit:legacy-js — FAILED\n');
violations.forEach((v) => console.error(`  VIOLATION: ${v}`));
process.exit(1);
