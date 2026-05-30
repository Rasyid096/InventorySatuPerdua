<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - 1/2 Kopi Tiam</title>
    
    {{-- Flash message meta tags for SweetAlert2 --}}
    @if(session('success'))
        <meta name="flash-success" content="{{ session('success') }}">
    @endif
    @if(session('error'))
        <meta name="flash-error" content="{{ session('error') }}">
    @endif
    @if(session('warning'))
        <meta name="flash-warning" content="{{ session('warning') }}">
    @endif
    
    {{-- External CDNs --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Page-specific head content --}}
    @stack('head')
</head>
<body class="bg-gray-100 min-h-screen" x-data="{ sidebarOpen: false, profileOpen: false }">
    
    {{-- Mobile Sidebar Overlay --}}
    <div x-show="sidebarOpen" 
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/50 z-40 lg:hidden"
         x-cloak></div>
    
    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform lg:translate-x-0 transition-transform duration-200 flex flex-col">
        
        {{-- Sidebar Header --}}
        <div class="flex items-center justify-center gap-3 px-5 py-5 border-b border-gray-100">
            <img src="{{ asset('assets/image/logo.png') }}" alt="Logo" class="w-11 h-11 rounded-full object-cover">
            <h2 class="text-lg font-bold text-gray-800">1/2 Kopi Tiam</h2>
        </div>
        
        {{-- Sidebar Menu --}}
        <nav class="flex-1 overflow-y-auto py-4 no-scrollbar">
            <a href="{{ url('/admin') }}" 
               class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors {{ request()->is('admin') || request()->is('admin/dashboard') ? 'bg-emerald-50 text-emerald-600 border-r-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-600' }}">
                <i class="fas fa-home w-5 text-center"></i>
                <span>Dashboard</span>
            </a>
            
            <p class="px-6 pt-5 pb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Master Data</p>
            <a href="{{ url('/admin/data-barang') }}" 
               class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors {{ request()->is('admin/data-barang*') ? 'bg-emerald-50 text-emerald-600 border-r-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-600' }}">
                <i class="fas fa-box w-5 text-center"></i>
                <span>Data Barang</span>
            </a>
            
            <p class="px-6 pt-5 pb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Transaksi</p>
            <a href="{{ url('/admin/barang-masuk') }}" 
               class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors {{ request()->is('admin/barang-masuk*') ? 'bg-emerald-50 text-emerald-600 border-r-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-600' }}">
                <i class="fas fa-sign-in-alt w-5 text-center"></i>
                <span>Barang Masuk</span>
            </a>
            <a href="{{ url('/admin/barang-keluar') }}" 
               class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors {{ request()->is('admin/barang-keluar*') ? 'bg-emerald-50 text-emerald-600 border-r-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-600' }}">
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                <span>Barang Keluar</span>
            </a>
            
            <p class="px-6 pt-5 pb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Laporan</p>
            <a href="{{ url('/admin/laporan-stok') }}" 
               class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors {{ request()->is('admin/laporan-stok*') ? 'bg-emerald-50 text-emerald-600 border-r-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-600' }}">
                <i class="fas fa-chart-line w-5 text-center"></i>
                <span>Laporan Stok</span>
            </a>
            <a href="{{ url('/admin/laporan-barang-masuk') }}" 
               class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors {{ request()->is('admin/laporan-barang-masuk*') ? 'bg-emerald-50 text-emerald-600 border-r-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-600' }}">
                <i class="fas fa-file-import w-5 text-center"></i>
                <span>Laporan Barang Masuk</span>
            </a>
            <a href="{{ url('/admin/laporan-barang-keluar') }}" 
               class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors {{ request()->is('admin/laporan-barang-keluar*') ? 'bg-emerald-50 text-emerald-600 border-r-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-600' }}">
                <i class="fas fa-file-export w-5 text-center"></i>
                <span>Laporan Barang Keluar</span>
            </a>
            
            <p class="px-6 pt-5 pb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Pengaturan</p>
            <a href="{{ url('/admin/pengaturan-satuan') }}" 
               class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors {{ request()->is('admin/pengaturan-satuan*') ? 'bg-emerald-50 text-emerald-600 border-r-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-600' }}">
                <i class="fas fa-balance-scale w-5 text-center"></i>
                <span>Satuan Barang</span>
            </a>
            
            @if(!auth()->check() || auth()->user()?->hak_akses != 'Karyawan')
                <a href="{{ url('/admin/manajemen-user') }}" 
                   class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors {{ request()->is('admin/manajemen-user*') ? 'bg-emerald-50 text-emerald-600 border-r-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-600' }}">
                    <i class="fas fa-user-cog w-5 text-center"></i>
                    <span>Manajemen User</span>
                </a>
                <a href="{{ url('/admin/backup-database') }}" 
                   class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors {{ request()->is('admin/backup-database*') ? 'bg-emerald-50 text-emerald-600 border-r-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-600' }}">
                    <i class="fas fa-cloud-download-alt w-5 text-center"></i>
                    <span>Backup Database</span>
                </a>
            @endif
            
            <p class="px-6 pt-5 pb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Bantuan</p>
            <a href="{{ url('/admin/tentang-aplikasi') }}" 
               class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors {{ request()->is('admin/tentang-aplikasi*') ? 'bg-emerald-50 text-emerald-600 border-r-4 border-emerald-600' : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-600' }}">
                <i class="fas fa-info-circle w-5 text-center"></i>
                <span>Tentang Aplikasi</span>
            </a>
        </nav>
        
        {{-- Sidebar Footer --}}
        <div class="border-t border-gray-100 p-4">
            <a href="{{ url('/') }}" 
               class="flex items-center gap-3 px-2 py-2 text-sm font-medium text-gray-500 hover:text-emerald-600 hover:bg-gray-50 rounded-lg transition-colors">
                <i class="fas fa-globe w-5 text-center"></i>
                <span>Lihat Website</span>
            </a>
        </div>
    </aside>
    
    {{-- Main Content Area --}}
    <div class="lg:ml-64 flex flex-col min-h-screen">
        {{-- Topbar --}}
        <header class="bg-emerald-600 text-white px-4 lg:px-6 py-4 flex items-center justify-between shadow-md sticky top-0 z-30">
            {{-- Mobile menu button --}}
            <button @click="sidebarOpen = true" 
                    class="lg:hidden text-xl p-2 -ml-2 hover:bg-white/10 rounded-lg transition-colors">
                <i class="fas fa-bars"></i>
            </button>
            
            <h1 class="text-lg lg:text-xl font-bold">Sistem Stok Bahan Baku</h1>
            
            {{-- Profile Dropdown --}}
            <div class="relative" @click.away="profileOpen = false">
                <button @click="profileOpen = !profileOpen"
                        class="flex items-center gap-3 hover:bg-white/10 rounded-lg px-3 py-2 transition-colors">
                    <div class="text-right hidden sm:block">
                        <p class="font-semibold text-sm">{{ auth()->user()?->nama_user ?? 'Pengguna' }}</p>
                        <p class="text-xs opacity-80">{{ auth()->user()?->hak_akses ?? 'Tamu' }}</p>
                    </div>
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-lg"></i>
                    </div>
                    <i class="fas fa-chevron-down text-xs hidden sm:block" :class="profileOpen ? 'rotate-180' : ''" style="transition: transform 0.2s"></i>
                </button>
                
                {{-- Dropdown Menu --}}
                <div x-show="profileOpen"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50"
                     x-cloak>
                    
                    {{-- User Info --}}
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-bold text-gray-800">{{ auth()->user()?->nama_user ?? 'Pengguna' }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()?->username ?? '-' }}</p>
                        <span class="inline-block mt-1 px-2 py-0.5 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">
                            {{ auth()->user()?->hak_akses ?? 'Tamu' }}
                        </span>
                    </div>
                    
                    {{-- Menu Items --}}
                    <div class="py-1">
                        <a href="{{ url('/') }}" 
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-globe w-5 text-center text-gray-400"></i>
                            <span>Lihat Website Publik</span>
                        </a>
                        <a href="{{ url('/admin') }}" 
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-tachometer-alt w-5 text-center text-gray-400"></i>
                            <span>Dashboard Admin</span>
                        </a>
                        <a href="{{ url('/admin/tentang-aplikasi') }}" 
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-info-circle w-5 text-center text-gray-400"></i>
                            <span>Tentang Aplikasi</span>
                        </a>
                    </div>
                    
                    {{-- Logout --}}
                    <div class="border-t border-gray-100 pt-1">
                        <a href="{{ url('/logout') }}" 
                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                            <i class="fas fa-sign-out-alt w-5 text-center"></i>
                            <span class="font-medium">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>
        
        {{-- Page Content --}}
        <main class="flex-1 p-4 lg:p-6">
            @yield('content')
        </main>
        
        {{-- Footer --}}
        <footer class="text-center text-sm text-gray-500 py-4 border-t border-gray-200 bg-white">
            &copy; {{ date('Y') }} 1/2 Kopi Tiam - Sistem Stok Bahan Baku
        </footer>
    </div>
    
    {{-- Page-specific scripts --}}
    @stack('scripts')
</body>
</html>
