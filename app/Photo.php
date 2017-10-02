<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['file', 'imageable_id', 'imageable_type'];

    protected $directory = '/images/';

    public function getFileAttribute($file){
        return $this->directory.$file;
    }
}


