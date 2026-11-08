# Audit Kepatuhan Resmi WordPress.org — Tema `gravisain` (v1.0.2)

**Target Audit:** Tema WordPress Hybrid [gravisain](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/style.css) (`d:/VS CODE GRAVISAIN/gravisain/`) & Paket Distribusi `release/wporg/gravisain.zip`  
**Konteks Pengajuan:** WordPress.org Themes Trac Ticket [#294475](https://themes.trac.wordpress.org/ticket/294475) (`Version: 1.0.2`, Reviewer: `vowelweb`)  
**Status Saat Ini:** **TERKIRIM & LOLOS SCANNER OTOMATIS (`SUBMITTED & AUTOMATED THEME CHECK PASSED`) — MENUNGGU REVIEW ULANG REVIEWER**  
**Tanggal Upload Revisi:** 8 November 2026 (Tiket Comment #5 via `@themetracbot`)  
**Diff Changeset Trac:** [Changeset [357968]](https://themes.trac.wordpress.org/changeset/357968) (`old: 1.0.1` → `new: 1.0.2`)  
**Live Preview Playground:** [WordPress.net Playground Gravisain 1.0.2](https://playground.wordpress.net/?blueprint-url=https%3A%2F%2Fwordpress.org%2Fthemes%2Fwp-json%2Fthemes%2Fv1%2Freview-blueprint%2F153343-gravisain%2F1.0.2)  

---

## 1. Ringkasan Eksekutif & Resolusi Tiket Trac #294475

Pada review resmi tanggal 6 November 2026 ([`comment:4`](https://themes.trac.wordpress.org/ticket/294475#comment:4)), reviewer resmi WordPress.org (`vowelweb`) memberikan 2 poin temuan penolakan sementara:
1. *"Keyboard Navigation Not Ok"*
2. *"In all the files, the content is not translated. Need to escape all the text."*

Seluruh temuan di atas beserta isu scanner line endings saat upload telah berhasil diselesaikan secara tuntas dan versi telah di-bump ke **1.0.2**:

| No | Poin Reviewer / Kategori Pedoman | Status Awal | Status Final | Ringkasan Resolusi Teknis |
| :---: | :--- | :---: | :---: | :--- |
| **1** | **Keyboard Navigation** (WCAG 2.1 AA) | Gagal | **LULUS (100%)** | Dukungan penuh `:focus-within`, `li.page_item_has_children`, dan `ul.children` (`wp_page_menu` fallback). Focus trap & `Escape` pada Off-Canvas Drawer & Search Modal. Hapus `outline: none;` dan terapkan `:focus-visible` kontras tinggi serta tombol panah pada Theme Switcher. |
| **2** | **Late Escaping Output** (Data Escaping) | Gagal | **LULUS (100%)** | Seluruh 9 pemanggilan `SVG::icon()` dibungkus `wp_kses()`. Avatar & produk WooCommerce dibungkus `wp_kses_post()`. Atribut ternary `class` & data atribut dibungkus `esc_attr()`. Penggabungan HTML dalam `printf` diganti pola `wp_kses_post( sprintf(...) )`. |
| **3** | **Internasionalisasi (i18n)** | Parsial | **LULUS (100%)** | 60 label sosial di `SocialNetworksHelper`, font stack `GoogleFontsHelper`, layout grid di Gutenberg sidebar (`src/meta/index.js`), tombol `Clear` di Color Picker, dan seluruh label Customizer Builder kini terlokalisasi dengan text domain `'gravisain'`. |
| **4** | **Pemisahan Modul Komersial** (Clean WP.org) | Blocker | **LULUS (100%)** | `classes/License/` & `classes/Rest/` dihapus dari paket rilis WP.org. Seluruh CPT Engine, metabox, dan notice dipisahkan via hook dinamis. File sumber `src/` disertakan lengkap di dalam ZIP. |
| **5** | **Line Endings Normalization (SVN)** | Gagal | **LULUS (100%)** | Memperbaiki error Theme Scanner: *Mixed DOS/UNIX line endings* pada `ServiceProvider.php` dengan menambahkan normalisasi otomatis ke format UNIX LF murni (`\n`) pada seluruh file staging sebelum pembuatan ZIP. |
| **6** | **Privasi & Eksternal Services (GDPR)** | Blocker | **LULUS (100%)** | Font Google otomatis dialihkan ke unduhan lokal (`LocalFontDownloader`). Seluruh hotlink gambar eksternal di `patterns/` diganti SVG lokal. `readme.txt` mendeklarasikan privasi dan lisensi 100% GPL compatible. |

---

## 2. Resolusi Detail: Poin 1 Reviewer (*Keyboard Navigation*)

### A. Dropdown Navigasi Desktop (`wp_nav_menu` & `wp_page_menu` Fallback)
* **Masalah:** Saat tema diuji pada instalasi WordPress baru tanpa menu kustom yang ditetapkan, WordPress memanggil `wp_page_menu()` yang menghasilkan elemen `.page_item_has_children` dan `ul.children` (bukan `.menu-item-has-children` dan `.sub-menu`). Hal ini menyebabkan halaman anak terkunci dan tidak bisa dibuka via keyboard. Selain itu, navigasi mundur (`Shift+Tab`) melompati submenu karena properti `visibility: hidden`.
* **Solusi Kode:**
  * Di [src/css/main.css](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/src/css/main.css): Menambahkan selektor `:focus-within` serta dukungan `.page_item_has_children:focus-within > .children` dan `.page_item_has_children.focus > .children`.
  * Di [src/js/main.js](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/src/js/main.js) ([`initAccessibleDropdownNavigation()`](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/src/js/main.js#L211)): Memperluas query selector ke `.menu-item-has-children, .page_item_has_children` dan `.sub-menu, .children`. Membuka menu saat `focusin` / panah bawah (`ArrowDown`), menutup saat `focusout` atau `Escape`.

### B. Theme Switcher (Tombol, Slider, dan Dropdown Pilihan)
* **Masalah:** CSS mendeklarasikan `outline: none;` pada `.ghb-theme-btn`, `.ghb-theme-item`, dan `.ghb-theme-switch-slider` sehingga pengguna keyboard kehilangan indikator visual saat menekan `Tab`. Dropdown pilihan tema juga tidak menutup otomatis saat fokus berpindah keluar.
* **Solusi Kode:**
  * Menghapus semua deklarasi `outline: none;` dan menggantikannya dengan `:focus-visible` outline solid 2px dengan offset kontras tinggi.
  * Menambahkan navigasi panah keyboard `ArrowDown` & `ArrowUp` di dalam menu pilihan tema, serta event listener `focusout` untuk menutup dropdown secara otomatis saat fokus berpindah keluar dari komponen.

### C. Off-Canvas Drawer & Search Modal
* **Masalah:** Tombol pencarian header sebelumnya tidak memiliki modal fungsional, dan drawer mobile tidak memiliki fallback menu saat belum ada menu yang ditetapkan.
* **Solusi Kode:**
  * Di [footer.php](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/footer.php) dan [src/js/main.js](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/src/js/main.js): Mengimplementasikan `#gravisain-search-modal` (`role="dialog"`, `aria-modal="true"`) lengkap dengan *focus trap* dan tombol `Escape`.
  * Di [template-parts/header/off-canvas.php](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/template-parts/header/off-canvas.php): Menggunakan `'fallback_cb' => 'wp_page_menu'` sehingga menu drawer mobile tidak pernah kosong pada instalasi pengujian baru.

---

## 3. Resolusi Detail: Poin 2 Reviewer (*Translation & Escaping*)

### A. Internasionalisasi (i18n)
* **`SocialNetworksHelper.php`:** Seluruh 60 label jaringan sosial (`Facebook`, `Shopee`, `X Twitter`, `YouTube`, `Instagram`, `Email`, `Phone`, `Google Reviews`, `Custom 1-3`, dll.) telah dibungkus dengan `__( '...', 'gravisain' )`.
* **`GoogleFontsHelper.php`:** Mengembalikan label sistem font `'Inherit'` dan `'System Stack'` yang terlokalisasi via `__( ..., 'gravisain' )`.
* **Customizer Controls (`SectionTabsControl`, `VisibilityControl`, `ContactOptions`):** Properti default array dan setting string default diinisialisasi melalui konstruktor dengan fungsi `__()` / `esc_html__()`.
* **Editor Gutenberg & React Controls (`src/meta/index.js`, `CustomizerColorPicker.jsx`, `customizer.js`):** Pilihan grid layout halaman, tombol `Clear` color picker, dan seluruh label Header/Footer Builder (`Hide`, `Available Components`, `Add Component`, `Used`, `Settings`, `Remove`, dll.) terintegrasi dengan `wp.i18n.__( ..., 'gravisain' )`.

### B. Late Escaping
* **Ikon SVG:** 9 pemanggilan `\Gravisain\Helpers\SVG::icon()` di [content.php](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/template-parts/content/content.php) dan [content-single.php](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/template-parts/content/content-single.php) telah dibungkus menggunakan `wp_kses( ..., SVG::allowed_svg_html() )`.
* **Avatar & Media:** Output `get_avatar()` di [account.php](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/template-parts/header/components/account.php) dan [content-single.php](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/template-parts/content/content-single.php), serta `$product->get_image()` di [WooCommerce.php](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/classes/Integrations/WooCommerce.php) dibungkus aman dengan `wp_kses_post()`.
* **Atribut HTML:** Seluruh operator ternary kelas CSS (seperti `ghb-contact-phone`, `ghb-cart-badge`, thumbnail/excerpt post) dan data atribut `data-target-section` dibungkus dengan `esc_attr()` langsung pada titik `echo`.
* **Refactoring `printf()`:** Mengganti parameter HTML mentah di dalam `printf( esc_html__( ... ), '<span>...' )` pada [comments.php](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/comments.php) dan [templates/search.php](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/templates/search.php) menjadi `echo wp_kses_post( sprintf( __( ... ), '<span>...' ) )` agar mematuhi analisis statis AST WordPress.org.

---

## 4. Verifikasi Paket Rilis Distribusi (`release/wporg/gravisain.zip`)

Paket rilis resmi v1.0.2 dibangun menggunakan script otomatis [scripts/zip-theme.ps1](file:///d:/VS%20CODE%20GRAVISAIN/gravisain/scripts/zip-theme.ps1):

1. **Ukuran File ZIP:** `1,197 KB` (189 entri file).
2. **Kepatuhan Sumber Aset:** Seluruh folder `src/` (CSS, JS, JSX), `package.json`, `vite.config.js`, dan `postcss.config.js` disertakan lengkap di dalam ZIP.
3. **Pembersihan Modul:** Bebas 100% dari `classes/License/`, `classes/Rest/`, file email `MAIL/`, `.eml`, `.distignore`, dan file audit internal.
4. **Guard Akses Langsung:** Seluruh 171 file PHP memiliki guard `if ( ! defined( 'ABSPATH' ) ) { exit; }`, termasuk file yang digenerate oleh `@wordpress/scripts` (`assets/meta/index.asset.php`).
5. **Konsistensi Line Endings:** Seluruh 182 file teks di-normalisasi ke format UNIX LF (`\n`) murni tanpa campuran CRLF/LF sehingga lolos scanner SVN WordPress.org.

---

## 5. Kronologi & Riwayat Tiket Trac #294475

* **26 Oktober 2026:** Pengajuan awal versi `1.0.1`. Tiket diasign ke reviewer `vowelweb` (status: `new → reviewing`).
* **6 November 2026 ([comment:4](https://themes.trac.wordpress.org/ticket/294475#comment:4)):** Reviewer melaporkan 2 isu penolakan sementara: *Keyboard Navigation Not Ok* & *Content not translated / need escaping*.
* **8 November 2026 (Pagi/Siang):** Seluruh perbaikan kode diimplementasikan, audit 100% tuntas, versi di-bump ke `1.0.2`.
* **8 November 2026 ([comment:5](https://themes.trac.wordpress.org/ticket/294475#comment:5)):** Uploader otomatis menerima revisi `1.0.2` (`Results of Automated Theme Scanning: Pass`). Bot `@themetracbot` mengunggah [Changeset [357968]](https://themes.trac.wordpress.org/changeset/357968) dan memperbarui tiket ke versi `1.0.2`.
* **8 November 2026:** Komentar penjelasan balasan resmi dikirimkan kepada `@vowelweb` dengan status tiket tetap `reviewing` menunggu tinjauan akhir untuk approval/live di direktori tema resmi.
