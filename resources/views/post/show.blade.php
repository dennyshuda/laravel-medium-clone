<x-app-layout>
    <x-delete-post-wrapper>
        <div class="py-4">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-5xl mb-4 font-bold">{{ $post->title }}</h1>
                <x-follow-wrapper :user="$post->user" class="flex items-center gap-2">
                    <x-user-avatar :user="$post->user" />
                    <a href="{{ route('profile.show', $post->user) }}" class="hover:underline">{{ $post->user->name }}</a>
                    @if (auth()->user()->id != $post->user->id)
                        <button @click="follow()" x-text="following ? 'Unfollow' : 'Follow'"
                            :class="following ? 'text-red-600 border rounded-full px-3 py-2' :
                                'text-emerald-600 border rounded-full px-3 py-2'"></button>
                    @endif
                    <div class="flex gap-2 text-sm font-medium text-gray-500">
                        {{ $post->readTime() }} min read
                        &middot;
                        {{ \Carbon\Carbon::parse($post->published_at)->format('F j, Y') }}
                    </div>
                </x-follow-wrapper>

                <div class="mt-8 p-4 border-t border-b flex justify-between">
                    <x-like-button :post="$post" />

                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = ! open">
                                <img src="{{ asset('icons/dot.svg') }}" alt="Menu Icon" class="w-6 h-6 text-blue-500">
                            </button>

                            <ul x-show="open" @click.outside="open = false"
                                class="absolute left-1/2 -translate-x-1/2 w-[200px] shadow-xl rounded-sm p-3 bg-white text-sm text-gray-500 space-y-3">
                                <li>
                                    <a href="{{ route('post.edit', $post) }}">Edit story</a>
                                </li>
                                <li>
                                    <button disabled class="cursor-not-allowed">Pin this story to your profile</button>
                                </li>
                                <li>
                                    <button @click="modal = ! modal" class="text-red-500">Delete story</button>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>

            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                class="mx-auto aspect-video object-cover h-[700px] my-10" />

            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <section class="mt-8">
                    <div class="mt-4">
                        {!! $post->content !!}
                    </div>
                </section>

                <section class="mt-8">
                    <span class="px-4 py-2 bg-gray-300 rounded-lg">
                        {{ $post->category->name }}
                    </span>
                </section>
            </div>
        </div>

        <div x-show="modal" class="fixed top-0 bottom-0 left-0 right-0 bg-white/80">
            <div @click.outside="modal = false"
                class="relative top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 shadow-lg rounded-lg bg-white w-5/6 md:w-4/6 h-4/6">
                <button @click="modal = false" class="absolute right-5 top-5">
                    <img src="{{ asset('icons/cancel.svg') }}" alt="Cancel icon" class="w-4 h-4">
                </button>

                <div class="mx-auto my-auto h-full flex items-center justify-center flex-col gap-2">
                    <h2 class="text-4xl font-bold">Delete story</h2>
                    <p class="text-gray-500">Deletion is not reversible, and the story will be completely deleted.</p>

                    <div class="flex gap-2">
                        <button @click="modal = false"
                            class="py-2 px-4 rounded-full border border-black">Cancel</button>
                        <form method="post" action="{{ route('post.delete', $post) }}">
                            @csrf
                            @method('delete')
                            <button class="bg-red-500 text-white py-2 px-4 rounded-full">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-delete-post-wrapper>
</x-app-layout>
