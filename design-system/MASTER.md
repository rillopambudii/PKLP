# PKLP Monitoring — Design System (MASTER)

> **Source of Truth.** Semua halaman (admin AdminLTE, dashboard publik, halaman auth) mengikuti aturan di file ini.
> Jika ada file `design-system/pages/<nama-halaman>.md`, aturan di file itu **menimpa** MASTER untuk halaman tersebut.

- **Produk:** PT. PKLP Marine Offshore — sistem monitoring QHSE/HSSE (audit, temuan, man-hours, sertifikat kapal, maintenance, management review/visit).
- **Gaya:** Minimalist Flat + sentuhan Modern (bersih, banyak whitespace, flat surfaces, shadow halus, sudut lembut).
- **Mode:** Light **dan** Dark (dirancang berpasangan).
- **Stack:** Laravel — Admin = AdminLTE 3 (Bootstrap 4), Auth & komponen Breeze = Tailwind + Alpine, Chart = Chart.js.

---

## 1. Brand

Warna diambil langsung dari logo `public/logo.png` ("MARINE OFFSHORE").

| Token | Hex | Asal |
|-------|-----|------|
| **Marine Blue** (brand utama) | `#343399` | teks "MARINE" |
| **Brand Red** (aksen brand) | `#E11D27` | swoosh + teks "OFFSHORE" (versi pure `#FE0000` dipakai hanya untuk logo) |
| **Silver/Grey** | `#9CA3AF` | huruf logo |

**Aturan pakai brand:**
- **Marine Blue = primary** → tombol utama, link, nav aktif, header chart.
- **Brand Red = aksen brand**, dipakai *hemat* (garis aksen, highlight kecil). **Jangan** jadikan warna tombol umum.
- Karena ini aplikasi safety, **merah juga = makna bahaya** (error/overdue/destructive). Itu konsisten dengan brand, bukan benturan.

---

## 2. Color Tokens (semantik)

> Gunakan **token semantik**, jangan hex mentah di komponen. Functional color (error/success) wajib disertai ikon/teks — jangan andalkan warna saja.

### Skala Primary (Marine Blue / Indigo)
| Step | Hex |
|------|-----|
| 50 | `#EEEEFA` |
| 100 | `#DCDCF4` |
| 200 | `#BBBAEA` |
| 300 | `#9897DC` |
| 400 | `#6A69C6` |
| 500 | `#4B4AB0` |
| **600 (brand)** | `#343399` |
| 700 | `#2B2A80` |
| 800 | `#232267` |
| 900 | `#1A1A4D` |

### Status (sama di light & dark, sesuaikan kontras)
| Token | Light | Dark | Makna |
|-------|-------|------|-------|
| `success` | `#16A34A` | `#22C55E` | closed, valid, selesai |
| `warning` | `#F59E0B` | `#FBBF24` | open, akan kedaluwarsa |
| `danger`  | `#DC2626` | `#F87171` | overdue, expired, error, destructive |
| `info`    | `#0EA5E9` | `#38BDF8` | netral/informasi |
| `accent`  | `#E11D27` | `#F0464E` | aksen brand (hemat) |

### Surface & Text — **Light**
| Token | Hex | Pakai |
|-------|-----|-------|
| `bg` (page) | `#F1F5F9` | latar halaman |
| `surface` (card) | `#FFFFFF` | kartu, panel, navbar |
| `surface-2` | `#F8FAFC` | header tabel, baris zebra |
| `border` | `#E2E8F0` | garis, divider |
| `text` | `#0F172A` | teks utama (≥ 4.5:1) |
| `text-muted` | `#475569` | teks sekunder (≥ 4.5:1) |
| `text-subtle` | `#94A3B8` | placeholder, hint |

### Surface & Text — **Dark**
| Token | Hex | Pakai |
|-------|-----|-------|
| `bg` (page) | `#0F172A` | latar halaman |
| `surface` (card) | `#1E293B` | kartu, panel, navbar |
| `surface-2` | `#243044` | header tabel, hover |
| `border` | `#334155` | garis, divider (harus tetap terlihat) |
| `text` | `#F1F5F9` | teks utama (≥ 4.5:1) |
| `text-muted` | `#CBD5E1` | teks sekunder (≥ 3:1) |
| `text-subtle` | `#94A3B8` | placeholder, hint |
| `primary` (dark) | `#9897DC` | link/teks brand di atas gelap (indigo-300) |
| `primary-btn` (dark) | `#4B4AB0` | bg tombol primary di dark |

**Aturan dark mode:** pakai varian tonal yang di-*desaturate*/diterangkan, **bukan** warna light yang dibalik. Uji kontras dark secara terpisah. Border & status harus tetap terbaca di kedua mode.

---

## 3. Typography

- **UI font:** `Inter` (semua teks antarmuka — heading, body, label, tombol).
- **Angka/data:** `JetBrains Mono` (kolom angka tabel, KPI, timer, kode) → pakai tabular figures agar tidak geser layout.
- **Fallback:** `system-ui, -apple-system, Segoe UI, Roboto, sans-serif`.

```css
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap');
```
> Catatan migrasi: ini menggantikan `Figtree` (Breeze) & `Source Sans Pro` (AdminLTE default) agar satu suara di seluruh aplikasi. `font-display: swap` wajib.

### Skala tipe (rem @ base 16px)
| Peran | Size | Weight | Line-height |
|------|------|--------|-------------|
| Display / H1 | 30px (1.875) | 700 | 1.25 |
| H2 | 24px (1.5) | 600 | 1.3 |
| H3 / Card title | 18px (1.125) | 600 | 1.4 |
| Body | 16px (1.0) | 400 | 1.5 |
| Body-sm / label | 14px (0.875) | 500 | 1.45 |
| Caption | 12px (0.75) | 500 | 1.4 |

- Body min **16px** (mobile, hindari auto-zoom iOS). Jangan teks < 12px.
- Hierarki lewat **size + weight + spacing**, bukan warna saja.

---

## 4. Spacing, Radius, Elevation

**Spacing scale (4/8px):** `4 · 8 · 12 · 16 · 24 · 32 · 48 · 64`. Padding kartu = 24px (desktop), 16px (mobile). Jarak antar section = 32px.

**Radius (flat-modern, lembut tidak bulat ekstrem):**
| Token | px | Pakai |
|-------|----|----|
| `sm` | 6 | input, badge, tombol |
| `md` | 10 | kartu, panel, modal |
| `lg` | 16 | kartu besar/hero |
| `full` | 9999 | avatar, pill, toggle |

**Elevation (shadow halus — flat):** gunakan skala konsisten, jangan acak.
| Token | Shadow (light) |
|-------|----------------|
| `e0` | none (datar, andalkan border) |
| `e1` | `0 1px 2px rgba(15,23,42,.06)` — kartu default |
| `e2` | `0 4px 12px rgba(15,23,42,.08)` — hover kartu, dropdown |
| `e3` | `0 12px 28px rgba(15,23,42,.12)` — modal, popover |
> Dark mode: turunkan opacity shadow & andalkan `border` + `surface-2` untuk memisahkan layer.

---

## 5. Komponen (spesifikasi inti)

**Button**
- Tinggi ≥ 40px desktop, **≥ 44px** mobile (touch target). Radius `sm`. Padding-x 16px.
- Primary = bg `primary-600`, teks putih. Secondary = surface + border. Danger = `danger`.
- **Satu primary CTA per layar**; aksi lain subordinat. State hover/focus/active/disabled jelas; transisi 150–200ms. Disabled: opacity .5 + `cursor-not-allowed` + atribut `disabled`. Saat async: disable + spinner.

**Card / Panel**
- `surface`, radius `md`, shadow `e1`, padding 24px. Judul pakai H3. Hindari shadow tebal.

**Table (modul CRUD)**
- Header `surface-2` + teks `text-muted` uppercase 12px. Zebra row opsional, hover row `surface-2`.
- Angka **rata kanan** + `JetBrains Mono`. Sediakan **empty state** (ikon + pesan), bukan tabel kosong.
- Sortable: indikasikan kolom aktif (aria-sort). Aksi baris di kanan, aksi destructive (hapus) dipisah visual + warna `danger` + konfirmasi.

**Form**
- **Label terlihat** di atas input (bukan placeholder-as-label). Wajib → tanda `*`.
- Helper text persisten di bawah input bila kompleks. Error **di bawah field** terkait + `role="alert"`, sebut sebab + cara perbaiki.
- Validasi saat blur, bukan tiap ketik. Input tipe semantik (`email`/`tel`/`number`/`date`). Password punya toggle show/hide. Tinggi input ≥ 44px mobile.

**Navigation (AdminLTE sidebar)**
- Sidebar = navigasi sekunder/struktur; jangan aksi utama di sini. Item punya **ikon + label**. Lokasi aktif di-highlight (warna primary + weight). Penempatan nav konsisten antar halaman.
- Aksi berbahaya (logout) dipisah dari item nav biasa.

**Charts (Chart.js)**
- Pilih tipe sesuai data: tren→line, perbandingan→bar, proporsi→doughnut (≤5 kategori). Selalu ada **legend + tooltip** (nilai + %). Warna status pakai token status (jangan andalkan warna saja → sertakan label).
- Empty state "Belum ada data". Hormati `prefers-reduced-motion`. `role="img"` + `aria-label` per canvas. Angka format locale `id-ID`.

**Badge status** (dipakai lintas modul):
`Open`→warning · `Overdue`/`Expired`→danger · `Closed`/`Valid`/`Selesai`→success · `Pending`/`Info`→info. Selalu **teks + warna** (+ ikon bila memungkinkan).

---

## 6. Motion

- Micro-interaction **150–300ms**, transisi kompleks ≤ 400ms, hindari > 500ms.
- Animasikan `transform`/`opacity` saja (jangan width/height/top/left → cegah CLS).
- Easing: ease-out saat masuk, ease-in saat keluar. Exit ~60–70% durasi enter.
- Setiap animasi bermakna (sebab-akibat), bukan dekorasi. **Wajib** hormati `prefers-reduced-motion`.

---

## 7. Layout & Responsive

- Breakpoint sistematis: **375 / 768 / 1024 / 1440**. Mobile-first.
- `viewport` = `width=device-width, initial-scale=1` (jangan disable zoom).
- Tidak ada horizontal scroll di mobile. Max-width konten desktop konsisten.
- Sidebar AdminLTE sudah **fixed** (`layout_fixed_sidebar => true`) — konten beri padding agar tidak ketutup elemen fixed.
- z-index berskala: `0 / 10 / 20 (sticky) / 40 (sidebar) / 1000 (modal) / 1100 (toast)`.

---

## 8. Accessibility (WAJIB)

- Kontras teks ≥ **4.5:1** (normal), ≥ 3:1 (teks besar/ikon UI) — di **kedua** mode.
- Focus ring terlihat (2–4px) di semua elemen interaktif; jangan dihapus.
- Tombol ikon-saja → `aria-label`. Gambar bermakna → alt text. Hierarki heading runut (h1→h6).
- Warna **bukan** satu-satunya penanda (tambah ikon/teks). Dukung scaling teks tanpa rusak layout.
- Toast: `aria-live="polite"`, auto-dismiss 3–5s, tidak merebut fokus.

---

## 9. Anti-pattern (HINDARI)

- Emoji sebagai ikon (pakai FontAwesome/Heroicons/Lucide — vektor).
- Hex mentah di komponen (pakai token).
- Shadow tebal/acak (gaya ini flat — shadow halus & konsisten).
- Pie/doughnut > 5 kategori; makna lewat warna saja.
- Placeholder dijadikan label; error hanya di atas form.
- Dark mode hasil "invert" dari light.

---

## 10. Implementasi token

### A. CSS Variables (taruh global, mis. `resources/css/app.css`, dipakai admin & publik)
```css
:root{
  --color-bg:#F1F5F9; --color-surface:#FFFFFF; --color-surface-2:#F8FAFC;
  --color-border:#E2E8F0; --color-text:#0F172A; --color-text-muted:#475569; --color-text-subtle:#94A3B8;
  --color-primary:#343399; --color-primary-600:#343399; --color-primary-700:#2B2A80;
  --color-on-primary:#FFFFFF; --color-accent:#E11D27;
  --color-success:#16A34A; --color-warning:#F59E0B; --color-danger:#DC2626; --color-info:#0EA5E9;
  --radius-sm:6px; --radius-md:10px; --radius-lg:16px;
  --shadow-e1:0 1px 2px rgba(15,23,42,.06); --shadow-e2:0 4px 12px rgba(15,23,42,.08); --shadow-e3:0 12px 28px rgba(15,23,42,.12);
}
:root.dark, [data-theme="dark"]{
  --color-bg:#0F172A; --color-surface:#1E293B; --color-surface-2:#243044;
  --color-border:#334155; --color-text:#F1F5F9; --color-text-muted:#CBD5E1; --color-text-subtle:#94A3B8;
  --color-primary:#9897DC; --color-primary-600:#4B4AB0; --color-primary-700:#343399;
  --color-on-primary:#FFFFFF; --color-accent:#F0464E;
  --color-success:#22C55E; --color-warning:#FBBF24; --color-danger:#F87171; --color-info:#38BDF8;
  --shadow-e1:0 1px 2px rgba(0,0,0,.4); --shadow-e2:0 4px 12px rgba(0,0,0,.45); --shadow-e3:0 12px 28px rgba(0,0,0,.5);
}
```

### B. Tailwind (`tailwind.config.js` → untuk auth/publik berbasis Tailwind)
```js
theme:{ extend:{
  fontFamily:{ sans:['Inter','system-ui','sans-serif'], mono:['JetBrains Mono','monospace'] },
  colors:{
    bg:'var(--color-bg)', surface:'var(--color-surface)', 'surface-2':'var(--color-surface-2)',
    border:'var(--color-border)',
    primary:{ DEFAULT:'var(--color-primary)', 600:'#343399', 700:'#2B2A80' },
    accent:'var(--color-accent)',
    success:'var(--color-success)', warning:'var(--color-warning)',
    danger:'var(--color-danger)', info:'var(--color-info)',
  },
  borderRadius:{ sm:'6px', md:'10px', lg:'16px' },
  boxShadow:{ e1:'var(--shadow-e1)', e2:'var(--shadow-e2)', e3:'var(--shadow-e3)' },
}}
// + aktifkan: darkMode: 'class'
```

### C. AdminLTE (Bootstrap) — selaraskan via variabel + sedikit override
- Set `config/adminlte.php`: tema sidebar gelap netral, dan tambahkan CSS variabel di atas pada layout admin.
- Override warna primer Bootstrap (`.btn-primary`, `.bg-primary`, `.text-primary`, link) → `var(--color-primary)`.
- Aktifkan dark mode AdminLTE selaras token (toggle menyetel `data-theme="dark"` pada `<body>`).

---

## 11. Cara pakai per halaman (retrieval)
> Saat membangun halaman X: baca `design-system/MASTER.md`. Cek apakah ada `design-system/pages/x.md`. Jika ada, prioritaskan aturan di sana; jika tidak, pakai MASTER sepenuhnya.

Override per-halaman ditaruh di `design-system/pages/<slug>.md` (mis. `dashboard.md`, `login.md`, `public-dashboard.md`).
