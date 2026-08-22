# Panduan Pengguna Tema Gravisain
## Cara Menggunakan Customizer Gravisain Options

Selamat datang di **Tema Premium Gravisain**! Dokumen ini adalah panduan lengkap penggunaan untuk semua pengaturan yang tersedia di dalam **Appearance → Customize → Gravisain Options**.

> **Cara Membuka Customizer:**
> Masuk ke Dashboard WordPress Anda → klik menu **Appearance** di sidebar kiri → klik **Customize**. Anda akan langsung masuk ke tampilan editor visual.

---

## Struktur Panel Gravisain Options

Di dalam Customizer, seluruh pengaturan tema Gravisain berada dalam panel **"Gravisain Options"** yang terbagi menjadi beberapa section:

| # | Nama Section | Fungsi Utama |
|---|---|---|
| 1 | **General Settings & UX** | Komponen interaktif global (tombol, progress bar) |
| 2 | **Global Colors** | Palet warna seluruh website |
| 3 | **Performance & Compliance** | Kecepatan dan kepatuhan GDPR |
| 4 | **Global Typography** | Font dan tipografi seluruh teks |
| 5 | **Container & Layouts** | Lebar dan tata letak kontainer konten |
| 6 | **Blog / Archive** | Tampilan halaman daftar artikel |
| 7 | **Single Post** | Tampilan halaman artikel tunggal |

---

## 1. General Settings & UX

Section ini mengatur komponen interaktif yang ditampilkan kepada pengunjung website Anda secara global.

---

### 🔘 Enable Scroll to Top Button

**Fungsi:** Mengaktifkan tombol mengambang (floating button) di sudut layar yang memungkinkan pengunjung untuk melompat kembali ke bagian atas halaman dengan satu klik. Tombol ini dilengkapi dengan cincin animasi yang menampilkan progress scroll pengunjung secara visual.

**Cara Menggunakan:**
1. Beri centang (✓) pada opsi **"Enable Scroll to Top Button"** untuk mengaktifkan.
2. Tombol akan muncul di website setelah pengunjung mulai scroll ke bawah halaman.

> **Nilai Default:** Aktif (dicentang)

---

#### ↔️ Scroll to Top Position

**Fungsi:** Menentukan posisi tombol muncul di sisi kiri atau kanan layar.

| Pilihan | Keterangan |
|---|---|
| **Left** | Tombol muncul di sudut kiri bawah layar |
| **Right** | Tombol muncul di sudut kanan bawah layar |

> **Nilai Default:** Right (Kanan)
> **Catatan:** Opsi ini hanya muncul jika "Enable Scroll to Top Button" aktif.

---

#### 📐 Scroll to Top Icon Size

**Fungsi:** Mengatur ukuran (besar/kecil) dari ikon dan lingkaran tombol scroll-to-top. Pengaturan ini bersifat **responsif**, artinya Anda bisa mengatur ukuran yang berbeda untuk Desktop, Tablet, dan Mobile secara terpisah.

**Cara Menggunakan:**
1. Pilih unit satuan yang diinginkan: **px**, **em**, atau **rem**.
2. Geser slider atau ketik nilai angka yang diinginkan.
3. Klik ikon **Desktop / Tablet / Mobile** untuk beralih dan mengatur ukuran masing-masing perangkat.
4. Klik tombol **Reset** untuk mengembalikan ke nilai bawaan.

| Perangkat | Unit | Min | Max | Default |
|---|---|---|---|---|
| Desktop | px | 10 | 50 | 18px |
| Tablet | px | 10 | 50 | 16px |
| Mobile | px | 10 | 50 | 16px |

> **Catatan:** Opsi ini hanya muncul jika "Enable Scroll to Top Button" aktif.

---

#### ↕️ Scroll to Top Side Offset

**Fungsi:** Mengatur jarak antara tombol scroll-to-top dengan tepi kiri atau kanan layar (tergantung posisi yang dipilih). Semakin besar nilainya, semakin jauh tombol dari tepi layar.

| Perangkat | Default |
|---|---|
| Desktop | 2rem |
| Tablet | 1.5rem |
| Mobile | 1rem |

---

#### ⬆️ Scroll to Top Bottom Offset

**Fungsi:** Mengatur jarak antara tombol scroll-to-top dengan tepi bawah layar. Berguna jika website Anda memiliki footer bar atau elemen lain di bagian paling bawah layar agar tombol tidak tertimpa.

| Perangkat | Default |
|---|---|
| Desktop | 2rem |
| Tablet | 1.5rem |
| Mobile | 1rem |

---

### 📊 Enable Reading Progress Bar on Single Posts

**Fungsi:** Menampilkan bilah kemajuan membaca (*reading progress bar*) bergradasi warna di bagian paling atas halaman. Bilah ini menunjukkan seberapa jauh pengunjung sudah membaca artikel, dan secara otomatis hanya tampil pada halaman artikel tunggal (*Single Post*).

**Cara Menggunakan:**
1. Beri centang (✓) pada opsi ini untuk mengaktifkan.
2. Bilah kemajuan baca akan langsung muncul di bagian atas browser saat membaca sebuah artikel.

> **Nilai Default:** Aktif (dicentang)

---

## 2. Global Colors

Section ini adalah pusat kendali warna seluruh website. Setiap warna yang dipilih di sini secara otomatis diterapkan ke seluruh elemen seperti tombol, link, judul, latar belakang, dan lain-lain.

---

### 🎨 Global Palette

**Fungsi:** Memilih atau menyesuaikan 8 warna utama (palet global) yang digunakan di seluruh tema. Anda bisa memilih dari preset yang sudah tersedia atau mengkustomisasi setiap warna satu per satu.

**8 Slot Warna Global:**

| Slot | Nama | Fungsi |
|---|---|---|
| 1 | **Primary** | Warna utama tema (tombol, link aktif, aksen utama) |
| 2 | **Secondary** | Warna pendukung (hover, gradasi, elemen kedua) |
| 3 | **Contrast (Text)** | Warna teks utama (judul, paragraf gelap) |
| 4 | **Contrast Alt (Muted)** | Warna teks lebih redup (meta info, keterangan) |
| 5 | **Base (Background)** | Warna latar belakang konten utama |
| 6 | **Base Alt (Surface)** | Warna latar belakang permukaan/card/surface |
| 7 | **Border** | Warna garis batas dan separator |
| 8 | **Accent** | Warna aksen/highlight (notifikasi, badge, tag) |

**Preset Palet yang Tersedia:**
* **Default** — Biru/Ungu modern dengan latar putih bersih
* **Dark Mode** — Warna cerah di atas latar gelap navy
* **Earth** — Palet hangat amber, hijau, dan cokelat
* **Ocean** — Palet dingin biru langit dan teal

---

### 🖼️ Site Background

**Fungsi:** Mengatur warna latar belakang utama website (area di luar konten).

> **Catatan:** Biarkan kosong untuk menggunakan warna **Base Alt** dari Global Palette secara otomatis.

---

### 📄 Content Background

**Fungsi:** Mengatur warna latar belakang area konten (di dalam kontainer artikel/halaman).

> **Catatan:** Biarkan kosong untuk menggunakan warna **Base** dari Global Palette secara otomatis.

---

## 3. Performance & Compliance

Section ini mengatur optimasi kecepatan website dan kepatuhan terhadap regulasi privasi data (GDPR).

---

### ⚡ Load Google Fonts Locally (GDPR Compliant)

**Fungsi:** Mengunduh font Google Fonts (yang Anda pilih di Typography) secara otomatis ke server hosting Anda sendiri, sehingga browser pengunjung tidak perlu lagi terhubung ke server Google untuk mengambil font.

**Manfaat:**
* ✅ **Lebih Cepat:** Menghilangkan *third-party request* ke server Google yang bisa memperlambat First Contentful Paint.
* ✅ **GDPR Compliant:** Tidak ada data pengunjung (IP address) yang dikirim ke pihak ketiga (Google).
* ✅ **Aman:** Font tetap tersedia meski Google Fonts mengalami gangguan.

> **Nilai Default:** Aktif (dicentang)

---

### 💾 Enable Dynamic CSS File Caching

**Fungsi:** Menyimpan CSS yang di-generate secara dinamis dari pengaturan Customizer ke dalam sebuah file CSS statis (`gravisain-dynamic.css`) di server. Dengan cara ini, browser pengunjung bisa menyimpan (*cache*) file tersebut sehingga tidak perlu di-generate ulang di setiap kunjungan halaman.

**Manfaat:**
* ✅ **Lebih Cepat:** Mengurangi waktu proses PHP di setiap halaman yang diakses.
* ✅ **PageSpeed Lebih Tinggi:** Berpengaruh positif pada skor Google PageSpeed Insights.

> **Nilai Default:** Aktif (dicentang)

---

## 4. Global Typography

Section ini mengatur font dan tipografi yang digunakan di seluruh teks website. Setiap elemen teks memiliki pengaturan tersendiri.

---

**Cara Menggunakan Typography Control:**
1. Klik pada kontrol tipografi yang diinginkan (misalnya: *Base Font*).
2. Gunakan kolom **pencarian font** untuk mencari nama font dari Google Fonts atau pilih dari daftar.
3. Pilih **style/ketebalan** font (misalnya: 400 Regular, 700 Bold).
4. Atur **ukuran font** menggunakan slider.
5. Atur **jarak antar huruf** (*letter-spacing*).
6. Lihat pratinjau teks langsung di bawah kontrol.

---

| Setting | Fungsi | Default |
|---|---|---|
| **Base Font** | Font untuk paragraf dan teks isi artikel | Inter, 400, 16px |
| **Heading 1 (H1)** | Font untuk judul utama halaman | Inter, 700, 40px |
| **Heading 2 (H2)** | Font untuk judul sub-bab utama | Inter, 700, 32px |
| **Heading 3 (H3)** | Font untuk judul sub-bab kedua | Inter, 700, 28px |
| **Heading 4 (H4)** | Font untuk judul level 4 | Inter, 600, 24px |
| **Heading 5 (H5)** | Font untuk judul level 5 | Inter, 600, 20px |
| **Heading 6 (H6)** | Font untuk judul level 6 (terkecil) | Inter, 600, 16px |

---

## 5. Container & Layouts

Section ini mengatur lebar dan tata letak kotak konten (kontainer) secara global.

---

### 📏 Container Max Width

**Fungsi:** Mengatur lebar maksimum kontainer konten utama website.

| Unit | Min | Max | Default |
|---|---|---|---|
| **px** | 800px | 2000px | 1200px |
| **rem** | 50rem | 130rem | — |
| **%** | 50% | 100% | — |

> **Tips:** Untuk layar lebar modern, nilai **1280px – 1440px** memberikan tampilan yang sangat nyaman dibaca.

---

### ↕️ Content Top & Bottom Spacing

**Fungsi:** Mengatur ruang kosong (padding) di atas dan bawah area konten utama. Bersifat responsif per perangkat.

| Perangkat | Default |
|---|---|
| Desktop | 56px |
| Tablet | 40px |
| Mobile | 32px |

---

### ↔️ Content Left/Right Edge Spacing

**Fungsi:** Mengatur ruang kosong (padding) di sisi kiri dan kanan kontainer konten. Berguna untuk memastikan teks tidak menempel di tepi layar pada perangkat mobile.

| Perangkat | Default |
|---|---|
| Desktop | 24px |
| Tablet | 20px |
| Mobile | 16px |

---

### 🗃️ Default Container Style

**Fungsi:** Menentukan gaya tampilan kotak kontainer konten yang akan diterapkan secara global ke seluruh halaman website.

| Pilihan | Tampilan |
|---|---|
| **Full Width / Unboxed (Flat)** | Konten menyatu dengan latar belakang. Tampilan bersih dan modern. **(Default)** |
| **Full Width / Stretched (100% Screen Width)** | Konten memenuhi 100% lebar layar tanpa batasan. Ideal untuk desain bold/magazine. |
| **Contained / Boxed (Single Box)** | Seluruh konten berada di dalam kotak tengah dengan latar berbeda. Gaya blog klasik. |
| **Contained Separated (Separate Cards)** | Setiap elemen konten (artikel, sidebar) tampil sebagai kartu terpisah dengan shadow. |

---

### 📰 Blog / Archive Container Style

**Fungsi:** Mengganti gaya kontainer khusus untuk halaman daftar artikel (Blog Index, Kategori, Tag, Arsip tanggal).

> Pilih **"Inherit Default Style"** agar mengikuti pengaturan **Default Container Style** di atas.

---

### 📝 Single Post Container Style

**Fungsi:** Mengganti gaya kontainer khusus untuk halaman artikel tunggal dan halaman statis (Page).

> Pilih **"Inherit Default Style"** agar mengikuti pengaturan **Default Container Style** di atas.

---

## Tips Umum

* **Tombol Publish:** Setiap perubahan di Customizer bersifat sementara dan hanya tersimpan di memori browser. Klik tombol **"Publish"** di bagian atas untuk menyimpan perubahan secara permanen ke website.
* **Tombol Reset:** Pada setiap kontrol slider, tersedia tombol reset (↺) untuk mengembalikan nilainya ke pengaturan bawaan tema.
* **Live Preview:** Perubahan pada sebagian besar pengaturan akan langsung terlihat di panel pratinjau sebelah kanan tanpa perlu menekan tombol apapun.
* **Responsif:** Pengaturan yang memiliki ikon 🖥️ (Desktop), 📱 (Tablet), dan 📱 (Mobile) dapat diatur berbeda untuk setiap jenis perangkat.

---

## 6. Blog / Archive

Section ini mengatur tampilan halaman daftar artikel (Blog Index, Kategori, Tag, Arsip bulan/tahun, dan halaman Pencarian).

---

### 🗂️ Post Archive Layout

**Fungsi:** Menentukan gaya tampilan kartu artikel di halaman daftar artikel.

| Pilihan | Tampilan |
|---|---|
| **Grid Cards** | Artikel ditampilkan dalam susunan kartu kotak berjajar (seperti Pinterest). **(Default)** |
| **List / Row Cards** | Artikel ditampilkan vertikal memanjang dengan gambar di kiri dan teks di kanan. |
| **Standard Large Image** | Gambar unggulan tampil penuh lebar di atas, cocok untuk blog gaya majalah. |

---

### 🔢 Grid Columns

**Fungsi:** Mengatur jumlah kolom kartu artikel dalam tampilan Grid.

| Pilihan | Default |
|---|---|
| 2 Kolom | — |
| 3 Kolom | ✓ (Default) |

---

### 📌 Sidebar Position (Archive)

**Fungsi:** Menentukan posisi sidebar pada halaman daftar artikel.

| Pilihan | Keterangan |
|---|---|
| **Right Sidebar** | Sidebar di kanan konten. **(Default)** |
| **Left Sidebar** | Sidebar di kiri konten. |
| **No Sidebar (Full Width)** | Tanpa sidebar, konten memenuhi seluruh lebar kontainer. |

---

### ✂️ Excerpt Length (words)

**Fungsi:** Mengatur berapa banyak kata yang ditampilkan sebagai ringkasan artikel di halaman daftar. Misalnya nilai `25` akan memotong teks setelah 25 kata pertama.

> **Default:** 25 kata | **Min:** 5 | **Max:** 100

---

### 🔗 Read More Button Text

**Fungsi:** Mengubah teks label tombol "Baca Selengkapnya" yang muncul di setiap kartu artikel.

> **Default:** `Read More →`

---

## 7. Single Post

Section ini mengatur tampilan dan fitur yang ditampilkan di dalam halaman artikel tunggal.

---

### 📌 Sidebar Position (Single Post)

**Fungsi:** Menentukan posisi sidebar pada halaman artikel tunggal.

| Pilihan | Keterangan |
|---|---|
| **Right Sidebar** | Sidebar di kanan konten. **(Default)** |
| **Left Sidebar** | Sidebar di kiri konten. |
| **No Sidebar (Narrow Focused Width)** | Tanpa sidebar. Lebar konten dipersempit agar lebih nyaman dibaca (reading mode). |

---

### 👤 Show Author Bio Box

**Fungsi:** Menampilkan kotak profil penulis artikel (foto, nama, bio singkat) di bagian bawah setiap artikel.

> **Default:** Aktif (dicentang)

---

### ⬅️ ➡️ Show Previous / Next Post Navigation

**Fungsi:** Menampilkan tautan navigasi artikel sebelumnya dan berikutnya di bagian paling bawah artikel.

> **Default:** Aktif (dicentang)

---

### 🔗 Show Native Social Share Buttons (Zero Tracking)

**Fungsi:** Menampilkan tombol berbagi sosial media (Facebook, Twitter/X, WhatsApp, dll.) di dalam artikel. Fitur ini menggunakan metode *native share* sehingga **tidak ada script pelacak pihak ketiga** yang dimuat.

> **Default:** Aktif (dicentang)

---

### 📰 Show Related Posts Grid

**Fungsi:** Menampilkan grid artikel terkait di bagian paling bawah artikel (berdasarkan kategori atau tag yang sama).

> **Default:** Aktif (dicentang)

---

### 🔢 Number of Related Posts

**Fungsi:** Mengatur berapa banyak artikel terkait yang ditampilkan.

| Pilihan | Keterangan |
|---|---|
| **3 Posts (1 Row)** | 1 baris berisi 3 artikel terkait. **(Default)** |
| **6 Posts (2 Rows)** | 2 baris masing-masing 3 artikel. |

---

## 8. Header

Panel **Header** adalah area pembuatan (*builder*) tata letak header website Anda. Header Gravisain menggunakan sistem **3 Baris (Row)** yang masing-masing bisa dikonfigurasi secara independen.

### Struktur Header Builder

```
┌─────────────────────────────────────────┐
│           TOP ROW (Baris Atas)           │  ← Opsional (biasanya untuk topbar info)
├─────────────────────────────────────────┤
│          MAIN ROW (Baris Utama)          │  ← Logo + Menu Navigasi Utama
├─────────────────────────────────────────┤
│        BOTTOM ROW (Baris Bawah)          │  ← Opsional (navigasi sekunder, pencarian)
└─────────────────────────────────────────┘
```

Setiap baris memiliki **3 area penempatan**: Kiri, Tengah, dan Kanan. Anda bisa menyeret dan meletakkan komponen header (Logo, Menu, Search, Button, Widget, dll.) ke dalam area mana pun.

---

### ⚙️ Sub-section di dalam Panel Header

| Sub-section | Isi Pengaturan |
|---|---|
| **Global Settings** | Tinggi header, warna background, border bawah, padding global |
| **Top Row** | Aktifkan/nonaktifkan baris atas; pengaturan warna, tinggi, dan padding baris atas |
| **Main Row** | Pengaturan baris utama (baris logo dan navigasi) |
| **Bottom Row** | Aktifkan/nonaktifkan baris bawah; pengaturan baris bawah |
| **Navigation & Menus** | Gaya hover menu, dropdown, mega menu, dan warna link |
| **Builder Components** | Pengaturan masing-masing komponen yang ditempatkan di header (Logo, Search Bar, dll.) |
| **Transparent Header** | Lihat section di bawah |
| **Sticky Header** | Lihat section di bawah |

---

## 9. Sticky Header (Header Mengambang)

Sticky Header adalah fitur yang membuat header tetap terlihat dan menempel di bagian atas viewport browser saat pengunjung menggulir ke bawah halaman.

---

### 📌 Sticky Header Rows

**Fungsi:** Memilih baris mana yang akan "menempel" saat pengguna scroll. Anda bisa memilih:
* **Disable** — Header tidak sticky (kembali ke perilaku normal scroll biasa).
* **Entire Header** — Seluruh header (Top Row + Main Row + Bottom Row) menempel.
* **Top Row / Main Row / Bottom Row** — Hanya baris tertentu yang menempel.

---

### 🖥️ Enable on Desktop

**Fungsi:** Mengaktifkan atau menonaktifkan fitur Sticky Header khusus untuk perangkat Desktop.
> **Default:** Aktif

### 📱 Enable on Mobile & Tablet

**Fungsi:** Mengaktifkan atau menonaktifkan fitur Sticky Header khusus untuk perangkat Mobile dan Tablet.
> **Default:** Aktif

---

### 🎭 Sticky Behavior

**Fungsi:** Menentukan *bagaimana* header berperilaku saat sticky.

| Pilihan | Keterangan |
|---|---|
| **Always Sticky When Scrolled** | Header tetap terlihat sepanjang waktu selama pengguna scroll ke bawah. **(Default)** |
| **Smart Reveal (Hide on Scroll Down, Show on Scroll Up)** | Header bersembunyi saat pengguna scroll ke bawah, dan muncul kembali saat pengguna scroll ke atas. Menghemat ruang layar. |

---

### 📐 Shrink Header on Scroll

**Fungsi:** Mengaktifkan efek animasi "penyusutan" pada header saat berada dalam mode sticky. Header akan mengecil secara halus sehingga tidak menutupi terlalu banyak ruang layar.
> **Default:** Aktif

---

### ↕️ Shrink Row Height

**Fungsi:** Mengatur tinggi spesifik baris header saat dalam kondisi susut (shrunk).
> **Default:** 54px | **Min:** 30px | **Max:** 120px

---

### 🖼️ Shrink Logo Height

**Fungsi:** Mengatur tinggi maksimum logo saat header dalam kondisi susut.
> **Default:** 40px | **Min:** 20px | **Max:** 100px

---

### 🎨 Sticky Background Color

**Fungsi:** Mengatur warna latar belakang header saat dalam mode sticky.
> **Default:** `#ffffff` (Putih)

### 🔤 Sticky Navigation Text Color

**Fungsi:** Mengatur warna teks link navigasi saat header dalam mode sticky (opsional).
> Biarkan kosong untuk menggunakan warna default.

### 🌑 Enable Subtle Drop Shadow

**Fungsi:** Menambahkan bayangan halus di bawah header saat sticky agar terlihat "mengambang" di atas konten.
> **Default:** Aktif

---

## 10. Transparent Header (Header Transparan)

Header Transparan adalah fitur yang membuat header tidak memiliki latar belakang dan "duduk" di atas konten/gambar hero yang ada di bawahnya. Sangat populer untuk halaman *landing page* dengan gambar hero penuh layar.

---

### ✅ Enable Transparent Header

**Fungsi:** Mengaktifkan mode transparent header secara global.
> **Default:** Nonaktif

---

### 🚫 Disable on Archives

**Fungsi:** Secara otomatis menonaktifkan transparent header di halaman-halaman yang tidak memiliki hero image (seperti halaman blog, kategori, tag, arsip). Ini penting karena transparent header di halaman yang tidak memiliki gambar latar akan membuat teks navigasi tidak terbaca.
> **Default:** Aktif (transparent dinonaktifkan di archive)

### 🚫 Disable on 404 & Search

**Fungsi:** Menonaktifkan transparent header di halaman 404 (tidak ditemukan) dan halaman hasil pencarian.
> **Default:** Aktif

---

### 🖼️ Transparent Logo

**Fungsi:** Mengunggah logo alternatif khusus untuk ditampilkan saat transparent header aktif. Biasanya berupa logo versi putih atau versi gelap yang kontras dengan gambar di belakangnya.
> Biarkan kosong untuk menggunakan logo utama dari **Site Identity**.

---

### 🎨 Background Overlay Color

**Fungsi:** Menambahkan lapisan warna semi-transparan di atas background page, di belakang header. Berguna untuk memastikan teks navigasi tetap terbaca jika gambar latar terlalu terang.

---

### 🔲 Bottom Border Width & Color

**Fungsi:** Menambahkan garis tipis di bagian bawah header transparan sebagai pemisah visual.

| Pilihan Width | Pilihan Color | Default |
|---|---|---|
| None (0px) / 1px / 2px / 3px | Color Picker | None (0px) / `#ffffff` |

---

### 🔤 Navigation Text Color & Hover Color

**Fungsi:** Mengatur warna teks link menu navigasi saat transparent header aktif.

| Setting | Default |
|---|---|
| Navigation Text Color | `#ffffff` (Putih) |
| Navigation Text Hover Color | `#cccccc` (Abu terang) |

---

## 11. Footer

Panel **Footer** menggunakan sistem *builder* yang serupa dengan Header, namun dengan struktur kolom yang lebih fleksibel.

### Struktur Footer Builder

```
┌─────────────────────────────────────────┐
│             TOP ROW (Widget Area)        │  ← Area widget kolom (1-4 kolom)
├─────────────────────────────────────────┤
│             MAIN ROW                     │  ← Konten utama footer
├─────────────────────────────────────────┤
│       BOTTOM ROW (Copyright Bar)         │  ← Teks copyright dan link tambahan
└─────────────────────────────────────────┘
```

Setiap baris footer memiliki **4 kolom** (`col-1` s/d `col-4`) sebagai area penempatan komponen.

---

### ⚙️ Sub-section di dalam Panel Footer

| Sub-section | Isi Pengaturan |
|---|---|
| **Scroll to Top & Interactive UX** | Pengaturan tombol Scroll to Top (sama dengan di General Settings, terpusat di sini) |
| **Top Row** | Aktifkan/nonaktifkan baris atas footer; jumlah kolom, warna, dan padding |
| **Main Row** | Pengaturan baris utama footer |
| **Bottom Row** | Pengaturan copyright bar; teks copyright kustom, warna, link sosial |
| **Builder Components** | Pengaturan komponen yang ditempatkan di footer (Widget, Copyright, Social Links, dll.) |

> **Catatan:** Pengaturan Scroll to Top yang ada di Footer Panel ini terhubung langsung ke pengaturan yang sama di **Gravisain Options > General Settings & UX**. Mengubah salah satu akan mengubah keduanya.

---

## 12. WooCommerce *(Hanya muncul jika plugin WooCommerce aktif)*

Panel ini muncul secara otomatis hanya jika plugin **WooCommerce** terdeteksi aktif di website Anda. Berisi konfigurasi khusus untuk tampilan toko online.

---

### 🛍️ Product Catalog Grid — Pengaturan Halaman Katalog Produk

#### Catalog Columns (Desktop)
**Fungsi:** Mengatur jumlah kolom produk yang ditampilkan pada halaman katalog/toko.

| Pilihan | Default |
|---|---|
| 2 Kolom | — |
| 3 Kolom | ✓ |
| 4 Kolom | — |

#### Products Per Page
**Fungsi:** Mengatur jumlah produk yang tampil per halaman sebelum ada tombol halaman berikutnya (Pagination).
> **Default:** 12 | **Min:** 4 | **Max:** 48

#### Product Card Content Alignment
**Fungsi:** Mengatur perataan teks (nama produk, harga, tombol) di dalam kartu produk.

| Pilihan | Default |
|---|---|
| Left Aligned | ✓ |
| Center Aligned | — |

#### Sale Badge Style
**Fungsi:** Mengatur gaya tampilan label diskon `SALE` pada produk yang sedang diskon.

| Pilihan | Tampilan |
|---|---|
| **Rounded Pill** | Label berbentuk kapsul bulat memanjang. **(Default)** |
| **Square Box** | Label berbentuk kotak persegi. |
| **Minimal Text** | Hanya teks kecil tanpa background. |

---

### 📦 Single Product Page — Pengaturan Halaman Produk Tunggal

#### Enable Sticky Add to Cart Bar on Scroll
**Fungsi:** Menampilkan bilah "Tambahkan ke Keranjang" yang menempel di bagian atas atau bawah layar saat pengunjung menggulir ke bawah halaman produk. Sangat efektif untuk meningkatkan *conversion rate*.
> **Default:** Aktif

---

### 🛒 Store Checkout & Conversion — Pengaturan Halaman Checkout

#### Enable Distraction-Free Checkout
**Fungsi:** Menyembunyikan Header Navigasi dan Footer website saat pengunjung berada di halaman **Checkout**. Tujuannya adalah agar pengunjung fokus menyelesaikan pembayaran tanpa tergoda klik menu lain, sehingga tingkat penyelesaian transaksi (*conversion rate*) meningkat.
> **Default:** Nonaktif

---

## Tips Umum

* **Tombol Publish:** Setiap perubahan di Customizer bersifat sementara dan hanya tersimpan di memori browser. Klik tombol **"Publish"** di bagian atas untuk menyimpan perubahan secara permanen ke website.
* **Tombol Reset:** Pada setiap kontrol slider, tersedia tombol reset (↺) untuk mengembalikan nilainya ke pengaturan bawaan tema.
* **Live Preview:** Perubahan pada sebagian besar pengaturan akan langsung terlihat di panel pratinjau sebelah kanan tanpa perlu menekan tombol apapun.
* **Responsif:** Pengaturan yang memiliki ikon 🖥️ (Desktop), 📱 (Tablet), dan 📱 (Mobile) dapat diatur berbeda untuk setiap jenis perangkat.
* **Override Per Halaman:** Untuk halaman atau artikel tertentu, Anda bisa menimpa (*override*) pengaturan global (seperti container style, sidebar, transparent header) melalui kotak **Gravisain Page Settings** di bawah editor artikel.

---

*Dokumentasi ini dibuat untuk Tema Gravisain — Bagian dari ekosistem Yudisainweb.*

