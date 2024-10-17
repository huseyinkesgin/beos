<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts ve App CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>

    @livewireStyles
</head>

<body class="h-screen overflow-hidden">
    <!-- Ana Flex Konteyner -->
    <div class="flex h-full">

        @include('layouts.parts.sidebar')

        <!-- Sağda kalan İçerik Alanı -->
        <div class="w-full ml-48" :class="{ 'ml-0': !sidebarOpen }" x-transition>

       @include('layouts.parts.topbar')



            <!-- Page Heading (Varsa) -->
            @if (isset($header))
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endif

            <!-- Ana İçerik -->
            <div class="m-5 h-min">
                {{ $slot }}
            </div>
            <!-- Ana İçerik Bitişi -->

           @include('layouts.parts.footer')
        </div>
        <!-- İçerik Alanı Bitişi-->
    </div>

    <!-- Modals -->
    @stack('modals')

    <!-- Bildirim ve Livewire Scriptleri -->
    <x-bildirim />
    <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script>
    @livewireScripts
</body>

</html>
