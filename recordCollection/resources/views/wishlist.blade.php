<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">My wishlist</h1>

        @isset($wishlists)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($wishlists as $wishlist)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 hover:shadow-lg transition flex flex-col">

                        {{-- Album Info --}}
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-1">
                            {{ $wishlist->album->name }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Artist:</span> {{ $wishlist->album->artist->name }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            <span class="font-medium">Genre:</span> {{ $wishlist->album->genre->name }}
                        </p>

                        {{-- Actions --}}
                        <div class="mt-auto">
                            <a href="{{ route('/albumDetails', ['id' => $wishlist->album->id]) }}"
                               class="block w-full text-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">
                                Album details
                            </a>

                            <a href="{{ route('/addToCollection', ['id' => $wishlist->album->id]) }}"
                               class="block w-full text-center px-3 py-2 bg-purple-600 text-white text-sm mt-2 font-medium rounded-lg hover:bg-purple-700 transition">
                                Add to collection
                            </a>

                            {{-- Delete --}}
                            <form method="POST" action="{{ route('/deleteFromWishlist', ['id' => $wishlist->id]) }}" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"

                               class="block w-full text-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
                                    <span>Delete from wishlist</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset

    </div>
</x-app-layout>
