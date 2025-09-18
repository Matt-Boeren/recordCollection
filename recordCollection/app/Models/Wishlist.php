<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }
    public function album(){
        return $this->belongsTo(Album::class, 'albumId');
    }
}
