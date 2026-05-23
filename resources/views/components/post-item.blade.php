@props(['post'])

<article class="flex items-start gap-6 py-6">
    <div class="flex-1 min-w-0">
        {{-- Author --}}
        <div class="flex items-center gap-2 mb-3">
            <x-user-avatar :user="$post->user" size="w-5 h-5" />
            <a href="{{ route('profile.show', $post->user) }}" class="text-sm font-medium hover:underline">
                {{ $post->user->name }}
            </a>
        </div>

        {{-- Title & Excerpt --}}
        <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}">
            <h2 class="text-xl font-bold text-gray-900 leading-tight mb-2 hover:underline">
                {{ $post->title }}
            </h2>
        </a>
        <p class="text-gray-600 text-base leading-relaxed mb-3 line-clamp-2">
            {!! Str::words(strip_tags($post->content), 30, '...') !!}
        </p>

        {{-- Meta --}}
        <div class="flex items-center gap-3 text-sm text-gray-500">
            <span>{{ \Carbon\Carbon::parse($post->published_at ?? $post->created_at)->format('F j, Y') }}</span>
            <span>&middot;</span>
            <span>{{ $post->readTime() }} min read</span>
            <span>&middot;</span>
            <span class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
                <span>{{ $post->likes()->count() }}</span>
            </span>
        </div>
    </div>

    {{-- Thumbnail --}}
    @if ($post->image)
    <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}" class="shrink-0">
        <img class="w-48 h-28 object-cover rounded" src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" />
    </a>
    @endif
</article>