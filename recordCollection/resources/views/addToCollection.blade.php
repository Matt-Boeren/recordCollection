<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-8">
            Add Album to Collection
        </h1>

        <form method="POST" action="" enctype="multipart/form-data"
              class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md space-y-8">
            @csrf

            {{-- Album --}}
            <div>
                <label for="album" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Album</label>
                <select name="album" id="album"
                        class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                               bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                               focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    {{-- Options will be populated dynamically --}}
                </select>
            </div>


            {{-- Rating --}}
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rating</label>
                <div class="flex items-center space-x-4 mt-2">
                    <input type="range" id="rating" name="rating" min="0" max="5" step="0.25"
                           class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer
                                  accent-blue-600 dark:accent-blue-400"
                           oninput="this.nextElementSibling.value = parseFloat(this.value).toFixed(2)"/>

                    <output class="text-gray-900 dark:text-gray-100 font-semibold w-12 text-center">2.50</output>
                </div>
            </div>
            {{-- Picture --}}
            <div>
                <label for="picture" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Picture</label>
                <input type="file" id="picture" name="picture" accept="image/*"
                       class="w-full mt-1 text-sm text-gray-900 dark:text-gray-100
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-lg file:border-0
                              file:text-sm file:font-medium
                              file:bg-blue-600 file:text-white
                              hover:file:bg-blue-700 transition"/>
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Add to Collection
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
