import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.join(__dirname, '..');
const src = path.join(root, 'node_modules', 'feather-icons', 'dist', 'feather.min.js');
const dest = path.join(root, 'public', 'js', 'feather.min.js');

if (!fs.existsSync(src)) {
    console.error('feather-icons not found in node_modules — run npm install first');
    process.exit(1);
}

fs.mkdirSync(path.dirname(dest), { recursive: true });
fs.copyFileSync(src, dest);
console.log('Copied feather.min.js to public/js/feather.min.js');
