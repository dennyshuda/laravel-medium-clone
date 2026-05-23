<x-app-layout>
    <div class="flex justify-center relative">
        <x-sidebar-overlay />

        {{-- Main Content --}}
        <main class="w-full max-w-[680px] px-4 pt-6">
            {{-- Category Tabs --}}
            <div class="border-b mb-2">
                <x-category-tabs :categories="$categories">
                    <p class="text-gray-900 text-center py-10">No Categories found</p>
                </x-category-tabs>
            </div>

            {{-- Posts Feed --}}
            <div class="divide-y divide-gray-100">
                @forelse ($posts as $post)
                <x-post-item :post="$post"></x-post-item>
                @empty
                <div>
                    <p class="text-gray-900 text-center py-10">No Posts found</p>
                </div>
                @endforelse
            </div>

            <div class="py-8">
                {{ $posts->links() }}
            </div>
        </main>

        {{-- Right Sidebar --}}
        <aside class="hidden lg:block w-[320px] shrink-0 px-4 pt-10">
            <div class="sticky top-20">
                @auth
                <div class="flex items-center gap-3 mb-6 pb-6 border-b">
                    <x-user-avatar :user="auth()->user()" size="w-12 h-12" />
                    <div>
                        <p class="font-semibold text-sm">{{ auth()->user()->name }}</p>
                        <p class="text-gray-500 text-sm">{{ '@' . auth()->user()->username }}</p>
                    </div>
                </div>
                @endauth

                @if (isset($suggestedUsers) && $suggestedUsers->count() > 0)
                <div class="mb-6">
                    <h3 class="font-bold text-sm text-gray-500 uppercase tracking-wider mb-3">Who to follow</h3>
                    <div class="space-y-3">
                        @foreach ($suggestedUsers as $suggestedUser)
                        <div class="flex items-center gap-3">
                            <x-user-avatar :user="$suggestedUser" size="w-8 h-8" />
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('profile.show', $suggestedUser->username) }}"
                                    class="text-sm font-semibold hover:underline truncate block">
                                    {{ $suggestedUser->name }}
                                </a>
                                <p class="text-xs text-gray-500 truncate">{{ '@' . $suggestedUser->username }}</p>
                            </div>
                            @auth
                            @if (auth()->id() !== $suggestedUser->id)
                            <x-follow-wrapper :user="$suggestedUser">
                                <button @click="follow" x-text="following ? 'Following' : 'Follow'"
                                    class="text-sm font-semibold transition"
                                    :class="following ? 'text-gray-500' : 'text-green-700 hover:text-green-800'">
                                </button>
                            </x-follow-wrapper>
                            @endif
                            @endauth
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="text-xs text-gray-400 space-x-2 mt-8">
                    <a href="#" class="hover:underline">Help</a>
                    <a href="#" class="hover:underline">Privacy</a>
                    <a href="#" class="hover:underline">Terms</a>
                    <span>&copy; {{ date('Y') }} Medium Clone</span>
                </div>
            </div>
        </aside>
    </div>
</x-app-layout>