{{-- 
    Button Component
    Usage:
    <x-btn>Primary Button</x-btn>
    <x-btn variant="danger" icon="trash">Delete</x-btn>
    <x-btn variant="warning" size="sm">Edit</x-btn>
    <x-btn variant="secondary" href="/cancel">Cancel</x-btn>
--}}

@props([
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'href' => null,
    'type' => 'button'
])

@php
$baseClasses = 'inline-flex items-center justify-center gap-2 font-bold rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

$variants = [
    'primary' => 'bg-emerald-600 hover:bg-emerald-700 text-white focus:ring-emerald-500',
    'secondary' => 'bg-gray-500 hover:bg-gray-600 text-white focus:ring-gray-400',
    'danger' => 'bg-red-600 hover:bg-red-700 text-white focus:ring-red-500',
    'warning' => 'bg-amber-500 hover:bg-amber-600 text-gray-900 focus:ring-amber-400',
    'success' => 'bg-green-600 hover:bg-green-700 text-white focus:ring-green-500',
    'info' => 'bg-blue-600 hover:bg-blue-700 text-white focus:ring-blue-500',
    'outline' => 'border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white focus:ring-red-500 bg-transparent',
    'outline-primary' => 'border-2 border-emerald-600 text-emerald-600 hover:bg-emerald-600 hover:text-white focus:ring-emerald-500 bg-transparent',
    'ghost' => 'text-gray-600 hover:bg-gray-100 focus:ring-gray-300',
];

$sizes = [
    'xs' => 'px-2 py-1 text-xs',
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-3.5 py-2 text-sm',
    'lg' => 'px-5 py-2.5 text-base',
];

$classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)<i class="fas fa-{{ $icon }}"></i>@endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)<i class="fas fa-{{ $icon }}"></i>@endif
        {{ $slot }}
    </button>
@endif
