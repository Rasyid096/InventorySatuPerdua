# Requirements Document: UI TailwindCSS Cleanup & Shared Components

## Introduction

Proyek aplikasi Sistem Stok Bahan Baku saat ini menggunakan CSS manual yang tersebar di berbagai file Blade, menyebabkan inkonsistensi UI, duplikasi kode, dan kesulitan maintenance. Tujuan dari perubahan ini adalah:

1. **Migrasi ke TailwindCSS** - Memanfaatkan TailwindCSS v4 yang sudah terinstall
2. **Shared Components** - Membuat Blade components yang reusable
3. **SweetAlert2 Integration** - Mengganti native confirm/alert dengan SweetAlert2
4. **Responsive Design** - Memastikan seluruh halaman responsive di semua device
5. **Design Consistency** - Mengikuti pola JokoUI untuk UI modern dan konsisten

---

## Requirements

### Requirement 1: TailwindCSS Configuration & Setup

**User Story:** Sebagai developer, saya ingin TailwindCSS dikonfigurasi dengan benar dan CSS lama dimigrasikan, sehingga kode CSS lebih maintainable dan konsisten.

#### Acceptance Criteria

1. WHEN project builds THEN system SHALL compile TailwindCSS from resources/css/app.css
2. WHEN Vite runs THEN system SHALL hot-reload TailwindCSS changes correctly
3. WHEN custom colors needed (primary-green #0fa958) THEN system SHALL define them in Tailwind theme config
4. WHEN layout loads THEN system SHALL include compiled Tailwind styles via @vite directive
5. IF old inline CSS exists THEN system SHALL migrate to Tailwind utility classes or shared components

---

### Requirement 2: Shared Blade Components Library

**User Story:** Sebagai developer, saya ingin komponen UI yang reusable, sehingga tidak perlu menduplikasi HTML/CSS di setiap halaman.

#### Acceptance Criteria

1. WHEN card component needed THEN system SHALL provide `<x-card>` component dengan slot untuk content
2. WHEN button component needed THEN system SHALL provide `<x-btn>` dengan variants: primary, secondary, danger, warning, success, outline
3. WHEN alert/notification needed THEN system SHALL provide `<x-alert>` dengan variants: success, error, warning, info
4. WHEN modal needed THEN system SHALL provide `<x-modal>` dengan Alpine.js for state management
5. WHEN table needed THEN system SHALL provide `<x-data-table>` dengan header slot dan rows slot
6. WHEN form input needed THEN system SHALL provide `<x-input>`, `<x-select>`, `<x-textarea>` components
7. WHEN badge needed THEN system SHALL provide `<x-badge>` dengan variants: admin, cabang, karyawan, default
8. WHEN page header needed THEN system SHALL provide `<x-page-header>` dengan title, breadcrumb, dan action slots
9. WHEN stat card needed (dashboard) THEN system SHALL provide `<x-stat-card>` dengan icon, label, value props

---

### Requirement 3: SweetAlert2 Integration

**User Story:** Sebagai user, saya ingin notifikasi dan konfirmasi yang lebih user-friendly dan modern, sehingga pengalaman menggunakan aplikasi lebih menyenangkan.

#### Acceptance Criteria

1. WHEN page loads THEN system SHALL include SweetAlert2 library via CDN
2. WHEN delete action triggered THEN system SHALL show SweetAlert2 confirmation dialog dengan icon warning
3. WHEN bulk delete triggered THEN system SHALL show SweetAlert2 dengan pesan peringatan bahaya merah
4. WHEN form submit success THEN system SHALL show SweetAlert2 success toast notification
5. WHEN error occurs THEN system SHALL show SweetAlert2 error notification
6. IF server returns flash message THEN system SHALL auto-trigger corresponding SweetAlert2 notification
7. WHEN confirmation needed THEN system SHALL return promise yang dapat di-chain dengan form submit

---

### Requirement 4: Responsive Design Implementation

**User Story:** Sebagai user mobile, saya ingin mengakses aplikasi dengan nyaman di smartphone dan tablet, sehingga bisa melakukan pekerjaan dari mana saja.

#### Acceptance Criteria

1. WHEN viewport < 768px THEN system SHALL collapse sidebar into hamburger menu
2. WHEN viewport < 768px THEN system SHALL stack table columns or enable horizontal scroll
3. WHEN viewport < 640px THEN system SHALL stack form-row columns vertically
4. WHEN viewport < 768px THEN system SHALL adjust modal width to full-width with padding
5. WHEN viewport < 768px THEN system SHALL adjust dashboard stat cards to stack vertically
6. WHEN viewport < 768px THEN system SHALL reduce topbar height and font sizes appropriately
7. WHEN any viewport size THEN system SHALL maintain readable font sizes (min 14px body, 12px small)
8. WHEN touch device detected THEN system SHALL ensure minimum tap target of 44x44px for interactive elements

---

### Requirement 5: Admin Layout Refactoring

**User Story:** Sebagai developer, saya ingin layout admin yang clean dan modular, sehingga mudah di-maintain dan di-extend.

#### Acceptance Criteria

1. WHEN admin layout renders THEN system SHALL use @vite for CSS/JS instead of inline styles
2. WHEN sidebar renders THEN system SHALL use Alpine.js for mobile toggle state
3. WHEN page renders THEN system SHALL apply consistent spacing using Tailwind (p-4, p-6, gap-4, etc.)
4. WHEN topbar renders THEN system SHALL display user info dengan null-safe access
5. IF user not authenticated THEN system SHALL show guest placeholder in topbar
6. WHEN layout loads THEN system SHALL include FontAwesome icons via CDN (already exists)
7. WHEN layout loads THEN system SHALL include Chart.js via CDN for dashboard charts

---

### Requirement 6: Page-Specific Migrations

**User Story:** Sebagai developer, saya ingin setiap halaman menggunakan shared components dan Tailwind, sehingga kode lebih DRY dan konsisten.

#### Acceptance Criteria

1. WHEN dashboard page renders THEN system SHALL use x-stat-card, x-card components
2. WHEN data_barang page renders THEN system SHALL use x-page-header, x-card, x-data-table, x-modal, x-btn components
3. WHEN barang_masuk page renders THEN system SHALL use same shared components as data_barang
4. WHEN barang_keluar page renders THEN system SHALL use same shared components as data_barang  
5. WHEN laporan pages render THEN system SHALL use x-card, x-data-table with print-friendly styles
6. WHEN manajemen_user page renders THEN system SHALL use x-modal, x-badge, x-btn components
7. WHEN pengaturan_satuan page renders THEN system SHALL use x-modal, x-data-table components
8. WHEN login page renders THEN system SHALL use Tailwind classes for responsive form layout
9. WHEN any page renders THEN system SHALL NOT have inline `<style>` blocks (except print styles)

---

### Requirement 7: Design Tokens & Consistency

**User Story:** Sebagai designer, saya ingin design tokens yang terdefinisi dengan jelas, sehingga visual consistency terjaga di seluruh aplikasi.

#### Acceptance Criteria

1. WHEN primary color needed THEN system SHALL use #0fa958 (primary-green) consistently
2. WHEN danger color needed THEN system SHALL use #dc3545 consistently
3. WHEN warning color needed THEN system SHALL use #ffc107 consistently
4. WHEN success color needed THEN system SHALL use #198754 consistently
5. WHEN border radius needed THEN system SHALL use rounded-lg (8px) for cards, rounded for buttons
6. WHEN shadow needed THEN system SHALL use shadow-sm for cards, shadow-md for modals
7. WHEN spacing needed THEN system SHALL follow 4px grid system (p-1=4px, p-2=8px, p-4=16px, etc.)
8. WHEN typography needed THEN system SHALL use 'Instrument Sans' as primary font (already in config)

---

## Technical Constraints

1. **No npm build required for production** - Tetap gunakan CDN untuk libs yang tidak compile-time critical
2. **Laravel Blade components** - Gunakan anonymous Blade components di `resources/views/components/`
3. **Alpine.js** - Gunakan untuk interaktivitas client-side (modal, toggle, dropdown)
4. **TailwindCSS v4** - Sudah terinstall, perlu setup proper build process
5. **Backward compatibility** - Existing functionality harus tetap berjalan
6. **No breaking changes** - Perubahan visual, bukan fungsional

---

## Out of Scope

1. Database schema changes
2. Backend logic modifications (controllers tetap sama)
3. Authentication flow changes
4. New features atau pages
5. Unit/integration testing
