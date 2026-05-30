{{-- 
    Page Header Component
    Usage:
    <x-page-header title="Data Barang" :breadcrumbs="['Dashboard', 'Master Data', 'Data Barang']">
        <x-btn icon="plus">Entri Data</x-btn>
    </x-page-header>
--}}

@props(['title', 'subtitle' => null, 'breadcrumbs' => []])

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl md:text-2xl font-bold text-gray-800">{{ $title }}</h2>
        @if($subtitle)
            <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
        @elseif(count($breadcrumbs) > 0)
            <nav class="text-sm text-gray-500 mt-1 flex items-center flex-wrap gap-1">
                <i class="fas fa-home text-xs"></i>
                @foreach($breadcrumbs as $index => $crumb)
                    <span>{{ $crumb }}</span>
                    @if(!$loop->last)
                        <span class="mx-1 text-gray-400">&gt;</span>
                    @endif
                @endforeach
            </nav>
        @endif
    </div>
    
    @if($slot->isNotEmpty())
        <div class="flex flex-wrap items-center gap-3">
            {{ $slot }}
        </div>
    @endif
</div>
