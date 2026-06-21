# PKLP — Sistem Monitoring QHSE & Fleet

Platform monitoring terintegrasi untuk **PT. Pelayaran Karya Lentari Perdana (PKLP)** — mengelola QHSE, audit, man-hours, sertifikat kapal, maintenance, hingga management review dalam satu dashboard. Dibangun dengan **Laravel 13** + **AdminLTE 3**.

---

## ✨ Fitur

Aplikasi terbagi menjadi panel admin (perlu login) dan halaman publik.

**Master Data**
- Master Lokasi

**Management**
- User Management (dengan peran: Super Admin, Admin QHSE, Admin Operation)

**QHSE**
- Man Hours
- HSSE Statistics
- Incident Resume
- Annual Work Plan (+ jadwal)
- Management Review
- Management Visit

**Audit**
- Checklist Template
- Internal Audit (+ checklist, export PDF)
- Audit Findings

**Operation**
- Certificate Monitoring (sertifikat kapal)
- Maintenance Checklist (+ daily check)

**Publik**
- Landing page (hero parallax + chart live)
- Public dashboard (KPI & analitik QHSE)

**Lain-lain**
- Dashboard eksekutif dengan grafik (Chart.js)
- Export **PDF** (dompdf) & **Excel** (maatwebsite/excel)
- Mode terang/gelap (dark mode)
- Tampilan responsif — tabel admin otomatis jadi kartu di layar HP

---

## 🛠️ Teknologi

| Komponen | Keterangan |
|----------|------------|
| Framework | Laravel 13 |
| Bahasa | PHP 8.4 |
| Database | MySQL |
| UI | AdminLTE 3 (Bootstrap 4), Blade |
| Auth | Laravel Breeze |
| Chart | Chart.js |
| Export | dompdf, Laravel Excel |

> Tidak memakai Vite/npm — seluruh aset front-end sudah tersedia di `public/`, jadi **tidak perlu `npm install`/`npm run`**.

---

## 📋 Prasyarat

- **PHP 8.4** (wajib — lihat `composer.json`)
- **Composer**
- **MySQL** (mis. lewat Laragon / XAMPP)

---

## 🚀 Instalasi (development)

```bash
# 1. Clone
git clone https://github.com/rillopambudii/PKLP.git
cd PKLP

# 2. Install dependency PHP
composer install

# 3. Siapkan environment
cp .env.example .env
php artisan key:generate
```

Lalu edit `.env`, sesuaikan koneksi database lokal kamu:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pklp
DB_USERNAME=root
DB_PASSWORD=
```

Buat database kosong bernama `pklp` di MySQL, lalu:

```bash
# 4. Migrasi tabel + isi data demo (akun admin, dsb)
php artisan migrate --seed

# 5. Jalankan
php artisan serve --no-reload
```

Buka **http://127.0.0.1:8000**.

> Di Windows, gunakan `--no-reload` untuk menghindari error `Failed to listen on 127.0.0.1:8000`. Tersedia juga `serve.bat` sebagai pintasan.

---

## 📱 Catatan tampilan

- **Laptop/desktop:** tabel tampil normal, seluruh kolom muat.
- **Tablet:** tabel bisa di-scroll horizontal.
- **HP:** tabel otomatis berubah jadi kartu (format `Label : Nilai`) agar mudah dibaca — ditangani oleh `public/js/responsive-tables.js` + `public/css/adminlte-theme.css`, tanpa mengubah file Blade.

---

## ☁️ Deployment

Panduan deploy ke hosting gratis (InfinityFree) tersedia di **`deploy/PANDUAN-DEPLOY-INFINITYFREE.md`**, lengkap dengan template `.env` produksi dan file pendukung.

> Catatan: hosting gratis sering hanya mendukung **PHP 8.3**, sedangkan project ini disetel untuk **8.4**. Cara menurunkan dependency ke 8.3 (khusus untuk paket upload, jangan dipakai di repo tim) ada di panduan tersebut.

---

## 👥 Catatan untuk tim

- Seluruh tim mengembangkan di **PHP 8.4** — jaga `composer.json` tetap `^8.4`.
- Saat setup awal cukup `composer install` (jangan `composer update` sembarangan) agar versi dependency konsisten antar anggota tim.

---

## 📄 Lisensi

Proyek internal PT. Pelayaran Karya Lentari Perdana. Hak cipta © PKLP.
