# Landing Page — Override (`/landing`)

> Menimpa `MASTER.md` hanya untuk halaman landing publik. Selebihnya ikut MASTER.

- **Tujuan:** halaman marketing/entry publik PT. PKLP Marine Offshore — memperkenalkan sistem monitoring QHSE & Fleet, lalu mengarahkan ke `/public-dashboard` dan `/login`.
- **View:** `resources/views/public/landing.blade.php`. **Route:** `Route::view('/landing', ...)`.
- **Stack:** sama seperti dashboard publik → Bootstrap 5 (CDN) + `public/css/design-tokens.css` + `theme-toggle.js`. **Bukan** React/Next — komponen Aceternity "Hero Parallax" **diport** ke vanilla JS.

## Penyesuaian dari MASTER

- **Hero parallax (signature):** tinggi `300vh`, `perspective:1000px`, `transform-style:preserve-3d`. Tiga baris kartu bergerak horizontal berlawanan arah saat scroll; grup di-`rotateX/rotateZ/translateY` + fade-in mengikuti progress scroll.
  - Reimplementasi framer-motion (`useScroll/useTransform/useSpring`) → 1 scroll listener + `requestAnimationFrame` dengan smoothing (lerp 0.1) sebagai pengganti spring.
  - **WAJIB hormati `prefers-reduced-motion`** (MASTER §6): jika aktif, parallax dimatikan → grid statis identitas, tidak ada gerak.
  - Animasi hanya `transform`/`opacity` (MASTER §6, cegah CLS).
- **Gambar kartu:** `picsum.photos` (deterministik via seed, dijamin termuat) + overlay gradient Marine Blue + label modul → tetap on-brand, nol risiko broken image. (Bukan Unsplash karena ID foto tak bisa dijamin.)
- **Ikon:** Lucide (vektor) — bukan emoji (MASTER §9).
- **Warna/typography/spacing/radius/shadow/CTA:** tetap pakai token & aturan MASTER (Marine Blue primary, Inter + JetBrains Mono, satu primary CTA per section).
- **Light + Dark:** anti-flash inline script + tombol `[data-theme-toggle]` seperti halaman publik lain.

## Struktur section
1. Navbar (logo + nav + theme toggle + CTA Login)
2. Hero parallax 300vh (judul + sub + CTA di `Header`)
3. Fitur / modul (grid kartu, ikon Lucide)
4. Statistik (angka `JetBrains Mono`, tabular)
5. CTA penutup → `/public-dashboard` + `/login`
6. Footer
