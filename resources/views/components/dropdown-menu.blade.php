<!-- resources/views/components/dropdown-menu.blade.php -->
<div class="py-1 pl-1">
    <a href="#" class="flex items-center text-lg font-semibold transition-colors duration-200 rounded-md hover:text-white pb-1
        {{ request()->routeIs($active) ? 'text-white' : 'text-gray-400' }}">
        <i class="mr-2 text-sm {{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
    <!-- Alt menüler her zaman açık olacak -->
    <div class="block pl-4 space-y-0">
        {{ $slot }}
    </div>
</div>
