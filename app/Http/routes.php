<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\User;


Route::get('/', function () {
    return view('welcome');
});

Route::auth();

// Login via Ajax
Route::post('/ajaxlogin', 'Auth\AuthController@ajaxLogin');

Route::group(['middleware'=>'admin'], function (){
    Route::get('/admin', function (){
        return view('admin.index');
    });

    Route::resource('/admin/users', 'AdminUsersController');
    Route::resource('/admin/posts', 'AdminPostsController');
    Route::get('/post/{id}', 'AdminPostsController@show');
    Route::resource('/admin/categories', 'AdminCategoriesController');
    Route::resource('/admin/media', 'AdminMediaController');
//    Route::get('admin/media', ['as'=>'admin.media.index', 'uses'=>'AdminMediaController@index']);
//    Route::get('/admin/media/upload', ['as'=>'admin.media.upload', 'uses'=>'AdminMediaController@upload']);
    Route::resource('admin/comments', 'CommentsController');
    Route::resource('admin/comment/replies', 'CommentRepliesController');
});

Route::get('/home', 'HomeController@index');

Route::get('blog', ['as'=>'blog.index', 'uses'=>'AdminPostsController@blog']);
Route::get('blog/post/{id}', ['as' => 'blog.post', 'uses' => 'AdminPostsController@show']);





