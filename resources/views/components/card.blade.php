{{-- 
    Card Component
    Usage:
    <x-card>Content here</x-card>
    <x-card title="Header Title" class="mt-4">Content with header</x-card>
--}}

@props(['title' => null, 'padding' => true])

<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-sm']) }}>
    @if($title)
        <div class="px-5 py-3.5 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">{{ $title }}</h3>
        </div>
    @endif
    
    <div class="{{ $padding ? 'p-4 lg:p-5' : '' }}">
        {{ $slot }}
    </div>
</div>
