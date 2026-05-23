<x-app-layout>
    <x-delete-post-wrapper>
        <article class="max-w-[680px] mx-auto px-4 pt-8 pb-16">
            {{-- Post Header --}}
            <header class="mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
                    {{ $post->title }}
                </h1>

                {{-- Author Info --}}
                <x-follow-wrapper :user="$post->user">
                    <div class="flex items-center gap-3">
                        <x-user-avatar :user="$post->user" size="w-11 h-11" />
                        <div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('profile.show', $post->user) }}" class="font-medium hover:underline">
                                    {{ $post->user->name }}
                                </a>
                                @auth
                                @if (auth()->user()->id != $post->user->id)
                                <button @click="follow()" x-text="following ? 'Following' : 'Follow'"
                                    class="text-sm font-medium transition"
                                    :class="following ? 'text-gray-500' : 'text-green-700 hover:text-green-800'">
                                </button>
                                @endif
                                @endauth
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($post->published_at ?? $post->created_at)->format('F j, Y') }}
                                &middot;
                                {{ $post->readTime() }} min read
                            </div>
                        </div>
                    </div>
                </x-follow-wrapper>
            </header>

            {{-- Featured Image --}}
            @if ($post->image)
            <div class="mb-8">
                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                    class="w-full aspect-video object-cover rounded" />
            </div>
            @endif

            {{-- Post Content --}}
            <div class="prose prose-lg max-w-none prose-headings:font-bold prose-a:text-green-700 prose-img:rounded">
                {!! $post->content !!}
            </div>

            {{-- Category Tag --}}
            @if ($post->category)
            <div class="mt-10">
                <a href="{{ route('category', $post->category) }}"
                    class="inline-block px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition">
                    {{ $post->category->name }}
                </a>
            </div>
            @endif

            {{-- Actions Bar --}}
            <div class="mt-10 pt-4 border-t flex items-center gap-4">
                <x-like-button :post="$post" />

                @auth
                <div x-data="{ open: false }" class="relative ml-auto">
                    <button @click="open = ! open" class="text-gray-400 hover:text-gray-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </button>

                    <ul x-show="open" @click.outside="open = false"
                        class="absolute right-0 w-[200px] shadow-xl rounded-sm bg-white text-sm text-gray-600 py-2 space-y-1 z-10 border">
                        <li>
                            <a href="{{ route('post.edit', $post) }}" class="block px-4 py-2 hover:bg-gray-50">Edit
                                story</a>
                        </li>
                        <li>
                            <button @click="modal = ! modal"
                                class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-50">
                                Delete story
                            </button>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </article>

        {{-- Delete Confirmation Modal --}}
        <div x-show="modal" class="fixed inset-0 bg-black/30 z-50" x-cloak>
            <div @click.outside="modal = false"
                class="relative top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 shadow-lg rounded-lg bg-white w-5/6 md:w-96 p-8 text-center">
                <h2 class="text-2xl font-bold mb-2">Delete story?</h2>
                <p class="text-gray-500 text-sm mb-6">This cannot be undone, and the story will be permanently deleted.
                </p>

                <div class="flex gap-3 justify-center">
                    <button @click="modal = false"
                        class="py-2 px-6 rounded-full border border-gray-300 text-sm hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <form method="post" action="{{ route('post.delete', $post) }}">
                        @csrf
                        @method('delete')
                        <button
                            class="bg-red-500 text-white py-2 px-6 rounded-full text-sm hover:bg-red-600 transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </x-delete-post-wrapper>
</x-app-layout>