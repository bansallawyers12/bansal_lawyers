import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const src = path.join(__dirname, '..', 'node_modules', 'tinymce');
const dest = path.join(__dirname, '..', 'public', 'assets', 'tinymce');

const dirsToCopy = ['icons', 'models', 'plugins', 'skins', 'themes'];
const filesToCopy = ['tinymce.min.js', 'license.md'];

function copyRecursive(srcDir, destDir) {
    fs.mkdirSync(destDir, { recursive: true });
    for (const entry of fs.readdirSync(srcDir, { withFileTypes: true })) {
        const srcPath = path.join(srcDir, entry.name);
        const destPath = path.join(destDir, entry.name);
        if (entry.isDirectory()) {
            copyRecursive(srcPath, destPath);
        } else {
            fs.copyFileSync(srcPath, destPath);
        }
    }
}

if (!fs.existsSync(src)) {
    console.error('TinyMCE not found in node_modules. Run npm install first.');
    process.exit(1);
}

if (fs.existsSync(dest)) {
    fs.rmSync(dest, { recursive: true });
}
fs.mkdirSync(dest, { recursive: true });

for (const dir of dirsToCopy) {
    copyRecursive(path.join(src, dir), path.join(dest, dir));
}
for (const file of filesToCopy) {
    fs.copyFileSync(path.join(src, file), path.join(dest, file));
}

console.log('TinyMCE copied to public/assets/tinymce');
