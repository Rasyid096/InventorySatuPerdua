@props(['label', 'for' => null, 'required' => false])

<div {{ $attributes->merge(['class' => 'flex-1 min-w-[200px]']) }}>
    <label @if($for) for="{{ $for }}" @endif class="text-label block mb-2">
        {{ $label }}
        @if($required)<span class="text-red-500">*</span>@endif
    </label>
    {{ $slot }}
</div>
