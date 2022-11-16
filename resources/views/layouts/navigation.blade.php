<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <div class="flex w-full">
                <!-- Logo -->
                <div class="shrink-0 flex items-center mr-10">
                    <a href="{{ route('mangas.index') }}">
                        <x-application-logo class="block h-8 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden w-full space-x-4 sm:flex sm:items-center sm:justify-between">
                    <div class="grow hidden space-x-8 sm:flex">
                        <x-nav-link :href="route('mangas.index')" :active="request()->routeIs('mangas.index')">
                            {{ __('Manga list') }}
                        </x-nav-link>

                        <x-nav-link :href="route('mangas.statistics')" :active="request()->routeIs('mangas.statistics')">
                            {{ __('Statistics') }}
                        </x-nav-link>

                        @guest
                            <x-nav-link :href="route('recommendations.create')" :active="request()->routeIs('recommendations.create')">
                                {{ __('Recommend manga') }}
                            </x-nav-link>
                        @endguest
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        @guest
                            <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                {{ __('Log in') }}
                            </x-nav-link>
                        @endguest
                    </div>
                </div>
            </div>

            @auth
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50 dark:hover:text-white px-3 py-2 rounded-md text-sm transition">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('mangas.manage')" :active="request()->routeIs('mangas.manage', 'mangas.edit')">
                                {{ __('Manage mangas') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('social_links.index')" :active="request()->routeIs('social_links.*')">
                                {{ __('Social links') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('recommendations.index')" :active="request()->routeIs('recommendations.index')">
                                {{ __('Recommendations') }}
                            </x-dropdown-link>

                            <x-dropdown-divider/>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-600 focus:text-gray-500 dark:focus:text-gray-300 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('mangas.index')" :active="request()->routeIs('mangas.index')">
                {{ __('Manga list') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('mangas.statistics')" :active="request()->routeIs('mangas.statistics')">
                {{ __('Statistics') }}
            </x-responsive-nav-link>

            @guest
                <x-responsive-nav-link :href="route('recommendations.create')" :active="request()->routeIs('recommendations.create')">
                    {{ __('Recommend manga') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Log in') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('mangas.manage')" :active="request()->routeIs('mangas.manage', 'mangas.edit')">
                    {{ __('Manage mangas') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('social_links.index')" :active="request()->routeIs('social_links.*')">
                    {{ __('Social links') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('recommendations.index')" :active="request()->routeIs('recommendations.index')">
                    {{ __('Recommendations') }}
                </x-responsive-nav-link>
            @endguest
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-300">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
