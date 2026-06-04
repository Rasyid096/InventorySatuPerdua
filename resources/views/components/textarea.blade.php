@props([
    'name',
    'label' => null,
    'error' => null,
    'required' => false,
    'value' => null,
    'id' => null,
    'rows' => 3,
])

@php
    $textareaId = $id ?? $name;
    $textareaClass = 'flex w-full rounded-lg border bg-transparent px-3 py-2 text-sm shadow-sm transition-colors placeholder:text-zinc-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600/20 disabled:cursor-not-allowed disabled:opacity-50 resize-y min-h-[80px] '
        . ($error ? 'border-red-400 bg-red-50' : 'border-zinc-200');
@endphp

<div class="mb-4">
    @if($label)
        <label for="{{ $textareaId }}" class="text-label block mb-2">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <textarea name="{{ $name }}"
              id="{{ $textareaId }}"
              rows="{{ $rows }}"
              {{ $attributes->merge(['class' => $textareaClass]) }}
              @if($required) required @endif>{{ old($name, $value) }}</textarea>

    @if($error)
        <p class="mt-1 text-xs font-medium text-red-500">{{ $error }}</p>
    @endif
</div>
