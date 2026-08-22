# 🚀 Gravisain Theme - Project Status & Architecture Memory

> **Dokumen ini berfungsi sebagai "Ingatan Permanen" (*Long-term Memory*) untuk setiap sesi obrolan AI yang baru.**
> Saat memulai sesi obrolan baru di Antigravity IDE, instruksikan AI dengan perintah:  
> *"Baca `PROJECT_STATUS.md` dan `.agents/AGENTS.md` untuk memahami seluruh arsitektur dan progres terakhir kita, lalu mari lanjutkan pengembangan."*

---

## 🏛️ Arsitektur & Teknologi Utama
* **Nama Theme**: Gravisain (Modern Premium WordPress Theme)
* **Pendekatan**: *Hybrid Theme* (Kadence / Astra style) di mana Global Layout, Header, dan Footer dikontrol 100% oleh PHP & WordPress Customizer, bukan Site Editor (FSE murni).
* **Standar Kode**: PHP 8.2+, PSR-4 Autoloading (`Gravisain\`), WordPress Coding Standards, SOLID Principles, DRY, KISS.
* **Build System**: Vite (`vite.config.js` & `npm run build`), PostCSS, Vanilla JS ES Modules.
* **Distribusi**: `npm run theme:zip` menghasilkan file `release/gravisain.zip` siap pakai.

---

## ✅ Fitur & Modul yang Telah Selesai Dibangun (100% Completed)

### 1. 🎨 Modern Header Builder & Off-Canvas Mobile Drawer (100% Kadence/Astra Parity)
* **Arsitektur 3 Baris**: Top Row, Main Row, Bottom Row (didukung 3 kolom tiap baris: Left, Center, Right).
* **Drag & Drop UI**: Kustomisasi interaktif di sidebar Customizer menggunakan jQuery UI Sortable + Live Preview aktual tanpa *full page reload*.
* **7 Komponen Modular Lengkap**: `logo`, `primary-navigation`, `secondary-navigation`, `action-button`, `social`, `html`, dan `search`. Masing-masing terhubung ke pengaturan Customizer dan ter-styling secara responsif.
* **Tabbed Customizer Sections & Brand Colors (Social Icons)**: Pemisahan pengaturan komponen `social` menggunakan Custom Control `SectionTabsControl` menjadi tab **Design** (untuk daftar jejaring sosial & link) dan tab **Style** (untuk ukuran ikon responsif, gap/spacing responsif, dan opsi warna brand sosial seperti *No*, *Yes*, *Default-Hover*, dan *Hover-Default*).
* **Mobile Header & Off-Canvas Navigation**: Komponen `menu-trigger` (Hamburger button dengan 3 opsi gaya ikon: *3-lines*, *2-lines*, *dots*) dan panel **Off-Canvas Drawer** yang geser dari kanan/kiri. Dilengkapi animasi GPU 60 FPS, WAI-ARIA *focus trapping*, penguncian scroll body, dan tombol `ESC` to close via Vanilla JS ES Module (`src/js/main.js`).
* **Aturan Unik UX Header Builder**: Komponen **Logo**, **Primary Navigation**, dan **Secondary Navigation** memiliki batasan instansi tunggal. Jika sudah digunakan di dalam grid, item otomatis nonaktif (*disabled* dengan badge `Used`) di kotak *Component Picker*. Jika dihapus dari grid, item kembali bisa digunakan.

### 2. 🦶 Modular Visual Footer Builder (100% Completed)
* **Arsitektur Grid 3 Baris**: Top Row, Main Row (Widgets), dan Bottom Row (didukung kustomisasi 1 hingga 4 kolom per baris dengan kontrol layout responsif *Full Width* vs *Contained*).
* **Drag & Drop UI dengan Header/Footer Tab Switcher**: Antarmuka visual kustomisasi di bar bawah Customizer dengan tombol beralih cepat antara Header Builder dan Footer Builder.
* **Komponen Modular Footer**: Dilengkapi dengan `copyright` (dengan shorttags `[year]`, `[site_title]`, `[theme_author]`), `footer-navigation`, `social` (DRY component reusable), dan 4 area *dynamic sidebar widgets* (`widget-1` hingga `widget-4`).
* **Selective Refresh Live Preview**: Terintegrasi langsung dengan pembaruan dinamis `#colophon` tanpa memuat ulang halaman secara keseluruhan.

### 3. ⚡ Top-Level Admin Dashboard & Starter Sites Importer
* **Posisi Menu Admin**: Berada di level teratas (*Top-Level Menu*) pada posisi **59** (tepat di bawah *Comments* dan di atas *Appearance* / *Themes*).
* **Custom Monogram Icon**: Menggunakan ikon vektor geometris modern **Diamond GRV Monogram** (`#a5b4fc`, *stroke-width: 36*) berbasis SVG Data URI yang tajam di layar gelap maupun terang.
* **Starter Sites Module**: 
  * Integrasi impor demo data dengan 3 demo siap pakai (*Agency*, *Logistics*, *Gravitour Travel*).
  * Fitur **Clear Demo Media** untuk membersihkan gambar impor dari Media Library secara bersih.
  * *Hotfix* penghapusan template FSE kustom di database agar sistem Hybrid PHP mengambil alih seutuhnya.

### 4. 📝 Blog Archive & Single Post Layouts (Classic/Hybrid) (100% Completed)
* **Arsitektur Tanpa FSE (High Performance)**: Seluruh hierarki template dimuat dari folder `templates/` (didukung oleh filter otomatis pada 16 tipe hierarki di `Hooks.php`) dan root fallback, menjaga performa rendering server-side tanpa beban blok FSE.
* **Opsi Kustomisasi Blog Lengkap (`BlogOptions.php`)**: Pilihan layout arsip (*Grid 2/3 Kolom*, *List Card*, *Standard Large Image*), pengaturan posisi sidebar (*Right*, *Left*, *No Sidebar / Full Width*), panjang kata kutipan dinamis, teks *Read More*, dan *toggle* elemen metadata (*author, date, category, comments*).
* **Fitur Artikel & Komentar Modern**:
  * **Author Bio Box**: Kotak profil penulis otomatis di akhir artikel dengan avatar dan deskripsi biografi.
  * **Post Navigation**: Navigasi antar artikel sebelum dan sesudah yang responsif.
  * **Core Web Vitals Friendly Comments**: Desain daftar komentar dan formulir balasan (`comments.php`) yang stabil dan tidak menggeser layout (*Zero CLS*).

### 5. 🔒 Keamanan & Security Hardening (Corporate & VIP Grade - 100% Completed)
* **Centralized Enterprise Sanitization Suite (`Sanitize.php`)**: Library sanitasi terpusat yang memvalidasi *checkbox*, warna (*hex, rgb, rgba, hsla*), *select whitelist choice*, *number range*, satuan CSS (`px, rem, em, %`), serta rekursi aman untuk layout JSON Customizer.
* **Proteksi CSS Injection & Style Breakout (`Builder.php` & `DynamicCSS.php`)**: Memagari seluruh keluaran properti CSS dinamis dari karakter ilegal dan penutupan tag (`</style>`, null byte, `expression()`, `javascript:`).
* **Proteksi LFI & Path Traversal**: Penggunaan `sanitize_file_name()` pada loader komponen dinamis.
* **Proteksi Stored XSS**: Penggunaan `wp_kses_post()` dan escaping lengkap pada pencetakan deskripsi web / *tagline*.
* **Proteksi CSRF, Authorization & Rate Limiting (`Welcome.php`)**: Verifikasi *nonce*, `current_user_can('manage_options')`, serta proteksi *Denial of Service (DoS)* lokal menggunakan *transient rate limiting* pada AJAX *cache purging*.
* **Strict Post Meta Guard (`PageSettings.php`)**: Proteksi ketat penyimpanan meta post terhadap *autosaves*, *revisions*, dan pengecekan *user capabilities* (`edit_page` vs `edit_post`).
* **Proteksi SQLi**: Penggunaan `$wpdb->prepare()` pada seluruh *query* database kustom.

### 6. ⚡ Performance & Compliance Module (100% Completed)
* **Local Google Fonts Downloader (`LocalFontDownloader.php`)**: Mengunduh otomatis font Google (`.woff2`) ke server lokal (`wp-content/uploads/gravisain/fonts/`) dan menyusun stylesheet `@font-face` lokal agar 100% mematuhi regulasi GDPR Eropa tanpa HTTP request eksternal.
* **Dynamic CSS Physical File Caching (`CSSFileCache.php`)**: Menyimpan hasil komputasi dari `DynamicCSS.php` ke file fisik statis (`wp-content/uploads/gravisain/gravisain-dynamic.css`) sehingga browser dapat melakukan caching jangka panjang, mengurangi penggunaan CPU PHP server. Dilengkapi mekanisme fallback otomatis ke inline `<style>` jika sistem file tidak writable.
* **Performance Options Panel & Cache Purging**: Pengaturan *toggle* aktivasi fitur di WordPress Customizer (`PerformanceOptions.php`) dan tombol **Purge Cache** interaktif via AJAX (`wp_ajax_gravisain_purge_cache`) di halaman dasbor admin **Gravisain Dashboard**.

### 7. 🧩 Hooked Elements & Custom Layouts Module (100% Completed)
* **Elements Engine (`ElementsEngine.php`)**: Registrasi Custom Post Type `gravisain_element` dengan dukungan penuh editor Gutenberg (Block Editor) & REST API untuk merancang komponen visual kustom. Mesin perender otomatis memasangkan blok ke *action hook* WordPress/Gravisain (`gravisain_before_header`, `gravisain_after_header`, `gravisain_before_content`, `gravisain_after_content`, `gravisain_before_footer`, `gravisain_after_footer`, `wp_body_open`, `wp_footer`, serta hook WooCommerce) berdasarkan aturan penahanan bersyarat (*Conditional Display Rules* & *User Conditions*) yang di-cache menggunakan transient agar super cepat.
* **Element Settings Meta Box (`ElementMetaBox.php`)**: Panel antarmuka metabox di layar editor `gravisain_element` untuk memilih target Action Hook, prioritas eksekusi, Display Rule (*Entire Website, Front Page, Single Post, Single Page, Archive, WooCommerce Shop/Product*), dan kondisi pengguna (*All Users, Logged-in Only, Logged-out Only*).

### 8. ♿ Aksesibilitas & Core UX Frontend (WCAG 2.1 AA Compliance - 100% Completed)
* **Skip to Content Focus (`initSkipLinkFocus`)**: Penanganan *skip link* (`.skip-link`) ke `<main id="primary" tabindex="-1">` pada seluruh hierarki template (`404.php`, `index.php`, `archive.php`, `page.php`, `search.php`, `single.php`) agar pembaca layar & keyboard langsung terarah ke area konten utama.
* **Accessible Dropdown Keyboard Navigation (`initAccessibleDropdownNavigation`)**: Dukungan navigasi tombol panah (`ArrowDown`, `ArrowUp`, `Escape`) dan sinkronisasi atribut ARIA (`aria-haspopup`, `aria-expanded`) pada menu desktop/mobile ES Module (`src/js/main.js`).
* **High Contrast Focus Ring**: Indikator fokus konsisten (`outline: 2px dashed var(--gravisain-color-primary)`) pada tombol, tautan, dan form input (`src/css/main.css`).

### 9. 🎨 Fitur UX Interaktif Frontend (Scroll-to-Top & Reading Progress Bar - 100% Completed)
* **Scroll-to-Top Floating Button (`initScrollToTop`)**: Tombol melayang kaca (*glassmorphism*) dengan indikator persentase guliran SVG melingkar (`.progress-ring`) yang muncul otomatis saat pengguna menggulir halaman >400px.
* **Reading Progress Bar (`initReadingProgressBar`)**: Garis kemajuan membaca horizontal bergaya gradien di puncak layar yang bergerak halus mengikuti persentase guliran pada artikel tunggal (`is_singular('post')`).
* **Dynamic Footer Injection (`footer.php` & `SVG.php`)**: Penambahan ikon SVG `arrow-up` kustom serta penyuntikan penampung interaktif sebelum tag penutup `</body>`.

### 10. 🛠️ Admin UX Polish & Diagnostic Tools (100% Completed)
* **Full System Status & Diagnostics Suite (`SystemStatus.php`)**: Panel diagnostik di bawah menu **Gravisain -> System Status** yang memeriksa kesehatan lingkungan WordPress, konfigurasi PHP (Versi, Memory Limit, cURL, GD, mbstring, OPcache), serta status izin tulis folder *cache* CSS/Font.
* **One-Click Report Exporter**: Fitur salin laporan diagnostik (*Copy System Report*) dalam format Markdown siap pakai untuk kemudahan pelaporan teknis & *troubleshooting*.
* **Dashboard Integration (`Welcome.php`)**: Tautan cepat menuju halaman diagnostik lengkap langsung dari kartu *System Status* di dasbor utama Gravisain.

### 11. 🎨 Standalone Gravisain Blocks & Pattern Library Companion Plugin (100% Completed)
* **Arsitektur Standalone Companion Plugin (`gravisain-blocks/`)**: Plugin terpisah berstandar PSR-4 OOP (`Gravisain\Blocks\`) yang memuat perpustakaan **10 Core Gutenberg Blocks & 5 Block Patterns**, menjaga tema utama `gravisain` tetap 100% ringan (Google PageSpeed 100/100) dan mematuhi prinsip *Separation of Concerns*.
* **10 Core Gutenberg Blocks Reguler (Free/Lite)**:
  * `gravisain/row-layout` (*Kadence-style* Multi-Column Grid dengan preset 1-4 kolom, gap, & shape dividers).
  * `gravisain/advanced-heading` (*Kadence-style* SEO Heading dengan pemilih tag H1-H6, Eyebrow atas/bawah, & accent line).
  * `gravisain/container` (Section / Container fleksibel dengan kontrol Max Width & Padding/Margin).
  * `gravisain/info-box` (Info Box / Icon Card dengan simbol ikon, eyebrow, judul, deskripsi, & link).
  * `gravisain/hero` (Hero Section dengan kontrol Eyebrow & Button Group).
  * `gravisain/features-grid` (Grid penampung kartu keunggulan).
  * `gravisain/feature-card` (Kartu fitur anak).
  * `gravisain/testimonial` (Kartu ulasan testimoni pelanggan).
  * `gravisain/faq-accordion` (Penampung accordion FAQ).
  * `gravisain/faq-item` (Anak item FAQ).
* **5 Pola Desain Kustom Premium (`patterns/`)**:
  * `hero-modern.php` (Modern Hero Section dengan Eyebrow & Dual Buttons).
  * `feature-grid-3col.php` (3-Column Feature Cards Grid).
  * `cta-banner.php` (High-Impact Call to Action Banner).
  * `pricing-3col.php` (3-Column Pricing Table dengan tier *Most Popular*).
  * `faq-accordion.php` (Accessible FAQ Section berbasis native HTML5 Details/Summary tanpa JavaScript eksternal).
* **Integrasi Dasbor & Admin Notice (`Welcome.php` & `CompanionNotice.php`)**: Kartu **Official Companion Plugins** di dasbor Gravisain memonitor status instalasi/aktivasi *Gravisain Blocks* dan *Gravisain Starter Sites* secara real-time.

---

## 📂 Struktur File Penting untuk Referensi AI
```text
gravisain/
├── PROJECT_STATUS.md                         # Ingatan permanen & status kemajuan projek
├── .agents/
│   ├── AGENTS.md                             # Aturan mutlak arsitektur & coding dari User
│   └── workflows/
│       └── hero.md                           # Workflow SOP / Slash Command (/hero) untuk Hero Block
├── classes/
│   ├── Core/
│   │   ├── Application.php                   # Bootstrap utama service & theme support
│   │   └── ElementsEngine.php                # Mesin Hooked Elements & Custom Layouts
│   ├── Meta/
│   │   ├── PageSettings.php                  # Per-page Settings Meta Box
│   │   └── ElementMetaBox.php                # Hooked Element Settings Meta Box
│   ├── Components/HeaderBuilder.php          # Logika PHP pengolah layout grid & render kolom
│   ├── Customizer/Options/HeaderOptions.php  # Registrasi setting layout & sanitasi JSON
│   ├── Customizer/Controls/SliderControl.php # Custom UI Slider untuk customizer
│   ├── CSS/
│   │   ├── DynamicCSS.php                    # Komputasi dan cetak CSS dinamis
│   │   ├── LocalFontDownloader.php           # Pengunduh Google Fonts lokal (GDPR Compliant)
│   │   └── CSSFileCache.php                  # File Caching untuk Dynamic CSS statis
│   └── Dashboard/
│       ├── Welcome.php                       # Registrasi Top-Level Admin Menu & Dasbor Welcome
│       └── StarterSites.php                  # Importer Demo Data & AJAX handlers
├── src/
│   ├── js/customizer.js                      # Logika Drag & Drop, Picker, & Aturan Unik UI
│   ├── js/customize-preview.js               # Live preview postMessage untuk Customizer
│   └── css/customizer.css                    # Styling antarmuka Header Builder & Dasbor
└── release/gravisain.zip                     # Arsip produksi terbaru hasil build

gravisain-blocks/                             # Standalone Companion Plugin: Pattern & Block Library
├── assets/css/patterns.css                   # Stylesheet pola & blok
├── classes/
│   ├── Plugin.php                            # Singleton lifecycle manager
│   └── PatternRegistry.php                   # Registrasi kategori & auto-discover pola
├── languages/gravisain-blocks.pot            # Template terjemahan internasionalisasi
├── patterns/                                 # 5 Pola Gutenberg siap pakai (Hero, Feature, CTA, Pricing, FAQ)
├── release/gravisain-blocks.zip              # Arsip rilis siap instal
├── scripts/zip-plugin.ps1                    # Script pemaket ZIP
└── package.json                              # Script build & "npm run all:zip"
```

---

## ⚡ Workflows & Perintah Slash Kustom
Projek ini memiliki definisi alur kerja (*Workflow SOP*) otomatis di dalam folder `.agents/workflows/`:
* **`/hero` (`.agents/workflows/hero.md`)**: SOP spesifikasi arsitektur untuk membangun modular Gutenberg Hero Block (1/2 Column, Eyebrow, Heading, Button Group, Inspector Controls terpisah, komponen reusable di `edit.jsx`).
* Saat pengembangan block dimulai, cukup panggil perintah `/hero` untuk memicu eksekusi standar tersebut.

---

## 🎯 Panduan Melanjutkan Kerja di Sesi Baru
1. Anda dapat menjalankan perintah **`npm run all:zip`** (baik dari direktori `gravisain` maupun `gravisain-blocks`) untuk membangun dan memaketkan seluruh arsip rilis sekaligus (`gravisain.zip`, `gravisain-starter-sites.zip`, dan `gravisain-blocks.zip`).
2. Jangan pernah meletakkan business logic di `functions.php`.
3. Selalu konsultasikan perubahan arsitektur sebelum menulis kode baru.
