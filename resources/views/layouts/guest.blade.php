<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
<div class="min-h-screen flex flex-col bg-gray-100">

    <x-header />
    <main class="flex-grow flex items-center justify-center w-full px-4 py-12">

        @if (request()->routeIs('welcome'))
            <div class="w-full sm:max-w-4xl mt-6 px-6 py-20 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>

        @elseif(request()->routeIs('login_admin'))
            <div class="w-full max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

                <div class="hidden md:block text-center">
                    <img src="{{ asset('img/admin.png') }}"
                         alt="Ilustração de Administrador"
                         class="max-w-md mx-auto rounded-2xl shadow-lg
                            hover:shadow-2xl hover:-translate-y-2 hover:shadow-border
                            transition-all duration-300"
                         style="mask-image: radial-gradient(circle, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%);" />
                </div>

                <div class="w-full bg-white shadow-xl rounded-2xl p-8 md:p-12">
                    {{ $slot }}
                </div>
            </div>

        @elseif(request()->routeIs('login_dev') || request()->routeIs('register_dev'))
            <div class="w-full max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div class="hidden md:block text-center">
                    <img src="{{ asset('img/dev.png') }}" alt="Ilustração de Desenvolvedor" class="max-w-md mx-auto rounded-2xl shadow-lg
                            hover:shadow-2xl hover:-translate-y-2 hover:shadow-border
                            transition-all duration-300"
                         style="mask-image: radial-gradient(circle, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%);" />
                </div>
                <div class="w-full bg-white shadow-xl rounded-2xl p-8 md:p-12">
                    {{ $slot }}
                </div>
            </div>

        @elseif(request()->routeIs('login_cliente') || request()->routeIs('register_cliente'))
            <div class="w-full max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div class="hidden md:block text-center">
                    <img src="{{ asset('img/cliente.png') }}" alt="Ilustração de Cliente" class="max-w-md mx-auto rounded-2xl shadow-lg
                            hover:shadow-2xl hover:-translate-y-2 hover:shadow-border
                            transition-all duration-300"
                         style="mask-image: radial-gradient(circle, rgba(0,0,0,1) 40%, rgba(0,0,0,0) 100%);" />
                </div>
                <div class="w-full bg-white shadow-xl rounded-2xl p-8 md:p-12">
                    {{ $slot }}
                </div>
            </div>

        @else
            <div class="w-full sm:max-w-md bg-white shadow-md overflow-hidden sm:rounded-lg p-6">
                {{ $slot }}
            </div>
        @endif

    </main>
    <x-footer />
</div>
</body>
</html>

