<?php

namespace App\Http\Controllers;

use App\Models\UserAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class collection extends Controller
{
    public function showCollection(){

        return view('collection');
    }
    public function showAddToCollection(){
        return view('addToCollection');
    }
    public function addToCollection(Request $request){
        $albumId = $request->input('albumId');
        $rating = $request->input('rating');
        $picture = $request->file('picture');

        $userAlbum = new UserAlbum();
        $userAlbum->albumId = $albumId;
        $userAlbum->rating = $rating;
        $userAlbum->picture = $picture;
        $userAlbum->userId = Auth::id();
        $userAlbum->save();

        return redirect('/collection');
    }
}
