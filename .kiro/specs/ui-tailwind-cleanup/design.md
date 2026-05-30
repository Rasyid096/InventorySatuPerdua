# Design Document: UI TailwindCSS Cleanup & Shared Components

## Overview

Dokumen ini menjelaskan arsitektur dan implementasi teknis untuk migrasi UI dari CSS manual ke TailwindCSS dengan shared Blade components. Pendekatan yang digunakan adalah **incremental migration** - memigrasikan per-bagian tanpa breaking existing functionality.

### Key Decisions

1. **TailwindCSS v4** - Menggunakan CSS-first configuration (tidak perlu tailwind.config.js)
2. **Anonymous Blade Components** - Simpel, tidak perlu class-based components
3. **Alpine.js** - Lightweight untuk interaktivitas (modal, dropdown, mobile toggle)
4. **SweetAlert2 via CDN** - Tidak perlu npm dependency
5. **JokoUI-inspired** - Copy-paste ready patterns, clean utility-first approach

---

## Architecture

```
resources/
├── css/
│   └── app.css                    # TailwindCSS entry + custom theme
├── js/
│   └── app.js                     # Alpine.js + SweetAlert2 helpers
└── views/
    ├── components/                # Shared Blade components
    │   ├── card.blade.php
    │   ├── btn.blade.php
    │   ├── alert.blade.php
    │   ├── modal.blade.php
    │   ├── data-table.blade.php
    │   ├── input.blade.php
    │   ├── select.blade.php
    │   ├── textarea.blade.php
    │   ├── badge.blade.php
    │   ├── page-header.blade.php
    │   └── stat-card.blade.php
    ├── layouts/
    │   └── admin.blade.php        # Refactored admin layout
    └── admin/
        └── *.blade.php            # Migrated pages
```

---

## Components and Interfaces

### Component 1: Card (`<x-card>`)

```blade
{{-- Usage --}}
<x-card class="p-6">
    <h3>Title</h3>
    <p>Content</p>
</x-card>

<x-card title="With Header" class="mt-4">
    Content with header
</x-card>
```

**Props:**
- `title` (optional): String - Header text
- `class` (optional): String - Additional classes

**Implementation:**
```blade
@props(['title' => null, 'class' => ''])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-sm ' . $class]) }}>
    @if($title)
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
        </div>
    @endif
    <div class="p-6">
        {{ $slot }}
    </div>
</div>
```

---

### Component 2: Button (`<x-btn>`)

```blade
{{-- Usage --}}
<x-btn>Default Primary</x-btn>
<x-btn variant="danger" icon="trash">Delete</x-btn>
<x-btn variant="warning" size="sm">Edit</x-btn>
<x-btn variant="secondary" href="/cancel">Cancel</x-btn>
```

**Props:**
- `variant`: primary | secondary | danger | warning | success | outline (default: primary)
- `size`: sm | md | lg (default: md)
- `icon`: FontAwesome icon name (without fa- prefix)
- `href`: If set, renders as anchor tag
- `type`: button | submit (default: button)

**Implementation:**
```blade
@props([
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'href' => null,
    'type' => 'button'
])

@php
$baseClasses = 'inline-flex items-center justify-center gap-2 font-bold rounded transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2';

$variants = [
    'primary' => 'bg-emerald-600 hover:bg-emerald-700 text-white focus:ring-emerald-500',
    'secondary' => 'bg-gray-500 hover:bg-gray-600 text-white focus:ring-gray-400',
    'danger' => 'bg-red-600 hover:bg-red-700 text-white focus:ring-red-500',
    'warning' => 'bg-amber-500 hover:bg-amber-600 text-gray-900 focus:ring-amber-400',
    'success' => 'bg-green-600 hover:bg-green-700 text-white focus:ring-green-500',
    'outline' => 'border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white focus:ring-red-500',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2.5 text-sm',
    'lg' => 'px-6 py-3 text-base',
];

$classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)<i class="fas fa-{{ $icon }}"></i>@endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)<i class="fas fa-{{ $icon }}"></i>@endif
        {{ $slot }}
    </button>
@endif
```

---

### Component 3: Alert (`<x-alert>`)

```blade
{{-- Usage --}}
<x-alert type="success">Data berhasil disimpan!</x-alert>
<x-alert type="error" dismissible>Terjadi kesalahan.</x-alert>
```

**Props:**
- `type`: success | error | warning | info (default: info)
- `dismissible`: Boolean - Shows close button

**Implementation:**
```blade
@props(['type' => 'info', 'dismissible' => false])

@php
$styles = [
    'success' => 'bg-green-50 border-green-200 text-green-800',
    'error' => 'bg-red-50 border-red-200 text-red-800',
    'warning' => 'bg-amber-50 border-amber-200 text-amber-800',
    'info' => 'bg-blue-50 border-blue-200 text-blue-800',
];

$icons = [
    'success' => 'check-circle',
    'error' => 'times-circle',
    'warning' => 'exclamation-triangle',
    'info' => 'info-circle',
];
@endphp

<div x-data="{ show: true }" x-show="show" x-transition
     {{ $attributes->merge(['class' => 'flex items-center gap-3 px-4 py-3 rounded-lg border ' . $styles[$type]]) }}>
    <i class="fas fa-{{ $icons[$type] }} text-lg"></i>
    <span class="flex-1">{{ $slot }}</span>
    @if($dismissible)
        <button @click="show = false" class="text-current opacity-70 hover:opacity-100">
            <i class="fas fa-times"></i>
        </button>
    @endif
</div>
```

---

### Component 4: Modal (`<x-modal>`)

```blade
{{-- Usage --}}
<x-modal name="edit-user" title="Edit User">
    <form>...</form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-user')">Batal</x-btn>
        <x-btn type="submit">Simpan</x-btn>
    </x-slot:footer>
</x-modal>

{{-- Trigger --}}
<x-btn @click="$dispatch('open-modal', 'edit-user')">Open Modal</x-btn>
```

**Props:**
- `name`: String - Unique identifier for the modal
- `title`: String - Modal header title
- `maxWidth`: sm | md | lg | xl (default: md)

**Implementation:**
```blade
@props(['name', 'title' => '', 'maxWidth' => 'md'])

@php
$maxWidthClass = [
    'sm' => 'max-w-sm',
    'md' => 'max-w-lg',
    'lg' => 'max-w-2xl',
    'xl' => 'max-w-4xl',
][$maxWidth];
@endphp

<div x-data="{ open: false }"
     x-on:open-modal.window="if ($event.detail === '{{ $name }}') open = true"
     x-on:close-modal.window="if ($event.detail === '{{ $name }}') open = false"
     x-on:keydown.escape.window="open = false"
     x-show="open"
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-modal="true">
    
    {{-- Backdrop --}}
    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/50" @click="open = false"></div>
    
    {{-- Modal Content --}}
    <div class="flex min-h-full items-center justify-center p-4">
        <div x-show="open"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             @click.stop
             class="relative w-full {{ $maxWidthClass }} bg-white rounded-xl shadow-xl">
            
            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
                <button @click="open = false" class="text-gray-400 hover:text-gray-600 text-xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            {{-- Body --}}
            <div class="px-6 py-4">
                {{ $slot }}
            </div>
            
            {{-- Footer --}}
            @if(isset($footer))
                <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-xl">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
```

---

### Component 5: Data Table (`<x-data-table>`)

```blade
{{-- Usage --}}
<x-data-table>
    <x-slot:header>
        <th>No</th>
        <th>Nama</th>
        <th>Aksi</th>
    </x-slot:header>
    
    @foreach($items as $index => $item)
        <tr class="hover:bg-gray-50">
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->nama }}</td>
            <td>...</td>
        </tr>
    @endforeach
</x-data-table>
```

**Props:**
- `searchable`: Boolean - Show search input
- `perPage`: Array - Per page options

**Implementation:**
```blade
@props(['searchable' => true, 'perPage' => [10, 25, 50]])

<div class="overflow-hidden">
    @if($searchable)
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4 text-sm text-gray-600">
        <div class="flex items-center gap-2">
            <span>Tampilkan</span>
            <select class="border border-gray-300 rounded px-2 py-1.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                @foreach($perPage as $num)
                    <option value="{{ $num }}">{{ $num }}</option>
                @endforeach
            </select>
            <span>data</span>
        </div>
        <div class="flex items-center gap-2">
            <span>Cari:</span>
            <input type="text" placeholder="Cari..." 
                   class="border border-gray-300 rounded px-3 py-1.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
        </div>
    </div>
    @endif
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-left text-gray-600 font-semibold">
                    {{ $header }}
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
```

---

### Component 6: Form Input (`<x-input>`)

```blade
{{-- Usage --}}
<x-input name="nama" label="Nama Barang" required />
<x-input name="email" type="email" label="Email" placeholder="user@example.com" />
<x-input name="password" type="password" label="Password" :error="$errors->first('password')" />
```

**Props:**
- `name`: String - Input name attribute
- `label`: String - Label text
- `type`: text | email | password | number | date | file (default: text)
- `error`: String - Error message
- `required`: Boolean
- All standard input attributes

**Implementation:**
```blade
@props([
    'name',
    'label' => null,
    'type' => 'text',
    'error' => null,
    'required' => false
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-gray-600 mb-2">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif
    
    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $name }}"
           {{ $attributes->merge([
               'class' => 'w-full px-3 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition ' 
                        . ($error ? 'border-red-400 bg-red-50' : 'border-gray-300')
           ]) }}
           @if($required) required @endif>
    
    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>
```

---

### Component 7: Select (`<x-select>`)

```blade
{{-- Usage --}}
<x-select name="satuan" label="Satuan" required>
    <option value="">-- Pilih --</option>
    @foreach($satuan_list as $s)
        <option value="{{ $s->nama }}">{{ $s->nama }}</option>
    @endforeach
</x-select>
```

**Implementation:**
```blade
@props([
    'name',
    'label' => null,
    'error' => null,
    'required' => false
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-gray-600 mb-2">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif
    
    <select name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes->merge([
                'class' => 'w-full px-3 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition '
                         . ($error ? 'border-red-400 bg-red-50' : 'border-gray-300')
            ]) }}
            @if($required) required @endif>
        {{ $slot }}
    </select>
    
    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>
```

---

### Component 8: Badge (`<x-badge>`)

```blade
{{-- Usage --}}
<x-badge variant="admin">Admin</x-badge>
<x-badge variant="success">Stok Aman</x-badge>
<x-badge variant="warning">Stok Menipis</x-badge>
```

**Implementation:**
```blade
@props(['variant' => 'default'])

@php
$variants = [
    'default' => 'bg-gray-100 text-gray-700',
    'admin' => 'bg-blue-600 text-white',
    'cabang' => 'bg-orange-500 text-white',
    'karyawan' => 'bg-green-600 text-white',
    'success' => 'bg-green-100 text-green-800',
    'warning' => 'bg-amber-100 text-amber-800',
    'danger' => 'bg-red-100 text-red-800',
];
@endphp

<span {{ $attributes->merge(['class' => 'inline-block px-3 py-1 rounded-full text-xs font-bold ' . $variants[$variant]]) }}>
    {{ $slot }}
</span>
```

---

### Component 9: Page Header (`<x-page-header>`)

```blade
{{-- Usage --}}
<x-page-header title="Data Barang" :breadcrumbs="['Dashboard', 'Master Data', 'Data Barang']">
    <x-btn icon="plus">Entri Data</x-btn>
</x-page-header>
```

**Implementation:**
```blade
@props(['title', 'subtitle' => null, 'breadcrumbs' => []])

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">{{ $title }}</h2>
        @if($subtitle)
            <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
        @elseif(count($breadcrumbs) > 0)
            <nav class="text-sm text-gray-500 mt-1">
                <i class="fas fa-home mr-1"></i>
                @foreach($breadcrumbs as $index => $crumb)
                    {{ $crumb }}
                    @if(!$loop->last)
                        <span class="mx-1">></span>
                    @endif
                @endforeach
            </nav>
        @endif
    </div>
    
    @if($slot->isNotEmpty())
        <div class="flex items-center gap-3">
            {{ $slot }}
        </div>
    @endif
</div>
```

---

### Component 10: Stat Card (`<x-stat-card>`)

```blade
{{-- Usage --}}
<x-stat-card 
    icon="box" 
    label="Total Barang" 
    :value="$total_barang" 
    color="blue" 
/>
```

**Implementation:**
```blade
@props(['icon', 'label', 'value', 'color' => 'blue'])

@php
$colors = [
    'blue' => ['border' => 'border-l-blue-600', 'bg' => 'bg-blue-600'],
    'green' => ['border' => 'border-l-green-600', 'bg' => 'bg-green-600'],
    'orange' => ['border' => 'border-l-orange-500', 'bg' => 'bg-orange-500'],
    'red' => ['border' => 'border-l-red-600', 'bg' => 'bg-red-600'],
];
$c = $colors[$color] ?? $colors['blue'];
@endphp

<div class="bg-white rounded-lg shadow-sm border-l-4 {{ $c['border'] }} p-5 flex items-center gap-5 hover:-translate-y-1 transition-transform">
    <div class="w-14 h-14 {{ $c['bg'] }} rounded-xl flex items-center justify-center text-white text-2xl">
        <i class="fas fa-{{ $icon }}"></i>
    </div>
    <div>
        <p class="text-sm text-gray-500 font-medium">{{ $label }}</p>
        <p class="text-3xl font-bold text-gray-800">{{ $value }}</p>
    </div>
</div>
```

---

## Data Models

Tidak ada perubahan data models - ini murni perubahan UI/presentation layer.

---

## CSS Theme Configuration

**File: `resources/css/app.css`**

```css
@import 'tailwindcss';

@source '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php';
@source '../../storage/framework/views/*.php';
@source '../**/*.blade.php';
@source '../**/*.js';

@theme {
    /* Typography */
    --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
    
    /* Brand Colors */
    --color-primary: #0fa958;
    --color-primary-dark: #0c8a47;
    
    /* Extend emerald to match brand */
    --color-emerald-600: #0fa958;
    --color-emerald-700: #0c8a47;
}

/* Custom utilities */
@layer utilities {
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
}

/* Alpine.js cloak */
[x-cloak] {
    display: none !important;
}
```

---

## JavaScript Architecture

**File: `resources/js/app.js`**

```javascript
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// SweetAlert2 helpers (loaded via CDN)
window.confirmDelete = function(message = 'Data yang dihapus tidak dapat dikembalikan!') {
    return Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    });
};

window.confirmDanger = function(title, text) {
    return Swal.fire({
        title: title,
        text: text,
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Lanjutkan!',
        cancelButtonText: 'Batal'
    });
};

window.toast = function(type, message) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
    Toast.fire({ icon: type, title: message });
};

// Auto-show flash messages
document.addEventListener('DOMContentLoaded', function() {
    const flash = document.querySelector('meta[name="flash-success"]');
    if (flash) {
        toast('success', flash.content);
    }
    const flashError = document.querySelector('meta[name="flash-error"]');
    if (flashError) {
        toast('error', flashError.content);
    }
});
```

---

## Admin Layout Structure

```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - 1/2 Kopi Tiam</title>
    
    {{-- Flash message meta for JS --}}
    @if(session('success'))
        <meta name="flash-success" content="{{ session('success') }}">
    @endif
    @if(session('error'))
        <meta name="flash-error" content="{{ session('error') }}">
    @endif
    
    {{-- External CDNs --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen" x-data="{ sidebarOpen: false }">
    
    {{-- Mobile Overlay --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/50 z-40 lg:hidden" x-transition.opacity></div>
    
    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform lg:translate-x-0 transition-transform duration-200 flex flex-col">
        ...sidebar content...
    </aside>
    
    {{-- Main Content --}}
    <div class="lg:ml-64 flex flex-col min-h-screen">
        {{-- Topbar --}}
        <header class="bg-emerald-600 text-white px-4 lg:px-6 py-4 flex items-center justify-between shadow-md sticky top-0 z-30">
            <button @click="sidebarOpen = true" class="lg:hidden text-xl">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="text-lg lg:text-xl font-bold">Sistem Stok Bahan Baku</h1>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="font-semibold text-sm">{{ auth()->user()?->nama_user ?? 'Pengguna' }}</p>
                    <p class="text-xs opacity-80">{{ auth()->user()?->hak_akses ?? 'Tamu' }}</p>
                </div>
                <i class="fas fa-user-circle text-2xl"></i>
            </div>
        </header>
        
        {{-- Page Content --}}
        <main class="flex-1 p-4 lg:p-6">
            @yield('content')
        </main>
    </div>
    
</body>
</html>
```

---

## Error Handling

1. **Form Validation** - Gunakan Laravel validation dengan `$errors` variable
2. **SweetAlert2 Errors** - Server-side errors di-flash ke session, auto-display via meta tag
3. **Graceful Degradation** - Jika Alpine.js gagal load, modal masih accessible via Blade fallback

---

## Testing Strategy

1. **Visual Testing** - Manual check di berbagai viewport (320px, 768px, 1024px, 1440px)
2. **Component Testing** - Pastikan setiap component render dengan benar
3. **Integration Testing** - Test flow CRUD lengkap dengan SweetAlert2
4. **Browser Testing** - Chrome, Firefox, Safari, Edge

---

## Migration Strategy

1. **Phase 1**: Setup TailwindCSS + Alpine.js + SweetAlert2 di layout
2. **Phase 2**: Create all Blade components
3. **Phase 3**: Migrate admin layout (keep inline CSS temporarily)
4. **Phase 4**: Migrate each page one by one
5. **Phase 5**: Remove old inline styles, final cleanup

---

## Dependencies

| Library | Version | Method | Purpose |
|---------|---------|--------|---------|
| TailwindCSS | ^4.0.0 | npm/Vite | Utility CSS |
| Alpine.js | ^3.x | npm | Reactivity |
| SweetAlert2 | ^11.x | CDN | Alerts/Modals |
| FontAwesome | ^6.4.0 | CDN | Icons |
| Chart.js | ^4.x | CDN | Dashboard charts |
