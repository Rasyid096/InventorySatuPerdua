@props([
    'name',
    'label' => null,
    'type' => 'text',
    'error' => null,
    'required' => false,
    'value' => null,
    'id' => null,
])

@php
    $inputId = $id ?? $name;
    $inputClass = 'flex h-9 w-full rounded-lg border bg-transparent px-3 py-1 text-sm shadow-sm transition-colors placeholder:text-zinc-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600/20 disabled:cursor-not-allowed disabled:opacity-50 '
        . ($error ? 'border-red-400 bg-red-50 focus-visible:ring-red-500/20' : 'border-zinc-200');
@endphp

<div class="mb-4">
    @if($label)
        <label for="{{ $inputId }}" class="text-label block mb-2">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    @if($type === 'password')
        <div class="relative" x-data="{ show: false }">
            <input :type="show ? 'text' : 'password'"
                   name="{{ $name }}"
                   id="{{ $inputId }}"
                   value="{{ old($name, $value) }}"
                   {{ $attributes->merge(['class' => $inputClass . ' pr-10']) }}
                   @if($required) required @endif>
            <button type="button"
                    @click="show = !show"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-zinc-500 hover:text-zinc-700">
                <span x-show="!show"><x-icon name="eye" class="w-4 h-4" /></span>
                <span x-show="show" x-cloak><x-icon name="eye-slash" class="w-4 h-4" /></span>
            </button>
        </div>
    @else
        <input type="{{ $type }}"
               name="{{ $name }}"
               id="{{ $inputId }}"
               value="{{ old($name, $value) }}"
               {{ $attributes->merge(['class' => $inputClass]) }}
               @if($required) required @endif>
    @endif

    @if($error)
        <p class="mt-1 text-xs font-medium text-red-500">{{ $error }}</p>
    @endif
</div>
