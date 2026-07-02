<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed inset-y-0 left-0 z-50 w-60 bg-white border-r border-zinc-200 transform lg:translate-x-0 transition-transform duration-300 ease-out flex flex-col shadow-lg lg:shadow-none">

    <div class="flex items-center gap-3 px-4 py-4 border-b border-zinc-100">
        <img src="{{ asset('assets/image/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full object-cover ring-2 ring-brand-100">
        <div class="min-w-0">
            <h2 class="text-sm font-bold text-zinc-900 truncate">1/2 Kopi Tiam {{ session('cabang_aktif_nama') ? ' ' . session('cabang_aktif_nama') : '' }}</h2>
            <p class="text-caption">Stok Bahan Baku</p>
        </div>
        <button type="button" @click="sidebarOpen = false" class="lg:hidden ml-auto p-1.5 rounded-lg hover:bg-zinc-100 text-zinc-500">
            <x-icon name="times" class="w-5 h-5" />
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-3 px-2 no-scrollbar space-y-0.5">
        <x-nav-link href="{{ url('/dashboard') }}" icon="home" :active="request()->is('dashboard')">
            Dashboard
        </x-nav-link>

        <p class="text-nav-section px-3 pt-4 pb-1">Transaksi</p>
        <x-nav-link href="{{ url('/transaksi/barang-masuk') }}" icon="sign-in-alt" :active="request()->is('transaksi/barang-masuk*')">
            Barang Masuk
        </x-nav-link>
        <x-nav-link href="{{ url('/transaksi/barang-keluar') }}" icon="sign-out-alt" :active="request()->is('transaksi/barang-keluar*')">
            Barang Keluar
        </x-nav-link>

        <p class="text-nav-section px-3 pt-4 pb-1">Master Data</p>
        <x-nav-link href="{{ url('/master-data/data-barang') }}" icon="box" :active="request()->is('master-data/data-barang*')">
            Data Barang
        </x-nav-link>

        <p class="text-nav-section px-3 pt-4 pb-1">Laporan</p>
        <x-nav-link href="{{ url('/laporan/stok') }}" icon="chart-line" :active="request()->is('laporan/stok*')">
            Laporan Stok
        </x-nav-link>
        <x-nav-link href="{{ url('/laporan/barang-masuk') }}" icon="file-import" :active="request()->is('laporan/barang-masuk*')">
            Laporan Barang Masuk
        </x-nav-link>
        <x-nav-link href="{{ url('/laporan/barang-keluar') }}" icon="file-export" :active="request()->is('laporan/barang-keluar*')">
            Laporan Barang Keluar
        </x-nav-link>

        <p class="text-nav-section px-3 pt-4 pb-1">Pengaturan</p>
        <x-nav-link href="{{ url('/pengaturan/preset-barang') }}" icon="tags" :active="request()->is('pengaturan/preset-barang*')">
            Preset Barang
        </x-nav-link>
        <x-nav-link href="{{ url('/pengaturan/satuan-barang') }}" icon="balance-scale" :active="request()->is('pengaturan/satuan-barang*')">
            Satuan Barang
        </x-nav-link>

        @if(auth()->user()?->hak_akses != 'Karyawan')
            <x-nav-link href="{{ url('/pengaturan/manajemen-user') }}" icon="user-cog" :active="request()->is('pengaturan/manajemen-user*')">
                Manajemen User
            </x-nav-link>
            <x-nav-link href="{{ url('/activity-log') }}" icon="clipboard-list" :active="request()->is('activity-log*')">
                Log Aktivitas
            </x-nav-link>
            <x-nav-link href="{{ url('/pengaturan/backup-database') }}" icon="cloud-download-alt" :active="request()->is('pengaturan/backup-database*')">
                Backup Database
            </x-nav-link>
        @endif

        <p class="text-nav-section px-3 pt-4 pb-1">Bantuan</p>
        <x-nav-link href="{{ url('/tentang') }}" icon="info-circle" :active="request()->is('tentang*')">
            Tentang Aplikasi
        </x-nav-link>
    </nav>
</aside>
