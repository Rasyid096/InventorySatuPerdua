@props(['variant' => 'default'])

@php
$variants = [
    'default' => 'bg-zinc-100 text-zinc-700',
    'admin' => 'bg-blue-600 text-white',
    'super-admin' => 'bg-red-600 text-white',
    'karyawan' => 'bg-green-600 text-white',
    'success' => 'bg-green-100 text-green-800',
    'warning' => 'bg-amber-100 text-amber-800',
    'danger' => 'bg-red-100 text-red-800',
    'info' => 'bg-blue-100 text-blue-800',
    'primary' => 'bg-brand-100 text-brand-800',
];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold ' . ($variants[$variant] ?? $variants['default'])]) }}>
    {{ $slot }}
</span>
