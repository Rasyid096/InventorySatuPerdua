@props(['searchable' => true, 'perPage' => [10, 25, 50, 100]])

<div class="overflow-hidden">
    @if($searchable)
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4 text-caption">
        <div class="flex items-center gap-2">
            <span>Tampilkan</span>
            <select class="h-9 rounded-lg border border-zinc-200 bg-white px-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600/20">
                @foreach($perPage as $num)
                    <option value="{{ $num }}">{{ $num }}</option>
                @endforeach
            </select>
            <span>data</span>
        </div>
        <div class="relative w-full sm:w-auto">
            <x-icon name="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 pointer-events-none" />
            <input type="text"
                   placeholder="Cari..."
                   class="h-9 w-full sm:w-56 rounded-lg border border-zinc-200 bg-transparent pl-9 pr-3 text-sm placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-brand-600/20">
        </div>
    </div>
    @endif

    <div class="relative w-full overflow-x-auto -mx-1 px-1">
        <table class="w-full min-w-[640px] caption-bottom text-sm">
            <thead>
                <tr class="border-b border-zinc-200 text-left text-caption font-semibold uppercase tracking-wide [&>th]:px-3 [&>th]:py-2.5">
                    {{ $header }}
                </tr>
            </thead>
            <tbody class="[&_tr]:border-b [&_tr:last-child]:border-0 [&>tr>td]:px-3 [&>tr>td]:py-2.5 text-sm">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
