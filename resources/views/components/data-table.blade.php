{{-- 
    Data Table Component
    Usage:
    <x-data-table>
        <x-slot:header>
            <th>No</th>
            <th>Nama</th>
            <th>Aksi</th>
        </x-slot:header>
        
        @foreach($items as $index => $item)
            <tr class="hover:bg-gray-50">
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>...</td>
            </tr>
        @endforeach
    </x-data-table>
--}}

@props(['searchable' => true, 'perPage' => [10, 25, 50, 100]])

<div class="overflow-hidden">
    @if($searchable)
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4 text-sm text-zinc-500">
        <div class="flex items-center gap-2">
            <span>Tampilkan</span>
            <select class="flex h-9 w-full rounded-md border border-zinc-200 bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950">
                @foreach($perPage as $num)
                    <option value="{{ $num }}">{{ $num }}</option>
                @endforeach
            </select>
            <span>data</span>
        </div>
        <div class="flex items-center gap-2">
            <input type="text" 
                   placeholder="Cari..." 
                   class="flex h-9 w-full rounded-md border border-zinc-200 bg-transparent px-3 py-1 text-sm shadow-sm transition-colors placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 sm:w-[250px]">
        </div>
    </div>
    @endif
    
    <div class="relative w-full overflow-auto">
        <table class="w-full caption-bottom text-sm">
            <thead class="[&_tr]:border-b">
                <tr class="border-b transition-colors hover:bg-zinc-100/50 data-[state=selected]:bg-zinc-100 text-left align-middle font-medium text-zinc-500 [&>th]:p-4 [&>th]:align-middle">
                    {{ $header }}
                </tr>
            </thead>
            <tbody class="[&_tr:last-child]:border-0 [&_tr]:border-b [&>tr>td]:p-4 [&>tr>td]:align-middle">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
