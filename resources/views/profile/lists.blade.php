<x-app-layout>
    <div class="flex gap-2">
        <section class="flex-1 px-10 pt-10">
            <div class="w-[750px] ml-auto">
                <h2 class="text-4xl font-bold">{{ $user->name }}</h2>
                <div class="my-5 flex gap-5 border-b py-3">

                    <a href="{{ route('profile.show', $user->username) }}" class="text-gray-600">Home</a>
                    <a href="{{ route('profile.lists', $user->username) }}" class="text-gray-600">Lists</a>
                    <a href="{{ route('profile.about', $user->username) }}" class="text-gray-600">About</a>
                </div>

                <div class="mt-4 text-gray-900">
                    @forelse ($posts as $post)
                        <x-post-item :post="$post"></x-post-item>
                    @empty
                        <div>
                            <p class="text-gray-900 text-center py-10">No Posts found</p>
                        </div>
                    @endforelse
                </div>
                <div class="my-5">{{ $posts->links() }}</div>
            </div>
        </section>

        <aside class="w-[450px] border-l px-8 pt-5">
            <x-follow-wrapper :user="$user">
                <x-user-avatar :user="$user" size="w-24 h-24" />
                <h3>{{ $user->name }}</h3>
                <p class="text-gray-500"><span x-text="followersCount"></span> followers</p>
                <p>{{ $user->bio }}</p>
                @if (auth()->user() && auth()->user()->id !== $user->id)
                    <div>
                        <button @click="follow" class="rounded-full px-4 py-2 text-white"
                            x-text="following ? 'Unfollow': 'Follow'"
                            :class="following ? 'bg-red-600' : 'bg-emerald-600'"></button>
                    </div>
                @endif
            </x-follow-wrapper>
        </aside>
    </div>
</x-app-layout>
