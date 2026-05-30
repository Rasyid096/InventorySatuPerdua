@extends('layouts.admin')

@section('title', 'Laporan Barang Keluar')

@section('content')
<x-page-header title="Laporan Riwayat Barang Keluar" />

{{-- Filter Card --}}
<x-card class="mb-6">
    <form action="{{ url('/admin/laporan-barang-keluar') }}" method="GET" class="flex flex-col lg:flex-row lg:items-end gap-4 flex-wrap" x-data="{ showCustom: '{{ $request->filter }}' === 'custom' }">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-600 mb-2">Periode Keluar *</label>
            <select name="filter" 
                    @change="showCustom = $event.target.value === 'custom'"
                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <option value="semua" {{ $request->filter == 'semua' ? 'selected' : '' }}>Semua Data</option>
                <option value="hari_ini" {{ $request->filter == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                <option value="minggu" {{ $request->filter == 'minggu' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                <option value="bulan" {{ $request->filter == 'bulan' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                <option value="custom" {{ $request->filter == 'custom' ? 'selected' : '' }}>Pilih Tanggal Custom</option>
            </select>
        </div>
        
        <div x-show="showCustom" x-transition class="flex flex-col sm:flex-row gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-2">Dari Tanggal</label>
                <input type="date" name="tanggal_mulai" value="{{ $request->tanggal_mulai }}"
                       class="px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-2">Sampai Tanggal</label>
                <input type="date" name="tanggal_sampai" value="{{ $request->tanggal_sampai }}"
                       class="px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
        </div>
        
        <div class="flex flex-wrap items-center gap-2">
            <x-btn type="submit" icon="search">Tampilkan</x-btn>
            
            @if($filter_aktif)
                @php
                    $params = '?filter=' . $request->filter . '&tanggal_mulai=' . $request->tanggal_mulai . '&tanggal_sampai=' . $request->tanggal_sampai;
                @endphp
                <x-btn variant="warning" icon="print" href="{{ url('/admin/laporan-barang-keluar/cetak' . $params) }}" target="_blank">
                    Cetak PDF
                </x-btn>
                <x-btn variant="success" icon="file-excel" href="{{ url('/admin/laporan-barang-keluar/export' . $params) }}">
                    Export Excel
                </x-btn>
            @endif
        </div>
    </form>
</x-card>

{{-- Data Table Card --}}
<x-card :padding="false">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
        <i class="fas fa-arrow-up text-orange-500"></i>
        <h3 class="font-bold text-gray-600">Detail Transaksi Barang Keluar</h3>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[600px]">
                <thead>
                    <tr class="bg-gray-50 text-left text-gray-600 font-semibold">
                        <th class="px-4 py-3">No.</th>
                        <th class="px-4 py-3">Tanggal Keluar</th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Nama Barang</th>
                        <th class="px-4 py-3">Jumlah Keluar</th>
                        <th class="px-4 py-3">Satuan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($data_laporan as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td class="px-4 py-3">
                                @if($item->foto)
                                    <img src="{{ asset('uploads/' . $item->foto) }}" 
                                         class="w-12 h-12 rounded-lg object-cover border border-gray-200" 
                                         alt="Foto">
                                @else
                                    <span class="text-gray-400 text-xs italic">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-bold text-gray-800">{{ $item->nama_barang }}</td>
                            <td class="px-4 py-3">{{ $item->jumlah }}</td>
                            <td class="px-4 py-3">{{ $item->satuan }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-red-500">
                                <i class="fas fa-exclamation-circle text-2xl mb-2"></i>
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
