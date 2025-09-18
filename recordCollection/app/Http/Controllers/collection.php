<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Label;
use App\Models\LabelUserAlbum;
use App\Models\UserAlbum;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

        $userAlbum = new UserAlbum();


        $userId = Auth::id();
        $wishlist = Wishlist::where('userId', '=', $userId)->where('albumId', '=', $id)->first();

        if($wishlist != null){
            $wishlist->delete();
        }

        $this->add($request, $userAlbum, $id);

        return redirect('/collection');
    }
    public function showEditCollection($id){
        $userAlbum = UserAlbum::find($id);
        $labels = Label::all();
        $selectedLabels = LabelUserAlbum::where('userAlbumId', '=', $id)->pluck('labelId')->toArray();
        return view('editCollection', compact('userAlbum', 'labels', 'selectedLabels'));
    }
    public function editCollection($id, Request $request){
        $userAlbum = UserAlbum::find($id);

        $userAlbum->labels()->delete();

        $this->add($request, $userAlbum, $userAlbum->albumId);
        return redirect('/collection');
    }
    public function deleteFromCollection($id){
        $userAlbum = UserAlbum::find($id);
        if($userAlbum->picture != null){
            Storage::disk('public')->delete($userAlbum->picture);
        }
        $userAlbum->delete();

        return redirect('/collection');
    }

    private function add(Request $request, UserAlbum $userAlbum, $id){

        $rating = $request->input('rating');
        $labels = $request->input('labels');
        $description = $request->input('description');


        if($userAlbum->picture != null){
            $delete = $request->input("pictureDeleted");
            if($delete == "true"){
                Storage::disk('public')->delete($userAlbum->picture);

                $userAlbum->picture = null;
            }
        }
        if($request->hasFile('picture')){


            $filePath = 'images/collection/';

            $manager = new ImageManager(new Driver());
            $picture = $manager->read($request->file('picture'));
            $picture = $picture->scale(width: 500)->toJpeg(quality: 70);

            $fileName = time() . '.jpg';
            Storage::disk('public')->put($filePath . $fileName, $picture);

            $userAlbum->picture = $filePath . $fileName;
        }

        if($description){
            $userAlbum->description = $description;
        }

        $userAlbum->albumId = $id;
        if($rating != -0.25){
            $userAlbum->rating = $rating;
        }
        else{
            $userAlbum->rating = null;
        }
        $userAlbum->userId = Auth::id();
        $userAlbum->save();
        if($labels != null){
            foreach($labels as $label){
                $labelUserAlbum = new LabelUserAlbum();
                $labelUserAlbum->userAlbumId = $userAlbum->id;
                $labelUserAlbum->labelId = $label;
                $labelUserAlbum->save();
            }
        }
    }
}
