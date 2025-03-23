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

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="fixed top-0 bottom-0 left-0 right-0">
        <img src="{{ asset('images/bg.jpg') }}" class="h-full w-full opacity-40" alt="">
    </div>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">

            </a>
        </div>

        <div class="w-full relative sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-5">
                <h1 class="text-xl font-bold text-main uppercase">Adarles Pentecostal Church</h1>
                <h1 class="text-lg  mt-3 text-gray-600 "><span class="text-main">O-CEMIS</span> |
                    {{ request()->routeIs('login') ? 'Login' : 'Register' }}</h1>
            </div>
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
