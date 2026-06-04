@props([
    'name',
    'label' => null,
    'error' => null,
    'required' => false,
    'id' => null,
])

@php
    $selectId = $id ?? $name;
    $selectClass = 'flex h-9 w-full rounded-lg border bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600/20 disabled:cursor-not-allowed disabled:opacity-50 '
        . ($error ? 'border-red-400 bg-red-50' : 'border-zinc-200');
@endphp

<div class="mb-4">
    @if($label)
        <label for="{{ $selectId }}" class="text-label block mb-2">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <select name="{{ $name }}"
            id="{{ $selectId }}"
            {{ $attributes->merge(['class' => $selectClass]) }}
            @if($required) required @endif>
        {{ $slot }}
    </select>

    @if($error)
        <p class="mt-1 text-xs font-medium text-red-500">{{ $error }}</p>
    @endif
</div>
