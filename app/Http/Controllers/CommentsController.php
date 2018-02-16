<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($id = Input::get('id')) {
            $comments = Comment::where('post_id', $id)->get();
        }else{
            $comments = Comment::all();
        }
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $data = [
            'post_id' => $input['post_id'],
            'author'  => $user->name,
            'email'   => $user->email,
            'body'    => $input['body'],
        ];


        if (isset($user->photo->file))$data['photo'] = $user->photo->file;
        if (!$user->isRegular())$data['is_active'] = 1;
        Comment::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($comment=Comment::find($id))
            $comment->delete();
        return back();
    }

    /**
     * Change status of a comment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approveToggle($id)
    {
        if($comment=Comment::find($id))
            $comment->is_active = ($comment->is_active > 0 ? 0 : 1);
            $comment->save();
        return back();
    }
}
