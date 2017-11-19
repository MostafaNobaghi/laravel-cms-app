<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'role_id', 'is_active', 'email', 'password', 'photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function role(){
        return $this->belongsTo('App\Role');
    }


    public function photo(){
        return $this->belongsTo('App\Photo');
    }


    public function isAdmin(){
        if($this->role['name'] == 'administrator'){
            return true;
        }
            return false;
    }


    public function isRegular(){
        if ($this->role->name == '' || null){
            return true;
        }
        return false;
    }


    public function isActive(){
        return $this->is_active == 1 ? true : false;
    }



    public function posts(){
        return $this->hasMany('App\Post');
    }
}
