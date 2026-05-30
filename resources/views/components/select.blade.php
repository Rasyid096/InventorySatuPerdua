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
    'required' => false
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-gray-600 mb-2">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif
    
    <select name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes->merge([
                'class' => 'w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition appearance-none bg-white '
                         . ($error ? 'border-red-400 bg-red-50' : 'border-gray-300')
            ]) }}
            @if($required) required @endif>
        {{ $slot }}
    </select>
    
    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>
