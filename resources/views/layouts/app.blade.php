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

    <wireui:scripts />
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased">
    <img src="{{ asset('images/side.jpg') }}"
        class="fixed top-0 left-0 right-0 bottom-0 h-full opacity-20 w-full object-cover" alt="">
    <div class="min-h-screen bg-gray-100  ">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow relative">
                <div class="max-w-7xl mx-auto py-6 px-4 2xl:px-0 ">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="relative">
            {{ $slot }}
        </main>
    </div>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
