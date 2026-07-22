@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<x-page-header title="Dashboard" />

{{-- Statistik Utama --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <x-stat-card icon="box" label="Total Macam Barang" :value="$total_barang" color="blue" />
    <x-stat-card icon="sign-in-alt" label="Total Barang Masuk" :value="$total_masuk" color="green" />
    <x-stat-card icon="sign-out-alt" label="Total Barang Keluar" :value="$total_keluar" color="orange" />
    <x-stat-card icon="balance-scale" label="Total Satuan" :value="$total_satuan" color="purple" />
    <x-stat-card icon="users" label="Total User" :value="$total_user" color="emerald" />
    @if($isGudangUtama)
        <x-stat-card icon="truck" label="Total Pengirim" :value="$total_pengirim" color="amber" />
    @endif
</div>

{{-- Stok Per Kategori --}}
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
    <x-card>
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                <x-icon name="wine" class="w-5 h-5 text-green-600" />
            </div>
            <div>
                <h4 class="text-sm font-semibold text-zinc-700">Stok Kategori Bar</h4>
                <p class="text-2xl font-bold text-green-600">{{ $stok_bar }}</p>
            </div>
        </div>
        <div class="w-full bg-zinc-100 rounded-full h-2">
            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $stok_bar + $stok_dapur > 0 ? round(($stok_bar / ($stok_bar + $stok_dapur)) * 100) : 0 }}%"></div>
        </div>
    </x-card>
    <x-card>
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                <x-icon name="utensils" class="w-5 h-5 text-amber-600" />
            </div>
            <div>
                <h4 class="text-sm font-semibold text-zinc-700">Stok Kategori Dapur</h4>
                <p class="text-2xl font-bold text-amber-600">{{ $stok_dapur }}</p>
            </div>
        </div>
        <div class="w-full bg-zinc-100 rounded-full h-2">
            <div class="bg-amber-500 h-2 rounded-full" style="width: {{ $stok_bar + $stok_dapur > 0 ? round(($stok_dapur / ($stok_bar + $stok_dapur)) * 100) : 0 }}%"></div>
        </div>
    </x-card>
</div>

{{-- Barang Menipis & Kosong --}}
@if($barang_menipis->count() > 0 || $barang_kosong->count() > 0)
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
    <x-card>
        <div class="flex items-center gap-2 mb-3">
            <x-icon name="exclamation-triangle" class="w-5 h-5 text-amber-500" />
            <h4 class="font-bold text-zinc-700">Stok Menipis ({{ $barang_menipis->count() }} item)</h4>
        </div>
        <div class="space-y-2">
            @forelse($barang_menipis as $item)
                <div class="flex items-center justify-between px-3 py-2 bg-amber-50 rounded-lg">
                    <span class="font-medium text-sm">{{ $item->nama_barang }}</span>
                    <span class="text-sm font-bold text-amber-700">{{ $item->stok_saat_ini }} {{ $item->satuan ?? '' }}</span>
                </div>
            @empty
                <p class="text-sm text-zinc-500">Tidak ada stok menipis</p>
            @endforelse
        </div>
    </x-card>
    <x-card>
        <div class="flex items-center gap-2 mb-3">
            <x-icon name="times-circle" class="w-5 h-5 text-red-500" />
            <h4 class="font-bold text-zinc-700">Stok Kosong ({{ $barang_kosong->count() }} item)</h4>
        </div>
        <div class="space-y-2">
            @forelse($barang_kosong as $item)
                <div class="flex items-center justify-between px-3 py-2 bg-red-50 rounded-lg">
                    <span class="font-medium text-sm">{{ $item->nama_barang }}</span>
                    <span class="text-sm font-bold text-red-600">0 {{ $item->satuan ?? '' }}</span>
                </div>
            @empty
                <p class="text-sm text-zinc-500">Tidak ada stok kosong</p>
            @endforelse
        </div>
    </x-card>
</div>
@endif

{{-- Grafik Stok --}}
<x-card class="mb-6">
    <div class="flex items-center gap-2 mb-4 pb-4 border-b border-zinc-100">
        <x-icon name="chart-bar" class="w-5 h-5 text-brand-600" />
        <h3 class="text-section-title">Grafik Sisa Stok Bahan Baku Saat Ini</h3>
    </div>
    <div class="relative h-[280px] sm:h-[320px]">
        <canvas id="stokChart"></canvas>
    </div>
</x-card>

{{-- Log Aktivitas Terbaru --}}
<x-card class="mb-6">
    <div class="flex items-center gap-2 mb-4 pb-4 border-b border-zinc-100">
        <x-icon name="clipboard-list" class="w-5 h-5 text-brand-600" />
        <h3 class="text-section-title">Aktivitas Terbaru</h3>
    </div>
    <div class="space-y-2">
        @forelse($log_terbaru as $log)
            <div class="flex items-start gap-3 px-3 py-2.5 bg-zinc-50 rounded-lg">
                <div class="w-8 h-8 bg-brand-100 rounded-full flex items-center justify-center shrink-0">
                    <x-icon name="user" class="w-4 h-4 text-brand-600" />
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-zinc-900">{{ $log->user?->nama_user ?? 'Sistem' }}</p>
                    <p class="text-xs text-zinc-500">{{ $log->description }}</p>
                </div>
                <span class="text-xs text-zinc-400 shrink-0">{{ $log->created_at->diffForHumans() }}</span>
            </div>
        @empty
            <p class="text-sm text-zinc-500 text-center py-4">Belum ada aktivitas</p>
        @endforelse
    </div>
</x-card>

{{-- Cabang Tujuan Aktif (khusus Gudang Utama) --}}
@if($isGudangUtama && $cabang_tujuan_aktif->count() > 0)
<x-card class="mb-6">
    <div class="flex items-center gap-2 mb-4 pb-4 border-b border-zinc-100">
        <x-icon name="shipping" class="w-5 h-5 text-brand-600" />
        <h3 class="text-section-title">Cabang Tujuan Pengiriman</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-zinc-50 text-left">
                    <th class="px-3 py-2.5 font-semibold">Cabang</th>
                    <th class="px-3 py-2.5 font-semibold">Total Kiriman</th>
                    <th class="px-3 py-2.5 font-semibold">Total Barang</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100">
                @foreach($cabang_tujuan_aktif as $ct)
                    <tr class="hover:bg-zinc-50">
                        <td class="px-3 py-2.5 font-medium">{{ $ct->nama_cabang }}</td>
                        <td class="px-3 py-2.5">{{ $ct->total_kiriman }}x</td>
                        <td class="px-3 py-2.5">{{ $ct->total_barang }} item</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-card>
@endif

@endsection

@push('scripts')
<script>
    const labelBarang = {!! json_encode($label_grafik) !!};
    const dataStok = {!! json_encode($data_grafik) !!};

    const ctx = document.getElementById('stokChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelBarang,
            datasets: [{
                label: 'Sisa Stok Aktual',
                data: dataStok,
                backgroundColor: 'rgba(5, 150, 105, 0.7)',
                borderColor: 'rgba(5, 150, 105, 1)',
                borderWidth: 1,
                borderRadius: 6,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } },
            },
            plugins: { legend: { display: false } },
        },
    });
</script>
@endpush
