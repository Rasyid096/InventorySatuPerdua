@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
<x-page-header title="Pengaturan Sistem" :breadcrumbs="['Dashboard', 'Pengaturan']" />

<div x-data="{ tab: '{{ request('tab') === 'log' ? 'log' : 'satuan' }}' }">
    {{-- Tab Buttons --}}
    <div class="flex flex-wrap gap-2 mb-6">
        <button @click="tab = 'satuan'"
                :class="tab === 'satuan' ? 'bg-emerald-50 text-emerald-600 border-emerald-600' : 'text-gray-500 hover:text-gray-700 border-transparent'"
                class="px-4 py-2 text-sm font-medium border rounded-lg transition-colors">
            <i class="fas fa-balance-scale mr-1"></i> Satuan Barang
        </button>
        @if(auth()->user()?->hak_akses != 'Karyawan')
        <button @click="tab = 'user'"
                :class="tab === 'user' ? 'bg-emerald-50 text-emerald-600 border-emerald-600' : 'text-gray-500 hover:text-gray-700 border-transparent'"
                class="px-4 py-2 text-sm font-medium border rounded-lg transition-colors">
            <i class="fas fa-user-cog mr-1"></i> Manajemen User
        </button>
        <button @click="tab = 'log'"
                :class="tab === 'log' ? 'bg-emerald-50 text-emerald-600 border-emerald-600' : 'text-gray-500 hover:text-gray-700 border-transparent'"
                class="px-4 py-2 text-sm font-medium border rounded-lg transition-colors">
            <i class="fas fa-clipboard-list mr-1"></i> Log Aktivitas
        </button>
        @endif
        <button @click="tab = 'backup'"
                :class="tab === 'backup' ? 'bg-emerald-50 text-emerald-600 border-emerald-600' : 'text-gray-500 hover:text-gray-700 border-transparent'"
                class="px-4 py-2 text-sm font-medium border rounded-lg transition-colors">
            <i class="fas fa-cloud-download-alt mr-1"></i> Backup Database
        </button>
    </div>

    {{-- ==================== TAB: SATUAN ==================== --}}
    <div x-show="tab === 'satuan'" x-cloak>
        @if(session('success'))
            <x-alert type="success" class="mb-4" dismissible>
                {{ session('success') }}
            </x-alert>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <x-card :padding="false">
                    <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
                        <i class="fas fa-balance-scale text-emerald-600"></i>
                        <h4 class="font-bold text-gray-700">Daftar Satuan</h4>
                        <span class="ml-auto bg-emerald-100 text-emerald-700 px-2.5 py-0.5 rounded-full text-xs font-bold">
                            {{ count($satuan) }} Item
                        </span>
                    </div>
                    <div class="p-4 lg:p-5">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-gray-50 text-left text-gray-600 font-semibold">
                                        <th class="px-3 py-2.5 w-20">No.</th>
                                        <th class="px-3 py-2.5">Nama Satuan</th>
                                        <th class="px-3 py-2.5 w-40 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($satuan as $index => $item)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-4 py-4 text-gray-500">{{ $index + 1 }}</td>
                                            <td class="px-4 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                                        <i class="fas fa-ruler text-emerald-600"></i>
                                                    </div>
                                                    <span class="font-bold text-gray-800">{{ $item->nama_satuan }}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4">
                                                <div class="flex items-center justify-center gap-2">
                                                    <x-btn variant="warning" size="sm"
                                                        data-id="{{ $item->id }}"
                                                        data-nama="{{ $item->nama_satuan }}"
                                                        onclick="openEditSatuan(this)">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </x-btn>
                                                    @if(auth()->user()->hak_akses != 'Karyawan')
                                                    <form action="{{ url('/admin/pengaturan-satuan/' . $item->id) }}" method="POST"
                                                          onsubmit="return confirmDeleteForm(event, 'Satuan ini akan dihapus!')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-btn variant="danger" size="sm" type="submit">
                                                            <i class="fas fa-trash"></i>
                                                        </x-btn>
                                                    </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-12 text-center text-gray-500">
                                                <div class="flex flex-col items-center">
                                                    <i class="fas fa-inbox text-4xl mb-2 text-gray-300"></i>
                                                    <p>Belum ada data satuan</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </x-card>
            </div>

            <div class="lg:col-span-1">
                <x-card>
                    <div class="text-center mb-4">
                        <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-info-circle text-xl text-emerald-600"></i>
                        </div>
                        <h4 class="font-bold text-gray-800">Tentang Satuan</h4>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed mb-4">
                        Satuan barang digunakan untuk mengukur kuantitas bahan baku seperti Kilogram, Liter, Pcs, Pack, dan lainnya.
                    </p>
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 text-sm text-amber-800">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        <strong>Perhatian:</strong> Menghapus satuan yang sudah digunakan dapat menyebabkan data tidak konsisten.
                    </div>
                </x-card>

                <x-card class="mt-4">
                    <h5 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                        <i class="fas fa-lightbulb text-amber-500"></i>
                        Contoh Satuan Umum
                    </h5>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                            Kilogram (kg) - untuk bahan padat
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            Liter (L) - untuk bahan cair
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                            Pcs - untuk barang satuan
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                            Pack - untuk kemasan
                        </li>
                    </ul>
                </x-card>
            </div>
        </div>
    </div>

    {{-- ==================== TAB: MANAJEMEN USER ==================== --}}
    @if(auth()->user()?->hak_akses != 'Karyawan')
    <div x-show="tab === 'user'" x-cloak>
        <div class="flex justify-end mb-4">
            <x-btn icon="plus" @click="$dispatch('open-modal', 'entri-user')">Entri Data</x-btn>
        </div>

        <x-card :padding="false">
            <div class="p-4 lg:p-5">
                <x-data-table>
                    <x-slot:header>
                        <th class="px-3 py-2.5">No.</th>
                        <th class="px-3 py-2.5">Nama User</th>
                        <th class="px-3 py-2.5">Username</th>
                        <th class="px-3 py-2.5">Hak Akses</th>
                        <th class="px-3 py-2.5">Aksi</th>
                    </x-slot:header>

                    @forelse($users as $index => $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-3 py-2.5">{{ $index + 1 }}</td>
                            <td class="px-3 py-2.5 font-bold text-gray-800">{{ $user->nama_user }}</td>
                            <td class="px-3 py-2.5">{{ $user->username }}</td>
                            <td class="px-3 py-2.5">
                                @if($user->hak_akses == 'Admin')
                                    <x-badge variant="admin">Admin</x-badge>
                                @elseif($user->hak_akses == 'Kepala Cabang')
                                    <x-badge variant="cabang">Kepala Cabang</x-badge>
                                @else
                                    <x-badge variant="karyawan">Karyawan</x-badge>
                                @endif
                            </td>
                            <td class="px-3 py-2.5">
                                <div class="flex items-center gap-2">
                                    <x-btn variant="warning" size="sm"
                                        data-id="{{ $user->id }}"
                                        data-nama="{{ $user->nama_user }}"
                                        data-username="{{ $user->username }}"
                                        data-akses="{{ $user->hak_akses }}"
                                        onclick="openEditUser(this)">
                                        <i class="fas fa-edit"></i>
                                    </x-btn>
                                    @if($user->username != 'admin')
                                        <form action="{{ url('/admin/manajemen-user/' . $user->id) }}" method="POST"
                                              onsubmit="return confirmDeleteForm(event, 'User ini akan dihapus permanen!')">
                                            @csrf
                                            @method('DELETE')
                                            <x-btn variant="danger" size="sm" type="submit">
                                                <i class="fas fa-trash"></i>
                                            </x-btn>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                <i class="fas fa-users text-4xl mb-2 text-gray-300"></i>
                                <p>Belum ada data user</p>
                            </td>
                        </tr>
                    @endforelse
                </x-data-table>
            </div>
        </x-card>
    </div>
    @endif

    {{-- ==================== TAB: LOG AKTIVITAS ==================== --}}
    @if(auth()->user()?->hak_akses != 'Karyawan')
    <div x-show="tab === 'log'" x-cloak>
        <x-card>
            <form method="GET" action="{{ url('/admin/pengaturan') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6 pb-4 border-b border-gray-100">
                <input type="hidden" name="tab" value="log">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Aksi</label>
                    <select name="action" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua</option>
                        <option value="create" {{ request('action') == 'create' ? 'selected' : '' }}>Create</option>
                        <option value="update" {{ request('action') == 'update' ? 'selected' : '' }}>Update</option>
                        <option value="delete" {{ request('action') == 'delete' ? 'selected' : '' }}>Delete</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Modul</label>
                    <select name="model" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua</option>
                        <option value="BarangMasuk" {{ request('model') == 'BarangMasuk' ? 'selected' : '' }}>Barang Masuk</option>
                        <option value="BarangKeluar" {{ request('model') == 'BarangKeluar' ? 'selected' : '' }}>Barang Keluar</option>
                        <option value="DataBarang" {{ request('model') == 'DataBarang' ? 'selected' : '' }}>Data Barang</option>
                        <option value="Satuan" {{ request('model') == 'Satuan' ? 'selected' : '' }}>Satuan</option>
                        <option value="User" {{ request('model') == 'User' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">User</label>
                    <select name="user_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->nama_user }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <x-btn type="submit" icon="filter" variant="primary">Filter</x-btn>
                    <a href="{{ url('/admin/pengaturan?tab=log') }}" class="px-3.5 py-2 text-sm text-gray-600 hover:text-gray-800 border border-gray-300 rounded-lg">Reset</a>
                </div>
            </form>

            <x-data-table :searchable="false">
                <x-slot:header>
                    <th class="px-3 py-2.5">Waktu</th>
                    <th class="px-3 py-2.5">User</th>
                    <th class="px-3 py-2.5">Aksi</th>
                    <th class="px-3 py-2.5">Modul</th>
                    <th class="px-3 py-2.5">Deskripsi</th>
                    <th class="px-3 py-2.5">IP</th>
                </x-slot:header>

                @forelse($logs as $log)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-3 py-2.5 text-sm text-gray-500 whitespace-nowrap">{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
                        <td class="px-3 py-2.5 font-bold text-gray-800">{{ $log->user->nama_user ?? '-' }}</td>
                        <td class="px-3 py-2.5">
                            @if($log->action == 'create')
                                <x-badge variant="success">Create</x-badge>
                            @elseif($log->action == 'update')
                                <x-badge variant="warning">Update</x-badge>
                            @elseif($log->action == 'delete')
                                <x-badge variant="danger">Delete</x-badge>
                            @else
                                <x-badge>{{ $log->action }}</x-badge>
                            @endif
                        </td>
                        <td class="px-3 py-2.5 text-sm text-gray-600">{{ $log->model }}</td>
                        <td class="px-3 py-2.5 text-sm text-gray-700">{{ $log->description }}</td>
                        <td class="px-3 py-2.5 text-xs text-gray-400">{{ $log->ip_address }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-clipboard-list text-4xl mb-2 text-gray-300"></i>
                            <p>Belum ada log aktivitas</p>
                        </td>
                    </tr>
                @endforelse
            </x-data-table>

            <div class="mt-4">
                {{ $logs->links() }}
            </div>
        </x-card>
    </div>
    @endif

    {{-- ==================== TAB: BACKUP ==================== --}}
    <div x-show="tab === 'backup'" x-cloak>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <x-card :padding="false">
                    <div class="relative overflow-hidden">
                        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-5 py-6 text-white">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                                    <i class="fas fa-database text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold">Cadangan Database</h3>
                                    <p class="text-emerald-100 text-sm mt-1">Simpan salinan data untuk keamanan</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg mb-6">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-exclamation-triangle text-amber-500 text-lg mt-0.5"></i>
                                    <div>
                                        <h4 class="font-bold text-amber-800">Penting!</h4>
                                        <p class="text-sm text-amber-700 mt-1">
                                            Lakukan backup database secara berkala untuk mengamankan riwayat transaksi barang masuk, barang keluar, dan master data bahan baku dari risiko kehilangan data.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-5 mb-6">
                                <h4 class="font-bold text-gray-700 mb-4 flex items-center gap-2">
                                    <i class="fas fa-server text-emerald-600"></i>
                                    Informasi Database
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Database Aktif</p>
                                        <p class="font-mono text-sm font-bold text-gray-800 bg-gray-100 px-2 py-1 rounded inline-block">
                                            {{ $nama_db }}
                                        </p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Total Tabel</p>
                                        <p class="text-2xl font-bold text-emerald-600">{{ $jumlah_tabel }}</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <p class="text-xs text-gray-500 uppercase font-bold mb-1">Format Output</p>
                                        <p class="font-medium text-gray-800">
                                            <i class="fas fa-file-code text-blue-500 mr-1"></i> SQL Script (.sql)
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <x-btn size="lg" icon="download" href="{{ url('/admin/backup-database/download') }}" class="px-8">
                                    Download Cadangan Database
                                </x-btn>
                                <p class="text-xs text-gray-500 mt-3">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    File akan diunduh dalam format .sql yang dapat diimpor kembali
                                </p>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>

            <div class="lg:col-span-1 space-y-4">
                <x-card>
                    <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-lightbulb text-amber-500"></i>
                        Tips Backup
                    </h4>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-emerald-500 mt-0.5"></i>
                            <span>Lakukan backup minimal 1x seminggu</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-emerald-500 mt-0.5"></i>
                            <span>Simpan file backup di tempat terpisah (cloud/USB)</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-emerald-500 mt-0.5"></i>
                            <span>Beri nama file dengan tanggal backup</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-emerald-500 mt-0.5"></i>
                            <span>Test restore berkala untuk memastikan backup valid</span>
                        </li>
                    </ul>
                </x-card>

                <x-card>
                    <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-box-open text-blue-500"></i>
                        Data yang Di-backup
                    </h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2 text-gray-600">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                            Master Data Barang
                        </li>
                        <li class="flex items-center gap-2 text-gray-600">
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            Riwayat Barang Masuk
                        </li>
                        <li class="flex items-center gap-2 text-gray-600">
                            <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                            Riwayat Barang Keluar
                        </li>
                        <li class="flex items-center gap-2 text-gray-600">
                            <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                            Data Pengguna
                        </li>
                        <li class="flex items-center gap-2 text-gray-600">
                            <span class="w-2 h-2 bg-pink-500 rounded-full"></span>
                            Pengaturan Satuan
                        </li>
                    </ul>
                </x-card>

                <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg p-5 text-white">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Rekomendasi</p>
                            <p class="font-bold">Backup Rutin</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-300">
                        Jadwalkan backup rutin setiap akhir pekan untuk memastikan data selalu aman.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ==================== MODALS ==================== --}}

{{-- Satuan Entry Modal --}}
<x-modal name="entri-satuan" title="Input Satuan" maxWidth="sm">
    <form id="form-entri-satuan" action="{{ url('/admin/pengaturan-satuan') }}" method="POST">
        @csrf
        <x-input name="nama_satuan" label="Nama Satuan" placeholder="Contoh: Gram, Kardus, Botol..." required />
        <p class="text-xs text-gray-500 -mt-2 mb-4">Masukkan nama satuan yang akan digunakan untuk mengukur barang</p>
    </form>
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'entri-satuan')">Batal</x-btn>
        <x-btn type="submit" form="form-entri-satuan" icon="save">Simpan Data</x-btn>
    </x-slot:footer>
</x-modal>

{{-- Satuan Edit Modal --}}
<x-modal name="edit-satuan" title="Edit Satuan" maxWidth="sm">
    <form id="form-edit-satuan" action="" method="POST">
        @csrf
        @method('PUT')
        <x-input name="nama_satuan" label="Nama Satuan" id="edit_nama_satuan" required />
    </form>
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-satuan')">Batal</x-btn>
        <x-btn type="submit" form="form-edit-satuan" icon="save">Simpan Perubahan</x-btn>
    </x-slot:footer>
</x-modal>

{{-- User Entry Modal --}}
<x-modal name="entri-user" title="Input User" maxWidth="md">
    <form id="form-entri-user" action="{{ url('/admin/manajemen-user') }}" method="POST">
        @csrf
        <x-input name="nama_user" label="Nama User" required />
        <x-input name="username" label="Username" required />
        <x-input name="password" type="password" label="Password" required />
        <x-select name="hak_akses" label="Hak Akses" required>
            <option value="">-- Pilih --</option>
            <option value="Admin">Admin</option>
            <option value="Kepala Cabang">Kepala Cabang</option>
            <option value="Karyawan">Karyawan</option>
        </x-select>
    </form>
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'entri-user')">Batal</x-btn>
        <x-btn type="submit" form="form-entri-user" icon="save">Simpan Data</x-btn>
    </x-slot:footer>
</x-modal>

{{-- User Edit Modal --}}
<x-modal name="edit-user" title="Edit User" maxWidth="md">
    <form id="form-edit-user" action="" method="POST">
        @csrf
        @method('PUT')
        <x-input name="nama_user" label="Nama User" id="edit_nama_user" required />
        <x-input name="username" label="Username" id="edit_username" required />

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-2">Password Baru</label>
            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
        </div>

        <x-select name="hak_akses" label="Hak Akses" id="edit_akses" required>
            <option value="Admin">Admin</option>
            <option value="Kepala Cabang">Kepala Cabang</option>
            <option value="Karyawan">Karyawan</option>
        </x-select>
    </form>
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-user')">Batal</x-btn>
        <x-btn type="submit" form="form-edit-user" icon="save">Simpan Perubahan</x-btn>
    </x-slot:footer>
</x-modal>
@endsection

@push('scripts')
<script>
    function openEditSatuan(btn) {
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-satuan' }));
        let id = btn.getAttribute('data-id');
        document.getElementById('edit_nama_satuan').value = btn.getAttribute('data-nama');
        document.getElementById('form-edit-satuan').action = "{{ url('/admin/pengaturan-satuan') }}/" + id;
    }

    function openEditUser(btn) {
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-user' }));
        let id = btn.getAttribute('data-id');
        document.getElementById('edit_nama_user').value = btn.getAttribute('data-nama');
        document.getElementById('edit_username').value = btn.getAttribute('data-username');
        document.getElementById('edit_akses').value = btn.getAttribute('data-akses');
        document.getElementById('form-edit-user').action = "{{ url('/admin/manajemen-user') }}/" + id;
    }
</script>
@endpush
