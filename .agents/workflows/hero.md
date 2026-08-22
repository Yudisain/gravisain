---
description: HERO
---

Saya ingin Hero Block dibuat sebagai block yang modular, reusable, dan scalable, bukan hanya untuk satu desain landing page.

Struktur Hero
Hero
├── Container
│   ├── Max Width
│   ├── Padding
│   └── Alignment
│
├── Layout
│   ├── 1 Column
│   ├── 2 Column
│   ├── Center
│   ├── Reverse
│   └── Full Width
│
├── Content
│   ├── Eyebrow (optional)
│   ├── Heading (H1)
│   ├── Description
│   ├── Button Group
│   │   ├── Primary Button
│   │   └── Secondary Button
│   └── Trust Badge / Rating (optional)
│
├── Media
│   ├── Image
│   ├── Video
│   ├── Illustration
│   └── Image Position
│
├── Background
│   ├── Color
│   ├── Gradient
│   ├── Background Image
│   └── Overlay
│
└── Decoration (optional)
    ├── Shape
    ├── Blob
    ├── Pattern
    └── Divider


Inspector Controls
Inspector Controls
Saya ingin Inspector dipisahkan menjadi beberapa panel:

Layout
Content
Buttons
Media
Background
Style
Typography
Spacing
Border
Shadow
Animation
Responsive
Advanced

Attribute
Minimal Hero memiliki attribute berikut:
layout
eyebrow
title
description
primaryButton
secondaryButton
media
background
overlay
spacing
typography
animation
responsive

Komponen
Saya ingin Hero menggunakan komponen yang dapat digunakan ulang, seperti:

Container
Section
Heading
Text
Button
Image
Stack
Grid

Jangan membuat seluruh UI di dalam satu file edit.jsx. Pisahkan setiap bagian menjadi komponen agar mudah dipelihara dan dapat digunakan kembali pada block lain.

Tujuan
Hero ini akan menjadi fondasi untuk membuat berbagai variasi Hero (Agency, SaaS, Portfolio, Startup, Centered, Split Layout, dan lainnya) tanpa mengubah arsitektur block.