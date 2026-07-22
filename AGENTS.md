# AGENTS.md

## Tujuan

Panduan kerja untuk agent dan developer yang mengubah codebase ini. Ikuti source aktual, bukan asumsi dari dokumentasi lama.

## Prinsip Dasar

- Sumber kebenaran utama adalah route runtime, controller, migration, dan Blade yang aktif.
- Jangan asumsi route dari `routes/web.php` saja.
- Selalu audit `php artisan route:list` jika perubahan menyentuh navigasi atau redirect.
- Hindari refactor besar tanpa audit dampak ke route cache, link Blade, dan alur stok.

## Stack dan Pola Aplikasi

- Backend: Laravel 13
- View layer: Blade server-rendered
- Frontend: Alpine.js + Vite + Tailwind CSS v4
- Notifikasi UI: SweetAlert2 via CDN
- Chart: Chart.js via CDN
- Data access utama: Query Builder (`DB::table(...)`)

## Konvensi Arsitektur

- Untuk modul stok dan laporan, ikuti pola existing berbasis Query Builder.
- Jangan memperkenalkan repository/service layer baru kecuali diminta eksplisit.
- Jangan migrasikan sebagian kecil file ke Eloquent-only style jika modul sekitarnya masih Query Builder.
- Pertahankan alur server-rendered Blade; jangan tambahkan SPA pattern tanpa arahan eksplisit.

## Konvensi Route

- Route publik (tanpa auth) ada di root — `/login`, `/logout`, `/forgot-password/*`, `/register-first-user`.
- Route yang butuh auth ada di dalam grup `middleware('auth')` — tanpa prefix `/admin`.
- Route dikelompokkan berdasarkan fungsi: `master-data/`, `transaksi/`, `laporan/`, `pengaturan/`.
- Sebelum mengubah URL, cek semua referensi di:
  - controller redirect
  - sidebar/layout Blade
  - named route
  - route cache
- Jika perubahan route dilakukan, sinkronkan seluruh link terkait dalam satu pekerjaan.

## Konvensi Database

- Tabel inti domain:
  - `barang_master`
  - `transaksi_stok`
  - `satuan_barang`
  - `preset_barang`
  - `activity_logs`
  - `users`
  - `cabang` — tabel cabang (Sepakat 2, Reformasi, Stand Event, Galeri, Gudang Utama, Petani)
- Saat menambah fitur stok, pikirkan dampak ke `barang_master.stok_saat_ini` dan histori `transaksi_stok`.
- Jangan edit logika transaksi tanpa mempertimbangkan rekonsiliasi stok.
- Backup database saat ini MySQL-oriented; jangan menganggap fitur itu portable ke SQLite/Postgres.
- `cabang_id` = 5 adalah **Gudang Utama** — memiliki fitur tambahan (harga_total, cabang_tujuan, pengambil).

## Konvensi Coding PHP

- Ikuti style existing file di sekitar area yang diedit.
- Gunakan import yang jelas; hindari FQCN inline jika file sekitar memakai `use`, kecuali memang pola lokalnya begitu.
- Jangan tambahkan comment baru kecuali diminta.
- Gunakan nama variabel berbahasa Indonesia jika modul sekitar sudah konsisten memakai istilah domain Indonesia.
- Untuk pesan flash, ikuti pola existing: `with('success', ...)`, `with('error', ...)`, `with('warning', ...)`.
- Untuk otorisasi sederhana, ikuti middleware `role` atau guard berbasis `hak_akses` yang sudah ada.
- `cabang_id` = 5 adalah **Gudang Utama** — memiliki fitur tambahan (harga_total, cabang_tujuan, pengambil).

## Konvensi Blade dan Frontend

- Ikuti komponen Blade yang sudah ada seperti `x-input`, `x-btn`, `x-alert`, `x-icon`, `x-nav-link`.
- Jangan masukkan library frontend baru tanpa verifikasi dependency dan alasan kuat.
- Jika butuh ikon, gunakan `x-icon` dan map ikon yang sudah ada.
- Pertahankan pola Alpine ringan untuk state UI sederhana.
- Jangan pindahkan SweetAlert2 atau Chart.js ke bundle npm kecuali memang diminta.

## Konvensi Asset

- Entry asset utama:
  - `resources/js/app.js`
  - `resources/css/app.css`
- Setelah mengubah asset frontend, validasi dengan `npm run build`.

## Konvensi Testing dan Validasi

Sebelum selesai, jalankan command yang relevan jika perubahan menyentuh area tersebut:

- `npm run build`
- `composer test`
- `vendor/bin/pint --test`

Catatan penting:

- Repo ini saat ini memang punya kegagalan existing pada test contoh default dan style Pint di banyak file.
- Jangan klaim repo clean jika command gagal karena baseline existing.
- Tetap laporkan dengan jelas apakah kegagalan berasal dari perubahan baru atau kondisi lama repo.

## Konvensi Edit Aman

- Sebelum ubah controller transaksi, baca controller pasangan dan migration tabel terkait.
- Sebelum ubah auth, cek login, register-first-user, reset password, dan redirect pasca-login.
- Sebelum ubah route atau URL, cek sidebar, layout, dan route list.
- Sebelum hapus kolom/ubah migration, audit seeder, controller, dan Blade yang memakai kolom itu.

## Hal yang Perlu Diwaspadai

- Ada mismatch antara source route/view tertentu dengan runtime route aktif.
- `User` model menonaktifkan timestamps (`$timestamps = false`) walau tabel `users` punya timestamps.
- Edit/hapus transaksi stok saat ini bisa membuat stok master tidak sinkron.
- Route cache dapat menyamarkan perubahan route source jika cache belum dibersihkan.
- `cabang_id` = 5 adalah **Gudang Utama** — logika khusus di banyak controller (harga_total, cabang_tujuan, pengambil).
- `RoleMiddleware` — Super Admin bypass semua pengecekan role, sisanya dicek `hak_akses`.

## Preferensi Commit dan Scope

- Jangan commit tanpa instruksi eksplisit user.
- Jika hanya update dokumentasi, jangan sekalian refactor code.
- Jika menemukan bug tambahan saat pekerjaan dokumentasi, catat sebagai temuan, jangan diperbaiki diam-diam.
