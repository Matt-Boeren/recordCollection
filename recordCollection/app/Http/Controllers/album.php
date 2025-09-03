<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Genre;
use Illuminate\Http\Request;

class album extends Controller
{
    public function showAlbum(){
        $artists = Artist::all();
        $genres = Genre::all();

        return view('album', compact('artists', 'genres'));
    }
    public function addAlbum(Request $request){

    }
}
