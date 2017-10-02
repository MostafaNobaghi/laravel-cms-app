@extends('layouts/admin')
@section('content')

    <h2>Edit User</h2>

    {{--{{dd($rolesArray)}}--}}
    @if(count($errors)>0)
        <div class="alert alert-danger col-md-3 col-md-offset-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
{{--    {{dd($user->photo)}}--}}
    <div class="col-xs-6 col-md-3 col-md-offset-3">
        <a href="#" class="thumbnail">
            <img src="{{$user->photo->file}}" alt="...">
        </a>
    </div>
    {!! Form::model($user,['method'=>'PATCH','action' => ["AdminUsersController@update", $user->id], 'files'=>true, 'class'=>'col-md-3 ']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'john smith']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'example@xmail.com']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id', 'Role:') !!}
        {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_active', 'Set active:') !!}
        {!! Form::select('is_active', [0=>'Not active', 1=>'Active'],null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('photo_id', 'Image:', ['class'=>'']) !!}
        {!! Form::file('photo_id', ['class'=>'']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Edit',['class'=>'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}
@endsection