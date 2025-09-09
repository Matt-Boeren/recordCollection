<?php

namespace App\Http\Controllers;

use App\Models\Album as AlbumModel;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Side;
use App\Models\Song;
use Illuminate\Http\Request;

class album extends Controller
{
    public function showAlbum(){
        $artists = Artist::all();
        $genres = Genre::all();
        $albums = AlbumModel::all();
        return view('album', compact('artists', 'genres', 'albums'));
    }
    public function addAlbum(Request $request){

        $album = new AlbumModel();

        $this->album($album, $request);

        return redirect("/album");
    }
    public function deleteAlbum($id){
        $album = AlbumModel::find($id);
        $album->delete();

        return redirect("/album");
    }
    public function albumDetails($id){

        $album = AlbumModel::with('sides.songs')->find($id);

        return view('albumDetails', compact('album'));
    }
    public function showEditAlbum($id){
        $artists = Artist::all();
        $genres = Genre::all();
        $album = AlbumModel::with('sides.songs')->find($id);


        return view('editAlbum', compact('artists', 'genres', 'album'));
    }
    public function editAlbum($id, Request $request){

        $album = AlbumModel::with('sides.songs')->find($id);

        $album->sides()->delete();

        $this->album($album, $request);

        $url = "/albumDetails/" . (string)$id;
        return redirect($url);
    }
    public function showSearchAlbum(){
        return view('searchAlbum');
    }

    public function SearchAlbum(Request $request){
        $searchValue = $request->input('searchValue');
        $albums = AlbumModel::where('name', 'like', '%' . $searchValue . '%')
            ->orWhereHas('artist', function($q) use($searchValue) {
                $q->where('name', 'like', '%' . $searchValue . '%');
            })
            ->orWhereHas('genre', function($q) use($searchValue) {
                $q->where('name', 'like', '%' . $searchValue . '%');
            })
            ->orWhereHas('sides.songs', function($q) use($searchValue) {
                $q->where('name', 'like', '%' . $searchValue . '%');
            })
            ->get();
        return view('searchAlbum', compact('albums'));
    }
    private function album(AlbumModel $album, Request $request){

        $name = $request->input("albumName");
        $artist = $request->input("artist");
        $genre = $request->input("genre");

        $album->name = $name;
        $album->artistId = $artist;
        $album->genreId = $genre;
        $album->save();

        $sideAmount = (int)$request->input("numSides");

        for($i = 1; $i <= $sideAmount; $i++){
            $sideName = $request->input("sideName" . (string)$i);
            $side = new Side();
            $side->name = $sideName;
            $side->albumId = $album->id;
            $side->save();

            $numSongs = (int)$request->input("numSongs" . (string)$i);
            for($j = 1; $j <= $numSongs; $j++){
                $songName = $request->input("song" . (string)$i . (string)$j);
                $song = new Song();
                $song->name = $songName;
                $song->order = $j;
                $song->sideId = $side->id;
                $song->save();
                $song = null;
            }
        }
    }

}
