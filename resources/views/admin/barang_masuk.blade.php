@extends('layouts.admin')

@section('title', 'Barang Masuk')

@section('content')
<x-page-header title="Data Barang Masuk" :breadcrumbs="['Dashboard', 'Transaksi', 'Barang Masuk']">
    @if(auth()->user()->hak_akses == 'Admin' || auth()->user()->hak_akses == 'Administrator')
        <form action="{{ url('/admin/barang-masuk/hapus-semua') }}" method="POST" onsubmit="return confirmBulkDelete(event)">
            @csrf
            @method('DELETE')
            <x-btn variant="outline" icon="trash-alt" type="submit">
                Hapus Semua Data
            </x-btn>
        </form>
    @endif
    <x-btn icon="plus" @click="$dispatch('open-modal', 'entri-barang')">Entri Data</x-btn>
</x-page-header>

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
                <th class="px-4 py-3">Nama Barang</th>
                <th class="px-4 py-3">Jumlah Masuk</th>
                <th class="px-4 py-3">Satuan</th>
                <th class="px-4 py-3">Total Harga</th>
                <th class="px-4 py-3">Foto</th>
                <th class="px-4 py-3">Aksi</th>
            </x-slot:header>
            
            @forelse($barang_masuk as $index => $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td class="px-4 py-3 font-bold text-gray-800">{{ $item->nama_barang }}</td>
                    <td class="px-4 py-3">{{ $item->jumlah }}</td>
                    <td class="px-4 py-3">{{ $item->satuan }}</td>
                    <td class="px-4 py-3 font-semibold text-emerald-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
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
                                data-satuan="{{ $item->satuan }}" 
                                data-harga="{{ $item->harga }}" 
                                onclick="openEditModal(this)">
                                <i class="fas fa-edit"></i>
                            </x-btn>
                            <form action="{{ url('/admin/barang-masuk/' . $item->id) }}" method="POST" 
                                  onsubmit="return confirmDeleteForm(event)">
                                @csrf
                                @method('DELETE')
                                <x-btn variant="danger" size="sm" type="submit">
                                    <i class="fas fa-trash"></i>
                                </x-btn>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2 text-gray-300"></i>
                        <p>Belum ada data barang masuk</p>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </div>
</x-card>

{{-- Entry Modal --}}
<x-modal name="entri-barang" title="Input Barang Masuk" maxWidth="md">
    <form id="form-entri-barang" action="{{ url('/admin/barang-masuk') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-input name="tanggal" type="date" label="Tanggal Masuk" required />
        <x-input name="nama_barang" label="Nama Barang" placeholder="Contoh: Susu Evaporasi" required />
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input name="jumlah" type="number" label="Jumlah Masuk" placeholder="0" required />
            <x-select name="satuan" label="Satuan" required>
                <option value="">-- Pilih Satuan --</option>
                @foreach($daftar_satuan as $satuan)
                    <option value="{{ $satuan->nama_satuan }}">{{ $satuan->nama_satuan }}</option>
                @endforeach
            </x-select>
        </div>
        
        <x-input name="total_harga" type="number" label="Total Harga (Rp)" placeholder="Contoh: 150000" required />
        <x-input name="foto" type="file" label="Foto Nota / Barang" accept="image/*" />
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'entri-barang')">Batal</x-btn>
        <x-btn type="submit" form="form-entri-barang" icon="save">Simpan Data</x-btn>
    </x-slot:footer>
</x-modal>

{{-- Edit Modal --}}
<x-modal name="edit-barang" title="Edit Barang Masuk" maxWidth="md">
    <form id="form-edit-barang" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-input name="tanggal" type="date" label="Tanggal Masuk" id="edit_tanggal" required />
        <x-input name="nama_barang" label="Nama Barang" id="edit_nama" required />
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input name="jumlah" type="number" label="Jumlah Masuk" id="edit_jumlah" required />
            <x-select name="satuan" label="Satuan" id="edit_satuan" required>
                @foreach($daftar_satuan as $satuan)
                    <option value="{{ $satuan->nama_satuan }}">{{ $satuan->nama_satuan }}</option>
                @endforeach
            </x-select>
        </div>
        
        <x-input name="total_harga" type="number" label="Total Harga (Rp)" id="edit_harga" required />
        
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-2">Ganti Foto (Opsional)</label>
            <input type="file" name="foto" accept="image/*" class="w-full text-sm">
            <p class="text-xs text-gray-500 mt-1">*Biarkan kosong jika foto tidak ingin diganti.</p>
        </div>
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-barang')">Batal</x-btn>
        <x-btn type="submit" form="form-edit-barang" icon="save">Perbarui Data</x-btn>
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
        document.getElementById('edit_satuan').value = btn.getAttribute('data-satuan');
        document.getElementById('edit_harga').value = btn.getAttribute('data-harga');
        
        document.getElementById('form-edit-barang').action = "{{ url('/admin/barang-masuk') }}/" + id;
    }
</script>
@endpush
