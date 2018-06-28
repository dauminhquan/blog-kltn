<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCourse extends Model
{
    //
    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class,'id_enterprise','id');
    }
}
