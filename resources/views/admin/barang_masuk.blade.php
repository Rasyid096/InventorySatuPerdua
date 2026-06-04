@extends('layouts.admin')

@section('title', 'Barang Masuk')

@section('content')
<x-page-header title="Data Barang Masuk" :breadcrumbs="['Dashboard', 'Transaksi', 'Barang Masuk']">
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
                <th class="px-3 py-2.5">No.</th>
                <th class="px-3 py-2.5">Tanggal</th>
                <th class="px-3 py-2.5">Nama Barang</th>
                <th class="px-3 py-2.5">Jumlah Masuk</th>
                <th class="px-3 py-2.5">Satuan</th>
                <th class="px-3 py-2.5">Foto</th>
                <th class="px-3 py-2.5">Aksi</th>
            </x-slot:header>
            
            @forelse($barang_masuk as $index => $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-3 py-2.5">{{ $index + 1 }}</td>
                    <td class="px-3 py-2.5">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td class="px-3 py-2.5 font-bold text-gray-800">{{ $item->nama_barang }}</td>
                    <td class="px-3 py-2.5">{{ $item->jumlah }}</td>
                    <td class="px-3 py-2.5">{{ $item->satuan }}</td>
                    <td class="px-3 py-2.5">
                        @if($item->foto)
                            <img src="{{ asset('uploads/' . $item->foto) }}" 
                                 class="w-12 h-12 rounded-lg object-cover border border-gray-200" 
                                 alt="Foto">
                        @else
                            <span class="text-gray-400 text-xs italic">Tidak ada foto</span>
                        @endif
                    </td>
                    <td class="px-3 py-2.5">
                        <div class="flex items-center gap-2">
                            <x-btn variant="warning" size="sm"
                                data-id="{{ $item->id }}" 
                                data-tanggal="{{ $item->tanggal }}"
                                data-nama="{{ $item->nama_barang }}" 
                                data-jumlah="{{ $item->jumlah }}" 
                                data-satuan="{{ $item->satuan }}" 
                                onclick="openEditModal(this)">
                                <i class="fas fa-edit"></i>
                            </x-btn>
                            @if(auth()->user()->hak_akses != 'Karyawan')
                            <form action="{{ url('/admin/barang-masuk/' . $item->id) }}" method="POST" 
                                  onsubmit="return confirmDeleteForm(event)">
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
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
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
    <form id="form-entri-barang" action="{{ url('/admin/barang-masuk') }}" method="POST" enctype="multipart/form-data" x-data="{ isCustom: false }">
        @csrf
        <x-input name="tanggal" type="date" label="Tanggal Masuk" required />
        
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Barang <span class="text-red-500">*</span></label>
            <select x-model="isCustom" 
                    @change="if (!isCustom) { document.getElementById('nama_barang_input').value = $event.target.value; }"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" 
                    required>
                <option value="">-- Pilih Barang --</option>
                @foreach($preset_barang as $preset)
                    <option value="{{ $preset->nama_barang }}">{{ $preset->nama_barang }}</option>
                @endforeach
                <option value="custom">Lainnya (Input Manual)</option>
            </select>
        </div>
        
        <div x-show="isCustom === 'custom'" x-transition class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Barang Custom</label>
            <input type="text" 
                   id="nama_barang_custom" 
                   placeholder="Masukkan nama barang..."
                   @input="document.getElementById('nama_barang_input').value = $event.target.value"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
        </div>
        
        <input type="hidden" name="nama_barang" id="nama_barang_input" required />
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input name="jumlah" type="number" label="Jumlah Masuk" placeholder="0" required />
            <x-select name="satuan" label="Satuan" required>
                <option value="">-- Pilih Satuan --</option>
                @foreach($daftar_satuan as $satuan)
                    <option value="{{ $satuan->nama_satuan }}">{{ $satuan->nama_satuan }}</option>
                @endforeach
            </x-select>
        </div>
        
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
        <x-input name="tanggal" type="date" label="Tanggal Masuk" id="edit_tanggal" readonly class="bg-zinc-100 text-zinc-500 cursor-not-allowed" />
        <x-input name="nama_barang" label="Nama Barang" id="edit_nama" required />
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input name="jumlah" type="number" label="Jumlah Masuk" id="edit_jumlah" required />
            <x-select name="satuan" label="Satuan" id="edit_satuan" required>
                @foreach($daftar_satuan as $satuan)
                    <option value="{{ $satuan->nama_satuan }}">{{ $satuan->nama_satuan }}</option>
                @endforeach
            </x-select>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-2">Ganti Foto (Opsional)</label>
            <input type="file" name="foto" accept="image/*" class="w-full text-sm">
            <p class="text-xs text-gray-500 mt-1">*Biarkan kosong jika foto tidak ingin diganti.</p>
        </div>
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-barang')">Batal</x-btn>
        <x-btn type="submit" form="form-edit-barang" icon="save">Simpan Perubahan</x-btn>
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
        
        document.getElementById('form-edit-barang').action = "{{ url('/admin/barang-masuk') }}/" + id;
    }
</script>
@endpush
