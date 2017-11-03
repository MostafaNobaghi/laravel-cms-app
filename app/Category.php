<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $fillable = ['name'];
//    protected $casts = ['quantity'=>'int'];

//    public function __construct()
//    {
////        $this->postsCount = $this->postsCount();
////        $this->attributes['quantity'] =  DB::statement("SELECT COUNT(*) AS NumberOfPosts FROM posts WHERE category_id = 1 ");
//        $this->setQuantityAttribute();
//    }




//    public function getQuantityAttribute() {
//        return $this->casts['quantity'];
//    }

//    public function setQuantityAttribute() {
//        $this->casts['quantity'] = DB::statement("SELECT COUNT(*) AS NumberOfPosts FROM posts WHERE category_id = 2 ");
//    }


    public function posts(){
        return $this->hasMany('App\Post');
    }

//    public function postsCount(){
////        return $this->posts();
//        $sql = "SELECT COUNT(*) AS NumberOfPosts FROM posts WHERE category_id = 2 ";
//        return DB::statement($sql);
//    }




/*

    // Module model
    public function sectionsCountRelation()
    {
        return $this->hasOne('Section')->selectRaw('module_id, count(*) as count')->groupBy('module_id');
        // replace module_id with appropriate foreign key if needed
    }


// then you can access it like this:

$modules = Module::with('sectionsCountRelation')->get();
$modules->first()->sectionsCountRelation->count;

// but there is a bit sugar to make it easier (and that s why I renamed it to sectionsCountRelation)

    public function getSectionsCountAttribute()
    {
        return $this->sectionsCountRelation->count;
    }


*/


}
