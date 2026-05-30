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
    'value' => null,
    'id' => null
])

@php
    $inputId = $id ?? $name;
@endphp

<div class="mb-4">
    @if($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium leading-none text-zinc-700 mb-2">
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
                   {{ $attributes->merge([
                       'class' => 'flex h-9 w-full rounded-md border border-zinc-200 bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 disabled:cursor-not-allowed disabled:opacity-50 pr-10 ' 
                                . ($error ? 'border-red-400 bg-red-50 focus-visible:ring-red-500' : 'border-zinc-200')
                   ]) }}
                   @if($required) required @endif>
            <button type="button" 
                    @click="show = !show"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-zinc-500 hover:text-zinc-700">
                <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
            </button>
        </div>
    @else
        <input type="{{ $type }}"
               name="{{ $name }}"
               id="{{ $inputId }}"
               value="{{ old($name, $value) }}"
               {{ $attributes->merge([
                   'class' => 'flex h-9 w-full rounded-md border border-zinc-200 bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 disabled:cursor-not-allowed disabled:opacity-50 ' 
                            . ($error ? 'border-red-400 bg-red-50 focus-visible:ring-red-500' : 'border-zinc-200')
               ]) }}
               @if($required) required @endif>
    @endif
    
    @if($error)
        <p class="mt-1 text-[0.8rem] font-medium text-red-500">{{ $error }}</p>
    @endif
</div>
