{{-- Button Component — Lucide icons via icon prop --}}

@props([
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'href' => null,
    'type' => 'button',
])

@php
$baseClasses = 'inline-flex items-center justify-center gap-2 font-medium rounded-lg transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600/30 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';

$variants = [
    'primary' => 'bg-brand-800 text-white hover:bg-brand-900 shadow-sm',
    'secondary' => 'bg-zinc-100 text-zinc-900 hover:bg-zinc-200',
    'danger' => 'bg-red-500 text-white hover:bg-red-600 shadow-sm',
    'warning' => 'bg-amber-500 text-white hover:bg-amber-600 shadow-sm',
    'success' => 'bg-brand-600 text-white hover:bg-brand-700 shadow-sm',
    'info' => 'bg-blue-600 text-white hover:bg-blue-700 shadow-sm',
    'outline' => 'border border-zinc-200 bg-white shadow-sm hover:bg-zinc-50 text-zinc-900',
    'outline-primary' => 'border border-brand-700 bg-white shadow-sm hover:bg-brand-50 text-brand-800',
    'ghost' => 'hover:bg-zinc-100 hover:text-zinc-900',
];

$sizes = [
    'xs' => 'h-7 px-2 text-xs',
    'sm' => 'h-8 px-3 text-xs',
    'md' => 'h-9 px-4 text-sm',
    'lg' => 'h-10 px-6 text-sm',
];

$iconSizes = [
    'xs' => 'w-3.5 h-3.5',
    'sm' => 'w-3.5 h-3.5',
    'md' => 'w-4 h-4',
    'lg' => 'w-4 h-4',
];

$classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
$iconClass = $iconSizes[$size] ?? $iconSizes['md'];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)<x-icon :name="$icon" :class="$iconClass" />@endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)<x-icon :name="$icon" :class="$iconClass" />@endif
        {{ $slot }}
    </button>
@endif
