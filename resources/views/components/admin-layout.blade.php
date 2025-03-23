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

<body class="font-sans antialiased">


    <div class="flex h-screen overflow-hidden bg-gray-100 ">

        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-72">
                <div class="flex flex-col flex-grow pt-5 overflow-y-auto relative bg-gray-200 border-r">
                    <img src="{{ asset('images/side.jpg') }}"
                        class="absolute top-0 left-0 right-0 bottom-0 h-full opacity-20 w-full object-cover"
                        alt="">
                    <div class="flex flex-col mt-5 flex-shrink-0 px-4">
                        <a class="text-lg font-semibold tracking-tighter flex justify-center text-center text-white focus:outline-none focus:ring"
                            href="/">
                            <div class="flex space-x-2 items-center text-gray-700">
                                <h1 class="text-main text-xl font-bold">O-CEMIS</h1>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-church">
                                    <path d="M10 9h4" />
                                    <path d="M12 7v5" />
                                    <path d="M14 22v-4a2 2 0 0 0-4 0v4" />
                                    <path
                                        d="M18 22V5.618a1 1 0 0 0-.553-.894l-4.553-2.277a2 2 0 0 0-1.788 0L6.553 4.724A1 1 0 0 0 6 5.618V22" />
                                    <path
                                        d="m18 7 3.447 1.724a1 1 0 0 1 .553.894V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9.618a1 1 0 0 1 .553-.894L6 7" />
                                </svg>

                            </div>

                        </a>

                        <button class="hidden rounded-lg focus:outline-none focus:shadow-outline">
                            <svg fill="currentColor" viewBox="0 0 20 20" class="size-6">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <x-shared.sidebar />

                </div>
            </div>
        </div>
        <div class="flex flex-col flex-1 w-0 overflow-hidden">
            <main class="relative flex-1 overflow-y-auto focus:outline-none">
                <div class="py-10">
                    <div class="mx-auto 2xl:max-w-7xl  ">
                        <h1 class="uppercase text-2xl font-bold">@yield('title')</h1>
                        <div class="mt-5">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
