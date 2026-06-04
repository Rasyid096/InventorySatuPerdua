{{--
    Lucide Icon Component (file-based, no Blade Icons registry required)
    Usage: <x-icon name="home" class="w-5 h-5" />
--}}

@props(['name', 'class' => 'w-4 h-4'])

@php
    use App\Support\IconRenderer;
    $svg = IconRenderer::render($name, $class);
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex shrink-0 items-center justify-center']) }} aria-hidden="true">
    {!! $svg !!}
</span>
