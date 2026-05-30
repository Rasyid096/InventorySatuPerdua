<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PT PARAPRENUER INDONESIA BAHAGIA</title>
    
    {{-- Flash message meta tags for SweetAlert2 --}}
    @if(session('success'))
        <meta name="flash-success" content="{{ session('success') }}">
    @endif
    @if(session('error'))
        <meta name="flash-error" content="{{ session('error') }}">
    @endif
    
    {{-- External CDNs --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    {{-- Vite Assets (TailwindCSS + Alpine.js) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('head')
</head>
<body class="min-h-screen flex flex-col">
    <header class="site-header bg-emerald-600 text-white">
        <div class="navbar flex items-center justify-between px-6 py-4 max-w-7xl mx-auto">
            <div class="logo font-bold text-lg">PT PARAPRENUER INDONESIA BAHAGIA</div>
            <ul class="nav-links flex items-center gap-6 text-sm font-medium">
                <li><a href="{{ url('/') }}" class="hover:text-emerald-200 transition-colors">BERANDA</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-emerald-200 transition-colors">MASUK</a></li>
            </ul>
        </div>
    </header>

    <main class="site-main flex-1">
        @yield('content')
    </main>

    <footer class="site-footer bg-gray-800 text-white text-center py-4 text-sm">
        <p>&copy; {{ date('Y') }} PT PARAPRENUER INDONESIA BAHAGIA</p>
    </footer>
    
    @stack('scripts')
</body>
</html>
