<div class="w-64 h-full px-4 py-5 text-gray-300 transition-all duration-300 bg-blue-950 md:w-48 lg:w-56">
    <div class="mb-3">
        <span class="text-xl font-extrabold text-orange-500">BEOS</span>
    </div>
    <hr class="mb-3 border-gray-700">

    <p class="mb-2 text-sm font-semibold tracking-wide text-gray-400">MENÜ</p>

    <!-- Portfolio Menüsü -->
    <x-dropdown-menu title="Portföyler" active="categories" icon="fas fa-folder">
        <x-dropdown-submenu href="{{ route('categories') }}" title="Kategoriler" active="categories" />
        <x-dropdown-submenu href="{{ route('types') }}" title="Emlak Tipleri" active="types" />
        <x-dropdown-submenu href="{{ route('portfolios') }}" title="Portföyler" active="portfolios" />
    </x-dropdown-menu>

    <!-- Gider Menüsü -->
    <x-dropdown-menu title="Giderler" active="bills" icon="fas fa-users">
        <x-dropdown-submenu href="{{ route('bills') }}" title="Faturalar" active="bills" />
        <x-dropdown-submenu href="{{ route('personel.expense') }}" title="Ofis Harcamaları" active="personel.expense" />
        <x-dropdown-submenu href="{{ route('personel.balance') }}" title="Nakit Girişleri" active="personel.balance" />
        <x-dropdown-submenu href="{{ route('vehicles') }}" title="Araçlar" active="vehicles" />
    </x-dropdown-menu>

    <!-- Kişiler Menüsü -->
    <x-dropdown-menu title="Kişiler" active="customers" icon="fas fa-users">
        <x-dropdown-submenu href="{{ route('customers') }}" title="Müşteriler" active="customers" />
        <x-dropdown-submenu href="{{ route('personnels') }}" title="Personeller" active="personnels" />
    </x-dropdown-menu>

    <!-- Lokasyon Menüsü -->
    <x-dropdown-menu title="Lokasyon" active="states" icon="fas fa-map-marker-alt">
        <x-dropdown-submenu href="{{ route('states') }}" title="İl Listesi" active="states" />
        <x-dropdown-submenu href="{{ route('cities') }}" title="İlçe Listesi" active="cities" />
        <x-dropdown-submenu href="{{ route('districts') }}" title="Bölge Listesi" active="districts" />
    </x-dropdown-menu>
</div>
