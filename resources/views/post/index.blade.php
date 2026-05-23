<x-app-layout>
    <div class="flex justify-center">
        <main class="w-full max-w-[680px] px-4 pt-6">
            <div class="border-b mb-2">
                <x-category-tabs>
                    <p class="text-gray-900 text-center py-10">No Categories found</p>
                </x-category-tabs>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse ($posts as $post)
                <x-post-item :post="$post"></x-post-item>
                @empty
                <div>
                    <p class="text-gray-900 text-center py-10">No Posts found</p>
                </div>
                @endforelse
            </div>

            <div class="py-8">
                {{ $posts->links() }}
            </div>
        </main>
    </div>
</x-app-layout>