@extends('layouts.admin')

@section('title', 'Data Barang')

@section('content')
<x-page-header title="Master Data Barang (Gudang Aktual)" :breadcrumbs="['Dashboard', 'Master Data', 'Data Barang']">
</x-page-header>

@if(session('success'))
    <x-alert type="success" class="mb-4" dismissible>
        {{ session('success') }}
    </x-alert>
@endif

<x-card :padding="false">
    <div class="p-4 lg:p-5">
        <x-data-table>
            <x-slot:header>
                <th class="px-3 py-2.5">No.</th>
                <th class="px-3 py-2.5">Tgl Update Terakhir</th>
                <th class="px-3 py-2.5">Foto</th>
                <th class="px-3 py-2.5">Nama Barang</th>
                <th class="px-3 py-2.5">Sisa Stok</th>
                <th class="px-3 py-2.5">Satuan</th>
                <th class="px-3 py-2.5">Status</th>
                <th class="px-3 py-2.5">Aksi</th>
            </x-slot:header>
            
            @forelse($data_barang as $index => $item)
                <tr class="hover:bg-zinc-50 transition-colors" data-barang-id="{{ $item->id }}">
                    <td class="px-3 py-2.5">{{ $index + 1 }}</td>
                    <td class="px-3 py-2.5">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td class="px-3 py-2.5">
                        @if($item->foto) 
                            <img src="{{ asset('uploads/' . $item->foto) }}" 
                                 class="w-12 h-12 rounded-lg object-cover border border-zinc-200" 
                                 alt="Foto">
                        @else 
                            <span class="text-zinc-400 text-xs italic">Tidak ada foto</span>
                        @endif
                    </td>
                    <td class="px-3 py-2.5 font-bold text-zinc-900">{{ $item->nama_barang }}</td>
                    <td class="px-3 py-2.5 font-semibold text-brand-600">{{ $item->jumlah }}</td>
                    <td class="px-3 py-2.5">{{ $item->satuan }}</td>
                    <td class="px-3 py-2.5">
                        @if($item->jumlah == 0)
                            <x-badge variant="danger">Kosong</x-badge>
                        @elseif($item->jumlah < 6)
                            <x-badge variant="warning">Menipis</x-badge>
                        @else
                            <x-badge variant="success">Aman</x-badge>
                        @endif
                    </td>
                    <td class="px-3 py-2.5">
                        <div class="flex items-center gap-2">
                            <x-btn variant="warning" size="sm"
                                data-id="{{ $item->id }}" 
                                data-nama="{{ $item->nama_barang }}" 
                                data-jumlah="{{ $item->jumlah }}" 
                                data-satuan="{{ $item->satuan }}" 
                                onclick="openEditModal(this)">
                                <x-icon name="edit" class="w-4 h-4" />
                            </x-btn>
                            @if(auth()->user()->hak_akses != 'Karyawan')
                            <form action="{{ url('/admin/data-barang/' . $item->id) }}" method="POST" 
                                  onsubmit="return confirmDeleteForm(event, 'Data master barang ini akan dihapus!')">
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
                    <td colspan="8" class="px-4 py-8 text-center text-zinc-500">
                        <x-icon name="box-open" class="w-10 h-10 text-zinc-300 mx-auto mb-2 block" />
                        <p>Belum ada data barang</p>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </div>
</x-card>

{{-- Edit Modal --}}
<x-modal name="edit-barang" title="Edit Data Barang" maxWidth="md">
    <form id="form-edit-barang" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-input name="nama_barang" label="Nama Barang" id="edit_nama" required />
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-input name="jumlah" type="number" label="Sisa Stok Aktual" id="edit_jumlah" required />
            <x-select name="satuan" label="Satuan" id="edit_satuan" required>
                @foreach($daftar_satuan as $satuan)
                    <option value="{{ $satuan->nama_satuan }}">{{ $satuan->nama_satuan }}</option>
                @endforeach
            </x-select>
        </div>
        
        <x-input name="foto" type="file" label="Update Foto (Opsional)" accept="image/*" />
    </form>
    
    <x-slot:footer>
        <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-barang')">Batal</x-btn>
        <x-btn type="submit" form="form-edit-barang" icon="save">Simpan Perubahan</x-btn>
    </x-slot:footer>
</x-modal>

{{-- Riwayat Transaksi Terbaru --}}
<x-card class="mt-6">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <x-icon name="history" class="w-5 h-5 text-blue-600" />
            <h3 class="text-lg font-bold text-zinc-900">Riwayat Transaksi Terbaru</h3>
        </div>
        <select id="filter-jenis" class="px-3 py-1.5 text-sm border border-zinc-200 rounded-lg">
            <option value="">Semua Jenis</option>
            <option value="Masuk">Masuk</option>
            <option value="Keluar">Keluar</option>
        </select>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-zinc-50 text-left text-zinc-600 font-semibold">
                    <th class="px-3 py-2.5 w-12">No</th>
                    <th class="px-3 py-2.5">Tanggal</th>
                    <th class="px-3 py-2.5">Jenis</th>
                    <th class="px-3 py-2.5">Nama Barang</th>
                    <th class="px-3 py-2.5 text-right">Jumlah</th>
                    <th class="px-3 py-2.5">Satuan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100" id="riwayat-tbody">
                @forelse($riwayat_terbaru as $index => $trans)
                <tr class="hover:bg-zinc-50 transition-colors riwayat-item" data-jenis="{{ $trans->jenis }}">
                    <td class="px-3 py-2.5 text-zinc-500">{{ $index + 1 }}</td>
                    <td class="px-3 py-2.5">{{ \Carbon\Carbon::parse($trans->tanggal)->format('d/m/Y H:i') }}</td>
                    <td class="px-3 py-2.5">
                        @if($trans->jenis == 'Masuk')
                            <x-badge variant="success"><x-icon name="arrow-down" class="w-3 h-3" /> Masuk</x-badge>
                        @else
                            <x-badge variant="danger"><x-icon name="arrow-up" class="w-3 h-3" /> Keluar</x-badge>
                        @endif
                    </td>
                    <td class="px-3 py-2.5 font-semibold text-zinc-900">{{ $trans->nama_barang }}</td>
                    <td class="px-3 py-2.5 text-right font-semibold">{{ $trans->jumlah }}</td>
                    <td class="px-3 py-2.5">{{ $trans->satuan }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-zinc-500">
                        <x-icon name="inbox" class="w-8 h-8 text-zinc-300 mx-auto mb-2 block" />
                        <p>Belum ada transaksi</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-card>
@endsection

@push('scripts')
<script>
    function openEditModal(btn) { 
        // Open modal
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-barang' }));
        
        let id = btn.getAttribute('data-id');
        document.getElementById('edit_nama').value = btn.getAttribute('data-nama');
        document.getElementById('edit_jumlah').value = btn.getAttribute('data-jumlah');
        document.getElementById('edit_satuan').value = btn.getAttribute('data-satuan');
        
        document.getElementById('form-edit-barang').action = "{{ url('/admin/data-barang') }}/" + id;
    }

    // Filter riwayat by jenis
    document.getElementById('filter-jenis').addEventListener('change', function() {
        const filter = this.value;
        const rows = document.querySelectorAll('.riwayat-item');
        
        rows.forEach((row, index) => {
            const jenis = row.getAttribute('data-jenis');
            if (filter === '' || jenis === filter) {
                row.style.display = '';
                // Update numbering
                row.querySelector('td:first-child').textContent = Array.from(rows).filter((r, i) => {
                    const rJenis = r.getAttribute('data-jenis');
                    return (filter === '' || rJenis === filter) && r.style.display !== 'none' && i <= index;
                }).length;
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endpush
