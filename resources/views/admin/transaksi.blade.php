@extends('layouts.admin')

@section('title', 'Transaksi')

@section('content')
<x-page-header title="Transaksi Barang" :breadcrumbs="['Dashboard', 'Transaksi']">
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

<div x-data="{ tab: 'masuk' }">
    {{-- Tab Buttons --}}
    <div class="flex gap-2 mb-6">
        <button @click="tab = 'masuk'" 
                :class="tab === 'masuk' ? 'bg-emerald-50 text-emerald-600 border-emerald-600' : 'text-gray-500 border-transparent hover:text-gray-700 hover:bg-gray-50'"
                class="px-5 py-2.5 rounded-lg border text-sm font-semibold transition-colors">
            <i class="fas fa-arrow-down mr-1"></i> Barang Masuk
        </button>
        <button @click="tab = 'keluar'" 
                :class="tab === 'keluar' ? 'bg-emerald-50 text-emerald-600 border-emerald-600' : 'text-gray-500 border-transparent hover:text-gray-700 hover:bg-gray-50'"
                class="px-5 py-2.5 rounded-lg border text-sm font-semibold transition-colors">
            <i class="fas fa-arrow-up mr-1"></i> Barang Keluar
        </button>
    </div>

    {{-- ==================== BARANG MASUK TAB ==================== --}}
    <div x-show="tab === 'masuk'" x-transition>
        <div class="flex justify-end gap-2 mb-4">
            @if(auth()->user()->hak_akses != 'Karyawan')
                <form action="{{ url('/admin/barang-masuk/hapus-semua') }}" method="POST" onsubmit="return confirmBulkDelete(event)">
                    @csrf
                    @method('DELETE')
                    <x-btn variant="outline" icon="trash-alt" type="submit">
                        Hapus Semua Data
                    </x-btn>
                </form>
            @endif
            <x-btn icon="plus" @click="$dispatch('open-modal', 'entri-masuk')">Entri Data</x-btn>
        </div>

        <x-card :padding="false">
            <div class="p-6">
                <x-data-table>
                    <x-slot:header>
                        <th class="px-3 py-2.5">No.</th>
                        <th class="px-3 py-2.5">Tanggal</th>
                        <th class="px-3 py-2.5">Nama Barang</th>
                        <th class="px-3 py-2.5">Jumlah Masuk</th>
                        <th class="px-3 py-2.5">Satuan</th>
                        <th class="px-3 py-2.5">Total Harga</th>
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
                            <td class="px-3 py-2.5 font-semibold text-emerald-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
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
                                        data-harga="{{ $item->harga }}" 
                                        onclick="openEditModalMasuk(this)">
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
                            <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2 text-gray-300"></i>
                                <p>Belum ada data barang masuk</p>
                            </td>
                        </tr>
                    @endforelse
                </x-data-table>
            </div>
        </x-card>
    </div>

    {{-- ==================== BARANG KELUAR TAB ==================== --}}
    <div x-show="tab === 'keluar'" x-transition>
        <div class="flex justify-end gap-2 mb-4">
            @if(auth()->user()->hak_akses != 'Karyawan')
                <form action="{{ url('/admin/barang-keluar/hapus-semua') }}" method="POST" onsubmit="return confirmBulkDelete(event)">
                    @csrf
                    @method('DELETE')
                    <x-btn variant="outline" icon="trash-alt" type="submit">
                        Hapus Semua Data
                    </x-btn>
                </form>
            @endif
            <x-btn icon="plus" @click="$dispatch('open-modal', 'entri-keluar')">Entri Data</x-btn>
        </div>

        <x-card :padding="false">
            <div class="p-6">
                <x-data-table>
                    <x-slot:header>
                        <th class="px-3 py-2.5">No.</th>
                        <th class="px-3 py-2.5">Tanggal</th>
                        <th class="px-3 py-2.5">Barang</th>
                        <th class="px-3 py-2.5">Jumlah Keluar</th>
                        <th class="px-3 py-2.5">Satuan</th>
                        <th class="px-3 py-2.5">Foto</th>
                        <th class="px-3 py-2.5">Aksi</th>
                    </x-slot:header>
                    
                    @forelse($barang_keluar as $index => $item)
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
                                        onclick="openEditModalKeluar(this)">
                                        <i class="fas fa-edit"></i>
                                    </x-btn>
                                    @if(auth()->user()->hak_akses != 'Karyawan')
                                    <form action="{{ url('/admin/barang-keluar/' . $item->id) }}" method="POST" 
                                          onsubmit="return confirmDeleteForm(event, 'Hapus riwayat ini?')">
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
                                <p>Belum ada data barang keluar</p>
                            </td>
                        </tr>
                    @endforelse
                </x-data-table>
            </div>
        </x-card>
    </div>
</div>

{{-- ==================== MASUK MODALS ==================== --}}
<x-modal name="entri-masuk" title="Input Barang Masuk" maxWidth="md">
    <form id="form-entri-masuk" action="{{ url('/admin/barang-masuk') }}" method="POST" enctype="multipart/form-data">
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
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'entri-masuk')">Batal</x-btn>
        <x-btn type="submit" form="form-entri-masuk" icon="save">Simpan Data</x-btn>
    </x-slot:footer>
</x-modal>

<x-modal name="edit-masuk" title="Edit Barang Masuk" maxWidth="md">
    <form id="form-edit-masuk" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-input name="tanggal" type="date" label="Tanggal Masuk" id="edit_masuk_tanggal" required />
        <x-input name="nama_barang" label="Nama Barang" id="edit_masuk_nama" required />
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input name="jumlah" type="number" label="Jumlah Masuk" id="edit_masuk_jumlah" required />
            <x-select name="satuan" label="Satuan" id="edit_masuk_satuan" required>
                @foreach($daftar_satuan as $satuan)
                    <option value="{{ $satuan->nama_satuan }}">{{ $satuan->nama_satuan }}</option>
                @endforeach
            </x-select>
        </div>
        
        <x-input name="total_harga" type="number" label="Total Harga (Rp)" id="edit_masuk_harga" required />
        
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-2">Ganti Foto (Opsional)</label>
            <input type="file" name="foto" accept="image/*" class="w-full text-sm">
            <p class="text-xs text-gray-500 mt-1">*Biarkan kosong jika foto tidak ingin diganti.</p>
        </div>
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-masuk')">Batal</x-btn>
        <x-btn type="submit" form="form-edit-masuk" icon="save">Simpan Perubahan</x-btn>
    </x-slot:footer>
</x-modal>

{{-- ==================== KELUAR MODALS ==================== --}}
<x-modal name="entri-keluar" title="Input Barang Keluar" maxWidth="md">
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
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'entri-keluar')">Batal</x-btn>
        <x-btn type="submit" form="form-entri-keluar" icon="save">Simpan Data</x-btn>
    </x-slot:footer>
</x-modal>

<x-modal name="edit-keluar" title="Edit Barang Keluar" maxWidth="md">
    <form id="form-edit-keluar" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-input name="tanggal" type="date" label="Tanggal Keluar" id="edit_keluar_tanggal" required />
        
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-2">Nama Barang (Tidak bisa diubah)</label>
            <input type="text" name="nama_barang" id="edit_keluar_nama" readonly 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-gray-100 cursor-not-allowed">
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input name="jumlah" type="number" label="Jumlah Keluar" id="edit_keluar_jumlah" required />
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-600 mb-2">Update Foto (Opsional)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-sm border border-gray-300 rounded-lg p-2">
            </div>
        </div>
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-keluar')">Batal</x-btn>
        <x-btn type="submit" form="form-edit-keluar" icon="save">Simpan Perubahan</x-btn>
    </x-slot:footer>
</x-modal>
@endsection

@push('scripts')
<script>
    function openEditModalMasuk(btn) { 
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-masuk' }));
        
        let id = btn.getAttribute('data-id');
        document.getElementById('edit_masuk_tanggal').value = btn.getAttribute('data-tanggal');
        document.getElementById('edit_masuk_nama').value = btn.getAttribute('data-nama');
        document.getElementById('edit_masuk_jumlah').value = btn.getAttribute('data-jumlah');
        document.getElementById('edit_masuk_satuan').value = btn.getAttribute('data-satuan');
        document.getElementById('edit_masuk_harga').value = btn.getAttribute('data-harga');
        
        document.getElementById('form-edit-masuk').action = "{{ url('/admin/barang-masuk') }}/" + id;
    }

    function openEditModalKeluar(btn) { 
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-keluar' }));
        
        let id = btn.getAttribute('data-id');
        document.getElementById('edit_keluar_tanggal').value = btn.getAttribute('data-tanggal');
        document.getElementById('edit_keluar_nama').value = btn.getAttribute('data-nama');
        document.getElementById('edit_keluar_jumlah').value = btn.getAttribute('data-jumlah');
        
        document.getElementById('form-edit-keluar').action = "{{ url('/admin/barang-keluar') }}/" + id;
    }
</script>
@endpush