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
     x-transition:enter-start="opacity-0 -translate-y-2"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     {{ $attributes->merge(['class' => 'flex items-center gap-3 px-4 py-3 rounded-lg border text-sm ' . ($styles[$type] ?? $styles['info'])]) }}>
    <x-icon :name="$icons[$type] ?? $icons['info']" class="w-5 h-5 shrink-0" />
    <span class="flex-1">{{ $slot }}</span>
    @if($dismissible)
        <button type="button" @click="show = false" class="opacity-70 hover:opacity-100 transition-opacity p-1">
            <x-icon name="times" class="w-4 h-4" />
        </button>
    @endif
</div>
