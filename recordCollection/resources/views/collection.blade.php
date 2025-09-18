<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">My collection</h1>

        @isset($userAlbums)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($userAlbums as $userAlbum)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 hover:shadow-lg transition flex flex-col">

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

                        {{-- Album Cover --}}
                        @if($userAlbum->picture != null)
                        <img src="{{ asset('storage/' . $userAlbum->picture ) }}" alt="{{ $userAlbum->album->name }}"
                                 class="w-full h-48 object-contain rounded-lg mb-4">
                        @endif


                        {{-- Rating --}}
                        @if($userAlbum->rating != null)
                            <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                                <span class="font-medium">Rating:</span> {{ $userAlbum->rating }}
                            </p>
                        @endif


                        @if($userAlbum->description != null)
                            <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                                {{ $userAlbum->description }}
                            </p>

                        @endif


                        {{-- Labels --}}
                        @if($userAlbum->labels->isNotEmpty())
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($userAlbum->labels as $LabelUserAlbum)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 shadow-sm">
                                        {{ $LabelUserAlbum->label->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        {{-- Actions --}}
                        <div class="mt-auto">
                            <a href="{{ route('/albumDetails', ['id' => $userAlbum->album->id]) }}"
                               class="block w-full text-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">
                                Album details
                            </a>

                            <a href="{{ route('/editCollection', ['id' => $userAlbum->id]) }}"
                               class="block w-full mt-2 text-center px-3 py-2 bg-yellow-600 text-white text-sm font-medium rounded-lg hover:bg-yellow-700 transition">
                                Edit collection
                            </a>

                            {{-- Delete --}}
                            <form method="POST" action="{{ route('/deleteFromCollection', ['id' => $userAlbum->id]) }}" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"

                               class="block w-full text-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
                                    <span>Delete from collection</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset
    </div>
</x-app-layout>
