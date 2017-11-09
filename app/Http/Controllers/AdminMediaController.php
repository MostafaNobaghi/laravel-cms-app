<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( $file = $request->file('file')){
            $name = time().$file->getClientOriginalName();
            if ($file->move('images/', $name)){
                Photo::create(['file'=>$name]);
            }

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Photo::findOrFail($id);
        if ($post=$media->post){
            Session::flash('media_delete_error', "The media you try to delete belongs to '$post->title' post");

        } elseif ($user = $media->user){
            Session::flash('media_delete_error', "The media you try to delete belongs to '$user->name' user");
        }else {
            $file = public_path().$media->file;
            if(is_file($file)){
                unlink($file);
            }
            $media->delete();
            Session::flash('media_delete', "The media '$media->file' Deleted successfully.");
        }
        return redirect(route('admin.media.index'));
    }
}
