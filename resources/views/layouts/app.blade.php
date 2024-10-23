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

<body class="flex flex-col h-screen">
    <!-- Ana Flex Konteyner -->
    <div class="flex flex-grow">
        @include('layouts.parts.sidebar')

        <!-- Sağda kalan İçerik Alanı -->
        <div class="flex flex-col w-full">
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
            <div class="flex-grow m-5">
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
    {{-- <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>

    @livewireScripts
</body>


</html>
