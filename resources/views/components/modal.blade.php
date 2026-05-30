{{-- 
    Modal Component
    Usage:
    <x-modal name="edit-user" title="Edit User">
        <form>...</form>
        
        <x-slot:footer>
            <x-btn variant="secondary" @click="$dispatch('close-modal', 'edit-user')">Batal</x-btn>
            <x-btn type="submit">Simpan</x-btn>
        </x-slot:footer>
    </x-modal>

    Trigger:
    <x-btn @click="$dispatch('open-modal', 'edit-user')">Open Modal</x-btn>
--}}

@props(['name', 'title' => '', 'maxWidth' => 'md'])

@php
$maxWidthClass = [
    'sm' => 'max-w-sm',
    'md' => 'max-w-xl',
    'lg' => 'max-w-2xl',
    'xl' => 'max-w-4xl',
    'full' => 'max-w-full mx-4',
][$maxWidth] ?? 'max-w-lg';
@endphp

<div x-data="{ open: false }"
     x-on:open-modal.window="if ($event.detail === '{{ $name }}') open = true"
     x-on:close-modal.window="if ($event.detail === '{{ $name }}') open = false"
     x-on:keydown.escape.window="open = false"
     x-show="open"
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-modal="true"
     role="dialog">
    
    {{-- Backdrop --}}
    <div x-show="open" 
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50" 
         @click="open = false"></div>
    
    {{-- Modal Content --}}
    <div class="flex min-h-full items-center justify-center p-4">
        <div x-show="open"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             @click.stop
             class="relative w-full {{ $maxWidthClass }} bg-white rounded-xl shadow-xl">
            
            {{-- Header --}}
            @if($title)
                <div class="flex items-center justify-between px-5 py-3.5 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
                    <button @click="open = false" 
                            class="text-gray-400 hover:text-gray-600 text-xl transition-colors p-1">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            {{-- Body --}}
            <div class="px-5 py-3.5 max-h-[70vh] overflow-y-auto">
                {{ $slot }}
            </div>
            
            {{-- Footer --}}
            @if(isset($footer))
                <div class="flex justify-end gap-3 px-5 py-3.5 border-t border-gray-100 bg-gray-50 rounded-b-xl">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
