@props(['showHeader' => true])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Feeding Fido</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    @if ($showHeader)
        <header class="bg-white mb-8">
            <nav class="flex mx-auto max-w-4xl p-6 lg:px-8 items-center justify-between" aria-label="Global">
                <div class="flex items-center gap-x-6">
                    <a href="/" class="-m-1.5 p-1.5">
                        <span class="sr-only">Feeding Fido</span>
                        <x-application-logo class="h-8 w-auto text-gray-500 fill-current"/>
                    </a>
                    <div>
                        @guest
                            <a href="{{ route('listings.create') }}"
                               class="inline-block px-4 py-1.5 bg-indigo-600 text-white text-sm font-medium rounded-sm shadow hover:bg-indigo-700 transition">
                                Add Listing
                            </a>
                        @else
                            @if (auth()->user()->role !== 'recipient')
                                <a href="{{ route('listings.create') }}"
                                   class="inline-block px-4 py-1.5 bg-indigo-600 text-white text-sm font-medium rounded-sm shadow hover:bg-indigo-700 transition">
                                    Add Listing
                                </a>
                            @else
                                <a href="{{ route('listings.index') }}" class="text-sm font-semibold text-gray-900">Available Listings</a>
                            @endif
                        @endguest
                    </div>
                </div>

                <div class="flex items-center gap-x-4">
                    @auth
                        <div class="sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-900 bg-white focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('dashboard')">
                                        {{ __('Your Listings') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

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
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-900">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-semibold text-gray-900">Register</a>
                        @endif
                    @endauth
                </div>

            </nav>

        </header>
    @endif

    <div class="mx-auto max-w-4xl p-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{ $slot }}
    </div>

</body>
</html>
