const ExcelJS = require('exceljs');
const fs = require('fs');
const path = require('path');

async function generateRoadmapExcel() {
  const workbook = new ExcelJS.Workbook();
  workbook.creator = 'Gravisain Theme Architect';
  workbook.lastModifiedBy = 'Senior WordPress Software Architect';
  workbook.created = new Date();
  workbook.modified = new Date();

  const worksheet = workbook.addWorksheet('Gravisain Completeness Roadmap', {
    views: [{ state: 'frozen', ySplit: 1 }]
  });

  // Define Columns
  worksheet.columns = [
    { header: 'Kategori', key: 'category', width: 28 },
    { header: 'Fitur yang Sudah Selesai (Completed)', key: 'completed', width: 55 },
    { header: 'Fitur yang Masih Kurang / Perlu Ditambahkan (Missing)', key: 'missing', width: 45 },
    { header: 'Status / Progres', key: 'status', width: 24 }
  ];

  const rows = [
    {
      category: '1. Core & Architecture',
      completed: 'Bootstrap & Lifecycle OOP (PSR-4)\nVite Build System (CSS, JS, Asset compilation)\nDynamic CSS Generator\nSafe Autoloader & Hook Registry',
      missing: 'None (Sudah sangat kokoh dan siap dikembangkan jangka panjang)',
      status: 'Selesai (100%)'
    },
    {
      category: '2. Header Builder',
      completed: 'Grid 3 baris (Top, Main, Bottom)\n11 Komponen Modular Lengkap (Logo, Primary Menu, Secondary Menu, Action Button, Social, HTML, Search, Account, Divider, Contact Info, WooCommerce Cart)\nOff-Canvas Drawer + Hamburger Menu (Mobile)\nSticky & Transparent Header\nDrag & Drop UI Customizer & Live Preview Shortcut',
      missing: 'None (Seluruh 11 komponen modular header telah selesai 100%)',
      status: 'Selesai (100%)'
    },
    {
      category: '3. Footer Builder',
      completed: 'Grid 3 baris dengan 1 hingga 4 kolom responsif\nKomponen Modular (Copyright, Footer Navigation, Social Icons, 4 Area Widget WordPress, Custom HTML / Shortcode Component)\nSelective Refresh Live Preview Shortcut',
      missing: 'None (Seluruh komponen widget dan Custom HTML telah selesai 100%)',
      status: 'Selesai (100%)'
    },
    {
      category: '4. Blog & Layouts',
      completed: 'Archive Grid (2/3 Col), List, & Standard Layout\nSidebar (Left, Right, None)\nMetadata Control (Author, Date, Category, dll.)\nAuthor Bio Box & Post Navigation\nZero-CLS Comments Section\nNative Breadcrumbs Schema.org (Yoast/RankMath/SEOPress integration + Native Fallback)\nPage Header / Hero Banner Controller (Solid/Gradient/Featured Image overlay + Alignment)',
      missing: 'None (Seluruh navigasi breadcrumb dan hero banner telah selesai 100%)',
      status: 'Selesai (100%)'
    },
    {
      category: '5. Page Settings (Meta Box)',
      completed: 'Integrasi Hybrid Meta Box (REST API Gutenberg + PHP Classic Editor Sidebar Panel)\nDisable Elements per-halaman (Hide Header, Hide Footer, Hide Page Title/Hero Area)\nSidebar Layout Override per-halaman (Default, No Sidebar, Left, Right)',
      missing: 'None (Meta box per halaman/postingan telah selesai 100%)',
      status: 'Selesai (100%)'
    },
    {
      category: '6. WooCommerce Integration',
      completed: 'Deklarasi dukungan tema WooCommerce & galeri zoom/lightbox/slider\nWooCommerce Customizer Panel (Kolom grid produk, produk per halaman, perataan kartu, sale badge)\nAJAX Cart Fragment Update otomatis untuk Header Cart badge\nSingle Product Page: Sticky Add to Cart Bar di bawah halaman\nDistraction-Free Checkout (sembunyikan header & footer saat checkout)',
      missing: 'None (WooCommerce Deep Integration telah selesai 100%)',
      status: 'Selesai (100%)'
    },
    {
      category: '7. Developer & Advanced Tools',
      completed: 'Starter Sites Importer (Demo Data, Media Import/Clean, FSE Hotfix)\nWp-Admin Dashboard Gravisain (Welcome Page)',
      missing: 'Hooked Elements / Custom Layouts: Fitur CPT di mana user bisa mendesain content dengan block lalu memasangnya di action hook tertentu dengan conditional display rules',
      status: '30% Selesai'
    },
    {
      category: '8. Performance & Compliance',
      completed: 'Vite minification & cache-busting\nZero jQuery dependency (Vanilla JS ES Module)\nDynamic Google Fonts enqueue',
      missing: 'Local Google Fonts Downloader: Unduh font otomatis ke lokal agar 100% GDPR-compliant\nDynamic CSS File Caching: Menyimpan dynamic CSS hasil customizer ke server (file fisik .css)',
      status: '70% Selesai'
    }
  ];

  // Style Header Row
  const headerRow = worksheet.getRow(1);
  headerRow.height = 28;
  headerRow.eachCell((cell) => {
    cell.font = { name: 'Segoe UI', size: 11, bold: true, color: { argb: 'FFFFFFFF' } };
    cell.fill = {
      type: 'pattern',
      pattern: 'solid',
      fgColor: { argb: 'FF1E293B' } // Slate 800 dark
    };
    cell.alignment = { vertical: 'middle', horizontal: 'center', wrapText: true };
    cell.border = {
      top: { style: 'medium', color: { argb: 'FF0F172A' } },
      left: { style: 'thin', color: { argb: 'FF334155' } },
      bottom: { style: 'medium', color: { argb: 'FF0F172A' } },
      right: { style: 'thin', color: { argb: 'FF334155' } }
    };
  });

  // Add Data Rows
  rows.forEach((item, index) => {
    const row = worksheet.addRow([item.category, item.completed, item.missing, item.status]);
    row.height = 85;

    const isEven = index % 2 === 0;
    const bgColor = isEven ? 'FFFFFFFF' : 'FFF8FAFC'; // White or very soft slate

    row.eachCell((cell, colIndex) => {
      cell.font = { name: 'Segoe UI', size: 10, color: { argb: 'FF1E293B' } };
      cell.fill = {
        type: 'pattern',
        pattern: 'solid',
        fgColor: { argb: bgColor }
      };
      cell.border = {
        top: { style: 'thin', color: { argb: 'FFE2E8F0' } },
        left: { style: 'thin', color: { argb: 'FFE2E8F0' } },
        bottom: { style: 'thin', color: { argb: 'FFE2E8F0' } },
        right: { style: 'thin', color: { argb: 'FFE2E8F0' } }
      };

      if (colIndex === 1) {
        cell.font = { name: 'Segoe UI', size: 10.5, bold: true, color: { argb: 'FF0F172A' } };
        cell.alignment = { vertical: 'top', horizontal: 'left', wrapText: true };
      } else if (colIndex === 4) {
        cell.alignment = { vertical: 'middle', horizontal: 'center', wrapText: true };
        cell.font = { name: 'Segoe UI', size: 10, bold: true };
        if (cell.value === 'Selesai (100%)') {
          cell.font = { name: 'Segoe UI', size: 10, bold: true, color: { argb: 'FF15803D' } }; // Green
          cell.fill = { type: 'pattern', pattern: 'solid', fgColor: { argb: 'FFDCFCE7' } }; // Soft green background
        } else {
          cell.font = { name: 'Segoe UI', size: 10, bold: true, color: { argb: 'FFB45309' } }; // Amber
          cell.fill = { type: 'pattern', pattern: 'solid', fgColor: { argb: 'FFFEF3C7' } }; // Soft amber background
        }
      } else {
        cell.alignment = { vertical: 'top', horizontal: 'left', wrapText: true };
      }
    });
  });

  const outPath = path.join(__dirname, '../gravisain-features-roadmap.xlsx');
  const fallbackPath = path.join(__dirname, '../gravisain-features-roadmap-updated.xlsx');
  try {
    await workbook.xlsx.writeFile(outPath);
    console.log('Successfully generated Excel file at:', outPath);
  } catch (e) {
    await workbook.xlsx.writeFile(fallbackPath);
    console.log('Original open in Excel. Generated Excel file at:', fallbackPath);
  }

  // Also update CSV
  const csvLines = [
    'Kategori;Fitur yang Sudah Selesai (Completed);Fitur yang Masih Kurang / Perlu Ditambahkan (Missing);Status / Progres'
  ];
  rows.forEach((item) => {
    const cleanCompleted = item.completed.replace(/\n/g, ' - ').replace(/"/g, '""');
    const cleanMissing = item.missing.replace(/\n/g, ' - ').replace(/"/g, '""');
    csvLines.push(`"${item.category}";"${cleanCompleted}";"${cleanMissing}";"${item.status}"`);
  });
  fs.writeFileSync(path.join(__dirname, '../gravisain-features-roadmap.csv'), csvLines.join('\r\n'));
  console.log('Successfully updated CSV file as well.');
}

generateRoadmapExcel().catch(console.error);
