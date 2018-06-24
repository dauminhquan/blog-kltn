<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

    public function enterprise()
    {
        return $this->belongsTo('App\Models\Enterprise','id_enterprise','id');
    }
    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill','post_skill','id_post','id_skill','id','id');
    }
    public function positions()
    {
        return $this->belongsToMany('App\Models\Position','post_position','id_post','id_position','id','id');
    }
    public function types()
    {
        return $this->belongsToMany('App\Models\TypeJob','post_type','id_post','id_job_type','id','id');
    }
    public function cities(){
        return $this->belongsTo('App\Models\PostCity','id','id_post');
    }

}
