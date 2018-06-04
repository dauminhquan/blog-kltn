<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //

    protected $table = 'employees';

    public function userEnterprise()
    {
        return $this->belongsTo('App\Models\User','user_enterprise','user_name');
    }
    public function userStudent()
    {
        return $this->belongsTo('App\Models\User','code_student','user_name');
    }
}
