<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','code_branch','code_branch');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course','code_course','code_course');
    }
    public function enterprises()
    {
        // chưa rõ
        return $this->belongsToMany('App\Models\Enterprise','employees','id_student','id_enterprise','id','id');
    }
}
