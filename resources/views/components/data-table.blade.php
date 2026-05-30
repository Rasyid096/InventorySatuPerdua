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
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4 text-sm text-gray-600">
        <div class="flex items-center gap-2">
            <span>Tampilkan</span>
            <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                @foreach($perPage as $num)
                    <option value="{{ $num }}">{{ $num }}</option>
                @endforeach
            </select>
            <span>data</span>
        </div>
        <div class="flex items-center gap-2">
            <span>Cari:</span>
            <input type="text" 
                   placeholder="Cari..." 
                   class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm w-full sm:w-auto">
        </div>
    </div>
    @endif
    
    <div class="overflow-x-auto -mx-6 px-6">
        <table class="w-full text-sm min-w-[600px]">
            <thead>
                <tr class="bg-gray-50 text-left text-gray-600 font-semibold">
                    {{ $header }}
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
