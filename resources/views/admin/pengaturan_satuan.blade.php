@extends('layouts.admin')

@section('title', 'Pengaturan Satuan')

@section('content')
<x-page-header title="Pengaturan Satuan Barang" :breadcrumbs="['Pengaturan', 'Satuan Barang']">
    <x-btn icon="plus" @click="$dispatch('open-modal', 'entri-satuan')">
        Tambah Satuan
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
            <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
                <x-icon name="balance-scale" class="w-5 h-5 text-brand-600" />
                <h4 class="font-bold text-zinc-700">Daftar Satuan</h4>
                <span class="ml-auto bg-brand-100 text-brand-700 px-2.5 py-0.5 rounded-full text-xs font-bold">
                    {{ count($satuan) }} Item
                </span>
            </div>
            
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-zinc-50 text-left text-zinc-600 font-semibold">
                                <th class="px-3 py-2.5 w-20">No.</th>
                                <th class="px-3 py-2.5">Nama Satuan</th>
                                <th class="px-3 py-2.5 w-40 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($satuan as $index => $item)
                                <tr class="hover:bg-zinc-50 transition-colors">
                                    <td class="px-4 py-4 text-zinc-500">{{ $index + 1 }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-brand-100 rounded-lg flex items-center justify-center">
                                                <x-icon name="ruler" class="w-5 h-5 text-brand-600" />
                                            </div>
                                            <span class="font-bold text-zinc-900">{{ $item->nama_satuan }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <x-btn variant="warning" size="sm" 
                                                data-id="{{ $item->id }}" 
                                                data-nama="{{ $item->nama_satuan }}" 
                                                onclick="openEditModal(this)">
                                                <x-icon name="edit" class="w-4 h-4" /> Edit
                                            </x-btn>
                                            @if(auth()->user()->hak_akses != 'Karyawan')
                                            <form action="{{ url('/admin/pengaturan-satuan/' . $item->id) }}" method="POST"
                                                  onsubmit="return confirmDeleteForm(event, 'Satuan ini akan dihapus!')">
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
                                    <td colspan="3" class="px-4 py-12 text-center text-zinc-500">
                                        <div class="flex flex-col items-center">
                                            <x-icon name="inbox" class="w-10 h-10 text-zinc-300 mx-auto mb-2 block" />
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
    
    {{-- Info Sidebar --}}
    <div class="lg:col-span-1">
        <x-card>
            <div class="text-center mb-4">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <x-icon name="info-circle" class="w-6 h-6 text-brand-600" />
                </div>
                <h4 class="font-bold text-zinc-900">Tentang Satuan</h4>
            </div>
            <p class="text-sm text-zinc-600 leading-relaxed mb-4">
                Satuan barang digunakan untuk mengukur kuantitas bahan baku seperti Kilogram, Liter, Pcs, Pack, dan lainnya.
            </p>
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 text-sm text-amber-800">
                <x-icon name="exclamation-triangle" class="w-4 h-4 inline" />
                <strong>Perhatian:</strong> Menghapus satuan yang sudah digunakan dapat menyebabkan data tidak konsisten.
            </div>
        </x-card>
        
        <x-card class="mt-4">
            <h5 class="font-bold text-zinc-700 mb-3 flex items-center gap-2">
                <x-icon name="lightbulb" class="w-5 h-5 text-amber-500" />
                Contoh Satuan Umum
            </h5>
            <ul class="space-y-2 text-sm text-zinc-600">
                <li class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-brand-500 rounded-full"></span>
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

{{-- Entry Modal --}}
<x-modal name="entri-satuan" title="Input Satuan" maxWidth="sm">
    <form id="form-entri-satuan" action="{{ url('/admin/pengaturan-satuan') }}" method="POST">
        @csrf
        <x-input name="nama_satuan" label="Nama Satuan" placeholder="Contoh: Gram, Kardus, Botol..." required />
        <p class="text-xs text-zinc-500 -mt-2 mb-4">Masukkan nama satuan yang akan digunakan untuk mengukur barang</p>
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'entri-satuan')">Batal</x-btn>
        <x-btn type="submit" form="form-entri-satuan" icon="save">Simpan Data</x-btn>
    </x-slot:footer>
</x-modal>

{{-- Edit Modal --}}
<x-modal name="edit-satuan" title="Edit Satuan" maxWidth="sm">
    <form id="form-edit-satuan" action="" method="POST">
        @csrf
        @method('PUT')
        <x-input name="nama_satuan" label="Nama Satuan" id="edit_nama" required />
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-satuan')">Batal</x-btn>
        <x-btn type="submit" form="form-edit-satuan" icon="save">Simpan Perubahan</x-btn>
    </x-slot:footer>
</x-modal>
@endsection

@push('scripts')
<script>
    function openEditModal(btn) { 
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-satuan' }));
        
        let id = btn.getAttribute('data-id');
        document.getElementById('edit_nama').value = btn.getAttribute('data-nama');
        document.getElementById('form-edit-satuan').action = "{{ url('/admin/pengaturan-satuan') }}/" + id;
    }
</script>
@endpush
