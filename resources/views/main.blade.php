<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Masuk') - 1/2 Kopi Tiam</title>

    @if(session('success'))
        <meta name="flash-success" content="{{ session('success') }}">
    @endif
    @if(session('error'))
        <meta name="flash-error" content="{{ session('error') }}">
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen flex flex-col bg-zinc-50 text-sm" x-data="{ menuOpen: false }">

    <header class="sticky top-0 z-50 bg-brand-800 text-white shadow-sm no-print">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
            <a href="{{ route('login') }}" class="text-sm sm:text-base font-semibold truncate">
                1/2 Kopi Tiam
            </a>

            <button type="button" @click="menuOpen = !menuOpen"
                    class="sm:hidden p-2 rounded-lg hover:bg-brand-700 transition-colors"
                    aria-label="Menu">
                <x-icon name="bars" class="w-5 h-5" x-show="!menuOpen" />
                <x-icon name="times" class="w-5 h-5" x-show="menuOpen" x-cloak />
            </button>

            <nav class="hidden sm:flex items-center gap-1">
                <a href="{{ route('login') }}"
                   class="px-3 py-2 text-sm font-medium rounded-lg hover:bg-brand-700 transition-colors {{ request()->routeIs('login') ? 'bg-brand-700' : '' }}">
                    Masuk
                </a>
            </nav>
        </div>

        <div x-show="menuOpen"
             x-transition
             x-cloak
             class="sm:hidden border-t border-brand-700 px-4 py-2">
            <a href="{{ route('login') }}"
               class="block px-3 py-2.5 text-sm font-medium rounded-lg hover:bg-brand-700">
                Masuk
            </a>
        </div>
    </header>

    <main class="flex-1 page-content">
        @yield('content')
    </main>

    <footer class="bg-zinc-900 text-zinc-300 text-center py-4 text-caption no-print">
        <p>&copy; {{ date('Y') }} 1/2 Kopi Tiam — Sistem Stok Bahan Baku</p>
    </footer>

    @stack('scripts')
</body>
</html>
