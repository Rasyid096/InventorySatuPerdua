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

    <div x-show="open"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50"
         @click="open = false"></div>

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

            @if($title)
                <div class="flex items-center justify-between px-5 py-3.5 border-b border-zinc-100">
                    <h3 class="text-section-title">{{ $title }}</h3>
                    <button type="button" @click="open = false"
                            class="text-zinc-400 hover:text-zinc-600 transition-colors p-1 rounded-lg hover:bg-zinc-100">
                        <x-icon name="times" class="w-5 h-5" />
                    </button>
                </div>
            @endif

            <div class="px-5 py-3.5 max-h-[70vh] overflow-y-auto text-sm">
                {{ $slot }}
            </div>

            @if(isset($footer))
                <div class="flex flex-wrap justify-end gap-3 px-5 py-3.5 border-t border-zinc-100 bg-zinc-50 rounded-b-xl">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
