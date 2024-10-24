<div class="py-2 pl-2 transition-colors duration-200 rounded-md hover:bg-blue-800 hover:text-white
    {{ request()->routeIs($active) ? 'bg-blue-800 text-white' : 'text-gray-400' }}">
    <a href="#" class="flex items-center text-lg font-semibold">
        <i class="mr-3 text-sm {{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
    <!-- Alt menüler -->
    <div class="pl-6 mt-2 space-y-1">
        {{ $slot }}
    </div>
</div>
