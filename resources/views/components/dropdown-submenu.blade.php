<a wire:navigate href="{{ $href }}"
    class="flex items-center text-md transition-colors duration-200 hover:text-white
        {{ request()->routeIs($active) ? 'text-white' : 'text-gray-400' }}">
    <i class="mr-2 text-xs fas fa-minus"></i>
    {{ $title }}
</a>
