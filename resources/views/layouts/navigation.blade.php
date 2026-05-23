<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            {{-- Left: Burger + Logo & Search --}}
            <div class="flex items-center gap-3">
                @auth
                <button @click="sidebar = ! sidebar" class="p-2 -ml-2 rounded-full hover:bg-gray-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                @endauth

                <a href="{{ route('home.index') }}">
                    <x-application-logo class="block h-8 w-auto fill-current text-gray-800" />
                </a>

                <div class="hidden sm:flex items-center bg-gray-100 px-3 py-1.5 rounded-full w-64">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4 text-gray-400 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input type="text" placeholder="Search"
                        class="focus:ring-0 border-none bg-transparent text-sm w-full placeholder:text-gray-400">
                </div>
            </div>

            {{-- Right: Actions --}}
            <div class="flex items-center gap-3">
                @auth
                <a href="{{ route('post.create') }}"
                    class="hidden sm:flex items-center gap-1.5 text-sm text-gray-600 hover:text-gray-900 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    <span>Write</span>
                </a>

                {{-- Notification bell --}}
                <button class="text-gray-500 hover:text-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                </button>

                {{-- User Avatar Dropdown --}}
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center focus:outline-none transition">
                            <x-user-avatar :user="auth()->user()" size="w-8 h-8" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b">
                            <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ '@' . Auth::user()->username }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.show', auth()->user()->username)">
                            Your profile
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.lists', auth()->user()->username)">
                            Your stories
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            Settings
                        </x-dropdown-link>
                        <div class="border-t"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Sign out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endauth

                @guest
                <a href="{{ route('post.create') }}"
                    class="hidden sm:flex items-center gap-1.5 text-sm text-gray-600 hover:text-gray-900 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    <span>Write</span>
                </a>
                <a href="{{ route('login') }}"
                    class="text-sm text-gray-600 hover:text-gray-900 transition hidden sm:block">
                    Sign in
                </a>
                <a href="{{ route('register') }}"
                    class="text-sm bg-green-700 text-white rounded-full px-4 py-2 hover:bg-green-800 transition">
                    Get started
                </a>
                @endguest

                {{-- Mobile menu toggle --}}
                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    @auth
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden border-t">
        <div class="pt-4 pb-1 space-y-1 px-4">
            <x-responsive-nav-link :href="route('profile.show', auth()->user()->username)">
                Your profile
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.lists', auth()->user()->username)">
                Your stories
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('post.create')">
                Write
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')">
                Settings
            </x-responsive-nav-link>
            <div class="border-t my-2"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    Sign out
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
    @endauth
    @guest
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden border-t">
        <div class="pt-4 pb-1 space-y-1 px-4">
            <x-responsive-nav-link :href="route('login')">Sign in</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')">Get started</x-responsive-nav-link>
        </div>
    </div>
    @endguest
</nav>