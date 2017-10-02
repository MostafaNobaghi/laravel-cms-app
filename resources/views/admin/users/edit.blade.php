@extends('layouts/admin')
@section('content')

    <h2>Edit User</h2>

    @include('includes.errors')

    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-offset-1">
            <h4>Image</h4>
            <a href="#" class="thumbnail">
                <img src="{{$user->photo?$user->photo->file:'/images/placeholder.svg'}}" alt="...">
            </a>
        </div>
        <div class="col-sm-6">
            <h4>User data</h4>
            {!! Form::model($user,['method'=>'PATCH','action' => ["AdminUsersController@update", $user->id], 'files'=>true, 'class'=>' ']) !!}
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
        </div>
    </div>



@endsection