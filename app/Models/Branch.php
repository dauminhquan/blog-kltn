<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function students()
    {
        return $this->hasMany('App\Models\Student','code_branch','code_branch');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department','code_department','code_department');
    }
}
