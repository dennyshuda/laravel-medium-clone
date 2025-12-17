a<x-app-layout>
    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-5xl mb-4 font-bold">{{ $post->title }}</h1>
            <x-follow-wrapper :user="$post->user" class="flex items-center gap-2">
                <x-user-avatar :user="$post->user" />
                <a href="{{ route('profile.show', $post->user) }}" class="hover:underline">{{ $post->user->name }}</a>
                <button @click="follow()" x-text="following ? 'Unfollow' : 'Follow'"
                    :class="following ? 'text-red-600 border rounded-full px-3 py-2' :
                        'text-emerald-600 border rounded-full px-3 py-2'"></button>
                <div class="flex gap-2 text-sm font-medium text-gray-500">
                    {{ $post->readTime() }} min read
                    &middot;
                    {{ \Carbon\Carbon::parse($post->published_at)->format('F j, Y') }}
                </div>
            </x-follow-wrapper>

            <div class="mt-8 p-4 border-t border-b flex justify-between">
                <x-like-button :post="$post" />
                @auth
                    <a href="{{ route('post.edit', $post) }}">edit</a>
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
</x-app-layout>
