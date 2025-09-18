<?php

namespace App\Http\Controllers;

use App\Models\Wishlist as ModelsWishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class wishlist extends Controller
{
    public function showWishlist(){

        $userId = Auth::id();
        $wishlists = ModelsWishlist::Where('userId', '=', $userId)->get();
        return view('wishlist', compact('wishlists'));
    }
    public function addToWishlist($id){
        $wishlist = new ModelsWishlist();

        $wishlist->userId = Auth::id();
        $wishlist->albumId = $id;

        $wishlist->save();

        return redirect('/wishlist');
    }
    public function deleteFromWishlist($id){
        $wishlist = ModelsWishlist::find($id);
        $wishlist->delete();

        return redirect('/wishlist');
    }
}
