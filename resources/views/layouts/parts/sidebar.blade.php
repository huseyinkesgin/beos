<div class="fixed w-48 h-full px-4 py-5 text-gray-300 bg-blue-950"
    x-data="{ openLocation: false, openPortfolio: false, openPeople: false }">
    <div class="mb-3">
        <span class="text-xl font-extrabold text-orange-500">BEOS</span>
    </div>
    <hr class="mb-3 border-gray-700">

    <p class="mb-2 text-sm font-semibold tracking-wide text-gray-400">MENÜ</p>



    <!-- Portfolio Menüsü -->
    <div class="py-1 pl-1">
        <a href="#" @click.prevent="openPortfolio = !openPortfolio; openLocation = false; openPeople = false"
            class="flex items-center text-lg font-semibold transition-colors duration-200 rounded-md hover:text-white pb-1
                {{ request()->routeIs('categories', 'types', 'portfolios') ? 'text-white' : 'text-gray-400' }}">
            <i class="mr-2 text-sm fas fa-folder"></i>
            <span>Portföyler</span>
            <span :class="{'rotate-180': openPortfolio}" class="ml-auto transition-transform duration-200">&#9662;</span>
        </a>
        <div x-show="openPortfolio" class="pl-4 space-y-0" x-transition>
            <a wire:navigate href="{{ route('categories') }}"
                class="flex items-center text-md transition-colors duration-200 hover:text-white
                    {{ request()->routeIs('categories') ? 'text-white' : 'text-gray-400' }}">
                <i class="mr-2 text-xs fas fa-minus"></i>
                Kategoriler
            </a>
            <a wire:navigate href="{{ route('types') }}"
                class="flex items-center text-md transition-colors duration-200 hover:text-white
                    {{ request()->routeIs('types') ? 'text-white' : 'text-gray-400' }}">
                <i class="mr-2 text-xs fas fa-minus"></i>
                Emlak Tipleri
            </a>
            <a wire:navigate href="{{ route('portfolios') }}"
                class="flex items-center text-md transition-colors duration-200 hover:text-white
                    {{ request()->routeIs('portfolios') ? 'text-white' : 'text-gray-400' }}">
                <i class="mr-2 text-xs fas fa-minus"></i>
                Portföyler
            </a>
        </div>
    </div>

    <!-- People Menüsü -->
    <div class="py-1 pl-1">
        <a href="#" @click.prevent="openPeople = !openPeople; openLocation = false; openPortfolio = false"
            class="flex items-center text-lg font-semibold transition-colors duration-200 rounded-md hover:text-white pb-1
                {{ request()->routeIs('customers', 'personnels') ? 'text-white' : 'text-gray-400' }}">
            <i class="mr-2 text-sm fas fa-users"></i>
            <span>Kişiler</span>
            <span :class="{'rotate-180': openPeople}" class="ml-auto transition-transform duration-200">&#9662;</span>
        </a>
        <div x-show="openPeople" class="pl-4 space-y-0" x-transition>
            <a wire:navigate href="{{ route('customers') }}"
                class="flex items-center text-md transition-colors duration-200 hover:text-white
                    {{ request()->routeIs('customers') ? 'text-white' : 'text-gray-400' }}">
                <i class="mr-2 text-xs fas fa-minus"></i>
                Müşteriler
            </a>
            <a wire:navigate href="{{ route('personnels') }}"
                class="flex items-center text-md transition-colors duration-200 hover:text-white
                    {{ request()->routeIs('personnels') ? 'text-white' : 'text-gray-400' }}">
                <i class="mr-2 text-xs fas fa-minus"></i>
                Personeller
            </a>
        </div>
    </div>

     <!-- Location Menüsü -->
     <div class="pl-1">
        <a href="#" @click.prevent="openLocation = !openLocation; openPortfolio = false; openPeople = false"
            class="flex items-center text-lg font-semibold transition-colors duration-200 rounded-md hover:text-white pb-1
                {{ request()->routeIs('states', 'cities', 'districts') ? 'text-white' : 'text-gray-400' }}">
            <i class="mr-2 text-sm fas fa-map-marker-alt"></i> <!-- Menü başlığı simgesi -->
            <span>Lokasyon</span>
            <span :class="{'rotate-180': openLocation}" class="ml-auto transition-transform duration-200">&#9662;</span>
        </a>
        <div x-show="openLocation" class="pl-4 space-y-0" x-transition>
            <a wire:navigate href="{{ route('states') }}"
                class="flex items-center text-md transition-colors duration-200 hover:text-white
                    {{ request()->routeIs('states') ? 'text-white' : 'text-gray-400' }}">
                <i class="mr-2 text-xs fas fa-minus"></i> <!-- Alt menü simgesi -->
                İl Listesi
            </a>
            <a wire:navigate href="{{ route('cities') }}"
                class="flex items-center text-md transition-colors duration-200 hover:text-white
                    {{ request()->routeIs('cities') ? 'text-white' : 'text-gray-400' }}">
                <i class="mr-2 text-xs fas fa-minus"></i>
                İlçe Listesi
            </a>
            <a wire:navigate href="{{ route('districts') }}"
                class="flex items-center text-md transition-colors duration-200 hover:text-white
                    {{ request()->routeIs('districts') ? 'text-white' : 'text-gray-400' }}">
                <i class="mr-2 text-xs fas fa-minus"></i>
                Bölge Listesi
            </a>
        </div>
    </div>
</div>
