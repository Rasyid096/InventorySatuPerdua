@extends('layouts.admin')

@section('title', 'Laporan Barang Keluar')

@section('content')
<x-page-header title="Laporan Riwayat Barang Keluar" />

{{-- Filter Card --}}
<x-card class="mb-6">
    <form action="{{ url('/admin/laporan-barang-keluar') }}" method="GET" class="flex flex-col lg:flex-row lg:items-end gap-4 flex-wrap" x-data="{ showCustom: '{{ $request->filter }}' === 'custom' }">
        <div class="flex-1 min-w-[200px]">
            <label class="text-label block mb-2">Periode Keluar *</label>
            <select name="filter" 
                    @change="showCustom = $event.target.value === 'custom'"
                    class="form-control">
                <option value="semua" {{ $request->filter == 'semua' ? 'selected' : '' }}>Semua Data</option>
                <option value="hari_ini" {{ $request->filter == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                <option value="minggu" {{ $request->filter == 'minggu' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                <option value="bulan" {{ $request->filter == 'bulan' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                <option value="custom" {{ $request->filter == 'custom' ? 'selected' : '' }}>Pilih Tanggal Custom</option>
            </select>
        </div>
        
        <div x-show="showCustom" x-transition class="flex flex-col sm:flex-row gap-4">
            <div>
                <label class="text-label block mb-2">Dari Tanggal</label>
                <input type="date" name="tanggal_mulai" value="{{ $request->tanggal_mulai }}"
                       class="form-control">
            </div>
            <div>
                <label class="text-label block mb-2">Sampai Tanggal</label>
                <input type="date" name="tanggal_sampai" value="{{ $request->tanggal_sampai }}"
                       class="form-control">
            </div>
        </div>
        
        <div class="flex flex-wrap items-center gap-2">
            <x-btn type="submit" icon="search">Tampilkan</x-btn>
            
            @php
                $params = $filter_aktif ? '?filter=' . $request->filter . '&tanggal_mulai=' . ($request->tanggal_mulai ?? '') . '&tanggal_sampai=' . ($request->tanggal_sampai ?? '') : '';
            @endphp
            <x-btn variant="warning" icon="print" href="{{ url('/admin/laporan-barang-keluar/cetak' . $params) }}" target="_blank">
                Cetak PDF
            </x-btn>
            <x-btn variant="success" icon="file-excel" href="{{ url('/admin/laporan-barang-keluar/export' . $params) }}">
                Export Excel
            </x-btn>
        </div>
    </form>
</x-card>

{{-- Data Table Card --}}
<x-card :padding="false">
    <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
        <x-icon name="arrow-up" class="w-5 h-5 text-orange-500" />
        <h3 class="text-section-title">Detail Transaksi Barang Keluar</h3>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[600px]">
                <thead>
                    <tr class="bg-zinc-50 text-left text-zinc-600 font-semibold">
                        <th class="px-3 py-2.5">No.</th>
                        <th class="px-3 py-2.5">Tanggal Keluar</th>
                        <th class="px-3 py-2.5">Nama Barang</th>
                        <th class="px-3 py-2.5">Jumlah Keluar</th>
                        <th class="px-3 py-2.5">Satuan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($data_laporan as $index => $item)
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-3 py-2.5">{{ $index + 1 }}</td>
                            <td class="px-3 py-2.5">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td class="px-3 py-2.5 font-bold text-zinc-900">{{ $item->nama_barang }}</td>
                            <td class="px-3 py-2.5">{{ $item->jumlah }}</td>
                            <td class="px-3 py-2.5">{{ $item->satuan }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-red-500">
                                <x-icon name="exclamation-circle" class="w-8 h-8 mx-auto mb-2 text-zinc-400 block" />
                                <p>Tidak ada transaksi barang keluar pada periode ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-card>
@endsection
