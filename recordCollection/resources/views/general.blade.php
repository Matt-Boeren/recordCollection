<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-8">General</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Artist Section --}}
            <div class="space-y-4">
                <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Artist</h2>
                <form method="POST" action="{{ route('/addArtist') }}"
                      class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md space-y-4">
                    @csrf
                    <div>
                        <label for="artist-name" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Name</label>
                        <input name="name" id="artist-name" type="text"
                               class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                      focus:ring-2 focus:ring-blue-500 focus:outline-none"/>
                    </div>

                    <div>
                        <label for="artist-description" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Description</label>
                        <textarea name="description" id="artist-description" rows="2"
                                  class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                         bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                         focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Add artist
                    </button>
                </form>

                <button onclick="toggleList('artist-list', this)"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    Show Artists
                </button>

                <div id="artist-list" hidden class="space-y-4">
                    @foreach($artists as $artist)
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl shadow-sm flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $artist->name }}</h3>
                                <p class="text-gray-600 dark:text-gray-300">{{ $artist->description }}</p>
                            </div>
                            <div>
                                <form method="POST" action="{{ route('/deleteArtist', ['id' => $artist->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 flex items-center space-x-1 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Genre Section --}}
            <div class="space-y-4">
                <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Genre</h2>
                <form method="POST" action="{{ route('/addGenre') }}"
                      class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md space-y-4">
                    @csrf
                    <div>
                        <label for="genre-name" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Name</label>
                        <input name="name" id="genre-name" type="text"
                               class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                      focus:ring-2 focus:ring-green-500 focus:outline-none"/>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Add genre
                    </button>
                </form>

                <button onclick="toggleList('genre-list', this)"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    Show Genres
                </button>

                <div id="genre-list" hidden class="space-y-4">
                    @foreach($genres as $genre)
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl shadow-sm flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $genre->name }}</h3>
                            </div>
                            <div>
                                <form method="POST" action="{{ route('/deleteGenre', ['id' => $genre->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 flex items-center space-x-1 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Label Section --}}
            <div class="space-y-4">
                <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">Label</h2>
                <form method="POST" action="{{ route('/addLabel') }}"
                      class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md space-y-4">
                    @csrf
                    <div>
                        <label for="label-name" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Name</label>
                        <input name="name" id="label-name" type="text"
                               class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                      focus:ring-2 focus:ring-purple-500 focus:outline-none"/>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                        Add label
                    </button>
                </form>

                <button onclick="toggleList('label-list', this)"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    Show Labels
                </button>

                <div id="label-list" hidden class="space-y-4">
                    @foreach($labels as $label)
                        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl shadow-sm flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $label->name }}</h3>
                            </div>
                            <div>
                                <form method="POST" action="{{ route('/deleteLabel', ['id' => $label->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 flex items-center space-x-1 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleList(listId, button) {
            const list = document.getElementById(listId);

            if (list.hidden) {
                list.hidden = false;
                button.textContent = button.textContent.replace('Show', 'Hide');
            } else {
                list.hidden = true;
                button.textContent = button.textContent.replace('Hide', 'Show');
            }
        }
    </script>
</x-app-layout>
