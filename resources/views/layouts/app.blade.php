<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BEOS - {{   $title ?? 'BEOS' }}</title>

    <!-- Google Fonts ve App CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body x-data="{ sidebarOpen: true }" class="flex flex-col h-screen overflow-hidden">
    <!-- Ana Flex Konteyner -->
    <div class="flex flex-grow h-screen overflow-hidden">
        <!-- Sidebar -->
        <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="-translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="-translate-x-full opacity-0">
            @include('layouts.parts.sidebar')
        </div>

        <!-- Sağda kalan İçerik Alanı -->
        <div :class="sidebarOpen ? 'flex flex-col w-full h-screen overflow-y-auto' : 'flex flex-col w-full h-screen overflow-y-auto'">
            <!-- Toggle Button (mobile & desktop) -->
            <button @click="sidebarOpen = !sidebarOpen" class="absolute top-4 left-4 z-50 p-2 bg-blue-900 text-white rounded-full shadow-lg focus:outline-none md:hidden">
                <template x-if="sidebarOpen">
                    <i class="fas fa-times text-base"></i>
                </template>
                <template x-if="!sidebarOpen">
                    <i class="fas fa-bars text-base"></i>
                </template>
            </button>
            @include('layouts.parts.topbar')

            <!-- Page Heading (Varsa) -->
            @if (isset($header))
            <header class="bg-white shadow border-2 border-amber-600 border-dashed m-2">
                <div class="px-2 py-2 mx-auto">
                    {{ $header }}
                </div>
            </header>
            @endif

            <!-- Ana İçerik -->
            <div class="flex-grow m-2  border-2 border-amber-600 border-dashed">
                {{ $slot }}
            </div>

            <!-- Footer her zaman en altta kalacak -->
            @include('layouts.parts.footer')
        </div>
    </div>

    <!-- Modals -->
    @stack('modals')

    <!-- Bildirim ve Livewire Scriptleri -->
    <x-bildirim />
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
    @livewireScripts
</body>


</html>
