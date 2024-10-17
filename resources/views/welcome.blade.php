<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="h-screen overflow-hidden">
    <!-- Sabitlenmiş Sidebar -->
    <div class="flex h-full">

        <div class="fixed w-48 h-full px-4 py-5 text-gray-300 bg-blue-950"
            x-data="{ openLocation: false, openPortfolio: false, openPeople: false }">
            <div class="mb-3">
                <span class="text-xl font-extrabold text-orange-500">BEOS</span>
            </div>
            <hr class="mb-3 border-gray-700">

            <p class="mb-2 text-sm font-semibold tracking-wide text-gray-400">MENÜ</p>

            <!-- Location Menu -->
            <div class="pl-1">
                <a href="#" @click.prevent="openLocation = !openLocation"
                    class="flex items-center justify-between text-sm font-semibold text-gray-400 transition-colors duration-200 rounded-md hover:text-white">
                    Location
                    <span :class="{'rotate-180': openLocation}"
                        class="text-gray-400 transition-transform duration-200">&#9662;</span>
                </a>
                <div x-show="openLocation" class="ml-2 space-y-0">
                    <a href="{{ route('states') }}"
                        class="block text-sm text-gray-400 transition-colors duration-200 hover:text-white">States</a>
                    <a href="{{ route('cities') }}"
                        class="block text-sm text-gray-400 transition-colors duration-200 hover:text-white">Cities</a>
                    <a href="{{ route('districts') }}"
                        class="block text-sm text-gray-400 transition-colors duration-200 hover:text-white">Districts</a>
                </div>
            </div>

            <!-- Portfolio Menu -->
            <div class="pl-1">
                <a href="#" @click.prevent="openPortfolio = !openPortfolio"
                    class="flex items-center justify-between text-sm font-semibold text-gray-400 transition-colors duration-200 rounded-md hover:text-white">
                    Portfolio
                    <span :class="{'rotate-180': openPortfolio}"
                        class="text-gray-400 transition-transform duration-200">&#9662;</span>
                </a>
                <div x-show="openPortfolio" class="ml-2 space-y-0">
                    <a href="{{ route('categories') }}"
                        class="block text-sm text-gray-400 transition-colors duration-200 hover:text-white">Categories</a>
                    <a href="{{ route('types') }}"
                        class="block text-sm text-gray-400 transition-colors duration-200 hover:text-white">Types</a>
                    <a href="{{ route('portfolios') }}"
                        class="block text-sm text-gray-400 transition-colors duration-200 hover:text-white">Portfolios</a>
                </div>
            </div>

            <!-- People Menu -->
            <div class="pl-1">
                <a href="#" @click.prevent="openPeople = !openPeople"
                    class="flex items-center justify-between text-sm font-semibold text-gray-400 transition-colors duration-200 rounded-md hover:text-white">
                    People
                    <span :class="{'rotate-180': openPeople}"
                        class="text-gray-400 transition-transform duration-200">&#9662;</span>
                </a>
                <div x-show="openPeople" class="ml-2 space-y-0">
                    <a href="{{ route('customers') }}"
                        class="block text-sm text-gray-400 transition-colors duration-200 hover:text-white">Customers</a>
                    <a href="{{ route('personnels') }}"
                        class="block text-sm text-gray-400 transition-colors duration-200 hover:text-white">Personnel</a>
                </div>
            </div>
        </div>

        <!-- Sağda kalan İçerik -->
        <div class="flex flex-col w-full h-full ml-48 overflow-auto bg-red-100">
            <!-- Topbar -->
            <div class="flex items-center justify-between w-full px-4 shadow-md bg-slate-50 h-14">
                <!-- Profil Menüsü -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex items-center text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                <img class="object-cover w-8 h-8 rounded-full"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                    {{ Auth::user()->name }}
                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Hesabım -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Hesabım') }}
                            </div>
                            <!-- Profil Linki -->
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profil') }}
                            </x-dropdown-link>
                            <!-- Ayarlar Linki -->
                            <x-dropdown-link href="#">
                                {{ __('Ayarlar') }}
                            </x-dropdown-link>
                            <!-- Çıkış Yap Linki -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Çıkış Yap') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Breadcrumb -->
            <div class="flex items-center justify-between w-full px-4 m-1 rounded-lg shadow-lg h-14 bg-slate-50">
                <div class="text-sm text-gray-500">
                    <a href="#" class="hover:text-gray-700">Dashboard</a> /
                    <a href="#" class="hover:text-gray-700">Users</a> /
                    <span class="font-semibold text-gray-600">Add User</span>
                </div>

                <!-- Action Button -->
                <button
                    class="flex items-center px-4 py-1 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Yeni Ekle
                </button>
            </div>

            <!-- Ana İçerik -->
            <div class="m-10 h-min">content</div>
            <!-- Footer -->
            <div class="flex justify-center p-4 text-gray-100 bg-gray-900">
                BEOS - Burada Emlak Otomasyon Sistemi &copy; <?php echo date('Y'); ?>
            </div>
        </div>
    </div>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
