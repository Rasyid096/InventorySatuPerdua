{{-- 
    Input Component
    Usage:
    <x-input name="nama" label="Nama Barang" required />
    <x-input name="email" type="email" label="Email" placeholder="user@example.com" />
    <x-input name="password" type="password" label="Password" :error="$errors->first('password')" />
--}}

@props([
    'name',
    'label' => null,
    'type' => 'text',
    'error' => null,
    'required' => false,
    'value' => null
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-gray-600 mb-2">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif
    
    @if($type === 'password')
        <div class="relative" x-data="{ show: false }">
            <input :type="show ? 'text' : 'password'"
                   name="{{ $name }}"
                   id="{{ $name }}"
                   value="{{ old($name, $value) }}"
                   {{ $attributes->merge([
                       'class' => 'w-full px-3 py-2.5 pr-10 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition ' 
                                . ($error ? 'border-red-400 bg-red-50' : 'border-gray-300')
                   ]) }}
                   @if($required) required @endif>
            <button type="button" 
                    @click="show = !show"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
            </button>
        </div>
    @else
        <input type="{{ $type }}"
               name="{{ $name }}"
               id="{{ $name }}"
               value="{{ old($name, $value) }}"
               {{ $attributes->merge([
                   'class' => 'w-full px-3 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition ' 
                            . ($error ? 'border-red-400 bg-red-50' : 'border-gray-300')
               ]) }}
               @if($required) required @endif>
    @endif
    
    @if($error)
        <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
    @endif
</div>
