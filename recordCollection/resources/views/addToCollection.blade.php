<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">
        {{-- Header with Actions --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-4 md:mb-0">
                Add {{ $album->name }} to collection
            </h1>
        </div>
        <form method="POST" action="{{ route('/addToCollection', ['id' => $album->id]) }}" enctype="multipart/form-data"
              class="mt-4 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md space-y-8">
            @csrf


            {{-- Album Info --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h2 class="text-sm font-medium text-gray-700 dark:text-gray-300">Artist</h2>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $album->artist->name }}</p>
                </div>

                <div>
                    <h2 class="text-sm font-medium text-gray-700 dark:text-gray-300">Genre</h2>
                    <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $album->genre->name }}</p>
                </div>
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

        <div class="mt-4 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md space-y-8">


            {{-- Header with Actions --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-4 md:mb-0">
                    Songs
                </h1>
            </div>
            {{-- Sides --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($album->sides as $side)
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                            {{ $side->name }}
                        </h2>

                        <div class="space-y-2">
                            @foreach($side->songs->sortBy('order') as $song)
                                <div class="flex items-center p-2 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-10">
                                        {{ $song->order }}.
                                    </span>
                                    <span class="text-gray-900 dark:text-gray-100">{{ $song->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
