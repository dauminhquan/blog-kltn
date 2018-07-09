<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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
    public function token_api()
    {
        return $this->hasMany('App\Models\OauthAccessTokens','user_id','id');
    }
    public function employees()
    {
        return $this->hasMany(Employee::class,'user_enterprise','user_name');
    }
    public function works()
    {
        return $this->hasMany(Employee::class,'code_student','user_name');
    }
    public function admin()
    {
        return $this->hasOne(Admin::class,'id_user','id');
    }

}
