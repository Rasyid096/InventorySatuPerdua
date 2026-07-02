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

<div x-data="{ tabAktif: '{{ $filterKategori ?? 'Bar' }}' }" class="mb-6">
    <div class="flex flex-wrap gap-2 border-b border-zinc-200 pb-3">
        <a href="{{ url('/transaksi/barang-masuk?kategori_lokasi=Bar') }}"
           :class="tabAktif === 'Bar' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white text-zinc-600 border-zinc-200'"
           class="px-4 py-2 rounded-lg border text-sm font-semibold transition-colors">
            Stok Bar
        </a>
        <a href="{{ url('/transaksi/barang-masuk?kategori_lokasi=Dapur') }}"
           :class="tabAktif === 'Dapur' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white text-zinc-600 border-zinc-200'"
           class="px-4 py-2 rounded-lg border text-sm font-semibold transition-colors">
            Stok Dapur
        </a>
        <a href="{{ url('/transaksi/barang-masuk?kategori_lokasi=Semua') }}"
           :class="tabAktif === 'Semua' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white text-zinc-600 border-zinc-200'"
           class="px-4 py-2 rounded-lg border text-sm font-semibold transition-colors">
            Semua
        </a>
    </div>
</div>

<x-card :padding="false">
    <div class="p-6">
        <x-data-table>
            <x-slot:header>
                <th class="px-3 py-2.5">No.</th>
                <th class="px-3 py-2.5">Tanggal</th>
                <th class="px-3 py-2.5">Nama Barang</th>
                <th class="px-3 py-2.5">Kategori</th>
                <th class="px-3 py-2.5">Jumlah Masuk</th>
                <th class="px-3 py-2.5">Satuan</th>
                <th class="px-3 py-2.5">Foto</th>
                <th class="px-3 py-2.5">Aksi</th>
            </x-slot:header>

            @forelse($barang_masuk as $index => $item)
                <tr class="hover:bg-zinc-50 transition-colors">
                    <td class="px-3 py-2.5">{{ $index + 1 }}</td>
                    <td class="px-3 py-2.5">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td class="px-3 py-2.5 table-cell-name">{{ $item->nama_barang }}</td>
                    <td class="px-3 py-2.5">
                        <x-badge variant="{{ $item->kategori_lokasi == 'Bar' ? 'success' : 'warning' }}">{{ $item->kategori_lokasi }}</x-badge>
                    </td>
                    <td class="px-3 py-2.5">{{ $item->jumlah }}</td>
                    <td class="px-3 py-2.5">{{ $item->satuan }}</td>
                    <td class="px-3 py-2.5">
                        @if($item->foto)
                            <img src="{{ asset('uploads/' . $item->foto) }}"
                                 class="w-12 h-12 rounded-lg object-cover border border-zinc-200"
                                 alt="Foto">
                        @else
                            <span class="text-zinc-400 text-xs italic">Tidak ada foto</span>
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
                                data-kategori="{{ $item->kategori_lokasi }}"
                                onclick="openEditModal(this)">
                                <x-icon name="edit" class="w-4 h-4" />
                            </x-btn>
                            @if(auth()->user()->hak_akses != 'Karyawan')
                            <form action="{{ url('/transaksi/barang-masuk/' . $item->id) }}" method="POST"
                                  onsubmit="return confirmDeleteForm(event)">
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
                    <td colspan="8">
                        <x-empty-state message="Belum ada data barang masuk" />
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </div>
</x-card>

<x-modal name="entri-barang" title="Input Barang Masuk" maxWidth="md">
    <form id="form-entri-barang" action="{{ url('/transaksi/barang-masuk') }}" method="POST" enctype="multipart/form-data" x-data="{ kategoriLokasi: '{{ in_array($filterKategori ?? 'Bar', ['Bar', 'Dapur']) ? $filterKategori : 'Bar' }}', isCustom: false }">
        @csrf
        <x-input name="tanggal" type="date" label="Tanggal Masuk" required />

        <x-select name="kategori_lokasi" label="Kategori Barang" x-model="kategoriLokasi" @change="isCustom = false; document.getElementById('nama_barang_input').value = ''; document.getElementById('nama_barang_custom').value = '';" required>
            <option value="Bar">Barang Bar</option>
            <option value="Dapur">Barang Dapur</option>
        </x-select>

        <div class="mb-4">
            <label class="text-label block mb-2">Nama Barang <span class="text-red-500">*</span></label>
            <select x-model="isCustom"
                    @change="if ($event.target.value !== 'custom') { document.getElementById('nama_barang_input').value = $event.target.value; } else { document.getElementById('nama_barang_input').value = ''; }"
                    class="form-control"
                    :key="kategoriLokasi"
                    required>
                <option value="">-- Pilih Barang --</option>
                @foreach($preset_barang as $preset)
                    <option x-show="kategoriLokasi === '{{ $preset->kategori_lokasi }}'" value="{{ $preset->nama_barang }}">{{ $preset->nama_barang }}</option>
                @endforeach
                <option value="custom">Lainnya (Input Manual)</option>
            </select>
        </div>

        <div x-show="isCustom === 'custom'" x-transition class="mb-4">
            <label class="text-label block mb-2">Nama Barang Custom</label>
            <input type="text"
                   id="nama_barang_custom"
                   placeholder="Masukkan nama barang..."
                   @input="document.getElementById('nama_barang_input').value = $event.target.value"
                   class="form-control">
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

        <x-select name="kategori_lokasi" label="Kategori Lokasi" id="edit_kategori" required>
            <option value="Bar">Bar</option>
            <option value="Dapur">Dapur</option>
        </x-select>

        <div class="mb-4">
            <label class="text-label block mb-2">Ganti Foto (Opsional)</label>
            <input type="file" name="foto" accept="image/*" class="w-full text-sm text-zinc-600">
            <p class="text-caption mt-1">*Biarkan kosong jika foto tidak ingin diganti.</p>
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
        document.getElementById('edit_kategori').value = btn.getAttribute('data-kategori');

        document.getElementById('form-edit-barang').action = "{{ url('/transaksi/barang-masuk') }}/" + id;
    }
</script>
@endpush
