<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">My Collection</h1>

        @isset($userAlbums)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($userAlbums as $userAlbum)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 hover:shadow-lg transition flex flex-col">
                        {{-- Album Cover --}}
                        @if($userAlbum->picture != null)
                            <img src="{{ $userAlbum->picture }}" alt="{{ $userAlbum->album->name }} cover"
                                 class="w-full h-48 object-cover rounded-lg mb-4">
                        @endif

                        {{-- Rating --}}
                        @if($userAlbum->rating != null)
                            <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                                <span class="font-medium">Rating:</span> {{ $userAlbum->rating }}
                            </p>
                        @endif

                        {{-- Album Info --}}
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-1">
                            {{ $userAlbum->album->name }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Artist:</span> {{ $userAlbum->album->artist->name }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            <span class="font-medium">Genre:</span> {{ $userAlbum->album->genre->name }}
                        </p>

                        {{-- Actions --}}
                        <div class="mt-auto">
                            <a href="{{ route('/albumDetails', ['id' => $userAlbum->album->id]) }}"
                               class="block w-full text-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">
                                Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset
    </div>
</x-app-layout>
