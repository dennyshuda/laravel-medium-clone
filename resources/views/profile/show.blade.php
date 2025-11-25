<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex gap-x-3">
                    <div class="flex-1">
                        <h2 class="text-5xl">{{ $user->name }}</h2>
                        <div class="mt-4 text-gray-900">
                            @forelse ($posts as $post)
                                <x-post-item :post="$post"></x-post-item>
                            @empty
                                <div>
                                    <p class="text-gray-900 text-center py-10">No Posts found</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <x-follow-wrapper :user="$user" class="w-[320px] border-l px-8">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>