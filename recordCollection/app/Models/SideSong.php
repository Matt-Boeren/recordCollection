<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SideSong extends Model
{
    use HasFactory;

    protected $fillable = [
        'order'
    ];

    public function side(){
        return $this->belongsTo(Side::class, 'sideId');
    }
    public function song(){
        return $this->belongsTo(Song::class, 'songId');
    }
}
