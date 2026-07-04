@extends('layouts.admin')

@section('title', $isGudangUtama ? 'Stok Gudang Keluar' : 'Barang Keluar')

@section('content')
<x-page-header title="{{ $isGudangUtama ? 'Data Stok Gudang Keluar' : 'Data Barang Keluar' }}" :breadcrumbs="['Dashboard', 'Transaksi', $isGudangUtama ? 'Stok Gudang Keluar' : 'Barang Keluar']">
    <x-btn icon="plus" @click="$dispatch('open-modal', 'entri-barang')">Entri Data</x-btn>
</x-page-header>

@if(session('error'))
    <x-alert type="error" class="mb-4" dismissible>{{ session('error') }}</x-alert>
@endif
@if(session('success'))
    <x-alert type="success" class="mb-4" dismissible>{{ session('success') }}</x-alert>
@endif

<div x-data="{ tabAktif: '{{ $filterKategori ?? 'Bar' }}' }" class="mb-6">
    <div class="flex flex-wrap items-end gap-3 border-b border-zinc-200 pb-3">
        <a href="{{ url('/transaksi/barang-keluar?kategori_lokasi=Bar') }}"
           :class="tabAktif === 'Bar' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white text-zinc-600 border-zinc-200'"
           class="px-4 py-2 rounded-lg border text-sm font-semibold transition-colors">Stok Bar</a>
        <a href="{{ url('/transaksi/barang-keluar?kategori_lokasi=Dapur') }}"
           :class="tabAktif === 'Dapur' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white text-zinc-600 border-zinc-200'"
           class="px-4 py-2 rounded-lg border text-sm font-semibold transition-colors">Stok Dapur</a>
        <a href="{{ url('/transaksi/barang-keluar?kategori_lokasi=Semua') }}"
           :class="tabAktif === 'Semua' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white text-zinc-600 border-zinc-200'"
           class="px-4 py-2 rounded-lg border text-sm font-semibold transition-colors">Semua</a>

        @if($isGudangUtama)
        <form action="{{ url('/transaksi/barang-keluar') }}" method="GET" class="flex flex-wrap items-end gap-3 ml-auto">
            <input type="hidden" name="kategori_lokasi" value="{{ $filterKategori ?? 'Semua' }}">

            <div class="min-w-[220px]">
                <label class="text-label block mb-2">Filter Cabang Tujuan</label>
                <select name="cabang_tujuan_id" class="form-control">
                    <option value="">Semua Cabang</option>
                    @foreach($daftarCabangTujuan as $cabang)
                        <option value="{{ $cabang->id }}" {{ (string) ($filterCabangTujuan ?? '') === (string) $cabang->id ? 'selected' : '' }}>{{ $cabang->nama_cabang }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-wrap gap-2">
                <x-btn type="submit" icon="search">Tampilkan</x-btn>
                <x-btn variant="secondary" href="{{ url('/transaksi/barang-keluar?kategori_lokasi=' . ($filterKategori ?? 'Semua')) }}">Reset</x-btn>
            </div>
        </form>
        @endif
    </div>
</div>

<x-card :padding="false">
    <div class="p-6">
        <x-data-table>
            <x-slot:header>
                <th class="px-3 py-2.5">No.</th>
                <th class="px-3 py-2.5">Tanggal</th>
                <th class="px-3 py-2.5">Barang</th>
                <th class="px-3 py-2.5">Kategori</th>
                <th class="px-3 py-2.5">Jumlah Keluar</th>
                <th class="px-3 py-2.5">Satuan</th>
                @if($isGudangUtama)
                <th class="px-3 py-2.5">Pengambil</th>
                <th class="px-3 py-2.5">Cabang Tujuan</th>
                @endif
                <th class="px-3 py-2.5">Foto</th>
                <th class="px-3 py-2.5">Aksi</th>
            </x-slot:header>

            @forelse($barang_keluar as $index => $item)
                <tr class="hover:bg-zinc-50 transition-colors">
                    <td class="px-3 py-2.5">{{ $index + 1 }}</td>
                    <td class="px-3 py-2.5">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td class="px-3 py-2.5 font-bold text-zinc-900">{{ $item->nama_barang }}</td>
                    <td class="px-3 py-2.5">
                        <x-badge variant="{{ $item->kategori_lokasi == 'Bar' ? 'success' : 'warning' }}">{{ $item->kategori_lokasi }}</x-badge>
                    </td>
                    <td class="px-3 py-2.5">{{ $item->jumlah }}</td>
                    <td class="px-3 py-2.5">{{ $item->satuan }}</td>
                    @if($isGudangUtama)
                    <td class="px-3 py-2.5">{{ $item->nama_pengambil_barang ?? '-' }}</td>
                    <td class="px-3 py-2.5">
                        @if($item->cabang_tujuan_nama)
                            <x-badge variant="info">{{ $item->cabang_tujuan_nama }}</x-badge>
                        @else
                            -
                        @endif
                    </td>
                    @endif
                    <td class="px-3 py-2.5">
                        @if($item->foto)
                            <img src="{{ asset('uploads/' . $item->foto) }}" class="w-12 h-12 rounded-lg object-cover border border-zinc-200" alt="Foto">
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
                                data-kategori="{{ $item->kategori_lokasi }}"
                                data-pengambil="{{ $item->nama_pengambil_barang ?? '' }}"
                                data-cabangtujuan="{{ $item->cabang_tujuan_id ?? '' }}"
                                onclick="openEditModal(this)">
                                <x-icon name="edit" class="w-4 h-4" />
                            </x-btn>
                            @if(auth()->user()->hak_akses != 'Karyawan')
                            <form action="{{ url('/transaksi/barang-keluar/' . $item->id) }}" method="POST"
                                  onsubmit="return confirmDeleteForm(event, 'Hapus riwayat ini?')">
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
                    <td colspan="{{ $isGudangUtama ? 10 : 8 }}" class="px-4 py-8 text-center text-zinc-500">
                        <x-icon name="inbox" class="w-10 h-10 text-zinc-300 mx-auto mb-2 block" />
                        <p>Belum ada data barang keluar</p>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </div>
</x-card>
<x-modal name="entri-barang" title="Input Barang Keluar" maxWidth="md">
    <form id="form-entri-keluar" action="{{ url('/transaksi/barang-keluar') }}" method="POST" enctype="multipart/form-data" x-data="{ kategoriLokasi: '{{ in_array($filterKategori ?? 'Bar', ['Bar', 'Dapur']) ? $filterKategori : 'Bar' }}' }">
        @csrf
        <x-input name="tanggal" type="date" label="Tanggal Keluar" required />

        <x-select name="kategori_lokasi_filter" label="Kategori Barang" x-model="kategoriLokasi" @change="$refs.barangKeluar.value = ''" required>
            <option value="Bar">Barang Bar</option>
            <option value="Dapur">Barang Dapur</option>
        </x-select>

        <x-select name="id_barang_master" label="Pilih Data Barang (Dari Master Data)" x-ref="barangKeluar" x-bind:key="kategoriLokasi" required>
            <option value="">-- Pilih Barang dari Gudang --</option>
            @foreach($stok_tersedia as $stok)
                <option x-show="kategoriLokasi === '{{ $stok->kategori_lokasi }}'" value="{{ $stok->id }}">{{ $stok->nama_barang }} (Sisa: {{ $stok->jumlah }} {{ $stok->satuan }})</option>
            @endforeach
        </x-select>

        @if($isGudangUtama)
            <x-input name="jumlah" type="number" label="Jumlah Keluar" min="1" required />

            <div class="border-t border-zinc-200 pt-4 mt-4">
                <x-input name="nama_pengambil_barang" label="Nama Pengambil Barang" placeholder="Masukkan nama pengambil" required />
                <x-select name="cabang_tujuan_id" label="Cabang Tujuan" required>
                    <option value="">-- Pilih Cabang Tujuan --</option>
                    @foreach($daftarCabangTujuan as $cabang)
                        <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                    @endforeach
                </x-select>

                <div class="mb-4">
                    <label class="text-label block mb-2">Foto Bukti Keluar (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-sm border border-zinc-200 rounded-lg p-2">
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-input name="jumlah" type="number" label="Jumlah Keluar" min="1" required />
                <div class="mb-4">
                    <label class="text-label block mb-2">Foto Bukti Keluar (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-sm border border-zinc-200 rounded-lg p-2">
                </div>
            </div>
        @endif
    </form>

    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'entri-barang')">Batal</x-btn>
        <x-btn type="submit" form="form-entri-keluar" icon="save">Simpan Data</x-btn>
    </x-slot:footer>
</x-modal>

<x-modal name="edit-barang" title="Edit Barang Keluar" maxWidth="md">
    <form id="form-edit-keluar" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-input name="tanggal" type="date" label="Tanggal Keluar" id="edit_tanggal" required />

        <div class="mb-4">
            <label class="text-label block mb-2">Nama Barang (Tidak bisa diubah)</label>
            <input type="text" name="nama_barang" id="edit_nama" readonly
                   class="w-full px-3 py-2 border border-zinc-200 rounded-lg text-sm bg-zinc-100 cursor-not-allowed">
        </div>

        <x-select name="kategori_lokasi" label="Kategori Lokasi" id="edit_kategori" required>
            <option value="Bar">Bar</option>
            <option value="Dapur">Dapur</option>
        </x-select>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input name="jumlah" type="number" label="Jumlah Keluar" id="edit_jumlah" required />
            <div class="mb-4">
                <label class="text-label block mb-2">Update Foto (Opsional)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-sm border border-zinc-200 rounded-lg p-2">
            </div>
        </div>

        @if($isGudangUtama)
        <div class="border-t border-zinc-200 pt-4 mt-4">
            <x-input name="nama_pengambil_barang" label="Nama Pengambil Barang" id="edit_pengambil" />
            <x-select name="cabang_tujuan_id" label="Cabang Tujuan" id="edit_cabang_tujuan">
                <option value="">-- Pilih Cabang Tujuan --</option>
                @foreach($daftarCabangTujuan as $cabang)
                    <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                @endforeach
            </x-select>
        </div>
        @endif
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
        document.getElementById('edit_kategori').value = btn.getAttribute('data-kategori');

        var pengambilEl = document.getElementById('edit_pengambil');
        if (pengambilEl) {
            pengambilEl.value = btn.getAttribute('data-pengambil') || '';
        }
        var cabangEl = document.getElementById('edit_cabang_tujuan');
        if (cabangEl) {
            cabangEl.value = btn.getAttribute('data-cabangtujuan') || '';
        }

        document.getElementById('form-edit-keluar').action = "{{ url('/transaksi/barang-keluar') }}/" + id;
    }
</script>
@endpush
