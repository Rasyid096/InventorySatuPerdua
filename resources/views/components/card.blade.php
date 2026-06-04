@props(['title' => null, 'padding' => true])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-zinc-200 bg-white text-zinc-900 shadow-sm']) }}>
    @if($title)
        <div class="px-5 py-4 border-b border-zinc-100">
            <h3 class="text-section-title">{{ $title }}</h3>
        </div>
    @endif

    <div class="{{ $padding ? 'p-5' : '' }}">
        {{ $slot }}
    </div>
</div>
