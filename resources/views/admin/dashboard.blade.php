@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<x-page-header title="Dashboard" />

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <x-stat-card icon="box" label="Total Macam Barang" :value="$total_barang" color="blue" />
    <x-stat-card icon="arrow-down" label="Total Barang Masuk" :value="$total_masuk" color="green" />
    <x-stat-card icon="arrow-up" label="Total Barang Keluar" :value="$total_keluar" color="orange" />
</div>

<x-card>
    <div class="flex items-center gap-2 mb-4 pb-4 border-b border-zinc-100">
        <x-icon name="chart-bar" class="w-5 h-5 text-brand-600" />
        <h3 class="text-section-title">Grafik Sisa Stok Bahan Baku Saat Ini</h3>
    </div>
    <div class="relative h-[280px] sm:h-[320px]">
        <canvas id="stokChart"></canvas>
    </div>
</x-card>
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
