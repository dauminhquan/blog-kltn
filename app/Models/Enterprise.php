<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    //
    protected $table = 'enterprises';

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }
    public function posts(){
        return $this->hasMany(Post::class,'id_enterprise','id');
    }
}
