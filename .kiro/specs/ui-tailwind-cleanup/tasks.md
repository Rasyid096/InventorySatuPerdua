# Implementation Plan: UI TailwindCSS Cleanup & Shared Components

## Phase 1: Foundation Setup

- [x] 1. Configure TailwindCSS Theme & Vite Build
  - [x] 1.1 Update resources/css/app.css dengan custom theme colors
    - Add brand colors (--color-primary: #0fa958, --color-primary-dark: #0c8a47)
    - Add [x-cloak] utility for Alpine.js
    - _Requirements: 1.3, 7.1, 7.2_

  - [x] 1.2 Install dan setup Alpine.js
    - Run `npm install alpinejs`
    - Configure resources/js/app.js untuk import dan start Alpine
    - _Requirements: 5.2_

  - [x] 1.3 Test Vite build process
    - Run `npm run build` to verify compilation
    - Check output di public/build folder
    - _Requirements: 1.1, 1.2_

---

## Phase 2: Create Blade Components

- [x] 2. Create Core UI Components
  - [x] 2.1 Create x-card component
    - File: resources/views/components/card.blade.php
    - Props: title, class
    - Slots: default, header (optional)
    - _Requirements: 2.1_

  - [x] 2.2 Create x-btn component
    - File: resources/views/components/btn.blade.php
    - Props: variant, size, icon, href, type
    - Support: primary, secondary, danger, warning, success, outline variants
    - _Requirements: 2.2_

  - [x] 2.3 Create x-alert component
    - File: resources/views/components/alert.blade.php
    - Props: type (success/error/warning/info), dismissible
    - Use Alpine.js for dismiss functionality
    - _Requirements: 2.3_

  - [x] 2.4 Create x-badge component
    - File: resources/views/components/badge.blade.php
    - Props: variant (admin/cabang/karyawan/success/warning/danger/default)
    - _Requirements: 2.7_

- [x] 3. Create Form Components
  - [x] 3.1 Create x-input component
    - File: resources/views/components/input.blade.php
    - Props: name, label, type, error, required, placeholder
    - Support: text, email, password, number, date, file types
    - Error state styling
    - _Requirements: 2.6_

  - [x] 3.2 Create x-select component
    - File: resources/views/components/select.blade.php
    - Props: name, label, error, required
    - Slot for options
    - _Requirements: 2.6_

  - [x] 3.3 Create x-textarea component
    - File: resources/views/components/textarea.blade.php
    - Props: name, label, error, required, rows
    - _Requirements: 2.6_

- [x] 4. Create Complex Components
  - [x] 4.1 Create x-modal component
    - File: resources/views/components/modal.blade.php
    - Props: name, title, maxWidth
    - Alpine.js untuk open/close state
    - Event listeners: open-modal, close-modal
    - Keyboard escape to close
    - _Requirements: 2.4_

  - [x] 4.2 Create x-data-table component
    - File: resources/views/components/data-table.blade.php
    - Props: searchable, perPage
    - Slots: header, default (rows)
    - Responsive horizontal scroll
    - _Requirements: 2.5_

  - [x] 4.3 Create x-page-header component
    - File: resources/views/components/page-header.blade.php
    - Props: title, subtitle, breadcrumbs
    - Action slot untuk buttons
    - Responsive stacking
    - _Requirements: 2.8_

  - [x] 4.4 Create x-stat-card component
    - File: resources/views/components/stat-card.blade.php
    - Props: icon, label, value, color
    - Hover animation
    - _Requirements: 2.9_

---

## Phase 3: SweetAlert2 Integration

- [x] 5. Setup SweetAlert2
  - [x] 5.1 Create SweetAlert2 helper functions di app.js
    - confirmDelete() - untuk konfirmasi hapus
    - confirmDanger() - untuk aksi berbahaya (bulk delete)
    - toast() - untuk notifikasi toast
    - Auto-show flash messages dari meta tags
    - _Requirements: 3.1, 3.2, 3.3, 3.4, 3.5, 3.6, 3.7_

---

## Phase 4: Refactor Admin Layout

- [x] 6. Refactor layouts/admin.blade.php
  - [x] 6.1 Add Vite directives dan external CDNs
    - @vite untuk CSS dan JS
    - SweetAlert2 CDN
    - FontAwesome CDN (keep existing)
    - Chart.js CDN (keep existing)
    - Meta tags untuk flash messages
    - _Requirements: 5.1, 5.6, 5.7_

  - [x] 6.2 Implement responsive sidebar dengan Alpine.js
    - x-data untuk sidebarOpen state
    - Mobile hamburger button di topbar
    - Overlay untuk mobile
    - Transform classes untuk slide in/out
    - _Requirements: 4.1, 5.2_

  - [x] 6.3 Refactor topbar ke Tailwind classes
    - Responsive padding dan font sizes
    - User info null-safe display
    - Mobile hamburger toggle
    - _Requirements: 5.4, 5.5, 4.6_

  - [x] 6.4 Remove semua inline <style> blocks
    - Migrasi styles ke Tailwind utilities
    - Keep only critical print styles jika ada
    - _Requirements: 6.9_

---

## Phase 5: Migrate Individual Pages

- [x] 7. Migrate Dashboard Page
  - [x] 7.1 Refactor dashboard.blade.php
    - Replace stat cards dengan x-stat-card component
    - Replace card div dengan x-card component
    - Remove inline styles
    - Responsive grid untuk stat cards (grid-cols-1 md:grid-cols-3)
    - _Requirements: 6.1, 4.5_

- [x] 8. Migrate Data Barang Page
  - [x] 8.1 Refactor data_barang.blade.php
    - Use x-page-header dengan breadcrumbs
    - Use x-card untuk table container
    - Use x-data-table untuk table
    - Use x-btn untuk action buttons
    - Use x-badge untuk status (stok-aman, stok-menipis)
    - Use x-modal untuk edit modal
    - Replace confirm() dengan SweetAlert2
    - Remove inline styles
    - _Requirements: 6.2, 3.2_

- [x] 9. Migrate Barang Masuk Page
  - [x] 9.1 Refactor barang_masuk.blade.php
    - Use x-page-header
    - Use x-card, x-data-table
    - Use x-modal untuk entry dan edit forms
    - Use x-input, x-select untuk form fields
    - Use x-btn components
    - SweetAlert2 untuk confirmations
    - Remove inline styles
    - _Requirements: 6.3, 3.2_

- [x] 10. Migrate Barang Keluar Page
  - [x] 10.1 Refactor barang_keluar.blade.php
    - Same pattern as barang_masuk
    - Use shared components
    - SweetAlert2 integration
    - Remove inline styles
    - _Requirements: 6.4, 3.2_

- [x] 11. Migrate Laporan Pages
  - [x] 11.1 Refactor laporan_stok.blade.php
    - Use x-card, x-data-table
    - Keep print-friendly styles di separate @media print
    - Use x-badge untuk status
    - _Requirements: 6.5_

  - [x] 11.2 Refactor laporan_barang_masuk.blade.php
    - Same pattern as laporan_stok
    - Date filter dengan x-input
    - _Requirements: 6.5_

  - [x] 11.3 Refactor laporan_barang_keluar.blade.php
    - Same pattern as laporan_stok
    - _Requirements: 6.5_

- [x] 12. Migrate Settings Pages
  - [x] 12.1 Refactor manajemen_user.blade.php
    - Use x-page-header, x-card, x-data-table
    - Use x-modal untuk add/edit user
    - Use x-badge untuk hak_akses
    - Use x-input, x-select untuk forms
    - SweetAlert2 untuk delete confirmation
    - _Requirements: 6.6_

  - [x] 12.2 Refactor pengaturan_satuan.blade.php
    - Use x-card, x-data-table
    - Use x-modal untuk add/edit satuan
    - SweetAlert2 integration
    - _Requirements: 6.7_

  - [x] 12.3 Refactor backup.blade.php
    - Use x-card, x-btn
    - SweetAlert2 untuk confirmations
    - _Requirements: 6.2_

  - [x] 12.4 Refactor tentang_aplikasi.blade.php
    - Use x-card
    - Clean Tailwind styling
    - _Requirements: 6.2_

- [x] 13. Migrate Login Page
  - [x] 13.1 Refactor login.blade.php
    - Migrate ke Tailwind classes
    - Keep responsive breakpoints
    - Maintain existing tab functionality
    - SweetAlert2 untuk error messages
    - _Requirements: 6.8_

---

## Phase 6: Final Cleanup & Testing

- [x] 14. Final Cleanup
  - [x] 14.1 Remove semua unused CSS
    - Check tidak ada inline styles tersisa
    - Remove old CSS classes dari layout
    - _Requirements: 6.9_

  - [x] 14.2 Verify responsive design
    - Test di 320px (mobile small)
    - Test di 375px (mobile)
    - Test di 768px (tablet)
    - Test di 1024px (laptop)
    - Test di 1440px (desktop)
    - _Requirements: 4.1, 4.2, 4.3, 4.4, 4.5, 4.6, 4.7, 4.8_

  - [x] 14.3 Verify SweetAlert2 integration
    - Test semua delete confirmations
    - Test bulk delete confirmations
    - Test flash message toasts
    - _Requirements: 3.2, 3.3, 3.4, 3.5_

  - [x] 14.4 Cross-browser testing
    - Test di Chrome
    - Test di Firefox
    - Test di Edge
    - _Requirements: Implisit_

- [x] 15. Build Production Assets
  - [x] 15.1 Run final production build
    - `npm run build`
    - Verify semua assets compiled correctly
    - Test production build di browser
    - _Requirements: 1.1_

---

## Notes

- **Incremental Migration**: Setiap page bisa di-migrate satu per satu tanpa breaking yang lain
- **Backward Compatibility**: Existing functionality harus tetap jalan selama migrasi
- **Component Testing**: Test setiap component setelah dibuat sebelum digunakan di pages
- **Keep Print Styles**: Untuk laporan pages, tetap pertahankan @media print styles
