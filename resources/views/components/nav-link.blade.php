@props(['href', 'icon', 'active' => false])

<a href="{{ $href }}"
   class="nav-link {{ $active ? 'nav-link-active' : 'nav-link-inactive' }}">
    <x-icon :name="$icon" class="w-5 h-5 shrink-0" />
    <span>{{ $slot }}</span>
</a>
