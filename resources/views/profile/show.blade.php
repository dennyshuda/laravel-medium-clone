<x-app-layout>
    <div class="flex justify-center">
        {{-- Main Content --}}
        <main class="w-full max-w-[680px] px-4 pt-8">
            {{-- Profile Header --}}
            <div class="mb-8">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900">{{ $user->name }}</h1>
                        @if ($user->bio)
                        <p class="mt-2 text-gray-600">{{ $user->bio }}</p>
                        @endif
                        <x-follow-wrapper :user="$user">
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-sm text-gray-500"><span x-text="followersCount"></span>
                                    followers</span>
                                <span class="text-gray-300">&middot;</span>
                                <span class="text-sm text-gray-500">{{ $posts->total() }} stories</span>
                                @if (auth()->user() && auth()->user()->id !== $user->id)
                                <button @click="follow"
                                    class="ml-3 rounded-full px-4 py-1.5 text-sm font-medium text-white transition"
                                    x-text="following ? 'Following' : 'Follow'"
                                    :class="following ? 'bg-gray-600 hover:bg-gray-700' : 'bg-green-700 hover:bg-green-800'">
                                </button>
                                @endif
                            </div>
                        </x-follow-wrapper>
                    </div>
                    <x-user-avatar :user="$user" size="w-20 h-20" />
                </div>
            </div>

            {{-- Tabs --}}
            <div class="flex gap-6 border-b mb-2">
                <a href="{{ route('profile.show', $user->username) }}"
                    class="pb-3 text-sm font-medium {{ request()->routeIs('profile.show') ? 'text-gray-900 border-b-2 border-gray-900' : 'text-gray-500 hover:text-gray-900' }}">
                    Home
                </a>
                <a href="{{ route('profile.lists', $user->username) }}"
                    class="pb-3 text-sm font-medium {{ request()->routeIs('profile.lists') ? 'text-gray-900 border-b-2 border-gray-900' : 'text-gray-500 hover:text-gray-900' }}">
                    Stories
                </a>
                <a href="{{ route('profile.about', $user->username) }}"
                    class="pb-3 text-sm font-medium {{ request()->routeIs('profile.about') ? 'text-gray-900 border-b-2 border-gray-900' : 'text-gray-500 hover:text-gray-900' }}">
                    About
                </a>
            </div>

            {{-- Posts --}}
            <div class="divide-y divide-gray-100">
                @forelse ($posts as $post)
                <x-post-item :post="$post"></x-post-item>
                @empty
                <div>
                    <p class="text-gray-900 text-center py-10">No stories yet</p>
                </div>
                @endforelse
            </div>

            <div class="py-8">
                {{ $posts->links() }}
            </div>
        </main>

        {{-- Right Sidebar --}}
        <aside class="hidden lg:block w-[320px] shrink-0 px-4 pt-8">
            <div class="sticky top-20">
                <x-follow-wrapper :user="$user" class="space-y-3">
                    <x-user-avatar :user="$user" size="w-24 h-24" />
                    <div>
                        <h3 class="font-bold text-xl">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500"><span x-text="followersCount"></span> followers</p>
                    </div>
                    @if ($user->bio)
                    <p class="text-sm text-gray-600">{{ $user->bio }}</p>
                    @endif
                    @if (auth()->user() && auth()->user()->id !== $user->id)
                    <button @click="follow" class="rounded-full px-6 py-2 text-sm font-medium text-white transition"
                        x-text="following ? 'Following' : 'Follow'"
                        :class="following ? 'bg-gray-600 hover:bg-gray-700' : 'bg-green-700 hover:bg-green-800'">
                    </button>
                    @endif
                </x-follow-wrapper>

                <div class="text-xs text-gray-400 space-x-2 mt-8">
                    <a href="#" class="hover:underline">Help</a>
                    <a href="#" class="hover:underline">Privacy</a>
                    <a href="#" class="hover:underline">Terms</a>
                </div>
            </div>
        </aside>
    </div>
</x-app-layout>