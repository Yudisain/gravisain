<?php
/**
 * Template Name: Gravisain Official Landing Page
 * Template Post Type: page
 *
 * The official high-performance architectural landing page for Undagital x Gravisain.
 * 100% Native WordPress Hybrid Theme Template, Zero Bloat, Zero jQuery.
 *
 * @package Gravisain
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'gravisain-official-landing-page' ); ?> id="i388">
<?php wp_body_open(); ?>


<header id="ia2hvs" class="grv-top-navbar">
    <div id="iha58v">
      <!-- Logo Brand -->
      <a href="/" id="io3pxj"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/gravisain-landscape.png' ); ?>" alt="Gravisain" id="ilkj0m"/></a>
      <!-- Desktop Navigation Links & Actions -->
      <div id="i1647k" class="grv-nav-desktop">
        <nav id="i1tqy9">
          <a href="#gravisain" id="iyvavl">Home</a>
          <a href="#blocks" id="i7glil">Blocks</a>
          <a href="#architecture" id="i7glil-3">Architecture</a>
          <a href="/#products" id="ipqa6j">Pricing</a>
          <a href="https://demo.undagital.com" target="_blank" id="i5avvq"><span>Live Demo</span><span id="iuz7a1">↗</span></a>
        </nav>
        <div id="i1jiml">
          <!-- Language Switcher Pill -->
          <div id="i5r6jt">
          </div>
          <!-- Customer Portal Button -->
          <a href="/portal/login" id="iqcqfe"><span>Customer Portal</span><span>→</span></a>
        </div>
      </div>
      <!-- Mobile Hamburger Button (Bebas dari bajakan plugin form) -->
      <div role="button" aria-label="Toggle Menu" id="ikhbgy" class="grv-burger-btn">
        <svg fill="none" stroke="#0f172a" viewBox="0 0 24 24" stroke-width="2.2" id="is0ydc">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16">
          </path>
        </svg>
      </div>
    </div>
    <!-- Mobile Dropdown Menu -->
    <div id="ijk8px" class="grv-nav-mobile">
      <a href="/" id="i177d1">Home</a>
      <a href="/#templates" id="iw6apt">Templates</a>
      <a href="/#pricing" id="itdqau">Pricing</a>
      <a href="https://demo.undagital.com" target="_blank" id="i7gs3u">Live Demo ↗</a>
      <div id="ij4ldv">
        <div id="ilb21p">
          <a href="/locale/id" id="imnw2v">ID</a>
          <a href="/locale/en" id="ietzyc">EN</a>
        </div>
        <a href="/portal/login" id="ilgzai">
          Customer Portal →
        </a>
      </div>
    </div>
  </header>
  <!-- ================= MAIN CONTENT (GUTENBERG COMPATIBLE) ================= -->
  <main id="primary" class="site-main grv-landing-content">
    <?php
    while ( have_posts() ) :
      the_post();

      $grv_page_content = get_the_content();
      if ( ! empty( trim( $grv_page_content ) ) ) {
        the_content();
      } else {
        // Fallback bawaan: ditampilkan otomatis jika konten halaman di Gutenberg masih kosong
        ?>
  <!-- ================= HERO SECTION PERSIS GAMBAR ================= -->
  <section id="gravisain" class="grv-hero-section">
    <div id="ien03w">
      <!-- 1. Top Monospace Pill Badge dengan Titik Hijau Blinking (Radar Pulse) -->
      <div id="i512vr">
        <!-- Titik Hijau Berkedip / Radar Pulse -->
        <span id="ialmqx"><span class="grv-blinking-ring"></span><span id="ik674d"></span></span>
        <!-- Teks Monospace PageSpeed -->
        <span id="ine5y7">Next-Gen WordPress Theme &amp; Gutenberg Blocks</span>
      </div>
      <!-- 2. Small Uppercase Tagline -->
      <div id="it4laz">
        Next-Generation WordPress Experience
      </div>
      <!-- 3. Giant Architectural Headline -->
      <h1 id="ixcpso" class="grv-hero-title">
        Build Blazing–Fast Sites With Architectural Precision
      </h1>
      <!-- 4. Description Paragraph -->
      <p id="ipkadx" class="grv-hero-desc">
        Gravisain combines a 100% hybrid PHP architecture with modern Gutenberg blocks, delivering exceptional PageSpeed scores and enterprise-grade maintainability.
      </p>
      <!-- 5. Dual Action Buttons -->
      <div id="iyequh" class="grv-hero-actions">
        <!-- Primary Button (Purple Gradient dengan Play Icon) -->
        <a href="https://demo.undagital.com" target="_blank" id="ikz2ee"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="iqe6oh">
          <circle cx="12" cy="12" r="10">
          </circle>
          <polygon points="10 8 16 12 10 16 10 8" fill="currentColor">
          </polygon>
          </svg><span>Explore Starter Sites (Live Demos)</span></a>
        <!-- Secondary Button (White Outline dengan Spark/Benchmark Icon) -->
        <a href="/#pricing" id="ifealp"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" id="icl78p">
          <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83">
          </path>
          </svg><span>View Benchmarks &amp; Pricing</span></a>
      </div>
      <!-- 6. Trust Badges Row (3 Pillars) -->
      <div id="idvpvf" class="grv-trust-badges">
        <!-- Badge 1: 100% Native WP 6.7+ -->
        <div id="i1gnqb">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" id="ia0rwb">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z">
            </path>
            <path d="m9 12 2 2 4-4">
            </path>
          </svg>
          <span id="i6chvi">
            100% Native WP 6.7+
          </span>
        </div>
        <!-- Badge 2: Zero jQuery Included -->
        <div id="i2xmbw">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" id="ifx1yy">
            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2">
            </polygon>
          </svg>
          <span id="i6rsbq">
            Zero jQuery Included
          </span>
        </div>
        <!-- Badge 3: GPLv3 Licensed -->
        <div id="iu3lgx">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" id="ijb9ui">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
            </rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4">
            </path>
          </svg>
          <span id="iwiuan">
            GPLv3 Licensed
          </span>
        </div>
      </div>
    </div>
  </section>
  <div id="in7bga">
    <div id="blocks" class="grv-mockup-wrapper">
      <!-- Pure CSS Tab Switcher Controls (Tanpa Tag Script Sama Sekali) -->
      <input type="radio" name="grv-m-tab" id="grv-tab-b" checked/>
      <input type="radio" name="grv-m-tab" id="grv-tab-c"/>
      <input type="radio" name="grv-m-tab" id="grv-tab-s"/>
      <!-- 1. Floating Badge Kiri Atas: Core Web Vitals 100 -->
      <div id="ihk85it" class="grv-badge-tl">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" id="itpf9jk">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14">
          </path>
          <polyline points="22 4 12 14.01 9 11.01">
          </polyline>
        </svg>
        <span id="iph4e9z">
          Core Web Vitals: 100
        </span>
      </div>
      <!-- 1b. Floating Badge Kanan Atas: Zero jQuery < 45KB Core -->
      <div id="ibkw3im" class="grv-badge-r">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="innsx65">
          <rect x="4" y="4" width="16" height="16" rx="2">
          </rect>
          <rect x="9" y="9" width="6" height="6">
          </rect>
          <line x1="9" y1="1" x2="9" y2="4">
          </line>
          <line x1="15" y1="1" x2="15" y2="4">
          </line>
          <line x1="9" y1="20" x2="9" y2="23">
          </line>
          <line x1="15" y1="20" x2="15" y2="23">
          </line>
          <line x1="20" y1="9" x2="23" y2="9">
          </line>
          <line x1="20" y1="15" x2="23" y2="15">
          </line>
          <line x1="1" y1="9" x2="4" y2="9">
          </line>
          <line x1="1" y1="15" x2="4" y2="15">
          </line>
        </svg>
        <span id="iu51lya">
          Zero jQuery &lt; 45KB Core
        </span>
      </div>
      <!-- 2. Window Frame Utama -->
      <div id="i9xh1wj" class="grv-window-frame">
        <!-- Top Header Bar (macOS Dots + URL + Actions) -->
        <div id="#blocks" title="Blocks" class="grv-mockup-header">
          <!-- 3 macOS Dots + URL -->
          <div id="ia6wrcc">
            <div id="ixwqbhk">
              <span id="imbwkvo" class="grv-mac-dot"></span>
              <span id="igwfqj3" class="grv-mac-dot"></span>
              <span id="idpu3pg" class="grv-mac-dot"></span>
            </div>
            <span id="iksjhs8" class="grv-url-text">yourdomian.com/wp-admin/post.php?post=408&amp;action=edit
            </span>
          </div>
          <!-- Status Saved + Tombol Update Beranimasi -->
          <div id="ibp7cse">
            <span id="iej137o">
              Saved 1s ago
            </span>
            <button type="button" id="igldzc8" class="grv-btn-update">Send</button>
          </div>
        </div>
        <!-- Mobile Column Switcher (Pure CSS Tanpa Script) -->
        <div class="grv-mobile-switcher">
          <label for="grv-tab-b" class="grv-mobile-tab-btn grv-btn-tab-b"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="iwxru13">
            <rect x="3" y="3" width="7" height="7">
            </rect>
            <rect x="14" y="3" width="7" height="7">
            </rect>
            <rect x="14" y="14" width="7" height="7">
            </rect>
            <rect x="3" y="14" width="7" height="7">
            </rect>
            </svg><span>Blocks Inserter</span></label>
          <label for="grv-tab-c" class="grv-mobile-tab-btn grv-btn-tab-c"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="ieizgc6">
            <rect x="2" y="3" width="20" height="14" rx="2">
            </rect>
            <line x1="8" y1="21" x2="16" y2="21">
            </line>
            <line x1="12" y1="17" x2="12" y2="21">
            </line>
            </svg><span>Canvas</span></label>
          <label for="grv-tab-s" class="grv-mobile-tab-btn grv-btn-tab-s"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="iuus6ei">
            <circle cx="12" cy="12" r="3">
            </circle>
            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
            </path>
            </svg><span>Settings</span></label>
        </div>
        <!-- 3-Column Body Layout -->
        <div id="iv4oyqb" class="grv-mockup-body">
          <!-- KOLOM KIRI: Block Inserter Sidebar (~260px) sesuai Gambar 2 -->
          <div id="grv-col-blocks" class="grv-mockup-left grv-mockup-col">
            <!-- 1. Gutenberg Top Mini-Toolbar -->
            <!-- 2. Tabs: Blocks | Patterns | Media + Close (x) -->
            <div id="i58ldg2">
              <div id="iwhjjph">
                <span id="itxwjzn" class="grv-tab-item active">Blocks</span>
                <span id="i7vfa95" class="grv-tab-item">Patterns</span>
                <span id="ih4d9vk" class="grv-tab-item">Media</span>
              </div>
              <span id="i9xhk4h" class="grv-close-btn">✕</span>
            </div>
            <!-- 3. Search Box -->
            <div id="iqy0rop">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="idbvzlq">
                <circle cx="11" cy="11" r="8">
                </circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65">
                </line>
              </svg>
              <input type="text" placeholder="Search" id="ipagd6a"/>
            </div>
            <!-- 4. Category Header: GRAVISAIN BLOCKS + Logo Badge -->
            <div id="i7g948v">
              <span id="iz910l8">GRAVISAIN BLOCKS</span>
              <div id="i9panph">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="i77blxf">
                  <polygon points="6 3 18 3 12 12 6 3">
                  </polygon>
                  <polygon points="6 21 18 21 12 12 6 21">
                  </polygon>
                </svg>
              </div>
            </div>
            <!-- 5. 3-Column Block Grid (12 Blocks dari Gambar 2) -->
            <div id="ine17og">
              <!-- Row 1 -->
              <div id="itvn3eh" class="grv-block-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="iotz0is">
                  <rect x="3" y="3" width="18" height="18" rx="4">
                  </rect>
                  <line x1="12" y1="8" x2="12" y2="16">
                  </line>
                  <polyline points="8 12 12 16 16 12">
                  </polyline>
                </svg>
                <div id="iflwr5t">Page Auto Scroll (Pro)
                </div>
              </div>
              <div id="i25izfx" class="grv-block-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="ip551qu">
                  <rect x="3" y="3" width="18" height="18" rx="4">
                  </rect>
                  <path d="M9 16V9l6-2v7">
                  </path>
                  <circle cx="7.5" cy="16" r="1.5" fill="currentColor">
                  </circle>
                  <circle cx="13.5" cy="14" r="1.5" fill="currentColor">
                  </circle>
                </svg>
                <div id="ivb099c">Audio Page (Pro)
                </div>
              </div>
              <div id="isiarkm" class="grv-block-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="ioel33b">
                  <line x1="3" y1="6" x2="21" y2="6">
                  </line>
                  <rect x="6" y1="4" width="4" height="4" rx="1" fill="currentColor">
                  </rect>
                  <line x1="3" y1="12" x2="21" y2="12">
                  </line>
                  <rect x="14" y1="10" width="4" height="4" rx="1" fill="currentColor">
                  </rect>
                  <line x1="3" y1="18" x2="21" y2="18">
                  </line>
                  <rect x="8" y1="16" width="4" height="4" rx="1" fill="currentColor">
                  </rect>
                </svg>
                <div id="ied28i6">Pro Slider
                </div>
              </div>
              <!-- Row 2 -->
              <div id="ie37orf" class="grv-block-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="i8r2okf">
                  <circle cx="9" cy="20" r="1">
                  </circle>
                  <circle cx="19" cy="20" r="1">
                  </circle>
                  <path d="M2 3h3l2.5 12h11.5l2-8H6">
                  </path>
                </svg>
                <div id="itxe6xa">WooCommerce Carousel (Pro)
                </div>
              </div>
              <div id="ivt3ijz" class="grv-block-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="iaege77">
                  <rect x="6" y="4" width="12" height="16" rx="2">
                  </rect>
                  <line x1="9" y1="9" x2="15" y2="9">
                  </line>
                  <line x1="9" y1="13" x2="13" y2="13">
                  </line>
                  <polyline points="2 12 4 12">
                  </polyline>
                  <polyline points="20 12 22 12">
                  </polyline>
                </svg>
                <div id="i0u1odk">Post Grid / Carousel (Pro)
                </div>
              </div>
              <div id="i9fa7p9" class="grv-block-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="iwb12vi">
                  <rect x="9" y="3" width="6" height="5" rx="1">
                  </rect>
                  <line x1="12" y1="8" x2="12" y2="13">
                  </line>
                  <line x1="6" y1="13" x2="18" y2="13">
                  </line>
                  <line x1="6" y1="13" x2="6" y2="16">
                  </line>
                  <line x1="18" y1="13" x2="18" y2="16">
                  </line>
                  <rect x="3" y="16" width="6" height="5" rx="1">
                  </rect>
                  <rect x="15" y="16" width="6" height="5" rx="1">
                  </rect>
                </svg>
                <div id="i4rrst4">Diagram Tree
                </div>
              </div>
              <!-- Row 3 -->
              <div id="ij5fscd" class="grv-block-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="ij9a0nk">
                  <rect x="3" y="4" width="18" height="16" rx="2">
                  </rect>
                  <line x1="3" y1="10" x2="21" y2="10">
                  </line>
                  <line x1="9" y1="10" x2="9" y2="20">
                  </line>
                  <line x1="15" y1="10" x2="15" y2="20">
                  </line>
                </svg>
                <div id="i7piksf">Advanced / Pricing Table
                </div>
              </div>
              <div id="iuks10m" class="grv-block-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="iv46yee">
                  <rect x="4" y="5" width="16" height="6" rx="3">
                  </rect>
                  <rect x="4" y="13" width="16" height="6" rx="3">
                  </rect>
                </svg>
                <div id="i6881d6">Advanced Buttons
                </div>
              </div>
              <div id="ijlnoux" class="grv-block-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="inbgpfm">
                  <rect x="4" y="3" width="16" height="18" rx="2">
                  </rect>
                  <line x1="8" y1="7" x2="16" y2="7">
                  </line>
                  <line x1="8" y1="11" x2="16" y2="11">
                  </line>
                  <line x1="8" y1="15" x2="12" y2="15">
                  </line>
                </svg>
                <div id="ieamtwm">Advanced Form
                </div>
              </div>
              <!-- Row 4 -->
              <div id="isyycai" class="grv-block-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="il2ezuo">
                  <rect x="3" y="3" width="7" height="7" rx="2">
                  </rect>
                  <rect x="14" y="3" width="7" height="7" rx="2">
                  </rect>
                  <rect x="3" y="14" width="7" height="7" rx="2">
                  </rect>
                  <rect x="14" y="14" width="7" height="7" rx="2">
                  </rect>
                </svg>
                <div id="iub5v17">Advanced Gallery
                </div>
              </div>
              <div id="ik0wupe" class="grv-block-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" id="iiy4yug">
                  <line x1="6" y1="4" x2="6" y2="20">
                  </line>
                  <line x1="18" y1="4" x2="18" y2="20">
                  </line>
                  <line x1="6" y1="12" x2="18" y2="12">
                  </line>
                </svg>
                <div id="ir3h2jb">Advanced Heading
                </div>
              </div>
              <div id="ixrsspi" class="grv-block-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="i23o2mf">
                  <rect x="3" y="3" width="18" height="18" rx="3">
                  </rect>
                  <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor">
                  </circle>
                  <polyline points="21 15 16 10 5 21">
                  </polyline>
                </svg>
                <div id="iar81c1">Advanced Image
                </div>
              </div>
            </div>
            <!-- 6. Bottom Breadcrumb (Page > Row Layout) -->
            <div id="iawvfei">
              <span>Page</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="i1vxsui">
                <polyline points="9 18 15 12 9 6">
                </polyline>
              </svg>
              <span>Row Layout</span>
            </div>
          </div>
          <!-- KOLOM TENGAH: Canvas Preview Area (Flexible) -->
          <div id="grv-col-canvas" class="grv-mockup-center grv-mockup-col">
            <!-- Gutenberg Block Preview Card -->
            <div id="iqjf2gk" class="grv-canvas-card">
              <!-- Floating Block Mini-Toolbar Interaktif -->
              <div id="izfezao">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="ib6wwui" class="grv-tool-icon">
                  <rect x="3" y="3" width="18" height="18" rx="2">
                  </rect>
                  <line x1="3" y1="9" x2="21" y2="9">
                  </line>
                </svg>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="iisc9hb" class="grv-tool-icon">
                  <rect x="3" y="3" width="18" height="18" rx="2">
                  </rect>
                </svg>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="i8fiv8j" class="grv-tool-icon">
                  <line x1="3" y1="6" x2="21" y2="6">
                  </line>
                  <line x1="3" y1="12" x2="21" y2="12">
                  </line>
                  <line x1="3" y1="18" x2="21" y2="18">
                  </line>
                </svg>
                <span id="i78jkrx">|</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="ik52qea" class="grv-tool-icon">
                  <circle cx="12" cy="12" r="1">
                  </circle>
                  <circle cx="12" cy="5" r="1">
                  </circle>
                  <circle cx="12" cy="19" r="1">
                  </circle>
                </svg>
              </div>
              <!-- Block Subtitle -->
              <div id="id0jke8">
                Next-Generation WordPress Experience
              </div>
              <!-- Block Title -->
              <h2 id="ij7v25g">
                Welcome to Gravisain
              </h2>
              <!-- Block Description -->
              <p id="ikv3rw6">
                Gravisain combines a 100% hybrid PHP architecture with modern Gutenberg blocks, delivering exceptional PageSpeed scores and enterprise-grade maintainability.
              </p>
              <!-- Block Actions (Tombol dengan Efek Shimmer & Hover Lift) -->
              <a href="#" id="ia1gwka" class="grv-btn-primary-card"><span>Get Started</span></a>
              <a href="#" id="ic7m04a" class="grv-btn-secondary-card"><span>Learn More</span></a>
            </div>
          </div>
          <!-- KOLOM KANAN: Block Inspector Settings (~250px) sesuai Screenshot -->
          <div id="grv-col-settings" class="grv-mockup-right grv-mockup-col">
            <!-- 1. Tabs: Page | Block + Close (x) -->
            <div id="i4h925f">
              <div id="icq88jl">
                <span id="imtctx9">Page</span>
                <span id="ivf0eju">
                  Block <span id="i3jatsi">|</span></span>
              </div>
              <span id="i7lzxob" class="grv-close-btn">✕</span>
            </div>
            <!-- 2. Block Identity: Hero Section -->
            <div id="i8fxf9j">
              <div id="ilt4t0d">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" id="iup60g4">
                  <rect x="3" y="4" width="18" height="16" rx="3">
                  </rect>
                  <line x1="7" y1="9" x2="17" y2="9">
                  </line>
                  <line x1="7" y1="13" x2="13" y2="13">
                  </line>
                </svg>
              </div>
              <div>
                <div id="if9yjdh">Hero Section
                </div>
                <div id="ij34slh">Premium Hero section block.
                </div>
              </div>
            </div>
            <!-- 3. Sub-tabs: General | Style | Advanced -->
            <div id="id78ff6">
              <div id="ieb029a">
                General
              </div>
              <div id="if9vh9f">
                Style
              </div>
              <div id="iedtn5l">
                Advanced
              </div>
            </div>
            <!-- 4. Accordion Section 1: Layout Settings (Expanded) -->
            <div id="iyk03hm">
              <div id="iwltskb">
                <span id="i7gof0b">Layout Settings</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="i4mjwv1">
                  <polyline points="18 15 12 9 6 15">
                  </polyline>
                </svg>
              </div>
              <!-- Layout Style Dropdown -->
              <div id="isi98vk">
                <div id="i9gkcqf">
                  LAYOUT STYLE
                </div>
                <div id="iv0vdmd">
                  <select id="i5j1noz"><option>1 Column (Center)</option><option>2 Columns (50 / 50)</option><option>3 Columns (Grid)</option></select>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="ijfkjef">
                    <polyline points="6 9 12 15 18 9">
                    </polyline>
                  </svg>
                </div>
              </div>
              <!-- Text Alignment + Device Toggles -->
              <div id="igtdq0q">
                <div id="i9h0gci">
                  <span id="i7hixgg">
                    TEXT ALIGNMENT
                  </span>
                  <!-- Device Switcher: Desktop | Tablet | Mobile -->
                  <div id="if2qti4">
                    <div title="Desktop" id="idoa7xi">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="iv5scb8">
                        <rect x="2" y="3" width="20" height="14" rx="2">
                        </rect>
                        <line x1="8" y1="21" x2="16" y2="21">
                        </line>
                        <line x1="12" y1="17" x2="12" y2="21">
                        </line>
                      </svg>
                    </div>
                    <div title="Tablet" id="ihbzmcc">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="i9e368g">
                        <rect x="4" y="2" width="16" height="20" rx="2">
                        </rect>
                        <line x1="12" y1="18" x2="12.01" y2="18">
                        </line>
                      </svg>
                    </div>
                    <div title="Mobile" id="iz4rl7k">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="i68o30f">
                        <rect x="5" y="2" width="14" height="20" rx="2">
                        </rect>
                        <line x1="12" y1="18" x2="12.01" y2="18">
                        </line>
                      </svg>
                    </div>
                  </div>
                </div>
                <!-- 3-Segment Alignment Buttons -->
                <div id="i32d0le">
                  <div id="ilhkq1k">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="i9r3iua">
                      <line x1="17" y1="10" x2="3" y2="10">
                      </line>
                      <line x1="21" y1="6" x2="3" y2="6">
                      </line>
                      <line x1="21" y1="14" x2="3" y2="14">
                      </line>
                      <line x1="17" y1="18" x2="3" y2="18">
                      </line>
                    </svg>
                  </div>
                  <div id="it85lxh">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="iolcbq9">
                      <line x1="18" y1="10" x2="6" y2="10">
                      </line>
                      <line x1="21" y1="6" x2="3" y2="6">
                      </line>
                      <line x1="21" y1="14" x2="3" y2="14">
                      </line>
                      <line x1="18" y1="18" x2="6" y2="18">
                      </line>
                    </svg>
                  </div>
                  <div id="ikzd30s">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" id="imtbiep">
                      <line x1="21" y1="10" x2="7" y2="10">
                      </line>
                      <line x1="21" y1="6" x2="3" y2="6">
                      </line>
                      <line x1="21" y1="14" x2="3" y2="14">
                      </line>
                      <line x1="21" y1="18" x2="7" y2="18">
                      </line>
                    </svg>
                  </div>
                </div>
              </div>
              <!-- Inner Container Max Width -->
              <div id="iyqkdvl">
                <div id="iladrw6">
                  INNER CONTAINER MAX WIDTH (PX)
                </div>
                <div id="isu1kd4">
                  <!-- Range Slider Track -->
                  <div id="infpk8n">
                    <div id="imuk61h">
                      <div id="i25dz9f">
                      </div>
                    </div>
                  </div>
                  <!-- Number Input -->
                  <input type="text" value="0" id="i7ihuwj"/>
                  <!-- Reset Button -->
                  <button type="button" id="i46mvmi">
                    Reset
                  </button>
                </div>
                <div id="ioo7fy8">
                  Set to 0 to inherit theme container width.
                </div>
              </div>
            </div>
            <!-- 5. Accordion Section 2: Background & Overlay (Collapsed) -->
            <div id="innef5i">
              <span id="idl9cs7">Background &amp; Overlay</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="icwvscl">
                <polyline points="6 9 12 15 18 9">
                </polyline>
              </svg>
            </div>
            <!-- 6. Accordion Section 3: Display Conditions (Pro) (Collapsed) -->
            <div id="ih7tre3">
              <span id="ius1gng">Display Conditions (Pro)</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="ifrp0op">
                <polyline points="6 9 12 15 18 9">
                </polyline>
              </svg>
            </div>
          </div>
        </div>
      </div>
      <!-- 3. Floating Badge Bawah Tengah: Clean DOM Elements: 184 (Animasi Floating Melayang) -->
      <div id="i6p9e12" class="grv-badge-b">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="in2o02z">
          <rect x="3" y="3" width="7" height="7">
          </rect>
          <rect x="14" y="3" width="7" height="7">
          </rect>
          <rect x="14" y="14" width="7" height="7">
          </rect>
          <rect x="3" y="14" width="7" height="7">
          </rect>
        </svg>
        <span id="iiy9s8p">
          Clean DOM Elements: 184
        </span>
      </div>
    </div>
    <!-- ================= CSS EFEK ANIMASI INTERAKTIF ================= -->
  </div>
  <div id="i8r2k6">
    <span id="architecture" class="text-xs font-label-code font-bold text-purple-700 uppercase tracking-widest block mb-3">BUILT DIFFERENT, BUILT TO LAST</span>
    <h2 id="i797u2" class="text-headline-lg-mobile md:text-headline-lg font-headline-lg font-extrabold text-slate-900 tracking-tight mb-4">100% Hybrid PHP Architecture
    </h2>
    <h2 id="ii66aj" class="text-headline-lg-mobile md:text-headline-lg font-headline-lg font-extrabold text-slate-900 tracking-tight mb-4">
    </h2>
  </div>
  <span id="ifcx4u" class="text-xs font-label-code font-bold text-purple-700 uppercase tracking-widest block mb-3"><span id="irkgbm">Gravisain combines the flexibility of traditional WordPress development with power of modern Gutenberg</span></span>
  <div id="ib218x" class="gjs-row">
    <div id="iho7i5" class="gjs-cell">
      <div id="iog06k">
        <!-- ================= GRAVISAIN ARCHITECTURE DIAGRAM SECTION ================= -->
        <div id="iqig07" class="grv-arch-wrapper">
          <!-- TOP SECTION: BADGE + CONNECTING FLOW LINES -->
          <div id="ix2vmg">
            <!-- Top Pill Badge: GRAVISAIN -->
            <div id="ituc4p" class="grv-brand-badge">
              <!-- Gravisain Diamond Layers Icon -->
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" id="ills3i">
                <polygon points="12 3 4 9 12 15 20 9 12 3">
                </polygon>
                <polyline points="4 14 12 20 20 14">
                </polyline>
              </svg>
              <span id="i5ai2j">
                GRAVISAIN
              </span>
            </div>
            <!-- SVG Flow Lines (Persis Garis Merah Putus-Putus Sesuai Gambar) -->
            <div id="i6928c" class="grv-flow-container">
              <svg viewBox="0 0 1000 42" preserveAspectRatio="none" id="i2357h" class="grv-flow-svg">
                <line x1="500" y1="0" x2="500" y2="18" stroke="#ef4444" stroke-width="1.8" stroke-dasharray="4 4" vector-effect="non-scaling-stroke">
                </line>
                <line x1="165" y1="18" x2="835" y2="18" stroke="#ef4444" stroke-width="1.8" stroke-dasharray="4 4" vector-effect="non-scaling-stroke">
                </line>
                <line x1="165" y1="18" x2="165" y2="42" stroke="#ef4444" stroke-width="1.8" stroke-dasharray="4 4" vector-effect="non-scaling-stroke">
                </line>
                <line x1="500" y1="18" x2="500" y2="42" stroke="#ef4444" stroke-width="1.8" stroke-dasharray="4 4" vector-effect="non-scaling-stroke">
                </line>
                <line x1="835" y1="18" x2="835" y2="42" stroke="#ef4444" stroke-width="1.8" stroke-dasharray="4 4" vector-effect="non-scaling-stroke">
                </line>
                <circle cx="500" cy="18" r="4" fill="#ef4444" class="grv-pulse-node">
                </circle>
              </svg>
            </div>
          </div>
          <!-- 3 COLUMNS ARCHITECTURE CARDS -->
          <div id="iyizmp" class="grv-cards-grid">
            <!-- ================= CARD 1: PHP ARCHITECTURE (KIRI) ================= -->
            <div id="ia8sai" class="grv-card grv-card-php">
              <div>
                <!-- Header Card 1 -->
                <div id="iy46vf">
                  <!-- Badge PHP Ungu Muda -->
                  <div id="icjfml">
                    php
                  </div>
                  <!-- Title -->
                  <h3 id="ittl8g">
                    PHP Architecture
                  </h3>
                </div>
                <!-- Feature Items List -->
                <div id="il2ae1">
                  <!-- Item 1 -->
                  <div id="i2lmrh">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" id="iaibb3">
                      <polyline points="20 6 9 17 4 12">
                      </polyline>
                    </svg>
                    <span id="i6ctin">
                      Dynamic Logic
                    </span>
                  </div>
                  <!-- Item 2 -->
                  <div id="in6xi7">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" id="iytl21">
                      <polyline points="20 6 9 17 4 12">
                      </polyline>
                    </svg>
                    <span id="id8evx">
                      Clean Templates
                    </span>
                  </div>
                  <!-- Item 3 -->
                  <div id="iyzj7j">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" id="ir0u4w">
                      <polyline points="20 6 9 17 4 12">
                      </polyline>
                    </svg>
                    <span id="ixzysj">
                      Standard WP Hooks
                    </span>
                  </div>
                  <!-- Item 4 -->
                  <div id="icxq3u">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" id="ij17r3">
                      <polyline points="20 6 9 17 4 12">
                      </polyline>
                    </svg>
                    <span id="igafe9">
                      Zero Client Rendering Delay
                    </span>
                  </div>
                </div>
              </div>
              <!-- Footer Card 1 -->
              <div id="ignpny">
                <span id="ikcsyv">
                  Engine: Server-Side
                </span>
                <span id="idwolw">
                  0ms Client JS
                </span>
              </div>
            </div>
            <!-- ================= CARD 2: HYBRID POWER (TENGAH) ================= -->
            <div id="i6948z" class="grv-card grv-card-hybrid">
              <div>
                <!-- Title -->
                <h3 id="ijk4ye">
                  Hybrid Power
                </h3>
                <!-- Subtitle Ungu Muda -->
                <div id="innuze">
                  Flexibility &amp; Performance
                </div>
                <!-- Deskripsi -->
                <p id="irpwlj">
                  Connects traditional WordPress template hooks with modern Gutenberg block states without iframe isolation.
                </p>
              </div>
              <!-- Badge / Pill Bawah: Seamless Synchronized Bridge -->
              <div id="i3ceh7">
                <div id="ispu9f">
                  Seamless Synchronized Bridge
                </div>
              </div>
            </div>
            <!-- ================= CARD 3: GUTENBERG BLOCKS (KANAN) ================= -->
            <div id="ilua3b" class="grv-card grv-card-gutenberg">
              <div>
                <!-- Header Card 3 -->
                <div id="iyaq5i">
                  <!-- Badge Desktop / Monitor -->
                  <div id="i2m01g">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" id="icm3ct">
                      <rect x="2" y="3" width="20" height="14" rx="2">
                      </rect>
                      <line x1="8" y1="21" x2="16" y2="21">
                      </line>
                      <line x1="12" y1="17" x2="12" y2="21">
                      </line>
                    </svg>
                  </div>
                  <!-- Title -->
                  <h3 id="iqmciw">
                    Gutenberg Blocks
                  </h3>
                </div>
                <!-- Feature Items List -->
                <div id="i1pzyt">
                  <!-- Item 1 -->
                  <div id="iy8eji">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" id="iz42o3">
                      <polyline points="20 6 9 17 4 12">
                      </polyline>
                    </svg>
                    <span id="i8pz07">
                      Visual In-Place Editing
                    </span>
                  </div>
                  <!-- Item 2 -->
                  <div id="imj5xh">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" id="iilja1">
                      <polyline points="20 6 9 17 4 12">
                      </polyline>
                    </svg>
                    <span id="i026q5">
                      Block Patterns Library
                    </span>
                  </div>
                  <!-- Item 3 -->
                  <div id="i5a2vu">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" id="idzaxa">
                      <polyline points="20 6 9 17 4 12">
                      </polyline>
                    </svg>
                    <span id="ix228d">
                      Native Global Styles
                    </span>
                  </div>
                  <!-- Item 4 -->
                  <div id="i45tyr">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" id="irtacg">
                      <polyline points="20 6 9 17 4 12">
                      </polyline>
                    </svg>
                    <span id="ic7h92">
                      Responsive Clamps
                    </span>
                  </div>
                </div>
              </div>
              <!-- Footer Card 3 -->
              <div id="ivotyf">
                <span id="iu1uf5">
                  UI: Native React Core
                </span>
                <span id="i0rmzs">
                  100% Visual Fidelity
                </span>
              </div>
            </div>
          </div>
        </div>
        <!-- ================= STYLES & RESPONSIVE BEHAVIOR ================= -->
      </div>
    </div>
  </div>
  <div id="i5oik3">
    <!-- ================= CSS EFEK ANIMASI INTERAKTIF ================= -->
  </div>
  <div id="ijox29">
    <!-- ================= CSS EFEK ANIMASI INTERAKTIF ================= -->
  </div>
  <div id="ig9431">
    <!-- ================= CSS EFEK ANIMASI INTERAKTIF ================= -->
  </div>
  <div id="i0ikck" class="gjs-row">
  </div>
  <div id="iwdzlm">
    <div id="itgsxx" class="grv-bento-container">
      <!-- 1. Header Section: Badge + Title + Subtitle -->
      <div id="i2vpso">
        <!-- Badge Pill -->
        <div id="i5k3wd">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" id="i4u6dj">
            <path d="M2 20h20">
            </path>
            <path d="m5 20 7-16 7 16">
            </path>
            <line x1="8" y1="13" x2="16" y2="13">
            </line>
          </svg>
          <span>Engineered for Precision</span>
        </div>
        <!-- Heading -->
        <h2 id="iv1hvg">
          Native Gutenberg First. No Builder Overhead.
        </h2>
        <!-- Subtitle -->
        <p id="id07ho">
          Gravisain was engineered to solve WordPress site bloat. Every block compiles to lightweight semantic HTML and vanilla CSS variables directly in WordPress core.
        </p>
      </div>
      <!-- 2. Bento Grid 12 Columns Layout -->
      <div class="grv-bento-grid">
        <!-- ================= CARD 1 (SPAN 8): NATIVE GUTENBERG BLOCK ENGINE ================= -->
        <div id="ip2jbz" class="grv-bento-card grv-span-8">
          <div>
            <!-- Icon Box -->
            <div id="ii36me">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="iyscbk">
                <path d="m21 16-9 5-9-5V8l9-5 9 5v8Z">
                </path>
                <path d="m3.27 6.96 8.73 4.99 8.73-4.99">
                </path>
                <path d="M12 22V12">
                </path>
              </svg>
            </div>
            <!-- Category Tag -->
            <span id="irglak">
              ARCHITECTURAL CORE
            </span>
            <!-- Title -->
            <h3 id="ie8eoh">
              Native Gutenberg Block Engine
            </h3>
            <!-- Description -->
            <p id="ixv6nt">
              Eliminate heavy iframe wrappers and external JavaScript interpreters. Gravisain blocks live natively in the WordPress editor, matching your frontend styling with 1:1 fidelity and lightning-fast typing response.
            </p>
          </div>
          <!-- Code Snippet Box -->
          <div id="ilwn8x">
            <div id="irc791">
              <div id="i1y7ah">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="inlxwn">
                  <polyline points="4 17 10 11 4 5">
                  </polyline>
                  <line x1="12" y1="19" x2="20" y2="19">
                  </line>
                </svg>
                <span>gravisain.engine.render.php</span>
              </div>
              <span id="iw3x8p">
                Pure WordPress Block API 3.0
              </span>
            </div>
            <pre id="igr83l">
<code>register_block_type( 'gravisain/bento-grid', [
'render_callback' =&gt; 'gravisain_render_css_grid',
'editor_script'   =&gt; 'gravisain-editor-v3',
'style'           =&gt; 'gravisain-modular-subgrid'
] ); // Compiles to standard HTML5 semantic elements without container bloat</code>
</pre>
          </div>
        </div>
        <!-- ================= CARD 2 (SPAN 4): ZERO JQUERY, DYNAMIC CSS ================= -->
        <div id="ilqis1" class="grv-bento-card grv-span-4">
          <div>
            <!-- Icon Box -->
            <div id="is0hto">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="iqh5t1">
                <circle cx="12" cy="12" r="10">
                </circle>
                <polyline points="12 6 12 12 16 14">
                </polyline>
              </svg>
            </div>
            <!-- Category Tag -->
            <span id="itk74o">
              ASSET EFFICIENCY
            </span>
            <!-- Title -->
            <h3 id="i53x6w">
              Zero jQuery, Dynamic CSS
            </h3>
            <!-- Description -->
            <p id="iq45xh">
              Scripts and styles load conditionally per page. If a block isn't present, its code is never enqueued into the user's browser payload.
            </p>
          </div>
          <!-- Asset Progress Box -->
          <div id="ijjzbi">
            <div id="ibabhk">
              <span id="i6ccgy">Asset Overhead</span>
              <span id="i4tzxv">&lt; 38KB Core</span>
            </div>
            <!-- Progress Bar -->
            <div id="ivw29f">
              <div id="iizo97">
              </div>
            </div>
            <span id="im6o1f">
              Versus 2.4MB on typical builder installs
            </span>
          </div>
        </div>
        <!-- ================= CARD 3 (SPAN 4): 1-CLICK CLOUD IMPORTER ================= -->
        <div id="i8aq9k" class="grv-bento-card grv-span-4">
          <div>
            <!-- Icon Box -->
            <div id="ij0p0x">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="ibo03l">
                <path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z">
                </path>
              </svg>
            </div>
            <!-- Category Tag -->
            <span id="in0k1z">
              RAPID ONBOARDING
            </span>
            <!-- Title -->
            <h3 id="i7gko4">
              1-Click Cloud Importer
            </h3>
            <!-- Description -->
            <p id="ix7dic">
              Browse templates directly inside the WordPress dashboard. Pick any site, click import, and have complete layouts ready in seconds.
            </p>
          </div>
          <!-- Feature Check Box -->
          <div id="i6dtzl">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" id="imp1ez">
              <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14">
              </path>
              <polyline points="22 4 12 14.01 9 11.01">
              </polyline>
            </svg>
            <span id="i1mkzh">
              Imports Menus, Widgets &amp; Styles
            </span>
          </div>
        </div>
        <!-- ================= CARD 4 (SPAN 4): GRANULAR BREAKPOINTS ================= -->
        <div id="iidc4f" class="grv-bento-card grv-span-4">
          <div>
            <!-- Icon Box -->
            <div id="iiwfnt">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="i5egnj">
                <rect x="2" y="3" width="20" height="14" rx="2">
                </rect>
                <line x1="8" y1="21" x2="16" y2="21">
                </line>
                <line x1="12" y1="17" x2="12" y2="21">
                </line>
              </svg>
            </div>
            <!-- Category Tag -->
            <span id="i4zh3j">
              VIEWPORT FLUIDITY
            </span>
            <!-- Title -->
            <h3 id="ih3nf8">
              Granular Breakpoints
            </h3>
            <!-- Description -->
            <p id="ijdwnx">
              Configure padding, typography clamps, flex ordering, and column spans independently across Desktop, Laptop, Tablet, and Mobile.
            </p>
          </div>
          <!-- Breakpoint Badges -->
          <div id="i7juc8">
            <span id="ikki3c">1440px</span>
            <span id="if96dy">1024px</span>
            <span id="i822cp">768px</span>
            <span id="i41k07">375px</span>
          </div>
        </div>
        <!-- ================= CARD 5 (SPAN 4): WHITE-LABEL & AUTO SYNC ================= -->
        <div id="iimdch" class="grv-bento-card grv-span-4">
          <div>
            <!-- Icon Box -->
            <div id="iismjl">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="i0zzvs">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z">
                </path>
              </svg>
            </div>
            <!-- Category Tag -->
            <span id="icihu8">
              AGENCY GOVERNANCE
            </span>
            <!-- Title -->
            <h3 id="iimk57">
              White-Label &amp; Auto Sync
            </h3>
            <!-- Description -->
            <p id="i6i1ml">
              Rebrand Gravisain as your agency's custom internal framework. Manage client site keys seamlessly with headless license authorization.
            </p>
          </div>
          <!-- Client Transfer Mode Pill -->
          <div id="iaotks">
            <span id="i39u5i">
              Client Transfer Mode
            </span>
            <span id="ibaguk"></span>
          </div>
        </div>
      </div>
    </div>
    <!-- ================= STYLES (TANPA SCRIPT - ZERO SCRIPT WARNINGS) ================= -->
  </div>
  <div id="i5m2cme">
    <div class="grv-comparison-wrapper" id="izbgv9e">
      <!-- Header Section -->
      <div id="i3je2ol">
        <!-- Badge Pill -->
        <div id="i53sofw">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" id="iqqkiq5">
            <path d="M12 2v4">
            </path>
            <path d="M12 18v4">
            </path>
            <path d="m4.93 4.93 2.83 2.83">
            </path>
            <path d="m16.24 16.24 2.83 2.83">
            </path>
            <path d="M2 12h4">
            </path>
            <path d="M18 12h4">
            </path>
            <path d="m4.93 19.07 2.83-2.83">
            </path>
            <path d="m16.24 7.76 2.83-2.83">
            </path>
          </svg>
          <span>Raw Benchmarks</span>
        </div>
        <!-- Heading -->
        <h2 id="ipeq1xx">
          Why Gravisain Beats Heavy Page Builders
        </h2>
        <!-- Subtitle -->
        <p id="ijn2bxw">
          Traditional visual builders wrap every headline in 8 nested divs. Gravisain renders directly to native browser elements.
        </p>
      </div>
      <!-- Comparison Table Card -->
      <div id="i45nnnt">
        <div id="ire7p5j">
          <table id="ip75omh">
            <!-- Table Header -->
            <thead>
              <tr id="i74ijcp">
                <th id="inzq2ax">
                  ARCHITECTURAL METRIC
                </th>
                <th id="ikiqv1x">
                  <div id="ixvglyl">
                    <span id="iej1y9l"></span>
                    <span id="ioyysua">GRAVISAIN</span>
                  </div>
                </th>
                <th id="i9woetv">
                  ELEMENTOR / DIVI / VISUAL BUILDERS
                </th>
              </tr>
            </thead>
            <!-- Table Body -->
            <tbody>
              <!-- Row 1: Average DOM Nodes per Page -->
              <tr class="grv-table-row" id="i58ypuj">
                <td id="imqq3bj">
                  Average DOM Nodes per Page
                </td>
                <td id="ilpy3e1">
                  180 – 240 elements
                </td>
                <td id="im236b2">
                  1,400 – 2,800+ elements (Excessive DOM Depth)
                </td>
              </tr>
              <!-- Row 2: Asset Enqueue Payload -->
              <tr class="grv-table-row" id="igdmix1">
                <td id="i6kcya7">
                  Asset Enqueue Payload
                </td>
                <td id="i4ani4o">
                  ~38KB CSS / 0KB JS (Block Conditional)
                </td>
                <td id="ijal49i">
                  1.8MB – 3.2MB (jQuery, Swiper, Waypoints)
                </td>
              </tr>
              <!-- Row 3: Mobile PageSpeed Score -->
              <tr class="grv-table-row" id="ih0vbqn">
                <td id="ik3yurq">
                  Mobile PageSpeed Score
                </td>
                <td id="ifzgkrm">
                  98 – 100 / 100
                </td>
                <td id="i69jc4u">
                  45 – 68 / 100 (Render blocking warnings)
                </td>
              </tr>
              <!-- Row 4: Editor Speed & Typing Latency -->
              <tr class="grv-table-row" id="i8pmy5x">
                <td id="ifsbv1l">
                  Editor Speed &amp; Typing Latency
                </td>
                <td id="ie9g7x6">
                  &lt; 8ms Instant React Core
                </td>
                <td id="i06c6j7">
                  300ms – 1.2s iframe loading delay
                </td>
              </tr>
              <!-- Row 5: Lock-in & Code Portability -->
              <tr class="grv-table-row" id="i5nrt0a">
                <td id="iq5x80o">
                  Lock-in &amp; Code Portability
                </td>
                <td id="i7e9zdq">
                  Zero Lock-in (Valid standard HTML comment tags)
                </td>
                <td id="if5136r">
                  Proprietary shortcodes leave broken code if deactivated
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- ================= STYLES (TANPA SCRIPT - ZERO SCRIPT WARNINGS) ================= -->
  </div>
  <div id="iouetr">
    <div id="is50esh" class="grv-pricing-ecosystem">
      <!-- ================= 1. OFFICIAL SOFTWARE SECTION (DARI PORTAL LICENSE) ================= -->
      <section id="products">
        <!-- Header -->
        <div id="iq6god2">
          <!-- Badge Pill -->
          <div id="i9hryem">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" id="i7e3bld">
              <polygon points="12 2 2 7 12 12 22 7 12 2">
              </polygon>
              <polyline points="2 17 12 22 22 17">
              </polyline>
              <polyline points="2 12 12 17 22 12">
              </polyline>
            </svg>
            <span>Official Software</span>
          </div>
          <!-- Title -->
          <h2 id="ilnd84k">
            Gravisain Themes &amp; Plugins
          </h2>
          <!-- Subtitle -->
          <p id="isafg4f">
            Select the product you need and get instant access to premium features.
          </p>
        </div>
        <!-- 4 Products Grid -->
        <div id="i2vycox" class="grv-products-grid">
          <!-- Product 1: Gravisain Theme -->
          <div id="ixr6nyq" class="grv-product-card">
            <!-- Top Accent Line -->
            <div id="i4n6e96">
            </div>
            <div>
              <!-- Badges -->
              <div id="i91e50h">
                <span id="iyv9cen">
                  v1.0.0
                </span>
                <span id="i49k9vg">
                  3-Day Trial Available
                </span>
              </div>
              <!-- Title & Description -->
              <h3 id="ivamrsp">
                Gravisain Theme
              </h3>
              <p id="iaolp7n">
                Premium software package fully integrated with Gravisain ecosystem.
              </p>
              <!-- Feature Checks -->
              <div id="iciucwy">
                <div id="i0mylqo">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="iqlvvmq">
                    <polyline points="20 6 9 17 4 12">
                    </polyline>
                  </svg>
                  <span>Direct 1-click WordPress updates</span>
                </div>
                <div id="ix52oge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="iiz09if">
                    <polyline points="20 6 9 17 4 12">
                    </polyline>
                  </svg>
                  <span>Customer Portal ZIP downloads</span>
                </div>
                <div id="iv4gvkj">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="inbg6fs">
                    <polyline points="20 6 9 17 4 12">
                    </polyline>
                  </svg>
                  <span>Self-serve domain transfer</span>
                </div>
              </div>
            </div>
            <!-- Price & Action Buttons -->
            <div id="i5hifkm">
              <div id="i1tfio8">
              </div>
              <div id="id17zmz-3">
                <div>
                  <div id="ie8po33-3">Starting at
                  </div>
                  <div id="in15ehg-3">
                    <span id="isb3oqt-2">$<strike>49
                      </strike></span>
                  </div>
                </div>
                <div id="ispluq2-3">
                  <div id="i3p1kag-7">beta
                  </div>
                </div>
              </div>
              <div id="i53j8um">
                <a href="https://ls.undagital.com/buy/gravisain-theme" id="i4c8xfi"><span>Purchase License</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="ieaac9x">
                  <line x1="5" y1="12" x2="19" y2="12">
                  </line>
                  <polyline points="12 5 19 12 12 19">
                  </polyline>
                  </svg></a>
                <a href="https://ls.undagital.com/buy/gravisain-theme?plan=trial" id="i2fnhej"><span>🎁 Start 3-Day Free Trial</span></a>
              </div>
            </div>
          </div>
          <!-- Product 2: Gravisain Blocks -->
          <div id="ii9fpd5" class="grv-product-card">
            <!-- Top Accent Line -->
            <div id="ivkbvr9">
            </div>
            <div>
              <!-- Badges -->
              <div id="ibd5mkq">
                <span id="idtqxyi">
                  v1.0.0
                </span>
                <span id="isr1m9t">
                  3-Day Trial Available
                </span>
              </div>
              <!-- Title & Description -->
              <h3 id="iikfa5d">
                Gravisain Blocks
              </h3>
              <p id="izj9waw">
                Premium software package fully integrated with Gravisain ecosystem.
              </p>
              <!-- Feature Checks -->
              <div id="iugmsa8">
                <div id="i918v8b">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="ihwovgq">
                    <polyline points="20 6 9 17 4 12">
                    </polyline>
                  </svg>
                  <span>Direct 1-click WordPress updates</span>
                </div>
                <div id="ifscsi6">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="ivowsqj">
                    <polyline points="20 6 9 17 4 12">
                    </polyline>
                  </svg>
                  <span>Customer Portal ZIP downloads</span>
                </div>
                <div id="ipsfzuy">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="itq5bpa">
                    <polyline points="20 6 9 17 4 12">
                    </polyline>
                  </svg>
                  <span>Self-serve domain transfer</span>
                </div>
              </div>
            </div>
            <!-- Price & Action Buttons -->
            <div id="iao9n5h">
              <div id="ixs5kq4">
              </div>
              <div id="im43lfv">
                <div id="id17zmz">
                  <div>
                    <div id="ie8po33">Starting at
                    </div>
                    <div id="in15ehg">
                      <span>$<strike>49
                        </strike></span>
                    </div>
                  </div>
                  <div id="ispluq2">
                    <div id="i3p1kag">beta
                    </div>
                  </div>
                </div>
                <a href="https://ls.undagital.com/buy/gravisain-blocks" id="iebf1w6"><span>Purchase License</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="idlps6h">
                  <line x1="5" y1="12" x2="19" y2="12">
                  </line>
                  <polyline points="12 5 19 12 12 19">
                  </polyline>
                  </svg></a>
                <a href="https://ls.undagital.com/buy/gravisain-blocks?plan=trial" id="inxhg5x"><span>🎁 Start 3-Day Free Trial</span></a>
              </div>
            </div>
          </div>
          <!-- Product 3: Gravisain Studio -->
          <div id="ipz8m1v" class="grv-product-card">
            <!-- Top Accent Line -->
            <div id="iivjb3d">
            </div>
            <div>
              <!-- Badges -->
              <div id="i69dr5g">
                <span id="i3qk7a7">
                  v1.0.0
                </span>
                <span id="i4ykrzd">
                  3-Day Trial Available
                </span>
              </div>
              <!-- Title & Description -->
              <h3 id="ixgxf3v">
                Gravisain Studio
              </h3>
              <p id="ih6n6ak">
                Premium software package fully integrated with Gravisain ecosystem.
              </p>
              <!-- Feature Checks -->
              <div id="imt3ytg">
                <div id="izcj7xq">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="inb1gbg">
                    <polyline points="20 6 9 17 4 12">
                    </polyline>
                  </svg>
                  <span>Direct 1-click WordPress updates</span>
                </div>
                <div id="ivv7iaw">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="i97pasb">
                    <polyline points="20 6 9 17 4 12">
                    </polyline>
                  </svg>
                  <span>Customer Portal ZIP downloads</span>
                </div>
                <div id="iwrrj9g">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="i4wcwre">
                    <polyline points="20 6 9 17 4 12">
                    </polyline>
                  </svg>
                  <span>Self-serve domain transfer</span>
                </div>
              </div>
            </div>
            <!-- Price & Action Buttons -->
            <div id="igvzdxk">
              <div id="id17zmz-2-2">
                <div>
                  <div id="ie8po33-2-2">Starting at
                  </div>
                  <div id="in15ehg-2-2">
                    <span id="i7bj40b-2">$<strike>49
                      </strike></span>
                  </div>
                </div>
                <div id="ispluq2-2-2">
                  <div id="iryxx8a-2-2">Lifetime
                  </div>
                  <div id="i3p1kag-4-2">N/A
                  </div>
                </div>
              </div>
              <div id="ig171jt">
                <a href="https://ls.undagital.com/buy/gravisain-studio" id="ichvbz7"><span>Purchase License</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="i7eiylv">
                  <line x1="5" y1="12" x2="19" y2="12">
                  </line>
                  <polyline points="12 5 19 12 12 19">
                  </polyline>
                  </svg></a>
                <a href="https://ls.undagital.com/buy/gravisain-studio?plan=trial" id="im4uoal"><span>🎁 Start 3-Day Free Trial</span></a>
              </div>
            </div>
          </div>
          <!-- Product 4: Gravisain Orders -->
          <div id="ix2jugk" class="grv-product-card">
            <!-- Top Accent Line -->
            <div id="ib44amu">
            </div>
            <div>
              <!-- Badges -->
              <div id="i08ljse">
                <span id="ifbdhqf">
                  v1.0.1
                </span>
                <span id="ijlsw2j">
                  3-Day Trial Available
                </span>
              </div>
              <!-- Title & Description -->
              <h3 id="iuwo4zk">
                Gravisain Orders
              </h3>
              <p id="izhc64s">
                Premium software package fully integrated with Gravisain ecosystem.
              </p>
              <!-- Feature Checks -->
              <div id="iz7e306">
                <div id="i5koxqw">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="in7nb0u">
                    <polyline points="20 6 9 17 4 12">
                    </polyline>
                  </svg>
                  <span>Direct 1-click WordPress updates</span>
                </div>
                <div id="iiwoahm">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="iubuett">
                    <polyline points="20 6 9 17 4 12">
                    </polyline>
                  </svg>
                  <span>Customer Portal ZIP downloads</span>
                </div>
                <div id="ihfsxou">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="ilf0m9w">
                    <polyline points="20 6 9 17 4 12">
                    </polyline>
                  </svg>
                  <span>Self-serve domain transfer</span>
                </div>
              </div>
            </div>
            <!-- Price & Action Buttons -->
            <div id="izz7hah">
              <div id="id17zmz-2">
                <div>
                  <div id="ie8po33-2">Starting at
                  </div>
                  <div id="in15ehg-2">IDR. 99.000
                  </div>
                </div>
                <div id="ispluq2-2">
                  <div id="iryxx8a-2">Lifetime
                  </div>
                  <div id="i3p1kag-4">N/A
                  </div>
                </div>
              </div>
              <div id="imrarul">
              </div>
              <div id="i8orfig">
                <a href="https://ls.undagital.com/buy/gravisain-orders" id="i25dz88"><span>Purchase License</span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="iwxkl96">
                  <line x1="5" y1="12" x2="19" y2="12">
                  </line>
                  <polyline points="12 5 19 12 12 19">
                  </polyline>
                  </svg></a>
                <a href="https://ls.undagital.com/buy/gravisain-orders?plan=trial" id="ipwvd85"><span>🎁 Start 3-Day Free Trial</span></a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ================= 2. CUSTOMER REVIEWS & SOCIAL PROOF ================= -->
      <!-- ================= 3. FAQ SECTION ================= -->
      <section id="faq">
        <!-- Header -->
        <div id="irjok64">
          <div id="inqyc1m">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" id="iwb3h3z">
              <circle cx="12" cy="12" r="10">
              </circle>
              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3">
              </path>
              <line x1="12" y1="17" x2="12.01" y2="17">
              </line>
            </svg>
            <span>Common Queries</span>
          </div>
          <h2 id="ii9tas1">
            Frequently Asked Questions
          </h2>
        </div>
        <!-- FAQ Items List (Pure HTML details/summary without script) -->
        <div id="iykmnf6">
          <!-- Item 1 -->
          <details open id="ixi5eyj" class="grv-faq-item">
            <summary id="iquphc9">
              <span>Do I need any third-party builder plugins like Elementor or Divi?</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="i4enzpe" class="grv-faq-icon">
                <polyline points="6 9 12 15 18 9">
                </polyline>
              </svg>
            </summary>
            <p id="ie3efbz">
              No! Gravisain completely replaces external page builders. It is 100% native to the core WordPress Gutenberg block editor. You get complete visual drag-and-drop capability with zero extra plugin bloat.
            </p>
          </details>
          <!-- Item 2 -->
          <details id="ibneiff" class="grv-faq-item">
            <summary id="i7qunob">
              <span>How does the 1-Click Starter Sites Importer work?</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="iy2ld9q" class="grv-faq-icon">
                <polyline points="6 9 12 15 18 9">
                </polyline>
              </svg>
            </summary>
            <p id="i08rwbl">
              Once Gravisain is activated, you will see the Gravisain Cloud tab inside your WordPress dashboard. Pick any starter template (Agency, SaaS, Portfolio, etc.) and click "Import". In less than 15 seconds, full pages, custom templates, and block settings will be seamlessly populated.
            </p>
          </details>
          <!-- Item 3 -->
          <details id="i6tsdwj" class="grv-faq-item">
            <summary id="i9p5tcq">
              <span>Is Gravisain compatible with WooCommerce?</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="izmzcxh" class="grv-faq-icon">
                <polyline points="6 9 12 15 18 9">
                </polyline>
              </svg>
            </summary>
            <p id="ic2j95q">
              Yes. The Professional and Agency plans include custom WooCommerce blocks, such as dynamic product grids, mini-cart sliders, and streamlined checkout styling optimized for rapid mobile purchasing.
            </p>
          </details>
          <!-- Item 4 -->
          <details id="i2mcwo7" class="grv-faq-item">
            <summary id="i8yygiq">
              <span>Can I use my Agency license on client websites?</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" id="ixime9v" class="grv-faq-icon">
                <polyline points="6 9 12 15 18 9">
                </polyline>
              </svg>
            </summary>
            <p id="i5lusfd">
              Yes! With the Agency Unlimited license, you can install Gravisain on unlimited client sites, enable white-label re-branding so it looks like your own proprietary agency framework, and control individual keys from your centralized dashboard.
            </p>
          </details>
        </div>
      </section>
      <!-- ================= 4. GLOWING CONVERSION CALL-TO-ACTION ================= -->
      <section id="i6j5pzk">
        <div id="iiukxju">
          <div id="iu6qg9g">
            <!-- Badge -->
            <span id="ivimssg">
              Instant WordPress Performance
            </span>
            <!-- Title -->
            <h2 id="iumlxsf">
              Ready to Build the Fastest WordPress Sites on the Web?
            </h2>
            <!-- Subtitle -->
            <p id="igoaouh">
              Join 12,000+ creators, freelancers, and design agencies who switched to the Undagital × Gravisain block architecture.
            </p>
            <!-- Action Buttons -->
            <div id="if8op9h" class="grv-cta-buttons">
              <a href="#products" id="isyz6ym"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" id="i9fymri">
                <path d="m4.5 16.5-1.5 3 3-1.5">
                </path>
                <path d="m14 7-5.5 5.5">
                </path>
                <path d="M9 12v5h5">
                </path>
                <path d="M12 15 21 6a3 3 0 0 0-4.24-4.24L7.5 11">
                </path>
                </svg><span>Get Gravisain Pro Today</span></a>
              <a href="#templates" id="i5zn5a5">
                Explore Live Demos
              </a>
            </div>
            <!-- Money-back Guarantee Footnote -->
            <div id="i8wyt34">
              Includes 14-day 100% money-back guarantee • Instant license key delivery
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- ================= STYLES (TANPA SCRIPT - ZERO SCRIPT WARNINGS) ================= -->
  </div>
        <?php
      }
    endwhile;
    ?>
  </main>

  <!-- ================= CSS RESPONSIVE & ANIMASI ================= -->

<style>* {
  box-sizing: border-box;
  }
  body {
    margin: 0;
  }
  .grv-blinking-ring{
    position:absolute;
    top:0px;
    right:0px;
    bottom:0px;
    left:0px;
    border-top-left-radius:9999px;
    border-top-right-radius:9999px;
    border-bottom-right-radius:9999px;
    border-bottom-left-radius:9999px;
    background-color:rgb(52, 211, 153);
    animation-duration:1.8s;
    animation-timing-function:cubic-bezier(0, 0, 0.2, 1);
    animation-delay:0s;
    animation-iteration-count:infinite;
    animation-direction:normal;
    animation-fill-mode:none;
    animation-play-state:running;
    animation-name:grvBlinkPulse;
    animation-timeline:auto;
    animation-range-start:normal;
    animation-range-end:normal;
  }
  #ilkj0m{
    height:34px;
    width:auto;
    object-fit:contain;
  }
  #io3pxj{
    display:flex;
    align-items:center;
    text-decoration:none;
  }
  #iyvavl{
    color:#475569;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
  }
  #i7glil{
    color:#475569;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
  }
  #ipqa6j{
    color:#475569;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
  }
  #iuz7a1{
    font-size:12px;
  }
  #i5avvq{
    color:#475569;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:4px;
  }
  #i1tqy9{
    display:flex;
    align-items:center;
    gap:24px;
  }
  #i5r6jt{
    display:flex;
    align-items:center;
    background:#f1f5f9;
    border-radius:9999px;
    padding:2px;
    font-size:11px;
    font-weight:700;
    border:1px solid #e2e8f0;
  }
  #iqcqfe{
    padding:9px 18px;
    border-radius:11px;
    background:#0f172a;
    color:#ffffff;
    font-size:13px;
    font-weight:700;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:6px;
    box-shadow:0 4px 12px rgba(15,23,42,0.15);
  }
  #i1jiml{
    display:flex;
    align-items:center;
    gap:12px;
  }
  #i1647k{
    display:flex;
    align-items:center;
    gap:28px;
  }
  #is0ydc{
    width:22px;
    height:22px;
    display:block;
    pointer-events:none;
  }
  #ikhbgy{
    background:#f8fafc;
    border:1px solid #e2e8f0;
    border-radius:8px;
    padding:7px 9px;
    cursor:pointer;
    align-items:center;
    justify-content:center;
  }
  #iha58v{
    max-width:1200px;
    margin:0 auto;
    min-height:72px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
    position:relative;
  }
  #i177d1{
    color:#1e293b;
    font-size:15px;
    font-weight:600;
    text-decoration:none;
    padding:6px 0;
  }
  #iw6apt{
    color:#1e293b;
    font-size:15px;
    font-weight:600;
    text-decoration:none;
    padding:6px 0;
  }
  #itdqau{
    color:#1e293b;
    font-size:15px;
    font-weight:600;
    text-decoration:none;
    padding:6px 0;
  }
  #i7gs3u{
    color:#1e293b;
    font-size:15px;
    font-weight:600;
    text-decoration:none;
    padding:6px 0;
  }
  #imnw2v{
    padding:3px 8px;
    text-decoration:none;
    color:#4338ca;
    background:#ffffff;
    border-radius:9999px;
  }
  #ietzyc{
    padding:3px 8px;
    text-decoration:none;
    color:#64748b;
  }
  #ilb21p{
    display:flex;
    align-items:center;
    background:#f1f5f9;
    border-radius:9999px;
    padding:2px;
    font-size:11px;
    font-weight:700;
    border:1px solid #e2e8f0;
  }
  #ilgzai{
    padding:8px 16px;
    border-radius:10px;
    background:#0f172a;
    color:#ffffff;
    font-size:13px;
    font-weight:700;
    text-decoration:none;
  }
  #ij4ldv{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding-top:10px;
    border-top:1px solid #e2e8f0;
  }
  #ijk8px{
    display:none;
    flex-direction:column;
    gap:14px;
    padding:16px 0 20px;
    border-top:1px solid #f1f5f9;
  }
  #ia2hvs{
    background:rgba(255, 255, 255, 0.95);
    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);
    border-bottom:1px solid rgba(226, 232, 240, 0.8);
    padding:0 24px;
    font-family:'Plus Jakarta Sans', sans-serif;
    position:sticky;
    top:0;
    z-index:100;
  }
  #ik674d{
    position:relative;
    display:inline-block;
    width:10px;
    height:10px;
    border-radius:9999px;
    background-color:#10b981;
    box-shadow:0 0 8px rgba(16, 185, 129, 0.6);
  }
  #ialmqx{
    position:relative;
    display:flex;
    width:10px;
    height:10px;
    flex-shrink:0;
  }
  #ine5y7{
    font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size:12px;
    font-weight:700;
    color:#4338ca;
    letter-spacing:-0.01em;
  }
  #i512vr{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:6px 18px;
    border-radius:9999px;
    background:#ffffff;
    border:1px solid rgba(199, 210, 254, 0.85);
    box-shadow:0 4px 14px rgba(99, 102, 241, 0.08);
    margin-bottom:24px;
  }
  #it4laz{
    font-size:12px;
    font-weight:800;
    color:#6366f1;
    text-transform:uppercase;
    letter-spacing:2px;
    margin-bottom:20px;
  }
  #ixcpso{
    font-size:64px;
    font-weight:900;
    line-height:1.12;
    color:#09090b;
    letter-spacing:-0.035em;
    margin:0 0 24px;
    max-width:860px;
    text-wrap:balance;
  }
  #ipkadx{
    font-size:18px;
    line-height:1.65;
    color:#475569;
    max-width:680px;
    margin:0 auto 36px;
    text-wrap:balance;
  }
  #iqe6oh{
    width:20px;
    height:20px;
    flex-shrink:0;
  }
  #ikz2ee{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:14px 26px;
    border-radius:12px;
    background:linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
    color:#ffffff;
    font-size:15px;
    font-weight:700;
    text-decoration:none;
    box-shadow:0 10px 25px -4px rgba(79, 70, 229, 0.42);
    transition:transform 0.2s, box-shadow 0.2s;
  }
  #icl78p{
    width:18px;
    height:18px;
    flex-shrink:0;
    color:#4338ca;
  }
  #ifealp{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:14px 26px;
    border-radius:12px;
    background:#ffffff;
    color:#1e293b;
    font-size:15px;
    font-weight:700;
    text-decoration:none;
    border:1px solid #e2e8f0;
    box-shadow:0 4px 12px rgba(0, 0, 0, 0.04);
    transition:transform 0.2s, border-color 0.2s;
  }
  #iyequh{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:16px;
    flex-wrap:wrap;
    margin-bottom:48px;
  }
  #ia0rwb{
    width:18px;
    height:18px;
    color:#059669;
  }
  #i6chvi{
    font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size:13px;
    font-weight:600;
    color:#475569;
  }
  #i1gnqb{
    display:inline-flex;
    align-items:center;
    gap:8px;
  }
  #ifx1yy{
    width:18px;
    height:18px;
    color:#059669;
  }
  #i6rsbq{
    font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size:13px;
    font-weight:600;
    color:#475569;
  }
  #i2xmbw{
    display:inline-flex;
    align-items:center;
    gap:8px;
  }
  #ijb9ui{
    width:18px;
    height:18px;
    color:#059669;
  }
  #iwiuan{
    font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size:13px;
    font-weight:600;
    color:#475569;
  }
  #iu3lgx{
    display:inline-flex;
    align-items:center;
    gap:8px;
  }
  #idvpvf{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:32px;
    flex-wrap:wrap;
  }
  #ien03w{
    max-width:980px;
    margin:0 auto;
    position:relative;
    z-index:2;
    display:flex;
    flex-direction:column;
    align-items:center;
  }
  #gravisain{
    position:relative;
    overflow:hidden;
    padding:80px 24px 100px;
    text-align:center;
    font-family:'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    background:radial-gradient(1100px circle at 15% 15%, rgba(245, 215, 237, 0.55), transparent 50%), radial-gradient(1100px circle at 85% 85%, rgba(219, 234, 254, 0.65), transparent 50%), radial-gradient(800px circle at 50% 50%, rgba(238, 242, 255, 0.4), transparent 60%), #ffffff;
    background-image:linear-gradient(to left, rgba(168,85,247,0.21) 0%, rgba(168,85,247,0.28) 83%);
  }
  .gjs-row{
    display:flex;
    justify-content:flex-start;
    align-items:stretch;
    flex-wrap:nowrap;
    padding-top:10px;
    padding-right:10px;
    padding-bottom:10px;
    padding-left:10px;
  }
  .gjs-cell{
    min-height:75px;
    flex-grow:1;
    flex-basis:100%;
  }
  .grv-badge-tl{
    animation-duration:4.2s;
    animation-timing-function:ease-in-out;
    animation-delay:0s;
    animation-iteration-count:infinite;
    animation-direction:normal;
    animation-fill-mode:none;
    animation-play-state:running;
    animation-name:grvFloatY;
    animation-timeline:auto;
    animation-range-start:normal;
    animation-range-end:normal;
  }
  .grv-badge-tl:hover{
    transform:translateY(-9px) scale(1.03) !important;
    box-shadow:rgba(16, 185, 129, 0.2) 0px 10px 25px !important;
  }
  .grv-badge-r{
    animation-duration:4.6s;
    animation-timing-function:ease-in-out;
    animation-delay:1.2s;
    animation-iteration-count:infinite;
    animation-direction:normal;
    animation-fill-mode:none;
    animation-play-state:running;
    animation-name:grvFloatY;
    animation-timeline:auto;
    animation-range-start:normal;
    animation-range-end:normal;
  }
  .grv-badge-r:hover{
    transform:translateY(-9px) scale(1.03) !important;
    box-shadow:rgba(99, 102, 241, 0.25) 0px 10px 25px !important;
  }
  .grv-badge-b{
    animation-duration:4.4s;
    animation-timing-function:ease-in-out;
    animation-delay:0.6s;
    animation-iteration-count:infinite;
    animation-direction:normal;
    animation-fill-mode:none;
    animation-play-state:running;
    animation-name:grvFloatBottom;
    animation-timeline:auto;
    animation-range-start:normal;
    animation-range-end:normal;
  }
  .grv-badge-b:hover{
    transform:translate(-50%, -9px) scale(1.03) !important;
    box-shadow:rgba(168, 85, 247, 0.22) 0px 10px 25px !important;
  }
  .grv-btn-update{
    transition-behavior:normal !important;
    transition-duration:0.25s !important;
    transition-timing-function:cubic-bezier(0.16, 1, 0.3, 1) !important;
    transition-delay:0s !important;
    transition-property:all !important;
  }
  .grv-btn-update:hover{
    transform:translateY(-2px);
    background-image:initial !important;
    background-position-x:initial !important;
    background-position-y:initial !important;
    background-size:initial !important;
    background-repeat:initial !important;
    background-attachment:initial !important;
    background-origin:initial !important;
    background-clip:initial !important;
    background-color:rgb(79, 70, 229) !important;
    box-shadow:rgba(99, 102, 241, 0.45) 0px 6px 18px !important;
  }
  .grv-btn-update:hover .grv-rocket-icon{
    transform:rotate(-14deg) scale(1.2);
  }
  .grv-btn-update:active{
    transform:scale(0.96);
  }
  .grv-btn-primary-card{
    transition-behavior:normal !important;
    transition-duration:0.25s !important;
    transition-timing-function:cubic-bezier(0.16, 1, 0.3, 1) !important;
    transition-delay:0s !important;
    transition-property:all !important;
  }
  .grv-btn-primary-card::after{
    content:"";
    position:absolute;
    top:-50%;
    left:-70%;
    width:50%;
    height:200%;
    background-image:linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.35), transparent);
    background-position-x:initial;
    background-position-y:initial;
    background-size:initial;
    background-repeat:initial;
    background-attachment:initial;
    background-origin:initial;
    background-clip:initial;
    background-color:initial;
    transform:rotate(25deg);
    transition-behavior:normal;
    transition-duration:0.75s;
    transition-timing-function:ease;
    transition-delay:0s;
    transition-property:all;
  }
  .grv-btn-primary-card:hover{
    transform:translateY(-2px);
    box-shadow:rgba(79, 70, 229, 0.45) 0px 8px 24px -2px !important;
  }
  .grv-btn-primary-card:hover::after{
    left:140%;
  }
  .grv-btn-primary-card:active{
    transform:scale(0.97);
  }
  .grv-btn-secondary-card{
    transition-behavior:normal !important;
    transition-duration:0.25s !important;
    transition-timing-function:ease !important;
    transition-delay:0s !important;
    transition-property:all !important;
  }
  .grv-btn-secondary-card:hover{
    transform:translateY(-1px);
    border-top-color:rgb(99, 102, 241) !important;
    border-right-color:rgb(99, 102, 241) !important;
    border-bottom-color:rgb(99, 102, 241) !important;
    border-left-color:rgb(99, 102, 241) !important;
    color:rgb(79, 70, 229) !important;
    background-image:initial !important;
    background-position-x:initial !important;
    background-position-y:initial !important;
    background-size:initial !important;
    background-repeat:initial !important;
    background-attachment:initial !important;
    background-origin:initial !important;
    background-clip:initial !important;
    background-color:rgb(248, 250, 252) !important;
    box-shadow:rgba(99, 102, 241, 0.1) 0px 4px 14px !important;
  }
  .grv-btn-secondary-card:active{
    transform:scale(0.97);
  }
  .grv-block-item{
    cursor:pointer;
    transition-behavior:normal !important;
    transition-duration:0.2s !important;
    transition-timing-function:cubic-bezier(0.16, 1, 0.3, 1) !important;
    transition-delay:0s !important;
    transition-property:all !important;
  }
  .grv-block-item:hover{
    transform:translateY(-2px);
    border-top-color:rgb(199, 210, 254) !important;
    border-right-color:rgb(199, 210, 254) !important;
    border-bottom-color:rgb(199, 210, 254) !important;
    border-left-color:rgb(199, 210, 254) !important;
    background-image:initial !important;
    background-position-x:initial !important;
    background-position-y:initial !important;
    background-size:initial !important;
    background-repeat:initial !important;
    background-attachment:initial !important;
    background-origin:initial !important;
    background-clip:initial !important;
    background-color:rgb(241, 245, 249) !important;
    box-shadow:rgba(99, 102, 241, 0.15) 0px 8px 18px -2px !important;
  }
  .grv-block-item:hover svg{
    transform:scale(1.12);
    transition-behavior:normal;
    transition-duration:0.2s;
    transition-timing-function:ease;
    transition-delay:0s;
    transition-property:transform;
  }
  .grv-block-item:active{
    transform:scale(0.96);
  }
  .grv-tool-icon:hover{
    color:rgb(99, 102, 241) !important;
    transform:scale(1.2);
  }
  .grv-mac-dot:hover{
    transform:scale(1.25);
  }
  .grv-close-btn:hover{
    color:rgb(239, 68, 68) !important;
    transform:rotate(90deg);
  }
  .grv-window-frame::-webkit-scrollbar{
    height:5px;
  }
  .grv-window-frame::-webkit-scrollbar-track{
    background-image:initial;
    background-position-x:initial;
    background-position-y:initial;
    background-size:initial;
    background-repeat:initial;
    background-attachment:initial;
    background-origin:initial;
    background-clip:initial;
    background-color:rgb(248, 250, 252);
  }
  .grv-window-frame::-webkit-scrollbar-thumb{
    background-image:initial;
    background-position-x:initial;
    background-position-y:initial;
    background-size:initial;
    background-repeat:initial;
    background-attachment:initial;
    background-origin:initial;
    background-clip:initial;
    background-color:rgb(203, 213, 225);
    border-top-left-radius:9999px;
    border-top-right-radius:9999px;
    border-bottom-right-radius:9999px;
    border-bottom-left-radius:9999px;
  }
  .grv-window-frame::-webkit-scrollbar-thumb:hover{
    background-image:initial;
    background-position-x:initial;
    background-position-y:initial;
    background-size:initial;
    background-repeat:initial;
    background-attachment:initial;
    background-origin:initial;
    background-clip:initial;
    background-color:rgb(148, 163, 184);
  }
  .grv-mobile-switcher{
    display:none;
  }
  #grv-tab-b{
    display:none;
  }
  #grv-tab-c{
    display:none;
  }
  #grv-tab-s{
    display:none;
  }
  #itpf9jk{
    width:16px;
    height:16px;
    color:#10b981;
  }
  #iph4e9z{
    font-family:ui-monospace, SFMono-Regular, monospace;
    font-size:11px;
    font-weight:700;
    color:#1e293b;
  }
  #ihk85it{
    position:absolute;
    top:0px;
    left:40px;
    z-index:10;
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:#ffffff;
    padding:6px 14px;
    border-radius:9999px;
    border:1px solid #e2e8f0;
    box-shadow:0 4px 15px rgba(0, 0, 0, 0.06);
    cursor:default;
    transition:transform 0.25s ease, box-shadow 0.25s ease;
  }
  #innsx65{
    width:14px;
    height:14px;
    color:#6366f1;
  }
  #iu51lya{
    font-family:ui-monospace, SFMono-Regular, monospace;
    font-size:11px;
    font-weight:700;
    color:#1e293b;
  }
  #ibkw3im{
    position:absolute;
    top:0px;
    right:40px;
    z-index:10;
    display:inline-flex;
    align-items:center;
    gap:6px;
    background:#ffffff;
    padding:6px 14px;
    border-radius:9999px;
    border:1px solid #e2e8f0;
    box-shadow:0 4px 15px rgba(99, 102, 241, 0.1);
    white-space:nowrap;
    cursor:default;
    transition:transform 0.25s ease, box-shadow 0.25s ease;
  }
  #imbwkvo{
    width:10px;
    height:10px;
    border-radius:50%;
    background:#ef4444;
    display:inline-block;
    cursor:pointer;
    transition:transform 0.2s;
  }
  #igwfqj3{
    width:10px;
    height:10px;
    border-radius:50%;
    background:#f59e0b;
    display:inline-block;
    cursor:pointer;
    transition:transform 0.2s;
  }
  #idpu3pg{
    width:10px;
    height:10px;
    border-radius:50%;
    background:#10b981;
    display:inline-block;
    cursor:pointer;
    transition:transform 0.2s;
  }
  #ixwqbhk{
    display:flex;
    gap:6px;
  }
  #iksjhs8{
    font-family:ui-monospace, SFMono-Regular, monospace;
    font-size:11px;
    color:#64748b;
  }
  #ia6wrcc{
    display:flex;
    align-items:center;
    gap:14px;
  }
  #iej137o{
    background:#ecfdf5;
    color:#059669;
    border-radius:6px;
    padding:4px 10px;
    font-size:11px;
    font-weight:700;
    font-family:ui-monospace, monospace;
  }
  #igldzc8{
    background:#6366f1;
    color:#ffffff;
    border:none;
    border-radius:8px;
    padding:6px 14px;
    font-size:12px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:6px;
    cursor:pointer;
    box-shadow:0 2px 6px rgba(99, 102, 241, 0.3);
  }
  #ibp7cse{
    display:flex;
    align-items:center;
    gap:10px;
  }
  #\#blocks{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:14px 20px;
    background:#ffffff;
    border-bottom:1px solid #f1f5f9;
  }
  #iwxru13{
    width:13px;
    height:13px;
  }
  #ieizgc6{
    width:13px;
    height:13px;
  }
  #iuus6ei{
    width:13px;
    height:13px;
  }
  #itxwjzn{
    color:#0f172a;
    font-weight:700;
    border-bottom:2px solid #0f172a;
    padding-bottom:8px;
    margin-bottom:-9px;
    cursor:pointer;
  }
  #i7vfa95{
    color:#64748b;
    cursor:pointer;
  }
  #ih4d9vk{
    color:#64748b;
    cursor:pointer;
  }
  #iwhjjph{
    display:flex;
    gap:14px;
    font-size:12px;
    font-weight:600;
  }
  #i9xhk4h{
    color:#1e293b;
    font-size:13px;
    font-weight:700;
    cursor:pointer;
  }
  #i58ldg2{
    display:flex;
    align-items:center;
    justify-content:space-between;
    border-bottom:1px solid #e2e8f0;
    padding-bottom:8px;
    margin-bottom:12px;
  }
  #idbvzlq{
    position:absolute;
    left:10px;
    top:50%;
    transform:translateY(-50%);
    width:14px;
    height:14px;
    color:#1e293b;
  }
  #ipagd6a{
    width:100%;
    box-sizing:border-box;
    background:#ffffff;
    border:1px solid #cbd5e1;
    border-radius:4px;
    padding:6px 10px 6px 32px;
    font-size:12px;
    color:#1e293b;
    outline:none;
    transition:border-color 0.2s;
  }
  #iqy0rop{
    position:relative;
    margin-bottom:14px;
  }
  #iz910l8{
    font-size:10px;
    font-weight:800;
    color:#475569;
    letter-spacing:0.5px;
    text-transform:uppercase;
  }
  #i77blxf{
    width:14px;
    height:14px;
    color:#4338ca;
  }
  #i9panph{
    width:22px;
    height:22px;
    border:1.5px solid #4338ca;
    border-radius:4px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#eef2ff;
  }
  #i7g948v{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:12px;
  }
  #iotz0is{
    width:22px;
    height:22px;
    color:#4338ca;
    margin:0 auto 6px;
    display:block;
  }
  #iflwr5t{
    font-size:9.5px;
    font-weight:600;
    color:#1e293b;
    line-height:1.25;
  }
  #itvn3eh{
    padding:6px 2px;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
  }
  #ip551qu{
    width:22px;
    height:22px;
    color:#4338ca;
    margin:0 auto 6px;
    display:block;
  }
  #ivb099c{
    font-size:9.5px;
    font-weight:600;
    color:#1e293b;
    line-height:1.25;
  }
  #i25izfx{
    padding:6px 2px;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
  }
  #ioel33b{
    width:22px;
    height:22px;
    color:#4338ca;
    margin:0 auto 6px;
    display:block;
  }
  #ied28i6{
    font-size:9.5px;
    font-weight:600;
    color:#1e293b;
    line-height:1.25;
  }
  #isiarkm{
    padding:6px 2px;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
  }
  #i8r2okf{
    width:22px;
    height:22px;
    color:#4338ca;
    margin:0 auto 6px;
    display:block;
  }
  #itxe6xa{
    font-size:9.5px;
    font-weight:600;
    color:#1e293b;
    line-height:1.25;
  }
  #ie37orf{
    padding:6px 2px;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
  }
  #iaege77{
    width:22px;
    height:22px;
    color:#4338ca;
    margin:0 auto 6px;
    display:block;
  }
  #i0u1odk{
    font-size:9.5px;
    font-weight:600;
    color:#1e293b;
    line-height:1.25;
  }
  #ivt3ijz{
    padding:6px 2px;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
  }
  #iwb12vi{
    width:22px;
    height:22px;
    color:#4338ca;
    margin:0 auto 6px;
    display:block;
  }
  #i4rrst4{
    font-size:9.5px;
    font-weight:600;
    color:#1e293b;
    line-height:1.25;
  }
  #i9fa7p9{
    padding:6px 2px;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
  }
  #ij9a0nk{
    width:22px;
    height:22px;
    color:#4338ca;
    margin:0 auto 6px;
    display:block;
  }
  #i7piksf{
    font-size:9.5px;
    font-weight:600;
    color:#1e293b;
    line-height:1.25;
  }
  #ij5fscd{
    padding:6px 2px;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
  }
  #iv46yee{
    width:22px;
    height:22px;
    color:#4338ca;
    margin:0 auto 6px;
    display:block;
  }
  #i6881d6{
    font-size:9.5px;
    font-weight:600;
    color:#1e293b;
    line-height:1.25;
  }
  #iuks10m{
    padding:6px 2px;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
  }
  #inbgpfm{
    width:22px;
    height:22px;
    color:#4338ca;
    margin:0 auto 6px;
    display:block;
  }
  #ieamtwm{
    font-size:9.5px;
    font-weight:600;
    color:#1e293b;
    line-height:1.25;
  }
  #ijlnoux{
    padding:6px 2px;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
  }
  #il2ezuo{
    width:22px;
    height:22px;
    color:#4338ca;
    margin:0 auto 6px;
    display:block;
  }
  #iub5v17{
    font-size:9.5px;
    font-weight:600;
    color:#1e293b;
    line-height:1.25;
  }
  #isyycai{
    padding:6px 2px;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
  }
  #iiy4yug{
    width:22px;
    height:22px;
    color:#4338ca;
    margin:0 auto 6px;
    display:block;
  }
  #ir3h2jb{
    font-size:9.5px;
    font-weight:600;
    color:#1e293b;
    line-height:1.25;
  }
  #ik0wupe{
    padding:6px 2px;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
  }
  #i23o2mf{
    width:22px;
    height:22px;
    color:#4338ca;
    margin:0 auto 6px;
    display:block;
  }
  #iar81c1{
    font-size:9.5px;
    font-weight:600;
    color:#1e293b;
    line-height:1.25;
  }
  #ixrsspi{
    padding:6px 2px;
    text-align:center;
    border-radius:6px;
    cursor:pointer;
  }
  #ine17og{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:14px 6px;
    margin-bottom:16px;
  }
  #i1vxsui{
    width:10px;
    height:10px;
    color:#94a3b8;
  }
  #iawvfei{
    margin-top:auto;
    padding-top:10px;
    border-top:1px solid #f1f5f9;
    display:flex;
    align-items:center;
    gap:6px;
    font-size:11px;
    font-weight:700;
    color:#0f172a;
  }
  #grv-col-blocks{
    width:298px;
    border-right:1px solid #e2e8f0;
    padding:12px 14px;
    flex-shrink:0;
    background:#ffffff;
    display:flex;
    flex-direction:column;
    max-height:540px;
    overflow-y:auto;
    box-sizing:border-box;
  }
  #ib6wwui{
    width:14px;
    height:14px;
    color:#6366f1;
    cursor:pointer;
    transition:transform 0.2s;
  }
  #iisc9hb{
    width:14px;
    height:14px;
    color:#64748b;
    cursor:pointer;
    transition:transform 0.2s;
  }
  #i8fiv8j{
    width:14px;
    height:14px;
    color:#64748b;
    cursor:pointer;
    transition:transform 0.2s;
  }
  #i78jkrx{
    color:#cbd5e1;
    font-size:10px;
  }
  #ik52qea{
    width:14px;
    height:14px;
    color:#64748b;
    cursor:pointer;
    transition:transform 0.2s;
  }
  #izfezao{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:#f8fafc;
    border:1px solid #e2e8f0;
    border-radius:8px;
    padding:4px 10px;
    margin-bottom:18px;
    box-shadow:0 2px 4px rgba(0,0,0,0.03);
  }
  #id0jke8{
    font-size:10px;
    font-weight:800;
    color:#6366f1;
    text-transform:uppercase;
    letter-spacing:1.5px;
    margin-bottom:10px;
  }
  #ij7v25g{
    font-size:49px;
    font-weight:900;
    color:#0f172a;
    margin:0 0 12px;
    letter-spacing:-0.02em;
  }
  #ikv3rw6{
    font-size:20px;
    line-height:1.6;
    color:#64748b;
    margin:0 0 20px;
  }
  #ia1gwka{
    display:block;
    background:linear-gradient(135deg, #4f46e5, #7c3aed);
    color:#ffffff;
    border-radius:8px;
    padding:11px;
    font-size:12px;
    font-weight:700;
    text-decoration:none;
    box-shadow:0 4px 14px rgba(79, 70, 229, 0.35);
    margin-bottom:8px;
    position:relative;
    overflow:hidden;
  }
  #ic7m04a{
    display:block;
    background:#ffffff;
    border:1px solid #e2e8f0;
    color:#334155;
    border-radius:8px;
    padding:10px;
    font-size:12px;
    font-weight:700;
    text-decoration:none;
    position:relative;
    overflow:hidden;
  }
  #iqjf2gk{
    background:#ffffff;
    border-radius:20px;
    border:2px solid #ede9fe;
    box-shadow:0 15px 35px -5px rgba(139, 92, 246, 0.22);
    padding:24px 28px;
    text-align:center;
    position:relative;
    transition:box-shadow 0.3s ease, transform 0.3s ease;
  }
  #grv-col-canvas{
    flex:1;
    background:#fafafa;
    padding:24px;
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
  }
  #imtctx9{
    color:#64748b;
    cursor:pointer;
    transition:color 0.2s;
  }
  #i3jatsi{
    font-weight:300;
    opacity:0.6;
    margin-left:1px;
  }
  #ivf0eju{
    color:#0f172a;
    font-weight:700;
    border-bottom:2px solid #0f172a;
    padding-bottom:8px;
    margin-bottom:-9px;
    cursor:pointer;
  }
  #icq88jl{
    display:flex;
    gap:16px;
    font-size:12px;
    font-weight:600;
  }
  #i7lzxob{
    color:#1e293b;
    font-size:13px;
    font-weight:700;
    cursor:pointer;
  }
  #i4h925f{
    display:flex;
    align-items:center;
    justify-content:space-between;
    border-bottom:1px solid #e2e8f0;
    padding-bottom:8px;
    margin-bottom:14px;
  }
  #iup60g4{
    width:18px;
    height:18px;
  }
  #ilt4t0d{
    width:32px;
    height:32px;
    border-radius:8px;
    background:#eff6ff;
    border:1.5px solid #3b82f6;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#2563eb;
    flex-shrink:0;
  }
  #if9yjdh{
    font-size:12.5px;
    font-weight:800;
    color:#0f172a;
    line-height:1.2;
  }
  #ij34slh{
    font-size:10.5px;
    color:#64748b;
    margin-top:3px;
    line-height:1.3;
  }
  #i8fxf9j{
    display:flex;
    align-items:flex-start;
    gap:10px;
    margin-bottom:14px;
  }
  #ieb029a{
    flex:1;
    text-align:center;
    padding:7px 0;
    background:#eff6ff;
    color:#2563eb;
    font-size:11px;
    font-weight:700;
    border-bottom:2px solid #2563eb;
    margin-bottom:-1px;
    cursor:pointer;
  }
  #if9vh9f{
    flex:1;
    text-align:center;
    padding:7px 0;
    color:#64748b;
    font-size:11px;
    font-weight:600;
    cursor:pointer;
    transition:color 0.2s;
  }
  #iedtn5l{
    flex:1;
    text-align:center;
    padding:7px 0;
    color:#64748b;
    font-size:11px;
    font-weight:600;
    cursor:pointer;
    transition:color 0.2s;
  }
  #id78ff6{
    display:flex;
    border-bottom:1px solid #e2e8f0;
    margin-bottom:14px;
  }
  #i7gof0b{
    font-size:11.5px;
    font-weight:800;
    color:#0f172a;
  }
  #i4mjwv1{
    width:14px;
    height:14px;
    color:#64748b;
  }
  #iwltskb{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:10px;
    cursor:pointer;
  }
  #i9gkcqf{
    font-size:9.5px;
    font-weight:800;
    color:#1e293b;
    text-transform:uppercase;
    letter-spacing:0.5px;
    margin-bottom:5px;
  }
  #i5j1noz{
    width:100%;
    box-sizing:border-box;
    background:#ffffff;
    border:1px solid #cbd5e1;
    border-radius:4px;
    padding:6px 26px 6px 10px;
    font-size:11.5px;
    color:#1e293b;
    appearance:none;
    -webkit-appearance:none;
    outline:none;
    cursor:pointer;
  }
  #ijfkjef{
    position:absolute;
    right:8px;
    top:50%;
    transform:translateY(-50%);
    width:12px;
    height:12px;
    color:#64748b;
    pointer-events:none;
  }
  #iv0vdmd{
    position:relative;
  }
  #isi98vk{
    margin-bottom:12px;
  }
  #i7hixgg{
    font-size:9.5px;
    font-weight:800;
    color:#1e293b;
    text-transform:uppercase;
    letter-spacing:0.5px;
  }
  #iv5scb8{
    width:11px;
    height:11px;
  }
  #idoa7xi{
    width:20px;
    height:20px;
    border-radius:4px;
    border:1.5px solid #3b82f6;
    background:#eff6ff;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#2563eb;
    cursor:pointer;
  }
  #i9e368g{
    width:11px;
    height:11px;
  }
  #ihbzmcc{
    width:20px;
    height:20px;
    border-radius:4px;
    border:1px solid #e2e8f0;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#94a3b8;
    cursor:pointer;
  }
  #i68o30f{
    width:11px;
    height:11px;
  }
  #iz4rl7k{
    width:20px;
    height:20px;
    border-radius:4px;
    border:1px solid #e2e8f0;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#94a3b8;
    cursor:pointer;
  }
  #if2qti4{
    display:flex;
    gap:4px;
  }
  #i9h0gci{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:6px;
  }
  #i9r3iua{
    width:13px;
    height:13px;
  }
  #ilhkq1k{
    flex:1;
    padding:5px 0;
    text-align:center;
    color:#64748b;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
  }
  #iolcbq9{
    width:13px;
    height:13px;
  }
  #it85lxh{
    flex:1;
    padding:5px 0;
    text-align:center;
    background:#ffffff;
    border-radius:5px;
    box-shadow:0 1px 3px rgba(0,0,0,0.08);
    color:#2563eb;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
  }
  #imtbiep{
    width:13px;
    height:13px;
  }
  #ikzd30s{
    flex:1;
    padding:5px 0;
    text-align:center;
    color:#64748b;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
  }
  #i32d0le{
    display:flex;
    background:#f1f5f9;
    border-radius:6px;
    padding:2px;
  }
  #igtdq0q{
    margin-bottom:14px;
  }
  #iladrw6{
    font-size:9.5px;
    font-weight:800;
    color:#1e293b;
    text-transform:uppercase;
    letter-spacing:0.5px;
    margin-bottom:6px;
  }
  #i25dz9f{
    width:10px;
    height:10px;
    border-radius:50%;
    background:#2563eb;
    position:absolute;
    left:0;
    top:-3px;
    box-shadow:0 0 0 3px rgba(37, 99, 235, 0.2);
  }
  #imuk61h{
    width:100%;
    height:4px;
    background:#e2e8f0;
    border-radius:2px;
    position:relative;
  }
  #infpk8n{
    flex:1;
    position:relative;
    display:flex;
    align-items:center;
  }
  #i7ihuwj{
    width:50px;
    box-sizing:border-box;
    background:#ffffff;
    border:1px solid #cbd5e1;
    border-radius:4px;
    padding:4px 6px;
    font-size:11.5px;
    font-weight:700;
    color:#1e293b;
    text-align:center;
    outline:none;
  }
  #i46mvmi{
    background:#ffffff;
    border:1px solid #3b82f6;
    color:#2563eb;
    border-radius:4px;
    padding:4px 8px;
    font-size:11px;
    font-weight:700;
    cursor:pointer;
    transition:all 0.2s ease;
  }
  #isu1kd4{
    display:flex;
    align-items:center;
    gap:8px;
  }
  #ioo7fy8{
    font-size:9.5px;
    color:#64748b;
    margin-top:5px;
    line-height:1.3;
  }
  #iyqkdvl{
    margin-bottom:6px;
  }
  #iyk03hm{
    margin-bottom:14px;
  }
  #idl9cs7{
    font-size:11.5px;
    font-weight:800;
    color:#0f172a;
  }
  #icwvscl{
    width:13px;
    height:13px;
    color:#64748b;
  }
  #innef5i{
    border-top:1px solid #f1f5f9;
    padding:10px 0;
    display:flex;
    align-items:center;
    justify-content:space-between;
    cursor:pointer;
  }
  #ius1gng{
    font-size:11.5px;
    font-weight:800;
    color:#0f172a;
  }
  #ifrp0op{
    width:13px;
    height:13px;
    color:#64748b;
  }
  #ih7tre3{
    border-top:1px solid #f1f5f9;
    padding:10px 0;
    display:flex;
    align-items:center;
    justify-content:space-between;
    cursor:pointer;
  }
  #grv-col-settings{
    width:303px;
    border-left:1px solid #e2e8f0;
    padding:12px 14px;
    flex-shrink:0;
    background:#ffffff;
    position:relative;
    max-height:540px;
    overflow-y:auto;
    box-sizing:border-box;
  }
  #iv4oyqb{
    display:flex;
    min-height:520px;
    background:#ffffff;
  }
  #i9xh1wj{
    background:#ffffff;
    border-radius:24px;
    border:1px solid #e2e8f0;
    box-shadow:0 25px 60px -15px rgba(99, 102, 241, 0.12), 0 10px 25px -5px rgba(0, 0, 0, 0.04);
    overflow:hidden;
    position:relative;
  }
  #in2o02z{
    width:16px;
    height:16px;
    color:#a855f7;
  }
  #iiy9s8p{
    font-family:ui-monospace, SFMono-Regular, monospace;
    font-size:11px;
    font-weight:700;
    color:#1e293b;
  }
  #i6p9e12{
    position:absolute;
    bottom:0px;
    left:50%;
    transform:translateX(-50%);
    z-index:10;
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:#ffffff;
    padding:6px 16px;
    border-radius:9999px;
    border:1px solid #e2e8f0;
    box-shadow:0 4px 15px rgba(0, 0, 0, 0.06);
    white-space:nowrap;
    cursor:default;
    transition:transform 0.25s ease, box-shadow 0.25s ease;
  }
  #blocks{
    position:relative;
    margin:40px 24px 60px 24px;
    padding:20px;
    font-family:'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
  }
  #iho7i5{
    flex-basis:70%;
  }
  #ib218x{
    float:none;
    margin:62px 35px 0px 0px;
  }
  .grv-card:hover{
    transform:translateY(-6px);
  }
  .grv-card-php:hover{
    box-shadow:rgba(0, 0, 0, 0.08) 0px 20px 40px -10px, rgba(0, 0, 0, 0.03) 0px 8px 16px !important;
  }
  .grv-card-hybrid:hover{
    box-shadow:rgba(74, 78, 90, 0.5) 0px 24px 45px -10px !important;
  }
  .grv-card-gutenberg:hover{
    box-shadow:rgba(93, 82, 229, 0.6) 0px 24px 50px -10px !important;
  }
  .grv-brand-badge:hover{
    transform:translateY(-2px);
    box-shadow:rgba(79, 70, 229, 0.55) 0px 14px 28px -4px !important;
  }
  .grv-pulse-node{
    transform-origin:500px 18px;
    animation-duration:2.8s;
    animation-timing-function:ease-in-out;
    animation-delay:0s;
    animation-iteration-count:infinite;
    animation-direction:normal;
    animation-fill-mode:none;
    animation-play-state:running;
    animation-name:grvPulse;
    animation-timeline:auto;
    animation-range-start:normal;
    animation-range-end:normal;
  }
  #ills3i{
    width:18px;
    height:18px;
  }
  #i5ai2j{
    font-size:13.5px;
    font-weight:800;
    letter-spacing:1.2px;
    text-transform:uppercase;
  }
  #ituc4p{
    display:inline-flex;
    align-items:center;
    gap:10px;
    background:linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
    color:#ffffff;
    padding:9px 24px;
    border-radius:12px;
    box-shadow:0 10px 25px -4px rgba(79, 70, 229, 0.45), 0 4px 10px rgba(0, 0, 0, 0.05);
    z-index:5;
    cursor:default;
    transition:transform 0.25s ease, box-shadow 0.25s ease;
  }
  #i2357h{
    width:100%;
    height:100%;
    display:block;
    overflow:visible;
  }
  #i6928c{
    width:100%;
    height:42px;
    position:relative;
    margin-top:-1px;
  }
  #ix2vmg{
    display:flex;
    flex-direction:column;
    align-items:center;
    position:relative;
  }
  #icjfml{
    width:40px;
    height:40px;
    border-radius:12px;
    background:#f3e8ff;
    color:#7e22ce;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:13.5px;
    font-weight:800;
    font-family:'JetBrains Mono', monospace;
    flex-shrink:0;
    box-shadow:inset 0 0 0 1px rgba(126, 34, 206, 0.1);
  }
  #ittl8g{
    margin:0;
    font-size:19px;
    font-weight:800;
    color:#0f172a;
    letter-spacing:-0.01em;
  }
  #iy46vf{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:26px;
  }
  #iaibb3{
    width:17px;
    height:17px;
    color:#4338ca;
    flex-shrink:0;
  }
  #i6ctin{
    font-size:14px;
    font-weight:700;
    color:#334155;
  }
  #i2lmrh{
    display:flex;
    align-items:center;
    gap:12px;
  }
  #iytl21{
    width:17px;
    height:17px;
    color:#4338ca;
    flex-shrink:0;
  }
  #id8evx{
    font-size:14px;
    font-weight:700;
    color:#334155;
  }
  #in6xi7{
    display:flex;
    align-items:center;
    gap:12px;
  }
  #ir0u4w{
    width:17px;
    height:17px;
    color:#4338ca;
    flex-shrink:0;
  }
  #ixzysj{
    font-size:14px;
    font-weight:700;
    color:#334155;
  }
  #iyzj7j{
    display:flex;
    align-items:center;
    gap:12px;
  }
  #ij17r3{
    width:17px;
    height:17px;
    color:#4338ca;
    flex-shrink:0;
  }
  #igafe9{
    font-size:14px;
    font-weight:700;
    color:#334155;
  }
  #icxq3u{
    display:flex;
    align-items:center;
    gap:12px;
  }
  #il2ae1{
    display:flex;
    flex-direction:column;
    gap:15px;
    margin-bottom:30px;
  }
  #ikcsyv{
    color:#64748b;
    font-weight:600;
  }
  #idwolw{
    color:#059669;
    font-weight:700;
  }
  #ignpny{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding-top:14px;
    font-family:'JetBrains Mono', monospace;
    font-size:11px;
  }
  #ia8sai{
    background:#ffffff;
    border-radius:20px;
    border:1px solid #edf2f7;
    box-shadow:0 12px 30px -8px rgba(0, 0, 0, 0.05), 0 4px 10px rgba(0, 0, 0, 0.02);
    padding:30px 26px 26px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    transition:transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
    box-sizing:border-box;
  }
  #ijk4ye{
    margin:0 0 6px;
    font-size:21px;
    font-weight:800;
    color:#ffffff;
    letter-spacing:-0.01em;
  }
  #innuze{
    font-size:13.5px;
    font-weight:700;
    color:#d8b4fe;
    margin-bottom:22px;
    letter-spacing:0.2px;
  }
  #irpwlj{
    margin:0 auto 28px;
    font-size:12.5px;
    line-height:1.68;
    color:#cbd5e1;
    max-width:260px;
  }
  #ispu9f{
    display:inline-block;
    background:rgba(255, 255, 255, 0.08);
    border:1px solid rgba(255, 255, 255, 0.16);
    border-radius:9999px;
    padding:6px 16px;
    font-size:11px;
    font-weight:600;
    color:#f1f5f9;
    font-family:'JetBrains Mono', monospace;
    letter-spacing:0.2px;
  }
  #i3ceh7{
    margin-top:auto;
    padding-top:12px;
  }
  #i6948z{
    background:#4a4e5a;
    border-radius:20px;
    box-shadow:0 16px 36px -10px rgba(74, 78, 90, 0.4), 0 6px 14px rgba(0, 0, 0, 0.08);
    padding:34px 24px 26px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    text-align:center;
    color:#ffffff;
    transition:transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
    box-sizing:border-box;
  }
  #icm3ct{
    width:20px;
    height:20px;
    color:#ffffff;
  }
  #i2m01g{
    width:40px;
    height:40px;
    border-radius:12px;
    background:rgba(255, 255, 255, 0.18);
    border:1px solid rgba(255, 255, 255, 0.25);
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    box-shadow:0 4px 12px rgba(0, 0, 0, 0.06);
  }
  #iqmciw{
    margin:0;
    font-size:19px;
    font-weight:800;
    color:#ffffff;
    letter-spacing:-0.01em;
  }
  #iyaq5i{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:26px;
  }
  #iz42o3{
    width:17px;
    height:17px;
    color:#ffffff;
    flex-shrink:0;
  }
  #i8pz07{
    font-size:14px;
    font-weight:700;
    color:#ffffff;
  }
  #iy8eji{
    display:flex;
    align-items:center;
    gap:12px;
  }
  #iilja1{
    width:17px;
    height:17px;
    color:#ffffff;
    flex-shrink:0;
  }
  #i026q5{
    font-size:14px;
    font-weight:700;
    color:#ffffff;
  }
  #imj5xh{
    display:flex;
    align-items:center;
    gap:12px;
  }
  #idzaxa{
    width:17px;
    height:17px;
    color:#ffffff;
    flex-shrink:0;
  }
  #ix228d{
    font-size:14px;
    font-weight:700;
    color:#ffffff;
  }
  #i5a2vu{
    display:flex;
    align-items:center;
    gap:12px;
  }
  #irtacg{
    width:17px;
    height:17px;
    color:#ffffff;
    flex-shrink:0;
  }
  #ic7h92{
    font-size:14px;
    font-weight:700;
    color:#ffffff;
  }
  #i45tyr{
    display:flex;
    align-items:center;
    gap:12px;
  }
  #i1pzyt{
    display:flex;
    flex-direction:column;
    gap:15px;
    margin-bottom:30px;
  }
  #iu1uf5{
    color:rgba(255, 255, 255, 0.85);
    font-weight:600;
  }
  #i0rmzs{
    color:#ffffff;
    font-weight:700;
  }
  #ivotyf{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding-top:14px;
    font-family:'JetBrains Mono', monospace;
    font-size:11px;
  }
  #ilua3b{
    background:linear-gradient(145deg, #4840d6 0%, #5d52e5 50%, #763ced 100%);
    border-radius:20px;
    box-shadow:0 18px 40px -8px rgba(93, 82, 229, 0.45), 0 6px 14px rgba(0, 0, 0, 0.08);
    padding:30px 26px 26px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    color:#ffffff;
    transition:transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
    box-sizing:border-box;
  }
  #iyizmp{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:24px;
    align-items:stretch;
    margin-top:2px;
  }
  #iqig07{
    width:100%;
    max-width:1060px;
    margin:0 auto;
    box-sizing:border-box;
  }
  #i388{
    background-color:#faf7ff;
  }
  #i8r2k6{
    float:none;
  }
  #architecture{
    --tw-border-spacing-y:0;
    --tw-translate-x:0;
    --tw-translate-y:0;
    --tw-rotate:0;
    --tw-skew-x:0;
    --tw-skew-y:0;
    --tw-scale-x:1;
    --tw-scale-y:1;
    --tw-scroll-snap-strictness:proximity;
    --tw-ring-offset-width:0px;
    --tw-ring-offset-color:#fff;
    --tw-ring-color:rgb(59 130 246 / 0.5);
    --tw-ring-offset-shadow:0 0 #0000;
    --tw-ring-shadow:0 0 #0000;
    --tw-shadow:0 0 #0000;
    --tw-shadow-colored:0 0 #0000;
    border-color:rgb(229, 231, 235);
    font-family:"JetBrains Mono";
    --tw-text-opacity:1;
    color:rgb(126, 34, 206);
    text-align:center;
  }
  #i797u2{
    --tw-border-spacing-y:0;
    --tw-translate-x:0;
    --tw-translate-y:0;
    --tw-rotate:0;
    --tw-skew-x:0;
    --tw-skew-y:0;
    --tw-scale-x:1;
    --tw-scale-y:1;
    --tw-scroll-snap-strictness:proximity;
    --tw-ring-offset-width:0px;
    --tw-ring-offset-color:#fff;
    --tw-ring-color:rgb(59 130 246 / 0.5);
    --tw-ring-offset-shadow:0 0 #0000;
    --tw-ring-shadow:0 0 #0000;
    --tw-shadow:0 0 #0000;
    --tw-shadow-colored:0 0 #0000;
    border-color:rgb(229, 231, 235);
    font-size:40px;
    font-family:"Plus Jakarta Sans";
    line-height:48px;
    letter-spacing:-0.02em;
    --tw-text-opacity:1;
    color:rgb(15, 23, 42);
    text-align:center;
  }
  #ii66aj{
    --tw-border-spacing-y:0;
    --tw-translate-x:0;
    --tw-translate-y:0;
    --tw-rotate:0;
    --tw-skew-x:0;
    --tw-skew-y:0;
    --tw-scale-x:1;
    --tw-scale-y:1;
    --tw-scroll-snap-strictness:proximity;
    --tw-ring-offset-width:0px;
    --tw-ring-offset-color:#fff;
    --tw-ring-color:rgb(59 130 246 / 0.5);
    --tw-ring-offset-shadow:0 0 #0000;
    --tw-ring-shadow:0 0 #0000;
    --tw-shadow:0 0 #0000;
    --tw-shadow-colored:0 0 #0000;
    border-color:rgb(229, 231, 235);
    font-size:40px;
    font-family:"Plus Jakarta Sans";
    line-height:48px;
    letter-spacing:-0.02em;
    --tw-text-opacity:1;
    color:rgb(15, 23, 42);
    text-align:center;
    background-color:rgb(250, 247, 255);
  }
  #ifcx4u{
    --tw-border-spacing-y:0;
    --tw-translate-x:0;
    --tw-translate-y:0;
    --tw-rotate:0;
    --tw-skew-x:0;
    --tw-skew-y:0;
    --tw-scale-x:1;
    --tw-scale-y:1;
    --tw-scroll-snap-strictness:proximity;
    --tw-ring-offset-width:0px;
    --tw-ring-offset-color:#fff;
    --tw-ring-color:rgb(59 130 246 / 0.5);
    --tw-ring-offset-shadow:0 0 #0000;
    --tw-ring-shadow:0 0 #0000;
    --tw-shadow:0 0 #0000;
    --tw-shadow-colored:0 0 #0000;
    border-color:rgb(229, 231, 235);
    font-family:"JetBrains Mono";
    --tw-text-opacity:1;
    color:rgb(126, 34, 206);
    text-align:center;
    font-weight:600;
  }
  #irkgbm{
    color:rgb(219, 39, 119);
    font-family:Inter;
    font-size:15px;
  }
  #i7glil-3{
    color:#475569;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
  }
  #iwdzlm{
    background-image:linear-gradient(to right, rgba(239,68,68,0.06) 0%, rgba(232,68,150,0.13) 100%);
  }
  html{
    scroll-behavior:smooth;
  }
  :target, [id]{
    scroll-margin-top:85px;
  }
  .grv-bento-grid{
    display:grid;
    grid-template-columns:repeat(12, 1fr);
    row-gap:24px;
    column-gap:24px;
  }
  .grv-span-8{
    grid-column-start:span 8;
    grid-column-end:auto;
  }
  .grv-span-4{
    grid-column-start:span 4;
    grid-column-end:auto;
  }
  .grv-bento-card:hover{
    transform:translateY(-5px);
    box-shadow:rgba(124, 58, 237, 0.12) 0px 20px 40px -10px !important;
    border-top-color:rgb(216, 180, 254) !important;
    border-right-color:rgb(216, 180, 254) !important;
    border-bottom-color:rgb(216, 180, 254) !important;
    border-left-color:rgb(216, 180, 254) !important;
  }
  #i4u6dj{
    width:15px;
    height:15px;
    color:#514bf0;
  }
  #i5k3wd{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:rgba(243, 232, 255, 0.85);
    border:1px solid #e9d5ff;
    color:#514bf0;
    padding:6px 16px;
    border-radius:9999px;
    font-size:12px;
    font-weight:700;
    font-family:ui-monospace, SFMono-Regular, monospace;
    margin-bottom:16px;
  }
  #iv1hvg{
    font-size:38px;
    font-weight:900;
    color:#0f172a;
    margin:0 0 16px;
    letter-spacing:-0.025em;
    line-height:1.18;
  }
  #id07ho{
    font-size:15px;
    line-height:1.65;
    color:#64748b;
    margin:0;
    font-weight:400;
  }
  #i2vpso{
    text-align:center;
    max-width:760px;
    margin:0 auto 56px;
  }
  #iyscbk{
    width:24px;
    height:24px;
  }
  #ii36me{
    width:48px;
    height:48px;
    border-radius:14px;
    background:#faf5ff;
    border:1px solid #f3e8ff;
    color:#514bf0;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:24px;
  }
  #irglak{
    font-size:11px;
    font-weight:800;
    color:#514bf0;
    text-transform:uppercase;
    letter-spacing:1.2px;
    font-family:ui-monospace, monospace;
  }
  #ie8eoh{
    font-size:24px;
    font-weight:800;
    color:#0f172a;
    margin:8px 0 12px;
    letter-spacing:-0.015em;
  }
  #ixv6nt{
    font-size:14.5px;
    line-height:1.6;
    color:#64748b;
    margin:0;
    max-width:620px;
  }
  #inlxwn{
    width:14px;
    height:14px;
    color:#10b981;
  }
  #i1y7ah{
    display:flex;
    align-items:center;
    gap:8px;
    color:#f8fafc;
    font-family:ui-monospace, monospace;
    font-size:12px;
    font-weight:600;
  }
  #iw3x8p{
    font-size:10px;
    color:#94a3b8;
    font-family:ui-monospace, monospace;
  }
  #irc791{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding-bottom:12px;
    margin-bottom:14px;
    border-bottom:1px solid #1e293b;
  }
  #igr83l{
    margin:0;
    font-family:'JetBrains Mono', ui-monospace, monospace;
    font-size:12px;
    color:#a5b4fc;
    line-height:1.6;
    overflow-x:auto;
    white-space:pre-wrap;
  }
  #ilwn8x{
    margin-top:32px;
    border-radius:14px;
    background:#0f172a;
    border:1px solid #1e293b;
    padding:18px 20px;
    box-shadow:0 4px 15px rgba(0, 0, 0, 0.2);
    box-sizing:border-box;
  }
  #ip2jbz{
    background:rgba(255, 255, 255, 0.95);
    border-radius:20px;
    border:1px solid #f1f0fb;
    padding:32px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    box-shadow:0 10px 30px rgba(124, 58, 237, 0.05);
    transition:transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    box-sizing:border-box;
  }
  #iqh5t1{
    width:24px;
    height:24px;
  }
  #is0hto{
    width:48px;
    height:48px;
    border-radius:14px;
    background:#ecfdf5;
    border:1px solid #d1fae5;
    color:#059669;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:24px;
  }
  #itk74o{
    font-size:11px;
    font-weight:800;
    color:#059669;
    text-transform:uppercase;
    letter-spacing:1.2px;
    font-family:ui-monospace, monospace;
  }
  #i53x6w{
    font-size:24px;
    font-weight:800;
    color:#0f172a;
    margin:8px 0 12px;
    letter-spacing:-0.015em;
  }
  #iq45xh{
    font-size:13.5px;
    line-height:1.6;
    color:#64748b;
    margin:0;
  }
  #i6ccgy{
    color:#475569;
    font-weight:600;
  }
  #i4tzxv{
    color:#059669;
    font-weight:800;
    font-family:ui-monospace, monospace;
  }
  #ibabhk{
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:12px;
    margin-bottom:10px;
  }
  #iizo97{
    width:12%;
    height:100%;
    background:#059669;
    border-radius:9999px;
  }
  #ivw29f{
    width:100%;
    height:8px;
    background:#e2e8f0;
    border-radius:9999px;
    overflow:hidden;
  }
  #im6o1f{
    font-size:10px;
    color:#64748b;
    display:block;
    margin-top:8px;
    font-family:ui-monospace, monospace;
  }
  #ijjzbi{
    margin-top:32px;
    padding:16px;
    border-radius:14px;
    background:#f8fafc;
    border:1px solid #e2e8f0;
  }
  #ilqis1{
    background:rgba(255, 255, 255, 0.95);
    border-radius:20px;
    border:1px solid #f1f0fb;
    padding:32px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    box-shadow:0 10px 30px rgba(124, 58, 237, 0.05);
    transition:transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    box-sizing:border-box;
  }
  #ibo03l{
    width:24px;
    height:24px;
  }
  #ij0p0x{
    width:48px;
    height:48px;
    border-radius:14px;
    background:#faf5ff;
    border:1px solid #f3e8ff;
    color:#7c3aed;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:24px;
  }
  #in0k1z{
    font-size:11px;
    font-weight:800;
    color:#7c3aed;
    text-transform:uppercase;
    letter-spacing:1.2px;
    font-family:ui-monospace, monospace;
  }
  #i7gko4{
    font-size:20px;
    font-weight:800;
    color:#0f172a;
    margin:8px 0 12px;
    letter-spacing:-0.015em;
  }
  #ix7dic{
    font-size:13.5px;
    line-height:1.6;
    color:#64748b;
    margin:0;
  }
  #imp1ez{
    width:18px;
    height:18px;
    color:#059669;
    flex-shrink:0;
  }
  #i1mkzh{
    font-size:12px;
    font-family:ui-monospace, monospace;
    color:#1e293b;
    font-weight:700;
  }
  #i6dtzl{
    margin-top:32px;
    display:flex;
    align-items:center;
    gap:10px;
    padding:14px;
    border-radius:14px;
    background:#f8fafc;
    border:1px solid #e2e8f0;
  }
  #i8aq9k{
    background:rgba(255, 255, 255, 0.95);
    border-radius:20px;
    border:1px solid #f1f0fb;
    padding:32px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    box-shadow:0 10px 30px rgba(124, 58, 237, 0.05);
    transition:transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    box-sizing:border-box;
  }
  #i5egnj{
    width:24px;
    height:24px;
  }
  #iiwfnt{
    width:48px;
    height:48px;
    border-radius:14px;
    background:#eff6ff;
    border:1px solid #dbeafe;
    color:#2563eb;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:24px;
  }
  #i4zh3j{
    font-size:11px;
    font-weight:800;
    color:#2563eb;
    text-transform:uppercase;
    letter-spacing:1.2px;
    font-family:ui-monospace, monospace;
  }
  #ih3nf8{
    font-size:20px;
    font-weight:800;
    color:#0f172a;
    margin:8px 0 12px;
    letter-spacing:-0.015em;
  }
  #ijdwnx{
    font-size:13.5px;
    line-height:1.6;
    color:#64748b;
    margin:0;
  }
  #ikki3c{
    color:#64748b;
  }
  #if96dy{
    color:#64748b;
  }
  #i822cp{
    color:#2563eb;
    font-weight:800;
    background:#eff6ff;
    padding:2px 8px;
    border-radius:6px;
  }
  #i41k07{
    color:#64748b;
  }
  #i7juc8{
    margin-top:32px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:12px 14px;
    border-radius:14px;
    background:#f8fafc;
    border:1px solid #e2e8f0;
    font-family:ui-monospace, monospace;
    font-size:12px;
  }
  #iidc4f{
    background:rgba(255, 255, 255, 0.95);
    border-radius:20px;
    border:1px solid #f1f0fb;
    padding:32px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    box-shadow:0 10px 30px rgba(124, 58, 237, 0.05);
    transition:transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    box-sizing:border-box;
  }
  #i0zzvs{
    width:24px;
    height:24px;
  }
  #iismjl{
    width:48px;
    height:48px;
    border-radius:14px;
    background:#f1f5f9;
    border:1px solid #e2e8f0;
    color:#334155;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:24px;
  }
  #icihu8{
    font-size:11px;
    font-weight:800;
    color:#64748b;
    text-transform:uppercase;
    letter-spacing:1.2px;
    font-family:ui-monospace, monospace;
  }
  #iimk57{
    font-size:20px;
    font-weight:800;
    color:#0f172a;
    margin:8px 0 12px;
    letter-spacing:-0.015em;
  }
  #i6i1ml{
    font-size:13.5px;
    line-height:1.6;
    color:#64748b;
    margin:0;
  }
  #i39u5i{
    font-size:12px;
    font-family:ui-monospace, monospace;
    color:#334155;
    font-weight:700;
  }
  #ibaguk{
    width:8px;
    height:8px;
    border-radius:50%;
    background:#10b981;
    display:inline-block;
    box-shadow:0 0 8px rgba(16, 185, 129, 0.6);
  }
  #iaotks{
    margin-top:32px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:14px;
    border-radius:14px;
    background:#f8fafc;
    border:1px solid #e2e8f0;
  }
  #iimdch{
    background:rgba(255, 255, 255, 0.95);
    border-radius:20px;
    border:1px solid #f1f0fb;
    padding:32px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    box-shadow:0 10px 30px rgba(124, 58, 237, 0.05);
    transition:transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    box-sizing:border-box;
  }
  #itgsxx{
    max-width:1240px;
    margin:40px auto;
    padding:20px 24px;
    font-family:'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
    -webkit-font-smoothing:antialiased;
    box-sizing:border-box;
  }
  details.grv-faq-item summary::-webkit-details-marker{
    display:none;
  }
  details.grv-faq-item[open] .grv-faq-icon{
    transform:rotate(180deg);
  }
  details.grv-faq-item:hover{
    border-top-color:rgb(216, 180, 254) !important;
    border-right-color:rgb(216, 180, 254) !important;
    border-bottom-color:rgb(216, 180, 254) !important;
    border-left-color:rgb(216, 180, 254) !important;
  }
  .grv-product-card:hover{
    transform:translateY(-6px);
    box-shadow:rgba(79, 70, 229, 0.14) 0px 20px 45px -10px !important;
    border-top-color:rgb(199, 210, 254) !important;
    border-right-color:rgb(199, 210, 254) !important;
    border-bottom-color:rgb(199, 210, 254) !important;
    border-left-color:rgb(199, 210, 254) !important;
  }
  #i7e3bld{
    width:14px;
    height:14px;
    color:#514bf0;
  }
  #i9hryem{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:rgba(243, 232, 255, 0.85);
    border:1px solid #e9d5ff;
    color:#514bf0;
    padding:6px 16px;
    border-radius:9999px;
    font-size:11px;
    font-weight:800;
    text-transform:uppercase;
    letter-spacing:1.5px;
    font-family:ui-monospace, SFMono-Regular, monospace;
    margin-bottom:14px;
  }
  #ilnd84k{
    font-size:36px;
    font-weight:900;
    color:#0f172a;
    margin:0 0 14px;
    letter-spacing:-0.025em;
    line-height:1.18;
  }
  #isafg4f{
    font-size:15px;
    line-height:1.6;
    color:#64748b;
    margin:0;
    font-weight:400;
  }
  #iq6god2{
    text-align:center;
    max-width:720px;
    margin:0 auto 56px;
  }
  #i4n6e96{
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:5px;
    background:linear-gradient(90deg, #6366f1, #8b5cf6, #6366f1);
  }
  #iyv9cen{
    padding:4px 10px;
    font-size:11px;
    font-weight:700;
    border-radius:8px;
    background:#eef2ff;
    color:#4338ca;
    border:1px solid #e0e7ff;
    font-family:ui-monospace, monospace;
  }
  #i49k9vg{
    padding:4px 10px;
    font-size:11px;
    font-weight:800;
    border-radius:8px;
    background:#ecfdf5;
    color:#047857;
    border:1px solid #a7f3d0;
  }
  #i91e50h{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:8px;
    margin-bottom:16px;
  }
  #ivamrsp{
    font-size:21px;
    font-weight:900;
    color:#0f172a;
    margin:0 0 8px;
    letter-spacing:-0.015em;
  }
  #iaolp7n{
    font-size:13px;
    line-height:1.55;
    color:#64748b;
    margin:0 0 20px;
    min-height:40px;
  }
  #iqlvvmq{
    width:15px;
    height:15px;
    color:#10b981;
    flex-shrink:0;
  }
  #i0mylqo{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    color:#334155;
    font-weight:500;
  }
  #iiz09if{
    width:15px;
    height:15px;
    color:#10b981;
    flex-shrink:0;
  }
  #ix52oge{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    color:#334155;
    font-weight:500;
  }
  #inbg6fs{
    width:15px;
    height:15px;
    color:#10b981;
    flex-shrink:0;
  }
  #iv4gvkj{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    color:#334155;
    font-weight:500;
  }
  #iciucwy{
    padding-top:16px;
    border-top:1px solid #f1f5f9;
    display:flex;
    flex-direction:column;
    gap:10px;
  }
  #i1tfio8{
    margin-bottom:16px;
  }
  #ieaac9x{
    width:14px;
    height:14px;
  }
  #i4c8xfi{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    padding:11px 16px;
    border-radius:12px;
    background:#4f46e5;
    color:#ffffff;
    font-size:12.5px;
    font-weight:700;
    text-decoration:none;
    box-shadow:0 4px 12px rgba(79, 70, 229, 0.25);
    transition:all 0.2s ease;
  }
  #i2fnhej{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    padding:9px 16px;
    border-radius:12px;
    background:#f8fafc;
    border:1px solid #e2e8f0;
    color:#334155;
    font-size:12px;
    font-weight:700;
    text-decoration:none;
    transition:all 0.2s ease;
  }
  #i53j8um{
    display:flex;
    flex-direction:column;
    gap:8px;
  }
  #i5hifkm{
    margin-top:24px;
    padding-top:18px;
    border-top:1px solid #f1f5f9;
  }
  #ixr6nyq{
    background:#ffffff;
    border-radius:24px;
    border:1px solid #e2e8f0;
    padding:28px 24px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    position:relative;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(15, 23, 42, 0.04);
    transition:all 0.3s ease;
    box-sizing:border-box;
  }
  #ivkbvr9{
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:5px;
    background:linear-gradient(90deg, #6366f1, #8b5cf6, #6366f1);
  }
  #idtqxyi{
    padding:4px 10px;
    font-size:11px;
    font-weight:700;
    border-radius:8px;
    background:#eef2ff;
    color:#4338ca;
    border:1px solid #e0e7ff;
    font-family:ui-monospace, monospace;
  }
  #isr1m9t{
    padding:4px 10px;
    font-size:11px;
    font-weight:800;
    border-radius:8px;
    background:#ecfdf5;
    color:#047857;
    border:1px solid #a7f3d0;
  }
  #ibd5mkq{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:8px;
    margin-bottom:16px;
  }
  #iikfa5d{
    font-size:21px;
    font-weight:900;
    color:#0f172a;
    margin:0 0 8px;
    letter-spacing:-0.015em;
  }
  #izj9waw{
    font-size:13px;
    line-height:1.55;
    color:#64748b;
    margin:0 0 20px;
    min-height:40px;
  }
  #ihwovgq{
    width:15px;
    height:15px;
    color:#10b981;
    flex-shrink:0;
  }
  #i918v8b{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    color:#334155;
    font-weight:500;
  }
  #ivowsqj{
    width:15px;
    height:15px;
    color:#10b981;
    flex-shrink:0;
  }
  #ifscsi6{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    color:#334155;
    font-weight:500;
  }
  #itq5bpa{
    width:15px;
    height:15px;
    color:#10b981;
    flex-shrink:0;
  }
  #ipsfzuy{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    color:#334155;
    font-weight:500;
  }
  #iugmsa8{
    padding-top:16px;
    border-top:1px solid #f1f5f9;
    display:flex;
    flex-direction:column;
    gap:10px;
  }
  #ixs5kq4{
    margin-bottom:16px;
  }
  #idlps6h{
    width:14px;
    height:14px;
  }
  #iebf1w6{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    padding:11px 16px;
    border-radius:12px;
    background:#4f46e5;
    color:#ffffff;
    font-size:12.5px;
    font-weight:700;
    text-decoration:none;
    box-shadow:0 4px 12px rgba(79, 70, 229, 0.25);
    transition:all 0.2s ease;
  }
  #inxhg5x{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    padding:9px 16px;
    border-radius:12px;
    background:#f8fafc;
    border:1px solid #e2e8f0;
    color:#334155;
    font-size:12px;
    font-weight:700;
    text-decoration:none;
    transition:all 0.2s ease;
  }
  #im43lfv{
    display:flex;
    flex-direction:column;
    gap:8px;
  }
  #iao9n5h{
    margin-top:24px;
    padding-top:18px;
    border-top:1px solid #f1f5f9;
  }
  #ii9fpd5{
    background:#ffffff;
    border-radius:24px;
    border:1px solid #e2e8f0;
    padding:28px 24px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    position:relative;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(15, 23, 42, 0.04);
    transition:all 0.3s ease;
    box-sizing:border-box;
  }
  #iivjb3d{
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:5px;
    background:linear-gradient(90deg, #6366f1, #8b5cf6, #6366f1);
  }
  #i3qk7a7{
    padding:4px 10px;
    font-size:11px;
    font-weight:700;
    border-radius:8px;
    background:#eef2ff;
    color:#4338ca;
    border:1px solid #e0e7ff;
    font-family:ui-monospace, monospace;
  }
  #i4ykrzd{
    padding:4px 10px;
    font-size:11px;
    font-weight:800;
    border-radius:8px;
    background:#ecfdf5;
    color:#047857;
    border:1px solid #a7f3d0;
  }
  #i69dr5g{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:8px;
    margin-bottom:16px;
  }
  #ixgxf3v{
    font-size:21px;
    font-weight:900;
    color:#0f172a;
    margin:0 0 8px;
    letter-spacing:-0.015em;
  }
  #ih6n6ak{
    font-size:13px;
    line-height:1.55;
    color:#64748b;
    margin:0 0 20px;
    min-height:40px;
  }
  #inb1gbg{
    width:15px;
    height:15px;
    color:#10b981;
    flex-shrink:0;
  }
  #izcj7xq{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    color:#334155;
    font-weight:500;
  }
  #i97pasb{
    width:15px;
    height:15px;
    color:#10b981;
    flex-shrink:0;
  }
  #ivv7iaw{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    color:#334155;
    font-weight:500;
  }
  #i4wcwre{
    width:15px;
    height:15px;
    color:#10b981;
    flex-shrink:0;
  }
  #iwrrj9g{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    color:#334155;
    font-weight:500;
  }
  #imt3ytg{
    padding-top:16px;
    border-top:1px solid #f1f5f9;
    display:flex;
    flex-direction:column;
    gap:10px;
  }
  #ie8po33{
    font-size:11px;
    color:#94a3b8;
    font-weight:600;
  }
  #in15ehg{
    font-size:26px;
    font-weight:900;
    color:#0f172a;
    letter-spacing:-0.02em;
  }
  #i3p1kag{
    font-size:12.5px;
    font-weight:800;
    color:#4f46e5;
    float:left;
  }
  #ispluq2{
    text-align:right;
  }
  #id17zmz{
    display:flex;
    align-items:baseline;
    justify-content:space-between;
    margin-bottom:16px;
  }
  #i7eiylv{
    width:14px;
    height:14px;
  }
  #ichvbz7{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    padding:11px 16px;
    border-radius:12px;
    background:#4f46e5;
    color:#ffffff;
    font-size:12.5px;
    font-weight:700;
    text-decoration:none;
    box-shadow:0 4px 12px rgba(79, 70, 229, 0.25);
    transition:all 0.2s ease;
  }
  #im4uoal{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    padding:9px 16px;
    border-radius:12px;
    background:#f8fafc;
    border:1px solid #e2e8f0;
    color:#334155;
    font-size:12px;
    font-weight:700;
    text-decoration:none;
    transition:all 0.2s ease;
  }
  #ig171jt{
    display:flex;
    flex-direction:column;
    gap:8px;
  }
  #igvzdxk{
    margin-top:24px;
    padding-top:18px;
    border-top:1px solid #f1f5f9;
  }
  #ipz8m1v{
    background:#ffffff;
    border-radius:24px;
    border:1px solid #e2e8f0;
    padding:28px 24px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    position:relative;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(15, 23, 42, 0.04);
    transition:all 0.3s ease;
    box-sizing:border-box;
  }
  #ib44amu{
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:5px;
    background:linear-gradient(90deg, #6366f1, #8b5cf6, #6366f1);
  }
  #ifbdhqf{
    padding:4px 10px;
    font-size:11px;
    font-weight:700;
    border-radius:8px;
    background:#eef2ff;
    color:#4338ca;
    border:1px solid #e0e7ff;
    font-family:ui-monospace, monospace;
  }
  #ijlsw2j{
    padding:4px 10px;
    font-size:11px;
    font-weight:800;
    border-radius:8px;
    background:#ecfdf5;
    color:#047857;
    border:1px solid #a7f3d0;
  }
  #i08ljse{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:8px;
    margin-bottom:16px;
  }
  #iuwo4zk{
    font-size:21px;
    font-weight:900;
    color:#0f172a;
    margin:0 0 8px;
    letter-spacing:-0.015em;
  }
  #izhc64s{
    font-size:13px;
    line-height:1.55;
    color:#64748b;
    margin:0 0 20px;
    min-height:40px;
  }
  #in7nb0u{
    width:15px;
    height:15px;
    color:#10b981;
    flex-shrink:0;
  }
  #i5koxqw{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    color:#334155;
    font-weight:500;
  }
  #iubuett{
    width:15px;
    height:15px;
    color:#10b981;
    flex-shrink:0;
  }
  #iiwoahm{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    color:#334155;
    font-weight:500;
  }
  #ilf0m9w{
    width:15px;
    height:15px;
    color:#10b981;
    flex-shrink:0;
  }
  #ihfsxou{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:12.5px;
    color:#334155;
    font-weight:500;
  }
  #iz7e306{
    padding-top:16px;
    border-top:1px solid #f1f5f9;
    display:flex;
    flex-direction:column;
    gap:10px;
  }
  #imrarul{
    margin-bottom:16px;
  }
  #iwxkl96{
    width:14px;
    height:14px;
  }
  #i25dz88{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    padding:11px 16px;
    border-radius:12px;
    background:#4f46e5;
    color:#ffffff;
    font-size:12.5px;
    font-weight:700;
    text-decoration:none;
    box-shadow:0 4px 12px rgba(79, 70, 229, 0.25);
    transition:all 0.2s ease;
  }
  #ipwvd85{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    padding:9px 16px;
    border-radius:12px;
    background:#f8fafc;
    border:1px solid #e2e8f0;
    color:#334155;
    font-size:12px;
    font-weight:700;
    text-decoration:none;
    transition:all 0.2s ease;
  }
  #i8orfig{
    display:flex;
    flex-direction:column;
    gap:8px;
  }
  #izz7hah{
    margin-top:24px;
    padding-top:18px;
    border-top:1px solid #f1f5f9;
  }
  #ix2jugk{
    background:#ffffff;
    border-radius:24px;
    border:1px solid #e2e8f0;
    padding:28px 24px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    position:relative;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(15, 23, 42, 0.04);
    transition:all 0.3s ease;
    box-sizing:border-box;
  }
  #i2vycox{
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:24px;
    align-items:stretch;
  }
  #products{
    padding:30px 0 80px;
  }
  #iwb3h3z{
    width:15px;
    height:15px;
    color:#514bf0;
  }
  #inqyc1m{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:rgba(243, 232, 255, 0.85);
    border:1px solid #e9d5ff;
    color:#514bf0;
    padding:6px 16px;
    border-radius:9999px;
    font-size:12px;
    font-weight:700;
    font-family:ui-monospace, SFMono-Regular, monospace;
    margin-bottom:16px;
  }
  #ii9tas1{
    font-size:34px;
    font-weight:900;
    color:#0f172a;
    margin:0;
    letter-spacing:-0.025em;
    line-height:1.2;
  }
  #irjok64{
    text-align:center;
    margin-bottom:48px;
  }
  #i4enzpe{
    width:20px;
    height:20px;
    color:#514bf0;
    flex-shrink:0;
    transition:transform 0.2s ease;
  }
  #iquphc9{
    font-size:16px;
    font-weight:800;
    color:#0f172a;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:space-between;
    user-select:none;
    outline:none;
    list-style:none;
  }
  #ie3efbz{
    font-size:14.5px;
    line-height:1.65;
    color:#64748b;
    margin:16px 0 0;
    padding-top:14px;
    border-top:1px solid #f1f5f9;
  }
  #ixi5eyj{
    background:rgba(255, 255, 255, 0.95);
    border-radius:16px;
    border:1px solid #f1f0fb;
    padding:20px 24px;
    box-shadow:0 4px 15px rgba(0,0,0,0.02);
    transition:all 0.2s ease;
  }
  #iy2ld9q{
    width:20px;
    height:20px;
    color:#514bf0;
    flex-shrink:0;
    transition:transform 0.2s ease;
  }
  #i7qunob{
    font-size:16px;
    font-weight:800;
    color:#0f172a;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:space-between;
    user-select:none;
    outline:none;
    list-style:none;
  }
  #i08rwbl{
    font-size:14.5px;
    line-height:1.65;
    color:#64748b;
    margin:16px 0 0;
    padding-top:14px;
    border-top:1px solid #f1f5f9;
  }
  #ibneiff{
    background:rgba(255, 255, 255, 0.95);
    border-radius:16px;
    border:1px solid #f1f0fb;
    padding:20px 24px;
    box-shadow:0 4px 15px rgba(0,0,0,0.02);
    transition:all 0.2s ease;
  }
  #izmzcxh{
    width:20px;
    height:20px;
    color:#514bf0;
    flex-shrink:0;
    transition:transform 0.2s ease;
  }
  #i9p5tcq{
    font-size:16px;
    font-weight:800;
    color:#0f172a;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:space-between;
    user-select:none;
    outline:none;
    list-style:none;
  }
  #ic2j95q{
    font-size:14.5px;
    line-height:1.65;
    color:#64748b;
    margin:16px 0 0;
    padding-top:14px;
    border-top:1px solid #f1f5f9;
  }
  #i6tsdwj{
    background:rgba(255, 255, 255, 0.95);
    border-radius:16px;
    border:1px solid #f1f0fb;
    padding:20px 24px;
    box-shadow:0 4px 15px rgba(0,0,0,0.02);
    transition:all 0.2s ease;
  }
  #ixime9v{
    width:20px;
    height:20px;
    color:#514bf0;
    flex-shrink:0;
    transition:transform 0.2s ease;
  }
  #i8yygiq{
    font-size:16px;
    font-weight:800;
    color:#0f172a;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:space-between;
    user-select:none;
    outline:none;
    list-style:none;
  }
  #i5lusfd{
    font-size:14.5px;
    line-height:1.65;
    color:#64748b;
    margin:16px 0 0;
    padding-top:14px;
    border-top:1px solid #f1f5f9;
  }
  #i2mcwo7{
    background:rgba(255, 255, 255, 0.95);
    border-radius:16px;
    border:1px solid #f1f0fb;
    padding:20px 24px;
    box-shadow:0 4px 15px rgba(0,0,0,0.02);
    transition:all 0.2s ease;
  }
  #iykmnf6{
    display:flex;
    flex-direction:column;
    gap:16px;
  }
  #faq{
    padding:40px 0 80px;
    max-width:860px;
    margin:0 auto;
  }
  #ivimssg{
    display:inline-block;
    padding:6px 16px;
    border-radius:9999px;
    background:#f3e8ff;
    border:1px solid #e9d5ff;
    color:#514bf0;
    font-size:12px;
    font-weight:800;
    font-family:ui-monospace, monospace;
    margin-bottom:20px;
    letter-spacing:0.5px;
  }
  #iumlxsf{
    font-size:38px;
    font-weight:900;
    color:#0f172a;
    margin:0 0 16px;
    letter-spacing:-0.025em;
    line-height:1.18;
  }
  #igoaouh{
    font-size:16px;
    line-height:1.65;
    color:#64748b;
    margin:0 auto 36px;
    max-width:580px;
  }
  #i9fymri{
    width:20px;
    height:20px;
    color:#ffffff;
  }
  #isyz6ym{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    padding:15px 32px;
    border-radius:14px;
    background:linear-gradient(135deg, #514bf0 0%, #6366f1 50%, #7c3aed 100%);
    color:#ffffff;
    font-size:15px;
    font-weight:800;
    text-decoration:none;
    box-shadow:0 10px 30px rgba(99, 102, 241, 0.4);
    transition:all 0.2s ease;
  }
  #i5zn5a5{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    padding:15px 30px;
    border-radius:14px;
    background:#ffffff;
    border:1px solid #e9d5ff;
    color:#1e293b;
    font-size:15px;
    font-weight:700;
    text-decoration:none;
    box-shadow:0 4px 15px rgba(0,0,0,0.03);
    transition:all 0.2s ease;
  }
  #if8op9h{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:16px;
    flex-wrap:wrap;
  }
  #i8wyt34{
    margin-top:28px;
    font-size:12.5px;
    font-family:ui-monospace, SFMono-Regular, monospace;
    color:#64748b;
    font-weight:600;
    letter-spacing:0.2px;
  }
  #iu6qg9g{
    max-width:760px;
    margin:0 auto;
    position:relative;
    z-index:2;
  }
  #iiukxju{
    position:relative;
    border-radius:28px;
    background:linear-gradient(180deg, #ffffff 0%, rgba(245, 243, 255, 0.75) 100%);
    border:1px solid #e9d5ff;
    padding:64px 32px;
    text-align:center;
    overflow:hidden;
    box-shadow:0 20px 50px rgba(124, 58, 237, 0.08);
  }
  #i6j5pzk{
    padding:20px 0 40px;
  }
  #is50esh{
    max-width:1280px;
    margin:0 auto;
    padding:40px 24px;
    font-family:'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    -webkit-font-smoothing:antialiased;
    box-sizing:border-box;
    color:#0f172a;
  }
  #i5m2cme{
    background-image:linear-gradient(to right, rgba(239,68,68,0.07) 0%, rgba(239,68,68,0) 100%);
  }
  .grv-table-row:hover{
    background-image:initial !important;
    background-position-x:initial !important;
    background-position-y:initial !important;
    background-size:initial !important;
    background-repeat:initial !important;
    background-attachment:initial !important;
    background-origin:initial !important;
    background-clip:initial !important;
    background-color:rgba(243, 232, 255, 0.25) !important;
  }
  #iqqkiq5{
    width:14px;
    height:14px;
    color:#514bf0;
  }
  #i53sofw{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:rgba(243, 232, 255, 0.85);
    border:1px solid #e9d5ff;
    color:#514bf0;
    padding:6px 16px;
    border-radius:9999px;
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:1.2px;
    font-family:ui-monospace, SFMono-Regular, monospace;
    margin-bottom:16px;
  }
  #ipeq1xx{
    font-size:38px;
    font-weight:900;
    color:#0f172a;
    margin:0 0 16px;
    letter-spacing:-0.025em;
    line-height:1.18;
  }
  #ijn2bxw{
    font-size:15px;
    line-height:1.65;
    color:#475569;
    margin:0;
    font-weight:400;
  }
  #i3je2ol{
    text-align:center;
    max-width:760px;
    margin:0 auto 52px;
  }
  #inzq2ax{
    padding:20px 24px;
    font-size:11px;
    font-weight:800;
    color:#64748b;
    text-transform:uppercase;
    letter-spacing:1.2px;
    font-family:ui-monospace, monospace;
    width:32%;
  }
  #iej1y9l{
    width:8px;
    height:8px;
    border-radius:50%;
    background:#10b981;
    display:inline-block;
    box-shadow:0 0 6px rgba(16, 185, 129, 0.5);
  }
  #ixvglyl{
    display:flex;
    align-items:center;
    gap:8px;
  }
  #ikiqv1x{
    padding:20px 24px;
    font-size:11px;
    font-weight:800;
    color:#514bf0;
    text-transform:uppercase;
    letter-spacing:1.2px;
    font-family:ui-monospace, monospace;
    background:rgba(243, 232, 255, 0.45);
    border-left:1px solid #ede9fe;
    border-right:1px solid #ede9fe;
    width:34%;
  }
  #i9woetv{
    padding:20px 24px;
    font-size:11px;
    font-weight:800;
    color:#64748b;
    text-transform:uppercase;
    letter-spacing:1.2px;
    font-family:ui-monospace, monospace;
    width:34%;
  }
  #i74ijcp{
    border-bottom:1px solid #f1f0fb;
    background:#faf9fe;
  }
  #imqq3bj{
    padding:20px 24px;
    font-size:14px;
    font-weight:600;
    color:#1e293b;
  }
  #ilpy3e1{
    padding:20px 24px;
    font-size:13.5px;
    font-weight:800;
    color:#059669;
    font-family:ui-monospace, SFMono-Regular, monospace;
    background:rgba(243, 232, 255, 0.45);
    border-left:1px solid #ede9fe;
    border-right:1px solid #ede9fe;
    letter-spacing:0.2px;
  }
  #im236b2{
    padding:20px 24px;
    font-size:13.5px;
    color:#64748b;
  }
  #i58ypuj{
    border-bottom:1px solid #f8f6fc;
    transition:background 0.2s ease;
  }
  #i6kcya7{
    padding:20px 24px;
    font-size:14px;
    font-weight:600;
    color:#1e293b;
  }
  #i4ani4o{
    padding:20px 24px;
    font-size:13.5px;
    font-weight:800;
    color:#059669;
    font-family:ui-monospace, SFMono-Regular, monospace;
    background:rgba(243, 232, 255, 0.45);
    border-left:1px solid #ede9fe;
    border-right:1px solid #ede9fe;
    letter-spacing:0.2px;
  }
  #ijal49i{
    padding:20px 24px;
    font-size:13.5px;
    color:#64748b;
  }
  #igdmix1{
    border-bottom:1px solid #f8f6fc;
    transition:background 0.2s ease;
  }
  #ik3yurq{
    padding:20px 24px;
    font-size:14px;
    font-weight:600;
    color:#1e293b;
  }
  #ifzgkrm{
    padding:20px 24px;
    font-size:13.5px;
    font-weight:800;
    color:#059669;
    font-family:ui-monospace, SFMono-Regular, monospace;
    background:rgba(243, 232, 255, 0.45);
    border-left:1px solid #ede9fe;
    border-right:1px solid #ede9fe;
    letter-spacing:0.2px;
  }
  #i69jc4u{
    padding:20px 24px;
    font-size:13.5px;
    color:#64748b;
  }
  #ih0vbqn{
    border-bottom:1px solid #f8f6fc;
    transition:background 0.2s ease;
  }
  #ifsbv1l{
    padding:20px 24px;
    font-size:14px;
    font-weight:600;
    color:#1e293b;
  }
  #ie9g7x6{
    padding:20px 24px;
    font-size:13.5px;
    font-weight:800;
    color:#059669;
    font-family:ui-monospace, SFMono-Regular, monospace;
    background:rgba(243, 232, 255, 0.45);
    border-left:1px solid #ede9fe;
    border-right:1px solid #ede9fe;
    letter-spacing:0.2px;
  }
  #i06c6j7{
    padding:20px 24px;
    font-size:13.5px;
    color:#64748b;
  }
  #i8pmy5x{
    border-bottom:1px solid #f8f6fc;
    transition:background 0.2s ease;
  }
  #iq5x80o{
    padding:20px 24px;
    font-size:14px;
    font-weight:600;
    color:#1e293b;
  }
  #i7e9zdq{
    padding:20px 24px;
    font-size:13.5px;
    font-weight:800;
    color:#059669;
    font-family:ui-monospace, SFMono-Regular, monospace;
    background:rgba(243, 232, 255, 0.45);
    border-left:1px solid #ede9fe;
    border-right:1px solid #ede9fe;
    letter-spacing:0.2px;
  }
  #if5136r{
    padding:20px 24px;
    font-size:13.5px;
    color:#64748b;
  }
  #i5nrt0a{
    transition:background 0.2s ease;
  }
  #ip75omh{
    width:100%;
    border-collapse:collapse;
    text-align:left;
    min-width:680px;
  }
  #ire7p5j{
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
  }
  #i45nnnt{
    background:rgba(255, 255, 255, 0.95);
    border-radius:20px;
    border:1px solid #f1f0fb;
    box-shadow:0 15px 40px rgba(124, 58, 237, 0.08);
    overflow:hidden;
    box-sizing:border-box;
  }
  #izbgv9e{
    max-width:1200px;
    margin:40px auto;
    padding:40px 24px;
    font-family:'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    -webkit-font-smoothing:antialiased;
    box-sizing:border-box;
    color:#0f172a;
  }
  #ie8po33-2{
    font-size:11px;
    color:#94a3b8;
    font-weight:600;
  }
  #in15ehg-2{
    font-size:26px;
    font-weight:900;
    color:#0f172a;
    letter-spacing:-0.02em;
  }
  #iryxx8a-2{
    font-size:10px;
    color:#94a3b8;
    text-transform:uppercase;
    font-weight:700;
  }
  #i3p1kag-4{
    font-size:12.5px;
    font-weight:800;
    color:#4f46e5;
  }
  #ispluq2-2{
    text-align:right;
  }
  #id17zmz-2{
    display:flex;
    align-items:baseline;
    justify-content:space-between;
    margin-bottom:16px;
  }
  #isb3oqt-2{
    letter-spacing:-0.52px;
  }
  #i7bj40b-2{
    letter-spacing:-0.52px;
  }
  #ie8po33-3{
    font-size:11px;
    color:#94a3b8;
    font-weight:600;
  }
  #isb3oqt-2{
    letter-spacing:-0.52px;
  }
  #in15ehg-3{
    font-size:26px;
    font-weight:900;
    color:#0f172a;
    letter-spacing:-0.02em;
  }
  #i3p1kag-7{
    font-size:12.5px;
    font-weight:800;
    color:#4f46e5;
    float:left;
  }
  #ispluq2-3{
    text-align:right;
  }
  #id17zmz-3{
    display:flex;
    align-items:baseline;
    justify-content:space-between;
    margin-bottom:16px;
  }
  #ie8po33-2-2{
    font-size:11px;
    color:#94a3b8;
    font-weight:600;
  }
  #in15ehg-2-2{
    font-size:26px;
    font-weight:900;
    color:#0f172a;
    letter-spacing:-0.02em;
  }
  #iryxx8a-2-2{
    font-size:10px;
    color:#94a3b8;
    text-transform:uppercase;
    font-weight:700;
  }
  #i3p1kag-4-2{
    font-size:12.5px;
    font-weight:800;
    color:#4f46e5;
  }
  #ispluq2-2-2{
    text-align:right;
  }
  #id17zmz-2-2{
    display:flex;
    align-items:baseline;
    justify-content:space-between;
    margin-bottom:16px;
  }
  @keyframes grvBlinkPulse{
    0%{
      transform:scale(0.95);
      opacity:0.9;
    }
    70%, 100%{
      transform:scale(2.4);
      opacity:0;
    }
  }
  @keyframes grvFloatY{
    0%, 100%{
      transform:translateY(0px);
    }
    50%{
      transform:translateY(-7px);
    }
  }
  @keyframes grvFloatBottom{
    0%, 100%{
      transform:translate(-50%, 0px);
    }
    50%{
      transform:translate(-50%, -7px);
    }
  }
  @keyframes grvPulse{
    0%, 100%{
      transform:scale(1);
      opacity:1;
    }
    50%{
      transform:scale(1.35);
      opacity:0.8;
    }
  }
  @media (max-width: 1100px){
    .grv-products-grid{
      grid-template-columns:repeat(2, 1fr) !important;
    }
  }
  @media (max-width: 992px){
    .grv-span-8{
      grid-column-start:span 12 !important;
      grid-column-end:auto !important;
    }
    .grv-span-4{
      grid-column-start:span 12 !important;
      grid-column-end:auto !important;
    }
    .grv-cta-buttons{
      flex-direction:column !important;
    }
    .grv-cta-buttons a{
      width:100% !important;
      box-sizing:border-box;
    }
  }
  @media (max-width: 900px){
    .grv-mockup-left{
      display:flex !important;
    }
    .grv-mockup-right{
      display:flex !important;
    }
    .grv-mockup-center{
      padding-top:20px !important;
      padding-right:12px !important;
      padding-bottom:20px !important;
      padding-left:12px !important;
    }
    .grv-mockup-wrapper{
      padding-top:24px !important;
      padding-right:6px !important;
      padding-bottom:36px !important;
      padding-left:6px !important;
      margin-top:20px !important;
      margin-right:auto !important;
      margin-bottom:20px !important;
      margin-left:auto !important;
    }
    .grv-window-frame{
      overflow-x:auto !important;
      border-top-left-radius:16px !important;
      border-top-right-radius:16px !important;
      border-bottom-right-radius:16px !important;
      border-bottom-left-radius:16px !important;
      box-shadow:rgba(99, 102, 241, 0.15) 0px 15px 40px -10px !important;
    }
    .grv-mockup-header{
      min-width:860px !important;
    }
    .grv-mockup-body{
      min-width:860px !important;
    }
    .grv-badge-tl{
      top:2px !important;
      left:12px !important;
      font-size:10px !important;
      padding-top:4px !important;
      padding-right:10px !important;
      padding-bottom:4px !important;
      padding-left:10px !important;
    }
    .grv-badge-b{
      bottom:8px !important;
      font-size:10px !important;
      padding-top:4px !important;
      padding-right:12px !important;
      padding-bottom:4px !important;
      padding-left:12px !important;
    }
    .grv-cards-grid{
      max-width:480px;
      margin-left:auto;
      margin-right:auto;
      grid-template-columns:1fr !important;
      row-gap:20px !important;
      column-gap:20px !important;
    }
    .grv-flow-container{
      display:none !important;
    }
    .grv-brand-badge{
      margin-bottom:24px !important;
    }
  }
  @media (min-width: 861px){
    .grv-nav-desktop{
      display:flex !important;
    }
    .grv-burger-btn{
      display:none !important;
    }
    .grv-nav-mobile{
      display:none !important;
    }
  }
  @media (max-width: 860px){
    .grv-nav-desktop{
      display:none !important;
    }
    .grv-burger-btn{
      display:flex !important;
    }
    .grv-hero-title{
      font-size:40px !important;
      line-height:1.18 !important;
    }
    .grv-hero-desc{
      font-size:16px !important;
    }
    .grv-hero-actions{
      flex-direction:column !important;
      width:100% !important;
    }
    .grv-hero-actions a{
      width:100% !important;
      justify-content:center !important;
    }
    .grv-trust-badges{
      row-gap:16px !important;
      column-gap:16px !important;
      flex-direction:column !important;
    }
    .grv-mockup-wrapper{
      padding-top:24px !important;
      padding-right:8px !important;
      padding-bottom:36px !important;
      padding-left:8px !important;
      margin-top:15px !important;
      margin-right:auto !important;
      margin-bottom:15px !important;
      margin-left:auto !important;
    }
    .grv-window-frame{
      overflow-x:hidden !important;
      overflow-y:hidden !important;
      border-top-left-radius:18px !important;
      border-top-right-radius:18px !important;
      border-bottom-right-radius:18px !important;
      border-bottom-left-radius:18px !important;
      box-shadow:rgba(99, 102, 241, 0.15) 0px 15px 40px -10px !important;
    }
    .grv-mockup-header{
      padding-top:10px !important;
      padding-right:14px !important;
      padding-bottom:10px !important;
      padding-left:14px !important;
    }
    .grv-url-text{
      display:none !important;
    }
    .grv-mobile-switcher{
      background-image:initial;
      background-position-x:initial;
      background-position-y:initial;
      background-size:initial;
      background-repeat:initial;
      background-attachment:initial;
      background-origin:initial;
      background-clip:initial;
      background-color:rgb(248, 250, 252);
      border-bottom-width:1px;
      border-bottom-style:solid;
      border-bottom-color:rgb(226, 232, 240);
      padding-top:6px;
      padding-right:8px;
      padding-bottom:6px;
      padding-left:8px;
      row-gap:6px;
      column-gap:6px;
      display:flex !important;
    }
    .grv-mobile-tab-btn{
      flex-grow:1;
      flex-shrink:1;
      flex-basis:0%;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      row-gap:5px;
      column-gap:5px;
      padding-top:8px;
      padding-right:4px;
      padding-bottom:8px;
      padding-left:4px;
      border-top-left-radius:8px;
      border-top-right-radius:8px;
      border-bottom-right-radius:8px;
      border-bottom-left-radius:8px;
      border-top-width:1px;
      border-right-width:1px;
      border-bottom-width:1px;
      border-left-width:1px;
      border-top-style:solid;
      border-right-style:solid;
      border-bottom-style:solid;
      border-left-style:solid;
      border-top-color:transparent;
      border-right-color:transparent;
      border-bottom-color:transparent;
      border-left-color:transparent;
      border-image-source:none;
      border-image-slice:100%;
      border-image-width:1;
      border-image-outset:0;
      border-image-repeat:stretch;
      background-image:initial;
      background-position-x:initial;
      background-position-y:initial;
      background-size:initial;
      background-repeat:initial;
      background-attachment:initial;
      background-origin:initial;
      background-clip:initial;
      background-color:transparent;
      color:rgb(100, 116, 139);
      font-size:11px;
      font-weight:700;
      cursor:pointer;
      transition-behavior:normal;
      transition-duration:0.2s;
      transition-timing-function:ease;
      transition-delay:0s;
      transition-property:all;
      outline-color:initial;
      outline-style:none;
      outline-width:initial;
    }
    .grv-mobile-tab-btn.active{
      background-image:initial;
      background-position-x:initial;
      background-position-y:initial;
      background-size:initial;
      background-repeat:initial;
      background-attachment:initial;
      background-origin:initial;
      background-clip:initial;
      background-color:rgb(255, 255, 255);
      color:rgb(79, 70, 229);
      border-top-color:rgb(226, 232, 240);
      border-right-color:rgb(226, 232, 240);
      border-bottom-color:rgb(226, 232, 240);
      border-left-color:rgb(226, 232, 240);
      box-shadow:rgba(0, 0, 0, 0.05) 0px 2px 6px;
    }
    .grv-mockup-body{
      display:block !important;
      min-height:auto !important;
      min-width:0px !important;
    }
    .grv-mockup-col{
      display:none !important;
      width:100% !important;
      border-top-width:medium !important;
      border-right-width:medium !important;
      border-bottom-width:medium !important;
      border-left-width:medium !important;
      border-top-style:none !important;
      border-right-style:none !important;
      border-bottom-style:none !important;
      border-left-style:none !important;
      border-top-color:currentcolor !important;
      border-right-color:currentcolor !important;
      border-bottom-color:currentcolor !important;
      border-left-color:currentcolor !important;
      border-image-source:none !important;
      border-image-slice:100% !important;
      border-image-width:1 !important;
      border-image-outset:0 !important;
      border-image-repeat:stretch !important;
      box-sizing:border-box !important;
    }
    .grv-mockup-col.grv-mobile-active{
      display:flex !important;
    }
    #grv-col-settings.grv-mobile-active{
      display:block !important;
    }
    .grv-mockup-left{
      max-height:none !important;
      padding-top:16px !important;
      padding-right:14px !important;
      padding-bottom:16px !important;
      padding-left:14px !important;
    }
    .grv-mockup-center{
      padding-top:24px !important;
      padding-right:16px !important;
      padding-bottom:24px !important;
      padding-left:16px !important;
    }
    .grv-mockup-right{
      padding-top:18px !important;
      padding-right:16px !important;
      padding-bottom:18px !important;
      padding-left:16px !important;
    }
    .grv-badge-r{
      display:none !important;
    }
    .grv-badge-tl{
      top:-6px !important;
      left:14px !important;
      font-size:10px !important;
      padding-top:4px !important;
      padding-right:10px !important;
      padding-bottom:4px !important;
      padding-left:10px !important;
    }
    .grv-badge-b{
      bottom:4px !important;
      font-size:10px !important;
      padding-top:4px !important;
      padding-right:12px !important;
      padding-bottom:4px !important;
      padding-left:12px !important;
    }
    #grv-tab-b:checked ~ .grv-window-frame .grv-btn-tab-b, #grv-tab-c:checked ~ .grv-window-frame .grv-btn-tab-c, #grv-tab-s:checked ~ .grv-window-frame .grv-btn-tab-s{
      background-image:initial !important;
      background-position-x:initial !important;
      background-position-y:initial !important;
      background-size:initial !important;
      background-repeat:initial !important;
      background-attachment:initial !important;
      background-origin:initial !important;
      background-clip:initial !important;
      background-color:rgb(255, 255, 255) !important;
      color:rgb(79, 70, 229) !important;
      border-top-color:rgb(226, 232, 240) !important;
      border-right-color:rgb(226, 232, 240) !important;
      border-bottom-color:rgb(226, 232, 240) !important;
      border-left-color:rgb(226, 232, 240) !important;
      box-shadow:rgba(0, 0, 0, 0.05) 0px 2px 6px !important;
    }
    #grv-tab-b:checked ~ .grv-window-frame #grv-col-blocks{
      display:flex !important;
    }
    #grv-tab-c:checked ~ .grv-window-frame #grv-col-canvas{
      display:flex !important;
    }
    #grv-tab-s:checked ~ .grv-window-frame #grv-col-settings{
      display:block !important;
    }
  }
  @media (max-width: 768px){
    .gjs-row{
      flex-wrap:wrap;
    }
    .grv-products-grid{
      grid-template-columns:1fr !important;
    }
    .grv-cta-buttons{
      flex-direction:column !important;
    }
    .grv-cta-buttons a{
      width:100% !important;
      box-sizing:border-box;
    }
    .grv-comparison-wrapper{
      padding-top:24px !important;
      padding-right:16px !important;
      padding-bottom:24px !important;
      padding-left:16px !important;
    }
  }
  @media (max-width: 480px){
    #i0ikck{
      height:69px;
    }
    #ien03w{
      top:-64px;
      margin:0px -15px 0px -17px;
    }
    #ixcpso{
      font-size:25px !important;
    }
    #it4laz{
      font-size:9px !important;
    }
    #ib218x{
      display:block;
      position:static;
      margin:0px 1px 0px 0px;
    }
    #idvpvf{
      display:flex;
      width:293px;
      margin:0px 0px -33px 0px;
    }
    #gravisain{
      padding:80px 24px 0px 24px;
    }
  }
</style>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var burger = document.querySelector('.grv-burger-btn');
    var navMobile = document.querySelector('.grv-nav-mobile');
    if (burger && navMobile) {
        burger.addEventListener('click', function(e) {
            e.preventDefault();
            var currentDisplay = window.getComputedStyle(navMobile).display;
            navMobile.style.display = (currentDisplay === 'none' || navMobile.classList.contains('hidden')) ? 'flex' : 'none';
        });
    }
});
</script>

<?php wp_footer(); ?>
</body>
</html>
