{{-- Sliding Sidebar Overlay (like Medium) --}}
<div x-show="sidebar" @@click="sidebar = false" class="fixed inset-0 bg-black/20 z-40 transition-opacity" x-cloak>
</div>

<aside
    class="fixed top-0 left-0 h-full w-[280px] bg-white z-50 shadow-xl transform transition-transform duration-300 ease-in-out overflow-y-auto"
    :class="sidebar ? 'translate-x-0' : '-translate-x-full'" x-cloak>

    {{-- Sidebar Header with Close Button --}}
    <div class="flex items-center gap-3 px-4 h-16 border-b">
        <button @click="sidebar = false" class="p-2 -ml-2 rounded-full hover:bg-gray-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5 text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
        <a href="{{ route('home.index') }}">
            <x-application-logo class="block h-8 w-auto fill-current text-gray-800" />
        </a>
    </div>

    {{-- Sidebar Nav --}}
    <nav class="px-3 pt-4 space-y-1">
        <a href="{{ route('home.index') }}"
            class="flex items-center gap-3 px-3 py-2.5 {{ request()->routeIs('home.index') ? 'text-gray-900 font-semibold bg-gray-50' : 'text-gray-600' }} rounded-lg hover:bg-gray-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span>Home</span>
        </a>

        @auth
        <a href="{{ route('profile.show', auth()->user()->username) }}"
            class="flex items-center gap-3 px-3 py-2.5 text-gray-600 rounded-lg hover:bg-gray-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <span>Profile</span>
        </a>

        <a href="{{ route('profile.lists', auth()->user()->username) }}"
            class="flex items-center gap-3 px-3 py-2.5 text-gray-600 rounded-lg hover:bg-gray-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            <span>Stories</span>
        </a>

        <div class="border-t my-3"></div>

        <a href="{{ route('post.create') }}"
            class="flex items-center gap-3 px-3 py-2.5 text-gray-600 rounded-lg hover:bg-gray-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
            <span>Write</span>
        </a>
        @endauth
    </nav>

    {{-- Sidebar Footer --}}
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t text-xs text-gray-400">
        <div class="space-x-3">
            <a href="#" class="hover:underline">Help</a>
            <a href="#" class="hover:underline">Privacy</a>
            <a href="#" class="hover:underline">Terms</a>
        </div>
    </div>
</aside>