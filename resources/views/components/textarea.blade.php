{{-- 
    Textarea Component
    Usage:
    <x-textarea name="keterangan" label="Keterangan" rows="4" />
--}}

@props([
    'name',
    'label' => null,
    'error' => null,
    'required' => false,
    'rows' => 3,
    'value' => null
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-gray-600 mb-2">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif
    
    <textarea name="{{ $name }}"
              id="{{ $name }}"
              rows="{{ $rows }}"
              {{ $attributes->merge([
                  'class' => 'w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition resize-y '
                           . ($error ? 'border-red-400 bg-red-50' : 'border-gray-300')
              ]) }}
              @if($required) required @endif>{{ old($name, $value) }}</textarea>
    
    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>
