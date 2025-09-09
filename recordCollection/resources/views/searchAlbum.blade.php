<x-app-layout>

    <div class="max-w-6xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">Search Album</h1>

        <form method="POST" action="{{ route('/searchAlbum') }}"
              class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md flex flex-col md:flex-row items-stretch gap-4">
            @csrf
            <div class="flex-1">
                <label for="searchValue" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Search by album, artist, genre, or song
                </label>
                @isset($searchValue)
                    <input type="text" name="searchValue" id="searchValue" value="{{ $searchValue }}"
                           class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                  bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                  focus:ring-2 focus:ring-blue-500 focus:outline-none"/>
                @else

                    <input type="text" name="searchValue" id="searchValue"
                           class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                  bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                  focus:ring-2 focus:ring-blue-500 focus:outline-none"/>
                @endisset
            </div>
            <div class="flex items-end">
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Search
                </button>
            </div>
        </form>

        @isset($albums)
            <div class="max-w-6xl mx-auto px-6 py-8">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">Albums</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($albums as $album)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 hover:shadow-lg transition flex flex-col justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">
                                {{ $album->name }}
                            </h2>
                            <p class="text-gray-600 dark:text-gray-300">
                                <span class="font-medium">Artist:</span> {{ $album->artist->name }}
                            </p>
                            <p class="text-gray-600 dark:text-gray-300">
                                <span class="font-medium">Genre:</span> {{ $album->genre->name }}
                            </p>
                        </div>

                        <div class="mt-4 flex flex-col space-y-2">
                            {{-- Details --}}
                            <a href="{{ route('/albumDetails', ['id' => $album->id]) }}"
                               class="px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 text-center transition">
                                Details
                            </a>

                            {{-- Add to collection --}}
                            <a href="{{ route('/addToCollection', ['id' => $album->id]) }}"
                               class="px-3 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 text-center transition">
                                Add to collection
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        @endisset
    </div>
</x-app-layout>
