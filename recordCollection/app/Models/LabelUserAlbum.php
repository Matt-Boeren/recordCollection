<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabelUserAlbum extends Model
{
    public function label(){
        return $this->belongsTo(Label::class, 'labelId');
    }

    public function userAlbum(){
        return $this->belongsTo(UserAlbum::class, 'userAlbumId');
    }
}
