<a  href="{{ $href }}"
    class="flex items-center px-2 py-1 text-[12px] transition-all duration-200 group hover:bg-white/5 hover:pl-3
        {{ request()->routeIs($active) ? 'text-white bg-white/10 border-l-2 border-amber-400 pl-3' : 'text-gray-900 hover:text-white' }}">
    <div class="flex items-center justify-center w-3 h-3 mr-2">
        <div class="w-1 h-1 rounded-full transition-colors duration-200 
            {{ request()->routeIs($active) ? 'bg-blue-400' : 'bg-gray-500 group-hover:bg-white' }}"></div>
    </div>
    <span class="font-medium">{{ $title }}</span>
</a>
