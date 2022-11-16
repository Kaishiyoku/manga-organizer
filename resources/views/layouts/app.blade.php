<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @vite('resources/css/app.css')

        <!-- Scripts -->
        @vite('resources/js/app.js')

        @include('shared._favicon')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:text-gray-400 dark:bg-gray-900">
            <img src="{{ asset('img/cover.jpg') }}" alt="{{ __('Cover') }}" class="w-full object-cover object-left-top drop-shadow-md h-[125px] sm:h-[150px] md:h-[175px] lg:h-[250px] xl:h-[300px]"/>

            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        @include('flash::message')

                        {{ $slot }}
                    </div>
                </div>
            </main>

            <footer class="pt-12 pb-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="space-x-4">
                    <x-link :href="route('mangas.index_plain')" :active="request()->routeIs('mangas.index_plain')">
                        {{ __('List as text') }}
                    </x-link>

                    @auth
                        <x-link :href="route('settings.index')" :active="request()->routeIs('settings.index', 'settings.edit_password')">
                            {{ __('Settings') }}
                        </x-link>
                    @endauth

                    @if (config('app.contact_email'))
                        <x-link :href="'mailto:' . config('app.contact_email')">
                            {{ __('Contact me') }}
                        </x-link>
                    @endif
                </div>

                <div class="space-x-4 pt-2">
                    @foreach (socialLinks() as $socialLink)
                        <x-link :href="$socialLink->url">
                            {{ $socialLink->title }}
                        </x-link>
                    @endforeach
                </div>
            </footer>
        </div>
    </body>
</html>
