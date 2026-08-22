# Gravisain Theme Architecture & Documentation

Dokumen ini memuat panduan arsitektur, standar pemrograman, dan rincian teknis dari **Gravisain**, sebuah tema WordPress Premium bergaya *Hybrid* (seperti Kadence, Astra, atau GeneratePress) yang berfokus pada kecepatan, performa (*Core Web Vitals*), dan skalabilitas berbasis *Object-Oriented Programming* (OOP).

---

## 1. Filosofi & Pendekatan Inti

* **Hybrid Theme:** Tata letak utama (Header, Footer, Global Layout) 100% dikendalikan oleh PHP dan Customizer, bukan menggunakan *Full Site Editing* (FSE) murni. Ini menjamin kestabilan desain kelas *enterprise*.
* **OOP & SOLID Principles:** Seluruh logika *backend* PHP ditulis menggunakan paradigma OOP. Tidak ada *spaghetti code* atau logika bisnis di dalam `functions.php`.
* **Performa Ekstrem:** Aset dikelola menggunakan **Vite**, mendukung *tree-shaking*, minifikasi, dan *conditional loading*. CSS dinamis hanya di-*generate* jika diperlukan.

---

## 2. Struktur Direktori Utama

Gravisain menggunakan pemisahan yang sangat tegas antara kode sumber (*source*) dan hasil kompilasi produksi (*dist/assets*).

```text
gravisain/
├── assets/                  # [AUTO-GENERATED] File production hasil build Vite (CSS, JS, font, dll).
├── src/                     # Source code frontend mentah.
│   ├── css/                 # File .css mentah (PostCSS).
│   ├── js/                  # File .js (ES Modules) dan React JSX untuk Customizer.
│   └── meta/                # Aset editor/Gutenberg metadata.
├── classes/                 # Jantung logika backend (PHP OOP).
├── template-parts/          # Komponen tampilan UI reusable (Header, Footer, dll).
├── templates/               # Hierarki Template WordPress (page.php, single.php).
├── release/                 # [AUTO-GENERATED] File ZIP tema siap produksi.
├── docs/                    # Dokumentasi proyek.
├── functions.php            # Hanya bertugas sebagai file bootstrap/pemicu awal.
├── vite.config.js           # Konfigurasi bundler Vite.
└── package.json             # Dependensi Node.js dan NPM Scripts.
```

---

## 3. Komponen Backend Inti (`classes/Core/`)

Seluruh sistem diinisialisasi melalui Namespace `Gravisain\Core`.

### `Bootstrap.php`
Titik awal berjalannya tema. File ini dipanggil oleh `functions.php` dan bertugas mendaftarkan *autoloader* Composer, memeriksa versi PHP, lalu memicu class `Application.php`.

### `Application.php`
Bertindak sebagai *Service Container*. Kelas ini mendaftarkan modul-modul tema (seperti *Customizer*, *Assets*, *CSS Generator*) dan menjalankannya melalui metode `register_services()`. Jika Anda ingin menambahkan fitur besar baru (misal: Integrasi WooCommerce), Anda akan mendaftarkannya di sini.

### `Hooks.php`
Manajer terpusat untuk fungsi `add_action()` dan `add_filter()`. Alih-alih menyebarkan *hooks* di mana-mana, setiap kelas yang membutuhkan *hook* harus mengimplementasikan interface `Hookable` dan mendaftarkan *hook*-nya melalui manajer ini.

### `Assets.php`
Menangani pemuatan (*enqueue*) CSS dan JS.
**Fitur Unggulan:** 
* Terintegrasi langsung dengan `manifest.json` dari Vite.
* Menggunakan fitur **Automatic Cache-Busting** (`filemtime`) di mana versi file otomatis berubah (contoh: `?ver=1.0.0.1784351690`) setiap kali ZIP baru dikompilasi, menjamin CDN Cloudflare atau LiteSpeed Cache otomatis tergantikan.

---

## 4. Arsitektur WordPress Customizer (`classes/Customizer/`)

Gravisain memiliki API Customizer kustom yang ditenagai oleh React di frontend dan OOP di backend.

* **Pengaturan Berbasis Objek:** Panel, Section, dan Setting didaftarkan secara elegan menggunakan instance OOP alih-alih array prosedural tradisional.
* **React Customizer Controls (`src/js/customizer-react.jsx`):** Kita tidak menggunakan antarmuka bawaan WordPress yang kaku, melainkan membangun kontrol khusus berbasis React (seperti *Color Palette Picker*, *Typography Control*, *Toggle Switches*) yang cepat dan dinamis.
* **Live Preview:** Didukung oleh postMessage API dan React, perubahan warna atau margin di Customizer langsung merender ulang halaman pratinjau (*iframe*) tanpa perlu memuat ulang (*refresh*) halaman.

---

## 5. Generator CSS Dinamis (`classes/CSS/`)

Ketimbang menaruh aturan CSS dinamis di dalam tag `<style>` di HTML yang memberatkan halaman, Gravisain mengumpulkan nilai dari Customizer dan mengubahnya menjadi CSS menggunakan `Builder.php`.

### Proteksi Kebocoran Selektor (*Strict CSS Scoping*)
Generator ini mematuhi aturan ketat anti-bocor:
* **TIDAK ADA selektor telanjang:** Kelas generik seperti `.site-title` tidak boleh ditulis bebas. Selalu gunakan penanda kontainer utama seperti `#masthead .site-title`.
* Ini menjamin bahwa aturan margin atau warna dari Customizer tidak akan pernah *"menyerang"* dan merusak struktur panel admin WordPress Customizer di sidebar.

---

## 6. Protokol Frontend & Styling (`src/css/`)

File CSS di Gravisain dibagi berdasarkan peruntukannya:
* `style.css` (Utama) -> Untuk elemen dasar *frontend*.
* `customizer-controls.css` -> Khusus mengatur antarmuka **admin panel** Customizer di sidebar kiri. 

**Aturan Emas Customizer Controls (`AGENTS.md`):**
Dilarang memaksakan override struktural (`height`, `min-height`, `overflow-y`, `display: flex`) pada elemen inti WordPress Core (`#customize-info`, `.customize-panel-description`). Memaksakan layout pada kontainer bawaan akan merusak transisi akordeon, menyembunyikan tombol "Back" (`<`), dan menciptakan artefak abu-abu kosong.

---

## 7. Alur Kerja (Workflow) Developer

Pengembangan Gravisain sangat bergantung pada NodeJS & Vite.

### Perintah Utama (NPM Scripts)

* **`npm run dev`**
  Menjalankan Vite *Dev Server*. Menggunakan HMR (*Hot Module Replacement*) untuk menyuntikkan CSS/JS secara instan ke browser saat Anda menyimpan file tanpa *reload*.
  *Catatan: Selalu gunakan mode ini hanya untuk tahap pembuatan kode, bukan untuk verifikasi akhir.*

* **`npm run build`**
  Mengompilasi aset (*Tree-shaking*, Minify, CSS Autoprefixer) ke dalam folder `assets/` dan menghasilkan `manifest.json`.
  *Catatan: Ini adalah standar wajib verifikasi lokal sebelum merilis fitur.*

* **`npm run theme:zip`**
  Membuat salinan produksi (*Production Build*), membuang file mentah seperti `src/` atau `node_modules`, dan mengemasnya secara otomatis menjadi file `release/gravisain.zip` yang siap diunggah ke *hosting*.

---

*Dokumen ini dibuat dan dikelola secara otomatis sesuai dengan arsitektur Gravisain yang berlaku.*
