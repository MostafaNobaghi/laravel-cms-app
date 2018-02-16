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
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::auth();

// Login via Ajax
Route::post('/ajaxlogin', 'Auth\AuthController@ajaxLogin');

Route::group(['prefix'=>'admin', 'middleware'=>'admin'], function (){
    Route::get('/', function (){
        return view('admin.index');
    });

    Route::resource('/users', 'AdminUsersController');
    Route::resource('/posts', 'AdminPostsController');
    Route::resource('/categories', 'AdminCategoriesController');
    Route::resource('/media', 'AdminMediaController');
//    Route::get('admin/media', ['as'=>'admin.media.index', 'uses'=>'AdminMediaController@index']);
//    Route::get('/admin/media/upload', ['as'=>'admin.media.upload', 'uses'=>'AdminMediaController@upload']);
//    Route::group(['prefix'])
    Route::resource('/comments', 'CommentsController');
    Route::post('comments/approve-disapprove/{id}', 'CommentsController@approveToggle')->name('comment.approve');
    Route::resource('/comment/replies', 'CommentRepliesController');
});
Route::get('/post/{id}', 'AdminPostsController@show');

Route::get('/home', 'HomeController@index');

Route::get('blog', ['as'=>'blog.index', 'uses'=>'AdminPostsController@blog']);
Route::get('blog/post/{id}', ['as' => 'blog.post', 'uses' => 'AdminPostsController@show']);

Route::group(['middleware'=>'auth'], function (){
    Route::post('comment/reply', 'CommentRepliesController@createReply');
});





