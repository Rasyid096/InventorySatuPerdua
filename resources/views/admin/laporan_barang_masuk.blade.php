@extends('layouts.admin')

@section('title', $isGudangUtama ? 'Laporan Stok Masuk' : 'Laporan Barang Masuk')

@section('content')
<x-page-header title="{{ $isGudangUtama ? 'Laporan Stok Masuk' : 'Laporan Riwayat Barang Masuk' }}" />

<x-card class="mb-6">
    <form action="{{ url('/laporan/barang-masuk') }}" method="GET" class="flex flex-col lg:flex-row lg:items-end gap-4 flex-wrap" x-data="{
        showCustom: '{{ $request->filter }}' === 'custom',
        buildUrl(path) {
            const params = new URLSearchParams(new FormData($el));
            return path + '?' + params.toString();
        }
    }">
        <div class="flex-1 min-w-[200px]">
            <label class="text-label block mb-2">Periode Masuk *</label>
            <select name="filter" @change="showCustom = $event.target.value === 'custom'" class="form-control">
                <option value="semua" {{ $request->filter == 'semua' ? 'selected' : '' }}>Semua Data</option>
                <option value="hari_ini" {{ $request->filter == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                <option value="minggu" {{ $request->filter == 'minggu' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                <option value="bulan" {{ $request->filter == 'bulan' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                <option value="custom" {{ $request->filter == 'custom' ? 'selected' : '' }}>Pilih Tanggal Custom</option>
            </select>
        </div>

        <div class="min-w-[180px]">
            <label class="text-label block mb-2">Filter Kategori</label>
            <select name="kategori_lokasi" class="form-control">
                <option value="">Semua</option>
                <option value="Bar" {{ $request->kategori_lokasi == 'Bar' ? 'selected' : '' }}>Bar</option>
                <option value="Dapur" {{ $request->kategori_lokasi == 'Dapur' ? 'selected' : '' }}>Dapur</option>
            </select>
        </div>

        <div x-show="showCustom" x-transition class="flex flex-col sm:flex-row gap-4">
            <div>
                <label class="text-label block mb-2">Dari Tanggal</label>
                <input type="date" name="tanggal_mulai" value="{{ $request->tanggal_mulai }}" class="form-control">
            </div>
            <div>
                <label class="text-label block mb-2">Sampai Tanggal</label>
                <input type="date" name="tanggal_sampai" value="{{ $request->tanggal_sampai }}" class="form-control">
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <x-btn type="submit" icon="search">Tampilkan</x-btn>
            <a href="{{ url('/laporan/barang-masuk/cetak') }}" target="_blank" x-bind:href="buildUrl('{{ url('/laporan/barang-masuk/cetak') }}')" class="inline-flex items-center justify-center gap-2 font-medium rounded-lg transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600/30 focus-visible:ring-offset-2 h-9 px-4 text-sm bg-amber-500 text-white hover:bg-amber-600 shadow-sm">
                <x-icon name="print" class="w-4 h-4" />
                Cetak PDF
            </a>
            <a href="{{ url('/laporan/barang-masuk/export') }}" x-bind:href="buildUrl('{{ url('/laporan/barang-masuk/export') }}')" class="inline-flex items-center justify-center gap-2 font-medium rounded-lg transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600/30 focus-visible:ring-offset-2 h-9 px-4 text-sm bg-brand-600 text-white hover:bg-brand-700 shadow-sm">
                <x-icon name="file-excel" class="w-4 h-4" />
                Export Excel
            </a>
        </div>
    </form>
</x-card>

<x-card :padding="false">
    <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
        <x-icon name="arrow-down" class="w-5 h-5 text-green-600" />
        <h3 class="text-section-title">Detail Transaksi Barang Masuk</h3>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[780px]">
                <thead>
                    <tr class="bg-zinc-50 text-left text-zinc-600 font-semibold">
                        <th class="px-3 py-2.5">No.</th>
                        <th class="px-3 py-2.5">Tanggal Masuk</th>
                        <th class="px-3 py-2.5">Nama Barang</th>
                        <th class="px-3 py-2.5">Kategori</th>
                        <th class="px-3 py-2.5">Jumlah Masuk</th>
                        <th class="px-3 py-2.5">Satuan</th>
                        @if($isGudangUtama)
                        <th class="px-3 py-2.5">Harga</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($data_laporan as $index => $item)
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
                            <td class="px-3 py-2.5">Rp {{ number_format($item->harga_total, 0, ',', '.') }}</td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $isGudangUtama ? 7 : 6 }}" class="px-4 py-8 text-center text-red-500">
                                <x-icon name="exclamation-circle" class="w-8 h-8 mx-auto mb-2 text-zinc-400 block" />
                                <p>Tidak ada transaksi barang masuk pada periode ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                @if($isGudangUtama && $data_laporan->count() > 0)
                <tfoot>
                    <tr class="bg-zinc-100 font-bold">
                        <td colspan="6" class="px-3 py-2.5 text-right">Total Harga:</td>
                        <td class="px-3 py-2.5">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</x-card>
@endsection
