@props(['icon', 'label', 'value', 'color' => 'blue'])

@php
$colors = [
    'blue' => ['border' => 'border-l-blue-600', 'bg' => 'bg-blue-600'],
    'green' => ['border' => 'border-l-green-600', 'bg' => 'bg-green-600'],
    'orange' => ['border' => 'border-l-orange-500', 'bg' => 'bg-orange-500'],
    'red' => ['border' => 'border-l-red-600', 'bg' => 'bg-red-600'],
    'emerald' => ['border' => 'border-l-brand-600', 'bg' => 'bg-brand-600'],
    'amber' => ['border' => 'border-l-amber-500', 'bg' => 'bg-amber-500'],
    'purple' => ['border' => 'border-l-purple-600', 'bg' => 'bg-purple-600'],
];
$c = $colors[$color] ?? $colors['blue'];
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-zinc-100 border-l-4 ' . $c['border'] . ' p-4 lg:p-5 flex items-center gap-4 hover:-translate-y-0.5 transition-transform duration-200']) }}>
    <div class="w-10 h-10 {{ $c['bg'] }} rounded-xl flex items-center justify-center text-white shrink-0">
        <x-icon :name="$icon" class="w-5 h-5" />
    </div>
    <div class="min-w-0">
        <p class="text-caption font-medium truncate">{{ $label }}</p>
        <p class="text-xl font-bold text-zinc-900 tabular-nums">{{ $value }}</p>
    </div>
</div>
