=== Gravisain ===
Contributors: yudisain, gravisain
Tags: blog, e-commerce, custom-background, custom-colors, custom-logo, custom-menu, editor-style, featured-images, block-patterns, block-styles, wide-blocks, threaded-comments, translation-ready
Requires at least: 6.4
Tested up to: 6.7
Requires PHP: 8.0
Stable tag: 1.0.1
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Gravisain is a modern, lightweight hybrid WordPress theme built as a flexible design system for fast, accessible websites.

== Description ==

Gravisain is a modern, lightweight hybrid WordPress theme built as a flexible design system for fast, accessible websites. Engineered with 100% Vanilla JavaScript (zero jQuery on the frontend), modular Header & Footer Builders, local privacy-first typography, WooCommerce support, native Gutenberg block patterns, and global Customizer design controls.

Key Features:
* Visual Header & Footer Row Builders in the WordPress Customizer
* Accessible keyboard navigation, skip links, focus management, and search modal
* Built-in Light / Dark / System color scheme switcher
* Privacy-first system font stack by default with optional local Google Fonts hosting
* Native Gutenberg `theme.json` design tokens, block styles, and core block patterns
* Deep WooCommerce layout and catalog integration

== Installation ==

1. In your WordPress admin dashboard, navigate to `Appearance > Themes` and click **Add New Theme**.
2. Click **Upload Theme**, select `gravisain.zip`, and click **Install Now**.
3. Click **Activate** to start using Gravisain.
4. Customize your header, footer, colors, and typography under `Appearance > Customize`.

== Build Instructions (Unminified Source Code) ==

All human-readable unminified CSS, JavaScript, and React source files are included inside the `/src` directory along with `package.json`, `vite.config.js`, and `postcss.config.js`.

To rebuild production assets from source:
1. Run `npm install` in the theme root directory.
2. Run `npm run build` to compile Vite frontend/Customizer bundles (`src/css`, `src/js`, `src/customizer-react`) and `@wordpress/scripts` editor sidebar controls (`src/meta`) into `/assets`.

== Privacy / External Services ==

By default, Gravisain uses the native operating system font stack (`system-stack`) and makes **zero** external network requests on either the frontend or the admin dashboard.

* **Optional Local Google Fonts Downloader (`fonts.googleapis.com` & `fonts.gstatic.com`)**:
  Only when a site administrator explicitly selects a Google Font family in `Appearance > Customize > Typography` (with *Load Google Fonts Locally* enabled under `Performance`), WordPress Admin downloads the stylesheet from `https://fonts.googleapis.com` and `.woff2` font files from `https://fonts.gstatic.com` onto your own server (`wp-content/uploads/gravisain/fonts/`). Frontend visitors never connect to Google servers.
  * Google Privacy Policy: https://policies.google.com/privacy
  * Google APIs Terms of Service: https://developers.google.com/terms

== Frequently Asked Questions ==

= Does this theme support the WordPress Customizer? =
Yes. Gravisain is a hybrid theme. Global layout options, colors, typography, Header rows, and Footer widget areas are configured natively via `Appearance > Customize`.

= Does Gravisain load external Google Fonts by default? =
No. Gravisain defaults to the system font stack with zero external requests. If you choose a Google Font in the Customizer, the theme downloads and hosts the `.woff2` files locally on your server.

= Does Gravisain work with WooCommerce? =
Yes. Gravisain includes built-in WooCommerce styling and Customizer layout controls.

== Changelog ==

= 1.0.1 =
* Hardened direct file access guards (`ABSPATH`), late output escaping, and type-specific Customizer sanitization callbacks across all settings.
* Improved accessibility: added accessible Header Search Modal with focus trap, keyboard-focusable dropdown navigation, content link underlines, semantic landmarks, and screen-reader context on archive links.
* Switched default typography to the native system font stack (`system-stack`) so zero external requests occur out of the box, and prevented remote Google Fonts fallback on the frontend.
* Included complete unminified `/src` source files and core-only Gutenberg block patterns in the distribution package.

= 1.0.0 =
* Initial WordPress.org release with Customizer Header/Footer builders, `theme.json` design system, and WooCommerce integration.

== License & Copyright ==

Gravisain WordPress Theme, Copyright 2026 Gravisain Studio (https://undagital.com).
Gravisain is distributed under the terms of the GNU General Public License v2 or later.

Third-party libraries and resources bundled or compiled in this theme:

* **React & React DOM** (compiled in Customizer controls bundle)
  Copyright (c) Meta Platforms, Inc. and affiliates.
  License: MIT License — https://opensource.org/licenses/MIT
  Source: https://github.com/facebook/react

* **React Color** (compiled in Customizer color picker control)
  Copyright (c) Case Sandberg.
  License: MIT License — https://opensource.org/licenses/MIT
  Source: https://github.com/casesandberg/react-color

* **Lucide Icons** (inline SVG paths in `classes/Helpers/SVG.php`)
  Copyright (c) Lucide Contributors.
  License: ISC License — https://opensource.org/licenses/ISC
  Source: https://lucide.dev/

* **Google Fonts** (metadata list in `data/google-fonts.json`; font files only downloaded locally if selected by admin)
  License: SIL Open Font License 1.1 (https://openfontlicense.org/) / Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
  Source: https://fonts.google.com/

* **Theme Screenshot & Starter Images** (`screenshot.jpg`, `assets/images/default-site-icon.png`, `assets/images/starter-content/logo-landscape2.png`, `assets/images/starter-content/resize.webp`)
  Original graphic works created by Gravisain Studio (https://undagital.com), released under CC0 1.0 Universal (https://creativecommons.org/publicdomain/zero/1.0/) and GPLv2 or later.
