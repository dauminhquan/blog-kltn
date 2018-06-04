<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function email_receive()
    {
        return $this->hasMany('App\Models\Email','to_id_user','id');
    }
    public function email_send()
    {
        return $this->hasMany('App\Models\Email','from_id_user','id');
    }
    public function student()
    {
        return $this->hasOne('App\Models\Student','id_user','id');
    }
    public function enterprise()
    {
        return $this->hasOne('App\Models\Enterprise','id_user','id');
    }

}
