<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $hidden = ['id'];
    public function students()
    {
        return $this->hasMany('App\Models\Student','code_department','code_department');
    }
    public function branches()
    {
        return $this->hasMany('App\Models\Branch','code_department','code_department');
    }

}
