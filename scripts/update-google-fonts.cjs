const fs = require('fs');
const path = require('path');

const OUTPUT_PATH = path.join(__dirname, '../data/google-fonts.json');

const SYSTEM_FONTS = {
    "inherit": { "category": "system" },
    "system-stack": { "category": "system" },
    "Arial, sans-serif": { "category": "system" },
    "Helvetica, sans-serif": { "category": "system" },
    "Verdana, sans-serif": { "category": "system" },
    "Tahoma, sans-serif": { "category": "system" },
    "Trebuchet MS, sans-serif": { "category": "system" },
    "Georgia, serif": { "category": "system" },
    "Palatino, serif": { "category": "system" },
    "Garamond, serif": { "category": "system" },
    "Times New Roman, serif": { "category": "system" },
    "Courier New, monospace": { "category": "system" },
    "Impact, sans-serif": { "category": "system" },
    "Bookman, serif": { "category": "system" }
};

function mapCategory(rawCat) {
    if (!rawCat) return 'sans-serif';
    const lower = rawCat.toLowerCase();
    if (lower === 'sans serif') return 'sans-serif';
    if (lower === 'serif') return 'serif';
    if (lower === 'display') return 'display';
    if (lower === 'handwriting') return 'handwriting';
    if (lower === 'monospace') return 'monospace';
    return 'sans-serif';
}

async function updateCatalog() {
    console.log('Fetching full Google Fonts metadata (1,900+ fonts)...');
    const response = await fetch('https://fonts.google.com/metadata/fonts');
    const text = await response.text();
    const cleanText = text.replace(/^\)]\}'\n?/, '').trim();
    const data = JSON.parse(cleanText);

    if (!data.familyMetadataList || !Array.isArray(data.familyMetadataList)) {
        throw new Error('Invalid response structure from Google Fonts metadata.');
    }

    const catalog = { ...SYSTEM_FONTS };
    let googleCount = 0;

    // Sort families alphabetically for clean diff and predictable ordering
    data.familyMetadataList.sort((a, b) => a.family.localeCompare(b.family));

    for (const font of data.familyMetadataList) {
        if (!font.family) continue;

        const category = mapCategory(font.category);
        const weightsSet = new Set();

        if (font.fonts && typeof font.fonts === 'object') {
            for (const key of Object.keys(font.fonts)) {
                // Strip trailing 'i' for italics and parse integer weight
                const numStr = key.replace(/i$/, '');
                const weightNum = parseInt(numStr, 10);
                if (!isNaN(weightNum) && weightNum >= 100 && weightNum <= 1000) {
                    weightsSet.add(weightNum);
                }
            }
        }

        // If axes defines a continuous wght range (variable font), expand standard steps
        if (font.axes && Array.isArray(font.axes)) {
            const wghtAxis = font.axes.find(a => a.tag === 'wght');
            if (wghtAxis && typeof wghtAxis.min === 'number' && typeof wghtAxis.max === 'number') {
                const standardWeights = [100, 200, 300, 400, 500, 600, 700, 800, 900];
                for (const w of standardWeights) {
                    if (w >= wghtAxis.min && w <= wghtAxis.max) {
                        weightsSet.add(w);
                    }
                }
            }
        }

        // Default to 400 if no weights found
        if (weightsSet.size === 0) {
            weightsSet.add(400);
        }

        const sortedWeights = Array.from(weightsSet).sort((a, b) => a - b);

        catalog[font.family] = {
            category: category,
            weights: sortedWeights
        };
        googleCount++;
    }

    fs.writeFileSync(OUTPUT_PATH, JSON.stringify(catalog), 'utf8');
    console.log(`Successfully updated google-fonts.json!`);
    console.log(`System fonts: ${Object.keys(SYSTEM_FONTS).length}`);
    console.log(`Google fonts: ${googleCount}`);
    console.log(`Total entries: ${Object.keys(catalog).length}`);
}

updateCatalog().catch(err => {
    console.error('Error updating Google Fonts catalog:', err);
    process.exit(1);
});
