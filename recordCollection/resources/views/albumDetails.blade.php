<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md space-y-8">

            {{-- Header with Actions --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-4 md:mb-0">
                    {{ $album->name }}
                </h1>

                <div class="flex space-x-3">
                    {{-- Details --}}
                    <a href="{{ route('/albumDetails', ['id' => $album->id]) }}"
                       class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 flex items-center space-x-2 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4.5C7.305 4.5 3.135 7.273 1.5 12c1.635 4.727 5.805 7.5 10.5 7.5s8.865-2.773 10.5-7.5c-1.635-4.727-5.805-7.5-10.5-7.5zM12 17c-2.757 0-5-2.243-5-5s2.243-5 5-5
                            5 2.243 5 5-2.243 5-5 5z"/><circle cx="12" cy="12" r="2.5"/>
                        </svg>
                        <span>Details</span>
                    </a>

                    {{-- Delete --}}
                    <form method="POST" action="{{ route('/deleteAlbum', ['id' => $album->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 flex items-center space-x-2 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span>Delete</span>
                        </button>
                    </form>
                </div>
            </div>

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
