<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order'
    ];

    public function side(){
        return $this->belongsTo(Side::class, 'sideId');
    }
}
