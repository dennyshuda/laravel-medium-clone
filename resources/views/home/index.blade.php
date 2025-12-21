<x-app-layout>
    <div class="flex">
        <nav class="border-r overflow-hidden transition-all duration-500 ease-in-out":class="sidebar
        ? 'w-[400px] opacity-100 translate-x-0'
        : 'w-0 opacity-0 -translate-x-10'">
            <div class="px-6 py-4 space-y-3">
                <a href="{{ route(name: 'home.index') }}" class="block mb-3">Home</a>
                <a href="#" class="block">Profile</a>
                <hr />
                <a href="#" class="block">Following</a>
            </div>
        </nav>

        <section class="mt-4 text-gray-900 w-full transition-all duration-500 ease-in-out"
            :class="sidebar === true ? 'ml-20' : 'ml-40'">
            @forelse ($posts as $post)
                <x-post-item :post="$post"></x-post-item>
            @empty
                <div>
                    <p class="text-gray-900 text-center py-10">No Posts found</p>
                </div>
            @endforelse
            <div>
                {{ $posts->links() }}
            </div>
        </section>

        <aside class="border-l transition-all duration-500 ease-in-out"
            :class="sidebar === true ? 'w-[500px]' : 'w-[700px]'">
            this is aside
        </aside>
    </div>
</x-app-layout>
