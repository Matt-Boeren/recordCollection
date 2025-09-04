<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Side extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function album(){
        return $this->belongsTo(Album::class, 'albumId');
    }
    public function songs(){
        return $this->hasMany(Song::class, 'sideId');
    }
}
