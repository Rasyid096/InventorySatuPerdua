{{-- 
    Select Component
    Usage:
    <x-select name="satuan" label="Satuan" required>
        <option value="">-- Pilih --</option>
        @foreach($satuan_list as $s)
            <option value="{{ $s->nama }}">{{ $s->nama }}</option>
        @endforeach
    </x-select>
--}}

@props([
    'name',
    'label' => null,
    'error' => null,
    'required' => false,
    'id' => null
])

@php
    $selectId = $id ?? $name;
@endphp

<div class="mb-4">
    @if($label)
        <label for="{{ $selectId }}" class="block text-sm font-medium leading-none text-zinc-700 mb-2">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif
    
    <select name="{{ $name }}"
            id="{{ $selectId }}"
            {{ $attributes->merge([
                'class' => 'flex h-9 w-full rounded-md border border-zinc-200 bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 disabled:cursor-not-allowed disabled:opacity-50 '
                         . ($error ? 'border-red-400 bg-red-50 focus-visible:ring-red-500' : 'border-zinc-200')
            ]) }}
            @if($required) required @endif>
        {{ $slot }}
    </select>
    
    @if($error)
        <p class="mt-1 text-[0.8rem] font-medium text-red-500">{{ $error }}</p>
    @endif
</div>
