<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'photo_id', 'category_id'];


    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }


    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }



    public function shortBody(){
        return substr($this->body,0,30).'...';
    }
}
