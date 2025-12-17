<ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 justify-center">
    <li class="me-2">
        <a href="{{ route('dashboard') }}"
            class="inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-100">
            All
        </a>
    </li>
    @forelse ($categories as $category)
        <li class="me-2">
            <a href="{{ route('category', ['category' => $category->id]) }}"
                class="{{ request()->routeIs('category') && request()->route('category')->id == $category->id ? 'active text-white bg-blue-600 inline-block px-4 py-2 rounded-lg' : 'inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-100' }}">
                {{ $category->name }}
            </a>
        </li>
    @empty
        {{ $slot }}
    @endforelse
</ul>