<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Label;
use App\Models\LabelUserAlbum;
use App\Models\UserAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class collection extends Controller
{
    public function showCollection(){

        $userId = Auth::id();
        $userAlbums = UserAlbum::where('userId', '=', $userId)->get();

        return view('collection', compact('userAlbums'));
    }
    public function showAddToCollection($id){
        $album = Album::find($id);
        $labels = Label::all();
        return view('addToCollection', compact('album', 'labels'));
    }
    public function addToCollection($id, Request $request){
        $rating = $request->input('rating');
        $labels = $request->input('labels');

        $userAlbum = new UserAlbum();
        if($request->hasFile('picture')){

            $picture = $request->file('picture');
            $extention = $picture->getClientOriginalExtension();
            $fileName = time() . "." . $extention;
            $filePath = 'images/collection/';
            $picture->move($filePath, $fileName);
            $userAlbum->picture = $filePath . $fileName;

        }

        $userAlbum->albumId = $id;
        $userAlbum->rating = $rating;
        $userAlbum->userId = Auth::id();
        $userAlbum->save();

        foreach($labels as $label){
            $labelUserAlbum = new LabelUserAlbum();
            $labelUserAlbum->userAlbumId = $userAlbum->id;
            $labelUserAlbum->labelId = $label;
            $labelUserAlbum->save();
        }

        return redirect('/collection');
    }
    public function deleteFromCollection($id){
        $userAlbum = UserAlbum::find($id);
        $userAlbum->delete();

        return redirect('/collection');
    }
}
