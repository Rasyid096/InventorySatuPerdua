@props(['title', 'subtitle' => null, 'breadcrumbs' => []])

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-page-title">{{ $title }}</h2>
        @if($subtitle)
            <p class="text-caption mt-1">{{ $subtitle }}</p>
        @elseif(count($breadcrumbs) > 0)
            <nav class="text-caption mt-1 flex items-center flex-wrap gap-1">
                <x-icon name="home" class="w-3.5 h-3.5" />
                @foreach($breadcrumbs as $crumb)
                    <span>{{ $crumb }}</span>
                    @if(!$loop->last)
                        <x-icon name="chevron-right" class="w-3 h-3 text-zinc-300" />
                    @endif
                @endforeach
            </nav>
        @endif
    </div>

    @if($slot->isNotEmpty())
        <div class="flex flex-wrap items-center gap-2">
            {{ $slot }}
        </div>
    @endif
</div>
