@props(['icon' => 'inbox', 'message' => 'Tidak ada data'])

<div {{ $attributes->merge(['class' => 'table-empty']) }}>
    <x-icon :name="$icon" class="w-10 h-10 text-zinc-300 mx-auto mb-2 block" />
    <p>{{ $message }}</p>
    @if($slot->isNotEmpty())
        <div class="mt-2">{{ $slot }}</div>
    @endif
</div>
