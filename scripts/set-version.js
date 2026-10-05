import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const themeDir = path.resolve(__dirname, '..');

/**
 * Synchronize theme version across all project files:
 * 1. style.css (Theme Header: Version: X.Y.Z)
 * 2. functions.php (Constant: define( 'GRAVISAIN_VERSION', 'X.Y.Z' ))
 * 3. readme.txt (Stable tag: X.Y.Z & Changelog entry)
 * 4. package.json (version property)
 *
 * @param {string} newVersion Target version string (e.g. '1.0.2')
 */
export function syncVersion(newVersion) {
  if (!newVersion || !/^\d+\.\d+(\.\d+)?(-[a-zA-Z0-9.]+)?$/.test(newVersion.trim())) {
    console.error(`❌ Format versi tidak valid: "${newVersion}". Contoh yang benar: 1.0.2 atau 1.1.0`);
    process.exit(1);
  }

  const ver = newVersion.trim();
  console.log(`\n🔄 Menyeragamkan versi Tema Gravisain ke: v${ver}...`);

  // 1. Update style.css
  const stylePath = path.join(themeDir, 'style.css');
  if (fs.existsSync(stylePath)) {
    let styleContent = fs.readFileSync(stylePath, 'utf8');

    // Update Header: Version: X.Y.Z
    styleContent = styleContent.replace(
      /(Version:\s*)([^\r\n]+)/i,
      `$1${ver}`
    );

    fs.writeFileSync(stylePath, styleContent, 'utf8');
    console.log(`  ✓ style.css (Version: ${ver})`);
  }

  // 2. Update functions.php
  const functionsPath = path.join(themeDir, 'functions.php');
  if (fs.existsSync(functionsPath)) {
    let functionsContent = fs.readFileSync(functionsPath, 'utf8');

    // Update Constant: define( 'GRAVISAIN_VERSION', 'X.Y.Z' );
    functionsContent = functionsContent.replace(
      /(define\(\s*['"]GRAVISAIN_VERSION['"]\s*,\s*['"])([^'"]+)(['"]\s*\);)/,
      `$1${ver}$3`
    );

    fs.writeFileSync(functionsPath, functionsContent, 'utf8');
    console.log(`  ✓ functions.php (GRAVISAIN_VERSION: ${ver})`);
  }

  // 3. Update readme.txt
  const readmePath = path.join(themeDir, 'readme.txt');
  if (fs.existsSync(readmePath)) {
    let readmeContent = fs.readFileSync(readmePath, 'utf8');

    // Update Stable tag: X.Y.Z
    readmeContent = readmeContent.replace(
      /(Stable tag:\s*)([^\r\n]+)/i,
      `$1${ver}`
    );

    // If changelog does not have this version yet, add placeholder
    const changelogPattern = new RegExp(`=\\s*${ver.replace(/\./g, '\\.')}\\s*=`);
    if (!changelogPattern.test(readmeContent)) {
      const changelogHeader = '== Changelog ==';
      if (readmeContent.includes(changelogHeader)) {
        const newEntry = `== Changelog ==\n\n= ${ver} =\n* Maintenance update, style refinements, and sticky layout improvements.`;
        readmeContent = readmeContent.replace(changelogHeader, newEntry);
      }
    }

    fs.writeFileSync(readmePath, readmeContent, 'utf8');
    console.log(`  ✓ readme.txt (Stable tag: ${ver})`);
  }

  // 4. Update package.json
  const pkgPath = path.join(themeDir, 'package.json');
  if (fs.existsSync(pkgPath)) {
    const pkg = JSON.parse(fs.readFileSync(pkgPath, 'utf8'));
    pkg.version = ver;
    fs.writeFileSync(pkgPath, JSON.stringify(pkg, null, 2) + '\n', 'utf8');
    console.log(`  ✓ package.json (version: ${ver})`);
  }

  console.log(`✅ Seluruh file versi Tema Gravisain berhasil diseragamkan ke v${ver}!\n`);
  return ver;
}

// Allow running directly from CLI: node scripts/set-version.js 1.0.2
const args = process.argv.slice(2).filter((arg) => arg !== '--');
const targetVer = args[0];

if (targetVer) {
  syncVersion(targetVer);
} else if (process.argv[1] === __filename) {
  console.log('Penggunaan:');
  console.log('  npm run set-version <nomor_versi>');
  console.log('  node scripts/set-version.js <nomor_versi>');
  console.log('\nContoh:');
  console.log('  npm run set-version 1.0.2\n');
  process.exit(1);
}
