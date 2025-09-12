<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAlbum extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'description',
        'picture'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }
    public function album(){
        return $this->belongsTo(Album::class, 'albumId');
    }

    public function labels(){
        return $this->hasMany(LabelUserAlbum::class, 'userAlbumId');
    }
}
