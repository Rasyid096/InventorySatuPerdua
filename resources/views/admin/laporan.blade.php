@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
<x-page-header title="Laporan" :breadcrumbs="['Dashboard', 'Laporan']" />

<x-card class="mb-6">
    <form action="{{ url('/admin/laporan') }}" method="GET" class="flex flex-col lg:flex-row lg:items-end gap-4 flex-wrap" x-data="{ showCustom: '{{ $request->filter ?? '' }}' === 'custom' }">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-600 mb-2">Periode *</label>
            <select name="filter"
                    @change="showCustom = $event.target.value === 'custom'"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <option value="semua" {{ ($request->filter ?? '') == 'semua' ? 'selected' : '' }}>Semua Data</option>
                <option value="hari_ini" {{ ($request->filter ?? '') == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                <option value="minggu" {{ ($request->filter ?? '') == 'minggu' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                <option value="bulan" {{ ($request->filter ?? '') == 'bulan' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                <option value="custom" {{ ($request->filter ?? '') == 'custom' ? 'selected' : '' }}>Pilih Tanggal Custom</option>
            </select>
        </div>

        <div x-show="showCustom" x-transition class="flex flex-col sm:flex-row gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-2">Dari Tanggal</label>
                <input type="date" name="tanggal_mulai" value="{{ $request->tanggal_mulai ?? '' }}"
                       class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-2">Sampai Tanggal</label>
                <input type="date" name="tanggal_sampai" value="{{ $request->tanggal_sampai ?? '' }}"
                       class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <x-btn type="submit" icon="search">Tampilkan</x-btn>
        </div>
    </form>
</x-card>

<div x-data="{ tab: 'stok' }">
    {{-- Tab Buttons --}}
    <div class="mb-4 flex flex-wrap gap-2">
        <button @click="tab = 'stok'"
                :class="tab === 'stok' ? 'bg-emerald-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-100'"
                class="px-4 py-2 rounded-lg text-sm font-semibold border border-gray-200 transition-colors">
            <i class="fas fa-chart-line mr-1"></i> Stok
        </button>
        <button @click="tab = 'masuk'"
                :class="tab === 'masuk' ? 'bg-emerald-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-100'"
                class="px-4 py-2 rounded-lg text-sm font-semibold border border-gray-200 transition-colors">
            <i class="fas fa-arrow-down mr-1"></i> Barang Masuk
        </button>
        <button @click="tab = 'keluar'"
                :class="tab === 'keluar' ? 'bg-emerald-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-100'"
                class="px-4 py-2 rounded-lg text-sm font-semibold border border-gray-200 transition-colors">
            <i class="fas fa-arrow-up mr-1"></i> Barang Keluar
        </button>
    </div>

    {{-- Export Buttons --}}
    @php
        $params = $filter_aktif ? '?filter=' . $request->filter . '&tanggal_mulai=' . ($request->tanggal_mulai ?? '') . '&tanggal_sampai=' . ($request->tanggal_sampai ?? '') : '';
    @endphp
    <div class="mb-4 flex flex-wrap gap-2">
        <div x-show="tab === 'stok'" x-transition class="flex gap-2">
            <x-btn variant="warning" icon="print" href="{{ url('/admin/laporan-stok/cetak' . $params) }}" target="_blank">
                Cetak PDF
            </x-btn>
            <x-btn variant="success" icon="file-excel" href="{{ url('/admin/laporan-stok/export' . $params) }}">
                Export Excel
            </x-btn>
        </div>
        <div x-show="tab === 'masuk'" x-transition class="flex gap-2">
            <x-btn variant="warning" icon="print" href="{{ url('/admin/laporan-barang-masuk/cetak' . $params) }}" target="_blank">
                Cetak PDF
            </x-btn>
            <x-btn variant="success" icon="file-excel" href="{{ url('/admin/laporan-barang-masuk/export' . $params) }}">
                Export Excel
            </x-btn>
        </div>
        <div x-show="tab === 'keluar'" x-transition class="flex gap-2">
            <x-btn variant="warning" icon="print" href="{{ url('/admin/laporan-barang-keluar/cetak' . $params) }}" target="_blank">
                Cetak PDF
            </x-btn>
            <x-btn variant="success" icon="file-excel" href="{{ url('/admin/laporan-barang-keluar/export' . $params) }}">
                Export Excel
            </x-btn>
        </div>
    </div>

    {{-- Stok Tab --}}
    <div x-show="tab === 'stok'" x-transition>
        <x-card :padding="false">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <i class="fas fa-file-alt text-emerald-600"></i>
                <h3 class="font-bold text-gray-600">Laporan Stok Seluruh Barang</h3>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm min-w-[600px]">
                        <thead>
                            <tr class="bg-gray-50 text-left text-gray-600 font-semibold">
                                <th class="px-3 py-2.5">No.</th>
                                <th class="px-3 py-2.5">Foto</th>
                                <th class="px-3 py-2.5">Nama Barang</th>
                                <th class="px-3 py-2.5">Sisa Stok</th>
                                <th class="px-3 py-2.5">Satuan</th>
                                <th class="px-3 py-2.5">Tgl Update Terakhir</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($data_stok as $index => $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 py-2.5">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2.5">
                                        @if($item->foto)
                                            <img src="{{ asset('uploads/' . $item->foto) }}"
                                                 class="w-12 h-12 rounded-lg object-cover border border-gray-200"
                                                 alt="Foto">
                                        @else
                                            <span class="text-gray-400 text-xs italic">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2.5">{{ $item->nama_barang }}</td>
                                    <td class="px-3 py-2.5 font-bold text-gray-800">{{ $item->jumlah }}</td>
                                    <td class="px-3 py-2.5">{{ $item->satuan }}</td>
                                    <td class="px-3 py-2.5">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-red-500">
                                        <i class="fas fa-exclamation-circle text-2xl mb-2"></i>
                                        <p>Tidak ada data stok pada periode waktu ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </x-card>
    </div>

    {{-- Barang Masuk Tab --}}
    <div x-show="tab === 'masuk'" x-transition>
        <x-card :padding="false">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <i class="fas fa-arrow-down text-green-600"></i>
                <h3 class="font-bold text-gray-600">Detail Transaksi Barang Masuk</h3>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm min-w-[700px]">
                        <thead>
                            <tr class="bg-gray-50 text-left text-gray-600 font-semibold">
                                <th class="px-3 py-2.5">No.</th>
                                <th class="px-3 py-2.5">Tanggal Masuk</th>
                                <th class="px-3 py-2.5">Foto</th>
                                <th class="px-3 py-2.5">Nama Barang</th>
                                <th class="px-3 py-2.5">Jumlah Masuk</th>
                                <th class="px-3 py-2.5">Satuan</th>
                                <th class="px-3 py-2.5">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @php $grand_total = 0; @endphp
                            @forelse($data_masuk as $index => $item)
                                @php $grand_total += $item->harga; @endphp
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 py-2.5">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2.5">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                    <td class="px-3 py-2.5">
                                        @if($item->foto)
                                            <img src="{{ asset('uploads/' . $item->foto) }}"
                                                 class="w-12 h-12 rounded-lg object-cover border border-gray-200"
                                                 alt="Foto">
                                        @else
                                            <span class="text-gray-400 text-xs italic">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2.5 font-bold text-gray-800">{{ $item->nama_barang }}</td>
                                    <td class="px-3 py-2.5">{{ $item->jumlah }}</td>
                                    <td class="px-3 py-2.5">{{ $item->satuan }}</td>
                                    <td class="px-3 py-2.5 font-semibold text-emerald-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-red-500">
                                        <i class="fas fa-exclamation-circle text-2xl mb-2"></i>
                                        <p>Tidak ada transaksi barang masuk pada periode ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if(count($data_masuk) > 0)
                            <tfoot>
                                <tr class="bg-gray-100">
                                    <th colspan="6" class="px-3 py-2.5 text-right font-bold text-gray-700">TOTAL PENGELUARAN :</th>
                                    <th class="px-3 py-2.5 font-bold text-lg text-green-600">Rp {{ number_format($grand_total, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </x-card>
    </div>

    {{-- Barang Keluar Tab --}}
    <div x-show="tab === 'keluar'" x-transition>
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
                                <th class="px-3 py-2.5">No.</th>
                                <th class="px-3 py-2.5">Tanggal Keluar</th>
                                <th class="px-3 py-2.5">Foto</th>
                                <th class="px-3 py-2.5">Nama Barang</th>
                                <th class="px-3 py-2.5">Jumlah Keluar</th>
                                <th class="px-3 py-2.5">Satuan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($data_keluar as $index => $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 py-2.5">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2.5">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                    <td class="px-3 py-2.5">
                                        @if($item->foto)
                                            <img src="{{ asset('uploads/' . $item->foto) }}"
                                                 class="w-12 h-12 rounded-lg object-cover border border-gray-200"
                                                 alt="Foto">
                                        @else
                                            <span class="text-gray-400 text-xs italic">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2.5 font-bold text-gray-800">{{ $item->nama_barang }}</td>
                                    <td class="px-3 py-2.5">{{ $item->jumlah }}</td>
                                    <td class="px-3 py-2.5">{{ $item->satuan }}</td>
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
    </div>
</div>
@endsection
