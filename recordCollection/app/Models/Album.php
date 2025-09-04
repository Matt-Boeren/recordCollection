<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function genre(){
        return $this->belongsTo(Genre::class, 'genreId');
    }
    public function artist(){
        return $this->belongsTo(Artist::class, 'artistId');
    }
    public function sides(){
        return $this->hasMany(Side::class, 'albumId');
    }
}
