<div x-data="{ open: false }" class="group">
    <div class="p-2 mx-1 transition-all duration-300 hover:bg-gradient-to-r hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:text-white text-[13px] font-normal
        {{ request()->routeIs($active) ? 'bg-gradient-to-r from-amber-600 to-amber-500 text-white shadow-lg' : 'text-gray-300 hover:text-white' }}">
        <a href="#" @click.prevent="open = !open" class="flex items-center justify-between cursor-pointer">
            <div class="flex items-center">
                <div class="flex items-center justify-center w-7 h-7 mr-2 rounded-lg bg-white/10 group-hover:bg-white/20
                    {{ request()->routeIs($active) ? 'bg-white/20' : '' }}">
                    <i class="text-xs {{ $icon }}"></i>
                </div>
                <span class="font-medium text-[13px]">{{ $title }}</span>
            </div>
            <i :class="open ? 'fa-chevron-up' : 'fa-chevron-down'" class="text-xs transition-transform duration-300 fas"></i>
        </a>
    </div>
    <!-- Alt menüler -->
    <div x-show="open" x-transition class="pl-7 pr-2 mt-1 space-y-1">
        {{ $slot }}
    </div>
</div>
