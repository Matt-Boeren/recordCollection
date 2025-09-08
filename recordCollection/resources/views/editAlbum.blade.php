<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-8">Album</h1>

        <form method="POST" action="{{ route('/editAlbum', ['id' => $album->id]) }}"
              class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md space-y-8">
            @csrf
            <input type="hidden" name="numSides" id="numSides" value="2" />


            {{-- Album Info --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="albumName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Album Name</label>
                    <input type="text" name="albumName" id="albumName" value="{{ $album->name }}"
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
                            @if($artist->id == $album->artistId)
                                <option value="{{ $artist->id }}" selected>{{ $artist->name }}</option>
                            @else
                                <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                            @endif
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
                            @if($genre->id == $album->genreId)
                                <option value="{{ $genre->id }}" selected>{{ $genre->name }}</option>
                            @else
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endif
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

            <div class="flex gap-2">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition inline-flex items-center justify-center">
                    Edit album
                </button>

                <a href="{{ route('/albumDetails', ['id' => $album->id]) }}"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition inline-flex items-center justify-center">
                    Cancel
                </a>
            </div>
        </form>

    </div>

    <script>
        let number = 0;
        let sides = {!! json_encode($album->sides->toArray()) !!};
        console.log(sides);

        sides.forEach(function (side){
            const container = document.getElementById('sideContainer');
            number++;
            container.appendChild(createSide(number, side.name, side.songs));
        });

        const numSides = document.getElementById('numSides');
        numSides.value = number;

        function addSide(){

            const container = document.getElementById('sideContainer');
            number++;
            container.appendChild(createSide(number,"",[]));
            number++;
            container.appendChild(createSide(number,"",[]));

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
        function createSong(sideNumber, songNumber, name){
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
            songInput.value = name;
            songInput.classList = `w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                      focus:ring-2 focus:ring-purple-500 focus:outline-none`;
            songElement.appendChild(songInput);
            return songElement;
        }
        function createSide(sideNumber, name, songList) {
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
            nameInput.value = name;
            nameInput.classList = `w-full mt-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg
                                      bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                                      focus:ring-2 focus:ring-green-500 focus:outline-none`;
            nameDiv.appendChild(nameInput);

            const songAmount = document.createElement("input");
            songAmount.type = "hidden";
            songAmount.id = `numSongs${sideNumber}`;
            songAmount.name = `numSongs${sideNumber}`;
            songAmount.value = songList.length;
            nameDiv.appendChild(songAmount);

            div.appendChild(nameDiv);

            const songDiv = document.createElement("div");
            for(let i = 0; i < songList.length; i++){
                songDiv.id = `songs${sideNumber}`;
                const songElement = createSong(sideNumber, i + 1, songList[i].name);
                songDiv.appendChild(songElement);
                div.appendChild(songDiv);
            }
            if(songList.length == 0){
                songDiv.id = `songs${sideNumber}`;
                const songElement = createSong(sideNumber, 1, "");
                songDiv.appendChild(songElement);
                div.appendChild(songDiv);
                songAmount.value = 1;
            }

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
                const songElement = createSong(sideNumber, amount, "");
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
