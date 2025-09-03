<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Label;
use Illuminate\Http\Request;

class general extends Controller
{
    public function showGeneral(){
        $artists = Artist::all();
        $genres = Genre::all();
        $labels = Label::all();

        return view('general', compact('artists', 'genres', 'labels'));
    }
    public function addArtist(Request $request){
        $name = $request->input('name');
        $description = $request->input('description');

        $artist = new Artist();
        $artist->name = $name;
        $artist->description = $description;
        $artist->save();

        return redirect('/general');
    }
    public function deleteArtist($id){
        $artist = Artist::find($id);
        $artist->delete();

        return redirect('/general');
    }
    public function addGenre(Request $request){
        $name = $request->input('name');

        $genre = new Genre();
        $genre->name = $name;
        $genre->save();

        return redirect('/general');
    }
    public function deleteGenre($id){
        $genre = Genre::find($id);
        $genre->delete();

        return redirect('/general');
    }
    public function addLabel(Request $request){
        $name = $request->input('name');

        $label = new Label();
        $label->name = $name;
        $label->save();

        return redirect('/general');
    }
    public function deleteLabel($id){
        $label = Label::find($id);
        $label->delete();

        return redirect('/general');
    }
}
