@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<x-page-header title="Dashboard" />

{{-- Stat Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-3 lg:gap-5 mb-6">
    <x-stat-card 
        icon="box" 
        label="Total Macam Barang" 
        :value="$total_barang" 
        color="blue" 
    />
    
    <x-stat-card 
        icon="arrow-down" 
        label="Total Barang Masuk" 
        :value="$total_masuk" 
        color="green" 
    />
    
    <x-stat-card 
        icon="arrow-up" 
        label="Total Barang Keluar" 
        :value="$total_keluar" 
        color="orange" 
    />
</div>

{{-- Chart --}}
<x-card>
    <div class="flex items-center gap-2 mb-6 pb-4 border-b border-gray-100">
        <i class="fas fa-chart-bar text-emerald-600"></i>
        <h3 class="text-base font-bold text-gray-600">Grafik Sisa Stok Bahan Baku Saat Ini</h3>
    </div>
    <div class="relative h-[300px]">
        <canvas id="stokChart"></canvas>
    </div>
</x-card>
@endsection

@push('scripts')
<script>
    const labelBarang = {!! json_encode($label_grafik) !!};
    const dataStok = {!! json_encode($data_grafik) !!};

    const ctx = document.getElementById('stokChart').getContext('2d');
    const stokChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelBarang,
            datasets: [{
                label: 'Sisa Stok Aktual',
                data: dataStok,
                backgroundColor: 'rgba(15, 169, 88, 0.7)',
                borderColor: 'rgba(15, 169, 88, 1)',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endpush
