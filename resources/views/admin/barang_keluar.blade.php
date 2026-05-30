@extends('layouts.admin')

@section('title', 'Barang Keluar')

@section('content')
<x-page-header title="Data Barang Keluar" :breadcrumbs="['Dashboard', 'Transaksi', 'Barang Keluar']">
    @if(auth()->user()->hak_akses == 'Admin' || auth()->user()->hak_akses == 'Administrator')
        <form action="{{ url('/admin/barang-keluar/hapus-semua') }}" method="POST" onsubmit="return confirmBulkDelete(event)">
            @csrf
            @method('DELETE')
            <x-btn variant="outline" icon="trash-alt" type="submit">
                Hapus Semua Data
            </x-btn>
        </form>
    @endif
    <x-btn icon="plus" @click="$dispatch('open-modal', 'entri-barang')">Entri Data</x-btn>
</x-page-header>

@if(session('error'))
    <x-alert type="error" class="mb-4" dismissible>
        {{ session('error') }}
    </x-alert>
@endif

@if(session('success'))
    <x-alert type="success" class="mb-4" dismissible>
        {{ session('success') }}
    </x-alert>
@endif

<x-card :padding="false">
    <div class="p-6">
        <x-data-table>
            <x-slot:header>
                <th class="px-4 py-3">No.</th>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3">Barang</th>
                <th class="px-4 py-3">Jumlah Keluar</th>
                <th class="px-4 py-3">Satuan</th>
                <th class="px-4 py-3">Foto</th>
                <th class="px-4 py-3">Aksi</th>
            </x-slot:header>
            
            @forelse($barang_keluar as $index => $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td class="px-4 py-3 font-bold text-gray-800">{{ $item->nama_barang }}</td>
                    <td class="px-4 py-3">{{ $item->jumlah }}</td>
                    <td class="px-4 py-3">{{ $item->satuan }}</td>
                    <td class="px-4 py-3">
                        @if($item->foto) 
                            <img src="{{ asset('uploads/' . $item->foto) }}" 
                                 class="w-12 h-12 rounded-lg object-cover border border-gray-200" 
                                 alt="Foto">
                        @else 
                            <span class="text-gray-400 text-xs italic">Tidak ada foto</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <x-btn variant="warning" size="sm"
                                data-id="{{ $item->id }}" 
                                data-tanggal="{{ $item->tanggal }}"
                                data-nama="{{ $item->nama_barang }}" 
                                data-jumlah="{{ $item->jumlah }}" 
                                onclick="openEditModal(this)">
                                <i class="fas fa-edit"></i>
                            </x-btn>
                            <form action="{{ url('/admin/barang-keluar/hapus/' . $item->id) }}" method="GET" 
                                  onsubmit="return confirmDeleteForm(event, 'Hapus riwayat ini?')">
                                <x-btn variant="danger" size="sm" type="submit">
                                    <i class="fas fa-trash"></i>
                                </x-btn>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2 text-gray-300"></i>
                        <p>Belum ada data barang keluar</p>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </div>
</x-card>

{{-- Entry Modal --}}
<x-modal name="entri-barang" title="Input Barang Keluar" maxWidth="md">
    <form id="form-entri-keluar" action="{{ url('/admin/barang-keluar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-input name="tanggal" type="date" label="Tanggal Keluar" required />
        
        <x-select name="id_barang_master" label="Pilih Data Barang (Dari Master Data)" required>
            <option value="">-- Pilih Barang dari Gudang --</option>
            @foreach($stok_tersedia as $stok)
                <option value="{{ $stok->id }}">{{ $stok->nama_barang }} (Sisa: {{ $stok->jumlah }} {{ $stok->satuan }})</option>
            @endforeach
        </x-select>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input name="jumlah" type="number" label="Jumlah Keluar" min="1" required />
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600 mb-2">Foto Bukti Keluar (Opsional)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-sm border border-gray-300 rounded-lg p-2">
            </div>
        </div>
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'entri-barang')">Batal</x-btn>
        <x-btn type="submit" form="form-entri-keluar" icon="save">Proses Keluar</x-btn>
    </x-slot:footer>
</x-modal>

{{-- Edit Modal --}}
<x-modal name="edit-barang" title="Edit Riwayat Barang Keluar" maxWidth="md">
    <form id="form-edit-keluar" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <x-input name="tanggal" type="date" label="Tanggal Keluar" id="edit_tanggal" required />
        
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-2">Nama Barang (Tidak bisa diubah)</label>
            <input type="text" name="nama_barang" id="edit_nama" readonly 
                   class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm bg-gray-100 cursor-not-allowed">
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input name="jumlah" type="number" label="Jumlah Keluar" id="edit_jumlah" required />
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600 mb-2">Update Foto (Opsional)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-sm border border-gray-300 rounded-lg p-2">
            </div>
        </div>
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-barang')">Batal</x-btn>
        <x-btn type="submit" form="form-edit-keluar" icon="save">Simpan Perubahan</x-btn>
    </x-slot:footer>
</x-modal>
@endsection

@push('scripts')
<script>
    function openEditModal(btn) { 
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-barang' }));
        
        let id = btn.getAttribute('data-id');
        document.getElementById('edit_tanggal').value = btn.getAttribute('data-tanggal');
        document.getElementById('edit_nama').value = btn.getAttribute('data-nama');
        document.getElementById('edit_jumlah').value = btn.getAttribute('data-jumlah');
        
        document.getElementById('form-edit-keluar').action = "{{ url('/admin/barang-keluar/update') }}/" + id;
    }
</script>
@endpush
