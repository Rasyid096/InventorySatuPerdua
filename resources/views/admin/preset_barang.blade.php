@extends('layouts.admin')

@section('title', 'Preset Barang')

@section('content')
<x-page-header title="Preset Nama Barang" :breadcrumbs="['Pengaturan', 'Preset Barang']">
    <x-btn icon="plus" @click="$dispatch('open-modal', 'entri-preset')">
        Tambah Preset
    </x-btn>
</x-page-header>

@if(session('success'))
    <x-alert type="success" class="mb-4" dismissible>
        {{ session('success') }}
    </x-alert>
@endif

<x-card class="mb-6">
    <form method="GET" class="flex flex-col sm:flex-row gap-4 sm:items-end">
        <div class="w-full sm:max-w-xs">
            <label class="text-label block mb-2">Filter Lokasi</label>
            <select name="kategori_lokasi" class="form-control">
                <option value="Semua" {{ ($filterKategori ?? 'Semua') == 'Semua' ? 'selected' : '' }}>Tampilkan Semua</option>
                <option value="Bar" {{ ($filterKategori ?? 'Semua') == 'Bar' ? 'selected' : '' }}>Khusus Bar</option>
                <option value="Dapur" {{ ($filterKategori ?? 'Semua') == 'Dapur' ? 'selected' : '' }}>Khusus Dapur</option>
            </select>
        </div>
        <div class="flex gap-2">
            <x-btn type="submit" icon="filter">Terapkan</x-btn>
            <x-btn variant="secondary" href="{{ url('/pengaturan/preset-barang') }}">Reset</x-btn>
        </div>
    </form>
</x-card>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <x-card :padding="false">
            <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
                <x-icon name="tags" class="w-5 h-5 text-brand-600" />
                <h4 class="font-bold text-zinc-700">Daftar Preset Barang</h4>
                <span class="ml-auto bg-brand-100 text-brand-700 px-2.5 py-0.5 rounded-full text-xs font-bold">
                    {{ count($preset) }} Item
                </span>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-zinc-50 text-left text-zinc-600 font-semibold">
                                <th class="px-3 py-2.5 w-20">No.</th>
                                <th class="px-3 py-2.5">Nama Barang</th>
                                <th class="px-3 py-2.5">Kategori</th>
                                <th class="px-3 py-2.5 w-40 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($preset as $index => $item)
                                <tr class="hover:bg-zinc-50 transition-colors">
                                    <td class="px-4 py-4 text-zinc-500">{{ $index + 1 }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-brand-100 rounded-lg flex items-center justify-center">
                                                <x-icon name="box" class="w-5 h-5 text-brand-600" />
                                            </div>
                                            <span class="font-bold text-zinc-900">{{ $item->nama_barang }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <x-badge variant="{{ $item->kategori_lokasi == 'Bar' ? 'success' : 'warning' }}">{{ $item->kategori_lokasi }}</x-badge>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <x-btn variant="warning" size="sm"
                                                data-id="{{ $item->id }}"
                                                data-nama="{{ $item->nama_barang }}"
                                                data-kategori="{{ $item->kategori_lokasi }}"
                                                onclick="openEditModal(this)">
                                                <x-icon name="edit" class="w-4 h-4" /> Edit
                                            </x-btn>
                                            @if(auth()->user()->hak_akses != 'Karyawan')
                                            <form action="{{ url('/pengaturan/preset-barang/' . $item->id) }}" method="POST"
                                                  onsubmit="return confirmDeleteForm(event, 'Preset barang ini akan dihapus!')">
                                                @csrf
                                                @method('DELETE')
                                                <x-btn variant="danger" size="sm" type="submit">
                                                    <x-icon name="trash" class="w-4 h-4" />
                                                </x-btn>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-12 text-center text-zinc-500">
                                        <div class="flex flex-col items-center">
                                            <x-icon name="inbox" class="w-10 h-10 text-zinc-300 mx-auto mb-2 block" />
                                            <p>Belum ada preset barang</p>
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
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <x-icon name="info-circle" class="w-6 h-6 text-brand-600" />
                </div>
                <h4 class="font-bold text-zinc-900">Tentang Preset Barang</h4>
            </div>
            <p class="text-sm text-zinc-600 leading-relaxed mb-4">
                Preset barang dipakai untuk menentukan nama barang sekaligus kategori lokasi otomatis saat input transaksi.
            </p>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-sm text-blue-800">
                <x-icon name="lightbulb" class="w-4 h-4 inline" />
                <strong>Tips:</strong> Pastikan setiap preset sudah ditandai sebagai Bar atau Dapur.
            </div>
        </x-card>
    </div>
</div>

<x-modal name="entri-preset" title="Input Preset Barang" maxWidth="sm">
    <form id="form-entri-preset" action="{{ url('/pengaturan/preset-barang') }}" method="POST">
        @csrf
        <x-input name="nama_barang" label="Nama Barang" placeholder="Contoh: Gula Pasir, Tepung Terigu..." required />
        <x-select name="kategori_lokasi" label="Kategori Lokasi" required>
            <option value="Bar">Bar</option>
            <option value="Dapur">Dapur</option>
        </x-select>
    </form>

    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'entri-preset')">Batal</x-btn>
        <x-btn type="submit" form="form-entri-preset" icon="save">Simpan Data</x-btn>
    </x-slot:footer>
</x-modal>

<x-modal name="edit-preset" title="Edit Preset Barang" maxWidth="sm">
    <form id="form-edit-preset" action="" method="POST">
        @csrf
        @method('PUT')
        <x-input name="nama_barang" label="Nama Barang" id="edit_nama" required />
        <x-select name="kategori_lokasi" label="Kategori Lokasi" id="edit_kategori" required>
            <option value="Bar">Bar</option>
            <option value="Dapur">Dapur</option>
        </x-select>
    </form>

    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-preset')">Batal</x-btn>
        <x-btn type="submit" form="form-edit-preset" icon="save">Simpan Perubahan</x-btn>
    </x-slot:footer>
</x-modal>
@endsection

@push('scripts')
<script>
    function openEditModal(btn) {
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-preset' }));

        let id = btn.getAttribute('data-id');
        document.getElementById('edit_nama').value = btn.getAttribute('data-nama');
        document.getElementById('edit_kategori').value = btn.getAttribute('data-kategori');
        document.getElementById('form-edit-preset').action = "{{ url('/pengaturan/preset-barang') }}/" + id;
    }
</script>
@endpush
