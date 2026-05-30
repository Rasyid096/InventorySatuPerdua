{{-- 
    Alert Component
    Usage:
    <x-alert type="success">Data berhasil disimpan!</x-alert>
    <x-alert type="error" dismissible>Terjadi kesalahan.</x-alert>
--}}

@props(['type' => 'info', 'dismissible' => false])

@php
$styles = [
    'success' => 'bg-green-50 border-green-200 text-green-800',
    'error' => 'bg-red-50 border-red-200 text-red-800',
    'warning' => 'bg-amber-50 border-amber-200 text-amber-800',
    'info' => 'bg-blue-50 border-blue-200 text-blue-800',
];

$icons = [
    'success' => 'check-circle',
    'error' => 'times-circle',
    'warning' => 'exclamation-triangle',
    'info' => 'info-circle',
];
@endphp

<div x-data="{ show: true }" 
     x-show="show" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform -translate-y-2"
     x-transition:enter-end="opacity-100 transform translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     {{ $attributes->merge(['class' => 'flex items-center gap-3 px-4 py-3 rounded-lg border ' . ($styles[$type] ?? $styles['info'])]) }}>
    <i class="fas fa-{{ $icons[$type] ?? $icons['info'] }} text-lg flex-shrink-0"></i>
    <span class="flex-1 text-sm">{{ $slot }}</span>
    @if($dismissible)
        <button @click="show = false" 
                class="text-current opacity-70 hover:opacity-100 transition-opacity p-1">
            <i class="fas fa-times"></i>
        </button>
    @endif
</div>
