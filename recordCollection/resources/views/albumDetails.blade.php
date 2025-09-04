<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-8">
            {{ $album->name }}
        </h1>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md space-y-8">

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
