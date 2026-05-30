# Sistem Stok Bahan Baku - 1/2 Kopi Tiam

Aplikasi manajemen stok bahan baku berbasis Laravel untuk operasional harian 1/2 Kopi Tiam.

## Fitur Utama

- Dashboard ringkasan stok dan aktivitas
- Manajemen data barang
- Transaksi barang masuk dan keluar
- Laporan stok, laporan barang masuk, laporan barang keluar
- Manajemen user (admin)
- Pengaturan satuan barang
- Backup database
- Landing page publik untuk profil bisnis

## Tech Stack

- PHP 8.3+ (project default)
- Laravel 13
- Blade + TailwindCSS v4
- Alpine.js
- SweetAlert2
- Vite
- MySQL / MariaDB

## Struktur Route

- Publik:
  - `/` landing page
  - `/login` autentikasi
- Admin (prefix):
  - `/admin`
  - `/admin/data-barang`
  - `/admin/barang-masuk`
  - `/admin/barang-keluar`
  - `/admin/laporan-*`
  - `/admin/manajemen-user`
  - `/admin/pengaturan-satuan`
  - `/admin/backup-database`
  - `/admin/tentang-aplikasi`

## Setup Lokal

1. Install dependency:
```bash
composer install
npm install
```

2. Copy env:
```bash
cp .env.example .env
```

3. Generate key:
```bash
php artisan key:generate
```

4. Konfigurasi database di `.env`, lalu migrate:
```bash
php artisan migrate
```

5. Jalankan dev:
```bash
composer dev
```

## Deploy via Docker (Railway-friendly)

Project ini sudah disiapkan untuk deploy berbasis Docker dengan container berjalan sebagai root/superuser sesuai request.

### File deploy yang disediakan

- `Dockerfile`
- `docker/start.sh`
- `docker/nginx.conf.template`
- `docker/supervisord.conf`
- `docker/php.ini`
- `.env.deploy`

### Build dan run lokal (opsional)

```bash
docker build -t stok-barang .
docker run --rm -p 8080:8080 --env-file .env.deploy stok-barang
```

Lalu akses: `http://localhost:8080`

## Catatan Deploy

- Asset CSS/JS dibuild saat image build (multi-stage Node -> PHP)
- `start.sh` akan:
  - fallback copy `.env.deploy` ke `.env` jika `.env` belum ada
  - render config Nginx memakai env `PORT`
  - generate APP_KEY jika kosong
  - cache config/route/view
  - menjalankan migrasi (best effort)
- Health endpoint tersedia di `/health`

## Environment Variables Penting

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL`
- `PORT` (di-platform, otomatis dari Railway)
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

## Troubleshooting Singkat

- Error autoload/vendor: hapus `vendor` lalu `composer install`
- CSS tidak muncul: pastikan build assets sukses saat docker build
- Error DB saat startup: cek kredensial DB dan network access database
