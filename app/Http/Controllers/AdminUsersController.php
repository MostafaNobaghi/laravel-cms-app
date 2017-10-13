<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersSaveRequest;
use App\Photo;
use App\Role;
use App\User;
use Faker\Provider\File;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name','id');
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersSaveRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt(trim($request->password));

        if($request->file('photo_id')){
            $file = $request->file('photo_id');
            $name = time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::Create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }


         User::create($input);
        Session::flash('user_created', "The user '$request->name' created successfully");
         return redirect(route('admin.users.index'));
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
        $user = User::find($id);
        $roles = Role::lists('name','id');
        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
//        dd($request->all());

        $input = $request->all();
        // if contains file
        if($request->file('photo_id')){
            $file = $request->file('photo_id');
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        // if password changed
        if(trim($input['password'])!='') {
            $input['password'] = bcrypt($request->password);
        } else{
            unset($input['password']);
        }

        User::findOrFail($id)->update($input);

        Session::flash('user_updated', "The user '$request->name' updated successfully");
        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete user photo
        if($user->name != 'mostafa nobaghi'){
            if($user->photo){
                $photo = $user->photo;
                if(unlink(public_path().$photo->file)){
                    $photo->delete();
                }
            }

            $user->delete();
            Session::flash('user_deleted',"The user '$user->name' removed");
        }else {
            Session::flash('user_deleted',"You cant delete user '$user->name'");
        }


        return redirect(route('admin.users.index'));
    }
}
