{{-- 
    Stat Card Component (Dashboard)
    Usage:
    <x-stat-card 
        icon="box" 
        label="Total Barang" 
        :value="$total_barang" 
        color="blue" 
    />
--}}

@props(['icon', 'label', 'value', 'color' => 'blue'])

@php
$colors = [
    'blue' => ['border' => 'border-l-blue-600', 'bg' => 'bg-blue-600'],
    'green' => ['border' => 'border-l-green-600', 'bg' => 'bg-green-600'],
    'orange' => ['border' => 'border-l-orange-500', 'bg' => 'bg-orange-500'],
    'red' => ['border' => 'border-l-red-600', 'bg' => 'bg-red-600'],
    'emerald' => ['border' => 'border-l-emerald-600', 'bg' => 'bg-emerald-600'],
    'amber' => ['border' => 'border-l-amber-500', 'bg' => 'bg-amber-500'],
    'purple' => ['border' => 'border-l-purple-600', 'bg' => 'bg-purple-600'],
];
$c = $colors[$color] ?? $colors['blue'];
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-sm border-l-4 ' . $c['border'] . ' p-4 lg:p-5 flex items-center gap-5 hover:-translate-y-1 transition-transform duration-200']) }}>
    <div class="w-10 h-10 {{ $c['bg'] }} rounded-xl flex items-center justify-center text-white text-xl flex-shrink-0">
        <i class="fas fa-{{ $icon }}"></i>
    </div>
    <div class="min-w-0">
        <p class="text-sm text-gray-500 font-medium truncate">{{ $label }}</p>
        <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $value }}</p>
    </div>
</div>
