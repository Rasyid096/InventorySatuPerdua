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
$baseClasses = 'inline-flex items-center justify-center gap-2 font-medium rounded-md transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 disabled:pointer-events-none disabled:opacity-50';

$variants = [
    'primary' => 'bg-zinc-900 text-zinc-50 hover:bg-zinc-900/90 shadow-sm',
    'secondary' => 'bg-zinc-100 text-zinc-900 hover:bg-zinc-100/80',
    'danger' => 'bg-red-500 text-zinc-50 hover:bg-red-500/90 shadow-sm',
    'warning' => 'bg-amber-500 text-zinc-50 hover:bg-amber-500/90 shadow-sm',
    'success' => 'bg-emerald-600 text-white hover:bg-emerald-600/90 shadow-sm',
    'info' => 'bg-blue-600 text-white hover:bg-blue-600/90 shadow-sm',
    'outline' => 'border border-zinc-200 bg-white shadow-sm hover:bg-zinc-100 hover:text-zinc-900',
    'outline-primary' => 'border border-zinc-900 bg-white shadow-sm hover:bg-zinc-100 hover:text-zinc-900',
    'ghost' => 'hover:bg-zinc-100 hover:text-zinc-900',
];

$sizes = [
    'xs' => 'h-7 px-2 text-xs',
    'sm' => 'h-8 px-3 text-xs',
    'md' => 'h-9 px-4 py-2 text-sm',
    'lg' => 'h-10 px-8 text-sm',
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
