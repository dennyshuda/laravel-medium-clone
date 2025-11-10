<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-5xl mb-4">{{ $post->title }}</h1>
                <section class="flex gap-4">
                    <div>
                        @if ($post->user->image)
                            <img class="w-12 h-12 rounded-full object-cover" src="{{ Storage::url($post->user->image) }}"
                                alt="{{ $post->user->name }}">
                        @else
                            <img class="w-12 h-12 rounded-full object-cover"
                                src="https://tamilnaducouncil.ac.in/wp-content/uploads/2020/04/dummy-avatar.jpg"
                                alt="Dummy Avatar">
                        @endif
                    </div>

                    <div>
                        <div class="flex gap-2">
                            <h3>{{ $post->user->username }}</h3>
                        </div>
                        <div class="flex gap-2 text-sm text-gray-500">
                            {{ $post->readTime() }} min read
                            &middot;
                            {{ $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </section>

                <x-clap-button />

                <section class="mt-8">
                    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">
                    <div class="mt-4">
                        {{ $post->content }}
                    </div>
                </section>

                <section class="mt-8">
                    <span class="px-4 py-2 bg-gray-300 rounded-lg">
                        {{ $post->category->name }}
                    </span>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
