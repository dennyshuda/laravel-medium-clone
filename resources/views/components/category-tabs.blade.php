@props(['categories' => []])

<div class="flex gap-4 overflow-x-auto pb-3 text-sm scrollbar-hide">
    <a href="{{ route('home.index') }}"
        class="{{ request()->routeIs('home.index') ? 'text-gray-900 font-semibold border-b-2 border-gray-900 pb-1' : 'text-gray-500 hover:text-gray-900 pb-1' }}">
        All
    </a>
    @forelse ($categories as $category)
    <a href="{{ route('category', ['category' => $category->id]) }}"
        class="{{ request()->routeIs('category') && request()->route('category')->id == $category->id ? 'text-gray-900 font-semibold border-b-2 border-gray-900 pb-1' : 'text-gray-500 hover:text-gray-900 pb-1' }} whitespace-nowrap">
        {{ $category->name }}
    </a>
    @empty
    {{ $slot }}
    @endforelse
</div>