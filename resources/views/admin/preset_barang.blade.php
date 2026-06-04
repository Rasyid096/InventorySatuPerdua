@extends('layouts.admin')

@section('title', 'Preset Barang')

@section('content')
<x-page-header title="Preset Nama Barang" :breadcrumbs="['Master Data', 'Preset Barang']">
    <x-btn icon="plus" @click="$dispatch('open-modal', 'entri-preset')">
        Tambah Preset
    </x-btn>
</x-page-header>

@if(session('success'))
    <x-alert type="success" class="mb-4" dismissible>
        {{ session('success') }}
    </x-alert>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Main Table Card --}}
    <div class="lg:col-span-2">
        <x-card :padding="false">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <i class="fas fa-tags text-emerald-600"></i>
                <h4 class="font-bold text-gray-700">Daftar Preset Barang</h4>
                <span class="ml-auto bg-emerald-100 text-emerald-700 px-2.5 py-0.5 rounded-full text-xs font-bold">
                    {{ count($preset) }} Item
                </span>
            </div>
            
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-left text-gray-600 font-semibold">
                                <th class="px-3 py-2.5 w-20">No.</th>
                                <th class="px-3 py-2.5">Nama Barang</th>
                                <th class="px-3 py-2.5 w-40 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($preset as $index => $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-box text-emerald-600"></i>
                                            </div>
                                            <span class="font-bold text-gray-800">{{ $item->nama_barang }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <x-btn variant="warning" size="sm" 
                                                data-id="{{ $item->id }}" 
                                                data-nama="{{ $item->nama_barang }}" 
                                                onclick="openEditModal(this)">
                                                <i class="fas fa-edit"></i> Edit
                                            </x-btn>
                                            @if(auth()->user()->hak_akses != 'Karyawan')
                                            <form action="{{ url('/admin/preset-barang/' . $item->id) }}" method="POST"
                                                  onsubmit="return confirmDeleteForm(event, 'Preset barang ini akan dihapus!')">
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
    
    {{-- Info Sidebar --}}
    <div class="lg:col-span-1">
        <x-card>
            <div class="text-center mb-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-info-circle text-xl text-emerald-600"></i>
                </div>
                <h4 class="font-bold text-gray-800">Tentang Preset Barang</h4>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed mb-4">
                Preset barang adalah daftar nama barang yang sering digunakan. Fitur ini mempercepat input data transaksi barang masuk.
            </p>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-sm text-blue-800">
                <i class="fas fa-lightbulb mr-1"></i>
                <strong>Tips:</strong> Tambahkan nama barang yang sering Anda gunakan agar proses input lebih cepat.
            </div>
        </x-card>
        
        <x-card class="mt-4">
            <h5 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                <i class="fas fa-clipboard-list text-amber-500"></i>
                Contoh Preset Barang
            </h5>
            <ul class="space-y-2 text-sm text-gray-600">
                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    Gula Pasir
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    Tepung Terigu
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                    Minyak Goreng
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                    Kopi Bubuk
                </li>
            </ul>
        </x-card>
    </div>
</div>

{{-- Entry Modal --}}
<x-modal name="entri-preset" title="Input Preset Barang" maxWidth="sm">
    <form id="form-entri-preset" action="{{ url('/admin/preset-barang') }}" method="POST">
        @csrf
        <x-input name="nama_barang" label="Nama Barang" placeholder="Contoh: Gula Pasir, Tepung Terigu..." required />
        <p class="text-xs text-gray-500 -mt-2 mb-4">Masukkan nama barang yang sering digunakan</p>
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'entri-preset')">Batal</x-btn>
        <x-btn type="submit" form="form-entri-preset" icon="save">Simpan Data</x-btn>
    </x-slot:footer>
</x-modal>

{{-- Edit Modal --}}
<x-modal name="edit-preset" title="Edit Preset Barang" maxWidth="sm">
    <form id="form-edit-preset" action="" method="POST">
        @csrf
        @method('PUT')
        <x-input name="nama_barang" label="Nama Barang" id="edit_nama" required />
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
        document.getElementById('form-edit-preset').action = "{{ url('/admin/preset-barang') }}/" + id;
    }
</script>
@endpush
