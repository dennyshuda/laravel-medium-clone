<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-8">
        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div class="mb-6">
                <input id="title" name="title" type="text" value="{{ old('title') }}" placeholder="Title" autofocus
                    class="w-full text-4xl font-bold text-gray-900 border-none p-0 focus:ring-0 placeholder:text-gray-300" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            {{-- Image --}}
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Featured image</label>
                <input id="image" name="image" type="file" accept=".png, .jpg, .jpeg"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            {{-- Category --}}
            <div class="mb-6">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category_id" id="category_id"
                    class="w-full border-gray-200 focus:border-gray-400 focus:ring-0 rounded-lg">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                    <option @selected(old('category_id')==$category->id) value="{{ $category->id }}">{{ $category->name
                        }}
                    </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            {{-- Content --}}
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Story</label>
                <textarea class="tinymce" name="content">{{ old('content') }}</textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            {{-- Submit --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-green-700 text-white rounded-full px-6 py-2 text-sm font-medium hover:bg-green-800 transition">
                    Publish
                </button>
            </div>
        </form>
    </div>
</x-app-layout>