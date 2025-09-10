<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Label;
use App\Models\LabelUserAlbum;
use App\Models\UserAlbum;
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
        $rating = $request->input('rating');
        $labels = $request->input('labels');

        $userAlbum = new UserAlbum();
        if($request->hasFile('picture')){


            $filePath = 'images/collection/';

            $manager = new ImageManager(new Driver());
            $picture = $manager->read($request->file('picture'));
            $picture = $picture->scale(width: 500)->toJpeg(quality: 70);

            $fileName = time() . '.jpg';
            Storage::disk('public')->put($filePath . $fileName, $picture);

            $userAlbum->picture = $filePath . $fileName;
        }

        $userAlbum->albumId = $id;
        $userAlbum->rating = $rating;
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
}
