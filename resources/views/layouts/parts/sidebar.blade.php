<div x-data="{ open: true }" class="relative text-[13px] font-normal">
    <!-- Toggle Button -->
    <button @click="open = !open"
        class="absolute top-4 right-4 z-50 p-2 bg-blue-900 text-white rounded-full shadow-lg focus:outline-none md:hidden">
        <template x-if="open">
            <i class="fas fa-times text-base"></i>
        </template>
        <template x-if="!open">
            <i class="fas fa-bars text-base"></i>
        </template>
    </button>

    <!-- Sidebar -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="-translate-x-full opacity-0"
        class="w-64 h-screen px-4 py-6 bg-orange-600 shadow-2xl text-gray-200 fixed top-0 left-0 z-40 md:relative md:block text-[13px] font-normal">
        <!-- Logo Section -->
        <div class="mb-6 text-center">
            <div class="text-xl font-bold text-white tracking-wide">BEOS</div>
            <div class="text-xs text-blue-100 mt-1">Emlak Yönetim Sistemi</div>
        </div>

        <!-- Navigation Section -->
        <div class="px-4 py-6">
            <div class="mb-6">
                <h2 class="px-3 mb-4 text-xs font-bold tracking-widest text-gray-900 uppercase">Ana Menü</h2>
            </div>

            <!-- Portfolio Menüsü -->
            <div class="mb-2">
                <x-dropdown-menu title="Portföyler" active="portfolios" icon="fas fa-home">
                    <x-dropdown-submenu href="{{ route('portfolios') }}" title="Tüm Portföyler" active="portfolios" />
                </x-dropdown-menu>
            </div>

            <!-- Gider Menüsü -->
            <div class="mb-2">
                <x-dropdown-menu title="Finansal İşlemler" active="bills" icon="fas fa-chart-line">
                    <x-dropdown-submenu href="{{ route('bills') }}" title="Faturalar" active="bills" />
                    <x-dropdown-submenu href="{{ route('personel.expense') }}" title="Ofis Harcamaları"
                        active="personel.expense" />
                    <x-dropdown-submenu href="{{ route('personel.balance') }}" title="Nakit Girişleri"
                        active="personel.balance" />
                </x-dropdown-menu>
            </div>

            <!-- Kişiler Menüsü -->
            <div class="mb-2">
                <x-dropdown-menu title="İnsan Kaynakları" active="customers" icon="fas fa-users">
                    <x-dropdown-submenu href="{{ route('customers') }}" title="Müşteriler" active="customers" />
                    <x-dropdown-submenu href="{{ route('personnels') }}" title="Personeller" active="personnels" />
                </x-dropdown-menu>
            </div>

            <!-- Ayarlar Section -->
            <div class="mt-8 pt-6 border-t border-slate-700">
                <h2 class="px-3 mb-4 text-xs font-bold tracking-widest text-gray-900 uppercase">Sistem Ayarları</h2>
                <div class="mb-2">
                    <x-dropdown-menu title="Yapılandırma" active="settings" icon="fas fa-cogs">
                        <x-dropdown-submenu  href="{{ route('categories') }}" title="Kategoriler" active="categories" wire:navigate />
                        <x-dropdown-submenu  href="{{ route('types') }}" title="Emlak Tipleri" active="types" wire:navigate />
                        <x-dropdown-submenu  href="{{ route('states') }}" title="İl Listesi" active="states" wire:navigate />
                        <x-dropdown-submenu  href="{{ route('cities') }}" title="İlçe Listesi" active="cities" wire:navigate />
                        <x-dropdown-submenu  href="{{ route('districts') }}" title="Mahalle Listesi" active="districts" wire:navigate />
                        <x-dropdown-submenu  href="{{ route('vehicles') }}" title="Araçlar" active="vehicles" wire:navigate />
                    </x-dropdown-menu>
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="absolute bottom-0 left-0 right-0 px-4 py-4 bg-orange-600 border-t border-orange-600">
            <div class="flex items-center justify-center text-xs text-gray-900">
                <i class="mr-2 fas fa-shield-alt"></i>
                <span>© 2024 BEOS v1.0</span>
            </div>
        </div>
    </div>
</div>
