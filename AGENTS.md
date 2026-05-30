# AGENTS.md

Panduan singkat untuk AI agent / developer yang melanjutkan project ini.

## Konteks Aplikasi

- Nama: Sistem Stok Bahan Baku - 1/2 Kopi Tiam
- Framework: Laravel 13
- Frontend: Blade + TailwindCSS + Alpine.js
- Fokus UI: modern, responsive, konsisten antar halaman admin

## Konvensi Utama

- Route admin wajib di bawah prefix `/admin`
- Layout admin utama: `resources/views/layouts/admin.blade.php`
- Komponen Blade reusable ada di: `resources/views/components/`
- Landing page publik: `resources/views/landing.blade.php`

## Aturan Implementasi

- Pertahankan style Tailwind yang sudah ada (warna brand hijau)
- Jangan ubah struktur route tanpa update link sidebar + header
- Jika menambah halaman admin:
  - daftarkan route di group `/admin`
  - gunakan layout admin
  - utamakan komponen blade reusable
- Jika menambah interaksi UI:
  - utamakan Alpine.js ringan
  - gunakan helper SweetAlert2 di `resources/js/app.js`

## Deploy & Infra

- Deploy target: Docker-based platform (Railway-friendly)
- Docker berjalan sebagai root/superuser (sesuai requirement)
- Docker config ada di folder `docker/`
- Env deploy template: `.env.deploy`

## Checklist sebelum selesai task

- [ ] Route dan URL link sinkron
- [ ] UI mobile & desktop tetap rapi
- [ ] Build assets Vite sukses
- [ ] Tidak ada referensi route lama tanpa `/admin`
- [ ] README ikut diupdate jika ada perubahan alur deploy

## Perintah Cepat

```bash
composer install
npm install
npm run build
php artisan migrate
composer dev
```
