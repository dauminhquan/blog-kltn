<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $hidden = ['id'];
    public function students()
    {
        return $this->hasMany('App\Models\Student','code_course','code_course');
    }

}
