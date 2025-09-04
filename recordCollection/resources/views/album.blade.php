<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-8">Album</h1>

        <form method="POST" action="{{ route('/addAlbum') }}"
              class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md space-y-8">
            @csrf
            <input type="hidden" name="numSides" id="numSides" value="2" />


            {{-- Album Info --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="albumName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Album Name</label>
                    <input type="text" name="albumName" id="albumName"
                           class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                  bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                  focus:ring-2 focus:ring-blue-500 focus:outline-none"/>
                </div>

                <div>
                    <label for="artist" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Artist</label>
                    <select name="artist" id="artist"
                            class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                   bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                   focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="genre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Genre</label>
                    <select name="genre" id="genre"
                            class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                   bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                   focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Sides (next to each other on big screens) --}}
            <div id="sideContainer" class="grid grid-cols-1 md:grid-cols-2 gap-8">

            </div>

            <div class="flex justify-center">
                <button id="addSide"
                        class="px-4 py-2 mr-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Add record
                </button>

                <button id="deleteSide"
                        class="px-4 py-2 ml-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Delete record
                </button>
            </div>


            {{-- Submit --}}
            <div>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Add Album
                </button>
            </div>
        </form>


        <div class="max-w-6xl mx-auto px-6 py-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">Albums</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($albums as $album)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 hover:shadow-lg flex justify-between items-start transition">
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
                        <div class="flex-col">
                            <form method="POST" action="{{ route('/deleteAlbum', ['id' => $album->id]) }}" class="m-2">
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
                            <a href="{{ route('/albumDetails',  ['id' => $album->id]) }}"
                                class="px-3 m-2 py-1 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 flex items-center space-x-1 transition">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320zM320 224C373 224 416 267 416 320C416 373 373 416 320 416C267 416 224 373 224 320C224 267 267 224 320 224zM320 464C399.5 464 464 399.5 464 320C464 240.5 399.5 176 320 176C240.5 176 176 240.5 176 320C176 399.5 240.5 464 320 464zM320 352C337.7 352 352 337.7 352 320C352 302.3 337.7 288 320 288C302.3 288 288 302.3 288 320C288 337.7 302.3 352 320 352z"/></svg>
                                    <span>Detais</span>
                            </a>

                        </div>


                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        let number = 0;
        addSide();

        function addSide(){

            const container = document.getElementById('sideContainer');
            number++;
            container.appendChild(createSide(number));
            number++;
            container.appendChild(createSide(number));

            const numSides = document.getElementById('numSides');
            numSides.value = number;
        }

        document.getElementById('addSide').addEventListener('click', function (e){
            e.preventDefault();
            addSide();
        });
        document.getElementById('deleteSide').addEventListener('click', function (e){
            e.preventDefault();
            const container = document.getElementById('sideContainer');
            if (container.children.length > 2){
                container.removeChild(container.lastChild);
                container.removeChild(container.lastChild);
                number -= 2;
                const numSides = document.getElementById('numSides');
                numSides.value = number;
            }
        });
        function createSong(sideNumber, songNumber){
            const songElement = document.createElement("div");
            const songLabel = document.createElement("label");
            songLabel.htmlFor = `song${sideNumber}${songNumber}`;
            songLabel.classList = "block text-sm font-medium text-gray-700 dark:text-gray-300";
            songLabel.innerText = `Song ${songNumber}`;
            songElement.appendChild(songLabel);
            const songInput = document.createElement("input");
            songInput.type = "text";
            songInput.name = `song${sideNumber}${songNumber}`;
            songInput.id = `song${sideNumber}${songNumber}`;
            songInput.classList = `w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                      focus:ring-2 focus:ring-purple-500 focus:outline-none`;
            songElement.appendChild(songInput);
            return songElement;
        }
        function createSide(sideNumber) {
            const div = document.createElement("div");
            div.classList = "space-y-4";
            const title = document.createElement("h2");
            title.classList = "text-xl font-semibold text-gray-800 dark:text-gray-100";
            title.innerText = "Side " + sideNumber;
            div.appendChild(title);
            const nameDiv = document.createElement("div");
            const sideNameLabel = document.createElement("label");
            sideNameLabel.htmlFor = `sideName${sideNumber}`;
            sideNameLabel.classList = "block text-sm font-medium text-gray-700 dark:text-gray-300";
            sideNameLabel.innerText = "Side name";
            nameDiv.appendChild(sideNameLabel);
            const nameInput = document.createElement("input");
            nameInput.type = "text";
            nameInput.name = `sideName${sideNumber}`;
            nameInput.id = `sideName${sideNumber}`;
            nameInput.classList = `w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                      focus:ring-2 focus:ring-green-500 focus:outline-none`;
            nameDiv.appendChild(nameInput);

            const songAmount = document.createElement("input");
            songAmount.type = "hidden";
            songAmount.id = `numSongs${sideNumber}`;
            songAmount.name = `numSongs${sideNumber}`;
            songAmount.value = 1;
            nameDiv.appendChild(songAmount);

            div.appendChild(nameDiv);

            const songDiv = document.createElement("div");
            songDiv.id = `songs${sideNumber}`;
            const songElement = createSong(sideNumber, 1);
            songDiv.appendChild(songElement);
            div.appendChild(songDiv);

            const add = document.createElement("button");
            add.id = `addSong${sideNumber}`;
            add.classList = "px-4 py-2 mr-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition";
            add.innerText = "Add song";
            add.addEventListener('click', function (e){
                e.preventDefault();
                const container = document.getElementById(`songs${sideNumber}`);
                const songAmount = document.getElementById(`numSongs${sideNumber}`);
                let amount = parseInt(songAmount.value);
                amount++;
                songAmount.value = amount;
                const songElement = createSong(sideNumber, amount);
                container.appendChild(songElement);
            });
            div.appendChild(add);

            const del = document.createElement("button");
            del.id = `addSong${sideNumber}`;
            del.classList = "px-4 py-2 ml-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition";
            del.innerText = "Delete song";
            del.addEventListener('click', function (e){
                e.preventDefault();
                const container = document.getElementById(`songs${sideNumber}`);

                if (container.children.length > 1){
                    container.removeChild(container.lastChild);

                    let amount = parseInt(songAmount.value);
                    amount--;
                    songAmount.value = amount;
                }
            });
            div.appendChild(del);
        return div;
        }
    </script>

</x-app-layout>
