{{-- 
    Badge Component
    Usage:
    <x-badge variant="admin">Admin</x-badge>
    <x-badge variant="success">Stok Aman</x-badge>
    <x-badge variant="warning">Stok Menipis</x-badge>
--}}

@props(['variant' => 'default'])

@php
$variants = [
    'default' => 'bg-gray-100 text-gray-700',
    'admin' => 'bg-blue-600 text-white',
    'cabang' => 'bg-orange-500 text-white',
    'karyawan' => 'bg-green-600 text-white',
    'success' => 'bg-green-100 text-green-800',
    'warning' => 'bg-amber-100 text-amber-800',
    'danger' => 'bg-red-100 text-red-800',
    'info' => 'bg-blue-100 text-blue-800',
    'primary' => 'bg-emerald-100 text-emerald-800',
];
@endphp

<span {{ $attributes->merge(['class' => 'inline-block px-3 py-1 rounded-full text-xs font-bold ' . ($variants[$variant] ?? $variants['default'])]) }}>
    {{ $slot }}
</span>
