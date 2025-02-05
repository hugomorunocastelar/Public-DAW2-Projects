<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Get a Car') }}</title>

        <link rel="shortcut icon" href="storage/logo/logo.png" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="flex flex-col min-h-screen bg-gray-100">

            <x-menus.menu-main/>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="container mx-auto py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <footer class="bg-gray-50">
                <header class="bg-white shadow">
                    <div class="container mx-auto py-6 sm:px-6 lg:px-8">
                        <div class="flex justify-between text-gray-500">
                            <div>
                                <a href="{{ route('policy') }}" class="me-4">
                                    {{__('Políticas')}}
                                </a>
                                <a href="{{ route('terms') }}">
                                    {{__('Términos')}}
                                </a>
                            </div>
                            <div>
                                <h4>Hugo Moruno Parra 2024</h4>
                            </div>
                        </div>
                    </div>
                </header>
            </footer>

        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
