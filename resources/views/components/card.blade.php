{{-- 
    Card Component
    Usage:
    <x-card>Content here</x-card>
    <x-card title="Header Title" class="mt-4">Content with header</x-card>
--}}

@props(['title' => null, 'padding' => true])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-zinc-200 bg-white text-zinc-950 shadow-sm']) }}>
    @if($title)
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="font-semibold leading-none tracking-tight">{{ $title }}</h3>
        </div>
    @endif
    
    <div class="{{ $padding ? 'p-6 pt-0' : '' }}">
        {{ $slot }}
    </div>
</div>
