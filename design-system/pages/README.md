# Page Overrides

Folder ini berisi **pengecualian/override** aturan `../MASTER.md` untuk halaman tertentu.

## Aturan
- 1 file per halaman, nama = slug halaman: `dashboard.md`, `login.md`, `public-dashboard.md`, `internal-audits.md`, dst.
- Hanya tulis **yang berbeda** dari MASTER (jangan ulang seluruh sistem).
- Saat membangun halaman: baca `MASTER.md` dulu → cek file halaman di sini → jika ada, override; jika tidak, pakai MASTER.

## Template
```md
# <Page Name> — Override

**Mengapa override:** <alasan singkat>

## Deviasi dari MASTER
- <token/komponen>: <nilai baru> (alasan)
```
